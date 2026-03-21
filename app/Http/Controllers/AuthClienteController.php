<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthClienteController extends Controller
{
    private $apiBase = 'http://127.0.0.1:8000/api'; // ← ajusta si tu backend corre en otro puerto

    // Mostrar formulario de login
    public function mostrarLogin()
    {
        if (session('cliente_token')) {
            return redirect()->route('catalogo.index');
        }
        return view('/login/login');
    }

    // Mostrar formulario de registro
    public function mostrarRegistro()
    {
        if (session('cliente_token')) {
            return redirect()->route('catalogo.index');
        }
        return view('auth.registro');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'correo'    => 'required|email',
            'contrasena' => 'required',
        ]);

        $respuesta = Http::post("{$this->apiBase}/cliente/login", [
            'correo'    => $request->correo,
            'contrasena' => $request->contrasena,
        ]);

        $json = $respuesta->json();

        if ($respuesta->successful() && $json['success']) {
            session([
                'cliente_token' => $json['data']['token'],
                'cliente_data'  => $json['data']['cliente'],
            ]);

            return redirect()->route('catalogo.index')->with('success', '¡Bienvenido, ' . $json['data']['cliente']['nombres'] . '!');
        }

        return back()->with('error', $json['mensaje'] ?? 'Credenciales incorrectas')->withInput();
    }

    // Procesar registro
    public function registro(Request $request)
    {
        $request->validate([
            'nombres'    => 'required|string|max:100',
            'apellido_p' => 'required|string|max:100',
            'apellido_m' => 'required|string|max:100',
            'correo'     => 'required|email',
            'contrasena' => 'required|min:6|confirmed',
        ]);

        $respuesta = Http::post("{$this->apiBase}/clientes", [
            'nombres'    => $request->nombres,
            'apellido_p' => $request->apellido_p,
            'apeliido_m' => $request->apellido_m, // ojo: así está en tu BD (con doble i)
            'correo'     => $request->correo,
            'contrasena' => $request->contrasena,
            'estado'     => 1,
        ]);

        $json = $respuesta->json();

        if ($respuesta->successful()) {
            return redirect()->route('login')->with('success', 'Cuenta creada. Ahora inicia sesión.');
        }

        return back()->with('error', $json['mensaje'] ?? 'Error al registrar')->withInput();
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $token = session('cliente_token');

        if ($token) {
            Http::withToken($token)->post("{$this->apiBase}/cliente/logout");
        }

        session()->forget(['cliente_token', 'cliente_data']);

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}