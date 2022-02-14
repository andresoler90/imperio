@if(isset($data))
    {{Form::open(['route'=>['task.detail.update',$data->id],'method'=>'PUT'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
@else
    {{Form::open(['route'=>'detail.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="company">{{__('Tipo de configuración')}}</label>
        {{Form::select('task_config_id',config('options.periodicity'),isset($data->task_config_id)?$data->task_config_id:old('task_config_id'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-12">
        <label for="company">{{__('Descripción de la tarea')}}</label>
        {{Form::text('description',isset($data->description)?$data->description:old('description'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-12">
        <label for="company">{{__('Link de la tarea')}}</label>
        {{Form::text('link',isset($data->link)?$data->link:old('link'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('task.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
