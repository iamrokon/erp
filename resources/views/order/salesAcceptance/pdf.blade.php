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
      font-size: 13px;
      margin: 0px !important;
      padding: 0px !important;
      background: #fff;
      line-height: normal !important;
    }

    .wrapper-content {
      /*width: 670px;*/
      margin: 0 auto;
      background: white;
      /*padding: 20px 50px;*/
    }

    .clearfix {
      display: block;
      content: "";
      clear: both;
    }

    table tbody tr td {
      padding: 0;
    }


    .pdf-data-table-one {
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
    }



    .pdf-data-table-one tbody tr td {
      /* border-right: 1px solid #000; */
      padding: 0;
      vertical-align: middle;
    }

    .pdf-data-table tbody tr td {
      border-top: 1px solid #000;
    }

    .pdf-data-table-one > tbody > tr:nth-child(even) td{
      background-color: #D9E1F1;
      border-right: 1px solid #000;
    }

    .pdf-data-table-one tbody tr>td {
      border-right: 1px solid #000;
    }

    /* .pdf-data-table-one thead > tr > td:first-child {
      border-left: 1px solid #000;
    }
    .pdf-data-table-one thead > tr > td:last-child {
      border-right: 1px solid #000;
    } */

    .pdf-data-table-one tbody tr>td:first-child {
      border-left: 1px solid #000;
    }

    .pdf-data-table-one tbody tr>td:last-child {
      border-right: 1px solid #000;
    }

    /* .pdf-data-table-one tbody tr > td:last-child {
      border-right: 1px solid transparent;
    } */

    /* .pdf-data-table-one tbody tr:first-child > td {
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
    } */


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
  </style>
</head>

<body>
  <div class="wrapper-contetn-area">
    <div class="wrapper-content">
      <div class="body-contetn">
        <div class="text-list">
          {{$kokyaku->name}}&nbsp;&nbsp;　御中 <span
            style="text-align: right;float: right;">{{ \Carbon\Carbon::today()->setTimezone('Asia/Tokyo')->format('Y/m/d')}}</span><br>
          <br>
          拝啓&nbsp;&nbsp; 貴社ますますご清栄のこととお慶び申し上げます。
        </div>
        <div class="text-list" style="word-wrap: break-word;">
          <div>平素は格別のご高配に預かりありがたく御礼申し上げます。</div>
          <div style="margin-left: 13px;">さて、弊社は下記物件の物品または成果物の納入並びに弊社担当業務を全て完了しました事をご報告します。</div>
          <div>つきましては受入検査の実施をお願い致します。</div>
          <div style="margin-left: 13px;">検収の承認を頂ける場合には、承認の証として、必要事項をご記入いただき、ご捺印の上、弊社宛にご返信願います。</div>
          <div>なお、ご承認が難しい場合は、担当までご一報くださると幸いです。 <span style=" float:right;">敬具</span></div>
        </div>

        <div style="text-align: right;padding-top: 7px;">ユーザックシステム株式会社</div>
        <div style="height: 1px; width: 100%;background: #000;margin: 9mm 0;"></div>
        <div style="text-align: center;text-decoration: underline;font-size: 18px;">検収確認書</div>

        <div style="padding-top: 5px;">宛先 &nbsp; ユーザックシステム株式会社</div>
        <div style="padding-left: 45px;">
          @if(isset($tantousya->syozoku) && $tantousya->syozoku == '1 大阪')
          〒541-0048　&nbsp; 大阪府大阪市中央区瓦町１－６－１０　ＪＰビル３階
          @elseif(isset($tantousya->syozoku) && $tantousya->syozoku == '2 東京')
          〒103-0015　東京都中央区日本橋箱崎町４－３　国際箱崎ビル４階
          @else
          @endif
        </div>
        <div style="padding-left: 46px;margin-bottom: 5px;">{{$categorikanriname}} <br>&nbsp;&nbsp;
          {{$tantousya->name??null}} &nbsp; {{$tantousya->mail??null}}</div>
        {{-- <div style="padding-left: 30px;margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categorikanriname}}
        {{$tantousya->name??null}} &nbsp; {{$tantousya->mail??null}}
      </div> --}}


      <div style="width: 100%;margin-left: 23px;">
        <table class="table-head" style="border-spacing: 0px;">
          <tbody>
            <tr>
              <td style="border-bottom: 1px solid #000;width: 70px;">弊社注番</td>
              <td style="border-bottom: 1px solid #000;width: 80px;">{{$orderhenkan->kokyakuorderbango}}</td>
              <td style="width: 10px;">&nbsp;</td>
              <td style="border-bottom: 1px solid #000;width: 90px;">貴社発注番号</td>
              <td style="border-bottom: 1px solid #000;width: 430px;">
                {{mb_convert_kana($orderhenkan->datachar04,"rnaskc")}}</td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #000; width: 70px;">受注日</td>
              <td style="border-bottom: 1px solid #000;">{{$orderhenkan->intorder01}}</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #000;width: 70px;">ご利用企業</td>
              <td colspan="4" style="border-bottom: 1px solid #000;width: 470px;">
                {{isset($information3->name)?mb_convert_kana($information3->name,"rnaskc"):null}} 様分</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="width: 100%;margin-top: 10px;">
        <table class="pdf-data-table-one"
          style="border-spacing: 0px;width: 100%;overflow:hidden;border-collapse:seperate;">
          {{-- <thead>
            <tr  style="width: 100%;text-align: center;">
              <td width="3%" style="border-bottom: 1px solid #000;"></td>
              <td width="61%" style="border-bottom: 1px solid #000;">案件</td>
              <td width="8%" style="border-bottom: 1px solid #000;">数</td>
              <td width="12%" style="border-bottom: 1px solid #000;">単価</td>
              <td width="13%" style="border-bottom: 1px solid #000;">金額</td>
            </tr>
          <thead> --}}
          <tbody>
            <tr style="width: 100%;text-align: center;">
              <td style="width: 3%; background-color: #D9E1F1; padding: 3px;"></td>
              <td style="width: 61%; background-color: #D9E1F1; ">案件</td>
              <td style="width: 8%; background-color: #D9E1F1; ">数</td>
              <td style="width: 12%; background-color: #D9E1F1; ">単価</td>
              <td style="width: 13%; background-color: #D9E1F1; ">金額</td>
            </tr>
            <tr style="width: 100%;text-align: center;">
              <td style="border-top: 1px solid black;"></td>
              <td style="border-top: 1px solid black;"></td>
              <td style="border-top: 1px solid black;"></td>
              <td style="border-top: 1px solid black;"></td>
              <td style="border-top: 1px solid black;"></td>
            </tr>
            @php
            $i=0;
            @endphp
            @foreach($misyukko as $mis)
            @php
            $i++;

            @endphp

            @if(($i%2)!=0 && $i<19) <tr>
              <td style="text-align: right;padding: 0 1mm;">{{$i}}</td>
              <td style="padding: 0 1mm;">{{$mis->kawasename}}
                {{substr(mb_convert_kana($mis->syouhinname,"rnaskc"),0,110)}}</td>
              <td style="text-align: right;padding: 0 1mm;">{{$mis->syukkasu}}</td>
              <td style="text-align: right;padding: 0 1mm;">{{$mis->dataint04}}</td>
              <td style="text-align: right;padding: 0 1mm;">{{$mis->cost}}</td>
              </tr>
              @elseif((($i%2)==0 && $i<18) || (($i%2)==0 && count($misyukko)==18)) <tr>
                <td style="text-align: right;padding: 0 1mm;">{{$i}}</td>
                <td style="padding: 0 1mm;">{{$mis->kawasename}}
                  {{substr(mb_convert_kana($mis->syouhinname,"rnaskc"),0,110)}}</td>
                <td style="text-align: right;padding: 0 1mm;">{{$mis->syukkasu}}</td>
                <td style="text-align: right;padding: 0 1mm;">{{$mis->dataint04}}</td>
                <td style="text-align: right;padding: 0 1mm;">{{$mis->cost}}</td>
                </tr>
                @elseif($i<=18 && !isset($mis->flag))
                  <!-- @php
                $msg='ok';
                @endphp -->
                  <tr>
                    <td style="text-align: right;padding: 0 1mm;">{{$i}}</td>
                    <td style="padding: 0 1mm;">以降、明細ありますが、詳細は見積書・注文書にてご確認お願い致します</td>
                    <td style="text-align: right;padding: 0 1mm;"></td>
                    <td style="text-align: right;padding: 0 1mm;"></td>
                    <td style="text-align: right;padding: 0 1mm;"></td>
                  </tr>
                  @elseif($i<=18 && isset($mis->flag))
                    <!-- @php
                $msg='ok';
                @endphp -->
                    <tr>
                      <td style="text-align: right;padding: 0 1mm;">{{$i}}</td>
                      <td style="padding: 0 1mm;"></td>
                      <td style="text-align: right;padding: 0 1mm;"></td>
                      <td style="text-align: right;padding: 0 1mm;"></td>
                      <td style="text-align: right;padding: 0 1mm;"></td>
                    </tr>
                    @else
                    @endif
                    @endforeach
                    <!-- @if(isset($msg)) -->

                    <!-- @endif -->
          </tbody>
        </table>
      </div>

      <div style="width: 100%;">
        <table style="border-spacing: 0px;width: 100%;">
          <tbody>
            <tr>
              <td style="border:none;" width="81%"></td>
              <td style="border:none;" width="5%">税抜</td>
              <td style="border:none;text-align: right;border-right: none;padding: 0 1mm;" width="14%">
                \{{$totalCostWithoutTax}}-</td>
            </tr>
            <tr>
              <td style="border:none;"></td>
              <td style="border:none;">消費税</td>
              <td style="border:none;text-align: right;border-right: none;padding: 0 1mm;">\{{$taxCalculateOfCost}}-
              </td>
            </tr>
            <tr>
              <td style="border:none;"></td>
              <td style="border:none;">税込</td>
              <td style="border:none;text-align: right;border-right: none;padding: 0 1mm;">\{{$totalpriceWithTax}}-</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="position: fixed;bottom: 230px;">
        <div style="width: 510px;margin-left: 30px;margin-bottom: 15px;">
          <div style="border-bottom: 1px solid #000;padding-bottom: 8px;">
            <span style="width: 125px;display: inline-block;">検収日</span>
            <span style="width: 30px;display: inline-block;">年</span>
            <span style="width: 30px;display: inline-block;">月</span>
            <span style="width: 30px;display: inline-block;">日</span>
          </div>
          <div style="border-bottom: 1px solid #000;padding-top: 4px; padding-bottom: 8px;">
            <span style="width: 50px;margin-bottom:10px;">支払日</span>
            <span style="width: 80px;margin-bottom:10px;">
              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"
                style="font-size:13px;vertical-align: middle;margin-bottom:10px;height: 6px;width:6px;margin-top: -6px;display:inline-block;">
              <label for="vehicle1" style="margin-bottom: 0;margin-top: 4px;margin-left:5px;">予定日通り</label>
            </span>
            <span style="width: 160px;margin-bottom:10px;">（支払予定日 {{$orderhenkan->intorder05}}）</span>
            <span style="width: 90px;margin-bottom:10px;">
              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"
                style="font-size:13px;vertical-align: middle;margin-bottom:10px;height: 6px;width:6px;margin-top: -6px;display:inline-block;">
              <label for="vehicle1"
                style="margin-bottom: 0;margin-top: 4px;margin-left:5px;margin-right:25px;">指定日</label>
            </span>
            <span style="width: 30px;margin-bottom:10px;margin-right:26px;">年</span>
            <span style="width: 30px;margin-bottom:10px;margin-right:26px;">月</span>
            <span style="width: 30px;margin-bottom:10px;">日</span>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div style="width: 100%; border: dotted 1px #000;height: 155px;position: fixed;bottom: 0;font-size: 12px;">
        <div style="width: 50%;float:left;border-right: dotted 1px #000;height: 153px;padding-left: 2px;">
          <span style="font-size: 13px;margin-bottom: 4px;"> リースの場合のみ　（リース会社様）</span><br>住所
          <div style="margin-bottom: 5px;margin-top: 5px;">
            <div style="float: left;margin-top: 22px;">貴社名</div>
            <div style="float: right;margin-right: 25px;margin-top:4px;">印</div>
            <div class="clearfix"></div>
          </div>
          <div style="float: left;margin-top:14px;">
            <div style="float: left;margin-top: 7px;margin-bottom: 21px;">御担当者名</div>
            <div style="float: right;margin-right: 25px;margin-top: 7px;">印</div>
            <div class="clearfix"></div>
            <div style="display: inline-block;">
              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"
                style="font-size:13px;vertical-align: middle;margin-left: 18px;height: 10px;margin: 0;margin-top: -3px;"><label
                for="vehicle1" style="margin-top: 2px;"> 弊社規定により社印は押印できませんが検収しました。</label>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div style="width: 50%;float:left;padding-left: 2px;height: 153px;">
          <span style="font-size: 13px;margin-bottom: 4px;">（お取引先様捺印欄）</span><br>住所
          <div style="margin-bottom: 5px;margin-top: 5px;">
            <div style="float: left;margin-top: 22px;">貴社名</div>
            <div style="float: right;margin-right: 25px;margin-top: 4px;">印</div>
            <div class="clearfix"></div>
          </div>
          <div style="margin-top:-70px;float:left;width:100%;">
            <div style="float: left;margin-top: 7px;margin-bottom: 21px;">御担当者名</div>
            <div style="float: right;margin-right: 25px;margin-top: 7px">印</div>
            <div class="clearfix"></div>
            <div style="display: inline-block;">
              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"
                style="font-size:13px;vertical-align: middle;margin-left: 18px;height: 10px;margin: 0;margin-top: -3px;"><label
                for="vehicle1" style="margin-top: 2px;"> 弊社規定により社印は押印できませんが検収しました。</label>
            </div>

          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>