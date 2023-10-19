<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {

        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $user = auth()->user()->username;
        // dd($user);
        $posts = Post::whereIn('user_id', $ids)->paginate(20);
        return view('home',[
            'posts'=>$posts,
            'user'=>$user,
        ]);
    }
}
