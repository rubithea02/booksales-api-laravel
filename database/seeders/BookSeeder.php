<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'description' => 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible dark wizard who killed his parents.',
            'price' => 50000,
            'stock' => 50,
            'cover_photo' => 'harry_potter.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ]);
        
        Book::create([
            'title' => 'The Hobbit',
            'description' => 'A hobbit embarks on a quest to reclaim a stolen treasure from a dragon, encountering goblins, elves, and a shape-shifting bear along the way.',
            'price' => 45000,
            'stock' => 30,
            'cover_photo' => 'the_hobbit.jpg',
            'genre_id' => 1,
            'author_id' => 2,
        ]);
        
        Book::create([
            'title' => 'Pride and Prejudice',
            'description' => 'Elizabeth Bennet navigates societal expectations, romance, and family drama while falling in love with the proud and wealthy Mr. Darcy.',
            'price' => 60000,
            'stock' => 40,
            'cover_photo' => 'pride_prejudice.jpg',
            'genre_id' => 2,
            'author_id' => 3,
        ]);
        
        Book::create([
            'title' => '1984',
            'description' => 'In a dystopian society ruled by an oppressive government, Winston Smith seeks truth and freedom while questioning his loyalty to the regime.',
            'price' => 55000,
            'stock' => 60,
            'cover_photo' => '1984.jpg',
            'genre_id' => 3,
            'author_id' => 4,
        ]);
        
        Book::create([
            'title' => 'The Great Gatsby',
            'description' => 'A young man named Nick Carraway tells the story of the mysterious Jay Gatsby, whose obsession with love leads to tragedy in the Roaring Twenties.',
            'price' => 70000,
            'stock' => 20,
            'cover_photo' => 'great_gatsby.jpg',
            'genre_id' => 2,
            'author_id' => 5,
        ]);
             
    }
}
