<!--Herencia de palntillas se usa los estilos base -->
@extends('layouts.app')

<!--Se inyectara todo lo de este archivo dentro de @yiedl-->
@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Mensajes de  error/exito -->
    <!--Busca en la session si exite una clave llamada success si es asi muestra el  mensaje-->
    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg shadow-lg flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-white font-bold">&times;</button>
        </div>
    @endif

   
    <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-gray-700">
        <h2 class="text-2xl font-bold  mb-4 flex items-center gap-2">
             Registra a un animal nuevo
        </h2>
    <!--Usamo post por que creamos un nuevo animal -->
        <form action="{{ route('animales.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <!--para proteger el envio de datos -->
            @csrf
        <!--cuerpo del formulario-->
                <!--Campo Nombre-->
            <div class="flex flex-col">
                <label for="name"class="text-sm font-semibold text-gray-300 mb-1"></label>
                    <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded text-white focus:outline-none focus:border-yellow-500"
                       placeholder="Nombre" required>
            </div>
              <div class="flex flex-col">
                <label for="age" class="text-sm font-semibold text-gray-300 mb-1"></label>
                <input type="number" id="age" name="age"
                        value="{{ old('age') }}"
                       class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded text-white focus:outline-none focus:border-yellow-500"
                       placeholder="Edad" required>
              </div>

             <div class="flex flex-col">
                <label for="species" class="text-sm font-semibold text-gray-400 mb-1"></label>
                <select name="species" id="species" 
                        class="w-full bg-slate-700 border border-slate-600 text-white rounded px-3 py-2 focus:outline-none focus:border-yellow-500 transition cursor-pointer"
                        required>
                    <option value="" disabled selected>Seleccionar...</option>
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Ave">Ave</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <!--Botón se envía el formulario-- -->
            <div class="pt-2 flex justify-start">
                <button type="submit"class="px-5 py-2  font-semibold  mb-1 border border-fuchsia-400 text-fuchsia-400 hover:bg-fuchsia-400 hover:text-gray-900 rounded-md text-sm font-semibold transition">
                    Registrar
                </button>
            </div>
        </form>
                       
    </div>
         
    
 

    <!--La lista de animales -->
    <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-gray-700">
        <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-4">
            <h2 class="text-xl font-bold text-white">Mis Animales Registrados</h2>
            <span class="text-sm text-gray-400">{{ count($animales) }} registros</span>
        </div>

        @if(count($animales) === 0)
            <!--Si esta vacia la lista muestra un mensaje-->
            <div class="text-center py-10">
                <div class="text-6xl mb-4 opacity-50"></div>
                <p class="text-gray-400 text-lg">No hay animales registrados aún.</p>
                <p class="text-gray-500 text-sm">Registra uno y lo verás aquí.</p>
            </div>
        @else
            <!--Sino mostar la lista -->
            <ul class="space-y-3">
            <!--Recorre el array para tomar el animal actual en cada iteración-->
                @foreach($animales as $animal)
                <li class="flex items-center justify-between bg-gray-700 hover:bg-gray-600 p-4 rounded-lg transition group">
                    <!-- Info del Animal -->
                    <div class="flex items-center gap-4">
                        <div class="capitalize">
                          <h3>{{ $animal['name'] ?? $animal['nombre'] ?? 'Sin nombre' }}</h3>  
                          <p>{{ $animal['species'] ?? $animal['especie'] ?? 'Sin especie' }}</p>  
                          <h3>{{ $animal['age'] ?? $animal['edad'] ?? 0 }} años</h3>

                        </div>
                    </div>

                 
                    <div class="flex space-x-3">
                        <!-- Botón Editar se envia el id  -->
                        <a href="{{ route('animales.edit', $animal['id']) }}" 
                           class="px-3 py-1 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 rounded-md text-sm font-semibold transition">
                            Editar
                        </a>
                        
                        <!-- Botón Eliminar -->
                        <form action="{{ route('animales.destroy', $animal['id']) }}" method="POST" class="inline">
                        <!--token de seguridad y la directiva de simulación delete-->
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-md text-sm font-semibold transition"
                                    onclick="return confirm('¿Eliminar a {{ $animal['name'] ?? $animal['nombre'] ?? 'este animal' }}?')">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection