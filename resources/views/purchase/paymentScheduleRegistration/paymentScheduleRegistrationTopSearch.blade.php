 <form id="insertData" onsubmit="return false" enctype="multipart/form-data" method="post">
  <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>

<div class="content-head-section custom-mb" style="padding-bottom: 5px;">
  <div class="container position-relative">
    <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
          &times;</button>
          <strong>success message</strong>
        </div>
      </div>
    </div>
    <script>
      // Focus on Alert Closing
      $(".dismissMe").keydown(function(e) {
          if (e.shiftKey && e.which == 13) {
              $('.close').alert('close');
              event.preventDefault();
              document.getElementById("categorikanri").click();
              $('#categorikanri').focus();
          }
      });
    </script>
  
    {{-- Error Message Starts Here --}}
      <div class="row">
        <div class="col-12">
          <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
        </div>
      </div>
    {{-- Error Message Ends Here --}}

    <div class="row order_entry_topcontent pay_schedule_reg">
      <div class="col">
        <div class="content-head-top" style="padding-bottom: 13px;">
          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table"
                style="border: none!important;width:auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width:113px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div> 締切日
                    </td>
                    <td style="border: none!important;width:178px;">
                      <div class="input-group">
                        <input type="text" name="purchase_payment_schedule_reg_101" id="purchase_payment_schedule_reg_101" class="form-control datePicker1_1" autofocus=""
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input type="hidden" class="datePickerHidden" value="">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <div style="margin-top: -3px;">
                <table class="table custom-form"
                  style="border: none!important;width:auto;margin-bottom:4px !important;margin-left:4px;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:130px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div> 仕入先・購入先
                      </td>
                      <td style="border: none!important;width:172px;">
                        <div class="input-group input-group-sm custom_modal_input">
                          <input type="text" name="purchase_payment_schedule_reg_102" id="purchase_payment_schedule_reg_102" class="form-control" placeholder="仕入先・購入先" readonly="">
                         <!--  <div class="input-group-append" data-toggle="modal" data-target="#search_modal4"
                            style="margin-left: 0px!important;">
                            <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                          </div> -->
                           <div class="input-group-append" id="modalarea" style="margin-left:0px!important;">
                            <button onclick="supplierSelectionModalOpener_2('supplier_v2','supplier_db','2','nullable','r17_3cd',2,event.preventDefault())"
                            class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="ml-3 mr-3" style="width: 726px;">
              <div>
                <table class="table custom-form" style="width:auto;margin-bottom:4px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:158px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3" style="background-color: #fff;"></div> 合計
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_111" id="purchase_payment_schedule_reg_111" class="form-control text-right" placeholder="" readonly="">
                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important;">
                        税
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_112" id="purchase_payment_schedule_reg_112" class="form-control text-right" placeholder="" readonly="">

                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 60px!important; max-width: 60px!important;">
                        税込
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_113" id="purchase_payment_schedule_reg_113" class="form-control text-right" placeholder="" readonly="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <table class="table custom-form" style="width:auto;margin-bottom:4px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:153px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3" style="background-color: #fff;"></div> 買掛残
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_114" id="purchase_payment_schedule_reg_114" class="form-control text-right" placeholder="" readonly="">
                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important;">
                        税
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_115" id="purchase_payment_schedule_reg_115" class="form-control text-right" placeholder="" readonly="">

                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 60px!important; max-width: 60px!important;">
                        税込
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_116" id="purchase_payment_schedule_reg_116" class="form-control text-right" placeholder="" readonly="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
                <table class="table custom-form" style="width:auto;margin-bottom:4px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:153px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3" style="background-color: #fff;"></div> 未払残
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_117" id="purchase_payment_schedule_reg_117" class="form-control text-right" placeholder="" readonly="">
                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important;">
                        税
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_118" id="purchase_payment_schedule_reg_118" class="form-control text-right" placeholder="" readonly="">

                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 60px!important; max-width: 60px!important;">
                        税込
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="purchase_payment_schedule_reg_119" id="purchase_payment_schedule_reg_119" class="form-control text-right" placeholder="" readonly="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="content-head-top">
          <div class="row mb-4 mt-4">
            <div class="col-8 d-flex align-items-center">
              <div class="radio-rounded d-inline-block">
               
                @foreach ($purchase_categories as $key => $value)
                    <div class="custom-control custom-radio custom-control-inline"
                      style="padding-left:11px!important;">
                      <input type="radio" class="custom-control-input" id="<?php echo "purchase_payment_schedule_reg_201_$key"; ?>" name="purchase_payment_schedule_reg_201" value="{{$value->jouhou}}" <?php if($value->jouhou == 'すべて') echo "checked"; ?>>
                      <label class="custom-control-label" for="<?php echo "purchase_payment_schedule_reg_201_$key"; ?>"
                        style="font-size: 12px!important;cursor:pointer;">{{ $value->jouhou }}</label>
                    </div>
                @endforeach
               <!--  <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:11px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio" name="payrd1" value=""
                    checked="">
                  <label class="custom-control-label" for="customRadio"
                    style="font-size: 12px!important;cursor:pointer;">すべて</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio2" name="payrd1" value="">
                  <label class="custom-control-label" for="customRadio2"
                    style="font-size: 12px!important;cursor:pointer;"> 仕入</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio3" name="payrd1" value="">
                  <label class="custom-control-label" for="customRadio3"
                    style="font-size: 12px!important;cursor:pointer;">購入</label>
                </div> -->


              </div>
            </div>
            <div class="col-4">
              <div class="d-inline-block float-right">
                <button onclick="process_2_202_display()" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>