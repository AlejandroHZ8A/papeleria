@extends('layouts.plantilla')

@section('titulo-pagina', 'Nuevo tipo de empleado')

@section('contenido')
    @if ($errors->any())
        <div class="mb-6 text-red-500 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/empleados/tipo-empleado/{{ $roles->id }}/actualizar" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Nombre del rol</label>
            <input name="nombre_rol" type="text" id="nombres" value="{{ $roles->nombre_rol }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Admin.." required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Sueldo</label>
            <input name="sueldo" type="text" id="apellido_materno" value="{{ $roles->sueldo }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="20000" required />
        </div>

        <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Crear
            nuevo tipo de empleado</button>
    </form>

@endsection