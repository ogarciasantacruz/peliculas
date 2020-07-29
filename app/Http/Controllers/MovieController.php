<?php

namespace App\Http\Controllers;

use App\Movie, App\Gender;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $genders = Gender::where('status', 'Active')->get();

        return view('admin.movies.index', compact('genders'));
    }


    /**
     * Display all genders.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMovies()
    {
        
        $movies = Movie::all();
        
        return response()->json(['movies' => $movies->load('gender')]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new \Catalogues\Movies\Create\Add($request))->newMovie();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Movie $movie)
    {
        if ( !isset($movie->id )) {

            return response()->json(['exito' => false]);
        } else {

            return response()->json(['exito' => true, 'movie' => $movie]);
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        return (new \Catalogues\Movies\Update\Adjust($request, $movie))->updateMovie();
    }

}
