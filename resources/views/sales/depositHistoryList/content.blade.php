<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('depositHistoryList') }}" method="post">
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
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            入金消込履歴一覧
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-pagination">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                                @include('sales.depositHistoryList.pagination')
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <table class="table custom-form"
                                            style="border: none!important;width: auto;float:right;">
                                            <tbody>
                                                <tr style="height: 28px;">
                                                    <td style="border: none!important;">
                                                        <button type="button" id="choice_button"
                                                            class="btn bg-teal uskc-button text-white"
                                                            onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                                            data-dismiss="modal">検　索</button>
                                                    </td>
                                                    <td style="border: none!important;">
                                                        <button type="button" id=""
                                                            class="btn text-white bg-default uskc-button"
                                                            onclick="refresh()" message="データを一覧表示します。"
                                                            data-dismiss="modal">一　覧</button>
                                                    </td>
                                                    <td style="border: none!important;">
                                                        <button type="button" class="btn text-white uskc-button"
                                                            data-dismiss="modal" id="excelDwld"
                                                            onclick="excelDownload()"
                                                            message="データをEXCELファイルとしてダウンロードします。" data-dismiss="modal"
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
                <div class="row mt-3" style="">
                    <div class="col-lg-12">
                        <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                            <div>
                                <div class="table-responsive largeTable">
                                    <table id="userTable" class="table table-bordered table-fill table-striped"
                                        style="margin-bottom: 20px!important;">
                                        <thead class="thead-dark header text-center">
                                            <tr>
                                                @foreach ($headers as $header => $field)
                                                    @if($field == "changer")
                                                    <th scope="col" class="signbtn">
                                                        <span onclick="AscDsc('changer_short');"
                                                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{ $header }}</span>
                                                    </th>
                                                    @else
                                                    <th scope="col" class="signbtn">
                                                        <span onclick="AscDsc('{{ $field }}');"
                                                            style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{ $header }}</span>
                                                    </th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($headers as $header => $field)
                                                    @if($field == "changer")
                                                    <td>
                                                        <input type="text" name="changer_short"
                                                            class="form-control"
                                                            value="{{ isset($default_req_data['changer_short']) ? $default_req_data['changer_short'] : null }}">
                                                    </td>
                                                    @else
                                                    <td>
                                                        <input type="text" name="{{ $field }}"
                                                            class="form-control"
                                                            value="{{ isset($default_req_data[$field]) ? $default_req_data[$field] : null }}">
                                                    </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            @if (isset($allDepositHistoryList))
                                                @foreach ($allDepositHistoryList as $key => $val)
                                                    <tr>
                                                        @php
                                                            $right_align_column = [ 'deposit_line_number', 'dhl_apply_line_number'];
                                                        @endphp
                                                        @foreach ($headers as $header => $field)
                                                            @if (in_array($field, $right_align_column))
                                                                <td style="text-align: right">{{ $val->$field }}</td>
                                                            @elseif($field == 'in_charge')
                                                                <td>{{ mb_substr($val->$field, 0, 3) }}</td>
                                                            @elseif($field=='changer')
                                                            <td>{{$val->changer_short}}</td>
                                                            @elseif($field=='dhl_deposit_application')
                                                            <td style="text-align: right;">{{$val->formatted_dhl_deposit_application}}</td>
                                                            @else
                                                                <td>{{ $val->$field }}</td>
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
