<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
<form id="mainForm" action="{{ route('purchaseRecordList') }}" method="post">
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
        @if($k != "selected_completion_finger" && $k != "up_support_number" && $k != "prev_inspection" && $k != "datachar17" && $k != "datachar18")
        <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
        @endif
    @endforeach
    @endif


  <div class="content-bottom-top" style="margin-bottom: 30px;">

    {{-- Page Title Starts Here --}}
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          仕入実績一覧
          </div>
        </div>
      </div>
    </div>
    {{-- Page Title Ends Here --}}

    {{-- Pagination Starts Here --}}
    <div class="content-bottom-pagination">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
             <!-- new pagination row starts here -->
               @include('purchase.purchaseRecordList.pagination')
               <!----------pagination End----------------->
              <div class="row">
                  <div class="col-6">
                  </div>

                  <div class="col-6">
                      <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                          <tbody>
                            <tr style="height: 28px;">
                                <td style=" border: none!important;">
                                  <button type="button" id="choice_button" class="btn bg-teal uskc-button text-white" 
                                  onclick="Thesearch();" message="検索欄に入力した内容を検索します。" data-dismiss="modal" style="width: 150px;"> 
                                  <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->検　索
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                  <button type="button" id="" class="btn text-white bg-default uskc-button"
                                  onclick="refresh()" message="データを一覧表示します。" data-dismiss="modal" style="width: 150px;"> 
                                  <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                   <button type="button"  id="excelDwld" onclick="excelDownload()"message="データをEXCELファイルとしてダウンロードします。"
                                    class="btn text-white uskc-button" data-dismiss="modal" style="width: 159px;background: #009640;">
                                   <!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> -->Excelエクスポート</button>
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
    {{-- Pagination Ends Here --}}

  </div>

  <div class="content-bottom-bottom">
    <div class="container">

      {{-- Table Starts Here --}}
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div style="overflow: hidden;">
              <div class="table-responsive largeTable">
                <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                  style="margin-bottom: 20px!important;">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                      <!-- <th class="signbtn" scope="col"><span class="table_header_span">受注番号</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">受注先</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">最終顧客</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">受注金額</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">売上日</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">売</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">仕入予定</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">仕入実績</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">内作予定</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">内作実績</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">実績合計</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">仕入差額</span></th>
                      <th class="signbtn-select" scope="col"> -->
                      @foreach($headers as $header=>$field)
                        @if ($field=='completion_finger')
                        <th class="signbtn-select" scope="col">
                        <div class="  d-flex">
                          <span  onclick="AscDsc('{{$field}}');" class="table_header_span" style="margin-top:5px; ">{{$header}}</span>
                            <div class="custom-arrow" style="width:48px;margin-left:10px;margin-top:5px;">
                              <select class="form-control chk-highlight" id="myAnchor" name="" style="height: 22px!important;">
                                  <!-- <option value="1">1 未</option>
                                  <option value="2">2 指示</option>
                                  <option value="3">3 検印</option>
                                  <option value="4" {{'disabled'}}>3 検印済</option>  -->
                                  <option value="1">1 未</option>
                                  <option value="2">2 指</option>
                                  <option value="3">3 検</option>
                              </select>
                            </div>
                        </div>
                      </th>
                      @elseif($field=='formatted_money10')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('money10');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='datachar21')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('m_datachar21');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_search_intorder03')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('search_intorder03');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_sum_of_syukkasu_dataint08')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('sum_of_syukkasu_dataint08');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                        @elseif($field=='formatted_scheduled_to_work')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('scheduled_to_work');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_scheduled_work_result')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('scheduled_to_work');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_sum_of_syouhizeiritu')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('sum_of_syouhizeiritu');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_purchase_sum')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_sum');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_purchase_difference')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_difference');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>          
                      @else
                      <th scope="col" class="signbtn"><span onclick="AscDsc('{{$field}}');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                     @endif
                       @endforeach
                      <!-- <th class="signbtn" scope="col"><span class="table_header_span">仕入差額</span></th> -->
                      <!-- <th class="signbtn" scope="col"><span class="table_header_span">仕入完了日</span></th>
                      <th class="signbtn" scope="col"><span class="table_header_span">仕入完了計算フラグ</span></th>
                      -->
                    </tr>

                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                      <td><input type="text" class="form-control"></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>150401227</td>
                      <td>ミロク情報サービス</td>
                      <td>福田屋</td>
                      <td class="text-right">15,625</td>
                      <td>8/5/2020</td>
                      <td>2 未</td>
                      <td class="text-right">0</td>
                      <td class="text-right">2,550</td>
                      <td class="text-right">0</td>
                      <td class="text-right">0</td>
                      <td class="text-right">0</td>
                      <td class="text-right">2,550</td>
                    
                      <td>
                        <div class="custom-arrow" style="width:100px;margin:0 auto;">
                            <select class="form-control" name="">
                                <option value="">1 指示済</option>
                                <option value="">2 指示済</option>
                            </select>
                          </div>
                      </td>
                      <td>yyyy/mm/dd</td>
                      <td>  
                        <div class="custom-arrow" style="width:100px;margin:0 auto;">
                          <select class="form-control" name="">
                              <option value="">1 済</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>999999999</td>
                      <td>ＮＮＮＮ５/ＮＮＮＮ５/ＮＮＮ</td>
                      <td>ＮＮＮＮ５/ＮＮＮＮ５/ＮＮＮ</td>
                      <td class="text-right">999,999,999</td>
                      <td>yyyy/mm/dd</td>
                      <td>9 Ｎ</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                     
                      <td>
                        <div class="custom-arrow" style="width:100px;margin:0 auto;">
                            <select class="form-control" name="">
                                <option value="">9 ＮＮＮ</option>
                            </select>
                          </div>
                      </td>
                      <td>yyyy/mm/dd</td>
                      <td>  
                        <div class="custom-arrow" style="width:100px;margin:0 auto;">
                          <select class="form-control" name="">
                              <option value="">2 未</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>合計</td>
                      <td></td>
                      <td class="text-right">999,999,999</td>
                      <td></td>
                      <td></td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right" class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      <td class="text-right">-999,999,999</td>
                      
                      <td> </td>
                      <td> </td>
                      <td> </td>
                    </tr> -->
                    <tr>
                    @foreach($headers as $header=>$field)
                    @if($field=='formatted_money10')
                        <td><input type="text" name="money10_search" class="form-control" value="{{isset($req_data['money10_search'])?$req_data['money10_search']:null}}"></td>
                      @elseif($field=='formatted_sum_of_syukkasu_dataint08')
                        <td><input type="text" name="sum_of_syukkasu_dataint08_search" class="form-control" value="{{isset($req_data['sum_of_syukkasu_dataint08_search'])?$req_data['sum_of_syukkasu_dataint08_search']:null}}"></td>
                      @elseif($field=='formatted_sum_of_syouhizeiritu')
                        <td><input type="text" name="sum_of_syouhizeiritu_search" class="form-control" value="{{isset($req_data['sum_of_syouhizeiritu_search'])?$req_data['sum_of_syouhizeiritu_search']:null}}"></td>
                      @elseif($field=='formatted_scheduled_to_work')
                        <td><input type="text" name="scheduled_to_work_search" class="form-control" value="{{isset($req_data['scheduled_to_work_search'])?$req_data['scheduled_to_work_search']:null}}"></td>                   
                       @elseif($field=='formatted_scheduled_work_result')
                        <td><input type="text" name="scheduled_work_result_search" class="form-control" value="{{isset($req_data['scheduled_work_result_search'])?$req_data['scheduled_work_result_search']:null}}"></td>
                      @elseif($field=='formatted_purchase_sum')
                        <td><input type="text" name="purchase_sum_search" class="form-control" value="{{isset($req_data['purchase_sum_search'])?$req_data['purchase_sum_search']:null}}"></td>
                      @elseif($field=='formatted_purchase_difference')
                        <td><input type="text" name="purchase_difference_search" class="form-control" value="{{isset($req_data['purchase_difference_search'])?$req_data['purchase_difference_search']:null}}"></td>                  
                        @else
                        <td><input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}"></td>
                      @endif

                      @endforeach
                  </tr>                    
                         @if(isset($purchaseRecordListInfo))
                            @foreach($purchaseRecordListInfo as $key=>$val)
                            <tr>
                              @foreach($headers as $header=>$field)
                                @if($field == "formatted_money10")
                                  <td class="text-right">{{$val->formatted_money10}}</td>
                                @elseif($field == "formatted_search_intorder03")
                                  <td class="text-right">{{$val->formatted_search_intorder03}}</td>  
                                @elseif($field == "formatted_sum_of_syukkasu_dataint08")
                                  <td class="text-right">{{$val->formatted_sum_of_syukkasu_dataint08}}</td>
                                @elseif($field == "formatted_sum_of_syouhizeiritu")
                                  <td class="text-right">{{$val->formatted_sum_of_syouhizeiritu}}</td>
                                @elseif($field == "formatted_scheduled_to_work")
                                  <td class="text-right">{{$val->formatted_scheduled_to_work}}</td>
                                @elseif($field == "formatted_scheduled_work_result")
                                  <td class="text-right">{{$val->formatted_scheduled_work_result}}</td>
                                @elseif($field == "formatted_purchase_sum")
                                  <td class="text-right">{{$val->formatted_purchase_sum}}</td>
                                @elseif($field == "formatted_purchase_difference")
                                  <td class="text-right">{{$val->formatted_purchase_difference}}</td> 
                                @elseif($field == 'completion_finger')
                                  <td>
                                    <div class="custom-arrow">
                                
                                      <select class="form-control completion_finger" onchange="checkPurchaseRecordListUpdateData($(this),'{{$bango}}','{{$val->datachar05}}',{{$val->completion_finger}})" @if($val->completion_finger==4){{'disabled'}}@endif name="selected_completion_finger[]">
                                         <option value="1" @if($val->completion_finger==1){{'selected'}}@endif>1 未</option>
                                         <option value="2" @if($val->completion_finger==2){{'selected'}}@endif>2 指示済</option>
                                         <option value="3" @if($val->completion_finger==3 || $val->completion_finger==4){{'selected'}}@endif>3 検印済</option>
                                         </select>
                                      </div> 
                                      @if($val->completion_finger !=4) 
                                      <input type="hidden" class="up_support_number" name="up_support_number[]" id="" value="{{$val->inner_kokyakuorderbango}}">                                    
                                      <input type="hidden" class="prev_inspection" name="prev_inspection[]" id="" value="{{ $val->completion_finger}}">
                                      <input type="hidden" class="datachar17" name="datachar17[]" id="" value="{{ $val->datachar17}}">
                                      <input type="hidden" class="datachar18" name="datachar18[]" id="" value="{{ $val->datachar18}}"> 
                                      @endif
                                    </td>
                                @else
                                  <td>{{$val->$field}}</td>
                                @endif
                              @endforeach
                            </tr> 
                            @endforeach
                            @if(isset($total204) && $total204 != null || isset($total207) && $total207 != null || isset($total208) && $total208 != null || isset($total209) && $total209 != null || isset($total210) && $total210 != null || isset($total211) && $total211 != null || isset($total212) && $total212 != null)
                    <tr>
                      @foreach($headers as $header=>$field)
                        @if($field == "information1_detail")
                        <td>合計</td>
                        @elseif($field == "formatted_money10")
                        <td class="text-right">{{ isset($total204) && $total204 == null ? $total204 : number_format($total204) }}</td>
                        @elseif($field == "formatted_sum_of_syukkasu_dataint08")
                        <td class="text-right">{{ isset($total207) && $total207 == null ? $total207 : number_format($total207) }}</td>
                        @elseif($field == "formatted_sum_of_syouhizeiritu")
                        <td class="text-right">{{ isset($total208) && $total208 == null ? $total208 : number_format($total208) }}</td>
                        @elseif($field == "formatted_scheduled_to_work")
                        <td class="text-right">{{ isset($total209) && $total209 == null ? $total209 : number_format($total209) }}</td>
                        @elseif($field == "formatted_scheduled_work_result")
                        <td class="text-right">{{ isset($total210) && $total210 == null ? $total210 : number_format($total210) }}</td>
                        @elseif($field == "formatted_purchase_sum")
                        <td class="text-right">{{ isset($total211) && $total211 == null ? $total211 : number_format($total211) }}</td>
                        @elseif($field == "formatted_purchase_difference")
                        <td class="text-right">{{ isset($total212) && $total212 == null ? $total212 : number_format($total212) }}</td>
                        @else
                         <td> </td>
                        @endif
                      @endforeach   
                    </tr> 
                    
                    @endif 
                          @endif            
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Table Ends Here --}}

      {{-- Table Bottom Button Starts Here --}}
      <div class="row">
        <div class="ml-3 mr-3 d-flex mt-3 w-100 justify-content-end">
          <div class="form-button">
          <button id="updateButton" onclick="updatePurchaseRecordList('{{route('updatePurchaseRecordList')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button"
              style="width: 150px;height:30px;line-height:30px;">登録</button>          
          </div>
        </div>
      </div>
      {{-- Table Bottom Button Ends Here --}}

    </div>
  </div>

</form>
</div>