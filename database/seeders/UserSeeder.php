<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => "Nico Dwi Kuswanto",
                'email' => 'nico@gmail.com',
                'pin' => 12345,
                'role' => 'employee'
            ],
            [
                'name' => "Nico Dwi Kuswanto (BOSS)",
                'email' => 'nicoboss@gmail.com',
                'pin' => 12345,
                'role' => 'boss'
            ]
        ]);
    }
}
