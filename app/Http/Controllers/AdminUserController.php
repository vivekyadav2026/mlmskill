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
        $request->validate(['name'=>'required', 'email'=>'required|email|unique:users', 'password'=>'required|min:6']);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->role = 'user';
        $user->status = 'inactive';
        $user->referral_code = strtoupper(substr(md5(uniqid()), 0, 8));
        $user->save();
        return redirect('admin/users')->with('success', 'User created successfully.');
    }
    public function tree() {
        $users = User::with('referrals')->whereNull('sponsor_id')->get();
        return view('admin.users.tree', compact('users'));
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
}