<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserSanctumController extends Controller
{
    public function autenticacion(Request $request)
    {

        try {
            $credenciagitles = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credenciales)) {
                $user = Auth::user();
                $token = $user->createToken('usersanctum');
                return response()->json([
                    'success' => true,
                    'mensaje' => 'usuario autenticado',
                    'errores' => null,
                    'data' => ['user' => $user, 'token' => $token -> plainTextToken]
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'usuario no autenticado',
                    'errores' => null,
                    'data' => null
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'mensaje' => 'no se pudo establecer comunicacion',
                'errores' => null,
                'data' => null
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        //$user = $request -> user();
        $user->tokens()->delete();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Token finalizado',
            'errores' => null,
            'data' => null
        ], 200);
    }
}