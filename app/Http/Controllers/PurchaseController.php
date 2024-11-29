<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function management(Request $request)
    {
        $searchQuery = $request->input('search');
        $date = $request->input('date');
        $sortDate = $request->input('sortDate', 'desc');


        $purchases = Purchase::whereHas('tickets.screeningRef', function ($query) {
            $query->whereNotNull('custom');
        })
        ->when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('id', $searchQuery);
        })
        ->when($date, function ($query) use ($date) {
            return $query->whereDate('date', $date);
        })
        ->orderBy('date', $sortDate)
        ->groupBy('purchases.id')
        ->distinct()
        ->paginate(10);

        return view('purchases.index', compact('purchases', 'searchQuery', 'date', 'sortDate'));
    }
}
