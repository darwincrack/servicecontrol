<?php
/**
 * Created by PhpStorm.
 * User: desarrollo
 * Date: 20/12/2016
 * Time: 17:20
 */

namespace App\models;

use DB;

class ListaModels
{

    static  public function tipo_procedencias()
    {
      return  DB::table('tipo_procedencia')
          ->where('activo', 1)
          ->get();

    }


    static  public function ciudades()
    {
        return  DB::table('ciudad')
            ->where('activo', 1)
            ->get();

    }

    static  public function compania()
    {
        return  DB::table('compania')
            ->where('activo', 1)
            ->get();
    }

    static  public function operadora()
    {
        return  DB::table('operadora')
            ->where('activo', 1)
            ->get();
    }

    static  public function tipo_servicios()
    {
        return  DB::table('tipo_servicios')
            ->where('activo', 1)
            ->get();
    }

    static  public function estatus()
    {
        return  DB::table('estatus')
            ->where('activo', 1)
            ->get();
    }

    static  public function list_procedencias($id_ciudad,$id_tipo_procedencia)
    {
        $data=DB::table('procedencia');
        $data->where('activo', 1);
        if($id_ciudad!='null')
        {
            $data->where('id_ciudad', $id_ciudad);
        }
        if($id_tipo_procedencia!='null')
        {
            $data->where('id_tipo_procedencia', $id_tipo_procedencia);
        }

        $data->select('procedencia.id_procedencia', 'procedencia.nombre');

        return  $data->get();
    }


    static public function procedencia($id_ciudad,$id_tipo_procedencia)
    {
        $data = DB::table('procedencia')
            ->where('activo', 1)
            -> where('id_ciudad', $id_ciudad)
            -> where('id_tipo_procedencia', $id_tipo_procedencia)
            ->select('procedencia.id_procedencia', 'procedencia.nombre')
            ->get();
        return $data;


    }
}