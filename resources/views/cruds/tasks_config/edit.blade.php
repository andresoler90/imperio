@extends('layouts.master')
@section('content')
    @include('partials.errors_toast')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">

                    <div class="card-header"><strong>{{__('Configuración de tareas')}}</strong>
                            <small>{{__('Edición de  registro')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.tasks_config._form',compact('data'))
                        </div>
                    </div>
                </div>
            </div>
            @include('cruds.tasks_config._list')
        </div>
    </div>
@endsection
