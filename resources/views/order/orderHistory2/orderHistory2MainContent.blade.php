<div class="content-bottom-section" style="padding-bottom:46px!important;">
  <form id="mainForm" action="{{ route('orderHistory2') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    <input type="hidden" id="pageName" value="order_history_2">
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
            {{-- <div class="bottom-top-btn" style="cursor: pointer;">
                  <span onclick="contentHideShow()" id="closetopcontent">閉じる</span>
                </div> --}}

            <div class="bottom-top-title">
              受注履歴一覧
            </div>
          </div>
        </div>
      </div>
      <div class="content-bottom-pagination">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;border-radius: 5px;">

                {{-- Pagination Starts Here --}}
                @include('order.orderHistory2.pagination')
                {{-- Pagination Ends Here --}}

                <div class="row" style="margin-bottom: 30px;">
                  <div class="col-6">
                    <div class="row">
                      <div class="col">
                        <table class="table custom-form custom-table" style="border: none!important;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                                販売金額計</td>
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td
                                style=" border: none!important;color: #000;font-weight: bold;font-size: 0.9em;">
                                @if(isset($order_amount))¥
                                {{number_format($order_amount)}} @endif</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col">
                        <table class="table custom-form" style="border: none!important;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                                営業粗利計</td>
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td
                                style=" border: none!important;color: #000;font-weight: bold;font-size: 0.9em;">
                                @if(isset($gross_profit))¥
                                {{number_format($gross_profit)}} @endif</td>
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
                              class="btn bg-teal uskc-button text-white" style="">検索
                            </button>
                          </td>
                          <td style=" border: none!important;">
                            <a href="#" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button"
                              data-dismiss="modal">一覧
                            </a>
                          </td>
                          <td style=" border: none!important;">
                            <button type="button" id="excelDwld" onclick="excelDownload()"
                              message="データをEXCELファイルとしてダウンロードします。" class="btn uskc-button text-white" data-dismiss="modal"
                              style="background: #009640;">
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
            <div style="background-color:#fff;padding: 10px;">
              <div class="wrapper-large-table largeTable" style="overflow-x: auto;">
                  <div>
                    <table id="userTable" class="table table-bordered table-fill table-striped"
                      style="margin-bottom: 20px!important;">
                      <thead class="thead-dark header text-center" id="myHeader">
                        <tr>
                          @foreach($headers as $header=>$field)
                              @if($field == 'hktsyukko_datachar01_detail')
                                  <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');"
                                      style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                                  </th>
                              @elseif($field == 'hktsyukko_datachar06_detail')
                                  <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');"
                                      style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                                  </th>
                              @else
                              <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');"
                                  style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                              </th>
                              @endif
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach($headers as $header=>$field)
                              @if($field == 'hktsyukko_datachar01_detail')
                                  <td>
                                  <select class="form-control" name="{{$field}}" id="" style="border: 1px solid #E1E1E1 !important; border-radius: 4px !important;">
                                      <option value="">-</option>
                                      @foreach($hktsyukko_datachar01 as $hktsyukko_dtchar01)
                                      <option value="{{$hktsyukko_dtchar01->syouhinbango}}" @if(isset($old['hktsyukko_datachar01']) && $hktsyukko_dtchar01->syouhinbango == $old['hktsyukko_datachar01']){{'selected'}}@endif>{{$hktsyukko_dtchar01->syouhinbango.' '}}{{$hktsyukko_dtchar01->jouhou}}</option>
                                      @endforeach
                                  </select>
                                  </td>
                              @elseif($field == 'hktsyukko_datachar06_detail')
                                  <td>
                                  <select class="form-control" name="{{$field}}" id="" style="border: 1px solid #E1E1E1 !important; border-radius: 4px !important;">
                                      <option value="">-</option>
                                      @foreach($hktsyukko_datachar06 as $hktsyukko_dtchar06)
                                      <option value="{{$hktsyukko_dtchar06->syouhinbango}}" @if(isset($old['hktsyukko_datachar06']) && $hktsyukko_dtchar06->syouhinbango == $old['hktsyukko_datachar06']){{'selected'}}@endif>{{$hktsyukko_dtchar06->syouhinbango.' '}}{{$hktsyukko_dtchar06->jouhou}}</option>
                                      @endforeach
                                  </select>
                                  </td>
                              @elseif($field == "formatted_money10")
                                <td>
                                  <input type="text" name="money10" class="form-control"
                                    value="{{isset($req_data['money10'])?$req_data['money10']:null}}">
                                </td>  
                              @elseif($field == "user_name")
                                <td>
                                  <input type="text" name="user_name_search" class="form-control"
                                    value="{{isset($req_data['user_name_search'])?$req_data['user_name_search']:null}}">
                                </td>   
                              @elseif($field == "datachar02_tan_name")
                                <td>
                                  <input type="text" name="datachar02_tan_name_search" class="form-control"
                                    value="{{isset($req_data['datachar02_tan_name_search'])?$req_data['datachar02_tan_name_search']:null}}">
                                </td>
                              @elseif($field == "datachar03_tan_name")
                                <td>
                                  <input type="text" name="datachar03_tan_name_search" class="form-control"
                                    value="{{isset($req_data['datachar03_tan_name_search'])?$req_data['datachar03_tan_name_search']:null}}">
                                </td>
                              @elseif($field == "datachar05_tan_name")
                                <td>
                                  <input type="text" name="datachar05_tan_name_search" class="form-control"
                                    value="{{isset($req_data['datachar05_tan_name_search'])?$req_data['datachar05_tan_name_search']:null}}">
                                </td>
                              @elseif($field == "datachar07_tan_name")
                                <td>
                                  <input type="text" name="datachar07_tan_name_search" class="form-control"
                                    value="{{isset($req_data['datachar07_tan_name_search'])?$req_data['datachar07_tan_name_search']:null}}">
                                </td>
                              @else
                              <td>
                                <input type="text" name="{{$field}}" class="form-control"
                                  value="{{isset($req_data[$field])?$req_data[$field]:null}}">
                              </td>
                              @endif
                          @endforeach
                        </tr>

                        @if(isset($orderHistory2Info))
                          @foreach($orderHistory2Info as $key=>$val)
                          <tr>
                            <!-- key field value to update in hikiatesyukko -->
                            <!--<input type="hidden" name="each_hktsyukko_orderbango[]" value="{{$val->bango}}" /> -->

                            @php
                                $number_format_field = ['sum_of_dataint05','sum_of_dataint06','sum_of_dataint07'];
                                $text_align_field = ['formatted_money10','sum_of_dataint05','sum_of_dataint06','sum_of_dataint07','ordertypebango2','order_history_datachar03','order_history_datachar08','order_history_datachar09'];
                            @endphp
                            @foreach($headers as $header=>$field)
                            @if($field == "kokyakuorderbango")
                            <td><a href="#" onclick="gotoOrderInquiry('{{$val->kokyakuorderbango}}',{{$val->ordertypebango2}})"
                                style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a></td>
                            @elseif($field == 'hktsyukko_datachar01_detail')
                                @if($tantousya->innerlevel<=12)
                                <td>
                                    @if($val->active_order_flag == 1)
                                    <!--<span style="position: relative;top:7px;">{{$val->$field}}</span>-->
                                    <select class="form-control dtchar01" name="each_hktsyukko_dtchar01[]" id="" style="float: right;width: 100%;border: 1px solid #E1E1E1 !important;  border-radius: 4px !important;">
                                        @foreach($hktsyukko_datachar01 as $hktsyukko_dtchar01)
                                        <option value="{{$hktsyukko_dtchar01->syouhinbango}} {{$val->bango}}" @if($val->hktsyukko_datachar01 == $hktsyukko_dtchar01->syouhinbango){{"selected"}}@endif>{{$hktsyukko_dtchar01->syouhinbango.' '}}{{$hktsyukko_dtchar01->jouhou}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    {{$val->$field}}
                                    @endif
                                </td>
                                @else
                                <td>{{$val->$field}}</td>
                                @endif
                            @elseif($field == 'hktsyukko_datachar06_detail')
                                @if($tantousya->innerlevel<=12)
                                <td>
                                    @if($val->active_order_flag == 1)
                                    <!--<span style="position: relative;top:7px;">{{$val->$field}}</span>-->
                                    <select class="form-control" name="each_hktsyukko_dtchar06[]" id="" style="float: right;width: 100%;border: 1px solid #E1E1E1 !important;  border-radius: 4px !important;">
                                        @foreach($hktsyukko_datachar06 as $hktsyukko_dtchar06)
                                        <option value="{{$hktsyukko_dtchar06->syouhinbango}} {{$val->bango}}" @if($val->hktsyukko_datachar06 == $hktsyukko_dtchar06->syouhinbango){{"selected"}}@endif>{{$hktsyukko_dtchar06->syouhinbango.' '}}{{$hktsyukko_dtchar06->jouhou}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    {{$val->$field}}
                                    @endif
                                </td>
                                @else
                                <td>{{$val->$field}}</td>
                                @endif
                            @elseif($field == "user_name")
                              <td>{{$val->user_name_short}}</td>
                            @elseif($field == "juchukubun1")
                            <td>{{$val->juchukubun1_short}}</td>
                            @elseif($field == "datachar02_tan_name")
                              <td>{{$val->datachar02_tan_name_short}}</td>
                            @elseif($field == "datachar03_tan_name")
                              <td>{{$val->datachar03_tan_name_short}}</td>
                            @elseif($field == "datachar05_tan_name")
                              <td>{{$val->datachar05_tan_name_short}}</td>
                            @elseif($field == "datachar07_tan_name")
                              <td>{{$val->datachar07_tan_name_short}}</td>
                            @elseif(in_array($field,$number_format_field))
                            <td style="text-align: right;">{{ $val->$field == null ? $val->$field : number_format($val->$field) }}</td>
                            @elseif(in_array($field,$text_align_field))
                                <td style="text-align: right;">{{$val->$field}}</td>
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
