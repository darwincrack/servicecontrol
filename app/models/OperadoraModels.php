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


class OperadoraModels
{

    static  public function listar()
    {
        $data = DB::table('operadora')
            ->select('id_operadora','nombre', 'created_at', 'activo');
        return $data;
    }


    static public function insertar($nombre)
    {
        DB::table('operadora')->insert(
            ['nombre' => $nombre, 'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }


    static public function editar($id_operadora,$nombre,$activo)
    {
        DB::table('operadora')
            ->where('id_operadora', $id_operadora)
            ->update( ['nombre' => $nombre,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }


    static public function show_operadora($id_operadora){


        $data = DB::table('operadora')
            ->where('id_operadora', $id_operadora)
            ->select('id_operadora','nombre', 'created_at', 'activo')
            ->first();
        return $data;

    }


}