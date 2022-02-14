@extends('layouts.master')
@section("styles")

    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Listado de usuarios')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.create')}}">{{__('Crear')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="yajra-datatable table table-bordered">
                                <thead>
                                <tr class="bg-blue-dark">
                                    <th>{{__('Usuario')}}</th>
                                    <th>{{__('Correo electrónico')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th>{{__('Referido por')}}</th>
                                    <th>{{__('Creado')}}</th>
                                    <th>{{__('Opciones')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="row justify-content-between mt-3">
                                <div class="col-md-6">

                                </div>
                            </div>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.ajax.list') }}",
                columns: [
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'sponsor', name: 'sponsor'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
