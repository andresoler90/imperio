@section('styles')
    <link rel="stylesheet" href="{{ asset('css/flag-icon.css') }}"/>
@endsection
<div class="row">
    @if(!$membership)

        <div class="col-md-12 col-lg-12">
            <div class="iq-card bg-primary sb-top-banner-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h2 class="text-white">{{__('Debe activar un producto')}}</h2>
                            <p class="text-white">{{__('Para comenzar a disfrutar sus beneficios debe seleccionar un
                                producto')}}</p>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn iq-bg-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                {{__('Ver productos')}}
                            </button>
                        </div>
                        <div class="col-md-6 position-relative">
                            <div class="an-img-two">
                                <div class="bodymovin" data-bm-path="images/small/data1.json" data-bm-renderer="svg"
                                     data-bm-loop="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="list-group">

                                <div class="col-sm-12">
                                    <div class="card-group">
                                        <div class="card" style="border-right: 1px #232323 solid">
                                            <a href="{{route('user.pricing','pool')}}">
                                                <img src="{{asset("assets/images/product/inversion.png")}}"
                                                     class="card-img-top" alt="#">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title">{{__('Pool de inversiones')}}</h4>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small class="text-muted">{{__('Adquiere una membresía')}}</small>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card" style="border-right: 1px #232323 solid">
                                            <a href="{{route('user.pricing','subscription')}}">
                                                <img src="{{asset("assets/images/product/robot.png")}}"
                                                     class="card-img-top" alt="#">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title">{{__('Subscripciones')}}</h4>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small
                                                        class="text-muted">{{__('Suscribete en nuestro robot')}}</small>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card">
                                            <a href="{{route('user.pricing','academys')}}">
                                                <img src="{{asset("assets/images/product/academia.png")}}"
                                                     class="card-img-top" alt="#">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title">{{__('Academia')}}</h4>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small class="text-muted">{{__('Estudia en nuestra plataforma')}}</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="iq-card">

            <div class="iq-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{__('Link público')}}</span>
                            </div>
                            <input type="text" class="form-control" readonly value="{{url('/registration?sponsor='.Auth::user()->username)}}"
                                   aria-describedby="button-addon4" id="link_referred">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-primary" type="button" onclick="copy('link_referred')">
                                    <i class="fa fa-files-o" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{__('Enviar')}}</span>
                            </div>
                            <input type="number" class="form-control" placeholder="{{__('Teléfono móvil')}}" id="tlf_whatsapp">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-primary" type="button" onclick="Send('tlf_whatsapp')">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function copy(id) {
                        /* Get the text field */
                        var copyText = document.getElementById(id);

                        /* Select the text field */
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); /* For mobile devices */

                        /* Copy the text inside the text field */
                        document.execCommand("copy");

                        /* Alert the copied text */
                        alert("{{__('Copiado')}}");
                    }

                    function Send(id) {
                        tlf = $('#' + id).val()
                        url = "https://wa.me/" + tlf + "?text={{urlencode('Te invito a registrarte en el siguiente link ').url('/registration?sponsor='.Auth::id())}}";
                        window.open(url, '_blank');
                    }
                </script>
            </div>
        </div>
    </div>
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container" style="margin-bottom: 20px;">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
                async>
            {
                "symbols"
            :
                [
                    {
                        "proName": "FOREXCOM:SPXUSD",
                        "title": "S&P 500"
                    },
                    {
                        "proName": "FOREXCOM:NSXUSD",
                        "title": "Nasdaq 100"
                    },
                    {
                        "proName": "FX_IDC:EURUSD",
                        "title": "EUR/USD"
                    },
                    {
                        "proName": "BITSTAMP:BTCUSD",
                        "title": "BTC/USD"
                    },
                    {
                        "proName": "BITSTAMP:ETHUSD",
                        "title": "ETH/USD"
                    }
                ],
                    "showSymbolLogo"
            :
                true,
                    "colorTheme"
            :
                "dark",
                    "isTransparent"
            :
                true,
                    "displayMode"
            :
                "adaptive",
                    "locale"
            :
                "es"
            }
        </script>
    </div>
    {{--    <div class="col-md-4">--}}
    {{--        --}}
    {{--    </div>--}}
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-6 col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon "><img src="{{asset("assets/images/icon/1.png")}}"
                                                                       alt=""></div>
                        <span class="float-right line-height-6">{{__("Ganancias")}} </span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0">
                                {{--<span>$</span><span class="counter">{{Auth::user()->totalRevenue()}}</span>--}}
                                $<span class="counter">{{  number_format(@$widgets->balanceCommissionsPaidUserId + $UserBalanceRoi, 2, '.', '')  }}</span>
                            </h2>
                        </div>
                    </div>
                    <div id="chart-2"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon "><img src="{{asset("assets/images/icon/3.png")}}"
                                                                       alt=""></div>
                        <span class="float-right line-height-6">{{__("Comisiones")}}</span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0">
                                {{--$<span class="counter">{{Auth::user()->bonus->sum('amount')}}</span>--}}
                                $<span class="counter">{{ number_format(@$widgets->balanceCommissionsPaidUserId,2, '.', '')  }}</span>
                            </h2>
                        </div>
                    </div>
                    <div id="chart-3"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                        <div class="rounded-circle iq-card-icon"><img src="{{asset("assets/images/icon/4.png")}}"
                                                                      alt=""></div>
                        <span class="float-right line-height-6">{{__("Rentabilidad")}} </span>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <h2 class="mb-0"><span class="counter">{{ $UserBalanceRoi }}</span></h2>
                        </div>
                    </div>
                    <div id="chart-4"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height iq-profile-card text-center">
                            <div class="iq-card-body">
                                <div class="iq-team text-center p-0">
                                    @if($rankUser)
                                        <img src="{{asset($rankUser->image)}}" class="rango-actual">
                                    @else
                                        <img src="{{asset('assets/images/rank/1.png')}}"
                                             class="rango-actual">
                                    @endif
                                    <h4 class="mb-0">{{Auth::user()->username}}</h4>
                                    <p>{{Auth::user()->email}}</p>
                                    <hr>
                                    <ul class="list-inline mb-0 d-flex justify-content-between">
                                        <li class="list-inline-item">
                                            <h5>{{__("Pool de inversiones")}}</h5>
                                            <p class="text-success">{{(isset($membership->membership) && $membership->membership->type == 'membership')  ? $membership->membership->name : ''}}</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>{{__("Subscripciones")}}</h5>
                                            <p class="text-success">{{(isset($membership->membership) && $membership->membership->type == 'subscription')  ? 'SI' : 'NO'}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div id="Dash1BarChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div
                            class="iq-card bg-primary sb-top-banner-card iq-card-block iq-card-stretch iq-card-height widget-binario">
                            <div class="iq-card-body pt-5 pb-5">
                                <div class="row">
                                    <div class="col-md-12 text-center  mb-3">
                                        <h4 class="card-title">{{__("TOTAL DE USUARIOS EN EL BINARIO:")}} </h4>
                                        <h1>{{$multilevel->underPlain()?count($multilevel->underPlain()):0}} </h1>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <span>{{__("TOTAL DE USUARIOS IZQUIERDA:")}}</span>
                                        <br>

                                        <h1> {{$multilevel->referredsPosition('I')?count($multilevel->referredsPosition('I')):0}} </h1>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <span>{{__("TOTAL DE USUARIOS DERECHA:")}} </span>
                                        <br>
                                        <h1> {{$multilevel->referredsPosition('D')?count($multilevel->referredsPosition('D')):0}}</h1>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <span>{{__("VOLUMEN IZQUIERDA:")}} </span>
                                        <br>
                                        <h1>  {{$multilevel->volumeNode('I')?number_format($multilevel->volumeNode('I')-$beforeBonus):0}} </h1>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <span>{{__("VOLUMEN DERECHA:")}} </span>
                                        <br>
                                        <h1>   {{$multilevel->volumeNode('D')?number_format($multilevel->volumeNode('D')-$beforeBonus):0}} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="iq-card bg-primary sb-top-banner-card iq-card-block iq-card-stretch iq-card-height widget-rangos">
                            <div class="iq-card-body pt-5 pb-5 pl-5 pr-5">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h4 class="card-title">{{__("CLASIFICACIÓN DE RANGOS DE KABOOM:")}}</h4>
                                        <div class="row pt-4 pb-3">
                                            <div class="col-md-3 ">
                                                {{__("BVF NECESARIOS PARA PRÓXIMO RANGO:")}}
                                                <h2>{{$rankUser && $rankUser->nextRank() ? $rankUser->nextRank()->pf: 0}}$</h2>
                                            </div>
                                            <div class="col-md-3 ">
                                                {{__("BVD NECESARIOS PARA PRÓXIMO RANGO:")}}
                                                <h2>{{$rankUser && $rankUser->nextRank() ? $rankUser->nextRank()->pd: 0}}$</h2>
                                            </div>
                                            <div class="col-md-3 ">
                                                {{__("PD:")}}
                                                <h2>{{ $multilevel->totalPfAndPd()['pd'] }} $</h2>
                                            </div>
                                            <div class="col-md-3 ">
                                                {{__("PF:")}}
                                                <h2>{{ $multilevel->totalPfAndPd()['pf'] }} $</h2>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div
                                                class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 10%"></div>
                                        </div>
                                        <br>
                                        <div class="row pt-4 pb-3">
                                            <div class="col-md-3 text-center">
                                                <h4>{{__("Rango Actual:")}}</h4>
                                                @if($rankUser)
                                                    <img src="{{asset($rankUser->image)}}" class="rango-actual">
                                                @else
                                                    <img src="{{asset('assets/images/rank/1.png')}}"
                                                         class="rango-actual">
                                                @endif
                                            </div>
                                            <div class="col-md-8 pt-5 text-center">
                                                <br>
                                                <ul class="lista-rangos">
                                                    @foreach($ranks as $rank)
                                                        <li><img src="{{asset($rank->image)}}"></li>
                                                    @endforeach
                                                </ul>
                                                <h5 class="text-center">{{__("Debes completar requisitos para subir de rango.")}}</h5>
                                                <br>
                                                @if($rankUser && $rankUser->nextRank())
                                                    <h5 class="text-center">{{ __($rankUser->nextRank()->requirements)}}</h5>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Mapa--}}
            <div class="col-md-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height wow " data-wow-delay="0.8s">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('Países con suscripción')}}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if(count($mapCountry->mapCount))
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{__('País')}}</th>
                                            <th scope="col">{{__('Total de suscripción')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($cont = 0)
                                        @php(arsort($mapCountry->mapCount))
                                        @foreach($mapCountry->mapCount as $country => $total)
                                            @php($cont++)
                                            @if($cont <= 6)
                                                <tr>
                                                    <th scope="row">{{ $cont }}</th>
                                                    <td>
                                                        <span
                                                            class="flag-icon flag-icon-{{@$mapCountry->code[$country]}}"></span>
                                                        {{ $country }}
                                                    </td>
                                                    <td><span class="badge badge-cobalt-blue">{{ $total }}</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        {{__('Aún no refieres a ninguna persona')}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div id="regions_div"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

