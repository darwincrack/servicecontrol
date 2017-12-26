<?php

namespace App\Http\Controllers;


use App\Http\Requests\TipoServicioRequest;
use App\models\TipoProcedenciaModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;


class TipoProcedenciaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('TipoProcedencia.index');
    }


    public function anyData()
    {

        $TipoProcedencias =  TipoProcedenciaModels::listar();

        return Datatables::of($TipoProcedencias)
            ->addColumn('action', function ($TipoProcedencia) {
                return '<a href="tipo-procedencia/editar/'.$TipoProcedencia->id_tipo_procedencia.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($TipoProcedencia) {
                if($TipoProcedencia->created_at!='0'){
                    return formato_fecha($TipoProcedencia->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($TipoProcedencia) {
                if($TipoProcedencia->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($TipoProcedencia) {

                return '<a  href="'.url("servicios/ver/id-tipo-servicios/".$TipoProcedencia->id_tipo_procedencia).'" title="Ver lista de servicios">'.$TipoProcedencia->nombre.'</a>';

            })


            ->make(true);

    }

    public function add()
    {

        return view('TipoProcedencia.add');
    }


    public function store(TipoServicioRequest $request)
    {

        $nombre             =   $request->input("nombre");
        $descripcion        =   $request->input("descripcion");


        TipoProcedenciaModels::insertar($nombre,$descripcion);

        $request->session()->flash('alert-success', 'Tipo de Procedencia agregado con exito!!');

        return redirect('tipo-procedencia');
    }



    public function editar($id_tipo_procedenia)
    {


       $data_tipo_procedencia         =  TipoProcedenciaModels::show_tipo_procedencia($id_tipo_procedenia);


        if (count($data_tipo_procedencia)==0){
            return redirect('tipo-procedencia');
        }
        return view('TipoProcedencia.editar', ['data_tipo_procedencia' =>$data_tipo_procedencia]);


    }



    public function store_editar(TipoServicioRequest $request)
    {

            $nombre                 =   $request->input("nombre");
            $descripcion            =   $request->input("descripcion");
            $activo                 =   $request->input("activo");
            $id_tipo_procedencia    =   $request->input("id_tipo_procedencia");


            TipoProcedenciaModels::editar(desencriptar($id_tipo_procedencia),$nombre,$descripcion,$activo);

            $request->session()->flash('alert-success', 'Tipo de procedencia editado con exito!!');

            return redirect('tipo-procedencia');
    }




}
