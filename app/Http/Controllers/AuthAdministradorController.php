<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Empleados;
use Laravel\Socialite\Facades\Socialite;
class AuthAdministradorController extends Controller
{
    public function Formulario()
    {
        //return view("/auth/login");
    }

    public function Login(Request $req)
    {
        if (Auth::guard('admin')->attempt(["correo" => $req->email, "password" => $req->password, "estado" => 1])) {
            $req->session()->regenerate();
            return redirect()->route("dashboard");
        }

        return back()->withErrors(["email" => "Credenciales incorrectas o no existentes!",])->onlyInput('email');

        //$admin = Empleados::where("email", $req->email)->where("contrasena", $req->password)->where("estado",1)->first();
    }

    public function Logout(Request $req)
    {

    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $empleado = Empleados::where('correo', $googleUser->getEmail())->first();

        if (!$empleado) {
            $empleado = Empleados::create([
                'rol_id' => 1,
                'nombre' => $googleUser->getName(),
                'apellido_p' => 'Google',
                'apellido_m' => 'User',
                'correo' => $googleUser->getEmail(),
                'usuario' => $googleUser->getNickname() ?? $googleUser->getEmail(),
                'contrasena' => bcrypt(uniqid()),
                'estado' => 1,
                'imagen' => $googleUser->getAvatar(),
            ]);
        }

        Auth::guard('admin')->login($empleado);

        return redirect()->route('dashboard');
    }

}