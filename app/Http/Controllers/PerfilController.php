<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PerfilController extends Controller
{
    //
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index()  
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);
        // Esta funcion crea el slug del username del usuario ; 
        $this->validate($request,[
            'username'=>['required','unique:users','min:5','max:20','not_in:twitter,editar-perfil'],
            // 'username'=>['required','unique:users','min:5','max:20','not_in:twitter,editar-perfil','in:CLIENTE'],
            // si voy a utilizar mas de 3 validaciones es recomendable colocarlo en un arreglo 
        ]);
        if($request->imagen){
            $imagen = $request ->file('imagen');
            $nombreImagen = Str::uuid().".".$imagen->extension(); 
            //? El codigo de arriba lo que hace es generar que la imagen de subida tenga un nombre unico para nuestro servidor 
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $imagennombreImagen ?? auth()->user()->imagen ?? null;
        //? El codigo de arriba lo que haces es revisar, si hay una imagen la deja si no, la deja vacia
        $usuario->save();

        return redirect()->route('posts.index',$usuario->username);
    }
}
