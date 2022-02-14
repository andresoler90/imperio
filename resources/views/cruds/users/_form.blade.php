@if(isset($data))
    {{Form::open(['route'=>['user.update',$data->id]])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'user.store'])}}
@endif
@php(!isset($cols)?$cols=4:'')
<div class="row">
    <div class="form-group col-md-{{$cols}}">
        <label for="name">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-{{$cols}}">
        <label for="email">{{__('Correo electrónico')}}</label>
        {{Form::email('email',isset($data->email)?$data->email:old('email'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-{{$cols}}">
        <label for="roles_id">{{__('Rol')}}</label>
        {{Form::select('roles_id',$roles,isset($data->roles_id)?$data->roles_id:old('roles_id'),['placeholder'=>'Seleccione...','class'=>'custom-select'])}}
    </div>
    @if(isset($data->sponsor_id))
        <div class="form-group col-md-{{$cols}}">
            <label for="roles_id">{{__('Referido por')}}</label>
            {{Form::select('sponsor_id',$users,isset($data->sponsor_id)?$data->sponsor_id:old('sponsor_id'),['placeholder'=>'Seleccione...','class'=>'custom-select select2','style'=>"width: 100%"])}}
        </div>
    @endif
</div>
<hr>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('user.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
