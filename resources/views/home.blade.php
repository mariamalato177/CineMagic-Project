@extends('layouts.main')

@section('header-title', 'CineMagic - Home')

@section('main')
<main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <!-- Welcome Section -->
        <div class="my-4 p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg text-gray-900 dark:text-gray-50">
            <h3 class="pb-3 text-2xl font-semibold text-gray-900 dark:text-gray-200 leading-tight">
                @auth
                    Welcome back, {{ Auth::user()->name }}!
                @else
                    <p class="text-lg">Welcome!</p>
                    <p class="text-lg">You can login <a href="{{ route('login') }}" class="text-coral">here</a>.</p>
                    <p class="text-lg">If you don't have an account, register <a href="{{ route('register') }}" class="text-coral">here</a>.</p>
                @endauth
            </h3>
        </div>

        <!-- Popular Movies Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Popular Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularMovies as $movie)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                             alt="{{ $movie['title'] }}" 
                             class="w-full h-auto object-contain rounded-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $movie['title'] }}</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $movie['release_date'] }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $movie['vote_average'] }}/10</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Now Playing Movies Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Now Playing Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($nowPlayingMovies as $movie)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                             alt="{{ $movie['title'] }}" 
                             class="w-full h-auto object-contain rounded-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $movie['title'] }}</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $movie['release_date'] }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $movie['vote_average'] }}/10</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Upcoming Screenings Section -->
<div class="my-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Upcoming Screenings</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($upcomingScreenings as $screening)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                <!-- Exibir a imagem do filme -->
                <img src="https://image.tmdb.org/t/p/w500{{ $screening['poster_path'] }}" alt="{{ $screening['title'] }}" class="w-full h-auto object-contain rounded-lg mb-4">
                <!-- Título do filme -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $screening['title'] }}</h3>
                <!-- Data de lançamento -->
                <p class="text-gray-700 dark:text-gray-300">{{ $screening['release_date'] }}</p>
                <!-- Nota do filme -->
                <p class="text-gray-700 dark:text-gray-300">{{ $screening['vote_average'] }}/10</p>
                <!-- Link para mais informações ou comprar ingressos -->
                <a href="#" class="mt-2 inline-block px-4 py-2 bg-coral text-white rounded-full hover:bg-orange-500 transition-colors">
                    Buy Tickets
                </a>
            </div>
        @endforeach
    </div>
</div>

</main>
@endsection
