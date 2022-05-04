<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
<form id="mainForm" action="{{ route('supplierLedger') }}" method="post">
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
      <div class="content-bottom-top" style="margin-bottom: 30px;">
          {{-- Page Title Starts Here --}}
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="bottom-top-title">
                  仕入先元帳
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
                       @include('purchase.supplierLedger.pagination')
                    <!----------pagination End----------------->
                    <div class="row">
                      <div class="col-1 mt-1">
                        前月未残高
                      </div>
                      <div class="col-5 mt-1">
                        <span>
                          @if(isset($kk0015Value))
                            {{number_format($kk0015Value)}}
                          @endif
                        </span>
                      </div>
                      <div class="col-6">
                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                          <tbody>
                            <tr style="height: 28px;">
                              <td style=" border: none!important;">
                                <button onclick="Thesearch();" message="検索欄に入力した内容を検索します。" type="button" id="choice_button" class="btn bg-teal uskc-button text-white"
                                  data-dismiss="modal" style="width: 150px;" disabled>検　索</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="" onclick="refresh()" message="データを一覧表示します。"
                                 class="btn text-white bg-default uskc-button"
                                data-dismiss="modal" style="width: 150px;" disabled>一　覧</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="excelDwld" onclick="excelDownload()" message="データをEXCELファイルとしてダウンロードします。"
                                class="btn text-white uskc-button" data-dismiss="modal" @if(isset($supplierLedgerData) && count($supplierLedgerData)<1) disabled @endif
                                style="width: 159px;background: #009640;">Excelエクスポート</button>
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
                          {{-- @foreach($headers as $header=>$field)
                            @if($field == "formatted_ledger_number")
                              <th class="signbtn" scope="col"><span onclick="AscDsc('ledger_number');" class="table_header_span">{{$header}}</span></th>
                            @elseif($field == "formatted_ledger_unit_price")
                              <th class="signbtn" scope="col"><span onclick="AscDsc('ledger_unit_price');" class="table_header_span">{{$header}}</span></th>
                            @elseif($field == "formatted_ledger_amount")
                              <th class="signbtn" scope="col"><span onclick="AscDsc('ledger_amount');" class="table_header_span">{{$header}}</span></th>
                            @elseif($field == "formatted_ledger_payment_amount")
                              <th class="signbtn" scope="col"><span onclick="AscDsc('ledger_payment_amount');" class="table_header_span">{{$header}}</span></th>
                            @elseif($field == "formatted_ledger_accounts_payable")
                              <th class="signbtn" scope="col"><span onclick="AscDsc('ledger_accounts_payable');" class="table_header_span">{{$header}}</span></th>
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
                          {{-- <tr>
                          @foreach($headers as $header=>$field)
                            @if($field == "formatted_ledger_number")
                              <td><input name="{{'ledger_number'}}" value="{{isset($req_data['ledger_number'])?$req_data['ledger_number']:null}}" type="text" class="form-control"></td>
                            @elseif($field == "formatted_ledger_unit_price")
                              <td><input name="{{'ledger_unit_price'}}" value="{{isset($req_data['ledger_unit_price'])?$req_data['ledger_unit_price']:null}}" type="text" class="form-control"></td>
                            @elseif($field == "formatted_ledger_amount")
                              <td><input name="{{'ledger_amount'}}" value="{{isset($req_data['ledger_amount'])?$req_data['ledger_amount']:null}}" type="text" class="form-control"></td>
                            @elseif($field == "formatted_ledger_payment_amount")
                              <td><input name="{{'ledger_payment_amount'}}" value="{{isset($req_data['ledger_payment_amount'])?$req_data['ledger_payment_amount']:null}}" type="text" class="form-control"></td>
                            @elseif($field == "formatted_ledger_accounts_payable")
                              <td><input name="{{'ledger_accounts_payable'}}" value="{{isset($req_data['ledger_accounts_payable'])?$req_data['ledger_accounts_payable']:null}}" type="text" class="form-control"></td>
                            @else
                              <td><input name="{{$field}}" value="{{isset($req_data[$field])?$req_data[$field]:null}}" type="text" class="form-control"></td>
                            @endif
                          @endforeach
                          </tr> --}}
                          @if(isset($supplierLedgerData))
                            @foreach($supplierLedgerData as $key=>$val)
                            <tr>
                              @foreach($headers as $header=>$field)
                                @if($field == "formatted_ledger_number")
                                  <td class="text-right">{{$val->formatted_ledger_number}}</td>
                                @elseif($field == "formatted_ledger_unit_price")
                                  <td>{{$val->formatted_ledger_unit_price}}</td>
                                @elseif($field == "formatted_ledger_amount")
                                  <td class="text-right">{{$val->formatted_ledger_amount}}</td>
                                @elseif($field == "formatted_ledger_payment_amount")
                                  <td class="text-right">{{$val->formatted_ledger_payment_amount}}</td>
                                @elseif($field == "formatted_ledger_accounts_payable")
                                  <td class="text-right">{{$val->formatted_ledger_accounts_payable}}</td>
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