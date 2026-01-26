@extends('layouts.plantilla-usuarios')

@section('titulo-pagina', 'Crear-Cuenta-Usuario')

@section('contenido')

<form class="max-w-sm mx-auto">
  <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Rol del empleado:</label>
  <select id="countries" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent
       border-0 border-b-2 border-black-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer">
    <option selected>Empleado de mostrador</option>
    <option value="US">Administador</option>
    <option value="CA">Ventas</option>
    <option value="FR">Proveedor</option>
    <option value="DE">Materialista</option>
  </select>
  </div>

   <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Nombres</label>
    <input type="email" id="email-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="Pepe" required />
  </div>

  <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido materno</label>
    <input type="email" id="email-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="Navarro" required />
  </div>

  <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Apellido paterno</label>
    <input type="email" id="email-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="Navarro" required />
  </div>

  <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Correo electronico</label>
    <input type="email" id="email-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="Navarro@gmail.com" required />
  </div>
  
  <div class="mb-5">
    <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white ">Nombre de usuario</label>
    <input type="email" id="email-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="PEPE1212" required />
  </div>


  <div class="mb-5">
    <label for="password-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white">Contraseña</label>
    <input type="password" id="password-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="••••••••" required />
  </div>

  <div class="mb-5">
    <label for="password-alternative" class="block mb-2.5 text-sm font-medium text-heading text-white">Confirmar contraseña</label>
    <input type="password" id="password-alternative" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent
       border-0 border-b-2 border-gray-400
       appearance-none focus:outline-none focus:ring-0
       focus:border-white peer" placeholder="••••••••" required />
  </div>
  
  <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Crear cuenta</button>
</form>

@endsection