<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\OperadoraModels;
use Yajra\Datatables\Datatables;

class OperadoraController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return view('Operadora.index');
    }




    public function anyData()
    {

        $operadora =  OperadoraModels::listar();

        return Datatables::of($operadora)
            ->addColumn('action', function ($operadora) {
                return '<a href="operadora/editar/'.$operadora->id_operadora.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($operadora) {
                if($operadora->created_at!='0'){
                    return formato_fecha($operadora->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($operadora) {
                if($operadora->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($operadora) {

                return '<a  href="'.url("servicios/ver/id-operadora/".$operadora->id_operadora).'" title="Ver lista de servicios">'.$operadora->nombre.'</a>';

            })


            ->make(true);

    }

    public function add()
    {

        return view('operadora.add');
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'nombre' => 'required|max:20|unique:operadora',

        ]);
        $nombre             =   $request->input("nombre");


        OperadoraModels::insertar($nombre);

        $request->session()->flash('alert-success', 'Operadora agregada con exito!!');

        return redirect('operadora');
    }


    public function editar($id_operadora)
    {


        $data_operadora         =  OperadoraModels::show_operadora($id_operadora);


        if (count($data_operadora)==0){
            return redirect('ciudad');
        }
        return view('operadora.editar', ['data_operadora' =>$data_operadora]);


    }




    public function store_editar(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|max:20',

        ]);

        $nombre             =   $request->input("nombre");
        $activo             =   $request->input("activo");
        $id_operadora       =   desencriptar($request->input("id_ciudad"));


        OperadoraModels::editar($id_operadora,$nombre,$activo);

        $request->session()->flash('alert-success', 'Operadora editada con exito!!');

        return redirect('operadora');
    }
}
