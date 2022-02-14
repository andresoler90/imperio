<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">{{__('Filtros')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">

                {{ Form::open(['route'=> ['kyc.search.filters'] ,'method'=>'POST', "id" => "formFilters", 'name' => "formFilters"]) }}
                {{ Form::token() }}

                <div class=" row align-items-center">
                    <div class="form-group col-sm-4">
                        {{ Form::label('username',__('Usuario:')) }}
                        {{ Form::text('username',null,["class"=>"form-control"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('dateIn',__('Fecha Inicio:')) }}
                        {{ Form::date('dateIn',null,["class"=>"form-control"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('dateEnd',__('Fecha Final:')) }}
                        {{ Form::date('dateEnd',null,["class"=>"form-control"]) }}
                    </div>
                </div>

                {{--Al buscar filtros resources\views\cruds\payment\filters.blade.php--}}
                {{ Form::button(__('Buscar'),
                    ['class' => 'btn btn-primary mr-2','id' => 'searchKyc', 'onclick' => 'searchFiltersKyc()']) }}
                <a class="btn btn-warning mr-2" href="{{route('kyc.index')}}">{{__('Limpiar')}}</a>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
