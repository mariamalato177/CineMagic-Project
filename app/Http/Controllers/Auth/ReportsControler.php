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
            ->orderBy('year', 'month')
            ->get();

        $chart = Charts::create('bar', 'highcharts')
            ->title('Sales by Month')
            ->elementLabel('Total Sales')
            ->labels($sales->pluck('month'))
            ->values($sales->pluck('total'))
            ->dimensions(1000, 500)
            ->responsive(true);

        return view('reports.sales_by_month', compact('chart'));
    }

    public function occupancyRate()
    {
        $occupancy = Screening::with('tickets')
            ->get()
            ->map(function ($screening) {
                $totalSeats = $screening->theater->seats()->count();
                $soldSeats = $screening->tickets()->count();
                return [
                    'movie' => $screening->movie->title,
                    'occupancy_rate' => $soldSeats / $totalSeats * 100
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
