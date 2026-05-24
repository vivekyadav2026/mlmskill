<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Register every permission from the DB as a Gate
        // so @can('manage_users'), Gate::allows('view_reports'), etc. all work
        try {
            Permission::all()->each(function ($perm) {
                Gate::define($perm->name, function ($user) use ($perm) {
                    return $user->hasPermission($perm->name);
                });
            });
        } catch (\Exception $e) {
            // Silently fail during migrations / fresh install
        }

        // Dynamic SMTP Config Override from Database Settings
        try {
            if (\App\Models\Setting::get('smtp_enabled') == '1') {
                $password = \App\Models\Setting::get('smtp_password');
                if ($password) {
                    try {
                        $password = decrypt($password);
                    } catch (\Exception $e) {
                        // ignore or handle if decrypt fails
                    }
                }
                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.host' => \App\Models\Setting::get('smtp_host', '127.0.0.1'),
                    'mail.mailers.smtp.port' => (int) \App\Models\Setting::get('smtp_port', 587),
                    'mail.mailers.smtp.encryption' => \App\Models\Setting::get('smtp_encryption', 'tls') === 'none' ? null : \App\Models\Setting::get('smtp_encryption', 'tls'),
                    'mail.mailers.smtp.username' => \App\Models\Setting::get('smtp_username'),
                    'mail.mailers.smtp.password' => $password,
                    'mail.from.address' => \App\Models\Setting::get('smtp_from_email', 'no-reply@example.com'),
                    'mail.from.name' => \App\Models\Setting::get('smtp_from_name', config('app.name')),
                ]);
            }
        } catch (\Exception $e) {
            // Silently fail during database fresh installs or migrations
        }

        // Convenience Blade directives
        // @role('admin')  ...  @endrole
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });

        // @hasPermission('manage_users')  ...  @endhasPermission
        Blade::directive('hasPermission', function ($perm) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$perm})): ?>";
        });
        Blade::directive('endhasPermission', function () {
            return "<?php endif; ?>";
        });
    }
}
