<form id="editForm" method="post" data-editmethod="editPersonalMaster"
  action="{{route("postPersonalMasterDetail",[$bango])}}">
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" name="personalBango" id="personalBango" value="">
  <input type="hidden" name="editUrl" value="{{route("postPersonalMasterDetail",[$bango])}}">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="edit_modal" role="dialog"
    aria-labelledby="" aria-hidden="true">
    {{-- <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="edit_modal" role="dialog" aria-labelledby="" aria-hidden="true" style="overflow-y: hidden !important;"> --}}
    <div class="modal-dialog" style="max-width: 800px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=""></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          {{-- <div class="modal-body" style="overflow-y: auto; max-height: 81vh;" data-bind="nextFieldOnEnter:true"> --}}
          <div class="development_page_top_table heading_mt">
            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-lg-12" style="padding-left: 1px !important;">

                {{-- Error Message Starts Here --}}
                <div id="edit_registration_error_data"></div>
                {{-- Error Message Ends Here --}}

              </div>
              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class=""
                            style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>個人マスタ(変更)</h5>
                            <div class="mt-3"> 変更(処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button name="insert" id="edit_submit_registration" type="submit" class="btn btn-info">
                      <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="personal_input_boxwrap_edit">
            <div class="table_wrap">
              <div class="row mt-1 mb-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="tbl_name">
                    <div class="w-100">
                      <div class=" row row_data">
                        <div class=" col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span>会社CD</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <input type="text" class="form-control" id="edit_company_cd_id" name="company_cd"
                                readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6  m-pl-15 "></div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-3 ">
                          <div class="margin_t ">
                            <span>事業所CD</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <input type="text" class="form-control" id="edit_office_cd_id" name="input_office_cd"
                                readonly>
                              <input type="hidden" id="new_edit_office_cd_id" name="office_cd">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 m-pl-15 ">
                              <div class="m_t"></div>
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
                              <input type="text" class="form-control" name="personal_cd" id="edit_personal_cd_id"
                                readonly>
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
                              <input type="text" class="form-control" name="deploy" id="edit_deploy_id">
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
                              <input type="text" class="form-control" name="position" id="edit_position_id">
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
                              <input type="text" class="form-control" value="" name="personal_name"
                                id="edit_personal_name_id">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4 col-sm-4 ">
                                  <div class="m_t">入力区分  <span style="color: red;">※</span></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 ">
                                  <div class="custom-arrow">
                                    <select class="form-control" style="width:100%;" name="input_classification"
                                      id="edit_input_classification_id">
{{--                                      <option value="">-</option>--}}
                                      @foreach($requestColors as $requestColor)
                                      <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                        {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class=" col-lg-2 col-md-2 col-sm-3 ">
                          <div class="margin_t ">
                            <span>個人名略称</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="department_charge_abbreviation"
                                id="edit_department_charge_abbreviation_id">
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
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <input type="text" class="form-control" value="" name="mail_address"
                                id="edit_mail_address">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span>メールアドレス <br />(確認用)</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="mail_address_confirmation"
                                id="edit_mail_address_confirmation">
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
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <input type="text" class="form-control" name="tel" id="edit_tel_id">
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
                              <input type="text" class="form-control" name="fax" id="edit_fax_id">
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
                            <div class="col-lg-8 col-md-8 col-sm-12 ">
                              <div class="form-group">
                                <textarea class="form-control" id="edit_internal_notes_id" rows="5"
                                  name="internal_notes" style="height: 80px;padding-left: 0px;"></textarea>
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
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="information_stop_flag"
                                  id="edit_information_stop_flag_id">
                                    <option value="">-</option>
                                  @foreach($requestColor1s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="keyaman_flag"
                                  id="edit_keyman_flag_id">
                                  <option value="">-</option>
                                  @foreach($requestColor2s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="officer_election_information"
                                  id="edit_officer_election_information_id">
                                    <option value="">-</option>
                                  @foreach($requestColor3s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="new_years_card"
                                  id="edit_new_years_card_id">
                                    <option value="">-</option>
                                  @foreach($requestColor4s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="user_meeting_information"
                                  id="edit_user_meeting_information">
                                    <option value="">-</option>
                                  @foreach($requestColor5s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                            <div class="col-lg-12  col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="shipment_flag"
                                  id="edit_shipment_flag_id">
                                    <option value="">-</option>
                                  @foreach($requestColor6s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}
                                  </option>
                                  @endforeach
                                </select>
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
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</form>
