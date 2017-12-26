<?php

namespace App\Http\Controllers;


use App\Http\Requests\TipoServicioRequest;
use App\models\TipoServiciosModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;


class TipoServiciosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('TipoServicios.index');
    }


    public function anyData()
    {

        $TipoServicios =  TipoServiciosModels::listar();

        return Datatables::of($TipoServicios)
            ->addColumn('action', function ($TipoServicio) {
                return '<a href="tipo-servicios/editar/'.$TipoServicio->id_tipo_servicios.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($TipoServicio) {
                if($TipoServicio->created_at!='0'){
                    return formato_fecha($TipoServicio->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($TipoServicio) {
                if($TipoServicio->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($TipoServicio) {

                return '<a  href="'.url("servicios/ver/id-tipo-servicios/".$TipoServicio->id_tipo_servicios).'" title="Ver lista de servicios">'.$TipoServicio->nombre.'</a>';

            })


            ->make(true);

    }

    public function add()
    {

        return view('TipoServicios.add');
    }


    public function store(TipoServicioRequest $request)
    {

        $nombre             =   $request->input("nombre");
        $descripcion        =   $request->input("descripcion");


        TipoServiciosModels::insertar($nombre,$descripcion);

        $request->session()->flash('alert-success', 'Tipo de Servicio agregado con exito!!');

        return redirect('tipo-servicios');
    }



    public function editar($id_tipo_servicio)
    {


       $data_tipo_servicios         =  TipoServiciosModels::show_tipo_servicio($id_tipo_servicio);


        if (count($data_tipo_servicios)==0){
            return redirect('tipo-servicios');
        }
        return view('TipoServicios.editar', ['data_tipo_servicios' =>$data_tipo_servicios]);


    }



    public function store_editar(TipoServicioRequest $request)
    {

            $nombre             =   $request->input("nombre");
            $descripcion        =   $request->input("descripcion");
            $activo             =   $request->input("activo");
            $id_tipo_servicio   =   $request->input("id_tipo_servicio");


            TipoServiciosModels::editar(desencriptar($id_tipo_servicio),$nombre,$descripcion,$activo);

            $request->session()->flash('alert-success', 'Tipo de Servicio editado con exito!!');

            return redirect('tipo-servicios');
    }




}
