@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel.png')}}" alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="mb-0">
                                        {{__('PD')}}
                                        <small class="d-block font-size-16 text-secondary">{{__("Total")}}
                                            {{ @$rankUser->nextRank()->pd }}
                                        </small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel-izquierda.png')}}"
                                         alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="mb-0">
                                        {{__('PF')}}
                                        <small class="d-block font-size-16 text-secondary">{{__("Total")}}
                                            {{ @$rankUser->nextRank()->pf }}
                                        </small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-lg-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel-derecha.png')}}"
                                         alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="mb-0">
                                        {{__('Requisito PD')}}
                                        <small class="d-block font-size-16 text-secondary">
                                            {{ @$rankUser->nextRank()->min_ranks_id != '' ? @$rankUser->nextRank()->min_ranks_id-1: null }}
                                        </small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-lg-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel-derecha.png')}}"
                                         alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="mb-0">
                                        {{__("Requisito PF")}}
                                        <small class="d-block font-size-16 text-secondary">
                                            {{ @$rankUser->nextRank()->min_ranks_id != '' ? @$rankUser->nextRank()->min_ranks_id-1: null }}
                                        </small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header">
                            <div class="col-md-12 p-3">
                                {{__('Rangos')}}
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>{{__('RANK')}}</td>
                                    <td>{{__('PD Volumen')}}</td>
                                    <td>{{__('PD Requerimiento')}}</td>
                                    <td>{{__('PF Volumen')}}</td>
                                    <td>{{__('PF Requerimiento')}}</td>
                                    <td>{{__('Requisitos')}}</td>
                                    <td>{{__('Estado')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ranks as $rank)
                                    @php
                                        $rankPrevious = isset($rank->previousRanks()[0]) ? $rank->previousRanks()[0] : null;
                                        $x = isset($rankPrevious->min_ranks_id) && $rankPrevious->min_ranks_id != null ? 'x' : null;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{asset($rank->image)}}"
                                                 style="width: 30px; height: 30px"> {{ $rank->name }}
                                        </td>
                                        <td> {{ $rank->pd }} </td>
                                        <td>
                                            @if($rankPrevious)
                                                <img src="{{asset(@$rankPrevious->image)}}"
                                                     style="width: 30px; height: 30px"> {{ $x }}
                                            @endif
                                            {{ @$rankPrevious->min_ranks_id }}
                                        </td>
                                        <td> {{ $rank->pf }} </td>
                                        <td>
                                            @if($rankPrevious)
                                                <img src="{{asset(@$rankPrevious->image)}}"
                                                     style="width: 30px; height: 30px"> {{ $x }}
                                            @endif
                                            {{ @$rankPrevious->min_ranks_id }}
                                        </td>
                                        <td>{{__( $rank->requirements )}}  </td>
                                        <td>
                                            @if($rank->id <= $rankUser->id)
                                                <i class="fa fa-check-square bg-success" aria-hidden="true"></i>
                                            @endif
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
