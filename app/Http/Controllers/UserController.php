<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Gate;

class UserController extends Controller
{    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('Acceso-Registro-Usuarios')) {
            abort(403);
        }                    
        
        return view('admin.users.index');
    }

    /**
     * Display all genders.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        
        $users = User::all();
        
        return response()->json(['users' => $users ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function getInfo($id)
    {
        $user = User::where('id', $id)->first();
        
        if ( !isset($user->id )) {

            return response()->json(['message' => 'Not Found!', 'exito' => false], 404);
        } else {

            return response()->json(['exito' => true, 'user' => $user->load(['moviesUser', 'moviesUser.gender'])]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMovies(User $user)
    {
        
        if (!Gate::allows('Acceso-Registro-Usuarios')) {
            abort(403);
        }

        return view('admin.users.movies', compact('user'));
    }
}
