<div class="row">
    <div class="col-7">
        <div class="pagi-content mt-3">
            <table>
                <tbody>
                    <tr>
                        @if (isset($allBillingLedger) && $allBillingLedger->lastPage() > 1)
                            @include('sales.billingLedger.pagination.pagination_new1')
                        @endif

                        @include('sales.billingLedger.pagination.pagination_new2')

                        @if (isset($allBillingLedger) && $allBillingLedger->total() > 0)
                            @include('sales.billingLedger.pagination.pagination_new3')
                        @endif

                        @include('sales.billingLedger.pagination.pagination_new4')
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-5">
        <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
            <table>
                <tbody>
                    <tr>
                        @include('sales.billingLedger.pagination.pagination_new5')
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
