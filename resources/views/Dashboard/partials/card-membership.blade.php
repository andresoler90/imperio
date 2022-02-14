@if($membership)
    <div class="col">
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{$membership->membership->name}}</h4>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            {{__('Solicitar activación')}}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Solicitar activacion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                                @if(count(Auth::user()->userMembership->hasPendingVerification()))
                                                    <div class="col-md-12 p-0">
                                                        <table class="table table-borderless table-sm table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('Documento')}}</th>
                                                                <th>{{__('Estado')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach(Auth::user()->userMembership->verifications as $verification)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <a href="{{route('membership.download',$verification->id)}}"
                                                                           class="badge badge-cobalt-blue">
                                                                            <i class="fa fa-download"></i>
                                                                            {{$verification->support_document}}
                                                                        </a>
                                                                    </td>
                                                                    <td>{!! $verification->status_badge !!}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                    </div>
                                                @else
                                                    {{Form::open(["route"=>'user.load.verification',"enctype"=>"multipart/form-data"])}}
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="support_document"
                                                                   name="support_document" lang="es">
                                                            <label class="custom-file-label" for="customFileLang">
                                                                Seleccionar Archivo
                                                            </label>
                                                        </div>
                                                        {{Form::submit('Cargar',['class'=>'btn btn-primary mt-1'])}}
                                                    </div>
                                                    {{Form::close()}}
                                                @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
