<div class="tab-pane fade" id="idioma" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">{{__('Idioma')}}</h4>
            </div>
        </div>
        <div class="iq-card-body">
            {!! Form::open(['route'=> ['profile.update',$user->id] ,'method'=>'PUT', 'files' => true]) !!}
            {!! Form::token() !!}
            <div class=" row align-items-center">
                <div class="form-group col-sm-12">
                    {!! Form::label('language',__('Idioma:')) !!}
                    {!! Form::select('language',config("options.language"),old('language',isset($user->contactInformation->language) ? $user->contactInformation->language : null ),["class"=>"form-control"]) !!}
                </div>
            </div>

            {!! Form::submit(__('Guardar'),["class" => "btn btn-primary mr-2"]) !!}
            <a class="btn iq-bg-danger" href="{{url('/')}}">{{__('Cancelar')}}</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
