@php
if(isset($salesSlipInfo)){
    $skip = 0;
    $old = array();
    if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
    }
    $current_page = $salesSlipInfo->currentPage();
    $per_page = $salesSlipInfo->perPage();
    $first_data = ($current_page - 1)*$per_page+1;
    $last_data = ($current_page - 1)*$per_page+ sizeof($salesSlipInfo->items());
    $total = $salesSlipInfo->total();
    $lastPage = $salesSlipInfo->lastPage() ;
}else{
    $current_page = 1;
    $per_page = 20;
    $first_data = 1;
    $last_data = 0;
    $total = 0;
    $lastPage = 1;
}

//check button name
//if(isset($old['Button']) && ($old['Button'] == 'Thesearch' || $old['Button'] == 'FirstSearch')){
//    $button_name = 'Thesearch';
//}elseif(isset($old['Button']) && ($old['Button'] == 'refresh')){
//    $button_name = 'refresh';
//}else{
//    $button_name = null;
//}

if(session()->has('salisSlip_selected_item')){
    $salisSlip_selected_item = session()->get('salisSlip_selected_item');
}

@endphp
<div class="content-bottom-section" style="margin-top: 15px;">
    <form id="mainForm" action="{{ route('salesSlip') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
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
                  売上伝票発行
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">

                  <!-- Pagination Starts Here -->
                  @include('sales.salesSlip.pagination')
                  <!-- Pagination Ends Here -->


                  <div class="row" style="margin-bottom: 30px;">
                    <div class="col-6">
                      <div class="row">
                        <div class="col">
                          <table class="table custom-form" style="border: none!important;width: auto;">
                            <tbody>
                              <tr style="">
                                <!-- <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td> -->
                                <td style=" border: none!important;width: 60px!important;color: #000;font-size: 0.9em;">チェック数 :</td>
                                <td style=" border: none!important;width: 15px!important;"></td>
                                <td style=" border: none!important;width: 50%;color: #000;font-size: 0.9em;" id="countCheckedItem">0</td>
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
                                <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" class="btn bg-teal text-white uskc-button">
                                    検　索
                                </button>
                            </td>
                            <td style=" border: none!important;">
                              <button type="button" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button" data-dismiss="modal"> 一　覧
                              </button>
                            </td>
                            <td style=" border: none!important;">
                              <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button" data-dismiss="modal" style="background: #009640;"> Excelエクスポート
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
        <div class="content-bottom-pagination" style="margin-top: 15px;">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div style="background-color:#fff;padding: 10px;">
                  <div id="userTable" class="table-responsive" style="">
                    <table class="table table-fill table-bordered table-striped custom-form">
                      <thead class="thead-dark header text-center" id="myHeader">
                        <tr>
                            @foreach($headers as $header=>$field)
                            @if($field == 'checkbox')
                            <th class="signbtn check-tblall selectall"><span style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 20px;margin: auto;background-color:#4D82C6;  color: #fff;">✓</span></th>
                            <th class="signbtn uncheck-tblall unselectall" style="display: none;"><span style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 20px;margin: auto;background-color:#4D82C6;  color: #fff;">✓</span></th>
                            @elseif($field == 'other11')
                            <th colspan="2" class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                            @elseif($field == 'formatted_money10')
                            <th class="signbtn"><span onclick="AscDsc('money10');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;">{{$header}}</span></th>
                            @else
                            <th class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;">{{$header}}</span></th>
                            @endif
                            @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach($headers as $header=>$field)
                          @if($field == 'checkbox')
                          <td>
                          </td>
                          @elseif($field == "user_name")
                          <td>
                            <input type="text" name="user_name_search" class="form-control"
                            value="{{isset($req_data['user_name_search'])?$req_data['user_name_search']:null}}">
                          </td>
                          @elseif($field == "hktsyukko_datachar05_detail")
                          <td>
                            <input type="text" name="hktsyukko_datachar05_detail_search" class="form-control"
                            value="{{isset($req_data['hktsyukko_datachar05_detail_search'])?$req_data['hktsyukko_datachar05_detail_search']:null}}">
                          </td>
                          @elseif($field == "formatted_money10")
                          <td>
                            <input type="text" name="money10" class="form-control"
                            value="{{isset($req_data['money10'])?$req_data['money10']:null}}">
                          </td>
                          @elseif($field == 'other11')
                          <td colspan="2">
                            <input type="text" name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" class="form-control">
                          </td>
                          @else
                          <td>
                            <input type="text" name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" class="form-control">
                          </td>
                          @endif
                          @endforeach
                        </tr>
                        
                        @if(isset($salesSlipInfo))
                        @foreach($salesSlipInfo as $key=>$val)

                        <tr>
                            @foreach($headers as $header=>$field)
                              
                                @if($field == "checkbox")
             
                                <td> 
                                    <label class="checkbox_container" style="margin-left:18px !important;">
                                    <input class="checkAllCheckbox tblCheckBox checkedItem" type="checkbox" id="" name="selected_item[]" value="{{$val->kokyakuorderbango}}" @if(isset($salisSlip_selected_item) && in_array($val->kokyakuorderbango,$salisSlip_selected_item)){{'checked'}}@endif>
                                    <span class="checkmark" style="top: -9px;left:-6px;"></span>
                                    </label>
                                </td>
                                @elseif($field == "juchukubun1")
                                <td>{{$val->juchukubun1_short}}</td>
                                @elseif($field == "user_name")
                                <td>{{$val->user_name_short}}</td>
                                @elseif($field == "hktsyukko_datachar05_detail")
                                <td>{{$val->hktsyukko_datachar05_detail_short}}</td>
                                @elseif($field == "formatted_money10")
                                <td style="text-align: right;">{{$val->$field}}</td>
                                @elseif($field == "juchukubun2")
                                <td><a href="#" onclick="gotoOrderInquiry('{{$val->kokyakuorderbango}}',{{$val->ordertypebango2}})"
                                    style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a></td>
                                @elseif($field == "text4")
                                <td><a href="{{'/pdf/salesSlip/'.$val->$field}}" target="_blank" style="color:blue;">{{$val->$field}}</a></td>
                                @elseif($field == "sales_slip_juchukubun2")
                                <td><a href="#" onclick="gotoSalesInquiry('{{$val->kokyakuorderbango}}',{{$val->ordertypebango2}})"  style="color:#0056b3;text-decoration:underline;">{{$val->$field}}</a></td>
                                @elseif($field == 'other11')
                                <td style="text-align: center;">{{$val->$field}}</td>
                                <td style="text-align: center;"><button class="btn" style="padding:0px;line-height: 0;color:#333;"><i class="fa fa-envelope-o"></i></button></td>
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
    </form>
</div>