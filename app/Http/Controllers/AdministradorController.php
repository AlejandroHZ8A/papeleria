<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    public function index()
    {
        $admins = Administrador::all();
        return view('/empleados/empleados-listado')->with('admins', $admins);
    }
}
