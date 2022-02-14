@extends('layouts.master_email')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card w-80" >
                    <div class="card-body">
                        <h2 class="card-title">Bienvenido a Imperio World </h2>
                        <h3 class="card-title">Sr. {{$user->name}} {{$user->lastname}} </h3>
                        <h4>Para recuperar su contreseña presione el siguiente botón. </h4>
                        <div class="text-center"  style="text-align: center;">
                            <a href="{{$newpassword}}" type="button" class="btn btn-primary" style="text-decoration: none;"> Recuperar Contraseña
                            </a>
                        </div>
                        <hr>
                        <div class="timeline-dots"></div>
                        <small>Si tiene problemas para hacer clic en el botón recuperar contreseña, copie y pegue la URL a continuación. <br>
                            en su navegador web: <a href="{!! $newpassword !!}"> {!! $newpassword !!}</a> </small>
                        <br>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection



