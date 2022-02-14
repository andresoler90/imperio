@extends('layouts.master')
@section('content')
    @include('partials.errors_toast')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">

                        <div class="card-header"><strong>{{__('Roles')}}</strong>
                            <small>{{__('Edición de  registro')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.roles._form',compact('roles','data'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
