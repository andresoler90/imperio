@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('partials.errors_toast')
            <div class="row">
                <div class="col-md-8">
                    <div class="iq-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if(Auth::user()->token_login)
                                        <i class="fa fa-check-circle fa-5x"></i>
                                        <br>
                                        <span class="badge badge-spring-green">Activo</span>
                                    @else
                                        <img id="imgQR" src="{{$urlQR}}"/>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4 class="card-title">{{__('Autenticación de doble factor')}}</h4>
                                    @if(Auth::user()->token_login)
                                        {{Form::open(['route'=>'user.deactivate.a2fa'])}}
                                        <div class="input-group mb-3">
                                            {{Form::text('code',null,["class"=>"form-control","maxlength"=>"6"])}}
                                            <div class="input-group-append">
                                                {{Form::submit(__('Desactivar'),['class'=>'btn btn-primary'])}}
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    @else
                                        {{Form::open(['route'=>'user.active.a2fa'])}}
                                        @csrf
                                        <ol>
                                            <li>
                                                {{__('Instale la aplicación')}}
                                                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=es&gl=US">
                                                    Google Authenticator
                                                </a>
                                            </li>
                                            <li>{{__('Abra la aplicación y seleccione la opción escanear código qr.')}}</li>
                                            <li>{{__('Escanee el código qr que se muestra en esta página.')}}</li>
                                            <li>{{__('Presione Activar')}}</li>
                                            <li><b>{{__('Para confirmar la asociación ingrese la clave actual ')}}  <span style="color:red;">{{__(' ( IMPORTANTE )')}}</span></b></li>
                                        </ol>
                                        {{Form::hidden('tokenLogin',$tokenLogin)}}
                                        <div class="input-group mb-3">
                                            {{Form::text('code',null,["class"=>"form-control","maxlength"=>"6"])}}
                                            <div class="input-group-append">
                                                {{Form::submit(__('Activar'),['class'=>'btn btn-primary'])}}
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
