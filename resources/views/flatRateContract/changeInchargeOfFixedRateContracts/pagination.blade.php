

<div class="row">
  <div class="col-7">
      <div class="pagi-content mt-3">
          <table>
              <tbody>
              <tr>
              @if(isset($allChangeInchargeOfFixedRateContract) && $allChangeInchargeOfFixedRateContract->lastPage() > 1)
                 @include('layout.pagination_new.pagination_new1')
              @endif  
                 @include('layout.pagination_new.pagination_new2')
              @if(isset($allChangeInchargeOfFixedRateContract) && $allChangeInchargeOfFixedRateContract->total() > 0)
                 @include('layout.pagination_new.pagination_new3')
              @endif    
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
                  @include('layout.pagination_new.pagination_new5')
              </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>
