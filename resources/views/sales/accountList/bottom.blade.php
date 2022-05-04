@php
  if(isset($account_list))
  {
    $old = array();
    if(session()->has('oldInput'.$bango))
    {
      $old = session()->get('oldInput'.$bango);
    }
    $current_page = $account_list->currentPage();
    $per_page = $account_list->perPage();
    $first_data = ($current_page - 1)*$per_page+1;
    $last_data = ($current_page - 1)*$per_page+ sizeof($account_list->items());
    $total = $account_list->total();
    $lastPage = $account_list->lastPage() ;
  }
  else
  {
    $current_page = 1;
    $per_page = 20;
    $first_data = 1;
    $last_data = 0;
    $total = 0;
    $lastPage = 1;
  }
@endphp
<style>

  .bg-blue-tr{
    background-color:#CCE5FF!important;
  }
</style>
<form id="mainForm" action="{{ route('accountList') }}" method="post">
  <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
  <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
  <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
  <input type="hidden" id="userId" name="userId" value="{{$bango}}">
  <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
  <input type="hidden" id="source" value="accountList"/>
  <input id='submit_confirmation' value='' type='hidden'/>
  @csrf

  <!-- first search req data //fsReqData=first search request data -->
  
  @if(isset($fsReqData))
      <!-- @foreach($fsReqData as $k=>$v)
      <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
      @endforeach -->
      <input type="hidden" id="dateReqVal" name="date" @if(isset($fsReqData['date'])) value="{{$fsReqData['date']}}" @else value="" @endif>
      <input type="hidden" id="information2_1_shortReqVal" name="information2_1_short" @if(isset($fsReqData['information2_1_short'])) value="{{$fsReqData['information2_1_short']}}"  @else value="" @endif>
      <input type="hidden" id="information2_2_shortReqVal" name="information2_2_short" @if(isset($fsReqData['information2_2_short'])) value="{{$fsReqData['information2_2_short']}}"  @else value="" @endif>
      <input type="hidden" id="information2_1_textReqVal" name="information2_1_text" @if(isset($fsReqData['information2_1_text'])) value="{{$fsReqData['information2_1_text']}}"  @else value="" @endif>
      <input type="hidden" id="information2_2_textReqVal" name="information2_2_text" @if(isset($fsReqData['information2_2_text'])) value="{{$fsReqData['information2_2_text']}}"  @else value="" @endif>
  @endif
  <div class="content-bottom-section" style="padding-bottom:46px!important;">
    <div class="content-bottom-top">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="bottom-top-title">
              売掛残高一覧
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;border-radius: 5px;">
             @include('sales.accountList.pagination')
             <div class="row" style="margin-bottom: 30px;">
              <div class="col-6 ml-auto">
                <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                  <tbody>
                    <tr style="height: 28px;">
                      <td style=" border: none!important;">
                        <button type="button" disabled onclick="Thesearch();" class="btn bg-teal uskc-button text-white" data-dismiss="modal">検索
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button type="button" disabled onclick="refresh()" class="btn text-white bg-default uskc-button" data-dismiss="modal">一覧
                        </button>
                      </td>
                      <td style=" border: none!important;">
                        <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button" data-dismiss="modal" style="background: #009640;">Excelエクスポート
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
  <div class="contant-bottom-bottom mt-3">
    <div class="container">
      <div class="row">
        <div class="col">
          <div id="payment_history_content_1" style="background-color:#fff;padding: 10px;border-radius: 4px;">
            <div>
              <div class="largeTable table-responsive">
                <table id="userTable" class="table table-fill table-bordered custom-form">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                      @foreach($headers as $header=>$field)
                      <th class="signbtn" scope="col"><span
                        style="cursor:pointer;border:2px solid #4D82C6 ;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6 ;  color: #fff;min-width: 100px;">{{$header}}</span>
                      </th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      @foreach($headers as $header=>$field)
                      <td>
                        <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" >
                      </td>
                      @endforeach
                    </tr> -->
                    @if(isset($account_list))
                      @foreach($account_list as $key=>$val)
                      <tr class="@if($val->is_company==0){{ 'bg-blue-tr' }}@endif" >
                        @foreach($headers as $header=>$field)
                          @if(in_array($field, [ 'prev_receivable' , 'sales' , 'discount' , 'consumption_tax' , 'cash' , 'bills' , 'other_deposit' , 'rem_recievable' , 'loan_balance', 'cred_balance', 'row_total', 'balance_at_the_end_of_month_before', 'net_sales_curr_month', 'return_curr_month', 'discount_curr_month', 'sales_curr_month_others', 'tax_curr_month', 'cash_deposit_curr_month', 'bill_receipt_curr_month', 'offset_amount_curr_month', 'curr_deposit_discount', 'reposited_that_month', 'balance_at_the_end_of_month', 'balance_of_bill_before', 'bill_settlement_amount', 'balance_of_bill', 'balance_of_advance_before', 'invoice_amount_before', 'consumption_tax_before', 'cash_deposit_before', 'receipt_amount_before_current', 'offset_amount_before', 'deposit_discount_before', 'receipt_amount_before', 'balance_of_receipt_before']))
                            @php
                              $temp_field = $field.'_commafied'
                            @endphp
                            <td class=" @if($val->is_company==0){{ ' bg-blue-tr' }}@endif text-right @if($val->$field<0){{ ' text-danger' }}@endif">{{ $val->$temp_field }}</td>
                          @else
                            <td class="@if($val->is_company==0){{ 'bg-blue-tr' }}@endif">{{ $val->$field }}</td>
                          @endif
                        @endforeach
                      </tr>
                      @endforeach
                    @endif
                    
                    @if(isset($account_list_total) && $show_total == 1)
                      @foreach($account_list_total as $key=>$val)
                      <tr class="@if($val->is_company==0){{ 'bg-blue-tr' }}@endif" >
                        @foreach($headers as $header=>$field)
                          @if(in_array($field, [ 'prev_receivable' , 'sales' , 'discount' , 'consumption_tax' , 'cash' , 'bills' , 'other_deposit' , 'rem_recievable' , 'loan_balance', 'cred_balance', 'row_total', 'balance_at_the_end_of_month_before', 'net_sales_curr_month', 'return_curr_month', 'discount_curr_month', 'sales_curr_month_others', 'tax_curr_month', 'cash_deposit_curr_month', 'bill_receipt_curr_month', 'offset_amount_curr_month', 'curr_deposit_discount', 'reposited_that_month', 'balance_at_the_end_of_month', 'balance_of_bill_before', 'bill_settlement_amount', 'balance_of_bill', 'balance_of_advance_before', 'invoice_amount_before', 'consumption_tax_before', 'cash_deposit_before', 'receipt_amount_before_current', 'offset_amount_before', 'deposit_discount_before', 'receipt_amount_before', 'balance_of_receipt_before']))
                            @php
                              $temp_field = $field.'_commafied'
                            @endphp
                            <td class=" @if($val->is_company==0){{ ' bg-blue-tr' }}@endif text-right @if($val->$field<0){{ ' text-danger' }}@endif">{{ $val->$temp_field }}</td>
                          @else
                            <td class="@if($val->is_company==0){{ 'bg-blue-tr' }}@endif">{{ $val->$field }}</td>
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
    </div>
  </div>
</div>
</form>
