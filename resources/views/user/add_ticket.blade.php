@extends('layouts.master')
@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 270px;
        }
    </style>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card iq-card-block iq-card-stretch">
                        <div class="iq-card-body">
                            <div class="col-md-12 ">
                                @include('user.partials.ticket_form_registration')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
