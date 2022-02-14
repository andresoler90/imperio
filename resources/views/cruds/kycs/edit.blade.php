@extends('layouts.master')
@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('partials.errors_toast')
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">
                                    {{__('Kyc')}}
                                </h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    @if(isset($data) && $data->status==0)
                                        <li class="nav-item">
                                            <a class="nav-link"
                                               href="{{route('kyc.status.update',[$data->id,1])}}">{{__('Aprobado')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                               href="{{route('kyc.status.update',[$data->id,2])}}">{{__('Rechazado')}}</a>
                                        </li>
                                    @else
                                        @switch($data->status)
                                            @case(1)
                                            <li class="nav-item">
                                                <span class="badge badge-success">{{__($data->status_name)}}</span>
                                            </li>
                                            @break
                                            @case(2)
                                            <li class="nav-item">
                                                <span class="badge badge-danger">{{__($data->status_name)}}</span>
                                            </li>
                                            @break
                                        @endswitch
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            @include('cruds.kycs._form',compact('types','users'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
