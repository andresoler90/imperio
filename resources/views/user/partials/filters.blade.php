<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">{{__('Filtros')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">

                {!! Form::open(['route'=> ['user.wallet'] ,'method'=>'GET']) !!}
                {!! Form::token() !!}

                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        {!! Form::label('name',__('Tipo:')) !!}
                        {!! Form::text('type',null,["class"=>"form-control"]) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('date',__('Fecha:')) !!}
                        {!! Form::date('date',null,["class"=>"form-control"]) !!}
                    </div>
                </div>

                <button class="btn btn-primary mr-2" type="submit">{{__('Buscar')}}</button>
                <a class="btn btn-warning mr-2" href="{{route('user.wallet')}}">{{__('Limpiar')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

