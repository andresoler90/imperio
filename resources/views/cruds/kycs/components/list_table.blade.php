<table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
       aria-describedby="user-list-page-info">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('Usuario')}}</th>
        <th>{{__('Tipo')}}</th>
        <th>{{__('Aprobado por')}}</th>
        <th>{{__('Comentario')}}</th>
        <th>{{__('Documento')}}</th>
        <th>{{__('Estado')}}</th>
        <th colspan="1">{{__('Opciones')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($kycs))
        @php($i=1)
        @foreach($kycs as $kyc)
            @php($path = 'users/' . $kyc->users_id . '/kyc/' . $kyc->id . '.' . File::extension($kyc->file))
            <tr>
                <td>{{$i++}}</td>
                <td><a href="{{route('user.edit',$kyc->users_id)}}"> {{$kyc->user->username}} - {{$kyc->user->name}} {{$kyc->user->lastname}} </a></td>
                <td>{{$kyc->kyc_type->name}}</td>
                <td>{{$kyc->approved?$kyc->approved->name:''}}</td>
                <td>{{$kyc->comment}}</td>
                <td style="text-align: center">
                    @if(Storage::exists($path))
                        <a href="{{route('user.kyc.download',[$kyc,1])}}" target="_blank">
                            <i class="fa fa-file-pdf-o" style="color: green">
                            </i>
                        </a>
                    @endif
                </td>
                <td>
                    @if(isset($kyc) && $kyc->status==0)
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="btnGroupDrop1" type="button"
                                    class="btn btn-primary btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                {{__('Aprobación')}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                {{-- APROBAR --}}
                                <a class="dropdown-item" href="#" onclick="postApprovedState('{{$kyc->id}}',1)">{{__('Aprobar')}}</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">{{__('Rechazar')}}</a>
                            </div>
                        </div>

                    <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{__('Rechazar')}}</h5>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::label('comment',__('Comentario:'),['class' => 'form-group']) !!}
                                        {!! Form::text('comment',isset($kyc->comment)?$kyc->comment:old('comment'),['class' => 'form-control','required']) !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancelar')}}</button>
                                        {{-- RECHAZAR --}}
                                        <button type="button" onclick="postApprovedState('{{$kyc->id}}',2)" class="btn btn-primary">
                                            {{__('Aceptar')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @switch($kyc->status)
                            @case(0)
                            <span
                                class="badge badge-warning">{{__($kyc->status_name)}}</span>
                            @break
                            @case(1)
                            <span
                                class="badge badge-success">{{__($kyc->status_name)}}</span>
                            @break
                            @case(2)
                            <span
                                class="badge badge-danger">{{__($kyc->status_name)}}</span>
                            @break
                        @endswitch
                    @endif
                </td>
                <td>
                    <form action="{{route('kyc.destroy',$kyc->id)}}" method="POST" id="formDeleteKyc">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-sm" onclick="confirmDeleteKyc()">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </form>
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

