@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    {{Form::open(['route'=>'system.update'])}}
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Configuraciones')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        {{Form::submit('Actualizar',['class'=>'btn btn-primary'])}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="row">
                                @foreach($systems as $system)
                                        <div class="col-md-3 mt-2">{{$system->parameter}}</div>
                                        <div class="col-md-3 mt-2">
                                            {{Form::text('parameters['.$system->parameter.']',$system->value,["class"=>"form-control"])}}
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="col-md-4">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Bonos')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="row">
                                <a href="{{route('system.command.weak_leg')}}" class="btn btn-primary btn-sm col-md-12">{{__('Bono de pierna débil')}}</a>
                            </div>
                            <div class="row">
                                <a href="{{route('system.command.regenerateRanks')}}" class="btn btn-primary btn-sm col-md-12">{{__('Actualizar rangos')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
