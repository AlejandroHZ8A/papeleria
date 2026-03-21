@extends('plantilla.app')

@section('titulo-pagina', 'catalogo - Papelería Lunary')

@section('contenido')

    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Catálogo de Productos
                    </h2>
                </div>
            </div>

            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($productos ?? [] as $producto)
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 flex flex-col justify-between">

                        <div
                            class="relative h-56 w-full flex items-center justify-center overflow-hidden rounded-t-lg bg-white p-4">
                            {{-- ✅ CAMBIO 1: La imagen ahora tiene el enlace a los detalles --}}
                            <a href="{{ route('catalogo.show', $producto['id']) }}"
                                class="flex h-full w-full items-center justify-center">
                                @if (isset($producto['imagenes']) && count($producto['imagenes']) > 0)
                                    <img class="h-full w-full object-contain"
                                        src="{{ $producto['imagenes'][0]['url_imagen'] }}"
                                        alt="{{ $producto['nombre'] }}" />
                                @else
                                    <img class="h-full w-full object-contain opacity-50"
                                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                        alt="Imagen por defecto" />
                                @endif
                            </a>
                        </div>

                        <div class="pt-6">
                            {{-- ✅ CAMBIO 2: Quitamos el enlace del nombre, ahora es solo un texto --}}
                            <h3 class="text-lg font-semibold leading-tight text-gray-900 dark:text-white line-clamp-2">
                                {{ $producto['nombre'] }}
                            </h3>

                            <p class="text-sm font-normal leading-tight text-gray-900 dark:text-white mt-2">
                                {{ $producto['descripcion'] }}
                            </p>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">
                                    ${{ number_format($producto['precio'], 2) }}
                                </p>

                                {{-- ✅ CAMBIO 3: Convertimos el botón en un enlace (etiqueta <a>) que lleva a los detalles --}}
                                <a href="{{ route('catalogo.show', $producto['id']) }}"
                                    class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                    </svg>
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
