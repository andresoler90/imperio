@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Productos')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('membership.create')}}">{{__('Crear')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("Nombre")}}</th>
                                    <th>{{__("Tipo")}}</th>
                                    <th>{{__("Opciones")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($memberships as $membership)
                                    <tr>
                                        <td>{{$membership->name}}</td>
                                        <td style="text-transform: capitalize">{{$membership->type}}</td>
                                        <td>
                                            <a href="{{route('membership.edit',$membership->id)}}"> <i class="fa fa-eye"></i></a>
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
