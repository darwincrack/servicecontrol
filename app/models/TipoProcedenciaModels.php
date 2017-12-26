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


class TipoProcedenciaModels
{

    static  public function listar()
    {
        $data = DB::table('tipo_procedencia')
            ->select('id_tipo_procedencia','nombre', 'descripcion', 'created_at', 'activo');
        return $data;

    }


    static public function insertar($nombre,$descripcion)
    {
        DB::table('tipo_procedencia')->insert(
            ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_tipo_procedencia,$nombre,$descripcion,$activo)
    {
        DB::table('tipo_procedencia')
            ->where('id_tipo_procedencia', $id_tipo_procedencia)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }



    static public function show_tipo_procedencia($id_tipo_procedencia){


        $data = DB::table('tipo_procedencia')
            ->where('id_tipo_procedencia', $id_tipo_procedencia)
            ->select('id_tipo_procedencia','nombre', 'descripcion', 'created_at', 'activo')
            ->first();
        return $data;

    }


}