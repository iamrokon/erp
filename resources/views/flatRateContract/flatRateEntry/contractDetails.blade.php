<div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <!-- <div class="bottom-top-btn" style="cursor: pointer;">
            <span onclick="contentHideShow()" id="closetopcontent">閉じる</span>
          </div> -->

          <div class="bottom-top-title" style="margin: 10px 10px; ">
          契約内容入力
          </div>
        </div>
      </div>

    </div>
</div>

<div class="content-head-section">
    <div class="container">

      <div class="row order_entry_topcontent">
        <div class="col">

          <div class="content-head-bottom">
            <div class="row">
              <div class="col-6">
                <table class="table custom-form custom-table" style="border: none!important;width: 100% !important;">
                    <tbody>
                      <tr>
                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                          <div class="line-icon-box"></div>
                        </td>
                        <td style=" border: none!important;width: 65px!important;">商品CD</td>
                        <td style=" border: none!important; width: 25%!important;">
                          <div style="">
                            <div class="input-group input-group-sm position-relative" id="kawasename_input_group">
                                <input name="kawasename" id="reg_kawasename" readonly type="text" class="form-control" placeholder="" style="">
                              <div class="input-group-append">
                                  <button id="productButton" disabled onclick="openProductModal();event.preventDefault();" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td style="border: none !important;">
                          <div class="input-group">
                              <input name="syouhinname" id='reg_syouhinname' type="text" class="form-control productName" value="">
                            <div class="input-group-append" style="background: #2c66b1;border-radius: 4px;">
                              <a href="#" class="btn rounded viewProductDes" style="border-radius:4px !important;display:flex;align-items:center;justify-content:center; color: #fff;"><i class="fa fa-clone" aria-hidden="true"></i></a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-2">
                <table class="table custom-form custom-table">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">数量</td>
                      <td style="border: none!important;">
                          <input name="syukkasu" id="reg_syukkasu" value="1" type="text" class="form-control" placeholder="" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="7">
                         <!-- onblur="callforComma(this)" onfocus="callToRemoveComma(this)" -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
               <div class="col-2">
                 <table class="table custom-form custom-table">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">単価</td>
                      <td style="border: none!important;">
                          <input name="money1" id="reg_money1" onchange="grossOperatingProfit()" type="text" class="form-control" placeholder="" maxlength="11">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-2">
                 <table class="table custom-form">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">契約金額</td>
                      <td style="border: none!important;">
                          <input name="money2" id="reg_money2" type="text" value="0" class="form-control" placeholder="" readonly="">
                          <input name="money3" id="reg_money3" type="hidden" />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-5">
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                    <tbody>
                      <tr>
                        <td style="border: none!important;text-align: left;width: 89px !important;padding:0px !important;">
                          <div class="line-icon-box float-left"></div>契約期間
                        </td>
                          <td style="border: none!important;width: 151px;">
                          <div class="input-group">
                              <input name="date0002" type="text" class="form-control" id="datepicker1_oen" onchange="getContractPeriodEndDate();"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10"
                                autocomplete="off" placeholder="年/月/日"
                                style="width: 96px!important;" value=""
                              >
                              <input type="hidden" class="datePickerHidden">
                          </div>
                          </td>
                          <td style="border: none!important;">
                            <div class="input-group">
                                <input name="numeric8" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/^0+/, '');" maxlength="2" id="reg_numeric8" type="text" class="form-control input_field" value="" placeholder="" style="width: 60px!important;">
                            </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                                <input name="date0003" id="reg_date0003" type="text" class="form-control input_field" readonly="" value=""
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10"
                                autocomplete="off" placeholder="年/月/日"
                                style="width: 96px!important;pointer-events: none;">
                                <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                      </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-2">
                 <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">自動継続</td>
                      <td style=" border: none!important;width: 54%;">
                        <div class="custom-arrow">
                            <select name="datachar26" id="reg_datachar26" class="form-control" autofocus="">
                                @foreach($datachar26 as $dtchar26)
                                    <option value="{{$dtchar26->syouhinbango}}" @if($dtchar26->syouhinbango == 2) selected @endif>
                                      {{$dtchar26->syouhinbango.' '}}{{$dtchar26->jouhou}}
                                    </option>
                                @endforeach
                          </select>
                        </div>
                      </td>

                    </tr>
                  </tbody>
                </table>
              </div>
               <div class="col-5">
                 <table class="table custom-form" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                    </td>
                      <td style=" border: none!important;width: 53px!important;">保守条件</td>
                      <td style=" border: none!important;width: 54% !important;">
                        <div class="input-group input-group-sm" style="cursor: pointer;">
                          <button id="igroup1" disabled onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:115px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                          保守条件
                          </button>
                          <div class="input-group-append">
                            <button onclick="maintenanceConditionsModalOpener();event.preventDefault();" id="maintenanceButton" type="button" class="input-group-text btn" onkeydown="focusNextInput(event);"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </td>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">SE</td>
                      <td style=" border: none!important;width: 86%;">
                        <div class="custom-arrow">
                            <select name="datachar02" id="reg_datachar02" disabled class="form-control" autofocus="">
                                <option value="">-</option>
                                @foreach($datachar02Info as $dtchar02Info)
                                    <option value="{{$dtchar02Info->bango}}">
                                      {{$dtchar02Info->name}}
                                    </option>
                                @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                  <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 65px!important;">無償期間</td>
                      <td style=" border: none!important;">
                          <input name="numeric9" id="reg_numeric9" value="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="2" type="text" class="form-control" placeholder="" maxlength="40">
                      </td>
                      <td style=" border: none!important;">ヶ月</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-2">
                  <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">請求サイクル</td>
                      <td style=" border: none!important;width: 86%;">
                          <div class="custom-arrow">
                              <select name="numeric10" id="reg_numeric10" class="form-control" autofocus="">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-3">
                  <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">請求月度</td>
                      <td style=" border: none!important;width: 86%;">
                          <div class="custom-arrow" style="width: 100%">
                            <select name="datatxt0121" id='reg_datatxt0121' class="form-control" autofocus="">
                                @foreach($datatxt0121Data as $dttxt0121Data)
                                    <option value="{{$dttxt0121Data->category2}}" @if($dttxt0121Data->category2 == 10) selected @endif>
                                      {{$dttxt0121Data->category2." ".$dttxt0121Data->category4}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-5">
                  <table class="table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">伝票統合</td>
                      <td class="border-line-area" style="border: none!important;width: 32%;">
                          <input name="datatxt0125" id="reg_datatxt0125" oninput="this.value = this.value.replace(/ /g,'')" maxlength="2" type="text" class="form-control" placeholder="" style="width: 100px;">
                      </td>

                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                    </td>
                      <td style=" border: none!important;width: 53px!important;">発注出荷</td>
                      <td style=" border: none!important;width: 45%;">
                        <div class="input-group input-group-sm" style="cursor: pointer;">
                            <button id="igroup1" disabled onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:115px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                          発注出荷
                          </button>
                          <div class="input-group-append">
                              <button onclick="orderShippingModalOpener();event.preventDefault();" id="orderShippingButton" type="button" class="input-group-text btn" ><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-5">
     new

              </div>
              <div class="col-2">
                new
              </div>
               <div class="col-2">


            new
              </div>
               <div class="col-1">
              </div>
              <div class="col-2">
                <button style="width: 99%;" type="button" class="btn btn-sm btn-info">分割</button>
              </div>
            </div> -->
            <div class="row">
            <div class="col-5">
            <div class="row">
            <div class="col-12">
            <table class="table custom-form custom-table-2" style="width: auto;margin-bottom: 2px!important;">
                    <tbody>
                      <tr>
                        <td style="border: none!important;text-align: left;width: 90px !important;padding: 0px !important;">
                          <div class="line-icon-box float-left"></div>有償期間
                        </td>
                          <td style="border: none!important;width: 151px;">
                          <div class="input-group">
                              <input name="date0004" type="text" readonly class="form-control" id="datepicker2_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                           maxlength="8"
                                           autocomplete="off" placeholder="年/月/日"
                                           style="width: 96px!important;" value="">
                                    <input type="hidden" class="datePickerHidden">
                                </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                          <div class="input-group">
                              <input name="date0005" type="text" readonly class="form-control" id="datepicker3_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                           maxlength="8"
                                           autocomplete="off" placeholder="年/月/日"
                                           style="width: 96px!important;" value="">
                                    <input type="hidden" class="datePickerHidden">
                                </div>
                          </td>
                      </tr>
                    </tbody>
                </table>

            </div>
            </div>
            <div class="row">
            <div class="col-6">
            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 65px!important;">計上日</td>
                      <td style=" border: none!important;width: 61%;">
                        <div class="custom-arrow">
                            <select name="numeric1" id="reg_numeric1" class="form-control" autofocus="">
                              @for($i=1;$i<=30;$i++)
                              <option value="{{$i}}">{{$i}}</option>
                              @endfor
                              <option value="31">末日</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
              <div class="col-6">

              <table class="table custom-form" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 46%;">自動売上</td>
                      <td style=" border: none!important;width: 41%;">
                        <div class="custom-arrow">
                            <select name="datachar27" id="reg_datachar27" class="form-control" autofocus="">
                              <option value="1">1 有</option>
                              <option value="2">2 無</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              </div>
              </div>
              <div class="col">
                <table class="table custom-form custom-table-2" style="border: none!important;width: auto;">
                  <tbody>
                  <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 77px!important;">伝票備考</td>
                      <td style=" border: none!important;width: 83%;">
                          <input type="text" name="datatxt0119" id="reg_datatxt0119" class="form-control" placeholder="（伝票備考）全角40文字まで" maxlength="40">
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">社内備考</td>
                      <td style=" border: none!important;width: 86%;">
                          <input name="datatxt0118" id="reg_datatxt0118" type="text" class="form-control" placeholder="（社内備考）全角40文字まで"  maxlength="40">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-2">

              <button onclick="addProductLine();event.preventDefault();" id="splitButton" disabled style="width: 162px;float: right;height:62px;" type="button" class="btn btn-sm btn-warning">分割</button>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <div style="border-top:1px solid #E1E1E1;margin-bottom: 10px;"></div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 65px!important;">営業粗利</td>
                      <td style="border: none!important;">
                          <input name="money4" id='reg_money4' type="text" readonly class="form-control" placeholder="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col">
                <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">SE</td>
                      <td style="border: none!important;">
                          <input id='db_money5' type="hidden"/>
                          <input name="money5" id='reg_money5' type="text" class="form-control" placeholder="" maxlength="11">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col">
                <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">研究所</td>
                      <td style="border: none!important;">
                          <input id='db_money6' type="hidden"/>
                          <input name="money6" id='reg_money6' type="text" class="form-control" placeholder="" maxlength="11">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col">
                <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">出荷C</td>
                      <td style="border: none!important;">
                          <input id='db_money7' type="hidden"/>
                          <input name="money7" id='reg_money7' type="text" class="form-control" placeholder="" maxlength="11">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col">
                <table class="table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">仕入金額</td>
                      <td style="border: none!important;">
                          <input id='db_money8' type="hidden"/>
                          <input name="money8" id="reg_money8" type="text" class="form-control" placeholder="" maxlength="11">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col">
                  <button onclick="registerFlatRate();event.preventDefault();" id="regButton" disabled style="width: 162px;float: right;" type="button" class="btn btn-sm btn-info">登録</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>