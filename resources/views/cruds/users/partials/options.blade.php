<table class="table table-borderless table-striped">
    @if($user->token_login)
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        {{__("Desactivar autenticacion de doble factor")}}
                        <a class="btn btn-outline-success float-right"
                           href="{{route('crud.deactivate.a2fa',$user->id)}}">Desactivar</a>
                    </div>
                </div>
            </td>
        </tr>
    @endif
    <tr>
        <td>
            <div class="row">
                <div class="col-md-12">
                    {{__("Reiniciar contraseña")}}
                    <a class="btn btn-outline-success float-right"
                       href="{{route('user.reset.password',$user->id)}}">Generar</a>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="row">
                <div class="col-md-12">
                    {{__("VIP")}}
                    @if($user->has_vip)
                        <a class="btn btn-outline-success float-right"
                           href="{{route('user.has.vip',[0,$user->id])}}">{{__('Desactivar')}}</a>
                    @else
                        <a class="btn btn-outline-danger float-right"
                           href="{{route('user.has.vip',[1,$user->id])}}">{{__('Activar')}}</a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                    {{__("Eliminar usuario")}}

                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-success float-right" data-toggle="modal"
                                data-target="#deleteModal">
                            {{__('Eliminar usuario')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{__('Eliminar usuario')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                {{__('Esta intentando de eliminar el usuario')}} <b>{{$user->username}}</b>, {{__('por lo cual el usuario dejara de ser visible por el sistema.')}}
                                                <br>
                                                <b>
                                                    {{__('Si esta seguro de lo que esta haciendo, por favor presione ELiminar, de lo contrario puede cerrar la ventana')}}
                                                </b>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    {{__('Cancelar')}}
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                {{Form::open(['route'=>'user.delete','method'=>'delete'])}}
                                                {{Form::hidden('users_id',$user->id)}}
                                                {{Form::submit(__('Eliminar'),['class'=>'btn btn-outline-danger float-right'])}}
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
</table>
