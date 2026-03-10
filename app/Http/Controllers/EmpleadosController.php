<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleados;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;


class EmpleadosController extends Controller
{

    public function index()
    {
        $admins = Empleados::with('rol')->get();
        return view('Empleados/Empleado-listado')->with('admins', $admins);
    }


    public function create()
    {
        $roles = Rol::all();
        return view('Empleados/Empleados-formulario', compact('roles'));

    }

    public function store(Request $req)
    {

        //return $req->all();
        $req->validate([
            'contrasena' => 'required|min:3',
            'contrasena_confirmar' => 'required|same:contrasena',
        ]);

        $admin = new Empleados();
        $admin->nombre = $req->nombre;
        $admin->apellido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->usuario = $req->usuario;
        $admin->contrasena = $req->contrasena;
        $admin->rol_id = $req->rol_id;
        $admin->estado = $req->has('estado_cliente') ? 1 : 0;
        $admin->imagen = '/imagenes/logopapeleria.png';


        $admin->save();

        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'empleado' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/empleado', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        return redirect('/empleados');
    }

    public function edit($id)
    {
        $empleado = Empleados::find($id);
        $roles = Rol::all();
        return view('Empleados/empleados-editar', compact('empleado', 'roles'));
    }

    public function update($id, Request $req)
    {

        $req->validate([
            'contrasena' => 'required|min:3',
            'contrasena_confirmar' => 'required|same:contrasena',
        ]);

        $admin = Empleados::find($id);

        $admin->nombre = $req->nombre;
        $admin->apellido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->usuario = $req->usuario;
        if ($req->filled('contrasena')) {
            $admin->contrasena = $req->contrasena;
        }
        $admin->rol_id = $req->rol_id;
        $admin->estado = $req->has('estado_cliente') ? 1 : 0;
        $admin->imagen = '/imagenes/logopapeleria.png';

        $admin->save();
        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'empleado' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/empleado', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        return redirect('/empleados');
    }

    public function destroy($id)
    {
        $usuario = Auth::guard('admin')->user();

        if (!$usuario || !$usuario->esAdministrador()) {
            abort(403, 'No tienes permisos para eliminar empleados.');
        }

        $empleado = Empleados::find($id);

        if (!$empleado) {
            return redirect('/empleados')
                ->with('error', 'Empleado no encontrado');
        }

        $empleado->delete();

        return redirect('/empleados')
            ->with('success', 'Empleado eliminado correctamente');
    }


}