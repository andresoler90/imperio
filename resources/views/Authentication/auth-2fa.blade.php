@include('partials._body_style')
<section class="sign-in-page bg-white">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-sm-6 align-self-center">
                <div class="sign-in-from">
                    {{Form::open(['route'=>['googleLogin',$user->id],'method'=>'POST'])}}
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="mt-3 mb-0">{{__('Clave dinámica')}}</h1>
                        </div>
                    </div>
                    <div class="row  align-items-center">
                        <div class="col-md-12">
                            <input class="form-control" id="code_verification" name="code_verification" type="text"
                                   placeholder="{{__('Código de verificación')}}" maxlength="6" required>

                            {!! Form::submit(__('Continuar'),array('class'=>'btn btn-primary mt-3')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>


            <div class="col-sm-6 text-center">
                <div class="sign-in-detail text-white"
                     style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                    <a class="sign-in-logo mb-5" href="#"><img
                            src={{asset("assets/images/logo-white-strongbox.png")}} class="img-fluid" alt="logo"></a>
                    <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"
                         data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"
                         data-items-mobile-sm="1" data-margin="0">
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>
                            <p>Gana dinero y aprende trading con nosotros!.</p>
                        </div>
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>
                            <p>Gana dinero y aprende trading con nosotros!.</p>
                        </div>
                        <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Tu mejor oportunidad esta aquí!</h4>
                            <p>Gana dinero y aprende trading con nosotros!.</p>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>
@include('partials._body_footer')
