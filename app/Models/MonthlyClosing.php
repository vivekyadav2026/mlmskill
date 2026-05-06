<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyClosing extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'total_active_users',
        'total_income_generated',
        'total_withdrawals',
        'total_tokens_issued',
        'report_json',
    ];

    protected function casts(): array
    {
        return [
            'report_json' => 'array',
        ];
    }
}
