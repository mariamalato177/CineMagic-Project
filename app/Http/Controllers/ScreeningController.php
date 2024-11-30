<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\ScreeningFormRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\TMDBService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ScreeningController extends Controller
{
    private TMDBService $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;

    }

    public function index(Request $request): View
    {
        $apiKey = env('TMDB_API_KEY');

        $today = Carbon::today();
        $twoWeeksFromNow = Carbon::today()->addWeeks(2);

        $searchQuery = $request->input('search');
        $movieQuery = $request->input('movie');
        $selectedDate = $request->input('date');

        $screeningsQuery = Screening::query();
        $screeningsQuery->whereNotNull('custom');

        if ($searchQuery) {
            $screeningsQuery = Screening::where('id', $searchQuery);
        }
        if ($movieQuery) {
            $screeningsQuery = Screening::whereHas('movieRef', function ($query) use ($movieQuery) {
                $query->where('title', 'like', "%$movieQuery%");
            });
        }

        if (!Auth::check() || Auth::user()->type !== 'A') {
            $screeningsQuery->whereBetween('date', [$today, $twoWeeksFromNow]);
        }

        if ($selectedDate) {
            $screeningsQuery->whereDate('date', $selectedDate);
        }

        $screenings = $screeningsQuery
            ->with('theaterRef', 'movieRef')
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(70)
            ->withQueryString();

        $availableDates = Screening::query()
            ->whereNotNull('custom')
            ->distinct()
            ->pluck('date')
            ->toArray();

        // Movie data
        $movieData = [];
        foreach ($screenings as $screening) {
            $tmdbId = $screening->custom;
            if ($tmdbId) {
                $movieData[$tmdbId] = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                    return $this->tmdbService->getMovieByID($tmdbId);
                });
            }
        }

        return view('screenings.index', compact('screenings', 'movieData', 'selectedDate', 'availableDates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $movies = $this->tmdbService->getNowPlayingMovies();
        $theaters = \App\Models\Theater::all();
        $screening = new Screening();

        return view('screenings.create', compact('screening', 'movies', 'theaters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dates' => 'required|array',
            'dates.*' => 'date',
            'times' => 'required|array',
            'times.*' => 'date_format:H:i',
            'movie_id' => 'required|integer',
            'theater_id' => 'required|exists:theaters,id',
        ]);

        $movieId = 350; 
        $tmdbMovieId = $validated['movie_id'];
        $theaterId = $validated['theater_id'];
        $dates = $validated['dates'];
        $times = $validated['times'];

        foreach ($dates as $date) {
            foreach ($times as $time) {
                Screening::create([
                    'movie_id' => $movieId,
                    'theater_id' => $theaterId,
                    'start_time' => $time,
                    'date' => $date,
                    'custom' => $tmdbMovieId,
                ]);
            }
        }

        return redirect()->route('screenings.index')->with('success', 'Screenings created successfully.');
    }


    public function showTickets(Request $request,Screening $screening): View
    {
        $searchQuery = $request->input('search');

        if ($searchQuery) {
            $tickets = Ticket::where('id', $searchQuery)->paginate(70);
            return view('tickets.index', compact('tickets', 'searchQuery', 'screening'));
        }

        $tickets = $screening->tickets()->paginate(70);
        return view('tickets.index', compact( 'tickets','searchQuery','screening'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Screening $screening): View
{
    $theater = $screening->theaterRef;
    $movie = $screening->movieRef;
    $seats = $theater->seats;

    $tmdbId = $screening->custom;
    $movieData = null;

    if ($tmdbId) {
        $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
            return $this->tmdbService->getMovieByID($tmdbId);
        });
    }

    return view('screenings.show')->with([
        'screening' => $screening,
        'theater' => $theater,
        'seats' => $seats,
        'movie' => $movie,
        'movieData' => $movieData,
    ]);
}


    public function isSoldOut(Screening $screening): bool
    {
        $theater = $screening->theaterRef;
        $seats = $theater->seats;

        foreach ($seats as $seat) {
            if ($seat->isAvailable($screening->id)) {
                return false;
            }
        }

        return true;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Screening $screening): View
    {

        return view('screenings.edit')
            ->with('screening', $screening);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScreeningFormRequest $request, Screening $screening): RedirectResponse
    {

        $screening->update($request->validated());
        $url = route('screenings.show', ['screening' => $screening]);
        $htmlMessage = "Movie <a href='$url'><u>{$screening->movieRef->title}</u></a> has been updated successfully!";
        return redirect()->route('screenings.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screening $screening): RedirectResponse
    {
        try {
            $url = route('screenings.show', ['screening' => $screening]);
            $totalTickets = DB::scalar(
                'select count(*) from tickets where screening_id = ?',
                [$screening->id]
            );
            if ($totalTickets == 0) {
                $screening->delete();
                $alertType = 'success';
                $alertMsg = "Screening ({$screening->id}) has been deleted successfully!";
            } else {
                $alertType = 'warning';
                $screeningsStr = match (true) {
                    $totalTickets <= 0 => "",
                    $totalTickets == 1 => "it already includes 1 session",
                    $totalTickets > 1 => "it already includes $totalTickets Tickets",
                };
                $justification = $screeningsStr;
                $alertMsg = "Screening <a href='$url'><u>{$screening->id}</u></a> cannot be deleted because $justification.";
            }
        } catch (\Exception $error) {
            $alertType = 'danger';
            $alertMsg = "It was not possible to delete the screening
                            <a href='$url'><u>{$screening->id}</u></a>
                            because there was an error with the operation!";
        }

        return redirect()->back()
        ->with('alert-type', $alertType)
        ->with('alert-msg', $alertMsg);

    }
}
