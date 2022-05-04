
<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
     <form id="mainForm" action="{{ route('paymentHistory') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
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
                  支払履歴一覧
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
                      @include('purchase.paymentHistory.pagination')
                      <!----------pagination End----------------->
                    <div class="row">
                      <div class="col-6">
                      </div>
                      <div class="col-6">
                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                          <tbody>
                            <tr style="height: 28px;">
                              <td style=" border: none!important;">
                                <button type="button" onclick="Thesearch();" class="btn bg-teal uskc-button text-white"
                                  data-dismiss="modal" style="width: 150px;">検　索</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" onclick="refresh()" class="btn text-white bg-default uskc-button"
                                  data-dismiss="modal" style="width: 150px;">一　覧</button>
                              </td>
                              <td style=" border: none!important;">
                                <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button" data-dismiss="modal"
                                  style="width: 159px;background: #009640;" @if(count($paymentHistoryInfos)<1) disabled @endif>Excelエクスポート</button>
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
            <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 10px 0 10px;">
               <div style="overflow: hidden;">
                <div class="table-responsive largeTable">
                  <table id="userTable" class="table table-bordered table-fill table-striped"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                  @php
                      $right_align_column = ['payment_amount'];
                      $date_time_column = ['payment_registration_date_time','payment_flag_registration_date_time'];
                  @endphp
                  @foreach($headers as $header=>$field)
                    @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field.'_sort'}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                    @else
                        <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                    @endif
                  @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach($headers as $header=>$field)
                    @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
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
                  <!-- <tr> -->

                  @if(isset($paymentHistoryInfos))
                      @foreach($paymentHistoryInfos as $key=>$val)
                          <tr>
                              @foreach($headers as $header=>$field)
                              @if (in_array($field, $right_align_column))
                                  <td style="text-align: right">{{ $val->$field }}</td>
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