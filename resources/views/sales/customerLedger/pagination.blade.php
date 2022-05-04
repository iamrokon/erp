@php
if(isset($customerLedgerInfo)){
    $skip = 0;
    $old = array();
    if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
    }
    $current_page = $customerLedgerInfo->currentPage();
    $per_page = $customerLedgerInfo->perPage();
    $first_data = ($current_page - 1)*$per_page+1;
    $last_data = ($current_page - 1)*$per_page+ sizeof($customerLedgerInfo->items());
    $total = $customerLedgerInfo->total();
    $lastPage = $customerLedgerInfo->lastPage() ;
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
            @if(isset($customerLedgerInfo) && $customerLedgerInfo->lastPage() > 1)
              @include('layout.pagination_new.pagination_new1')
            @endif

            @include('layout.pagination_new.pagination_new2')

            @if(isset($customerLedgerInfo) && $customerLedgerInfo->total() > 0)
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
