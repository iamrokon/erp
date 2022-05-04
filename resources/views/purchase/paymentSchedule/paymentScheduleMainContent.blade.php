<div class="content-bottom-section" style="padding-bottom:46px;">
    <form id="mainForm" action="{{ route('paymentSchedule') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

        @csrf
        @if(isset($fsReqData))
            <input type="hidden" id="dateDeadLineReqVal" name="dateDeadLine" @if(isset($fsReqData['dateDeadLine'])) value="{{$fsReqData['dateDeadLine']}}" @else value="" @endif>
            <input type="hidden" id="information1_textReqVal" name="information1_text" @if(isset($fsReqData['information1_text'])) value="{{$fsReqData['information1_text']}}"  @else value="" @endif>
            <input type="hidden" id="information1_shortReqVal" name="information1_short" @if(isset($fsReqData['information1_short'])) value="{{$fsReqData['information1_short']}}"  @else value="" @endif>
            <input type="hidden" id="information2_textReqVal" name="information2_text" @if(isset($fsReqData['information2_text'])) value="{{$fsReqData['information2_text']}}"  @else value="" @endif>
            <input type="hidden" id="information2_shortReqVal" name="information2_short" @if(isset($fsReqData['information2_short'])) value="{{$fsReqData['information2_short']}}"  @else value="" @endif>
            <input type="hidden" id="paymentDateFromReqVal" name="paymentDateFrom" @if(isset($fsReqData['paymentDateFrom'])) value="{{$fsReqData['paymentDateFrom']}}" @else value="" @endif>
            <input type="hidden" id="paymentDateToReqVal" name="paymentDateTo" @if(isset($fsReqData['paymentDateTo'])) value="{{$fsReqData['paymentDateTo']}}" @else value="" @endif>
            <input type="hidden" id="paymentMethodReqVal" name="paymentMethod" @if(isset($fsReqData['paymentMethod'])) value="{{$fsReqData['paymentMethod']}}" @else value="" @endif>
            <input type="hidden" id="rd1ReqVal" name="rd1" @if(isset($fsReqData['rd1'])) value="{{$fsReqData['rd1']}}" @else value="" @endif>
        @endif
          <div class="content-bottom-top">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    支払予定一覧
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
                    @include('purchase.paymentSchedule.pagination')
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
                                              data-dismiss="modal" style="background: #009640;" @if(count($paymentScheduleInfos)<1)  disabled @endif>
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
          <div class="content-bottom-bottom" style="margin-top: 10px;">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
                    <div class="table-responsive largeTable">
                      <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                        style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                        @php
                            $right_align_column = ['current_month_balance','purchase_payment_amount1','purchase_payment_amount2','purchase_payment_amount3','purchase_payment_amount1_1','purchase_payment_amount2_1','purchase_payment_amount3_1','amount'];
                            $date_time_column = ['payment_date','bill_due_date'];
                            $center_align_column= ['difference'];
                        @endphp
                        @foreach($headers as $header=>$field)
                            @if(in_array($field, $right_align_column) || in_array($field, $date_time_column) || in_array($field, $center_align_column))
                            <!--for search sort-->
                            <!--<th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field.'_sort'}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>-->
                                <th scope="col" class="signbtn" style="width: 50px;"><span  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                            @else
                                <!--for search sort-->
                                <!--<th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>-->
                                <th scope="col" class="signbtn" style="width: 50px;"><span  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                            @endif
                        @endforeach
                        </thead>
                        <tbody>
                        <!--for search sort-->
{{--                        <tr>--}}
{{--                            @foreach($headers as $header=>$field)--}}
{{--                                @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))--}}
{{--                                    @php $sort_field=$field.'_sort'@endphp--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="{{$sort_field}}" class="form-control" value="{{isset($old[$sort_field])?$old[$sort_field]:null}}" >--}}
{{--                                    </td>--}}
{{--                                @else--}}
{{--                                    <td>--}}
{{--                                        <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" >--}}
{{--                                    </td>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}

                        @if(isset($paymentScheduleInfos))
                            @php $chk=0; @endphp
                            @foreach($paymentScheduleInfos as $key=>$val)
                                <tr>
                                    @foreach($headers as $header=>$field)
                                        @if (in_array($field, $right_align_column))
                                            <td style="text-align: right">{{ $val->$field }}</td>
                                        @elseif(in_array($field, $center_align_column))
                                                <td style="text-align: center">{{ $val->$field }}</td>
                                        @else
                                            <td>{{$val->$field}}</td>
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
          </div>
    </form>
</div>
