@extends('plantilla.app')

@section('titulo-pagina', 'Carrito - Papelería Lunary')

@section('contenido')

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Carrito de compras</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @foreach ($carrito as $item)
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="#" class="shrink-0 md:order-1">
                                        <img class="h-20 w-20 object-contain"
                                            src="{{ $item['imagen'] ?: 'https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg' }}"
                                            alt="{{ $item['nombre'] }}" />
                                    </a>

                                    <label for="counter-input" class="sr-only">Elegir cantidad:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button type="button" id="decrement-button"
                                                data-input-counter-decrement="counter-input"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="counter-input-{{ $item['producto_id'] }}"
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                value="{{ $item['cantidad'] }}" required />
                                            <button type="button" id="increment-button"
                                                data-input-counter-increment="counter-input"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-gray-900 dark:text-white">
                                                ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#"
                                            class="text-base font-medium text-gray-900 hover:underline dark:text-white">Descripcion
                                            del producto</a>

                                        <div class="flex items-center gap-4">
                                            <button type="button"
                                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                </svg>
                                                Agregar a favoritos
                                            </button>

                                            <form method="POST"
                                                action="{{ route('carrito.eliminar', $item['producto_id']) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                    <div class="hidden xl:mt-8 xl:block">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">A la gente tambien le gusto
                        </h3>
                        <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
                            <div
                                class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <a href="#" class="overflow-hidden rounded">
                                    <img class="mx-auto h-44 w-44 dark:hidden"
                                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                        alt="imac image" />
                                    <img class="mx-auto hidden h-44 w-44 dark:block"
                                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                        alt="imac image" />
                                </a>
                                <div>
                                    <a href="#"
                                        class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                                        {{ $item['nombre'] }}
                                    </a>
                                    <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This
                                        generation
                                        Descripcion del producto</p>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                                        <span class="line-through"> costo en oferta si llegara a aplicar</span>
                                    </p>
                                    <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$costo
                                        actual/real</p>
                                </div>
                                <div class="mt-6 flex items-center gap-2.5">
                                    <button data-tooltip-target="favourites-tooltip-1" type="button"
                                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-1" role="tooltip"
                                        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        agregar a favoritos
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <button type="button"
                                        class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                        </svg>
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Costo total de productos</p>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Precio
                                        original</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        ${{ number_format($total, 2) }}
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Descuentos
                                    </dt>
                                    <dd class="text-base font-medium text-green-600">$0.00</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Cantidad</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ array_sum(array_column($carrito, 'cantidad')) }} productos
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Impuesto</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        ${{ number_format($total * 0.16, 2) }}
                                    </dd>
                                </dl>
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    ${{ number_format($total * 1.16, 2) }}
                                </dd>
                            </dl>
                        </div>

                        <a href="#"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Iniciar el pago</a>

                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> Ó </span>
                            {{-- <form method="POST" action="{{ route('carrito.vaciar') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-lg border border-red-300 px-5 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:border-red-600 dark:text-red-500">
                                    Vaciar carrito
                                </button>
                            </form> --}}
                            
                            <a href="{{ route('catalogo.index') }}" title=""
                                class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                Continua comprando
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <form class="space-y-4">
                            <div>
                                <label for="voucher"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Tienes
                                    algun
                                    codigo de descuento? </label>
                                <input type="text" id="voucher"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="" required />
                            </div>
                            <button type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Aplicar
                                codigo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<script>
    document.querySelectorAll('[data-input-counter-decrement], [data-input-counter-increment]').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.inputCounterDecrement || this.dataset.inputCounterIncrement;
            const input = document.getElementById(targetId);
            let val = parseInt(input.value);

            if (this.dataset.inputCounterDecrement !== undefined) {
                if (val > 1) input.value = val - 1;
            } else {
                input.value = val + 1;
            }

            // Envía automáticamente al controlador
            const productoId = targetId.replace('counter-input-', '');
            fetch('{{ route('carrito.actualizar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    producto_id: productoId,
                    cantidad: input.value
                })
            }).then(() => location.reload());
        });
    });
</script>
