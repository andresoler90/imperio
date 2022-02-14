<!-- Modal -->
@php
$system = \App\Models\System::where('parameter', 'pay_membership_porcentaje')->first();
$registration = \App\Models\System::where('parameter', 'registration_value')->first();
@endphp
<table class="table table-borderless">

    <tr>
        <th>{{ __('Membresias') }}</th>
        <td style="text-align: right"> <b class="membership_amount"></b></td>
    </tr>
    <tr>
        <th>{{ __('Fee de activación') }}</th>
        <td style="text-align: right">$ <b>{{ $registration->value }}</b></td>
    </tr>
    <tr style="border-top: solid #ECEFF1 2px;">
        <th>{{ __('Total') }}</th>
        <td style="text-align: right"><b id="total"></b></td>
    </tr>
</table>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-coinbase" role="tab"
            aria-controls="nav-coinbase" aria-selected="false">{{ __('Criptomonedas') }}</a>

        <!--<a class="nav-item nav-link" id="nav-mercadopago-tab" data-toggle="tab" href="#nav-mercadopago"
           role="tab" aria-controls="nav-mercadopago" aria-selected="false">{{ __('MercadoPago') }}</a>-->
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade " id="nav-wallet" role="tabpanel" aria-labelledby="nav-home-tab">
        {{ Form::open(['route' => 'user.load.verification', 'enctype' => 'multipart/form-data']) }}
        {{ Form::hidden('membership_id', null, ['id' => 'membership_id']) }}
        @csrf
        <div class="col-md-12">
            <div id="">
                <div class="row col-12 input_fields_wrap">
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ 'Nombre' }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('name', old('name', @Auth::user()->name), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ 'Apellido' }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('lastname', old('lastname', @Auth::user()->lastname), ['class' => 'form-control']) }}

                        </div>
                    </div>
                </div>
                <div class="row col-12 input_fields_wrap">
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ 'Usuario:' }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('username', old('username', @Auth::user()->username), ['class' => 'form-control', 'disabled']) }}
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ 'Documento Identidad:' }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('identification_document', old('identification_document', @Auth::user()->userContacInformacion->identification_document), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row col-12 input_fields_wrap">
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ 'Telefono:' }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('cellphone', old('cellphone', @Auth::user()->userContacInformacion->cellphone1), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ ' Fecha:' }}
                        </label><br>
                        <label><b>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</b></label>
                    </div>
                </div>
            </div>
            <br>
            <label class="label" for="">
                {{ 'Eres Titular de la Cuenta?' }}
            </label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="titular" id="inlineRadio1" value="NO" checked>
                <label class="form-check-label" for="inlineRadio1">SI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="titular" id="inlineRadio2" value="SI">
                <label class="form-check-label" for="inlineRadio2">NO</label>
            </div>
            <br>
            <div id="no_titular_1" style="display: none;">

                <div class="col-12 form-group">
                    {{ Form::label('address_wallet', 'Documento de identidad') }}
                    <div class="input-group mb-2">
                        {{ Form::text('documento_identidad', old('address_wallet'), ['class' => 'form-control documento_identidad']) }}
                    </div>
                </div>
                <div class="col-12 form-group">
                    {{ Form::label('address_wallet', 'Seleccione Pais del banco') }}
                    <div class="input-group mb-2">
                        {{ Form::select('pais_banco', \App\Models\Country::all()->pluck('name', 'id'), old('pais_banco'), ['class' => 'form-control pais_banco', 'id' => 'pais_banco']) }}
                    </div>
                </div>
                <div class="col-12 form-group">
                    {{ Form::label('name_lastname', 'Documento de identidad') }}
                    <div class="input-group mb-2">
                        {{ Form::text('name_lastname', old('name_lastname'), ['class' => 'form-control name_lastname']) }}
                    </div>
                </div>

            </div>
            <br>
            <label for="customFileLang">
                {{ 'Ingrese recibo de pago para procesar su solicitud.' }}
            </label><br>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="support_document" name="support_document" lang="es"
                    required>
                <label class="custom-file-label" for="customFileLang">
                    {{ __('Seleccionar Archivo') }} (jpg,jpeg,png,pdf)
                </label>
            </div>
            {{ Form::submit('Cargar', ['class' => 'btn btn-primary mt-1 col-md-12    ']) }}

        </div>

        {{ Form::close() }}

    </div>
    <div class="tab-pane fade show active" id="nav-coinbase" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => ['user.load.coinbase'], 'method' => 'POST', 'files' => true]) }}
                {{ Form::hidden('user_membresia_id', null, ['id' => 'user_membresia_id']) }}
                {{ Form::hidden('amount', null, ['id' => 'membershipamount']) }}
                {{ Form::token() }}
                {{-- <input type="hidden" class="form-control amount" name="amount" placeholder="Ingresa monto" value="{{$membership->amount}}"> --}}
                {{-- <input type="hidden" name="user_membresia_id"  placeholder="Ingresa monto" value="{{$membership->id}}"> --}}
                <div class="row col-12 input_fields_wrap">
                    <div class="form-group col-md-6">
                        <label for="countries_id">{{ __('Código pais') }}</label>

                        {{ Form::hidden('code_phone', '+57',['id' => 'code_phone']) }}

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="btn-group btn-block bg-white rounded form-control">
                                    <button type="button" id="btn-cod-internacional"
                                        class="btn btn-default rounded dropdown-toggle"
                                        data-toggle="dropdown">
                                        <span data-bind="label" id="cod_value">
                                            +58</span>
                                        &nbsp;&nbsp;
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu form-control"
                                    role="menu" id="cod_internacional"
                                    style="height: 400px !important; margin-left: -12px; overflow-y: scroll !important;scroll-behavior: smooth !important;">
                                         @foreach ($countries as $item)
                                            <li><a href="#"><span class="ml-4 mr-2 flag-icon flag-icon-{{ strtolower($item->code) }}"></span> +{{ $item->code_phone }}</a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ __('Teléfono') }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::number('cellphone', old('cellphone', @Auth::user()->userContacInformacion->cellphone1), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ __('Documento Identidad') }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::number('identification_document', old('identification_document', @Auth::user()->userContacInformacion->identification_document), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                </div>
                <ol class="p-4">
                    <li>{{ __('Al iniciar el proceso de pago coinbase este abrirá una nueva pestaña en su navegador.') }}
                    </li>
                    <li>{{ __('El sistema de coinbase le dara las instrucciones necesarias para realizar el pago.') }}
                    </li>
                    <li>{{ __('Una vez realizado el pago, NO DEBE CERRAR LA VENTANA hasta que el sistema de coinbase confirme el pago.') }}
                    </li>
                    <li>
                        {{ __('Ya al estar confirmado el pago, coinbase lo redirigirá nuevamente a una pantalla del sistema de KABOOM, ya aquí culmina el proceso y debería activarse de manera automática la membresía') }}
                    </li>
                    <li>{{ __('Si realizo el pago, y el sistema de coinbase aun no ha realizado la confirmación NO DEBE GENERAR UNA NUEVA PETICIÓN DE PAGO a menos de que en la petición anterior no hubiese generado ningún pago') }}
                    </li>
                    @if (Auth::user()->userMembership)
                        <li>
                            {{ __('Si realizo el pago, y tuvo algún inconveniente que lo llevo a cerrar la ventana o desconectarse de internet, puede ejecutar la reverificación del pago de manera manual haciendo') }}
                            <a href="{{ route('user.recheck', Auth::user()->userMembership->id) }}"
                                style="color: #0cd2e3;">
                                {{ __('Click aquí') }}
                            </a>
                        </li>
                    @endif
                </ol>
                <br>
                <div class="mr-4">
                    {{ Form::submit(__('Continuar'), ['class' => 'btn btn-primary float-right ']) }}
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-mercadopago" role="tabpanel" aria-labelledby="nav-mercadopago-tab">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => ['user.load.mercadopago'], 'method' => 'POST', 'files' => true]) }}
                {{ Form::hidden('user_membresia_id', null, ['id' => '', 'class' => 'user_membresia_id']) }}
                {{ Form::hidden('amount', null, ['id' => '', 'class' => 'membershipamount']) }}
                {{ Form::token() }}
                {{-- <input type="hidden" class="form-control amount" name="amount" placeholder="Ingresa monto" value="{{$membership->amount}}"> --}}
                {{-- <input type="hidden" name="user_membresia_id"  placeholder="Ingresa monto" value="{{$membership->id}}"> --}}
                <div class="row col-12 input_fields_wrap">
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ __('Telefono') }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::tel('cellphone', old('cellphone', @Auth::user()->userContacInformacion->cellphone1), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="label" for="">
                            {{ __('Documento Identidad') }}
                        </label><br>
                        <div class="input-group mb-2">
                            {{ Form::text('identification_document', old('identification_document', @Auth::user()->userContacInformacion->identification_document), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                </div>
                <ol>
                    <li>{{ __('Al iniciar el proceso Mercado Pago este abrira una nueva pestaña en su navegador.') }}
                    </li>
                    <li>{{ __('El sistema de Mercado Pago le dara las instrucciones necesarias para realizar el pago.') }}
                    </li>
                    <li>{{ __('Una vez realizado el pago, NO DEBE CERRAR LA VENTANA hasta que el sistema confirme el pago.') }}
                    </li>
                    <li>
                        {{ __('Ya al estar confirmado el pago, Mercado pago lo redirigirá nuevamente a una pantalla del sistema de KABOOM, ya aqui culmina el proceso y deberia activarse de manera automatica la membresia') }}
                    </li>
                </ol>
                <div class="mr-4">
                    {{ Form::submit(__('Continuar'), ['class' => 'btn btn-primary float-right ']) }}
                    {{ Form::close() }}
                </div>
                <br>


            </div>
        </div>
    </div>


</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var titular = $('input:radio[name=titular]:checked').val();
        if (titular == 'NO') {
            $('#titular_1').show();
            $('#no_titular_1').hide();
            $('.documento_identidad').prop('required', false);
            $('.pais_banco').prop('required', false);
            $('#pais_banco').val('');
        } else {
            $('#titular_1').hide();
            $('#no_titular_1').show();
            $('.documento_identidad').prop('required', true);
            $('.pais_banco').prop('required', true);
            $('#pais_banco').val('');
        }

        $('.form-check-input').change(function() {
            var titular = $('input:radio[name=titular]:checked').val();
            if (titular == 'NO') {
                $('#titular_1').show();
                $('#no_titular_1').hide();
                $('.documento_identidad').prop('required', false);
                $('.pais_banco').prop('required', false);
                $('#pais_banco').val('');
            } else {
                $('#titular_1').hide();
                $('#no_titular_1').show();
                $('.documento_identidad').prop('required', true);
                $('.pais_banco').prop('required', true);
                $('#pais_banco').val('');
            }
        });
    });


    $(document.body).on('click', '.dropdown-menu li', function (event) {
        var $target = $(event.currentTarget);
        $target.closest('.btn-group')
            .find('[data-bind="label"]').text($target.text())
            .end()
            .children('.dropdown-toggle').dropdown('toggle');
        code_area();
        return false;
    });

    const code_area = () => {
        console.log(document.getElementById('cod_value').innerHTML);
        document.getElementById('code_phone').value = document.getElementById('cod_value').innerHTML
    }

</script>
