<div class="iq-card iq-card-block iq-card-stretch iq-card-height wow zoomIn">
    <div class="iq-card-body">
        <div class="row center-text">
            <div class="col-lg-12 mb-2 d-flex justify-content-between">
                <div
                    class="icon iq-icon-box rounded-circle iq-bg-success rounded-circle center-icon">
                    <i class="ri-wallet-3-fill"></i>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <h6 class="card-title text-uppercase text-secondary mb-0">{{__("Saldo Billetera")}}</h6>
                <span class="h2 text-dark mb-0 counter">{{number_format(Auth::user()->balanceTotal(),2)}}</span><span
                    class="h2 text-dark">$ </span>
            </div>
        </div>
    </div>
</div>
