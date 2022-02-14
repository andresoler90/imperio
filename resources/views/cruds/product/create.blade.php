@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('partials.errors_toast')
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="card-header"><strong>{{__('Producto')}}</strong> <small>{{__('Nuevo registro')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.product._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
