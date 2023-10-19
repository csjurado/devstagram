@extends('layouts.app')
@section('titulo')
Pagina Principal
@endsection
@section('contenido')
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
            <div>
                <a href=" {{ route('posts.show',[ 'post' => $post ,'user' => $user ]) }}">
                    {{-- <a href=" #"> --}}
                    <img src="{{asset('uploads').'/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                </a>
            </div>
            @endforeach
        </div>

        <div 
            class="my-10">
                {{$post->links}}
        </div>
    @else
        <p> No hay posts</p>
    @endif
@endsection