<?php

namespace App\Http\Controllers;

use App\Gender;
use Illuminate\Http\Request;
use Gate;

class GenderController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('Acceso-Catalogo-Generos')) {
                abort(403);
            }

            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.genders.index');
    }

    /**
     * Display all genders.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGenders()
    {
        
        $genders = Gender::all();
        
        return response()->json(['genders' => $genders]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (!Gate::allows('Registro-Catalogo-Generos')) {
            abort(403);
        }
        
        return (new \Catalogues\Genders\Create\Add($request))->newGender();
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Gender $gender)
    {
        if ( !isset($gender->id )) {

            return response()->json(['exito' => false]);
        } else {

            return response()->json(['exito' => true, 'gender' => $gender]);
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gender $gender)
    {
        
        if (!Gate::allows('Edicion-Catalogo-Generos')) {
            abort(403);
        }
        
        return (new \Catalogues\Genders\Update\Adjust($request, $gender))->updateEdition();
    }

}
