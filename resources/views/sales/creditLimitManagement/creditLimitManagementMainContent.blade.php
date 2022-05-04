<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">
    <form id="mainForm" action="{{ route('creditLimitManagement') }}" method="post">
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
        @endif
          <div class="content-bottom-top" style="margin-bottom: 30px;">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title">
                    与信限度チェック管理表
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
                        @include('sales.creditLimitManagement.pagination')
                       <!----------pagination End----------------->
                      <div class="row">
                        <div class="col-7 ml-auto">
                          <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                            <tbody>
                            <tr style="height: 28px;">
                                <td style=" border: none!important;">
                                    <button type="button"  message="検索欄に入力した内容を検索します。"
                                            class="btn bg-teal text-white uskc-button" data-dismiss="modal" disabled> 検　索
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
                                            data-dismiss="modal" style="background: #009640;" @if(count($creditLimitManagementInfos)<1) disabled @endif>
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
                <div class="col-12">
                  <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
                    <div class="table-responsive largeTable">
                      <table id="userTable" class="table table-bordered table-fill table-striped"
                        style="margin-bottom: 20px!important;">
                        <thead class="thead-dark header text-center" id="myHeader">
                        @php
                            $right_align_column = ['clm_credit_limits', 'clm_total_amounts','clm_maintenance_schedule','clm_note_remaining_schedule','clm_scheduled_balance'];
                            $date_time_column = ['clm_sales_schedule'];
                        @endphp
                        @foreach($headers as $header=>$field)
                            @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                                <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                            @else
                                <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                            @endif
                        @endforeach
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($headers as $header=>$field)
                                @if(in_array($field, $right_align_column) || in_array($field, $date_time_column))
                                    @php $sort_field=$field.'_sort'@endphp
                                    <td>
                                        <input type="text" name="{{$sort_field}}" class="form-control" value="{{isset($old[$sort_field])?$old[$sort_field]:null}}" disabled>
                                    </td>
                                @else
                                    <td>
                                        <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" disabled>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @if(isset($creditLimitManagementInfos))
                            @foreach($creditLimitManagementInfos as $key=>$val)
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
          </div>
    </form>
</div>
