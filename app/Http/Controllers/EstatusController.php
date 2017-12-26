<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\EstatusModels;
use Yajra\Datatables\Datatables;

class EstatusController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return view('estatus.index');
    }




    public function anyData()
    {

        $estatus =  EstatusModels::listar();

        return Datatables::of($estatus)
            ->addColumn('action', function ($estatus) {
                return '<a href="estatus/editar/'.$estatus->id_estatus.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($estatus) {
                if($estatus->created_at!='0'){
                    return formato_fecha($estatus->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($estatus) {
                if($estatus->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($estatus) {

                if(trim(strtoupper($estatus->nombre))=="ACTIVO"){
                    return "<span class='label label-success'>ACTIVO</span>";
                }
                elseif(trim(strtoupper($estatus->nombre))=="ELIMINADO"){
                    return "<span class='label label-danger'>ELIMINADO</span>";
                }
                elseif(trim(strtoupper($estatus->nombre))=="SUSPENDIDO"){
                    return "<span class='label label-warning'>SUSPENDIDO</span>";
                }

                return $estatus->nombre;

            })


            ->make(true);

    }

    public function add()
    {

        return view('estatus.add');
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'nombre' => 'required|max:20|unique:estatus',

        ]);
        $nombre             =   $request->input("nombre");


        EstatusModels::insertar($nombre);

        $request->session()->flash('alert-success', 'Estatus agregado con exito!!');

        return redirect('estatus');
    }


    public function editar($id_estatus)
    {


        $data_estatus         =  EstatusModels::show_estatus($id_estatus);


        if (count($data_estatus)==0){
            return redirect('ciudad');
        }
        return view('Estatus.editar', ['data_estatus' =>$data_estatus]);


    }




    public function store_editar(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|max:20',

        ]);

        $nombre             =   $request->input("nombre");
        $activo             =   $request->input("activo");
        $id_estatus       =   desencriptar($request->input("id_ciudad"));


        EstatusModels::editar($id_estatus,$nombre,$activo);

        $request->session()->flash('alert-success', 'Estatus editado con exito!!');

        return redirect('estatus');
    }
}
