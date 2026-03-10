@extends('layouts.plantilla')

@section('titulo-pagina', 'Crear Cuenta de cliente')

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
    <form action="/clientes/{{ $clientes->id }}/actualizar" method="POST" enctype="multipart/form-data"
        class="max-w-sm mx-auto">
        @csrf
        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Nombre</label>
            <input name="nombres" type="text" id="nombres" value="{{ $clientes->nombres }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Eric" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido
                materno</label>
            <input name="apeliido_m" type="text" id="apellido_materno" value="{{ $clientes->apeliido_m }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Felix" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido
                paterno</label>
            <input name="apellido_p" type="text" id="apellido_paterno" value="{{ $clientes->apellido_p }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Cedillo" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Correo
                electronico</label>
            <input name="correo" type="email" id="correo_electronico" value="{{ $clientes->correo }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Navarro@gmail.com" required />
        </div>

        <div class="mb-10">
            <label for="password-alternative"
                class="block mb-2.5 text-sm font-medium text-heading text-white">Contraseña</label>
            <input name="contrasena" type="password" id="contrasena_usuario" value="{{ $clientes->contrasena }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent 
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="••••••••" required />
        </div>

        <div class="mb-10">
            <label class="block mb-2.5 text-sm font-medium text-white">
                Foto de perfil
            </label>
            @if ($clientes->imagen)
                <div class="mb-6">
                    <p class="text-sm text-white mb-2">Imagen actual:</p>
                    <img src="{{ asset($clientes->imagen) }}"
                        class="w-32 h-32 object-cover rounded-full border border-gray-400">
                </div>
            @endif
            <input name="imagen" type="file" accept="image/*"
                class="block m-10 w-full text-sm text-gray-300
               file:mr-4 file:py-2 file:px-4
               file:rounded-full file:border-0
               file:text-sm file:font-semibold
               file:bg-white file:text-gray-800
               hover:file:bg-gray-200" />
        </div>

        <div class="mb-10">
            <label for="numero-interior" class="block mb-2.5 text-sm font-medium text-heading text-white">
                estado
            </label>
            <input name="estado" type="text" id="estado_usuario" value="{{ $clientes->estado }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
               border-0 border-b-2 border-gray-400
               appearance-none focus:outline-none focus:ring-0
               focus:border-white peer
               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                placeholder="Jalisco" />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Calle
            </label>
            <input name="calle" type="text" id="calle_usuario" value="{{ $clientes->calle }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Santa monica" required />
        </div>

        <div class="mb-10">
            <label for="numero-interior" class="block mb-2.5 text-sm font-medium text-heading text-white">
                Numero exterior
            </label>
            <input name="num_ext" type="number" id="numero-exterior" value="{{ $clientes->num_ext }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
               border-0 border-b-2 border-gray-400
               appearance-none focus:outline-none focus:ring-0
               focus:border-white peer
               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                placeholder="38" />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Numero
                interior</label>
            <input name="num_int" type="number" id="numero_interior" value="{{ $clientes->num_int }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer
               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                placeholder="5" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Codigo
                postal</label>
            <input name="cp" type="number" id="codigo_postal" value="{{ $clientes->cp }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer
               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                placeholder="53812" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative"
                class="block mb-2.5 text-sm font-medium text-heading text-white ">Ciudad</label>
            <input name="ciudad" type="text" id="ciudad_usuario" value="{{ $clientes->ciudad }}"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Guadalajara" required />
        </div>

        <div class="mb-10 flex items-center">
            <input name="estado_cliente" type="checkbox" id="estado_usuario_activo" value="1"
                {{ $clientes->estado_cliente == 1 ? 'checked' : '' }}
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded
                  focus:ring-primary-500 focus:ring-2">

            <label for="estado_usuario_activo" class="ml-2 text-sm font-medium text-white">
                Cliente activo/Inactivo
            </label>
        </div>

        <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">
            Actualizar cuenta</button>
    </form>

@endsection
