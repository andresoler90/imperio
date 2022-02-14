@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Listado de estados')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <ul class="nav nav-pills">

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('status.create')}}">{{__('Crear')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Nombre')}}</th>
                                    <th colspan="3">{{__('Opciones')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($status))
                                    @php($i=1)
                                    @foreach($status as $state)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$state->status_name}}</td>
                                            <td>
                                                <a href="{{route('status.edit',$state->id)}}"
                                                   class="btn btn-sm btn-ghost-dark">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('status.destroy',$state->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                            class="btn btn-primary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{$state->active?'Activo':'Inactivo'}}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        {{-- APROBAR --}}
                                                        <a class="dropdown-item" href="{{route('status.active',[$state->id,1])}}">Activo</a>
                                                        <a class="dropdown-item" href="{{route('status.active',[$state->id,0])}}">Inactivo</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">{{__('Sin registros asociados')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="row justify-content-between mt-3">
                                <div class="col-md-6">
                                    {{$status->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
