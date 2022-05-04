<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('billingLedger') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{ isset($old['Button']) ? $old['Button'] : null }}">
        <input type="hidden" id="sortField" name="sortField"
            value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
        <input type="hidden" id="sortType" name="sortType"
            value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
        <input type="hidden" id="userId" name="userId" value="{{ $bango }}">
        <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token" disabled>
        @csrf
        <!-- first search req data //fsReqData=first search request data -->
        @if (isset($fsReqData))
            @foreach ($fsReqData as $k => $v)
                <input type="hidden" value="{{ $v }}" name="{{ $k }}ReqVal">
            @endforeach
        @endif
        <div class="content-bottom-top">
            <div class="container content-middle-top">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            得意先元帳（社外）
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="wrapper-pagination"
                            style="background-color:#fff;height:130px;padding: 10px;border-radius: 5px;">
                            @include('sales.billingLedger.pagination')
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-6 ml-auto">
                                    <table class="table custom-form"
                                        style="border: none!important;width: auto;float:right;">
                                        <tbody>
                                            <tr style="height: 28px;">
                                                <td style=" border: none!important;">
                                                    <button type="button" id="choice_button"
                                                        class="btn bg-teal uskc-button text-white"
                                                        onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                                        data-dismiss="modal" disabled>検索
                                                    </button>
                                                </td>
                                                <td style=" border: none!important;">
                                                    <button type="button" id="" onclick="refresh()"
                                                        message="データを一覧表示します。"
                                                        class="btn text-white bg-default uskc-button"
                                                        data-dismiss="modal">一覧
                                                    </button>
                                                </td>
                                                <td style=" border: none!important;">
                                                    <button type="button" class="btn text-white uskc-button"
                                                        id="excelDwld" onclick="excelDownload()"
                                                        message="データをEXCELファイルとしてダウンロードします。" data-dismiss="modal"
                                                        style="background: #009640;">Excelエクスポート
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
                        <div id="payment_history_content_1"
                            style="background-color:#fff;padding: 10px;border-radius: 4px;">
                            <div>
                                <div id="userTable" class="table-responsive tbl_long_height">
                                    <table class="table table-fill table-bordered custom-form">
                                        <thead class="thead-dark header text-center" id="myHeader">
                                            <tr>
                                                @foreach ($headers as $header => $field)
                                                    <th scope="col" class="signbtn">
                                                        <span {{-- onclick="AscDsc('{{ $field }}');" --}}
                                                            style="cursor: default;border:2px solid #4D82C6 ;padding: 3px;text-align: center;display: block;margin: auto;background-color:#4D82C6 ;  color: #fff;width: 100px;">{{ $header }}</span>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody id="billing_ledger_0408_pagination_table_body">
                                            {{--@foreach ($headers as $header => $field)
                                                <td>
                                                    <input type="text" name="{{ $field }}" class="form-control"
                                                        value="{{ isset($default_req_data[$field]) ? $default_req_data[$field] : null }} "
                                                        readonly>
                                                </td>
                                            @endforeach--}}
                                            @if (isset($allBillingLedger))
                                                @php
                                                    $right_align_column = ['slip_number', 'order_slip_number','unit_price', 'sales_amount', 'consumption_tax', 'deposit_amount','balance'];
                                                    $temp_slip_number="";
                                                    $i=0;
                                                @endphp
                                                @foreach ($allBillingLedger as $key => $val)
													
                                                    <tr>
                                                        @foreach ($headers as $header => $field)
                                                                @if (in_array($field, $right_align_column))
																	@if($field == 'consumption_tax' && $val->consumption_temp == 1)																		
																		@if($temp_slip_number != $val->slip_number && $val->lines == 1)
																			<td style="text-align: right">{{ $val->$field }}</td>
																		@else
																			<td style="text-align: right"></td>
																		@endif																		
																	@else	
																		<td style="text-align: right">{{ $val->$field }}</td>
																	@endif                                                               
                                                                @elseif($field == 'dates')
                                                                    <td>{{$val->dates_xls}}</td>
                                                                    @else
                                                                        <td>{{ $val->$field }}</td>
                                                                    @endif
                                                        @endforeach
                                                        @php
														$temp_slip_number = $val->slip_number;
														@endphp
                                                    </tr>
                                                    <input type="hidden" value="{{$i++}}">
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
