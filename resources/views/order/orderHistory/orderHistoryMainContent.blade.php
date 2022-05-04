<div class="content-bottom-section" style="padding-bottom:46px!important;">
  <form id="mainForm" action="{{ route('orderHistory') }}" method="post">
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
              <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">

                {{-- Pagination Starts Here --}}
                @include('order.orderHistory.pagination')
                {{-- Pagination Ends Here --}}

               {{-- @php
                if(isset($orderHistoryInfo)){
                    foreach($orderHistoryInfo as $key=>$value){
                        $order_amount = $orderHistoryInfo[$key]->order_amount;
                        $gross_profit = $orderHistoryInfo[$key]->gross_profit;
                        if( $skip == 0 )break;
                    }
                }
                @endphp --}}

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
                              class="btn bg-teal uskc-button text-white">検索
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
            <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
              <div class="table-responsive largeTable">
                <table id="userTable" class="table table-bordered table-fill table-striped"
                  style="margin-bottom: 20px!important;">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                      <th scope="col"></th>
                      @foreach($headers as $header=>$field)
                        @if($field == 'formatted_money10')
                        <th class="signbtn" scope="col"><span onclick="AscDsc('money10');"
                            style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                        </th>
                        @elseif($field == 'formatted_moneymax')
                        <th class="signbtn" scope="col"><span onclick="AscDsc('moneymax');"
                            style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                        </th>
                        @elseif($field == 'changer')
                        <th class="signbtn" scope="col"><span onclick="AscDsc('changer_short');"
                            style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6;color: #fff;border-radius: 4px;">{{$header}}</span>
                        </th>
                        @elseif($field == 'tantousyabango')
                        <th class="signbtn" scope="col"><span onclick="AscDsc('tantousyabango_short');"
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
                      <td class="text-center"></td>
                      @foreach($headers as $header=>$field)
                        @if($field == "user_name")
                        <td>
                          <input type="text" name="user_name_search" class="form-control"
                            value="{{isset($req_data['user_name_search'])?$req_data['user_name_search']:null}}">
                        </td>
                        @elseif($field == "datachar17_tan_name")
                            <td>
                              <input type="text" name="datachar17_tan_name_search" class="form-control"
                                value="{{isset($req_data['datachar17_tan_name_search'])?$req_data['datachar17_tan_name_search']:null}}">
                            </td>
                        @elseif($field == "datachar18_tan_name")
                            <td>
                              <input type="text" name="datachar18_tan_name_search" class="form-control"
                                value="{{isset($req_data['datachar18_tan_name_search'])?$req_data['datachar18_tan_name_search']:null}}">
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
                        @elseif($field == "changer")
                            <td>
                              <input type="text" name="changer_short" class="form-control"
                                value="{{isset($req_data['changer_short'])?$req_data['changer_short']:null}}">
                            </td>
                        @elseif($field == "tantousyabango")
                            <td>
                              <input type="text" name="tantousyabango_short" class="form-control"
                                value="{{isset($req_data['tantousyabango_short'])?$req_data['tantousyabango_short']:null}}">
                            </td>
                        @elseif($field == "formatted_money10")
                            <td>
                              <input type="text" name="money10" class="form-control"
                                value="{{isset($req_data['money10'])?$req_data['money10']:null}}">
                            </td>
                        @elseif($field == "formatted_moneymax")
                            <td>
                              <input type="text" name="moneymax" class="form-control"
                                value="{{isset($req_data['moneymax'])?$req_data['moneymax']:null}}">
                            </td>
                        @else
                        <td>
                          <input type="text" name="{{$field}}" class="form-control"
                            value="{{isset($req_data[$field])?$req_data[$field]:null}}">
                        </td>
                        @endif
                      @endforeach
                    </tr>

                    @if(isset($orderHistoryInfo))
                      @foreach($orderHistoryInfo as $key=>$val)
                      <tr>
                        <td style="width:50px;">
                          <a href="#" onclick="gotoOrderEntry('{{$val->kokyakuorderbango}}','{{$val->datachar01}}','{{$val->datachar02}}')" id="productsubButton1" class="btn btn-info pro-sub-edit" style="@if($val->active_order_flag != 1 || $val->delete_status == 2)opacity:0.65 !important;pointer-events: none;@endif width: 100%;" type="button"><i class="fa fa-pencil-square-o"
                              aria-hidden="true" style="margin-right: 5px;"></i>編集</a>
                        </td>
                        @php
                            //$number_format_field = ['money10','moneymax'];
                            $text_align_field = ['formatted_money10','formatted_moneymax','ordertypebango2','datachar03','datachar08','datachar09','initial_ordertypebango2'];
                        @endphp
                        @foreach($headers as $header=>$field)
                        @if($field == "kokyakuorderbango")
                        <td><a href="#" onclick="gotoOrderInquiry('{{$val->kokyakuorderbango}}',{{$val->ordertypebango2}})"
                            style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a></td>
                        @elseif($field == "user_name")
                            <td>{{$val->user_name_short}}</td>
                        @elseif($field == "juchukubun1")
                            <td>{{$val->juchukubun1_short}}</td>
                        @elseif($field == "datachar17_tan_name")
                            <td>{{$val->datachar17_tan_name_short}}</td>
                        @elseif($field == "datachar18_tan_name")
                            <td>{{$val->datachar18_tan_name_short}}</td>
                        @elseif($field == "datachar02_tan_name")
                            <td>{{$val->datachar02_tan_name_short}}</td>
                        @elseif($field == "datachar03_tan_name")
                            <td>{{$val->datachar03_tan_name_short}}</td>
                        @elseif($field == "datachar05_tan_name")
                            <td>{{$val->datachar05_tan_name_short}}</td>
                        @elseif($field == "datachar07_tan_name")
                            <td>{{$val->datachar07_tan_name_short}}</td>
                        @elseif($field == "changer")
                            <td>{{$val->changer_short}}</td>
                        @elseif($field == "tantousyabango")
                            <td>{{$val->tantousyabango_short}}</td>
                        {{--@elseif(in_array($field,$number_format_field))
                            <td style="text-align: right;">{{ $val->$field == null ? $val->$field : number_format($val->$field) }}</td>--}}
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
  </form>
</div>
