@extends('layouts.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Comisiones')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <h3>
                                <span class="counter">{{ number_format(@$widgets->balanceCommissionsPaidSponsor) + number_format(@$widgets->balanceCommissionsPaidUser) }}</span>
                            </h3>
                            <p class="card-text">{{__('Total comisiones pagadas en quick start al referido')}}</p>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Comisiones al que refirio')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <h3>
                                <span class="counter">{{ number_format(@$widgets->balanceCommissionsPaidUser) }}</span>
                            </h3>
                            <p class="card-text">{{__('Total comisiones pagadas en quick start al que refiere')}}</p>
                        </div>
                    </div>
                </div>--}}
                <div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Rentabilidad')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <h3>
                                <span class="counter">{{$widgets->balanceRentability}}</span>
                            </h3>
                            <p class="card-text">{{__('Rentabilidades pagadas en membresias.')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="card iq-mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{__('Membresias')}}</h4>
                            <div class="rounded-circle iq-card-icon iq-bg-success">
                                <span class="counter">{{$widgets->balanceMembershipActives}}</span>
                            </div>
                            <p class="card-text">{{__('Cantidad de membresias activas.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Filtros')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {{ Form::open(['route'=> ['report.balance.filters'] ,'method'=>'POST', "id" => "formFilters", 'name' => "formFilters"]) }}
                            {{ Form::token() }}

                            <div class=" row align-items-center">
                                <div class="form-group col-sm-3">
                                    {{ Form::label('username',__('Usuario:')) }}
                                    {{ Form::text('username',@$filters->username,["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-3">
                                    {{ Form::label('type',__('Tipo:')) }}
                                    {{ Form::select('type',$type,@$filters->type,["class"=>"form-control",'placeholder'=>'Seleccione...']) }}
                                </div>
                                <div class="form-group col-sm-3">
                                    {{ Form::label('dateIn',__('Fecha Inicio:')) }}
                                    {{ Form::date('dateIn',@$filters->dateIn,["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-3">
                                    {{ Form::label('dateEnd',__('Fecha Final:')) }}
                                    {{ Form::date('dateEnd',@$filters->dateEnd,["class"=>"form-control"]) }}
                                </div>
                            </div>
                            {{ Form::submit(__('Buscar'),
                                ['class' => 'btn btn-primary mr-2','id' => 'search']) }}
                            <a class="btn btn-warning mr-2" href="{{route('report.balance.index')}}">{{__('Limpiar')}}</a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Membresias')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered table-striped yajra-datatable">
                                <thead>
                                <tr>
                                    <th>{{__("Usuario")}}</th>
                                    <th>{{__("Tipo")}}</th>
                                    <th>{{__("Monto")}}</th>
                                    <th>{{__("Fecha")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($balances as $balance)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.edit',$balance->users_id)}}">{{$balance->user->name}}</a>
                                        </td>
                                        <td>{{$balance->type}}</td>
                                        <td style="color: {{$balance->amount >= 0 ? 'aquamarine' : 'red'}}">$ {{number_format($balance->amount,2)}}</td>
                                        <td>{{date_format($balance->created_at,'Y-m-d')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if($balances instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                <div class="row justify-content-between mt-3">
                                    <div class="col-md-6">
                                        {{$balances->links()}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
