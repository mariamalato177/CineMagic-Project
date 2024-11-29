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
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $movie['title'] }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('d-m-Y') }}
                                    </p>
                                    <p class="text-sm text-gray-400">Rating:
                                        {{ number_format($movie['vote_average'], 1) }}/10</p>
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
                                        {{ number_format($movie['vote_average'], 1) }}/10</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Upcoming Screenings Section -->
            <div class="my-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Screenings</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($upcomingScreenings as $screening)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-4">
                            <div class="relative pb-[150%]">
                                <img src="https://image.tmdb.org/t/p/w500{{ $screening['poster_path'] }}"
                                    alt="{{ $screening['title'] }}"
                                    class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $screening['title'] }}</h3>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($screening['release_date'])->format('d-m-Y') }}
                                </p>
                                <p class="text-sm text-gray-400">Rating:
                                    {{ number_format($screening['vote_average'], 1) }}/10</p>
                                <a href="#"
                                    class="mt-2 inline-block px-4 py-2 bg-coral text-white rounded-full hover:bg-orange-500 transition-colors">
                                    Buy Tickets
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    </div>
    </main>
@endsection
