@extends('layouts.master')
@section('content')
    @include('partials.errors_toast')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">

                        <div class="card-header"><strong>{{__('Estados')}}</strong>
                            <small>{{__('Edición de  estados')}}</small>
                        </div>
                        <div class="card-body">
                            @include('cruds.tickets.status._form',compact('status','data'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
