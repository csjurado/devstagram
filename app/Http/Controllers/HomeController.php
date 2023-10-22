<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Esta funciona menciona que si no esta autnticado te redirija a la pantalla principal 


    public function __invoke()
    {

        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $user = auth()->user()->username;
        // dd($user);
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home',[
            'posts'=>$posts,
            'user'=>$user,
        ]);
    }
}
