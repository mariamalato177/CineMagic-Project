<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'nif', 'payment_type','payment_ref','custom'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id','id');
    }

    // 0/1(Customer) to N(Purchases)
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'customer_id', 'id');
    }
}
