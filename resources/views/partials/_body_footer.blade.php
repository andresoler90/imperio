<!-- Footer -->
<footer class="bg-white iq-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">{{__("Politica de Privacidad")}}</a></li>
                    <li class="list-inline-item">{{__("Terminos de Uso")}}</li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                {{__("Copyright 2021")}}  <a href="{{url('/')}}">Kaboom LLC</a> {{__("Todos los Derechos Reservados")}}.
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->
<!-- Optional JavaScript -->
@include('partials._body_scripts')
@yield('body_bottom')
