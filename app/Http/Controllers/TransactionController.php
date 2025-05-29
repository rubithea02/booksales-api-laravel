<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource data not found!',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all resources',
            'data' => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validasi input dan cek keberadaan buku
        $validator = Validator::make($request->all(), [
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data'    => $validator->errors()
            ], 422);
        }

        // 2. Generate kode transaksi unik
        $uniqueCode = 'ORD-' . strtoupper(uniqid());

        // 3. Ambil data user yang sedang login melalui API guard
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        // 4. Cari data buku berdasarkan book_id
        $book = Book::find($request->book_id);

        // 5. Cek apakah stok buku mencukupi
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup!'
            ], 400);
        }

        // 6. Hitung total harga (price * quantity)
        $totalAmount = $book->price * $request->quantity;

        // 7. Kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();

        // 8. Simpan transaksi ke database
        $transaction = Transaction::create([
            'order_number'  => $uniqueCode,
            'customer_id'   => $user->id,
            'book_id'       => $request->book_id,
            'total_amount'  => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully!',
            'data'    => $transaction
        ], 201);
    }
}
