$ErrorActionPreference = "Stop"

$baseDir = "c:\xampp\htdocs\mlm"
$pagesDir = "$baseDir\pages"
$assetsDir = "$baseDir\assets"

Write-Host "Creating directories..."
if (!(Test-Path $pagesDir)) { New-Item -ItemType Directory -Force -Path $pagesDir | Out-Null }
if (!(Test-Path $assetsDir)) { New-Item -ItemType Directory -Force -Path $assetsDir | Out-Null }

$htmlFiles = Get-ChildItem -Path $baseDir -Filter "*.html" -File

Write-Host "Found $($htmlFiles.Count) HTML files. Processing..."

foreach ($file in $htmlFiles) {
    $nameWithoutExt = $file.BaseName
    $filesFolder = "$baseDir\${nameWithoutExt}_files"
    
    $content = Get-Content $file.FullName -Raw -Encoding UTF8

    if (Test-Path $filesFolder) {
        Write-Host "Moving assets for $nameWithoutExt..."
        Move-Item -Path $filesFolder -Destination $assetsDir -Force
        
        # Replace paths in HTML
        $findStr1 = "./${nameWithoutExt}_files"
        $replaceStr1 = "../assets/${nameWithoutExt}_files"
        $content = $content.Replace($findStr1, $replaceStr1)
        
        $findStr2 = "`"${nameWithoutExt}_files"
        $replaceStr2 = "`"../assets/${nameWithoutExt}_files"
        $content = $content.Replace($findStr2, $replaceStr2)
        
        $findStr3 = "'${nameWithoutExt}_files"
        $replaceStr3 = "'../assets/${nameWithoutExt}_files"
        $content = $content.Replace($findStr3, $replaceStr3)
    }

    # Save modified HTML to the pages directory directly
    $newFilePath = "$pagesDir\$($file.Name)"
    Set-Content -Path $newFilePath -Value $content -Encoding UTF8
    
    # Remove original HTML file
    Remove-Item -Path $file.FullName -Force
}

Write-Host "Cleanup and organization complete!"
