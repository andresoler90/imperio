@if(isset($data))
    {{Form::open(['route'=>['status.update',$data->id]])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'status.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="company">{{__('Nombre')}}</label>
        {{Form::text('status_name',isset($data->status_name)?$data->status_name:old('status_name'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('status.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
