<?php

$baseDir = __DIR__ . '/resources/views/';

$userPages = [
    'profile/index', 'profile/edit', 'profile/password',
    'wallets/income', 'wallets/package', 'wallets/utility', 'wallets/renewal', 'wallets/history',
    'referral/link', 'referral/invite', 'referral/history',
    'earnings/direct', 'earnings/team', 'earnings/total',
    'course/my', 'course/progress', 'course/complete', 'course/certificate',
    'token/history', 'token/utility', 'token/renewal', 'token/conversion',
    'package/upgrade', 'package/history',
    'withdraw/request', 'withdraw/history',
    'reports/income', 'reports/token', 'reports/transaction',
    'notifications/system', 'notifications/announcements',
    'settings/account', 'settings/security'
];

$adminPages = [
    'analytics',
    'users/active', 'users/inactive', 'users/create', 'users/tree',
    'activations/requests', 'activations/history', 'activations/manual',
    'wallets/index', 'wallets/adjustments', 'wallets/logs',
    'tokens/settings', 'tokens/logs', 'tokens/manual',
    'commissions/direct', 'commissions/level', 'commissions/settings',
    'courses/index', 'courses/create', 'courses/content', 'courses/progress',
    'certificates/generate', 'certificates/issued',
    'withdrawals/pending', 'withdrawals/approved', 'withdrawals/rejected', 'withdrawals/logs',
    'reports/income', 'reports/token', 'reports/user', 'reports/financial',
    'closing/generate', 'closing/history', 'closing/reports',
    'cms/banners', 'cms/announcements', 'cms/pages',
    'settings/general', 'settings/plan', 'settings/token', 'settings/payment',
    'roles/index', 'permissions/index', 'permissions/assign',
    'logs/system', 'logs/activity', 'logs/error'
];

function createView($layout, $type, $path) {
    global $baseDir;
    $fullPath = $baseDir . $type . '/' . $path . '.blade.php';
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    if (!file_exists($fullPath)) {
        $name = ucwords(str_replace(['/', '_', '-'], ' ', $path));
        $content = "@extends('layouts.{$layout}')\n\n";
        $content .= "@section('content')\n";
        $content .= "<script src=\"https://cdn.tailwindcss.com\"></script>\n";
        $content .= "<style>.app-main { padding: 20px; }</style>\n";
        $content .= "<div class=\"tailwind-scope mt-4\">\n";
        $content .= "    <div class=\"bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] p-6\">\n";
        $content .= "        <div class=\"mb-6\">\n";
        $content .= "            <h2 class=\"text-2xl font-bold text-gray-100\">{$name}</h2>\n";
        $content .= "            <p class=\"text-gray-400\">Manage and view your {$name} details.</p>\n";
        $content .= "        </div>\n";
        $content .= "        <div class=\"border-t border-[#334155] pt-6\">\n";
        $content .= "            <div class=\"p-10 text-center text-gray-500 bg-[#0b1220] rounded-lg border border-dashed border-[#334155]\">\n";
        $content .= "                <i class=\"fa-solid fa-gears text-4xl mb-3 text-indigo-500\"></i>\n";
        $content .= "                <h3 class=\"text-xl font-bold text-gray-300\">Module Active</h3>\n";
        $content .= "                <p class=\"mt-2\">The {$name} functionality is currently linked and ready for data binding.</p>\n";
        $content .= "            </div>\n";
        $content .= "        </div>\n";
        $content .= "    </div>\n";
        $content .= "</div>\n";
        $content .= "@endsection\n";
        
        file_put_contents($fullPath, $content);
    }
}

foreach ($userPages as $page) {
    createView('user', 'user', $page);
}

foreach ($adminPages as $page) {
    createView('admin', 'admin', $page);
}

echo "All views scaffolded successfully.\n";
