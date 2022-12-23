<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Propietario::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj_usuario = Auth::user();

        $request->validate([
            'tipo_documento' => ['required'],
            'documento' => ['required'],
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'direccion' => ['required'],
            'telefono' => ['required'],
            'email' => ['required']
        ]);

        $propietario = new Propietario;
        $propietario->tipo_documento = $request->input('tipo_documento');
        $propietario->documento = $request->input('documento');
        $propietario->nombres = $request->input('nombres');
        $propietario->apellidos = $request->input('apellidos');
        $propietario->direccion = $request->input('direccion');
        $propietario->telefono = $request->input('telefono');
        $propietario->email = $request->input('email');
        $propietario->usuariocreacion = 1; //$obj_usuario->id;
        $propietario->usuariomodificacion = 1; //$obj_usuario->id;
        $propietario->ipcreacion = $request->getClientIp();
        $propietario->ipmodificacion = $request->getClientIp();
        $propietario->save();
        return $propietario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Propietario  $propietario
     * @return \Illuminate\Http\Response
     */
    public function show(Propietario $propietario)
    {
        return $propietario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Propietario  $propietario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propietario $propietario)
    {
        $obj_usuario = Auth::user();
        
        $request->validate([
            'tipo_documento' => ['required'],
            'documento' => ['required'],
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'direccion' => ['required'],
            'telefono' => ['required'],
            'email' => ['required']
        ]);

        $propietario->tipo_documento = $request->input('tipo_documento');
        $propietario->documento = $request->input('documento');
        $propietario->nombres = $request->input('nombres');
        $propietario->apellidos = $request->input('apellidos');
        $propietario->direccion = $request->input('direccion');
        $propietario->telefono = $request->input('telefono');
        $propietario->email = $request->input('email');
        $propietario->usuariocreacion = 1; //$obj_usuario->id;
        $propietario->usuariomodificacion = 1; //$obj_usuario->id;
        $propietario->ipcreacion = $request->getClientIp();
        $propietario->ipmodificacion = $request->getClientIp();
        $propietario->save();
        return $propietario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propietario  $propietario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propietario $propietario)
    {
        $propietario->delete();

        return response()->noContent();
    }
}
