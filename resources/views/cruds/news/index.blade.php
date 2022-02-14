@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('NOTICIAS')}}</h4>
                        </div>
                        @if(Auth::user()->roles_id==1)
                            <div class="nav-item">
                                <a class="nav-link" href="{{route('news.create')}}">{{__('Crear')}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            @if(count($news))
                                @foreach($news as $new)
                                    @if(App::getLocale()==$new->languages->language || Auth::user()->roles_id==1)
                                        <div class="col-md-6">
                                            <div
                                                class="iq-card iq-card-block iq-card-stretch iq-card-height wow zoomIn">
                                                <div class="iq-card-body">
                                                    @if(Auth::user()->roles_id==1)
                                                        <div class="pull-right">
                                                            <a class=""
                                                               href="{{route('news.edit',$new)}}">{{__('Editar')}}</a>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="card-title text-uppercase text-secondary mb-0">{{ $new->title }}
                                                                <small>{{'('.$new->languages->language.')'}}</small>
                                                            </h5>
                                                            <p class="card-text">
                                                                {{ $new->body }}
                                                            </p>
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                {!! $new->iframe !!}
                                                            </div>
                                                            <p class="text-muted mb-0">
                                                                <em>
                                                                    &ndash; {{ $new->user->name}}
                                                                </em>
                                                                {{ $new->created_at->format('Y-m-d') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-md-12 text-muted text-center">
                                    {{__('NO SE POSEE NOTICIAS REGISTRADAS')}}
                                </div>
                            @endif
                        </div>
                        <div class="row justify-content-between mt-3">
                            <div class="col-md-6">
                                {{$news->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
