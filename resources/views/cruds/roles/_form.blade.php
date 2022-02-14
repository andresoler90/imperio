@if(isset($data))
    {{Form::open(['route'=>['roles.update',$data->id]])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'roles.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="company">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('roles.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
