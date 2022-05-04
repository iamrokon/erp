<div class="content-bottom-section bottom-top-100" style="padding-bottom:46px;">
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
                    <input type="text" value='@if(isset($supportInquiryData->deletedate)){{$supportInquiryData->deletedate}}@endif' class="form-control" id="datepicker6_oen" readonly=""
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
                    <input type="text" value='@if(isset($supportInquiryData->date0012)){{$supportInquiryData->date0012}}@endif' class="form-control" id="datepicker7_oen" readonly=""
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
                    <input type="text" value='@if(isset($supportInquiryData->date0020)){{$supportInquiryData->date0020}}@endif' class="form-control" id="datepicker11_oen" readonly=""
                    maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                  <input type="hidden" class="datePickerHidden">
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
                    <input type="text" value='@if(isset($supportInquiryData->datachar12)){{$supportInquiryData->datachar12}}@endif' class="form-control " placeholder="" style="width: 96px!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->datatxt0157)){{$supportInquiryData->datatxt0157}}@endif' class="form-control" placeholder="" style="padding: 0!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->datachar14)){{$supportInquiryData->datachar14}}@endif' class="form-control" placeholder="" style="padding: 0!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->datachar13)){{$supportInquiryData->datachar13}}@endif' class="form-control" placeholder="" style="padding: 0!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->datachar15)){{$supportInquiryData->datachar15}}@endif' class="form-control" placeholder="" style="padding: 0!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->minyuko_datachar11)){{$supportInquiryData->minyuko_datachar11}}@endif' class="form-control" maxlength="40" placeholder="社内備考（全角４０文字まで）"
                    style="padding: 0!important;" readonly="">
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
                  <input type="text" value='@if(isset($supportInquiryData->minyuko_datachar09)){{$supportInquiryData->minyuko_datachar09}}@endif' class="form-control" maxlength="60" placeholder="発注出荷備考（全角６０文字まで）"
                    style="padding: 0!important;" readonly="">
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
                  <textarea  name="" id="" class="form-control largeDesc" maxlength="1036" placeholder="６０文字×１７行、改行有"
                    style="width: 100%;border:1px solid #E1E1E1 !important;border-radius:4px !important;min-height: 312px;max-height: 312px;" readonly="">@if(isset($supportInquiryData->datatxt0147)){{$supportInquiryData->datatxt0147}}@endif</textarea>
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
                <td style="border: none!important;text-align: left;color: black;width: 145px !important;">
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
                    <input type="text" value='@if(isset($supportInquiryData->date0013)){{$supportInquiryData->date0013}}@endif' class="form-control" id="datepicker8_oen" readonly=""
                      maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                    <input type="hidden" class="datePickerHidden">
                  </div>
                </td>
                <td style="border: none!important;width: 151px;text-align:center">
                  <div class="input-group">
                    <input type="text" value='@if(isset($supportInquiryData->date0014)){{$supportInquiryData->date0014}}@endif' class="form-control" id="datepicker9_oen" readonly=""
                      maxlength="10" autocomplete="off" placeholder="年/月/日" value="">
                    <input type="hidden" class="datePickerHidden">
                  </div>
                </td>
                <td style="border: none!important;width: 151px;text-align:center">
                  <div class="input-group">
                    <input type="text" value='@if(isset($supportInquiryData->date0015)){{$supportInquiryData->date0015}}@endif' class="form-control" id="datepicker10_oen" readonly=""
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
                <td class="text-render" style="border:none !important;width: 77px!important;">
                  <div class="line-icon-box float-left mr-3"></div>検収条件
                </td>
                <td style=" border: none!important;width: 205px;">
                  <div class="custom-arrow">
                    <input type="text" value='@if(isset($supportInquiryData->chumonsyajouhou_detail)){{$supportInquiryData->chumonsyajouhou_detail}}@endif' class="form-control" placeholder="" readonly=""
                            style="padding: 0!important;">
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
                <td style=" border: none!important;width:145px !important;"></td>
                <td style=" border: none!important;">
                  <textarea name="" class="form-control largeDesc" maxlength="182" placeholder="６０文字×３行、改行有" style="padding: 0;min-height: 74px;max-height: 74px;" readonly="">@if(isset($supportInquiryData->datatxt0148)){{$supportInquiryData->datatxt0148}}@endif</textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>


    </div>
  </div>
  <div class="content-bottom-bottom2">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <table class="table custom-form" style="margin-bottom: 0px!important;width: 536px;" id="tbl-supplier">
            <tbody>
              <tr>
                <td class="text-render" style="border: none!important;color: black;width: 83px !important;">
                  <div style="width: 79px;">
                    <div class="line-icon-box float-left mr-3"></div>サポート部門
                  </div>
                </td>
                <td style=" border: none!important;width: 220px;">
                  <div class="custom-arrow">
                    <input type="text" value='@if(isset($supportInquiryData->datatxt0149)){{$supportInquiryData->datatxt0149_detail}}@endif' class="form-control" placeholder="" readonly=""
                            style="padding: 0!important;">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-2"></div>
        <div class="col-4">
          <table class="custom-form " style="float: right;margin-top:3px;">
            <tbody>
              <tr>
                <td style=" border: none!important;width: 193px !important;">
                  <div class="custom-select-file-upload input-group input-group-sm">
                    <div class="custom-file-area">
                      <div class="input-group input-group-sm">
                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                        <label class="custom-file-label c_hover" for="customFile" style="pointer-events:none;cursor: pointer;width: 156px;margin-right: -2px;background: #4D82C6;color: #fff!important; border: 1px solid #4D82C6;overflow: hidden;font-size: 13px;">@if(isset($supportInquiryData->datachar09_short)){{$supportInquiryData->datachar09_short}} @else {{''}} @endif
                        </label>
                        <div class="input-group-append">
                          <button class="input-group-text btn" style="padding: 0px 10px !important;cursor: pointer!important;"><i class="fa fa-times" aria-hidden="true"></i></button>
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
    </div>
  </div>

</div>
