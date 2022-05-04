<form id="mainForm" action="{{ route('salesCancellation') }}" method="post">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input id='submit_confirmation' value='' type='hidden'/>
    @csrf
    <div class="row sales-concellation-top">
            <div class="col-12">
                    <div class="row" style="padding-top: 0px;">
                      <div class="col-3">
                            <table class="table custom-form" style="border: none!important;width: auto;margin-bottom: 2px!important;">
                              <tbody>
                                    <tr>
                                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                      </td>
                                      <td style=" border: none!important;width: 88px!important;">売上番号</td>
                                      <td style=" border: none!important;width: 178px;">
                                          <input name="datachar10" id="sales_number" autofocus="" type="text" class="form-control" autocomplete="off" value="" placeholder="" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');">
                                      </td>
                                    </tr>
                              </tbody>
                            </table>
                      </div>
                      <div class="col-3">
                            <table class="table custom-form" style="border: none!important;margin-bottom: 2px!important;">
                              <tbody>
                                    <tr>
                                      <td style=" border: none!important;">
                                          <input name="information1" id="information1" type="text" class="form-control" autocomplete="off" value="" placeholder="受注先" readonly>
                                      </td>
                                    </tr>
                              </tbody>
                            </table>
                      </div>
                      <div class="col-3">
                            <table class="table custom-form" style="border: none!important;margin-bottom: 2px!important;">
                              <tbody>
                                    <tr>
                                      <td style=" border: none!important;">
                                            <input name="information2" id="information2" type="text" class="form-control" autocomplete="off" value="" placeholder="売上請求先" readonly >
                                            <input name="information2_db" id="information2_db" type="hidden" readonly >
                                      </td>
                                    </tr>
                              </tbody>
                            </table>
                      </div>
              </div>
              <div class="row" style="padding-top: 0px;">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                      <table class="table custom-form" style="border: none!important;margin-bottom: 2px !important;">
                            <tbody>
                              <tr>
                                    <td style=" border: none!important;">
                                        <input name="juchukubun1" id="juchukubun1" type="text" class="form-control" autocomplete="off" value="" placeholder="受注件名" readonly>
                                    </td>
                              </tr>
                            </tbody>
                      </table>
                    </div>
                    <div class="col-2">
                      <table class="table custom-form" style="border: none!important;margin-bottom: 2px !important;">
                            <tbody>
                              <tr>
                                    <td style=" border: none!important;">
                                      <input name="money10" id="money10" type="text" class="form-control text-right" autocomplete="off" value="" placeholder="受注金額" readonly >
                                    </td>
                              </tr>
                            </tbody>
                      </table>
                    </div>
              </div>
              <div class="row" style="padding-top: 0px;">
                    <div class="col-3">

                    </div>
                    <div class="col-6">
                      <table class="table custom-form" style="border: none!important;margin-bottom: 2px !important;">
                            <tbody>
                              <tr>
                                    <td style=" border: none!important;">
                                      <input name="information8" id="information8" type="text" class="form-control" autocomplete="off" value="" placeholder="伝票備考" >
                                    </td>
                              </tr>
                            </tbody>
                      </table>
                    </div>

              </div>
              <div class="row" style="padding-top: 0px;">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                      <table class="table custom-form" style="border: none!important;">
                            <tbody>
                              <tr>
                                    <td style=" border: none!important;">
                                      <input name="information7" id="information7" type="text" class="form-control" autocomplete="off" value="" placeholder="社内備考" >
                                    </td>
                              </tr>
                            </tbody>
                      </table>
                    </div>
              </div>
              <div class="row">
                    <div class="ml-3 mr-3">
                      <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                            <tbody>
                              <tr>
                                    <td style="border: none!important;text-align: left;color: black;width: 113px !important;">
                                      <div class="line-icon-box float-left mr-3"></div>
                                      取消日
                                    </td>
                                    <td style="border: none!important;width: 178px;">
                                      <!-- <div class="input-group">
                                            <input id="datepicker2_oen" autocomplete="off" type="text" class="form-control input_field" value="" placeholder="年/月/日" style="width: 96px!important;">
                                      </div> -->
                                      <div class="input-group">
                                         <input name="date0009" type="text" class="form-control" id="datepicker1_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                            maxlength="10"
                                                            autocomplete="off" placeholder="年/月/日"
                                                            style="width: 96px!important;" value="{{$orderbango}}">
                                                 <input type="hidden" class="datePickerHidden" value="{{$orderbango}}">
                                            <input type="hidden" id="start_date" value="{{$start_date}}">
                                            <input type="hidden" id="end_date" value="{{$end_date}}">
                                         </div>
                                    </td>
                              </tr>
                            </tbody>
                      </table>
                    </div>
              </div>
              <div class="row">
                    <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                      <div>
                            <button id="salesCancellation" onclick="registerSalesCancellation('{{route('salesCancellation')}}',event.preventDefault())" type="submit" href="#" class="btn btn-info uskc-button">実 行
                            </button>
                      </div>
                      <div class="loading-icon" style="">
                            <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </div>
              </div>
            </div>
      </div>
</form>