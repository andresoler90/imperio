@extends('layouts.master')

@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 230px;
        }
    </style>
@endsection

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Detalle del ticket')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.ticket.create')}}">{{__('')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr class="border-bottom-1">
                                    <th class="">#</th>
                                    <th>{{__('Ticket ID')}}</th>
                                    <th>{{__('Asunto')}}</th>
                                    <th>{{__('Categoaria')}}</th>
                                    <th>{{__('Prioridad')}}</th>
                                    <th>{{__('Usuario de Creación')}}</th>
                                    <th>{{__('Creado en')}}</th>
                                    <th>{{__('Ultima actualización')}}</th>
                                    <th>{{__('Adjunto')}}</th>
                                    @if(Auth::user()->role->id == 1)
                                    <th>{{__('Estado')}}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td>{{($ticket->code)}} </td>
                                        <th>{{$ticket->subject}} </th>
                                        <td>{{$ticket->category->category_name}} </td>
                                        <td>{{$ticket->priority->priority_name}} </td>
                                        <td>{{$ticket->user->name}} </td>
                                        <td>{{$ticket->created_at}} </td>
                                        <td>{{\Carbon\Carbon::parse($ticket->updated_at)->diffForHumans()}} </td>
                                        <th>
                                            @if($ticket->file_path)
                                            <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download',[$ticket->id,1])}}" target="blank">
                                                {{$ticket->file_path}}
                                                &nbsp;
                                                <i class="fa fa-download"></i>
                                            </a>
                                            @endif
                                        </th>
                                        @if(Auth::user()->role->id == 1)
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                            class="btn btn-primary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{$ticket->status->status_name}}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        {{-- APROBAR --}}
                                                        @foreach($statuses as $status)
                                                            <a class="dropdown-item" href="{{route('tickets.status.update',[$ticket->id, $status->id])}}">{{($status->status_name)}}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="iq-card {{$ticket->status->id==2?'d-none':''}}">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Respuestas')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.ticket.create')}}">{{__('')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            @php($route = Auth::user() ? 'user.ticket.reponse' : 'register')

                            <form method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <input class="custom-file-input mb-0 @error('subject') is-invalid @enderror" name="file" id="file" name="file" type="file"
                                               accept="application/gif,image/jpeg,image/png,image/jpg,image/JPG"
                                               value="{{isset($data->file)?$data->file:old('file')}}">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                        @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="comment">{{__('Mensaje')}}</label>
                                        <textarea id="comment" type="text"
                                                  class="form-control mb-0 @error('comment') is-invalid @enderror" name="comment"
                                                  value="{{ old('comment') }}" required autocomplete="name" autofocus>
                                        </textarea>
                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-inline-block w-100">
                                    <button type="submit" class="btn btn-primary float-right">{{__('Guardar')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Mensajes')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.ticket.create')}}">{{__('')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            @if($ticket->users_id == Auth::user()->id)
                                <div class="alert alert-secondary offset-4 col-md-8 justify-content-end text-right" role="alert" style="display: block !important;">

                                    <div class="row">
                                        <div class="col-10">
                                            {{$ticket->user->name}}<br>
                                            {{$ticket->created_at}}<br>
                                            {!! $ticket->message !!}<br>
                                            @if($ticket->file_path)
                                                <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download',[$ticket->id,1])}}" target="blank">
                                                    {{$ticket->file_path}}
                                                    &nbsp;
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-2">
                                            <img class="profile-pic"
                                                 src="{{ asset(isset($ticket->user->contactInformation->url_image) ? $ticket->user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                                                 alt="{{isset($ticket->user->contactInformation->name_image) ?$ticket->user->contactInformation->name_image : 'user-image'}}">
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="alert alert-primary col-md-8 justify-content-start" role="alert" style="display: block !important;">
                                    <div class="row">
                                        <div class="col-2">
                                            <img class="profile-pic"
                                                 src="{{ asset(isset($ticket->user->contactInformation->url_image) ? $ticket->user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                                                 alt="{{isset($ticket->user->contactInformation->name_image) ?$ticket->user->contactInformation->name_image : 'user-image'}}">
                                        </div>
                                        <div class="col-10">
                                            {{$ticket->user->name}}<br>
                                            {{$ticket->created_at}}<br>
                                            {!! $ticket->message !!}<br>
                                            @if($ticket->file_path)
                                                <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download',[$ticket->id,1])}}" target="blank">
                                                    {{$ticket->file_path}}
                                                    &nbsp;
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @foreach($responses as $response)
                                @if($response->users_id == Auth::user()->id)
                                    <div class="alert alert-secondary offset-4 col-md-8 justify-content-end text-right" role="alert" style="display: block !important;">

                                        <div class="row">
                                            <div class="col-10">
                                                {{$response->user->name}}<br>
                                                {{$response->created_at}}<br>
                                                {!! $response->comment !!}<br>
                                                @if($response->file)
                                                <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download.response',[$response->id,1])}}" target="blank">
                                                    {{$response->file}}
                                                    &nbsp;
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @endif
                                            </div>
                                            <div class="col-2">
                                                <img class="profile-pic"
                                                     src="{{ asset(isset($response->user->contactInformation->url_image) ? $response->user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                                                     alt="{{isset($response->user->contactInformation->name_image) ?$response->user->contactInformation->name_image : 'user-image'}}">
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="alert alert-primary col-md-8 justify-content-start" role="alert" style="display: block !important;">
                                        <div class="row">
                                            <div class="col-2">
                                                <img class="profile-pic"
                                                     src="{{ asset(isset($response->user->contactInformation->url_image) ? $response->user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                                                     alt="{{isset($response->user->contactInformation->name_image) ?$response->user->contactInformation->name_image : 'user-image'}}">
                                            </div>
                                            <div class="col-10">
                                                {{$response->user->name}}<br>
                                                {{$response->created_at}}<br>
                                                {!! $response->comment !!}<br>
                                                @if($response->file)
                                                    <a class="badge badge-cobalt-blue" href="{{route('user.ticket.download.response',[$response->id,1])}}" target="blank">
                                                        {{$response->file}}
                                                        &nbsp;
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
        });

        ClassicEditor
            .create( document.querySelector( '#comment' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'insertTable', 'undo', 'redo'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
            })
            .catch( error => {
                console.error( error );
            });
    </script>
@endsection
