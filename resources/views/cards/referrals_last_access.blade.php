<div class="iq-card iq-card-block iq-card-stretch iq-card-height">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{__("Ultimos Referidos")}}</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <table class="table mb-0 table-borderless">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Usuario</th>
                <th scope="col">Membresía</th>
                <th scope="col">Fecha Registro</th>
                <th scope="col">Pago</th>
                <th scope="col">Estatus</th>
            </tr>
            </thead>
            @php
                $multilevel= new \App\Http\Controllers\Libs\Multilevel(Auth::user());
                $json=collect(json_decode($multilevel->toJson()));
                $users=\App\User::whereIn("id",$json->pluck("id"))->limit(7)->orderByDesc("created_at")->get();
            @endphp
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">
                        <img class="rounded-circle img-fluid avatar-40"
                             src="{{asset("assets/images/user/01.jpg")}}" alt="profile">
                    </td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->membership?$user->membership->membership->name:"Pendiente"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->membership?number_format($user->membership->membership->price):0}}</td>
                    <td>
                        <div
                            class="badge badge-pill badge-success">{{$user->membership?$user->membership->status_name:"Pendiente"}}</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
