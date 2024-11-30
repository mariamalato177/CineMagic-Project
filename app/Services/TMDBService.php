<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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


    public function searchMovies($query, $page)
    {
        $response = Http::get("{$this->baseUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'pt-PT',
            'page' => $page,
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }

    public function getGenres()
    {
        return Cache::remember('tmdb_genres', 60 * 60, function () {
            $response = Http::get("{$this->baseUrl}/genre/movie/list", [
                'api_key' => $this->apiKey,
                'language' => 'en-US',
            ]);

            if ($response->failed()) {
                return collect([]);
            }

            return collect($response->json()['genres'] ?? [])->keyBy('id');
        });
    }

    public function discoverMoviesByGenre(string $genreFilter, int $page = 1)
    {
        $response = Http::get("{$this->baseUrl}/discover/movie", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'with_genres' => $genreFilter,
            'page' => $page,
        ]);

        return $response->successful() ? $response->json() : [];
    }
}
