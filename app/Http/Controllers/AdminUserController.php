<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function create() {
        return view('admin.users.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name'=>'required', 
            'email'=>'required|email|unique:users', 
            'password'=>'required|min:6',
            'sponsor_id'=>'required|exists:users,referral_code'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->role = 'user';
        $user->status = 'inactive';
        $user->sponsor_id = $request->sponsor_id;
        $user->referral_code = 'SD-' . strtoupper(substr(md5(uniqid()), 0, 6));
        $user->save();
        return redirect('admin/users')->with('success', 'User created successfully.');
    }
    public function tree() {
        // Show a virtual root with all top-level users as children
        return view('admin.users.tree');
    }

    public function treeNode($id) {
        if ($id == 0) {
            // Virtual root: all users with no sponsor
            $roots = User::whereNull('sponsor_id')->orWhere('sponsor_id', '')->get();
            $buildTree = function (User $u) use (&$buildTree) {
                $children = User::where('sponsor_id', $u->referral_code)->get();
                return [
                    'id'            => $u->id,
                    'name'          => $u->name,
                    'referral_code' => $u->referral_code,
                    'status'        => $u->status,
                    'children'      => $children->map(fn($c) => $buildTree($c))->values()->toArray(),
                ];
            };
            return response()->json([
                'id'            => 0,
                'name'          => 'All Members',
                'referral_code' => '',
                'status'        => 'active',
                'children'      => $roots->map(fn($u) => $buildTree($u))->values()->toArray(),
            ]);
        }

        $node = User::findOrFail($id);
        $buildTree = function (User $u) use (&$buildTree) {
            $children = User::where('sponsor_id', $u->referral_code)->get();
            return [
                'id'            => $u->id,
                'name'          => $u->name,
                'referral_code' => $u->referral_code,
                'status'        => $u->status,
                'children'      => $children->map(fn($c) => $buildTree($c))->values()->toArray(),
            ];
        };
        return response()->json($buildTree($node));
    }
    public function index() {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }
    public function active() {
        $users = User::where('status', 'active')->latest()->paginate(15);
        return view('admin.users.active', compact('users'));
    }
    public function inactive() {
        $users = User::where('status', 'inactive')->latest()->paginate(15);
        return view('admin.users.inactive', compact('users'));
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/users')->with('success', 'User updated successfully.');
    }

    public function status($id, \App\Services\ActivationService $activationService) {
        $user = User::findOrFail($id);
        
        if ($user->status === 'inactive') {
            try {
                $activationService->activateUser($user);
                return back()->with('success', 'User activated successfully! Commissions and wallets generated.');
            } catch (\Exception $e) {
                return back()->with('error', 'Activation failed: ' . $e->getMessage());
            }
        } else {
            $user->status = 'inactive';
            $user->save();
            return back()->with('success', 'User deactivated successfully.');
        }
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}