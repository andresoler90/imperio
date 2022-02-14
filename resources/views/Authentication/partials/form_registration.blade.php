@include('partials.errors_toast')
@php($route = Auth::user() ? 'user.create.reference' : 'register')

<form method="POST" action="{{ route($route) }}">
    @csrf

    <div class="row">

        <div class="form-group col-md-12">
            <label for="username">{{__('Usuario')}}</label>
            <input id="username" type="text"
                   class="form-control mb-0 @error('username') is-invalid @enderror" name="username"
                   value="{{ old('username') }}" required autocomplete="name" autofocus>
            @error('username')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="form-group col-md-6">

            <label for="password">{{__('Clave')}}</label>
            <input id="password" type="password"
                   class="form-control mb-0 @error('password') is-invalid @enderror" name="password"
                   required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="password-confirm">{{ __('Confirmar clave') }}</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    <hr>
    <div class="row">


        <div class="form-group col-md-6">

            <label for="name">{{__('Nombre')}}</label>
            <input id="name" type="text"
                   class="form-control mb-0 @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="lastname">{{__('Apellido')}}</label>
            <input id="lastname" type="text"
                   class="form-control mb-0 @error('lastname') is-invalid @enderror" name="lastname"
                   value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
            <label for="email">{{__('Correo electrónico')}}</label>
            <input id="email" type="email"
                   class="form-control mb-0 @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="countries_id">{{__('País')}}</label>
            {{Form::select('countries_id',\App\Models\Country::all()->pluck('name','id'),null,['class'=>'custom-select','id'=>'countries_id','placeholder'=>'Seleccione...','required'])}}

            @error('countries_id')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    @if(Auth::user())
        {{Form::hidden('sponsor',Auth::user()->username)}}
    @elseif(isset($_REQUEST['sponsor']))
        {{Form::hidden('sponsor',$_REQUEST['sponsor'])}}
    @else
        {{Form::hidden('sponsor','admin')}}
    @endif
    <div class="d-inline-block w-100">
        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
            <input type="checkbox" class="custom-control-input" id="customCheck1" required>
            <label class="custom-control-label" for="customCheck1">
                {{__("Aceptar")}}
                <a href="{{asset('pdf/terminosycondiciones.pdf')}}" target="_blank">
                    {{__('Términos y condiciones')}}
                </a>
            </label>
        </div>
        <button type="submit" class="btn btn-primary float-right">{{__('Continuar')}}</button>
    </div>
    @if(!Auth::user())
        <div class="sign-info">
                            <span class="dark-color d-inline-block line-height-2">{{__('Posee cuenta')}} ? <a
                                    href="{{route('login')}}">{{__('Ingrese aquí')}}</a></span>
            <ul class="iq-social-media">
                <li><a href="mailto:support@kaboom.world" target="_blank"><i class="ri-mail-line"></i></a></li>
                <li><a href="" target="_blank"><i class="ri-telegram-line"></i></a></li>
            </ul>
        </div>
    @endif
</form>
