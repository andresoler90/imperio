@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Membresias')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("Usuario")}}</th>
                                    <th>{{__("Membresia")}}</th>
                                    <th>{{__("Estado")}}</th>
                                    <th>{{__("Opciones")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usermemberships as $um)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.edit',$um->users_id)}}">{{$um->user->name}}</a>
                                        </td>
                                        <td>{{$um->membership->name}}</td>
                                        <td>
                                            @if($um->hasApprovedVerification())
                                                <span class="badge badge-success">{{__('Activo')}}</span>
                                            @else
                                                <span class="badge badge-warning">{{__('Pendiente')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('membership.detail',$um->id)}}"> <i class="fa fa-eye"></i></a>
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
