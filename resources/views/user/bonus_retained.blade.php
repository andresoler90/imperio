@extends('layouts.master')
@section("styles")
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}"/>
@endsection
@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <table class="yajra-datatable table table-bordered">
                                <thead>
                                <tr class="border-bottom-1">
                                    <th>{{__('Tipo Bono')}}</th>
                                    <th>{{__('Total Bono')}}</th>
                                    <th>{{__('% Bono Entregado')}}</th>
{{--                                    <th>{{__('Valor Entregado')}}</th>--}}
{{--                                    <th>{{__('% Bono Retenido')}}</th>--}}
{{--                                    <th>{{__('Valor Retenido')}}</th>--}}
{{--                                    <th>{{__('Fecha Creación')}}</th>--}}
{{--                                    <th>{{__('Fecha de Entrega')}}</th>--}}
{{--                                    <th>{{__('Estado')}}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
            var table = $('.yajra-datatable').DataTable({
                ajax: "{{ route('user.bonus.retained_ajax') }}",
                columns: [
                    {data: 'type', name: 'type'},
                    {data: 'total', name: 'total'},
                    {data: 'percentage_balance', name: 'percentage_balance'},
                    // {data: 'delivered_value', name: 'delivered_value'},
                    // {data: 'percentage_retained', name: 'percentage_retained'},
                    // {data: 'retained_value', name: 'retained_value'},
                    // {
                    //     data: 'created_at',
                    //     type: 'num',
                    //     render: {
                    //         _: 'display',
                    //         sort: 'timestamp'
                    //     }
                    // },
                    // {data: 'date_delivery', name: 'date_delivery'},
                    // {data: 'status_delivery', name: 'status_delivery',orderable: true, searchable: true},

                ],
            //    "order": [[ 8, "desc" ]],
            });
        });
    </script>
@endsection
