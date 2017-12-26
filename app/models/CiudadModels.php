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


class CiudadModels
{

    static  public function listar()
    {
        $data = DB::table('ciudad')
            ->select('id_ciudad','nombre', 'created_at', 'activo');
        return $data;

    }


    static public function insertar($nombre)
    {
        DB::table('ciudad')->insert(
            ['nombre' => $nombre, 'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_ciudad,$nombre,$activo)
    {
        DB::table('ciudad')
            ->where('id_ciudad', $id_ciudad)
            ->update( ['nombre' => $nombre,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }



    static public function show_ciudad($id_ciudad){


        $data = DB::table('ciudad')
            ->where('id_ciudad', $id_ciudad)
            ->select('id_ciudad','nombre', 'created_at', 'activo')
            ->first();
        return $data;

    }


}