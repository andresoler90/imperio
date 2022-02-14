@extends('layouts.master')
@section('content')
    @include('partials.errors_toast')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">

                        <div class="card-header"><strong>{{__('Productos')}}</strong>
                            <small>{{__('Edición de  registro')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.membership._form',['data'=>$membership])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
