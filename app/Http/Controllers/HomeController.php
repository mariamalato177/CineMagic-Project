<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar filmes em exibição ("Now Playing") da API TMDB para "Upcoming Screenings"
        $upcomingScreeningsResponse = Http::get('https://api.themoviedb.org/3/movie/now_playing', [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'en-US',
            'region' => 'hr',
            'page' => 1,
        ]);

        // Verificar se a resposta foi bem-sucedida e extrair os filmes para "Upcoming Screenings"
        $upcomingScreenings = $upcomingScreeningsResponse->successful() ? $upcomingScreeningsResponse->json()['results'] : [];

        // Buscar filmes populares da API TMDB
        $popularMoviesResponse = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'en-US',
            'region' => 'hr',
            'page' => 1,
        ]);

        // Buscar filmes em exibição ("Now Playing") da API TMDB
        $nowPlayingResponse = Http::get('https://api.themoviedb.org/3/movie/now_playing', [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'en-US',
             'region' => 'hr',
            'page' => 1,
        ]);

        // Verificar se a resposta foi bem-sucedida e extrair os filmes
        $popularMovies = $popularMoviesResponse->successful() ? $popularMoviesResponse->json()['results'] : [];
        $nowPlayingMovies = $nowPlayingResponse->successful() ? $nowPlayingResponse->json()['results'] : [];

        // Passar as variáveis para a view
        return view('home', compact('upcomingScreenings', 'nowPlayingMovies', 'popularMovies'));
    }
}
