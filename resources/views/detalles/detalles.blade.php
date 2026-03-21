@extends('plantilla.app')

@section('titulo-pagina', 'detalles del producto - Papelería Lunary')

@section('contenido')

    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            {{-- SECCIÓN DE IMÁGENES --}}
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">

                {{-- Contenedor de la Galería (Miniaturas + Imagen Principal) --}}
                <div class="flex gap-4 lg:gap-6 flex-col-reverse lg:flex-row">

                    {{-- Contenedor de MINIATURAS (Thumbnails) --}}
                    {{-- Si hay imágenes, creamos el panel de miniaturas a la izquierda --}}
                    @if (isset($producto['imagenes']) && count($producto['imagenes']) > 0)
                        <div
                            class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-y-auto lg:max-h-[500px] flex-shrink-0 w-full lg:w-32 lg:justify-start justify-center">
                            @foreach ($producto['imagenes'] as $index => $imagen)
                                <button type="button" onclick="changeMainImage('{{ $imagen['url_imagen'] }}', this)"
                                    {{-- Clase para la miniatura activa (borde azul) --}}
                                    class="thumbnail-btn flex items-center justify-center h-20 w-20 flex-shrink-0 border-2 rounded-lg overflow-hidden focus:outline-none transition-all duration-300 {{ $index === 0 ? 'border-primary-600 ring-2 ring-primary-300 active-thumbnail' : 'border-transparent hover:border-primary-500' }}">
                                    <img src="{{ $imagen['url_imagen'] }}" class="h-full w-full object-cover"
                                        alt="Miniatura {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Contenedor de la IMAGEN PRINCIPAL (grande) --}}
                    <div
                        class="w-full lg:flex-grow flex items-center justify-center p-4 bg-gray-100 rounded-2xl overflow-hidden min-h-[400px]">
                        @if (isset($producto['imagenes']) && count($producto['imagenes']) > 0)
                            <img id="mainImage" src="{{ $producto['imagenes'][0]['url_imagen'] }}"
                                alt="{{ $producto['nombre'] }}"
                                class="max-w-full max-h-[500px] object-contain transition-opacity duration-300 ease-in-out">
                        @else
                            {{-- Imágenes por defecto si no tiene --}}
                            <img class="w-full dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                            <img class="w-full hidden dark:block"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                alt="" />
                        @endif
                    </div>
                </div>

                {{-- SECCIÓN DE INFORMACIÓN --}}
                <div class="mt-6 sm:mt-8 lg:mt-0">

                    {{-- Título / Nombre --}}
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $producto['nombre'] }}
                    </h1>

                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        {{-- Precio --}}
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            ${{ number_format($producto['precio'], 2) }}
                        </p>

                        {{-- Estrellitas (fijas) --}}
                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                (5.0)
                            </p>
                        </div>
                    </div>

                    {{-- BOTONES --}}
                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <a href="/login" title=""
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button">
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                            Agregar a favoritos
                        </a>

                        @if (session('cliente_token'))
                            <form method="POST" action="{{ route('carrito.agregar') }}">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                <input type="hidden" name="nombre" value="{{ $producto['nombre'] }}">
                                <input type="hidden" name="precio" value="{{ $producto['precio'] }}">
                                <input type="hidden" name="imagen"
                                    value="{{ isset($producto['imagenes'][0]) ? $producto['imagenes'][0]['url_imagen'] : '' }}">

                                <button type="submit"
                                    class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center">
                                    <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                    </svg>
                                    Agregar al carrito
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center">
                                Inicia sesión para comprar
                            </a>
                        @endif
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    {{-- Descripción --}}
                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $producto['descripcion'] }}
                    </p>

                    {{-- Categoría y Existencias --}}
                    @if (isset($producto['categoria']))
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-4">
                            <strong>Categoría:</strong> {{ $producto['categoria']['nombre'] }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-4">
                            <strong>Marca:</strong> {{ $producto['marca']['nombre'] }}
                        </p>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-4">
                            <strong>Categoría:</strong> Sin categoría asignada
                        </p>
                    @endif

                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        <strong>Existencias:</strong> {{ $producto['existencia'] }} unidades disponibles.
                    </p>

                </div>
            </div>
        </div>
    </section>

@endsection

{{-- ✅ SCRIPT DE JAVASCRIPT --}}
{{-- Pónlo al final del archivo, después de @endsection --}}
<script>
    function changeMainImage(imageUrl, thumbnailElement) {
        // 1. Obtenemos el elemento de la imagen principal por su ID
        const mainImage = document.getElementById('mainImage');

        // 2. Aplicamos un efecto de desvanecimiento (opcional, para suavizar)
        mainImage.style.opacity = 0;

        // 3. Cambiamos la fuente de la imagen principal
        // Usamos setTimeout para esperar a que termine el desvanecimiento
        setTimeout(() => {
            mainImage.src = imageUrl;
            mainImage.style.opacity = 1;
        }, 150); // 150ms es la mitad de la duración de la transición

        // 4. Actualizamos el estado "activo" de las miniaturas

        // A. Quitamos las clases activas de todas las miniaturas
        document.querySelectorAll('.thumbnail-btn').forEach(btn => {
            btn.classList.remove('border-primary-600', 'ring-2', 'ring-primary-300', 'active-thumbnail');
            btn.classList.add('border-transparent');
        });

        // B. Añadimos las clases activas a la miniatura seleccionada (this)
        thumbnailElement.classList.add('border-primary-600', 'ring-2', 'ring-primary-300', 'active-thumbnail');
        thumbnailElement.classList.remove('border-transparent');
    }
</script>
