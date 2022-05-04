<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
    <form id="mainForm" action="{{ route('purchaseDetails') }}" method="post">
        <input type="hidden" id="tableType" name="tableType" value="orderDataTable">
        <input type="hidden" name="Button" id="Button" class="B_Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

        @csrf

    <!-- first search req data //fsReqData=first search request data -->
        @if(isset($fsReqData))
            <input type="hidden" id="order_noReqVal" name="order_no" @if(isset($fsReqData['order_no'])) value="{{$fsReqData['order_no']}}" @else value="" @endif>
        @endif
          <div class="content-bottom-top" style="margin-bottom: 30px;">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    仕入予定明細
                  </div>
                </div>
              </div>
            </div>
            <div class="content-bottom-pagination" >
              <div class="container">
                <div class="row">
                  <div class="col">
                   <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
                       <!-- new pagination row starts here -->
                        @include('purchase.purchaseDetails.pagination1')
                       <!----------pagination End----------------->
                        <div class="row">
                          <div class="col-6">
                              <div class="row">
                                  <div class="col">
                                      <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                          <tbody>
                                            <tr style="">
                                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                              </td>
                                              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">内作予定</td>
                                              <td style=" border: none!important;width: 15px!important;"></td>
                                              <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;" id="table1Sum1"></td>
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
                                              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">予定合計</td>
                                              <td style=" border: none!important;width: 15px!important;"></td>
                                              <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;" id="table1Sum2"></td>
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
                                          <button type="button" onclick="Thesearch('orderDataTable');" message="検索欄に入力した内容を検索します。"
                                                  class="btn bg-teal text-white uskc-button" data-dismiss="modal"> 検　索
                                          </button>
                                      </td>
                                      <td style=" border: none!important;">
                                          <button type="button" onclick="refresh('orderDataTable')" message="データを一覧表示します。"
                                                  class="btn text-white bg-default uskc-button" data-dismiss="modal">
                                              一　覧
                                          </button>
                                      </td>
                                      <td style=" border: none!important;">
                                          <button type="button" id="excelDwld" onclick="excelDownload('orderDataTable')" class="btn uskc-button text-white"
                                                  data-dismiss="modal" style="background: #009640;" @if(count($purchaseDetails1Infos)<1) disabled @endif>
                                              Excel エクスポート
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
              <div class="row">
                <div class="col-lg-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
                    <div style="overflow: hidden;">
                      <div class="table-responsive largeTable">
                        <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                          <thead class="thead-dark header text-center" id="myHeader">
                              @php
                                  $right_align_column = ['purchase_details1_quantity','purchase_details1_unit_price','purchase_details1_amount'];
                                  $date_time_column = ['order_date','delivery_date'];
                                  $table1Sum1_val=null; $table1Sum2_val=null;
                              @endphp
                              @foreach($headers as $header=>$field)
                                  @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                                      <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field.'_sort'}}','orderDataTable');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                  @else
                                      <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}','orderDataTable');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                  @endif
                              @endforeach
                          </thead>
                          <tbody>
                            <tr>
                                @foreach($headers as $header=>$field)
                                    @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                                        @php $sort_field=$field.'_sort'@endphp
                                        <td>
                                            <input type="text" name="{{$sort_field}}" class="form-control" value="{{isset($old[$sort_field])?$old[$sort_field]:null}}" >
                                        </td>
                                    @else
                                        <td>
                                            <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" >
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            @if(isset($purchaseDetails1Infos))
                                @foreach($purchaseDetails1Infos as $key=>$val)
                                    @php
                                        $table1Sum1_val=(int)$table1Sum1_val + $val->syukkasu_multi_dataint05+$val->syukkasu_multi_dataint06+$val->syukkasu_multi_dataint07;
                                        $table1Sum2_val=(int)$table1Sum2_val + $val->purchase_details1_amount_sort;
                                    @endphp
                                    <tr>
                                        @foreach($headers as $header=>$field)
                                            @if (in_array($field, $right_align_column))
                                                <td style="text-align: right">{{ $val->$field }}</td>
                                            @else
                                                <td>{{$val->$field}}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                <input type="hidden" id="table1Sum1_h" value="¥ {{number_format($table1Sum1_val)}}">
                                <input type="hidden" id="table1Sum2_h" value="¥ {{number_format($table1Sum2_val+$table1Sum1_val)}}">
                                <script>
                                    $('#table1Sum1').html($('#table1Sum1_h').val());
                                    $('#table1Sum2').html($('#table1Sum2_h').val());
                                </script>
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
