<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Theater;


class ReportsController extends Controller
{
    public function index()
    {
        // Exibir a página inicial de relatórios
        return view('reports.index');
    }

    public function salesByMonth()
    {
        $sales = Purchase::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(total_price) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $months = $sales->pluck('month');
        $totals = $sales->pluck('total');

        return view('reports.sales_by_month', compact('months', 'totals'));
    }

    public function occupancyRate()
{
    // Fetch aggregated data for each screening
    $screenings = Screening::with(['movieRef'])
        ->withCount(['tickets as sold_seats'])
        ->with('theaterRef:id')
        ->get();

    // Calculate total seats for each theater once
    $theaterSeats = Theater::withCount('seats')->get()->pluck('seats_count', 'id');

    // Group the data by movie
    $movies = $screenings->groupBy(function ($screening) {
        return $screening->movieRef->id;
    });

    // Calculate the occupancy rate for each movie
    $occupancy = $movies->map(function ($screenings, $movieId) use ($theaterSeats) {
        $movie = $screenings->first()->movieRef;
        $movieTitle = $movie->title;
        $movieImage = $movie->image_url;
        $totalSeats = 0;
        $soldSeats = 0;

        foreach ($screenings as $screening) {
            $theaterId = $screening->theaterRef->id;
            $totalSeats += $theaterSeats[$theaterId] ?? 0;
            $soldSeats += $screening->sold_seats;
        }

        return [
            'movie' => $movieTitle,
            'occupancy_rate' => $totalSeats > 0 ? ($soldSeats / $totalSeats) * 100 : 0,
            'img' => $movieImage,
        ];
    });

    return view('reports.occupancy_rate', compact('occupancy'));
}





    public function export(Request $request)
    {
        $type = $request->input('type');
        return Excel::download(new ReportsExport($type), 'report.xlsx');
    }
}


