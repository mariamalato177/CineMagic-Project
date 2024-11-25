<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Definir os parâmetros comuns para a API TMDB
        $apiKey = env('TMDB_API_KEY');
        $language = 'en-US';
        $region = 'hr';

        // Buscar filmes em exibição ("Now Playing") da API TMDB para "Upcoming Screenings"
        $upcomingScreenings = $this->getMoviesFromApi('now_playing', $apiKey, $language, $region);

        // Buscar filmes populares da API TMDB
        $popularMovies = $this->getMoviesFromApi('popular', $apiKey, $language, $region);

        // Buscar filmes que serão lançados ("Upcoming") da API TMDB
        $upcomingMovies = $this->getMoviesFromApi('upcoming', $apiKey, $language, $region);

        // Buscar filmes que estão atualmente em exibição ("Now Playing") da API TMDB
        $nowPlayingMovies = $this->getMoviesFromApi('now_playing', $apiKey, $language, $region);

        // Passar os filmes para a view
        return view('home', compact('upcomingScreenings', 'popularMovies', 'upcomingMovies', 'nowPlayingMovies'));
    }

    // Método auxiliar para obter filmes da API TMDB com base no tipo de filme
    private function getMoviesFromApi($type, $apiKey, $language, $region)
    {
        // Fazer a requisição para a API TMDB
        $response = Http::get("https://api.themoviedb.org/3/movie/{$type}", [
            'api_key' => $apiKey,
            'language' => $language,
            'region' => $region,
            'page' => 1, // Página 1 para o primeiro lote de resultados
        ]);

        // Retornar os resultados se a requisição for bem-sucedida, caso contrário, retornar um array vazio
        return $response->successful() ? $response->json()['results'] : [];
    }
}
