<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Administrador;


class AdminControlador extends Controller
{
    public function index()
    {
        $admins = Administrador::all();
        return view('/empleados/empleados-formulario')->with('admins', $admins);
    }

    public function create()
    {
        return view('/clientes/clientes-formulario');
    }

    public function store(Request $req)
    {

        //return $req->all();

        $admin = new Clientes();
        $admin->nombres = $req->nombres;
        $admin->apeliido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->contrasena = $req->contrasena;

        if ($req->hasFile('imagen')) {
            $archivo = $req->file('imagen');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('imagenes'), $nombre);

            $admin->imagen = 'imagenes/' . $nombre;
        }
        $admin->estado = $req->estado;
        $admin->calle = $req->calle;
        $admin->num_int = $req->num_int;
        $admin->num_ext = $req->num_ext;
        $admin->cp = $req->cp;
        $admin->ciudad = $req->ciudad;
        $admin->estado_cliente = $req->has('estado_cliente') ? 1 : 0;


        $admin->save();

        return redirect('/clientes/ver-clientes');
    }
}
