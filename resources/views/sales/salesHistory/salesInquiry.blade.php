@section('page_title', '売上履歴一覧・売上照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', ' 売上履歴一覧・売上照会')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">
  <head>
    @include('layout.head_link')
  </head>
  <style>
    .custom-table-1 {
      position: relative;
    }
    .custom-table-1:after {
      content: '';
      position: absolute;
      background: #D0D0D0;
      width: 1px;
      height: 90px;
      right: -15px;
      top: 3px;
    }
    .custom-form .input-group-sm .form-control {
      background: #EFEFEF;
      padding: 0px!important;
    }
    .tag-line {
      margin-bottom: 13px;
      font-size: 12px;
    }
    .form-button {
      background: #fff;
      padding: 10px;
      text-align: center;
      border-radius: 5px;
    }
    .form-button .btn {
      width: 163px;
    }
    .form-button .btn-success {
      background: #009943;
    }
    .form-button .btn-primary {
      background: #2C66B0;
    }
    select:focus option {
      outline: none;
      -moz-appearance: none;
      -webkit-appearance: none;
    }

    .form-control:focus option {
      outline: none;
      -moz-appearance: none;
      -webkit-appearance: none;
    }

    .w-145 {
      width: 145px;
    }

    .border-line-area {
      position: relative;
    }

    .border-line-area:before {
      position: absolute;
      right: 9px;
      height: 26px;
      background: #D0D0D0;
      width: 1px;
      content: '';
    }

    .margin_t {
      margin-top: 13px !important;
    }

    .outer {
      border-bottom: 1px solid #e1e1e1;
      padding: 15px 0px 14px;
    }

    .modal-data-box .table td,
    .table th {
      padding: .75rem;
      vertical-align: top;
      border-top: 0;
      border-bottom: 1px solid #141855 !important;
      color: #fff;
    }

    .modal-data-box .modal-inner.table td,
    .modal-data-box .modal-inner.table th {
      position: relative;
    }

    .modal-data-box .modal-inner.table td:after,
    .modal-data-box .modal-inner.table th:after {
      content: '';
      position: absolute;
      background: #D7D7D7;
      width: 1px;
      height: 15px;
      right: 0px;
      top: 18px;
    }

    .modal-data-box .modal-inner.table td,
    .table th {
      padding: .75rem;
      vertical-align: top;
      border-top: 0;
      border-bottom: 1px solid #dee2e6;
    }

    .modal-data-box .form-control {
      height: 28px;
      padding: 0px;
      vertical-align: middle;
      line-height: 22px;
      margin: 0px;
    }

    .modal-data-box .line-icon-box {
      background: #bbbbbb;
    }

    .square-title .line-icon-box {
      background: #bbbbbb;
    }

    .line-icon-box {
      height: 14px;
      width: 14px;
      background: #363A81;
      border-radius: 3px;
      float: left;
      margin-right: 10px;
    }

    .modal-data-box .form-control {
      border-radius: 3px !important;
    }

    .modal-data-box .modal-inner.table td:after,
    .modal-data-box .modal-inner.table th:after {
      content: '';
      position: absolute;
      background: #D7D7D7;
      width: 1px;
      height: 15px;
      right: 0px;
      top: 7px;
    }

    .bg-blue {
      background: #363A81 !important;
    }

    .order_entry_topcontent .input-group-append,
    .data-wrapper-content .input-group-append {
      cursor: pointer;
    }

    .custom-arrow select::-ms-expand {
      display: none;
    }

    .custom-arrow select {
      -webkit-appearance: none;
    }

    .td-border-line:after {
      content: '';
      position: absolute;
      background: #D0D0D0;
      width: 1px;
      height: 26px;
      left: 15px;
      top: 3px;
    }

    .orderentry-databox .data-box {
      background: #fff;
      font-size: 0.8em;
    }

    .vertical-line {
      position: relative;
    }

    .vertical-line:after {
      position: absolute;
      left: 0;
      top: 12px;
      width: 1px;
      height: 15px;
      content: '';
      background: #ddd;
    }

    .close:hover,
    .close:focus {
      outline: 0;
    }

    .custom-data-modal .bg-white {
      background: #fff !important;
    }
  </style>
  <body style="overflow-x:visible;">
    <section class="">
      @include('layout.nav_fixed')
      <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <!-- Content head section start -->
        <div class="content-head-section">
          <div class="container">
            <div class="row order_entry_topcontent" style="margin-top: 35px;">
              <div class="col">
                <!-- Content head top section start -->
                <div class="content-head-top">
                  <div class="row">
                    <div class="col">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 68px!important;">売上区分</td>
                            <td style=" border: none!important;width: 178px;">
                              <input autofocus="" type="text" name="" class="form-control" placeholder="10 売上" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 53px!important;">作成区分</td>
                            <td style=" border: none!important;width: 178px">
                              <input type="text" name="" class="form-control" placeholder="1 新規作成" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col">
                      <table class="table custom-form" style="border: none!important;width: 100% !important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 53px!important;">売上番号</td>
                            <td style=" border: none!important; min-width: 179px!important;">
                              <div style="width: 100% !important;">
                                <input type="text" class="form-control" placeholder="0950123456" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col">
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 67px!important;">受注番号</td>
                            <td style=" border: none!important;width: 178px;">
                              <!-- <div style="width: 269px !important"> -->
                              <div style="border: 1px solid #E1E1E1 !important;background-color: #e9ecef;padding: 5px;border-radius: 4px;padding-left: 0px;"><a style="color:#0056b3;text-decoration:underline;" target="_blank" href="{{url('/order_inquiry')}}">0150123456</a></div>
                              <!-- </div> -->
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <table class="table custom-form" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 64px!important;">受注先</td>
                            <td style=" border: none!important;width: 84%;">
                              <input type="text" class="form-control" placeholder="NNNNN/NNNNN/NNNNN" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 64px!important;">売上請求先</td>
                            <td style=" border: none!important;width: 84%;">
                              <input type="text" class="form-control" placeholder="NNNNN/NNNNN/NNNNN" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 64px!important;">最終顧客</td>
                            <td style=" border: none!important;width: 84%;">
                              <input type="text" class="form-control" placeholder="NNNNN/NNNNN/NNNNN" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table custom-form " style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 64px!important;">受注日</td>
                            <td style=" border: none!important;width: 150px;">
                              <input type="text" class="form-control" placeholder="2020/10/10" readonly="">
                            </td>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box ml-4"></div>
                            </td>
                            <td style=" border: none!important;width: 45px!important;">売上日</td>
                            <td style=" border: none!important;width: 150px;">
                              <input type="text" class="form-control" placeholder="2020/10/10" readonly="">
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 64px!important;">入金方法</td>
                            <td style=" border: none!important;width: 150px;">
                             <div class="custom-arrow">
                                  <select class="form-control" name="" id="">
                                  <option value="">04 小切手入金</option>
                                  <option value="">04 小切手入金</option>
                              </select>
                            </div>
                            </td>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box ml-4"></div>
                            </td>
                            <td style=" border: none!important;width: 45px!important;">入金日</td>
                            <td style=" border: none!important;width: 150px;">
                              <input type="text" class="form-control" placeholder="2020/10/10" readonly="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                          <table class="table custom-form" style="border: none!important;width: 255px;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求書番号</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="1250123456" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-12">
                          <table class="table custom-form" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求書送付先</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="ＮＮＮＮＮ／ＮＮＮＮＮ／ＮＮＮＮＮ" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-9" style="border-right: 1px solid #D0D0D0;">
                          <table class="table custom-form vertical" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">担当</td>
                                <td style=" border: none!important;width: ">
                                  <input type="text" class="form-control" placeholder="0275 小川卓也" readonly style="width: 50%;">
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求日</td>
                                <td style=" border: none!important;">
                                  <div class="d-flex">
                                    <div style="width: 50%">
                                    <input type="text" class="form-control" placeholder="2020/10/10" readonly style=" border-top-right-radius: 0px !important;border-bottom-right-radius: 0px !important;">
                                  </div>
                                  <div class="custom-arrow" style="width: 50%;">
                                    <select class="form-control" name="" id="" style="border-radius: 0px !important;">
                                    <option value="">1 即時</option>
                                    <option value="">1 即時</option>
                                      </select>
                                  </div>
                                   <div style="width: 50%">
                                    <input type="text" class="form-control" placeholder="浦本悦" readonly style="border-top-left-radius: 0px !important; border-bottom-left-radius: 0px !important;">
                                  </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style=" border: none!important;width: 77px!important;">請求課税区分</td>
                                <td style=" border: none!important;">
                                  <input type="text" class="form-control" placeholder="10 １０％" readonly style="width: 50%;">
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-3">
                          <table class="table custom-form" style="border: none!important;width: auto;">
                            <tbody>
                              <tr>
                                <td style=" border: none!important;width: 77px!important;">売上→会計</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="1 済" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 77px!important;">指定納品書</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="0 未" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 77px!important;">請求書メール</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="1 済" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td style=" border: none!important;width: 77px!important;">入金</td>
                                <td style=" border: none!important;width: 82%;">
                                  <input type="text" class="form-control" placeholder="1 済" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <table class="table mt-2 custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 77px!important;">伝票備考</td>
                              <td style=" border: none!important;width: 82%;">
                                <input type="text" class="form-control" placeholder="NNNNNNNNNNNNNNNNNNN" readonly>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                    <div class="col-6">
                      <table class="table mt-2 custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td style=" border: none!important;width: 77px!important;">社内備考</td>
                              <td style=" border: none!important;width: 82%;">
                                <input type="text" class="form-control" placeholder="NNNNNNNNNNNNNNNNNNN" readonly>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
                      <table class="table custom-form" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">販売金額計</td>
                            <td style=" border: none!important;width: 15px!important;"></td>
                            <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">¥ 999,999,999</td>
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
        <!-- Content head section end -->
        <!-- Content bottom section start -->
        <div class="content-bottom-section">
          <div class="content-bottom-top">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title" style="letter-spacing: 0px;">
                    売　上　明　細
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                      <div style="padding: 23px;">
                        行
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px; width: 120px;">
                          商品CD
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 519px;">
                          商品名
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 80px;">
                          数
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 80px;">
                          単位
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 100px;">
                          販売単価
                        </div>
                        <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 100px;">
                          販売金額
                        </div>
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border" style="padding: 5px; width: 799px;border-right: 0 !important; border-left: 0 !important;">
                          明細備考
                        </div>
                        <div class="data-box float-left border" style="padding: 5px; width: 100px;border-right: 0 !important;">
                          製品区分
                        </div>
                        <div class="data-box float-left border" style="padding: 5px; width: 100px;border-right: 0 !important;">
                          事業分類
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content-bottom-bottom">
            <div class="container">
              <div class="row mt-2">
                <div class="col-12">
                  <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                      <div style="padding: 23px;">
                        1-0
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0 text-left" style="padding: 5px; width: 120px;background: #e9ecef;">
                          12345
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-left" style="padding: 5px; width: 519px;background: #e9ecef;">
                          Ａｕｔｏメール名人開発版Ｖｅｒ０６．０．０（１年ＬＳ）
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-right" style="padding: 5px; width: 80px;background: #e9ecef;">
                          99,999
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-left" style="padding: 5px; width: 80px;background: #e9ecef;">
                          一式
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-right" style="padding: 5px; width: 100px;background: #e9ecef;">
                          999,999,999
                        </div>
                        <div class="data-box float-left border text-right border-bottom-0" style="padding: 5px; width: 100px;background: #e9ecef;">
                          999,999,999
                        </div>
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 799px;border-right: 0 !important; border-left: 0 !important;background: #e9ecef;">
                          ＮＮＮＮＮＮＮＮＮＮ
                        </div>
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 100px;border-right: 0 !important;background: #e9ecef;">
                          製品
                        </div>
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 100px;border-right: 0 !important;background: #e9ecef;">
                          10 RPA
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="buttom-btn text-right mt-4">
                          <button class="btn btn-info"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;">
                    </i>登録</button>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Content bottom section end -->
        @include('layout.footer')
    </section>
    <!-- Details modal start here -->
    <div class="modal" data-keyboard="false" data-backdrop="static" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="development_page_top_table heading_mt" style="margin:11px;">
              <!--======================= button start ======================-->
              <div class="row titlebr" style="margin-bottom: 15px;">
                <div class="col-lg-6 pl-1" style="padding-top: 9px;">
                  <h5 class="">商品説明マスタ(詳細)</h5>
                </div>
                <div class="col-lg-6" style="">
                  {{--
                  <table class="dev_tble_button" style="float: right;">
                    <tbody>
                      <tr class="marge_in">
                        <td class="">
                          <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal"
                            data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                          </i>削除
                          </a>
                        </td>
                        <td class="">
                          <a class="btn btn-info scroll" id="product_des_Button3" data-toggle="modal"
                            data-target="#editModal" style="width: 100%;"><i class="fa fa-pencil-square-o"
                            aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                        </td>
                        <td class="" style="padding-left:6px!important;">
                          <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                            style="margin-right: 5px;"></i>データを戻す</a>
                        </td>
                        {{--
                        <td class="">
                          <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true"
                            style="margin-right: 5px;"></i>印刷</a>
                        </td>
                        --}}
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--======================= button  end ======================-->
            </div>
            <!--======================= modal 2 table start here ======================-->
            <div class="row mt-1 mb-3">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="tbl_name">
                  <div class="w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t "><span>商品説明CD区分</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          {{--
                          <div class="col-lg-2 col-md-2 col-sm-2 ">
                            <div class="m_t"></div>
                          </div>
                          --}}
                          <div class="col-lg-3 col-md-3 col-sm-3 ">
                            <div class="m_t" style="font-size:12px;">
                              商品　
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>商品説明CD </span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-2 col-md-2 col-sm-3 ">
                            <div style="position:relative;">
                              <div class="m_t">00571</div>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-8 ">
                            <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>見積明細備考</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t">(成果物) システム計画書</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>サービス内容</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t" style="white-space: normal;word-break: break-all;">
                            <div>事前打ち合わせ、製品機能説明、社内環境整備、パッケージ操作指導（開発ツールは含まず）</div>
                            <div>＊開発指導のみの場合不要</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>工数目安</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" style="white-space: normal; word-break: break-all;">
                            <div>社内0.5日</div>
                            <div>打合せ1～1.5日</div>
                            <div>訪問作業0.5日</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>成果物</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t">システム計画書</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>社内備考</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-3 col-sm-3 ">
                          <div class="m_t"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>販売時留意点</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t" style="white-space: normal;word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>商品説明PDF</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div style="position:relative;">
                            <div class="m_t">20191225AM-notes.PDF</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>補足説明</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t" style="white-space: normal;word-break: break-all;">(当面未使用)</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row" style="border-bottom: none;">
                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                          <div class="m_t">2</div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                          <div class="m_t" style="font-size:12px;">
                            0：訂正不可　1：訂正可
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--======================= modal 2 table end here ======================-->
        </div>
      </div>
    </div>
    <!-- Details modal end here -->

    <!-- Example modal start here -->
    <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
          <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
            <div class="modal-data-box pl-4 pr-4">
              <table class="table text-white" id="table-basic">
                <tbody class="pl-4 pr-4">
                  <tr>
                    <td class="border-left-0" style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                      <div class="line-icon-box"></div>
                      入金方法
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="01 現金入金" readonly="" autofocus="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                      <div class="line-icon-box"></div>
                      検収条件
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 納品完了確認書　貴社捺印時" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                      <div class="line-icon-box"></div>
                      売上基準
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 検収基準" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 130px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      即時区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 即時" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer border-top-0 pl-4 pr-4">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Example modal end here -->

    <!-- Example1 modal start here -->
    <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
          <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLabel"><strong>出荷指示</strong></h5>
            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
            <div class="modal-data-box pl-4 pr-4">
              <table class="table text-white" id="table-basic">
                <tbody class="pl-4 pr-4">
                  <tr>
                    <td class="border-left-0" style="width: 150px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                      <div class="line-icon-box"></div>
                      発出備考
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <div class="">
                        <textarea class="form-control" readonly="" autofocus rows="5" id="comment2" style=" resize: none;height: 53px;white-space:normal;border-radius:4px!important;" placeholder="発出備考NNNNNNNNNNNNNNNN"></textarea>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                      <div class="line-icon-box"></div>
                      納品方法
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="01 UIS" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px !important;padding-top: 17px;">
                      <div class="line-icon-box"></div>
                      継続区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 新規ﾗｲｾﾝｽ" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      新規VUP
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 新規" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      VUP区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 ﾒｼﾞｬｰ50%" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      明細備考
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <div class="">
                        <textarea class="form-control" rows="5" id="comment2" style=" resize: none;height: 75px;white-space:normal;border-radius:4px!important;" readonly="" placeholder=" 明細備考を入力（全角XX文字まで）"></textarea>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer border-top-0 pl-4 pr-4">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Example1 modal end here -->

    @include('layout.bottom_link')

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
