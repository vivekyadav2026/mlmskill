<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication & Registration
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::get('/forgot-password', [\App\Http\Controllers\AuthController::class, 'showForgot'])->name('forgot.password');
Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'processForgot'])->name('forgot.password.submit');

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']); // Fallback GET logout

// Demo Routes
Route::get('/login/admin', function () {
    auth()->login(\App\Models\User::where('email', 'admin@example.com')->first());
    return redirect()->route('admin.dashboard');
});
Route::get('/login/user', function () {
    auth()->login(\App\Models\User::where('email', 'user@example.com')->first());
    return redirect()->route('dashboard');
});

// User Dashboard & Flow
Route::middleware(['auth'])->group(function () {
    // Profile Completion
    Route::get('/user/complete-profile', [\App\Http\Controllers\CompleteProfileController::class, 'index'])->name('user.complete.profile');
    Route::post('/user/complete-profile', [\App\Http\Controllers\CompleteProfileController::class, 'store'])->name('user.complete.profile.submit');

    Route::get('/inactive', [\App\Http\Controllers\UserActivationController::class, 'inactive'])->name('inactive');
    Route::post('/inactive/submit', [\App\Http\Controllers\UserActivationController::class, 'submit'])->name('user.activate.submit');
    
    // Package Module - Accessible to inactive users so they can buy package to activate
    Route::get('/user/package/upgrade', [\App\Http\Controllers\PackageController::class, 'upgrade'])->name('package.upgrade');
    Route::get('/user/package/checkout/{id}', [\App\Http\Controllers\PackageController::class, 'checkout'])->name('package.checkout');
    Route::post('/user/package/purchase', [\App\Http\Controllers\PackageController::class, 'purchase'])->name('package.purchase');

    // Support Chat Module - Accessible to inactive users
    Route::get('/user/chat/unread', [\App\Http\Controllers\SupportChatController::class, 'unreadCount']);
    Route::get('/user/chat/messages', [\App\Http\Controllers\SupportChatController::class, 'fetchMessages']);
    Route::post('/user/chat/send', [\App\Http\Controllers\SupportChatController::class, 'sendMessage']);

    Route::middleware(['active'])->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Wallets & Tokens
    Route::get('/wallets', [\App\Http\Controllers\WalletController::class, 'index'])->name('wallets.index');
    Route::post('/wallets/convert', [\App\Http\Controllers\WalletController::class, 'convertTokens'])->name('wallets.convert');
    
    // Withdrawals
    
    // Courses & Certificates
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
    // Network Module
    Route::get('/user/network/direct', [\App\Http\Controllers\NetworkController::class, 'direct'])->name('network.direct');
    Route::get('/user/network/tree', [\App\Http\Controllers\NetworkController::class, 'tree'])->name('network.tree');
    Route::get('/user/network/tree/node/{id}', [\App\Http\Controllers\NetworkController::class, 'treeNode'])->name('network.tree.node');
    Route::get('/user/network/sponsor', [\App\Http\Controllers\NetworkController::class, 'sponsor'])->name('network.sponsor');
    Route::get('/user/network/level', [\App\Http\Controllers\NetworkController::class, 'level'])->name('network.level');

    // Profile Module
    Route::get('/user/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.index');
    Route::post('/user/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/user/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Profile Extra Module
    Route::get('/user/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user/profile/password', [\App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::get('/user/id-card', [\App\Http\Controllers\ProfileController::class, 'idCard'])->name('user.idcard');

    // Wallet Module
    Route::get('/user/wallets/income', [\App\Http\Controllers\WalletController::class, 'income'])->name('wallets.income');
    Route::get('/user/wallets/package', [\App\Http\Controllers\WalletController::class, 'package'])->name('wallets.package');
    Route::get('/user/wallets/utility', [\App\Http\Controllers\WalletController::class, 'utility'])->name('wallets.utility');
    Route::get('/user/wallets/renewal', [\App\Http\Controllers\WalletController::class, 'renewal'])->name('wallets.renewal');
    Route::get('/user/wallets/history', [\App\Http\Controllers\WalletController::class, 'history'])->name('wallets.history');
    Route::get('/user/wallets/transfer', [\App\Http\Controllers\WalletController::class, 'transfer'])->name('wallets.transfer');
    Route::post('/user/wallets/transfer', [\App\Http\Controllers\WalletController::class, 'processTransfer'])->name('wallets.transfer.submit');

    // P2P Extra Module
    Route::get('/user/p2p/history', [\App\Http\Controllers\WalletController::class, 'p2pHistory'])->name('p2p.history');
    Route::get('/user/p2p/mpin', [\App\Http\Controllers\WalletController::class, 'mpinSettings'])->name('p2p.mpin');
    Route::post('/user/p2p/mpin', [\App\Http\Controllers\WalletController::class, 'updateMpin'])->name('p2p.mpin.update');

    // Referral Module
    Route::get('/user/referral/link', [\App\Http\Controllers\ReferralController::class, 'link'])->name('referral.link');
    Route::get('/user/referral/invite', [\App\Http\Controllers\ReferralController::class, 'invite'])->name('referral.invite');
    Route::get('/user/referral/history', [\App\Http\Controllers\ReferralController::class, 'history'])->name('referral.history');

    // Earning Module
    Route::get('/user/earnings/direct', [\App\Http\Controllers\EarningController::class, 'direct'])->name('earnings.direct');
    Route::get('/user/earnings/team', [\App\Http\Controllers\EarningController::class, 'team'])->name('earnings.team');
    Route::get('/user/earnings/total', [\App\Http\Controllers\EarningController::class, 'total'])->name('earnings.total');

    // Course Module
    Route::get('/user/course/my', [\App\Http\Controllers\CourseController::class, 'my'])->name('course.my');
    Route::get('/user/course/progress', [\App\Http\Controllers\CourseController::class, 'progress'])->name('course.progress');
    Route::get('/user/course/complete', [\App\Http\Controllers\CourseController::class, 'completeView'])->name('course.complete.view');
    Route::post('/user/course/complete', [\App\Http\Controllers\CourseController::class, 'markComplete'])->name('course.complete');
    Route::get('/user/course/certificate', [\App\Http\Controllers\CourseController::class, 'certificate'])->name('course.certificate');

    // Token System Module
    Route::get('/user/token/history', [\App\Http\Controllers\TokenSystemController::class, 'history'])->name('token.history');
    Route::get('/user/token/utility', [\App\Http\Controllers\TokenSystemController::class, 'utility'])->name('token.utility');
    Route::get('/user/token/renewal', [\App\Http\Controllers\TokenSystemController::class, 'renewal'])->name('token.renewal');
    Route::get('/user/token/conversion', [\App\Http\Controllers\TokenSystemController::class, 'conversion'])->name('token.conversion');
    Route::post('/user/token/conversion', [\App\Http\Controllers\TokenSystemController::class, 'processConversion'])->name('token.conversion.submit');

    // Package Module (History and Activation)
    Route::get('/user/package/history', [\App\Http\Controllers\PackageController::class, 'history'])->name('package.history');
    Route::get('/user/package/activate-member', [\App\Http\Controllers\PackageController::class, 'activateMember'])->name('package.activate_member');
    Route::post('/user/package/activate-member', [\App\Http\Controllers\PackageController::class, 'processActivateMember'])->name('package.activate_member.submit');
    Route::get('/user/package/lookup-member', [\App\Http\Controllers\PackageController::class, 'lookupMember'])->name('package.lookup_member');

    // Withdraw Module
    Route::get('/user/withdraw/request', [\App\Http\Controllers\WithdrawController::class, 'request'])->name('withdraw.request');
    Route::post('/user/withdraw/submit', [\App\Http\Controllers\WithdrawController::class, 'submit'])->name('withdraw.submit');
    Route::get('/user/withdraw/history', [\App\Http\Controllers\WithdrawController::class, 'history'])->name('withdraw.history');

    // Reports Module
    Route::get('/user/reports/income', [\App\Http\Controllers\ReportController::class, 'income'])->name('reports.income');
    Route::get('/user/reports/token', [\App\Http\Controllers\ReportController::class, 'token'])->name('reports.token');
    Route::get('/user/reports/transaction', [\App\Http\Controllers\ReportController::class, 'transaction'])->name('reports.transaction');

    // Notifications Module
    Route::get('/user/notifications/system', [\App\Http\Controllers\NotificationController::class, 'system'])->name('notifications.system');
    Route::get('/user/notifications/announcements', [\App\Http\Controllers\NotificationController::class, 'announcements'])->name('notifications.announcements');


    // Job Placement Module
    Route::get('/user/jobs', [\App\Http\Controllers\User\UserJobController::class, 'index'])->name('user.jobs.index');
    Route::get('/user/jobs/applications', [\App\Http\Controllers\User\UserJobController::class, 'applications'])->name('user.jobs.applications');
    Route::get('/user/jobs/{id}', [\App\Http\Controllers\User\UserJobController::class, 'show'])->name('user.jobs.show');
    Route::post('/user/jobs/{id}/apply', [\App\Http\Controllers\User\UserJobController::class, 'apply'])->name('user.jobs.apply');

    // Loan Facility Module
    Route::get('/user/loans', [\App\Http\Controllers\User\UserLoanController::class, 'index'])->name('user.loans.index');
    Route::get('/user/loans/history', [\App\Http\Controllers\User\UserLoanController::class, 'history'])->name('user.loans.history');
    Route::post('/user/loans/{id}/apply', [\App\Http\Controllers\User\UserLoanController::class, 'apply'])->name('user.loans.apply');

    // Settings Module (Mapping directly to Profile controller for account management)
    Route::get('/user/settings/account', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('settings.account');
    Route::get('/user/settings/security', [\App\Http\Controllers\ProfileController::class, 'password'])->name('settings.security');

    // Dynamic User Routes for Sidebar
    Route::get('/user/{section}/{subsection?}', [\App\Http\Controllers\DashboardController::class, 'userView']);
    });
});

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Analytics
    Route::get('/analytics', [\App\Http\Controllers\AdminAnalyticsController::class, 'index'])->name('admin.analytics');

    // Notifications
    Route::get('/notifications/mark-all-read', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    });

    // Users
    Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/active', [\App\Http\Controllers\AdminUserController::class, 'active'])->name('admin.users.active');
    Route::get('/users/inactive', [\App\Http\Controllers\AdminUserController::class, 'inactive'])->name('admin.users.inactive');
    Route::get('/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::get('/users/export/excel', [\App\Http\Controllers\AdminUserController::class, 'exportExcel'])->name('admin.users.export.excel');
    Route::get('/users/export/pdf', [\App\Http\Controllers\AdminUserController::class, 'exportPDF'])->name('admin.users.export.pdf');
    Route::post('/users/create', [\App\Http\Controllers\AdminUserController::class, 'store']);
    Route::get('/users/tree', [\App\Http\Controllers\AdminUserController::class, 'tree'])->name('admin.users.tree');
    Route::get('/users/tree/node/{id}', [\App\Http\Controllers\AdminUserController::class, 'treeNode'])->name('admin.users.tree.node');
    Route::get('/users/{id}', [\App\Http\Controllers\AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{id}/update', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/{id}/password', [\App\Http\Controllers\AdminUserController::class, 'changePassword'])->name('admin.users.password');
    Route::post('/users/{id}/status', [\App\Http\Controllers\AdminUserController::class, 'status'])->name('admin.users.status');
    Route::post('/users/{id}/delete', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Withdrawals
    Route::get('/withdrawals/pending', [\App\Http\Controllers\AdminWithdrawalController::class, 'pending'])->name('admin.withdrawals.pending');
    Route::get('/withdrawals/approved', [\App\Http\Controllers\AdminWithdrawalController::class, 'approved'])->name('admin.withdrawals.approved');
    Route::get('/withdrawals/rejected', [\App\Http\Controllers\AdminWithdrawalController::class, 'rejected'])->name('admin.withdrawals.rejected');
    Route::get('/withdrawals/logs', [\App\Http\Controllers\AdminWithdrawalController::class, 'logs'])->name('admin.withdrawals.logs');
    Route::post('/withdrawals/{id}/approve', [\App\Http\Controllers\AdminWithdrawalController::class, 'approve'])->name('admin.withdrawals.approve');
    Route::post('/withdrawals/{id}/reject', [\App\Http\Controllers\AdminWithdrawalController::class, 'reject'])->name('admin.withdrawals.reject');

    // Activations
    Route::get('/activations/requests', [\App\Http\Controllers\AdminActivationController::class, 'requests'])->name('admin.activations.requests');
    Route::post('/activations/requests/{id}/approve', [\App\Http\Controllers\AdminActivationController::class, 'approveRequest'])->name('admin.activations.approve');
    Route::post('/activations/requests/{id}/reject', [\App\Http\Controllers\AdminActivationController::class, 'rejectRequest'])->name('admin.activations.reject');
    Route::get('/activations/history', [\App\Http\Controllers\AdminActivationController::class, 'history'])->name('admin.activations.history');
    Route::get('/activations/manual', [\App\Http\Controllers\AdminActivationController::class, 'manual'])->name('admin.activations.manual');
    Route::post('/activations/manual', [\App\Http\Controllers\AdminActivationController::class, 'activate']);

    // Wallets
    Route::get('/wallets', [\App\Http\Controllers\AdminWalletController::class, 'index'])->name('admin.wallets.index');
    Route::get('/wallets/adjustments', [\App\Http\Controllers\AdminWalletController::class, 'adjustments'])->name('admin.wallets.adjustments');
    Route::post('/wallets/adjustments', [\App\Http\Controllers\AdminWalletController::class, 'adjust']);
    Route::get('/wallets/logs', [\App\Http\Controllers\AdminWalletController::class, 'logs'])->name('admin.wallets.logs');

    // Tokens
    Route::get('/tokens/settings', [\App\Http\Controllers\AdminTokenController::class, 'settings'])->name('admin.tokens.settings');
    Route::get('/tokens/logs', [\App\Http\Controllers\AdminTokenController::class, 'logs'])->name('admin.tokens.logs');
    Route::get('/tokens/manual', [\App\Http\Controllers\AdminTokenController::class, 'manual'])->name('admin.tokens.manual');
    Route::post('/tokens/manual', [\App\Http\Controllers\AdminTokenController::class, 'creditManual'])->name('admin.tokens.manual.submit');

    // Commissions
    Route::get('/commissions/direct', [\App\Http\Controllers\AdminCommissionController::class, 'direct'])->name('admin.commissions.direct');
    Route::get('/commissions/level', [\App\Http\Controllers\AdminCommissionController::class, 'level'])->name('admin.commissions.level');
    // Route::get('/commissions/settings', [\App\Http\Controllers\AdminCommissionController::class, 'settings'])->name('admin.commissions.settings');

    // Courses
    Route::get('/courses', [\App\Http\Controllers\AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [\App\Http\Controllers\AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses/create', [\App\Http\Controllers\AdminCourseController::class, 'store']);
    
    // Modules
    Route::get('/courses/modules', [\App\Http\Controllers\AdminCourseController::class, 'modules'])->name('admin.courses.modules');
    Route::post('/courses/modules', [\App\Http\Controllers\AdminCourseController::class, 'storeModule']);
    Route::post('/courses/modules/{id}/update', [\App\Http\Controllers\AdminCourseController::class, 'updateModule'])->name('admin.courses.modules.update');
    Route::post('/courses/modules/{id}/assign', [\App\Http\Controllers\AdminCourseController::class, 'assignCourses'])->name('admin.courses.modules.assign');
    Route::post('/courses/modules/{id}/delete', [\App\Http\Controllers\AdminCourseController::class, 'destroyModule'])->name('admin.courses.modules.destroy');

    Route::get('/courses/content', [\App\Http\Controllers\AdminCourseController::class, 'content'])->name('admin.courses.content');
    Route::post('/courses/content/store', [\App\Http\Controllers\AdminCourseController::class, 'storeContent'])->name('admin.courses.content.store');
    Route::post('/courses/content/{id}/delete', [\App\Http\Controllers\AdminCourseController::class, 'destroyContent'])->name('admin.courses.content.destroy');
    Route::get('/courses/{id}/edit', [\App\Http\Controllers\AdminCourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('/courses/{id}/update', [\App\Http\Controllers\AdminCourseController::class, 'update'])->name('admin.courses.update');
    Route::post('/courses/{id}/delete', [\App\Http\Controllers\AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::get('/courses/progress', [\App\Http\Controllers\AdminCourseController::class, 'progress'])->name('admin.courses.progress');

    // Certificates
    Route::get('/certificates/generate', [\App\Http\Controllers\AdminCertificateController::class, 'generateForm'])->name('admin.certificates.generate');
    Route::post('/certificates/generate', [\App\Http\Controllers\AdminCertificateController::class, 'generate']);
    Route::get('/certificates/issued', [\App\Http\Controllers\AdminCertificateController::class, 'issued'])->name('admin.certificates.issued');
    Route::get('/certificates/{id}/preview', [\App\Http\Controllers\AdminCertificateController::class, 'preview'])->name('admin.certificates.preview');
    Route::post('/certificates/{id}/delete', [\App\Http\Controllers\AdminCertificateController::class, 'destroy'])->name('admin.certificates.destroy');

    // Reports
    Route::get('/reports/income', [\App\Http\Controllers\AdminReportController::class, 'income'])->name('admin.reports.income');
    Route::get('/reports/income/export/excel', [\App\Http\Controllers\AdminReportController::class, 'exportIncomeExcel'])->name('admin.reports.income.excel');
    Route::get('/reports/income/export/pdf', [\App\Http\Controllers\AdminReportController::class, 'exportIncomePDF'])->name('admin.reports.income.pdf');
    Route::get('/reports/token', [\App\Http\Controllers\AdminReportController::class, 'token'])->name('admin.reports.token');
    Route::get('/reports/user', [\App\Http\Controllers\AdminReportController::class, 'user'])->name('admin.reports.user');
    Route::get('/reports/financial', [\App\Http\Controllers\AdminReportController::class, 'financial'])->name('admin.reports.financial');
    Route::get('/reports/financial/export/excel', [\App\Http\Controllers\AdminReportController::class, 'exportFinancialExcel'])->name('admin.reports.financial.excel');
    Route::get('/reports/financial/export/pdf', [\App\Http\Controllers\AdminReportController::class, 'exportFinancialPDF'])->name('admin.reports.financial.pdf');

    // Monthly Closing
    Route::get('/closing/history', [\App\Http\Controllers\AdminClosingController::class, 'history'])->name('admin.closing.history');
    Route::get('/closing/generate', [\App\Http\Controllers\AdminClosingController::class, 'generate'])->name('admin.closing.generate');
    Route::post('/closing/generate', [\App\Http\Controllers\AdminClosingController::class, 'store']);
    Route::get('/closing/reports', [\App\Http\Controllers\AdminClosingController::class, 'reports'])->name('admin.closing.reports');

    // CMS / Content
    Route::get('/cms/banners', [\App\Http\Controllers\AdminCmsController::class, 'banners'])->name('admin.cms.banners');
    Route::post('/cms/banners', [\App\Http\Controllers\AdminCmsController::class, 'storeBanner']);
    Route::post('/cms/banners/{id}/delete', [\App\Http\Controllers\AdminCmsController::class, 'destroyBanner'])->name('admin.cms.banners.destroy');
    
    Route::get('/cms/announcements', [\App\Http\Controllers\AdminCmsController::class, 'announcements'])->name('admin.cms.announcements');
    Route::post('/cms/announcements', [\App\Http\Controllers\AdminCmsController::class, 'storeAnnouncement']);
    Route::post('/cms/announcements/{id}/delete', [\App\Http\Controllers\AdminCmsController::class, 'destroyAnnouncement'])->name('admin.cms.announcements.destroy');

    Route::get('/cms/pages', [\App\Http\Controllers\AdminCmsController::class, 'pages'])->name('admin.cms.pages');
    Route::post('/cms/pages', [\App\Http\Controllers\AdminCmsController::class, 'storePage']);
    Route::post('/cms/pages/{id}/delete', [\App\Http\Controllers\AdminCmsController::class, 'destroyPage'])->name('admin.cms.pages.destroy');

    // System Settings
    Route::get('/settings/general', [\App\Http\Controllers\AdminSettingController::class, 'general'])->name('admin.settings.general');
    Route::post('/settings/general', [\App\Http\Controllers\AdminSettingController::class, 'saveGeneral']);
    Route::get('/settings/smtp', [\App\Http\Controllers\AdminSettingController::class, 'smtp'])->name('admin.settings.smtp');
    Route::post('/settings/smtp', [\App\Http\Controllers\AdminSettingController::class, 'saveSmtp']);
    Route::post('/settings/test-email', [\App\Http\Controllers\AdminSettingController::class, 'sendTestEmail'])->name('admin.settings.test-email');

    Route::get('/settings/plan', [\App\Http\Controllers\AdminSettingController::class, 'plan'])->name('admin.settings.plan');
    Route::post('/settings/plan', [\App\Http\Controllers\AdminSettingController::class, 'savePlan']);

    Route::get('/settings/token', [\App\Http\Controllers\AdminSettingController::class, 'token'])->name('admin.settings.token');
    Route::post('/settings/token', [\App\Http\Controllers\AdminSettingController::class, 'saveToken']);

    Route::get('/settings/payment', [\App\Http\Controllers\AdminSettingController::class, 'payment'])->name('admin.settings.payment');
    Route::post('/settings/payment', [\App\Http\Controllers\AdminSettingController::class, 'savePayment']);

    Route::post('/settings/theme', [\App\Http\Controllers\AdminSettingController::class, 'saveTheme'])->name('admin.settings.theme');

    // Roles & Permissions
    Route::get('/roles',                        [\App\Http\Controllers\AdminRoleController::class, 'roles'])->name('admin.roles');
    Route::post('/roles',                       [\App\Http\Controllers\AdminRoleController::class, 'storeRole']);
    Route::post('/roles/{id}/delete',           [\App\Http\Controllers\AdminRoleController::class, 'destroyRole'])->name('admin.roles.destroy');
    Route::get('/roles/{id}/permissions',       [\App\Http\Controllers\AdminRoleController::class, 'assignPermissions'])->name('admin.roles.permissions');
    Route::post('/roles/{id}/permissions',      [\App\Http\Controllers\AdminRoleController::class, 'savePermissions']);
    Route::post('/roles/assign-user',           [\App\Http\Controllers\AdminRoleController::class, 'assignRoleToUser'])->name('admin.roles.assign-user');

    Route::get('/permissions',                  [\App\Http\Controllers\AdminRoleController::class, 'permissions'])->name('admin.permissions');
    Route::post('/permissions',                 [\App\Http\Controllers\AdminRoleController::class, 'storePermission']);
    Route::post('/permissions/{id}/delete',     [\App\Http\Controllers\AdminRoleController::class, 'destroyPermission'])->name('admin.permissions.destroy');
    Route::post('/permissions/seed',            [\App\Http\Controllers\AdminRoleController::class, 'seedPermissions'])->name('admin.permissions.seed');
    Route::get('/permissions/assign',           [\App\Http\Controllers\AdminRoleController::class, 'assignPage'])->name('admin.permissions.assign');
    Route::post('/permissions/assign',          [\App\Http\Controllers\AdminRoleController::class, 'saveAssign']);

    // Logs & Monitoring
    Route::get('/logs/system',                  [\App\Http\Controllers\AdminLogController::class, 'systemLogs'])->name('admin.logs.system');
    Route::post('/logs/system/clear',           [\App\Http\Controllers\AdminLogController::class, 'clearSystemLogs'])->name('admin.logs.system.clear');
    Route::get('/logs/activity',                [\App\Http\Controllers\AdminLogController::class, 'activityLogs'])->name('admin.logs.activity');
    Route::get('/logs/error',                   [\App\Http\Controllers\AdminLogController::class, 'errorLogs'])->name('admin.logs.error');

    // Job Management
    Route::get('/jobs', [\App\Http\Controllers\Admin\AdminJobController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/create', [\App\Http\Controllers\Admin\AdminJobController::class, 'create'])->name('admin.jobs.create');
    Route::post('/jobs/store', [\App\Http\Controllers\Admin\AdminJobController::class, 'store'])->name('admin.jobs.store');
    Route::get('/jobs/applications', [\App\Http\Controllers\Admin\AdminJobController::class, 'applications'])->name('admin.jobs.applications');
    Route::post('/jobs/applications/{id}/update', [\App\Http\Controllers\Admin\AdminJobController::class, 'updateApplication'])->name('admin.jobs.applications.update');

    // Loan Management
    Route::get('/loans/schemes', [\App\Http\Controllers\Admin\AdminLoanController::class, 'indexSchemes'])->name('admin.loans.schemes');
    Route::get('/loans/schemes/create', [\App\Http\Controllers\Admin\AdminLoanController::class, 'createScheme'])->name('admin.loans.create_scheme');
    Route::post('/loans/schemes/store', [\App\Http\Controllers\Admin\AdminLoanController::class, 'storeScheme'])->name('admin.loans.store_scheme');
    Route::get('/loans/requests', [\App\Http\Controllers\Admin\AdminLoanController::class, 'requests'])->name('admin.loans.requests');
    Route::post('/loans/requests/{id}/update', [\App\Http\Controllers\Admin\AdminLoanController::class, 'updateRequest'])->name('admin.loans.requests.update');

    // Support Chat
    Route::get('/support/unread', [\App\Http\Controllers\AdminSupportChatController::class, 'unreadCount']);
    Route::get('/support', [\App\Http\Controllers\AdminSupportChatController::class, 'index'])->name('admin.support.index');
    Route::get('/support/{userId}', [\App\Http\Controllers\AdminSupportChatController::class, 'chat'])->name('admin.support.chat');
    Route::delete('/support/{userId}/delete', [\App\Http\Controllers\AdminSupportChatController::class, 'deleteChat']);
    Route::get('/support/{userId}/messages', [\App\Http\Controllers\AdminSupportChatController::class, 'fetchMessages']);
    Route::post('/support/{userId}/send', [\App\Http\Controllers\AdminSupportChatController::class, 'sendMessage']);
});

// Dynamic CMS Pages
Route::get('/page/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');

// Admin Settings Routes (inside admin middleware in web.php)

