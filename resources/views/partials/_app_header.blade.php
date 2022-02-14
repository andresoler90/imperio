<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <div class="iq-sidebar-logo">
            <div class="top-logo">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/images/logo-white-strongbox.png') }}" class="img-fluid" alt=""
                         style="max-height: 100px;">
                    <span>{{config('APP_NAME')}}</span>
                </a>
            </div>
        </div>
        @php($name = Request::route()->getName())
        @php($arr = explode(".",$name))
        <div class="navbar-breadcrumb">
            <h5 class="mb-0 texto-naranja" style="text-transform: capitalize">{{$arr[0]}}</h5>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    @if($arr)
                        @foreach($arr as $key=>$segment)
                            @if($key)
                                <li class="breadcrumb-item" aria-current="page"
                                    style="text-transform: capitalize">{{__($segment)}}</li>
                            @endif
                        @endforeach
                    @else
                        Inicio
                    @endif
                </ul>
            </nav>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    @if(App::getLocale()=='es')
                        <li class="nav-item">
                            <a href="{{route('locale',"en")}}" class="iq-waves-effect">EN</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{route('locale',"es")}}" class="iq-waves-effect">ES</a>
                        </li>
                    @endif
                    <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i
                                class="ri-fullscreen-line"></i></a></li>
                    <li class="nav-item text-red-dark">
                        @impersonating($guard = null)
                        <a href="{{ route('impersonate.leave') }}">Detener</a>
                        @endImpersonating
                    </li>
                </ul>
            </div>
            <ul class="navbar-list">
                <li>
                    <a href="#" class="search-toggle iq-waves-effect text-white color-naranja"><img
                            src="{{ asset(isset(Auth::user()->contactInformation->url_image) ? Auth::user()->contactInformation->url_image : 'assets/images/user/11.png') }}"
                            class="img-fluid rounded" alt="user-image"></a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">{{__('Hola')}} {{Auth::user()->full_name}}</h5>
                                    <span class="text-white font-size-12">{{__('Disponible')}}</span>
                                </div>
                                <a href="{{ route('profile.edit','user') }}"
                                   class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-success">
                                            <i class="ri-profile-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">{{__('Editar perfil')}}</h6>
                                            <p class="mb-0 font-size-12">{{__('Modifica algún detalle en tu perfil')}}</p>
                                        </div>
                                    </div>
                                </a>
{{--                                <a href="{{ route('user.settings') }}" class="iq-sub-card iq-bg-primary-danger-hover">--}}
{{--                                    <div class="media align-items-center">--}}
{{--                                        <div class="rounded iq-card-icon iq-bg-danger">--}}
{{--                                            <i class="ri-account-box-line"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body ml-3">--}}
{{--                                            <h6 class="mb-0 ">{{__('Activa el 2fa')}}</h6>--}}
{{--                                            <p class="mb-0 font-size-12">{{__('Administra las configuraciones de tu cuenta')}}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn" role="button" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                        <i class="ri-login-box-line ml-2"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- TOP Nav Bar END -->
