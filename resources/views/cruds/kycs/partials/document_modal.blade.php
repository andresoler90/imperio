<div class="modal fade documentKycModal{{$kyc->id}}" tabindex="-1" role="dialog"   aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Visualización de documento')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <iframe width="600" height="600" src="{{route('user.kyc.download',[$kyc,1])}}" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cerrar')}}</button>
            </div>
        </div>
    </div>
</div>
