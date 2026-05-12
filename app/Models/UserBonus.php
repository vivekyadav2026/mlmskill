<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBonus extends Model
{
    protected $fillable = [
        'user_id',
        'bonus_type',
        'milestone',
        'amount',
        'month_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
