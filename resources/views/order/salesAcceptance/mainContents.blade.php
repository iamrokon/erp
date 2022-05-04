<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

  <!-- content head section start -->
  <div class="preloader">
    <div class="loading" style="display: none"></div>
  </div>
  <!--/.preloader-->
  <div class="content-head-section">
    <div class="container" style="position: relative;">
      {{-- <div class="row" style="position: absolute; top: 55px;">
        <div class="col-12">
          <div class="customalert" style="padding:10px; margin-bottom: 0px;background: #e6e6ff;color: #3333FF;border-radius: 4px;display: none;">
            <span class="close alertclose" style="color: #3333FF;">
              <span aria-hidden="true">&times;</span>
            </span>
            <strong>作成しました</strong>
          </div>
        </div>
      </div> --}}
      
      {{-- Success Message Starts Here --}}
      <div class="row success-msg-box" style="position: relative; width: 100%;max-width: 1452px;z-index: 1;">
        <div class="col-12">
          <div class="alert alert-primary alert-dismissible" id="msgFromBack" style="display: none;">
            <button type="button" class="close dismissAlertMessage" autofocus>&times;</button>
            <strong id="msgFromJs"></strong>
          </div>
        </div>
      </div>
        {{-- Success Message Ends Here --}}

        <script>
          $(".dismissAlertMessage").click(function (){
            // $('#msgFromBack').hide();
            closeMsg();
            $('.categorikanri').focus();
          });
          $(".dismissAlertMessage").keydown(function (e){
            if (e.shiftKey && e.which == 13) {
              $('#msgFromBack').hide();
              $('.categorikanri').focus();
              e.preventDefault();
              $('.categorikanri').click();
            }
          });
        </script>

      <input type="hidden" id="review_date" name="review_date" value="{{$review_date}}">
      <form action="" method="post" id="searchForm">

        @csrf

        <input type="hidden" name="userId" value="{{$bango}}">

        {{-- Error Message Starts Here --}}
        <div id="err_msg" class="common_error"></div>
        {{-- Error Message Ends Here --}}

        <div class="content-head-top inner-top-content" style="margin-bottom:0px;border-bottom: 1px solid #E1E1E1;padding-bottom: 17px;">
        <div class="row ">
          <div class="col-4">
            <table class="table custom-form " style="border: none!important;width: auto;">

              <tbody>
                <tr>
                  <td style="width: 5%!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;width: 10%!important;">事業部<span style="color: red;"> ※</span></td>
                  <td style=" border: none!important;width: 75%;">
                    <div class="custom-arrow">
                      <select class="form-control categorikanri" name="datatxt0003" style="width:100%;" autofocus="" id="datatxt0003" onchange="filterdatatxt0003()">

                        @foreach($datatxt0003 as $value)
                        <option value="{{$value->category1}}{{$value->category2}}" @if($value->category1 == ($personal_datatxt0003->category1??null) && $value->category2 == ($personal_datatxt0003->category2??null)) selected @endif>{{substr($value->category2,-2)}}
                          {{$value->category4}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 5%!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;width: 10%!important;">部</td>
                  <td style=" border: none!important;width: 75%;">
                    <div class="custom-arrow">
                      <select class="form-control" style="width:100%;" id="datatxt0004" onchange="filterdatatxt0004()" name="datatxt0004">
                        <option value="">-</option>
                        @foreach($datatxt0004 as $value)
                        <option class="datatxt0004" value="{{$value->category1}}{{$value->category2}}" @if($value->category1 == ($personal_datatxt0004->category1??null) && $value->category2 == ($personal_datatxt0004->category2??null)) selected @endif>
                          {{substr($value->category2,-1)}} {{$value->category4}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 5%!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;width: 10%!important;">グループ</td>
                  <td style=" border: none!important;width: 75%;">
                    <div class="custom-arrow">
                      <select id="datatxt0005" name="datatxt0005" onchange="filterdatatxt0005()" class="form-control" style="width:100%;">
                        <option value="">-</option>
                        <!--@foreach($datatxt0005 as $value)
                        <option value="{{$value->category1}}{{$value->category2}}" @if($value->category1 == ($personal_datatxt0005->category1??null) && $value->category2 == ($personal_datatxt0005->category2??null)) selected @endif>{{substr($value->category2,-1)}}
                          {{$value->category4}}
                        </option>
                        @endforeach-->
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td rowspan="3" style="width: 5%!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="width: 10%!important;border: none!important;text-align: left;color: black;">担当者</td>
                  <td style="width: 62%!important;border: 0px!important;">
                    <div class="custom-arrow">
                      <select id="usersoption" class="form-control left_select" style="width: 54%;" name="employee">
                        <option value="">-</option>
                        @foreach($tantousyas as $value)
                        <option value="{{$value->bango}}" @if($tantousya->bango == $value->bango) selected @endif>{{$value->bango}} {{$value->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            {{-- <table class="table custom-form " style="border: none!important;width: auto;">
              <tbody>
                <tr>
                  <td rowspan="3" style="width: 5%!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="width: 10%!important;border: none!important;text-align: left;color: black;">担当者</td>
                  <td style="width: 62%!important;border: 0px!important;">
                    <div class="custom-arrow">
                      <select id="usersoption" class="form-control left_select" style="width: 54%;" name="employee">
                        <option value="">-</option>
                        @foreach($tantousyas as $value)
                        <option value="{{$value->bango}}" @if($tantousya->bango == $value->bango) selected @endif>{{$value->bango}} {{$value->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table> --}}
          </div>
          <div class="col-4">
            <!--  table part 2 -->
            <table class="table custom-form" style="margin-bottom: 0px!important;">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="width: 70px!important;border: none!important;text-align: left;color: black;">対象選択<span style="color: red;"> ※</span></td>
                  <td style="border: none!important;">
                    <div class="custom-arrow">
                      <select class="form-control left_select" name="datachar02">
                        <option value="U110/U111/U121/U150/U160/U180/U181">保守以外</option>
                        <option value="U120/U122">保守のみ</option>
                        <option value="U110/U111/U120/U121/U122/U150/U160/U180/U181">すべて</option>
                      </select>
                    </div>
                  </td>
                  <td style="border: none!important;"></td>
                </tr>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="width: 83px!important;border: none!important;text-align: left;color: black;">売上年月<span style="color: red;"> ※</span></td>
                  <td style="border: none!important;">
                    <input type="text" name="salesDateFrom" id="from" class="form-control" placeholder="年/月" autocomplete="off" oninput="checkTheUpperDate(),this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="7" value="<?php echo date('Y/m'); ?>">
                    <input type="hidden" class="datePickerHidden">
                  </td>
                  <td style="border: none!important;width: 38px!important;text-align: left;">～</td>
                  <td style="border: none!important;">
                    <input type="text" name="salesDateTo" id="to" class="form-control" placeholder="年/月" autocomplete="off" oninput="checkTheUpperDate(),this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="7" value="<?php echo date('Y/m'); ?>">
                    <input type="hidden" class="datePickerHidden">
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-radiobtn-controll">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="width: 30px!important;border: none!important;text-align: left!important;color: black;">
                    <div style="width: 65px !important">指示検印<span style="color: red;"> ※</span></div>
                  </td>
                  <td style="border: none !important;">
                    <div class="radio-rounded  d-inline-block">
                      <div id="r5" class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="amount_radio1" name="status" class="custom-control-input" value="1" checked="">
                        <label class="custom-control-label" for="amount_radio1" style=""><span style="display: inline-block;margin-top: 2px;">未指示</span></label>
                      </div>
                    </div>
                  </td>
                  <td style="border: none !important;">
                    <div class="radio-rounded  d-inline-block">
                      <div id="r6" class="custom-control custom-radio custom-control-inline ">
                        <input type="radio" id="amount_radio2" name="status" class="custom-control-input" value="2" tabindex="1">
                        <label class="custom-control-label" for="amount_radio2"><span style="margin-top: 2px;display: inline-block;">指示済</span></label>
                      </div>
                    </div>
                  </td>
                  <td style="border: none !important;">
                    <div style="margin-left: -23px !important">
                      <div class="radio-rounded  d-inline-block">
                        <div id="r7" class="custom-control custom-radio custom-control-inline ">
                          <input type="radio" id="amount_radio3" name="status" class="custom-control-input" value="3" tabindex="1">
                          <label class="custom-control-label" for="amount_radio3" style=""><span style="margin-top: 2px; display: inline-block;">検印済</span></label>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;text-align: left!important;color: black;">
                    <div>管理確認</div>
                  </td>
                  <td style="border: none !important;">
                    <div style="width: 50px">
                      <div class="radio-rounded  d-inline-block">
                        <div id="r1" class="custom-control custom-radio custom-control-inline mt-1" style="">
                          <input type="radio" id="deposit_classi_unit_radio" name="managementConfirm" class="custom-control-input" value="2" tabindex="1" checked="">
                          <label class="custom-control-label" for="deposit_classi_unit_radio"><span style="padding-top: 2px;display: block;">未確認</span></label>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td style="border: none !important;">
                    <div class="radio-rounded  d-inline-block">
                      <div id="r2" class="custom-control custom-radio custom-control-inline mt-1">
                        <input type="radio" id="order_no_unit_radio" name="managementConfirm" class="custom-control-input" value="1" tabindex="1">
                        <label class="custom-control-label" for="order_no_unit_radio"><span style="padding-top: 2px;display: block;">確認済</span></label>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="content-head-top" style="margin-bottom:0px;border-bottom: 1px solid #E1E1E1;padding-bottom: 17px;padding-top: 17px;">
        <div class="row">
          <div class="col-6"></div>
          <div class="col-6 margin_b">
            <div class="margin_t">
              <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
                <tbody>
                  <tr>
                    <td style=" width: 64px!important;padding: 0px!important;border: none!important;"><a id="shitanoformsubmit" href="#" onclick="validateBeforeSearch()" class="btn btn-info uskc-button" style="margin-right: 5px !important;" type="button">表　示
                      </a>
                    </td>
                    <td style=" border: none!important;padding: 0px!important;"><button id="contenthide" href="#" disabled="disable" class="btn btn-info uskc-button">検収書再作成
                      </button>
                    </td>
                    {{-- <td style="border: none !important;">
                      <div class="loading-icon" style="display: none;">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </td> --}}
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
      </form>
    </div>
  </div>
  <!-- content head section end -->

  <!-- content bottom section start -->
  <div class="content-bottom-section">
    <div class="content-bottom-top">
      <div class="container">
        <div class="row" style="margin-top: 6px;">
          <div class="col">
            <div class="bottom-top-title" style="letter-spacing: 4px;">
              売 上 検 収 明 細
            </div>
          </div>
        </div>
       
        {{-- Pagination Starts Here --}}
        <div class="wrapper-pagination" id="pagination_div" style="background-color:#fff;height:87px;padding: 10px; display:none;">
          <div class="row mb-1">
            <div class="col-7">
              <div class="pagi-content mt-3">
                <table>
                  <tbody>
                    <tr>
                      <td class="" style="padding-left:0px!important;border: none !important;">
                        <div class="pagi" style="float: left;">
                          <div class="nav_mview">
                            <nav aria-label="Page navigation example ">
                              <ul class="pagination">
                                <li class="page-item" style="padding-right: 3px;">
                                  <a class="page-link" href="#" aria-label="Previous" onclick="goBackSales()" 
                                    style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color:white !important;">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <li class="w_50 ">
                                  <input type="text" name="page" id="paginate"
                                    class="form-control intLimitTextBox text-center input_pagi" value="0"
                                    style="margin-top: 0px;height: 27px!important;border-radius: 4px!important;"
                                    onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))">
                                </li>
                                <li class="page-item" style="padding-left: 3px!important;">
                                  <a class="page-link" href="#" onclick="goToSales()" 
                                    style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;;border-radius: 4px!important;color: white !important;">=</a>
                                </li>
                                <li class="page-item" style="padding-left: 3px!important;">
                                  <a class="page-link" href="#" aria-label="Next" onclick="goForwardSales()" 
                                    style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color: white !important;">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 pl-2 pr-2" style="border:none!important;">情報総数 <span id="total_data"></span></td>
                      <td class="p-2 pl-2 pr-2" style="border:none!important;">表示範囲<span id="from_data"></span>～<span id="to_data"></span></td>
                      <td class="p-2 pl-2 pr-2" style="border:none!important;">ページ総数 <span id="total_page"></span> &nbsp;&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        {{-- Pagination Ends Here --}}        
    
        <div class="row mt-1">
          <div class="col-12">
            <div class="data-wrapper-content" style="width: 100%;">
              <div class="data-box-content" style="width: 5%; float: left;background-color:#666666;text-align: center;color:#fff;height: 98px !important; vertical-align: middle;border-radius: 5px 0px 5px;">
                <div style="padding: 39px 0px;">
                  行
                </div>
              </div>
              <div class="data-box-content2 text-center orderentry-databox" style="width: 95%;float: left;">
                <div style="width: 100%;float: left;">
                  <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px; width: 22%;">
                    受注番号
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 26%;">
                    受注先
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 26%;">
                    売上請求先
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 26%;">
                    最終顧客
                  </div>
                </div>
              </div>
              <div class="data-box-content2 text-center orderentry-databox" style="width: 95%;float: left;">
                <div style="width: 100%;float: left;">
                  <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px; width: 40%;">
                    受注件名
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 13%;">
                    販売金額計
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 13%;">
                    営業粗利計
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 10%;">
                    検収書
                  </div>
                  <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 24%;">
                    検収確認書PDFアップロード
                  </div>
                </div>
              </div>
              <div class="data-box-content2 text-center orderentry-databox" style="width: 95%;float: left;">
                <div style="width: 100%;float: left;">
                  <div class="data-box float-left border" style="padding: 4px; width: 24%;border-right: 0 !important; border-left: 0 !important;">
                    受注日
                  </div>
                  <div class="data-box float-left border" style="padding: 4px; width: 14%;border-right: 0 !important;">
                    検収日
                  </div>
                  <div class="data-box float-left border" style="padding: 4px; width: 15%;border-right: 0 !important;">
                    売上日
                  </div>
                  <div class="data-box float-left border" style="padding: 4px; width: 11%;border-right: 0 !important;">
                    入金日
                  </div>
                  <div class="data-box float-left border" style="padding: 4px; width: 12%;border-right: 0 !important;">
                    即締
                  </div>
                  <div class="data-box float-left border" style="padding: 4px; width: 12%;border-right: 0 !important;">
                    <div style="width: 45px;float: left;text-align: left;">指検</div>
                    <div class="custom-arrow" style="width: 64px;float: left;">
                      <select id="referTo" class="form-control left_select" style="border: 1px solid #e1e1e1 !important;border-radius: 4px !important;height: 22px !important;" onchange="changeAllchild($(this))">
                        <option value="1">未</option>
                        <option value="2">指示</option>
                        <option value="3">検印</option>
                      </select>
                    </div>
                  </div>
                  <div class="data-box border  border-right-0" style="padding: 4px;float: left; width: 12%;">
                    管理
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="content-bottom-bottom">
      <form action="" method="post" enctype='multipart/form-data' id="orderForm">
        @csrf
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="userId" value="{{$bango}}">
        <div class="container">
          <div id="orderRows">
            @include('order.salesAcceptance.orderDetail')
          </div>
          <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6 ">
              <div class="float-right mt-4">
                <button id="ordersubmit" type="button" onclick="submitOrders()" onkeypress="" class="btn btn-info disable uskc-button">登　録</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- content bottom section end -->
</div>