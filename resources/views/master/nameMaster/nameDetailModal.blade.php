<div class="modal" data-keyboard="false" data-backdrop="static" id="name_modal2" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-bind="nextFieldOnEnter:true">
        <div class="development_page_top_table heading_mt" style="margin: 11px !important;">

          {{-- Error Message Starts Here --}}
          <div class="col-12 pl-0" style="margin-left: -25px !important;">
            <div id="detail_error_data"></div>
          </div>
          {{-- Error Message Ends Here --}}

          <div class="row titlebr" style="margin-bottom: 15px;">
            <div class="col-lg-6 pl-1" style="padding-top: 8px;">
              <h5 class="">名称マスタ(詳細)</h5>
            </div>
            <div class="col-lg-6" style="">
              <table class="dev_tble_button" style="float: right;">
                <tbody>
                  <tr class="marge_in">
                    @if($tantousya->innerlevel <= 10)
                      <td class="">
                        <a type="button" class="btn btn-info scroll" id="deleteThis"
                          style="background-color: #4D82C6!important;border: 1px solid #4D82C6 !important;"
                          onclick="deleteNameMaster('{{route('clearNameSetting',[$bango])}}')" autofocus>
                          <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                      </td>
                      <td class="">
                        <a class="btn btn-info scroll" id="nameButton3" data-toggle="modal" data-target="#name_modal3">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                        </a>
                      </td>

                      @if($deleted_item )
                      <td class="" style="padding-left:6px!important;">
                        <a class="btn btn-info scroll" onclick="returnNameMaster('{{route('clearNameSetting',[$bango,1])}}')" id="btnRestore">
                          <i class="" aria-hidden="true" style="margin-right: 5px;"></i>データを戻す
                        </a>
                      </td>
                      @endif
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row mt-1 mb-3">
          <div class="col-lg-12">
            <div class="tbl_name">
              <div class="w-100">
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t ">
                      <span>名称CD <span style="color: red;">※</span></span>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_category1"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>分類CD<span style="color: red;">※</span></span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_category2"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>名称名<span style="color: red;">※</span></span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_category3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>分類名<span style="color: red;">※</span></span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_category4"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>名称名略称</span> <span style="color: red;">※</span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_category5"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>分類名略称</span> <span style="color: red;">※</span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_groupbango"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>分類CD桁数<span style="color: red;">※</span></span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_osusume"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>表示順</span> <span style="color: red;">※</span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_suchi1"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>変更可否</span> <span style="color: red;">※</span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_changed"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>予備1 </span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_spare_one"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>予備2 </span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_spare_two"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-3">
                    <div class="margin_t "><span>予備3  </span></div>
                  </div>
                  <div class="col-lg-9">
                    <div class="outer row">
                      <div class="col-lg-12 ">
                        <div class="m_t" id="detail_spare_three"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
