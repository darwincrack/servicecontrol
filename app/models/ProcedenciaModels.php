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

class ProcedenciaModels
{

    static  public function listar()
    {
        $data = DB::table('procedencia')
            ->join('ciudad', 'procedencia.id_ciudad', '=', 'ciudad.id_ciudad')
            ->join('tipo_procedencia', 'procedencia.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia')
/*            ->leftJoin('detalles_alquiler_procedencia', 'procedencia.id_procedencia', '=', 'detalles_alquiler_procedencia.id_procedencia')*/
            ->select('procedencia.id_procedencia as id_procedencia', 'procedencia.nombre AS nombre_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia','ciudad.nombre AS nombre_ciudad' ,'procedencia.id_ciudad AS id_ciudad',DB::raw('IFNULL(procedencia.fecha_alquiler, "0") AS fecha_alquiler'),'procedencia.activo','motivo');

        return $data;

    }

    static public function insertar($id_tipo_procedencia,$id_ciudad,$nombre_procedencia,$activo,$motivo,$alquilado,$fecha_alquiler = NULL,$nombre_inquilino,$nombre_responsable,$tlf_persona_contacto)
    {
        $lastInsertID= DB::table('procedencia')->insertGetId(
            ['id_ciudad' => $id_ciudad, 'id_tipo_procedencia' => $id_tipo_procedencia, 'nombre' => $nombre_procedencia, 'activo' => $activo, 'motivo' => $motivo, 'alquilado' => $alquilado, 'created_at' => DB::raw("NOW()"), 'fecha_alquiler'=>$fecha_alquiler,'creado_por'=>Auth::user()->id]
        );

        if($alquilado==1){

            DB::table('detalles_alquiler_procedencia')->insert(
                ['nombre_inquilino' => $nombre_inquilino, 'fecha_alquiler' => $fecha_alquiler, 'tlf_persona_contacto' => $tlf_persona_contacto, 'persona_contacto' => $nombre_responsable, 'activo' => '1', 'created_at' => DB::raw("NOW()"), 'id_procedencia' => $lastInsertID,'creado_por'=>Auth::user()->id]
            );

        }
    }


    static public function editar($id_procedencia,$id_tipo_procedencia,$id_ciudad,$nombre_procedencia,$activo,$motivo,$alquilado,$fecha_alquiler = NULL,$nombre_inquilino,$nombre_responsable,$tlf_persona_contacto)
    {

        DB::table('procedencia')
            ->where('id_procedencia', $id_procedencia)
            ->update( ['id_ciudad' => $id_ciudad, 'id_tipo_procedencia' => $id_tipo_procedencia, 'nombre' => $nombre_procedencia, 'activo' => $activo, 'motivo' => $motivo, 'alquilado' => $alquilado, 'updated_at' => DB::raw("NOW()"), 'fecha_alquiler'=>$fecha_alquiler,'creado_por'=>Auth::user()->id]);

        DB::table('detalles_alquiler_procedencia')
            ->where('id_procedencia', $id_procedencia)
            ->update(['activo' => null]);

        if($alquilado==1){


            DB::table('detalles_alquiler_procedencia')->insert(
                ['nombre_inquilino' => $nombre_inquilino, 'fecha_alquiler' => $fecha_alquiler, 'tlf_persona_contacto' => $tlf_persona_contacto, 'persona_contacto' => $nombre_responsable, 'activo' => '1', 'created_at' => DB::raw("NOW()"), 'id_procedencia' => $id_procedencia,'creado_por'=>Auth::user()->id]
            );

        }
    }




    static public function show_procedencia($id_procedencia){

        $data = DB::table('procedencia')
            ->where('procedencia.id_procedencia', $id_procedencia)
            ->join('ciudad', 'procedencia.id_ciudad', '=', 'ciudad.id_ciudad')
            ->join('tipo_procedencia', 'procedencia.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia')
            ->select('procedencia.id_procedencia as id_procedencia', 'procedencia.nombre AS nombre_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia' , 'tipo_procedencia.id_tipo_procedencia AS id_tipo_procedencia','ciudad.nombre AS nombre_ciudad' ,'ciudad.id_ciudad AS id_ciudad','procedencia.fecha_alquiler','procedencia.activo','motivo', 'alquilado')
            ->first();
        return $data;

    }

    static public function show_alquiler_procedencia($id_procedencia){

        $data = DB::table('detalles_alquiler_procedencia')
            ->where('id_procedencia', $id_procedencia)
            ->where('activo', 1)
            ->select('nombre_inquilino', 'fecha_alquiler', 'persona_contacto','tlf_persona_contacto','activo')
            ->first();
        return $data;

    }


}