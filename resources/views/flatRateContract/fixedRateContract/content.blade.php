<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form  id="mainForm" action="{{ route('fixedRateContract') }}" method="post">
        <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
        @csrf
        <!-- first search req data //fsReqData=first search request data -->
        @if(isset($fsReqData))
            @foreach($fsReqData as $k=>$v)
                <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
            @endforeach
        @endif
        <div class="content-bottom-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            定期定額契約一覧
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-pagination" >
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                                @include('flatRateContract.fixedRateContract.pagination')
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                            <tbody>
                                            <tr style="height: 30px;">
                                                <td style="border: none!important;">
                                                    <button
                                                        type="button"
                                                        onclick="Thesearch();"
                                                        message="検索欄に入力した内容を検索します。"
                                                        class="btn bg-teal uskc-button text-white"
                                                        data-dismiss="modal">検　索</button>
                                                </td>
                                                <td style="border: none!important;">
                                                    <button
                                                        type="button"
                                                        class="btn text-white bg-default uskc-button"
                                                        onclick="refresh()"
                                                        message="データを一覧表示します。">一　覧</button>
                                                </td>
                                                <td style="border: none!important;">
                                                    <button
                                                        type="button"
                                                        class="btn text-white uskc-button"
                                                        id="excelDwld"
                                                        onclick="excelDownload()"
                                                        message="データをEXCELファイルとしてダウンロードします。"
                                                        data-dismiss="modal"
                                                        style="background: #009640;">Excelエクスポート</button>
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
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                            <div style="overflow: hidden;">
                                <div class="table-responsive largeTable">
                                    <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                                        <thead class="thead-dark header text-center" id="myHeader">
                                            <tr>
                                                <th scope="col" class="signbtn" style="width: 50px;">
                                                    <span style="cursor:pointer;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto; color: #fff;"></span>
                                                </th>
                                                @foreach($headers as $header=>$field)
                                                    <th scope="col" class="signbtn" style="width: 50px;">
                                                        <span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">{{$header}}</span>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" autocomplete="off"></td>
                                            @foreach($headers as $header=>$field)
                                                <td>
                                                    <input type="text" name="{{$field}}" class="form-control" value="{{isset($req_data[$field])?$req_data[$field]:null}}">
                                                </td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $number_format_field = [];
                                            $text_align_field = ['contract_amount','contract_months','free_period','billing_cycle','quantity','unit_price','consumption_tax','gross_operating_profit','se_gross_profit','lab_gross_profit','sc_gross_profit','purchase_amount','number_of_windows','number_of_contracts','branch_number','line_number'];
                                        @endphp
                                        @if(isset($allFixedRateContract))
                                            @foreach($allFixedRateContract as $key => $val)
                                                <tr>
                                                    <td style="width:50px;">
                                                       <a
                                                           onclick="gotoFlatRateEntry('{{$val->contract_number}}')"
                                                           id="flatRateButton1" class="btn btn-info pro-sub-edit" style="{{-- @if($val->active_order_flag != 1 || $val->delete_status == 2)opacity:0.65 !important;pointer-events: none;@endif--}} width: 100%;" type="button">
                                                           <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>編集
                                                       </a>
                                                    </td>
                                                    @foreach($headers as $header=>$field)
                                                       @if($field == 'contract_number')
                                                           <td>
                                                            <a onclick="goToFixedRateInquiry('{{$val->contract_number}}')" target="_blank" style="color:#0056b3;text-decoration:underline;padding:2px 10px;border-right: 1px solid #e1e1e1;cursor:pointer;">{{$val->$field}}</a>
                                                           </td>
                                                        @elseif(in_array($field,$number_format_field))
                                                            <td style="text-align: right;">{{ $val->$field == null ? $val->$field : number_format($val->$field) }}</td>
                                                        @elseif(in_array($field,$text_align_field))
                                                            <td style="text-align: right;">{{$val->$field}}</td>
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
        </div>
    </form>
   </div>
