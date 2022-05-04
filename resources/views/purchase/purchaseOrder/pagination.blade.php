@php
    if(isset($purchaseOrderInfos)){
        $current_page=$purchaseOrderInfos->currentPage();
        $per_page=$purchaseOrderInfos->perPage();
        $first_data= ($current_page - 1)*$per_page+1;
        $last_data=($current_page - 1)*$per_page+ sizeof($purchaseOrderInfos->items());
        $total=$purchaseOrderInfos->total();
        $lastPage=$purchaseOrderInfos->lastPage();
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
@endphp

<div class="row">
    <div class="col-7">
        <div class="pagi-content mt-3">
            <table>
                <tbody>
                <tr>
                    @if(isset($purchaseOrderInfos) && $purchaseOrderInfos->lastPage() > 1)
                        @include('layout.pagination_new.pagination_new1')
                    @endif

                    @include('layout.pagination_new.pagination_new2')

                    @if(isset($purchaseOrderInfos) && $purchaseOrderInfos->total() > 0)
                        @include('layout.pagination_new.pagination_new3')
                    @endif

                    @include('layout.pagination_new.pagination_new4')
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
                    @include('layout.pagination_new.pagination_new5')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
