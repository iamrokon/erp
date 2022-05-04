<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('unpaidList') }}" method="post">
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
            @if($k != "orderhenkan_bango" && $k != "temp_intorder05_input" && $k != "check_intorder05_input" && $k != "sortField" && $k != "sortType")
            <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
            @endif
        @endforeach
        @endif
        
    <div class="content-bottom-top">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="bottom-top-title">
                未入金一覧
              </div>
            </div>
          </div>
        </div>
        <div class="content-bottom-pagination" >
          <div class="container">
            <div class="row">
              <div class="col">
               <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">

                  <!-- Pagination Starts Here -->
                  @include('sales.unpaidList.pagination')
                  <!-- Pagination Ends Here -->

                    <div class="row" style="margin-bottom: 30px;">
                      <div class="col-6"></div>
                      <div class="col-6">
                          <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                              <tbody>
                                <tr style="height: 28px;">
                                  <td style=" border: none!important;">
                                      <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" class="btn bg-teal uskc-button text-white" data-dismiss="modal"> <!-- <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->検　索
                                      </button>
                                    </td>
                                    <td style=" border: none!important;">
                                      <button type="button" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button" data-dismiss="modal"> <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                                      </button>
                                    </td>
                                    <td style=" border: none!important;">
                                       <button type="button" id="excelDwld" onclick="excelDownload()" message="データをEXCELファイルとしてダウンロードします。" class="btn text-white uskc-button" data-dismiss="modal" style="background: #009640;"><!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> Excelエクスポート
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
                <div style="overflow: hidden;">
                  <div class="table-responsive largeTable">
                    <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                      <thead class="thead-dark header text-center" id="myHeader">
                        <tr>
                            @foreach($headers as $header=>$field)
                                @if($field == 'formatted_sales_amount')
                                <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('unpaidlist_sales_amount');"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                </th>
                                @else
                                <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');"
                                  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                                </th>
                                @endif
                            @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                @foreach($headers as $header=>$field)
                    @if($field == "user_name")
                    <td><input type="text" name="user_name_short" value="{{isset($req_data['user_name_short'])?$req_data['user_name_short']:null}}" class="form-control"></td>
                    @elseif($field == "formatted_sales_amount")
                    <td><input type="text" name="unpaidlist_sales_amount" value="{{isset($req_data['unpaidlist_sales_amount'])?$req_data['unpaidlist_sales_amount']:null}}" class="form-control"></td>
                    @else
                    <td><input type="text" name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" class="form-control"></td>
                    @endif
                @endforeach
                </tr>
                
                @if(isset($unpaidInfo))
                @foreach($unpaidInfo as $key=>$val)
                    <tr>
                    @php
                        $text_align_field = ['formatted_sales_amount','max_moneymax'];
                    @endphp
                    @foreach($headers as $header=>$field)
                        @if($field == "intorder05_input")
                        <td>
                            @if($val->req_dataint01 == '1 済')
                            {{$val->$field}}
                            @else
                            <div class="input-group">
                                <input name="orderhenkan_bango[]" value="{{$val->bango}}" type="hidden" />
                                <input name="temp_intorder05_input[]" type="text" class="form-control intorder05_input datePicker" id="datepicker5_oen"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style=""
                                value="{{$val->$field}}">
                                <input name="check_intorder05_input[]" type="hidden" value="{{$val->$field}}">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                            @endif
                        </td>
                        @elseif($field == "user_name")
                        <td>{{$val->user_name_short}}</td>
                        @elseif($field == "unpaidlist_sales_amount")
                        <td style="text-align: right;">{{$val->unpaidlist_sales_amount != null?number_format($val->unpaidlist_sales_amount):$val->unpaidlist_sales_amount}}</td>
                        @elseif($field == "unpaidlist_deposit_balance")
                        <td style="text-align: right;">{{$val->unpaidlist_deposit_balance != null?number_format($val->unpaidlist_deposit_balance):$val->unpaidlist_deposit_balance}}</td>
                        @elseif($field == "unpaidlist_sum_of_nyukingaku")
                        <td style="text-align: right;">{{$val->unpaidlist_sum_of_nyukingaku != null?number_format($val->unpaidlist_sum_of_nyukingaku):$val->unpaidlist_sum_of_nyukingaku}}</td>
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

    <div class="row mt-3">
    <div class="col-6 "></div>
      <div class="col-6 ">
        <div class="form-button float-right mt-4">
          <button id="updateButton" onclick="updateSelectedDepositeDate('{{route('updateSelectedDepositeDate')}}',event.preventDefault())" type="submit" @if($tantousya->innerlevel > 14){{'disabled'}}@endif class="btn btn-info uskc-button">登　録</button>
        </div>
      </div>
    </div>


      </div>
    </div>
    </form>
</div>
