<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MovieFormRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\TMDBService;


class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index(Request $request): View
    {
        /*
        $genres = DB::table('genres')->get();

        $today = Carbon::today();
        $twoWeeksFromNow = Carbon::today()->addWeeks(2);


        $filterByGenre = $request->query('genre');
        $filterByTitle = $request->query('title');
        $filterBySynopsis = $request->input('synopsis');

        $moviesQuery = Movie::query();


        if ($filterByGenre !== null) {
            $moviesQuery->where('genre_code', $filterByGenre);
        }
        if ($filterByTitle !== null) {
            $moviesQuery->where('title', 'like', '%' . $filterByTitle . '%');
        }
        if ($filterBySynopsis !== null) {
            $moviesQuery->where('synopsis', 'like', '%' . $filterBySynopsis . '%');
        }

        if (!Auth::check() || Auth::user()->type !== 'A') {
            $moviesQuery->whereHas('screenings', function ($query) use ($today, $twoWeeksFromNow) {
                $query->whereBetween('date', [$today, $twoWeeksFromNow]);
            });
        }


        $movies = $moviesQuery
            ->with('genreRef')
            ->orderBy('title')
            ->paginate(20)
            ->withQueryString();


        return view(
            'movies.index',
            compact('movies', 'filterByGenre', 'filterByTitle', 'filterBySynopsis', 'genres')
        );*/

        // Obtendo a lista de filmes da API
    $movies = $this->tmdbService->getPopularMovies(); // Assumindo que existe esse método na TMDBService

    
    // Decodificando a resposta JSON
    $movies = json_decode(json_encode($movies), true);

    // Verificando se houve erro na resposta
    if (isset($movies['success']) && !$movies['success']) {
        return view('movies.index')->with('error', $movies['status_message']);
    }

    // Verificando se a lista de filmes está vazia
    if (empty($movies['results'])) {
        return view('movies.index')->with('error', 'No movies found.');
    }

    return view('movies.index', ['movies' => $movies['results']]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $newMovie = new Movie();
        $genres = DB::table('genres')->get();
        return view('movies.create')->with(['movie' => $newMovie, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show($movieId): View
    {
    $movie = $this->tmdbService->getMovie($movieId);
    $genres = DB::table('genres')->get();
    return view('movies.show')->with(['movie' => $movie, 'genres' => $genres]);
    }


    public function showScreenings(Movie $movie): View
    {

        $screenings = $movie->screenings()->orderBy('date')->paginate(70);
      //  dd($screenings);
        return view('screenings.index', compact( 'screenings'));
    }


    /**
     * Show the form for editing the specified resource.
     */
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



    /**
     * Remove the specified resource from storage.
     */
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
