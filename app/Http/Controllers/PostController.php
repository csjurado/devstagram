<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user){

        // dd($user->username);
        //dd($user);
        //! Asi se consigue las propiedades de un objeto en este caso primero se llama al Modelo 
        return view('dashboard',[
            'user'=> $user,
        ]);
    }
}
