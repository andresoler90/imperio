@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            {{Form::open(['route'=>'roi.execute'])}}
                            <div class="row">
                                @foreach($memberships as $membership)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{$membership->name}}</label>
                                            <input name="membership[{{$membership->id}}]" class="form-control"
                                                   type="number" step="0.1" , min="0" max="100" value="0" required>

                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    {{Form::submit('Ejecutar',['class'=>'btn btn-primary float-right'])}}
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
