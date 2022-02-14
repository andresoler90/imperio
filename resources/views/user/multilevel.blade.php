@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>

@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="iq-card">
                        <div class="iq-card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{__('Link público')}}</span>
                                        </div>
                                        <input type="text" class="form-control" readonly
                                               value="{{url('/registration?sponsor='.Auth::user()->username)}}"
                                               aria-describedby="button-addon4" id="link_referred">
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-outline-primary" type="button"
                                                    onclick="copy('link_referred')">
                                                <i class="fa fa-files-o" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{__('Enviar')}}</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Telefono"
                                               id="tlf_whatsapp">
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-outline-primary" type="button"
                                                    onclick="Send('tlf_whatsapp')">
                                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function copy(id) {
                                    /* Get the text field */
                                    var copyText = document.getElementById(id);

                                    /* Select the text field */
                                    copyText.select();
                                    copyText.setSelectionRange(0, 99999); /* For mobile devices */

                                    /* Copy the text inside the text field */
                                    document.execCommand("copy");

                                    /* Alert the copied text */
                                    alert("{{__('Copiado')}}");
                                }

                                function Send(id) {
                                    tlf = $('#' + id).val()
                                    url = "https://wa.me/" + tlf + "?text={{urlencode('Te invito a registrarte en el siguiente link ').url('/registration?sponsor='.Auth::id())}}";
                                    window.open(url, '_blank');
                                }
                            </script>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel.png')}}" alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6 text-left">
                                    <h4 class="mb-0">
                                        {{__('Multinivel')}}
                                        <small class="d-block font-size-16 text-secondary">{{__("Total")}}
                                            {{count($multilevel->underPlain())}}
                                        </small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel-izquierda.png')}}"
                                         alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="mb-0">
                                        {{__('Izquierda')}}
                                        <small class="d-block font-size-16 text-secondary">{{__("Total")}}
                                            {{count($multilevel->totalLeft())}}
                                        </small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 text-center">
                                    <img src="{{asset('assets/images/multilevel/multinivel-derecha.png')}}"
                                         alt="scoter.png"
                                         class="img-fluid dash-tracking-icon">
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="mb-0">
                                        {{__('Derecha')}}
                                        <small class="d-block font-size-16 text-secondary">{{__("Total")}}
                                            {{count($multilevel->totalRight())}}
                                        </small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-12 text-center">
                                    {{--                                    <img src="" alt="scoter.png" class="img-fluid dash-tracking-icon">--}}
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-0">
                                        {{__("Próxima Asignación")}}
                                    </h4>
                                    {{$nextNode->parent->username}} -
                                    @switch($nextNode->position)
                                        @case('I')
                                        {{__("Izquierda")}}
                                        @break
                                        @case('D')
                                        {{__("Derecha")}}
                                        @break
                                    @endswitch
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-body">

                            <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#multilevel"
                                       role="tab"
                                       aria-controls="home" aria-selected="true">{{__('Multinivel')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#referreds" role="tab"
                                       aria-controls="profile" aria-selected="false">{{__('Referidos')}}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent-2">
                                <div class="tab-pane fade show active" id="multilevel" role="tabpanel"
                                     aria-labelledby="multilevel-tab">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="btn-group float-right" role="group">
                                                <a href="{{route('user.multilevel.position','I')}}"
                                                   class="btn btn-outline-primary px-4 btn-sm {{Auth::user()->position_preference=='I'?'active':''}}"> {{__('Izquierda')}}</a>

                                                <a href="{{route('user.multilevel.position','D')}}"
                                                   class="btn btn-outline-primary px-4 btn-sm {{Auth::user()->position_preference=='D'?'active':''}}">{{__('Derecha')}}</a>
                                            </div>
                                            <a href="{{route('user.multilevel.tree')}}"
                                               class="btn btn-sm btn-outline-primary float-right mx-2">
                                                <i class="fa fa-sitemap" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover datatable">
                                        <thead>
                                        <tr style="background-color: #607D8B">
                                            <td style="font-weight: bold">{{__('Nombre')}}</td>
                                            <td style="font-weight: bold">{{__('Padre')}}</td>
                                            <td style="font-weight: bold">{{__('Posicion')}}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($nodes as $node)
                                            <tr>
                                                <td>{{$node->user->username}}</td>
                                                <td>{{$node->parent->user->username}}</td>
                                                <td>{{__($node->positionLabel)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="referreds" role="tabpanel"
                                     aria-labelledby="referreds-tab">
                                    <table class="table table-striped table-hover datatable" style="width: 100%">
                                        <thead>
                                        <tr style="background-color: #607D8B">
                                            <td style="font-weight: bold">{{__('Nombre')}}</td>
                                            <td style="font-weight: bold">{{__('Membresia')}}</td>
{{--                                            <td style="font-weight: bold">{{__('Telefono')}}</td>--}}
                                            <td style="font-weight: bold">{{__('Registro')}}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($referreds as $referred)
                                            <tr>
                                                <td>{{$referred->fullname}}</td>
                                                <td>{{$referred->membership?$referred->membership->membership->name:''}}</td>
{{--                                                <td>{{$referred->userContacInformacion?$referred->userContacInformacion->cellphone1:''}}</td>--}}
                                                <td>{{$referred->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datatable').DataTable();
        });
    </script>
@endsection
