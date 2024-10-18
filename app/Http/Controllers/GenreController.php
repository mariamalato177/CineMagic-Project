<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Screening;


class GenreController extends Controller
{

    public function index()
    {

        $genres = Genre::all();

        return view('genres.index')->with('genres', $genres);
    }

    public function create()
    {
        $newGenre = new Genre();
        return view('genres.create')->with('genre', $newGenre);
    }

    public function store(Request $request)
    {
        Genre::create($request->all());
        return redirect()->route('genres.index');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index');
    }

}
