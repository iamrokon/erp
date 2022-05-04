@php
  $design_conditions = [
    'companyMasterTableSetting' => [1050, 30],
    'creditMasterTableSetting' => [351, 20],
    'customerProductManagementTableSetting' => [351, 20],
    'employeeMasterTableSetting' => [700, 20],
    'nameMasterTableSetting' => [351, 20],
    'officeMasterTableSetting' => [1050, 23],
    'personalMasterTableSetting' => [700, 21],
    'productDescriptionTableSetting' => [351, 20],
    'productMasterTableSetting' => [1050, 20],
    'ProductSubMasterTableSetting' => [700, 21],
    'seqNumberingMasterTableSetting' => [351, 20],
    'projectRegistrationTableSetting' => [351, 20],
    'orderHistoryTableSetting' => [980, 21],
    'orderHistory2TableSetting' => [980, 20],
    'lBookTableSetting' => [351, 20],
    'dashboardCommentTableSetting' => [351, 20],
    'salesSlipTableSetting' => [351, 20],
    'backOrderTableSetting' => [560, 17],
    'salesHistoryTableSetting' => [700, 20],
    'depositHistoryTableSetting' => [590, 20],
    'accountListTableSetting' => [590, 20],
    'invoiceDeadlineTableSetting' => [850, 20],
    'fixedRateTableSetting' => [980, 20],
    'unpaidListTableSetting' => [700, 20],
    'depositHistoryListTableSetting' => [560,20],
    'customerLedgerTableSetting' => [700, 20],
    'billingLedgerTableSetting' => [700,20],
    'backlogList2TableSetting' => [700,20],
    'purchaseOrderTableSetting' => [700,20],
    'supportReqConfirmationTableSetting' => [700,20],
    'purchaseHistoryTableSetting' => [920,20],
    'inventoryListTableSetting' => [700,15],
    'paymentScheduleTableSetting' => [700,15],
    'paymentHistoryTableSetting' => [700,15],
    'supplierLedgerTableSetting' => [700,10],
    'purchaseLedgerTableSetting' => [700,10],
    'purchaseRecordListTableSetting' => [700,10],
    'purchaseResultListTableSetting' => [590,15],
    'purchaseBalanceListTableSetting' => [700,10],
    'purchaseDetailsTableSetting' => [700,10],
    'purchaseInquiryResultTableSetting' => [470,10],
    'creditLimitManagementTableSetting' => [700,10],
    'billingBalanceListTableSetting' => [700,15],
    'changeInchargeOfInHouseWorkWithFixedRateContractTableSetting' => [700,15],
    'changeInchargeOfFixedRateContractTableSetting' => [700,15],
    'purchaseSlipTableSetting' => [700,15],
  ];
  $width = $design_conditions[$route][0];
  $chunk = $design_conditions[$route][1];
  $headersChunk = collect($table_headers)->chunk($chunk);
  $chunkCount = count($headersChunk);
  $colDivider = $chunkCount ? intdiv(12,$chunkCount) : 0 ;
  $val = 0;
  $user_def_show = $bango == 'user_def' ? false : true;
@endphp

<form id="tableSetting" action="{{ route($route,$bango) }}">
  @csrf
  <input type="hidden" name="redirect_path" value="{{$redirect_path}}">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog" role="document" style="max-width: {{$width}}px; min-width: {{$width}}px;">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <div class="table_setting_hover_message" style="height: 40px; color:red;padding-left: 5px; white-space: normal; word-break: break-all;"></div>
          <button ignore type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-8">
              <button type="button" message="@if(array_key_exists('sett_select_all', $buttonMessage)){{$buttonMessage['sett_select_all']}}@endif"
                class="checkall table_sett_message_content btn btn-info" autofocus style="margin-bottom: 10px;">全選択</button>
              <button type="button" message="@if(array_key_exists('sett_deselect_all', $buttonMessage)){{$buttonMessage['sett_deselect_all']}}@endif"
                class="uncheck table_sett_message_content btn btn-info" style="margin-bottom: 10px;">全解除</button>
            </div>
            <div class="col-lg-4">
              @if($user_def_show)
              <button
                message="@if(array_key_exists('sett_default', $buttonMessage)){{$buttonMessage['sett_default']}}@endif"
                class="btn btn-info table_sett_message_content" data-userid="user_def"
                data-url="{{route($route,[$bango,'user_id'])}}" id="default_table_setting"
                style="margin-bottom: 10px;float: right;">デフォルト
              </button>
              @endif
            </div>
          </div>
          <div id="errorShow" style="margin-left: -11px !important;"></div>
          <div id="setting_input_boxwrap_personal">
            <div class="row custom-form">
              @foreach($headersChunk as $headers)
              <div class="col-{{$colDivider}}">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="table_settings">
                      @foreach($headers as $key => $header)
                      @if($val == 0)
                      <tr>
                        <td>

                          {{-- <label class="checkbox_container" for="check_{{$header}}" style="margin-left: 14px !important;margin-top: 2px !important;">&nbsp;
                            <input type="checkbox" class="" id="check_{{$header}}" checked="checked" disabled>
                            <input type="hidden" name="check_{{$header}}" value="on">
                            <span class="checkmark"></span>
                          </label> --}}


                            <div class="custom-control custom-checkbox custom-control-inline"
                              style="margin-left: 18px!important;">
                              <input type="checkbox" id="check_{{$header}}" class="custom-control-input "
                                checked="checked" disabled  ignore>
                              <input type="hidden" name="check_{{$header}}" value="on">
                              <label class="custom-control-label margin_btn_17" for="check_{{$header}}"></label>
                            </div>

                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="{{$header}}" value="0" readonly="readonly" id="setting_{{$header}}"
                            class="form-control text-right" maxlength="1" placeholder="0" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span
                            message="@if(isset($tableSettHeaderMsg) && array_key_exists($key, $tableSettHeaderMsg)){{$tableSettHeaderMsg[$key]}}@endif"
                            class="mt-1 text-left table_sett_message_content" style="white-space: normal;">{{ $key }}</span>
                        </td>
                      </tr>
                      @php
                      $val++;
                      @endphp
                      @else
                      <tr>
                        <td>
                          {{-- <label class="checkbox_container" for="check_{{$header}}"
                            style="margin-left: 14px !important;margin-top: 2px !important;">&nbsp;
                            <input type="checkbox" class="customCheckBox" id="check_{{$header}}" name="check_{{$header}}" onclick="activeInactiveCheckbox($(this))">
                            <input type="hidden" name="check_{{$header}}" value="on">
                            <span class="checkmark"></span>
                          </label> --}}

                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 18px!important;">
                            <input type="checkbox" name="check_{{$header}}" id="check_{{$header}}"
                              onclick="activeInactiveCheckbox($(this))" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_{{$header}}"></label>
                          </div>

                        </td>
                        <td style="width:60px!important;">
                          @if($loop->parent->last)
                          <input type="tel" name="{{$header}}" id="setting_{{$header}}"
                            class="form-control text-right input_field" maxlength="3" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                            onkeydown="lastTab(event)"
                          >
                          @else
                          <input type="tel" name="{{$header}}" id="setting_{{$header}}"
                            class="form-control text-right input_field" maxlength="3" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                          @endif
                        </td>
                        <td class="text-left">
                          <span
                            message="@if(isset($tableSettHeaderMsg) && array_key_exists($key, $tableSettHeaderMsg)){{$tableSettHeaderMsg[$key]}}@endif"
                            class="mt-1 text-left table_sett_message_content" style="white-space: normal;">@if($key == 'tick_mark'){{"✓"}}@else{{ $key }}@endif </span>
                        </td>
                      </tr>
                      @endif
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach

            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button message="@if(array_key_exists('sett_save', $buttonMessage)){{$buttonMessage['sett_save']}}@endif"
            type="button" id="tableSettingSubmit" class="btn btn-info table_sett_message_content" onkeydown="lastTab(event)">
            <i class="fas fa-save" style="margin-right: 5px;"></i>保存
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  var initial_focus_id = document.getElementsByClassName("table_settings")[0].children[1].cells[1].children[0].id;
  function lastTab(event) {
    if (event.keyCode == 13) {
      document.getElementById(initial_focus_id).focus();
      event.preventDefault();
    }
  }
</script>

<script>
  $(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
  });
  </script>
<script>
  // for table header settings lat input to first input focusing
  // function lastTab(event) {
  //   if (event.keyCode == 13) {
  //     $(".checkall").focus();
  //     event.preventDefault();
  //   }
  // }
</script>

{{-- Knockout - Enter to New Input Starts Here --}}
{{-- @include('master.common.knockout') --}}
{{-- Knockout - Enter to New Input Ends Here --}}
