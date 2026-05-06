$ErrorActionPreference = "Stop"
$baseDir = "c:\xampp\htdocs\mlm"

$adminMap = @{
    "Admin Dashboard" = "index.html"
    "Capping Settings" = "settings-capping.html"
    "Cron Manager" = "cron-manager.html"
    "Deposit Requests" = "deposit-requests.html"
    "Deposit Wallets" = "deposit-wallets.html"
    "Deposits" = "deposits.html"
    "Direct Income Settings" = "settings-direct.html"
    "Engine Controls" = "settings-engines.html"
    "Income Overview" = "settings-overview.html"
    "Investments" = "investments.html"
    "KYC Approvals" = "kyc-approvals.html"
    "Level Income Settings" = "settings-level.html"
    "Network Tree" = "network-tree.html"
    "Package Plans" = "plans.html"
    "Package Settings" = "settings-packages.html"
    "Payout Wallet Directory" = "payout-directory.html"
    "Rank Management" = "settings-ranks.html"
    "Rank Rewards Settings" = "settings-rewards.html"
    "Reports" = "reports.html"
    "ROI Settings" = "settings-roi.html"
    "Site Settings" = "site-settings.html"
    "Transactions" = "transactions.html"
    "User Management" = "users.html"
    "Weekly Salary Settings" = "settings-salary.html"
    "Withdrawal Settings" = "settings-withdrawal.html"
    "Withdrawals" = "withdrawals.html"
}

$userMap = @{
    "My Dashboard" = "index.html"
    "Deposit " = "deposit.html"
    "Direct Team" = "referrals.html"
    "Invest " = "invest.html"
    "KYC Management" = "kyc.html"
    "My Incomes" = "incomes.html"
    "My Network" = "tree.html"
    "My Payout Wallet" = "payout-wallet.html"
    "My Profile" = "profile.html"
    "Portfolio" = "portfolio.html"
    "Profile Image" = "profile-image.html"
    "Transactions" = "transactions.html"
    "Withdraw " = "withdraw.html"
}

# 1. First, replace links in all html files across all directories
Write-Host "Updating links..."
$allFiles = Get-ChildItem -Path $baseDir -Recurse -Filter "*.html"
foreach ($file in $allFiles) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    
    # Update php links to html links with relative paths
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'https://xvoltytrade.bgtl.in/user/([a-zA-Z0-9_-]+)\.php', '../user/$1.html')
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, 'https://xvoltytrade.bgtl.in/admin/([a-zA-Z0-9_-]+)\.php', '../admin/$1.html')
    
    $content = $content -replace 'https://xvoltytrade.bgtl.in/index.php', '../front/index.html'
    $content = $content -replace 'https://xvoltytrade.bgtl.in/"', '../front/index.html"'
    $content = $content -replace 'https://xvoltytrade.bgtl.in"', '../front/index.html"'
    
    # Some links might be without absolute path (e.g. href="index.php")
    # Actually most of them in the raw scraped file are absolute, but just in case:
    # (We will just rely on the absolute URLs we saw)

    Set-Content -Path $file.FullName -Value $content -Encoding UTF8
}

# 2. Rename Admin files
Write-Host "Renaming Admin files..."
$adminFiles = Get-ChildItem -Path "$baseDir\admin" -Filter "*.html"
foreach ($file in $adminFiles) {
    foreach ($key in $adminMap.Keys) {
        if ($file.Name.StartsWith($key)) {
            $newName = $adminMap[$key]
            Rename-Item -Path $file.FullName -NewName $newName -Force
            break
        }
    }
}

# 3. Rename User files
Write-Host "Renaming User files..."
$userFiles = Get-ChildItem -Path "$baseDir\user" -Filter "*.html"
foreach ($file in $userFiles) {
    foreach ($key in $userMap.Keys) {
        if ($file.Name.StartsWith($key)) {
            $newName = $userMap[$key]
            Rename-Item -Path $file.FullName -NewName $newName -Force
            break
        }
    }
}

# 4. Rename Front files
Write-Host "Renaming Front files..."
$frontFiles = Get-ChildItem -Path "$baseDir\front" -Filter "*.html"
foreach ($file in $frontFiles) {
    if ($file.Name.StartsWith("XVolty Trade")) {
        Rename-Item -Path $file.FullName -NewName "index.html" -Force
    }
}

Write-Host "Done renaming and updating links!"
