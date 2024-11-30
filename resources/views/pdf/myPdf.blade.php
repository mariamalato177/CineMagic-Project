@extends('layouts.main')

@section('header-title', 'My Purchases')

@section('main')
    <header class="bg-white  shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                @yield('header-title')
            </h2>
        </div>
    </header>

    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            <div class="container mx-auto px-4 pt-16">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-4">
                    @foreach ($purchases as $purchase)
                        @php
                            $date = \Carbon\Carbon::parse($purchase->date)->format('d-m-Y');
                        @endphp
                        <div
                            class="px-6 py-4 bg-white  rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                            <h3 class="text-xl font-bold text-gray-900  truncate"> Date {{ $date }}</h3>
                            <p><strong>Id:</strong> {{ $purchase->id }}</p>
                            <p> <strong> Price: </strong> {{ $purchase->total_price }} €</p>
                            @if ($purchase->receipt_pdf_filename)
                                <div class="flex items-center space-x-4">
                                    <a href="{{ url('/pdf_purchases/' . $purchase->receipt_pdf_filename) }}" target="_blank"
                                        class="text-lg font-bold text-blue-500 hover:text-blue-700">
                                        <strong>View PDF</strong>
                                    </a>
                                </div>
                            @else
                                <span class="text-lg font-bold text-red-300">Receipt not available</span>
                            @endif
                            <div class="flex justify-end mt-4 space-x-2">
                                <a class="text-lg font-bold text-green-500 hover:text-green-700"
                                    href="{{ route('tickets.showTickets', ['purchase' => $purchase]) }}">
                                    <strong>View Tickets</strong>
                                </a>
                            </div>
                        </div>
                        @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
