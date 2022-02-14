@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('partials.errors_toast')
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch ">
                        <div class="iq-card-body">
                            <div class="d-flex align-items-center">
                                @if($userProduct)
                                    <div class="rounded-circle iq-card-icon">
                                        <img src="{{asset('storage/products/'.$userProduct->product->image)}}"
                                             class="img-fluid" alt="logo">
                                    </div>
                                    <div class="text-left ml-3">
                                        <h6>Nombre del paquete</h6>
                                        <h3>{{$userProduct->product->name}}</h3>
                                        <p class="mb-0">Cantidad de clicks {{$userProduct->product->clicks}}</p>
                                    </div>
                                @else
                                    <div class="col-md-12 text-center">
                                        {{__('Adquiera un producto ')}}<a href="#">{{__('Aquí')}}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($userProduct)
                        <div class="iq-card iq-card-block iq-card-stretch ">
                            <div class="iq-card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span
                                            class="text-success float-right">Requeridos {{$userProduct->product->clicks}}</span>
                                        <span class="font-size-14">Clicks realizados</span>
                                        <h3>{{$taskPerfomanceByDay=count(Auth::user()->taskPerfomanceByDay())}}</h3>
                                        <div class="iq-progress-bar-linear d-inline-block w-100 float-left mt-3">
                                            <div class="iq-progress-bar">

                                                @php
                                                    $advance=($taskPerfomanceByDay*100)/$userProduct->product->clicks;
                                                @endphp
                                                <span class="bg-primary" data-percent="{{$advance}}"
                                                      style="transition: width 2s ease 0s; width: {{$advance}}%;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-8">
                    <div class="iq-card">
                        <div class="iq-card-body">

                            <ul class="nav nav-tabs justify-content-end" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#task-tab-daily" role="tab" aria-controls="home" aria-selected="true">
                                        {{__('Tareas diarias')}} <span class="badge badge-light ml-2">{{count($tasks)}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#task-tab-history" role="tab" aria-controls="profile" aria-selected="false">
                                        {{__('Historico')}} <span class="badge badge-light ml-2">{{count($taskHistory)}}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="task-tab-daily" role="tabpanel" aria-labelledby="home-tab-justify">
                                    @if($userProduct)
                                        @foreach($tasks as $task)
                                            <div class="media-support mb-3">
                                                <div class="media-support-header mb-2">
                                                    <div class="media-support-user-img mr-3">
                                                        <img class="rounded-circle" src="{{asset('img/img1.png')}}" alt="">
                                                    </div>
                                                    <div class="media-support-info mt-2">
                                                        <h6 class="mb-0">{{$task->description}}</h6>

                                                        <small>{{__('Vence en ')}}{{$available_time->diff(date('Y-m-d 00:00:00',strtotime(date('Y-m-d').' + 1day')))->format('%h:%I:%S')." Horas"}}</small>
                                                    </div>
                                                    <div class="mt-3">
                                                        @include('user.partials._link_scripts',['link'=>$task->link,"id"=>$task->id])
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 text-center">
                                            {{__('Debe contar con un producto para poder visualizar las tareas disponibles')}}
                                        </div>
                                    @endif                            </div>
                                <div class="tab-pane fade" id="task-tab-history" role="tabpanel" aria-labelledby="profile-tab-justify">
                                    <table id="user-list-table" class="table table-borderless  table-striped" role="grid"
                                           aria-describedby="user-list-page-info">
                                        <thead>
                                        <tr>
                                            <th class="col-md-10">{{__('Descripción')}}</th>
                                            <th class="col-md-2">{{__('Fecha')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($taskHistory))
                                            @php($i=1)
                                            @foreach($taskHistory as $history)
                                                <tr>
                                                    <td style="font-size: 12px; !important;">{{$history->task->description}}</td>
                                                    <td style="font-size: 12px; !important;">{{$history->task->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">{{__('Sin registros asociados')}}</td>
                                            </tr>
                                        @endif
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
    <script>
        var btn = document.getElementById("goPay");
        btn.onclick = function () {
            var win = window.open(
                "http://www.stackoverflow.com",
                "Secure Payment");
            var timer = setInterval(function () {
                if (win.closed) {
                    clearInterval(timer);
                    paid();
                    alert("'Secure Payment' window closed !");
                }
            }, 500);
        }

        var div = document.getElementById("info");

        function paid() {
            info.innerHTML = "Seems like you have completed payment !<br />Let me check the DB...";
        }
    </script>
@endsection
