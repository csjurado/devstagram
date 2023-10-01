<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite('resources/css/app.css')
       
    </head>
    <body class="bg-gray-100">
       <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-3xl font-black"> DevStagram </h1>


            {{-- ! Inicio Este espacio vamos a verificar la autenticacion  --}}
            {{-- @if (auth()->user())
                <p> Autenticado </p>
            @else
                <p> No Autenticado </p>
            @endif --}}
            @auth
            <nav class="flex gap-2 items-center">
                <a class="font-bold  text-gray-600 text-sm" href="{{ route('login') }}"> 
                    Hola  
                    <spam class="font-normal"> 
                        {{ auth()->user()->username}} 
                    </spam>
                </a>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button  type="submit" class="font-bold uppercase text-gray-600 text-sm" href="{{ route('logout') }}">Cerrar Sesión</button>
                </form>
                
            </nav>
            @endauth
            @guest
                {{-- <p> No Autenticado </p> --}}

                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            @endguest
            {{-- ! fin Este espacio vamos a verificar la autenticacion  --}}
           
        </div>
       </header>
       <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10"> @yield('titulo')</h2>
            @yield('contenido')
       </main>
       <footer class="mt-10 text-center p-5 text-gray-500 font-bold">
        DevStagram - Todos los derechos reservados 
        {{now()->year}}
       </footer>
       {{-- <?php echo date('Y'); ?> --}}
    </body>
</html>