<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NuevoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fabian',
            'email' => 'admin6@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1023244764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        
        User::factory()
        ->count(50)
        ->create();
    }
}
