<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Importante: Importar el cliente HTTP

class ApiController extends Controller
{
    public function index()
{
    try {
        $ipResponse = Http::get('https://api.ipify.org?format=json');
        $myIp = $ipResponse->json()['ip']; 
    } catch (\Exception $e) {
        $myIp = '189.130.208.196'; 
    }

    $geoResponse = Http::get("http://ip-api.com/json/{$myIp}");
    $geoData = $geoResponse->json();

    $lat = $geoData['lat'] ?? 0;
    $lon = $geoData['lon'] ?? 0;
    $city = $geoData['city'] ?? 'Desconocida';
    $country = $geoData['country'] ?? 'Desconocido';

    $weatherResponse = Http::get("https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current_weather=true&timezone=auto");
    $weatherData = $weatherResponse->json();
    
    $temperature = $weatherData['current_weather']['temperature'] ?? 'N/A';
    $windspeed = $weatherData['current_weather']['windspeed'] ?? 'N/A';

    $currencyResponse = Http::get("https://api.frankfurter.app/latest?amount=1&from=USD&to=MXN");
    $currencyData = $currencyResponse->json();
    
    $exchangeRate = $currencyData['rates']['MXN'] ?? 0;

    return view('/Api-clima/api_demo', compact('city', 'country', 'temperature', 'windspeed', 'exchangeRate', 'geoData', 'myIp'));
}
}