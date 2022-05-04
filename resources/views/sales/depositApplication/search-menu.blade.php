<?php
$today = date('Y/m/d');
?>
<table class="table custom-form" style="width: auto;margin-bottom: 2px!important;float:right;">
    <tbody>
    <tr>
        <td style="border: none!important;width: 238px !important;">
            <div class="radio-rounded custom-table-oh d-inline-block">
                <div class="custom-control custom-radio custom-control-inline"
                     style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio" name="complete_status" value="2"
                           checked="">
                    <label class="custom-control-label" for="customRadio"
                           style="font-size: 12px!important;cursor:pointer;">未完了分のみ</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                     style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="complete_status" value="1">
                    <label class="custom-control-label" for="customRadio2"
                           style="font-size: 12px!important;cursor:pointer;"> 完了分のみ</label>
                </div>
            </div>
        </td>
        <td style="border: none!important;text-align: left;color: black;width: 85px !important;">
            <div class="line-icon-box float-left mr-3"></div>
            売上日
        </td>
        <td style="border: none!important;width: 151px;">
            <div class="input-group">
                <input type="text" name="sales_date_start" class="form-control datePicker datePicker1_2" autocomplete="off"
                       value="" placeholder="年/月/日"
                       oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                       maxlength="10">
                <input type="hidden" class="datePickerHidden">
            </div>
        </td>
        <td style="width: 30px!important;border:0!important;text-align: center;">
            ～
        </td>
        <td style="border: none!important;width: 151px;">
            <div class="input-group">
                <input type="text" name="sales_date_end" class="form-control datePicker datePicker1_1" autocomplete="off"
                       value="{{$today}}" placeholder="年/月/日"
                       oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                       maxlength="10">
                <input type="hidden" class="datePickerHidden">
            </div>
        </td>
        <td style=" border: none!important;">
            <div class="form-button">
                <button type="button" id="searchBtn" class="btn btn-sm btn-primary loadingProgress uskc-button">表示</button>
            </div>
        </td>
    </tr>
    </tbody>
</table>
