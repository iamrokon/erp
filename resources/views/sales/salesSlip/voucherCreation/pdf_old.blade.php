<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>
    <style type="text/css">
      body {
        font-family: "ipag", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
        font-size: 13px;
        margin: 0px;
        padding: 0px;
        background: #fff;
      }
      .wrapper-content {
          /*width: 795px;*/
          margin: 0 auto;
          background: white;
          /*padding: 37.79px 37.79px 37.79px 56.69px;*/
      }
       .clearfix{
        display: block;
        content: "";
        clear: both;
      }

      table thead tr td,
      table tbody tr td{
        border: none;
        border-right: 1px solid #000;
        text-align: center;
      }

      table thead tr td:last-child,
      table tbody tr td:last-child{
        border-right: 0;
      }

      @font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path ('fonts/YuGothRegular.ttf') }}") format('truetype');

        }
        @font-face {
            font-family: ipag;
            font-style: bold;
            font-weight: bold;
            src: url("{{ storage_path ('fonts/YuGothBold.ttf') }}") format('truetype');

        }
    </style>
  </head>
  <body>
    <div class="wrapper-body">
      <div class="wrapper-content">
        <div style="width: 100%;">
          <div style="width: 46%;float: left;margin-right: 4%;">
                <div>{{substr($data[0]->office_yubinbango, 0, 3).'-'.substr($data[0]->office_yubinbango, 3)}}</div>
                <div>{{$data[0]->office_address_part1}}</div>
                <div>{{$data[0]->office_address_part2}}</div>
                <div>{{$data[0]->company_name}}</div>
                <div>{{$data[0]->office_name}}</div>
                <div>{{$data[0]->etsransa_detail}}</div>
                <div>お客様コード {{$data[0]->information2}}</div>
                <!--<div>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</div>
                <div>お客様コード - XXXXXXXXXX</div>-->
          </div>
          <div style="width: 46%;float: left;">
            <div style="margin-top: 6px;font-size: 20px;text-decoration: underline;">
                @if($data[0]->housoukubun == 1)
                {{'売上伝票　兼　請求書'}}
                @else
                {{'売上伝票'}}
                @endif
            </div>
            <div style="position: relative;">
              @if($data[0]->housoukubun != 1)
              <div style="">
                <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/logo.png'}}" width="320">
              </div>
              @endif
               <div class="clearfix"></div>
            </div>
            <div style="width: 100%;">
               <div style="margin-top: -25px;">
                  <div>登録番号 T 7 1 2 0 0 0 1 0 9 1 5 7 3</div>
                    <div>大阪本社 〒541-0048 大阪市中央区瓦町1-6-10</div>
                    <div style="margin-left:28px;">経理部 TEL 06-6228-1384 FAX 06-6228-1380</div>
                    <div>東京本社 〒103-0015 東京都中央区日本橋箱崎町4-3</div>
                     <div style="margin-left:28px;">経理部 TEL 03-6661-1210 FAX 03-5643-0909</div>
               </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div style="width: 100%;margin-top:40px;">
            <div style="width: 36%;float: left;margin-right: 9%;">
              <div style="border-bottom: 1px solid #000;">
                <span style="padding-right: 35px;">伝票番号
                </span><span>{{$data[0]->juchukubun2}}</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span style="padding-right: 23px;">売上年月日</span><span>{{$data[0]->intorder03}}</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span style="padding-right: 23px;">請求書番号</span><span>@if($data[0]->housoukubun == 1){{$data[0]->text3}}@endif</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span style="padding-right: 11px;">弊社管理番号</span><span> {{$data[0]->kokyakuorderbango}} </span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span style="padding-right: 11px;">貴社発注番号</span><span>{{$data[0]->datachar04}}</span>
              </div>
              <div class="clearfix"></div>
            </div>

            @if($data[0]->housoukubun == 1)
            <div style="width: 55%;float: left;text-align: right;margin-top: 30px;">
              <div>
                <span style="padding-right: 10px;">取引銀行 &nbsp;三井住友銀行 &nbsp; 御堂筋支店</span>
                <span>当座6661280</span>
              </div>
              <div>
                <span style="padding-right: 30px;">りそな銀行 &nbsp; 船場支店
                </span>
                <span>当座1274350</span>
              </div>
               <div>
                <span>三菱UFJ銀行 &nbsp;船場中央支店&nbsp;</span>
                <span>当座1126963</span>
              </div>
               <div>
                <span style="padding-right: 30px;">みずほ銀行&nbsp;船場支店&nbsp;
                </span><span>当座0035398</span>
              </div>
              <div class="clearfix"></div>
            </div>
            @endif

            <div class="clearfix"></div>
        </div>
        <!-- content 1 -->
        <div style="width: 100%;margin-top: 10px;border:1px solid #000;">
          <table style="border-spacing: 0px;width: 100%;">
            <thead style="background: #D9E1F1; width: 100%;">
              <tr>
                <td>行</td>
                <td>区分</td>
                <td>商品コード<br/>商 品 名</td>
                <td>数 量<br/>単 位</td>
                <td>単 価</td>
                <td>金 額</td>
                <td>摘 要</td>
              </tr>
            </thead>
            <tbody>
                @foreach($data as $key=>$val)
                <tr>
                  <td>{{$data[$key]->syouhinsyu}}</td>
                  <td>{{$data[$key]->text1_detail}}</td>
                  <td>{{$data[$key]->kawasename}}<br/> {{$data[$key]->syouhinname}}</td>
                  <td>{{$data[$key]->syukkasu}}<br/> {{$data[$key]->codename}}</td>
                  <td>{{number_format($data[$key]->dataint04)}}</td>
                  <td>{{number_format($data[$key]->syukkasu*$data[$key]->dataint04)}}</td>
                  <td>{{$data[$key]->datachar08}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div style="width: 100%;border:1px solid #000;border-top: 0;">
          <table style="border-spacing: 0px;width: 100%;">
            <tbody>
              <tr>
                <td rowspan="4" width="55%">
                  摘要 X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X
                  X X X X X X X X X X X X X X X X X X X X
                  X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X
                  X X X
                  X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X
                  X X X
                  X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X
                  X X X
                  X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X X
                  X X X
                </td>
                <td style="background: #D9E1F1;">合計（税込）</td>
                <td style="background: #D9E1F1;">{{$data[0]->numeric3 + $data[0]->numeric4}}</td>
                <td  width="15%"></td>
              </tr>
              <tr>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">合 計 <br/>消 費 税</td>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">{{$data[0]->numeric3}}<br/>{{$data[0]->numeric4}}</td>
                <td></td>
              </tr>
              <tr>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">1 0 % 対 象<br/>消 費 税</td>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">SSS, SSS, SS0</td>
                <td></td>
              </tr>
              <tr>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">8 % 対 象<br/>消 費 税</td>
                <td style="background: #D9E1F1;border-top: 1px solid #000;">SSS, SSS, SS0</td>
                <td>XX</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
