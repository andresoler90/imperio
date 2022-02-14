<!doctype html>
<html lang="es">
@include('partials._body_style')
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
{{--        <div class="loader">--}}
{{--            <div class="cube">--}}
{{--                <div class="sides">--}}
{{--                    <div class="top" style="background-color: #EF9726;"></div>--}}
{{--                    <div class="right" style="background-color: #EF9726;"></div>--}}
{{--                    <div class="bottom" ></div>--}}
{{--                    <div class="left" ></div>--}}
{{--                    <div class="front" style="background-color: #EF9726;"></div>--}}
{{--                    <div class="back" ></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
<!-- loader END -->
@include('partials._app_body')

@yield('scripts')
</body>

</html>
