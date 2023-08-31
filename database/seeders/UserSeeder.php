<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Mia',
            'email' => 'peternak@gmail.com',
            'password' => Hash::make('peternak'),
            'role' => 'peternak',
        ],
        [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('john123'),
            'role' => 'peternak',
        ],
    ]);
    }
}