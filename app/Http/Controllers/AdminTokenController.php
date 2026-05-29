<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TokenLedger;
use App\Models\User;
use App\Models\Setting;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminTokenController extends Controller
{
    public function settings()
    {
        $settings = Setting::whereIn('key', [
            'utility_token_name', 'utility_token_value',
            'renewal_token_name', 'renewal_token_value',
            // 'token_expiry_days', 'min_token_redeem',
            // 'token_auto_credit', 'token_transferable',
        ])->pluck('value', 'key')->toArray();

        return view('admin.tokens.settings', compact('settings'));
    }

    public function logs()
    {
        $logs = TokenLedger::with('user')->latest()->paginate(20);
        return view('admin.tokens.logs', compact('logs'));
    }

    public function manual()
    {
        $users = User::where('status', 'active')->orderBy('name')->get();
        return view('admin.tokens.manual', compact('users'));
    }

    public function creditManual(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'token_type' => 'required|in:utility,renewal,nexa_3',
            'amount'     => 'required|numeric|min:0.0001',
            'note'       => 'nullable|string|max:255',
        ]);

        // Get token value from settings
        $valueKey = 'utility_token_value';
        if ($request->token_type === 'renewal') {
            $valueKey = 'renewal_token_value';
        } elseif ($request->token_type === 'nexa_3') {
            $valueKey = 'nexa_3_token_value';
        }
        $tokenValue = (float) (Setting::get($valueKey, 1));

        DB::transaction(function () use ($request, $tokenValue) {
            // Create the ledger entry
            TokenLedger::create([
                'user_id'      => $request->user_id,
                'token_type'   => $request->token_type,
                'token_count'  => $request->amount,
                'token_value'  => $tokenValue,
                'source'       => 'manual:admin#' . Auth::id() . ($request->note ? ' – ' . $request->note : ''),
                'status'       => 'credited',
                'credited_date'=> Carbon::now(),
            ]);

            // Update the user's wallet balance
            $wallet = Wallet::firstOrCreate(['user_id' => $request->user_id]);
            $walletField = 'utility_token_wallet';
            if ($request->token_type === 'renewal') {
                $walletField = 'renewal_token_wallet';
            } elseif ($request->token_type === 'nexa_3') {
                $walletField = 'nexa_3_wallet';
            }
            $wallet->increment($walletField, $request->amount);
        });

        $user = User::find($request->user_id);
        $typeLabel = $request->token_type === 'nexa_3' ? 'NEXA 3.0' : ucfirst($request->token_type);

        return redirect()->route('admin.tokens.manual')
            ->with('success', "{$request->amount} {$typeLabel} tokens credited to {$user->name} successfully.");
    }
}