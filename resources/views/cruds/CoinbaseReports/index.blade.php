@extends('layouts.master')
@section('content')
    {{--    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>--}}
    <div id="content-page" class="content-page">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-2 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Solicitudes')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-info mr-3">
                                <span
                                    class="counter">{{ @$widgets->coinbaseSoliciteForMonth }}
                                </span>
                            </div>
                            <p class="card-text">{{__('Coinbase solicitadas en el mes.')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Verificadas')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success mr-3">
                                <span
                                    class="counter">{{ @$widgets->coinbaseActiveForMonth }}
                                </span>
                            </div>
                            <p class="card-text">{{__('Coinbase verificadas en el mes.')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Canceladas')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-danger mr-3">
                                <span
                                    class="counter">{{ @$widgets->coinbaseCancelForMonth }}
                                </span>
                            </div>
                            <p class="card-text">{{__('Coinbase canceladas en el mes.')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Facturación Mes')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <h3>
                                <span class="counter">{{ number_format(@$widgets->coinbaseFactureForMonth) }}</span>
                            </h3>
                            <p class="card-text">{{__('Facturación realizada de coinbase verificadas en el mes.')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Facturación Total')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <h3>
                                <span class="counter">{{ number_format(@$widgets->coinbaseFactureForTotal) }}</span>
                            </h3>
                            <p class="card-text">{{__('Facturación total realizada de coinbase verificadas.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Filtros')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {{ Form::open(['route'=> ['report.coinbase.filters'] ,'method'=>'POST', "id" => "formFilters", 'name' => "formFilters"]) }}
                            {{ Form::token() }}

                            <div class=" row align-items-center">
                                <div class="form-group col-sm-4">
                                    {{ Form::label('username',__('Usuario:')) }}
                                    {{ Form::text('username',@$filters->username,["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-4">
                                    {{ Form::label('dateIn',__('Fecha Inicio:')) }}
                                    {{ Form::date('dateIn',@$filters->dateIn,["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-4">
                                    {{ Form::label('dateEnd',__('Fecha Final:')) }}
                                    {{ Form::date('dateEnd',@$filters->dateEnd,["class"=>"form-control"]) }}
                                </div>
                            </div>
                            {{ Form::submit(__('Buscar'),
                                ['class' => 'btn btn-primary mr-2','id' => 'search']) }}
                            <a class="btn btn-warning mr-2" href="{{route('ReporteCoinbase.index')}}">{{__('Limpiar')}}</a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{("Reporte Pagos Coinbase")}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="yajra-datatable_ table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{("Usuario")}}</th>
                                    <th>{{("Fecha")}}</th>
                                    <th>{{("Estatus")}}</th>
                                    <th>{{("Valor")}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($reporteCoinbase as $val)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.edit',$val->id)}}">{{$val->user->name}} {{$val->user->lastname}}</a>
                                        </td>
                                        <td>{{Carbon\Carbon::parse($val->created_at)->format('d/m/Y')}}</td>
                                        @if($val->status == 'V')
                                            <td><span class="badge badge-success">{{('Verificado')}}</span></td>
                                        @elseif($val->status == 'C')
                                            <td><span class="badge badge-danger">{{('Cancelado')}}</span></td>
                                        @else
                                            <td><span class="badge badge-warning">{{('Pendiente')}}</span></td>
                                        @endif
                                        <td>{{$val->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if($reporteCoinbase instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                <div class="row justify-content-between mt-3">
                                    <div class="col-md-6">
                                        {{$reporteCoinbase->links()}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('scripts')--}}
{{--    <script src="{{ asset('js/datatables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}

{{--            $('.yajra-datatable_').DataTable({--}}
{{--                language: {--}}
{{--                    "sProcessing": "Procesando...",--}}
{{--                    "sLengthMenu": "Mostrar _MENU_ registros",--}}
{{--                    "sZeroRecords": "No se encontraron resultados",--}}
{{--                    "sEmptyTable": "Ningún dato disponible.",--}}
{{--                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",--}}
{{--                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",--}}
{{--                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",--}}
{{--                    "sInfoPostFix": "",--}}
{{--                    "sSearch": "Buscar:",--}}
{{--                    "sUrl": "",--}}
{{--                    "sInfoThousands": ",",--}}
{{--                    "sLoadingRecords": "Cargando...",--}}
{{--                    "oPaginate": {--}}
{{--                        "sFirst": "Primero",--}}
{{--                        "sLast": "Último",--}}
{{--                        "sNext": "Siguiente",--}}
{{--                        "sPrevious": "Anterior"--}}
{{--                    },--}}
{{--                    "oAria": {--}}
{{--                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",--}}
{{--                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"--}}
{{--                    }--}}
{{--                }--}}
{{--                //  processing: true,--}}
{{--                //  serverSide: true,--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
