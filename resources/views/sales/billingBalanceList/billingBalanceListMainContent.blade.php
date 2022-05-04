 <!-- content bottom section start -->
 <div class="content-bottom-section" style="margin-top: 15px; padding-bottom:46px;">
 <form id="mainForm" action="{{ route('billingBalanceList') }}" method="post">
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

  <div class="content-bottom-top" style="margin-bottom: 30px;">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          請求残高一覧
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
            <!-- new pagination row starts here -->
            @include('sales.billingBalanceList.pagination')
            <!----------pagination End----------------->
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <div class="col">
                    <table class="table custom-form" style="border: none!important;width: auto;">
                      <tbody>
                        <tr style="">
                          <!-- <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td> -->
                          <td style=" border: none!important;width: 60px!important;color: #000;font-size: 0.9em;">
                            </td>
                          <td style=" border: none!important;width: 15px!important;"></td>
                          <td style=" border: none!important;width: 50%;color: #000;    font-size: 0.9em;">
                          </td>
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
                        <button type="button" id="choice_button" class="btn bg-teal uskc-button text-white"
                         onclick="Thesearch();" message="検索欄に入力した内容を検索します。" data-dismiss="modal" style="">検　索
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button type="button" id="refreshPage" class="btn text-white bg-default uskc-button"
                         onclick="refresh()" message="データを一覧表示します。" data-dismiss="modal" style=""> 一　覧
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button type="button" id="excelDwld" class="btn text-white uskc-button" data-dismiss="modal"
                        onclick="excelDownload()"message="データをEXCELファイルとしてダウンロードします。" style="background: #009640;"> Excelエクスポート
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
          <div style="background-color:#fff;padding: 10px 0 0 10px;">
            <div id="userTable" class="table-responsive" style="overflow:auto;">
              <table class="table table-fill table-bordered table-striped custom-form">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    <!--  <th></th> -->
                    <!-- <th class="signbtn"><span class="table_header">売上請求先CD</span></th>
                    <th class="signbtn"><span class="table_header">売上請求先</span></th>
                    <th class="signbtn"><span class="table_header">前回請求額</span></th>
                    <th class="signbtn"><span class="table_header">現金入金額</span></th>
                    <th class="signbtn"><span class="table_header">手形入金</span></th>
                    <th class="signbtn"><span class="table_header">今回値引他</span></th>
                    <th class="signbtn"><span class="table_header">今回繰越額</span></th>
                    <th class="signbtn"><span class="table_header">今回売上額</span></th>
                    <th class="signbtn"><span class="table_header">今回消費税</span></th>
                    <th class="signbtn"><span class="table_header">今回請求額</span></th>
                    <th class="signbtn"><span class="table_header">即時請求額</span></th>
                    <th class="signbtn"><span class="table_header">即時請求税</span></th> -->
                    @php
                       $formatted_field = ['formatted_data202','formatted_data203','formatted_data204','formatted_data205','formatted_data206','formatted_data207','formatted_data208','formatted_data209','formatted_data210','formatted_data211','formatted_data212','formatted_data252','formatted_data253','formatted_data254','formatted_data255','formatted_data256','formatted_data257','formatted_data258','formatted_data259','formatted_data260','formatted_data261','formatted_data262','formatted_data263','formatted_data264','formatted_data265'];
                    @endphp
                    <tr>
                    @foreach($headers as $header=>$field)
                        @if(in_array($field,$formatted_field))
                           @php
                           $field = str_replace("formatted_","",$field);
                           @endphp
                            <th class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                        @else
                            <th class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                        @endif
                     @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <!-- <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="">
                    </td> -->
                               @foreach($headers as $header=>$field)
                                  
                                        @if(in_array($field,$formatted_field))
                                            @php
                                            $field = str_replace("formatted_","",$field);
                                            @endphp
                                            <td>
                                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}">
                                            </td>
                                        @else
                                        <td>
                                            <input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}" >
                                        </td>
                                        @endif
                                @endforeach
                  </tr>
                  <!--      2nd row -->
                   <!-- <tr>
                    <td>20570101</td>
                    <td>ジョイアスフーズ／本社</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">7370055</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">7370055</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">7370055</td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">0</td> 
                    </tr> -->
                                 @if(isset($billingBalanceListInfo))
                                    @foreach($billingBalanceListInfo as $key=>$val)
                                        <tr>
                                            @foreach($headers as $header=>$field)                              
                                                @if($field == 'formatted_data203' || $field == 'formatted_data204' || $field == 'formatted_data205' || $field == 'formatted_data206' ||
                                                $field == 'formatted_data207' || $field == 'formatted_data208' || $field == 'formatted_data209' || $field == 'formatted_data210' || $field == 'formatted_data211' ||
                                                $field == 'formatted_data212' || $field == 'formatted_data252' || $field == 'formatted_data253' || $field == 'formatted_data254' || $field == 'formatted_data255' ||
                                                $field == 'formatted_data256' || $field == 'formatted_data257' || $field == 'formatted_data258' || $field == 'formatted_data259' || $field == 'formatted_data260') 
                                                    <td style="text-align: right">{{$val->$field}}</td>
                                                @else
                                                    <td>{{$val->$field}}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif

                     @if(isset($formatted_total203) && $formatted_total203 != null || isset($formatted_total204) && $formatted_total204 != null || isset($formatted_total205) && $formatted_total205 != null || isset($formatted_total206) && $formatted_total206 != null || isset($formatted_total207) && $formatted_total207 != null || isset($formatted_total208) && $formatted_total208 != null || isset($formatted_total209) && $formatted_total209 != null || isset($formatted_total210) && $formatted_total210 != null || isset($formatted_total211) && $formatted_total211 != null || isset($formatted_total212) && $formatted_total212 != null || isset($formatted_total252) && $formatted_total252 != null || isset($formatted_total253) && $formatted_total253 != null || isset($formatted_total254) && $formatted_total254 != null || isset($formatted_total255) && $formatted_total255 != null || isset($formatted_total256) && $formatted_total256 != null || isset($formatted_total257) && $formatted_total257 != null || isset($formatted_total258) && $formatted_total258 != null || isset($formatted_total259) && $formatted_total259 != null || isset($formatted_total260) && $formatted_total260 != null)
                    <tr>
                      @foreach($headers as $header=>$field)
                        @if($field == "formatted_data202")
                        <td>合計</td>
                        @elseif($field == "formatted_data203")
                        <td class="text-right">{{ isset($formatted_total203) && $formatted_total203 == null ? $formatted_total203 : number_format($formatted_total203) }}</td>
                        @elseif($field == "formatted_data204")
                        <td class="text-right">{{ isset($formatted_total204) && $formatted_total204 == null ? $formatted_total204 : number_format($formatted_total204) }}</td>
                        @elseif($field == "formatted_data205")
                        <td class="text-right">{{ isset($formatted_total205) && $formatted_total205 == null ? $formatted_total205 : number_format($formatted_total205) }}</td>
                        @elseif($field == "formatted_data206")
                        <td class="text-right">{{ isset($formatted_total206) && $formatted_total206 == null ? $formatted_total206 : number_format($formatted_total206) }}</td>
                        @elseif($field == "formatted_data207")
                        <td class="text-right">{{ isset($formatted_total207) && $formatted_total207 == null ? $formatted_total207 : number_format($formatted_total207) }}</td>
                        @elseif($field == "formatted_data208")
                        <td class="text-right">{{ isset($formatted_total208) && $formatted_total208 == null ? $formatted_total208 : number_format($formatted_total208) }}</td>
                        @elseif($field == "formatted_data209")
                        <td class="text-right">{{ isset($formatted_total209) && $formatted_total209 == null ? $formatted_total209 : number_format($formatted_total209) }}</td>
                        @elseif($field == "formatted_data210")
                        <td class="text-right">{{ isset($formatted_total210) && $formatted_total210 == null ? $formatted_total210 : number_format($formatted_total210) }}</td>
                        @elseif($field == "formatted_data211")
                        <td class="text-right">{{ isset($formatted_total211) && $formatted_total211 == null ? $formatted_total211 : number_format($formatted_total211) }}</td>
                        @elseif($field == "formatted_data212")
                        <td class="text-right">{{ isset($formatted_total212) && $formatted_total212 == null ? $formatted_total212 : number_format($formatted_total212) }}</td>
                        @elseif($field == "formatted_data252")
                        <td class="text-right">{{ isset($formatted_total252) && $formatted_total252 == null ? $formatted_total252 : number_format($formatted_total252) }}</td>
                        @elseif($field == "formatted_data253")
                        <td class="text-right">{{ isset($formatted_total253) && $formatted_total253 == null ? $formatted_total253 : number_format($formatted_total253) }}</td>
                        @elseif($field == "formatted_data254")
                        <td class="text-right">{{ isset($formatted_total254) && $formatted_total254 == null ? $formatted_total254 : number_format($formatted_total254) }}</td>
                        @elseif($field == "formatted_data255")
                        <td class="text-right">{{ isset($formatted_total255) && $formatted_total255 == null ? $formatted_total255 : number_format($formatted_total255) }}</td>
                        @elseif($field == "formatted_data256")
                        <td class="text-right">{{ isset($formatted_total256) && $formatted_total256 == null ? $formatted_total256 : number_format($formatted_total256) }}</td>
                        @elseif($field == "formatted_data257")
                        <td class="text-right">{{ isset($formatted_total257) && $formatted_total257 == null ? $formatted_total257 : number_format($formatted_total257) }}</td>
                        @elseif($field == "formatted_data258")
                        <td class="text-right">{{ isset($formatted_total258) && $formatted_total258 == null ? $formatted_total258 : number_format($formatted_total258) }}</td>
                        @elseif($field == "formatted_data259")
                        <td class="text-right">{{ isset($formatted_total259) && $formatted_total259 == null ? $formatted_total259 : number_format($formatted_total259) }}</td>
                        @elseif($field == "formatted_data260")
                        <td class="text-right">{{ isset($formatted_total260) && $formatted_total260 == null ? $formatted_total260 : number_format($formatted_total260) }}</td>
                        @else
                        <td> </td>
                        @endif
                      @endforeach   
                    </tr> 
                    @endif 
            
                  <!-- <tr>
                    <td></td>
                    <td>合計</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                    <td>-999999999</td>
                  </tr> -->
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
<!-- content bottom section end -->