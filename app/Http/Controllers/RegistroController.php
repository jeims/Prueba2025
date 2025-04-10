<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public  function index()
    {

        $roles = Roles::all();

        return view(
            'auth.registro',
            compact('roles')
        );
    }

    public  function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'primer_apellido' => 'required|max:30',

        ]);


        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'id_rol' => $request->rol_id
        ]);

        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('home.index');
    }
}
