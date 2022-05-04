@php
  $priceTotal = 0;
  $taxTotal = 0;
  $all_id = "";
  function numberFormat($value)
  {
      return gettype($value) == 'double' ? number_format($value, 2) : number_format($value);
  }
@endphp

@foreach($purchaseSlipInfos as $purchaseSlipData)
  @php
    $priceTotal += $purchaseSlipData->purchase_line_amount;
    $taxTotal += $purchaseSlipData->purchase_consumption_amount;
    $all_id .= $purchaseSlipData->bango.",";
  @endphp
@endforeach
@php
  $all_id = rtrim($all_id,",");
@endphp

<div class="content-bottom-section" style="padding-bottom:46px!important;margin-top: 15px;">


<form id="insertData" action="{{ route('purchaseSlip') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="{{isset($old['Button']) ? $old['Button']:''}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="tableType" name="tableType" value="purchaseSlipTable">
    <input type="hidden" name="reg_sold_to" value="{{isset($fsReqData['reg_sold_to'])?$fsReqData['reg_sold_to']:null}}">
    <input type="hidden" name="reg_sold_to_text" value="{{isset($fsReqData['reg_sold_to_text'])?$fsReqData['reg_sold_to_text']:null}}">
    <input type="hidden" name="input_person" value="{{isset($fsReqData['input_person'])?$fsReqData['input_person']:null}}">
    <input type="hidden" name="all_id" id="all_id" value="{{ $all_id }}">
    <input type="hidden" name="kaiin_register_status" id="kaiin_register_status" value="1">
    <input type="hidden" name="deletion_status" id="deletion_status" value="0">
    <input type="hidden" name="deleteLine">
    <input type="hidden" name="confirm_status" id="confirm_status" value="0">
    @csrf

  <div class="content-bottom-top" style="margin-bottom: 30px;">

    {{-- Page Title Starts Here --}}
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
          定期仕入一覧
          </div>
        </div>
      </div>
    </div>
    {{-- Page Title Ends Here --}}

    {{-- Pagination Starts Here --}}
    <div class="content-bottom-pagination">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="wrapper-pagination" style="background-color:#fff;height:130px;padding: 10px;">
              <!-- new pagination row starts here -->
              @include('purchase.purchaseSlip.pagination')
              <!----------pagination End----------------->
              <div class="row">
                  <div class="col-7">
                      <div class="row mt-2">
                          <div class="col">
                              <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                  <tbody>
                                    <tr style="">
                                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                      </td>
                                      <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">合計</td>
                                      <td style=" border: none!important;width: 15px!important;"></td>
                                      <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                      ¥ <span id="total_price">{{ $priceTotal ? numberFormat($priceTotal) : 0 }}</span>
                                      <input type="hidden" name="total_price" id="total_price" value="{{ $priceTotal }}"/>
                                    </td>
                                    </tr>
                                  </tbody>
                                </table>
                          </div>
                          <div class="col">
                              <table class="table custom-form" style="border: none!important;width: auto;">
                                <tbody>
                                  <tr style="">
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                      <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">消費税</td>
                                    <td style=" border: none!important;width: 15px!important;"></td>
                                    <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                      ¥ <span id="total_tax">{{ $taxTotal ? numberFormat($taxTotal) : 0 }}</span>
                                      <input type="hidden" name="total_tax" id="total_tax" value="{{ $taxTotal }}"/></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                          <div class="col">
                              <table class="table custom-form" style="border: none!important;width: auto;">
                                <tbody>
                                  <tr style="">
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                      <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">税込合計</td>
                                    <td style=" border: none!important;width: 15px!important;"></td>
                                    <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                      ¥ <span id="price_tax_total">{{ ($priceTotal + $taxTotal) ? numberFormat($priceTotal + $taxTotal) : 0 }}</span>
                                      <input type="hidden" name="price_tax_total" value="{{ ($priceTotal + $taxTotal) }}"/></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>

                      </div>
                  </div>

                  <div class="col-5">
                      <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                          <tbody>
                            <tr style="height: 28px;">
                                <td style=" border: none!important;">
                                   <!-- <button type="button" id="" class="btn text-white uskc-button" data-dismiss="modal" style="width: 159px;background: #009640;">
                                   Excelエクスポート</button> -->
                                   <button type="button" id="excelDwld" onclick="excelDownload('purchaseSlipTable')" class="btn text-white uskc-button" data-dismiss="modal"
                                  style="width: 159px;background: #009640;" @if(count($purchaseSlipInfos)<1) disabled @endif>Excelエクスポート</button>
                                </td>
                            </tr>
                          </tbody>
                        </table>

                  </div>

              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Pagination Ends Here --}}

  </div>
  
  <div class="content-bottom-bottom">
    <div class="container">

      {{-- Table Starts Here --}}
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 0 0 10px;">
            <div style="overflow: hidden;">
              <div class="table-responsive largeTable">
                <table id="userTable" class="table table-bordered table-fill table-striped custom-form"
                  style="margin-bottom: 20px!important;">
                  <thead class="thead-dark header text-center" id="myHeader">
                    <tr>
                    @foreach($headers as $header=>$field)
                      <th class="signbtn" scope="col" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{ $header }}</span></th>
                    @endforeach
                    </tr>

                  </thead>
                  <tbody>
                    @if($purchaseSlipInfos->count() != 0)
                    @foreach($purchaseSlipInfos as $key=>$val)
                    @php
                      $i = $loop->index + 1;
                    @endphp
                    <tr class="line-form" data-setcode="{{ $i }}" id="LineBranch{{ $i }}"> 
                    @foreach($headers as $header=>$field)
                    
                    <!-- @php
                        $total_tax = 0;
                        $totalPrice = 0;
                        if(isset($tax_rate)){
                          $taxRate = $tax_rate['value'];
                          $format = $tax_rate['format'];
                          $totalPrice = $val->purchase_quantity*$val->purchase_unit_price;
                          $tax = ($totalPrice/100)*$taxRate;
                          if($format == '1'){
                              $total_tax = round($tax);
                          }else if($format == '2'){
                              $total_tax = floor($tax);
                          }else if($format == '3'){
                              $total_tax = ceil($tax);
                          }
                        }
                      @endphp -->
                      @if($field == 'line_number')
                      <td>
                        <div class="data-box-content" style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                          <div style="padding: 8px 0px;height: 37px;">
                            <div style="width:100%;float:left;">
                              <div style="text-align: center;width:20%;float:left;color: #fff;">
                                <span id="serial-{{ $i }}" class="serial">{{ $i }}</span>
                                <input type="hidden" class="serial-input" id="serial-input-{{ $i }}"
                                    name="serial[]" value="{{ $i }}">
                                <input type="hidden" class="line_number" id="line_number-{{ $i }}"
                                    name="line_number[]" value="{{ $val->$field }}">
                                <input type="hidden" class="setcode" id="setcode-{{ $i }}" name="setcode[]">
                                <input type="hidden" class="id" id="id-{{ $i }}"
                                    name="id[]" value="{{ $val->bango }}">
                              </div>
                              <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                                <button class="btn repeat_btn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                <i class="fa fa-plus" aria-hidden="true"></i></button>
                              </div>
                              <div style="width:40%;float:left;margin-top: -2px;">
                                  <button type="button" class="btn delete_btn"
                                      style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                      <i class="fa fa-trash" aria-hidden="true"></i></button>
                              </div>

                            </div>
                          </div>
                        </div>
                      </td>
                      @elseif($field == 'display_order')
                        <td class="text-right"><input type="text" id="display_order-{{ $i }}" class="form-control display_order" name="display_order[]" value="{{ $val->$field }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" maxlength="3"></td>
                      @elseif($field == 'group')
                        <td class="text-right"><input type="text" id="group-{{ $i }}" class="group form-control" name="group[]" value="{{ $val->$field }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="" maxlength="2"></td>
                      @elseif($field == 'order_to')
                      <td>
                        <div style="width: 210px !important;">
                          <div class="input-group input-group-sm position-relative">
                              <input type="text" readonly class="form-control order_to" style="width: 127px!important;padding: 0!important; background:white!important;"
                                  id="order_to-{{ $i }}" placeholder="" name="order_to_full[]" value="{{ $val->order_to_full }}" >
                              <input type="hidden" id="order_to_db-{{ $i }}"
                                  name="order_to[]" class="db_hidden_field order_to_db" value="{{ $val->$field }}" >
                              <div class="input-group-append">
                                  <button type="button"
                                      onclick="supplierSelectionModalOpener_2(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'1','required','r20cd',2,event.preventDefault())"
                                      class="btn btn-outline-secondary order_to_modal_opener"
                                      style="background:#2c66b1 !important;color:white !important;"><i
                                      class="fas fa-arrow-left"></i></button>
                              </div>
                          </div>
                        </div>
                      </td>
                      @elseif($field == 'incharge_purchasing')
                      <td class="text-right">
                          <div class="custom-arrow">
                            <select class="form-control left_select incharge_purchasing"
                                id="incharge_purchasing-{{ $i }}" name="incharge_purchasing[]">
                                <option value="">-</option>
                                @foreach ($incharge_purchasing as $purchaser)
                                    <option @if ($val->$field == $purchaser->bango) selected @endif
                                        value="{{ $purchaser->bango }}">
                                        {{ $purchaser->name }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                      </td>
                      @elseif($field == 'product_cd')
                      <td>
                        <div class="productData custom-form d-flex">
                            <input type="text" readonly class="form-control productCd productSubOrCdTarget "
                                id="productCd-{{ $i }}" name="productCd[]" value="{{ $val->$field }}" style="width: 60px;">
                                <div style="width: 330px;">
                                  <div class="input-group input-group-sm position-relative">
                                      <input type="text" class="form-control productName"
                                          id="productName-{{ $i }}" maxlength="40" name="productName[]" value="{{ $val->product_name }}" @if($val->product_name) readonly @endif >
                                      <div class="input-group-append">
                                          <button type="button" class="btn btn-outline-secondary productModalOpener"
                                              style="background: #2c66b1 !important;color: white; ">
                                              <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                          </button>
                                      </div>
                                  </div>
                                </div>
                        </div>
                           
                    
                      </td>
                      @elseif($field == 'purchase_quantity')
                      <td class="text-right"><input type="text" id="purchase_quantity-{{ $i }}" class="purchase_quantity form-control text-right" name="purchase_quantity[]" maxlength="5"
                       value="{{ $val->$field ? numberFormat($val->$field) : null }}" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"></td>
                      @elseif($field == 'purchase_unit_price')
                      <td class="text-right"><input type="text" id="purchase_unit_price-{{ $i }}" class="purchase_unit_price form-control text-right" name="purchase_unit_price[]" maxlength="5"
                       value="{{ $val->$field ? numberFormat($val->$field) : null }}" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"></td>
                      @elseif($field == 'purchase_line_amount')
                      <td class="text-right"><input type="text" id="purchase_line_amount-{{ $i }}" class="purchase_line_amount form-control text-right" name="purchase_line_amount[]" value="{{ $val->$field ? numberFormat($val->$field) : null }}" readonly></td>
                      @elseif($field == 'purchase_consumption_amount')
                      <td class="text-right"><input type="text" id="purchase_consumption_amount-{{ $i }}" class="purchase_consumption_amount form-control text-right" name="purchase_consumption_amount[]" value="{{ $val->$field ? numberFormat($val->$field) : null }}" readonly></td>
                      @elseif($field == 'accounting_subject')
                      <td>
                        <div class="custom-arrow" style="width:200px;">
                          <select class="form-control left_select accounting_subject"
                              id="accounting_subject-{{ $i }}" name="accounting_subject[]">
                              <option value="">-</option>
                              @foreach ($accounting_subjects as $categoryKanri)
                                  <option @if ($val->$field == $categoryKanri->category1 . $categoryKanri->category2) selected @endif
                                      value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                      {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                  </option>
                              @endforeach
                          </select>
                        </div>
                      </td>
                      @elseif($field == 'accounting_breakdown')
                      <td>
                        <div class="custom-arrow" style="width:200px;">
                          <select class="form-control left_select accounting_breakdown"
                              id="accounting_breakdown-{{ $i }}" name="accounting_breakdown[]">
                              <option value="">-</option>
                              @foreach ($accounting_breakdowns as $categoryKanri)
                                  <option @if ($val->$field == $categoryKanri->category1 . $categoryKanri->category2) selected @endif
                                      value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                      {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                  </option>
                              @endforeach
                          </select>
                        </div>
                      </td>
                      @elseif($field == 'remarks')
                      <td class="text-right"><input type="text" id="remarks-{{ $i }}" class="remarks form-control" name="remarks[]" value="{{ $val->$field }}" maxlength="40" id="charInput"></td>
                      @elseif($field == 'retain')
                      <td>
                        <label class="checkbox_container header-checkbox">
                            <input class="checkAllCheckbox retain" type="checkbox" id="retain-{{ $i }}" value="2" @if($val->$field == 2){{ 'checked' }}@endif >
                            <input class="retain_val" type="hidden" id="retain_val-{{ $i }}" name="retain[]" value="{{ $val->$field }}" >
                          <span class="checkmark" style="top: -6px;"></span>
                        </label>
                      </td>
                      @elseif($field == 'last_datetime')
                      @php
                          $formattedDate = $val->$field ?? null;
                          if ($formattedDate) {
                              $year = substr($formattedDate, 0, 4);
                              $month = substr($formattedDate, 4, 2);
                              $day = substr($formattedDate, 6, 2);
                              $formattedDate = $year . '/' . $month . '/' . $day;
                          }

                      @endphp
                        <td>
                          <div class="data-box float-left">
                              <div class="input-group">
                                  <input autofocus="" type="text" class="form-control datePicker last_datetime"
                                      id="last_datetime-{{ $i }}" name="last_datetime[]"
                                      oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                      maxlength="10" autocomplete="off" placeholder="年/月/日"
                                      style="width: 140px!important;" value="{{ $val->$field }}" readonly>
                                  <input type="hidden" class="datePickerHidden"
                                      value="{{ $val->$field }}">
                              </div>
                          </div>
                        </td>
                      @endif
                      @endforeach


                      @if(!in_array('display_order',$headers))
                      <input type="hidden" class="display_order" id="display_order-{{ $i }}" name="display_order[]" value="">
                      @endif
                      @if(!in_array('group',$headers)) 
                      <input type="hidden" class="group" id="group-{{ $i }}" name="group[]" value="">
                      @endif
                      @if(!in_array('order_to',$headers))
                      <input type="hidden" class="order_to" id="order_to-{{ $i }}" name="order_to_full[]" value="">
                      <input type="hidden" class="order_to_db" id="order_to_db-{{ $i }}" name="order_to[]" value="">
                      @endif
                      @if(!in_array('incharge_purchasing',$headers))
                      <input type="hidden" class="incharge_purchasing" id="incharge_purchasing-{{ $i }}" name="incharge_purchasing[]" value="">
                      @endif
                      @if(!in_array('product_cd',$headers))
                      <input type="hidden" class="productCd" id="productCd-{{ $i }}" name="productCd[]" value="">
                      <input type="hidden" class="productName" id="productName-{{ $i }}" name="productName[]" value="">
                      @endif
                      @if(!in_array('purchase_quantity',$headers))
                      <input type="hidden" class="purchase_quantity" id="purchase_quantity-{{ $i }}" name="purchase_quantity[]" value="">
                      @endif
                      @if(!in_array('purchase_unit_price',$headers))
                      <input type="hidden" class="purchase_unit_price" id="purchase_unit_price-{{ $i }}" name="purchase_unit_price[]" value="">
                      @endif
                      @if(!in_array('purchase_line_amount',$headers))
                      <input type="hidden" class="purchase_line_amount" id="purchase_line_amount-{{ $i }}" name="purchase_line_amount[]" value="">
                      @endif
                      @if(!in_array('purchase_consumption_amount',$headers))
                      <input type="hidden" class="purchase_consumption_amount" id="purchase_consumption_amount-{{ $i }}" name="purchase_consumption_amount[]" value="">
                      @endif
                      @if(!in_array('accounting_subject',$headers))
                      <input type="hidden" class="accounting_subject" id="accounting_subject-{{ $i }}" name="accounting_subject[]" value="">
                      @endif
                      @if(!in_array('accounting_breakdown',$headers))
                      <input type="hidden" class="accounting_breakdown" id="accounting_breakdown-{{ $i }}" name="accounting_breakdown[]" value="">
                      @endif
                      @if(!in_array('remarks',$headers))
                      <input type="hidden" class="remarks" id="remarks-{{ $i }}" name="remarks[]" value="">
                      @endif
                      @if(!in_array('retain',$headers))
                      <input type="hidden" class="retain" id="retain-{{ $i }}" name="retain[]" value="">
                      @endif
                      @if(!in_array('last_datetime',$headers))
                      <input type="hidden" class="last_datetime" id="last_datetime-{{ $i }}" name="last_datetime[]" value="">
                      @endif


                    </tr>
                    
                    @endforeach
                    @else
                    <tr class="line-form" data-setcode="1" id="LineBranch1"> 
                    @foreach($headers as $header=>$field)
                    
                      @if($field == 'line_number')
                      <td>
                        <div class="data-box-content" style="width: 100px; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                          <div style="padding: 8px 0px;height: 37px;">
                            <div style="width:100%;float:left;">
                              <div style="text-align: center;width:20%;float:left;color: #fff;">
                                <span id="serial-1" class="serial">1</span>
                                <input type="hidden" class="serial-input" id="serial-input-1"
                                    name="serial[]" value="1">
                                <input type="hidden" class="line_number" id="line_number-1"
                                    name="line_number[]" value="1">
                                <input type="hidden" class="setcode" id="setcode-1" name="setcode[]">
                                <input type="hidden" class="id" id="id-1"
                                    name="id[]" value="">
                              </div>
                              <div style="width:40%;float:left;color: #fff; margin-top: -2px;">
                                <button class="btn repeat_btn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                <i class="fa fa-plus" aria-hidden="true"></i></button>
                              </div>
                              <div style="width:40%;float:left;margin-top: -2px;">
                                  <button type="button" class="btn delete_btn"
                                      style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                      <i class="fa fa-trash" aria-hidden="true"></i></button>
                              </div>

                            </div>
                          </div>
                        </div>
                      </td>
                      @elseif($field == 'display_order')
                        <td class="text-right"><input type="text" id="display_order-1" class="display_order form-control" value="" name="display_order[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" maxlength="3"></td>
                      @elseif($field == 'group')
                        <td class="text-right"><input type="text" id="group-1" class="group form-control" name="group[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="" maxlength="2"></td>
                      @elseif($field == 'order_to')
                      <td>
                        <div style="width: 210px !important;">
                          <div class="input-group input-group-sm position-relative">
                              <input type="text" readonly class="form-control order_to" style="width: 127px!important;padding: 0!important; background:white!important;"
                                  id="order_to-1" placeholder="" name="order_to_full[]" value="" >
                              <input type="hidden" id="order_to_db-1"
                                  name="order_to[]" class="db_hidden_field order_to_db" value="" >
                              <div class="input-group-append">
                                  <button type="button"
                                      onclick="supplierSelectionModalOpener_2(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'1','required','r20cd',2,event.preventDefault())"
                                      class="btn btn-outline-secondary order_to_modal_opener"
                                      style="background:#2c66b1 !important;color:white !important;"><i
                                      class="fas fa-arrow-left"></i></button>
                              </div>
                          </div>
                        </div>
                      </td>
                      @elseif($field == 'incharge_purchasing')
                      <td class="text-right">
                          <div class="custom-arrow">
                            <select class="form-control left_select incharge_purchasing"
                                id="incharge_purchasing-1" name="incharge_purchasing[]">
                                <option value="">-</option>
                                @foreach ($incharge_purchasing as $purchaser)
                                    <option
                                        value="{{ $purchaser->bango }}">
                                        {{ $purchaser->name }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                      </td>
                      @elseif($field == 'product_cd')
                      <td>
                        <div class="productData custom-form d-flex">
                            <input type="text" readonly class="form-control productCd productSubOrCdTarget "
                                id="productCd-1" name="productCd[]" value="" style="width: 60px;">
                                <div style="width: 330px;">
                                  <div class="input-group input-group-sm position-relative">
                                      <input type="text" class="form-control productName"
                                          id="productName-1" maxlength="40" name="productName[]" value="">
                                      <div class="input-group-append">
                                          <button type="button" class="btn btn-outline-secondary productModalOpener"
                                              style="background: #2c66b1 !important;color: white; ">
                                              <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                          </button>
                                      </div>
                                  </div>
                                </div>
                        </div>
                           
                    
                      </td>
                      @elseif($field == 'purchase_quantity')
                      <td class="text-right"><input type="text" id="purchase_quantity-1" class="purchase_quantity form-control text-right" name="purchase_quantity[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"  value="" maxlength="5"></td>
                      @elseif($field == 'purchase_unit_price')
                      <td class="text-right"><input type="text" id="purchase_unit_price-1" class="purchase_unit_price form-control text-right" name="purchase_unit_price[]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="" maxlength="5"></td>
                      @elseif($field == 'purchase_line_amount')
                      <td class="text-right"><input type="text" id="purchase_line_amount-1" class="purchase_line_amount form-control text-right" name="purchase_line_amount[]" value="" readonly></td>
                      @elseif($field == 'purchase_consumption_amount')
                      <!-- <td>342</td> -->
                      <td class="text-right"><input type="text" id="purchase_consumption_amount-1" class="purchase_consumption_amount form-control text-right" name="purchase_consumption_amount[]" value="" readonly></td>
                      @elseif($field == 'accounting_subject')
                      <td>
                        <div class="custom-arrow" style="width:200px;">
                          <select class="form-control left_select accounting_subject"
                              id="accounting_subject-1" name="accounting_subject[]">
                              <option value="">-</option>
                              @foreach ($accounting_subjects as $categoryKanri)
                                  <option
                                      value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                      {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                  </option>
                              @endforeach
                          </select>
                        </div>
                      </td>
                      @elseif($field == 'accounting_breakdown')
                      <td>
                        <div class="custom-arrow" style="width:200px;">
                          <select class="form-control left_select accounting_breakdown"
                              id="accounting_breakdown-1" name="accounting_breakdown[]">
                              <option value="">-</option>
                              @foreach ($accounting_breakdowns as $categoryKanri)
                                  <option
                                      value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                      {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                  </option>
                              @endforeach
                          </select>
                        </div>
                      </td>
                      @elseif($field == 'remarks')
                      <td class="text-right"><input type="text" id="remarks-1" class="remarks form-control" name="remarks[]" value="" maxlength="40"  ></td>
                      @elseif($field == 'retain')
                      <td>
                        <label class="checkbox_container header-checkbox">
                            <input class="checkAllCheckbox retain" type="checkbox" id="retain-1" value="2" >
                            <input class="" type="hidden" id="retain_val-1" name="retain[]" value="2" >
                          <span class="checkmark" style="top: -6px;"></span>
                        </label>
                      </td>
                      @elseif($field == 'last_datetime')
                        <td>
                          <div class="data-box float-left">
                              <div class="input-group">
                                  <input autofocus="" type="text" class="form-control datePicker last_datetime"
                                      id="last_datetime-1" name="last_datetime[]"
                                      oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                      maxlength="10" autocomplete="off" placeholder="年/月/日"
                                      style="width: 140px!important;" value="" readonly>
                                  <input type="hidden" class="datePickerHidden"
                                      value="">
                              </div>
                          </div>
                        </td>
                      @endif
                      @endforeach

                      @if(!in_array('display_order',$headers))
                      <input type="hidden" class="display_order" id="display_order-1" name="display_order[]" value="">
                      @endif
                      @if(!in_array('group',$headers)) 
                      <input type="hidden" class="group" id="group-1" name="group[]" value="">
                      @endif
                      @if(!in_array('order_to',$headers))
                      <input type="hidden" class="order_to" id="order_to-1" name="order_to_full[]" value="">
                      <input type="hidden" class="order_to_db" id="order_to_db-1" name="order_to[]" value="">
                      @endif
                      @if(!in_array('incharge_purchasing',$headers))
                      <input type="hidden" class="incharge_purchasing" id="incharge_purchasing-1" name="incharge_purchasing[]" value="">
                      @endif
                      @if(!in_array('product_cd',$headers))
                      <input type="hidden" class="productCd" id="productCd-1" name="productCd[]" value="">
                      <input type="hidden" class="productName" id="productName-1" name="productName[]" value="">
                      @endif
                      @if(!in_array('purchase_quantity',$headers))
                      <input type="hidden" class="purchase_quantity" id="purchase_quantity-1" name="purchase_quantity[]" value="">
                      @endif
                      @if(!in_array('purchase_unit_price',$headers))
                      <input type="hidden" class="purchase_unit_price" id="purchase_unit_price-1" name="purchase_unit_price[]" value="">
                      @endif
                      @if(!in_array('purchase_line_amount',$headers))
                      <input type="hidden" class="purchase_line_amount" id="purchase_line_amount-1" name="purchase_line_amount[]" value="">
                      @endif
                      @if(!in_array('purchase_consumption_amount',$headers))
                      <input type="hidden" class="purchase_consumption_amount" id="purchase_consumption_amount-1" name="purchase_consumption_amount[]" value="">
                      @endif
                      @if(!in_array('accounting_subject',$headers))
                      <input type="hidden" class="accounting_subject" id="accounting_subject-1" name="accounting_subject[]" value="">
                      @endif
                      @if(!in_array('accounting_breakdown',$headers))
                      <input type="hidden" class="accounting_breakdown" id="accounting_breakdown-1" name="accounting_breakdown[]" value="">
                      @endif
                      @if(!in_array('remarks',$headers))
                      <input type="hidden" class="remarks" id="remarks-1" name="remarks[]" value="" maxlength="40" >
                      @endif
                      @if(!in_array('retain',$headers))
                      <input type="hidden" class="retain" id="retain-1" name="retain[]" value="">
                      @endif
                      @if(!in_array('last_datetime',$headers))
                      <input type="hidden" class="last_datetime" id="last_datetime-1" name="last_datetime[]" value="">
                      @endif
                    

                    </tr>
                    @endif
                    
                    <tr id="last_row" style="display:none"></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Table Ends Here --}}

      {{-- Table Bottom Button Starts Here --}}
      <div class="row">
        <div class="ml-3 mr-3 d-flex mt-3 w-100 justify-content-end">
          <div class="form-button">
          <button href="#" class="btn btn-info uskc-button" id="dataCreation"
              style="width: 150px;height:30px;line-height:30px;">データ作成</button>
            <button href="#" class="btn btn-info uskc-button" id="registration"
              style="width: 150px;height:30px;line-height:30px;">登録</button>
          </div>
        </div>
      </div>
      {{-- Table Bottom Button Ends Here --}}

    </div>
  </div>
  
</div>
  {{-- Alert message modal start here --}}

  <div class="modal custom-modal" data-backdrop="static" id="dataCreation_pop_up_modal1" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:550px;">
    <div class="modal-content bg-blue">
      <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><strong>データ作成</strong></h5>
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
        <div class="modal-data-box pl-4 pr-4 mt-4">
          <table class="table text-white table_modal" id="table-basic" style="width: 267px;">
            <tbody class="pl-4 pr-4">
              <tr>
                <td colspan="5" style="border:0px!important;pading-left:0px!important;pading-right:0px!important;">
                  <div id="error_data2" style=" color: red;font-size: 12px;width: 100%;margin-left:-8px;"></div>
                </td>
              </tr>
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-box-icon"></div>
              </td>
              <td style=" border: none!important;width: 73px!important;color: #fff;">グループ</td>
                <td
                  style="border-left: 0px !important;border-right: 0px !important; width: 40px!important;padding: 10px 0px 5px 0px !important;border-bottom: 0px!important;">
  
                  <input type="text" name="group_first" id="group_first" class="form-control" style="width: 40px !important;" maxlength="2" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="">
                </td>
                <td style="width: 30px!important;border:0!important;text-align: center;">
                  ～
                </td>
                <td
                style="border-left: 0px !important;border-right: 0px !important; width: 40px!important;padding: 10px 0px 5px 0px !important;border-bottom: 0px!important;">

                <input name="group_last" id="group_last" type="text" class="form-control" style="width: 40px !important;" maxlength="2"  oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="">
              </td>
              </tr>
         
            </tbody>
          </table>
          <table class="table text-white table_modal" id="table-basic" style="width: 322px;">
         
            <tbody class="pl-4 pr-4">
           
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-box-icon mr-3"></div>
              </td>
              <td style=" border: none!important;width: 95px!important;color: #fff;">仕入日付</td>
               
                <td
                style="border-left: 0px !important;border-right: 0px !important;padding: 10px 0px 5px 0px !important;border-bottom: 0px!important;">

                {{-- <div> --}}
                  <input  type="text" class="form-control input_field datePicker1_1" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 134px!important;" name="purchase_date" id="purchase_date" value="">
                  <input type="hidden" class="datePickerHidden">
                {{-- </div> --}}
              </td>
              </tr>
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-box-icon mr-3"></div>
              </td>
              <td style=" border: none!important;width: 95px!important;color: #fff;">納品書番号</td>
               
                <td
                style="border-left: 0px !important;border-right: 0px !important;padding: 10px 0px 5px 0px !important;border-bottom: 0px!important;">

                <input type="text" class="form-control" style="width: 134px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;" maxlength="20" value="">
              </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer border-top-0 pl-4 pr-4">
          <button type="button" id="choice_button" class="btn text-white uskc-button bg-default ml-2" data-dismiss="modal">
            キャンセル
           </button>
          <button type="button" class="btn w-145 bg-teal text-white ml-2" id="main_registration">
            データ作成
          </button>
        </div>
      </div>
    </div>
  </div>
  </div>
  
  {{--  Alert message modal end end here --}}
   {{-- Alert message modal start here --}}

   <div class="modal custom-data-modal" data-backdrop="static" id="dataCreation_pop_up_modal2" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel1" aria-hidden="true">
   <div class="modal-dialog" role="document" style="max-width: 300px;">
     <div class="modal-content bg-blue">
       <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
         <h5 class="modal-title" id="exampleModalLabel"><strong></strong></h5>
         <span type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </span>
       </div>
       <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
         <div class="modal-data-box pl-4 pr-4">
           <table class="table text-white" id="table-basic">
             <tbody class="pl-4 pr-4">
           
               <tr>
   
                 <td class="text-center"
                   style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
   
                   <div> <span id="no_of_unsumei" ></span></div>
                 </td>
               </tr>
              
               <tr>
   
                 <td
                   style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                   <div class="text-center">
                     <button type="button" id="dataCreationDone" class="btn w-145 bg-teal text-white ml-2">
                     OK
                     </button>
                   </div>
                 </td>
               </tr>
   
   
             </tbody>
           </table>
         </div>
         <div class="modal-footer border-top-0 pl-4 pr-4">
           
         </div>
       </div>
     </div>
   </div>
   </div>
   
   {{--  Alert message modal end end here --}}

   
  </form>
  
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
