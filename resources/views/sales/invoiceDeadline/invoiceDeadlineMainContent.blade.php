@php
    /*$old = array();
    if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
    }*/

    $current_page=$searchData->currentPage();
    $per_page=$searchData->perPage();
    $first_data= ($current_page - 1)*$per_page+1;
    $last_data=($current_page - 1)*$per_page+ sizeof($searchData->items());
    $total=$searchData->total();
    $lastPage=$searchData->lastPage();
@endphp

<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('invoiceDeadline') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
    @csrf

    <!-- first search req data //fsReqData=first search request data -->
        @if(isset($fsReqData) && count($fsReqData)>0)

            <input type="hidden" id="categorykanri" name="categorykanri" @if(isset($fsReqData['categorykanri'])) value="{{$fsReqData['categorykanri']}}" @else value="" @endif>
            <input type="hidden" id="print_date" name="print_date" @if(isset($fsReqData['print_date'])) value="{{$fsReqData['print_date']}}" @else value="" @endif >
            <input type="hidden" id="datepicker1_oen" name="categorykanri_date" @if(isset($fsReqData['categorykanri_date'])) value="{{$fsReqData['categorykanri_date']}}" @else value="" @endif>
            <input type="hidden" id="invoiceDeadlineSupplier1" name="invoiceDeadlineSupplier1" @if(isset($fsReqData['invoiceDeadlineSupplier1'])) value="{{$fsReqData['invoiceDeadlineSupplier1']}}" @else value="" @endif>
            <input type="hidden" id="invoiceDeadlineSupplier1_db" name="invoiceDeadlineSupplier1_db" @if(isset($fsReqData['invoiceDeadlineSupplier1_db'])) value="{{$fsReqData['invoiceDeadlineSupplier1_db']}}" @else value="" @endif>
            <input type="hidden" id="invoiceDeadlineSupplier2" name="invoiceDeadlineSupplier2" @if(isset($fsReqData['invoiceDeadlineSupplier2'])) value="{{$fsReqData['invoiceDeadlineSupplier2']}}" @else value="" @endif>
            <input type="hidden" id="invoiceDeadlineSupplier2_db" name="invoiceDeadlineSupplier2_db" @if(isset($fsReqData['invoiceDeadlineSupplier2_db'])) value="{{$fsReqData['invoiceDeadlineSupplier2_db']}}"  @else value="" @endif>
            <input type="hidden" id="request_data01" name="request_data01" @if(isset($fsReqData['request_data01'])) value="{{$fsReqData['request_data01']}}" @else value="" @endif>
            <input type="hidden" id="request_data02" name="request_data02" @if(isset($fsReqData['request_data02'])) value="{{$fsReqData['request_data02']}}" @else value="" @endif>
            <input type="hidden" id="request_data03" name="request_data03" @if(isset($fsReqData['request_data03'])) value="{{$fsReqData['request_data03']}}" @else value="" @endif>
        @endif
    <div class="content-bottom-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bottom-top-title" style="letter-spacing: 0px;">
                        請　求　一　覧
                    </div>
                </div>
            </div>
        </div>
        <div class="content-bottom-pagination">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                            {{-- Pagination Starts Here --}}
                            @include('sales.invoiceDeadline.pagination')
                            {{-- Pagination Ends Here --}}
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-6">

                                </div>

                                <div class="col-6">
                                    <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                        <tbody>
                                        <tr style="height: 28px;">
                                            <td style=" border: none!important;">
                                                <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                                        class="btn bg-teal uskc-button text-white" data-dismiss="modal"> 検　索
                                                </button>
                                            </td>
                                            <td style=" border: none!important;">
                                                <button type="button" onclick="refresh()" message="データを一覧表示します。"
                                                        class="btn text-white bg-default uskc-button" data-dismiss="modal"> 一　覧
                                                </button>
                                            </td>
                                            <td style=" border: none!important;">
                                                <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button"
                                                        data-dismiss="modal" style="background: #009640;"> Excelエクスポート
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
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
                        <div id="userTable" class="table-responsive" style="overflow:auto;padding-bottom:25px;">
                            <table class="table table-fill table-bordered table-striped custom-form">
                                <thead class="thead-dark header text-center" id="myHeader">
                                @php
                                $formatted_field = ['formatted_datanum0051','formatted_datanum0052','formatted_datanum0053','formatted_datanum0054','formatted_datanum0055','formatted_datanum0056','formatted_datanum0057','formatted_datanum0058','formatted_datanum0059','formatted_datanum0060','formatted_datanum0061','formatted_datanum0062','formatted_datanum0063','formatted_datanum0064','formatted_datanum0065','formatted_datanum0066','formatted_datanum0067','formatted_datanum0068','formatted_datanum0069','formatted_datanum0070','formatted_datanum0071','formatted_datanum0072','formatted_datanum0073','formatted_datanum0074','formatted_datanum0075','formatted_datanum0076','formatted_datanum0077','formatted_datanum0078','formatted_datanum0079','formatted_datanum0080','formatted_datanum0081','formatted_datanum0082','formatted_datanum0083','formatted_datanum0084','formatted_datanum0085'];
                                @endphp
                                <tr>
                                    @foreach($headers as $header=>$field)
                                        @if($field == 'checkbox')
                                            <th class="signbtn check-tblall selectall"><span style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 20px;margin: auto;background-color:#4D82C6;  color: #fff;">✓</span></th>
                                            <th class="signbtn uncheck-tblall unselectall" style="display: none;"><span style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 20px;margin: auto;background-color:#4D82C6;  color: #fff;">✓</span></th>
                                        @elseif(in_array($field,$formatted_field))
                                            @php
                                            $field = str_replace("formatted_","",$field);
                                            @endphp
                                            <th class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                                        @else
                                        <th class="signbtn"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #4D82C6;padding: 3px;text-align: center;display: block;min-width: 90px;margin: auto;background-color:#4D82C6;  color: #fff;">{{$header}}</span></th>
                                        @endif
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach($headers as $header=>$field)
                                        @if($field == 'checkbox')
                                            <td>
                                            </td>
                                        @elseif($field == "issuer_name")
                                        <td>
                                            <input type="text" name="issuer_name_search" class="form-control" value="{{isset($old['issuer_name_search'])?$old['issuer_name_search']:null}}">
                                        </td>
                                        @elseif($field == "datatxt0143")
                                        <td>
                                            <input type="text" name="datatxt0143_search" class="form-control" value="{{isset($old['datatxt0143_search'])?$old['datatxt0143_search']:null}}">
                                        </td>
                                        @elseif(in_array($field,$formatted_field))
                                            @php
                                            $field = str_replace("formatted_","",$field);
                                            @endphp
                                            <td>
                                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                                            </td>
                                        @else
                                        <td>
                                            <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}">
                                        </td>
                                        @endif
                                @endforeach
                                </tr>
                                <!--      2nd row -->
                                @if(isset($searchData))
                                    @foreach($searchData as $key=>$val)
                                        <tr>
                                            @foreach($headers as $header=>$field)
                                                @if($field == "checkbox")
                                                <td>
                                                    <label class="checkbox_container" style="margin-left:18px !important;">
                                                        <input class="checkAllCheckbox tblCheckBox checkedItem" type="checkbox" id="" name="selected_item[]" value="{{$val->invoice_deadline_datatxt0142.'_'.$val->invoice_deadline_text3}}">
                                                        <span class="checkmark" style="top: -6px;left:-6px;"></span>
                                                    </label>
                                                </td>
                                                @elseif($field == 'sum_1' || $field == 'sum_2' || $field == 'sum_3' || $field == 'sum_4' || $field == 'sum_5'  
                                                || $field == 'sum_6' || $field == 'datanum0051' || $field == 'billedamount' || $field == 'invoice_deadline_text3' 
                                                || $field == 'formatted_datanum0051' || $field == 'formatted_datanum0052' 
                                                || $field == 'formatted_datanum0053' || $field == 'formatted_datanum0054' || $field == 'formatted_datanum0055' 
                                                || $field == 'formatted_datanum0056' || $field == 'formatted_datanum0057' || $field == 'formatted_datanum0058' 
                                                || $field == 'formatted_datanum0059' || $field == 'formatted_datanum0060' || $field == 'formatted_datanum0061' 
                                                || $field == 'formatted_datanum0062' || $field == 'formatted_datanum0063' || $field == 'formatted_datanum0064' 
                                                || $field == 'formatted_datanum0065' || $field == 'formatted_datanum0066' || $field == 'formatted_datanum0067' 
                                                || $field == 'formatted_datanum0068' || $field == 'formatted_datanum0069' || $field == 'formatted_datanum0070' 
                                                || $field == 'formatted_datanum0071' || $field == 'formatted_datanum0072' || $field == 'formatted_datanum0073' 
                                                || $field == 'formatted_datanum0074' || $field == 'formatted_datanum0075' || $field == 'formatted_datanum0076' 
                                                || $field == 'formatted_datanum0077' || $field == 'formatted_datanum0078' || $field == 'formatted_datanum0079' 
                                                || $field == 'formatted_datanum0080' || $field == 'formatted_datanum0081' || $field == 'formatted_datanum0082' 
                                                || $field == 'formatted_datanum0083' || $field == 'formatted_datanum0084' || $field == 'formatted_datanum0085' 
                                                )
                                                    <td style="text-align: right">{{$val->$field}}</td>
                                                @elseif($field == "datatxt0144")
                                                    <td><a href="@if($val->$field!=null){{url('/pdf/invoiceDeadline').'/'.$val->$field}}@else{{'#'}}@endif" target="_blank" style="color:blue;">{{$val->datatxt0144_short}}</a></td>
                                                @elseif($field == "issuer_name")
                                                    <td>{{$val->issuer_name_short}}</td>
                                                @elseif($field == "datatxt0143")
                                                    <td>{{$val->datatxt0143_short}}</td>
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
