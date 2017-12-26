<?php
/**
 * Created by PhpStorm.
 * User: desarrollo
 * Date: 20/12/2016
 * Time: 17:20
 */

namespace App\models;

use DB;
use Auth;


class TipoServiciosModels
{

    static  public function listar()
    {
        $data = DB::table('tipo_servicios')
            ->select('id_tipo_servicios','nombre', 'descripcion', 'created_at', 'activo');
        return $data;

    }


    static public function insertar($nombre,$descripcion)
    {
        DB::table('tipo_servicios')->insert(
            ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_tipo_servicio,$nombre,$descripcion,$activo)
    {
        DB::table('tipo_servicios')
            ->where('id_tipo_servicios', $id_tipo_servicio)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }



    static public function show_tipo_servicio($id_tipo_servicio){


        $data = DB::table('tipo_servicios')
            ->where('id_tipo_servicios', $id_tipo_servicio)
            ->select('id_tipo_servicios','nombre', 'descripcion', 'created_at', 'activo')
            ->first();
        return $data;

    }


}