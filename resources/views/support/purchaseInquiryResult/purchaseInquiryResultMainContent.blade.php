<div class="content-bottom-section" style="padding-bottom: 10px;">
<form id="mainForm" action="{{ route('purchaseInquiryResult') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    <input id='submit_confirmation' value='' type='hidden'/> 
    <input type="hidden" name="support_number" class="form-control" value="{{$support_number}}">
    @csrf
  <div class="content-bottom-top" style="margin-bottom: 30px;">

    {{-- Page Title Starts Here --}}
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            外注仕入実績照会
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
                    @include('support.purchaseInquiryResult.pagination')
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
                                onclick="Thesearch();" message="検索欄に入力した内容を検索します。" data-dismiss="modal" style="width: 150px;">検　索</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="" class="btn text-white bg-default uskc-button"
                                onclick="refresh()" message="データを一覧表示します。" data-dismiss="modal" style="width: 150px;">一　覧</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="excelDwld" onclick="excelDownload()"message="データをEXCELファイルとしてダウンロードします。"
                                class="btn text-white uskc-button" data-dismiss="modal" style="width: 159px;background: #009640;">Excelエクスポート</button>
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
      <div class="row mb-3">
        <div class="col-lg-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div style="overflow: hidden;">
              <div class="table-responsive largeTable">
                <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                  style="margin-bottom: 20px!important;">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                    @foreach($headers as $header=>$field)
                      @if ($field=='purchase_inquiry_formatted_quantity')
                      <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_inquiry_quantity');" class="table_header_span">{{$header}}</span></th>
                      @elseif ($field=='purchase_inquiry_formatted_unit_price')
                      <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_inquiry_unit_price');" class="table_header_span">{{$header}}</span></th>
                      @elseif ($field=='purchase_inquiry_formatted_amount')
                      <th class="signbtn" scope="col"><span onclick="AscDsc('purchase_inquiry_amount');" class="table_header_span">{{$header}}</span></th>
                      @else
                      <th class="signbtn" scope="col"><span onclick="AscDsc('{{$field}}');" class="table_header_span">{{$header}}</span></th>
                      @endif
                    @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach($headers as $header=>$field)
                        @if($field=='purchase_inquiry_formatted_quantity')
                          <td><input type="text" name="purchase_inquiry_quantity" class="form-control" value="{{isset($req_data['purchase_inquiry_quantity'])?$req_data['purchase_inquiry_quantity']:null}}"></td>
                        @elseif($field=='purchase_inquiry_formatted_unit_price')
                          <td><input type="text" name="purchase_inquiry_unit_price" class="form-control" value="{{isset($req_data['purchase_inquiry_unit_price'])?$req_data['purchase_inquiry_unit_price']:null}}"></td>
                        @elseif($field=='purchase_inquiry_formatted_amount')
                          <td><input type="text" name="purchase_inquiry_amount" class="form-control" value="{{isset($req_data['purchase_inquiry_amount'])?$req_data['purchase_inquiry_amount']:null}}"></td>
                        @else
                          <td><input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}"></td>
                        @endif
                      @endforeach
                    </tr>
                    @if(isset($purchaseInquiryResultData))
                      @foreach($purchaseInquiryResultData as $key=>$val)
                        <tr>
                        @foreach($headers as $header=>$field)
                          @if($field=='purchase_inquiry_formatted_quantity')
                            <td class="text-right">{{$val->$field}}</td>
                          @elseif($field=='purchase_inquiry_formatted_unit_price')
                            <td class="text-right">{{$val->$field}}</td>
                          @elseif ($field=='purchase_inquiry_formatted_amount')
                            <td class="text-right">{{$val->$field}}</td>
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