@extends('layouts.master')

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Filtros')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {{ Form::open(['route'=> ['payment.search.filters'] ,'method'=>'POST', "id" => "formFilters", 'name' => "formFilters"]) }}
                            {{ Form::token() }}

                            <div class=" row align-items-center">
                                <div class="form-group col-sm-4">
                                    {{ Form::label('name',__('Usuario:')) }}
                                    {{ Form::text('name',old('name',isset($user->name) ? $user->name : null ),["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-4">
                                    {{ Form::label('type',__('Tipo pago:')) }}
                                    {{ Form::select('type',config('options.typePayment'),null,["class"=>"form-control"]) }}
                                </div>
                                <div class="form-group col-sm-4">
                                    {{ Form::label('status',__('Tipo solicitud:')) }}
                                    {{ Form::select('status',config('options.statusPayment'),null,["class"=>"form-control"]) }}
                                </div>
                            </div>

                            {{--Al buscar filtros resources\views\cruds\payment\filters.blade.php--}}
                            {{ Form::button(__('Buscar'),
                                ['class' => 'btn btn-outline-dark mr-2','id' => 'searchPayments', 'onclick' => 'getSearchFilters()'])}}
                            <a class="btn btn-outline-dark mr-2" href="{{route('payment.index')}}">{{__('Limpiar')}}</a>
                            {{Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            @if(count($payments))
                <div class="row">
                    <div class="col-md-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#actual-tab"
                                           role="tab">
                                            {{__("Actual")}}
                                            <span class="badge badge-default">{{count($payments)}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="actual-tab" role="tabpanel">
                                        @include("cruds.payment.partials.list",["route"=>'payment.action',"payments"=>$payments])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{__("Aun no se cuenta con solicitudes de pagos registradas")}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('scripts')

    {{Html::script("js/sweetalert2.js")}}
    <script type="text/javascript">

        function selectAll() {
            if ($('#check_padre').is(':checked'))
                tipo = 0;
            else
                tipo = 1;

            if (tipo == 0) {
                $("#check_padre").prop('checked', true);
                $("#detail_results input[type=checkbox]").prop('checked', true);
            } else {
                $("#check_padre").prop('checked', false);
                $("#detail_results input[type=checkbox]").prop('checked', false);
            }
        }

        function getSearchFilters() {

            // CAMPOS FORMS
            $_token = "{{ csrf_token() }}";
            let name = $("input[name=name]").val();
            let type = $("select[name=type]").val();
            let status = $("select[name=status]").val();


            $.ajax({
                url: '{{route('payment.search.filters')}}',
                type: 'POST',
                datatype: 'html',
                data: {
                    'name': name, 'type': type, 'status': status, '_token': $_token
                },
                success: function (data) {
                    $('#detail_results').html(data);
                }
            });
        }

        function confirmPaymentAdmin(type) {
            if (type == 1) {
                var label = "{{__('Si, Aprobar')}}";
                $("#refuse").val(null);
            } else if (type == 2) {
                var label = "{{__('Si, Rechazar')}}";
                $("#approve").val(null);
            }

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
                confirmButtonText: label,
                cancelButtonText: "{{__('No, Cancelar!')}}",
                reverseButtons: true
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    // Envio submit
                    $("#formApprove").submit();
                }
            })
        }
    </script>
@endsection
