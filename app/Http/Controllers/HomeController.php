<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TMDBService;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private TMDBService $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index()
    {
        $nowPlayingMovies = $this->tmdbService->getNowPlayingMovies();
        $upcomingMovies = $this->tmdbService->getUpcomingMovies();


            $upcomingScreenings = Screening::whereDate('date', now()->toDateString())
            ->where('custom', '!=', null)
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy('custom');

        $screeningsByMovie = [];

        foreach ($upcomingScreenings as $tmdbId => $screenings) {
            $firstScreening = $screenings->first();

            $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                return $this->tmdbService->getMovieByID($tmdbId);
            });

            $screeningsByMovie[] = [
                'movie' => $movieData,
                'screening' => $firstScreening,
            ];
        }

        return view('home', compact('upcomingScreenings', 'nowPlayingMovies', 'upcomingMovies', 'screeningsByMovie'));
    }
}
