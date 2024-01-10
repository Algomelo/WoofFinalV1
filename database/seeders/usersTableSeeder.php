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
            'email' => 'admin2@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Santiago',
            'email' => 'admin1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Fernanda',
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
            'cedula' => '1020844764',
            'address' => 'av chile',
            'phone' => '+573057202110',
            'role' => 'admin',
        ]);
        
            /**
   *User::factory()
    *    ->count(50)
        
     *   ->create();
     */

    }
}
