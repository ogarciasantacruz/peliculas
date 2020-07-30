<?php

namespace Catalogues\Favorites\Update;

use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;
use Arr, Validator, Carbon\Carbon;
use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Adjust
{

    protected $movieData;    
    
    public function __construct($request_data)
    {
        $this->movieData = $request_data;
    }

    
    public function validate()
    {
        
        $validator = Validator::make($this->movieData->all(), [
            'movies'       => 'nullable|array'            
        ]);

        return $validator;
    }
    

    public function updateFavorites()
    {   
        
        $validator = $this->validate();
        
        if ($validator->fails()) {

            $errors = $validator->errors();

            return response()->json(['register' => false, 'errors' => $errors]);

        } else {

            try {

                DB::transaction(function() {

                    $user = Auth::user();

                    $user->moviesUser()->detach();

                    if (isset($this->movieData['movies'])) {

                        foreach($this->movieData['movies'] AS $movie) {

                            $user->moviesUser()->attach([(int) $movie]);
                        }

                    }                    
                    
                });

                toastr()->success('Se ha editado tu catalogo de películas favoritas', 'Películas');
    
                return back();
            
            } catch(Exception $e) {
                
                toastr()->error('Ocurrio un error al editar tu catalogo de favoritos, si persiste el problema consulte a su administrador', 'Error');

                return back();

            }

        }

    }   

}