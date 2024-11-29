@extends('layouts.main')

@section('header-title', 'List of Screenings')

@section('main')
    @php
        $groupedScreenings = $screenings->groupBy('custom');
        $availableDates = collect($availableDates)->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });
        $sortedScreenings = $groupedScreenings->sortByDesc(function ($group) {
            return $group->count();
        });
    @endphp

    <header class="bg-white">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @yield('header-title')
            </h2>
            <br>
            <form action="{{ route('screenings.index') }}" method="GET"
                class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                <label for="search" class="text-black">Search:</label>
                <div class="flex flex-col space-y-2">
                    <input type="text" id="search" name="search" value="{{ $searchQuery ?? '' }}"
                        placeholder="Screening ID" class="bg-white text-black p-2 rounded">
                </div>
                <div class="flex flex-col space-y-2">
                    <input type="text" id="movie" name="movie" value="{{ $movieQuery ?? '' }}"
                        placeholder="Movie Title" class="bg-white text-black p-2 rounded">
                </div>
                <!-- Date Input for Filtering Screenings -->
                <div class="flex items-center space-x-4 mt-6">
                    <label for="date" class="text-black">Select Date:</label>
                    <input type="date" name="date" id="date" class="bg-white text-black p-2 rounded"
                        value="{{ $selectedDate ?? '' }}" min="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="flex">
                    <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
                </div>
                <div>
                    <a href="{{ route('screenings.index') }}" class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </header>

    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            @can('create', App\Models\Screening::class)
                <div class="flex items-center gap-4 mb-4 pb-5">
                    <x-button href="{{ route('screenings.create') }}" text="Create a new Screening" />
                </div>
            @endcan
            @foreach ($groupedScreenings as $tmdbId => $screeningsGroup)
                <div class="mb-8">
                    @php
                        $movie = $movieData[$tmdbId] ?? null;
                    @endphp

                    @if ($movie)
                        <h1 class="text-2xl font-bold mb-4 text-gray-900">
                            Movie: {{ $movie['title'] ?? 'Unknown Title' }}
                        </h1>
                        <div class="flex flex-col md:flex-row items-start">
                            <!-- Poster Section -->
                            <div class="w-full md:w-1/4 flex justify-center items-center mb-4 md:mb-0">
                                <a href="#">
                                    <img src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : asset('storage/posters/_no_poster_2.png') }}"
                                        alt="{{ $movie['title'] ?? 'No Poster' }}"
                                        class="w-80 h-auto object-contain rounded-lg">
                                </a>
                            </div>

                            <!-- Screenings Section -->
                            <div class="w-full md:w-3/4 md:pl-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        $sortedTheaters = $screeningsGroup
                                            ->groupBy('theaterRef.name')
                                            ->sortByDesc(function ($theaterGroup) {
                                                return $theaterGroup->count();
                                            });
                                    @endphp
                                    @foreach ($sortedTheaters as $theaterName => $theaterScreenings)
                                        <!-- Theater Box -->
                                        <div
                                            class="bg-gray-100 shadow-lg rounded-md p-4 flex flex-col justify-between h-full">
                                            <h2 class="text-xl font-semibold mb-2 text-gray-900">Theater:
                                                {{ $theaterName }}</h2>
                                            <div class="space-y-4 flex-grow">
                                                @foreach ($theaterScreenings as $screening)
                                                    <!-- Individual Screening Card -->
                                                    <div class="bg-white shadow-md rounded-lg p-4">
                                                        @php
                                                        $date = \Carbon\Carbon::parse($screening->date)->format('d-m-Y');
                                                         @endphp
                                                        <p class="text-xl"><strong>Date:</strong> {{ $date }}
                                                        </p>
                                                        <p class="text-xl"><strong>Start Time:</strong>
                                                            {{ $screening->start_time }}</p>
                                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                                            @if (auth()->check() && auth()->user()->type === 'A')
                                                                <a class="px-2 py-1 bg-yellow-400 text-white text-sm font-semibold rounded-full inline-flex items-center"
                                                                    href="{{ route('screenings.showTickets', ['screening' => $screening]) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                                                        fill="currentColor">
                                                                        <path
                                                                            d="M20 3H4c-1.1 0-2 .9-2 2v3.5c1.11 0 2 .89 2 2s-.89 2-2 2V19c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-3.5c-1.11 0-2-.89-2-2s.89-2 2-2V5c0-1.1-.9-2-2-2zm-5 10H9v-2h6v2zm0-4H9V7h6v2z" />
                                                                    </svg>
                                                                </a>
                                                                <x-table.icon-edit
                                                                    href="{{ route('screenings.edit', ['screening' => $screening]) }}" />
                                                                <x-table.icon-delete
                                                                    action="{{ route('screenings.destroy', ['screening' => $screening]) }}" />
                                                            @else
                                                                @if (!$screening->isSoldOut($screening))
                                                                    <div class="mt-4 flex justify-end">
                                                                        <a href="{{ route('screenings.show', $screening) }}"
                                                                            class="px-4 py-2 bg-coral text-white rounded-full"
                                                                            style=" color: white; transition: background-color 0.3s ease-in-out;">
                                                                            @if (auth()->check() && auth()->user()->type !== 'C')
                                                                                See info
                                                                            @else
                                                                                Buy Tickets
                                                                            @endif
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                @if (auth()->check() && auth()->user()->type !== 'A')
                                                                    <a href="{{ route('screenings.show', $screening) }}"
                                                                    rel="noopener noreferrer"
                                                                    class="px-2 py-1 font-semibold rounded-full bg-coral"
                                                                    style="color: white; transition: background-color 0.3s ease-in-out;">
                                                                    See Info
                                                                </a>
                                                                <div class="absolute top-2 right-2">
                                                                    <span
                                                                        class="px-2 py-1 bg-red-500 text-white text-xl font-semibold rounded-full">Sold
                                                                        Out</span>
                                                                </div>
                                                                @endif
                                                            @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endforeach
                </div>
        </div>
    </div>
@else
    <p>No movie data available</p>
    @endif
    </div>
    @endforeach
    </div>
    </div>


@endsection
