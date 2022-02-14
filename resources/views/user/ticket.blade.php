@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('user.partials.ticket_filters')
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Listado de tickets')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills {{Auth::user()->roles_id == 1?'d-none':''}}">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.ticket.create')}}">{{__('Crear')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                                @foreach($statuses as $status)
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#pending-tab{{$status->id}}" role="tab" aria-controls="home"
                                           aria-selected="false">{{$status->status_name}}
                                            <span class="badge badge-default">{{count($tickets[$status->status_name])}}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent-2">
                                @foreach($statuses as $status)
                                    <div class="tab-pane fade {{$loop->index==0?'active show':''}} " id="pending-tab{{$status->id}}" role="tabpanel" aria-labelledby="home-tab">
                                        @component('user.partials.tickect_states_table')
                                            @slot('tickets', $tickets[$status->status_name])
                                        @endcomponent
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
