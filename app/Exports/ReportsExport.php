<?php

namespace App\Exports;

use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Screening;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportsExport implements FromView
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function view(): View
    {
        if ($this->type == 'sales_by_month') {
            $data = Purchase::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(total_price) as total')
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

            return view('exports.sales_by_month', compact('data'));
        } elseif ($this->type == 'occupancy_rate') {
            $data = Screening::with('tickets')
                ->get()
                ->map(function ($screening) {
                    $totalSeats = $screening->theaterRef->seats()->count();
                    $soldSeats = $screening->tickets()->count();
                    return [
                        'movie' => $screening->movie->title,
                        'occupancy_rate' => $soldSeats / $totalSeats * 100
                    ];
                });
            return view('exports.occupancy_rate', compact('data'));
        }
    }
}
