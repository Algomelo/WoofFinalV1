<?php

namespace Database\Seeders;
use App\Models\SistemsEmails;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SistemsEmailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = [
            [
                'email' => 'ejemplo1@example.com',
                'comment' => 'Este es un comentario de prueba 1',
                'name' => 'Juan',
                'phone' => '123456789',
                'age' => '30',
                'dogname' => 'Firulais',
                'breed' => 'Labrador',
                'address' => 'Calle 123',
                'service' => 'Paseo',
                'form' => 'landing'
            ],
            [
                'email' => 'ejemplo2@example.com',
                'comment' => 'Este es un comentario de prueba 2',
                'name' => 'María',
                'phone' => '987654321',
                'age' => '25',
                'dogname' => 'Rex',
                'breed' => 'Golden Retriever',
                'address' => 'Avenida XYZ',
                'service' => 'Cuidado de día',
                'form' => 'landing'

            ],
            [
                'email' => 'ejemplo2@example.com',
                'comment' => 'Este es un comentario de prueba 2',
                'name' => 'Fabian',
                'phone' => '987654321',
                'form' => 'contact'

            ],
            [
                'email' => 'ejemplo3@example.com',
                'comment' => 'Este es un comentario de prueba 3',
                'name' => 'Arturo',
                'phone' => '32325346',
                'form' => 'contact'

            ]
            ,
            [
                'email' => 'ejemplo4@example.com',
                'comment' => 'Este es un comentario de prueba 4',
                'name' => 'Santiago',
                'phone' => '1235325',
                'form' => 'contactJob'

            ]
            ,
            [
                'email' => 'ejemplo6@example.com',
                'comment' => 'Este es un comentario de prueba 5',
                'name' => 'Roberto',
                'phone' => '12332527',
                'form' => 'contactJob'

            ]
            // Agrega más datos de prueba según sea necesario
        ];

        foreach ($emails as $emailData) {
            SistemsEmails::create($emailData);
        }
    }
}
