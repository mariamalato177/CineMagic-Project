@extends('layouts.main')

@section('header-title', 'CineMagic - Home')

@section('main')
    <!-- Welcome Section -->
    <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
        <h3 class="pb-3 text-2xl font-semibold text-gray-900 leading-tight">
            @auth
                Welcome back, {{ Auth::user()->name }}!
            @else
                <p class="text-lg">Welcome!</p>
                <p class="text-lg">You can login <a href="{{ route('login') }}" class="text-coral">here</a>.</p>
                <p class="text-lg">If you don't have an account, register <a href="{{ route('register') }}"
                        class="text-coral">here</a>.</p>
            @endauth
        </h3>
    </div>

    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            <!-- Upcoming Movies Carousel -->
            <div class="my-8 mb-12 relative">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Movies</h2>

                <div class="flex overflow-x-auto scroll-smooth space-x-4">
                    @foreach ($upcomingMovies as $movie)
                        <div class="w-full sm:w-1/4 flex-shrink-0 pb-4">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative pb-[150%]">
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                        alt="{{ $movie['title'] }}"
                                        class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
                                </div>
                                <div class="h-36 p-4 flex flex-col justify-center items-start">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $movie['title'] }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Release Date: {{ \Carbon\Carbon::parse($movie['release_date'])->format('d-m-Y') }}
                                    </p>
                                    <p class="text-sm text-gray-400">Rating:
                                        {{ $movie['vote_average'] == 0 ? 'N/A' : number_format($movie['vote_average'], 1) }}{{ $movie['vote_average'] == 0 ? '' : '/10' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Now Playing Movies Carousel -->
            <div class="my-8 mb-12 relative">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Now Playing Movies</h2>
                <div id="nowPlayingCarousel" class="flex overflow-x-auto scroll-smooth space-x-4">
                    @foreach ($nowPlayingMovies as $movie)
                        <div class="w-full sm:w-1/4 flex-shrink-0 pb-4">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative pb-[150%]">
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                        alt="{{ $movie['title'] }}"
                                        class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $movie['title'] }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('d-m-Y') }}
                                    </p>
                                    <p class="text-sm text-gray-400">Rating:
                                        {{ $movie['vote_average'] == 0 ? 'N/A' : number_format($movie['vote_average'], 1) }}{{ $movie['vote_average'] == 0 ? '' : '/10' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Upcoming Screenings Section -->
            <div class="my-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Screenings</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($screeningsByMovie as $movieGroup)
                        @if($movieGroup['screening']['date'] == now()->toDateString() && $movieGroup['screening']['start_time'] > now()->toTimeString())
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-4">
                            <img src="https://image.tmdb.org/t/p/w500{{ $movieGroup['movie']['poster_path'] }}"
                                alt="{{ $movieGroup['movie']['title'] }}">
                            <div class="p-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $movieGroup['movie']['title'] }}</h3>
                                @php
                                    $date = \Carbon\Carbon::parse($movieGroup['screening']['date'])->format('d-m-Y');
                                @endphp
                                <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $date }}</p>
                                <p class="text-sm text-gray-600"><strong>Time:
                                    </strong>{{ $movieGroup['screening']['start_time'] }}</p>
                                    @if (!$movieGroup['screening']->isSoldOut($movieGroup['screening']))
                                        <div class="mt-4 flex justify-end">
                                            <a href="{{ route('screenings.show', $movieGroup['screening']) }}"
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
                                            <a href="{{ route('screenings.show', $movieGroup['screening']) }}"
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
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
