@extends('layouts.main')

@section('header-title', 'List of Screenings')

@section('main')
@php
    $groupedScreenings = $screenings->groupBy('custom');
    $availableDates = collect($availableDates)->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    });
@endphp

<header class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('header-title')
        </h2>
        <br>
        <form action="{{ route('screenings.index') }}" method="GET" class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
            <label for="search" class="text-black">Search:</label>
            <div class="flex flex-col space-y-2">
                <input type="text" id="search" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Screening ID" class="bg-white text-black p-2 rounded">
            </div>
            <div class="flex flex-col space-y-2">
                <input type="text" id="movie" name="movie" value="{{ $movieQuery ?? '' }}" placeholder="Movie Title" class="bg-white text-black p-2 rounded">
            </div>
            <div class="flex">
                <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
            </div>
            <div>
                <a href="{{ route('screenings.index') }}" class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
            </div>

            <!-- Date Input for Filtering Screenings -->
            <div class="flex items-center space-x-4 mt-6">
                <label for="date" class="text-black">Select Date:</label>
                <input type="date" name="date" id="date" class="bg-white text-black p-2 rounded"
                       value="{{ $selectedDate ?? '' }}" min="{{ now()->format('Y-m-d') }}">
            </div>
        </form>


    </div>
</header>

<div>
    <div class="px-[50px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 gap-y-12 mt-12">
            @foreach ($groupedScreenings as $tmdbId => $screeningsGroup)
                @php
                    $movie = $movieData[$tmdbId] ?? null;
                @endphp

                <div class="col-md-3">
                    <div class="card mb-4">
                        @if ($movie)
                            <img class="rounded-lg shadow-md ease-in-out duration-300 hover:opacity-50 cursor-pointer"
                            src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w300/' . $movie['poster_path'] : asset('storage/posters/_no_poster_1.png') }}"
                            alt="{{ $movie['title'] ?? 'Unknown Movie' }} poster"
                            data-movie="{{ json_encode($movie) }}"
                            onclick="openModal(event)">

                            <div class="text-center">
                                <h5 class="card-title mt-2">{{ $movie['title'] ?? 'Unknown Movie' }}</h5>
                            </div>
                        @else
                            <p>No movie data available</p>
                        @endif
                        @foreach ($screeningsGroup->groupBy('theaterRef.name') as $theaterName => $theaterScreenings)
                            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                                <h3 class="text-2xl font-semibold text-gray-800 mb-4"><strong>{{ $theaterName }}</strong></h3>

                                @foreach ($theaterScreenings->groupBy('date') as $screeningDate => $dateScreenings)
                                    <div class="space-y-6">
                                        <h4 class="text-xl font-semibold text-gray-700 mb-4">
                                            <strong>{{ \Carbon\Carbon::parse($screeningDate)->format('l, F j, Y') }}</strong>
                                        </h4>

                                        @foreach ($dateScreenings as $screening)
                                            <div class="border-t pt-4">
                                                <div class="mt-2">
                                                    <label for="session-{{ $screening->id }}" class="flex items-center space-x-2 cursor-pointer">
                                                        <input type="radio" id="session-{{ $screening->id }}" name="screening_{{ $screeningDate }}" value="{{ $screening->id }}" class="hidden peer" />

                                                        <span class="w-6 h-6 border-2 border-gray-400 rounded-full flex items-center justify-center peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-300 peer-checked:ring-offset-1 peer-hover:border-blue-500 transition-all duration-200">
                                                            <span class="w-3 h-3 rounded-full bg-white"></span>
                                                        </span>

                                                        <span class="text-gray-700 font-medium">{{ $screening->start_time }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75 hidden transition-opacity duration-300">
        <div class="bg-gray-900 text-gray-100 rounded-lg shadow-lg max-w-2xl w-full p-6 relative flex flex-col md:flex-row items-start">
            <button id="close-modal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-300 text-4xl p-2">&times;</button>
            <div class="w-full md:w-1/3">
                <img id="modal-poster" class="rounded-lg shadow-md" src="" alt="Movie Poster">
            </div>
            <div class="w-full md:w-2/3 mt-6 md:mt-0 md:pl-6">
                <h2 class="text-2xl font-semibold text-gray-200 mb-2" id="modal-title"></h2>
                <p class="text-gray-400 mb-6" id="modal-description">Here you can put a movie description or any additional information about the movie.</p>

                <div class="space-y-4">
                    @foreach ($screeningsGroup->groupBy('theaterRef.name') as $theaterName => $theaterScreenings)
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-gray-600">{{ $theaterName }}</h4>

                            @foreach ($theaterScreenings->groupBy('date') as $screeningDate => $dateScreenings)
                                <div class="border-t pt-4">
                                    <h5 class="text-md font-medium text-gray-700 mb-2">{{ \Carbon\Carbon::parse($screeningDate)->format('l, F j, Y') }}</h5>

                                    @foreach ($dateScreenings as $screening)
                                        <label for="session-{{ $screening->id }}" class="flex items-center space-x-2 cursor-pointer">
                                            <input type="radio" id="session-{{ $screening->id }}" name="screening_{{ $screeningDate }}" value="{{ $screening->id }}" class="hidden peer" />

                                            <span class="w-5 h-5 border-2 border-gray-400 rounded-full flex items-center justify-center peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-300 peer-checked:ring-offset-1 peer-hover:border-blue-500 transition-all duration-200">
                                                <span class="w-3 h-3 rounded-full bg-white"></span>
                                            </span>

                                            <span class="text-gray-700 font-medium">{{ $screening->start_time }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function openModal(event) {
        event.preventDefault();

        const movie = JSON.parse(event.target.getAttribute('data-movie'));

        document.getElementById('modal-poster').src = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'storage/posters/_no_poster_1.png';
        document.getElementById('modal-title').innerText = movie.title || 'Unknown Movie';
        document.getElementById('modal-description').innerText = movie.description || 'No description available.';

        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.getElementById('close-modal').addEventListener('click', function() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

</script>

@endsection
