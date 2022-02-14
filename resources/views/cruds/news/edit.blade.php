@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('partials.errors_toast')
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="card-header"><strong>{{__('Noticias')}}</strong> <small>{{__('Editar registro')}}</small>
                        </div>
                        <div class="card-body">
                            {{Form::open(['route'=>['news.update',$news->id],'method' => 'PUT'])}}
                                @include('cruds.news.form')
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
