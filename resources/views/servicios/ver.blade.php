@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/servicios/editar/'.$id_servicio) }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Editar servicio o equipo
</a>
@endpush

@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
<style>
    .content-historico table th  {
        text-align: center;
    }

</style>
@endpush

@section('title', 'Detalles de Servicio o equipo')

@section('content')




    {!! csrf_field() !!}

    <div class="ibox-content animated slideInDown">
        <form class="form-horizontal" role=search" >
            <div class="form-group">

                <div class="row">
                    @foreach($data_id_servicio as $data_id_servicios)
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tlf o circuito:</th>
                                        <td>{{$data_id_servicios->telefono_circuito}}</td>
                                    </tr>
                                    <tr>
                                        <th>Estatus: </th>
                                        <td>   <?php
                                            if(trim(strtoupper($data_id_servicios->estatus))=="ACTIVO"){
                                                echo "<span class='badge badge-success'>ACTIVO</span>";
                                            }
                                            elseif(trim(strtoupper($data_id_servicios->estatus))=="ELIMINADO"){
                                                echo "<span class='badge badge-danger'>ELIMINADO</span>";
                                            }
                                            elseif(trim(strtoupper($data_id_servicios->estatus))=="SUSPENDIDO"){
                                                echo "<span class='badge badge-warning'>SUSPENDIDO</span>";
                                            }
                                            else
                                            {
                                                echo $data_id_servicios->estatus;
                                            }?></td>





                                    </tr>
                                    <tr>
                                        <th>Tipo de servicio:</th>
                                        <td>{{$data_id_servicios->nombre_tipo_servicio}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nombre del servicio:</th>
                                        <td>{{$data_id_servicios->nombre_servicio}}</td>
                                    </tr>

                                    <tr>
                                        <th>Compa&ntilde;ia: </th>
                                        <td>{{$data_id_servicios->compania}}</td>
                                    </tr>

                                    <tr>
                                        <th>Número de contrato: </th>
                                        <td>{{$data_id_servicios->num_contrato}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha Inicio Contrato: </th>
                                        <td>{{formato_fecha($data_id_servicios->fecha_inicio_contrato)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha fin Contrato: </th>
                                        <td>{{formato_fecha($data_id_servicios->fecha_finalizacion_contrato)}}</td>
                                    </tr>
                                    </thead>
                                </table>

                            </div>




                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">



                            <div class="ibox-content">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>FCC: </th>
                                        <td>{{ ($data_id_servicios->fcc!="") ? $data_id_servicios->fcc:"No posee"}}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo: </th>
                                        <td>{{ ($data_id_servicios->modelo!="") ? $data_id_servicios->modelo:"No posee"}}</td>
                                    </tr>
                                    <tr>
                                        <th>Serial: </th>
                                        <td>{{ ($data_id_servicios->serial!="") ? $data_id_servicios->serial:"No posee"}}</td>
                                    </tr>

                                    <tr>
                                        <th>IMEI: </th>
                                        <td>{{ ($data_id_servicios->imei!="") ? $data_id_servicios->imei:"No posee"}}</td>
                                    </tr>
                                    <tr>
                                        <th>Propio: </th>
                                        <td>{{ ($data_id_servicios->propio=="1") ? "SI":"NO"}}</td>
                                    </tr>
                                    <tr>
                                        <th>Operadora: </th>
                                        <td>{{$data_id_servicios->operadora}}</td>
                                    </tr>
                                    <tr>
                                        <th>Costo del plan: </th>
                                        <td>{{$data_id_servicios->costo_plan}}</td>
                                    </tr>



                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                    @endforeach

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content text-center p-md content-historico">

                                <h2><span class="text-navy">Historico de ubicaciones</span></h2>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Ciudad</th>
                                        <th>Nombre</th>
                                        <th>Tipo de procedencia</th>
                                        <th>Fecha de movimiento</th>
                                        <th>Ubicaci&oacute;n actual</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                @foreach($data_historico_ubicaciones as $data_historico_ubicacion)
                                    <tr>
                                        <td>{{$data_historico_ubicacion->ciudad}}</td>
                                        <td>{{$data_historico_ubicacion->nombre_procedencia}}</td>
                                        <td>{{$data_historico_ubicacion->tipo_procedencia}}</td>
                                        <td>{{formato_fecha($data_historico_ubicacion->fecha_movimiento)}}</td>
                                        <td>{{ ($data_historico_ubicacion->estatus=="1") ? "SI":"NO"}}</td>
                                    </tr>

                                @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>


                </div>






            </div>
        </form>

    </div>




    <br>

@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready(function(){

        $("#button-buscar").click(function() {


            $('#users-table').show();
            $('#users-table').dataTable().fnDestroy();

            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
                },

                ajax: {
                    'url': 'busqueda-avanzada/resultados',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    "data" : {
                        'ciudades' : $("#ciudades").val(),
                        'tipo_procedencias' : $("#tipo_procedencias").val(),
                        'operadoras' : $("#operadoras").val(),
                        'tipos_servicios' : $("#servicios").val(),
                        'id_estatus' : $("#estatus").val()
                    }
                },

                "order": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                columns: [
                    {data: 'id_servicio', name: 'servicio.id_servicio'},
                    {data: 'nombre_procedencia', name: 'procedencia.nombre'},
                    {data: 'ciudad', name: 'ciudad.nombre'},
                    {data: 'nombre_tipo_procedencia', name: 'tipo_procedencia.nombre'},
                    {data: 'nombre_operadora', name: 'operadora.nombre'},
                    {data: 'nombre_tipo_servicio', name: 'tipo_servicios.nombre'},
                    {data: 'nombre_servicio', name: 'servicio.nombre'},
                    {data: 'telefono_circuito', name: 'servicio.telefono_circuito'},
                    {data: 'estatus', name: 'estatus.nombre'},
                    {data: 'detalles', name: 'detalles', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}


                ],
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Reporte de Servicios'},
                    {extend: 'pdf', title: 'Reporte de Servicios'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]
            });

        });


    });







    $('[data-rec]').on('click', function() {

        var path="show-procedencia2/";

        $.getJSON( path+$("#ciudades").val()+"/"+$("#tipo_procedencias").val() )
                .done(function( response, textStatus, jqXHR ) {

                    if (response.success) {
                        $('#procedencia').html("");

                        $('#procedencia').append($('<option>', {
                            value: 'null',
                            text : 'Procedencias'
                        }));

                        $.each(response.data, function(key, value) {

                            $('#procedencia').append($('<option>', {
                                value: value['id_procedencia'],
                                text : value['nombre']
                            }));

                        });
                    }
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) {
                        alert( "Algo ha fallado: " +  textStatus );
                    }
                });


    })

</script>

@endpush