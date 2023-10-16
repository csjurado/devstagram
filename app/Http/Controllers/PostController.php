<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Illuminate\Pagination\Pagination;
use Illuminate\Support\Facades\File as FacadesFile;

class PostController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    
    public function index(User $user){

        // dd($user->id);
        //dd($user);
        //! Asi se consigue las propiedades de un objeto en este caso primero se llama al Modelo 
        $post = Post::query()->where('user_id', $user->id)->paginate(20);
        // $paginator = $post->paginator();
        
        return view('dashboard',[
            'user'=> $user,
            'post'=>$post,
            //'paginator'=>$paginator, //Estoy pasando la varaible $post sin s 
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
       $this->validate($request,[
        'titulo'=>'required|max:255',
        'descripcion'=>'required',
        'imagen'=>'required'
       ]);

        //! Forma original de crear registros 
    //    Post::create([
    //     'titulo'=>$request->titulo,
    //     'descripcion'=>$request->descripcion,
    //     'imagen'=>$request->imagen,
    //     'user_id'=>auth()->user()->id,
    //    ]);

       //! 1era otra forma de crear registros 
    //    $post = new Post; 
    //    $post -> titulo = $request->titulo;
    //    $post -> descripcion = $request->descripcion;
    //    $post -> imagen = $request->imagen;
    //    $post -> user_id = auth()->user()->id;
    //    $post->save();

     //! 2da otra forma de crear registros 
     $request -> user()->posts()->create([
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id,
     ]);


       return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user, Post $post){

        return view('posts.show',[
            'post'=>$post,
            'user'=>$user,
        ]);
    }
    public function destroy (Post $post){
        // if($post->user_id === auth()->user()->id){
        //     dd('Si es el mismo usuario');
        // }
        // else{
        //    dd( 'No es el mismo usuario');
        // }
        $this->authorize('delete',$post);
        $post->delete();

        // toDO Eliminar la imagen 

        $imagen_path = public_path('uploads/'.$post->imagen);
        if(FacadesFile::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
