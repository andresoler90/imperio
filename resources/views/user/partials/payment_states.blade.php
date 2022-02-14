<div class="iq-card">
    <div class="iq-card-body">
        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#pending-tab{{isset($id)?"-".$id:""}}" role="tab" aria-controls="home"
                   aria-selected="false">{{__("Pendientes")}}
                    <span class="badge badge-default">{{count($payments->pendings)}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#approves-tab{{isset($id)?"-".$id:""}}" role="tab"
                   aria-controls="profile" aria-selected="true">{{__("Aprobados")}} <span
                        class="badge badge-default">{{count($payments->approves)}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#refuses-tab{{isset($id)?"-".$id:""}}" role="tab"
                   aria-controls="contact" aria-selected="false">{{__("Rechazados")}} <span
                        class="badge badge-default">{{count($payments->refuses)}}</span></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent-2">
            <div class="tab-pane fade" id="pending-tab{{isset($id)?"-".$id:""}}" role="tabpanel" aria-labelledby="home-tab">
                @component('user.partials.payment_states_table')
                    @slot('payments', $payments->pendings)
                @endcomponent
            </div>
            <div class="tab-pane fade active show" id="approves-tab{{isset($id)?"-".$id:""}}" role="tabpanel" aria-labelledby="profile-tab">
                @component('user.partials.payment_states_table')
                    @slot('payments', $payments->approves)
                @endcomponent
            </div>
            <div class="tab-pane fade" id="refuses-tab{{isset($id)?"-".$id:""}}" role="tabpanel" aria-labelledby="contact-tab">
                @component('user.partials.payment_states_table')
                    @slot('payments', $payments->refuses)
                @endcomponent
            </div>
        </div>
    </div>
</div>
