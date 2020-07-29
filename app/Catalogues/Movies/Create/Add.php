<?php

namespace Catalogues\Movies\Create;

use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;
use Arr, Validator, Carbon\Carbon;
use App\Movie;
use Illuminate\Support\Facades\DB;

class Add
{

    protected $movieData;
    
    public function __construct($request_data)
    {
        $this->movieData = $request_data;
    }

    
    public function validate()
    {
        
        $validator = Validator::make($this->movieData->all(), [
            'title'             => 'required|unique:movies,title|max:255',
            'gender'            => 'required|exists:genders,id',
            'release_date'      => 'required|date_format:d/m/Y',
            'description'       => 'required'
        ]);

        return $validator;
    }
    

    public function newMovie()
    {   
        
        $validator = $this->validate();
        
        if ($validator->fails()) {

            $errors = $validator->errors();

            return response()->json(['register' => false, 'errors' => $errors]);

        } else {
        

            try {

                DB::transaction(function() {

                    Movie::create($this->setup());
                });

                return response()->json(['register' => true]);
            
            } catch(Exception $e) {
                
                return response()->json(['register' => false]);

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
            
        $data =   Arr::add($data, 'title',          $this->movieData['title']);
        $data =   Arr::add($data, 'gender_id',      $this->movieData['gender']);
        $data =   Arr::add($data, 'release_date',   Carbon::createFromFormat('d/m/Y', $this->movieData['release_date']));
        $data =   Arr::add($data, 'description',    $this->movieData['description']);

        return $data;
    }       

}