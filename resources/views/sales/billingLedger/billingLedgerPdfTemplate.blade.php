<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
      /*@font-face {
        font-family: msgothic;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path ('fonts/msgothic.ttf') }}") format('truetype');
      }*/
      body {
        font-family: "ipag", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
        /*font-family: msgothic;*/
        margin: 0px !important;
        /*padding: 0px !important;*/
        background: #fff;
        line-height: normal;
        color: #000000;
      }
      .wrapper-content {
        margin: 0 auto;
        background: white;
        padding: 8mm 8mm;
        font-size: 12px;
        /*padding: 37.79px 37.79px 37.79px 56.69px;*/
        /*padding: 22mm 25mm;*/
      }

      .clearfix{
        display: block;
        content: "";
        clear: both;
      }

      table{
        border-spacing: 0;
        width: 100%;
        border-collapse: collapse;
      }

      .main-table tr td{
        height: 18px;
        padding-left: 2px;
        padding-right: 2px;
        padding-top: -2px;
        border: 1px solid #000;
        line-height: .7;
      }

      /*.main-table tr td:last-child{
        padding-right: 0;
      }*/

      @media print {
        * {
          background: transparent !important;
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
        size: landscape;
        margin: 0;
      }

      @media screen, print{
        @page {
          max-width: 100%;
          max-height:100%;
          position:fixed;
        }
      } 
    </style>
  </head>
  <body>
    <div class="wrapper-content">
            <?php
              $temp_billing_ledger_table = "";
              $temp_count = 0;
              $page_no = 1;
              $total_page = ceil(count($allBillingLedger)/29);
              foreach($allBillingLedger as $key => $value){
                if($temp_count == 0){
                  // every page header
                  // for next page header top padding
                  if($page_no > 1){
                    $temp_billing_ledger_table .= "<div class='pdf-head' style='padding-top: 8mm !important;'>";
                  }else{
                    $temp_billing_ledger_table .= "<div class='pdf-head'>";
                  }

                  $temp_billing_ledger_table .= "<div style='width: 80%;float: left;'>
                                                    <div style='font-size: 18px; font-weight: bold; padding-left: 30px;'> 得意先元帳（社外）</div>
                                                    <div>年月度={$ledger_year_start}～{$ledger_year_end} 売上請求先CD={$billing_address} 用紙の左端寄せ。数値は半角。</div>
                                                  </div>
                                                  <div style='width: 20%;float: left;'>
                                                    <table>
                                                      <tbody>
                                                        <tr>
                                                          <td style='text-align:right'>印刷日</td>
                                                          <td style='text-align:right'>". date('Y/m/d H:i:s') ."</td>
                                                          <td style='text-align:right'>頁 $page_no/$total_page</td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                  <div class='clearfix'></div>
                                                </div>";
                  $temp_billing_ledger_table .= "<div class='main-table'>
                                            <table>
                                              <tbody>
                                                <tr>
                                                  <td style='text-align:center;width: 8%;'>日付</td>
                                                  <td style='text-align:center;width: 4%;'>区分</td>
                                                  <td style='text-align:center;width: 9%;'>伝票番号</td>
                                                  <td style='text-align:center;width: 16%;'>品名／備考</td>
                                                  <td style='text-align:center;width: 8%;'>売上金額</td>
                                                  <td style='text-align:center;width: 8%;'>消費税</td>
                                                  <td style='text-align:center;width: 8%;'>入金額</td>
                                                  <td style='text-align:center;width: 8%;'>残高</td>
                                                  <td style='text-align:center;width: 14%;'>摘要</td>
                                                  <td style='text-align:center;width: 14%;'>最終顧客</td>
                                                </tr>";
                }
                  $temp_count++;     
                  $classification = "";
                  if($value->classification){
                    $classification = explode(" ", $value->classification)[0];
                  }

                  $product_name = "";
                  if($value->product_name){
                    if(mb_strlen($value->product_name) >= 13){
                      $product_name = mb_convert_kana(mb_substr($value->product_name, 0, 13), "rnaskhc") . "...";
                    }else{
                      $product_name = mb_convert_kana($value->product_name, "rnaskhc");
                    }
                  }

                  $voucher_remarks = "";
                  if($value->voucher_remarks){
                    if(mb_strlen($value->voucher_remarks) >= 10){
                      $voucher_remarks = mb_convert_kana(mb_substr($value->voucher_remarks, 0, 10), "rnaskhc") . "...";
                    }else{
                      $voucher_remarks = mb_convert_kana($value->voucher_remarks, "rnaskhc");
                    }
                  }

                  $end_customer = "";
                  if($value->end_customer){
                    if(mb_strlen($value->end_customer) >= 10){
                      $end_customer = mb_convert_kana(mb_substr($value->end_customer, 0, 10), "rnaskhc") . "...";
                    }else{
                      $end_customer = mb_convert_kana($value->end_customer, "rnaskhc");
                    }
                  }

                  $temp_billing_ledger_table .= "<tr>
                                                  <td>$value->dates_xls</td>
                                                  <td>$classification</td>
                                                  <td>$value->slip_number</td>
                                                  <td>$product_name</td>
                                                  <td style='text-align: right'>$value->sales_amount</td>
                                                  <td style='text-align: right'>$value->consumption_tax</td>
                                                  <td style='text-align: right'>$value->deposit_amount</td>
                                                  <td style='text-align:right;'>$value->balance</td>
                                                  <td style='text-align:left;'>$voucher_remarks</td>
                                                  <td style='text-align:left;'>$end_customer</td>
                                                </tr>";
                  if($temp_count == 29){
                    // table finish
                    $temp_billing_ledger_table .= "</tbody>
                                                    </table>
                                                  </div>";
                      // create new page
                     $temp_billing_ledger_table .= "<div style='page-break-before: always;'></div>";
                     $temp_count = 0;
                     $page_no++;   
                  }
              } // ./ Loop ends

              if($temp_count < 29){
                $remaining_row_count = 29 - $temp_count;
                for($i = 0; $i < $remaining_row_count; $i++){
                   $temp_billing_ledger_table .= "<tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                  </tr>";
                }
                $temp_billing_ledger_table .= "</tbody>
                                                    </table>
                                                  </div>";
              }


              echo $temp_billing_ledger_table;
            ?>
    </div>
  </body>
</html>