<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientesController extends Controller
{
    private $url = "http://127.0.0.1:8000/api/clientes";

    public function index()
    {
        $response = Http::withoutVerifying()->get($this->url);
        
        $json = json_decode($response->body());
        
        $admins = $json->datos ?? []; 

        return view('Clientes.Clientes-listado')->with('admins', $admins);
    }

    public function create()
    {
        return view('Clientes.Clientes-formulario');
    }

    public function store(Request $req)
    {
        $http = Http::withoutVerifying()->asMultipart();

        if ($req->hasFile('imagen')) {
            $http->attach(
                'imagen', 
                file_get_contents($req->imagen), 
                'foto.jpg'
            );
        }

        $response = $http->post($this->url, $req->except('imagen'));

        if (!$response->successful()) {
            return back()->with('error', 'Hubo un error al guardar')->withInput();
        }

        return redirect('/clientes')->with('success', 'Cliente creado!');
    }

    public function edit($id)
    {
        $response = Http::withoutVerifying()->get($this->url . '/' . $id);
        
        $json = json_decode($response->body());
        $cliente = $json->datos ?? null;

        return view('Clientes.Clientes-editar')->with('clientes', $cliente);
    }

    public function update($id, Request $req)
    {
        $http = Http::withoutVerifying()->asMultipart();

        if ($req->hasFile('imagen')) {
            $http->attach(
                'imagen', 
                file_get_contents($req->imagen), 
                'foto.jpg'
            );
        }

        $datos = $req->except('imagen');
        $datos['_method'] = 'PUT';

        $response = $http->post($this->url . '/' . $id, $datos);

        if (!$response->successful()) {
            return back()->with('error', 'Hubo un error al actualizar')->withInput();
        }

        return redirect('/clientes')->with('success', 'Cliente actualizado!');
    }

    public function destroy($id)
    {
        $datos = [
            '_method' => 'DELETE'
        ];

        $response = Http::withoutVerifying()->post($this->url . '/' . $id, $datos);

        return redirect('/clientes')->with('success', 'Cliente eliminado correctamente');
    }
}