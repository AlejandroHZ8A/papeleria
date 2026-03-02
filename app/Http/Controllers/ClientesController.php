<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ClientesController extends Controller
{
    public function index()
    {
        $admins = clientes::all();

        foreach ($admins as $admin) {
            $admin->imagen=asset($admin->imagen);
        }
        //return view('/Clientes/Clientes-listado')->with('admins', $admins);
        return response()->json(['resultado' => true, 'datos' => $admins], 200);
    }

    public function create()
    {
        return view('/Clientes/Clientes-formulario');
    }

    public function store(Request $req)
    {

        //return $req->all();

        // $req->validate([
        //     'contrasena' => 'required|min:3',
        //     'contrasena_confirmar' => 'required|same:contrasena',
        // ]);

        $validator = Validator::make($req->all(), [
            'nombres' => 'required|string',
            'apellido_p' => 'required|string',
            'apeliido_m' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo',
            'contrasena' => 'required|min:3',
            'estado' => 'required|string',
            'calle' => 'required|string',
            'num_ext' => 'required',
            'cp' => 'required',
            'ciudad' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'errores' => $validator->errors()], 422);
        }

        $admin = new Clientes();
        $admin->nombres = $req->nombres;
        $admin->apeliido_m = $req->apeliido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        $admin->contrasena = Hash::make($req->contrasena);
        $admin->imagen = '/storage/imagenes/logopapeleria.png';
        $admin->estado = $req->estado;
        $admin->calle = $req->calle;
        $admin->num_int = $req->num_int;
        $admin->num_ext = $req->num_ext;
        $admin->cp = $req->cp;
        $admin->ciudad = $req->ciudad;
        //$admin->estado_cliente = $req->has('estado_cliente') ? 1 : 0;
        $admin->estado_cliente = $req->estado_cliente ?? 1;

        $admin->save();

        if ($req->hasFile('imagen')) {
            $imagen = $req->file('imagen');
            $nuevo_nombre = 'clientes' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/clientes', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        //return redirect('/clientes');
        $admin->imagen=asset($admin->imagen);
        return response()->json(['resultado' => true, 'datos' => $admin, 'errors' => ''], 201);
    }

    public function edit($id)
    {

        $admin = Clientes::find($id);

        return view('Clientes/Clientes-editar', )->with('clientes', $admin);
    }

    public function update($id, Request $req)
    {
        // $req->validate([
        //     'contrasena' => 'required|min:3',
        //     'contrasena_confirmar' => 'required|same:contrasena',
        // ]);

        $validator = Validator::make($req->all(), [
            'nombres' => 'required|string',
            'apellido_p' => 'required|string',
            'apeliido_m' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo,' . $id,
            'contrasena' => 'required|min:3',
            'estado' => 'required|string',
            'calle' => 'required|string',
            'num_ext' => 'required',
            'cp' => 'required',
            'ciudad' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'errores' => $validator->errors()], 422);
        }


        $admin = Clientes::find($id);

        $admin->nombres = $req->nombres;
        $admin->apeliido_m = $req->apeliido_m;
        $admin->apellido_p = $req->apellido_p;
        $admin->correo = $req->correo;
        if ($req->filled('contrasena')) {
            $admin->contrasena = Hash::make($req->contrasena);
        }
        $admin->imagen = '/storage/imagenes/administradores/default.jpg';
        $admin->estado = $req->estado;
        $admin->calle = $req->calle;
        $admin->num_int = $req->num_int;
        $admin->num_ext = $req->num_ext;
        $admin->cp = $req->cp;
        $admin->ciudad = $req->ciudad;
        //$admin->estado_cliente = $req->has('estado_cliente') ? 1 : 0;
        $admin->estado_cliente = $req->estado_cliente ?? 1;

        $admin->save();

        if ($req->hasFile('imagen')) {
            $imagen = $req->file('imagen');
            $nuevo_nombre = 'administrador_' . $admin->id . '.jpg';
            $ruta = $imagen->storeAs('imagenes/administradores', $nuevo_nombre, 'public');
            $admin->imagen = '/storage/' . $ruta;
            $admin->save();
        }

        //return redirect('/clientes');
        $admin->imagen=asset($admin->imagen);
        return response()->json(['resultado' => true, 'datos' => $admin, 'errors' => ''], 201);
    }

    public function show($id)
    {

        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|min:1|exists:clientes,id']
        );

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => null, 'mensaje'=>'No existe ese id', 'errores' => $validator->errors()], 422);
        }

        $clientes = Clientes::find($id);
        if (!$clientes) {
            return response()->json(['resultado' => false, 'datos' => $clientes], 404);
        }
        $clientes->imagen=asset($clientes->imagen);
        return response()->json(['resultado' => true, 'datos' => $clientes], 200);
    }

    public function destroy($id)
    {

        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|min:1|exists:clientes,id']
        );

        if ($validator->fails()) {
            return response()->json(['resultado' => false, 'datos' => '', 'errores' => $validator->errors()], 422);
        }

        $cliente = Clientes::find($id);

        if (!$cliente) {
            return redirect('/clientes')->with('error', 'Cliente no encontrado');
        }

        $cliente->delete();

        //return redirect('/clientes')->with('success', 'Cliente eliminado correctamente');
        return response()->json(['resultado' => true, 'datos' => '', 'errors' => ''], 201);
    }
}