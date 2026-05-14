<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'mpin',
        'profile_image',
        'gender',
        'address',
        'city',
        'state',
        'zip',
        'sponsor_id',
        'referral_code',
        'status',
        'is_profile_complete',
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
            'last_seen_at' => 'datetime',
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

    public function allReferrals()
    {
        return $this->referrals()->with('allReferrals');
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

    public function supportChats()
    {
        return $this->hasMany(SupportChat::class);
    }

    // ── Role & Permission Helpers ───────────────────────────

    /** Get the Role model for this user */
    public function roleModel()
    {
        return Role::with('permissions')->where('name', $this->role)->first();
    }

    /** Check if user has a specific role slug */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /** Check if user is a super-admin (bypasses all permission checks) */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin' || $this->role === 'admin';
    }

    /** Check if user has a specific permission */
    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) return true;  // super admin can do everything
        $rm = $this->roleModel();
        if (!$rm) return false;
        return $rm->permissions->contains('name', $permission);
    }

    /** Get all permission slugs for this user's role (cached per request) */
    public function getPermissions(): array
    {
        static $cache = [];
        $key = $this->id . '_' . $this->role;
        if (!isset($cache[$key])) {
            if ($this->isSuperAdmin()) {
                $cache[$key] = ['*'];   // wildcard
            } else {
                $rm = $this->roleModel();
                $cache[$key] = $rm ? $rm->permissions->pluck('name')->toArray() : [];
            }
        }
        return $cache[$key];
    }
}
