@extends('layouts.main')

@section('header-title', 'Movie Details')

@section('main')
<div style="padding-left: 50px; padding-right: 50px;">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-2xl mx-auto">
        <div class="flex items-center justify-center mb-4">
            <img src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'] : asset('storage/posters/_no_poster_1.png') }}"
                 alt="{{ $movie['title'] }}" 
                 class="rounded-lg shadow-md w-48 md:w-64" 
                 style="border: 4px solid #e2e8f0;">
        </div>
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $movie['title'] }}</h2>
            <p class="text-gray-500 italic mb-4">{{ $movie['overview'] ?? 'No synopsis available.' }}</p>
            <p class="text-gray-600 mb-2">
                <strong>Genre:</strong> {{ $movie['genre_names'] ?? 'Unknown genre' }}
            </p>
            <p class="text-gray-600">
                <strong>Release Year:</strong> {{ $movie['release_date'] ? \Carbon\Carbon::parse($movie['release_date'])->year : 'N/A' }}
            </p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Reviews</h3>
        
        @forelse($reviews as $review)
            <div class="mb-6 p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                <p class="italic text-gray-700 mb-2">{{ $review['content'] }}</p>
                <p class="text-sm text-gray-500 text-right">- {{ $review['author'] }}</p>
            </div>
        @empty
            <p class="text-center text-gray-600">No reviews available for this movie.</p>
        @endforelse

        @if($reviews->isNotEmpty() || !$reviews->onFirstPage())
            <div class="mt-6">
                <div class="flex justify-center">
                    <div class="flex items-center">
                        @if($reviews->onFirstPage())
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md cursor-not-allowed" disabled>
                                &laquo; Previous
                            </button>
                        @else
                            <a href="{{ $reviews->previousPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-400 transition">
                                &laquo; Previous
                            </a>
                        @endif

                        <span class="mx-2 text-sm text-gray-600">
                            Page {{ $reviews->currentPage() }} of {{ $reviews->lastPage() }}
                        </span>

                        @if($reviews->isNotEmpty() && $reviews->hasMorePages())
                            <a href="{{ $reviews->nextPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-400 transition">
                                Next &raquo;
                            </a>
                        @else
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md cursor-not-allowed" disabled>
                                Next &raquo;
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
