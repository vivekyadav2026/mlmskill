$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"
$viewsDir = "$baseDir\resources\views"
$layoutsDir = "$viewsDir\layouts"

if (!(Test-Path $layoutsDir)) { New-Item -ItemType Directory -Force -Path $layoutsDir | Out-Null }

function Process-Panel {
    param (
        [string]$panelName
    )
    
    Write-Host "Processing $panelName panel..."
    $panelDir = "$viewsDir\$panelName"
    $indexFile = "$panelDir\index.blade.php"
    
    if (!(Test-Path $indexFile)) {
        Write-Host "Warning: $indexFile not found!"
        return
    }
    
    $indexContent = Get-Content -Path $indexFile -Raw -Encoding UTF8
    
    # Define regex to split
    # (?s) makes . match newline
    $pattern = '(?s)^(.*?)<main class="app-content">(.*?)</main>(.*?)$'
    
    if ($indexContent -match $pattern) {
        $topPart = $Matches[1]
        $bottomPart = $Matches[3]
        
        # Clean up the top part (remove active classes from nav-links so it doesn't stay highlighted everywhere)
        $topPart = $topPart -replace 'class="nav-link active"', 'class="nav-link"'
        
        # Create Layout
        $layoutContent = $topPart + "<main class=`"app-content`">`n  @yield('content')`n</main>" + $bottomPart
        Set-Content -Path "$layoutsDir\$panelName.blade.php" -Value $layoutContent -Encoding UTF8
        
        # Now loop through all files in this panel
        $files = Get-ChildItem -Path $panelDir -Filter "*.blade.php"
        foreach ($file in $files) {
            $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
            if ($content -match $pattern) {
                $mainContent = $Matches[2].Trim()
                
                # Try to extract the title from the original file if possible
                $title = "Dashboard"
                if ($content -match '<title>(.*?)</title>') {
                    $title = $Matches[1]
                }
                
                $newContent = "@extends('layouts.$panelName')`n@section('title', '$title')`n`n@section('content')`n$mainContent`n@endsection"
                Set-Content -Path $file.FullName -Value $newContent -Encoding UTF8
            } else {
                Write-Host "Warning: Could not match <main> in $($file.Name)"
            }
        }
    } else {
        Write-Host "Error: Could not parse layout from $indexFile"
    }
}

Process-Panel -panelName "user"
Process-Panel -panelName "admin"

Write-Host "Blade layouts extracted and applied successfully!"
