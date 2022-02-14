@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('KYC')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th width="15%">{{__('Descripción')}}</th>
                                    <th width="40%">{{__('Comentario')}}</th>
                                    <th width="15%">{{__('Estado')}}</th>
                                    <th width="20%">{{__('Documento')}}</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($types))
                                    @foreach($types as $type)
                                        @if($type->hasDocument())
                                            @php($document=$type->hasDocument())
                                            @if($document->status == 2)
                                                {{Form::open(['route'=>'user.kyc.store','enctype'=>'multipart/form-data'])}}
                                                <tr>
                                                    <td>{{$type->name}}</td>
                                                    <td>{{$document->comment}}</td>
                                                    <td>
                                                        <span class="badge badge-danger">{{$document->status_name}}</span>
                                                    </td>
                                                    <td>
                                                        {{Form::hidden('kyc_types_id',$type->id)}}
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" id="file" name="file"
                                                                   type="file"
                                                                   accept="application/pdf,image/jpeg,image/png,image/jpg">
                                                            <label class="custom-file-label"
                                                                   for="file">{{__('Seleccione...')}}</label>
                                                        </div>
                                                    </td>
                                                    <td>{{Form::submit(__('Cargar'),['class'=>'btn btn-outline-dark'])}}</td>
                                                </tr>
                                                {{Form::close()}}
                                            @else
                                                <tr>
                                                    <td>  {{__($type->name)}} </td>
                                                    <td>{{$document->comment}}</td>
                                                    <td>
                                                        <span class="badge badge-cyan"> {{__( $document->status_name)}} </span>

                                                    </td>
                                                    <td>
                                                        <a class="badge badge-cobalt-blue" href="{{route('user.kyc.download',[$document->id,1])}}" target="blank">
                                                            {{$document->file}}
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @else
                                            {{Form::open(['route'=>'user.kyc.store','enctype'=>'multipart/form-data'])}}
                                            <tr>
                                                <td>{{$type->name}}</td>
                                                <td></td>
                                                <td>
                                                    <span class="badge badge-amber">{{__('Sin documento')}}</span>
                                                </td>
                                                <td>
                                                    {{Form::hidden('kyc_types_id',$type->id)}}
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="file" name="file"
                                                               type="file"
                                                               accept="application/pdf,image/jpeg,image/png,image/jpg">
                                                        <label class="custom-file-label"
                                                               for="file">{{__('Seleccione...')}}</label>
                                                    </div>
                                                </td>
                                                <td>{{Form::submit(__('Cargar'),['class'=>'btn btn-outline-dark'])}}</td>
                                            </tr>
                                            {{Form::close()}}
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.custom-file-input').on('change', function () {
            var fileName = $(this).val();
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            $(this).next('.custom-file-label').html(cleanFileName);
        })
    </script>
@endsection
