<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieController extends Controller
{
    public function index(Request $request): View
    {
        $page = max(1, (int) $request->get('page', 1));
        $apiKey = env('TMDB_API_KEY');
        $query = $request->get('query');
        $genreFilter = $request->get('genre');
        $perPage = 20;

        $genres = cache()->remember('tmdb_genres', 60 * 60, function () use ($apiKey) {
            $genresResponse = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
                'api_key' => $apiKey,
                'language' => 'en-US',
            ]);
            return collect($genresResponse->json()['genres'] ?? [])->keyBy('id');
        });

        $url = $query ? 'https://api.themoviedb.org/3/search/movie' : 'https://api.themoviedb.org/3/discover/movie';
        $params = [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1, 
        ];

        if ($query) {
            $params['query'] = $query;
        }
        if ($genreFilter) {
            $params['with_genres'] = $genreFilter;
        }


        $allMovies = collect();
        $totalResults = 0;


        do {
            $response = Http::get($url, $params);

            if ($response->failed()) {
                return view('movies.index')->with('error', 'Error: Failed to fetch movies from TMDB API.')
                    ->with('genres', $genres);
            }

            $moviesData = $response->json();
            $movies = $moviesData['results'] ?? [];
            $totalResults = $moviesData['total_results'] ?? 0;

            $allMovies = $allMovies->merge($movies);


            $params['page']++;

            
            if ($params['page'] > 10) {
                break;
            }
        } while ($params['page'] <= min(ceil($totalResults / $perPage), 500));


        
        $allMovies->transform(function ($movie) use ($genres) {
            $movie['genre_names'] = collect($movie['genre_ids'] ?? [])
                ->map(fn($genreId) => $genres->get($genreId)['name'] ?? 'Unknown genre')
                ->join(', ');
            return $movie;
        });

        if ($query && $genreFilter) {
            $allMovies = $allMovies->filter(function ($movie) use ($query, $genreFilter) {
                return stripos($movie['title'], $query) !== false &&
                    in_array($genreFilter, $movie['genre_ids'] ?? []);
            })->values();
        } elseif ($query) {
            $allMovies = $allMovies->filter(fn($movie) => stripos($movie['title'], $query) !== false)->values();
        } elseif ($genreFilter) {
            $allMovies = $allMovies->filter(fn($movie) => in_array($genreFilter, $movie['genre_ids'] ?? []))->values();
        }

        $totalFilteredResults = $allMovies->count();
        $paginatedMovies = $allMovies->forPage($page, $perPage);

        $moviesPaginator = new LengthAwarePaginator(
            $paginatedMovies,
            $totalFilteredResults,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('movies.index', [
            'movies' => $moviesPaginator,
            'genres' => $genres,
        ]);
    }


    public function create(): View
    {
        $newMovie = new Movie();
        $genres = DB::table('genres')->get();
        return view('movies.create')->with(['movie' => $newMovie, 'genres' => $genres]);
    }

    public function show($movieId)
    {
        $apiKey = env('TMDB_API_KEY');

        $movie = cache()->remember("movie_$movieId", 60 * 60, function () use ($movieId, $apiKey) {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$movieId}", [
                'api_key' => $apiKey,
                'language' => 'en-US',
            ]);

            return $response->successful() ? $response->json() : [];
        });

        $genres = cache()->remember('tmdb_genres', 60 * 60, function () use ($apiKey) {
            $genresResponse = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
                'api_key' => $apiKey,
                'language' => 'en-US',
            ]);
            return collect($genresResponse->json()['genres'] ?? [])->keyBy('id');
        });

        $movie['genre_names'] = collect($movie['genres'] ?? [])
            ->map(fn($genre) => $genres->get($genre['id'])['name'] ?? 'Unknown genre')
            ->join(', ');

        $page = request()->get('page', 1);
        $reviewsResponse = Http::get("https://api.themoviedb.org/3/movie/{$movieId}/reviews", [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => $page,
        ]);

        $reviewsData = $reviewsResponse->json();
        $reviews = $reviewsData['results'] ?? [];
        $totalReviews = $reviewsData['total_results'] ?? 0;

        $reviewsPaginator = new LengthAwarePaginator(
            $reviews,
            $totalReviews,
            5,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('movies.show', [
            'movie' => $movie,
            'reviews' => $reviewsPaginator,
        ]);
    }



    public function showScreenings(Movie $movie): View
    {
        $screenings = $movie->screenings()->orderBy('date')->paginate(70);
        return view('screenings.index', compact('screenings'));
    }

    public function edit(Movie $movie): View
    {
        $title = $movie->title;
        $genres = DB::table('genres')->get();
        $movie = Movie::where('title', $title)->firstOrFail();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        if ($request->hasFile('poster_filename')) {
            $poster = $request->file('poster_filename');
            $filename = $poster->store('posters', 'public');
            $data['poster_filename'] = basename($filename);
        }

        Movie::create($data);
        $url = route('movies.show', ['movie' => $movie]);
        $htmlMessage = "Movie <a href='$url'><u>{$movie->title}</u></a> ({$movie->title}) has been stored successfully!";
        return redirect()->route('movies.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }

    public function update(Request $request, Movie $movie): RedirectResponse
    {
        $data = $request->all();
        if ($request->hasFile('poster_filename')) {
            $file = $request->file('poster_filename');
            $filename = $file->store('posters', 'public');
            $data['poster_filename'] = basename($filename);
            if ($movie->poster_filename) {
                Storage::disk('public')->delete('posters/' . $movie->poster_filename);
            }
        }

        $movie->update($data);
        $url = route('movies.show', ['movie' => $movie]);
        $htmlMessage = "Movie <a href='$url'><u>{$movie->title}</u></a> ({$movie->title}) has been updated successfully!";
        return redirect()->route('movies.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        try {
            $url = route('movies.show', ['movie' => $movie]);
            $totalScreenings = DB::scalar(
                'select count(*) from screenings where movie_id = ?',
                [$movie->id]
            );
            if ($totalScreenings == 0) {
                $movie->delete();
                $alertType = 'success';
                $alertMsg = "Movie ({$movie->title}) has been deleted successfully!";
            } else {
                $alertType = 'warning';
                $screeningsStr = match (true) {
                    $totalScreenings <= 0 => "",
                    $totalScreenings == 1 => "it already includes 1 session",
                    $totalScreenings > 1 => "it already includes $totalScreenings Screenings",
                };
                $justification = $screeningsStr;
                $alertMsg = "movie <a href='$url'><u>{$movie->title}</u></a> ({$movie->title}) cannot be deleted because $justification.";
            }
        } catch (\Exception $error) {
            $alertType = 'danger';
            $alertMsg = "It was not possible to delete the movie
                            <a href='$url'><u>{$movie->name}</u></a> ({$movie->title})
                            because there was an error with the operation!";
        }
        return redirect()->back()
            ->with('alert-type', $alertType)
            ->with('alert-msg', $alertMsg);
    }

    public function deletePoster(Movie $movie): RedirectResponse
    {
        if ($movie->poster_filename) {
            Storage::disk('public')->delete('posters/' . $movie->poster_filename);
            $movie->poster_filename = null;
            $movie->save();
        }
        return redirect()->route('movies.management', $movie);
    }
}
