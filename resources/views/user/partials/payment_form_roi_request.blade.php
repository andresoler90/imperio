{{ Form::open(['route'=> ['user.save.roi'] ,'method'=>'POST', 'files' => true]) }}
{{ Form::token() }}
@php($maxAmount = number_format(Auth::user()->balanceRoiTotal(),2))
@php($minAmount = \App\Models\System::where('parameter','remove_minimum')->first())

<div class="row align-items-center">
    <div class="form-group col-sm-12">
        {{ Form::label('amount_remove',__('Cantidad a retirar:')) }}
        {{ Form::number('amount_remove',null,["class"=>"form-control","required","min" => @$minAmount->value, "max" => $maxAmount ,"step"=>".01"]) }}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('type',__('BITCOIN / ETHER:')) }}
        {{ Form::select('type',config("options.typePayment"),null,["class"=>"form-control", "required", 'placeholder' => __('Seleccione')]) }}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('address_wallet',__('Direccion billetera:')) }}
        {{ Form::text('address_wallet',null,['class'=>'form-control', "required"]) }}
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
{{--        @if(date("N")==(int)env('PAYMENT_DAY'))--}}
        @if(in_array(date("N"),explode(',',env('PAYMENT_DAY'))))

                <div class="alert alert-info" role="alert">
                    {{__("Comisión por retiro: ") . $remove_commission->value . '%'}}
                </div>
                {{ Form::submit(__('Guardar'),["class" => "btn btn-primary mr-2"]) }}
        @else
            <div class="alert alert-secondary" role="alert">
                <div class="col-md-12">
                @php($dias = explode(',', env('PAYMENT_DAY')))
                {{__("Solicitud de retiro disponible solo el dia")}}<br>

                @foreach($dias as $val)
                        <b>{{__(config('options.weekly_days_payment.'.$val))}}</b>
                @endforeach
            </div>
            </div>
        @endif
    </div>

</div>
{{ Form::close() }}
