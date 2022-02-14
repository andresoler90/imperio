@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Lista el menu')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <div class="row justify-content-between">
                                    <div class="col-sm-12 col-md-6">
                                        <div id="user_list_datatable_info" class="dataTables_filter">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="user-list-files d-flex float-right">
                                            <a href="javascript:void();" class="chat-icon-phone">
                                                Print
                                            </a>
                                            <a href="javascript:void();" class="chat-icon-video">
                                                Excel
                                            </a>
                                            <a href="javascript:void();" class="chat-icon-delete">
                                                Pdf
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Nombre')}}</th>
                                        <th>{{__('Role')}}</th>
                                        <th>{{__('Hijos')}}</th>
                                        <th>{{__('Estado')}}</th>
                                        <th colspan="2">{{__('Opciones')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($menus))
                                        @php($i=1)
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$menu->name}}</td>
                                                <td>{{$menu->role->name}}</td>
                                                <td>{{count($menu->hasChild())}}</td>
                                                <td>{{$menu->deleted_at?__('Inactivo'):__('Activo')}}</td>
                                                <td>
                                                    <a href="{{route('menu.edit',$menu->id)}}"
                                                       class="btn btn-sm btn-ghost-dark">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{route('menu.destroy',$menu->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-ghost-dark">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">{{__('Sin registros asociados')}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div id="user-list-page-info" class="col-md-6">
                                    <span>Showing 1 to 5 of 5 entries</span>
                                </div>
                                <div class="col-md-6">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
