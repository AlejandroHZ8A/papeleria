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
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white ml-4">
                        Papelería Lunary
                    </span>
                </a>

                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li class="relative group">
                            <a href="/inicio"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Inicio</a>

                            <a href="/nosotros"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Nosotros</a>

                            <a href="/catalogo"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Catálogo de productos</a>

                            <a href="{{ route('carrito.index') }}"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Carrito de compras</a>

                            <a href="/contactanos"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center gap-3 lg:order-2">

                    {{-- Icono carrito --}}
                    @if (session('cliente_token'))
                        <a href="{{ route('carrito.index') }}"
                            class="relative text-gray-800 dark:text-white hover:bg-gray-50 rounded-lg p-2 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                            @php $totalItems = array_sum(array_column(session('carrito', []), 'cantidad')); @endphp
                            @if ($totalItems > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-primary-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $totalItems }}
                                </span>
                            @endif
                        </a>
                    @endif
                    @if (session('cliente_token'))
                        {{-- Usuario logueado --}}
                        <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">
                            Hola, {{ session('cliente_data')['nombres'] }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Cerrar sesión
                            </button>
                        </form>
                    @else
                        {{-- Usuario no logueado --}}
                        <a href="{{ route('login') }}"
                            class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                            Iniciar sesión
                        </a>
                    @endif

                </div>
            </div>
        </nav>
    </header>

    {{-- contenido dinamico --}}
    <main class="min-h-screen">
        @yield('contenido')
    </main>

    {{-- footer --}}
    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="/inicio"
                class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <div class="h-10 w-10 rounded-full overflow-hidden">
                    <img src="{{ asset('imagenes/logopapeleria.png') }}" class="h-full w-full object-cover"
                        alt="Papeleria-Logo">
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white ml-4">Papelería
                    Lunary</span>
            </a>
            <p class="my-6 text-gray-500 dark:text-gray-400">La información proporcionada en este sitio es utilizada
                únicamente para fines de contacto
                y atención al cliente. No compartimos datos personales con terceros.</p>
            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
                <li>
                    <a href="/nosotros" class="mr-4 hover:underline md:mr-6 ">Sobre Nosotros</a>
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
                    <a href="/contactanos" class="mr-4 hover:underline md:mr-6">Contacto</a>
                </li>
                <li>
                    <a href="/inicio" class="mr-4 hover:underline md:mr-6">Inicio</a>
                </li>
            </ul>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2026 <a href="#"
                    class="hover:underline">Papelería Lunery™ </a>Todos los derechos reservados.</span>
        </div>
    </footer>

</body>

</html>
