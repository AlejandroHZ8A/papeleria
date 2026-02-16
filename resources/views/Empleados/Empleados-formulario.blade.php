@extends('layouts.plantilla')

@section('titulo-pagina', 'Crear cuenta de empleado')

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
    <form action="/empleados/mostrar-cuentas" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Rol del
                empleado:</label>
            <select name="rol_id"
                class="block py-2.5 px-0 w-full text-sm text-black bg-transparent
    border-0 border-b-2 border-black-400
    appearance-none focus:outline-none focus:ring-0
    focus:border-white peer">

                <option value="">Seleccione un rol</option>

                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">
                        {{ $rol->nombre_rol }}
                        {{ $rol->sueldo }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Nombres</label>
            <input name="nombre" type="text" id="nombres"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Jose" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido
                materno</label>
            <input name="apellido_m" type="text" id="apellido_materno"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Navarro" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido
                paterno</label>
            <input name="apellido_p" type="text" id="apellido_paterno"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Navarro" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Correo
                electronico</label>
            <input name="correo" type="email" id="correo_electronico"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Navarro@gmail.com" required />
        </div>

        <div class="mb-10">
            <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Usuario</label>
            <input name="usuario" type="text" id="usuario"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="Jose" required />
        </div>´

        <div class="mb-10">
            <label class="block mb-2.5 text-sm font-medium text-white">
                Foto de perfil
            </label>

            <input name="imagen" type="file" accept="image/*"
                class="block m-10 w-full text-sm text-gray-300
               file:mr-4 file:py-2 file:px-4
               file:rounded-full file:border-0
               file:text-sm file:font-semibold
               file:bg-white file:text-gray-800
               hover:file:bg-gray-200" />
        </div>

        <div class="mb-10">
            <label for="password-alternative"
                class="block mb-2.5 text-sm font-medium text-heading text-white">Contraseña</label>
            <input name="contrasena" type="password" id="contrasena_usuario"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="••••••••" required />
        </div>

        <div class="mb-10">
            <label for="password-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white">Confirmar
                contraseña</label>
            <input name="contrasena_confirmar" type="password" id="contrasena_usuario_confirmar"
                class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer"
                placeholder="••••••••" required />
        </div>

        <div class="mb-10 flex items-center">
            <input name="estado_cliente" type="checkbox" id="estado_usuario_activo" value="1"
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded
                  focus:ring-primary-500 focus:ring-2">

            <label for="estado_usuario_activo" class="ml-2 text-sm font-medium text-white">
                Confirmo crear una cuenta nueva
            </label>
        </div>

        <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Crear
            cuenta</button>
    </form>

@endsection
