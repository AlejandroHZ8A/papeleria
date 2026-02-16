<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function index()
    {   //validacion en caso de que queramos mostrar solo los "activos" dentro del sistema.
        //$admins = Clientes::where('estado_cliente', 1)->get();
        $admins = clientes::all();
        
        return view('/Clientes/Clientes-listado')->with('admins', $admins);
    }

    public function create()
    {
        return view('/Clientes/Clientes-formulario');
    }

    public function store(Request $req)
    {

        //return $req->all();

        $req->validate([
            'contrasena' => 'required|min:3',
            'contrasena_confirmar' => 'required|same:contrasena',
        ]);

        $admin = new Clientes();
        $admin->nombres = $req->nombres;
        $admin->apeliido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->contrasena = $req->contrasena;
        $admin->imagen = '/imagenes/logopapeleria.png';
        $admin->estado = $req->estado;
        $admin->calle = $req->calle;
        $admin->num_int = $req->num_int;
        $admin->num_ext = $req->num_ext;
        $admin->cp = $req->cp;
        $admin->ciudad = $req->ciudad;
        $admin->estado_cliente = $req->has('estado_cliente') ? 1 : 0;

        $admin->save();

        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'clientes'.$admin->id.'.jpg';
            $ruta = $imagen->storeAs('imagenes/clientes', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/'.$ruta;
            $admin->save();
        }

        return redirect('/clientes');
    }

    public function edit($id)
    {

        $admin = Clientes::find($id);

        return view('Clientes/Clientes-editar', )->with('clientes', $admin);
    }

    public function update($id, Request $req)
    {
        $req->validate([
            'contrasena' => 'required|min:3',
            'contrasena_confirmar' => 'required|same:contrasena',
        ]);

        $admin = Clientes::find($id);

        $admin->nombres = $req->nombres;
        $admin->apeliido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        if ($req->filled('contrasena')) {
            $admin->contrasena = $req->contrasena;
        }
        $admin->imagen = '/imagenes/administradores/default.jpg';
        $admin->estado = $req->estado;
        $admin->calle = $req->calle;
        $admin->num_int = $req->num_int;
        $admin->num_ext = $req->num_ext;
        $admin->cp = $req->cp;
        $admin->ciudad = $req->ciudad;
        $admin->estado_cliente = $req->has('estado_cliente') ? 1 : 0;

        $admin->save();

        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'administrador_'.$admin->id.'.jpg';
            $ruta = $imagen->storeAs('imagenes/administradores', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/'.$ruta;
            $admin->save();
        }

        return redirect('/clientes');
    }

    public function destroy($id)
    {

        $cliente = Clientes::find($id);

        if (!$cliente) {
            return redirect('/clientes')->with('error', 'Cliente no encontrado');
        }

        $cliente->delete();

        return redirect('/clientes')->with('success', 'Cliente eliminado correctamente');
    }
}