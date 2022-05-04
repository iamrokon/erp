<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>
    <style type="text/css">
      @font-face {
        font-family: msgothic;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path ('fonts/msgothic.ttf') }}") format('truetype');
      }
      body {
        font-family: msgothic;
        font-size: 12px;
        margin: 0px !important;
        padding: 0px !important;
        background: #fff;
        /*line-height: normal !important;*/
      }
      .wrapper-content {
          /*width: 795px;*/
          margin: 0 auto;
          background: white;
          /*padding: 37.79px 37.79px 37.79px 56.69px;*/
          /*padding: 22mm 25mm;*/
          font-size: 10px;
          position: relative;
      }

      .pdf-logo{
        position: relative;
        height: 55px;
      }

      .pdf-img-stamp{
        position: absolute;
        left: 180px;
        top: -16px;
      }

      .clearfix{
        display: block;
        content: "";
        clear: both;
      }

      table thead tr td{
        text-align: center;
      }
     
      .pdf-data-table,
      .pdf-data-table-one{
        border: 1px solid #000;

      }

      .pdf-data-table thead tr td,
      .pdf-data-table tbody tr td,
      .pdf-data-table-one thead tr td,
      .pdf-data-table-one tbody tr td{
        border-right: 1px solid #000;
        padding: 0;
        vertical-align: middle;
      }

      .pdf-data-table thead tr td:last-child,
      .pdf-data-table tbody tr td:last-child,
      .pdf-data-table-one thead tr td:last-child,
      .pdf-data-table-one tbody tr td:last-child  {
        border-right: none;
      }

      .pdf-data-table tbody tr td{
        border-top: 1px solid #000;
      }

      .pdf-data-table-one tbody tr:nth-child(even) td{
        background-color: #D9E1F1;
      }

      .pdf-data-table-one tbody tr:nth-child(even) td:last-child{
        border-right: none;
      }

      .pdf-data-table-one thead tr td{
        border-bottom: 1px solid #000;
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
          /* font-size: 8px !important; */
        }

        body {
          padding: 0;
        }
      }

      @page {
        size: A4;
      }

      header {
        position: fixed;
        height: 1px;
        width: 20px;
        background: #000;
        left: -30px;
        top: 104mm;
      }

      footer {
        height: 1px;
        width: 20px;
        background: #000;
        position: fixed;
        right: -30px;
        top: 104mm;
      }
    </style>
  </head>
  <body>
    <header></header>
    <footer></footer>
    <main>
      <div class="wrapper-body">
        <div class="wrapper-content">
          <!-- <div class="left-line"></div>
          <div class="right-line"></div> -->

          <div style="width: 100%;margin-top:1mm;margin-bottom:5px;">
            <div style="width: 87.7mm;margin-left:11.3mm;float: left;margin-right: 50px;font-size: 13px;word-wrap: break-word;line-height: 1.1;">
              @php
              if($data[0]->office_address != null){
                $temp_office_address = preg_split("/[ ]/", $data[0]->office_address);
                $office_address = $temp_office_address[0] ." ". $temp_office_address[1] ." ". $temp_office_address[2];
                $office_address_last_part = $temp_office_address[3]??null;
              }else{
                $office_address = "";
                $office_address_last_part = "";
              }
              @endphp
              <div>〒{{substr($data[0]->office_yubinbango, 0, 3).'-'.substr($data[0]->office_yubinbango, 3)}}</div>
              <div>{{mb_convert_kana(str_replace("　","",str_replace(" ","",$office_address)),"rnask")}}</div>
              <div>{{mb_convert_kana(str_replace("　","",str_replace(" ","",$office_address_last_part)),"rnask")}}</div>
              <div>{{$data[0]->company_name}}</div>
              <div>&nbsp;&nbsp;&nbsp;&nbsp;{{$data[0]->office_name}}</div>
              <div>&nbsp;&nbsp;{{mb_convert_kana($personal_name,"rnask")}}</div>
              <div  style="font-size: 10px;">お客様コード　{{mb_convert_kana($personal_info2,"rnask")}}</div>
            </div>
            <div style="float: left;">
              <div style="margin-top: 6px;margin-bottom:20px;font-size: 18px;border-bottom: 2pt double black;">
                請　求　書
              </div>
              <div>
                <div class="pdf-logo">
                  <!-- <img src="img/logo.jpg" height="36px">
                  <img class="pdf-img-stamp" src="img/stamp.png" width="85px"> -->
                  {{-- <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/logo.jpg'}}" height="36px">
                  <img class="pdf-img-stamp" src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/stamp.png'}}" width="60px"> --}}
                  <img src="{{resource_path() . '/views/sales/invoiceDeadline/voucherCreation/img/usaclogo_syaban.png'}}" height="45px">
                </div>
                 <div class="clearfix"></div>
              </div>
              <div style="">
                <div style="font-size: 10px;"><!-- margin-left: 116mm -->
                  <div>登録番号 T7120001091573</div>
                  <div>大阪本社 〒541-0048 大阪市中央区瓦町1-6-10</div>
                  <div style="margin-left:28px;">経理部 TEL 06-6228-1384 FAX 06-6228-1380</div>
                  <div>東京本社 〒103-0015 東京都中央区日本橋箱崎町4-3</div>
                  <div style="margin-left:28px;">経理部 TEL 03-6661-1210 FAX 03-5643-0909</div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div style="width: 100%;">
            <div style="width: 53%;float: left; margin-right: 9%;font-size: 11px;">
              <table style="width: 200px;">
                <tbody>
                <tr>
                    <td style="width: 65px;">&nbsp;</td>
                    <td>&nbsp;　</td>
                  </tr>
                  <tr>
                    <td style="width: 65px;padding-right: 5px;">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;width: 65px;">発行年月日</td>
                    <td style="border-bottom: 1px solid #000;">{{$print_date}}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;width: 65px;padding-right: 5px;">請求書番号</td>
                    <td style="border-bottom: 1px solid #000;">{{$invoice_number}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="clearfix"></div>
            </div>

            <div style="width: 38%;float: left;margin-bottom: 0px;font-size: 11px;">
              <div><!-- style="float: right;" -->
                <table style="width: 100%;">
                  <tbody>
                    <tr>
                      <td style="padding-right: 5px;">取引銀行</td>
                      <td style="padding-right: 5px;">三井住友銀行</td>
                      <td style="padding-right: 5px;">御堂筋支店</td>
                      <td >当座6661280</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>りそな銀行</td>
                      <td>船場支店</td>
                      <td>当座1274350</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>三菱UFJ銀行</td>
                      <td>船場中央支店</td>
                      <td>当座1126963</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>みずほ銀行</td>
                      <td> 船場支店</td>
                      <td>当座0035398</td>
                    </tr>
                  </tbody>
                </table>
              </div>

               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>


           <!-- top content start -->
           <div style="width: 100%;margin-top: 5px;margin-bottom:5px;">
            <div style="width: 76%; float: left;margin-right:4%; ">
            <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;border-left: 1px solid; #000;line-height: 1.1;float:left;border-right: 1px  solid #000;">
              <thead style="background: #D9E1F1; width: 100%;">
                <tr>
                  <td style="padding: 0;vertical-align: middle;text-align: center;">前回御請求額</td>
                  <td style="padding: 0;vertical-align: middle;text-align: center;"> 今回御入金額</td>
                  <td style="padding: 0;vertical-align: middle;text-align: center;width: 80px;"> 繰　越　額</td>
                  <td style="padding: 0;vertical-align: middle;text-align: center;">今回御買上額</td>
                  <td style="padding: 0;vertical-align: middle;text-align: center;"> 今回消費税額</td>
                </tr>
              </thead>
              <tbody>
                <tr style="background-color: #fff;">
                  <td style="padding:1px;word-wrap: break-word;text-align: right;background: #fff;">{{number_format($data[0]->datanum0051)}}</td>
                  <td style="padding:1px;word-wrap: break-word;text-align: right;background: #fff;">{{number_format($data[0]->deposit_amount)}}</td>
                  <td style="padding:1px;text-align: right;white-space: normal;overflow: hidden;background: #fff;">{{number_format($data[0]->datanum0051 - $data[0]->deposit_amount)}}</td>
                  <td style="padding:1px;word-wrap: break-word; text-align: right;background: #fff;">{{number_format($data[0]->purchase_amount)}}</td>
                  <td style="padding:1px;word-wrap: break-word;text-align: right;background: #fff;">{{number_format($data[0]->datanum0056)}}</td>
                </tr>
              </tbody>
            </table>
            <div class="clearfix"></div>
            </div>

            <div style="width: 20%; margin-left:80%;">
            {{-- <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;border-top: .5px solid #000;border-left: .5px solid #000;border-bottom: .5px solid #000;border-right: .5px solid #000;line-height: 1.2;float:left;">
              <thead style="background: #D9E1F1; width: 100%;">
                <tr>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;vertical-align: middle;text-align: center;">今回御請求額</td>
                </tr>
              </thead>
              <tbody>
                <tr style="background-color: #fff;">
                  <td style="border-right: 1px solid #000;word-wrap: break-word;text-align: right;background: #fff;padding: 1px;">{{number_format(($data[0]->datanum0051 - $data[0]->deposit_amount) + $data[0]->purchase_amount + $data[0]->datanum0056)}}</td>
                </tr>
              </tbody>
            </table> --}}
            <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;line-height: 1.1;float:left;">
              <thead style="background: #D9E1F1; width: 100%;">
                <tr>
                  <td style="padding: 0;vertical-align: middle;text-align: center;">今回御請求額</td>
                </tr>
              </thead>
              <tbody>
                <tr style="background-color: #fff;">
                  <td style="padding:1px;word-wrap: break-word;text-align: right;background: #fff;">{{number_format(($data[0]->datanum0051 - $data[0]->deposit_amount) + $data[0]->purchase_amount + $data[0]->datanum0056)}}</td>
                </tr>
              </tbody>
            </table>

              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
           </div>
           <!-- top content end -->

          <!-- content 1 -->
          <div style="width: 100%;margin-top: 2px; float:left;">
            <table class="pdf-data-table-one" style="border-spacing: 0px;width: 100%;font-size: 12px;line-height: 1.1;table-layout:fixed;border-top:1.3px solid #000;border-bottom:1px solid transparent;border-collapse:initial">
              <thead style="background: #D9E1F1; width: 100%;">
                <tr>
                  <td style="width: 10%;">売上日</td>
                  <td style="width: 10%;">伝票番号</td>
                  <td style="width: 5%;">区分</td>
                  <td style="width: 35%;">商　品　名</td>
                  <td style="width: 5%;">数量</td>
                  <td style="width: 5%;">単位</td>
                  <td style="width: 10%;">単価</td>
                  <td style="width: 10%;">金額</td>
                </tr>
              </thead>
              <tbody>
                {{-- <tr>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 10%;vertical-align: middle;text-align: center;">売上日</td>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 10%;vertical-align: middle;text-align: center;">伝票番号</td>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 5%;vertical-align: middle;text-align: center;">区分</td>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 35%;vertical-align: middle;text-align: center;">商　品　名</td>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 5%;vertical-align: middle;text-align:center;">数量</td>
                  <td style="border-right: 1px solid #000;border-top:1px solid #000;padding: 0;width: 5%;vertical-align: middle;text-align: center;">単位</td>
                  <td style="border-top:1px solid #000;border-right: 1px solid #000; padding: 0;width: 10%;vertical-align: middle;text-align: center;">単価</td>
                  <td style="border-top:1px solid #000;border-right: 1px solid #000; padding: 0;width: 10%;vertical-align: middle;text-align: center;">金額</td>
                </tr> --}}
                @php
                $last_key = array_key_last($data->toArray());
                $lastFrom = null;
                $lastIntorder03 = null;
                $count = 1;
                $countLineNumber = 0;
                $page = 1;
                $des_status = 'no';
                $percentage_10 = 0;
                $percentage_10_sub = 0;
                $percentage_8 = 0;
                $percentage_8_sub = 0;
                @endphp
                @foreach($data as $key=>$val)
                    @php
                    //compare with previous data
                    if ($data[$key]->datachar10 !== $lastFrom) {
                        //$intorder03 = $data[$key]->modified_intorder03;
                        $datachar10 = $data[$key]->datachar10;
                        $text1_detail = $data[$key]->text1_detail;
                        
                        //calculate percentage(start)
                        if(substr($data[0]->other1,0,1) == 1){
                            $status = $data[0]->datatxt0051;
                        }else{
                            $status = $data[0]->other17;
                        }
                        if($data[$key]->percentage == '10'){
                          //$percentage_10 = $data[0]->sum_of_numeric3;
                          $percentage_10 = $percentage_10 + $data[$key]->numeric3;
                          if($status != '3 請求時一括'){
                              $percentage_10_sub = $percentage_10_sub + $data[$key]->numeric4;
                          }else{
                              if($data[0]->other18 == 'B21'){
                                  $percentage_10_sub = $percentage_10_sub + round($percentage_10*0.08);
                              }else if($data[0]->other18 == 'B22'){
                                  $percentage_10_sub = $percentage_10_sub + floor($percentage_10*0.08);
                              }else{
                                  $percentage_10_sub = $percentage_10_sub + ceil($percentage_10*0.08);
                              }
                          }
                        }
                        if($data[$key]->percentage == '08'){
                          //$percentage_8 = $data[0]->sum_of_numeric3;
                          $percentage_8 = $percentage_8 + $data[$key]->numeric3;
                          if($status != '3 請求時一括'){
                              $percentage_8_sub = $percentage_8_sub + $data[$key]->numeric4;
                          }else{
                              if($data[0]->other18 == 'B21'){
                                  $percentage_8_sub = $percentage_8_sub + round($percentage_8*0.08);
                              }else if($data[0]->other18 == 'B22'){
                                  $percentage_8_sub = $percentage_8_sub + floor($percentage_8*0.08);
                              }else{
                                  $percentage_8_sub = $percentage_8_sub + ceil($percentage_8*0.08);
                              }
                          }
                        }
                        //calculate percentage(end)
                        
                    }else{
                        //$intorder03 = "";
                        $datachar10 = "";
                        $text1_detail = "";
                    }
                    $lastFrom = $data[$key]->datachar10;
                    
                    if ($data[$key]->modified_intorder03 !== $lastIntorder03) {
                        $intorder03 = $data[$key]->modified_intorder03;
                    }else{
                        $intorder03 = "";
                    }
                    $lastIntorder03 = $data[$key]->modified_intorder03;

                    //check sub line
                    if($data[$key]->count_datachar10 == $count){
                        $sub_part = 1;
                        $count = 0;
                    }else{
                        $sub_part = "";
                    }
                    $count++;

                    //check sub_status
                    if(substr($data[$key]->other1,0,1) == 1){
                        $sub_status = $data[$key]->datatxt0051;
                    }else{
                        $sub_status = $data[$key]->other17;
                    }
                    
                    //if($data[$key]->patternsub2 == '081'){
                    //    $des_status = 'yes';
                    //}
            
                    if($data[$key]->otodoketime == 'B140'){
                        $des_status = 'yes';
                    }
                    
                    $countLineNumber++;
                    
                    @endphp
                    <tr>
                      <td style="padding:0 1px;word-wrap: break-word;">{{$intorder03}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;">{{$datachar10}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: center;">{{$text1_detail}}</td>
                      <td  style="padding:0 2px;white-space:nowrap;overflow: hidden;">{{mb_convert_kana($data[$key]->syouhinname,"rnask")}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;">{{number_format($data[$key]->syukkasu)}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: center;">{{$data[$key]->codename}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;">@if($data[$key]->otodoketime == 'B140')※@endif {{number_format($data[$key]->dataint04)}}</td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;">{{number_format($data[$key]->syukkasu * $data[$key]->dataint04)}}</td>
                    </tr>
                  
                <!-- page break starts here -->
                @if($countLineNumber % 29 == 0)
                    @include('sales.invoiceDeadline.voucherCreation.commonHeader')
                    @php
                        $page++;
                        $countLineNumber = 0;
                    @endphp
                @endif
                <!-- page break ends here -->
                
                    <!-- 713 starts -->
                    @if($data[$key]->datachar08 != null)
                    <tr>
                      <td style="padding:0 1px;word-wrap: break-word;"></td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                      <td colspan="5" style="padding:0 2px;white-space:nowrap;overflow: hidden;">{{mb_convert_kana($data[$key]->datachar08,"rnask")}}</td>
                      <!--<td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                      <td style="padding:0 1px;word-wrap: break-word;"></td>
                      <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                      <td style="adding:0 1px;word-wrap: break-word;text-align: right;"></td>-->
                    </tr>
                        @php
                        $countLineNumber++;
                        @endphp
                        
                        <!-- page break starts here -->
                        @if($countLineNumber % 29 == 0)
                            @include('sales.invoiceDeadline.voucherCreation.commonHeader')
                            @php
                                $page++;
                                $countLineNumber = 0;
                            @endphp
                        @endif
                        <!-- page break ends here -->
                        
                    @endif
                    <!-- 713 ends -->
                    
                    <!-- sub_part starts -->
                    @if($sub_part == 1)
                      <!-- 710 starts -->
                      @if($data[$key]->information8 != null)
                      <tr>
                        <td style="padding:0 1px;word-wrap: break-word;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                        <td colspan="5" style="padding:0 2px;white-space:nowrap;overflow: hidden;">{{mb_convert_kana($data[$key]->information8,"rnask")}}</td>
                        <!--<td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>-->
                      </tr>
                          @php
                          $countLineNumber++;
                          @endphp
                          
                          <!-- page break starts here -->
                            @if($countLineNumber % 29 == 0)
                                @include('sales.invoiceDeadline.voucherCreation.commonHeader')
                                @php
                                    $page++;
                                    $countLineNumber = 0;
                                @endphp
                            @endif
                            <!-- page break ends here -->
                          
                      @endif
                      <!-- 710 ends -->
                      
                      <!-- 714 starts -->
                      @if($data[$key]->kokyaku1_name != null)
                      <tr>
                        <td style="padding:0 1px;word-wrap: break-word;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                        <td colspan="5" style="padding:0 2px;white-space:nowrap;overflow: hidden;">{{mb_convert_kana($data[$key]->kokyaku1_name,"rnask")." 様分"}}</td>
                        <!--<td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>-->
                      </tr>
                          @php
                          $countLineNumber++;
                          @endphp
                          
                           <!-- page break starts here -->
                            @if($countLineNumber % 29 == 0)
                                @include('sales.invoiceDeadline.voucherCreation.commonHeader')
                                @php
                                    $page++;
                                    $countLineNumber = 0;
                                @endphp
                            @endif
                            <!-- page break ends here -->
                          
                      @endif
                      <!-- 714 ends -->

                      <!-- 712 starts -->
                      @if($sub_status != '3 請求時一括')
                      <tr>
                        <td style="padding:0 1px;word-wrap: break-word;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                        <td style="padding:0 2px;white-space:nowrap;overflow: hidden;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;">消費税額</td>
                        <td style="padding:0 1px;word-wrap: break-word;text-align: right;">{{number_format($data[$key]->numeric4)}}</td>
                      </tr>
                          @php
                          $countLineNumber++;
                          @endphp
                          
                           <!-- page break starts here -->
                            @if($countLineNumber % 29 == 0 && $last_key != $key)
                                @include('sales.invoiceDeadline.voucherCreation.commonHeader')
                                @php
                                    $page++;
                                    $countLineNumber = 0;
                                @endphp
                            @endif
                            <!-- page break ends here -->
                          
                      @endif
                      <!-- 712 ends -->
                      
                    @endif
                    <!-- sub_part ends -->
                    
                  
                @endforeach

              @php
              //$total = $percentage_10 + $percentage_8;
              //$sub_total = $percentage_10_sub + $percentage_8_sub;
              //$grand_total = $total + $sub_total;
              @endphp

              <!-- blank row display starts here -->
              @for($k=1;$k<=(29-$countLineNumber);$k++)
                <tr>
                  <td style="padding:0 1px;word-wrap: break-word;">&nbsp;</td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                  <td style="padding:0 2px;white-space:nowrap;overflow: hidden;"></td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: center;"></td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                  <td style="padding:0 1px;word-wrap: break-word;text-align: right;"></td>
                </tr>
              @endfor
              <!-- blank row display ends here -->
              
                </tbody>
            </table>
                
            <div style="margin-top:-1px;">
             <!-- <div style="display: block; page-break-before: always;"> --> 
              <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;border-top: none;">
                <tbody>
                  <tr>
                    <td rowspan="3" style="width: 79%;position: relative;vertical-align: top;padding: 0 3px;line-height:20px;">
                      <div class="" style="position: absolute;top: 1px;font-size:10px;width: 100%;">
                        <div style="float: right;">
                          <span style="margin-right: 0px;">@if($data[0]->information2 != $data[0]->information6)□@endif</span>
                          <!--<span>◎</span>-->
                        </div>
                      </div>

                      <div class="" style="padding-right: 10px;margin-top: 1px;width: 100%;">
                        <span style="font-size: 11px;">摘要 <br/>
                        <span style="font-size: 12px;margin-right:5px;">ページ：</span> <span style="font-size: 11px;">（{{$page}}／<span class="total-page"></span>）</span><br/> <br/>
                        <span style="font-size: 12px;">@if($des_status == 'yes')（※ は軽減税率である事を示します）@endif</span><br/>
                        <span style="font-size: 12px;">上記の通り御請求申し上げます。</span> <br/>
                        <span style="font-size: 11px;">なお御不審の点がございましたら早速御連絡頂きたく存じます。</span> <br/>
                        <span style="font-size: 11px;">当請求書と行き違いにお支払いを頂きました際は悪しからずご了承下さい。</span>
                      </div>
                    </td>  
                    <td colspan="2" style="background: #D9E1F1;padding:3px 0 3px 3px;line-height:1.1; height:45px;border-left:1px solid transparent;"></td>              
                    {{-- <td style="background: #D9E1F1;border-right: none;width: 10%;text-align: center;padding:3px 0 3px 3px;line-height:1.1; height:45px;"><div style="vertical-align:middle;height:43px;line-height:25px; padding-top:20px; padding-bottom:0px;"></td>
                      <td style="background: #D9E1F1;border-right: none;width: 10%;text-align: right;padding:3px 3px 3px 0px;;line-height:1.1;height:45px;"><div style="vertical-align:middle;height:43px;line-height:25px; padding-top:20px; padding-bottom:0px;padding-right:2px;"></td> --}}
                  </tr>
                  <tr>
                    <td style="background: #D9E1F1;width: 10%;padding: 0;line-height:1.1;height:46px;">1 0 % 対 象<br/>消 費 税</td>
                    <td style="background: #D9E1F1;width: 10%;text-align: right;padding: 0 2px;line-height:1.1;">{{$percentage_10 == 0 ?"":number_format($percentage_10)}}<br/>{{$percentage_10_sub == 0 ?"":number_format($percentage_10_sub)}}</td>
                  </tr>
                  <tr>
                    <td style="background: #D9E1F1;padding: 0 2px;line-height:1.1;">8 % 対 象<br/>消 費 税</td>
                    <td style="background: #D9E1F1;text-align: right;padding: 0 2px;line-height:1.1;">{{$percentage_8 == 0 ? "":number_format($percentage_8)}}<br/>{{$percentage_8_sub == 0 ? "":number_format($percentage_8_sub)}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
                
        <!-- display total page number -->
        <style>
        .total-page:after {
            content: "{{ $page }}";
        }
        </style>
            
      </div>
    </main>
  </body>
</html>
