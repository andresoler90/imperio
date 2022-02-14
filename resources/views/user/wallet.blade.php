@extends('layouts.master')
@section('styles')
    <style>
        .select2-search { background-color: gray; }
        .select2-search input { background-color: gray; }
        .select2-results { background-color: gray; }
    </style>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="iq-card iq-card-block iq-card-stretch">
                        <div class="iq-card-body">
                            <h2 class="mb-0"><span>$</span><span
                                    class="counter">{{number_format(Auth::user()->balanceTotal(),2)}}</span>
                                <input type="hidden" id="total_amount"
                                       value="{{Auth::user()->balanceTotal()}}">
                            </h2>
                            <p class="mb-3">{{__('Saldo actual')}}</p>
                            <div class="row align-items-center justify-content-between">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3 mb-md-0">
                                        <div class="rounded-circle iq-card-icon iq-bg-danger mr-3"><i
                                                class="ri-group-line"></i></div>
                                        <div class="text-left">
                                            <h4>{{count(Auth::user()->referreds())}}</h4>
                                            <p class="mb-0">{{__('Referidos')}}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{Form::open(['route'=>'user.transfer','method'=>'POST','onsubmit'=>'return validate()'])}}
                    <div class="iq-card iq-card-block iq-card-stretch mt-1">
                        <div class="iq-card-body">
                            <p class="mb-3">{{__('Transferencia de fondos')}}</p>
                            <div class="row align-items-center justify-content-between">
                                <div class="form-group col-sm-12">
                                    <label for="name">{{__('Traslado a (Usuario)')}}</label>
                                    {{ Form::select('name',$referred,null,['required','placeholder' => __('Seleccione'),'class'=>'custom-select select2']) }}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="amount_transfer">{{__('Cantidad a transferir')}}</label>
                                    {{Form::number('amount_transfer','',['class'=>'form-control', 'id'=>'amount_transfer','required'])}}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="comment">{{__('Nota Transacción')}}</label>
                                    {{Form::text('comment',isset($data->comment)?$data->comment:old('comment'),['class'=>'form-control',' required'])}}
                                </div>
                                <div class="form-group col-sm-12">
                                    @if(!empty($referred))
                                        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
                                        <span class="float-right">{{__('Se cobrara un')}} {{isset($feeValue)?$feeValue:''}}% {{__('por cada transacción')}}</span>
                                        <input type="hidden" id="feeValue" value="{{isset($feeValue)?$feeValue:''}}">
                                    @else
                                        <div class="alert alert-danger">
                                            <span class="float-right">{{__('No cuenta con referidos para realizar esta transacción')}}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
{{--                    {{Form::close()}}--}}
{{--                    @if(Auth::user()->membership)--}}
{{--                        {{Form::open(['route'=>'user.reinvestment','method'=>'POST'])}}--}}
{{--                        @php($maxAmount = number_format(Auth::user()->balanceTotal(),2))--}}
{{--                        <div class="iq-card iq-card-block iq-card-stretch mt-1">--}}
{{--                            <div class="iq-card-body">--}}
{{--                                <p class="mb-3">{{__('Reinversión')}}</p>--}}
{{--                                <p class="mb-0"><span>{{__('Inversión actual')}} $</span><span--}}
{{--                                        class="counter">{{number_format(Auth::user()->investment(),2)}}</span>--}}
{{--                                </p>--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span>{{'Membresia Actual'}}: {{Auth::user()->membership()->first() ? Auth::user()->membership()->first()->membership->name : 'N/A'}}</span>--}}
{{--                                </p>--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span>{{'Próxima Membresia'}}: {{Auth::user()->nextMembership() ? Auth::user()->nextMembership()->name : 'N/A'}}</span>--}}
{{--                                </p>--}}
{{--                                <div class="row align-items-center justify-content-between">--}}
{{--                                    <div class="form-group col-sm-12">--}}
{{--                                        <label for="amount">{{__('Monto')}}</label>--}}
{{--                                        {{Form::number('amount',null,['class'=>'form-control','required',"min" => 1, "max" => $maxAmount ,"step"=>".01"])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-sm-12">--}}
{{--                                        <label for="description">{{__('Descripción')}}</label>--}}
{{--                                        {{Form::text('description',old('comment'),['class'=>'form-control',' required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-sm-12">--}}
{{--                                        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        {{Form::close()}}--}}
{{--                    @endif--}}
                </div>

                <div class="col-md-8">
                    @include('user.partials.filters')

                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Billetera electrónica')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table id="user-list-table" class="table table-borderless  table-striped" role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr>
                                    <th>{{__('Generado por')}}</th>
                                    <th>{{__('Tipo')}}</th>
                                    <th>{{__('Fecha')}}</th>
                                    <th>{{__('Monto')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($balances))
                                    @php($i=1)
                                    @foreach($balances as $balance)
                                        <tr>
                                            <td>
                                                {{$balance->createdUser->username}}
                                            </td>
                                            <td>
                                                {{__($balance->type)}}
                                                @if($balance->type == 'transfer')
                                                    a {{$balance->transfer?$balance->transfer->toUser->username:''}}
                                                    <p>({{__('Cuota de Transacción')}})</p>
                                                @endif
                                            </td>
                                            <td>{{$balance->created_at}}</td>
                                            <td>
                                                ${{number_format($balance->amount,2)}}
                                                @if($balance->type == 'transfer')
                                                    <p style="color: red">
                                                        $({{number_format($balance->amount * $feeValue / 100,2)}}
                                                        )</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">{{__('Sin registros asociados')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="row justify-content-between mt-3">
                                <div class="col-md-6">
                                    {{$balances->appends(['type'=> $type, 'date'=> $date])}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
            $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
        function validate() {
            var amount_transfer = parseFloat($("#amount_transfer").val());
            var feeValue = $("#feeValue").val();
            var feeReal = parseFloat((amount_transfer * feeValue) / 100);
            var total = amount_transfer + feeReal;
            var balance = parseFloat($("#total_amount").val());

            if (total > balance) {
                swal({
                    title: "{{__('Monto a transferir')}}",
                    text: "{{__('El monto no puede sobrepasar el saldo de su cuenta')}}",
                    icon: "warning",
                })

                return false;
            }
            return true;
        }

    </script>
@endsection
