<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivationRequest extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'transaction_id', 'payment_method', 
        'screenshot', 'status', 'remarks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
