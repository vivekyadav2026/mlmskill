$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"

Write-Host "Creating legacy backup..."
if (!(Test-Path "$baseDir\_legacy")) { New-Item -ItemType Directory -Force -Path "$baseDir\_legacy" | Out-Null }

# Safely move existing folders to _legacy if they exist in the root
$foldersToMove = @("admin", "user", "front", "assets")
foreach ($folder in $foldersToMove) {
    if (Test-Path "$baseDir\$folder") {
        Move-Item -Path "$baseDir\$folder" -Destination "$baseDir\_legacy\" -Force
    }
}

Write-Host "Installing Laravel (this will take a minute)..."
Set-Location $baseDir
# Create project in a temp folder
composer create-project laravel/laravel laravel_temp --quiet

Write-Host "Moving Laravel files to root..."
# Move all visible files/folders
Move-Item -Path "laravel_temp\*" -Destination . -Force
# Move hidden files/folders (.env, .gitignore, etc)
Get-ChildItem -Path "laravel_temp" -Force | Where-Object { $_.Name -like ".*" } | ForEach-Object { Move-Item -Path $_.FullName -Destination . -Force }

Remove-Item -Path "laravel_temp" -Recurse -Force

Write-Host "Setting up views and assets..."
# Move assets to public
if (!(Test-Path "$baseDir\public\assets")) {
    Move-Item -Path "$baseDir\_legacy\assets" -Destination "$baseDir\public\" -Force
}

# Create view directories
$viewsDir = "$baseDir\resources\views"
New-Item -ItemType Directory -Force -Path "$viewsDir\user" | Out-Null
New-Item -ItemType Directory -Force -Path "$viewsDir\admin" | Out-Null
New-Item -ItemType Directory -Force -Path "$viewsDir\front" | Out-Null

# Move HTML to Blade
$allHtml = Get-ChildItem -Path "$baseDir\_legacy" -Filter "*.html" -Recurse
foreach ($file in $allHtml) {
    $parentName = $file.Directory.Name # Will be user, admin, or front
    $newName = $file.Name -replace '\.html$', '.blade.php'
    $newPath = "$viewsDir\$parentName\$newName"
    
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    
    # Transform Links to Laravel syntax
    # 1. Assets
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, '(\.\./)+assets/', "{{ asset('assets/")
    # If the original was href="../assets/...", we replaced it with href="{{ asset('assets/...". 
    # But wait, it leaves the closing quote!
    # Original: href="../assets/path/style.css"
    # Replaced: href="{{ asset('assets/path/style.css" -> Wait, we need to close the parenthesis!
    # A better regex: href="\.\./assets/([^"]+)" -> href="{{ asset('assets/$1') }}"
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'href="\.\./assets/([^"]+)"', "href=`"{{ asset('assets/`$1') }}`"")
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'src="\.\./assets/([^"]+)"', "src=`"{{ asset('assets/`$1') }}`"")
    
    # 2. URLs
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'href="\.\./user/([^"]+)\.html"', "href=`"{{ url('user/`$1') }}`"")
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'href="\.\./admin/([^"]+)\.html"', "href=`"{{ url('admin/`$1') }}`"")
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'href="\.\./front/index\.html"', "href=`"{{ url('/') }}`"")
    
    Set-Content -Path $newPath -Value $content -Encoding UTF8
}

Write-Host "Laravel Initialization and Migration complete!"
