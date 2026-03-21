@extends('plantilla.app')

@section('titulo-pagina', 'Inicio - Papelería lunary')

@section('contenido')

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Todo lo que necesitas para crear y aprender
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Desde útiles escolares básicos hasta material de arte profesional. En <strong>Papelería Lunary</strong>,
                    transformamos tus ideas en realidad con los mejores suministros del mercado.
                </p>
                <a href="/catalogo"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Ver Catálogo
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=20.6736,-103.344" target="_blank"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path
                            d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l5.46 6.57a1 1 0 0 0 1.506 0l5.46-6.57a1 1 0 0 0 .12-.183A7.992 7.992 0 0 0 8 0Zm0 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" />
                    </svg>
                    Ver Ubicación
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                {{-- Se usa asset() para apuntar correctamente a la carpeta public --}}
                <img src="{{ asset('imagenes/logopapeleria.png') }}" alt="Logo Papelería El Trazo"
                    class="rounded-lg shadow-xl">
            </div>
        </div>
    </section>

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <section class="bg-gray-50 dark:bg-gray-800 py-12">
        <div class="max-w-screen-xl px-4 mx-auto text-center">
            <h2 class="mb-8 text-3xl font-bold text-gray-900 dark:text-white">¿Por qué elegirnos?</h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex justify-center mb-4 text-blue-600 dark:text-blue-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Surtido Completo</h3>
                    <p class="text-gray-500 dark:text-gray-400">Desde el lápiz más sencillo hasta kits de ingeniería y
                        arquitectura.</p>
                </div>
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex justify-center mb-4 text-blue-600 dark:text-blue-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Centro de Impresión</h3>
                    <p class="text-gray-500 dark:text-gray-400">Copias a color, b/n, escaneos y encuadernación profesional
                        al instante.</p>
                </div>
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex justify-center mb-4 text-blue-600 dark:text-blue-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Ventas al Mayor</h3>
                    <p class="text-gray-500 dark:text-gray-400">Precios especiales para colegios, oficinas y listas
                        escolares completas.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900 py-16">
        <div class="max-w-screen-md mx-auto text-center">
            <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Nuestra Misión</h2>
            <p class="mb-8 font-light text-gray-500 sm:text-xl dark:text-gray-400">
                Creemos que las herramientas adecuadas potencian el talento. Por eso, nos esforzamos en ofrecer productos de
                calidad que acompañen el crecimiento académico y profesional de nuestra comunidad.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <span
                    class="px-4 py-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">📍
                    Av. Principal #123</span>
                <span
                    class="px-4 py-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">⏰
                    Lun - Sáb: 8:00 AM - 8:00 PM</span>
            </div>
        </div>
    </section>

@endsection
