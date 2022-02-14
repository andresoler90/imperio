@section('styles')
    @parent
    <link href="{{ asset('css/calendar-main.css') }}" rel='stylesheet'/>
@endsection
@if(!isset($calendar))
    @php
        $obj=new \App\Http\Controllers\Admin\CalendarController();
        $calendar=$obj->getCalendar();
    @endphp
@endif
{!! $calendar->calendar() !!}

@section('scripts')
    @parent
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/main.min.js')}}"></script>
    {!! $calendar->script() !!}
@endsection
