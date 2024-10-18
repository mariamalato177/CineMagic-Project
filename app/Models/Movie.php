<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'genre_code',
        'year',
        'poster_filename',
        'synopsis',
        'trailer_url',
        'custom'
    ];

    public function getFileNameAttribute()
    {
        return strtoupper(trim($this->title)) . '.png';
    }

    public function getImageExistsAttribute()
    {
        if($this->poster_filename == null){
            return false;
        }
        return Storage::exists("public/posters/{$this->poster_filename}");
    }

    public function getImageUrlAttribute()
    {
        if ($this->imageExists) {
            return asset("storage/posters/{$this->poster_filename}");
        } else {
            return asset("storage/posters/_no_poster_1.png");
        }
    }

    //1(Movie) to N(Screenings)
    public function screenings()
    {
        return $this->hasMany(Screening::class, 'movie_id', 'id');
    }

    //1(Genre) to N(Movies)
    public function genreRef()
    {
        return $this->belongsTo(Genre::class, 'genre_code', 'code');
    }
}
