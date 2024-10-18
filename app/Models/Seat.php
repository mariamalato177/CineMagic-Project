<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['theater_id', 'row', 'seat_number', 'custom'];

    //1(Theater) to N(Seats)
    public function theaterRef(): BelongsTo
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }

    //1(Seat) to N(tickets)
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'seat_id', 'id');
    }

    public function getSeatNameAttribute()
    {
        return "{$this->row}{$this->seat_number}";
    }

    // public function isAvailable($screeningId): bool
    // {
    //      return $this->tickets()->where('screening_id', $screeningId)->exists();

    // }
    public function isAvailable($screeningId): bool
{
    // A seat is available if there are no tickets associated with this seat for the given screening
    return !$this->tickets()->where('screening_id', $screeningId)->exists();
}






}
