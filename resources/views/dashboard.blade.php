@extends('layouts.template')

@push('css')
{{--rutas css--}}

{{--<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">--}}
@endpush

@section('title', 'Titulo pagina')

@section('content')

    contenido aqui
@stop

@push('scripts')
{{--rutas js y script--}}

{{--<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>--}}

{{--<script>
    tu script
</script>--}}
@endpush