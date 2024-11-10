@extends('layouts.main')

@section('header-title', 'List of Movies')

@section('main')
<div class="container"  style="padding-left: 50px; padding-right: 50px;">
    <!-- <h1>Movies List</h1> -->

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!empty($movies))
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 gap-y-12 mt-12">
                @foreach($movies as $movie)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img class="rounded-lg shadow-md ease-in-out duration-300 hover:opacity-50" src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                            <div class="text-center">
                                <h5 class="card-title">{{ $movie['title'] }}</h5>
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
