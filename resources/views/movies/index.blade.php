@extends('layouts.main')

@section('header-title', 'List of Movies')

@section('main')
<div class="container">
    <h1>Movies List</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!empty($movies))
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                            <p class="card-text">{{ $movie['overview'] }}</p>
                            <a href="{{ route('movies.show', $movie['id']) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">No movies found.</div>
    @endif
</div>
@endsection
