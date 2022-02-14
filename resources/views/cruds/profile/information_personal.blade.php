@foreach($errors->all() as $message)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endforeach

<div class="tab-pane fade active show" id="personal-information" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">{{__('Información personal')}}</h4>
            </div>
        </div>
        <div class="iq-card-body">

            {{ Form::open(['route'=> ['profile.update',$user->id] ,'method'=>'PUT', 'files' => true]) }}
            {{ Form::token() }}

            <div class="form-group row align-items-center">
                <div class="col-md-12">
                    <div class="profile-img-edit">
                        <img class="profile-pic"
                             src="{{ asset(isset($user->contactInformation->url_image) ? $user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                             alt="{{isset($user->contactInformation->name_image) ?$user->contactInformation->name_image : 'user-image'}}">
                        <div class="p-image">
                            <i class="ri-pencil-line upload-button"></i>
                            {{ Form::input('file','file_upload',null,["class" => "file-upload","accept"=>"image/png, image/jpeg"]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row align-items-center">
                <div class="form-group col-sm-6">
                    {{ Form::label('username',__('Usuario:')) }}
                    {{ Form::text('username',old('username',$user->username),["class"=>"form-control", "disabled"]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('email',__('Correo:')) }}
                    {{ Form::text('email',old('email',$user->email),["class"=>"form-control"]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('name',__('Nombre de pila:')) }}
                    {{ Form::text('name',old('name',$user->name),["class"=>"form-control"]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('lastname',__('Apellido:')) }}
                    {{ Form::text('lastname',old('lastname',$user->lastname),["class"=>"form-control"]) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('birth_date',__('Fecha de nacimiento:')) }}
                    {{ Form::date('birth_date',old('birth_date',isset($user->contactInformation->birth_date) ? $user->contactInformation->birth_date : null),["class"=>"form-control"]) }}
                </div>
                <div class="form-group col-sm-6">
                    @php
                        $genderMale = false;
                        $genderFemale = false;
                        if ($user->contactInformation)
                        {

                            if (isset($user->contactInformation->gender) && $user->contactInformation->gender == 0)
                                $genderMale = true;
                            elseif (isset($user->contactInformation->gender) && $user->contactInformation->gender == 1)
                                $genderFemale = true;
                        }
                    @endphp
                    {{ Form::label('gender',__('Genero:'),["class"=>"d-block"]) }}

                    {{ Form::radio('gender',0,$genderMale) }}
                    {{ Form::label('gender',__('Masculino'),["class"=>"custom-control custom-radio custom-control-inline"]) }}

                    {{ Form::radio('gender',1,$genderFemale) }}
                    {{ Form::label('gender',__('Femenino'),["class"=>"custom-control custom-radio custom-control-inline"]) }}

                </div>
            </div>
            {{ Form::submit(__('Guardar'),["class" => "btn btn-primary mr-2"]) }}
            <a class="btn iq-bg-danger" href="{{url('/')}}">{{__('Cancelar')}}</a>
            {{ Form::close() }}
            @if(Auth::user()->membership)
                <hr>
                <div class="row">
                    <div class="col-md-12 text-right">

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#close_account">
                            {{__('Cerrar cuenta')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="close_account" tabindex="-1" role="dialog"
                             aria-labelledby="close_accountTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLongTitle">{{__('Confirmación de cierra de ceunta')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-justify">
                                        <h4 class="card-title">{{__('Términos  y condiciones')}}</h4>
                                        <span>
There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                    </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info float-left" data-dismiss="modal">
                                            {{__('Cancelar')}}
                                        </button>
                                        <a href="{{route('user.close.account')}}" class="btn btn-outline-danger">
                                            {{__('Acepto Términos  y condiciones')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
