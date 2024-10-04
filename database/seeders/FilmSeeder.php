<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $films = [
            [
                'name' => 'Inception',
                'genre_id' => 1,
                'director' => 'Christopher Nolan',
                'synopsis' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
                'duration' => 148,
            ],
            [
                'name' => 'The Shawshank Redemption',
                'genre_id' => 2,
                'director' => 'Frank Darabont',
                'synopsis' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
            ],
            // Tambahkan lebih banyak film
            [
                'name' => 'The Dark Knight',
                'genre_id' => 1,
                'director' => 'Christopher Nolan',
                'synopsis' => 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.',
                'duration' => 152,
            ],
            [
                'name' => 'Pulp Fiction',
                'genre_id' => 3,
                'director' => 'Quentin Tarantino',
                'synopsis' => 'The lives of two mob hitmen, a boxer, a gangster’s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'duration' => 154,
            ],
            [
                'name' => 'The Godfather',
                'genre_id' => 4,
                'director' => 'Francis Ford Coppola',
                'synopsis' => 'An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.',
                'duration' => 175,
            ],
            // Tambahkan lebih banyak film sesuai kebutuhan
        ];

        DB::table('films')->insert($films);
    }
}
