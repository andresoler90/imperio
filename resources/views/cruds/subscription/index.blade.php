@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Suscriciones')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("Usuario")}}</th>
                                    <th>{{__("Membresia")}}</th>
                                    <th>{{__("Estado")}}</th>
                                    <th>{{__("Registro")}}</th>
                                    <th>{{__("Expira")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($usermemberships))
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
                                               {{$um->created_at->format('d/M/Y')}}
                                            </td>
                                            <td>
                                                {{$um->expiration_date}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"
                                            class="text-center"> {{__('Sin suscripciones registradas')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
