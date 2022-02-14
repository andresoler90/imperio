<div class="tab-pane fade" id="chang-pwd" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">{{__('Cambiar contraseña')}}</h4>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="iq-card-body">
            {{ Form::open(['route'=> ['profile.user.changedPassWord',$user] ,'method'=>'PUT']) }}
            {{ Form::token() }}
                <div class="form-group">
                    {{ Form::label('current_password',__('Contraseña actual:')) }}
                    {{ Form::password('current_password',["class"=>"form-control",'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password',__('Nueva contraseña:')) }}
                    {{ Form::password('password',["class"=>"form-control",'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation',__('Confirmar contraseña:')) }}
                    {{ Form::password('password_confirmation',["class"=>"form-control",'required']) }}
                </div>
                {{ Form::submit(__('Guardar'),["class" => "btn btn-primary mr-2"]) }}
                <a class="btn iq-bg-danger" href="{{url('/')}}">{{__('Cancelar')}}</a>
                {{ Form::close() }}
        </div>
    </div>
</div>




