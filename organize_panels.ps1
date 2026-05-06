$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"
$pagesDir = "$baseDir\pages"

$adminDir = "$baseDir\admin"
$userDir = "$baseDir\user"
$frontDir = "$baseDir\front"

# Create directories
if (!(Test-Path $adminDir)) { New-Item -ItemType Directory -Force -Path $adminDir | Out-Null }
if (!(Test-Path $userDir)) { New-Item -ItemType Directory -Force -Path $userDir | Out-Null }
if (!(Test-Path $frontDir)) { New-Item -ItemType Directory -Force -Path $frontDir | Out-Null }

$htmlFiles = Get-ChildItem -Path $pagesDir -Filter "*.html"

foreach ($file in $htmlFiles) {
    $name = $file.Name
    
    # Check if Admin file
    if ($name -match "Admin|Settings|Engine|Rank|Package|Capping") {
        Move-Item -Path $file.FullName -Destination "$adminDir\$name" -Force
    }
    elseif ($name -match "XVolty Trade.*Secure Crypto") {
        Move-Item -Path $file.FullName -Destination "$frontDir\$name" -Force
    }
    else {
        # Must be user panel
        Move-Item -Path $file.FullName -Destination "$userDir\$name" -Force
    }
}

# Delete the empty pages directory if it is indeed empty
if (Test-Path $pagesDir) {
    if ((Get-ChildItem -Path $pagesDir | Measure-Object).Count -eq 0) {
        Remove-Item -Path $pagesDir -Force
    }
}
