@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">

            @include('cruds.kycs.partials.filters')

            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Lista KYC')}}</h4>
                            </div>
{{--                            <div class="iq-card-header-toolbar d-flex align-items-center">--}}
{{--                                <ul class="nav nav-pills">--}}

{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" href="{{route('kyc.create')}}">{{__('Crear')}}</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>

                        <div class="iq-card-body" id="kyc-list-div">
                            @component('cruds.kycs.components.list_table')
                                @slot('kycs',$kycs)
                            @endcomponent
                            <div class="row justify-content-between mt-3">
                                <div class="col-md-6">
                                    {{$kycs->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        function confirmDeleteKyc() {
            const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

            swalWithBootstrapButtons.fire({
                title: "{{__('¿Está seguro?')}}",
                text: "{{__('Esta acción no tiene reversa!')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('Si, Eliminar')}}",
                cancelButtonText: "{{__('No, Cancelar!')}}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envio submit
                    $("#formDeleteKyc").submit();
                }
            })
        }

        function searchFiltersKyc() {

            // CAMPOS FORMS
            $_token = "{{ csrf_token() }}";
            let username = $("input[name=username]").val();
            let dateIn = $("input[name=dateIn]").val();
            let dateEnd = $("input[name=dateEnd]").val();


            $.ajax({
                url: '{{route('kyc.search.filters')}}',
                type: 'POST',
                datatype: 'html',
                data: {
                    'username': username,'dateIn': dateIn,'dateEnd': dateEnd,'_token': $_token
                },
                success: function (data) {
                    $('#kyc-list-div').html(data);
                }
            });
        }

        function postApprovedState(kyc,status) {

            comment = $('#comment').val();
            var url = "{{route('kyc.status.update',['%kyc%','%status%','%comment%'])}}";
            url = url.replace('%kyc%', kyc);
            url = url.replace('%status%',status);
            url = url.replace('%comment%',comment);

            $.ajax({
                type:"GET",
                url:url,
                success:function(data){
                    window.location.href = url
                },
            })
        }
    </script>
@endsection
