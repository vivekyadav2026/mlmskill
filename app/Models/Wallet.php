<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'income_wallet',
        'package_wallet',
        'utility_token_wallet',
        'renewal_token_wallet',
        'nexa_3_wallet',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

