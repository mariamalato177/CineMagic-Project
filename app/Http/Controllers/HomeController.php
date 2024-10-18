<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Movie;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch upcoming screenings
        $upcomingScreenings = Screening::where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->take(10) 
            ->get();

        // Fetch most sold screenings based on tickets
        $mostSoldScreenings = Screening::with('movieRef')
            ->join('tickets', 'screenings.id', '=', 'tickets.screening_id')
            ->select('screenings.*', DB::raw('COUNT(tickets.id) as total_tickets_sold'))
            ->groupBy('screenings.id')
            ->orderBy('total_tickets_sold', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('upcomingScreenings', 'mostSoldScreenings'));
    }
}
