<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
    <form id="mainForm" action="{{ route('purchaseHistory') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

    @csrf

    <!-- first search req data //fsReqData=first search request data -->
        @if(isset($fsReqData))
            <input type="hidden" id="division_datachar05_startReqVal" name="division_datachar05_start" @if(isset($fsReqData['division_datachar05_start'])) value="{{$fsReqData['division_datachar05_start']}}" @else value="" @endif>
            <input type="hidden" id="department_datachar05_startReqVal" name="department_datachar05_start" @if(isset($fsReqData['department_datachar05_start'])) value="{{$fsReqData['department_datachar05_start']}}" @else value="" @endif >
            <input type="hidden" id="group_datachar05_startReqVal" name="group_datachar05_start" @if(isset($fsReqData['group_datachar05_start'])) value="{{$fsReqData['group_datachar05_start']}}" @else value="" @endif>
            <input type="hidden" id="division_datachar05_endReqVal" name="division_datachar05_end" @if(isset($fsReqData['division_datachar05_end'])) value="{{$fsReqData['division_datachar05_end']}}" @else value="" @endif>
            <input type="hidden" id="department_datachar05_endReqVal" name="department_datachar05_end" @if(isset($fsReqData['department_datachar05_end'])) value="{{$fsReqData['department_datachar05_end']}}" @else value="" @endif>
            <input type="hidden" id="group_datachar05_endReqVal" name="group_datachar05_end" @if(isset($fsReqData['group_datachar05_end'])) value="{{$fsReqData['group_datachar05_end']}}" @else value="" @endif>
            <input type="hidden" id="datachar05ReqVal" name="datachar05" @if(isset($fsReqData['datachar05'])) value="{{$fsReqData['datachar05']}}"  @else value="" @endif>
            <input type="hidden" id="information1_textReqVal" name="information1_text" @if(isset($fsReqData['information1_text'])) value="{{$fsReqData['information1_text']}}"  @else value="" @endif>
            <input type="hidden" id="information1_shortReqVal" name="information1_short" @if(isset($fsReqData['information1_short'])) value="{{$fsReqData['information1_short']}}"  @else value="" @endif>
            <input type="hidden" id="information2_textReqVal" name="information2_text" @if(isset($fsReqData['information2_text'])) value="{{$fsReqData['information2_text']}}"  @else value="" @endif>
            <input type="hidden" id="information2_shortReqVal" name="information2_short" @if(isset($fsReqData['information2_short'])) value="{{$fsReqData['information2_short']}}"  @else value="" @endif>
            <input type="hidden" id="rd1ReqVal" name="rd1" @if(isset($fsReqData['rd1'])) value="{{$fsReqData['rd1']}}" @else value="" @endif>
            <input type="hidden" id="rd2ReqVal" name="rd2" @if(isset($fsReqData['rd2'])) value="{{$fsReqData['rd2']}}" @else value="" @endif>
            <input type="hidden" id="inputDateFromReqVal" name="inputDateFrom" @if(isset($fsReqData['inputDateFrom'])) value="{{$fsReqData['inputDateFrom']}}" @else value="" @endif>
            <input type="hidden" id="inputDateToReqVal" name="inputDateTo" @if(isset($fsReqData['inputDateTo'])) value="{{$fsReqData['inputDateTo']}}" @else value="" @endif>
            <input type="hidden" id="purchaseDateFromReqVal" name="purchaseDateFrom" @if(isset($fsReqData['purchaseDateFrom'])) value="{{$fsReqData['purchaseDateFrom']}}" @else value="" @endif>
            <input type="hidden" id="purchaseDateToReqVal" name="purchaseDateTo" @if(isset($fsReqData['purchaseDateTo'])) value="{{$fsReqData['purchaseDateTo']}}" @else value="" @endif>
            <input type="hidden" id="purchaseNoFromReqVal" name="purchaseNoFrom" @if(isset($fsReqData['purchaseNoFrom'])) value="{{$fsReqData['purchaseNoFrom']}}" @else value="" @endif>
            <input type="hidden" id="purchaseNoToReqVal" name="purchaseNoTo" @if(isset($fsReqData['purchaseNoTo'])) value="{{$fsReqData['purchaseNoTo']}}" @else value="" @endif>
            <input type="hidden" id="accountingSubReqVal" name="accountingSub" @if(isset($fsReqData['accountingSub'])) value="{{$fsReqData['accountingSub']}}" @else value="" @endif>
            <input type="hidden" id="rd3ReqVal" name="rd3" @if(isset($fsReqData['rd3'])) value="{{$fsReqData['rd3']}}" @else value="" @endif>
        @endif
          <div class="content-bottom-top" style="margin-bottom: 30px;">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    仕入購入履歴一覧
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
                    @include('purchase.purchaseHistory.pagination')
                    <!----------pagination End----------------->

                      <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                          <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                            <tbody>
                              <tr style="height: 28px;">
                                  <td style=" border: none!important;">
                                      <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                              class="btn bg-teal text-white uskc-button" data-dismiss="modal"> 検　索
                                      </button>
                                  </td>
                                  <td style=" border: none!important;">
                                      <button type="button" onclick="refresh()" message="データを一覧表示します。"
                                              class="btn text-white bg-default uskc-button" data-dismiss="modal">
                                          一　覧
                                      </button>
                                  </td>
                                  <td style=" border: none!important;">
                                      <button type="button" id="excelDwld" onclick="excelDownload()" class="btn uskc-button text-white"
                                              data-dismiss="modal" style="background: #009640;" @if(count($purchaseHistoryInfos)<1) disabled @endif>
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
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                    <div style="overflow: hidden;">
                      <div class="table-responsive largeTable">
                        <table id="userTable" class="table table-bordered table-fill table-striped"
                          style="margin-bottom: 20px!important;">
                          <thead class="thead-dark header text-center" id="myHeader">
                          @php
                              $right_align_column = ['purchase_history_amount', 'purchase_consumption_tax_amount','consumption_tax_paid'];
                              $check_box_column = ['instructions_check', 'stamp_check'];
                              $date_time_column = ['purchase_date','payment_date','registration_date', 'registration_time','payment_closing_date','provisional_purchase_date','invoice_date'];
                          @endphp
                            @foreach($headers as $header=>$field)
                                @if ($field=='instructions_check')
                                    <th scope="col" class="signbtn checkbox1"><span
                                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 63px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                    </th>
                                @elseif($field=='stamp_check')
                                    <th scope="col" class="signbtn checkbox2"><span
                                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 63px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                    </th>
                                @else
                                    @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field.'_sort'}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                    @else
                                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                        @endif
                                @endif
                            @endforeach
                          </thead>
                          <tbody>

                            <tr>
                              @foreach($headers as $header=>$field)
                                  @if(in_array($field, $check_box_column))
                                      <td></td>
                                  @elseif(in_array($field, $right_align_column) || in_array($field, $date_time_column))
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
                            @if(isset($purchaseHistoryInfos))
                                @php $chk=0; @endphp
                                @foreach($purchaseHistoryInfos as $key=>$val)
                                    <tr>
                                        @foreach($headers as $header=>$field)
                                            @if(in_array($field, $check_box_column))
                                                @if ($field=='instructions_check')
                                                    @if($val->creation_division=='3')
                                                        <td></td>
                                                    @else
                                                        <td>
                                                            <div style="display: flex; justify-content: center;">
                                                                <label class="checkbox_container" style="margin-left: 6px !important;">
                                                                    <input class="checkAllCheckbox tblCheckBox1" type="checkbox" id="tblCheckBox1_{{$chk}}" name="tblCheckBox1_{{$chk}}" value="" @if($val->instructions_check!=null){{'checked'}}@endif>
                                                                    <input type="hidden" class="tblCheckBox1_h" @if($val->instructions_check!=null) value="1" @else value="0" @endif>
                                                                    <input type="hidden" value="{{$val->instructions_check}}">
                                                                    <input type="hidden" class="ck1_val_h" id="ck1_val_h_{{$chk}}"
                                                                           value="ck1_{{$chk}}_{{$val->line_no}}_{{$val->purchase_no}}_{{$val->number_of_corrections}}@if($val->instructions_check!=null)_1_{{$val->instructions_check}}@else _0_0 @endif _{{$val->order_number}}">
                                                                    <input type="hidden" class="chk2Id" value="#ck2_val_h_{{$chk}}">
                                                                    <input type="hidden" class="chk2hId" value="#tblCheckBox2_h_{{$chk}}">
                                                                    <span class="checkmark" style="top: -7px;"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @endif
                                                @elseif($field=='stamp_check')
                                                    @if($val->creation_division=='3')
                                                        <td></td>
                                                    @else
                                                        <td>
                                                            <div style="display: flex; justify-content: center;" @if(($tantousya->innerlevel<15) && ($val->finger_test_information_condition=='1')) class="d-none"
                                                                                @elseif(($tantousya->innerlevel>14 && $tantousya->innerlevel<19) && (($val->finger_test_information_condition=='1'))) class="d-none"
                                                                                @elseif(($tantousya->innerlevel>18) && (($val->finger_test_information_condition=='1') || ($val->finger_test_information_condition=='2'))) class="d-none"
                                                                              @endif>
                                                                <label class="checkbox_container" style="margin-left: 6px !important;">
                                                                    <input class="checkAllCheckbox tblCheckBox2" type="checkbox" id="tblCheckBox2_{{$chk}}" name="tblCheckBo2_{{$chk}}" value="" @if($val->stamp_check!=null)checked="checked"@endif>
                                                                    <input type="hidden" class="tblCheckBox2_h" id="tblCheckBox2_h_{{$chk}}" @if($val->stamp_check!=null)value="1" @else value="0"@endif>
                                                                    <input type="hidden" class="ck2_val_h" id="ck2_val_h_{{$chk}}"
                                                                           value="ck2_{{$chk}}_{{$val->line_no}}_{{$val->purchase_no}}_{{$val->number_of_corrections}}@if($val->stamp_check!=null)_1_{{$val->stamp_check}}@else _0_0 @endif _{{$val->order_number}}">
                                                                    <input type="hidden" class="chkRowNo" value="{{$chk}}">
                                                                    <input type="hidden" class="chk1Id" value="#ck1_val_h_{{$chk}}">
                                                                    <span class="checkmark" style="top: -7px;"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endif
                                            @elseif($field=='purchase_no')
                                                <td>
                                                    <a href="#" onclick="gotoPurchaseInquiry('{{$val->$field}}','{{$val->number_of_corrections}}','{{$val->line_no}}')" style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                                                </td>
                                            @else
                                                @if (in_array($field, $right_align_column))
                                                    <td style="text-align: right">{{ $val->$field }}</td>
                                                @else
                                                    <td>{{$val->$field}}</td>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tr>
                                    <input type="hidden" value="{{$chk++}}">
                                @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="ml-3 mr-3 d-flex mt-3 w-100 justify-content-end">
                  <div class="form-button">
                    <a type="button" class="btn btn-info uskc-button" id="registrationBtn"
                      style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</a>
                  </div>

                </div>
              </div>

            </div>
          </div>
    </form>
</div>
