@include('partials._body_style')
<section class="sign-in-page bg-white">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-sm-6 align-self-center">
                <div class="sign-in-from">
                    <a href="{{route('locale',"es")}}" class="iq-waves-effect">ES</a>
                    <a href="{{route('locale',"en")}}" class="iq-waves-effect">EN</a>
                <!--   <a class="sign-in-logo mb-5" href="#"><img
                            src={{asset("assets/images/logo-gray-strongbox.png")}} class="img-fluid" alt="logo"></a> -->
                    <h1 class="mb-0">Nueva Contraseña</h1>
                    <p>Ingrese y confirme su nueva contraseña</p>

                    <form method="POST" action="{{route('resetclavenew')}}" class="mt-4">
                        @csrf
                        <input type="hidden" class="form-control " name="userd_id" value="{{$id}}">
                        <div class="form-group">
                            <label for="new_password">{{__('Nueva contraseña:')}}</label>
                            <input id="new_password" type="password"
                                   class="form-control " placeholder="Ingrese nueva contraseña"
                                   name="new_password" value="{{ old('new_password') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confir_password">{{__('Confirmar contraseña:')}}</label>
                            <input id="confir_password" type="password" placeholder="Confirme contraseña"
                                   class="form-control " name="confir_password"
                                   required >

                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="d-inline-block w-100">

                            <button type="submit" class="btn btn-primary float-right">
                               Aceptar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <div class="sign-in-detail text-white"
                     style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                    <a class="sign-in-logo mb-5" href="#"><img
                            src={{asset("assets/images/logo-white.png" )}} class="img-fluid" alt="logo"></a>
                    <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"
                         data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"
                         data-items-mobile-sm="1" data-margin="0">
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials._body_footer')
