<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Administrador
        $admin = User::create([
            'name'            => 'Alejandro',
            'last_name'       => 'García Santacruz',
            'email'           => 'admin@demo.com',
            'password'        => bcrypt('abcd1234'),
        ]);

        $admin->roles()->attach(1);

        // Client
        $client = User::create([
            'name'            => 'Pedro',
            'last_name'       => 'Paramo',
            'age'             => 15,
            'phone'           => "442 2121 212",
            'email'           => 'user@demo.com',
            'password'        => bcrypt('abcd1234'),
        ]);

        $client->roles()->attach(2);
    }
}
