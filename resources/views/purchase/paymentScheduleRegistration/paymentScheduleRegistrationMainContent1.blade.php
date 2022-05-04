<div class="content-bottom-section" style="padding-bottom:10px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            支払予定登録
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="data-wrapper-content" style="width: 100%;">
            <!-- <div class="data-box-content" style="width: 6%; float: left;background-color:#666666;text-align: center;color:#fff;height: 33px;vertical-align: middle;border-radius: 5px 0px 5px;">
              <div style="padding: 6px;">
                行
              </div>
            </div> -->
            <div class="data-box-content2 text-center orderentry-databox"
              style="width: 100%;float: left;background: white;">
              <div style="width: 100%;float: left;">
                <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                  style="padding: 5px;width: 14%;">
                  仕入支払方法1
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 14%;">
                  仕入支払額1
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 14%;">
                  仕入支払方法2
                </div>

                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px; width: 14%;">
                  仕入支払額2</div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 14%;">仕入支払方法3
                </div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 15%;">仕入支払額3
                </div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 15%;">仕入支払計
                </div>
              </div>
              <div style="width: 100%;float: left;">
                <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                  style="padding: 5px;width: 14%;">
                  購入支払方法1
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 14%;">
                  購入支払額1
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 14%;">
                  購入支払方法2
                </div>

                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px; width: 14%;">
                  購入支払額2</div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 14%;">購入支払方法3
                </div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 15%;">購入支払額3
                </div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 15%;">購入支払計
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-bottom-bottom">
    <div class="container">
      <div class="row mt-2">
        <div class="col-12">

          <div class="data-box-content2 custom-form text-center orderentry-databox"
            style="width: 100%;float: left;">
            <div style="width: 100%;float: left;">
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_211" id="purchase_payment_schedule_reg_211" autofocus="">
                    <option value="">-</option>
                    @foreach ($categorykanries as $request)
                      <option value="{{ $request->category1 . '' . $request->category2}}">
                          {{ $request->category2 . ' ' . $request->category4 }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_212" id="purchase_payment_schedule_reg_212" class="form-control text-right" value="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_212()">
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_213" id="purchase_payment_schedule_reg_213" autofocus="">
                     <option value="">-</option>
                      @foreach ($categorykanries as $request)
                        <option value="{{ $request->category1 . '' . $request->category2}}">
                            {{ $request->category2 . ' ' . $request->category4 }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_214" id="purchase_payment_schedule_reg_214" class="form-control text-right" value="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_214">
                </div>
              </div>

                <script>
                    /*$(document).on('change','#purchase_payment_schedule_reg_213',function(){
                            alert('hlw');
                    });*/
                    /*function hyphenCheck(own) {
                        let dropdown_id = '#'+own.id;
                        let method_val = $(dropdown_id).val();
                        // console.log(method_val);
                        if (!method_val){
                            let id_no = dropdown_id.substring(dropdown_id.length - 3);
                            let input_id_no = parseInt(id_no)+1;
                            let input_id = dropdown_id.substring(0, dropdown_id.length - 3);
                            input_id = input_id+input_id_no.toString();
                            $(input_id).val(null);
                            // console.log(parseInt(id_no),id_no,input_id);
                        }
                    }*/
                </script>

              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_215" id="purchase_payment_schedule_reg_215" autofocus="">
                     <option value="">-</option>
                      @foreach ($categorykanries as $request)
                        <option value="{{ $request->category1 . '' . $request->category2}}">
                            {{ $request->category2 . ' ' . $request->category4 }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_216" id="purchase_payment_schedule_reg_216" class="form-control text-right" placeholder="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_216">
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_217" id="purchase_payment_schedule_reg_217" class="form-control text-right" readonly placeholder="">
                </div>
              </div>
            </div>

            <div style="width: 100%;float: left;">
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_221" id="purchase_payment_schedule_reg_221" autofocus="">
                      <option value="">-</option>
                      @foreach ($categorykanries as $request)
                        <option value="{{ $request->category1 . '' . $request->category2}}">
                            {{ $request->category2 . ' ' . $request->category4 }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_222" id="purchase_payment_schedule_reg_222" class="form-control text-right" value="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_222">
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_223" id="purchase_payment_schedule_reg_223" autofocus="">
                     <option value="">-</option>
                      @foreach ($categorykanries as $request)
                        <option value="{{ $request->category1 . '' . $request->category2}}">
                            {{ $request->category2 . ' ' . $request->category4 }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_224" id="purchase_payment_schedule_reg_224" class="form-control text-right" value="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_224">
                </div>
              </div>

              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="custom-arrow">
                  <select class="form-control" name="purchase_payment_schedule_reg_225" id="purchase_payment_schedule_reg_225" autofocus="">
                     <option value="">-</option>
                      @foreach ($categorykanries as $request)
                        <option value="{{ $request->category1 . '' . $request->category2}}">
                            {{ $request->category2 . ' ' . $request->category4 }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_226" id="purchase_payment_schedule_reg_226" class="form-control text-right" placeholder="" maxlength="9" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\..*)\./g, '$1');" onchange="purchase_payment_schedule_reg_226">
                </div>
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_227" id="purchase_payment_schedule_reg_227" class="form-control text-right" readonly placeholder="">
                </div>
              </div>
            </div>
            <div style="width: 100%;display:flex; align-items:center;">
              <div class="data-box float-left" style="padding: 5px;width: 14%;">

              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">

              </div>
              <div class="data-box float-left" style="padding: 5px;width: 14%;">

              </div>
              <div class="data-box float-left text-right" style="padding: 5px;width: 14%;">
                手形期日
              </div>

              <div class="data-box float-left" style="padding: 5px;width: 14%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_231" id="purchase_payment_schedule_reg_231" class="form-control datePicker1_2" autofocus=""
                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                    onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                    maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                  <input type="hidden" class="datePickerHidden" value="">
                </div>
              </div>
              <div class="data-box float-left text-right" style="padding: 5px;width: 15%;">
                支払額計合計
              </div>
              <div class="data-box float-left" style="padding: 5px;width: 15%;">
                <div class="input-group">
                  <input type="text" name="purchase_payment_schedule_reg_232" id="purchase_payment_schedule_reg_232" class="form-control text-right" readonly placeholder="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="d-flex ml-3 mr-3 mt-3 mb-1 justify-content-end w-100">
          <div class=" " style="background-color:#fff; padding: 10px;">
            <input type="hidden" id="submit_confirmation" name="submit_confirmation">
            <input type="hidden" id="success_result_3_1" name="success_result_3_1">
            <input type="hidden" id="success_result_3_2" name="success_result_3_2">
            <button class="btn btn-info uskc-button registerPayScheduleSubmitButton" onclick="registerPaySchedule()">登&nbsp;&nbsp;録</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
