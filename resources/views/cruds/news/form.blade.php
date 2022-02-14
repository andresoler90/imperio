<div class="row">
    <div class="form-group col-md-12">
        <label for="title">{{__('Titulo')}}</label>
        {{Form::text('title',isset($news->title)?$news->title:old('title'),['class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-12">
        <label for="body">{{__('Idioma')}}</label>
        {{Form::select('languages_id',$languages,isset($news->languages_id)?$news->languages_id:old('languages_id'),['class'=>'form-control', 'placeholder' => __('Seleccione')])}}
    </div>
    <div class="form-group col-md-12">
        <label for="body">{{__('Contenido')}}</label>
        {{Form::textarea('body',isset($news->body)?$news->body:old('body'),['class'=>'form-control', 'rows' => 5])}}
    </div>
    <div class="form-group col-md-12">
        <label for="iframe">{{__('Contenido embebido')}}</label>
        {{Form::textarea('iframe',isset($news->iframe)?$news->iframe:old('iframe'),['class'=>'form-control', 'rows' => 2])}}
    </div>
</div>
<hr>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('news.index')}}">{{__('Cancelar')}}</a>
</div>
