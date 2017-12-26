@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/servicios/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo Servicio o Equipo
</a>
@endpush

@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">

@endpush

@section('title', "Busqueda por: $filter")

@section('content')

    <div class="ibox-content">

        <input type="hidden" id="id" value="{{$id}}">
        <input type="hidden" id="filter" value="{{$filter}}">





    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->


    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="users-table" >

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

    </div>
@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready(function(){


            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
                },


                ajax: "{{ url("servicios/busqueda/$filter/$id") }}",
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
                    {extend: 'excel', title: 'Reporte de Procedencias'},
                    {extend: 'pdf', title: 'Reporte de Procedencias'},

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


</script>

@endpush