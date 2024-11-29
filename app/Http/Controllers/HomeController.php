<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TMDBService;

class HomeController extends Controller
{
    private TMDBService $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index()
    {
        // Use the service to fetch the data
        $upcomingScreenings = $this->tmdbService->getNowPlayingMovies();
        $nowPlayingMovies = $this->tmdbService->getNowPlayingMovies();
        $upcomingMovies = $this->tmdbService->getUpcomingMovies();

        // Pass the data to the view
        return view('home', compact('upcomingScreenings', 'nowPlayingMovies', 'upcomingMovies'));
    }
}
