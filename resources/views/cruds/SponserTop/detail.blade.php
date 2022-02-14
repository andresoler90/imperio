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
                                <h4 class="card-title">{{__('Detelles - Referidos')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="yajra-datatable_ table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__("Usuario")}}</th>
                                    <th>{{__("Correo electrónico")}}</th>
                                    <th>{{__("Membresia")}}</th>
                                    <th>{{__("Fecha registro")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sponserToplist as $val)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.edit',$val->id)}}">{{$val->name}} {{$val->lastname}}</a>
                                        </td>

                                        <td>{{$val->email}}</td>
                                        <td>{{@$val->userMembership->membership->name}}</td>
                                        <td>{{$val->created_at}}
                                        </td>

                                    </tr>
                                @endforeach
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

            $('.yajra-datatable_').DataTable({
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
