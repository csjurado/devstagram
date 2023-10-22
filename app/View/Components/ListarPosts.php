<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPosts extends Component
{
    public $posts;
    public $user;

    public function __construct($posts,$user)
    {
        //
        $this->posts = $posts; 
        $this->user = $user; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-posts');
    }
}
