<div class="row">
  <div class="col-7">
    <div class="pagi-content mt-3">
      <table>
        <tbody>
          <tr>
            @if(isset($allDepositHistoryList) && $allDepositHistoryList->lastPage() > 1)
              @include('layout.pagination_new.pagination_new1')
            @endif

            @include('layout.pagination_new.pagination_new2')

            @if( isset($allDepositHistoryList)  && $allDepositHistoryList->total() > 0)
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
