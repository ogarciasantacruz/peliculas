<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::Create([
            'name'          => "Administrador",
            'description'   => "Permisos de administrador"
        ]);

        Role::Create([
            'name'          => "Cliente",
            'description'   => "Solo tiene permiso de registrar sus películas favoritas"
        ]);
    }
}
