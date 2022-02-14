@if(isset($data))
    {{Form::open(['route'=>['menu.update',$data->id],'method'=>'PUT'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
@else
    {{Form::open(['route'=>'menu.store'])}}
@endif
@csrf
<div class="row">
    <div class="form-group col-md-6">
        <label for="company">{{__('Nombre')}}</label>
        <input class="form-control" id="name" name="name" type="text" value="{{isset($data->name)?$data->name:old('name')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('URL')}}</label>
        <input class="form-control" id="url" name="url" type="text" value="{{isset($data->url)?$data->id:old('url')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Ruta (Laravel)')}}</label>
        <input class="form-control" id="route" name="route" type="text" value="{{isset($data->route)?$data->route:old('route')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Icono (Fontawesome)')}}</label>
        <input class="form-control" id="icon" name="icon" type="text" value="{{isset($data->icon)?$data->icon:old('icon')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Clase css')}}</label>
        <input class="form-control" id="class" name="class" type="text" value="{{isset($data->class)?$data->class:old('class')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Menu padre')}}</label>
        {{Form::select('menus_id',$menus,isset($data->menus_id)?$data->menus_id:old('menus_id'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Rol')}}</label>
        {{Form::select('roles_id',$roles,isset($data->roles_id)?$data->roles_id:old('roles_id'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('menu.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
