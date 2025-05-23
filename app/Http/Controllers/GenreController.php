<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // Menampilkan semua genre
    public function index() {
        $genres = Genre::all();

        // Jika tidak ada genre yang ditemukan, kembalikan respons 404
        if ($genres->isEmpty()) {
            return response()->json([
                'success' => false,  // Menandakan bahwa tidak ada data
                'message' => 'No genres found'
            ], 404);  // 404 karena data tidak ditemukan
        }

        // Jika ada genre, kembalikan data dengan respons 200
        return response()->json([
            'success' => true,
            'message' => 'Get all genres',
            'data' => $genres
        ], 200);
    }

    // Menambahkan genre baru
    public function store(Request $request) {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100'
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Membuat genre baru dan menyimpannya ke database
        $genre = Genre::create([
            'name' => $request->name
        ]);

        // Mengembalikan respons dengan data genre yang baru dibuat
        return response()->json([
            'success' => true,
            'message' => 'Genre created successfully',
            'data' => $genre
        ], 201);
    }

    // Menampilkan detail genre berdasarkan ID
    public function show(string $id) {
        $genre = Genre::find($id);

        // Jika genre tidak ditemukan, kembalikan respons 404
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        // Kembalikan respons dengan data genre
        return response()->json([
            'success' => true,
            'message' => 'Get genre details',
            'data' => $genre
        ], 200);
    }

    // Memperbarui data genre berdasarkan ID
    public function update(string $id, Request $request) {
        $genre = Genre::find($id);

        // Jika genre tidak ditemukan, kembalikan respons 404
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100'
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Memperbarui data genre
        $genre->update([
            'name' => $request->name
        ]);

        // Mengembalikan respons dengan data genre yang telah diperbarui
        return response()->json([
            'success' => true,
            'message' => 'Genre updated successfully',
            'data' => $genre
        ], 200);
    }

    // Menghapus genre berdasarkan ID
    public function destroy(string $id) {
        $genre = Genre::find($id);

        // Jika genre tidak ditemukan, kembalikan respons 404
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        // Menghapus genre dari database
        $genre->delete();

        // Mengembalikan respons sukses setelah penghapusan
        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully'
        ], 200);
    }
}
