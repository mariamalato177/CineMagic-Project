<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theater extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'photo_filename', 'custom'];

    //1(Theater) to N(Seats)
    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class, 'theater_id', 'id');
    }

    //1(Theater) to N(Screenings)
    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class, 'theater_id', 'id');
    }

    public function getImageExistsAttribute()
    {
        if ($this->photo_filename === null) {
            return false;
        }else{
            return true;
        }
    }

    public function getImageUrlAttribute()
    {
        return asset("storage/images/{$this->photo_filename}");
    }
}
