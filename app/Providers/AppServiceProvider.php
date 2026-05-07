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
