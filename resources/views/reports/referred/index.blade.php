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
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Reporte - Referidos')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="yajra-datatable table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__("Usuario")}}</th>
                                    <th>{{__("Correo electrónico")}}</th>
                                    <th>{{__("Referido Por")}}</th>
                                    <th>{{__("Membresia")}}</th>
                                    <th>{{__("Estado")}}</th>
                                    <th>{{__("Fecha registro")}}</th>

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

    {{--Buttons--}}
    <script src="{{ asset('js/buttons-dataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons-dataTables/jszip.min.js') }}"></script>
    <script src="{{ asset('js/buttons-dataTables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/buttons-dataTables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons-dataTables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons-dataTables/buttons.print.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('.yajra-datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copy', text: '{{__('Copiar')}}',"className": 'btn btn-primary' },
                    { extend: 'csv', text: '{{__('Exportar a csv')}}',"className": 'btn btn-primary' },
                    { extend: 'excel', text: '{{__('Exportar a excel')}}',"className": 'btn btn-primary' },
                    { extend: 'pdf', text: '{{__('Exportar a pdf')}}',"className": 'btn btn-primary' },
                    { extend: 'print', text: '{{__('Imprimir')}}',"className": 'btn btn-primary' }
                ],

                ajax: "{{ route('report.referred.ajax') }}",
                columns: [
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'sponsor', name: 'sponsor'},
                    {data: 'membership', name: 'membership'},
                    {data: 'state', name: 'state',orderable: true, searchable: true},
                    {
                        data: 'created_at',
                        type: 'num',
                        render: {
                            _: 'display',
                            sort: 'timestamp'
                        }
                    }
                ],
                "order": [[ 5, "desc" ]],
            });
        });
    </script>
@endsection
