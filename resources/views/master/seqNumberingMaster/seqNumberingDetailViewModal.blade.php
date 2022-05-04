<form id="detailViewForm" action="{{ route('seqNumberingMaster',$bango) }}" method="post">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="seqNumberingDetailModal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin:11px;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              {{-- <div class="row"> --}}
                <div id="detail_seq_error_data" style="margin-left: -11px !important;"></div>
              {{-- </div> --}}
              {{-- Error Message Ends Here --}}

              <div class="row col-12 pr-0">
                <div class="col-6 pl-1" style="padding-top: 8px;">
                  <h5 class="">SEQ番号付番マスタ(詳細)</h5>
                </div>
                <div class="col-6 pr-0">
                  <table class="dev_tble_button float-right">
                    <tbody>
                      <tr class="marge_in">
                        @if($tantousya->innerlevel <= 10) <td class="">
                          <a id="deleteThis" class="btn btn-info scroll"
                            onclick="deleteSeqNumberingMaster('{{route('deleteOrReturnSeqNumbering',[$bango])}}')"
                            autofocus="">
                            <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                          </a>
                          </td>
                          @endif
                          <td class="">
                            <a id="seq_Button3" class="btn btn-info scroll" id="seq_Button3" data-toggle="modal"
                              data-target="#seq_numbering_edit_modal">
                              <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                            </a>
                          </td>
                          @if($deleted_item)
                          <td class="" style="padding-left:6px!important;">
                            <a id="btnRestore" class="btn btn-info"
                              onclick="returnSeqNumberingMaster('{{route('deleteOrReturnSeqNumbering',[$bango,1])}}')">
                              <i class="" aria-hidden="true" style="margin-right: 5px;"></i>データを戻す
                            </a>
                          </td>
                          @endif
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                        <span>番号区分<span style="color: red;">※</span></span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div id="detail_kokyakusyouhinbango"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3">
                      <div class="margin_t "><span>番号<span style="color: red;">※</span></span></div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div id="detail_orderbango"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class=" row row_data">
                    <div class="col-lg-3">
                      <div class="margin_t "><span>番号総桁数<span style="color: red;">※</span></span></div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div id="detail_mobile_flag"></div>
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