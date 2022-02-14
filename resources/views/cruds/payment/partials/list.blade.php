@if(count($payments))
    {{ Form::open(['route'=> $route ,'method'=>'POST', "id" => "formApprove"]) }}
    {{ Form::token() }}
    {{Form::hidden('approve','approve',['id' => 'approve'])}}
    {{Form::hidden('refuse','refuse',['id' => 'refuse'])}}
    {{Form::hidden('legacy',isset($legacy)?true:null)}}
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" onclick="selectAll()" id="check_padre"></th>
            <th>{{__('Nombre usuario')}}</th>
            <th>{{__('Monto solicitado')}}</th>
            <th>{{__('Comisión')}}</th>
            <th>{{__('Saldo Actual')}}</th>
            <th>{{__('Metodo Pago')}}</th>
            <th>{{__('Tipo pago')}}</th>
            <th>{{__('Direccion billetera')}}</th>
            <th>{{__('Tipo solicitud')}}</th>
            <th>{{__('Fecha solicitud')}}</th>
        </tr>
        </thead>
        <tbody id="detail_results">

        @foreach($payments as $payment)

            @php
                switch ($payment->status) {
                    case 0:
                        $style = "badge badge-pill badge-warning text-white";
                        break;
                    case 1:
                        $style = "badge badge-pill badge-success text-white";
                        break;
                    case 2:
                        $style = "badge badge-pill badge-danger text-white";
                        break;
                    default:
                        $style = "badge badge-pill badge-info text-white";
                }
            @endphp

            <tr>
                <td>
                    <input type="checkbox" id="{{'payment_id_'.$payment->id}}"
                           name="payments[{{$payment->id}}]">
                </td>
                <td> {{ $payment->user->name }} </td>
                <td> $ {{ $payment->amount_remove }} </td>
                <td> $ {{ $payment->remove_commission }} </td>
                <td> $ {{ $payment->balanceTotalById($payment->users_id) }} </td>
                <td> {{ __('Coinbase') }} </td>
                <td> {{ config('options.typePayment.'.$payment->type) }} </td>
                <td> {{ $payment->address_wallet }} </td>
                <td>
                    <div
                        class="{{$style}}">{{ config('options.statusPayment.'.$payment->status) }}</div>
                </td>
                <td> {{ $payment->created_at }} </td>
            </tr>
        @endforeach
        </tbody>
        {{ $payments->links() }}
    </table>

    <div class="row">
        <div class="col-md-12 text-right">
            <input type="button" class="btn btn-outline-success" name="btn-approve" id="btn-approve"
                   onclick="confirmPaymentAdmin(1)" value="{{__('Aprobar')}}">

            <input type="button" class="btn btn-outline-info" name="btn-refuse" id="btn-refuse"
                   onclick="confirmPaymentAdmin(2)" value="{{__('Rechazar')}}">

            {{Form::close()}}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            {{__("Aun no se cuenta con solicitudes de pagos registradas")}}
        </div>
    </div>
@endif
