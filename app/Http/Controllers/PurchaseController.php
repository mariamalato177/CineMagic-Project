<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    
    public function management(Request $request)
    {
        $searchQuery = $request->input('search');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $sortDate = $request->input('sortDate', 'desc');

        $purchases = Purchase::when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('id', $searchQuery);
        })->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('date', [$startDate, $endDate]);
        })->orderBy('date', $sortDate)->paginate(10);

        return view('purchases.index', compact('purchases', 'searchQuery', 'startDate', 'endDate', 'sortDate'));
    }
}
