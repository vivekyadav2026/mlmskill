$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"

Write-Host "Fixing broken fonts (replacing local FontAwesome with CDN)..."
$allFiles = Get-ChildItem -Path $baseDir -Recurse -Filter "*.html"
foreach ($file in $allFiles) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    
    # Replace the local all.min.css with CDN to restore missing webfonts
    $pattern = '<link rel="stylesheet" href="\.\./assets/[^"]*all\.min\.css">'
    $replacement = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">'
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, $pattern, $replacement)
    
    Set-Content -Path $file.FullName -Value $content -Encoding UTF8
}

Write-Host "Creating missing change-password.html..."
$profilePath = "$baseDir\user\profile.html"
$changePassPath = "$baseDir\user\change-password.html"
if (Test-Path $profilePath) {
    Copy-Item -Path $profilePath -Destination $changePassPath -Force
    # Quick string replace to make it somewhat distinct
    $cpContent = Get-Content -Path $changePassPath -Raw -Encoding UTF8
    $cpContent = $cpContent -replace "My Profile", "Change Password"
    Set-Content -Path $changePassPath -Value $cpContent -Encoding UTF8
}

Write-Host "Creating missing logout.html..."
$logoutContent = @"
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="1;url=../front/index.html" />
    <title>Logging Out...</title>
</head>
<body style="background: #0b1220; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: sans-serif;">
    <h2>Logging out...</h2>
</body>
</html>
"@

Set-Content -Path "$baseDir\user\logout.html" -Value $logoutContent -Encoding UTF8
Set-Content -Path "$baseDir\admin\logout.html" -Value $logoutContent -Encoding UTF8

Write-Host "Done fixing fonts and missing links!"
