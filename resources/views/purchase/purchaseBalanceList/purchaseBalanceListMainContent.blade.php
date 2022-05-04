<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
    <form id="mainForm" action="{{ route('purchaseBalanceList') }}" method="post">
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
    
  <div class="content-bottom-top" style="margin-bottom: 30px;">

    {{-- Page Title Starts Here --}}
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          買掛・購入残高一覧
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
                @include('purchase.purchaseBalanceList.pagination') 
               <!----------pagination End----------------->
               
              <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                    <tbody>
                      <tr style="height: 28px;">
                        <td style=" border: none!important;">
                          <button disabled onclick="Thesearch();" message="検索欄に入力した内容を検索します。" type="button" id="choice_button" class="btn bg-teal uskc-button text-white"
                            data-dismiss="modal" style="width: 150px;">検　索</button>
                        </td>
                        <td style=" border: none!important;">
                          <button onclick="refresh()" message="データを一覧表示します。" type="button" id="" class="btn text-white bg-default uskc-button"
                            data-dismiss="modal" style="width: 150px;">一　覧</button>
                        </td>
                        <td style=" border: none!important;">
                          <button id="excelDwld" onclick="excelDownload()" type="button" class="btn text-white uskc-button" data-dismiss="modal"
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
                        @foreach($headers as $header=>$field)
                        <th class="signbtn" scope="col"><span class="table_header_span">{{$header}}</span></th>
                        @endforeach
                    </tr>
                  </thead>
                  <tbody>
                      
                    <tr style="display:none;">
                      @foreach($headers as $header=>$field)
                        <td>
                          <input type="text" name="{{$field}}" class="form-control"
                            value="{{isset($req_data[$field])?$req_data[$field]:null}}">
                        </td>
                      @endforeach
                    </tr>
                      
                      
                    @if(isset($purchaseBalanceListInfo) && count($purchaseBalanceListInfo) > 0)
                    @foreach($purchaseBalanceListInfo as $key=>$val)
                        <tr>
                            @foreach($headers as $header=>$field)
                                @if($field == 'kk0002')
                                    <td>{{$val->$field}}</td>
                                @elseif($field == 'supplier_name')
                                    <td>{{$val->$field}}</td>
                                @else
                                <td style="text-align:right;">{{$val->$field}}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    
                    <tr>
                      @foreach($headers as $header=>$field)
                        @if($field == "supplier_name")
                        <td>合計</td>
                        @elseif($field == "formatted_kk0004")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0004'])}}@endif</td>
                        @elseif($field == "formatted_kk0005")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0005'])}}@endif</td>
                        @elseif($field == "formatted_purchase_discount")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_purchase_discount'])}}@endif</td>
                        @elseif($field == "formatted_kk0009")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0009'])}}@endif</td>
                        @elseif($field == "formatted_kk0010")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0010'])}}@endif</td>
                        @elseif($field == "formatted_kk0011")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0011'])}}@endif</td>
                        @elseif($field == "formatted_payment_discount")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_payment_discount'])}}@endif</td>
                        @elseif($field == "formatted_kk0015")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0015'])}}@endif</td>
                        @elseif($field == "formatted_kk0016")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0016'])}}@endif</td>
                        @elseif($field == "formatted_kk0017")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0017'])}}@endif</td>
                        @elseif($field == "formatted_kk0018")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0018'])}}@endif</td>
                        @elseif($field == "formatted_kk0019")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0019'])}}@endif</td>
                        @elseif($field == "formatted_kk0020")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0020'])}}@endif</td>
                        @elseif($field == "formatted_prepaid_payment_discount")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_prepaid_payment_discount'])}}@endif</td>
                        @elseif($field == "formatted_kk0024")
                        <td class="text-right">@if(isset($sum_array)){{number_format($sum_array['sum_of_kk0024'])}}@endif</td>
                        @else
                         <td> </td>
                        @endif
                      @endforeach   
                    </tr> 
                    
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