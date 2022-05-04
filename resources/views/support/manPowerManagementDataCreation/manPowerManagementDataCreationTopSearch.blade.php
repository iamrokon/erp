<form id="mainForm" action="{{ route('manPowerManagementDataCreationCSVProcess') }}" method="post">
  <input type="hidden" id="userId" name="userId" value="{{ $bango }}">
  <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
  <input type="hidden" id="submit_confirmation" value="" name="submit_confirmation">
  <div class="row man_power-top-content">
    <div class="col">
      <div class="content-head-top ">

        <div class="row" style="padding-top: 0px;">
          <div class="col-4">
            <table class="table custom-form"
              style="border: none!important;width: auto;margin-bottom: 2px !important;">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;width: 88px!important;">データ区分</td>
                  <td style="border: none!important;width: 178px;">
                    <div class="custom-arrow">
                      <select class="form-control" name="man_power_management_data_creation_101" autofocus id="man_power_management_data_creation_101">
                        <!--  <option value="1">1 受注データ</option> 
                         <option value="2">2 受注データ</option> --> 
                          @foreach ($request_101 as $request)
                            <option value="{{ $request->syouhinbango}}">
                                {{ $request->syouhinbango . ' ' . $request->jouhou }}
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
        <div class="row" style="padding-top: 0px;">
          <div class="col-4">
            <table class="table custom-form"
              style="border: none!important;width: auto;margin-bottom: 2px !important;">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style="border: none!important;width: 88px!important;">出力区分</td>
                  <td style="border: none!important;width: 178px;">
                    <div class="custom-arrow">
                      <select class="form-control" name="man_power_management_data_creation_102" autofocus id="man_power_management_data_creation_102">
                        <!-- <option value="">1 未出力</option> -->
                        @foreach ($request_102 as $request)
                          <option value="{{ $request->syouhinbango}}">
                              {{ $request->syouhinbango . ' ' . $request->jouhou }}
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
          <div class="ml-3 mr-3">
            <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
              <tbody>
                <tr>
                  <td
                    style="padding-left: 0px !important;border: none!important;text-align: left;color: black;width: 112px !important;">
                    <div class="line-icon-box float-left" style="margin-right: 14px;"></div>
                    入力日付
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_103_1" id="man_power_management_data_creation_103_1" class="form-control datePicker datePicker1_1"
                        autocomplete="off" value="<?= date('Y/m/d') ?>" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10" autofocus>
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                  <td
                    style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                    ～
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_103_2" id="man_power_management_data_creation_103_2" class="form-control datePicker datePicker1_2"
                        autocomplete="off" value="<?= date('Y/m/d') ?>" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10" autofocus>
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
              <tbody>
                <tr>
                  <td
                    style="padding-left: 0px !important;border: none!important;text-align: left;color: black;width: 112px !important;">
                    <div class="line-icon-box float-left" style="margin-right: 14px;"></div>
                    受注番号
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_104_1" id="man_power_management_data_creation_104_1" class="form-control" placeholder="0000000000">
                    </div>
                  </td>
                  <td
                    style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                    ～
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_104_2" id="man_power_management_data_creation_104_2" class="form-control" placeholder="9999999999">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mt-3 mb-3">
          <div class="ml-3 mr-3">
            <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
              <tbody>
                <tr>
                  <td
                    style="padding-left: 0px !important;border: none!important;text-align: left;color: black;width: 112px !important;">
                    <div class="line-icon-box float-left" style="margin-right: 14px;"></div>
                    伝票日付
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_105_1" id="man_power_management_data_creation_105_1" class="form-control datePicker datePicker2_1"
                        autocomplete="off" value="" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10" autofocus disabled>
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                  <td
                    style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                    ～
                  </td>
                  <td style="border: none!important;width: 178px;">
                    <div class="input-group">
                      <input type="text" name="man_power_management_data_creation_105_2" id="man_power_management_data_creation_105_2" class="form-control datePicker datePicker2_2"
                        autocomplete="off" value="" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10" autofocus disabled>
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div>
        <div class="row mb-4 mt-4">
          <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
            <div>
              <button id="dataCreationBtn" class="btn btn-info uskc-button" onclick="manPowerManagementDataCreation(event.preventDefault())">データ作成</button>
            </div>
            <div>
              <div class="loading-icon" style="">
                <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>