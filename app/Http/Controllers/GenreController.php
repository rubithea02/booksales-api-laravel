<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use GrahamCampbell\ResultType\Success;

class GenreController extends Controller
{
    public function index()
    {
        // Mengambil data genre dari model Genre
        $genres = (new Genre)->getGenres();

        // Mengirim data genre ke view 'genres.index'
        return response()->json(
            [
                "success" => true,
                "message" => "Get All Resource",
                "data" => $genres
            ],
            200
        );
    }
}
