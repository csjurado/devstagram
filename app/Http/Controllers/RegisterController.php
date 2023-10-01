<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    //
   
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request) 
    {
        $request->request->add(['username'=>Str::slug($request->username)]);
        // dd($request->get('username'));
        $this->validate($request, [
            'name'=> 'required|min:8',
            'username'=>'required|unique:users|min:5|max:20',
            'email'=> 'required|unique:users|email|max:50',
            // 'password'=>'required'
            'password'=>'required|confirmed'
        ]);
        // Asi voy a crear un modelo 
        User::create([
           
            'name'=> $request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        //* Autenticar un usuario 

        // auth()->attempt([
        //     'email'=>$request->email,
        //     'password'=>$request->password,
        // ]);

        //? Otra forma de autenticar 

        auth()->attempt($request->only('email','password'));

        return redirect()->route('posts.index');

    }
}
