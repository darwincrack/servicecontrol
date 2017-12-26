<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\CiudadModels;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CiudadRequest;

class CiudadController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        return view('ciudad.index');
    }




    public function anyData()
    {

        $ciudades =  CiudadModels::listar();

        return Datatables::of($ciudades)
            ->addColumn('action', function ($ciudad) {
                return '<a href="ciudad/editar/'.$ciudad->id_ciudad.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', function ($ciudad) {
                if($ciudad->created_at!='0'){
                    return formato_fecha($ciudad->created_at);
                }
                else{
                    return '';
                }

            })

            ->editColumn('activo', function ($ciudad) {
                if($ciudad->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })

            ->editColumn('nombre', function ($ciudad) {

                return '<a  href="'.url("servicios/ver/id-ciudad/".$ciudad->id_ciudad).'" title="Ver lista de servicios">'.$ciudad->nombre.'</a>';

            })


            ->make(true);

    }

    public function add()
    {

        return view('ciudad.add');
    }


    public function store(CiudadRequest $request)
    {

        $nombre             =   $request->input("nombre");


        CiudadModels::insertar($nombre);

        $request->session()->flash('alert-success', 'Ciudad agregada con exito!!');

        return redirect('ciudad');
    }


    public function editar($id_ciudad)
    {


        $data_ciudad         =  CiudadModels::show_ciudad($id_ciudad);


        if (count($data_ciudad)==0){
            return redirect('ciudad');
        }
        return view('ciudad.editar', ['data_ciudad' =>$data_ciudad]);


    }



    public function store_editar(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|max:20',

        ]);

        $nombre             =   $request->input("nombre");
        $activo             =   $request->input("activo");
        $id_ciudad          =   desencriptar($request->input("id_ciudad"));


        CiudadModels::editar($id_ciudad,$nombre,$activo);

        $request->session()->flash('alert-success', 'Ciudad editada con exito!!');

        return redirect('ciudad');
    }
}
