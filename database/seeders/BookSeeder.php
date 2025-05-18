<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::insert([
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'A Game of Thrones', 'author_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Hobbit', 'author_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Murder on the Orient Express', 'author_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Da Vinci Code', 'author_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);        
    }
}
