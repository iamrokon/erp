<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('purchaseOrder') }}" method="post">
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
            <input type="hidden" id="orderDateFromReqVal" name="orderDateFrom" @if(isset($fsReqData['orderDateFrom'])) value="{{$fsReqData['orderDateFrom']}}" @else value="" @endif>
            <input type="hidden" id="orderDateToReqVal" name="orderDateTo" @if(isset($fsReqData['orderDateTo'])) value="{{$fsReqData['orderDateTo']}}" @else value="" @endif>
            <input type="hidden" id="orderNoReqVal" name="orderNo" @if(isset($fsReqData['orderDateTo'])) value="{{$fsReqData['orderNo']}}" @else value="" @endif>
            <input type="hidden" id="rd1ReqVal" name="rd1" @if(isset($fsReqData['rd1'])) value="{{$fsReqData['rd1']}}" @else value="" @endif>
            <input type="hidden" id="rd2ReqVal" name="rd2" @if(isset($fsReqData['rd2'])) value="{{$fsReqData['rd2']}}" @else value="" @endif>
            <input type="hidden" id="correction_checkbox_hReqVal" name="correction_checkbox_h" @if(isset($fsReqData['correction_checkbox_h'])) value="{{$fsReqData['correction_checkbox_h']}}"  @else value="" @endif>
            <input type="hidden" id="information1_textReqVal" name="information1_text" @if(isset($fsReqData['information1_text'])) value="{{$fsReqData['information1_text']}}"  @else value="" @endif>
            <input type="hidden" id="information1_shortReqVal" name="information1_short" @if(isset($fsReqData['information1_short'])) value="{{$fsReqData['information1_short']}}"  @else value="" @endif>
            <input type="hidden" id="information2_textReqVal" name="information2_text" @if(isset($fsReqData['information2_text'])) value="{{$fsReqData['information2_text']}}"  @else value="" @endif>
            <input type="hidden" id="information2_shortReqVal" name="information2_short" @if(isset($fsReqData['information2_short'])) value="{{$fsReqData['information2_short']}}"  @else value="" @endif>
            <input type="hidden" id="information3_textReqVal" name="information3_text" @if(isset($fsReqData['information3_text'])) value="{{$fsReqData['information3_text']}}"  @else value="" @endif>
            <input type="hidden" id="information3_shortReqVal" name="information3_short" @if(isset($fsReqData['information3_short'])) value="{{$fsReqData['information3_short']}}"  @else value="" @endif>
        @endif
        <div class="content-bottom-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            発注一覧
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
                            @include('purchase.purchaseOrder.pagination')
                            <!----------pagination End----------------->
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-6">
                                        <table class="table custom-form" style="border: none!important;width: auto;">
                                            <tbody>
                                              <tr style="">
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                  <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                  チェック数</td>
                                                  <td style=" border: none!important;width: 15px!important;"></td>
                                                  <td id="checkedSum" style=" border: none!important;width: 50%;color: #000;font-weight: bold; font-size: 0.9em;"></td>
                                              </tr>
                                            </tbody>
                                          </table>
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
                                                            data-dismiss="modal" style="background: #009640;" @if(count($purchaseOrderInfos)<1) disabled @endif>
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
                <div class="row mt-3" style="">
                    <div class="col-lg-12">
                        <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                            <div style="overflow: hidden;">
                                <div class="table-responsive largeTable">
                                    <table id="userTable" class="table table-bordered table-fill table-striped"
                                           style="margin-bottom: 20px!important;">
                                        <thead class="thead-dark header text-center" id="myHeader">

                                        @foreach($headers as $header=>$field)
                                            @if($field=='check_tik')
                                                <th class="signbtn check-tblall" style="width:50px;"><span class="table_span_check" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 22px;margin: auto;background-color:#3e6ec1;  color: #fff;" >{{$header}}</span></th>
                                            @elseif($field=='user_name')
                                                <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('user_name_sort');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                            @else
                                                <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                                                @endif
                                        @endforeach

                                        </thead>
                                        <tbody>

                                        <tr>
                                            @foreach($headers as $header=>$field)
                                                @if($field=='check_tik')
                                                    <td></td>
                                                @elseif($field=='user_name')
                                                    <td>
                                                        <input type="text" name="user_name_sort" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" >
                                                    </td>
                                                @else
                                                    <td>
                                                        <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" >
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        @if(isset($purchaseOrderInfos))
                                            @php
                                                $right_align_column = ['correction_orders', 'purchase_consumption_tax','total_order_amount'];
                                                $chk=0;
                                            @endphp
                                            @foreach($purchaseOrderInfos as $key=>$val)
                                                <tr>
                                                    @foreach($headers as $header=>$field)
                                                        @if($field=='check_tik')
                                                            <td>
                                                                <div style="">
                                                                    <label class="checkbox_container" style="display: flex;align-items: center;justify-content: center;position: relative;padding-left:0px!important;">
                                                                        <input class="checkAllCheckbox tblCheckBox" type="checkbox" id="tblCheck{{$chk++}}" name="tblCheck{{$chk}}" value="{{$val->order_number1}}">
                                                                        <input type="hidden" class="tblCheckBox_h" value="0">
                                                                        <input type="hidden" class="hikiatenyukoDate_h" value="{{$val->denpyoshimebi}}">
                                                                        <input type="hidden" class="correction_orders_h" value="{{$val->correction_orders}}">
                                                                        <span class="checkmark" style="top: 0px;position: relative;"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        @elseif($field=='order_number1')
                                                            @if($val->purchase_order_pdf!=null)
                                                                <td>
                                                                    <a href="{{'/pdf/purchaseOrder/'.$val->purchase_order_pdf}}" target="_blank" style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->order_number1}}</a>
                                                                </td>
                                                            @elseif($val->purchase_order_pdf==null)
                                                                <td>{{$val->order_number1}}</td>
                                                                @endif
                                                        @elseif($field=='storage_number')
                                                            @if($val->storage_number!=null)
                                                                <td>
                                                                    <a href="#" onclick="downloadPurchaseOrderPdf('{{$val->purchase_order_pdf}}','{{$val->order_number1}}','{{$val->correction_orders}}','{{$bango}}')" style="color:#0056b3;text-decoration:underline;font-weight:600;">{{$val->$field}}</a>
                                                                </td>
                                                            @elseif($val->storage_number==null)
                                                                <td>{{$val->storage_number}}</td>
                                                            @endif
                                                        @else
                                                            @if (in_array($field, $right_align_column))
                                                                @if($field=='purchase_consumption_tax')
                                                                    <td style="text-align: right">{{ $val->purchase_consumption_tax_show }}</td>
                                                                @elseif($field=='total_order_amount')
                                                                    <td style="text-align: right">{{ $val->total_order_amount_show }}</td>
                                                                @else
                                                                    <td style="text-align: right">{{ $val->$field }}</td>
                                                                @endif
                                                            @else
                                                                <td>{{$val->$field}}</td>
                                                                @endif
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
    </form>
</div>
