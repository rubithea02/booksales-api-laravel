<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Ambil semua data author
        $authors = Author::all();

        // Kirim ke view
        return view('authors.index', compact('authors'));
    }
}
