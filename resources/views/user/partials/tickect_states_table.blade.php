<div class="row align-items-center">
    <div class="col-sm-12">

        <table class="table table-hover table-bordered">
            <thead>
            <tr class="border-bottom-1">
                <th class="">#</th>
                <th>{{__('Asunto')}}</th>
                <th>{{__('Adjunto')}}</th>
                <th>{{__('Estado')}}</th>
                <th>{{__('Categoaria')}}</th>
                <th>{{__('Prioridad')}}</th>
                <th>{{__('Usuario de Creación')}}</th>
                <th>{{__('Creado en')}}</th>
                <th>{{__('Ultima actualización')}}</th>
                <th>{{__('Detalles')}}</th>
            </tr>
            </thead>
            <tbody>

            @if(count($tickets))
                @foreach($tickets as $data)
                    <tr>
                        <td>{{$data->code}} </td>
                        <th>{{$data->subject}} </th>
                        <th>
                            @if($data->file_path)
                                <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download',[$data->id,1])}}" target="blank">
                                    {{$data->file_path}}
                                    &nbsp;
                                    <i class="fa fa-download"></i>
                                </a>
                            @endif
                        </th>
                        <td>{{$data->status->status_name}} </td>
                        <td>{{$data->category->category_name}} </td>
                        <td>{{$data->priority->priority_name}} </td>
                        <td>{{$data->user->username}} </td>
                        <td>{{$data->created_at}} </td>
                        <td>{{\Carbon\Carbon::parse($data->updated_at)->diffForHumans()}} </td>
                        <td>
                            <a href="{{route('user.ticket.detail', $data->id)}}" class="btn pull-right">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center">{{__("Sin datos")}}</td>
                </tr>
            @endif
            </tbody>
            {{ $tickets->links() }}
        </table>
    </div>
</div>


