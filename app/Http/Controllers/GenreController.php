<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        // Mengambil data genre dari model Genre
        $genres = (new Genre)->getGenres();

        // Mengirim data genre ke view 'genres.index'
        return view('genres.index', compact('genres'));
    }
}