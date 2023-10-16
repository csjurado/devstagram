<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Pagination;

class Post extends Model
{
    use HasFactory;
   

    protected $fillable =[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function autor (){
        return $this->belongsTo(User::class,'user_id')->select(['name','username']);
    }

    // public function links()
    // {
    //     return $this->paginator()->links();
    // }
    public function comentarios (){
        return $this->hasMany(Comentario::class);
    }
    public function likes (){
        return $this->hasMany(Like::class);
    }
    public function checkLike (User $user){
        return $this->likes->contains('user_id',$user->id);
    }

}
