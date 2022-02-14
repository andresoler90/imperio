@include('partials._body_style')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 align-self-center">
            <div class="sign-in-from">
                <a class="logo-login mb-5" href="#"><img
                        src={{asset("assets/images/logo-white-strongbox.png")}} class="img-fluid" alt="logo" style="max-height: 100px;"></a>
                <br>

                <h1 class="mb-0  pt-3">{{__('Registrarse')}}</h1>
                <br>

                @include('Authentication.partials.form_registration')

            </div>
        </div>
            <div class="col-sm-6 text-center">
                <div class="sign-in-detail text-white"
                     style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">

{{--                    <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"--}}
{{--                         data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"--}}
{{--                         data-items-mobile-sm="1" data-margin="0">--}}
{{--                        <div class="item">--}}
{{--                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">--}}
{{--                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>--}}
{{--                            <p>Gana dinero y aprende trading con nosotros!.</p>--}}
{{--                        </div>--}}
{{--                             <div class="item">--}}
{{--                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">--}}
{{--                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>--}}
{{--                            <p>Gana dinero y aprende trading con nosotros!.</p>--}}
{{--                        </div>--}}
{{--                             <div class="item">--}}
{{--                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">--}}
{{--                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>--}}
{{--                            <p>Gana dinero y aprende trading con nosotros!.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
    </div>
</div>
@include('partials._body_footer')

