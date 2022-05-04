<form id="mainForm" action="{{ route('purchaseLedger') }}" method="post">
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
    <div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">

        <div class="content-bottom-top" style="margin-bottom: 30px;">

          {{-- Page Title Starts Here --}}
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="bottom-top-title">
                  購入先元帳
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
                       @include('purchase.purchaseLedger.pagination')
                    <!----------pagination End----------------->
                    <div class="row">
                      
                      <div class="col-1 mt-1">
                        前月未残高
                      </div>
                      <div class="col-5 mt-1">
                        <span>
                          @if(isset($balance_of_prev_month))
                            {{number_format($balance_of_prev_month)}}
                          @endif
                        </span>
                      </div>
                      
                      <div class="col-6">
                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                          <tbody>
                            <tr style="height: 28px;">
                              <td style=" border: none!important;">
                                <button type="button" id="choice_button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。" type="button" id="choice_button" class="btn bg-teal uskc-button text-white"
                                  data-dismiss="modal" style="width: 150px;" disabled>検　索</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="" onclick="refresh()" message="データを一覧表示します。" class="btn text-white bg-default uskc-button"
                                  data-dismiss="modal" style="width: 150px;" disabled>一　覧</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="excelDwld" onclick="excelDownload()" message="データをEXCELファイルとしてダウンロードします。" class="btn text-white uskc-button" data-dismiss="modal"
                                  style="width: 159px;background: #009640;" @if(isset($purchaseLedgerInfo) && count($purchaseLedgerInfo)<1) disabled @endif>Excelエクスポート</button>
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
                      <table id="userTable" class="table table-bordered table-fill table-striped"
                        style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                          <tr>
                            {{--@foreach($headers as $header=>$field)
                              @if($field == "formatted_purchase_ledger_nyukosu")
                                <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_ledger_nyukosu');" class="table_header_span">{{$header}}</span></th>
                              @elseif($field == "formatted_purchase_ledger_kingaku")
                                <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_ledger_kingaku');" class="table_header_span">{{$header}}</span></th>
                              @elseif($field == "formatted_purchase_ledger_syouhizeiritu")
                                <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_ledger_syouhizeiritu');" class="table_header_span">{{$header}}</span></th>
                              @elseif($field == "formatted_purchase_ledger_payment_amount")
                                <th class="signbtn" scope="col"><span onclick="AscDsc('formatted_purchase_ledger_payment_amount');" class="table_header_span">{{$header}}</span></th>
                              @elseif($field == "formatted_purchase_ledger_accounts_payable")
                                <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_ledger_accounts_payable');" class="table_header_span">{{$header}}</span></th>
                              @else
                                <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');" class="table_header_span">{{$header}}</span></th>
                              @endif
                            @endforeach --}}  
                            @foreach($headers as $header=>$field)
                            <th class="signbtn" scope="col"><span class="table_header_span">{{$header}}</span></th>
                          @endforeach         
                          </tr>
                        </thead>
                        <tbody>
                          {{--<tr>
                            @foreach($headers as $header=>$field)
                              @if($field == "formatted_purchase_ledger_nyukosu")
                                <td><input name="{{'purchase_ledger_nyukosu'}}" value="{{isset($req_data['purchase_ledger_nyukosu'])?$req_data['purchase_ledger_nyukosu']:null}}" type="text" class="form-control"></td>
                              @elseif($field == "formatted_purchase_ledger_kingaku")
                                <td><input name="{{'purchase_ledger_kingaku'}}" value="{{isset($req_data['purchase_ledger_kingaku'])?$req_data['purchase_ledger_kingaku']:null}}" type="text" class="form-control"></td>
                              @elseif($field == "formatted_purchase_ledger_syouhizeiritu")
                                <td><input name="{{'purchase_ledger_syouhizeiritu'}}" value="{{isset($req_data['purchase_ledger_syouhizeiritu'])?$req_data['purchase_ledger_syouhizeiritu']:null}}" type="text" class="form-control"></td>
                              @elseif($field == "formatted_purchase_ledger_payment_amount")
                                <td><input name="{{'purchase_ledger_payment_amount'}}" value="{{isset($req_data['purchase_ledger_payment_amount'])?$req_data['purchase_ledger_payment_amount']:null}}" type="text" class="form-control"></td>
                              @elseif($field == "formatted_purchase_ledger_accounts_payable")
                                <td><input name="{{'purchase_ledger_accounts_payable'}}" value="{{isset($req_data['purchase_ledger_accounts_payable'])?$req_data['purchase_ledger_accounts_payable']:null}}" type="text" class="form-control"></td>
                              @else
                                <td><input name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" type="text" class="form-control"></td>
                              @endif
                            @endforeach
                          </tr>--}}
                          </tr>
                          @if(isset($purchaseLedgerInfo))
                            @foreach($purchaseLedgerInfo as $key=>$val)
                            <tr>
                              @foreach($headers as $header=>$field)
                                @if($field == "formatted_purchase_ledger_nyukosu")
                                  <td class="text-right">{{$val->formatted_purchase_ledger_nyukosu}}</td>
                                @elseif($field == "formatted_purchase_ledger_kingaku")
                                  <td class="text-right">{{$val->formatted_purchase_ledger_kingaku}}</td>
                                @elseif($field == "formatted_purchase_ledger_syouhizeiritu")
                                  <td class="text-right">{{$val->formatted_purchase_ledger_syouhizeiritu}}</td>
                                @elseif($field == "formatted_purchase_ledger_payment_amount")
                                  <td class="text-right">{{$val->formatted_purchase_ledger_payment_amount}}</td>
                                @elseif($field == "formatted_purchase_ledger_accounts_payable")
                                  <td class="text-right">{{$val->formatted_purchase_ledger_accounts_payable}}</td>
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

            {{-- Table Bottom Button Starts Here --}}
            {{-- <div class="row">
              <div class="ml-3 mr-3 d-flex mt-3 w-100 justify-content-end">
                <div class="form-button">
                  <button href="#" class="btn btn-info uskc-button"
                    style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
                </div>
              </div>
            </div> --}}
            {{-- Table Bottom Button Ends Here --}}

          </div>
        </div>
    </div>
</form>