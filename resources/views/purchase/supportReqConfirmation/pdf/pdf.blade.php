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
        margin: -2mm -2.7mm -2mm -1.5mm !important;
        padding: 0px !important;
        background: #fff;
        color: #000;
        /*line-height: normal !important;*/
      }
      .wrapper-content {
          /* width: 795px; */
          margin: 0 auto;
          background: white;
          /*padding: 37.79px 37.79px 37.79px 56.69px;*/
          /*padding: 3mm 9mm;*/
          font-size: 11px;
          position: relative;
      }

      .pdf-logo{
        position: relative;
        height: 65px;
      }

      .pdf-img-stamp{
        position: absolute;
        left: 173px;
        top: -24px;
      }

      .clearfix{
        display: block;
        content: "";
        clear: both;
      }

      table thead tr td{
        text-align: center;
        
      }

      .pdf-data-table-one {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        /*border: 1px solid #000;*/
      }

    .pdf-data-table-one tbody tr td {
      /*border-right: 1px solid #000; */
      padding: 0;
      vertical-align: middle;
    }

    /*.pdf-data-table-one tbody tr td:last-child {
      border-right: none;
    }*/

    .pdf-data-table-one tbody tr:nth-child(odd) td {
      background-color: #D9E1F1;
      border-right: 1px solid #000;
    }

    .pdf-data-table-one tbody tr:nth-child(even) td {
      border-right: 1px solid #000;
    }

    .pdf-data-table-one tbody tr:nth-child(odd) td:first-child {
      border-left: 1px solid #000;
    }

    .pdf-data-table-one tbody tr:nth-child(even) td:first-child {
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

    /*.table-tr-border td{
      border-bottom: 1px solid #000;
    }*/
  
    /*.pdf-data-table-one tbody tr > td{
      border-right: 1px solid #000;
    }*/
    /* .pdf-data-table-one thead > tr > td:first-child {
      border-left: 1px solid #000;
    }
    .pdf-data-table-one thead > tr > td:last-child {
      border-right: 1px solid #000;
    } */
     
    /*.pdf-data-table-one tbody tr > td:first-child {
      border-left: 1px solid #000;
    }*/
    /*.pdf-data-table-one tbody tr > td:last-child {
      border-right: 0;
    }*/
    
    /* .pdf-data-table-one tbody tr > td:last-child {
      border-right: 1px solid transparent;
    } */

    /* .pdf-data-table-one tbody tr:first-child > td {
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
    } */

    /*.pdf-data-table tbody tr td {
      border-top: 1px solid #000;
    }*/
	/*.pdf-data-table-bordered{
		border-left: 1px solid #000;
		border-right: 1px solid #000;
		border-top: 1px solid #000;

	}
.pdf-data-table-bordered tr{
	border-top: 1px solid #000;
}*/


    .pdf-data-table-bordered tr td{
      /* border: 0.5px solid #000; */
      border-bottom: 1px solid #000;
      border-left: 1px solid #000;
    }

    .pdf-data-table-bordered tr td:last-child{
      border-right: 1px solid #000;
    }
	
    .calcu-left-part{
      margin-top: 30px;
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

      /* header {
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
      } */
    </style>
  </head>
  <body>
    {{-- <header></header>
    <footer></footer> --}}

    <main>
      <div class="wrapper-body">
        <div class="wrapper-content">
          <!-- <div class="left-line"></div>
            <div class="right-line"></div> -->
          
            @php
            $temp_total_rows = count($data);
            $total_page = ceil($temp_total_rows/27)+1;
            @endphp
          
          <div style="width: 100%;">
            {{-- <div style="width: 30%;float:left;"></div> --}}
            <div style="width: 60%;float:left;text-align:right;margin-top:-2px;">
              <span style="margin-top: 0px;margin-bottom:50px;font-size: 18px;border-bottom: 1px solid #808080; @if($data[0]->kokyakubango == 2) width: 234px; @else width: 165px; @endif">
                サポート依頼兼請書@if($data[0]->kokyakubango == 2)（訂正）@endif
              </span>
            </div>
            <div style="width: 40%;float:left;">
              <div style="width:100%;text-align:right;margin-right:2px;">
                （1/{{$total_page}}頁）
              </div>
              <div style="width: 100%;text-align:right;">
                @php
                $datetime = new DateTime( "now", new DateTimeZone( "Asia/Tokyo" ) );
                $current_date = $datetime->format( 'Y/m/d' );
                $current_time = $datetime->format( 'H:i:s' );
                @endphp
                <span>印刷日</span> <span>{{$current_date}}</span> <span> {{$current_time}}</span>
              </div>
              <div style="width: 100%;text-align:right;">
                <span>サポート番号</span> <span style="padding-left:10px;">{{$data[0]->support_number.'-'.str_pad($data[0]->ordertypebango2, 2, '0', STR_PAD_LEFT)}}</span> 
              </div>
              <div style="width: 100%;text-align:right;">
                <span>担当</span> <span style="padding-left:10px;">{{$data[0]->responsible_person}}</span><span style="padding-left:10px;">{{$data[0]->authorizer}}</span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>

          {{-- <div style="width: 100%;margin-top:1mm;">
          </div> --}}

          <div style="width: 100%;margin-top:-2px;">
            <table class="" border="0" style="border-spacing: 0px;width: 100%;table-layout:fixed;border-collapse:seperate; background-color:#fff;">
              <tbody>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">受注番号</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->orderuserbango}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">受注先</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->information1_detail}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">最終顧客</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->information3_detail}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">受注件名</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->juchukubun1}}</td>
                </tr>
              </tbody>
            </table>

            <table class="" border="0" style="border-spacing: 0px;width: 100%;table-layout:fixed;border-collapse:seperate; background-color:#fff;">
              <tbody>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">受注日</td>
                  <td style="width: 15%;vertical-align: top;text-align: left;">{{$data[0]->intorder01}}</td>
                  <td style="width: 10%;vertical-align: top;text-align: left;">依頼日</td>
                  <td style="width: 15%;vertical-align: top;text-align: left;">{{$data[0]->date}}</td>
                  <td style="width: 8%;vertical-align: top;text-align: left;">納期</td>
                  <td style="width: 42%;vertical-align: top;text-align: left;">{{$data[0]->intorder02}}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;text-align: left;">検収日</td>
                  <td style="vertical-align: top;text-align: left;">{{$data[0]->intorder04}}</td>
                  <td style="vertical-align: top;text-align: left;">売上日</td>
                  <td style="vertical-align: top;text-align: left;">{{$data[0]->intorder03}}</td>
                  <td style="vertical-align: top;text-align: left;">入金日</td>
                  <td style="vertical-align: top;text-align: left;">{{$data[0]->intorder05}}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;text-align: left;">引継希望日</td>
                  <td style="vertical-align: top;text-align: left;">{{$data[0]->deletedate}}</td>
                  <td style="vertical-align: top;text-align: left;">初回訪問日</td>
                  <td style="vertical-align: top;text-align: left;">{{$data[0]->date0012}}</td>
                  <td style="vertical-align: top;text-align: left;"></td>
                  <td style="vertical-align: top;text-align: left;"></td>
                </tr>
              </tbody>
            </table>

            <table class="" border="0" style="border-spacing: 0px;width: 100%;table-layout:fixed;border-collapse:seperate; background-color:#fff;">
              <tbody>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">納品先</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->kaiinid_detail}}<br/>
                    〒{{substr($data[0]->haisou_yubinbango, 0, 3).'-'.substr($data[0]->haisou_yubinbango, 3)}}<br/>
                    @php
                    $part1 = "";
                    $part2 = "";
                    $haisou_address = trim(trim($data[0]->haisou_address," "),"　");
                    if(strpos($haisou_address," ")!==false){
                    $haisou_address = str_replace(" ","　",$haisou_address);
                    }
                    $haisou_address = explode('　',$haisou_address);
                    for($i=0;$i<count($haisou_address);$i++)
                    {
                    if($i == 0){
                    $part1 = $part1.$haisou_address[$i];
                    }
                    if($i == 1){
                    $part1 = $part1."　".$haisou_address[$i];
                    }
                    if($i == 2){
                    $part1 = $part1."　".$haisou_address[$i];
                    }
                    if($i == 3){
                    $part2 = $part2.$haisou_address[$i];
                    }
                    }
                    @endphp
                    {{$part1}}<br/>
                    @if($part2 != ""){{$part2}}@else &nbsp; @endif<br/>
                    {{$data[0]->kokyaku1_name}} <br/>
                    {{$data[0]->etsuransya_mail2.' '.$data[0]->etsuransya_tantousya}}<br/>
                    TEL {{$data[0]->haisou_tel}}<br/>
                  </td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">相談SE</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->datachar12}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">納入場所</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->datatxt0157}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">機種名</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->datachar14}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">業務名</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->datachar13}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">ＯＳ</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$data[0]->datachar15}}</td>
                </tr>
                <tr>
                  <td style="width: 10%;vertical-align: top;text-align: left;">社内備考</td>
                  @php
                  $minyuko_datachar11_part1 = substr($data[0]->minyuko_datachar11,0,30);
                  $minyuko_datachar11_part2 = substr($data[0]->minyuko_datachar11,30,30);
                  @endphp
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$minyuko_datachar11_part1}}<br/>
                    {{$minyuko_datachar11_part2}} 
                  </td>
                </tr>
                <tr>
                  @php
                  $minyuko_datachar09_part1 = substr($data[0]->minyuko_datachar09,0,30);
                  $minyuko_datachar09_part2 = substr($data[0]->minyuko_datachar09,30,30);
                  @endphp
                  <td style="width: 10%;vertical-align: top;text-align: left;">発注出荷備考</td>
                  <td style="width: 90%;vertical-align: top;text-align: left;">{{$minyuko_datachar09_part1}} <br/>
                    {{$minyuko_datachar09_part2}}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div style="width: 100%;margin-top:10px;">
            <div style="width: 100%;">
              <span style="padding-right:10px;">受注概要</span> <span>留意点</span> <span></span>
            </div>
            <div style="width: 100%;margin-top:2px;margin-bottom:10px;max-height:230px;" >
              <table  style="border-spacing: 0px;width: 100%;border:1px solid #000;border-radius:5px;">
                <tbody>
                  @php
                  $datatxt0147 = preg_split('/\r\n|\r|\n/', $data[0]->datatxt0147);
                  @endphp
                  @for($j = 0;$j<17;$j++)
                  @if(array_key_exists($j,$datatxt0147))
                  <tr style="height: 230px!important;">
                    <td style="padding:1px;word-wrap: break-word;text-align: left;width: 100%;">{{$datatxt0147[$j]}}</td>
                  </tr>
                  @else
                  <tr style="height: 230px!important;">
                    <td style="padding:1px;word-wrap: break-word;text-align: left;width: 100%;">&nbsp;</td>
                  </tr>
                  @endif
                  @endfor
                </tbody>
              </table>
            </div>
          </div>

          <div style="width: 100%;margin-top: 17px;float:left;">
            <div style="width: 50%;">
              <div style="width: 100%;">
                <span>営業マスタプラン</span> 
              </div>
              <table style="margin-left: 20px;">
                <tbody>
                  <tr>
                    <td style="width:90px;">基本設計終了 </td>
                    <td style="">{{$data[0]->date0013}}</td>
                  </tr>
                  <tr>
                    <td style="">セットアップ開始</td>
                    <td style="">{{$data[0]->date0014}}</td>
                  </tr>
                  <tr>
                    <td style="">本稼働開始</td>
                    <td style="">{{$data[0]->date0015}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style="width: 50%;">
            </div>
            {{-- 
            <div style="width: 30%;">
            </div>
            --}}
            <div class="clearfix"></div>
          </div>

          <div style="width: 100%;margin-top:10px;">
            <div style="width: 100%;">
              <span style="padding-right:10px;">検収条件</span> <span>納品確認書貴社捺印時</span> <span></span>
            </div>
            <div style="width: 100%;margin-top:2px;" >
              <table  style="border-spacing: 0px;width: 100%;table-layout:fixed;border:1px solid #000;border-radius:5px;">
                <tbody>
                  @php
                  $datatxt0148 = preg_split('/\r\n|\r|\n/', $data[0]->datatxt0148);
                  @endphp
                  @for($i = 0;$i<3;$i++)
                  @if(array_key_exists($i,$datatxt0148))
                  <tr>
                    <td style="padding:1px;word-wrap: break-word;text-align: left;width: 100%;">{{$datatxt0148[$i]}}</td>
                  </tr>
                  @else
                  <tr>
                    <td style="padding:1px;word-wrap: break-word;text-align: left;width: 100%;">&nbsp;</td>
                  </tr>
                  @endif
                  @endfor
                </tbody>
              </table>
            </div>
          </div>

          <div style="page-break-before: always;"></div>

          <!-- content 1 -->
          <div style="width: 100%;margin-top: -1mm !important;">
            <div style="width: 30%;float:left;">
            </div>
            <div style="width: 40%;float:left;">
            </div>
            <div style="width: 30%;float:left;">
              <div style="width: 100%;text-align:right;">
                <span>（2/{{$total_page}}頁）</span>
              </div>
              <div style="width: 100%;text-align:right;">
                <span>印刷日</span> <span style="padding-left:5px;"> {{$current_date}}</span> <span style="padding-left:5px;">  {{$current_time}}</span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>

          <div style="width: 100%;margin-top: 0px;margin-bottom:0px;">
            <div style="width: 90%;float:left;">
              <div style="width: 100%;float:left;">
                <span>サポート部門</span>   <span style="padding-left:10px;">{{$data[0]->datatxt0149_detail}}</span>
              </div>
              <div style="width: 100%;float:left;margin-top:20px!important;">
                <span>資料</span>   <span style="padding-left:53px;">@if($data[0]->datatxt0151 == null)添付資料無 @else 添付資料有 @endif</span>
              </div>
            </div>

            <div style="width: 10%;float:left;">
            </div>
            <div class="clearfix"></div>
          </div>

          <div style="width: 100%;margin-top: 5px;margin-bottom: 10px;">
            <table class="pdf-data-table-bordered" style="border-spacing: 0px;width: 100%;table-layout:fixed;">
              <tbody>
                <tr>
                  <td style="padding: 0px; line-height:0;"></td>
                  <td style="padding: 0px; line-height:0;"></td>  
                  <td style="padding: 0px; line-height:0;"></td> 
                  <td style="padding: 0px; line-height:0;"></td>
                  <td style="padding: 0px; line-height:0;"></td>
                  <td style="padding: 0px; line-height:0;"></td>
                </tr>
                <tr>
                  <td style="width: 5%;text-align: center;">商品CD</td>
                  <td style="width: 45%;text-align: center;">商品名</td>
                  <td style="width: 6%;text-align: center;">数量</td>
                  <td style="width: 10%;text-align: center;">単価</td>
                  <td style="width: 10%;text-align: center;">金額</td>
                  <td style="width: 24%;text-align: center;">SE担当</td>
                </tr>
                @php
                $grand_total = 0;
                $total_rows = count($data);
                $row_count = 0;
                $page_number = 2;
                @endphp
                @foreach($data as $key=>$val)
                <tr>
                  <td style="padding-left:4px!important;">{{$data[$key]->minyuko_datachar02}}</td>
                  <td style="padding-left:6px!important;">{{$data[$key]->minyuko_datachar03}}</td>
                  <td style="text-align: right;padding-right:4px!important;">{{number_format($data[$key]->minyuko_nyukosu)}}</td>
                  <td style="text-align: right;padding-right:4px!important;">{{number_format($data[$key]->minyuko_genka)}}</td>
                  <td style="text-align: right;padding-right:4px!important;">{{number_format($data[$key]->minyuko_syouhizeiritu)}}</td>
                  <td>{{$data[$key]->minyuko_datachar13_name}}</td>
                </tr>
                  @php
                  $grand_total = $grand_total + $data[$key]->minyuko_syouhizeiritu;
                  $row_count++;
                  @endphp
                  
                  <!-- common header starts -->
                  @if($row_count > 27)
                        </tbody>
                  </table>
                  <div style="page-break-before: always;"></div>
                  
                    <!-- content 1 -->
                    <div style="width: 100%;margin-top: 0px;">
                      <div style="width: 30%;float:left;">
                      </div>
                      <div style="width: 40%;float:left;">
                      </div>
                      <div style="width: 30%;float:left;">
                        <div style="width: 100%;text-align:right;">
                          <span>（{{$page_number+1}}/{{$total_page}}頁）</span>
                        </div>
                        <div style="width: 100%;text-align:right;">
                          <span>印刷日</span> <span style="padding-left:5px;"> {{$current_date}}</span> <span style="padding-left:5px;">  {{$current_time}}</span>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>

                    <div style="width: 100%;margin-top: 0px;margin-bottom:0px;">
                      <div style="width: 90%;float:left;">
                        <div style="width: 100%;float:left;">
                          <span>サポート部門</span>   <span style="padding-left:10px;">{{$data[0]->datatxt0149_detail}}</span>
                        </div>
                        <div style="width: 100%;float:left;margin-top:20px!important;">
                          <span>資料</span>   <span style="padding-left:53px;">@if($data[0]->datatxt0151 == null)添付資料無 @else 添付資料有 @endif</span>
                        </div>
                      </div>

                      <div style="width: 10%;float:left;">
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    
                    <table class="pdf-data-table-bordered" style="border-spacing: 0px;width: 100%;table-layout:fixed;">
                    <tbody>
                      <tr>
                        <td style="padding: 0px; line-height:0;"></td>
                        <td style="padding: 0px; line-height:0;"></td>  
                        <td style="padding: 0px; line-height:0;"></td> 
                        <td style="padding: 0px; line-height:0;"></td>
                        <td style="padding: 0px; line-height:0;"></td>
                        <td style="padding: 0px; line-height:0;"></td>
                      </tr>
                      <tr>
                        <td style="width: 5%;text-align: center;">商品CD</td>
                        <td style="width: 45%;text-align: center;">商品名</td>
                        <td style="width: 6%;text-align: center;">数量</td>
                        <td style="width: 10%;text-align: center;">単価</td>
                        <td style="width: 10%;text-align: center;">金額</td>
                        <td style="width: 24%;text-align: center;">SE担当</td>
                      </tr>
                    @php
                    $row_count = 0;
                    $page_number++;
                    @endphp
                @endif
                <!-- common header ends -->
                  
                @endforeach
                <tr>
                  <td colspan="4" style="padding: 0;text-align: right;border-left: 0px!important;border-bottom: 0px!important;">SE粗利計</td>
                  <td style="padding: 0;text-align: right;border-bottom: 1px solid #000;padding-right:4px!important;padding-top:2px!important;padding-bottom:2px!important;">{{number_format($grand_total)}}</td>
                  <td style="border-bottom: 0px!important;border-right: 0px!important;"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>