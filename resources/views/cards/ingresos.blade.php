<div class="iq-card iq-card-block iq-card-stretch iq-card-height">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{__("Ultimos Ingresos")}}</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <table class="table mb-0 table-borderless">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">{{__("Detalle")}}</th>
                <th scope="col">{{__("Cantidad")}}</th>
                <th scope="col">{{__("Fecha Registro")}}</th>
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
                    <td>10$</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
