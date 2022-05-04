<div class="content-bottom-section" style="padding-bottom:46px;">
<form id="mainForm" action="{{ route('purchaseResultList') }}" method="post">
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
            外注仕入実績一覧
          </div>
        </div>
      </div>
    </div>
    <div class="content-bottom-pagination">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
              <!-- new pagination row starts here -->
               @include('support.purchaseResultList.pagination')
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
                          onclick="Thesearch();" message="検索欄に入力した内容を検索します。" style="width: 150px;">
                            <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->検　索
                          </button>
                        </td>
                        <td style=" border: none!important;">
                          <button type="button" id="" class="btn text-white bg-default uskc-button"
                          onclick="refresh()" message="データを一覧表示します。" style="width: 150px;">
                            <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                          </button>
                        </td>
                        <td style=" border: none!important;">
                          <button type="button" id="excelDwld" onclick="excelDownload()"message="データをEXCELファイルとしてダウンロードします。"
                           class="btn text-white uskc-button" data-dismiss="modal" style="width: 159px;background: #009640;">
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
  <div class="content-bottom-bottom" style="margin-top: 10px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div class="table-responsive largeTable">
              <table id="userTable" class="table table-bordered table-fill table-striped custom-form">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    <!-- <th scope="col" class="signbtn"> <span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">サポート番号行</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注先</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">最終顧客</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">受注番号</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">売上日</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">売</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">外注予定</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">外注発注</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">外注実績</span>
                    </th> -->
                    @foreach($headers as $header=>$field)
                      @if ($field=='inspection')
                        <th class="signbtn-select" scope="col">
                          <div class="  d-flex">
                            <span onclick="AscDsc('{{$field}}');" class="table_header_span" style="margin-top:5px; ">{{$header}}</span>
                              <div  class="custom-arrow" style="width:52px;margin-left:10px;margin-top:5px;">
                                <select class="form-control  chk-highlight" id="myAnchor" name="" style=" height:22px!important;">
                                  <option value="1">1 未</option>
                                  <option value="2">2 指示</option>
                                  <option value="3" @if($tantousya->innerlevel > 18){{'disabled'}}@endif>3 検印</option>
                                  <option value="4" @if($tantousya->innerlevel > 14){{'disabled'}}@endif>4 完了</option>
                                </select>
                              </div>
                          </div>
                        </th>
                      @elseif($field=='formatted_schedule')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_Result_list_schedule');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_amount')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_Result_list_amount');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_results')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_Result_list_results');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @elseif($field=='formatted_purchase_difference')
                        <th scope="col" class="signbtn"><span onclick="AscDsc('purchase_Result_list_difference');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @else
                        <th scope="col" class="signbtn"><span onclick="AscDsc('{{$field}}');"
                          style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                        </th>
                      @endif
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach($headers as $header=>$field)
                      @if($field=='formatted_schedule')
                        <td><input type="text" name="purchase_Result_list_schedule" class="form-control" value="{{isset($req_data['purchase_Result_list_schedule'])?$req_data['purchase_Result_list_schedule']:null}}"></td>
                      @elseif($field=='formatted_amount')
                        <td><input type="text" name="purchase_Result_list_amount" class="form-control" value="{{isset($req_data['purchase_Result_list_amount'])?$req_data['purchase_Result_list_amount']:null}}"></td>
                      @elseif($field=='formatted_results')
                        <td><input type="text" name="purchase_Result_list_results" class="form-control" value="{{isset($req_data['purchase_Result_list_results'])?$req_data['purchase_Result_list_results']:null}}"></td>
                      @elseif($field=='formatted_purchase_difference')
                        <td><input type="text" name="purchase_Result_list_difference" class="form-control" value="{{isset($req_data['purchase_Result_list_difference'])?$req_data['purchase_Result_list_difference']:null}}"></td>
                      @else
                        <td><input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}"></td>
                      @endif
                    @endforeach
                    <!-- <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td>
                    <td>
                      <input type="text" class="form-control">
                    </td> -->
                  </tr>
                  <!-- <form id="updateForm" enctype="multipart/form-data">
                    <input type="hidden" id="formSubmitButton" name="type" />
                    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
                    <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
                    <input id='submit_confirmation' value='' type='hidden'/> -->
                  <!-- 2nd row -->
                  @if(isset($purchaseResultListData))
                    @php $chk = 0; @endphp
                    @foreach($purchaseResultListData as $key=>$val)
                    @php $chk++; @endphp
                    <tr id="row{{$chk}}">
                      @foreach($headers as $header=>$field)
                        @if ($field == 'support_number')
                          <td> <a href="#" target="_blank" onclick="gotoPurchaseInquiryResult('{{$val->support_number}}')"
                            style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                            <input type="hidden" class="up_support_number" name="up_support_number[]" id="" value="{{ $val->support_number }}">
                          </td>
                          <!-- <td class="text-right">142,800</td>
                          <td class="text-right">27,500</td> -->
                        @elseif($field == 'inspection')
                          <td>
                            <div class="custom-arrow">
                              <select class="form-control selected_inspection" name="selected_inspection[]" id="selected_inspection_{{$chk}}">
                                <option value="1" @if($val->inspection==1){{'selected'}}@endif>1 未</option>
                                <option value="2" @if($val->inspection==2){{'selected'}}@endif>2 指示</option>
                                <option value="3" @if($val->inspection==3){{'selected'}}@endif @if($tantousya->innerlevel > 18){{'disabled'}}@endif>3 検印</option>
                                <option value="4" @if($val->inspection==4){{'selected'}}@endif @if($tantousya->innerlevel > 14){{'disabled'}}@endif>4 完了</option>
                              </select>
                            </div>
                            <input type="hidden" class="up_barcode" name="barcode[]" id="" value="{{ $val->barcode }}">
                            <input type="hidden" class="up_codename" name="codename[]" id="" value="{{ $val->codename }}">
                            <input type="hidden" class="up_tanka" name="tanka[]" id="" value="{{ $val->tanka }}">
                            <input type="hidden" class="prev_inspection" name="prev_inspection[]" id="" value="{{ $val->inspection }}">
                          </td>
                        @elseif($field == 'formatted_schedule')
                          <td class="text-right">{{$val->formatted_schedule}}</td>
                        @elseif($field == 'formatted_amount')
                          <td class="text-right">{{$val->formatted_amount}}</td>
                        @elseif($field == 'formatted_results')
                          <td class="text-right">{{$val->formatted_results}}</td>
                        @elseif($field == 'formatted_purchase_difference')
                          <td class="text-right">{{$val->formatted_purchase_difference}}</td>
                        @else
                          <td>  
                          {{$val->$field}}
                          </td>
                        @endif
                      @endforeach
                    </tr>
                    @endforeach
                    @if((isset($amount) && $amount != null) ||(isset($results) && $results != null) || (isset($difference) && $difference != null))
                      <tr>
                        <td> </td>
                        <td>合計 </td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ isset($amount) && $amount == null ? $amount : number_format($amount) }}</td>
                        <td class="text-right">{{ isset($results) && $results == null ? $results : number_format($results) }}</td>
                        <td></td>
                        <td class="text-right">{{ isset($difference) && $difference == null ? $difference : number_format($difference) }}</td>
                        <td> </td>
                        <td> </td>
                      </tr> 
                    @endif
                  @endif
                  <!-- </form> -->
                  <!-- 3rd row -->
                  <!-- <tr>
                    <td> <a href="{{url('/purchase_inquiry_result')}}" target="_blank"
                      style="color:#0056b3;text-decoration:underline;font-weight:600;">9949707544001</a></td>
                    <td>ＮＮＮＮ５/ＮＮＮＮ５/ＮＮＮ </td>
                    <td>ＮＮＮＮ５/ＮＮＮＮ５/ＮＮＮ</td>
                    <td>9999999999 </td>
                    <td>yyyy/mm/dd </td>
                    <td>
                      <div class="custom-arrow" style="width:100px;margin:0 auto;">
                        <select class="form-control" name="">
                            <option value="">9 Ｎ</option>
                        </select>
                      </div>
                    </td>
                    <td></td>
                    <td class="text-right">-999,999,999</td>
                    <td class="text-right">-999,999,999</td>
                    <td>
                      <div class="custom-arrow">
                       <select class="form-control" name="" id="">
                         <option value="">2 指示</option>
                         <option value=""></option>
                       </select>
                     </div>
                   </td>
                    <td class="text-right"> -999,999,999</td>
                    <td>yyyy/mm/dd</td>
                    <td>  
                      2 未
                    </td>
                  </tr>
                  <tr>
                    <td> </td>
                    <td>合計 </td>
                    <td></td>
                    <td> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">-999,999,999</td>
                    <td class="text-right">-999,999,999</td>
                    <td></td>
                    <td class="text-right"> -999,999,999</td>
                    <td> </td>
                    <td> </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="ml-3 mr-3 w-100" style="background-color:#fff;">
          <div class=" d-flex justify-content-end mb-3">
            <div class="form-button">
              <button id="updateButton" onclick="updatePurchaseResultList('{{route('updatePurchaseResultList')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button" style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>