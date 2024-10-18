<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Screening;

class Genre extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['code', 'name', 'custom'];

    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $keyType = 'string';

    //1(Genre) to N(Movies)
    public function movies()
    {
        return $this->hasMany(Movie::class, 'genre_code', 'code');
    }


    public function hasActiveScreenings()
    {
        $startDate = now()->subMinutes(5);
        $endDate = now()->addWeeks(2);

        $activeScreeningsCount = Screening::whereHas('movieRef', function ($query) {
                $query->where('genre_code', $this->code);
            })
            ->where('date', '>', $startDate)
            ->where('date', '<=', $endDate)
            ->count();

        return $activeScreeningsCount > 0;
    }
}
