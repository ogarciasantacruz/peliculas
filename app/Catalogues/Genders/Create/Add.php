<?php

namespace Catalogues\Genders\Create;

use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;
use Arr;
use App\Gender;
use Illuminate\Support\Facades\DB;

class Add
{

    protected $genderData;
    
    public function __construct($request_data)
    {
        $this->genderData = $request_data;
    }

    
    public function validate()
    {
        return $this->genderData->validate([
            'name'         => 'required|unique:genders,name|max:255'
        ]);
    }
    

    public function newGender()
    {   
        
        if ( $this->validate() ) {

            try {

                DB::transaction(function() {

                    Gender::create($this->setup());
                });

                toastr()->success('Se ha registrado un nuevo genero de manera exitosa', 'Generos');
    
                return back();
            
            } catch(Exception $e) {
                
                toastr()->error('Ocurrio un error al registrar el genero en la base de datos, si persiste el problema consulte a su administrador', 'Error');

                return back();

            }

        }

    }


    /**
    * Setup data
    * @return array
    */
    public function setup()
    {
        $data = [];
            
        $data =   Arr::add($data, 'name', $this->genderData['name']);

        return $data;
    }       

}