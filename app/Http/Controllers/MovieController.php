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
    $page = min($request->get('page', 1), 500);
    $apiKey = env('TMDB_API_KEY');

    // Fetch movies for the current page
    $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
        'api_key' => $apiKey,
        'language' => 'en-US',
        'page' => $page,
        'sort_by' => 'vote_count.desc',
    ]);

    if ($response->failed()) {
        return view('movies.index')->with('error', 'Unable to fetch movies from TMDB.');
    }

    // Get movies and pagination info
    $movies = $response->json()['results'] ?? [];
    $totalResults = min($response->json()['total_results'] ?? 0, 500 * 20);
    $totalPages = min($response->json()['total_pages'] ?? 1, 500);

    // Fetch genres from TMDB and map them by ID
    $genresResponse = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
        'api_key' => $apiKey,
        'language' => 'en-US',
    ]);

    $genres = collect($genresResponse->json()['genres'] ?? [])->keyBy('id');

    // Attach genre names to each movie
    foreach ($movies as &$movie) {
        $movie['genre_names'] = collect($movie['genre_ids'] ?? [])
            ->map(fn($genreId) => $genres->get($genreId)['name'] ?? 'Unknown genre')
            ->join(', ');
    }

    $moviesPaginator = new LengthAwarePaginator(
        $movies,
        $totalResults,
        count($movies),
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('movies.index', ['movies' => $moviesPaginator]);
}


    public function create(): View
    {
        $newMovie = new Movie();
        $genres = DB::table('genres')->get();
        return view('movies.create')->with(['movie' => $newMovie, 'genres' => $genres]);
    }

    public function show($movieId): View
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$movieId}", [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'en-US',
        ]);

        $movie = $response->json();
        $genres = DB::table('genres')->get();

        return view('movies.show')->with(['movie' => $movie, 'genres' => $genres]);
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
            // Delete old poster if it exists
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
