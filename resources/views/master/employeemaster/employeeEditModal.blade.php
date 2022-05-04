<form id="editForm" action="{{ route('postEditEmployeeMaster',[$bango]) }}" method="post" data-editmethod="editEmployee"
  onsubmit="editEmployee('{{route("postEditEmployeeMaster",[$bango])}}');event.preventDefault();"
  enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" id="hiddenBango" name="bango" value="">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal custom-form" id="employee_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 900px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div id="error_dataEdit" style="padding-left: 1px !important;"></div>
              {{-- Error Message Ends Here --}}

              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td style="padding-left: 0px!important;width: 100px!important;border:0px!important; ">
                            <h5>社員マスタ(変更)</h5>
                            <div class="mt-3"> 変更(処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button href="#" id="editButton" type="submit" class="btn btn-info scroll"
                      style="margin-right: 5px;" autofocus>
                      <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="table_wrap border_none_table">
            <div id="emp_input_boxwrap_edit" data-bind="nextFieldOnEnter:true">
              <div class="row mt-1 mb-3">
                <div class="col-lg-10 col-md-10 col-sm-12">
                  <div class="tbl_emp1">
                    <div class="w-100">
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-4">
                          <div class="margin_t ">
                            <span>事業年度(期)<span style="color: red;">※</span></span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                          <div class="outer_t row" style="">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                              <input type="text" id="edit_ztanka" name="ztanka" class="form-control" value="" readonly>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                              <div class="outer_t row" style="">
                                <div class="col-lg-3  col-md-3 col-sm-3">
                                  <div class="mt_d">社員CD<span style="color: red;">※</span></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                  <input type="text" class="form-control" id="edit_bango" name="bango" value=""
                                    readonly>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                          <div class="margin_t ">
                            <span>社員名(姓)</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer_t row" style="">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                              <div classlg-="mt_d">
                                <input type="text" id="edit_name1" name="name1" class="form-control" value=""  @if($has_permission) readonly @endif></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                          <div class="margin_t ">
                            <span>社員名(名)</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer_t row" style="">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                              <div class="">
                                <input type="text" id="edit_name2" name="name2" class="form-control" value=""  @if($has_permission) readonly @endif>
                              </div>
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
                            <div class="col-lg-7 col-md-7 col-sm-7">
                              <div class="">
                                <input type="text" id="edit_htanka" name="htanka" class="form-control" value=""  @if($has_permission) readonly @endif>
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
                            <span>事業部</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                              <div class="">
                                <div class="custom-arrow">
                                  <select @if($has_permission) style="pointer-events: none" @endif class="form-control" id="edit_datatxt0003" name="datatxt0003"  @if($has_permission) readonly @endif
                                    data-bango="{{ $bango }}">
                                    <!-- <option data-categoryType="null" data-categoryValue="null" value="">-
                                    </option> -->
                                    @foreach($datatxt0003 as $val)
                                    <option data-categoryType="{{$val->category1}}"
                                      data-categoryValue="{{$val->category2}}"
                                      value="{{$val->category1}}{{$val->category2}}">
                                      {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
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
                              <div class="custom-arrow">
                                <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" id="edit_datatxt0004" name="datatxt0004"  @if($has_permission) readonly @endif
                                  data-bango="{{ $bango }}">
                                
                                  @foreach($datatxt0004 as $val)
                                  <option data-categoryType="{{$val->category1}}"
                                    data-categoryValue="{{$val->category2}}"
                                    value="{{$val->category1}}{{$val->category2}}">
                                    {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="margin_t ">
                            <span>グループ</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select class="form-control" @if($has_permission) style="pointer-events: none" @endif  id="edit_datatxt0005" name="datatxt0005"  @if($has_permission) readonly @endif>
                                  
                                  @foreach($datatxt0005 as $val)
                                  <option value="{{$val->category1}}{{$val->category2}}">
                                    {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="margin_t ">
                            <span>事業所</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" id="edit_syozoku" name="syozoku"  @if($has_permission) readonly @endif>
                                  <!-- <option value="">-</option> -->
                                  @foreach($request as $val)
                                  <option value="{{$val->syouhinbango.' '.$val->jouhou}}">
                                    {{$val->syouhinbango .' '. $val->jouhou}}</option>
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="password" id="edit_passwd" class="form-control" name="passwd" value="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-4">
                          <div class="margin_t ">
                            <span>(確認用)</span>  <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="password" id="edit_passwd_confirmation" class="form-control"
                                name="passwd_confirmation" value="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-4">
                          <div class="margin_t ">
                            <span>権限CD</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6 pr-0 ">
                              <div class="pr-m-15">
                                <div class="custom-arrow">
                                  <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" id="edit_mail4" name="mail4"  @if($has_permission) readonly @endif
                                    style="width: 100%!important;">
                                    
                                    @foreach($authority as $val)
                                    <option value="{{$val->category1}}{{$val->category2}}">
                                      {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pl-0 ">
                              <div class="pl-m-15"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3">
                          <div class="margin_t ">
                            <span>承認部門</span>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="outer row">
                            <div class="col-lg-12 ">
                              <div class="custom-arrow">
                                <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" id="edit_recog_dept" name="recog_dept" @if($has_permission) readonly @endif
"
                                  style="width: 100%!important;">
                                  <option value="">-</option>
                                  @foreach($recog_dept as $val)
                                  <option value="{{$val->category1}}{{$val->category2}}">
                                    {{$val->category2.' '}}{{$val->category4}}</option>
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
                              <input type="text" class="form-control" name="mail2" id="edit_mail2"
                                value="090-0000-0000">
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
                              <input type="text" class="form-control" name="mail3" id="edit_mail3" value="1">
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
                            <span>メールアドレス<span style="color: red;">※</span></span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="text" name="mail" id="edit_mail" class="form-control" value="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="margin_t ">
                            <span>(確認用)</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="text" name="mail_confirmation" id="edit_mail_confirmation"
                                class="form-control" value="">
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
                              <div class="custom-arrow">
                                <select class="form-control" name="datatxt0030" id="edit_datatxt0030">
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" id="edit_datatxt0031" name="datatxt0031">
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                              <div class="custom-arrow">
                                <select class="form-control" name="datatxt0032" id="edit_datatxt0032">
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                              <div class="custom-arrow">
                                <select class="form-control" name="datatxt0033" id="edit_datatxt0033">
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
                              <div class="custom-arrow">
                                <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" id="edit_datatxt0034" name="datatxt0034" @if($has_permission) readonly @endif >
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" id="edit_datatxt0035" name="datatxt0035" @if($has_permission) readonly @endif>
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="custom-arrow">
                                <select @if($has_permission) style="pointer-events: none" @endif  class="form-control" name="datatxt0036" id="edit_datatxt0036" @if($has_permission) readonly @endif>
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option  value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
                                  @endforeach
                                </select>
                              </div>
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
                              <div class="custom-arrow">
                                <select class="form-control" id="edit_datatxt0037" name="datatxt0037" @if($has_permission) readonly @endif>
                                  <option value="">-</option>
                                  @foreach($tantousyas as $user)
                                  <option value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
              <div class="row mt-1 mb-3">
                <div class="col-lg-10">
                  <div class="tbl_emp1">
                    <div class="w-100">
                      <div class=" row row_data">
                        <div class="col-lg-2">
                          <div class="margin_t ">
                            <span>社員印影</span>
                          </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="outer_t row" style="padding-left: 15px;padding-right: 10px;">
                            <div style="float: left;width: 62%;">
                              <input name="inpemp2" id="inpemp2" type="text" class="input_field form-control"
                                style="background-color: white" readonly>
                              <input name="old_inpemp2" id="old_inpemp2" type="hidden" class="input_field form-control">
                            </div>
                            <div style="float: left;width: 20%;">
                              <div class="custom-file mb-3" style="margin-left: 5px;">
                                <input type="file" accept="image/png, image/jpeg, application/pdf"
                                  class="custom-file-input_emp2" id="customFileEmp2" onchange="readURL(this);"
                                  name="datatxt0029">
                                <label class=" btn btn-info" for="customFileEmp2">
                                  <i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-10">
                  <div class="tbl_emp1">
                    <div class="w-100">
                      <div class=" row row_data">
                        <div class="col-lg-2">
                          <div class="margin_t ">
                            <span>写真</span>
                          </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="outer_t row" style="padding-left: 15px;padding-right: 10px;">
                            <div style="float: left;width: 62%;">
                              <input name="inpemp4" id="inpemp4" type="text" class="input_field form-control"
                                style="background-color: white" readonly>
                              <input name="old_inpemp4" id="old_inpemp4" type="hidden" class="input_field form-control">
                            </div>
                            <div style="float: left;width: 20%;">
                              <div class="custom-file mb-3" style="margin-left: 5px;">
                                <input type="file" accept="image/png, image/jpeg, application/pdf"
                                  class="custom-file-input_emp4" id="customFileEmp4" onchange="readURL(this);"
                                  name="syounin">
                                <label class=" btn btn-info" for="customFileEmp4">
                                  <i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照
                                </label>
                              </div>
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
                            <span>権限レベル<span style="color: red;">※</span></span>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="outer row">
                            <div class="col-lg-12 ">
                              <input type="text" maxlength="2" class="form-control" name="innerlevel" @if(!$inner_level_change_permission) readonly @endif
                                id="edit_innerlevel">
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

<script>
  $(".custom-file-input_emp2").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $("#employee_modal3").find('#inpemp2').val(fileName);
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    $("#employee_modal3").find('#inpemp2').val(fileName)
  });
  $(".custom-file-input_emp4").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $("#employee_modal3").find('#inpemp4').val(fileName);
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    $("#employee_modal3").find('#inpemp4').val(fileName)
  });

</script>
