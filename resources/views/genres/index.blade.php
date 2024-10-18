@extends('layouts.main')

@section('header-title', 'Genres')

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
                <div class="flex items-center gap-4 mb-4">
                    <x-button href="{{ route('genres.create') }}" text="Create a new Genre" />
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($genres as $genre)
                        <div
                            class="px-6 py-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50 truncate">{{ $genre->name }}</h3>
                            <p>Code: {{ $genre->code }}</p>
                            <div class="flex justify-end mt-4 space-x-2">
                                @if (!$genre->hasActiveScreenings())
                                    <form method="POST" action="{{ route('genres.destroy', ['genre' => $genre]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                @else
                                    <p><strong>Active screenings </strong></p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
