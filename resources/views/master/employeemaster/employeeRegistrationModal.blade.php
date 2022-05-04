<form id="registrationForm" action="{{ route('postEditEmployeeMaster',[$bango]) }}" method="post"  data-regmethod="registerEmployee" enctype='multipart/form-data'>
    @csrf
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="validate_only" value="1">
    <div class="modal custom-form" id="employee_modal1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" style="max-width: 900px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-bind="nextFieldOnEnter:true">
                    <div class="table_wrap border_none_table">
                        <div class="row titlebr" style="margin-bottom: 15px;">

                            {{-- Error Message Starts Here --}}
                            <div id="error_data" style="padding-left: 1px !important;"></div>
                            {{-- Error Message Ends Here --}}

                            <div class="col-lg-12">
                                <div style="display: inline;">
                                    <div style="float:left; ">
                                        <table class="dev_tble_button">
                                            <tbody>
                                            <tr>
                                                <td class=""
                                                    style="padding-left: 0px!important;width: 100px!important;border:0px!important; ">
                                                    <h5>社員マスタ(登録)</h5>
                                                    <div class="mt-3"> 新規(処理状況)</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div style="float: right;">
                                        <a name="insert" type="button" class="btn btn-info scroll"
                                           onclick="registerEmployee('{{route("postEditEmployeeMaster",[$bango])}}');"
                                           style="margin-right: 5px;" id="regButton" autofocus>
                                            <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

            <div id="emp_input_boxwrap_reg">
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
                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                              <input type="text" class="form-control" id="insert_ztanka" name="ztanka" value="">
                            </div>
                            <div class=" col-lg-9 col-md-9 col-sm-9 ">
                              <div class="outer_t row" style="">
                                <div class="col-lg-3  col-md-3 col-sm-3">
                                  <div class="" style="margin-top: 5px;">社員CD<span style="color: red;">※</span></div>
                                </div>
                                <div class=" col-lg-6  col-md-6 col-sm-6">
                                  <input type="text" class="form-control" name="bango" id="insert_bango" value="">
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
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                              <input type="text" class="form-control" id="insert_name1" name="name1" value="">
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
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                              <input type="text" class="form-control" id="insert_name2" name="name2" value="">
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
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                              <input type="text" class="form-control" id="insert_htanka" name="htanka" value="">
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <div class="">
                                <div class="custom-arrow">
                                  <select name="datatxt0003" id="insert_datatxt0003" class="form-control"
                                    data-bango="{{ $bango }}">

                                    @foreach($datatxt0003 as $val)
                                    <option data-categoryType="{{$val->category1}}"
                                      data-categoryValue="{{$val->category2}}"
                                      value="{{$val->category1}}{{$val->category2}}" @if($val->category2=='5001')selected @endif>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                              <div class="custom-arrow">
                                <select name="datatxt0004" id="insert_datatxt0004" class="form-control"
                                  data-bango="{{ $bango }}">
                                
                                    @if(!empty($datatxt0004))
                                  @foreach($datatxt0004 as $val)
                                  <option data-categoryType="{{$val->category1}}"
                                    data-categoryValue="{{$val->category2}}"
                                    value="{{$val->category1}}{{$val->category2}}" @if($val->category2=='50011')selected @endif>
                                    {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                  @endforeach
                                  @endif
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
                                <select name="datatxt0005" id="insert_datatxt0005" class="form-control">
                                    
                                    @if(!empty($datatxt0005))
                                  @foreach($datatxt0005 as $val)
                                  <option value="{{$val->category1}}{{$val->category2}}" @if($val->category2=='500111')selected @endif>
                                    {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                  @endforeach
                                  @endif
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
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                              <div class="custom-arrow">
                                <select name="syozoku" class="form-control" id="insert_syozoku">

                                  @foreach($request as $val)
                                  <option value="{{$val->syouhinbango.' '.$val->jouhou}}" @if($val->syouhinbango=='1')selected @endif>
                                    {{$val->syouhinbango.' '.$val->jouhou}}</option>
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
                              <input type="text" id="insert_passwd" name="passwd" class="form-control" value="">
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
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <input type="text" id="insert_passwd_confirmation" name="passwd_confirmation"
                                class="form-control" value="">
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
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <div class="w-100">
                                <div class="custom-arrow">
                                  <select name="mail4" class="form-control" id="insert_mail4"
                                    style="width: 100%!important;">

                                    @foreach($authority as $val)
                                    <option value="{{$val->category1}}{{$val->category2}}" @if($val->category2=='10')selected @endif>
                                      {{$val->category1}}{{$val->category2.' '}}{{$val->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
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
                                <select class="form-control" id="insert_recog_dept" name="recog_dept"
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
                              <input type="text" id="insert_mail2" name="mail2" class="form-control" value="">
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
                              <input type="text" class="form-control" id="insert_mail3" name="mail3" value="">
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
                              <input type="text" name="mail" id="insert_mail" class="form-control" value="">
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
                              <input type="text" class="form-control" id="insert_mail_confirmation"
                                name="mail_confirmation" value="">
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
                                <select class="form-control" id="insert_datatxt0030" name="datatxt0030">
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
                                <select class="form-control" id="insert_datatxt0031" name="datatxt0031">
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
                                <select class="form-control" id="insert_datatxt0032" name="datatxt0032">
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
                                <select class="form-control" id="insert_datatxt0033" name="datatxt0033">
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
                            <span>決裁者1
                            </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="custom-arrow">
                                                                <select class="form-control" id="insert_datatxt0034"
                                                                        name="datatxt0034">
                                                                    <option value="">-</option>
                                                                    @foreach($tantousyas as $user)
                                                                        <option
                                                                            value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
                                                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                            <div class="custom-arrow">
                                                                <select class="form-control" id="insert_datatxt0035"
                                                                        name="datatxt0035">
                                                                    <option value="">-</option>
                                                                    @foreach($tantousyas as $user)
                                                                        <option
                                                                            value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
                                                                <select class="form-control" id="insert_datatxt0036"
                                                                        name="datatxt0036">
                                                                    <option value="">-</option>
                                                                    @foreach($tantousyas as $user)
                                                                        <option
                                                                            value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
                                                                <select class="form-control" id="insert_datatxt0037"
                                                                        name="datatxt0037">
                                                                    <option value="">-</option>
                                                                    @foreach($tantousyas as $user)
                                                                        <option
                                                                            value="{{$user->bango}}">{{$user->bango.' '}}{{$user->name}}</option>
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
                                                    <div class="outer_t row"
                                                         style="padding-left: 15px; padding-right: 10px;">
                                                        <div style="float: left;width: 62%;">
                                                            <input name="inpemp1" id="input_file_emp" type="text"
                                                                   class="input_field form-control"
                                                                   style="background-color: white" readonly>
                                                        </div>
                                                        <div style="float: left;width: 20%;">
                                                            <div class="custom-file" style="margin-left: 5px;">
                                                                <input type="file"
                                                                       accept="image/png, image/jpeg, application/pdf"
                                                                       class="custom-file-input_emp" id="customFileEmp"
                                                                       onchange="readURL(this);"
                                                                       name="datatxt0029">
                                                                <label class=" btn btn-info" for="customFileEmp">
                                                                    <i class="fa fa-search" aria-hidden="true"
                                                                       style="margin-right: 5px;"></i>参照
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
                                                    <div class="outer_t row"
                                                         style="padding-left: 15px; padding-right: 10px;">
                                                        <div style="float: left;width: 62%;">
                                                            <input name="inpemp3" id="input_file_emp3" type="text"
                                                                   class="input_field form-control"
                                                                   style="background-color: white" readonly>
                                                        </div>
                                                        <div style="float: left;width: 20%;">
                                                            <div class="custom-file mb-3" style="margin-left: 5px;">
                                                                <input type="file"
                                                                       accept="image/png, image/jpeg, application/pdf"
                                                                       class="custom-file-input_emp3"
                                                                       id="customFileEmp3" onchange="readURL(this);"
                                                                       name="syounin">
                                                                <label class=" btn btn-info" for="customFileEmp3">
                                                                    <i class="fa fa-search" aria-hidden="true"
                                                                       style="margin-right: 5px;"></i>参照
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
                                                            <input type="text" value="15" maxlength="2"
                                                                   class="form-control" name="innerlevel"
                                                                   id="insert_innerlevel">
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
    $(".custom-file-input_emp").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $("#input_file_emp").val(fileName);
    });
    $(".custom-file-input_emp3").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $("#input_file_emp3").val(fileName);
    });

</script>
