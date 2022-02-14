<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{__('KYC')}}</h4>
        </div>
    </div>
    <div class="iq-card-body p-0">
        <table class="table table-striped table-borderless">
            <tbody>
            @if(count($typesKyc))
                @foreach($typesKyc as $type)
                    @if($kyc=$type->hasDocument($user->id))
                        @php($document=$type->hasDocument($user->id))
                        <tr>
                            <td>{{$type->name}}</td>
                            <td>
                                @php($path = 'users/' . $user->id . '/kyc/' . $kyc->id . '.' . File::extension($kyc->file))
                                @if(Storage::exists($path))
                                    <a href="{{route('user.kyc.download',[$kyc,1])}}" target="_blank">
                                        <i class="fa fa-file-pdf-o" style="color: green">
                                        </i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-right">
                                @switch($kyc->status)
                                    @case("0")
                                    <a href="{{route('kyc.status.update',[$kyc->id,1])}}">
                                        <i class="fa fa-check-circle-o fa-2x" style="color: #00C853"
                                           aria-hidden="true"></i>
                                    </a>
                                    &nbsp;
                                    &nbsp;
                                    <a href="#" data-toggle="modal"
                                       data-target="#modal-{{$kyc->id}}">
                                        <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"
                                           style="color: #DD2C00"></i>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-{{$kyc->id}}" tabindex="-1" role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{__('Rechazar')}}</h5>
                                                </div>
                                                {{Form::open(['route'=>['kyc.status.reject',$kyc->id]])}}
                                                @csrf
                                                <div class="modal-body">
                                                    {{Form::textarea('comment',isset($kyc->comment)?$kyc->comment:old('comment'),['rows'=>5,'class' => 'form-control','required','placeholder'=>'Motivo del rechazo'])}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{__('Cancelar')}}</button>
                                                    {{-- RECHAZAR --}}
                                                    <button type="submit" class="btn btn-primary">
                                                        {{__('Aceptar')}}
                                                    </button>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case("1")
                                    <span class="badge badge-success">{{$document->status_name}}</span>
                                    @break
                                    @case("2")
                                    <span class="badge badge-warning">{{$document->status_name}}</span>
                                    @break
                                @endswitch
                            </td>
                        </tr>
                    @else
                        {{Form::open(['route'=>'kyc.store','enctype'=>'multipart/form-data'])}}
                        <tr>
                            <td>{{$type->name}}</td>
                            <td>
                                <span class="badge badge-danger">{{__('Sin documento')}}</span>
                            </td>
                            <td>

                            </td>
                        </tr>
                        {{Form::close()}}
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
