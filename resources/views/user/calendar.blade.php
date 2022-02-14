@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Proximos eventos')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="m-0 p-0 today-schedule">
                                @if(count($events))
                                    @foreach($events as $event)
                                        <li class="d-flex">
                                            <div class="schedule-icon">
                                                <i class="ri-checkbox-blank-circle-fill text-primary"></i>
                                            </div>
                                            <div class="schedule-text">
                                                <span><b>{{$event->title}}</b></span>
                                                <span>{{$event->start_time}} - {{$event->end_time}}</span>
                                                @if($event->link)
                                                    <span>
                                                    <a href="{{$event->link}}" target="_blank">{{$event->link}}</a>
                                                </span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{__("Sin eventos registrados")}}
                                        </div>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            @include('user.partials.calendar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
