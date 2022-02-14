@if(isset($data))
    {{Form::open(['route'=>['kyc.update',$data->id],'method'=>'PUT','enctype'=>'multipart/form-data'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'kyc.store','enctype'=>'multipart/form-data'])}}
@endif

<div class="row">
    <div class="form-group col-md-6">
        <label for="company">{{__('Usuarios')}}</label>
        {{Form::select('users_id',$users,isset($data->users_id)?$data->users_id:old('users_id'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Tipo de documento')}}</label>
        {{Form::select('kyc_types_id',$types,isset($data->kyc_types_id)?$data->kyc_types_id:old('kyc_types_id'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Comentario')}}</label>
        <input class="form-control" id="comment" name="comment" type="text"
               value="{{isset($data->comment)?$data->comment:old('comment')}}">
    </div>
    <div class="form-group col-md-6">
        <label for="company">{{__('Documento')}}</label>
        <div class="custom-file">
            <input class="custom-file-input" id="file" name="file" type="file"
                   accept="application/pdf,image/jpeg,image/png,image/jpg"
                   value="{{isset($data->file)?$data->file:old('file')}}">
            <label class="custom-file-label" for="file">Choose file</label>
        </div>
    </div>

    <div class="form-group col-md-6">
    </div>
    @if(isset($data->users_id))
        <div class="form-group col-md-6">
            <label for="company">{{__('Documento cargado')}}</label>
            @php($path = 'users/' . $data->users_id . '/kyc/' . $data->id . '.' . File::extension($data->file))
            @if(Storage::exists($path))
                <a class="form-control-file" target="_blank" href="{{route('user.kyc.download',[$data->id,1])}}"><i
                        class="fa fa-file-pdf-o"
                        style="color: red">{{ __(' Descargar documento') }}</i></a>
            @else
                <a class="form-control-file"><i class="fa fa-file-pdf-o"
                                                style="color: grey"></i>{{ __(' Sin documento') }}</a>
            @endif
        </div>
    @endif

</div>
<div class="form-actions">
    @if(isset($data) && $data->status==0)
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    @endif
    @if(!isset($data))
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    @endif
    <a class="btn btn-secondary" href="{{route('kyc.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}
