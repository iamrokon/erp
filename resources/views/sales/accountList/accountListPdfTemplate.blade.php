
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
        /*padding: 0px !important;*/
        background: #fff;
        line-height: normal !important;
        color: #000000;
      }
      .wrapper-content {
        margin: 0 auto;
        background: white;
        padding: 8mm 8mm !important;
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
        /*border-collapse: collapse;*/
      }

      .main-table tr td{
        height: 20px;
        padding-right: 10px;
        /*border: 1px solid #000;*/
        vertical-align: middle;
      }

      .main-table tr td:last-child{
        padding-right: 0;
      }

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
              $total_page = ceil(count($account_list)/29);
              foreach($account_list as $key => $value){
                if($temp_count == 0){
                  // every page header
                  // for next page header top padding
                  if($page_no > 1){
                    $temp_billing_ledger_table .= "<div class='pdf-head' style='padding-top: 8mm !important;'>";
                  }else{
                    $temp_billing_ledger_table .= "<div class='pdf-head'>";
                  }

                  $temp_billing_ledger_table .= "<div style='width: 40%;float: left;'>
                                                    <div style='font-size: 18px; padding-left: 30px;'>売掛残高一覧</div>
                                                      <div>年月={$date} 得意先CD={$information2_1_short}～{$information2_2_short}</div>
                                                    </div>
                                                    <div style='width: 20%;float: left;'>
                                                      <table>
                                                        <tbody>
                                                          <tr>
                                                            <td style='text-align:right'>PAGE $page_no</td>
                                                            <td style='text-align:right'>{$dateTime}</td>
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
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>CODE</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>得意先名</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>前月売掛残</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>当月売上額</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>売上値引等</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>当月消費税</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>現金振込</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>手形</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>入金値引他</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>当月売掛残</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>総債権残高</td>
                                                  <td style='text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;'>与信残額</td>
                                                </tr>";
                }
                  $temp_count++;     
                  

                  $temp_billing_ledger_table .= "<tr>
                                                    <td style='text-align: right;'>$value->sales_billing_cd</td> 
                                                    <td>$value->sales_billing_name</td> 
                                                    <td style='text-align: right;'>$value->prev_receivable_commafied</td> 
                                                    <td style='text-align: right;'>$value->net_sales_curr_month_commafied</td> 
                                                    <td style='text-align: right;'>$value->discount_commafied</td> 
                                                    <td style='text-align: right;'>$value->tax_curr_month_commafied</td> 
                                                    <td style='text-align: right;'>$value->cash_commafied</td>
                                                    <td style='text-align: right;'>$value->bills_commafied</td> 
                                                    <td style='text-align: right;'>$value->other_deposit_commafied</td> 
                                                    <td style='text-align: right;'>$value->rem_recievable_commafied</td>
                                                    <td style='text-align: right;'>$value->loan_balance_commafied</td>
                                                    <td style='text-align: right;'>$value->cred_balance_commafied</td>
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

              if($temp_count <= 29){
      
       
                   $temp_billing_ledger_table .= "<tr>
                                             <td style='text-align: right;'></td>
                                             <td>合計</td>
                                             <td style='text-align: right;'>{$total1303}</td>
                                             <td style='text-align: right;'>{$total1304}</td>
                                             <td style='text-align: right;'>{$total1305}</td>
                                             <td style='text-align: right;'>{$total1306}</td>
                                             <td style='text-align: right;'>{$total1307}</td>
                                             <td style='text-align: right;'>{$total1308}</td>
                                             <td style='text-align: right;'>{$total1309}</td>
                                             <td style='text-align: right;'>{$total1310}</td>
                                             <td style='text-align: right;'>{$total1311}</td>
                                             <td style='text-align: right;'></td>
                                                    </tr>";

                $temp_billing_ledger_table .= "</tbody>
                                                    </table>
                                                  </div>";
              }


              echo $temp_billing_ledger_table;
            ?>
    </div>
  </body>
</html>