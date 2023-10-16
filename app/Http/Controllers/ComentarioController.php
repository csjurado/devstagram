<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //

    public function store (Request $request, User $user,Post $post){
        // dd($post->id);
        //toDO  Validar 
        $this -> validate($request,[
            'comentario'=>'required|max:255',
        ]);
        //toDo almacenar resultado
        Comentario::create([
            'user_id'=> auth()->user()->id, 
            'post_id'=>$post->id,
            'comentario'=> $request->comentario,
        ]);
        //toDo Imprimir mensaje

        return back()->with('mensaje','Comentario realizado Correctamente');
        //? Este mensaje se lo imprime en una session que se encuentra en el show.blade
    }
  
}
