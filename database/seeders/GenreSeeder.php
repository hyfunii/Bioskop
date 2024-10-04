<?php

namespace Database\Seeders;

use App\Models\Genre;
use DB;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Drama'],
            ['name' => 'Comedy'],
            ['name' => 'Horror'],
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Documentary'],
        ];

        DB::table('genres')->insert($genres);
    }
}
