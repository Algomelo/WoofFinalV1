<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fabian',
            'email' => 'admin3@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1021744764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        
        User::factory()
        ->count(30)
        ->create();
    }
}
