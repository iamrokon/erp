<style type="text/css">
  .pl-m {
    padding-left: 0px;
  }

  .text-c-right {
    float: right;
  }

  @media (max-width: 991px) {

    .text-c-right {
      float: left !important;
    }
  }

  @media only screen and (max-width: 767px) {

    .pl-m {
      padding-left: 15px;
    }

    .text-c-right {
      float: left !important;
    }
  }
</style>

<div class="row mt-2">
  <div class="col-lg-12 col-sm-12">
    <div class="hover_message" style="display: block; height: 15px; color: red"></div>
    <!-- <div class="hover_message"></div> -->
  </div>
</div>
<div class="row mt-3">
  <div class="col-lg-8 col-sm-12 m-pd ">
    <div class="responsive button-responsive-view">
      <div class="row">
        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 text-center">
          <div style="cursor: pointer;">
            <button href="#" message="@if(array_key_exists('search', $buttonMessage)){{$buttonMessage['search']}}@endif"
              class="btn btn-info btn-m-view message_content" onclick="Thesearch();" style="width: 100%;"><i
                class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索
            </button>
          </div>

        </div>
        <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m  text-center">
          <div style="cursor: pointer;">
            <a href="#" message="@if(array_key_exists('refresh', $buttonMessage)){{$buttonMessage['refresh']}}@endif"
              class="btn btn-info btn-m-view message_content" type="button" style="width: 100%;height: 28px;"
              onclick="refresh()">一覧</a>
          </div>
        </div>
        <div class="col-lg-2 col-6 col-sm-3 col-xs-6 padd-0 text-center">
          <div style="cursor: pointer;">
            <a href="#" message="@if(array_key_exists('insert', $buttonMessage)){{$buttonMessage['insert']}}@endif"
              class="btn btn-info btn-m-view message_content" style="width: 100%;" @if(isset($deleted_item) &&
              $deleted_item==0) onclick="openRegistration()" @endif>新規登録</a>
          </div>
        </div>

        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m text-center ">
          <div style="cursor: pointer;">
            <button href="#" message="@if(array_key_exists('ecxel', $buttonMessage)){{$buttonMessage['ecxel']}}@endif"
              onclick="excelDownload()" id="excelDwld" class="btn btn-info btn-m-view message_content"
              style="width: 100%;">EXCEL作成
            </button>
          </div>
        </div>
        <!--    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m " >
                                       <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="btnchk1" name="chkboxinp" onclick="refresh()" value="1" @if(isset($deleted_item)?($deleted_item == 1):false) checked="checked" @endif>
                                    <label class="custom-control-label margin_btn_17" for="btnchk1" style="line-height: 25px;">削除データ表示</label>
                                    </div>
                                     </div> -->

        @if($tantousya->innerlevel <= 10) 
        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m">
          <label class="checkbox_container mt-1 ml-1 message_content" for="lblchk1"
            message="@if(array_key_exists('delete_dt_display', $buttonMessage)){{$buttonMessage['delete_dt_display']}}@endif">削除データ表示
            <input type="checkbox" class="checkAllCheckbox" id="lblchk1" name="chkboxinp" value="1" onclick="refresh()"
              @if(isset($deleted_item)?($deleted_item==1):false) checked="checked" @endif>
            <span class="checkmark"></span>
          </label>

          {{-- <div class="custom-control custom-checkbox custom-control-inline" style="padding-left: 20px !important;">

            <input type="checkbox" id="lblchk1" name="chkboxinp" value="1" onclick="refresh()"
              class="custom-control-input " @if(isset($deleted_item)?($deleted_item==1):false) checked="checked" @endif>


            <label
              message="@if(array_key_exists('delete_dt_display', $buttonMessage)){{$buttonMessage['delete_dt_display']}}@endif"
              class="custom-control-label margin_btn_17 message_content" for="lblchk1"
              style="line-height: 25px;">削除データ表示</label>

          </div> --}}
      </div>
      @endif


    </div>
  </div>


</div>
<div class="col-md-4 col-lg-4">
  @php
  $uri = Route::current()->uri();
  @endphp

  @if($uri === "company")
  <div class="mt-2 text-c-right"><a href="{{url('/logfile/会社マスタ.csv')}}?a={{rand(9,9999)}}">履歴CSVダウンロード </a></div>
  @elseif($uri === "office")
  <div class="mt-2 text-c-right"><a href="{{url('/logfile/事業所マスタ.csv')}}?a={{rand(9,9999)}}">履歴CSVダウンロード </a></div>
  @endif
</div>
</div>