<div class="row">
  <div class="col-lg-6">
    <div class="pagi-content pagi-inner-text mt-3">
      <table>
        <tbody>
          <tr>
            @if($dashboardCommentInfo->lastPage() > 1)
            @include('layout.pagination_new.pagination_new1')
            @endif
            @include('layout.pagination_new.pagination_new2')
            @if($dashboardCommentInfo->total() > 0)
            @include('layout.pagination_new.pagination_new3')
            @endif
            @include('layout.pagination_new.pagination_new4')
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="mt-3 mb-3 float-lg-right float-sm-left">
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
