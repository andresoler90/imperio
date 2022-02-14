@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <div class="iq-team text-center p-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img class="img-fluid mb-3 avatar-120 rounded-circle"
                                             src="{{ asset(isset($user->contactInformation->url_image) ? $user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                                             alt="{{isset($user->contactInformation->name_image) ?$user->contactInformation->name_image : 'user-image'}}">
                                        <h4 class="mb-0">{{$user->fullname}}</h4>
                                        <a href="mailto:{{$user->email}}"
                                           class="d-inline-block w-100">{{$user->email}}</a>
                                        <p class="mt-1">{{isset($user->contactInformation)?$user->contactInformation->address1:""}}</p>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <table class="table table-borderless ">
                                            <tr>
                                                <th class="text-right">{{__("Usuario")}}:</th>
                                                <td class="text-left">{{$user->username}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">{{__("Pais")}}:</th>
                                                <td class="text-left">{{@$user->country->name}}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">{{__("Celular")}}:</th>
                                                <td class="text-left">
                                                    <a href="tel:{{isset($user->contactInformation)?$user->contactInformation->prefix_cellphone.$user->contactInformation->cellphone1:''}}">
                                                        {{isset($user->contactInformation)?$user->contactInformation->prefix_cellphone.$user->contactInformation->cellphone1:''}}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Membresia')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="iq-timeline">
                                <li>
                                    <div class="timeline-dots"></div>
                                    <h6 class="float-left mb-1">{{__('Se registra la membresia')}}</h6>
                                    <small
                                        class="float-right mt-1">{{$userMembership->created_at->diffForHumans()}}</small>
                                    <div class="d-inline-block w-100">
                                        <p>{{__($membership->select_text)}}</p>
                                    </div>
                                </li>

                                @foreach($userMembership->verifications as $verification)
                                    <li>
                                        <div class="timeline-dots border-success"></div>
                                        <h6 class="float-left mb-1">{{__('Solicitud de activación')." - ".$verification->status_name}}</h6>
                                        <small
                                            class="float-right mt-1">{{$verification->created_at->diffForHumans()}}</small>
                                        <div class="d-inline-block w-100">
                                            <span>
                                                <a href="{{route('membership.download',$verification->id)}}"
                                                   class="badge badge-cobalt-blue">
                                                    <i class="fa fa-download"></i>
                                                    {{$verification->support_document}}
                                                </a>
                                            @if($userMembership->verifications->last()->id==$verification->id && $verification->status=='P')
                                                    {{Form::open(['route'=>'membership.confirm'])}}
                                                    @csrf
                                                    {{Form::hidden('membership_verification_id',$verification->id)}}
                                                    {{Form::select('status',['A'=>__('Aprobar'),'R'=>__('Rechazar')],null,['class'=>'custom-select my-3','placeholder'=>'Seleccione...','id'=>'confirm'])}}
                                                    {{Form::textarea('comment',null, ['class'=>'form-control mb-3','rows'=>2,'placeholder'=>'Comentario'])}}

                                                    <div class="row mb-4" id="bonus-section" style="display: none">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">{{__('Bonos')}}</h4>
                                                        @foreach($bonus as $bono)
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="checkbox" checked="{{$bono->required?true:false}}" name="bonus[{{$bono->id}}]" value="{{$bono->id}}">
                                                                    </div>
                                                                    <span class="input-group-text">
                                                                        <label>{{$bono->name}}</label>
                                                                    </span>
                                                                </div>
                                                                {{Form::number("bonus_percentage[$bono->id]",$bono->percentage,['class'=>'form-control','required'])}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                    {{__('Continuar')}}
                                                </button>
                                                    {{Form::close()}}
                                                @endif
                                                @if($verification->comment && $verification->status=='A')
                                                    <h4>{{__('Comentario')}}</h4>
                                                    {{$verification->comment}}
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
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
            $("#confirm").change(function () {
                if (this.value == 'A') {
                    $('#bonus-section').show();
                } else {
                    $('#bonus-section').hide();
                }
            });
        });
    </script>
@endsection
