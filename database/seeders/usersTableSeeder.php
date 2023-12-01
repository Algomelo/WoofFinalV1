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
            'name' => 'Santiago',
            'email' => 'prueba@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'Santiago',
            'email' => 'prueba2@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        
        User::factory()
        ->count(50)
        
        ->create();
    }
}
