<div class="col-md-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">{{__('NOTICIAS')}}</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="row">
                @php($cont=0)
                @foreach($news as $new)
                    @if(App::getLocale()==$new->languages->language)
                        @php($cont++)
                        <div class="col-md-6">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height wow zoomIn">
                                <div class="iq-card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-title text-uppercase text-secondary mb-0">{{ $new->title }}</h5>
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
            </div>
            @if($cont > 0)
            <div class="row justify-content-between mt-3">
                <div class="col-md-6">
                    <a href="{{route('news.index')}}">{{__('Leer mas noticias...')}}</a>
                </div>
            </div>
            @else
                <div class="col-md-12 text-muted text-center">
                    {{__('NO SE POSEE NOTICIAS REGISTRADAS')}}
                </div>
            @endif
        </div>
    </div>
</div>

