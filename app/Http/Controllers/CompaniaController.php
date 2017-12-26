<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\CompaniaModels;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CiudadRequest;

class CompaniaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return view('compania.index');
    }




    public function anyData()
    {

        $compania =  CompaniaModels::listar();

        return Datatables::of($compania)
            ->addColumn('action', function ($compania) {
                return '<a href="compania/editar/'.$compania->id_compania.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($compania) {
                if($compania->created_at!='0'){
                    return formato_fecha($compania->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($compania) {
                if($compania->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($compania) {

                return '<a  href="'.url("servicios/ver/id-compania/".$compania->id_compania).'" title="Ver lista de servicios">'.$compania->nombre.'</a>';

            })


            ->make(true);

    }

    public function add()
    {

        return view('compania.add');
    }


    public function store(CiudadRequest $request)
    {

        $nombre             =   $request->input("nombre");


        CompaniaModels::insertar($nombre);

        $request->session()->flash('alert-success', 'Compa&ntilde;ia agregada con exito!!');

        return redirect('compania');
    }


    public function editar($id_compania)
    {
        $data_compania         =  CompaniaModels::show_compania($id_compania);


        if (count($data_compania)==0){
            return redirect('compania');
        }
        return view('compania.editar', ['data_compania' =>$data_compania]);


    }



    public function store_editar(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|max:20',

        ]);

        $nombre             =   $request->input("nombre");
        $activo             =   $request->input("activo");
        $id_compania          =   desencriptar($request->input("id_compania"));


        CompaniaModels::editar($id_compania,$nombre,$activo);

        $request->session()->flash('alert-success', 'compa&ntilde;ia editada con exito!!');

        return redirect('compania');
    }
}
