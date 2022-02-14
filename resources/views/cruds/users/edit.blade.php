@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap4.css') }}"/>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('partials.errors_toast')
            <div class="row">
                <div class="col-sm-5">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <ul class="nav nav-tabs justify-content-end" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab"
                                       aria-controls="home" aria-selected="true">{{__("Datos básicos")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                       aria-controls="profile" aria-selected="false">{{__("Editar")}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="user" role="tabpanel"
                                     aria-labelledby="user-tab">
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
                                                    <tr>
                                                        <th class="text-right">{{__("Impersonar")}}:</th>
                                                        <td class="text-left">
                                                            <a href="{{route('impersonate', $user->id)}}">
                                                                Ingresar aqui
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row align-items-center justify-content-between">

                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                    <div class="rounded-circle iq-card-icon iq-bg-info mr-3"><i
                                                            class="ri-message-3-line"></i></div>
                                                    <div class="text-left">
                                                        <h4>0</h4>
                                                        <p class="mb-0">{{__('Transferencias')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                                    <div class="rounded-circle iq-card-icon iq-bg-danger mr-3"><i
                                                            class="ri-group-line"></i></div>
                                                    <div class="text-left">
                                                        <h4>{{count($user->referreds())}}</h4>
                                                        <p class="mb-0">{{__('Referidos')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                                    @include('cruds.users._form',['data'=>$user,'roles'=>$roles,'users'=>$users,"cols"=>12])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="iq-card iq-card-block">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Opciones')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body p-0">
                            @include('cruds.users.partials.options')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="iq-card iq-card-block iq-card-height">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('Cambiar contraseña')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    {{Form::open(["route"=>'user.changed.Password'])}}
                                    @csrf
                                    {{Form::hidden('users_id',$user->id)}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                {{Form::text("new_password",null,["class"=>"form-control","placeholder"=>"Ingrese Clave"])}}
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__("Guardar")}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="iq-card iq-card-block iq-card-stretch">
                                <div class="iq-card-body">
                                    <h2 class="mb-0"><span>$</span><span
                                            class="counter">{{number_format($user->balanceTotal(),2)}}</span></h2>
                                    <p class="mb-3">{{__('Saldo actual')}}</p>
                                    {{Form::open(['route'=>'user.add.balance','onsubmit'=>'return confirmPay()'])}}
                                    @csrf
                                    {{Form::hidden('users_id',$user->id)}}
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="amount"
                                               placeholder="{{__('Monto')}}"
                                               step="any"
                                               required>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="submit">{{__('Añadir saldo')}}</button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="iq-card iq-card-block iq-card-height">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('Membresias')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    {{Form::open(["route"=>'user.membership.assign'])}}
                                    @csrf
                                    {{Form::hidden('users_id',$user->id)}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                {{Form::select("memberships_id",$listMemberships,$userMembership?$userMembership->memberships_id:null,["class"=>"custom-select","placeholder"=>"Seleccione..."])}}
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__("Guardar")}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('cruds.users.partials.kyc')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });

        function confirmPay() {
            return confirm("{{__("Se procede a agregar saldo a la cuenta")}}");
        }
    </script>
@endsection
