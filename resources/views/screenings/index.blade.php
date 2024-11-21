@extends('layouts.main')

@section('header-title', 'List of Screenings')

@section('main')
@php
    $groupedScreenings = $screenings->groupBy('custom');
@endphp

<header class="bg-white ">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            @yield('header-title')
        </h2>
        <br>
        <form action="{{ route('screenings.index') }}" method="GET"
            class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
            <label for="search" class="text-black ">Search:</label>
            <div class="flex flex-col space-y-2">

                <input type="text" id="search" name="search" value="{{ $searchQuery ?? '' }}"
                    placeholder="Screening ID" class="bg-white text-black p-2 rounded">
            </div>
            <div class="flex flex-col space-y-2">
                <input type="text" id="movie" name="movie" value="{{ $searchQuery ?? '' }}"
                    placeholder="Movie Title" class="bg-white text-black p-2 rounded">

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
    <div
        class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-7xl">

        @can('create', App\Models\Screening::class)
            <div class="flex items-center gap-4 mb-4">
                <x-button href="{{ route('screenings.create') }}" text="Create a new Screening" />
            </div>
        @endcan
        <div class="font-base text-sm text-gray-700 ">
            @can('update', App\Models\Screening::class)
                <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="true" :showEdit="true"
                    :showDelete="true" />
            @else
                @if (auth()->check() && auth()->user()->type !== 'C')
                    <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="true" :showEdit="false"
                        :showDelete="false" />
                @else
                    <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="false" :showEdit="false"
                        :showDelete="false" />
                @endif
            @endcan
        </div>
        <div class="mt-4">
            {{ $screenings->links() }}
        </div>
    </div>
</div>
@foreach ($groupedScreenings as $tmdbId => $screeningsGroup)
    @php
        // Get the movie data for the current tmdbId
        $movie = $movieData[$tmdbId] ?? null;
    @endphp

    <div class="movie-group">
        @if ($movie)
            <h2>{{ $movie['title'] ?? 'Unknown Movie' }}</h2>
            <img src="https://image.tmdb.org/t/p/w200/{{ $movie['poster_path'] ?? 'default-poster.jpg' }}" alt="{{ $movie['title'] ?? 'Unknown Movie' }} poster">
        @else
            <p>No movie data available</p>
        @endif

        <div class="screenings">
            @foreach ($screeningsGroup as $screening)
                <div class="screening">
                    <div class="screening-details">
                        <p><strong>Theater:</strong> {{ $screening->theaterRef->name }}</p>
                        <p><strong>Date:</strong> {{ $screening->date }}</p>
                        <p><strong>Start Time:</strong> {{ $screening->start_time }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach


    <div class="mt-4">
        {{ $screenings->links() }}
    </div>

@endsection
