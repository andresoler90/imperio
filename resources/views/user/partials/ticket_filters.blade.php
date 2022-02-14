<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">{{__('Filtros')}}</h4>
                </div>
            </div>
            <div class="iq-card-body">

                {{ Form::open(['route'=> ['user.search.ticket'] ,'method'=>'GET']) }}
                {{ Form::token() }}

                <div class=" row align-items-center">
                    <div class="form-group col-sm-4">
                        {{ Form::label('code',__('Codigo:')) }}
                        {{ Form::text('code',null,["class"=>"form-control"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('user',__('User:')) }}
                        {{ Form::text('user',null,["class"=>"form-control"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('category',__('Categoria:')) }}
                        {{Form::select('category_id',$categories,null,['class'=>'custom-select','id'=>'category_id','placeholder'=>'Seleccione...'])}}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('priority',__('Prioridad:')) }}
                        {{Form::select('priority_id',$priorities,null,['class'=>'custom-select','id'=>'category_id','placeholder'=>'Seleccione...'])}}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('date_ini',__('Fecha Inicial:')) }}
                        {{ Form::date('date_ini',null,["class"=>"form-control"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('date_end',__('Fecha Final:')) }}
                        {{ Form::date('date_end',null,["class"=>"form-control"]) }}
                    </div>
                </div>

                <button class="btn btn-primary mr-2" type="submit">{{__('Buscar')}}</button>
                <a class="btn btn-warning mr-2" href="{{route('user.ticket')}}">{{__('Limpiar')}}</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

