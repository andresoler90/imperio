@if(isset($data))
    {{Form::open(['route'=>['category.update',$data->id]])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'category.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="company">{{__('Nombre')}}</label>
        {{Form::text('category_name',isset($data->category_name)?$data->category_name:old('category_name'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-12">
        <label for="company">{{__('Prefijo')}}</label>
        {{Form::text('category_prefix',isset($data->category_prefix)?$data->category_prefix:old('category_prefix'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('category.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
