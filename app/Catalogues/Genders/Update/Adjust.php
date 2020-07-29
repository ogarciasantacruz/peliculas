<?php

namespace Catalogues\Genders\Update;

use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;
use Arr;
use App\Gender;
use Illuminate\Support\Facades\DB;

class Adjust
{

    protected $genderData;
    protected $gender;
    
    public function __construct($request_data, $gender)
    {
        $this->genderData = $request_data;
        $this->gender = $gender;
    }

    
    public function validate()
    {
        return $this->genderData->validate([
            'name'         => 'required|max:255|unique:genders,name,' . $this->gender->id,
            'status'    => [
                'required',
                Rule::in(['Active', 'Suspended']),
            ],
        ]);
    }
    

    public function updateEdition()
    {   
        
        if ( $this->validate() ) {

            try {

                DB::transaction(function() {

                    $this->gender->update($this->setup());
                });

                toastr()->success('Se ha editado la información del genero de manera exitosa', 'Generos');
    
                return back();
            
            } catch(Exception $e) {
                
                toastr()->error('Ocurrio un error al editar el genero en la base de datos, si persiste el problema consulte a su administrador', 'Error');

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
            
        $data =   Arr::add($data, 'name',   $this->genderData['name']);
        $data =   Arr::add($data, 'status', $this->genderData['status']);

        return $data;
    }       

}