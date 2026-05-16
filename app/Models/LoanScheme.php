<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanScheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'min_amount', 'max_amount', 'interest_rate', 
        'max_tenure_months', 'description', 'required_rank', 'status'
    ];

    public function requests()
    {
        return $this->hasMany(LoanRequest::class);
    }
}
