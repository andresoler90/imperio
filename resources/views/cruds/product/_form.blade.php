@if(isset($data))
    {{Form::open(['route'=>['product.update',$data->id],'enctype'=>'multipart/form-data'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'product.store','enctype'=>'multipart/form-data'])}}
@endif

<div class="row">
    <div class="form-group col-md-6">
        <label for="name">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="description">{{__('Descripción')}}</label>
        {{Form::text('description',isset($data->description)?$data->description:old('description'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="commission">{{__('Comisión')}}</label>
        {{Form::number('commission',isset($data->commission)?$data->commission:old('commission'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="commission_referred">{{__('Comisión por referidos')}}</label>
        {{Form::number('commission_referred',isset($data->commission_referred)?$data->commission_referred:old('commission_referred'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="image">{{__('Imagen')}}</label>
        <div class="custom-file">
        <input class="custom-file-input" id="image" name="image" type="file" accept="image/jpeg,image/png,image/jpg"
               value="{{isset($data->image)?$data->image:old('image')}}">
        <label class="custom-file-label" for="file">Choose file</label>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="expiration_days">{{__('Días de vencimiento')}}</label>
        {{Form::number('expiration_days',isset($data->expiration_days)?$data->expiration_days:old('expiration_days'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="clicks">{{__('Clicks permitidos')}}</label>
        {{Form::number('clicks',isset($data->clicks)?$data->clicks:old('clicks'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="price">{{__('Precio')}}</label>
        {{Form::number('price',isset($data->price)?$data->price:old('pair_price'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        <label for="pair_price">{{__('pair_price')}}</label>
        {{Form::number('pair_price',isset($data->pair_price)?$data->pair_price:old('pair_price'),['class'=>'form-control'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('product.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
