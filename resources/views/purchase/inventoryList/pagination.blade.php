@php
    if(isset($inventoryListData)){
        
        $current_page=$inventoryListData->currentPage();
        $per_page=$inventoryListData->perPage();
        $first_data= ($current_page - 1)*$per_page+1;
        $last_data=($current_page - 1)*$per_page+ sizeof($inventoryListData->items());
        $total=$inventoryListData->total();
        $lastPage=$inventoryListData->lastPage();
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
@endphp
<div class="row mb-1">
    <div class="col-7">
      <div class="pagi-content mt-3">
       <table>
         <tbody>
           <tr>
                @if(isset($inventoryListData) && $inventoryListData->lastPage() > 1)
                  @include('layout.pagination_new.pagination_new1')
                @endif
                @include('layout.pagination_new.pagination_new2')
                @if(isset($inventoryListData) && $inventoryListData->total() > 0)
                  @include('layout.pagination_new.pagination_new3')
                @endif
                @include('layout.pagination_new.pagination_new4')
           </tr>
         </tbody>
       </table>
       </div>
    </div>
    <div class="col-5 d-flex justify-content-end">
      <div class=" mt-3 mb-3">
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