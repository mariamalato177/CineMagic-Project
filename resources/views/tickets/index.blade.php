@extends('layouts.main')

@section('header-title', 'Tickets')

@section('main')
    <header class="bg-white dark:bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @yield('header-title')
            </h2>
            <div class="flex justify-start">
                <form action="{{ route('screenings.showTickets', ['screening' => $screening]) }}" method="GET"
                    class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex flex-col space-y-2">
                        <label for="search" class="text-black dark:text-white">Search by Ticket ID:</label>
                        <input type="text" id="search" name="search" value="{{ $searchQuery ?? '' }}"
                            placeholder="Enter Ticket ID" class="bg-white text-black p-2 rounded">
                    </div>
                    <div class="flex">
                        <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
                    </div>
                    <div>
                        <a href="{{ route('screenings.showTickets', ['screening' => $screening]) }}"
                            class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <div class="flex justify-center flex-wrap">
        <div
            class="w-full my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden sm:rounded-lg text-gray-900 dark:text-gray-50">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Id</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Seat</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Name of Customer</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Price (€)</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                QR Code</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tickets->sortByDesc('id') as $ticket)
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ticket->seatRef->row }}{{ $ticket->seatRef->seat_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->purchaseRef->customer_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($ticket->status == 'invalid')
                                        <p class="text-red-500 font-bold ">Invalid</p>
                                    @else
                                        <p class="text-green-500 font-bold">Valid</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$ticket->qrcode_url}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('tickets.showQrCode', ['ticket' => $ticket]) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
