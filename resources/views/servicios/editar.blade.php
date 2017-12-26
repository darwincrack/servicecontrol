@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/servicios/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo Servicio o Equipo
</a>
@endpush

@push('css')

<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/datapicker/datepicker3.css') }}">
<style>
    select{text-transform: uppercase;}
    input{text-transform: uppercase;}

</style>
@endpush

@section('title', 'Editar Servicio o Equipo')

@section('content')






        <div class="ibox float-e-margins animated fadeInDown">

            <div class="ibox-content">

                Los campos marcados con (<span style="color:#afafaf;">*</span>) son obligatorios

                <br>
                <br>

                <form class="form-horizontal" method="post" action="{{ URL::asset('servicios/editar') }}">
                    {!! csrf_field() !!}
                    <input name="id_servicio" type="hidden" value="{{encriptar($id_servicio)}}">



                    <div class="form-group{{ $errors->has('ciudades') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Ciudad</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="ciudades" id="ciudades" data-rec="">
                                @foreach($data_ciudades as $data_ciudad)
                                    <option value="{{$data_ciudad->id_ciudad}}" {{($data_ciudad->id_ciudad==$data_servicio->id_ciudad)?"selected":""}}>{{$data_ciudad->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ciudades'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('ciudades') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('tipo_procedencia') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Tipo de  Procedencia</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="tipo_procedencia" id="tipo_procedencia" data-rec="">
                                @foreach($data_tipo_procedencias as $data_tipo_procedencia)
                                    <option value="{{$data_tipo_procedencia->id_tipo_procedencia}}" {{($data_tipo_procedencia->id_tipo_procedencia==$data_servicio->id_tipo_procedencia)?"selected":""}}>{{$data_tipo_procedencia->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo_procedencia'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tipo_procedencia') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('procedencia') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Procedencia</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="procedencia" id="procedencia">
                                @foreach($data_procedencias as $data_procedencia)
                                    <option value="{{$data_procedencia->id_procedencia}}" {{($data_procedencia->id_procedencia==$data_servicio->id_procedencia)?"selected":""}}>{{$data_procedencia->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('procedencia'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('procedencia') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tipo_servicio') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Tipo de  Servicio</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="tipo_servicio" id="tipo_servicio">
                                @foreach($data_tipo_servicios as $data_tipo_servicio)
                                    <option value="{{$data_tipo_servicio->id_tipo_servicios}}" {{($data_tipo_servicio->id_tipo_servicios==$data_servicio->id_tipo_servicios)?"selected":""}}>{{$data_tipo_servicio->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo_servicio'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tipo_servicio') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('operadora') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Operadora</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="operadora">
                                @foreach($data_operadoras as $data_operadora)
                                    <option value="{{$data_operadora->id_operadora}}" {{($data_operadora->id_operadora==$data_servicio->id_operadora)?"selected":""}}>{{$data_operadora->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('operadora'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('operadora') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('estatus') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Estatus Servicio o Equipo</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="estatus">
                                @foreach($data_estatus as $data_estatu)
                                    <option value="{{$data_estatu->id_estatus}}" {{($data_estatu->id_estatus==$data_servicio->id_estatus)?"selected":""}}>{{$data_estatu->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('estatus'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('estatus') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>


                    <div class="form-group"><label class="col-lg-2 control-label">Equipo Propio?</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"   class="onoffswitch-checkbox" id="propio" name="propio" value="1"  {{($data_servicio->propio==1)?"checked=":'null'}} >
                                    <label class="onoffswitch-label" for="propio">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('num_telefono_circuito') ? ' has-error' : '' }}"><label class="col-lg-2 control-label"><span style="color:#afafaf;">* </span>Num Telefono o Circuito</label>

                        <div class="col-lg-10"><input type="text" name="num_telefono_circuito" placeholder="Ejemplo: 02392253939" class="form-control" value="{{ $data_servicio->telefono_circuito }}">
                            @if ($errors->has('num_telefono_circuito'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('num_telefono_circuito') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('nombre_plan') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre del plan o equipo</label>

                        <div class="col-lg-10"><input type="text" name="nombre_plan" placeholder="Ejemplo: ABA para Todos" class="form-control" value="{{ $data_servicio->nombre }}"> @if ($errors->has('nombre_plan'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre_plan') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('costo_plan') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Costo del plan</label>

                        <div class="col-lg-10"><input type="text" name="costo_plan" placeholder="Ejemplo: 2500" class="form-control" value="{{ $data_servicio->costo_plan }}"> @if ($errors->has('costo_plan'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('costo_plan') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div id="content_aba_movil" style="display: block">
                    <div class="form-group{{ $errors->has('imei') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">IMEI</label>

                        <div class="col-lg-10"><input type="text" name="imei" placeholder="Ejemplo: 350604106383727" class="form-control" value="{{ $data_servicio->imei }}">
                            @if ($errors->has('imei'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('imei') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('modelo') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Modelo</label>

                        <div class="col-lg-10"><input type="text" name="modelo" id="modelo" placeholder="Ejemplo: 8310" class="form-control" value="{{ $data_servicio->modelo }}"> @if ($errors->has('modelo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                     <div class="form-group{{ $errors->has('serial') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Serial</label>

                        <div class="col-lg-10"><input type="text" name="serial" id="serial" placeholder="Ejemplo: 8310" class="form-control" value="{{ $data_servicio->serial }}"> @if ($errors->has('serial'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('serial') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('fcc') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">FCC</label>

                        <div class="col-lg-10"><input type="text" name="fcc" id="fcc" placeholder="Ejemplo: 11235813" class="form-control" value="{{ $data_servicio->fcc }}"> @if ($errors->has('fcc'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('fcc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    </div>



                    <div class="form-group{{ $errors->has('id_compania') ? ' has-error' : '' }}"><label class="col-sm-2 control-label"><span style="color:#afafaf;">* </span>Compa&nacute;ia</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="id_compania" id="id_compania" data-rec="">
                                @foreach($data_compania as $data_companias)
                                    <option value="{{$data_companias->id_compania}}" {{($data_companias->id_compania==$data_servicio->id_compania)?"selected":""}}>{{$data_companias->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ciudades'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('compania') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('num_contrato') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Num Contrato</label>

                        <div class="col-lg-10"><input type="text" name="num_contrato" placeholder="Ejemplo: 11235813" class="form-control" value="{{ $data_servicio->num_contrato }}"> @if ($errors->has('num_contrato'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('num_contrato') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('inicio_contrato') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Fecha Inicio Contrato</label>

                        <div class="col-lg-10">
                            <div  id="data_1">

                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="inicio_contrato" id="inicio_contrato" class="form-control" value="{{ $servicio_fecha_inicio_contrato}}">
                                    @if ($errors->has('inicio_contrato'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('inicio_contrato') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class="form-group{{ $errors->has('final_contrato') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Fecha Final Contrato</label>

                        <div class="col-lg-10">
                            <div  id="data_1">

                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="final_contrato" id="final_contrato" class="form-control" value="{{ $servicio_fecha_finalizacion_contrato }}">
                                    @if ($errors->has('final_contrato'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('final_contrato') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
@stop

@push('scripts')
{{--rutas js y script--}}

<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.es.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endpush

