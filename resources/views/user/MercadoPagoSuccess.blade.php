@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">{{__('Solicitud de pagos')}}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="alert alert-success" role="alert">
                                    {{__('Su Pago de Membresia ah sido Verificada correctamente')}}
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
