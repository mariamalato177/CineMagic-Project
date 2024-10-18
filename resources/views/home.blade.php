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
                        <p class="text-lg">Welcome !</p>
                        <p class="text-lg">You can login <a href="{{ route('login') }}" class="text-coral">here </a>. </p>
                        <p class="text-lg">If you don't have an account..Register <a href="{{ route('register') }}" class="text-coral">here </a>. </p>
                    @endauth
            </h3>
            <div class="flex items-center space-x-4">
                <div>

                </div>
            </div>
        </div>

        <!-- Upcoming Screenings Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Upcoming Screenings</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcomingScreenings as $screening)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">

                        <img src="{{ $screening->movieRef->image_url }}" alt="{{ $screening->movieRef->title }}" class="w-full h-auto object-contain rounded-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $screening->movieRef->title }}</h3>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Date:</strong> {{ $screening->date }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Start Time:</strong> {{ $screening->start_time }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><strong>Theater:</strong> {{ $screening->theaterRef->name }}</p>
                        <a href="{{ route('screenings.show', $screening->id) }}" class="mt-2 inline-block px-4 py-2 bg-coral text-white rounded-full hover:bg-orange-500 transition-colors">
                            Buy Tickets
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Most Sold Screenings Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Most Sold Screenings</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mostSoldScreenings as $screening)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <a href="{{ route('movies.show', $screening->movieRef->id) }}">
                            <img src="{{ $screening->movieRef->image_url }}" alt="{{ $screening->movieRef->title }}" class="w-full h-auto object-contain rounded-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $screening->movieRef->title }}</h3>
                        </a>
                        <p class="text-gray-700 dark:text-gray-300">{{ $screening->movieRef->genre }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $screening->movieRef->year }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
