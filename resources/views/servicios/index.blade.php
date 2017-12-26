@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/servicios/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo Servicio o Equipo
</a>
@endpush

@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
<style>
    .dataTables_filter {
        display: none;
    }

     td{text-transform: uppercase;}


</style>
@endpush

@section('title', 'Buscar Servicios o Equipos')

@section('content')




    {!! csrf_field() !!}
    <div class="ibox-content animated fadeInDown">

            <div class="form-group">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group"> <input type="text" role=search" class="form-control m-b" name="busqueda" id="search" value="" placeholder="Num telefonico, Num circuito, Plan, IMEI, FCC, Modelo, Nombre Ciudad, Num Contrato " value="{{old('busqueda')}}"> <span class="input-group-btn"> <button id="button-buscar" type="button" class="btn btn-primary">Buscar
                                        </button> </span></div>
                    </div>

                </div>
            </div>


    </div>



    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->


    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="users-table" style="display: none;">

            <thead>
            <tr>

                <th>id_servicio</th>
                <th>Procedencia/ Ubicacion</th>
                <th>Ciudad</th>
                <th>Tipo de Procedencia</th>
                <th>Operadora</th>
                <th>Tipo de Servicio</th>
                <th>Nombre del Plan</th>
                <th>Numero tlf o Circuito</th>
                <th>Estatus</th>
                <th>Detalles</th>
                <th>Edit</th>
            </tr>
            </thead>
        </table>

    </div>
@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready(function(){

        $(document).keypress(function(e) {
            if(e.which == 13) {
                mostrar_resultados();
            }
        });


        $("#button-buscar").click(function() {
                mostrar_resultados();

        });


        var mostrar_resultados= function () {

            $('#users-table').show();
            $('#users-table').dataTable().fnDestroy();

            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
                },

                ajax: {
                    'url': 'servicios/busqueda',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    "data" : {
                        'busqueda' : $("#search").val(),
                        'ciudad' : $("#ciudades").val(),
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


/*            $('#users-table').on( 'draw', function () {
                var body = $( table.table().body() );

                body.unhighlight();
                body.highlight( table.search() );
            } );*/

        }

    });

</script>

@endpush