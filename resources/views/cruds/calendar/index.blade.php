@extends('layouts.master')
@section('styles')
    @parent
    <link href="{{ asset('css/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel='stylesheet'/>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Nuevo evento')}}</h4>
                            </div>
                        </div>
                        {{Form::open(['route'=>'crud.calendar.add.event'])}}
                        @csrf
                        <div class="iq-card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="title">{{__('Titulo')}}</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="start_time">{{__('Inicio')}}</label>
                                    <input type="text" class="form-control" id="start_time" name="start_time" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_time">{{__('Fin')}}</label>
                                    <input type="text" class="form-control" id="end_time" name="end_time" readonly required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="description">{{__('Descripción')}}</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" required>
                                </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="link">{{__('Link')}}</label>
                                    <input type="url" class="form-control" name="link">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            @include('user.partials.calendar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}"></script>

    <script type="text/javascript">
        $('#start_time').datetimepicker('setStartDate', '{{date('Y-m-d')}}');
        $('#end_time').datetimepicker('setStartDate', '{{date('Y-m-d')}}');
    </script>
@endsection
