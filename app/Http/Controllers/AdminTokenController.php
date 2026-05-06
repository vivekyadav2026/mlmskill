<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TokenLedger;

class AdminTokenController extends Controller
{
    public function settings() { return view('admin.tokens.settings'); }
    public function logs() {
        $logs = TokenLedger::with('user')->latest()->paginate(15);
        return view('admin.tokens.logs', compact('logs'));
    }
    public function manual() { return view('admin.tokens.manual'); }
}