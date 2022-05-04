@php
    if(isset($purchaseSlipInfos)){
        $current_page=$purchaseSlipInfos->currentPage();
        $per_page=$purchaseSlipInfos->perPage();
        $first_data= ($current_page - 1)*$per_page+1;
        $last_data=($current_page - 1)*$per_page+ sizeof($purchaseSlipInfos->items());
        $total=$purchaseSlipInfos->total();
        $lastPage=$purchaseSlipInfos->lastPage();
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
          
                 @include('layout.pagination_new.pagination_new1_3')
                 @include('layout.pagination_new.pagination_new2')
                 @include('layout.pagination_new.pagination_new3')
                 @include('layout.pagination_new.pagination_new4')
              </tr>
              </tbody>
          </table>
      </div>
  </div>
  <div class="col-5 d-flex justify-content-end">
      <div class="mt-3 mb-3">
          <table>
              <tbody>
              <tr>
                  @include('layout.pagination_new.pagination_new5_3')
              </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>
