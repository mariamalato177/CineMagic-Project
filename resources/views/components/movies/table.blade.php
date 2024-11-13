<div {{ $attributes }}>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($movies->results as $movie)
            <div class="movie-card">
                <h2>{{ $movie->title }}</h2>
                <p>{{ $movie->overview }}</p>
                <a href="{{ route('movies.show', $movie->id) }}">Details</a>  
            </div>
        @endforeach
    </div>
</div>

