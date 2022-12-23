<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculo = Vehiculo::join("marca","marca.id","vehiculo.marca_id")
                ->join("modelo","modelo.id","vehiculo.modelo_id")
                ->join("propietario","propietario.id","vehiculo.propietario_id")
                ->select("vehiculo.id",
                    "vehiculo.placa",
                    "marca.nom_marca",
                    "modelo.nom_modelo",
                    "vehiculo.ano",
                    "vehiculo.color",
                    DB::raw("concat(propietario.nombres,' ',propietario.apellidos) as propietario"),
                    "vehiculo.observaciones",
                    "vehiculo.fecha_registro",
                    "vehiculo.fechacreacion",
                    "vehiculo.usuariocreacion",
                    "vehiculo.fechamodificacion",
                    "vehiculo.usuariomodificacion",
                    "vehiculo.ipcreacion",
                    "vehiculo.ipmodificacion")
                ->get();

        return response()->json($vehiculo);
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
            'placa' => ['required'],
            'marca_id' => ['required'],
            'modelo_id' => ['required'],
            'ano' => ['required'],
            'color' => ['required'],
            'propietario_id' => ['required'],
            'observaciones' => ['required'],
            'fecha_registro' => ['required']
        ]);

        $vehiculo = new Vehiculo;
        $vehiculo->placa = $request->input('placa');
        $vehiculo->marca_id = $request->input('marca_id');
        $vehiculo->modelo_id = $request->input('modelo_id');
        $vehiculo->ano = $request->input('ano');
        $vehiculo->color = $request->input('color');
        $vehiculo->propietario_id = $request->input('propietario_id');
        $vehiculo->observaciones = $request->input('observaciones');
        $vehiculo->fecha_registro = $request->input('fecha_registro');
        $vehiculo->usuariocreacion = 1; //$obj_usuario->id;
        $vehiculo->usuariomodificacion = 1; //$obj_usuario->id;
        $vehiculo->ipcreacion = $request->getClientIp();
        $vehiculo->ipmodificacion = $request->getClientIp();
        $vehiculo->save();
        return $vehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        return $vehiculo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $obj_usuario = Auth::user();

        $request->validate([
            'placa' => ['required'],
            'marca_id' => ['required'],
            'modelo_id' => ['required'],
            'ano' => ['required'],
            'color' => ['required'],
            'propietario_id' => ['required'],
            'observaciones' => ['required'],
            'fecha_registro' => ['required']
        ]);

        $vehiculo->placa = $request->input('placa');
        $vehiculo->marca_id = $request->input('marca_id');
        $vehiculo->modelo_id = $request->input('modelo_id');
        $vehiculo->ano = $request->input('ano');
        $vehiculo->color = $request->input('color');
        $vehiculo->propietario_id = $request->input('propietario_id');
        $vehiculo->observaciones = $request->input('observaciones');
        $vehiculo->fecha_registro = $request->input('fecha_registro');
        $vehiculo->usuariocreacion = 1; //$obj_usuario->id;
        $vehiculo->usuariomodificacion = 1; //$obj_usuario->id;
        $vehiculo->ipcreacion = $request->getClientIp();
        $vehiculo->ipmodificacion = $request->getClientIp();
        $vehiculo->save();
        return $vehiculo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return response()->noContent();
    }
}
