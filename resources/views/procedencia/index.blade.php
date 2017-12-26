@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/procedencia/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nueva Procedencia
</a>
@endpush

@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
@endpush

@section('title', 'Procedencia/ Ubicación')

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->




    <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="users-table">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre Procedencia</th>
            <th>Procedencia/ Ubicacion</th>
            <th>Ciudad</th>
            <th>Fecha Alquiler</th>
            <th>Activo</th>
            <th>Motivo</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>

    </div>
@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            },
            ajax: 'procedencia/data',
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            columns: [
                {data: 'id_procedencia', name: 'procedencia.id_procedencia'},
                {data: 'nombre_procedencia', name: 'procedencia.nombre'},
                {data: 'nombre_tipo_procedencia', name: 'tipo_procedencia.nombre'},
                {data: 'nombre_ciudad', name: 'ciudad.nombre'},
                {data: 'fecha_alquiler', name: 'procedencia.fecha_alquiler'},
                {data: 'activo', name: 'procedencia.activo'},
                {data: 'motivo', name: 'motivo'},
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