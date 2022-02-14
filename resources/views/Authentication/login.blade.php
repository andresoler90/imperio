@include('partials._body_style')
<section class="sign-in-page bg-white">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-sm-6 align-self-center">
                <div class="sign-in-from">
                    <a class="logo-login mb-5" href="#"><img
                            src={{asset("assets/images/logo-white-strongbox.png")}} class="img-fluid" alt="logo"></a>
                    <br>


                    <!--   <a class="sign-in-logo mb-5" href="#"><img
                            src={{asset("assets/images/logo-gray-strongbox.png")}} class="img-fluid" alt="logo"></a> -->
                    <h1 class="mb-0">{{__('Acceder')}}</h1>
{{--                    <a href="{{route('locale',"es")}}" class="iq-waves-effect">ES</a>--}}
{{--                    <a href="{{route('locale',"en")}}" class="iq-waves-effect">EN</a>--}}
                    <p>{{__('Ingresa con tu usuario para acceder a nuestro sistema')}}</p>

                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="username">{{__('Usuario')}}</label>
                            <input id="username" type="text"
                                   class="form-control  mb-0 @error('username') is-invalid @enderror" placeholder="{{__('Ingrese con su usuario')}}"
                                   name="username" value="{{ old('username') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Clave')}}</label>
                            <a href="{{route('recover-password')}}" class="float-right">{{__('¿Olvidaste tu clave?')}}</a>
                            <input id="password" type="password" placeholder="{{__('Ingrese su clave')}}"
                                   class="form-control mb-0 @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="d-inline-block w-100">

                            <button type="submit" class="btn btn-primary float-right">
                                {{__('Ingresar')}}
                            </button>
                        </div>
                        <div class="sign-info">
                            <span class="dark-color d-inline-block line-height-2">{{__('No posee una cuenta?')}} <a
                                    href="{{route('registration')}}">{{__('Regístrese aquí')}}</a></span>
                            <ul class="iq-social-media">
                                <li><a href="mailto:support@kaboom.world" target="_blank"><i class="ri-mail-line"></i></a></li>
                                <li><a href="" target="_blank"><i class="ri-telegram-line"></i></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 text-center">

                <div class="sign-in-detail text-white" style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                    <br><br><br>
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
</section>
@include('partials._body_footer')
