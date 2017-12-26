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


class CompaniaModels
{

    static  public function listar()
    {
        $data = DB::table('compania')
            ->select('id_compania','nombre', 'created_at', 'activo');
        return $data;
    }


    static public function insertar($nombre)
    {
        DB::table('compania')->insert(
            ['nombre' => $nombre, 'activo' => '1', 'created_at' => DB::raw("NOW()"),'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_compania,$nombre,$activo)
    {
        DB::table('compania')
            ->where('id_compania', $id_compania)
            ->update( ['nombre' => $nombre,  'activo' => $activo, 'updated_at' => DB::raw("NOW()"), 'creado_por'=>Auth::user()->id]);

    }



    static public function show_compania($id_compania){


        $data = DB::table('compania')
            ->where('id_compania', $id_compania)
            ->select('id_compania','nombre', 'created_at', 'activo')
            ->first();
        return $data;

    }


}