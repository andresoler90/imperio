<!-- Modal -->
@php
    $system = \App\Models\System::where('parameter','pay_membership_porcentaje')->first();
    $membership_verificado = \App\Models\MembershipVerifications::where('user_memberships_id',Auth::user()->userMembership->id)->where('status','!=','R')->first();
    $total = (@$membership->amount + @$registration->value);
@endphp

<div class="modal fade" id="payModal_{{$membership->id}}" tabindex="-1" role="dialog"
     aria-labelledby="payModal_{{$membership->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Modernizar')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr>
                        <th>{{__('Membresias')}}</th>
                        <td style="text-align: right">${{@$membership->amount}}</td>
                    </tr>
                    <tr>
                        <th>{{__('Cuota de activación')}}</th>
                        <td style="text-align: right">${{@$registration->value}}</td>
                    </tr>
                    <tr style="border-top: solid #ECEFF1 2px;">
                        <th>{{__('Total')}}</th>
                        <td style="text-align: right">${{@$total}}</td>
                    </tr>
                </table>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-profile-tab_{{$membership->id}}" data-toggle="tab"
                           href="#nav-coinbase_{{$membership->id}}"
                           role="tab" aria-controls="nav-coinbase_{{$membership->id}}"
                           aria-selected="false">{{('Coinbase')}}</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active"  id="nav-coinbase_{{$membership->id}}" role="tabpanel"
                         aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::open(['route'=>['user.load.coinbase'],'method'=>'POST','files' => true])}}
                                {{ Form::token() }}
{{--                                <input type="hidden" class="form-control amount" name="amount"--}}
{{--                                       placeholder="Ingresa monto" value="{{Auth::user()->userMembership->price}}">--}}
{{--                                <input type="hidden" name="user_membresia_id" placeholder="Ingresa monto"--}}
{{--                                       value="{{Auth::user()->userMembership->id}}">--}}
                                {{Form::hidden('user_membresia_id',null,['id'=>'' , 'class'=>'user_membresia_id'])}}
                                {{Form::hidden('amount',null,['id'=>'', 'class'=>'membershipamount'])}}
                                <div class="row col-12 input_fields_wrap">
                                    <div class="col-6 form-group">
                                        <label class="label" for="">
                                            {{__('Teléfono')}}
                                        </label><br>
                                        <div class="input-group mb-2">
                                            {{ Form::text('cellphone',old('cellphone',@Auth::user()->userContacInformacion->cellphone1),["class"=>"form-control"]) }}
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="label" for="">
                                            {{__('Documento Identidad')}}
                                        </label><br>
                                        <div class="input-group mb-2">
                                            {{ Form::text('identification_document',old('identification_document',@Auth::user()->userContacInformacion->identification_document),["class"=>"form-control",'required']) }}
                                        </div>
                                    </div>
                                </div>
                                <ol>
                                    <li>{{__("Al iniciar el proceso de pago coinbase este abrira una nueva pestaña en su navegador.")}}

                                    <li>{{__("El sistema de coinbase le dara las instrucciones necesarias para realizar el pago.")}}
                                    </li>
                                    <li>{{__("Una vez realizado el pago, NO DEBE CERRAR LA VENTANA hasta que el sistema de coinbase confirme el pago.")}}
                                    </li>
                                    <li>
                                        {{__("Ya al estar confirmado el pago, coinbase lo redirigirá nuevamente a una pantalla del sistema de KABOOM, ya aqui culmina el proceso y deberia activarse de manera automatica la membresia")}}
                                    </li>
                                    <li>{{__("Si realizo el pago, y el sistema de coinbase aun no ha realizado la confirmacion NO DEBE GENERAR UNA NUEVA PETICION DE PAGO a menos de que en la peticion anterior no hubiese generado ningun pago")}}
                                    </li>
                                    @if(Auth::user()->userMembership)
                                        <li>
                                            {{__("Si realizo el pago, y tuvo algun inconveniente que lo llevo a cerrar la ventana o desconectarse de internet, puede ejecutar la reverificación del pago de manera manual haciendo")}}
                                            <a href="{{route('user.recheck', Auth::user()->userMembership->id)}}"
                                               style="color: #0cd2e3;">
                                                {{__("Click aqui")}}
                                            </a>
                                        </li>
                                    @endif
                                </ol>
                                <br>
                                @if(empty($membership_verificado))
                                    {{Form::submit(__('Continuar'),['class'=>'btn btn-primary float-right'])}}
                                @else
                                    {{Form::submit(__('Continuar'),['class'=>'btn btn-primary float-right', 'disabled'])}}
                                @endif

                                {{Form::close()}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
