<div class="tab-pane fade" id="manage-contact" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">{{__('Información de contacto')}}</h4>
            </div>
        </div>
        <div class="iq-card-body">

            {{ Form::open(['route'=> ['profile.update',$user->id] ,'method'=>'PUT', 'files' => true]) }}
            {{ Form::token() }}

            <div class=" row align-items-center">
                <div class="form-group col-sm-6">
                    {{ Form::label('address1',__('Dirección linea 1:')) }}
                    {{ Form::textarea('address1',old('address1',isset($user->contactInformation->address1) ? $user->contactInformation->address1 : null),["class"=>"form-control", "rows" => 1]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('address2',__('Dirección linea 2:')) }}
                    {{ Form::textarea('address2',old('address2',isset($user->contactInformation->address2) ? $user->contactInformation->address2 : null),["class"=>"form-control" , "rows" => 1]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('countries_id',__('País:')) }}
                    {{ Form::select('countries_id',$countries,old('countries_id',@$user->country->id),['class'=>'form-control', 'placeholder' => 'Seleccione']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('city',__('Ciudad:')) }}
                    {{ Form::text('city',old('city',isset($user->contactInformation->city) ? $user->contactInformation->city : null),['class'=>'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('code_postal',__('Codigo postal:')) }}
                    {{ Form::number('code_postal',old('code_postal',isset($user->contactInformation->code_postal) ? $user->contactInformation->code_postal : null),['class'=>'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('cellphone1',__('Nro móvil:')) }}
{{--                    <span class="input-group-addon"><span id="mcode">+57</span></span>--}}
                    {{ Form::number('cellphone1',old('cellphone1',isset($user->contactInformation->cellphone1) ? $user->contactInformation->cellphone1 : null),['class'=>'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('cellphone2',__('Nro fijo:')) }}
                    {{ Form::number('cellphone2',old('cellphone2',isset($user->contactInformation->cellphone2) ? $user->contactInformation->cellphone2 : null),['class'=>'form-control']) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('web_page',__('Pagina Web:')) }}
                    {{ Form::text('web_page',old('web_page',isset($user->contactInformation->web_page) ? $user->contactInformation->web_page : null),['class'=>'form-control']) }}
                </div>
            </div>

            {{ Form::submit(__('Guardar'),["class" => "btn btn-primary mr-2"]) }}
            <a class="btn iq-bg-danger" href="{{url('/')}}">{{__('Cancelar')}}</a>
            {{ Form::close() }}
        </div>
    </div>
</div>
