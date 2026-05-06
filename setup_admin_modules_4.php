<?php

$viewsDir = __DIR__ . '/resources/views/admin/';

function ensureDir($path) {
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
}

$modulesToBuild = [
    // Courses
    'courses/content' => ['icon' => 'fa-video', 'title' => 'Course Content Editor', 'desc' => 'Upload and manage course videos and PDFs.'],
    'courses/progress' => ['icon' => 'fa-bars-progress', 'title' => 'User Course Progress', 'desc' => 'Track completion rates across the network.'],
    
    // Withdrawals (Logs)
    'withdrawals/logs' => ['icon' => 'fa-file-invoice-dollar', 'title' => 'Withdrawal Payment Logs', 'desc' => 'Detailed audit trail of all manual and automated payouts.'],

    // Certificates
    'certificates/generate' => ['icon' => 'fa-certificate', 'title' => 'Generate Certificates', 'desc' => 'Manually generate custom certificates.'],
    'certificates/issued' => ['icon' => 'fa-award', 'title' => 'Issued Certificates', 'desc' => 'Ledger of all digitally signed and issued certificates.'],

    // Reports
    'reports/income' => ['icon' => 'fa-chart-line', 'title' => 'Income Analytics', 'desc' => 'Macro analytics on platform revenue generation.'],
    'reports/token' => ['icon' => 'fa-chart-pie', 'title' => 'Token Velocity', 'desc' => 'Macro analytics on utility token conversion rates.'],
    'reports/user' => ['icon' => 'fa-users', 'title' => 'User Acquisition', 'desc' => 'Data on new registrations and demographic spread.'],
    'reports/financial' => ['icon' => 'fa-file-invoice', 'title' => 'Financial Statements', 'desc' => 'Exportable PDF/CSV financial compliance reports.'],

    // Monthly Closing
    'closing/generate' => ['icon' => 'fa-calendar-check', 'title' => 'Run Monthly Closing', 'desc' => 'Execute cron jobs for monthly reward distributions.'],
    'closing/history' => ['icon' => 'fa-clock-rotate-left', 'title' => 'Closing History', 'desc' => 'Records of past monthly settlement batches.'],
    'closing/reports' => ['icon' => 'fa-file-signature', 'title' => 'Settlement Reports', 'desc' => 'Audited reports of monthly payouts.'],

    // CMS
    'cms/banners' => ['icon' => 'fa-images', 'title' => 'Banner Management', 'desc' => 'Update homepage and dashboard carousel images.'],
    'cms/announcements' => ['icon' => 'fa-bullhorn', 'title' => 'Global Announcements', 'desc' => 'Push notifications to all user dashboards.'],
    'cms/pages' => ['icon' => 'fa-file-lines', 'title' => 'Page Builder', 'desc' => 'Edit Terms of Service, Privacy Policy, and FAQs.'],

    // Settings
    'settings/general' => ['icon' => 'fa-sliders', 'title' => 'General Settings', 'desc' => 'Global platform configuration variables.'],
    'settings/plan' => ['icon' => 'fa-sitemap', 'title' => 'MLM Plan Settings', 'desc' => 'Network levels, matrix depth, and commission rates.'],
    'settings/payment' => ['icon' => 'fa-credit-card', 'title' => 'Payment Gateway', 'desc' => 'API Keys for crypto and fiat gateways.'],
    
    // Roles & Permissions
    'roles/index' => ['icon' => 'fa-user-tie', 'title' => 'Role Management', 'desc' => 'Create admin roles (Super Admin, Support, Financial).'],
    'permissions/index' => ['icon' => 'fa-key', 'title' => 'Permission Matrix', 'desc' => 'Define granular access rules for admin endpoints.'],
    'permissions/assign' => ['icon' => 'fa-user-shield', 'title' => 'Assign Permissions', 'desc' => 'Bind security roles to specific admin staff.'],

    // Logs
    'logs/system' => ['icon' => 'fa-server', 'title' => 'System Logs', 'desc' => 'Raw server access and cron execution logs.'],
    'logs/activity' => ['icon' => 'fa-desktop', 'title' => 'Admin Activity Logs', 'desc' => 'Audit trail of all administrative actions.'],
    'logs/error' => ['icon' => 'fa-bug', 'title' => 'Error Logs', 'desc' => 'Live exception tracing and application warnings.'],
];

foreach ($modulesToBuild as $path => $data) {
    $fullPath = $viewsDir . $path . '.blade.php';
    ensureDir($fullPath);
    
    $title = $data['title'];
    $desc = $data['desc'];
    $icon = $data['icon'];

    $html = <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">{\$title}</h2></div>
    
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-10 text-center shadow-lg">
        <div class="w-20 h-20 mx-auto bg-indigo-900/30 border border-indigo-500/50 rounded-full flex items-center justify-center mb-6">
            <i class="fa-solid {\$icon} text-4xl text-indigo-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-200 mb-2">Module Initialized</h3>
        <p class="text-gray-400 mb-8 max-w-md mx-auto">{\$desc}</p>
        
        <div class="bg-[#0b1220] border border-[#334155] rounded p-4 text-left font-mono text-sm text-green-400 shadow-inner">
            <p>> Loading dependencies for {\$title}...</p>
            <p>> Connecting to database cluster...</p>
            <p>> Access granted. Interface ready for data binding.</p>
        </div>
    </div>
</div>
@endsection
HTML;
    
    file_put_contents($fullPath, $html);
}

echo "All remaining placeholder modules generated.";
