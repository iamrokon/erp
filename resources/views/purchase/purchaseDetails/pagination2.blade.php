@php
    if(isset($purchaseDetails2Infos)){
        $current_page2=$purchaseDetails2Infos->currentPage();
        $per_page2=$purchaseDetails2Infos->perPage();
        $first_data2= ($current_page2 - 1)*$per_page2+1;
        $last_data2=($current_page2 - 1)*$per_page2+ sizeof($purchaseDetails2Infos->items());
        $total2=$purchaseDetails2Infos->total();
        $lastPage2=$purchaseDetails2Infos->lastPage();
    }else{
        $current_page2 = 1;
        $per_page2 = 20;
        $first_data2 = 1;
        $last_data2 = 0;
        $total2 = 0;
        $lastPage2 = 1;
    }
@endphp

<div class="row">
    <div class="col-7">
        <div class="pagi-content mt-3">
            <table>
                <tbody>
                <tr>
                    {{--@if(isset($purchaseDetails2Infos) && $purchaseDetails2Infos->lastPage() > 1)
                        @include('layout.pagination_new.pagination_new1')
                    @endif--}}
                    @if(isset($purchaseDetails2Infos) && $purchaseDetails2Infos->lastPage() > 1)
                        @include('layout.pagination_new.pagination_new1_2')
                    @endif

                    @include('layout.pagination_new.pagination_new2_2')

                    @if(isset($purchaseDetails2Infos) && $purchaseDetails2Infos->total() > 0)
                        @include('layout.pagination_new.pagination_new3_2')
                    @endif

                    @include('layout.pagination_new.pagination_new4_2')
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
                    @include('layout.pagination_new.pagination_new5_2')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
