<div class="row align-items-center">
    <div class="col-sm-12">

        <table class="table table-hover table-bordered">
            <thead>
            <tr class="border-bottom-1">
                <th class="">#</th>
                <th>{{__('Monto solicitado')}}</th>
                <th>{{__('Comisión por retiro')}}</th>
                <th>{{__('Tipo')}}</th>
                <th>{{__('Direccion de billetera')}}</th>
                <th>{{__('Fecha solicitud')}}</th>
                <th>{{__('Estado')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(count($payments))
            @php($cont = 0)
            @foreach($payments as $data)
                @php($cont++)
                <tr>
                    <td> {{$cont}} </td>
                    <td> $ {{$data->amount_remove}} </td>
                    <td> $ {{$data->remove_commission}} </td>
                    <td> {{config('options.typePayment.'.$data->type)}} </td>
                    <td> {{$data->address_wallet}} </td>
                    <td> {{$data->created_at}} </td>
                    <td>
                        {{config('options.statusPayment.'.$data->status)}}
                        @if($data->status == 0)
                            {!! Form::open(['route'=> ['payment.destroy',$data->id] ,'method'=>'DELETE','id' => 'formDelete']) !!}
                            {{ csrf_field() }}
                            <a class="btn btn-danger pull-right" name="deletePayment" onclick="confirmDelete()">
                                <i class="fa fa-trash"></i>
                            </a>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">{{__("Sin datos")}}</td>
                </tr>
            @endif
            </tbody>
            {{ $payments->links() }}
        </table>
    </div>
</div>


