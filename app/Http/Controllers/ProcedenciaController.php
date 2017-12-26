<?php

namespace App\Http\Controllers;

use App\models\ProcedenciaModels;
use App\models\ListaModels;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use Input;

class ProcedenciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('procedencia.index');
    }


    public function anyData()
    {

        $procedencias  =  ProcedenciaModels::listar();

        return Datatables::of($procedencias)
            ->addColumn('action', function ($procedencia) {
                return '<a href="procedencia/editar/'.$procedencia->id_procedencia.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('fecha_alquiler', function ($procedencia) {
                if($procedencia->fecha_alquiler!='0'){
                    return date('d/m/Y', strtotime($procedencia->fecha_alquiler));
                }
                else{
                    return 'NO ALQUILADO';
                }

            })

            ->editColumn('activo', function ($procedencia) {
                if($procedencia->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })


            ->editColumn('nombre_ciudad', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-ciudad/".$servicio->id_ciudad).'" title="Ver lista de servicios">'.$servicio->nombre_ciudad.'</a>';

            })

            ->editColumn('nombre_procedencia', function ($servicio) {

                return '<a  href="'.url("servicios/ver/id-procedencia/".$servicio->id_procedencia).'" title="Ver lista de servicios">'.$servicio->nombre_procedencia.'</a>';

            })



            ->make(true);

    }


    public function add()
    {

        $data_tipo_procedencias  =  ListaModels::tipo_procedencias();
        $data_ciudades  =  ListaModels::ciudades();
        return view('procedencia.add', ['data_tipo_procedencias' => $data_tipo_procedencias, 'data_ciudades' =>$data_ciudades]);
    }


    public function editar($id_procedencia)
    {

        $data_procedencias          =  ProcedenciaModels::show_procedencia($id_procedencia);

        if (count($data_procedencias)==0){
            return redirect('procedencia');
        }

        $data_tipo_procedencias     =  ListaModels::tipo_procedencias();
        $data_ciudades              =  ListaModels::ciudades();
        $data_alquiler_procedencia  =  ProcedenciaModels::show_alquiler_procedencia($id_procedencia);





    if (count($data_alquiler_procedencia)==0)
    {
        $nombre_inquilino       =   '';
        $persona_contacto       =   '';
        $tlf_persona_contacto   =   '';
    }
    else
    {
        $nombre_inquilino       =   $data_alquiler_procedencia->nombre_inquilino;
        $persona_contacto       =   $data_alquiler_procedencia->persona_contacto;
        $tlf_persona_contacto   =   $data_alquiler_procedencia->tlf_persona_contacto;



    }

        if($data_procedencias->fecha_alquiler !='')
        {
            $procedencia_fecha_alquiler     =  formato_fecha($data_procedencias->fecha_alquiler);
        }
        else
        {
            $procedencia_fecha_alquiler     =   '';
        }

        return view('procedencia.editar', ['id_procedencia' =>$id_procedencia, 'data_procedencias' => $data_procedencias, 'data_alquiler_procedencia' => $data_alquiler_procedencia,'data_tipo_procedencias' => $data_tipo_procedencias, 'data_ciudades' =>$data_ciudades, 'procedencia_fecha_alquiler' => $procedencia_fecha_alquiler, 'nombre_inquilino' => $nombre_inquilino, 'persona_contacto' => $persona_contacto, 'tlf_persona_contacto' => $tlf_persona_contacto]);


    }


    public function store(Request $request)
    {

        if($request->input('activo')!="1")
        {

            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
                'motivo' => 'required|max:200',
            ]);
        }




        if($request->input('alquilado')=="1")
        {

            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
                'fecha_alquiler' => 'required|date_format:"d/m/Y"',
                'nombre_inquilino' => 'required|max:40',
                'nombre_responsable' => 'required|max:40',
                'tlf_persona_contacto' => 'required|numeric',
            ]);
        }
        else{
            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
            ]);
        }


        $id_tipo_procedencia    =   $request->input("tipo_procedencia");
        $id_ciudad              =   $request->input("ciudades");
        $nombre_procedencia     =   $request->input("nombre_procedencia");
        $activo                 =   $request->input("activo");
        $motivo                 =   $request->input("motivo");
        $alquilado              =   $request->input("alquilado");
        $nombre_inquilino       =   $request->input("nombre_inquilino");
        $nombre_responsable     =   $request->input("nombre_responsable");
        $tlf_persona_contacto   =   $request->input("tlf_persona_contacto");

        if($request->input("fecha_alquiler") !='')
        {
            $fecha_alquiler     =  formato_fecha($request->input("fecha_alquiler"),'Y-m-d');

        }
        else
        {
            $fecha_alquiler     =   NULL;
        }

        ProcedenciaModels::insertar($id_tipo_procedencia,$id_ciudad,$nombre_procedencia,$activo,$motivo,$alquilado, $fecha_alquiler,$nombre_inquilino,$nombre_responsable,$tlf_persona_contacto);

        $request->session()->flash('alert-success', 'Procedencia agregada con exito!!');

        return redirect('procedencia');
    }



    public function store_editar(Request $request)
    {


        if($request->input('activo')!="1")
        {

            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
                'motivo' => 'required|max:200',
            ]);
        }




        if($request->input('alquilado')=="1")
        {

            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
                'fecha_alquiler' => 'required|date_format:"d-m-Y"',
                'nombre_inquilino' => 'required|max:40',
                'nombre_responsable' => 'required|max:40',
                'tlf_persona_contacto' => 'required|numeric',
            ]);
        }
        else{
            $this->validate($request, [
                'nombre_procedencia' => 'required|max:40',
            ]);
        }


        $id_tipo_procedencia    =   $request->input("tipo_procedencia");
        $id_ciudad              =   $request->input("ciudades");
        $nombre_procedencia     =   $request->input("nombre_procedencia");
        $activo                 =   $request->input("activo");
        $motivo                 =   $request->input("motivo");
        $alquilado              =   $request->input("alquilado");
        $nombre_inquilino       =   $request->input("nombre_inquilino");
        $nombre_responsable     =   $request->input("nombre_responsable");
        $id_procedencia         =   $request->input('id_procedencia');
        $tlf_persona_contacto   =   $request->input("tlf_persona_contacto");

        if($request->input("fecha_alquiler") !='')
        {
            $fecha_alquiler  =  formato_fecha($request->input("fecha_alquiler"),'Y-m-d');


        }
        else
        {
            $fecha_alquiler  =  NULL;
        }


        ProcedenciaModels::editar(desencriptar($id_procedencia),$id_tipo_procedencia,$id_ciudad,$nombre_procedencia,$activo,$motivo,$alquilado, $fecha_alquiler,$nombre_inquilino,$nombre_responsable,$tlf_persona_contacto);

        $request->session()->flash('alert-success', 'Procedencia editada con exito!!');

        return redirect('procedencia');
    }



}
