<div class="modal" data-keyboard="false" data-backdrop="static" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
{{-- <div class="modal" data-keyboard="false" data-backdrop="static" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="overflow-y: hidden !important;"> --}}
  <div class="modal-dialog" role="document" style="max-width: 800px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-bind="nextFieldOnEnter:true">
      {{-- <div class="modal-body" style="overflow-y: auto; max-height: 81vh;" data-bind="nextFieldOnEnter:true"> --}}
        <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">
          <div class="row titlebr" style="margin-bottom: 15px;">
            
            {{-- Confirmation Message Starts Here --}}
            <div class="col-12 pl-0">
              <div id="confirmation_message" style="margin-left: -10px !important; padding-left: 1px !important"></div>
            </div>
            {{-- Confirmation Message Ends Here --}}
            
            <div class="col-lg-6 pl-1">
              <h5>個人マスタ(詳細)</h5>
            </div>
            <div class="col-lg-6">
              <table class="dev_tble_button" style="float: right;">
                <tbody>
                  <tr class="marge_in">
                    @if($tantousya->innerlevel <= 10) <td class="">
                      <a data-url="{{ route('personalMasterDelete',$bango) }}" class="btn btn-info scroll"
                        style="background-color: #3e6ec1!important;" id="btnDelete"><i class="fa fa-trash"
                          style="margin-right: 7px;">
                        </i>削除
                      </a>
                      </td>
                      @if($deleted_item )
                      <td class="">
                        <a class="btn btn-info scroll" data-url="{{ route('personalMasterDelete',[$bango,1]) }}"
                          id="btnRestore" style="">データを戻す
                        </a>
                      </td>
                      @endif
                      @endif
                      <td class="">
                        <a class="btn btn-info scroll" id="edit_modal_open" style="">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                        </a>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="table_wrap">
          <div class="row mt-1 mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>会社CD</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="company_name"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>事業所CD</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="bussiness_name"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>個人CD</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="m_t" id="personal_cd"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>部署</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="m_t" id="deploy"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>役職</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="m_t" id="position"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>個人名</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                          <div class="m_t" id="personal_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                              <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div> 
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                              <div class="m_t" id="input_classification"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>個人名略称</span>  <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="m_t" id="department_charge_abbreviation"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>メールアドレス</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="white-space: normal; word-break: break-all;">
                          <div class="m_t" id="mail_address"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>メールアドレス<br />(確認用)</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="white-space: normal; word-break: break-all;">
                          <div class="m_t" id="confirm_mail_address"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>TEL</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="m_t" id="tel"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>FAX</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="m_t" id="fax">0322223333</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-3">
                      <div class="margin_t ">
                        <span>備考</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <div class="form-group">
                            <div class="m_t" id="internal_notes"></div>
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
            <div class="col-lg-6 col-md-6">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="margin_t ">
                        <span>案内フラグ</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="information_stop_flag"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="margin_t ">
                        <span>キーマンフラグ</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t" id="keyman_flag"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-5 col-md-5 col-sm-4">
                      <div class="margin_t ">
                        <span>役員改選案内</span>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="officer_election_information"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-5 col-md-5 col-sm-4">
                      <div class="margin_t ">
                        <span>年賀状</span>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="new_years_card"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-5 col-md-5 col-sm-4">
                      <div class="margin_t ">
                        <span>ユーザー会案内</span>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="user_meeting_information"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-5 col-md-5 col-sm-4">
                      <div class="margin_t ">
                        <span>送付物フラグ４</span>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" id="shipment_flag"></div>
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
</div>