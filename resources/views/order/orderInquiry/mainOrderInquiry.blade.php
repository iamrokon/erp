@section('title', '受注照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注 >')
@section('menu-test5', '受注履歴一覧・受注照会')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}
</head>

{{-- Including Common Header Links Starts Here --}}
@include('order.orderInquiry.styles')
{{-- Including Common Header Links Ends Here--}}

<body class="common-nav" style="overflow-x:visible;">
  {{-- <section class=""> --}}

    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}

    {{-- Main Contents Starts Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- Content Head Section Starts Here --}}
      <div class="content-head-section">
        <div class="container">
          <div class="row order_entry_topcontent inner-top-content" >
            <div class="col">
              <!-- Content head top section start -->
              <div class="content-head-top">
                <div class="row">
                <input value="{{$bango}}" id='userId' type='hidden'/>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 78px!important;">受注区分</td>
                          <td style=" border: none!important;width: 178px;">
                              <input name="" value="@if(isset($orderInquiryFirstPart[0]->datachar02_detail)){{$orderInquiryFirstPart[0]->datachar02_detail}}@endif" type="text" autofocus="" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 53px!important;">作成区分</td>
                          <td style=" border: none!important;width: 228px">
                            <input value="@if(isset($orderInquiryFirstPart[0]->datachar01)){{$orderInquiryFirstPart[0]->datachar01}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table"
                      style="border: none!important;width: 100% !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 77px!important;">番号検索</td>
                          <td style=" border: none!important; min-width: 179px!important;">
                            <div style="width: 100% !important;">
                              <input type="text" value="@if(isset($orderInquiryFirstPart[0]->kokyakuorderbango)){{$orderInquiryFirstPart[0]->kokyakuorderbango}}@endif" class="form-control" placeholder="" readonly
                                style="width: 165px!important;">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 53px!important;">受注番号</td>
                          <td style=" border: none!important;width: 174px;">
                            <input name="" value="@if(isset($orderInquiryFirstPart[0]->kokyakuorderbango)){{$orderInquiryFirstPart[0]->kokyakuorderbango}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>

                          <td style=" border: none!important;width: 178px;">
                            <!-- <div style="width: 269px !important"> -->
                            <input type="text" value="@if(isset($orderInquiryFirstPart[0]->ordertypebango2)){{$orderInquiryFirstPart[0]->ordertypebango2}}@endif" name="" class="form-control text-right" placeholder="" readonly>
                            <!-- </div> -->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table-1" style="border: none!important;margin-bottom:13px!important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 78px!important;">受注先</td>
                          <td style=" border: none!important;width: 514px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information1_detail)){{$orderInquiryFirstPart[0]->information1_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 74px!important;">売上請求先</td>
                          <td style=" border: none!important;width: 514px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information2_detail)){{$orderInquiryFirstPart[0]->information2_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 74px!important;">最終顧客</td>
                          <td style=" border: none!important;width: 514px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information3_detail)){{$orderInquiryFirstPart[0]->information3_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">代理店1</td>
                          <td style=" border: none!important;width:571px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information4_detail)){{$orderInquiryFirstPart[0]->information4_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">代理店2</td>
                          <td style=" border: none!important;width:571px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information5_detail)){{$orderInquiryFirstPart[0]->information5_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">請求書送付先</td>
                          <td style=" border: none!important;width:571px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information6_detail)){{$orderInquiryFirstPart[0]->information6_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Content head top section end -->
              <!-- Content head bottm section start -->
              <div class="content-head-bottom">
                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form " style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 78px!important;">受注日</td>
                          <td style=" border: none!important;width: 157px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->intorder01)){{$orderInquiryFirstPart[0]->intorder01}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                          <td style="width: 32px!important;border:0!important;position: relative;">
                            <div class="td-border-line"></div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">納期</td>
                          <td style=" border: none!important;width: 160px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->intorder02)){{$orderInquiryFirstPart[0]->intorder02}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                          <td style="width: 32px!important;border:0!important;position: relative;">
                            <div class="td-border-line"></div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">検収日</td>
                          <td style=" border: none!important;width: 160px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->intorder04)){{$orderInquiryFirstPart[0]->intorder04}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                          <td style="width: 30px!important;border:0!important;position: relative;">
                            <div class="td-border-line"></div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 45px!important;">売上日</td>
                          <td style=" border: none!important;width: 161px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->intorder03)){{$orderInquiryFirstPart[0]->intorder03}}@endif @if(isset($orderInquiryFirstPart[0]->hikiatesyukko_datachar04) && $orderInquiryFirstPart[0]->hikiatesyukko_datachar04 == 1)     ※@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                          <td style="width: 30px!important;border:0!important;position: relative;">
                            <div class="td-border-line"></div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 47px!important;">入金日</td>
                          <td style=" border: none!important;width: 176px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->intorder05)){{$orderInquiryFirstPart[0]->intorder05}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-inpur-field" style="border: none!important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 77px!important;">受注件名</td>
                          <td style=" border: none!important;width: 515px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->juchukubun1)){{$orderInquiryFirstPart[0]->juchukubun1}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                          <td style=" border: none!important;width: 193px;padding-left:7px!important;">
                            <div class="input-group input-group-sm border-line-area" style="cursor: pointer;">
                              <button class="btn c_hover"
                                style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:127px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                取引条件
                              </button>
                              <div class="input-group-append">
                                <button class="input-group-text btn" id="igroup1" data-toggle="modal"
                                  data-target="#exampleModal"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;padding-left: 3px!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 43px!important;">P J</td>
                          <td style=" border: none!important;width: 438px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->datachar03_detail)){{$orderInquiryFirstPart[0]->datachar03_detail}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 78px!important;">伝票備考</td>
                          <td style=" border: none!important;width: 514px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information8)){{$orderInquiryFirstPart[0]->information8}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 75px!important;">社内備考</td>
                          <td style=" border: none!important;width: 573px;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->information7)){{$orderInquiryFirstPart[0]->information7}}@endif" type="text" class="form-control" placeholder="" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table " style="border: none!important;width: auto;">
                      <tbody>
                        <tr style="line-height: 44px; display: inline;">
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 78px!important;">注文書</td>
                          <td style=" border: none!important; min-width:158px;">
                              @if(isset($orderInquiryFirstPart[0]->file_name) && $orderInquiryFirstPart[0]->file_name!=null)
                             <a href="@if(isset($orderInquiryFirstPart[0]->file_name) && $orderInquiryFirstPart[0]->file_name!=null){{url('/uploads/order_entry').'/'.$orderInquiryFirstPart[0]->file_name}}@else{{'#'}}@endif" target="_blank"
                              style="color:#0056b3 !important;text-decoration: underline;font-weight: 600;padding-left: 13px;">@if(isset($orderInquiryFirstPart[0]->file_name_short)){{$orderInquiryFirstPart[0]->file_name_short}}@endif</a>
                              @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 58px!important;">客先注番</td>
                          <td style=" border: none!important;width: 244px;position: relative;">
                            <input value="@if(isset($orderInquiryFirstPart[0]->datachar04)){{$orderInquiryFirstPart[0]->datachar04}}@endif" type="text" class="form-control" placeholder="" readonly="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                      <tbody>
                        <tr style="height: 28px;">
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td
                            style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                            販売金額計</td>
                          <td style=" border: none!important;width: 15px!important;"></td>
                          <td
                            style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
                            @if(isset($orderInquiryFirstPart[0]->money10))
                            {{"¥ ".number_format($orderInquiryFirstPart[0]->money10)}}
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr style="height: 28px;">
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td
                            style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                            営業粗利計</td>
                          <td style=" border: none!important;width: 15px!important;"></td>
                          <td
                            style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
                            @if(isset($orderInquiryFirstPart[0]->moneymax))
                            {{"¥ ".number_format($orderInquiryFirstPart[0]->moneymax)}}
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Content head bottm section end -->
            </div>
          </div>
        </div>
      </div>
      {{-- Content Head Section Ends Here --}}

      {{-- Content Bottom Section Starts Here --}}
      <div class="content-bottom-section">
        <div class="content-bottom-top">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="bottom-top-btn" style="cursor: pointer;">
                  <span onclick="contentHideShow()" id="closetopcontent">閉じる</span>
                </div>
                <div class="bottom-top-title">
                  受注明細
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <div class="data-wrapper-content" style="width: 100%;">
                  <div class="data-box-content"
                    style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                    <div style="padding: 23px;">
                      行
                    </div>
                  </div>
                  <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                    <div style="width: 100%;float: left;">
                      <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                        style="padding: 5px; width: 10%;">
                        商品CD
                      </div>
                      <div class="data-box float-left border border-bottom-0 border-right-0"
                        style="padding: 5px; width: 35%;">
                        商品名
                      </div>
                      <div class="data-box float-left border border-bottom-0 border-right-0"
                        style="padding: 5px; width: 15%;">
                        発注日
                      </div>
                      <div class="data-box float-left border border-bottom-0 border-right-0"
                        style="padding: 5px; width: 15%;">
                        個別納期
                      </div>
                      <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 25%;">
                        納品先
                      </div>
                    </div>
                  </div>
                  <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                    <div style="width: 100%;float: left;">
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 12%;border-right: 0 !important; border-left: 0 !important;">
                        単 位
                      </div>
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 8%;border-right: 0 !important;">
                        数量
                      </div>
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 8%;border-right: 0 !important;">
                        販売単価
                      </div>
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 8%;border-right: 0 !important;">
                        販売金額
                      </div>
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 8%;border-right: 0 !important;">
                        営業粗利
                      </div>
                      <div class="data-box float-left border"
                        style="padding: 5px; width: 8%;border-right: 0 !important;">
                        S E@
                      </div>
                      <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 9%;">
                        研究所＠
                      </div>
                      <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 8%;">
                        出荷C@
                      </div>
                      <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 8%;">
                        仕入＠
                      </div>
                      <div class="data-box border border-right-0" style="padding: 5px;float: left; width: 10%;">
                        営 業
                      </div>
                      <div class="data-box border" style="padding: 5px;float: left; width: 13%;">
                        S E
                      </div>
                    </div>
                  </div>
                </div>
                <div class="data-box-content3 orderentry-databox  text-center" style="width: 100%;float: left;">
                  <div style="width: 100%;float: left;">
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 20%;border-right: 0 !important; border-left: 0 !important;">
                      商品サブCD
                    </div>
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 14%;border-right: 0 !important;">
                      出荷指示
                    </div>
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 4%;border-right: 0 !important;">
                      保 守
                    </div>
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 20%;border-right: 0 !important;">
                      仕入先
                    </div>
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 14.1%;border-right: 0 !important;">
                      メーカー品番
                    </div>
                    <div class="data-box float-left border border-top-0"
                      style="padding: 5px; width: 17.9%;border-right: 0 !important;">
                      メーカー品名
                    </div>
                    <div class="data-box float-left border border-top-0"
                    style="padding: 5px; width: 5%;border-right: 0 !important;">
                    内訳保守
                  </div>
                  <div class="data-box float-left border border-top-0"
                  style="padding: 5px; width: 5%;border-right: 0 !important;">
                  保守作成
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-bottom-bottom">
          <div class="container">

            @if(isset($orderInquiryInfo))
                @foreach($orderInquiryInfo as $key=>$val)
                @if($orderInquiryInfo[$key]->yoteimeter != 2)
                <div class="row mt-2 line-form">
                  <div class="col-12">
                    <div class="data-wrapper-content" style="width: 100%;">
                      <div class="data-box-content"
                        style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 15px 0px;height: 76px;">
                          <div style="width:100%;float:left;">
                            <div style="width:70%;float:left;color: #fff;">
                              <span>{{$orderInquiryInfo[$key]->syouhinsyu}}</span> <span>-</span> <span>{{$orderInquiryInfo[$key]->hantei}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="data-box-content2 custom-form text-center orderentry-databox"
                        style="width: 90%;float: left;">
                        <div style="width: 100%;float: left;">
                          <div class="data-box float-left" style="padding: 5px; width: 10%;">
                            <input value="{{$orderInquiryInfo[$key]->kawasename}}" type="text" class="form-control productCd productSubOrCdTarget"  id="productCd" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 35%;">
                            <div class="input-group">
                              <input value="{{$orderInquiryInfo[$key]->syouhinname}}" type="text" readonly="" class="form-control ">
                              <div class="input-group-append">
                                  <a href="#"
                                  class="btn rounded viewProductDes"
                                  style="margin-left: 4px;color: #fff;"><i
                                    class="fa fa-clone" aria-hidden="true"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 15%;">
                            <div class="input-group">
                              <input value="{{$orderInquiryInfo[$key]->dataint09}}" type="text" class="form-control" autocomplete="off" value="" placeholder=""
                                readonly="" style="width: 96px!important;">
                            </div>
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 15%;">
                            <div class="input-group">
                              <input value="{{$orderInquiryInfo[$key]->dataint10}}" type="text" class="form-control" autocomplete="off" value="" placeholder=""
                                readonly="" style="width: 96px!important;">
                            </div>
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 25%;">
                            <input value="{{$orderInquiryInfo[$key]->datachar06_detail}}" type="text" readonly="" class="form-control" value="">
                          </div>
                        </div>
                      </div>
                      <div class="data-box-content2 text-center custom-form orderentry-databox"
                        style="width: 90%;float: left;">
                        <div style="width: 100%;float: left;">
                          <div class="data-box float-left"
                            style="padding: 5px; width: 12%;border-right: 0 !important; border-left: 0 !important;">
                            <input value="{{$orderInquiryInfo[$key]->codename}}" type="text" class="form-control" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input value="{{$orderInquiryInfo[$key]->syukkasu}}" type="text" class="form-control text-right" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input type="text" readonly="" class="form-control text-right" value="{{number_format($orderInquiryInfo[$key]->dataint04)}}">
                          </div>
                          <div class="data-box float-left"
                            style="padding: 12px 0px; width: 8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                            {{number_format($orderInquiryInfo[$key]->dataint11)}}
                          </div>
                          <div class="data-box float-left vertical-line"
                            style="padding: 12px 0px; width: 8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                            {{number_format($orderInquiryInfo[$key]->dataint12)}}
                          </div>
                          <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input value="{{number_format($orderInquiryInfo[$key]->dataint05)}}" type="text" class="form-control text-right" placeholder="" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px;float: left; width: 9%;">
                            <input value="{{number_format($orderInquiryInfo[$key]->dataint06)}}" type="text" class="form-control text-right" placeholder="" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
                            <input value="{{number_format($orderInquiryInfo[$key]->dataint07)}}" type="text" class="form-control text-right" placeholder="" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
                            <input value="{{number_format($orderInquiryInfo[$key]->dataint08)}}" type="text" class="form-control text-right" placeholder="" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
                            <input value="{{$orderInquiryInfo[$key]->tuhan_datachar01}}" type="text" class="form-control" placeholder="" readonly="">
                          </div>
                          <div class="data-box float-left" style="padding: 5px;float: left; width: 13%;">
                            <input value="{{$orderInquiryInfo[$key]->tuhan_datachar02}}" type="text" class="form-control" placeholder="" readonly="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="data-box-content3 custom-form orderentry-databox  text-center"
                      style="width: 100%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left"
                          style="padding: 5px; width: 20%;border-right: 0 !important; border-left: 0 !important;">
                          <div class="input-group">
                            <input value="{{$orderInquiryInfo[$key]->barcode}}" type="text" readonly="" class="form-control productSubOrCdTarget productSubCd"  id="productSubCd">
                            <div class="input-group-append">
                                <a href="#"
                                class="btn rounded viewProductDes"
                                style="margin-left: 4px;color: #fff;"><i
                                  class="fa fa-clone" aria-hidden="true"></i></a>
                            </div>
                          </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 14%;border-right: 0 !important;">
                          <div class="input-group">
                            <input value="{{$orderInquiryInfo[$key]->shipping_instruction}}" type="text" class="form-control" value="">
                            <div class="input-group-append">
                                @php
                                $shipping_arr = ['datachar07'=>$orderInquiryInfo[$key]->datachar07,'datachar08'=>$orderInquiryInfo[$key]->datachar08,'datachar09'=>$orderInquiryInfo[$key]->datachar09,'datachar15'=>$orderInquiryInfo[$key]->datachar15,'datachar16'=>$orderInquiryInfo[$key]->datachar16,'datachar17'=>$orderInquiryInfo[$key]->datachar17,'datachar21'=>$orderInquiryInfo[$key]->datachar21];
                                @endphp
                                <button type="button" onclick="shippingInstrationDetails('{{json_encode($shipping_arr)}}',event.preventDefault())" class="btn btn-outline-secondary"
                                style="color: white;"><i class="fa fa-arrow-left"
                                  aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 4%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->datachar12_detail}}" type="text" class="form-control" placeholder="" readonly="">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 20%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->datachar05_detail}}" type="text" readonly="" class="form-control" value="">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 14.1%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->manufacturer_part_num}}" type="text" class="form-control" placeholder="" readonly="">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 17.9%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->manufacturer_product_name}}" type="text" class="form-control" placeholder="" readonly="">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->breakdown_maintenance}}" type="text" class="form-control" placeholder="" readonly="">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
                          <input value="{{$orderInquiryInfo[$key]->maintenance_creation}}" type="text" class="form-control" placeholder="" readonly="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endif

                @endforeach
            @endif



          </div>
        </div>
      </div>
      {{-- Content Bottom Section Ends Here --}}
    </div>
    {{-- Main Contents Ends Here --}}

    {{-- Navbar Starts Here --}}
    @include('layout.footer_new')
    {{-- Navbar Ends Here --}}

  {{-- </section> --}}

  <!-- Product Details Modal Starts Here -->
  @include('order.order-entry.include.product_description_detail_page')
  <!-- Product Details Modal Ends Here -->

  <!-- Product Sub Details Modal Starts Here -->
  @include('order.orderInquiry.productSubDetailsModal')
  <!-- Product Sub Details Modal Ends Here -->

  <!-- Transaction Terms Modal Starts Here -->
  @include('order.orderInquiry.transactionTermsModal')
  <!-- Transaction Terms Modal Ends Here -->

  <!-- Example Modal 1 Starts Here -->
  @include('order.orderInquiry.shippingInstractionModal')
  <!-- Example Modal 1 Ends Here -->

<!-- Alert Modal Starts Here -->
  @include('order.order-entry.alert_modal')
  <!-- Alert Modal Ends Here -->

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  {{-- Knockout - Enter to New Input Starts Here --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
              $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trfocus', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trfocus').filter(':visible');
              var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
              next = focusable.eq(nextIndex);
              next.focus();
              return false;
            }
            if (e.keyCode == 9) {
              e.preventDefault();
            }
          });
        }
      };
      ko.applyBindings({});
  </script>
  {{-- Knockout - Enter to New Input Ends Here --}}

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var orderInquiry = document.createElement("script");
    orderInquiry.type = "text/javascript";
    orderInquiry.src = "{{ asset('js/order/order_inquiry/orderInquiry.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(orderInquiry);
  </script>
  <script type="text/javascript">
    var productDescriptionDetail = document.createElement("script");
    productDescriptionDetail.type = "text/javascript";
    productDescriptionDetail.src = "{{ asset('js/order/order_entry/product_description_detail.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(productDescriptionDetail);
  </script>
  <!-- Hard reload js link ends here -->

  <!-- Content top hide show js start -->
  <script type="text/javascript">
    $(document).ready(function(){
        $("#closetopcontent").click(function(){
          $(".order_entry_topcontent").toggle();
          $('.content-bottom-section').css('margin-top',38);
        });
      });
      function contentHideShow() {
       var hideShow = document.getElementById("closetopcontent");
       if (hideShow.innerHTML === "閉じる") {
         hideShow.innerHTML = "開く";
       } else {
         hideShow.innerHTML = "閉じる";
       }
      }
  </script>
  <!-- Content top hide show js end -->

  <!-- file name show in input area... -->
  <script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

      //Enter press hide dropdown...
      $(".input_field").keydown(function(e){
        if(e.keyCode == 13) {
          $(".input_field").datepicker('hide');
        }
      });
  </script>
</body>

</html>
