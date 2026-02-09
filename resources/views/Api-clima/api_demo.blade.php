
@extends('layouts.plantilla')

@section('titulo-pagina', 'Crear Cuenta de cliente')

@section('contenido')
    <div class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 p-8 min-h-screen"> 

    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold  text-slate-50">Monitor de Red y Entorno</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                
                <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Meteorología</h5>
                <div class="flex items-end space-x-2">
                    <span class="text-5xl font-bold text-slate-800">{{ $temperature }}°</span>
                    <span class="text-xl text-slate-600 mb-2">C</span>
                </div>
                
                <div class="mt-6 space-y-2">
                    <div class="flex justify-between text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Viento</span>
                        <span class="font-medium text-slate-700">{{ $windspeed }} km/h</span>
                    </div>
                    <div class="flex justify-between text-sm pt-1">
                        <span class="text-slate-500">Estado</span>
                        <span class="font-medium text-green-600">Actualizado</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 relative overflow-hidden hover:shadow-md transition-all">
                <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Mercado Cambiario</h5>
                
                <div class="flex items-center space-x-1 text-green-600">
                    <span class="text-2xl font-bold">$</span>
                    <span class="text-5xl font-bold">{{ $exchangeRate }}</span>
                    <span class="text-sm font-medium self-end mb-2">MXN</span>
                </div>
                <p class="text-xs text-slate-400 mt-1">1 USD = {{ $exchangeRate }} MXN</p>

                <div class="mt-6 bg-green-50 rounded-lg p-3 border border-green-100">
                    <p class="text-xs text-green-800 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Datos proporcionados por Frankfurter API
                    </p>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-all md:col-span-1">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Geolocalización IP</h5>
                        <h3 class="text-xl font-bold text-slate-800">{{ $city }}, {{ $geoData['region'] ?? '' }}</h3>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded border border-blue-200">{{ $geoData['countryCode'] ?? 'MX' }}</span>
                </div>

                <ul class="space-y-3 mt-4">
                    <li class="flex justify-between items-center text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500 flex items-center">
                            🌐 IP Pública
                        </span>
                        <span class="font-mono font-medium text-slate-700">{{ $myIp }}</span>
                    </li>
                    
                    <li class="flex justify-between items-center text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Proveedor (ISP)</span>
                        <span class="font-medium text-slate-700 text-right text-xs max-w-[150px] truncate" title="{{ $geoData['isp'] ?? 'N/A' }}">
                            {{ $geoData['isp'] ?? 'N/A' }}
                        </span>
                    </li>

                    <li class="flex justify-between items-center text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Código Postal</span>
                        <span class="font-medium text-slate-700">{{ $geoData['zip'] ?? 'N/A' }}</span>
                    </li>

                    <li class="flex justify-between items-center text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">🕒 Zona Horaria</span>
                        <span class="font-medium text-slate-700 text-xs">{{ $geoData['timezone'] ?? 'N/A' }}</span>
                    </li>

                    <li class="flex justify-between items-center text-sm pt-1">
                        <span class="text-slate-500">Coordenadas</span>
                        <span class="font-mono text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded">
                            {{ $geoData['lat'] ?? 0 }}, {{ $geoData['lon'] ?? 0 }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
