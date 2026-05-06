<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CommissionLedger;

class AdminCommissionController extends Controller
{
    public function direct() {
        $logs = CommissionLedger::with('user')->where('commission_type', 'direct')->latest()->paginate(15);
        return view('admin.commissions.direct', compact('logs'));
    }
    public function level() {
        $logs = CommissionLedger::with('user')->where('commission_type', 'level')->latest()->paginate(15);
        return view('admin.commissions.level', compact('logs'));
    }
    public function settings() { return view('admin.commissions.settings'); }
}