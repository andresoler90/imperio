@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">
                    @if(Auth::user()->balanceRoiTotal())
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">{{__('Solicitud de pagos')}}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                @if(!count($payments->pendings))
                                    @include('user.partials.payment_form_roi_request')
                                @else
                                    <div class="alert alert-success" role="alert">
                                        {{__('Ya hay una solicitud pendiente por aprobar, cancele la solicitud si desea modificar la información.')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="iq-card iq-card-block iq-card-stretch">
                        <div class="iq-card-body">
                            <div class="col-md-6 ">
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <div
                                        class="rounded-circle iq-card-icon {{Auth::user()->balanceRoiTotal()?'iq-bg-success':'iq-bg-danger'}} mr-3">
                                        <i class="fa fa-dollar"></i></div>
                                    <div class="text-left">
                                        <p class="mb-0">{{__('Saldo actual:')}}</p>
                                        <h2 class="mb-0"><span
                                                class="counter">{{ number_format(Auth::user()->balanceRoiTotal(),2) }}</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include("user.partials.payment_states")
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        function confirmDelete() {
            swal({
                title: "{{__('¿Está seguro?')}}",
                text: "{{__('Esta acción no tiene reversa!')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        // Envio submit
                        $("#formDelete").submit();
                    }
                });
        }
    </script>
@endsection
