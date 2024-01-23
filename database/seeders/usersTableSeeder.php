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
            'email' => 'admin1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Santiago',
            'email' => 'admin3@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Fernanda',
            'email' => 'admin2@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1024844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'user',
        ]);
        

        User::factory()
        ->count(50)
        
       ->create();
    

    }
}
