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
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
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

                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

                        <li class="relative group">
                            <!-- Botón principal -->
                            <button
                                class="flex items-center py-2 pr-4 pl-3 text-gray-700 hover:text-primary-700
               dark:text-gray-400 dark:hover:text-white">
                                Usuarios
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
                                            Ver usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar usuarios
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
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Ver administradores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Agregar administradores
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
                                            Mostrar productos
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


    {{-- Footer --}}
    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="#"
                class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <div class="h-10 w-10 rounded-full overflow-hidden">
                    <img src="{{ asset('imagenes/logopapeleria.png') }}" class="h-full w-full object-cover"
                        alt="Papeleria-Logo">
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
                    class="hover:underline">Stationary Lunery™ </a>Todos los derechos reservados.</span>
        </div>
    </footer>


</body>

</html>
