<form id="registrationForm" method="post" data-regmethod="registerPersonalModal"
  action="{{route("postPersonalMasterDetail",[$bango])}}">
  @csrf
  <input type="hidden" name="type" value="create">
  <input type="hidden" name="bango" value="{{$bango}}">
  <input type="hidden" name="url" value="{{route("postPersonalMasterDetail",[$bango])}}">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="registration_modal" role="dialog" aria-labelledby="" aria-hidden="true">
  {{-- <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="registration_modal" role="dialog" aria-labelledby="" aria-hidden="true" style="overflow-y: hidden !important;"> --}}
    <div class="modal-dialog" role="document" style="max-width:800px!important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id=""></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
        {{-- <div class="modal-body" style="overflow-y: auto; max-height: 81vh;" data-bind="nextFieldOnEnter:true"> --}}
          <div class="development_page_top_table heading_mt">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div id="registration_error_data"></div>
              {{-- Error Message Ends Here --}}

              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class=""
                            style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>個人マスタ(登録)</h5>
                            <div class="mt-3"> 新規(処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button name="insert" id="submit_registration" type="submit" class="btn btn-info">
                      <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="personal_input_boxwrap_reg">
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
                        <div class="col-lg-10 col-md-10 col-sm-10">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control custom_select_search" name="company_cd"
                                  data-ownbango="{{$bango}}" id="insert_company_cd_id" style="width:100%;">
                                  @foreach($kokyaku1s as $kokyaku1)
                                  <option value="{{$kokyaku1->yobi12.'-'.$kokyaku1->bango}}">
                                    {{ $kokyaku1->yobi12 .' '.$kokyaku1->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data" style="margin-top: 2px !important;">
                        <div class="col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span>事業所CD</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control custom_select_search" name="office_cd"
                                  id="insert_office_cd_id" data-bango="{{$bango}}" style="width:100%;">
                                  @foreach($haisous as $haisou)
                                  <option value="{{$haisou->torihikisakibango.'-'.$haisou->bango}}">
                                    {{ $haisou->torihikisakibango.' '.$haisou->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="personal_cd" id="insert_personal_cd_id">
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span>部署</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="deploy" id="insert_deploy_id">
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
                              <input type="text" class="form-control" name="position" id="insert_position_id">
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
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="personal_name" id="insert_personal_name_id">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4 col-sm-4 ">
                                  <div class="m_t">入力区分 <span style="color: red;">※</span></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 ">
                                  <div class="custom-arrow">
                                    <select class="form-control" style="width:100%;" name="input_classification"
                                      id="insert_input_classification_id">
{{--                                      <option value="">-</option>--}}
                                      @foreach($requestColors as $requestColor)
                                      <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}" @if ($requestColor->syouhinbango .' '.$requestColor->jouhou == '1 訂正可') selected @endif>
                                        {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                        <div class="col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span>個人名略称</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="department_charge_abbreviation"
                                id="insert_department_charge_abbreviation_id">
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
                              <input type="text" class="form-control" name="mail_address" id="insert_mail_address">
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
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="mail_address_confirmation"
                                id="insert_mail_address_confirmation">
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
                              <input type="text" class="form-control" name="tel" id="insert_tel_id">
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
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <input type="text" class="form-control" name="fax" id="insert_fax_id">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-3">
                          <div class="margin_t ">
                            <span> 備考</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-8 col-md-8 col-sm-12  ">
                              <div class="form-group">
                                <textarea class="form-control" rows="5" name="internal_notes"
                                  style="height: 80px;padding-left: 0px;" id="insert_internal_notes_id"></textarea>
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
                                  id="insert_information_stop_flag_id">
                                    <option value="">-</option>
                                  @foreach($requestColor1s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango.' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                                  id="insert_keyman_flag_id">
                                  <option value="">-</option>
                                  @foreach($requestColor2s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango.' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                                  id="insert_officer_election_information_id">
                                    <option value="">-</option>
                                  @foreach($requestColor3s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                                  id="insert_new_years_card_id">
                                    <option value="">-</option>
                                  @foreach($requestColor4s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                            <div class="col-lg-12  col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control" style="width:100%;" name="user_meeting_information"
                                  id="insert_user_meeting_information">
                                    <option value="">-</option>
                                  @foreach($requestColor5s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
                                  id="insert_shipment_flag_id">
                                    <option value="">-</option>
                                  @foreach($requestColor6s as $requestColor)
                                  <option value="{{$requestColor->syouhinbango .' '.$requestColor->jouhou}}">
                                    {{$requestColor->syouhinbango .' '.$requestColor->jouhou	}}</option>
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
