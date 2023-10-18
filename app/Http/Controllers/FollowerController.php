<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(User $user)
    {
       $user->followers()->attach(auth()->user()->id);
       //Utiliza atach apra relazionar la misma tabla 
       return back();
    }


    public function destroy(User $user)
    {
       $user->followers()->detach(auth()->user()->id);
       //Utiliza atach apra relazionar la misma tabla 
       return back();
    }

}
