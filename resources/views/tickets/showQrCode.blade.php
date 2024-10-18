@extends('layouts.main')

@section('header-title', 'Validation of Tickets')

@section('main')
    <header class="bg-white dark:bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @yield('header-title')
            </h2>
        </div>
    </header>
    <div class="flex justify-center">
        <div
            class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50 w-full max-w-6xl">
            <div class="container mx-auto px-4 pt-8">
                <h1 class="text-3xl font-bold mb-6 text-white">Ticket number: {{ $ticket->id }}</h1>
                @if ($user)
                    <div class="flex items-center my-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden">
                            <img src="{{ $user->first()->photoFullUrl ? $user->first()->photoFullUrl : asset('storage/app/public/photos/anonymous.jpg') }}"
                                class="w-full h-full object-cover" alt="{{ $user->first()->name }}">
                        </div>
                        <span class="text-lg font-bold ml-4">{{ $user?->first()->name }}</span>
                    </div>
                @endif
            </div>

            <div
                class="px-6 py-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50 truncate">Screening:
                    {{ $ticket->screeningRef->movieRef->title }}</h3>
                <p>{{ $ticket->screeningRef->start_time }}</p>
                <p>Seat: {{ $ticket->seatRef->seatName }}</p>
                <p>{{ $ticket->screeningRef->theaterRef->name }} Theater</p>
                <p>Price: {{ $ticket->price }}€</p>
                <p style="color: {{ $ticket->status == 'valid' ? 'green' : 'red' }}">Status: {{ ucfirst($ticket->status) }}
                </p>
                <div class="flex justify-end mt-4 space-x-2">
                    <form action="{{ route('tickets.invalidate', ['ticket' => $ticket->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-coral hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">Invalidate
                            Ticket</button>
                    </form>
                </div>
                <div class="absolute top-2 right-2">
                    @if ($ticket->status != 'valid')
                        <span class="px-2 py-2 bg-red-500 text-white text-lg font-semibold rounded-full">Ticket Invalid
                        </span>
                    @else
                        <span class="px-2 py-2 bg-green-500 text-white text-lg font-semibold rounded-full">Ticket
                            Valid</span>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
