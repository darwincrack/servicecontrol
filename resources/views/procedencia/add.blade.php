@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/procedencia/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nueva Procedencia
</a>
@endpush

@push('css')

<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/datapicker/datepicker3.css') }}">
@endpush

@section('title', 'Agregar Procedencia/ Ubicación')

@section('content')





    {{--    @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif--}}


        <div class="ibox float-e-margins animated fadeInDown">

            <div class="ibox-content">
                <form class="form-horizontal" method="post" action="{{ URL::asset('procedencia/add') }}">
                    {!! csrf_field() !!}


                    <div class="form-group"><label class="col-sm-2 control-label">Tipo Procedencias</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="tipo_procedencia">
                                @foreach($data_tipo_procedencias as $data_tipo_procedencia)
                                    <option value="{{$data_tipo_procedencia->id_tipo_procedencia}}">{{$data_tipo_procedencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group"><label class="col-sm-2 control-label">Ciudades</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="ciudades">
                                @foreach($data_ciudades as $data_ciudad)
                                    <option value="{{$data_ciudad->id_ciudad}}">{{$data_ciudad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nombre_procedencia') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre_procedencia" placeholder="Ejemplo: Stadium Universitario" class="form-control" value="{{ old('nombre_procedencia') }}"> @if ($errors->has('nombre_procedencia'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre_procedencia') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label">Activo</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"    class="onoffswitch-checkbox" id="activo" name="activo" value="1" {{(old('activo'))?"checked=''":'null'}}  >
                                    <label class="onoffswitch-label" for="activo">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('motivo') ? ' has-error' : '' }}" id="content_motivo" @if (old('activo') == 1) style="display: none" @else style="display: block" @endif>
                        <label class="col-lg-2 control-label">Motivo</label>

                        <div class="col-lg-10"><input type="text" name="motivo" placeholder="motivo" class="form-control" value="{{ old('motivo') }}">
                            @if ($errors->has('motivo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('motivo') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label">Alquilado</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" DISABLED=""  class="onoffswitch-checkbox" id="alquilado" name="alquilado" value="1" @if (old('alquilado') == "1") checked="" @endif >
                                    <label class="onoffswitch-label" for="alquilado">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="content_alquiler" @if (old('alquilado') == 1) style="display: block" @else style="display: none" @endif >

                        <div class="form-group{{ $errors->has('fecha_alquiler') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Fecha Alquiler</label>

                            <div class="col-lg-10">
                                <div  id="data_1">

                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fecha_alquiler" id="fecha_alquiler" class="form-control" value="{{ old('fecha_alquiler') }}">
                                        @if ($errors->has('fecha_alquiler'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('fecha_alquiler') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('nombre_inquilino') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Razón Social del Inquilino</label>

                            <div class="col-lg-10"><input type="text" name="nombre_inquilino" id="nombre_inquilino" placeholder="Ejemplo: Jhon Doe C.A." class="form-control" value="{{ old('nombre_inquilino') }}"> @if ($errors->has('nombre_inquilino'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nombre_inquilino') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nombre_responsable') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre persona responsable del alquiler</label>

                            <div class="col-lg-10"><input type="text" name="nombre_responsable" id="nombre_inquilino" placeholder="Ejemplo: Darwin Cedeño" class="form-control" value="{{ old('nombre_responsable') }}"> @if ($errors->has('nombre_responsable'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nombre_responsable') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('tlf_persona_contacto') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Tlf Persona Contacto</label>

                            <div class="col-lg-10"><input type="text" name="tlf_persona_contacto" placeholder="Ejemplo: 02121234567" class="form-control" value="{{ old('tlf_persona_contacto') }}"> @if ($errors->has('tlf_persona_contacto'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('tlf_persona_contacto') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-5">
                            <button class="btn btn-block btn-primary" type="submit" title="Enviar datos para guardar">Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

@stop

@push('scripts')
{{--rutas js y script--}}

<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.es.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endpush

