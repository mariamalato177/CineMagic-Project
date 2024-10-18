<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ticket_price',
        'register_customer_ticket_discount',
        'custom'
    ];
}
