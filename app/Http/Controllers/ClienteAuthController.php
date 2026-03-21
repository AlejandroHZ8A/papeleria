<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'correo' => 'required|email',
                'contrasena' => 'required',
            ]);

            $cliente = clientes::where('correo', $request->correo)->first();

            if ($cliente && Hash::check($request->contrasena, $cliente->contrasena)) {

                $token = $cliente->createToken('TokenCliente')->accessToken;

                return response()->json([
                    'success' => true,
                    'mensaje' => 'Cliente autenticado con Passport',
                    'data' => [
                        'cliente' => $cliente,
                        'token' => $token
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'mensaje' => 'Credenciales inválidas'
            ], 401);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'mensaje' => $th->getMessage()
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'mensaje' => 'Token de cliente eliminado'
        ], 200);
    }

    public function perfil(Request $request)
    {
        return response()->json([
            'success' => true,
            'datos' => $request->user()
        ], 200);
    }


}