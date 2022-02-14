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
                            <h2 class="mb-0"><span>$</span>
                                <span
                                    class="counter">{{number_format($saldo,2)}}
                                </span>
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
                </div>

                <div class="col-md-8">
                    @include('user.partials.filters_roi')

                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Balances Roi')}}</h4>
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
