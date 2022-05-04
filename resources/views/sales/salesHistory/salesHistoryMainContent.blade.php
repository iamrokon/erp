<?php
// echo '<pre/>';
// print_r($salesHistoryInfo);
// exit();
?>

<div class="content-bottom-section" style="padding-bottom:46px!important;">
  <form id="mainForm" action="{{ route('salesHistory') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="changeStatus" value="0">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    @csrf
    @if(isset($fsReqData))
      @foreach($fsReqData as $k=>$v)
        <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
      @endforeach
    @endif
    <div class="content-bottom-top">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="bottom-top-title" style="letter-spacing: 0px;">
              売 上 履 歴 一 覧
            </div>
          </div>
        </div>
      </div>
      <div class="content-bottom-pagination">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                @include('sales.salesHistory.pagination')
                <div class="row" style="margin-bottom: 30px;">
                  <div class="col-6">
                    <div class="row">
                      <div class="col">
                        <table class="table custom-form custom-table" style="bsales: none!important;width: auto;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                販売金額計</td>
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td
                                style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                ¥{{ number_format($total_sales) }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col">
                        <table class="table custom-form" style="border: none!important;width: auto;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                営業粗利計</td>
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td
                                style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                ¥{{ number_format($gross_profit) }}</td>
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
                            <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                              class="btn bg-teal uskc-button text-white" data-dismiss="modal"> 検　索
                            </button>
                          </td>
                          <td style=" border: none!important;">
                            <button type="button" onclick="refresh()" message="データを一覧表示します。"
                              class="btn text-white bg-default uskc-button" data-dismiss="modal">
                              <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                            </button>
                          </td>
                          <td style=" border: none!important;">
                            <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button"
                              data-dismiss="modal" style="background: #009640;">
                              <!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> Excelエクスポート
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
            <div  class="wrapper-large-table " style="background-color:#fff;padding:10px; ">
              <!-- <div>
                <div class="" > -->
                <div class="largeTable" style="overflow-x: auto;">
                  <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;width: 100%!important">
                    <thead class="thead-dark header text-center" id="myHeader">
                      <tr>
                        @foreach($headers as $header=>$field)
                            <th scope="col" class="signbtn">
                              @if($field == "sales_history_juchukubun2") 
                              <span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center; background-color:#3e6ec1; color: #fff;max-width: 66px; display: block;">{{$header}}</span>
                              @else
                              <span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;margin: auto;background-color:#3e6ec1; color: #fff;min-width: 80px;display: block;">{{$header}}</span>
                              @endif
                            </th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($headers as $header=>$field)
                        @if($field == "user_name")
                          <td>
                            <input type="text" name="user_name_short" class="form-control"
                              value="{{isset($default_req_data['user_name_short'])?$default_req_data['user_name_short']:null}}">
                          </td>
                        @elseif($field == "user_name2")
                          <td>
                            <input type="text" name="user_name_short2" class="form-control"
                              value="{{isset($default_req_data['user_name_short2'])?$default_req_data['user_name_short2']:null}}">
                          </td>
                        @elseif($field == "updated_user")
                          <td>
                              <input type="text" name="updated_user_short" class="form-control"
                                     value="{{isset($default_req_data['updated_user_short'])?$default_req_data['updated_user_short']:null}}">
                          </td>
                        @elseif($field == "updated_user1")
                          <td>
                              <input type="text" name="updated_user1_short" class="form-control"
                                     value="{{isset($default_req_data['updated_user1_short'])?$default_req_data['updated_user1_short']:null}}">
                          </td>
                        @elseif($field == "sales_history_juchukubun2")
                        <td>
                          <input type="text" name="{{$field}}" class="form-control" value="{{isset($default_req_data[$field])?$default_req_data[$field]:null}}" style="width: 85px;">
                        </td>
                        @else
                        <td>
                          <input type="text" name="{{$field}}" class="form-control" value="{{isset($default_req_data[$field])?$default_req_data[$field]:null}}">
                        </td>
                        @endif
                        @endforeach
                      </tr>
                      @php
                        $text_align_field = ['updated_times'];
                        $money_format_fields = ['numeric3','moneymax'];
                      @endphp
                      <!--      2nd row -->
                      @foreach($salesHistoryInfo as $key=>$val)
                      <tr class="dropdown_parent">
                        @foreach($headers as $header=>$field)
                          @if($privileged_user&&$field=='housoukubun_val')
                            <td>
                                <input type="hidden" class="dropdown_change_status_1" name="dropdown_change_status_1[]">
                                <select class="form-control dropdown" name="update[{{ $val->bango }}][{{ $field }}]">
                                  @foreach($housoukubun_dropdown as $value=>$option)
                                    <option value="{{ $value }}" @if($val->$field==$option) {{ " selected" }}@endif>{{ $option }}</option>
                                  @endforeach
                                </select>
                            </td>
                          @elseif($privileged_user&&$field=='intorder05')
                          <td style="width: 151px;">
                            <div class="input-group">
                              <input id="table_date" type="text" class="form-control input_field date-hide-td" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" oninput="updateStatus(); this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" maxlength="10" autocomplete="off"  placeholder="年/月/日" style="width: 96px!important;" name="update[{{ $val->bango }}][{{ $field }}]" value="{{$val->$field}}">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                          @elseif($privileged_user&&$field=='kessaihouhou_val')
                            <td>
                                <input type="hidden" class="dropdown_change_status_2" name="dropdown_change_status_2[]">
                                <select class="form-control dropdown" name="update[{{ $val->bango }}][{{ $field }}]">
                                  @foreach($category_dropdown as $value=>$option)
                                    <option value="{{ $value }}" @if($val->$field==$option) {{ " selected" }}@endif>{{ $option }}</option>
                                  @endforeach
                                </select>
                            </td>
                          @elseif($privileged_user&&strpos($field, 'dataint01_val')!==false)
                            <td>
                              <select class="form-control" onchange="updateStatus()" name="update[{{ $val->bango }}][{{ $field }}]">
                                @foreach($dataint_dropdown[$field] as $value=>$option)
                                  <option value="{{ $value }}" @if($val->$field==$option) {{ " selected" }}@endif>{{ $option }}</option>
                                @endforeach
                              </select>
                            </td>
                          @elseif($field=="sales_history_youbou")
                            <td>
                              <a href="{{url('pdf/salesSlip/'.$val->$field)}}" target="_blank">{{ $val->$field }}</a>
                            </td>
                          @elseif($field == "kokyakuorderbango")
                            <td>
                              <a href="#" onclick="gotoOrderInquiry('{{$val->kokyakuorderbango}}',{{$val->order_inquiry_ordertypebango2}})" style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                              <input type="hidden" name="update[{{ $val->bango }}][{{ $field }}]" value="{{$val->$field}}">
                            </td>
                          @elseif($field == "user_name")
                            <td>{{$val->user_name_short}}</td>
                          @elseif($field == "user_name2")
                            <td>{{$val->user_name_short2}}</td>
                          @elseif($field == "updated_user")
                              <td>{{$val->updated_user_short}}</td>
                          @elseif($field == "updated_user1")
                              <td>{{$val->updated_user1_short}}</td>
                          @elseif($field == "juchukubun1")
                              <td>{{$val->juchukubun1_short}}</td>
                          @elseif(in_array($field,$text_align_field))
                            <td style="text-align: right;">{{$val->$field}}</td>
                          @elseif(in_array($field,$money_format_fields))
                              <td style="text-align: right;">{{number_format($val->$field)}}</td>
                          @elseif($field == "sales_history_juchukubun2")
                          <td><a href="#" onclick="gotoSalesInquiry('{{$val->kokyakuorderbango}}',{{$val->ordertypebango2}})"
                              style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                              @if($val->text4_display != null)
                              <a style="color:#0056b3;" class="btn btn-info" target="_blank" href="{{url('pdf/salesSlip/'.$val->text4_display)}}">PDF</a>
                              @endif
                            </td>
                          @elseif($field == "dataint06_val")
                              <input type="hidden" class="dataint06" name="dataint06[]" value="{{$val->dataint06}}">
                              <td>{{$val->$field}}</td>
                          @else
                            <td>{{$val->$field}}</td>
                          @endif
                        @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
function updateStatus(){
  document.getElementById("changeStatus").value = 1;
}
// function updateStatus1(){
//   //var parentLine = $(this).parents('.dropdown_parent');
//   var parentLineForm = $(this).parents('.dropdown_parent');
//   //console.log("Hello")
//   console.log(parentLineForm)
//   console.log(parentLineForm.find('.dropdown_change_status_1').val())
//   parentLineForm.find($('input[name="dropdown_change_status_1[]"]')).val("ss");
//   document.getElementById("changeStatus").value = 1;
// }
// function updateStatus2(){
//   var parentLine = $(this).parents('.dropdown_parent');
//   parentLine.find('input[name="dropdown_change_status_2[]"]').val(1);
//   document.getElementById("changeStatus").value = 1;
// }
</script>
