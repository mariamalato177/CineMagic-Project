<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Screening extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['movie_id', 'theater_id', 'date', 'start_time', 'custom'];

    //1(Theater) to N(Screenings)
    public function theaterRef(): BelongsTo
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }

    //1(Screening) to N(Tickets)
    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class, 'screening_id', 'id');
    }

    //1(Movie) to N(Screenings)
    public function movieRef(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }

    public function isSoldOut(Screening $screening): bool
    {
        $theater = $screening->theaterRef;
        $seats = $theater->seats;

        // Check if all seats are unavailable for the given screening
        foreach ($seats as $seat) {
            if ($seat->isAvailable($screening->id)) {
                // If at least one seat is available, return false
                return false;
            }
        }

        // If all seats are unavailable, return true
        return true;
    }
    public function hasPassed(): bool
    {
        $currentDateTime = now();
        $screeningDateTime = $this->date . ' ' . $this->start_time;

        if ($currentDateTime->diffInMinutes($screeningDateTime) <= 5) {
            return true;
        }

        return false;
    }

}
