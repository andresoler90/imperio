@if(isset($data))
    {{Form::open(['route'=>['membership.update',$data->id],'enctype'=>'multipart/form-data'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'membership.store','enctype'=>'multipart/form-data'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="name">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="description">{{__('Descripción')}}</label>
        {{Form::text('description',isset($data->description)?$data->description:old('description'),['class'=>'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="amount">{{__('Monto')}}</label>
        {{Form::number('amount',isset($data->amount)?$data->amount:old('amount'),['class'=>'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="cap">{{__('Margen de maximo de ganancia')}}</label>
        {{Form::number('cap',isset($data->cap)?$data->cap:old('cap'),['class'=>'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="image">{{__('Imagen')}}</label>
        {{Form::file('image',['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('membership.list')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
