<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            'J.K. Rowling',
            'George R.R. Martin',
            'J.R.R. Tolkien',
            'Agatha Christie',
            'Dan Brown',
        ];

        foreach ($authors as $author) {
            Author::create(['name' => $author]);
        }
    }
}
