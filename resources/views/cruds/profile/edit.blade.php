@extends('layouts.master')

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="iq-edit-list">
                                <ul class="iq-edit-profile d-flex nav nav-pills">
                                    <li class="col-md p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                            {{__('Información personal')}}
                                        </a>
                                    </li>
                                    <li class="col-md p-0">
                                        <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                            {{__('Información de contacto')}}
                                        </a>
                                    </li>
                                    <li class="col-md p-0">
                                        <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                            {{__('Cambiar contraseña')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="iq-edit-list-data">
                        <div class="tab-content">
                            @include('cruds.profile.information_personal')
                            @include('cruds.profile.information_contact')
                            @include('cruds.profile.changed_password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
