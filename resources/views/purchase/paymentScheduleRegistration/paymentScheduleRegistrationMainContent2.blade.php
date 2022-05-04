
<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
     <form id="mainForm" action="{{ route('paymentScheduleRegistration') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="pagination_dynamic_variable" name="pagination_dynamic_variable" value="">
        <input type="hidden" id="pagination_dynamic_variable_purchase_payment_schedule_reg_101" name="pagination_dynamic_variable_purchase_payment_schedule_reg_101" value="">
        <input type="hidden" id="pagination_dynamic_variable_purchase_payment_schedule_reg_102" name="pagination_dynamic_variable_purchase_payment_schedule_reg_102" value="">
        <input type="hidden" id="pagination_dynamic_variable_purchase_payment_schedule_reg_201" name="pagination_dynamic_variable_purchase_payment_schedule_reg_201" value="">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

        @csrf
        @if(isset($fsReqData))
          <!-- @foreach($fsReqData as $k=>$v)
            <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
          @endforeach -->
            <input type="hidden" id="yoteibi_startReqVal" name="yoteibi_start" @if(isset($fsReqData['yoteibi_start'])) value="{{$fsReqData['yoteibi_start']}}" @else value="" @endif>
            <input type="hidden" id="yoteibi_endReqVal" name="yoteibi_end" @if(isset($fsReqData['yoteibi_end'])) value="{{$fsReqData['yoteibi_end']}}"  @else value="" @endif>
            <input type="hidden" id="denpyohakkoubi_startReqVal" name="denpyohakkoubi_start" @if(isset($fsReqData['denpyohakkoubi_start'])) value="{{$fsReqData['denpyohakkoubi_start']}}"  @else value="" @endif>
            <input type="hidden" id="denpyohakkoubi_endReqVal" name="denpyohakkoubi_end" @if(isset($fsReqData['denpyohakkoubi_end'])) value="{{$fsReqData['denpyohakkoubi_end']}}"  @else value="" @endif>
            <input type="hidden" id="syouhinid_startReqVal" name="syouhinid_start" @if(isset($fsReqData['syouhinid_start'])) value="{{$fsReqData['syouhinid_start']}}"  @else value="" @endif>
            <input type="hidden" id="syouhinid_endReqVal" name="syouhinid_end" @if(isset($fsReqData['syouhinid_end'])) value="{{$fsReqData['syouhinid_end']}}" @else value="" @endif>
            <input type="hidden" id="datachar01_startReqVal" name="datachar01_start" @if(isset($fsReqData['datachar01_start'])) value="{{$fsReqData['datachar01_start']}}" @else value="" @endif>
            <input type="hidden" id="datachar01_endReqVal" name="datachar01_end" @if(isset($fsReqData['datachar01_end'])) value="{{$fsReqData['datachar01_end']}}" @else value="" @endif>
            <input type="hidden" id="rd1ReqVal" name="rd1" @if(isset($fsReqData['rd1'])) value="{{$fsReqData['rd1']}}" @else value="" @endif>
        @endif
     
        <div class="content-bottom-top" style="margin-bottom: 30px;">

          {{-- Page Title Starts Here --}}
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="bottom-top-title">
                  支払予定明細一覧
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
                  <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;" id="pagination_0610">
                      <!-- new pagination row starts here -->
                       @include('purchase.paymentScheduleRegistration.pagination')
                      <!----------pagination End----------------->
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Pagination Ends Here --}}

        </div>


    <div id="payment_schedule_registration_0610_pagination_body">
      @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new6')
    </div>

</form>
 </div>