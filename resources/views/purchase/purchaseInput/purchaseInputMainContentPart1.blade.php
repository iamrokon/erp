<div class="content-bottom-section main-content backlog-order-section" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            発注残
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
              <table id="backlogOrderTable" class="table table-bordered table-fill table-striped"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">品番</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">品名</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">数量</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">発注番号行番号</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">仕入予定日</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">受注先</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">最終顧客</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">仮引</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- 2nd row -->
                  @if(isset($data))
                  @php
                  $sum = 0;
                  $rowId = 1;
                  function numberFormat($value)
                  {
                    return gettype($value) == 'double' ? number_format($value, 2) : number_format($value);
                  }
                  @endphp
                  @foreach($data as $key=>$val)
                  <tr id = "row{{$rowId}}">
                    <td>{{ $val->datachar02 }}</td>
                    <td>{{ $val->datachar08 }}</td>
                    <td class="text-right">{{ gettype($val->nyukosu) == 'double ' ? number_format($val->nyukosu, 2) : number_format($val->nyukosu)}}</td>
                    <td class="text-right">{{ gettype($val->genka) == 'double ' ? number_format($val->genka, 2) : number_format($val->genka)}} </td>
                    <td class="text-right">{{ gettype($val->syouhizeiritu) == 'double ' ? number_format($val->syouhizeiritu, 2) : number_format($val->syouhizeiritu)}}</td>
                    <td>{{ $val->data206}}</td>
                    <td>{{ $val->yoteibi}}</td>
                    <td>{{ $val->reg_sold_to}}</td>
                    <td>{{ $val->reg_end_customer}}</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-info table-row-select">仮引</button>
                      <input type="hidden" name="addedRowNumberOfDetailsTable[]" id="addedRowNumberOfDetailsTable{{$rowId}}" class="addedRowNumberOfDetailsTable">
                    </td>
                  </tr>
                  @php
                    $rowId++;
                    $sum += $val->syouhizeiritu; 
                  @endphp
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="ml-3 mr-3 d-flex  w-100 justify-content-end" style="background-color: #fff;">
          <div>
            <table class="table custom-form" style="border: none!important;width:auto;">
              <tbody>
                <tr style="height: 28px;">
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td
                    style=" border: none!important;width: 40px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                    合計</td>
                  <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
                    ¥{{isset($sum) ? number_format($sum) : 0 }}</td>
                  <td style=" border: none!important;width: 5px!important;"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

