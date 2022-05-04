<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <style type="text/css">
      @font-face {
        font-family: msgothic;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path ('fonts/msgothic.ttf') }}") format('truetype');
      }
      body {
        font-family: msgothic;
        /*font-size: 12px;*/
        margin: 0px !important;
        padding: 0px !important;
        background: #fff;
      }
      .wrapper-content {
          margin: 0 auto;
          background: white;
          font-size: 10px;
          position: relative;
      }

      .pdf-logo{
        position: relative;
        height: 65px;
      }

      .pdf-img-stamp{
        position: absolute;
        left: 233px;
        top: -1px;
      }

      .clearfix{
        display: block;
        content: "";
        clear: both;
      }

      table thead tr td{
        text-align: center;
      }

      .table-first-pdf{
        border-bottom: 1px solid #000;
      }

      .table-second-pdf{
        border-bottom: 1px solid #000;
      }

      .pdf-data-table-one tbody tr td {
        padding: 0;
        vertical-align: middle;
      }

      .pdf-data-table-one > tbody > tr:nth-child(even) td {
        background-color: #D9E1F1;
        border-right: 1px solid #000;
      }

      .pdf-data-table-one > tbody > tr:nth-child(odd) td {
        border-right: 1px solid #000;
      }

      .pdf-data-table-one > tbody > tr:nth-child(even) td:first-child {
        border-left: 1px solid #000;
      }

      .pdf-data-table-one > tbody > tr:nth-child(odd) td:first-child {
        border-left: 1px solid #000;
      }

      .pdf-data-table{
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
      }

      .pdf-data-table tbody tr td{
        border-right: 1px solid #000;
      }

      .pdf-data-table tbody tr td:first-child{
        border-left: none;
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
      <div class="">
        <div class="wrapper-content">
          <div style="width: 100%;margin-top:1mm;margin-bottom:5px;">
            <div style="width: 47%;margin-left:11.3mm;float: left;margin-right: 50px;font-size: 13px;word-wrap: break-word;line-height: 1.1;">
              <div>〒{{substr($data[0]->office_yubinbango, 0, 3).'-'.substr($data[0]->office_yubinbango, 3)}}</div>
              @php
              $str = $data[0]->office_address;
              $part1_1 = "";
              $part1_2 = "";
              $part2 = "";
              if(strpos($str," ")!==false){
                $str = str_replace(" ","　",$str);
              }
              $res = explode('　',$str);
              for($i=0;$i<count($res);$i++){
                    if($i<2){
                        $part1_1 = $part1_1.$res[$i]."　";
                    }
                    if($i==2){
                        $part1_2 = $part1_2.$res[$i]."　";
                    }
                    if($i>=3){
                        $part2 = $part2.$res[$i]."　";
                    }
              }
              $part1_1 = str_replace("－","‑",$part1_1);
              $part1_2 = str_replace("－","‑",$part1_2);
              $part2 = str_replace("－","‑",$part2);
              @endphp

              <div>{{mb_convert_kana(str_replace("　","",$part1_1),"rnask").mb_convert_kana(str_replace("　","",$part1_2),"rnask")}}</div>
              <div>{{mb_convert_kana(str_replace("　","",$part2),"rnask")}}</div>
              <div>{{$data[0]->company_name}}</div>
              <div style="margin-left: 20px;">{{$data[0]->office_name}}</div>
              <div style="margin-left: 20px;">{{mb_convert_kana($data[0]->information2_mail2,"rnask")}}</div>
              <div style="margin-left: 20px;">{{mb_convert_kana($data[0]->etsransainfo2_tantousya,"rnask")}}　様</div>
              <div style="font-size: 10px;">お客様コード {{$data[0]->information2}}</div>
            </div>
            <div style="float: left;width: 40%;">
              
                @if($data[0]->housoukubun == 1)
                  <div style="width: 180px;margin-top: 6px;margin-bottom:10px;font-size: 18px;border-bottom: 2pt double black;">
                    {{'売上伝票　兼　請求書'}}
                  </div>
                @else
                  <div style="width: 80px;margin-top: 6px;margin-bottom:10px;font-size: 18px;border-bottom: 2pt double black;">
                    {{'売上伝票'}}
                  </div>
                @endif

              <div>
                <div class="pdf-logo">
                  <!-- <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/logo.jpg'}}" height="42px"> -->
                  <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/usaclogo.png'}}" height="48px">
                  @if($data[0]->housoukubun == 1)
                  <img class="pdf-img-stamp" src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/stamp.png'}}" width="47px">
                  @endif
                </div>
              </div>
              <div style="margin-top:-10px;">
                <div style="font-size: 10px;margin-left: 45px;">
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
            <div style="width: 52%;float: left; margin-right: 7%;font-size: 11px;">
              <table style="width: 200px;border-collapse: collapse;">
                <tbody>
                  <tr>
                    <td style="border-bottom: 1px solid #000;width: 70px;">伝票番号</td>
                    <td style="border-bottom: 1px solid #000;">{{$data[0]->juchukubun2}}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;">売上年月日</td>
                    <td style="border-bottom: 1px solid #000;">{{$data[0]->intorder03}}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;">請求書番号</td>
                    <td style="border-bottom: 1px solid #000;">@if($data[0]->housoukubun == 1){{$data[0]->text3}}@endif</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;">弊社管理番号</td>
                    <td style="border-bottom: 1px solid #000;">{{$data[0]->kokyakuorderbango}}</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #000;padding-right: 5px;">貴社発注番号</td>
                    <td style="border-bottom: 1px solid #000;">{{mb_convert_kana($data[0]->datachar04,"rnask")}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="clearfix"></div>
            </div>

              @if($data[0]->housoukubun == 1)
              <div style="width: 38%;float: left;font-size: 11px;">
                <div>
                  <table>
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
                        <td>船場支店</td>
                        <td>当座0035398</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="clearfix"></div>
              </div>
              @endif
            <div class="clearfix"></div>
          </div>

          <!-- content 1 -->
          <div style="width: 100%;margin-top:5px;">
            <table class="pdf-data-table-one table-first-pdf" style="border-spacing: 0px;width: 100%;table-layout:fixed;border-collapse:seperate;">
              <tbody>
                <tr style="width: 100%;text-align: center;">
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                  <td style="border-bottom: 1pt solid #000;"></td>
                </tr>
                <tr>
                  <td style="background-color: #D9E1F1;padding: 0;width: 3%;vertical-align: top;text-align: center;font-size: 12px;">行</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 4%;vertical-align: top;text-align: center;font-size: 12px;">区分</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 46%;vertical-align: top;text-align: center;font-size: 12px;">商品コード・商 品 名</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 5%;vertical-align: top;text-align: center;font-size: 11.3px;">数 量<br/>単 位</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 10%;vertical-align: top;text-align: center;font-size: 12px;">単 価</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 10%;vertical-align: top;text-align: center;font-size: 12px;">金 額</td>
                  <td style="background-color: #D9E1F1;padding: 0;width: 17%;vertical-align: top;text-align: center;font-size: 12px;">明細備考</td>
                </tr>
                  @php
                  $percn_10 = 0;
                  $percn_consumption_10 = 0;
                  $percn_8 = 0;
                  $percn_consumption_8 = 0;
                  $grand_total = 0;
                  $temp_cn = count($data);
                  $countLineNumber = 1;
                  $is_equal = 0;

                  /*  blank row cal starts here */
                  $tmp_blank_row_page_no = 1;
                  $blank_row_page_no = 0;
                  $no_of_blank_row = 0;
                  if($temp_cn<=17){
                    $no_of_blank_row = 17-$temp_cn;
                    $blank_row_page_no = 1;
                  }else if($temp_cn>17){
                    $tmp_res = $temp_cn/17;
                    $blank_row_page_no =  ceil($tmp_res);
                    $fillable_row = $temp_cn%17;
                    if($fillable_row != 0){
                        $no_of_blank_row = 17-$fillable_row;
                    }else{
                        $no_of_blank_row = 0;
                    }
                  }
                  /* blank row cal starts here */

                  @endphp

                @foreach($data as $key=>$val)
                    @php
                    //if($data[$key]->otodoketime == "B120"){
                    //    $percn_10 = $percn_10 + ($data[$key]->syukkasu*$data[$key]->dataint04);
                    //    $percn_consumption_10 = $percn_consumption_10 + $data[$key]->datachar20;
                    //}

                    //if($data[$key]->otodoketime == "B140"){
                    //    $percn_8 = $percn_8 + ($data[$key]->syukkasu*$data[$key]->dataint04);
                    //    $percn_consumption_8 = $percn_consumption_8 + $data[$key]->datachar20;
                    //}
                    
                    if($data[$key]->otodoketime == "B110"){
                        $grand_total = $grand_total + ($data[$key]->syukkasu*$data[$key]->dataint04);
                    }
                    $is_equal++;
                    @endphp
                    <tr>
                      <td style="padding: 0 3px;word-wrap: break-word;text-align: center;">{{$countLineNumber}} @if($data[$key]->otodoketime == "B140")</br>{{"※"}}@endif</td>
                      <td style="padding: 0 3px;word-wrap: break-word;text-align: center;">{{$data[$key]->text1_detail}}</td>
                      <td style="padding: 0 3px;white-space: nowrap;overflow: hidden;">{{$data[$key]->kawasename}} <span style="font-size: 11px;">@if($data[$key]->barcode != null){{"(".substr(mb_convert_kana($data[$key]->barcode,"rnask"),11).")"}}</span>@endif <br><span style="font-size: 12px;">{{mb_convert_kana($data[$key]->syouhinname,"rnask")}}</span></td>
                      <td style="padding: 0 3px;word-wrap: break-word;"><div style="text-align: right;">{{number_format($data[$key]->syukkasu)}}</div><div style="text-align: center;">{{mb_convert_kana($data[$key]->codename,"rnask")}}</div></td>
                      <td style="padding: 0 3px;word-wrap: break-word;text-align: right;font-size: 11px;">{{number_format($data[$key]->dataint04)}}</td>
                      <td style="padding: 0 3px;word-wrap: break-word;text-align: right;font-size: 11px;">{{number_format($data[$key]->syukkasu*$data[$key]->dataint04)}}</td>
                      <td style="padding: 0 3px;word-wrap: break-word;">
                          @if(\App\Helpers\Helper::validateKanji($data[$key]->datachar08))
                            {{mb_substr(mb_convert_kana($data[$key]->datachar08,"rnask"),0,10)}}</br>
                            {{mb_substr(mb_convert_kana($data[$key]->datachar08,"rnask"),10,10)}}
                          @else
                            @if(\App\Helpers\Helper::isExistKanji($data[$key]->datachar08))
                                @php
                                 $res = \App\Helpers\Helper::byteWiseSubStr($data[$key]->datachar08);
                                @endphp
                                {{$res['part1']}}</br>
                                {{$res['part2']}}
                            @else
                            {{mb_substr(mb_convert_kana($data[$key]->datachar08,"rnask"),0,20)}}</br>
                            {{mb_substr(mb_convert_kana($data[$key]->datachar08,"rnask"),20,20)}}
                            @endif
                          @endif
                      </td>
                    </tr>
                    @if ( $countLineNumber % 17 == 0 && $temp_cn != $is_equal)
                        @php
                        $tmp_blank_row_page_no++;
                        @endphp
                  </tbody>
                </table>


                @if($temp_cn > 17)
                <div style="page-break-before: always;"></div>
                @endif

                <!-- every page top header starts here -->
                <div style="width: 100%;margin-top:1mm;">
                  <div style="width: 47%;margin-left:11.3mm;float: left;margin-right: 50px;font-size: 13px;word-wrap: break-word;line-height: 1.1;">
                    <div>〒{{substr($data[0]->office_yubinbango, 0, 3).'-'.substr($data[0]->office_yubinbango, 3)}}</div>
                    @php
                    $str = $data[0]->office_address;
                    $part1_1 = "";
                    $part1_2 = "";
                    $part2 = "";
                    if(strpos($str," ")!==false){
                      $str = str_replace(" ","　",$str);
                    }
                    $res = explode('　',$str);
                    for($i=0;$i<count($res);$i++){
                          if($i<2){
                              $part1_1 = $part1_1.$res[$i]."　";
                          }
                          if($i==2){
                              $part1_2 = $part1_2.$res[$i]."　";
                          }
                          if($i>=3){
                              $part2 = $part2.$res[$i]."　";
                          }
                    }
                    $part1_1 = str_replace("－","‑",$part1_1);
                    $part1_2 = str_replace("－","‑",$part1_2);
                    $part2 = str_replace("－","‑",$part2);
                    @endphp

                    <div>{{mb_convert_kana(str_replace("　","",$part1_1),"rnask").mb_convert_kana(str_replace("　","",$part1_2),"rnask")}}</div>
                    <div>{{mb_convert_kana(str_replace("　","",$part2),"rnask")}}</div>
                    <div>{{$data[0]->company_name}}</div>
                    <div style="margin-left: 20px;">{{$data[0]->office_name}}</div>
                    <div style="margin-left: 20px;">{{mb_convert_kana($data[0]->information2_mail2,"rnask")}}</div>
                    <div style="margin-left: 20px;">{{mb_convert_kana($data[0]->etsransainfo2_tantousya,"rnask")}}　様</div>
                    <div style="font-size: 10px;">お客様コード {{$data[0]->information2}}</div>
                  </div>
                  <div style="float: left;width: 40%;">
                    @if($data[0]->housoukubun == 1)
                      <div style="width: 180px;margin-top: 6px;margin-bottom:10px;font-size: 18px;border-bottom: 2pt double black;">
                        {{'売上伝票　兼　請求書'}}
                      </div>
                    @else
                      <div style="width: 80px;margin-top: 6px;margin-bottom:10px;font-size: 18px;border-bottom: 2pt double black;">
                        {{'売上伝票'}}
                      </div>
                    @endif

                    <div>
                      <div class="pdf-logo">
                        <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/usaclogo.png'}}" height="48px">
                        @if($data[0]->housoukubun == 1)
                        <img class="pdf-img-stamp" src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/stamp.png'}}" width="47px">
                        @endif
                      </div>
                    </div>
                    <div style="margin-top:-10px;">
                      <div style="font-size: 10px;margin-left: 45px;">
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

                <div style="width: 100%;margin-top: 5px;">
                  <div style="width: 52%;float: left; margin-right: 7%;font-size: 11px;">
                    <table style="width: 200px;border-collapse: collapse;">
                      <tbody>
                        <tr>
                          <td style="border-bottom: 1px solid #000;width: 70px;">伝票番号</td>
                          <td style="border-bottom: 1px solid #000;">{{$data[0]->juchukubun2}}</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #000;">売上年月日</td>
                          <td style="border-bottom: 1px solid #000;">{{$data[0]->intorder03}}</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #000;">請求書番号</td>
                          <td style="border-bottom: 1px solid #000;">@if($data[0]->housoukubun == 1){{$data[0]->text3}}@endif</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #000;">弊社管理番号</td>
                          <td style="border-bottom: 1px solid #000;">{{$data[0]->kokyakuorderbango}}</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #000;padding-right: 5px;">貴社発注番号</td>
                          <td style="border-bottom: 1px solid #000;">{{mb_convert_kana($data[0]->datachar04,"rnask")}}</td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="clearfix"></div>
                  </div>

                  @if($data[0]->housoukubun == 1)
                  <div style="width: 38%;float: left;font-size: 11px;">
                    <div>
                      <table>
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
                            <td>船場支店</td>
                            <td>当座0035398</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  @endif
                  <div class="clearfix"></div>
                </div>
                <!-- every page top header starts here -->
                
                <table class="pdf-data-table-one table-second-pdf" style="border-spacing: 0px;width: 100%;table-layout:fixed;border-collapse:seperate;margin-top:5px;">
                  <tbody>
                      @if($temp_cn>$countLineNumber)
                      <tr style="width: 100%;text-align: center;">
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                        <td style="border-bottom: 1pt solid #000;"></td>
                      </tr>
                      <tr>
                          <td style="background-color: #D9E1F1;padding: 0;width: 3%;vertical-align: top;text-align: center;font-size: 12px;">行</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 4%;vertical-align:top;text-align: center;font-size: 12px;">区分</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 46%;vertical-align:top;text-align: center;font-size: 12px;">商品コード・商 品 名</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 5%;vertical-align:top;text-align: center;font-size: 11.3px;">数 量<br/>単 位</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 10%;vertical-align:top;text-align: center;font-size: 12px;">単 価</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 10%;vertical-align:top;text-align: center;font-size: 12px;">金 額</td>
                          <td style="background-color: #D9E1F1;padding: 0;width: 17%;vertical-align:top;text-align: center;font-size: 12px;">明細備考</td>
                      </tr> 
                      
                      @endif
                    @endif
                    @php
                    $countLineNumber++;
                    @endphp

                @endforeach

                {{-- blank row display starts here --}}
                @if($tmp_blank_row_page_no == $blank_row_page_no)
                    @for($k=1;$k<=$no_of_blank_row;$k++)
                    <tr>
                        <td style="padding: 3px 3px;word-wrap: break-word;height: 6mm;text-align: center;">{{$countLineNumber}}</td>
                        <td style="padding: 0 3px;word-wrap: break-word;height: 6mm;"></td>
                        <td style="padding: 0 3px;white-space: nowrap;overflow: hidden;height: 6mm;"></td>
                        <td style="padding: 0 3px;word-wrap: break-word;height: 6mm;"></td>
                        <td style="padding: 0 3px;word-wrap: break-word;height: 6mm;text-align: right;font-size: 11px;"></td>
                        <td style="padding: 0 3px;word-wrap: break-word;height: 6mm;text-align: right;font-size: 11px;"></td>
                        <td style="padding: 0 3px;word-wrap: break-word;height: 6mm;"></td>
                    </tr>
                    @php
                    $countLineNumber++;
                    @endphp
                    @endfor
                @endif
                {{-- blank row display ends here --}}

              </tbody>
            </table>

            <div style="margin-top: -1px;">
              <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;">
                <tbody>
                    @php
                    //$total = $percn_10 + $percn_8;
                    //$total_consumption = $percn_consumption_10 + $percn_consumption_8;
                    //$grand_total = $total + $total_consumption;
                    @endphp
                  <tr>
                    <td rowspan="3" style="border-left: 1px solid #000;width: 77.5%;padding: 0 2px;position: relative;vertical-align: top;">
                      <div class="" style="position: absolute;top: 1px;font-size: 10px;width: 100%;">
                        <div style="float: right;">
                          <span style="margin-right: 0px;">@if($data[0]->information2 != $data[0]->information6){{"□"}}@endif</span>
                          <span>@if($data[0]->text1 == "U560"){{"◎"}}@endif</span>
                        </div>
                      </div>

                      <div class="" style="margin-right: 9px; margin-top: 1px; width: 100%;">
                        <span style="font-size: 11px;">摘要</span><br/>
                        <span style="font-size: 12px;">{{mb_convert_kana($data[0]->end_customer,"rnask")}} &nbsp;</span><br/>
                        <span style="font-size: 11px;">{{$data[0]->information8}}</span><br/>
                        <div style="position: absolute; top: 87px;">
                          <span style="font-size: 11px;">@if($data[0]->otodoketime == "B140"){{"(※は軽減税率である事を示します)"}}@endif &nbsp;</span><br />
                          @if($data[0]->housoukubun == 1)
                            <span style="font-size: 11px;">{{"上記の通りご請求申し上げます。"}}</span> <br />
                            <span style="font-size: 11px;">{{"なお御不審の点がございましたら早速ご連絡頂きたく存じます。"}}</span> <br />
                            <span style="font-size: 11px;">{{"当請求書と行き違いにお支払いを頂きました際は悪しからずご了承下さい。"}}</span>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td style="background: #D9E1F1;width: 10%;text-align: center;padding:3px 0 3px 3px;line-height:1.1; height:45px;">
                      <div style="vertical-align:middle;border-left:1px solid black;border-top:1px solid black;border-bottom:1px solid black;height:44px;line-height:16px; padding-top:7px; padding-bottom:0px;">合計 <br/>（税込）</div>
                    </td>
                    <td style="background: #D9E1F1;width: 11.5%;text-align: right;padding:3px 3px 3px 0px;line-height:1.1;height:45px;">
                      <div style="vertical-align:middle;border-right:1px solid black;border-top:1px solid black;border-bottom:1px solid black;height:43px;line-height:29px; padding-top:8px; padding-bottom:0px;padding-right:2px;">
                        <div style="margin-top: -4px;">@if($data[0]->otodoketime == "B110"){{number_format($grand_total)}}@else{{number_format($data[0]->numeric3+$data[0]->numeric4)}}@endif</div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="background: #D9E1F1;text-align: center;padding: 0;line-height:1.1;height:46px;border-top: 1px solid #000">
                        1 0 % 対 象<br/>消 費 税
                    </td>
                    <td style="background: #D9E1F1;text-align: right;padding: 0; padding-right: 3px; line-height:1.1;height:46px;border-top: 1px solid #000;">
                        @if($data[0]->otodoketime == "B120"){{number_format($data[0]->numeric3)}}@endif<br/>@if($data[0]->otodoketime == "B120"){{number_format($data[0]->numeric4)}}@endif
                    </td>
                  </tr>
                  <tr>
                    <td style="background: #D9E1F1;text-align: center;padding: 0 2px;line-height:1.1;height:44px;border-top: 1px solid #000;">8 % 対 象<br/>消 費 税</td>
                    <td style="background: #D9E1F1;text-align: right;padding: 0 2px;line-height:1.1;border-top: 1px solid #000;">@if($data[0]->otodoketime == "B130" || $data[0]->otodoketime == "B140"){{number_format($data[0]->numeric3)}}@endif<br/>@if($data[0]->otodoketime == "B130" || $data[0]->otodoketime == "B140"){{number_format($data[0]->numeric4)}}@endif</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
