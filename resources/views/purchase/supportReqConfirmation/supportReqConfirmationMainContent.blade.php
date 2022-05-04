@php
if(session()->has('supportReqConfirmation_selected_item')){
    $supportReqConfirmation_selected_item = session()->get('supportReqConfirmation_selected_item');
}
@endphp
<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('supportReqConfirmation') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    <input id='submit_confirmation' value='' type='hidden'/>
    @csrf
    
    <!-- first search req data //fsReqData=first search request data -->
    @if(isset($fsReqData))
    @foreach($fsReqData as $k=>$v)
      <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
    @endforeach
    @endif
    
    <div class="content-bottom-top">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="bottom-top-title">
              サポート一覧
            </div>
          </div>
        </div>
      </div>
      <div class="content-bottom-pagination">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">

                <!-- Pagination Starts Here -->
                @include('purchase.supportReqConfirmation.pagination')
                <!-- Pagination Ends Here -->

                <div class="row" style="margin-bottom: 30px;">
                  <div class="col-6">
                    <div class="row">
                      <div class="col">
                        <table class="table custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;    font-size: 0.9em;">
                                チェック数</td>
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td id="countCheckedItem" style=" border: none!important;width: 50%;color: #000;    font-size: 0.9em;">
                                0</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                      <tbody>
                        <tr style="height: 28px;">
                          <td style=" border: none!important;">
                            <button onclick="Thesearch();" message="検索欄に入力した内容を検索します。" type="button" id="choice_button" class="btn bg-teal w-145 text-white uskc-button"
                              data-dismiss="modal">
                              検　索
                            </button>
                          </td>
                          <td style=" border: none!important;">
                            <button onclick="refresh()" message="データを一覧表示します。" type="button" id="" class="btn text-white bg-default w-145 uskc-button" data-dismiss="modal">
                              一　覧
                            </button>
                          </td>
                          <td style=" border: none!important;">
                            <button id="excelDwld" onclick="excelDownload()" type="button" class="btn text-white uskc-button" data-dismiss="modal"
                              style="background: #009640;">Excelエクスポート
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
        <div class="row mt-3" style="">
          <div class="col-lg-12">
            <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
              <div style="overflow: hidden;">
                <div class="table-responsive largeTable">
                  <table id="userTable" class="table table-bordered table-fill table-striped"
                    style="margin-bottom: 20px!important;">
                    <thead class="thead-dark header text-center" id="myHeader">
                      <tr>
                        @foreach($headers as $header=>$field)
                        @if($field == 'checkbox')
                        <th class="signbtn check-tblall selectall" style="width: 20px;">
                              <span style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center; display: block; min-width: 20px; margin: auto; background-color:#4D82C6; color: #fff;">✓</span>
                        </th>
                        @elseif($field == "formatted_support_amount")
                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('support_amount');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                        @else
                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');"
                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                        </th>
                        @endif
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($headers as $header=>$field)
                            @if($field == 'checkbox')
                            <td></td>
                            @elseif($field == "formatted_support_amount")
                            <td><input name="support_amount" value="{{isset($req_data['support_amount'])?$req_data['support_amount']:null}}" type="text" class="form-control"></td>
                            @elseif($field == "datatxt0151")
                            <td><input name="datatxt0151_short" value="{{isset($req_data['datatxt0151_short'])?$req_data['datatxt0151_short']:null}}" type="text" class="form-control"></td>
                            @else
                            <td><input name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" type="text" class="form-control"></td>
                            @endif
                        @endforeach
                      </tr>
                      
                      @if(isset($supportReqConfirmationInfo))
                      @foreach($supportReqConfirmationInfo as $key=>$val)
                      <tr style="height: 30px;">
                          @foreach($headers as $header=>$field)
                            @if($field == "support_number")
                            <td><a href="#" onclick="gotoSupportInquiry('{{$val->support_number}}',{{$val->ordertypebango2}})" style="text-decoration:underline;font-weight:600;">{{$val->support_number}}</a></td>
                            @elseif($field == "checkbox")
                                <td> <label class="checkbox_container" style="margin-left:18px !important;">
                                  <input class="checkAllCheckbox tblCheckBox checkedItem" type="checkbox" id="" name="selected_item[]" value="{{$val->kokyakuorderbango}}" @if(isset($old['Button']) && $old['Button'] == 'FirstSearch'){{'checked'}}@elseif(isset($supportReqConfirmation_selected_item) && in_array($val->kokyakuorderbango,$supportReqConfirmation_selected_item)){{'checked'}}@else{{''}}@endif>
                                  <span class="checkmark" style="top: -7.5px;left:-6px;"></span>
                                </label>
                                </td>
                            @elseif($field == "formatted_support_amount")
                                <td style="text-align:right;">{{$val->$field}}</td>
                            @elseif($field == "datatxt0151")
                                <td><a href="{{'/pdf/supportReqConfirmation/'.$val->$field}}" target="_blank" style="color:blue;">{{$val->datatxt0151_short}}</a></td>
                            @elseif($field == "user_name")
                                <td>{{$val->user_name_short}}</td>
                            @elseif($field == "changer_name")
                                <td>{{$val->changer_name_short}}</td>
                            @elseif($field == "inspector_name")
                                <td>{{$val->inspector_name_short}}</td>
                            @else
                                <td>{{$val->$field}}</td>
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                      @endif
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
