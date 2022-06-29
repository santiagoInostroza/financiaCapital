<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Santiago Inostroza',
            'email' => 'santiagoinostroza2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'usuario 2',
            'email' => 'us@gmail.com',
            'password' => bcrypt('usuario2'),
        ]);

        User::create([
            'name' => 'usuario 3',
            'email' => 'u3@gmail.com',
            'password' => bcrypt('usuario3'),
        ]);

        User::create([
            'name' => 'usuario 4',
            'email' => 'u4@gmail.com',
            'password' => bcrypt('usuario4'),
        ]);

    }
}
