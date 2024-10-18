<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['screening_id', 'seat_id', 'purchase_id', 'price', 'qrcode_url', 'status', 'custom'];

    //1(Purchase) to N(Tickets)
    public function purchaseRef(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    //1(Seat) to N(tickets)
    public function seatRef(): BelongsTo
    {
        return $this->belongsTo(Seat::class, 'seat_id', 'id');
    }

    //1(Screening) to N(Tickets)
    public function screeningRef(): BelongsTo
    {
        return $this->belongsTo(Screening::class, 'screening_id', 'id');
    }

}
