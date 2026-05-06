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
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Activation Flow
    Route::post('/activate', [\App\Http\Controllers\ActivationController::class, 'activate'])->name('user.activate');
    
    // Wallets & Tokens
    Route::get('/wallets', [\App\Http\Controllers\WalletController::class, 'index'])->name('wallets.index');
    Route::post('/wallets/convert', [\App\Http\Controllers\WalletController::class, 'convertTokens'])->name('wallets.convert');
    
    // Withdrawals
    Route::post('/withdraw', [\App\Http\Controllers\WithdrawalController::class, 'requestWithdrawal'])->name('withdraw.request');
    
    // Courses & Certificates
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
    // Network Module
    Route::get('/user/network/direct', [\App\Http\Controllers\NetworkController::class, 'direct'])->name('network.direct');
    Route::get('/user/network/tree', [\App\Http\Controllers\NetworkController::class, 'tree'])->name('network.tree');
    Route::get('/user/network/sponsor', [\App\Http\Controllers\NetworkController::class, 'sponsor'])->name('network.sponsor');
    Route::get('/user/network/level', [\App\Http\Controllers\NetworkController::class, 'level'])->name('network.level');

    // Profile Module
    Route::post('/user/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/user/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Wallet Module
    Route::get('/user/wallets/income', [\App\Http\Controllers\WalletController::class, 'income'])->name('wallets.income');
    Route::get('/user/wallets/package', [\App\Http\Controllers\WalletController::class, 'package'])->name('wallets.package');
    Route::get('/user/wallets/utility', [\App\Http\Controllers\WalletController::class, 'utility'])->name('wallets.utility');
    Route::get('/user/wallets/renewal', [\App\Http\Controllers\WalletController::class, 'renewal'])->name('wallets.renewal');
    Route::get('/user/wallets/history', [\App\Http\Controllers\WalletController::class, 'history'])->name('wallets.history');

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

    // Package Module
    Route::get('/user/package/upgrade', [\App\Http\Controllers\PackageController::class, 'upgrade'])->name('package.upgrade');
    Route::get('/user/package/history', [\App\Http\Controllers\PackageController::class, 'history'])->name('package.history');

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

    // Settings Module (Mapping directly to Profile controller for account management)
    Route::get('/user/settings/account', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('settings.account');
    Route::get('/user/settings/security', [\App\Http\Controllers\ProfileController::class, 'changePassword'])->name('settings.security');

    // Dynamic User Routes for Sidebar
    Route::get('/user/{section}/{subsection?}', [\App\Http\Controllers\DashboardController::class, 'userView']);
});

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Analytics
    Route::get('/analytics', [\App\Http\Controllers\AdminAnalyticsController::class, 'index'])->name('admin.analytics');

    // Users
    Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/active', [\App\Http\Controllers\AdminUserController::class, 'active'])->name('admin.users.active');
    Route::get('/users/inactive', [\App\Http\Controllers\AdminUserController::class, 'inactive'])->name('admin.users.inactive');
    Route::get('/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/create', [\App\Http\Controllers\AdminUserController::class, 'store']);
    Route::get('/users/tree', [\App\Http\Controllers\AdminUserController::class, 'tree'])->name('admin.users.tree');
    
    // Withdrawals
    Route::get('/withdrawals/pending', [\App\Http\Controllers\AdminWithdrawalController::class, 'pending'])->name('admin.withdrawals.pending');
    Route::get('/withdrawals/approved', [\App\Http\Controllers\AdminWithdrawalController::class, 'approved'])->name('admin.withdrawals.approved');
    Route::get('/withdrawals/rejected', [\App\Http\Controllers\AdminWithdrawalController::class, 'rejected'])->name('admin.withdrawals.rejected');
    Route::post('/withdrawals/{id}/approve', [\App\Http\Controllers\AdminWithdrawalController::class, 'approve'])->name('admin.withdrawals.approve');
    Route::post('/withdrawals/{id}/reject', [\App\Http\Controllers\AdminWithdrawalController::class, 'reject'])->name('admin.withdrawals.reject');

    // Activations
    Route::get('/activations/requests', [\App\Http\Controllers\AdminActivationController::class, 'requests'])->name('admin.activations.requests');
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

    // Commissions
    Route::get('/commissions/direct', [\App\Http\Controllers\AdminCommissionController::class, 'direct'])->name('admin.commissions.direct');
    Route::get('/commissions/level', [\App\Http\Controllers\AdminCommissionController::class, 'level'])->name('admin.commissions.level');
    Route::get('/commissions/settings', [\App\Http\Controllers\AdminCommissionController::class, 'settings'])->name('admin.commissions.settings');

    // Courses
    Route::get('/courses', [\App\Http\Controllers\AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [\App\Http\Controllers\AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses/create', [\App\Http\Controllers\AdminCourseController::class, 'store']);
});
