 <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            サポート入力
          </div>
        </div>
      </div>
    </div>
  </div>
        
<div class="content-bottom-bottom">
          <div class="container">
            <div class="row mt-1">
              <div class="col-3">
                <table class="table custom-form custom-table" style="margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 140px !important;">
                        <div class="line-icon-box float-left mr-3"></div>引継希望日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker6_oen" name="datepicker6_oen" 
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-3">
                <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>初回訪問日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker7_oen" name="datepicker7_oen" 
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-3">
                <table class="table custom-form custom-table " style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 113px !important;">
                        <div class="line-icon-box float-left mr-3"></div>サポート納期

                      </td>
                      <td style="border: none!important;width: 151px;">
                        
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker11_oen" name="datepicker11_oen" 
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input type="hidden" class="datePickerHidden">
                          {{-- <input type="text" class="form-control " placeholder="" style="width: 96px!important;"> --}}
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col">
                <table class="table custom-form " style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>相談SE
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input type="text" name="consultation_person_name" id="consultation_person_name" class="form-control" placeholder="" style="width: 96px!important;" maxlength="40"> 
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
          
            </div>
            <div class="row">
              <div class="col-6">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 130px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>納入場所
                        </div>
                      </td>
                      <td style=" border: none!important;width: 443px;">
                        <input type="text" class="form-control" id="include_place" name="include_place" placeholder="" style="padding: 0!important;" maxlength="40">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>機種名
                        </div>
                      </td>
                      <td style=" border: none!important;width: 443px;">
                        <input type="text" class="form-control" id="model_name" name="model_name" placeholder="" style="padding: 0!important;" maxlength="40">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 130px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>業務名
                        </div>
                      </td>
                      <td style=" border: none!important;width: 443px;">
                        <input type="text" name="juchukubun1_business_name" id="juchukubun1_business_name" class="form-control" placeholder="" style="padding: 0!important;" maxlength="40">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>OS
                        </div>
                      </td>
                      <td style=" border: none!important;width: 443px;">
                        <input type="text" class="form-control" id="os" name="os" placeholder="" style="padding: 0!important;" maxlength="40">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 11% !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>社内備考
                        </div>
                      </td>
                      <td style=" border: none!important;">
                        <input type="text" name="information7_in_house_remarks" id="information7_in_house_remarks" class="form-control" maxlength="40" placeholder="社内備考（全角４０文字まで）"
                          style="padding: 0!important;">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 11% !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>発注出荷備考
                        </div>
                      </td>
                      <td style=" border: none!important;">
                        <input type="text" name="order_shipping_remarks_209" id="order_shipping_remarks_209" class="form-control" maxlength="60" placeholder="発注出荷備考（全角６０文字まで）"
                          style="padding: 0!important;">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 11% !important;">

                        <div class="line-icon-box float-left mr-3"></div>受注概要や留意点

                      </td>
                    </tr>
                    <tr>
                      <td style=" border: none!important;"></td>
                      <td style=" border: none!important;">
                        <textarea name="order_summary_remarks" id="order_summary_remarks" class="largeDesc" maxlength="1036" placeholder="６０文字×１７行、改行有" style="width: 100%;border-radius:4px !important;min-height: 312px;max-height: 312px;resize: none;"></textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr style="background: white;height:4px;">
            <div class="row">
              <div class="col">
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 128px !important;">
                        <div class="line-icon-box float-left mr-3"></div>営業マスタプラン
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <span>基本設計終了</span>
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <span>セットアップ開始</span>
                    
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <span>本稼働開始</span>
                      </td>
                    </tr>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 128px !important;">
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker8_oen" name="datepicker8_oen" 
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker9_oen" name="datepicker9_oen" 
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                      <td style="border: none!important;width: 151px;text-align:center">
                        <div class="input-group">
                          <input type="text" class="form-control" id="datepicker10_oen" name="datepicker10_oen" 
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-5">
                <table class="table custom-form" style="margin-bottom: 0px!important;width: 534px;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border:none !important;width: 64px!important;">
                        <div class="line-icon-box float-left mr-3"></div>検収条件
                      </td>
                      <td style=" border: none!important;width: 198px;">
                        <div class="custom-arrow">
                           <select class="form-control" name="chumonsyajouhou_214" id="chumonsyajouhou_214" autofocus>
                                  @foreach ($u2Data214 as $request)
                                  <option value="{{$request->category1}}{{$request->category2}}">
                                      {{ $request->category4 }}
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
              <div class="col-12">
                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td style=" border: none!important;width:128px !important;"></td>
                      <td style=" border: none!important;">
                        <textarea class="form-control largeDesc" id="acceptance_condition" name="acceptance_condition" maxlength="182" placeholder="６０文字×３行、改行有" style="padding: 0;min-height: 74px;max-height: 74px;resize: none;"></textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <table class="table custom-form" style="margin-bottom: 0px!important;width: 427px;" id="tbl-supplier">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 106px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>サポート部門
                        </div>
                      </td>
                      <td style=" border: none!important;width: 235px;">
                        <div class="custom-arrow">
                            <select class="form-control" name="datatxt0004_216" id="datatxt0004_216" autofocus>
                                    @foreach ($c1Data216 as $request)
                                    <option value="{{$request->category1}}{{$request->category2}}">
                                        {{ $request->category4 }}
                                    </option>
                                    @endforeach
                            </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-4"></div>
              <div class="col-4">
                <table class="custom-form " style="float: right; margin-top: 3px;">
                  <tbody>
                    <tr>
                      <td style=" border: none!important;width: 193px !important;">
                        <div class="custom-select-file-upload input-group input-group-sm">
                          <div class="custom-file-area">
                            <div class="input-group input-group-sm">
                              <input type="hidden" name="lbook_file_input" id="lbook_file_input">
                              <input type="hidden" name="hidden_lbook_kokyakuorderbango" id="hidden_lbook_kokyakuorderbango">
                              <input type="file" class="custom-file-input" id="proposal_file" name="proposal_file" accept=".pdf, .zip" >
                              <label class="custom-file-label c_hover" for="proposal_file" style="cursor: pointer;width: 156px;margin-right: -2px;background: #4D82C6;color: #fff!important; border: 1px solid #4D82C6;overflow: hidden;font-size: 13px;">提案書アップロード
                              </label>
                              <div class="input-group-append">
                                <button id="fileUploadClose" class="input-group-text btn fileUploadClose" style="padding: 0px 10px !important;cursor: pointer!important;"><i class="fa fa-times" aria-hidden="true"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row mt-3">
              <div class=" ml-auto">
                <div class="form-button text-right" style="margin-right:15px;padding:8px;">
                  <button type="button" class="btn btn-sm btn-primary supportEntrySubmitBtn uskc-button" id="supportEntrySubmitBtn">登録</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </form>