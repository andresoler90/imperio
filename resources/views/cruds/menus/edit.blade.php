@extends('layouts.master')
@section('content')
    @include('partials.errors_toast')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>{{__('Menu')}}</strong> <small>{{__('Nuevo registro')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.menus._form',compact('menus','roles','data'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
