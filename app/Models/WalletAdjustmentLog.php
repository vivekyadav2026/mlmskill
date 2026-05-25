<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletAdjustmentLog extends Model
{
    protected $fillable = [
        'admin_id', 'user_id', 'wallet_type',
        'amount', 'balance_before', 'balance_after', 'note',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getWalletLabelAttribute(): string
    {
        return match($this->wallet_type) {
            'income_wallet'        => 'Income Wallet',
            'package_wallet'       => 'Package Wallet',
            'utility_token_wallet' => 'NEXA 1.0',
            'renewal_token_wallet' => 'NEXA 2.0',
            'nexa_3_wallet'        => 'NEXA 3.0',
            default                => ucfirst($this->wallet_type),
        };
    }
}
