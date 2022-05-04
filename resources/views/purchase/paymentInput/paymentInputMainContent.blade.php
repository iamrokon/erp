<div class="content-bottom-section" style="padding-bottom:46px;">
  <div class="content-bottom-top">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            支払明細
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="data-wrapper-content" style="width: 100%;">
            <div class="data-box-content"
              style="width: 6%; float: left;background-color:#666666;text-align: center;color:#fff;height: 33px;vertical-align: middle;border-radius: 5px 0px 5px;">
              <div style="padding: 6px;">
                行
              </div>
            </div>
            <div class="data-box-content2 text-center orderentry-databox"
              style="width: 94%;float: left;background: white;">
              <div style="width: 100%;float: left;">
                <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                  style="padding: 5px;width: 10%;">
                  支払方法
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 10%;">
                  銀行
                </div>
                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px;width: 12%;">
                  支店
                </div>

                <div class="data-box float-left border border-bottom-0 border-right-0"
                  style="padding: 5px; width: 10%;">
                  支払金額</div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 11%;">手形期日
                </div>
                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 47%;">備考</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-bottom-bottom">
    <div class="container">

      <div class="row mt-2 line-form" id="LineBranch1">
        <div class="col-12">
          <div class="data-wrapper-content" style="width: 100%;">
            <div class="data-box-content"
              style="width: 6%;float: left;background-color:#666666;text-align: center;color:#fff;height: 58px;vertical-align: middle;border-radius: 5px 0px 5px;">
              <div style="padding: 8px 0px;height: 58px;">
                <div style="width:100%;float:left;">
                  <div style="text-align: center;width:100%;float:left;color: #fff;">
                    <span id="lineValue" class="lineValue">1</span>
                    <input type="hidden" class="line-input" name="line[]" value="1">
                  </div>
                </div>
                <div style="width:100%;float:left;margin-top: 2px;">
                  <div style="width:50%;float:left;color: #fff; margin-top: -2px;">
                    <button type="button" class="lineBtn" id="lineBtn" 
                      style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i
                        class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                  <div style="width:50%;float:left;margin-top: -2px;">
                    <button tylpe="button" class="deleteBtn" id="deleteBtn" data-toggle="modal" data-target="#confirm_line_delation_Modal_deposit"
                      style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                      class="fa fa-trash" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="data-box-content2 custom-form text-center orderentry-databox"
              style="width: 94%;float: left;background: white;height:56px;">
              <div style="width: 100%;float: left;margin-top: 10px;">
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="custom-arrow">
                    <select class="form-control payment_method" name="payment_method[]" id="payment_method">
                      <!-- <option value=""></option> -->
                      @foreach ($data201 as $categoryKanri) 
                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                        {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="custom-arrow">
                    <select class="form-control bank" name="bank[]" id="bank">
                      <option value="">-</option>
                      @foreach ($data202 as $categoryKanri) 
                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                        {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 12%;">
                  <div class="custom-arrow">
                    <select class="form-control branch_store" name="branch_store[]" id="branch_store">
                      <option value="">-</option>
                      @foreach ($data203 as $categoryKanri) 
                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                        {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="input-group">
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"  class="form-control text-right payment_amount" name="payment_amount[]" id="payment_amount" value="" maxlength="9">
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 11%;">
                  <div class="input-group">
                    <input type="text" class="form-control datePicker1_1 due_date" id="due_date"  name="due_date[]" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                      maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                    <input type="hidden" class="datePickerHidden">

                    {{-- <input type="text" name="due_date[]" class="form-control due_date"  id="due_date" placeholder=""> --}}
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 47%;">
                  <div class="input-group">
                    <input type="text" name="remarks[]" class="form-control remarks" id="remarks" placeholder="" maxlength="40">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row mt-2">
        <div class="col-12">
          <div class="data-wrapper-content" style="width: 100%;">
            <div class="data-box-content"
              style="width: 6%;float: left;background-color:#666666;text-align: center;color:#fff;height: 58px;vertical-align: middle;border-radius: 5px 0px 5px;">
              <div style="padding: 8px 0px;height: 58px;">
                <div style="width:100%;float:left;">
                  <div style="text-align: center;width:100%;float:left;color: #fff;">
                    <span>2</span>
                  </div>
                </div>
                <div style="width:100%;float:left;margin-top: 2px;">
                  <div style="width:50%;float:left;color: #fff; margin-top: -2px;">
                    <button class="btn"
                      style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;"><i
                        class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                  <div style="width:50%;float:left;margin-top: -2px;">
                    <button class="btn" data-toggle="modal" data-target="#confirm_line_delation_Modal_deposit"
                      style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                        class="fa fa-trash" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="data-box-content2 custom-form text-center orderentry-databox"
              style="width: 94%;float: left;background: white;height:56px;">
              <div style="width: 100%;float: left;margin-top: 10px;">
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="custom-arrow">
                    <select class="form-control" name="" id="">
                      <option value="">06 FB振込</option>
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="custom-arrow">
                    <select class="form-control" name="" id="">
                      <option value="">01 三井住友銀行</option>
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 12%;">
                  <div class="custom-arrow">
                    <select class="form-control" name="" id="">
                      <option value="">01 三井住友銀行</option>
                    </select>
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 10%;">
                  <div class="input-group">
                    <input type="text" readonly="" class="form-control text-right" value="19,000">
                  </div>
                </div>

                <div class="data-box float-left" style="padding: 5px;width: 11%;">
                  <div class="input-group">
                    <input type="text" name="" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="data-box float-left" style="padding: 5px;width: 47%;">
                  <div class="input-group">
                    <input type="text" name="" class="form-control" placeholder="NNNN5NNNN0NNNN5NNNN0">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="row registration-button-area">
        <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
          <div class="form-button">
            <button href="#" class="btn btn-info uskc-button register-button" id="registrationButton"
              style="width: 150px;height:30px;line-height:30px;">登&nbsp;&nbsp;録</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  function numberCommaFormat(num) {
      if (num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
      }
      return null;
  }

  function callforComma(self) {
      var test = numberCommaFormat(self.value);
      self.value = test;
  }

  function callToRemoveComma(self) {
      var test = self.value.replace(/,+/g, '')
      self.value = test;
  }
</script>