<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            @font-face {
                font-family: msgothic;
                font-style: normal;
                font-weight: normal;
                src: url("{{ storage_path ('fonts/msgothic.ttf') }}") format('truetype');
            }

            body {
                font-family: msgothic;
                margin: 0px !important;
                padding: 0px !important;
                background: #fff;
                line-height: normal !important;
                color: #000000;
                /*margin: -2mm -2.7mm -2mm -2.6mm !important;*/
                margin:  -2mm -11px -2mm -11px !important;
            }

            .wrapper-content {
                margin: 0 auto;
                background: white;
                font-size: 11px;
                /*padding: 37.79px 37.79px 37.79px 56.69px;*/
                /*padding: 3mm 9mm;*/
            }

            .clearfix{
                display: block;
                content: "";
                clear: both;
            }

            table{
                border-spacing: 0;
            }

            .main-table table{
                border: 1px solid #000;
                width: 100%;
                border-spacing: 0px !important;
                border-radius: 5px;
            }

            .main-table table tr td{
                /*position: relative;*/
                border-top: 1px solid #000;
                word-wrap: break-word;
                vertical-align: baseline;
            }

            .main-table table tr:first-child td{
                border-top: none;
            }

            @media print {
              * {
                background: transparent !important;
                color: #000 !important;
                box-shadow: none !important;
                text-shadow: none !important;
                margin: 0;
                padding: 0;
                line-height: normal !important;
              }

              body {
                padding: 0;
              }
            }

            @page {
                size: A4;
                /* margin: 0; */
            }

            /* @media screen, print{
                  @page {
                      max-width: 100%;
                      max-height:100%;
                      position:fixed;
                  }
              } */
        </style>
    </head>
    <body>
        <div class="wrapper-content">
            @php
            $page_no=1;
            $count_data=count($data);
            $no_of_page=intval($count_data/3);
            if ($count_data%3==0){
                $no_of_page=$no_of_page;
            }else{
                $no_of_page=$no_of_page+1;
            }
            @endphp
            @foreach($data as $key=>$value)
            <!--pdf header starts here-->
            @if($loop->first || $key%3==0)
                <div class="pdf-head-top">
                    <div style="width: 41%;float: left;">
                        <div style="word-wrap: break-word;">{{$data[0]->company_name1}}</div>
                        <div style="word-wrap: break-word;">{{$data[0]->department_name1}}</div>
                        <div style="word-wrap: break-word;">{{$data[0]->personal_name1}}&nbsp;様</div>
                        <div style="border-bottom: 1px solid #808080;">
                            <span>TEL: {{$data[0]->phone_number1}}</span>
                            <span>{{$data[0]->mail_address4}}</span>
                        </div>
                        <div>
                            <span>{{$data[0]->para1}}</span>
                            <!--<span>&nbsp;&nbsp;良夢ちゃん良夢ちゃん</span>-->
                        </div>
                    </div>
                    <div style="width: 19%;text-align: center;float: left;margin-top: -5px;">
                        <span style="font-size: 18px;letter-spacing: 4px;border-bottom: 1px solid #808080;padding-left: 15px;padding-bottom: 5px;">
                            {{$data[0]->heading}}
                        </span>
                    </div>
                    <div style="width: 40%;float: left;margin-top: -5px;">
                        <div style="width:100%;margin-bottom: 3px;">
                            <table style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 60px;vertical-align: baseline;">発注日</td>
                                        <td style="vertical-align: baseline;">{{$data[0]->order_date}}</td>
                                        <td style="text-align:right;vertical-align: baseline;">{{$page_no++}}/{{$no_of_page}}頁</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">発注番号</td>
                                        <td style="vertical-align: baseline;">{{$data[0]->order_number}}</td>
                                        <td style="vertical-align: baseline;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pdf-logo" style="margin-bottom: 3px;">
                            <img src="{{resource_path() . '/views/purchase/purchaseOrder/pdfCreation/img/logol.png'}}" height="30px">
                        </div>
                        <div>{{$data[0]->department_name2}} </div>
                        <div>
                            <span>TEL:{{$data[0]->phone_number2}} </span>
                            <span>{{$data[0]->mail_address3}}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="pdf-head-bottom">
                    <div style="width: 60%;float: left;">
                        <div>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;仕入先見積番号</span>
                            <span>&nbsp;&nbsp;{{$data[0]->quotation_number}}</span>
                        </div>
                        <div>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;仕入基準 : {{$data[0]->purchase_criteria}}</span>
                            <span style="width: 80px;"></span>
                            <span>支払条件 : {{$data[0]->terms_of_payment}}</span>
                        </div>
                    </div>
                    <div style="width: 40%;float: left;">
                        <div>
                            <span style="width: 40px;">発注者</span>
                            <span>{{$data[0]->orderer}}</span>
                            <span width="15px"></span>
                            <span style="width: 40px;">承認者</span>
                            <span>{{$data[0]->approver}}</span>
                        </div>
                        <div>
                            <span style="width: 40px;">起票者</span>
                            <span>{{$data[0]->logger}}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endif
            <!--pdf header ends here-->


                <!--pdf body starts here-->

                @if($loop->first || $key%3==0)
                <div class="main-table">
                    <table>
                @endif
                <!--looping tr here-->

                        <tbody>

                        @if($loop->first || $key%3==0)
                            <tr>
                                <td style="text-align:center;border-right: 1px solid #000;vertical-align: middle;" width="4%">行</td>
                                <td style="text-align:center;border-right: 1px solid #000;" width="20%">品番<br>品名</td>
                                <td style="text-align:center;border-right: 1px solid #000;" width="12%">個別納期<br>現調日<br>現調時間</td>
                                <td style="text-align:center;border-right: 1px solid #000;" width="10%">数量</td>
                                <td style="text-align:center;border-right: 1px solid #000;" width="12%">単価<br>金額<br>消費税</td>
                                <td style="text-align:center;" width="42%">納品先名及び住所・TEL</td>
                            </tr>
                        @endif

                        <tr>
                            <td rowspan="2" style="vertical-align: middle;border-right: 1px solid #000;text-align: center;">{{$value->yes}}</td>
                            <td style="border-right: 1px solid #000;height: 90px;">{{$value->part_number}}<br>{{$value->body_name}}</td>
                            <td style="border-right: 1px solid #000;text-align: center;">{{$value->delivery_date}}<br>{{$value->day_adjust}}<br>{{$value->tuning_time}}</td>
                            <td style="text-align:right;border-right: 1px solid #000;padding-right: 2px;">{{$value->quantity}}</td>
                            <td style="text-align:right;border-right: 1px solid #000;padding-right: 2px;">{{$value->unit_price}}<br>{{$value->amount}}<br>{{$value->consumption_tax1}}</td>
                            <td rowspan="2" style="position:relative;padding-right: 10px;">
                                <div style="height: 44px;position: relative;">
                                    <div>〒{{$value->address5_1}}&nbsp;{{$value->address5_2}}&nbsp;{{$value->address5_3}}</div>
                                    <div style="position: absolute;right: 0;top: 29px;">
                                        TEL:{{$value->phone_number3}}
                                    </div>
                                </div>
                                {{$value->company_name2}}<br>{{$value->personal_name2}}

                                @if($loop->first || $key%3==0)
                                    <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;">回答納期{{--{{$value->delivery_response}}--}}</div>
                                    @else
                                        <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;"></div>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-right: 1px solid #000;height: 45px;">
                                <div style="width: 100%;">
                                    <div style="float: left;width: 6%;">
                                        <div style="padding-top:10px;">備<br>考</div>
                                    </div>
                                    <!--<div style="float:left;width: 93%;">{{$value->detail_remarks}}</div>-->
                                    <div class="clearfix"></div>
                                </div>
                            </td>
                        </tr>
                        <!--pdf blank row start-->
                        @if($loop->last)
                            @if(count($data)%3==1)
                                <tr>
                                    <td rowspan="2" style="vertical-align: middle;border-right: 1px solid #000;text-align: center;"></td>
                                    <td style="border-right: 1px solid #000;height: 90px;"></td>
                                    <td style="border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td rowspan="2" style="position:relative;">

                                    <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border-right: 1px solid #000;height: 45px;"></td>
                                </tr>
                                <tr>
                                    <td rowspan="2" style="vertical-align: middle;border-right: 1px solid #000;text-align: center;"></td>
                                    <td style="border-right: 1px solid #000;height: 90px;"></td>
                                    <td style="border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td rowspan="2" style="position:relative;">

                                    <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border-right: 1px solid #000;height: 45px;"></td>
                                </tr>
                                @elseif(count($data)%3==2)
                                <tr>
                                    <td rowspan="2" style="vertical-align: middle;border-right: 1px solid #000;text-align: center;"></td>
                                    <td style="border-right: 1px solid #000;height: 90px;"></td>
                                    <td style="border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td style="text-align:right;border-right: 1px solid #000;"></td>
                                    <td rowspan="2" style="position:relative;">

                                    <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="border-right: 1px solid #000;height: 45px;"></td>
                                </tr>
                                @endif
                        @endif
                        

                        </tbody>

                @if($loop->last || ($key+1)%3==0)
                    </table>
                @endif

                <!--pdf body ends here-->


                <!--pdf footer starts here-->
                @if($loop->last || ($key+1)%3==0)
                    <table style="margin-top: -1px;">
                        <tbody>
                        <tr>
                            <td style="border-right: 1px solid #000;height: 30px;vertical-align: middle;padding-right: 2px;">
                                <div style="width: 100%;height: 20px;padding-top: 7px;">
                                    <div style="width: 80%;float: left;">{{$data[0]->end_customer}}</div>
                                    <div style="text-align: right;width: 19%;float: left;">{{$data[0]->order_no}}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- <span style="float: right;"></span> -->
                            </td>
                            <td style="width: 200px;vertical-align: middle;padding-right: 2px;position: relative;">
                                <div style="width: 100%;height: 20px;padding-top: 7px;">
                                    <div style="width: 20%;float: left;">合計</div>
                                    <div style="text-align: right;width: 80%;float: left;">{{$data[0]->summation}}</div>
                                    <div class="clearfix"></div>
                                </div>

                                <!-- <span style="float: right;margin-top: 8px;"></span> -->

                                <div style="border: 1px dotted #000;height: 15px;width: 100px;top: -23px;right: 0;position: absolute;border-radius: 5px;text-align: center;padding-top: 5px;"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table style="margin-top: -1px;">
                        <tbody>
                            <tr>
                                <td style="height: 100px;word-wrap: break-word;padding-right: 10px;">
                                    {{$data[0]->summary}}<br>
                                    {{$data[0]->slip_remarks2}}<br>
                                    {{$data[0]->slip_remarks3}}<br>
                                    {{$data[0]->para2}}
                                </td>
                                <td style="width: 202px;position: relative;">
                                    <div style="position: absolute;border-left: 1px solid #000;border-bottom: 1px solid #000;height: 25px;width: 201px;padding-right: 2px;top: 0;right: 0;padding-top: 5px;">
                                        <div style="width: 100%;height: 30px;">
                                            <div style="width: 30%;float: left;">消費税</div>
                                            <div style="text-align: right;width: 70%;float: left;">{{$data[0]->consumption_tax2}}</div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- <span style="float: right;"></span> -->
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    @if($loop->last==false)
                        <!--pdf page break here-->
                        <div style="page-break-before: always;"></div>
                        <!--pdf page break here-->
                        @endif
                @endif
                <!--pdf footer ends here-->



                @endforeach
            </div>
        </div>
    </body>
</html>
