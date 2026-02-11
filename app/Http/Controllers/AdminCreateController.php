<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\Rol;
use Illuminate\Http\Request;

class AdminCreateController extends Controller
{
    public function create()
{
    $roles = Rol::all();
    return view('empleados/empleados-listado', compact('roles'));
}

public function store(Request $req)
    {

        //return $req->all();

        $admin = new Empleados();
        $admin->nombre = $req->nombre;
        $admin->apellido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->usuario = $req->usuario;
        $admin->contrasena = $req->contrasena;
        $admin->rol_id = $req->rol_id;
        $admin->estado = $req->has('estado_cliente') ? 1 : 0;


        $admin->save();

        return redirect('/admin/index');
    }

}