@extends('layouts.template')

@section('title', 'Titulo de la pagina')

@section('nombre_usuario', 'Darwincrack')

@section('content')

<form method="POST">

    {!! csrf_field() !!}
   {{-- <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
    <textarea>mi notasss</textarea>
    <button type="submit">Crear note</button>

</form>
@endsection