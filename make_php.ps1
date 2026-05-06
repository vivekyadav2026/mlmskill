$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"

Write-Host "Converting all HTML files to PHP..."
$allFiles = Get-ChildItem -Path $baseDir -Recurse -Filter "*.html"

foreach ($file in $allFiles) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    
    # Change internal links from .html to .php
    $content = $content -replace '\.html"', '.php"'
    $content = $content -replace '\.html\?', '.php?'
    $content = $content -replace '\.html#', '.php#'
    
    # Save the content back to a new .php file
    $newPath = $file.FullName -replace '\.html$', '.php'
    Set-Content -Path $newPath -Value $content -Encoding UTF8
    
    # Delete the old .html file
    Remove-Item -Path $file.FullName -Force
}

Write-Host "All files converted to PHP successfully!"
