<a href="{{route('user.tasks.link',$id)}}" class="btn btn-sm btn-outline-dark" target="_blank">
    <i class="fa fa-external-link"></i>
    {{__('Abrir pagina')}}
</a>
{{--
<script type="text/javascript">

    function link{{$id}}() {

        var win = window.open(
            "{{$link}}",
            "link-{{$id}}");
        var timer = setInterval(function () {
            if (win.closed) {
                clearInterval(timer);

                alert(timer);
            }
        }, 500);
    }
</script>
--}}
