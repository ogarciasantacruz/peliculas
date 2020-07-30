<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $movies = Movie::where('status', 'Active')->get();
        $user = Auth::user();
        $favorites = $user->moviesUser;

        $favorites = $favorites->pluck('id')->all();

        return view('admin.home', compact('movies', 'favorites'));
    }
}
