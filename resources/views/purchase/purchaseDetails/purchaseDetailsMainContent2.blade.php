<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
    <form id="mainForm2" action="{{ route('purchaseDetails') }}" method="post">
        <input type="hidden" id="tableType" name="tableType" value="{{isset($old2['tableType']) ? $old2['tableType']:'purchaseDataTable'}}">
        <input type="hidden" name="Button" id="Button" class="B_Button" value="{{isset($old2['Button']) ? $old2['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old2['sortField'])?$old2['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old2['sortType'])?$old['sortType']:null}}">
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
                    仕入実績明細
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
                        @include('purchase.purchaseDetails.pagination2')
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
                                              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">内作実績合計</td>
                                              <td style=" border: none!important;width: 15px!important;"></td>
                                              <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;" id="table2Sum1"></td>
                                                <script>
                                                    if ($('#searchDetails2').val()==0){
                                                        $('#table2Sum1').html('¥ 0');
                                                    }
                                                    else if($('#searchDetails2').val()>0){
                                                        $('#table2Sum1').html($('#table1Sum1_h').val());
                                                    }
                                                </script>
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
                                              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">実績合計</td>
                                              <td style=" border: none!important;width: 15px!important;"></td>
                                              <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;" id="table2Sum2"></td>
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
                                          <button type="button" onclick="Thesearch('purchaseDataTable');" message="検索欄に入力した内容を検索します。"
                                                  class="btn bg-teal text-white uskc-button" data-dismiss="modal"> 検　索
                                          </button>
                                      </td>
                                      <td style=" border: none!important;">
                                          <button type="button" onclick="refresh('purchaseDataTable')" message="データを一覧表示します。"
                                                  class="btn text-white bg-default uskc-button" data-dismiss="modal">
                                              一　覧
                                          </button>
                                      </td>
                                      <td style=" border: none!important;">
                                          <button type="button" id="excelDwld" onclick="excelDownload('purchaseDataTable')" class="btn uskc-button text-white"
                                                  data-dismiss="modal" style="background: #009640;" @if(count($purchaseDetails2Infos)<1) disabled @endif>
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
                              $right_align_column2 = ['purchase_details2_quantity2','purchase_details2_unit_price2','purchase_details2_amount2'];
                              $date_time_column2 = ['purchase_date'];
                              $table2Sum2_val=null;
                          @endphp
                          @foreach($headers2 as $header=>$field)
                              @if(in_array($field, $right_align_column2) || in_array($field, $date_time_column2))
                                  <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field.'_sort'}}','purchaseDataTable');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                              @else
                                  <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}','purchaseDataTable');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                              @endif
                          @endforeach
                          </thead>
                          <tbody>
                          <tr>
                              @foreach($headers2 as $header=>$field)
                                  @if(in_array($field, $right_align_column2) || in_array($field, $date_time_column2))
                                      @php $sort_field=$field.'_sort'@endphp
                                      <td>
                                          <input type="text" name="{{$sort_field}}" class="form-control" value="{{isset($old2[$sort_field])?$old2[$sort_field]:null}}" >
                                      </td>
                                  @else
                                      <td>
                                          <input type="text" name="{{$field}}" class="form-control" value="{{isset($old2[$field])?$old2[$field]:null}}" >
                                      </td>
                                  @endif
                              @endforeach
                          </tr>
                          @if(isset($purchaseDetails2Infos))
                              @foreach($purchaseDetails2Infos as $key=>$val)
                                  @php $table2Sum2_val=(int)$table2Sum2_val + $val->purchase_details2_amount2_sort; @endphp
                                  <tr>
                                      @foreach($headers2 as $header=>$field)
                                          @if (in_array($field, $right_align_column2))
                                              <td style="text-align: right">{{ $val->$field }}</td>
                                          @else
                                              <td>{{$val->$field}}</td>
                                          @endif
                                      @endforeach
                                  </tr>
                              @endforeach
                              <input type="hidden" id="table2Sum2_h" value="¥ {{number_format($table2Sum2_val)}}">
                                <script>
                                    var table2Sum2_h_val=$('#table2Sum2_h').val().replace(/¥/g,'').replace(/,/g,'').replace(/ /g,'');
                                    var table1Sum1_h_val=$('#table1Sum1_h').val().replace(/¥/g,'').replace(/,/g,'').replace(/ /g,'');
                                    var table1Sum2_h_val=$('#table1Sum2_h').val().replace(/¥/g,'').replace(/,/g,'').replace(/ /g,'');
                                    var table2Sum2_val=Number(table2Sum2_h_val)+Number(table1Sum1_h_val);
                                    var difference207_val=Number(table1Sum2_h_val)-table2Sum2_val;
                                    // console.log(Number(table2Sum2_h_val)+Number(table1Sum1_h_val));
                                    const currency = function(number){
                                        return new Intl.NumberFormat('en-IN', {style: 'currency',currency: 'jpy', minimumFractionDigits: 0}).format(number);
                                    };
                                    table2Sum2_val = currency(table2Sum2_val).replace(/JP/g,'').toString();
                                    table2Sum2_val  = table2Sum2_val.slice(0, 1) + " " + table2Sum2_val.slice(1);
                                    difference207_val = currency(difference207_val).replace(/JP¥/g,'').toString();
                                    difference207_val  = '¥ '+difference207_val;
                                    // difference207_val  = '¥'+difference207_val
                                    // console.log(currency(money).replace(/JP/g,'').toString(),newString);
                                    if ($('#searchDetails2').val()==0){
                                        $('#table2Sum2').html('¥ 0');
                                        $('#difference207').html($('#table1Sum2_h').val());
                                    }
                                    else if($('#searchDetails2').val()>0){
                                        $('#table2Sum2').html(table2Sum2_val);
                                        $('#difference207').html(difference207_val);
                                    }
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
