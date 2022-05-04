<form id="employeeDetailViewForm" action="{{ route('employeeMaster',$bango) }}" method="post">
  <div class="modal" id="employee_modal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 900px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="development_page_top_table heading_mt" style="margin-right: 0px !important;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div id="detail_error_data" style="padding-left: 1px !important;"></div>
              {{-- Error Message Ends Here --}}

              <div class="col-lg-6" style="">
                <h5>社員マスタ(詳細)</h5>
              </div>
              <div class="col-lg-6">
                <table class="dev_tble_button" style="float: right;">
                  <tbody>
                    <tr class="marge_in">
                      @if($tantousya->innerlevel <= 10)
                      <td class="">
                        <a class="btn btn-info scroll" id="deleteThis" style="background-color: #3e6ec1!important;"
                          data-toggle="modal" data-target="#"
                          onclick="deleteEmployeeMaster('{{route('clearEmployeeSetting',[$bango])}}')"><i
                            class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                      </td>
                      @if($deleted_item )
                      <td class="">
                        <a class="btn btn-info scroll"
                          onclick="returnEmployeeMaster('{{route('clearEmployeeSetting',[$bango,1])}}')"
                          id="btnRestore" style="">データを戻す
                        </a>
                      </td>
                      @endif
                      @endif
                      <td class="">
                        <a class="btn btn-info scroll" id="empButton3" data-toggle="modal"
                          data-target="#employee_modal3" style="">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="table_wrap border_none_table">
            <div class="row mt-1 mb-3">
              <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="tbl_emp1">
                  <div class="w-100">
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-2 col-sm-4">
                        <div class="margin_t ">
                          <span>事業年度(期) <span style="color: red;">※</span></span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-8">
                        <div class="outer_t row" style="">
                          <div id="detail_ztanka" class="col-lg-3 col-md-3 col-sm-3" style="margin-top: 5px;">48</div>
                          <div class="col-lg-9 col-md-9 col-sm-9">
                            <div class="outer_t row" style="">
                              <div class="col-lg-3  col-md-3 col-sm-3">
                                <div style="margin-top: 5px;">社員CD <span style="color: red;">※</span></div>
                              </div>
                              <div class="col-lg-6  col-md-6 col-sm-6">
                                <div class="" style="margin-top: 5px;" id="detail_bango"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t ">
                        <span>社員名(姓)</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer_t row" style="">
                        <div class="col-lg-7 col-md-7 col-sm-7">
                          <div class="mt_d" id="detail_name1" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t ">
                        <span>社員名(名)</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer_t row" style="">
                        <div class="col-lg-7 ">
                          <div class="mt_d" id="detail_name2" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t ">
                        <span>給与社員CD</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer_t row" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_htanka" style="white-space: normal; word-break: break-all;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>事業部</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0003" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>部</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0004" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>グループ</span>  <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0005" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>事業所</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_syozoku" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <div class="margin_t ">
                        <span>パスワード<span style="color: red;">※</span></span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                          <div style="white-space: normal; word-break: break-all; padding-top: 7px;">******</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <div class="margin_t ">
                        <span>(確認用)</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                          <div style="white-space: normal; word-break: break-all; padding-top: 7px;">******</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>権限CD</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="outer row" style="padding-left: 30px;">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="pr-m-15 pl-m-15" id="detail_mail4" style="margin-top: 6px;">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>承認部門
                        </span>
                      </div>
                    </div>
                    <div class="outer row" style="padding-left: 30px;">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="pr-m-15 pl-m-15" id="detail_recog_dept" style="margin-top: 5px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>電話番号</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_mail2" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>携帯番号</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_mail3" style="white-space: normal; word-break: break-all;">1</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-8 col-md-8 col-sm-8">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <div class="margin_t ">
                        <span>メールアドレス <span style="color: red;">※</span></span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="mt_d" id="detail_mail_1" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <div class="margin_t ">
                        <span>(確認用)</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_mail_2" style="white-space: normal; word-break: break-all;">
                            XXX1@xx.co.jp
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力者1</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0030" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力者2</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0031" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力者3</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0032" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力者4</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0033" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>決裁者1</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0034" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>決裁者2</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div id="detail_datatxt0035"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>決裁者3</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="mt_d" id="detail_datatxt0036" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>決裁者4</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0037" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-10 col-md-10 col-sm-10">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t ">
                        <span>社員印影</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_datatxt0029" style="overflow: hidden;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t ">
                        <span>写真</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="mt_d" id="detail_syounin" style="overflow: hidden;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="tbl_emp1">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3">
                      <div class="margin_t ">
                        <span>権限レベル </span> <span style="color: red">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row" style="">
                        <div class="col-lg-12 ">
                          <div class="mt_d" id="detail_innerlevel"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</form>
