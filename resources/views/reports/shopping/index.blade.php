@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Historial de Compras')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table id="membership-list-table" class="table table-striped table-bordered mt-4 yajra-datatable" role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr >
                                    <th >#</th>
                                    <th >{{__('N° Factura')}}</th>
                                    <th >{{__('Fecha Compra')}}</th>
                                    <th >{{__('Monto')}}</th>
                                    <th >{{__('Bono de Producto')}}</th>
                                    <th >{{__('Tipo Membresía')}}</th>
                                    <th >{{__('Método Pago')}}</th>
                                    <th >{{__('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($historialCompras))
                                    @php($i=1)
                                    @foreach($historialCompras as $compras)

                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$compras->id}}</td>
                                            <td>{{\Carbon\Carbon::parse($compras->created_at)->format('d/m/Y')}}</td>
                                            <td>{{$compras->price}} $</td>
                                            <td>{{isset($compras->UserBonus[0]->percentage) ? $compras->UserBonus[0]->percentage :'0'}} %</td>
                                            <td>{{isset($compras->membership->type) ? $compras->membership->type : ''}}</td>
                                            @if(\App\Models\PaymentCoinbase::where('user_memberships_id',$compras->users_id)->first())
                                            <td>Coinbase</td>
                                            @elseif(count($compras->verifications))
                                            <td>Moneda Local</td>
                                            @else
                                             <td>Coinbase</td>
                                            @endif
                                            @if(\App\Models\PaymentCoinbase::where('user_memberships_id',$compras->users_id)->where('status','V')->first() || $compras->hasApprovedVerification() )
                                            <td><span class="badge badge-success">Pagado</span></td>
                                            @else
                                                <td><span class="badge badge-warning">Pendiente</span></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">{{__('Sin registros asociados')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{--                            <div class="row justify-content-between mt-3">--}}
                            {{--                                <div class="col-md-6">--}}
                            {{--                                    {{$membershipAdmin->links()}}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').DataTable({
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible.",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
                //  processing: true,
                //  serverSide: true,
            });
        });
    </script>
@endsection

