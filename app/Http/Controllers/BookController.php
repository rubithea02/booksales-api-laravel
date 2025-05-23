<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::all();

        if ($books->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No books found",
            ], 200); // 200 OK, karena permintaan berhasil meski tidak ada data
        }

        return response()->json([
            "success" => true,
            "message" => "Get all books",
            "data" => $books
        ], 200);
    }

    // Menambahkan buku baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        // Cek validasi error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Upload gambar sampul
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // Insert data buku
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);

        // Respons setelah berhasil menambahkan data
        return response()->json([
            'success' => true,
            'message' => 'Book added successfully!',
            'data' => $book
        ], 201);
    }

    // Menampilkan detail buku berdasarkan ID
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404); // 404 karena data tidak ditemukan
        }

        return response()->json([
            'success' => true,
            'message' => 'Get book details',
            'data' => $book
        ], 200);
    }

    // Menghapus buku berdasarkan ID
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404); // 404 karena data tidak ditemukan
        }

        // Hapus gambar sampul jika ada
        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        // Hapus data buku
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ], 200); // 200 karena penghapusan berhasil
    }

    // Memperbarui data buku berdasarkan ID
    public function update(string $id, Request $request)
    {
        // Cari data buku
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404); // 404 karena data tidak ditemukan
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        // Cek validasi error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Siapkan data untuk update
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

        // Jika ada file gambar baru, proses upload dan hapus gambar lama
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            // Hapus gambar lama jika ada
            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            // Tambahkan gambar baru ke data
            $data['cover_photo'] = $image->hashName();
        }

        // Update data buku
        $book->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully!',
            'data' => $book
        ], 200); // 200 OK setelah data berhasil diperbarui
    }
}
