<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // Menampilkan semua author
    public function index() {
        $authors = Author::all();

        // Jika tidak ada author yang ditemukan, kembalikan respons 404
        if ($authors->isEmpty()) {
            return response()->json([
                'success' => false,  // Menandakan bahwa tidak ada data
                'message' => 'No authors found'
            ], 404);  // 404 karena data tidak ditemukan
        }

        // Jika ada author, kembalikan data dengan respons 200
        return response()->json([
            'success' => true,
            'message' => 'Get all authors',
            'data' => $authors
        ], 200);
    }

    // Menambahkan author baru
    public function store(Request $request) {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string'
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Membuat author baru dan menyimpannya ke database
        $author = Author::create([
            'name' => $request->name,
            'bio' => $request->bio
        ]);

        // Mengembalikan respons dengan data author yang baru dibuat
        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    // Menampilkan detail author berdasarkan ID
    public function show(string $id) {
        $author = Author::find($id);

        // Jika author tidak ditemukan, kembalikan respons 404
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        // Kembalikan respons dengan data author
        return response()->json([
            'success' => true,
            'message' => 'Get author details',
            'data' => $author
        ], 200);
    }

    // Memperbarui data author berdasarkan ID
    public function update(string $id, Request $request) {
        $author = Author::find($id);

        // Jika author tidak ditemukan, kembalikan respons 404
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string'
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Memperbarui data author
        $author->update([
            'name' => $request->name,
            'bio' => $request->bio
        ]);

        // Mengembalikan respons dengan data author yang telah diperbarui
        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    // Menghapus author berdasarkan ID
    public function destroy(string $id) {
        $author = Author::find($id);

        // Jika author tidak ditemukan, kembalikan respons 404
        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }

        // Menghapus author dari database
        $author->delete();

        // Mengembalikan respons sukses setelah penghapusan
        return response()->json([
            'success' => true,
            'message' => 'Author deleted successfully'
        ], 200);
    }
}
