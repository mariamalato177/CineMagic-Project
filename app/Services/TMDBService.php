<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUrl = 'https://api.themoviedb.org/3';
    }

    public function getMovies($movieId)
    {
        $response = Http::get("{$this->baseUrl}/movie/{$movieId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-EN',
        ]);

        return $response->json();
    }
    public function getPopularMovies()
    {
        $response = Http::get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        return $response->json();
    }
    
    public function getNowPlayingMovies(){
        $response = Http::get("{$this->baseUrl}/movie/now_playing", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'region' => 'hr',
            'page' => 1,
        ]);
        return $response->json()['results'] ?? [];
    }

    public function getMovieByID($tmdb_id)
    {
        $response = Http::get("{$this->baseUrl}/movie/{$tmdb_id}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'region' => 'hr',
            'page' => 1,
        ]);
        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }


    public function searchMovies($query)
    {
        $response = Http::get("{$this->baseUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'pt-PT',
        ]);

        return $response->json();
    }
}
