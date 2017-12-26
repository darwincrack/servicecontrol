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

class ServicioModels
{


    static  public function listar($busqueda)
    {


        $data = DB::table('servicio');

        if($busqueda==''){
            $data->limit(25);
        }

        $data->orderBy('servicio.id_servicio','desc');
        $data->orwhere('servicio.telefono_circuito','like', "%$busqueda%");
        $data->orwhere('servicio.nombre','like', "%$busqueda%");
        $data->orwhere('operadora.nombre','like', "%$busqueda%");
        $data->orwhere('servicio.fcc','like', "%$busqueda%");
        $data->orwhere('servicio.modelo','like', "%$busqueda%");
        $data->orwhere('servicio.imei','like', "%$busqueda%");
        $data->orwhere('ciudad.nombre','like', "%$busqueda%");
        $data->orwhere('servicio.num_contrato','like', "%$busqueda%");

        $data->join('estatus', 'servicio.id_estatus', '=', 'estatus.id_estatus');
        $data->join('operadora', 'servicio.id_operadora', '=', 'operadora.id_operadora');
        $data->join('tipo_servicios', 'servicio.id_tipo_servicios', '=', 'tipo_servicios.id_tipo_servicios');
        $data->join('procedencia', 'servicio.id_procedencia', '=', 'procedencia.id_procedencia');
        $data->join('tipo_procedencia', 'servicio.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia');
        $data->join('ciudad', 'servicio.id_ciudad', '=', 'ciudad.id_ciudad');
        $data->select('servicio.id_servicio', 'procedencia.nombre AS nombre_procedencia', 'servicio.id_procedencia AS id_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia', 'operadora.nombre AS nombre_operadora', 'tipo_servicios.nombre AS nombre_tipo_servicio', 'servicio.nombre AS nombre_servicio', 'servicio.telefono_circuito as telefono_circuito', 'estatus.nombre AS estatus', 'ciudad.nombre AS ciudad', 'servicio.id_ciudad as id_ciudad');

        return $data->get();

    }


    static  public function busqueda_avanzada($id_ciudad,$id_tipo_procedencia,$id_operadora,$id_tipos_servicios,$id_estatus)
    {


        $data = DB::table('servicio');

        $data->orderBy('servicio.id_servicio','desc');

        if($id_ciudad!='null')
        {
            $data->where('servicio.id_ciudad', $id_ciudad);
        }
        if($id_tipo_procedencia!='null')
        {
            $data->where('servicio.id_tipo_procedencia', $id_tipo_procedencia);
        }
        if($id_operadora!='null')
        {
            $data->where('servicio.id_operadora', $id_operadora);
        }
        if($id_tipos_servicios!='null')
        {
            $data->where('servicio.id_tipo_servicios', $id_tipos_servicios);
        }
        if($id_estatus!='null')
        {
            $data->where('servicio.id_estatus', $id_estatus);
        }


        $data->join('estatus', 'servicio.id_estatus', '=', 'estatus.id_estatus');
        $data->join('operadora', 'servicio.id_operadora', '=', 'operadora.id_operadora');
        $data->join('tipo_servicios', 'servicio.id_tipo_servicios', '=', 'tipo_servicios.id_tipo_servicios');
        $data->join('procedencia', 'servicio.id_procedencia', '=', 'procedencia.id_procedencia');
        $data->join('tipo_procedencia', 'servicio.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia');
        $data->join('ciudad', 'servicio.id_ciudad', '=', 'ciudad.id_ciudad');
        $data->select('servicio.id_servicio', 'procedencia.nombre AS nombre_procedencia', 'servicio.id_procedencia AS id_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia', 'operadora.nombre AS nombre_operadora', 'tipo_servicios.nombre AS nombre_tipo_servicio', 'servicio.nombre AS nombre_servicio', 'servicio.telefono_circuito as telefono_circuito', 'estatus.nombre AS estatus', 'ciudad.nombre AS ciudad', 'servicio.id_ciudad as id_ciudad');


        return $data->get();

    }

    static  public function busqueda_detalle($id_servicio)
    {

        $data = DB::table('servicio');

        $data->orderBy('servicio.id_servicio','asc');

        if($id_servicio!='null')
        {
            $data->where('servicio.id_servicio', $id_servicio);
        }

        $data->join('estatus', 'servicio.id_estatus', '=', 'estatus.id_estatus');
        $data->join('compania', 'servicio.id_compania', '=', 'compania.id_compania');
        $data->join('operadora', 'servicio.id_operadora', '=', 'operadora.id_operadora');
        $data->join('tipo_servicios', 'servicio.id_tipo_servicios', '=', 'tipo_servicios.id_tipo_servicios');
        $data->join('procedencia', 'servicio.id_procedencia', '=', 'procedencia.id_procedencia');
        $data->join('tipo_procedencia', 'servicio.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia');
        $data->join('ciudad', 'servicio.id_ciudad', '=', 'ciudad.id_ciudad');
        /*->leftJoin('detalles_alquiler_procedencia', 'procedencia.id_procedencia', '=', 'detalles_alquiler_procedencia.id_procedencia')*/
        $data->select('servicio.propio','operadora.nombre as operadora','servicio.costo_plan','servicio.imei','servicio.modelo','servicio.serial','servicio.fcc','servicio.fecha_inicio_contrato','servicio.fecha_finalizacion_contrato','servicio.num_contrato','servicio.id_servicio', 'compania.nombre AS compania', 'procedencia.nombre AS nombre_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia', 'operadora.nombre AS nombre_operadora', 'tipo_servicios.nombre AS nombre_tipo_servicio', 'servicio.nombre AS nombre_servicio', 'servicio.telefono_circuito as telefono_circuito', 'estatus.nombre AS estatus', 'ciudad.nombre AS ciudad');



        //     ->select(['procedencia.nombre', 'tipo_procedencia.nombre AS nombre_tipo_procedencia']);

        return $data->get();

    }



    static  public function historico_ubicaciones($id_servicio)
    {

        $data = DB::table('detalles_procedencia_servicios');
        $data->orderBy('detalles_procedencia_servicios.id_detalle_procedencia','desc');
        $data->where('detalles_procedencia_servicios.id_servicio', $id_servicio);
        $data->join('procedencia', 'detalles_procedencia_servicios.id_procedencia', '=', 'procedencia.id_procedencia');
        $data->join('tipo_procedencia', 'procedencia.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia');
        $data->join('ciudad', 'procedencia.id_ciudad', '=', 'ciudad.id_ciudad');
        $data->select('ciudad.nombre as ciudad',  'procedencia.nombre AS nombre_procedencia',  'tipo_procedencia.nombre AS tipo_procedencia', DB::raw('cast(detalles_procedencia_servicios.created_at as date) AS fecha_movimiento'), 'detalles_procedencia_servicios.activo as estatus', 'procedencia.id_procedencia', 'detalles_procedencia_servicios.id_servicio', 'tipo_procedencia.id_tipo_procedencia');

        return $data->get();
    }





    static public function insertar($id_ciudad,$id_tipo_procedencia,$id_procedencia,$id_tipo_servicio,$id_operadora,$id_status,$propio, $num_telefono_circuito, $nombre_plan_equipo,$costo_plan,$imei,$modelo, $fcc,$num_contrato,$fecha_inicio_contrato,$fecha_final_contrato,$id_compania,$serial)
    {
        $lastInsertID= DB::table('servicio')->insertGetId(
            ['id_procedencia'=>$id_procedencia,'id_ciudad'=>$id_ciudad,'id_tipo_procedencia'=>$id_tipo_procedencia,'id_estatus' => $id_status, 'id_operadora' => $id_operadora, 'id_tipo_servicios' => $id_tipo_servicio, 'nombre' => $nombre_plan_equipo, 'telefono_circuito' => $num_telefono_circuito, 'imei' => $imei, 'modelo' => $modelo, 'fcc'=>$fcc,'propio'=>$propio,'created_at' => DB::raw("NOW()"),'num_contrato'=>$num_contrato,'fecha_finalizacion_contrato'=>$fecha_final_contrato,'fecha_inicio_contrato'=>$fecha_inicio_contrato,'costo_plan'=>$costo_plan,'creado_por'=>Auth::user()->id,'id_compania'=> $id_compania,'serial' =>$serial]
        );


        DB::table('detalles_procedencia_servicios')->insert(
            ['id_procedencia' => $id_procedencia, 'id_servicio' => $lastInsertID, 'created_at' => DB::raw("NOW()"), 'activo' => '1','creado_por'=>Auth::user()->id]
        );
    }



    static public function editar($id_servicio,$id_ciudad,$id_tipo_procedencia,$id_procedencia,$id_tipo_servicio,$id_operadora,$id_status,$propio, $num_telefono_circuito, $nombre_plan_equipo,$costo_plan,$imei,$modelo, $fcc,$num_contrato,$fecha_inicio_contrato,$fecha_final_contrato,$id_compania,$serial)
    {
        DB::table('servicio')
            ->where('id_servicio', $id_servicio)
            ->update(['id_procedencia'=>$id_procedencia,'id_ciudad'=>$id_ciudad,'id_tipo_procedencia'=>$id_tipo_procedencia,'id_estatus' => $id_status, 'id_operadora' => $id_operadora, 'id_tipo_servicios' => $id_tipo_servicio, 'nombre' => $nombre_plan_equipo, 'telefono_circuito' => $num_telefono_circuito, 'imei' => $imei, 'modelo' => $modelo, 'fcc'=>$fcc,'propio'=>$propio,'updated_at' => DB::raw("NOW()"),'num_contrato'=>$num_contrato,'fecha_finalizacion_contrato'=>$fecha_final_contrato,'fecha_inicio_contrato'=>$fecha_inicio_contrato,'costo_plan'=>$costo_plan,'creado_por'=>Auth::user()->id,'id_compania'=> $id_compania,'serial'=>$serial]);


        DB::table('detalles_procedencia_servicios')
            ->where('id_servicio', $id_servicio)
            ->update(['activo' => null]);


        DB::table('detalles_procedencia_servicios')->insert(
            ['id_procedencia' => $id_procedencia, 'id_servicio' => $id_servicio, 'created_at' => DB::raw("NOW()"), 'activo' => '1','creado_por'=>Auth::user()->id]
        );
    }





    static public function show_servicio($id_servicio){

        $data = DB::table('servicio')
            ->where('servicio.id_servicio', $id_servicio)
            ->select('id_estatus', 'id_operadora', 'id_tipo_servicios' , 'id_procedencia','id_tipo_procedencia' ,'id_compania' ,'id_ciudad','nombre','telefono_circuito','imei','modelo', 'serial', 'fcc', 'propio', 'fecha_finalizacion_contrato', 'fecha_inicio_contrato', 'costo_plan', 'num_contrato')
            ->first();
        return $data;

    }



    static public function show_tipo_servicio($id_tipo_servicio){


        $data = DB::table('tipo_servicios')
            ->where('id_tipo_servicios', $id_tipo_servicio)
            ->select('id_tipo_servicios','nombre', 'descripcion', 'created_at', 'activo')
            ->first();
        return $data;

    }







    static  public function busquedapor($filter,$id)
    {


        $data = DB::table('servicio');

        $data->orderBy('servicio.id_servicio','desc');

        $data->where("servicio.$filter", $id);

        $data->join('estatus', 'servicio.id_estatus', '=', 'estatus.id_estatus');
        $data->join('operadora', 'servicio.id_operadora', '=', 'operadora.id_operadora');
        $data->join('tipo_servicios', 'servicio.id_tipo_servicios', '=', 'tipo_servicios.id_tipo_servicios');
        $data->join('procedencia', 'servicio.id_procedencia', '=', 'procedencia.id_procedencia');
        $data->join('tipo_procedencia', 'servicio.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia');
        $data->join('ciudad', 'servicio.id_ciudad', '=', 'ciudad.id_ciudad');
        $data->select('servicio.id_servicio', 'procedencia.nombre AS nombre_procedencia', 'servicio.id_procedencia AS id_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia', 'operadora.nombre AS nombre_operadora', 'tipo_servicios.nombre AS nombre_tipo_servicio', 'servicio.nombre AS nombre_servicio', 'servicio.telefono_circuito as telefono_circuito', 'estatus.nombre AS estatus', 'ciudad.nombre AS ciudad', 'servicio.id_ciudad as id_ciudad');

        return $data->get();

    }







}