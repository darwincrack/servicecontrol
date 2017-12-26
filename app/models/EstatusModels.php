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


class EstatusModels
{

    static  public function listar()
    {
        $data = DB::table('estatus')
            ->select('id_estatus','nombre', 'created_at', 'activo');
        return $data;
    }


    static public function insertar($nombre)
    {
        DB::table('estatus')->insert(
            ['nombre' => $nombre, 'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }


    static public function editar($id_estatus,$nombre,$activo)
    {
        DB::table('estatus')
            ->where('id_estatus', $id_estatus)
            ->update( ['nombre' => $nombre,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }


    static public function show_estatus($id_estatus){


        $data = DB::table('estatus')
            ->where('id_estatus', $id_estatus)
            ->select('id_estatus','nombre', 'created_at', 'activo')
            ->first();
        return $data;

    }


}