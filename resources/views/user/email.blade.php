@extends('layouts.master')
@section('styles')
    <link href="{{ asset('assets/select2/css/select2.css') }}" rel='stylesheet'/>
    <link href="{{ asset('assets/select2/css/select2-bootstrap4.css') }}" rel='stylesheet'/>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid relative">
            <div class="row">
                <div class="col-lg-3">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <div class="">
                                <div class="iq-email-list">
                                    <button class="btn btn-primary btn-lg btn-block mb-3 font-size-16 p-3"
                                            data-target="#compose-email-popup" data-toggle="modal">
                                        <i class="ri-send-plane-line mr-2"></i>New Message
                                    </button>
                                    <div class="iq-email-ui nav flex-column nav-pills">
                                        <li class="nav-link active" role="tab" data-toggle="pill" href="#mail-inbox"><a
                                                href="#"><i class="ri-mail-line"></i>Inbox<span
                                                    class="badge badge-primary ml-2">{{$listEmailTo->count()}}</span></a>
                                        </li>
                                        <li class="nav-link" role="tab" data-toggle="pill" href="#mail-sent"><a
                                                href="#"><i class="ri-mail-send-line"></i>Sent Mail</a></li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mail-box-detail">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="">
                                <div class="iq-email-to-list p-3">
                                    <div class="d-flex justify-content-between">
                                        <ul>
                                            <li>
                                                <a href="#" id="navbarDropdown" data-toggle="dropdown">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1"><i
                                                                class="ri-arrow-down-s-line"></i></label>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </li>
                                            <li data-toggle="tooltip" data-placement="top" title="Reload"><a href="#"><i
                                                        class="ri-restart-line"></i></a></li>
                                            <li data-toggle="tooltip" data-placement="top" title="Archive"><a
                                                    href="#"><i class="ri-mail-open-line"></i></a></li>
                                            <li data-toggle="tooltip" data-placement="top" title="Spam"><a href="#"><i
                                                        class="ri-information-line"></i></a></li>
                                            <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i
                                                        class="ri-delete-bin-line"></i></a></li>
                                            <li data-toggle="tooltip" data-placement="top" title="Inbox"><a href="#"><i
                                                        class="ri-mail-unread-line"></i></a></li>
                                            <li data-toggle="tooltip" data-placement="top" title="Zoom"><a href="#"><i
                                                        class="ri-drag-move-2-line"></i></a></li>
                                        </ul>
                                        <div class="iq-email-search d-flex">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                                           aria-describedby="emailHelp" placeholder="Search">
                                                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                                </div>
                                            </form>
                                            <ul>
                                                <li class="mr-3">
                                                    <a class="font-size-14" href="#" id="navbarDropdown"
                                                       data-toggle="dropdown">
                                                        1 - 50 of 505
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="#">20 per page</a>
                                                        <a class="dropdown-item" href="#">50 per page</a>
                                                        <a class="dropdown-item" href="#">100 per page</a>
                                                    </div>
                                                </li>
                                                <li data-toggle="tooltip" data-placement="top" title="Privious"><a
                                                        href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i
                                                            class="ri-arrow-right-s-line"></i></a></li>
                                                <li class="mr-0" data-toggle="tooltip" data-placement="top"
                                                    title="Setting"><a href="#"><i
                                                            class="ri-list-settings-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-email-listbox">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="mail-inbox" role="tabpanel">
                                            @if(count($listEmailTo))
                                                @foreach($listEmailTo as $toListEmail)
                                                <ul class="iq-email-sender-list">
                                                    <li class="iq-unread">
                                                        <div class="d-flex align-self-center">
                                                            <div class="iq-email-sender-info">
                                                                <div class="iq-checkbox-mail">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                               class="custom-control-input"
                                                                               id="mailk">
                                                                        <label class="custom-control-label"
                                                                               for="mailk"></label>
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="ri-star-line iq-star-toggle text-warning"></span>
                                                                <a href="javascript: void(0);"
                                                                   class="iq-email-title">{{$toListEmail->fromUser->full_name}}</a>
                                                            </div>
                                                            <div class="iq-email-content">
                                                                <a href="javascript: void(0);"
                                                                   class="iq-email-subject">{{$toListEmail->subject}}
                                                                    @<span>{{$toListEmail->fromUser->full_name}}</span>
                                                                </a>
                                                                <div class="iq-email-date"
                                                                     style="width: 200px">{{$toListEmail->created_at->format('j F Y h:i A')}}</div>
                                                            </div>
                                                            <ul class="iq-social-media">
                                                                <li><a href="#"><i class="ri-delete-bin-2-line"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="ri-mail-line"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="ri-file-list-2-line"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="ri-time-line"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <div class="email-app-details">
                                                        <div class="iq-card">
                                                            <div class="iq-card-body p-0">
                                                                <div class="">
                                                                    <div class="iq-email-to-list p-3">
                                                                        <div class="d-flex justify-content-between">
                                                                            <ul>
                                                                                <li class="mr-3">
                                                                                    <a href="javascript: void(0);">
                                                                                        <h4 class="m-0"><i
                                                                                                class="ri-arrow-left-line"></i>
                                                                                        </h4>
                                                                                    </a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-mail-open-line"></i></a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-information-line"></i></a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-delete-bin-line"></i></a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-mail-unread-line"></i></a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-folder-transfer-line"></i></a>
                                                                                </li>
                                                                                <li data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Tooltip on top"><a
                                                                                        href="#"><i
                                                                                            class="ri-bookmark-line"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="iq-email-search d-flex">
                                                                                <ul>
                                                                                    <li class="mr-3">
                                                                                        <a class="font-size-14"
                                                                                           href="#">1
                                                                                            of 505</a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-arrow-left-s-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-arrow-right-s-line"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="mt-0">
                                                                    <div class="iq-inbox-subject p-3">
                                                                        <h5 class="mt-0">{{$toListEmail->subject}}</h5>
                                                                        <div class="iq-inbox-subject-info">
                                                                            <div class="iq-subject-info">
                                                                                <img
                                                                                    src={{asset("assets/images/user/user-1.jpg")}} class="img-fluid
                                                                                    rounded-circle" alt="#">
                                                                                <div
                                                                                    class="iq-subject-status align-self-center">
                                                                                    <h6 class="mb-0">{{$toListEmail->fromUser->full_name}}</h6>
                                                                                    <div class="dropdown">
                                                                                        <a class="dropdown-toggle"
                                                                                           href="#"
                                                                                           id="dropdownMenuButton"
                                                                                           data-toggle="dropdown"
                                                                                           aria-haspopup="true"
                                                                                           aria-expanded="false">
                                                                                            to {{$toListEmail->toUser->full_name}}
                                                                                        </a>
                                                                                        <div
                                                                                            class="dropdown-menu font-size-12"
                                                                                            aria-labelledby="dropdownMenuButton">
                                                                                            <table
                                                                                                class="iq-inbox-details">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td>from:</td>
                                                                                                    <td>{{$toListEmail->fromUser->full_name}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>to:</td>
                                                                                                    <td>{{$toListEmail->toUser->full_name}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>date:</td>
                                                                                                    <td>{{$toListEmail->created_at->format('j F Y h:i A')}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>subject:
                                                                                                    </td>
                                                                                                    <td>{{$toListEmail->subject}}</td>
                                                                                                </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <span
                                                                                    class="float-right align-self-center">{{$toListEmail->created_at->format('j F Y h:i A')}}</span>
                                                                            </div>
                                                                            <div class="iq-inbox-body mt-5">
                                                                                <pre>{{$toListEmail->message}}</pre>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            @endforeach
                                            @else
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center">
                                                        {{__("Aun no posee ningún mensaje")}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="mail-sent" role="tabpanel">
                                            @if($listEmailForm)
                                                @foreach($listEmailForm as $fromListEmail)
                                                    <ul class="iq-email-sender-list">
                                                        <li class="iq-unread">
                                                            <div class="d-flex align-self-center">
                                                                <div class="iq-email-sender-info">
                                                                    <div class="iq-checkbox-mail">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                   class="custom-control-input"
                                                                                   id="mailk">
                                                                            <label class="custom-control-label"
                                                                                   for="mailk"></label>
                                                                        </div>
                                                                    </div>
                                                                    <span
                                                                        class="ri-star-line iq-star-toggle text-warning"></span>
                                                                    <a href="javascript: void(0);"
                                                                       class="iq-email-title">{{$fromListEmail->toUser->full_name}}</a>
                                                                </div>
                                                                <div class="iq-email-content">
                                                                    <a href="javascript: void(0);"
                                                                       class="iq-email-subject">{{$fromListEmail->subject}}
                                                                        @<span>{{$fromListEmail->toUser->full_name}}</span>
                                                                    </a>
                                                                    <div class="iq-email-date"
                                                                         style="width: 200px">{{$fromListEmail->created_at->format('j \\of F Y h:i A')}}</div>
                                                                </div>
                                                                <ul class="iq-social-media">
                                                                    <li><a href="#"><i class="ri-delete-bin-2-line"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="ri-mail-line"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="ri-file-list-2-line"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="ri-time-line"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <div class="email-app-details">
                                                            <div class="iq-card">
                                                                <div class="iq-card-body p-0">
                                                                    <div class="">
                                                                        <div class="iq-email-to-list p-3">
                                                                            <div class="d-flex justify-content-between">
                                                                                <ul>
                                                                                    <li class="mr-3">
                                                                                        <a href="javascript: void(0);">
                                                                                            <h4 class="m-0"><i
                                                                                                    class="ri-arrow-left-line"></i>
                                                                                            </h4>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-mail-open-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-information-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-delete-bin-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-mail-unread-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-folder-transfer-line"></i></a>
                                                                                    </li>
                                                                                    <li data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Tooltip on top"><a
                                                                                            href="#"><i
                                                                                                class="ri-bookmark-line"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                                <div class="iq-email-search d-flex">
                                                                                    <ul>
                                                                                        <li class="mr-3">
                                                                                            <a class="font-size-14"
                                                                                               href="#">1
                                                                                                of 505</a>
                                                                                        </li>
                                                                                        <li data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Tooltip on top"><a
                                                                                                href="#"><i
                                                                                                    class="ri-arrow-left-s-line"></i></a>
                                                                                        </li>
                                                                                        <li data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Tooltip on top"><a
                                                                                                href="#"><i
                                                                                                    class="ri-arrow-right-s-line"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr class="mt-0">
                                                                        <div class="iq-inbox-subject p-3">
                                                                            <h5 class="mt-0">{{$fromListEmail->subject}}</h5>
                                                                            <div class="iq-inbox-subject-info">
                                                                                <div class="iq-subject-info">
                                                                                    <img
                                                                                        src={{asset("assets/images/user/user-1.jpg")}} class="img-fluid
                                                                                        rounded-circle" alt="#">
                                                                                    <div
                                                                                        class="iq-subject-status align-self-center">
                                                                                        <h6 class="mb-0">{{$fromListEmail->fromUser->full_name}}</h6>
                                                                                        <div class="dropdown">
                                                                                            <a class="dropdown-toggle"
                                                                                               href="#"
                                                                                               id="dropdownMenuButton"
                                                                                               data-toggle="dropdown"
                                                                                               aria-haspopup="true"
                                                                                               aria-expanded="false">
                                                                                                to {{$fromListEmail->toUser->full_name}}
                                                                                            </a>
                                                                                            <div
                                                                                                class="dropdown-menu font-size-12"
                                                                                                aria-labelledby="dropdownMenuButton">
                                                                                                <table
                                                                                                    class="iq-inbox-details">
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <td>from:</td>
                                                                                                        <td>{{$fromListEmail->fromUser->full_name}}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>to:</td>
                                                                                                        <td>{{$fromListEmail->toUser->full_name}}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>date:</td>
                                                                                                        <td>{{$fromListEmail->created_at->format('j F Y h:i A')}}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>subject:
                                                                                                        </td>
                                                                                                        <td>{{$fromListEmail->subject}}</td>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span
                                                                                        class="float-right align-self-center">{{$fromListEmail->created_at->format('j F Y h:i A')}}</span>
                                                                                </div>
                                                                                <div class="iq-inbox-body mt-5">
                                                                                    <pre>{{$fromListEmail->message}}</pre>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                @endforeach
                                            @else
                                                <div class="iq-card">
                                                    <div class="iq-card-body text-center">
                                                        {{__("Aun no posee ningún mensaje")}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="compose-email-popup" class="compose-popup modal modal-sticky-bottom-right modal-sticky-lg">
                    <div class="iq-card iq-border-radius-20 mb-0">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-md-12 mb-3">
                                    <h5 class="text-primary float-left"><i class="ri-pencil-fill"></i> Compose Message
                                    </h5>
                                    <button type="submit" class="float-right close-popup" data-dismiss="modal"><i
                                            class="ri-close-fill"></i></button>
                                </div>
                            </div>
                            {{Form::open(['route'=>['send.email'], 'class' => 'email-form', 'method'=>'POST'])}}
                            <div class="form-group row">
                                <label for="users_id" class="col-sm-2 col-md-2 col-form-label">To:</label>
                                <div class="col-md-10">
                                    {{Form::select('users_id',$users,isset($data->users_id)?$data->users_id:old('users_id'),['class'=>'custom-select select2','style'=>'width: 100%'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                                <div class="col-sm-10">
                                    {{Form::text('subject',isset($data->subject)?$data->subject:old(''),['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-sm-2 col-form-label">Your Message:</label>
                                <div class="col-md-10">
                                    {{Form::textarea('message',isset($data->subject)?$data->subject:old(''),['placeholder'=>'Next, use our Get Started docs to setup Tiny!', 'class'=>'textarea form-control form-control', 'rows' => '5'])}}
                                </div>
                            </div>
                            <div class="form-group row align-items-center compose-bottom pt-3 m-0">
                                <div class="d-flex flex-grow-1 align-items-center">
                                    <div class="send-btn">
                                        <button class="btn btn-primary" type="submit">{{__('Send')}}</button>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="send-panel float-right">
                                        <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="javascript:void();"><i
                                                    class="ri-settings-2-line text-primary"></i></a></label>
                                        <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="javascript:void();"> <i
                                                    class="ri-delete-bin-line text-primary"></i></a> </label>
                                    </div>
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
@section('scripts')
    <script type="text/javascript">
        $('.select2').select2({
            theme: 'bootstrap4',
            width: 'resolve' // need to override the changed default
        });
    </script>
@endsection
