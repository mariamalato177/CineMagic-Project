@extends('layouts.main')

@section('header-title', 'Purchases')

@section('main')

<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>
<div class="flex justify-center">
    <div class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-6xl">
        <div class="bg-white rounded-lg p-4 mb-8">
            <form action="{{ route('purchases.index') }}" method="GET"
            class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex flex-col space-y-2">
                    <label for="search" class="text-black">Search by Purchase ID:</label>
                    <input type="text" id="search" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Enter Purchase ID" class="bg-white text-black p-2 rounded">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="date" class="text-black">Select Date:</label>
                    <input type="date" name="date" id="date" class="bg-white text-black p-2 rounded"
                        value="{{ $date ?? '' }}">
                </div>
                <div class="flex flex-col space-y-2 w-60">
                    <label for="sortDate" class="text-black ">Sort by:</label>
                    <select id="sortDate" name="sortDate" class="bg-white text-black p-2 rounded w-full full">
                        <option value="desc" {{ $sortDate == 'desc' ? 'selected' : '' }}>Newest First</option>
                        <option value="asc" {{ $sortDate == 'asc' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>

                <div class="flex pt-6 gap-4">
                    <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
                    <a href="{{ route('purchases.index') }}" class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
                </div>
            </form>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($purchases as $purchase)
            @php
             $date = \Carbon\Carbon::parse($purchase->date)->format('d-m-Y');
            @endphp
                <div class="px-6 py-4 bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                    <h3 class="text-xl font-bold text-gray-900  truncate"><strong> Date: </strong> {{ $date }}</h3>
                    <p><strong>Customer : </strong>{{ $purchase->customer_name }}</p>
                    <p><strong> Purchase Id:</strong> {{ $purchase->id }}</p>
                    @if ($purchase->receipt_pdf_filename)
                        <div class="flex items-center space-x-4">
                            <a href="{{ url('/pdf_purchases/' . $purchase->receipt_pdf_filename) }}" target="_blank" class="text-lg font-bold text-blue-500 hover:text-blue-700">
                                <strong>View PDF</strong>
                            </a>
                        </div>
                    @else
                        <span class="text-lg font-bold text-red-300">Receipt not available</span>
                    @endif
                    <div class="flex justify-end mt-4 space-x-2">
                        <a class="text-lg font-bold text-green-500 hover:text-green-700" href="{{ route('tickets.showTickets', ['purchase' => $purchase]) }}">
                            <strong>View Tickets</strong>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="flex justify-center mb-8">
    {{ $purchases->links() }}
</div>
@endsection
