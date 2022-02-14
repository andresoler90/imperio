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
                                <h4 class="card-title">{{__('Listado de Rangos')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('rankAdmin.create')}}">{{__('Crear')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4 yajra-datatable" role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr id="tab">
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('PF')}}</th>
                                    <th>{{__('PD')}}</th>
                                    <th>{{__('Min_Rank_id')}}</th>
                                    <th>{{__('Requerimientos')}}</th>
                                    <th>{{__('Opciones')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($ranks))
                                    @php($i=1)
                                    @foreach($ranks as $rank)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td><img src="{{asset('../storage/app/public/ranks/'.$rank->image)}}"
                                                     style="width: 30px; height: 30px;"> &nbsp;&nbsp;{{$rank->name}}</td>
                                            <td>{{$rank->pf}}</td>
                                            <td>{{$rank->pd}}</td>
                                            <td>{{$rank->min_ranks_id}}</td>
                                            <td>{{$rank->requirements}}</td>
                                            <td>
                                                <div class="row" style="text-align: center">
                                                <a href="{{route('rankAdmin.edit',$rank->id)}}"
                                                   class="btn btn-sm btn-ghost-dark" style="margin-left: 10%">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;&nbsp;
                                                <form action="{{route('rankAdmin.destroy',$rank->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                                </div>
                                            </td>
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
{{--                                    {{$ranks->links()}}--}}
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
