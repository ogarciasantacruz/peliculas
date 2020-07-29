<?php

namespace Catalogues\Movies\Update;

use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;
use Arr, Validator, Carbon\Carbon;
use App\Movie;
use Illuminate\Support\Facades\DB;

class Adjust
{

    protected $movieData;
    protected $movie;
    
    public function __construct($request_data, $movie)
    {
        $this->movieData = $request_data;
        $this->movie = $movie;
    }

    
    public function validate()
    {
        
        $validator = Validator::make($this->movieData->all(), [
            'title'             => 'required|max:255|unique:movies,title,' . $this->movie->id,
            'gender'            => 'required|exists:genders,id',
            'release_date'      => 'required|date_format:d/m/Y',
            'description'       => 'required',
            'status'    => [
                'required',
                Rule::in(['Active', 'Suspended']),
            ],
        ]);

        return $validator;
    }
    

    public function updateMovie()
    {   
        
        $validator = $this->validate();
        
        if ($validator->fails()) {

            $errors = $validator->errors();

            return response()->json(['register' => false, 'errors' => $errors]);

        } else {

            try {

                DB::transaction(function() {

                    $this->movie->update($this->setup());
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
        $data =   Arr::add($data, 'status',         $this->movieData['status']);

        return $data;
    }       

}