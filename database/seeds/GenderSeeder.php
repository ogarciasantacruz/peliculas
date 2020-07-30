<?php

use Illuminate\Database\Seeder;
use App\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = collect([
            ['name' => 'Drama'],
            ['name' => 'Comedia'],
            ['name' => 'Terror'],
            ['name' => 'Documental'],
            ['name' => 'Ciencia ficción'],
            ['name' => 'Anime'],
            ['name' => 'Acción'],
            ['name' => 'Romance'],
            ['name' => 'Suspenso']
        ]);


        
        $genders->each(function($gender, $value){
            Gender::create([
                'name'         => $gender['name'],                
            ]);
        });
    }
}
