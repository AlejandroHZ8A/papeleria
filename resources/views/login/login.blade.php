@extends('plantilla.app')

@section('titulo-pagina', 'login - Papelería Lunary')

@section('contenido')

    <body>
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="/inicio" class="flex items-center">
                    <div class="h-10 w-10 rounded-full overflow-hidden">
                        <img src="{{ asset('imagenes/logopapeleria.png') }}" class="h-full w-full object-cover"
                            alt="Papeleria-Logo">
                    </div>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white ml-4">
                        Papelería Lunary
                    </span>
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-3 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        @if (session('error'))
                            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="space-y-4 md:space-y-6" action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu correo
                                    electronico:</label>
                                <input type="email" name="correo" id="correo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña:</label>
                                <input type="password" name="contrasena" id="contrasena" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required="">
                            </div>
                            {{-- <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                            required="">
                                    </div><label for="terms" class="font-light text-gray-500 dark:text-gray-300 p-1 -translate-y-1">Acepto<a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terminos y condiciones</a></label>
                      
                                </div>
                            </div> --}}
                            <button type="submit"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Iniciar
                                sesion</button>
                        </form>
                        <a href="#"
                            class="w-full text-white ml-24 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Iniciar sesión con Google
                        </a>
                        <a href="/auth/google"
                            class="w-full text-white ml-24 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Crear cuenta
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </body>

@endsection
