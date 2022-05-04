<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
<form id="mainForm" action="{{ route('changeInchargeOfFixedRateContract') }}" method="post">
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
               @if($k != "selected_new_charge" && $k != "up_support_number" && $k != "prev_new_charge")
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
          定期定額契約担当変更
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
               @include('flatRateContract.changeInchargeOfFixedRateContracts.pagination')
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
                                  onclick="Thesearch();" message="検索欄に入力した内容を検索します。" data-dismiss="modal" style="width: 150px;"> <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->検　索
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                  <button type="button" id="refreshPage" class="btn text-white bg-default uskc-button" 
                                  onclick="refresh()" message="データを一覧表示します。" data-dismiss="modal" style="width: 150px;"> <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                                  </button>
                                </td>
                                <td style=" border: none!important;">
                                   <button type="button" id="excelDwld" class="btn text-white uskc-button" data-dismiss="modal"
                                   onclick="excelDownload()"message="データをEXCELファイルとしてダウンロードします。" style="width: 159px;background: #009640;"><!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> -->Excelエクスポート</button>
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
                    @php
                       $formatted_field = ['formatted_contractor','formatted_no_of_contracts','formatted_sales_destination_r17','formatted_contractor_r17','formatted_end_customer_r17','formatted_new_charge','formatted_contract_amount','formatted_regular_subscription_classification','formatted_consumption_tax','formatted_updater','formatted_contract_status'];
                    @endphp
                  <tr>
                      @foreach($headers as $header=>$field)
                        @if(in_array($field,$formatted_field))
                           @php
                           $field = str_replace("formatted_","",$field);
                           @endphp
                           @if($field == 'new_charge')
                           <th class="signbtn-select" scope="col">
                        <div class="  d-flex">
                          <span class="table_header_span" style="margin-top:5px; ">{{$header}}</span>
                            <div class="custom-arrow" style="width:52px;margin-left:10px;margin-top:5px;">
                              <select class="form-control chk-highlight" id="myAnchor" name="myAnchor" style="height: 22px!important;">
                                  <!-- <option value="1">一括変更</option>
                                  @foreach ($incharges as $user)
                                       @php
                                         $data = $user->bango .' ' . substr($user->name,0,3);
                                       @endphp
                                   <option value="{{ $user->bango }}">{{ $data }}</option>
                                  @endforeach -->
                                  <option value="1">-</option>
                                  @foreach ($incharges as $user)
                                                  @php
                                                      $data = $user->bango .' ' . substr($user->name,0,3);
                                                   @endphp
                                                   @if (isset($fsReqData['incharge']))
                                                     <option value="{{ $user->bango }}" @if ($user->bango == $fsReqData['incharge']) {{ 'selected' }} @endif>
                                                         {{ $data }}
                                                     </option>
                                                   @else
                                                      @if (isset($fsReqData) && count($fsReqData) > 0)
                                                         <option value="{{ $user->bango }}">
                                                            {{ $data }}
                                                         </option>
                                                       @else
                                                          <option value="{{ $user->bango }}" @if ($user->bango == $bango){{ 'selected' }} @endif>
                                                             {{ $data }}
                                                          </option>
                                                       @endif
                                                    @endif
                                              @endforeach   
                              </select>
                            </div>
                        </div>
                      </th>

                           @else
                            <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                           @endif
                        @else
                            <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                        @endif
                      @endforeach
                     
                    </tr>

                  </thead>
                  <tbody>
                    <tr>
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
               @if(isset($allChangeInchargeOfFixedRateContract))
                   @foreach($allChangeInchargeOfFixedRateContract as $key=>$val)
                    <tr>
                      @foreach($headers as $header=>$field)  
                           @if($field == 'auto_continuation_flag'|| $field == 'auto_sales_flag'|| $field == 'billed_flag'|| $field == 'paid_flag'|| $field == 'correction_flag'|| $field == 'order_line_number'|| $field == 'order_branch_number'|| $field == 'formatted_contract_amount'|| $field == 'formatted_consumption_tax') 
                              <td style="text-align: right">{{$val->$field}}</td>
                           @elseif($field == 'formatted_new_charge')
                               <td style="text-align: right">
                                 
                               <div class="custom-arrow">
                                   <select class="form-control new_charge" onchange="checkChangeInchargeOfFixedRateContractUpdateData($(this),'{{$bango}}')" name="selected_new_charge[]">
                                          <option value="1">-</option>
                                              @foreach ($incharges as $user)
                                                  @php
                                                      $data = $user->bango .' ' . substr($user->name,0,3);
                                                   @endphp
                                                   @if (isset($fsReqData['incharge']))
                                                     <option value="{{ $user->bango }}" @if ($user->bango == $fsReqData['incharge']) {{ 'selected' }} @endif>
                                                         {{ $data }}
                                                     </option>
                                                   @else
                                                      @if (isset($fsReqData) && count($fsReqData) > 0)
                                                         <option value="{{ $user->bango }}">
                                                            {{ $data }}
                                                         </option>
                                                       @else
                                                          <option value="{{ $user->bango }}" @if ($user->bango == $bango){{ 'selected' }} @endif>
                                                             {{ $data }}
                                                          </option>
                                                       @endif
                                                    @endif
                                              @endforeach          
                                   </select>
                                </div>   
                                      <input type="hidden" class="up_support_number" name="up_support_number[]"  value="{{$val->contract_number}}">                                    
                                      <input type="hidden" class="prev_new_charge" name="prev_new_charge[]" value="{{ $val->formatted_new_charge}}">
                              </td>      
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
      {{-- Table Ends Here --}}
    </div>
  </div>
</form>
</div>
