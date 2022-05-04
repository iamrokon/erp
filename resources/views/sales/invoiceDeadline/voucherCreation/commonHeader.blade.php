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
    border: 1px dotted #000;
  }

  .pdf-data-table thead tr td,
  .pdf-data-table tbody tr td,
  .pdf-data-table-one thead tr td,
  .pdf-data-table-one tbody tr td{
    border-right: 1px dotted #000;
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
    border-top: 1px dotted #000;
  }

  .pdf-data-table-one tbody tr:nth-child(even) td{
    background-color: #D9E1F1;
  }

  .pdf-data-table-one tbody tr:nth-child(even) td:last-child{
    border-right: none;
  }

  .pdf-data-table-one thead tr td{
    border-bottom: 1px dotted #000;
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

<!-- end of previous page -->
  </tbody>
</table>
<!-- end of previous page -->

<!-- common footer starts here -->
<div style="margin-top:-1px;">
 <table class="pdf-data-table" style="border-spacing: 0px;width: 100%;font-size: 12px;border-top: none;">
   <tbody>
     <tr>
       <td rowspan="3" style="width: 79%;position: relative;vertical-align: top;padding: 0 3px;line-height:20px;">
         <div class="" style="position: absolute;top: 1px;font-size:10px;width: 100%;">
           <div style="float: right;">
             <span style="margin-right: 0px;"></span>
           </div>
         </div>

         <div class="" style="margin-right: 10px;margin-top: 1px;width: 100%;">
           <span style="font-size: 11px;"> <br/>
           <span style="font-size: 12px;margin-right:5px;">ページ：</span> <span style="font-size: 11px;">（{{$page}}／<span class="total-page"></span>）</span><br/> <br/>
           <span style="font-size: 12px;"></span><br/>
           <span style="font-size: 12px;"></span> <br/>
           <span style="font-size: 11px;"></span> <br/>
           <span style="font-size: 11px;"></span>
         </div>
       </td>
       <td colspan="2" style="background: #D9E1F1;padding:3px 0 3px 3px;line-height:1.1; height:45px;"></td> 
       {{-- <td style="background: #fff;width: 10%;text-align: center;padding:3px 0 3px 3px;line-height:1.1; height:45px;"><div style="vertical-align:middle;height:43px;line-height:25px; padding-top:20px; padding-bottom:0px;"></td>
       <td style="background: #fff;width: 10%;text-align: right;padding:3px 3px 3px 0px;;line-height:1.1;height:45px;"><div style="vertical-align:middle;height:43px;line-height:25px; padding-top:20px; padding-bottom:0px;padding-right:2px;"></td> --}}

       </tr>

     <tr>
       <td style="background: #D9E1F1;text-align: center;padding: 0 2px;line-height:1.1;height:46px;"><br/></td>
       <td style="background: #D9E1F1;text-align: right;padding: 0 2px;line-height:1.1;"><br/></td>
     </tr>
     <tr>
       <td style="background: #D9E1F1;text-align: center;padding: 0 2px;line-height:1.1;"><br/></td>
       <td style="background: #D9E1F1;text-align: right;padding: 0 2px;line-height:1.1;"><br/></td>
     </tr>
   </tbody>
 </table>
</div>
<!-- common footer ends here -->

<div style="page-break-before: always;"></div>

<!-- start of common header -->      
<div style="width: 100%;margin-top:1mm;margin-bottom:5px;">
    <div style="width: 87.7mm;margin-left:11.3mm;float: left;margin-right: 50px;font-size: 13px;word-wrap: break-word;line-height: 1.1;">
      @php
      if($data[0]->office_address != null){
        $temp_office_address = preg_split("/[ ]/", $data[0]->office_address);
        $office_address = $temp_office_address[0] ." ". $temp_office_address[1] ." ". $temp_office_address[2];
        $office_address_last_part = $temp_office_address[3];
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
      <div>&nbsp;&nbsp;{{$personal_name}}</div>
      <div  style="font-size: 10px;">お客様コード　{{mb_convert_kana($personal_info2,"rnask")}}</div>
    </div>
    <div style="float: right;margin-right: 45px;">
      <div style="margin-top: 6px;margin-bottom:20px;font-size: 18px;border-bottom: 2pt double black;">
        請　求　書
      </div>
      <div>
        <div class="pdf-logo">
          <!-- <img src="img/logo.jpg" height="36px">
          <img class="pdf-img-stamp" src="img/stamp.png" width="85px"> -->
          <img src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/logo.jpg'}}" height="36px">
          <img class="pdf-img-stamp" src="{{resource_path() . '/views/sales/salesSlip/voucherCreation/img/stamp.png'}}" width="60px">
        </div>
         <div class="clearfix"></div>
      </div>
      <div style="margin-top:-10px;">
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
  <div style="width: 100%;float:left;">
    <div style="width: 53%;float: left; margin-right: 9%;font-size: 10px;">
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

    <div style="width: 38%;float: right; margin-bottom: 0px;font-size: 11px;">
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
<!-- end of common header -->    

<!-- starts page break header -->
<div style="width: 100%;margin-top: 2px; float:left;">
<table class="pdf-data-table-one" style="border-spacing: 0px;width: 100%;font-size: 12px;line-height: 1.1;table-layout:fixed;margin-top: 80px;border-bottom:1px solid transparent;">
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
  </div>
<!-- ends page break header -->