<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleados;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmpleadosController extends Controller
{

    public function index()
    {
        $admins = Empleados::with('rol')->get();
        foreach ($admins as $admin) {
            $admin->imagen=asset($admin->imagen);
        }
        return response()->json(['resultado' => true, 'datos' => $admins], 200);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'rol_id' => 'required|exists:roles,id',
            'correo' => 'required|email|unique:empleados',
            'contrasena' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'errores' => $validator->errors()], 422);
        }


        $admin = new Empleados();
        $admin->nombre = $req->nombre;
        $admin->apellido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->usuario = $req->usuario;
        $admin->contrasena = Hash::make($req->contrasena);
        $admin->rol_id = $req->rol_id;
        $admin->estado = $req->estado ?? 1;
        $admin->imagen = '/storage/imagenes/logopapeleria.png';


        $admin->save();

        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'empleado' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/empleado', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        $admin->imagen=asset($admin->imagen);
        return response()->json(['resultado' => true, 'datos' => $admin, 'errors' => ''], 201);
    }

    public function edit($id)
    {
        $empleado = Empleados::find($id);
        $roles = Rol::all();
        return view('Empleados/empleados-editar', compact('empleado', 'roles'));
    }

    public function show($id)
    {

        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|min:1|exists:empleados,id']
        );

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'mensaje'=>'No existe ese id', 'errores' => $validator->errors()], 422);
        }

        $empleado = Empleados::find($id);
        $roles = Rol::all();
        if (!$empleado or !$roles) {
            return response()->json(['resultado' => false, 'datos' => $empleado, 'datos2' => $roles], 404);
        }
        
        $empleado->imagen=asset($empleado->imagen);
        
        return response()->json(['resultado' => true, 'datos' => $empleado], 200);
    }

    public function update($id, Request $req)
    {

        $validator = Validator::make($req->all(), [
            'rol_id' => 'required|exists:roles,id',
            'correo' => 'required|email|unique:empleados,correo,' . $id,
            'contrasena' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'errores' => $validator->errors()], 422);
        }

        $admin = Empleados::find($id);

        $admin->nombre = $req->nombre;
        $admin->apellido_m = $req->apellido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->usuario = $req->usuario;
        if ($req->filled('contrasena')) {
            $admin->contrasena = Hash::make($req->contrasena);
        }
        $admin->rol_id = $req->rol_id;
        $admin->estado = $req->estado ?? $admin->estado;
        $admin->imagen = '/storage/imagenes/logopapeleria.png';

        $admin->save();
        if ($req->has('imagen')) {
            $imagen = $req->imagen;
            $nuevo_nombre = 'empleado' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/empleado', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        $admin->imagen=asset($admin->imagen);
        
        return response()->json(['resultado' => true, 'datos' => $admin], 200);
    }

    public function destroy($id)
    {

         $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|min:1|exists:empleados,id']
        );

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => '', 'errores' => $validator->errors()], 422);
        }

        $empleado = Empleados::find($id);

        if (!$empleado) {
            return redirect('/empleados')
                ->with('error', 'Empleado no encontrado');
        }

        $empleado->delete();
        return redirect('/api/empleados');
    }
}