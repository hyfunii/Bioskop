<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Hyfunii',
                'email' => 'adm@gg.com',
                'role' => 'admin',
                'password' => bcrypt('123123123'),
            ],
            [
                'name' => 'hifnyy',
                'email' => 'user1@gg.com',
                'role' => 'user',
                'password' => bcrypt('123123123'),
            ],
            [
                'name' => 'fnyy',
                'email' => 'user2@gg.com',
                'role' => 'user',
                'password' => bcrypt('123123123'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
