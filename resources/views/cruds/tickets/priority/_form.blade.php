@if(isset($data))
    {{Form::open(['route'=>['priority.update',$data->id]])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'priority.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="company">{{__('Nombre')}}</label>
        {{Form::text('priority_name',isset($data->priority_name)?$data->priority_name:old('priority_name'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('priority.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
