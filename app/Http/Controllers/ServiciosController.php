<?php

namespace App\Http\Controllers;

use App\models\ListaModels;
use App\models\ServicioModels;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;



class ServiciosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('servicios.index');
    }


    public function anyData(Request $request)
    {
        $busqueda=$request->input("busqueda");

        $servicios  =  ServicioModels::listar($busqueda);

        return Datatables::of($servicios)
            ->addColumn('detalles', function ($servicio) {
                return '<a href='. url("servicios/detalles/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>';
            })



            ->addColumn('action', function ($servicio) {
                return '<a href='. url("servicios/editar/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })

            ->editColumn('ciudad', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-ciudad/".$servicio->id_ciudad).'" title="Ver lista de servicios">'.$servicio->ciudad.'</a>';

            })

            ->editColumn('nombre_procedencia', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-procedencia/".$servicio->id_procedencia).'" title="Ver lista de servicios">'.$servicio->nombre_procedencia.'</a>';

            })


            ->editColumn('estatus', function ($servicio) {

                if(trim(strtoupper($servicio->estatus))=="ACTIVO"){
                    return "<span class='label label-success'>ACTIVO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="ELIMINADO"){
                    return "<span class='label label-danger'>ELIMINADO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="SUSPENDIDO"){
                    return "<span class='label label-warning'>SUSPENDIDO</span>";
                }

                    return $servicio->estatus;

            })



            ->make(true);
    }

    public function busqueda_avanzada(Request $request)
    {
        $id_ciudad              =   $request->input("ciudades");
        $id_tipo_procedencias   =   $request->input("tipo_procedencias");
        $id_operadoras          =   $request->input("operadoras");
        $id_tipos_servicios     =   $request->input("tipos_servicios");
        $id_estatus             =   $request->input("id_estatus");

        $servicios              =  ServicioModels::busqueda_avanzada($id_ciudad,$id_tipo_procedencias,$id_operadoras,$id_tipos_servicios,$id_estatus);

        return Datatables::of($servicios)
            ->addColumn('detalles', function ($servicio) {
                return '<a href='. url("servicios/detalles/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>';
            })



            ->addColumn('action', function ($servicio) {
                return '<a href='. url("servicios/editar/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })

            ->editColumn('ciudad', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-ciudad/".$servicio->id_ciudad).'" title="Ver por Ciudad">'.$servicio->ciudad.'</a>';

            })

            ->editColumn('nombre_procedencia', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-procedencia/".$servicio->id_procedencia).'" title="Ver por Procedencia">'.$servicio->nombre_procedencia.'</a>';

            })

            ->editColumn('estatus', function ($servicio) {

                if(trim(strtoupper($servicio->estatus))=="ACTIVO"){
                    return "<span class='label label-success'>ACTIVO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="ELIMINADO"){
                    return "<span class='label label-danger'>ELIMINADO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="SUSPENDIDO"){
                    return "<span class='label label-warning'>SUSPENDIDO</span>";
                }

                return $servicio->estatus;

            })


            ->make(true);
    }



    public function select_procedencia($id_ciudad,$id_tipo_procedencia){

       $data_procedencia     = ListaModels::procedencia($id_ciudad,$id_tipo_procedencia);

       return Response::json(['success'=>true,'data'=>$data_procedencia]);
    }




    public function select_procedencia2($id_ciudad,$id_tipo_procedencia){

        $data_procedencia     = ListaModels::list_procedencias($id_ciudad,$id_tipo_procedencia);

        return Response::json(['success'=>true,'data'=>$data_procedencia]);
    }




    public function add()
    {
        $data_tipo_procedencias  =  ListaModels::tipo_procedencias();
        $data_ciudades           =  ListaModels::ciudades();
        $data_compania           =  ListaModels::compania();
        $data_operadoras         =  ListaModels::operadora();
        $data_estatus            =   ListaModels::estatus();
        $data_tipo_servicios     = ListaModels::tipo_servicios();
        $data_procedencias        = ListaModels::procedencia(1,1);

        return view('servicios.add', ['data_tipo_procedencias' => $data_tipo_procedencias, 'data_ciudades' =>$data_ciudades,'data_operadoras' => $data_operadoras, 'data_estatus' =>$data_estatus, 'data_tipo_servicios' =>$data_tipo_servicios, 'data_procedencias' =>$data_procedencias, 'data_compania' => $data_compania]);

    }



    public  function store(Request $request){


        $this->validate($request, [
            'num_telefono_circuito' => 'required|max:11',
            'inicio_contrato' => 'date_format:"d-m-Y"',
            'final_contrato' => 'date_format:"d-m-Y"',
            'ciudades' => 'required',
            'tipo_procedencia' => 'required',
            'procedencia' => 'required',
            'tipo_servicio' => 'required',
            'operadora' => 'required',
            'estatus' => 'required',
            'id_compania' => 'required',
            'serial' => 'max:40'

        ]);


        $id_ciudad                  =   $request->input("ciudades");
        $id_tipo_procedencia        =   $request->input("tipo_procedencia");
        $id_tipo_servicio           =   $request->input("tipo_servicio");
        $id_operadora               =   $request->input("operadora");
        $id_procedencia             =   $request->input("procedencia");
        $id_status                  =   $request->input("estatus");
        $propio                     =   $request->input("propio");
        $num_telefono_circuito      =   $request->input("num_telefono_circuito");
        $nombre_plan_equipo         =   $request->input("nombre_plan");
        $costo_plan                 =   $request->input("costo_plan");
        $imei                       =   $request->input("imei");
        $modelo                     =   $request->input("modelo");
        $fcc                        =   $request->input("fcc");
        $num_contrato               =   $request->input("num_contrato");
        $id_compania                =   $request->input("id_compania");
        $serial                     =   $request->input("serial");



        if($request->input("inicio_contrato") !='')
        {
            $fecha_inicio_contrato     =  formato_fecha($request->input("inicio_contrato"),'Y-m-d');

        }
        else
        {
            $fecha_inicio_contrato     =   NULL;
        }

        if($request->input("final_contrato") !='')
        {
            $fecha_final_contrato     =  formato_fecha($request->input("final_contrato"),'Y-m-d');

        }
        else
        {
            $fecha_final_contrato     =   NULL;
        }


        ServicioModels::insertar($id_ciudad,$id_tipo_procedencia,$id_procedencia, $id_tipo_servicio,$id_operadora,$id_status,$propio, $num_telefono_circuito, $nombre_plan_equipo,$costo_plan,$imei,$modelo, $fcc,$num_contrato,$fecha_inicio_contrato,$fecha_final_contrato,$id_compania,$serial);

        $request->session()->flash('alert-success', 'Servicio Agregado con exito!!');
        return redirect('/');


    }



    public function editar($id_servicio)
    {
        $data_servicio          =  ServicioModels::show_servicio($id_servicio);

        if (count($data_servicio)==0){
            //return redirect('procedencia');
            return "no encontrado";
        }

        $data_tipo_procedencias  =  ListaModels::tipo_procedencias();
        $data_ciudades           =  ListaModels::ciudades();
        $data_operadoras         =  ListaModels::operadora();
        $data_compania           =  ListaModels::compania();
        $data_estatus            =  ListaModels::estatus();
        $data_tipo_servicios     =  ListaModels::tipo_servicios();
        $data_procedencias        = ListaModels::procedencia($data_servicio->id_ciudad,$data_servicio->id_tipo_procedencia,$data_servicio->id_compania);



        if($data_servicio->fecha_inicio_contrato !='')
        {
            $servicio_fecha_inicio_contrato     =  formato_fecha($data_servicio->fecha_inicio_contrato);
        }
        else
        {
            $servicio_fecha_inicio_contrato     =   '';
        }


        if($data_servicio->fecha_finalizacion_contrato !='')
        {
            $servicio_fecha_finalizacion_contrato     =  formato_fecha($data_servicio->fecha_finalizacion_contrato);
        }
        else
        {
            $servicio_fecha_finalizacion_contrato     =   '';
        }

        return view('servicios.editar',  ['id_servicio'=>$id_servicio,'data_servicio'=>$data_servicio, 'data_tipo_procedencias' => $data_tipo_procedencias, 'data_ciudades' =>$data_ciudades,'data_operadoras' => $data_operadoras, 'data_estatus' =>$data_estatus, 'data_tipo_servicios' =>$data_tipo_servicios, 'data_procedencias' =>$data_procedencias,'servicio_fecha_inicio_contrato'=>$servicio_fecha_inicio_contrato,'servicio_fecha_finalizacion_contrato'=>$servicio_fecha_finalizacion_contrato,'data_compania'=>$data_compania]);


    }



    public  function store_editar(Request $request){


        $this->validate($request, [
            'num_telefono_circuito' => 'required|max:11',
            'inicio_contrato' => 'date_format:"d-m-Y"',
            'final_contrato' => 'date_format:"d-m-Y"',
            'ciudades' => 'required',
            'tipo_procedencia' => 'required',
            'procedencia' => 'required',
            'tipo_servicio' => 'required',
            'operadora' => 'required',
            'estatus' => 'required',
            'id_compania' => 'required',
            'serial' => 'max:40'

        ]);

        $id_servicio                =   desencriptar($request->input("id_servicio"));
        $id_ciudad                  =   $request->input("ciudades");
        $id_compania                =   $request->input("id_compania");
        $id_tipo_procedencia        =   $request->input("tipo_procedencia");
        $id_tipo_servicio           =   $request->input("tipo_servicio");
        $id_operadora               =   $request->input("operadora");
        $id_procedencia             =   $request->input("procedencia");
        $id_status                  =   $request->input("estatus");
        $propio                     =   $request->input("propio");
        $num_telefono_circuito      =   $request->input("num_telefono_circuito");
        $nombre_plan_equipo         =   $request->input("nombre_plan");
        $costo_plan                 =   $request->input("costo_plan");
        $imei                       =   $request->input("imei");
        $modelo                     =   $request->input("modelo");
        $fcc                        =   $request->input("fcc");
        $num_contrato               =   $request->input("num_contrato");
        $serial                     =   $request->input("serial");



        if($request->input("inicio_contrato") !='')
        {
            $fecha_inicio_contrato     =  formato_fecha($request->input("inicio_contrato"),'Y-m-d');

        }
        else
        {
            $fecha_inicio_contrato     =   NULL;
        }

        if($request->input("final_contrato") !='')
        {
            $fecha_final_contrato     =  formato_fecha($request->input("final_contrato"),'Y-m-d');

        }
        else
        {
            $fecha_final_contrato     =   NULL;
        }


        ServicioModels::editar($id_servicio,$id_ciudad,$id_tipo_procedencia,$id_procedencia, $id_tipo_servicio,$id_operadora,$id_status,$propio, $num_telefono_circuito, $nombre_plan_equipo,$costo_plan,$imei,$modelo, $fcc,$num_contrato,$fecha_inicio_contrato,$fecha_final_contrato,$id_compania,$serial);


        $request->session()->flash('alert-success', 'Servicio editado con exito!!');

        return redirect('/');


    }



    public function add_select()
    {

        $data_tipo_procedencias     =  ListaModels::tipo_procedencias();
        $data_ciudades              =  ListaModels::ciudades();
        $data_operadora             =  ListaModels::operadora();
        $data_tipo_servicios        =  ListaModels::tipo_servicios();
        $data_estatus               =  ListaModels::estatus();
        $data_procedencias          =  ListaModels::list_procedencias('null','null');

        return view('servicios.busqueda-avanzada', ['data_tipo_procedencias' => $data_tipo_procedencias, 'data_ciudades' =>$data_ciudades, 'data_operadora' =>$data_operadora,'data_tipo_servicios' =>$data_tipo_servicios,'data_estatus' =>$data_estatus, 'data_procedencias'=>$data_procedencias]);
    }

    public function todo_detalle($id_servicio)
    {


        $data_id_servicio               =  ServicioModels::busqueda_detalle($id_servicio);
        $data_historico_ubicaciones     =  ServicioModels::historico_ubicaciones($id_servicio);

        if(count($data_id_servicio)==0) return redirect('/');
        if(count($data_historico_ubicaciones)==0) return redirect('/');

        return view('servicios.ver', ['data_id_servicio' =>$data_id_servicio, 'id_servicio'=>$id_servicio,'data_historico_ubicaciones'=>$data_historico_ubicaciones]);


    }



    public function busquedapor($filter,$id){


        return view('servicios.busquedapor', ['filter'=>$filter, 'id'=>$id]);


    }



    public function busquedaporanydata($filter,$id){


        $filter     =   str_replace("-","_",$filter);

        $servicios  =  ServicioModels::busquedapor($filter,$id);

        return Datatables::of($servicios)
            ->addColumn('detalles', function ($servicio) {
                return '<a href='. url("servicios/detalles/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>';
            })



            ->addColumn('action', function ($servicio) {
                return '<a href='. url("servicios/editar/".$servicio->id_servicio).' class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })

            ->editColumn('ciudad', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-ciudad/".$servicio->id_ciudad).'" title="Ver lista de servicios">'.$servicio->ciudad.'</a>';

            })

            ->editColumn('nombre_procedencia', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-procedencia/".$servicio->id_procedencia).'" title="Ver lista de servicios">'.$servicio->nombre_procedencia.'</a>';

            })

            ->editColumn('estatus', function ($servicio) {

                if(trim(strtoupper($servicio->estatus))=="ACTIVO"){
                    return "<span class='label label-success'>ACTIVO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="ELIMINADO"){
                    return "<span class='label label-danger'>ELIMINADO</span>";
                }
                elseif(trim(strtoupper($servicio->estatus))=="SUSPENDIDO"){
                    return "<span class='label label-warning'>SUSPENDIDO</span>";
                }

                return $servicio->estatus;

            })

            ->make(true);


    }



}