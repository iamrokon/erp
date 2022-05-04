<div class="content-bottom-section" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            支払予定明細一覧
          </div>
        </div>
      </div>
    </div>
    <div class="content-bottom-pagination">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:73px;padding: 10px;">
               <!-- new pagination row starts here -->
               @include('purchase.paymentScheduleRegistration.pagination')
               <!----------pagination End----------------->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-bottom-bottom" style="margin-top: 10px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div class="table-responsive largeTable">
              <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                    <th scope="col" class="signbtn"> <span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">行</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入購入区分</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入日</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">納品書番号</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">品名</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">数</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">単価</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">金額</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">消費税額</span>
                    </th>
                    <th scope="col" class="signbtn"><span
                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;color: #fff;">税込金額</span>
                    </th>
                  </tr>
                </thead>
                <tbody id="pay_schedule_registration_id">
                  <!-- 2nd row -->
                  @foreach ($categorykanries_2 as $key => $value)
                    <tr>
                    <td class="text-right">{{ $key + 1 }}</td>
                    <td>{{ $value->category1 . $value->category2 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                  </tr>
                  @endforeach 

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>