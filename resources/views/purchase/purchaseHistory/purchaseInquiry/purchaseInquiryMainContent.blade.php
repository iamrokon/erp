<div class="content-bottom-section" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          明細
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-bottom-bottom">
    <div class="container">
      <div class="row">
       <div class="col-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
            <div class="table-responsive largeTable">
             <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
              style="margin-bottom: 20px!important;">
              <thead class="thead-dark header text-center" id="myHeader">
                <tr>
                  <th scope="col" class="signbtn"> <span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">発注番号行番号</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">品番</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">品名</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">数量</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">消費税</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">課税</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">会計科目</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">会計科目内訳</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">受注先</span>
                  </th>
                  <th scope="col" class="signbtn"><span
                      style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">明細備考</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <!-- 2nd row -->
                @foreach($purchaseHistoryInquiryInfos as $purchaseHistoryInquiryInfo)
                    <tr>
                  <td class="text-right">{{$purchaseHistoryInquiryInfo->line_no}}</td>
                  <td> {{$purchaseHistoryInquiryInfo->order_number_line}}</td>
                  <td>
                    <div style="width: 175px !important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control" placeholder="" readonly="" style="width: 127px!important;padding: 0!important;" value="{{$purchaseHistoryInquiryInfos[0]->part_no}}">
                        </div>
                    </div>
                 </td>
                  <td>{{$purchaseHistoryInquiryInfo->part_name}}</td>
                  <td class="text-right">{{$purchaseHistoryInquiryInfo->quantity}} </td>
                  <td class="text-right">{{$purchaseHistoryInquiryInfo->unite_price}} </td>
                  <td class="text-right">{{$purchaseHistoryInquiryInfo->amount}}</td>
                  <td class="text-right">{{$purchaseHistoryInquiryInfo->consumption_tax}}</td>
                  <td>
                      {{$purchaseHistoryInquiryInfo->taxation}}

                  </td>
                  <td>{{$purchaseHistoryInquiryInfo->accounting}}</td>
                  <td>{{$purchaseHistoryInquiryInfo->breakdown}}</td>
                  <td>{{$purchaseHistoryInquiryInfo->order_to2}}</td>
                  <td>{{$purchaseHistoryInquiryInfo->remarks}}</td>

                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="ml-3 mr-3 d-flex  w-100 justify-content-end" style="background-color: #fff;">
      <div  class="mt-2">
        <table class="table custom-form" style="border: none!important;width:auto;">
        <tbody>
          <tr style="height: 28px;">
            <td style="width: 23px!important;padding: 0!important;border:0!important;">
              <div class="line-icon-box"></div>
            </td>
            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                (明細)合計</td>
            <td style=" border: none!important;width: 65%;color: #000;font-weight: bold;font-size: 0.9em;">¥
              {{$purchaseHistoryInquiryInfos[0]->amount_total}}</td>
          </tr>
        </tbody>
        </table>
      </div>
      <div  class="mt-2">
        <table class="table custom-form" style="border: none!important;width:auto;">
        <tbody>
          <tr style="height: 28px;">
            <td style="width: 23px!important;padding: 0!important;border:0!important;">
              <div class="line-icon-box"></div>
            </td>
            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;padding-right: 8px!important;">
                (明細)消費税</td>
           <!-- <td style=" border: none!important;width: 15px!important;"></td> -->
            <td style=" border: none!important;width: 65%;color: #000;font-weight: bold;font-size: 0.9em;">¥
              {{$purchaseHistoryInquiryInfos[0]->consumption_tax_total}}</td>
          </tr>
        </tbody>
        </table>
      </div>
      <div  class="mt-2">
        <table class="table custom-form" style="border: none!important;width:auto;">
        <tbody>
          <tr style="height: 28px;">
            <td style="width: 23px!important;padding: 0!important;border:0!important;">
              <div class="line-icon-box"></div>
            </td>
            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;padding-right: 8px!important;">
                (明細)税込合計</td>
            <td style=" border: none!important;width: 65%;color: #000;font-weight: bold;font-size: 0.9em;">¥
              {{$purchaseHistoryInquiryInfos[0]->total_including_tax}}</td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>

    </div>

    <div class="content-head-bottom">
    <div class="row mt-2">
            <div class="col-8">
              <table class="table custom-form" style="border: none!important;width: 100%;margin-bottom: 4px!important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 54px!important;">伝票備考</td>
                    <td style=" border: none!important;">
                    <input type="text" class="form-control" maxlength="40" readonly placeholder="伝票備考（全角４０文字まで）" value="{{$purchaseHistoryInquiryInfos[0]->voucher_remarks}}">
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
