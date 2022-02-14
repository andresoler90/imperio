@extends('layouts.master')

@section('content')
    @php( $registration = \App\Models\System::where('parameter','registration_value')->first())

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Lista Pool Upgrades')}}</h4>
                            </div>
                        </div>

                        <div class="iq-card-body" id="pool-list-div">
                            <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                   aria-describedby="user-list-page-info">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Usuario')}}</th>
                                    <th>{{__('Identificación')}}</th>
                                    <th>{{__('Telefono')}}</th>
                                    <th>{{__('Tipo Membresia')}}</th>
                                    <th>{{__('Valor')}}</th>
                                    <th>{{__('Aprobado por')}}</th>
                                    <th>{{__('Documento')}}</th>
                                    <th>{{__('Estado')}}</th>
                                    <th colspan="1">{{__('Opciones')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($listPoolUpgrades))
                                    @php($i=1)
                                    @foreach($listPoolUpgrades as $pool)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td><a href="{{route('user.edit',$pool->users_id)}}"> {{$pool->user->username}} - {{$pool->user->name}} {{$pool->user->lastname}} </a></td>
                                            <td>{{$pool->identification_document}}</td>
                                            <td>{{$pool->cellphone}}</td>
                                            <td>{{$pool->membership->name}}</td>
                                            <td>${{$pool->membership->amount}} + ${{$registration->value}}</td>
                                            <td>{{$pool->confirm_user?$pool->confirmUser->name:''}}</td>
                                            <td style="text-align: center">
                                                @if($pool->support_document)
                                                    <a href="{{route('general.downloads',[$pool->id,'m_pool_upgrades',1])}}" target="_blank"
                                                       class="badge badge-cobalt-blue">
                                                        <i class="fa fa-eye"></i>
                                                        {{$pool->support_document}}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($pool->status=='P')
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{__('Aprobación')}}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            {{-- APROBAR --}}
                                                            <a class="dropdown-item" href="#" onclick="postApprovedState('{{$pool->id}}','A')">{{__('Aprobar')}}</a>
                                                            <a class="dropdown-item" href="#" onclick="postApprovedState('{{$pool->id}}','R')">{{__('Rechazar')}}</a>
{{--                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">{{__('Rechazar')}}</a>--}}
                                                        </div>
                                                    </div>
                                                @else
                                                    {!! $pool->getStatusBadgeAttribute() !!}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{route('destroy.pool.upgrade',$pool->id)}}" method="POST" id="formDeletepool_{{$pool->id}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a class="btn btn-sm" onclick="confirmDeletepool('{{$pool->id}}')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">{{__('Sin registros asociados')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="row justify-content-between mt-3">
                                <div class="col-md-6">
                                    {{$listPoolUpgrades->links()}}
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
    {{Html::script("js/sweetalert2.js")}}
    <script type="text/javascript">
        function confirmDeletepool(id) {
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
                    $("#formDeletepool_"+id).submit();
                }
            })
        }

        function postApprovedState(pool,status) {

            var url = "{{route('approved.pool.upgrade',['%pool%','%status%'])}}";
            url = url.replace('%pool%', pool);
            url = url.replace('%status%',status);

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
