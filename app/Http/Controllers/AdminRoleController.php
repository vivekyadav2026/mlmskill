<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class AdminRoleController extends Controller
{
    // ── ROLES ─────────────────────────────────────────────
    public function roles()
    {
        $roles = Role::withCount('users')->with('permissions')->latest()->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|alpha_dash|max:50|unique:roles,name',
            'display_name' => 'required|string|max:100',
            'description'  => 'nullable|string|max:255',
            'color'        => 'required|string|max:20',
        ]);
        Role::create($request->only(['name', 'display_name', 'description', 'color']));
        return back()->with('success', 'Role created successfully.');
    }

    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        if ($role->users_count > 0 || User::where('role', $role->name)->exists()) {
            return back()->with('error', 'Cannot delete role: users are assigned to it.');
        }
        $role->delete();
        return back()->with('success', 'Role deleted.');
    }

    // ── PERMISSIONS ────────────────────────────────────────
    public function permissions()
    {
        $permissions = Permission::with('roles')->orderBy('group')->orderBy('display_name')->get()
            ->groupBy('group');
        $roles = Role::all();
        return view('admin.permissions.index', compact('permissions', 'roles'));
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|alpha_dash|max:80|unique:permissions,name',
            'display_name' => 'required|string|max:100',
            'group'        => 'required|string|max:50',
        ]);
        Permission::create($request->only(['name', 'display_name', 'group']));
        return back()->with('success', 'Permission created.');
    }

    public function destroyPermission($id)
    {
        Permission::findOrFail($id)->delete();
        return back()->with('success', 'Permission deleted.');
    }

    // ── ASSIGN PERMISSIONS TO A ROLE ──────────────────────
    public function assignPermissions($roleId)
    {
        $role        = Role::with('permissions')->findOrFail($roleId);
        $permissions = Permission::orderBy('group')->orderBy('display_name')->get()->groupBy('group');
        return view('admin.permissions.assign', compact('role', 'permissions'));
    }

    public function savePermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->sync($request->input('permissions', []));
        return back()->with('success', 'Permissions updated for role: ' . $role->display_name);
    }

    // ── ASSIGN / REMOVE ROLE FROM USER ────────────────────
    public function assignRoleToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => 'nullable|string',
        ]);
        
        $role = $request->role ?: 'user'; // Default non-admin role is 'user'
        
        User::findOrFail($request->user_id)->update(['role' => $role]);
        
        if ($role === 'user') {
            return back()->with('success', 'Role removed from user successfully.');
        }
        return back()->with('success', 'Role assigned to user successfully.');
    }

    public function seedPermissions()
    {
        $defaults = [
            // Users
            ['name'=>'view_users',        'display_name'=>'View Users',           'group'=>'users'],
            ['name'=>'manage_users',      'display_name'=>'Manage Users',         'group'=>'users'],
            ['name'=>'activate_users',    'display_name'=>'Activate/Block Users', 'group'=>'users'],
            // Finance
            ['name'=>'view_withdrawals',  'display_name'=>'View Withdrawals',     'group'=>'finance'],
            ['name'=>'approve_withdrawals','display_name'=>'Approve Withdrawals', 'group'=>'finance'],
            ['name'=>'view_commissions',  'display_name'=>'View Commissions',     'group'=>'finance'],
            ['name'=>'view_wallets',      'display_name'=>'View Wallets',         'group'=>'finance'],
            // Tokens
            ['name'=>'view_tokens',       'display_name'=>'View Tokens',          'group'=>'tokens'],
            ['name'=>'manage_tokens',     'display_name'=>'Manage Tokens',        'group'=>'tokens'],
            // Courses
            ['name'=>'view_courses',      'display_name'=>'View Courses',         'group'=>'courses'],
            ['name'=>'manage_courses',    'display_name'=>'Manage Courses',       'group'=>'courses'],
            // Reports
            ['name'=>'view_reports',      'display_name'=>'View Reports',         'group'=>'reports'],
            ['name'=>'view_analytics',    'display_name'=>'View Analytics',       'group'=>'reports'],
            ['name'=>'view_closing',      'display_name'=>'Monthly Closing',      'group'=>'reports'],
            // Settings
            ['name'=>'manage_settings',   'display_name'=>'Manage Settings',      'group'=>'settings'],
            ['name'=>'manage_roles',      'display_name'=>'Manage Roles',         'group'=>'settings'],
            ['name'=>'manage_theme',      'display_name'=>'Manage Theme',         'group'=>'settings'],
            // CMS
            ['name'=>'manage_banners',    'display_name'=>'Manage Banners',       'group'=>'cms'],
            ['name'=>'manage_pages',      'display_name'=>'Manage Pages',         'group'=>'cms'],
            ['name'=>'manage_announcements','display_name'=>'Manage Announcements','group'=>'cms'],
        ];
        $created = 0;
        foreach ($defaults as $p) {
            Permission::firstOrCreate(['name' => $p['name']], $p);
            $created++;
        }
        return back()->with('success', "Seeded {$created} default permissions successfully.");
    }

    // ── Standalone Assign Page ──────────────────────────────────
    public function assignPage(Request $request)
    {
        $roles       = Role::with('permissions')->get();
        $permissions = Permission::orderBy('group')->orderBy('display_name')->get()->groupBy('group');
        $selectedRole = $request->role_id ? Role::with('permissions')->find($request->role_id) : $roles->first();
        return view('admin.permissions.assign-page', compact('roles', 'permissions', 'selectedRole'));
    }

    public function saveAssign(Request $request)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);
        $role = Role::findOrFail($request->role_id);
        $role->permissions()->sync($request->input('permissions', []));
        return redirect(url('admin/permissions/assign?role_id=' . $role->id))
            ->with('success', 'Permissions updated for role: ' . $role->display_name);
    }
}
