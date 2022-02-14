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
            <input type="checkbox" id="{{'payment_id_'.$payment->id}}" name="payments[{{$payment->id}}]">
        </td>
        <td> {{ $payment->name }} </td>
        <td> $ {{ $payment->amount_remove }} </td>
        <td> $ {{ $payment->balanceTotalById($payment->users_id) }} </td>
        <td> {{ __('Coinbase') }} </td>
        <td> {{ config('options.typePayment.'.$payment->type) }} </td>
        <td> {{ $payment->address_wallet }} </td>
        <td>
            <div class="{{$style}}">{{ config('options.statusPayment.'.$payment->status) }}</div>
        </td>
        <td> {{ $payment->created_at }} </td>

    </tr>
@endforeach

