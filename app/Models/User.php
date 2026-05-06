<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'sponsor_id',
        'referral_code',
        'status',
        'activation_date',
        'course_completed_at',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'activation_date' => 'datetime',
            'course_completed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_id', 'referral_code');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'sponsor_id', 'referral_code');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function token_ledgers()
    {
        return $this->hasMany(TokenLedger::class);
    }

    public function commissions()
    {
        return $this->hasMany(CommissionLedger::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
