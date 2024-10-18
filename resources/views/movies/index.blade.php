@extends('layouts.main')

@section('header-title', 'List of Movies')

@section('main')
    <div class="flex justify-center flex-wrap">
        <div
            class="w-full my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden  sm:rounded-lg text-gray-900 dark:text-gray-50">
            @can('create', App\Models\Movie::class)
                <div class="flex items-center gap-4 mb-4">
                    <x-button href="{{ route('movies.create') }}" text="Create a new Movie" />
                </div>
            @endcan

            <x-movies.filter-card :genres="$genres->pluck('name', 'code')->toArray()" :genre="old('genre', $filterByGenre)" :title="old('title', $filterByTitle)" :synopsis="old('synopsis', $filterBySynopsis)" :filterAction="route('movies.index')"
                :resetUrl="route('movies.index')" />
            <br>
            <br>
            @can('update', App\Models\Movie::class)
                <x-movies.table :movies="$movies" :showView="true" :showEdit="true" :showDelete="true" />
            @else
                <x-movies.table :movies="$movies" :showView="true" :showEdit="false" :showDelete="false" />
            @endcan

            <div class="mt-4">
                {{ $movies->links() }}
            </div>
        </div>
    </div>
@endsection
