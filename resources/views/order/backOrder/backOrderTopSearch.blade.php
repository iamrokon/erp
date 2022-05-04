<div class="container position-relative">
    @if(Session::has('success_msg'))
        <div class="row success-msg-box position-relative" id="session_msg" style="width: 100%;max-width: 1452px;z-index: 1;" >
            <div class="col-12" style="white-space: normal; word-break: break-all;">
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                             onclick="$('#division_datachar05_start').focus();">
                        &times;
                    </button>
                    <strong>{{session()->pull('success_msg') }}</strong>
                </div>
            </div>
        </div>
    @endif

    <div class="common_error" id="msgDiv"></div>

    @if(isset($arr_err) && !empty($arr_err) && gettype($arr_err)=='array')
          @foreach($arr_err as $msg)

            <p class="common_error" >{{$msg}}</p>
          @endforeach
        @endif

    <div class="common_error" id="gtMsgDiv">
    </div>

    @if(isset($backOrderError)&& $backOrderError!=null)
        <p class="common_error">{{$backOrderError}}</p>
    @endif

    <script>
    // Focus on Alert Closing
    $(".dismissMe").keydown(function (e) {
        if (e.shiftKey && e.which == 13) {
            $('.close').alert('close');
            event.preventDefault();
            $("#division_datachar05_start").click();
            $('#division_datachar05_start').focus();
        }
    });
    </script>
    
</div>
<div class="content-head-section ">
    <div class="container">
        <form id="firstSearch" action="{{ route('backOrder') }}" method="post">
            <input type="hidden" name="firstButton" value="topSearch">
            <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
{{--{{dd($fsReqData)}}--}}
            {{--{{dd(isset($fsReqData['department_datachar05_start']))}}--}}
            @csrf
            <div class="row">
            <div class="col-lg-12">

                <div style="">
                    <div class="wrap-100"
                         style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="content-head-top inner-top-content">

                                            @include('layout.commonOfficeDeptGroup')

                                            <div class="row" style="padding-top: 0px;">
                                                <!--4th dropdown-->
                                                <div class="col-5">
                                                    <table class="table custom-form" style="width:auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width: 5%!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box" style="margin-top: -1px;"></div>
                                                            </td>
                                                            <td style="border: none!important;width: 71px!important;">担当</td>
                                                            <td style=" border: none!important;">
                                                                <div class="custom-arrow position-relative" style="width: 266px!important;">
                                                                    <select name="datachar05" id="datachar05" class="form-control disabledDesign" style="width:100%;" autofocus="" > <!-- id="hidari0003" onchange="hidarifilter0003($(this))" -->
                                                                        <option value="">-</option>
                                                                        @foreach($datachar05 as $dtchar05)
                                                                            @if(isset($fsReqData['datachar05']))
                                                                                <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$fsReqData['datachar05']){{'selected'}}@endif>
                                                                                    {{$dtchar05->bango." ".$dtchar05->name}}
                                                                                </option>
                                                                            @else
                                                                                @if(isset($fsReqData) && count($fsReqData)>0)
                                                                                    <option value="{{$dtchar05->bango}}">
                                                                                        {{$dtchar05->bango." ".$dtchar05->name}}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$bango){{'selected'}}@endif>
                                                                                        {{$dtchar05->bango." ".$dtchar05->name}}
                                                                                    </option>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="ml-3 mr-3">
                                                    <table class="table custom-form" style="width: auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box" style="margin-top: -1px;"></div>
                                                            </td>
                                                            <td style="border: none !important;width: 71px;">売上年月</td>
                                                            <td style="border: none!important; width: 116px;">
                                                                @php
                                                                    $year = date('Y');
                                                                    $month = date('m');
                                                                    $nextYear = date("Y",strtotime("+1 year"));
                                                                    /*$lastMonth = date("m",strtotime("-1 month"));*/
                                                                    $start_date = $year.'/'.$month;
                                                                    $end_date = $nextYear.'/'.$month;
                                                                @endphp
{{--                                                                {{dd(isset($fsReqData))}}--}}
                                                                <input type="text" name="salesDate_start" id="from" class="form-control" placeholder=""  autocomplete="off" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="6" value="{{isset($fsReqData['salesDate_start'])?$fsReqData['salesDate_start'] : $start_date}}">
                                                                <input type="hidden" id="from_h" class="datePickerHidden">
                                                            </td>
                                                            <td style="border: none!important;width: 38px!important;text-align: center;">～</td>
                                                            <td style="border: none!important; width: 116px;">
                                                                <input type="text" name="salesDate_end" id="to" class="form-control" placeholder="" autocomplete="off" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="6" value="{{isset($fsReqData['salesDate_end'])?$fsReqData['salesDate_end'] :$end_date}}">
                                                                <input type="hidden" id="to_h" class="datePickerHidden">
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-bottom: 20px !important;">
                                                <div class="ml-3 mr-3" style="">
                                                    <table class="table custom-form" style="margin-bottom: 0px!important; width: auto;" id="tbl-supplier">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-render" style="padding-left:0px !important;border: none!important;color:black;">
                                                                <div style="width: 93px;">
                                                                    <div class="line-icon-box float-left mr-3" style="margin-top:1px;"></div>受注先
                                                                </div>
                                                            </td>
                                                            <td style="border: none!important;width: 443px;">
                                                                <div style="width: 443px;">
                                                                    <div class="input-group input-group-sm custom_modal_input">
                                                                        <input type="text" id="backOrderSupplier" name="backOrderSupplier" readonly="" class="form-control" placeholder="受注先"  style="padding: 0!important;" value="{{isset($fsReqData['backOrderSupplier'])? $fsReqData['backOrderSupplier'] : "受注先"}}">
                                                                        <input type="hidden" id="backOrderSupplier_db" name="backOrderSupplier_db" value="{{isset($fsReqData['backOrderSupplier_db'])? $fsReqData['backOrderSupplier_db'] : null}}">
                                                                        <div class="input-group-append" style="margin-left: 0px !important;">
                                                                            <a class="input-group-text btn" onclick="supplierSelectionModalOpener_2('backOrderSupplier','backOrderSupplier_db','1','nullable','r16cd',event.preventDefault())" style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-head-top">
                                    <div class="row" style="margin-top:10px;margin-bottom:25px;">
                                        <div class="col-9">
                                            <div class="radio-rounded custom-table-oh d-inline-block" style="margin-bottom: 4px;">
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:9px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="1"){{"checked"}}@endif checked="">
                                                    <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;">すべて</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="2"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;"> 定期定額以外</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="3"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio3" style="font-size: 12px!important;cursor:pointer;">保守</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio4" name="rd1" value="4" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="4"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;">サブスク</label>
                                                </div>
                                            </div>

                                            <div class="radio-rounded d-inline-block">
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left: 26px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio5" name="rd2" value="1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="1"){{"checked"}}@endif checked="">
                                                    <label class="custom-control-label" for="customRadio5" style="font-size: 12px!important;cursor:pointer;"> 営業</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio6" name="rd2" value="2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="2"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio6" style="font-size: 12px!important;cursor:pointer;"> SE</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio7" name="rd2" value="3" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="3"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio7" style="font-size: 12px!important;cursor:pointer;">研究所</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                                    <input type="radio" class="custom-control-input" id="customRadio8" name="rd2" value="4" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="4"){{"checked"}}@endif>
                                                    <label class="custom-control-label" for="customRadio8" style="font-size: 12px!important;cursor:pointer;"> 出荷C</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <div class="d-inline-block float-right">
                                                <a class="uskc-button btn btn-info" id="topSearchBtn">表示</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            {{-- <div style="border-top: 1px solid #E1E1E1"></div> --}}

                            <!-- product content col-12 ends here -->
                            </div>
                            <!-- product content row ends here -->
                        </div>
                        <!-- wrap-100 div end -->
                    </div>
                    <!-- bgcolor div end -->
                </div>
                <!-- col-12 div end -->
            </div>
            <!-- row div end -->
        </div>
        </form>
    </div>


<!--    <div class="content-bottom-section" style="padding-bottom:46px!important;">
        <div class="content-bottom-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bottom-top-title">
                            月別受注残一覧
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-pagination">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="pagi-content mt-3">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="" style="padding-left:0px!important;border: none !important;">
                                                        <div class="pagi" style="float: left;">
                                                            <div class="nav_mview">
                                                                <nav aria-label="Page navigation example ">
                                                                    <ul class="pagination">
                                                                        <li class="page-item" style="padding-right: 3px;">
                                                                            <a class="page-link" href="#" aria-label="Previous" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color:white !important;">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="w_50 "><input type="text" name="page" id="paginate" class="form-control intLimitTextBox text-center input_pagi" value="6" style="margin-top: 0px;height: 27px!important;border-radius: 4px!important;" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"></li>
                                                                        <li class="page-item" style="padding-left: 3px!important;"><a class="page-link" href="#" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;;border-radius: 4px!important;color: white !important;">=</a></li>
                                                                        <li class="page-item" style="padding-left: 3px!important;">
                                                                            <a class="page-link" href="#" aria-label="Next" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color: white !important;">
                                                                                <span aria-hidden="true">»</span>
                                                                                <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                    </td>                                <td class="p-2 pl-2 pr-2" style="border:none!important;"> 情報総数 203</td>                                <td class="p-2 pl-2 pr-2" style="border:none!important;">表示範囲 101～120</td>                                <td class="p-2 pl-2 pr-2" style="border:none!important;">ページ総数 11 &nbsp;&nbsp;</td>                           </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    &lt;!&ndash;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;pagination Start&#45;&#45;&#45;&#45;&#45;&#45;&ndash;&gt;
                                                    <td class="" style="margin-left : 0px">
                                                        <a class="b1">行指定 </a>
                                                    </td>
                                                    <td>
                                                        <div class="custom-arrow">
                                                            <select class="form-control left_select " style="width: 95px!important; border:1px solid #e1e1e1 !important;border-radius: 0.25rem!important;">
                                                                <option value="20">20</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td class="">
                                                        <a class="b2">行</a>
                                                    </td>
                                                    <td class="">
                                                        <div style="width: 110px;"></div>
                                                    </td>
                                                    <td class="">
                                                        <a href="#" class="btn btn-warning " style=" margin-top: 2px;" data-toggle="modal" data-target="#setting_display_modal">設定カラム表示</a>
                                                    </td>                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-6">

                                    </div>

                                    <div class="col-6">
                                        <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                            <tbody>
                                            <tr style="height: 28px;">
                                                <td style=" border: none!important;">
                                                    <button type="button" id="choice_button" class="btn bg-teal w-145 text-white" data-dismiss="modal" style="width: 150px;"> &lt;!&ndash; <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> &ndash;&gt;検　索
                                                    </button>
                                                </td>
                                                <td style=" border: none!important;">
                                                    <button type="button" id="" class="btn text-white bg-default w-145" data-dismiss="modal" style="width: 150px;"> &lt;!&ndash; <i class="" aria-hidden="true" style="margin-right: 5px;"></i> &ndash;&gt; 一　覧
                                                    </button>
                                                </td>
                                                <td style=" border: none!important;">
                                                    <button type="button" id="" class="btn text-white" data-dismiss="modal" style="width: 150px;background: #009640;">&lt;!&ndash;  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> &ndash;&gt; EXCEL作成
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
                                    <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                                        <thead class="thead-dark header text-center" id="myHeader">
                                        <tr>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                                            </th>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注番号</span>
                                            </th>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">担当</span>
                                            </th>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注先</span>
                                            </th>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注件名</span>
                                            </th>
                                            <th scope="col" class="signbtn" style="width: 50px;"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">受注日</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">検収日</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">売上日</span>
                                            </th>

                                            &lt;!&ndash;  <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 63px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注先</span>
                                           </th> &ndash;&gt;
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 82px;margin: auto;background-color:#3e6ec1;  color: #fff;">入金日</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">受注金額</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（SE）単価</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（研究所）単価</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（出荷C）単価</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">粗利</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 100px;margin: auto;background-color:#3e6ec1;  color: #fff;">売上請求先</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 60px;margin: auto;background-color:#3e6ec1;  color: #fff;">最終顧客</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 52px;margin: auto;background-color:#3e6ec1;  color: #fff;">入金日</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width: 70px;margin: auto;background-color:#3e6ec1;  color: #fff;">入金方法</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;width:70px;margin: auto;background-color:#3e6ec1;  color: #fff;">即時区分</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">検収条件</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">売上基準</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社内備考</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">伝票備考</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求課税区分</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">注文書PDF</span>
                                            </th>
                                            <th scope="col" class="signbtn"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">注文書書類保管番号</span>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>


                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>


                                        </tr>
                                        &lt;!&ndash;      2nd row &ndash;&gt;
                                        <tr>
                                            <td class="text-right" style="width:50px;">
                                                999
                                            </td>
                                            <td><a href="{{url('/order_inquiry')}}" target="_blank" style="color:#0056b3;text-decoration:underline;font-weight:600;">0150123456</a></td>
                                            <td class="">0275 小川卓也
                                            </td>
                                            <td class="">会社名略称/事業所名略称/個…
                                            </td>
                                            <td class="">受注件名　受注件名　受注件名…
                                            </td>

                                            <td class="text-right">yyyy/mm/dd</td>
                                            <td>yyyy/mm/dd</td>
                                            <td>yyyy/mm/dd</td>
                                            <td>yyyy/mm/dd</td>
                                            &lt;!&ndash;  <td>NNNNNNNNNN…</td>
                                             <td>NNNNNNNNNN…</td> &ndash;&gt;
                                            <td class="text-right">999,999,999</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">999,999,999</td>
                                            <td>会社名略称/事業所名略称/個…</td>
                                            <td>会社名略称/事業所名略称/個…</td>
                                            <td>yyyy/mm/dd</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>NNNNNNNNNN</td>
                                            <td>NNNNNNNNNN</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                        &lt;!&ndash;      3rd row &ndash;&gt;

                                        &lt;!&ndash;      4th row &ndash;&gt;
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="d-inline-block float-right">
                            <button class="btn btn-info" style="width: 120px;">登  録</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</div>
