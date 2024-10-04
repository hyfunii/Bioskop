<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $rooms = [
            ['name' => 'Room 1'],
            ['name' => 'Room 2'],
            ['name' => 'Room 3'],
            ['name' => 'Room 4'],
            // Tambahkan lebih banyak ruang sesuai kebutuhan
        ];

        DB::table('rooms')->insert($rooms);
    }
}
