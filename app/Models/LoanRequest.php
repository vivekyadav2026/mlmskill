<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'loan_scheme_id', 'amount', 'tenure_months', 
        'monthly_emi', 'status', 'admin_remarks', 'approved_at', 'disbursed_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'disbursed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scheme()
    {
        return $this->belongsTo(LoanScheme::class, 'loan_scheme_id');
    }
}
