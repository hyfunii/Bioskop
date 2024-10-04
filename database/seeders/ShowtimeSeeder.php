<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $showtimes = [
            [
                'film_id' => 1,
                'room_id' => 1,
                'showtime' => '2024-10-05 15:00:00',
            ],
            [
                'film_id' => 1,
                'room_id' => 1,
                'showtime' => '2024-10-05 20:00:00',
            ],
            [
                'film_id' => 2,
                'room_id' => 2,
                'showtime' => '2024-10-06 17:00:00',
            ],
            [
                'film_id' => 2,
                'room_id' => 3,
                'showtime' => '2024-10-07 19:00:00',
            ],
            // Tambahkan lebih banyak showtime
            [
                'film_id' => 3,
                'room_id' => 1,
                'showtime' => '2024-10-08 14:00:00',
            ],
            [
                'film_id' => 4,
                'room_id' => 2,
                'showtime' => '2024-10-08 18:00:00',
            ],
            [
                'film_id' => 5,
                'room_id' => 3,
                'showtime' => '2024-10-09 20:00:00',
            ],
            [
                'film_id' => 1,
                'room_id' => 2,
                'showtime' => '2024-10-10 16:00:00',
            ],
            [
                'film_id' => 2,
                'room_id' => 1,
                'showtime' => '2024-10-10 19:00:00',
            ],
            [
                'film_id' => 3,
                'room_id' => 3,
                'showtime' => '2024-10-11 15:30:00',
            ],
            [
                'film_id' => 4,
                'room_id' => 2,
                'showtime' => '2024-10-11 21:00:00',
            ],
            [
                'film_id' => 5,
                'room_id' => 1,
                'showtime' => '2024-10-12 14:30:00',
            ],
            // Tambahkan lebih banyak showtime sesuai kebutuhan
        ];

        DB::table('showtimes')->insert($showtimes);
    }
}
