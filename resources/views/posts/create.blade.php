@extends('layouts.app')
@section('titulo')
 Crea un nueva Publicacion
@endsection

@push('styles')
    <link 
    rel="stylesheet" 
    href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" 
    type="text/css" 
    />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form 
        id="dropzone"
        action="{{ route('imagenes.store') }}" 
        method="POST"
        enctype="multipart/form-data"
        class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
        {{-- class="dropzone"> --}}
        @csrf
        </form>
        <script src="https://unpkg.com/dropzone@5.7.0/dist/dropzone.js"></script>
        <script>
            Dropzone.options.dropzone = {
                url: "{{ route('imagenes.store') }}",
                dictDefaultMessage : "Sube aqui tu imagen",
                acceptedFiles : ".png,.jpg,.jpeg,.gif",
                addRemoveLinks: true,
                dictRemoveFile : "Borrar Archivo",
                maxFiles : 1,
                uploadMultiple: false,
                previewsContainer: '#dropzone',
                init:function(){
                   if(document.querySelector('[name="imagen"]').value.trim()) {
                        const imagenPublicada = {}
                        imagenPublicada.size = 1234;
                        imagenPublicada.name = document.querySelector('[name="imagen"]').value;

                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.addedfile.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`);

                        imagenPublicada.previewElement.classList.add('dz-success','dz-complete')
                   }
                },

                
                // sending:function(file,xhr,formData){
                //     console.log(formData);
                // },
                success: function(file, response) {
                  console.log(response.imagen);
                  document.querySelector('[name="imagen"]').value = response.imagen;
                },
                // error: function(file, message) {
                //     console.log(message);
                // },
                removedfile: function() {
                    document.querySelector('[name="imagen"]').value ="";
                },
            };
            
        </script>
    </div>
    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        <form action="{{route('posts.store')}}" method="POST" novalidate>
            @csrf
                {{-- Este es el input del nombre  --}}
            <div class="mb-5 ">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold"> 
                    Título 
                </label>
                <input id="titulo" name="titulo" type="text" placeholder="Titulo de la Publicacion " class="border p-3 w-full rounded-lg 
                @error('name') border-red-500
                @enderror"
                value="{{old('titulo')}}"/>
                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p>
                @enderror
            </div>

            {{-- Este es el input de la descripcion  --}}
            <div class="mb-5 ">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold"> 
                    Descripción  
                </label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la Publicacion" class="border p-3 w-full rounded-lg 
                @error('name') border-red-500
                @enderror"
                > {{old('descripcion')}} </textarea>
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p>
                @enderror
            </div>

            {{-- Este es el input de la imagen  --}}
            <div class="mb-5">
                <input 
                name="imagen"
                type="hidden"
                value="{{old('imagen')}}"
                />
                @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}} </p>
            @enderror

            </div>

            <input type="submit" value="Crear Publicacion" class="bg-sky-600 hover:bg-sky-700 transition-colors 
            cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>

        </form>
    </div>
</div>

@endsection