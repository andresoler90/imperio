@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                @php
                    $requestTemp = session('requestTemp')[0];
                    $route = $requestTemp['route'];
                @endphp

                <div class="col-md-12">
                    <div class="iq-card iq-card-block iq-card-stretch">
                        <div class="iq-card-body">
                            <div class="sign-in-from">
                                {{Form::open(['route'=>[$route],'method'=>'POST'])}}

                                @foreach($requestTemp as $title => $value)
                                    @if($title != "_token")
                                        {!! Form::hidden($title,$value) !!}
                                    @endif
                                @endforeach

                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 class="mt-3 mb-0">{{__('Clave dinámica')}}</h1>
                                    </div>
                                </div>
                                <div class="row  align-items-center">
                                    <div class="col-md-12">
                                        <input class="form-control" id="code_verification" name="code_verification"
                                               type="text"
                                               placeholder="{{__('Código de verificación')}}">

                                        {!! Form::submit(__('Continuar'),array('class'=>'btn btn-primary mt-3')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>A email has been send to youremail@domain.com. Please check for an email from
                                            company
                                            and
                                            click on the included link to reset your password.</p>
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

