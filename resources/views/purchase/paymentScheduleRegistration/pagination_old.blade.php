@php
    if(isset($purchaseHistoryInfos)){
        $current_page=$purchaseHistoryInfos->currentPage();
        $per_page=$purchaseHistoryInfos->perPage();
        $first_data= ($current_page - 1)*$per_page+1;
        $last_data=($current_page - 1)*$per_page+ sizeof($purchaseHistoryInfos->items());
        $total=$purchaseHistoryInfos->total();
        $lastPage=$purchaseHistoryInfos->lastPage();
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
            
                    @include('layout.pagination_new.pagination_new1')
               

                    @include('layout.pagination_new.pagination_new2')

                    @include('layout.pagination_new.pagination_new3')
                 

                    @include('layout.pagination_new.pagination_new4')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-5 d-flex justify-content-start">
        <div class="mt-3 mb-3">
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
