<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function store(Request $request, Post $post)  {
        
        $post->likes()->create([
            'user_id'=> $request->user()->id,
        ]);

        return back();
        // return view('dashboard',[
        //     'post'=>$post,
        //     //'paginator'=>$paginator, //Estoy pasando la varaible $post sin s 
        // ]);
    }
    public function destroy (Request $request, Post $post){
        $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
    }
}
