<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papeleria @yield('titulo-pagina')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">

    {{-- navbar --}}
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 mr-30 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="/inicio" class="flex items-center">
                    <div class="h-10 w-10 rounded-full overflow-hidden">
                        <img src="{{ asset('imagenes/logopapeleria.png') }}" class="h-full w-full object-cover"
                            alt="Papeleria-Logo">
                    </div>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white ml-4">stationery
                        lunery</span>
                </a>
                <div class="flex items-center lg:order-2">
                    @if (session()->has('usuario_id'))
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-800 dark:text-white text-sm">
                                Hola, {{ session('usuario_nombre') }}
                            </span>

                            <a href="/logout" class="text-red-500 hover:underline text-sm">
                                Cerrar sesión
                            </a>
                        </div>
                    @else
                        <a href="/usuarios/iniciar-sesion"
                            class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:hover:bg-gray-700">
                            Iniciar sesión
                        </a>
                    @endif

                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/inicio"
                                class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                                aria-current="page">Inicio</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Productos</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Productos
                                en oferta</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Historial
                                de compras</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Mi
                                carrito</a>
                        </li>

                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

                        <li class="relative group">
                            <!-- Botón principal -->
                            <button
                                class="flex items-center py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700
               dark:text-gray-400 dark:hover:text-white">
                                Administradores
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Submenú -->
                            <div
                                class="absolute left-0 mt-2 w-44 rounded-lg bg-white shadow-lg
               opacity-0 invisible group-hover:opacity-100 group-hover:visible
               transition-all duration-200
               dark:bg-gray-700 z-50">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="/empleados"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Ver administradores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/empleados/crear-cuenta"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar administradores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/empleados/rol-empleados"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Ver tipos de empleado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/empleados/crear-nuevo-rol"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar nuevo tipo de empleado
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="relative group">
                            <!-- Botón principal -->
                            <button
                                class="flex items-center py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700
               dark:text-gray-400 dark:hover:text-white">
                                Clientes
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Submenú -->
                            <div
                                class="absolute left-0 mt-2 w-44 rounded-lg bg-white shadow-lg
               opacity-0 invisible group-hover:opacity-100 group-hover:visible
               transition-all duration-200
               dark:bg-gray-700 z-50">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="/clientes"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Ver clientes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/clientes/crear-cuenta"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar clientes
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="relative group">
                            <!-- Botón principal -->
                            <button
                                class="flex items-center py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700
               dark:text-gray-400 dark:hover:text-white">
                                Productos
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Submenú -->
                            <div
                                class="absolute left-0 mt-2 w-44 rounded-lg bg-white shadow-lg
               opacity-0 invisible group-hover:opacity-100 group-hover:visible
               transition-all duration-200
               dark:bg-gray-700 z-50">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Ver productos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar productos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- contenido dinamico --}}
    @yield('contenido')


    
    {{-- footer --}}
    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="/inicio"
                class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <div class="h-10 w-10 rounded-full overflow-hidden">
                    <img src="imagenes/logopapeleria.png" class="h-full w-full object-cover" alt="Papeleria-Logo">
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white ml-4">stationery
                    lunery</span>
            </a>
            <p class="my-6 text-gray-500 dark:text-gray-400">La información proporcionada en este sitio es utilizada
                únicamente para fines de contacto
                y atención al cliente. No compartimos datos personales con terceros.</p>
            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">Sobre Nosotros</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Facebook</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">Instagram</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">WhatsApp</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Preguntas frecuentes</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Contacto</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Inicio</a>
                </li>
            </ul>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2026 <a href="#"
                    class="hover:underline">Papelería Lunery™ </a>Todos los derechos reservados.</span>
        </div>
    </footer>

</body>

</html>