@if(isset($data))
    {{Form::open(['route'=>['task.update',$data->id],'method'=>'PUT'])}}
    {{Form::hidden('id',isset($data->id)?$data->id:'')}}
    @method('put')
@else
    {{Form::open(['route'=>'task.store'])}}
@endif

<div class="row">
    <div class="form-group col-md-12">
        <label for="name">{{__('Nombre')}}</label>
        {{Form::text('name',isset($data->name)?$data->name:old('name'),['class'=>'form-control'])}}    </div>
    <div class="form-group col-md-12">
        <label for="periodicity">{{__('Tipo')}}</label>
        {{Form::select('periodicity',config('options.periodicity'),isset($data->periodicity)?$data->periodicity:old('periodicity'),['id'=>'periodicity',"class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-12" style="display: none" id="field_weekly">
        <label for="value[weekly]">{{__('Dia de la semana')}}</label>
        {{Form::select('value[weekly]',config('options.weekly_days'),isset($data->value)?$data->value:old('value'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
    <div class="form-group col-md-12" style="display: none" id="field_monthly">
        <label for="value[monthly]">{{__('Dia del mes')}}</label>
        {{Form::select('value[monthly]',config('options.monthly_days'),isset($data->value)?$data->value:old('value'),["class"=>"custom-select",'placeholder'=>'Seleccione...'])}}
    </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
    <a class="btn btn-secondary" href="{{route('task.index')}}">{{__('Cancelar')}}</a>
</div>
{{Form::close()}}

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#periodicity').on('change', function () {
                var value = $(this).val();
                switch (value) {
                    case "daily":
                        $('#field_weekly').hide();
                        $('#field_monthly').hide();
                        break;
                    case "weekly":
                        $('#field_monthly').hide();
                        $('#field_weekly').show();
                        break;
                    case "monthly":
                        $('#field_weekly').hide();
                        $('#field_monthly').show();
                        break;
                }
            });

            @if(isset($data))
                @switch($data->periodicity)
                    @case('weekly')
                        $('#field_weekly').show();
                    @break
                    @case('monthly')
                        $('#field_monthly').show();
                    @break
                @endswitch
            @endif
        });
    </script>
@endsection
