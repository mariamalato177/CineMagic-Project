<div {{ $attributes }}>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($movies->results as $movie)  <!-- Use -> em vez de [] -->
            <div class="movie-card">
                <h2>{{ $movie->title }}</h2>  <!-- Use -> em vez de [] -->
                <p>{{ $movie->overview }}</p> <!-- Use -> em vez de [] -->
                <a href="{{ route('movies.show', $movie->id) }}">Detalhes</a>  <!-- Use -> em vez de [] -->
            </div>
        @endforeach
    </div>
</div>

