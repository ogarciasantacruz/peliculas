<?php

use Illuminate\Database\Seeder;
use App\Permission, App\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions= collect([
            ['group' => 'Generos',          'name' => 'Acceso-Catalogo-Generos',         'description'=> 'Permiso para acceder al catalogo de generos'],
            ['group' => 'Generos',          'name' => 'Registro-Catalogo-Generos',       'description'=> 'Permiso para registrar un nuevo genero'],
            ['group' => 'Generos',          'name' => 'Edicion-Catalogo-Generos',        'description'=> 'Permiso para editar un genero'],            

            ['group' => 'Peliculas',        'name' => 'Acceso-Catalogo-Peliculas',       'description'=> 'Permiso para acceder al catalogo de películas'],
            ['group' => 'Peliculas',        'name' => 'Registro-Catalogo-Peliculas',     'description'=> 'Permiso para registrar una nueva película'],
            ['group' => 'Peliculas',        'name' => 'Edicion-Catalogo-Peliculas',      'description'=> 'Permiso para editar una película'],

            ['group' => 'Favoritos',        'name' => 'Edicion-Catalogo-Favoritos',      'description'=> 'Permiso para ingresar y editar las películas favoritas'],
        ]);


        
        $permissions->each(function($permission, $value){
            Permission::create([
                'group'         => $permission['group'],
                'name'          => $permission['name'],
                'description'   => $permission['description']                
            ]);
        });


        //Administrador
        $role = Role::whereName('Administrador')->first();
        $permissions = Permission::where('name', '!=', 'Edicion-Catalogo-Favoritos')->get();
        
        foreach($permissions as $permission) {
 
            $role->givePermissionTo($permission);

        }

        //Client
        $role = Role::whereName('Cliente')->first();
        $permissions = Permission::where('name', 'Edicion-Catalogo-Favoritos')->get();
        
        foreach($permissions as $permission) {
 
            $role->givePermissionTo($permission);

        }


    }
    
}
