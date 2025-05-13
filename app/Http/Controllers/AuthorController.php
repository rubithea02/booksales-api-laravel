<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Mengambil data author dari model Author
        $authors = (new Author)->getAuthors();

        // Mengirim data author ke view
        return view('authors.index', compact('authors'));
    }
}