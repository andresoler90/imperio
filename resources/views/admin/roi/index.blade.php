@extends('layouts.master')

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Historico')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('roi.new')}}">{{__('Nuevo')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4"
                                   role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr id="tab">
                                    <th>#</th>
                                    <th>{{__('Fecha')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($logRoi))
                                    @php($i=1)
                                    @foreach($logRoi as $roi)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$roi->created_at}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">{{__('Sin registros asociados')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{$logRoi->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
