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
        $admin = User::create([
            'name'            => 'Alejandro',
            'last_name'       => 'García Santacruz',
            'email'           => 'ogarciasantacruz@gmail.com',
            'password'        => bcrypt('Al3x39722#'),
        ]);

        // Administrador
        $admin->roles()->attach(1);
    }
}
