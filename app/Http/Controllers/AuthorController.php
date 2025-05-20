<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Ambil semua data author
        $authors = Author::all();
        return response()->json(
            [
                "success" => true,
                "message" => "Get All Resource",
                "data" => $authors
            ],
            200
        );
        // Kirim ke view
        // return view('authors.index', compact('authors'));
    }
}
