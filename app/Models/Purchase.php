<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'date',
        'total_price',
        'customer_name',
        'customer_email',
        'nif',
        'payment_type',
        'payment_ref',
        'receipt_pdf_filename',
        'custom'
    ];

    //1(Purchase) to N(tickets)
    public function tickets() {
        return $this->hasMany(Ticket::class, 'purchase_id','id');
    }

    //0/1(Customer) to N(Purchases)
    public function customerRef() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
