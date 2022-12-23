<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelo = Modelo::join("marca","marca.id","modelo.marca_id")
                        ->select("modelo.id",
                            "modelo.marca_id",
                            "marca.nom_marca",
                            "modelo.nom_modelo",
                            "modelo.fechacreacion",
                            "modelo.usuariocreacion",
                            "modelo.fechamodificacion",
                            "modelo.usuariomodificacion",
                            "modelo.ipcreacion",
                            "modelo.ipmodificacion")
                        ->get();

        return response()->json($modelo);
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
            'nom_modelo' => ['required'],
            'marca_id' => ['required']
        ]);

        $modelo = new Modelo;
        $modelo->marca_id = $request->input('marca_id');
        $modelo->nom_modelo = $request->input('nom_modelo');
        $modelo->usuariocreacion = 1; //$obj_usuario->id;
        $modelo->usuariomodificacion = 1; //$obj_usuario->id;
        $modelo->ipcreacion = $request->getClientIp();
        $modelo->ipmodificacion = $request->getClientIp();
        $modelo->save();
        return $modelo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        return $modelo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        $obj_usuario = Auth::user();

        $request->validate([
            'nom_modelo' => ['required'],
            'marca_id' => ['required']
        ]);

        $modelo->marca_id = $request->input('marca_id');
        $modelo->nom_modelo = $request->input('nom_modelo');
        $modelo->usuariocreacion = 1; //$obj_usuario->id;
        $modelo->usuariomodificacion = 1; //$obj_usuario->id;
        $modelo->ipcreacion = $request->getClientIp();
        $modelo->ipmodificacion = $request->getClientIp();
        $modelo->save();
        return $modelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo $modelo)
    {
        $modelo->delete();

        return response()->noContent();
    }
}
