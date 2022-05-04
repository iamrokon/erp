<div class="row">
  <div class="col-7">
    <div class="pagi-content pagi-inner-text mt-3">
      <table>
        <tbody>
          <tr>
            @if($projectInfo->lastPage() > 1)
              @include('layout.pagination_new.pagination_new1')
            @endif

            @include('layout.pagination_new.pagination_new2')

            @if($projectInfo->total() > 0)
              @include('layout.pagination_new.pagination_new3')
            @endif

            @include('layout.pagination_new.pagination_new4')
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-5">
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

<!-- Pagination Starts Here -->
{{-- <div class="col-lg-12">
  <div class="row">
    <div class="pagi_main_wrap">
      <div class="pagi_inner_wrap">
        @if($projectInfo->lastPage() > 1)
        <div class="pagi_left_div">
          @include('layout.pagination.pagi1_settings')
        </div>
        @endif
        <div class="pagi_midd_div">
          @include('layout.pagination.pagi2_settings')
          @if($projectInfo->total() > 0)
          @include('layout.pagination.pagi3_settings')
          @endif
          @include('layout.pagination.pagi4_settings')
        </div>
        <div class="right_colset">
          @include('layout.pagination.pagi5_settings')
        </div>
      </div>
    </div>
  </div>
</div> --}}
<!-- Pagination Ends Here -->
