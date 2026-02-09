<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;


class RolEmpleadoController extends Controller
{
    public function index()
    {
        $rol = Rol::all();
        return view('Tipos-empleados/Empleados-tipo-listado', compact('rol'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('Tipos-empleados/Empleados-tipo-formulario', compact('roles'));
    }

    public function store(Request $req)
    {
        $admin = new Rol();

        $admin->nombre_rol = $req->nombre_rol;
        $admin->sueldo = $req->sueldo;
        
        $admin->save();

        return redirect('/empleados/rol-empleados');
    }

    public function edit($id)
    {
        $admin = Rol::find($id);

        return view('Tipos-empleados/Empleados-tipo-editar', )->with('roles', $admin);
    }

    public function update($id, Request $req)
    {   
        $admin = Rol::find($id);


        $admin->nombre_rol = $req->nombre_rol;
        $admin->sueldo = $req->sueldo;
        
        $admin->save();

        return redirect('/empleados/rol-empleados');
    }

    public function destroy($id)
    {
        $roles = Rol::find($id);

        if (!$roles) {
            return redirect('/empleados/rol-empleados')->with('error', 'Cliente no encontrado');
        }

        $roles->delete();

        return redirect('/empleados/rol-empleados')->with('success', 'Cliente eliminado correctamente');
    }
}
