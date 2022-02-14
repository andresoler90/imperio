@if(isset($data))
    {{Form::open(['route'=>['rankAdmin.update',$data->id],'enctype'=>'multipart/form-data'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'rankAdmin.store','enctype'=>'multipart/form-data'])}}

@endif
<div class="row">
    <div class="form-group col-md-6">
        <label for="name">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="pf">{{__('PF')}}</label>
        {{Form::number('pf',isset($data->pf)?$data->pf:old('pf'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="pd">{{__('PD')}}</label>
        {{Form::number('pd',isset($data->pd)?$data->pd:old('pd'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="min_ranks_id">{{__('Min Rank')}}</label>
        {{Form::number('min_ranks_id',isset($data->min_ranks_id)?$data->min_ranks_id:old('min_ranks_id'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="requisitos">{{__('Requisitos')}}</label>
        {{Form::text('requirements',isset($data->requirements)?$data->requirements:old('requirements'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="image">{{__('Imagen')}}</label>
        <div class="custom-file">
            <input class="custom-file-input form-control-lg" id="image" name="image" type="file" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.pdf"
                   value="{{isset($data->image)?$data->image:old('image')}}">
            <label class="custom-file-label col-form-label-lg" for="file">Choose file</label>
        </div>
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('rankAdmin.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}

@section('scripts')
    <script type="text/javascript">

        $('#image').on('change', function () {
            files = $(this)[0].files;
            name = '';
            for (var i = 0; i < files.length; i++) {
                name += files[i].name + (i != files.length - 1 ? ", " : "");
            }
            $(".custom-file-label").html(name);
        });
    </script>
@endsection
