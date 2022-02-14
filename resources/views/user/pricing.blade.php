@extends('layouts.master')
@section('content')
    @php
        $registration = \App\Models\System::where('parameter','registration_value')->first();
    @endphp
    <div id="content-page" class="content-page">
        <div class="container-fluid">

            {{--            @if(count($membershiVerification))--}}
            @if(count($membershiVerification) || count($PaymentCoinbaseVerification) || count($PaymentMercadoPagoVerification))
                <div class="row">
                    <div class="col-md-4 offset-4 align-self-center">
                        <div class="card iq-mb-3">
                            <div class="card-body px-0">
                                @if(count(Auth::user()->userMembership->hasPendingVerification()))
                                    <div class="col-md-12 px-2">
                                        <h4 class="card-title">{{__('Verificación en proceso')}}</h4>
                                    </div>
                                    <hr class="dropdown-divider">

                                    <div class="col-md-12 p-0">
                                        <table class="table table-borderless table-sm table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{__('Soporte')}}</th>
                                                <th>{{__('Estado')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(Auth::user()->userMembership->verifications as $verification)
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="{{route('membership.download',$verification->id)}}"
                                                           class="badge badge-cobalt-blue">
                                                            <i class="fa fa-download"></i>
                                                            {{$verification->support_document}}
                                                        </a>
                                                    </td>
                                                    <td>{!! $verification->status_badge !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>

                            </div>
                            @elseif(count($PaymentCoinbaseVerification))
                                <div class="col-md-12 px-2">
                                    <h4 class="card-title">{{__('Pago Rechazado')}}</h4>
                                </div>
                                <hr class="dropdown-divider">
                                <ol>
{{--                                    <li style="text-align: justify">{{__('Si realizo Pago con Moneda Local el mismo fue rechazado por favor vuelva a ingresar los datos')}}.--}}
{{--                                    </li>--}}
                                    <li style="text-align: justify">{{__('Si realizo el pago por coinbase y por alguna razon se quedo pegado el proceso por favor ingresa a la venta de coinbase y presionar recheck.')}}.
                                    </li>
                                    <li style="text-align: justify">{{__('Si realizo el pago por coinbase y lo cancelo por error por favor vuelva a realizar el pago.')}}.
                                    </li>
                                </ol>
                                <div
                                    class="d-flex flex-wrap justify-content-between align-items-center form-group">
                                    <div class="row boton-activacion" style="margin-left: 15px;">
                                        <div class="" data-toggle="modal"
                                             data-target="#pricingModal"
                                             onclick="updateMembership('{{Auth::user()->userMembership->membership->name}}','{{Auth::user()->userMembership->membership->id}}','{{$PaymentCoinbaseVerification[0]->amount}}','{{$registration->value}}')">
                                            <a href="#" data-toggle="tooltip" class="button btn btn-secondary"
                                               data-placement="top" title=""
                                               data-original-title="Activar Plan">{{__('Activar Plan')}}</a>
                                        </div>
                                        <div class="" style="margin-left: 5px;">
                                        <a href="{{(route('user.cancel.plan',[Auth::id(),$PaymentCoinbaseVerification[0]->memberships_id ]))}}"  class="button btn btn-secondary" data-toggle="tooltip"
                                           data-placement="top" title=""
                                           data-original-title="Cancelar Plan">{{__('Cancelar Plan')}}</a>
                                        </div>

                                    </div>
                                    <div class="product-price">
                                        <div class="regular-price"><b>
                                                ${{$PaymentCoinbaseVerification[0]->amount}}</b></div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 px-2">
                                    <h4 class="card-title">{{__('Pago Rechazado')}}</h4>
                                </div>
                                <hr class="dropdown-divider">
                                <ol>
{{--                                    <li style="text-align: justify"> {{__("Si realizo Pago con Moneda Local el mismo fue rechazado por favor vuelva a ingresar los datos")}}.--}}
{{--                                    </li>--}}
                                    <li style="text-align: justify">{{__("Si realizo el pago por coinbase y por alguna se quedo pegado el proceso por favor ingresa a la venta de coinbase y presionar recheck.")}}
                                    </li>
                                    <li style="text-align: justify">{{__("Si realizo el pago por coinbase y lo cancelo por error por favor vuelva a realizar el pago.")}}
                                    </li>
                                </ol>
                                <div
                                    class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="row boton-activacion" style="margin-left: 15px;"><!-- se comneta class boton por que eran muy grande los botones -->
                                        <div class="" data-toggle="modal"
                                             data-target="#pricingModal"
                                             onclick="updateMembership('{{Auth::user()->userMembership->membership->name}}','{{Auth::user()->userMembership->membership->id}}','{{$PaymentCoinbaseVerification[0]->amount}}','{{$registration->value}}')">
                                            <a href="#" data-toggle="tooltip"
                                               data-placement="top" title=""
                                               data-original-title="Activar Plan">{{ __('Activar Plan') }}</a>
                                        </div>
                                        <div class="" style="margin-left: 5px;">
                                            <a href="{{(route('user.cancel.plan',[Auth::id(),$PaymentCoinbaseVerification[0]->memberships_id ]))}}"  class="button btn btn-secondary" data-toggle="tooltip"
                                               data-placement="top" title=""
                                               data-original-title="Cancelar Plan">{{__('Cancelar Plan')}}</a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <div class="regular-price"><b>
                                                ${{$PaymentCoinbaseVerification[0]->amount}}</b></div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="pricingModal" tabindex="-1" role="dialog"
                     aria-labelledby="pricingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <b id="membershipTitle"></b>
                                    &nbsp;-&nbsp;
                                    {{__("Solicitar activación")}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(count($subscriptionList) && ($type=='*'|| $type=='pool'))
                                            <h4 class="card-title">{{__('Instrucciones')}}</h4>
                                            <ol class="px-5">
                                                <li>{{__('Completar todos tus datos en tu perfil')}}</li>
                                                <li>{{__('Enviar todos los documentos para el KYC')}}</li>
                                                <li>{{__('Realizar el proceso de pago')}}</li>
                                            </ol>
                                        @endif

                                        @if(count($membershipList) && ($type=='*'|| $type=='subscription'))
                                            <h4 class="card-title">{{__('Instrucciones')}}</h4>
                                            <ol class="px-5">
                                                <li>{{__('Completar todos tus datos en tu perfil')}}</li>
                                                <li>{{__('Enviar todos los documentos para el KYC')}}</li>
                                                <li>{{__('Abre tu cuenta en tu bróker - Si no tienes, puedes')}}
                                                    <a href="https://my.myfxchoice.com/registration/?refer=324283"
                                                       style="color: #f5ca62; font-size: 20px;">
                                                        <span>{{__('Registrarte Aquí')}}</span>
                                                    </a>
                                                </li>
                                                <li>{{__('Entrada mínima $1500 dólares')}}</li>
                                            </ol>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    @include('user.modal_pay_memberships')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if($poolUpgrade != null && ($type=='*'|| $type=='pool'))
                    <div class="row">
                        <div class="col-md-4 offset-4 align-self-center">
                            <div class="card iq-mb-3">
                                <div class="card-body px-0">
                                    <div class="col-md-12 px-2">
                                        <h4 class="card-title">{{__('Upgrade en proceso')}}</h4>
                                    </div>
                                    <hr class="dropdown-divider">
                                    <div class="col-md-12 p-0">
                                        <table class="table table-borderless table-sm table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{__('Soporte')}}</th>
                                                <th>{{__('Estado')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{route('general.downloads',[$poolUpgrade->id,'m_pool_upgrades',1])}}"
                                                       target="_blank"
                                                       class="badge badge-cobalt-blue">
                                                        <i class="fa fa-eye"></i>
                                                        {{$poolUpgrade->support_document}}
                                                    </a>
                                                </td>
                                                <td>{!! $poolUpgrade->status_badge !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(count($membershipList) && ($type=='*'|| $type=='pool'))
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">
                                {{__('Fondo de Inversión')}}
                            </h3>
                        </div>

                        <div class="col-sm-12 ">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <div id="js-product-list">
                                        <div class="Products">
                                            <ul class="product_list gridcount grid row">
                                                @foreach($membershipList as $membership)
                                                    <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-3 ">
                                                        <div class="product-miniature">
                                                            <div class="thumbnail-container">
                                                                <a href="#">
                                                                    @if($membership->image)
                                                                        <img
                                                                            src="{{asset("storage/memberships/".$membership->image)}}"
                                                                            alt="product-image" class="img-fluid"/>
                                                                    @else
                                                                        <img
                                                                            src="{{asset("assets/images/membresia-1.jpg")}}"
                                                                            alt="product-image" class="img-fluid"/>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="product-description">
                                                                <h4>{{$membership->name}}</h4>
                                                                <p class="mb-10">{{__('Plan de trading')}}</p>
                                                                <p class="mb-10">{{__('Cuota de activación')}} - <span>{{@$registration->value}}$ </span>
                                                                </p>
                                                                <div
                                                                    class="d-flex flex-wrap justify-content-between align-items-center">
                                                                    @if(Auth::user()->membershipActive)
                                                                        <button type="button"
                                                                                class="btn btn-primary float-right btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#payModal_{{$membership->id}}" onclick="updateUpgrateMembership('{{$membership->id}}','{{$membership->amount}}')">
                                                                            {{__('Solicitar upgrade')}}
                                                                        </button>
                                                                        @include('user.modal_membership_upgrade')
                                                                    @else
                                                                        <div class="boton-activacion">
                                                                            <div class="boton" data-toggle="modal"
                                                                                 data-target="#pricingModal"
                                                                                 data-id="{{$membership->id}}"
                                                                                 onclick="updateMembership('{{$membership->name}}','{{$membership->id}}','{{$membership->amount}}','{{$registration->value}}')">
                                                                                <a href="#" data-toggle="tooltip"
                                                                                   data-placement="top" title=""
                                                                                   data-original-title="Activar Plan">
                                                                                    {{ __('Activar Plan') }}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="product-price">
                                                                        <div class="regular-price"><b>
                                                                                ${{$membership->amount}}</b></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(count($subscriptionList) && ($type=='*'|| $type=='subscription'))
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">
                                {{__('Robots de Trading')}}
                            </h3>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <div id="js-product-list">
                                        <div class="Products">
                                            <ul class="product_list gridcount grid row">
                                                @foreach($subscriptionList as $subscription)
                                                    <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-3 ">
                                                        <div class="product-miniature">
                                                            <div class="thumbnail-container">
                                                                @if($subscription->image)
                                                                    <img
                                                                        src="{{asset("storage/memberships/".$subscription->image)}}"
                                                                        alt="product-image" class="img-fluid"/>
                                                                @else
                                                                    <img
                                                                        src="{{asset("assets/images/membresia-1.jpg")}}"
                                                                        alt="product-image" class="img-fluid"/>
                                                                @endif
                                                            </div>
                                                            <div class="product-description">
                                                                <h4>{{$subscription->name}}</h4>
                                                                <p class="mb-10">{{__('Plan de activación anual')}}</p>
                                                                <p class="mb-10">  </span>  </p>
                                                                <div
                                                                    class="d-flex flex-wrap justify-content-between align-items-center">
                                                                    <div class="boton-activacion">
                                                                        <div class="boton" data-toggle="modal"
                                                                             data-target="#pricingModal"
                                                                             onclick="updateMembership('{{$subscription->name}}','{{$subscription->id}}')">
                                                                            <a href="#" data-toggle="tooltip"
                                                                               data-placement="top" title=""
                                                                               data-original-title="Activar Plan">
                                                                                {{ __('Activar Plan') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-price">
                                                                        <div class="regular-price">
                                                                            <b>${{$subscription->amount}}</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($type=='*'|| $type=='academys')
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">
                                {{__('Academia')}}
                            </h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="iq-card">
                                <div class="iq-card-body">
                                    <div class="row">
                                        <div class="col-md-6 iq-item-product-left">
                                            <div class="iq-image-container">
                                                <div class="iq-product-cover">
                                                    <img src="{{asset("assets/images/trading-deportivo2.jpg")}}"
                                                         alt="product-image" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 iq-item-product-right">
                                            <div class="product-additional-details">
                                                <h3 class="productpage_title">{{__('ACADEMIA BET LIVE')}}</h3>
                                                <p>{{__('Estudia con nosotros trading deportivo')}}</p>
                                                <div class="product-descriptio">
                                                    <p>{{__('Bet Live Academy es una aventura colectiva en donde personas con todo tipo de personalidad y edad, se pueden formar para adaptar un estilo de vida nuevo relacionado con las inversiones deportivas. Con más de 15 años de experiencia, hemos diseñado una plataforma poderosa, enfocada en enseñar a través de la práctica, conceptos claves para ser rentable en este mercado. Ahí es donde se encuentra el equilibrio del verdadero éxito.')}}
                                                        .</p>
                                                </div>
                                                <ul>
                                                    <li>{{__('Acceso vitalicio a las Master Classes de trading deportivo')}}
                                                        .
                                                    </li>
                                                    <li>{{__('Estrategias diarias de señales deportivas')}}.</li>
                                                    <li>{{__('Itinerarios operativos de eventos')}}.</li>
                                                    <li>{{__('Educación continua')}}.</li>
                                                </ul>
                                                <div class="additional-product-action d-flex align-items-center">
                                                    <div class="product-action ml-2">
                                                        <div class="add-to-cart"><a
                                                                href="https://betlive.academy/auth/register/Kaboom"
                                                                style="padding: 0 70px;" target="_blank"> {{__('Únete')}} </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--                        <div class="col-sm-12 ">--}}
                        {{--                            <div class="iq-card">--}}
                        {{--                                <div class="iq-card-body">--}}
                        {{--                                    <div id="js-product-list">--}}
                        {{--                                        <div class="Products">--}}
                        {{--                                            <ul class="product_list gridcount grid row">--}}
                        {{--                                                <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-3 ">--}}
                        {{--                                                    <div class="product-miniature">--}}
                        {{--                                                        <div class="thumbnail-container">--}}
                        {{--                                                            <a href="#"><img src="{{asset("assets/images/trading-deportivo.jpg")}}"--}}
                        {{--                                                                    alt="product-image" class="img-fluid"/> </a>--}}
                        {{--                                                        </div>--}}
                        {{--                                                        <div class="product-description">--}}
                        {{--                                                            <h4>{{__('ACADEMIA BET LIVE')}}</h4>--}}
                        {{--                                                            <p class="mb-10">{{__('Bet Live Academy es una aventura colectiva en donde personas con todo tipo de personalidad y edad, se pueden formar para adaptar un estilo de vida nuevo relacionado con las inversiones deportivas. Con más de 15 años de experiencia, hemos diseñado una plataforma poderosa, enfocada en enseñar a través de la práctica, conceptos claves para ser rentable en este mercado. Ahí es donde se encuentra el equilibrio del verdadero éxito.')}}</p>--}}
                        {{--                                                            <ul>--}}
                        {{--                                                                <li>Acceso vitalicio a las Master Classes de trading deportivo.</li>--}}
                        {{--                                                                <li>Estrategias diarias de señales deportivas.</li>--}}
                        {{--                                                                <li>Itinerarios operativos de eventos.</li>--}}
                        {{--                                                                <li>Educación continua.</li>--}}
                        {{--                                                                <li>Imagen de trading deportivo.</li>--}}
                        {{--                                                            </ul>--}}

                        {{--                                                            <p class="mb-10">  </span>  </p>--}}
                        {{--                                                            <div--}}
                        {{--                                                                class="d-flex flex-wrap justify-content-between align-items-center"--}}
                        {{--                                                            ">--}}
                        {{--                                                            <div class="boton-activacion">--}}
                        {{--                                                                <div class="boton">--}}
                        {{--                                                                    <a href="https://www.betliveacademy.com/login"--}}
                        {{--                                                                       data-toggle="tooltip"--}}
                        {{--                                                                       data-placement="top" title=""--}}
                        {{--                                                                       data-original-title="Únete" target="_blank">--}}
                        {{--                                                                        Únete</a></div>--}}
                        {{--                                                            </div>--}}

                        {{--                                                        </div>--}}
                        {{--                                                    </div>--}}

                        {{--                                                </li>--}}
                        {{--                                            </ul>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        @endif


                        <div class="modal fade" id="pricingModal" tabindex="-1" role="dialog"
                             aria-labelledby="pricingModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <b id="membershipTitle"></b>
                                            &nbsp;-&nbsp;
                                            {{__("Solicitar activación")}}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{--                                    {{Form::open(["route"=>'user.load.verification',"enctype"=>"multipart/form-data"])}}--}}
                                    {{--                                    {{Form::hidden('membership_id',null,['id'=>'membership_id'])}}--}}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(count($subscriptionList) && ($type=='*'|| $type=='pool'))
                                                    <h4 class="card-title">{{__('Instrucciones')}}</h4>
                                                    <ol class="px-5">
                                                        <li>{{__('Completar todos tus datos en tu perfil')}}</li>
                                                        <li>{{__('Enviar todos los documentos para el KYC')}}</li>
                                                        <li>{{__('Realizar el proceso de pago')}}</li>
                                                    </ol>
                                                @endif

                                                @if(count($membershipList) && ($type=='*'|| $type=='subscription'))
                                                    <h4 class="card-title">{{__('Instrucciones')}}</h4>
                                                    <ol class="px-5">
                                                        <li>{{__('Completar todos tus datos en tu perfil')}}</li>
                                                        <li>{{__('Enviar todos los documentos para el KYC')}}</li>
                                                        <li>{{__('Abre tu cuenta en tu bróker - Si no tienes, puedes')}}
                                                            <a href="https://my.myfxchoice.com/registration/?refer=324283"
                                                               style="color: #f5ca62; font-size: 20px;"> {{__('Registrarte Aquí')}}</a></li>
                                                        <li>{{__('Entrada mínima $1500 dolares')}}</li>
                                                    </ol>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row">
                                            {{--                                            <div class="col-md-12">--}}
                                            {{--                                                <div class="custom-file">--}}
                                            {{--                                                    <input type="file" class="custom-file-input"--}}
                                            {{--                                                           id="support_document"--}}
                                            {{--                                                           name="support_document" lang="es">--}}
                                            {{--                                                    <label class="custom-file-label" for="customFileLang">--}}
                                            {{--                                                        {{__('Seleccione archivo')}}--}}
                                            {{--                                                    </label>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </div>--}}
                                            {{--                                    <div class="modal-footer">--}}
                                            {{--                                        {{Form::submit('Cargar',['class'=>'btn btn-primary mt-1 col-md-12'])}}--}}
                                            {{--                                    </div>--}}
                                            {{--                                    {{Form::close()}}--}}
                                            @include('user.modal_pay_memberships')
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        @endsection
                        @section('scripts')
                            <script type="text/javascript">
                                $(document).ready(function (e) {
                                    $('#pricingModal').on('show.bs.modal', function (e) {
                                        var id = $(e.relatedTarget).data().id;
                                        $(e.currentTarget).find('#id_menbreship').val(id);

                                    });
                                });

                                function updateMembership(title, value, amount, system) {
                                    $('#membership_id').val(value);
                                    $('#user_membresia_id').val(value);
                                    $('#membershipTitle').html(title);
                                    $('.membership_amount').html(amount);
                                    $('#membershipamount').val(amount);
                                    $('.membershipamount').val(amount);
                                    $('.user_membresia_id').val(value);
                                    var monto = parseInt(amount);
                                    var fee = parseInt(system);
                                    $('#total').html(monto + fee);
                                }

                                function updateUpgrateMembership(value, amount) {
                                    $('.membership_id').val(value);
                                    $('.membershipamount').val(amount);
                                    $('.user_membresia_id').val(value);
                                }
                            </script>
@endsection
