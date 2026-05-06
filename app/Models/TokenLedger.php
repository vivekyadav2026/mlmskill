<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token_type',
        'token_count',
        'token_value',
        'source',
        'status',
        'credited_date',
        'used_date',
    ];

    protected function casts(): array
    {
        return [
            'credited_date' => 'datetime',
            'used_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
