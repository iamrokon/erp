<form id="mainForm" action="{{ route('customer_ledger') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:'Thesearch'}}">
    <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
    <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

    @csrf

<!-- first search req data //fsReqData=first search request data -->
    @if(isset($fsReqData))
        <input type="hidden" id="start_dateReqVal" name="start_date" @if(isset($fsReqData['start_date'])) value="{{$fsReqData['start_date']}}" @else value="" @endif>
        <input type="hidden" id="end_dateReqVal" name="end_date" @if(isset($fsReqData['end_date'])) value="{{$fsReqData['end_date']}}" @else value="" @endif >
        <input type="hidden" id="customerLedgerSupplierReqVal" name="customerLedgerSupplier" @if(isset($fsReqData['customerLedgerSupplier'])) value="{{$fsReqData['customerLedgerSupplier']}}" @else value="" @endif>
        <input type="hidden" id="customerLedgerSupplier_dbReqVal" name="customerLedgerSupplier_db" @if(isset($fsReqData['customerLedgerSupplier_db'])) value="{{$fsReqData['customerLedgerSupplier_db']}}" @else value="" @endif>
    @endif
    <div class="content-bottom-section" style="padding-bottom:46px!important;">
        <div class="content-bottom-top">
    <div class="container">
    <div class="row">
        <div class="col">
            <div class="bottom-top-title">
                得意先元帳（社内）
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;border-radius: 5px;">
                <!-- new pagination row starts here -->

            @include('sales.customerLedger.pagination')
            <!----------pagination End----------------->

                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-6 ml-auto">
                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                            <tbody>
                            <tr style="height: 28px;">
                                <td style=" border: none!important;">
                                    <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                            class="btn bg-teal uskc-button text-white" data-dismiss="modal" disabled> 検　索
                                    </button>
                                </td>
                                <td style=" border: none!important;">
                                    <button type="button" onclick="refresh()" message="データを一覧表示します。"
                                            class="btn text-white bg-default uskc-button" data-dismiss="modal">一　覧
                                    </button>
                                </td>
                                <td style=" border: none!important;">
                                    <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button"
                                            data-dismiss="modal" style="background: #009640;" @if(count($customerLedgerInfo)<1) disabled @endif>Excelエクスポート
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
    <div class="contant-bottom-bottom mt-3">
        <div class="container">
    <div class="row">
    <div class="col">
        <div id="payment_history_content_1" style="background-color:#fff;border-radius: 4px;">
            <div>
                <div id="userTable" class="table-responsive tbl_long_height">
                    <table class="table table-fill table-bordered custom-form">
                        <thead class="thead-dark header text-center" id="myHeader">
                        @foreach($headers as $header=>$field)

                            <th scope="col" class="signbtn" style="width: 50px;"><span  style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>

                        @endforeach
                        </thead>
                        <tbody>
                        {{-- <tr>
                        @foreach($headers as $header=>$field)
                            <td>
                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($old[$field])?$old[$field]:null}}" disabled>
                            </td>
                        @endforeach

                        </tr> --}}
                        @if(isset($customerLedgerInfo))
								@php
								$temp_s1_s2kaiinid_s3shinkurokokyakuname = "";
								@endphp
                            @foreach($customerLedgerInfo as $key=>$val)
                                <tr>

                                    @foreach($headers as $header=>$field)

                                        @if($field=='s1_s2syouhinsyu_s3shinkurokokyakugroup' || $field=='s1_s2syukkasu_s3' || $field=='s1_s2dataint04_s3chumondate' || $field=='s1_s2searched3_s3' || $field=='s1_s2searched4_s3' || $field=='s1_s2_s3nyukingaku' || $field=='s1datanum0032_s2_s3' || $field=='s1_s2syouhinsyu_s3syouhinsyu'  )
                                            @if($field=='s1_s2dataint04_s3chumondate')
                                                <td class="text-right">{{$val->s1_s2dataint04_s3chumondate_show}}</td>
                                            @elseif($field=='s1_s2searched3_s3')
                                                <td class="text-right">{{$val->s1_s2searched3_s3_show}}</td>
                                            @elseif($field=='s1_s2searched4_s3')
                                                <td class="text-right">{{$val->s1_s2searched4_s3_show}}</td>
                                            @elseif($field=='s1_s2_s3nyukingaku')
                                                <td class="text-right">{{$val->s1_s2_s3nyukingaku_show}}</td>
                                            @else
                                                <td class="text-right">{{$val->$field}}</td>
                                                @endif
                                        @else
                                          <td>{{$val->$field}}</td>
                                        @endif
																				
                                    @endforeach
										@php
										$temp_s1_s2kaiinid_s3shinkurokokyakuname = $val->s1_s2kaiinid_s3shinkurokokyakuname;
										@endphp
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
