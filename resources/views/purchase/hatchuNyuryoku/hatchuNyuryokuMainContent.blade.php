@php
$i = 0;

function numberFormat($value)
{
    return gettype($value) == 'double' ? number_format($value, 2) : number_format($value);
}
@endphp
<script type="text/javascript">
    var productRows = [];
    var typeofFunction = document.getElementById('request').value;
    var typeOfCategoyKanri = document.getElementById('categorikanri').value;
    document.cookie = "typeoffunction =" + typeofFunction + "typeOfCategoyKanri =" + typeOfCategoyKanri;

    $("#request").change(function() {
        var typeofFunction = document.getElementById('request').value;
        document.cookie = "typeoffunction =" + typeofFunction;
    });
    $("#categorikanri").change(function() {
        var typeofFunction = document.getElementById('categorikanri').value;
        document.cookie = "typeOfCategoyKanri =" + typeOfCategoyKanri;
    });
    document.cookie = "hikitasukko_val=" + $("#_hikitasukko_val").val()
</script>
@if (!empty($products))
    @php
        $j = array_fill(1, sizeof($products), 0);
    @endphp
    @foreach ($products as $product)
        @php
            $i++;
            $idoutanabango = $product->idoutanabango;
            $idotanabango = $product->idoutanabango ? explode(',', $product->idoutanabango)[0] ?? null : null;
        @endphp
        <div class="container">
          <div class="row line-form" data-setcode="{{ $idotanabango }}" style="margin-top:32px;" id="LineBranch{{$i}}">
            <script type="text/javascript">
              productRows[{{$i}}]= {{$i}};
            </script>
           <div class="col-12">
            <div class="data-wrapper-content" style="width: 100%;">
              <div class="data-box-content"
                style="width: 7%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
                <div style="padding: 15px 0px;height: 76px;">
                  <div style="width:100%;">
                    <input type="hidden" value="{{ $product->dataint02 }}" class="serial"
                        id="serial-{{ $loop->index }}" name="serial[]">
                    <input type="hidden" class="deletedProduct" name="deletedProduct[]"
                        value="{{ $product->yoteimeter }}" />
                    <input type="hidden" value="{{ $idotanabango }}" id="setcode-{{ $loop->index }}"
                        class="setcode" name="setcode[]">
                    <div style="color: #fff;">
                      @if ($product->juchusyukko_check == '1' && ($_COOKIE['typeoffunction'] == '3 削除' || $_COOKIE['typeoffunction'] == '2 訂正'))
                          <input type="hidden" name="juchusyukko_check" value="1">
                      @else
                          <input type="hidden" name="juchusyukko_check" value="0">
                      @endif
                      <span id="lineValue-{{ $loop->index }}" class="lineValue">{{$i}}</span>
                      <input type="hidden" class="line-input" name="line[]" readonly="" value="{{$i}}"> <!-- change may be needed to value="{{ $product->syouhinsyu }}"-->
                      
                    </div>
                  </div>
                  <div style="width:100%;float:left;margin-top: 7px;">
                    <div style="width:50%;float:left;color: #fff;">
                      <button class="btn lineBtn" id="lineBtn"name="gyoutuika"
                        style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 24px;font-size:12px;background-color: #4dbdd9;color: #fff;cursor: pointer;"><i
                          class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                    <div style="width:50%;float:left;color: #fff;">
                      <button class="btn delBtn" name="gyousakujo" 
                        style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                          class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="data-box-content2 custom-form text-center orderentry-databox"
                style="width: 93%;float: left;">
                <div style="width: 100%;float: left;">
                  <div class="data-box float-left" style="padding: 5px; width: 10%;">
                    <div class="input-group">
                      <input type="text" class="form-control productCd productSubOrCdTarget" id="productCd-{{ $loop->index }}" name="syouhincd[]" readonly="" value="{{$product->kawasename}}">
                      <div class="input-group-append">
                      <input type="hidden" name="denpyohakkoubi[]" id="denpyohakkoubi-{{ $loop->index }}" value="{{ $product->denpyohakkoubi }}">
                      <input type="hidden" class="selectValue">
                                <input type="hidden" class="syohin_data100" id="syohin_data100" />
                                <input type="hidden" class="syohin_product_status" id="syohin_product_status" />
                                <input type="hidden" class="syohin_product_count" id="syohin_product_count" />
                                <input type="hidden" value="" class="dataChar13Status" name="data_char13[]">
                                <input type="hidden" class="dspbango" id="dspbango" />
                                <input type="hidden" class="shoyin_kongouritsu" id="shoyin_kongouritsu" />
                                <input type="hidden" class="shoyin_mdjouhou" id="shoyin_mdjouhou" />
                                <input type="hidden" class="shoyin_color" name=shoyin_color[] id="shoyin_color" />
                                <input type="hidden" class="shoyin_tokuchou" id="shoyin_tokuchou" />
                                <input type="hidden" class="shoyin_data22" id="shoyin_data22" />
                                <input type="hidden" class="shoyin_data51" id="shoyin_data51" />
                        <button type="button" 
                          class="btn btn-outline-secondary productModalOpener" name="syouhincd-kensaku" style="color: white; "><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 15%;">
                    <div class="input-group">
                      <input type="text" class="form-control manufacturePartNumber" 
                      id="manufacturePartNumber-{{ $loop->index }}" name="me_ka_hinban[]" maxlength="13"
                      value="{{ $product->datachar03 ? $product->datachar03 : null }}">
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 30%;">
                    <div class="input-group">
                      <input type="text" class="form-control productName"  
                      id="productName-{{ $loop->index }}" name="productName[]" maxlength="40"
                      value="{{ $product->datachar04 ? $product->datachar04 : null }}">
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right quantity" name="quantity[]" maxlength="5"
                    min="1" value="{{ $product->syukkasu ? numberFormat($product->syukkasu) : null }}"
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                    >
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right price" name="price[]" maxlength="8"
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                    value="{{ $product->syouhin1kakaku ? numberFormat($product->syouhin1kakaku) : null }}">
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right rate" name="rate[]"  maxlength="5"
                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d{1})\d+/g, '$1');"
                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right partitionUnitPrice" name="partitionUnitPrice[]" 
                    value="{{ $product->partitionunitprice ?  numberFormat($product->partitionunitprice): 0 }}" readonly>
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right orderAmount" name="orderAmount[]"  
                    value="{{ $product->syouhizeiritu ? numberFormat($product->syouhizeiritu) : 0 }}" readonly>
                  </div>
                </div>
              </div>

              <div class="data-box-content2 text-center custom-form orderentry-databox"
                style="width: 93%;float: left;">
                <div style="width: 100%;float: left;">
                  <div class="data-box float-left" style="padding: 5px; width: 11%;">
                    <div class="input-group">
                      <input type="text" class="form-control datePicker datePicker2 kobetunouki" name="kobetunouki[]" autocomplete="off"
                        value="{{isset($product->yoteibi) ? $product->yoteibi : null}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10">
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </div>
                  <div class="data-box float-left vertical-line"
                    style="padding: 5px; width: 5%;height: 37px;border-right: 0 !important;">
                    <label class="checkbox_container header-checkbox">
                      @if($product->dataint21 == '1')
                      <input type="hidden" class="checkboxInput" name="saitan[]" value="1">
                      <input class="checkAllCheckbox checkbox2" type="checkbox" id="saitan-{{ $loop->index }}" checked >
                      <span class="checkmark" style="top: 6px;left: 18px;"></span>
                      @else
                        <input type="hidden" class="checkboxInput" name="saitan[]" value="2">
                        <input class="checkAllCheckbox checkbox2" type="checkbox" id="saitan-{{ $loop->index }}" >
                        <span class="checkmark" style="top: 6px;left: 18px;"></span>
                      @endif
                    </label>
                  </div>
                  <div class="data-box float-left vertical-line" style="padding: 5px; width: 11%;">
                    <div class="input-group">
                      <input type="text" class="form-control datePicker datePicker3 genchoubi" name="genchoubi[]" autocomplete="off"
                        value="{{isset($product->kanryoubi) ? $product->kanryoubi : null}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10">
                      <input type="hidden" class="datePickerHidden" >
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
                    <input type="text" class="form-control text-right genchoujikan" name="genchoujikan[]" maxlength="4" value="{{isset($product->genchoujikan) ? $product->genchoujikan : null}}"
                    onblur="callforColon(this)" onfocus="callToRemoveColon(this)">
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 25%;">
                    <div class="input-group input-group-sm">
                      <input type='hidden' class="houseEntry" id="houseEntry-{{ $loop->index }}" name="houseEntry[]" value="{{ isset($product->houseentry) ? $product->houseentry : ''}}" />
                      <textarea class="form-control comment" hidden="hidden" name="comment[]" id="comment-{{ $loop->index }}" style=" display: none;">{{isset($product->comment) ? $product->comment : ''}}</textarea>
                      <input type="text" class="form-control deliveryDestination" placeholder="納品先" name="nouhinsaki[]" readonly=""
                      id="deliveryDestination-{{ $loop->index }}"
                      value="{{ \App\AllClass\order\orderEntry\OrderEntry::convertNumberToString($product->datachar06, 'r17_3') }}">
                      <input type="hidden" readonly
                      class="form-control deliveryDestination_db db_hidden_field"
                      id="deliveryDestination-{{ $loop->index }}_db" name="deliveryDestination[]"
                      value="{{ $product->datachar06 }}">
                      <!-- <div class="input-group-append">
                        <button onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','required','r17_3',1,event.preventDefault())"
                         class="input-group-text btn sold_to_modal_opener"
                         name="nouhinsaki-button[]"><i class="fas fa-arrow-left"></i></button>
                      </div> -->
                      <div class="input-group-append" >
                        <button type="button" id="deliveryDestinationModal"
                        class="input-group-text btn delivery_destination_opener" name="nouhinsaki-button"><i class="fas fa-arrow-left"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
                    <input type="text" class="form-control text-right juchubangou" name="juchubangou[]" maxlength="10" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="{{$product->syouhinid}}" >
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 3%;">
                    <input type="text" class="form-control juchubangougyou" name="juchubangougyou[]" maxlength="3" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="{{$product->syouhinsyu}}" >
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 3%;">
                    <input type="text" class="form-control juchubangougyoueda"  name="juchubangougyoueda[]" maxlength="3" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="{{$product->hantei}}">
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 9%;">
                    <div class="custom-arrow">
                    <select class="form-control left_select siharaikazeikubun" id="siharaikazeikubun-{{ $loop->index }}" name="siharaikazeikubun[]">
                    @foreach ($siharaikazeikubun as $categoryKanri)
                      <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" {{ ($categoryKanri->category2 . $categoryKanri->category4 == $product->datachar18) ? 'selected' : '' }}>
                          {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                      </option>
                    @endforeach               
                    </select>
                    </div>
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
                    <input type="text" class="form-control siharaizeihasuukubun" value="" id="siharaizeihasuukubun-{{ $loop->index }}" name="siharaizeihasuukubun[]" readonly>
                  </div>
                  <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
                    <input type="text" class="form-control text-right syouhizei" id="syouhizei-{{$loop->index}}" name="syouhizei[]" value="{{ $product->soukobango ?  numberFormat($product->soukobango): 0 }}" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
@else        
  <div class="row line-form" data-setcode="" style="margin-top:32px;" id="LineBranch1">
    <script type="text/javascript">
            productRows[1] = 1;
    </script>
    <div class="col-12">
      <div class="data-wrapper-content" style="width: 100%;">
        <div class="data-box-content"
          style="width: 7%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
          <div style="padding: 15px 0px;height: 76px;">
            <div style="width:100%;">
              <input type="hidden" class="serial" name="serial[]">
              <input type="hidden" class="deletedProduct" name="deletedProduct[]" value="0" />
              <input type="hidden" class="setcode" name="setcode[]">
              <div style="color: #fff;">
                <span id="lineValue" class="lineValue">1</span>
                <input type="hidden" class="line-input" name="line[]" readonly="" >
              </div>
            </div>
            <div style="width:100%;float:left;margin-top: 7px;">
              <div style="width:50%;float:left;color: #fff;">
                <button class="btn lineBtn" id="lineBtn"name="gyoutuika"
                  style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 24px;font-size:12px;background-color: #4dbdd9;color: #fff;cursor: pointer;"><i
                    class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
              <div style="width:50%;float:left;color: #fff;">
                <button class="btn delBtn" id="delBtn" name="gyousakujo" 
                  style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;"><i
                    class="fa fa-trash" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="data-box-content2 custom-form text-center orderentry-databox"
          style="width: 93%;float: left;">
          <div style="width: 100%;float: left;">
            <div class="data-box float-left" style="padding: 5px; width: 10%;">
              <div class="input-group">
                <input type="text" class="form-control productCd productSubOrCdTarget" id="productCd" name="syouhincd[]" readonly="" >
                <div class="input-group-append">
                <input type="hidden" name="denpyohakkoubi[]" id="denpyohakkoubi" value="">
                <input type="hidden" class="selectValue">
                          <input type="hidden" class="syohin_data100" id="syohin_data100" />
                          <input type="hidden" class="syohin_product_status" id="syohin_product_status" />
                          <input type="hidden" class="syohin_product_count" id="syohin_product_count" />
                          <input type="hidden" value="" class="dataChar13Status" name="data_char13[]">
                          <input type="hidden" class="dspbango" id="dspbango" />
                          <input type="hidden" class="shoyin_kongouritsu" id="shoyin_kongouritsu" />
                          <input type="hidden" class="shoyin_mdjouhou" id="shoyin_mdjouhou" />
                          <input type="hidden" class="shoyin_color" name=shoyin_color[] id="shoyin_color" />
                          <input type="hidden" class="shoyin_tokuchou" id="shoyin_tokuchou" />
                          <input type="hidden" class="shoyin_data22" id="shoyin_data22" />
                          <input type="hidden" class="shoyin_data51" id="shoyin_data51" />
                  <button type="button" 
                    class="btn btn-outline-secondary productModalOpener" name="syouhincd-kensaku" style="color: white; "><i class="fa fa-arrow-left"
                      aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 15%;">
              <div class="input-group">
                <input type="text" class="form-control manufacturerPartNumber" name="me_ka_hinban[]" maxlength="13" >
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 30%;">
              <div class="input-group">
                <input type="text" class="form-control productName" name="productName[]" maxlength="40" >
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
              <input type="text" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                class="form-control text-right quantity" name="quantity[]" maxlength="5" onblur="callforComma(this)"
                onfocus="callToRemoveComma(this)">
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
              <input type="text" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                class="form-control text-right price" name="price[]" maxlength="8" onblur="callforComma(this)"
                onfocus="callToRemoveComma(this)" >
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
              <input type="text"  oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d{1})\d+/g, '$1');"
                class="form-control text-right rate" name="rate[]" maxlength="5" >
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
              <input type="text" class="form-control text-right partitionUnitPrice" name="partitionUnitPrice[]"  readonly>
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 10%;border-right: 0 !important;">
              <input type="text" class="form-control text-right orderAmount" name="orderAmount[]"  readonly>
            </div>
          </div>
        </div>

        <div class="data-box-content2 text-center custom-form orderentry-databox"
          style="width: 93%;float: left;">
          <div style="width: 100%;float: left;">
            <div class="data-box float-left" style="padding: 5px; width: 11%;">
              <div class="input-group">
                <input type="text" class="form-control datePicker datePicker2 kobetunouki" id="kobetunouki" name="kobetunouki[]" autocomplete="off"
                  value="" placeholder="年/月/日"
                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                  maxlength="10">
                <input type="hidden" class="datePickerHidden" >
              </div>
            </div>
            <div class="data-box float-left vertical-line"
              style="padding: 5px; width: 5%;height: 37px;border-right: 0 !important;">
              <label class="checkbox_container header-checkbox">
                <input type="hidden" class="checkboxInput" name="saitan[]" value="2">
                <input class="checkAllCheckbox checkbox2" type="checkbox" id="saitan" >
                <span class="checkmark" style="top: 6px;left: 18px;"></span>
              </label>
            </div>
            <div class="data-box float-left vertical-line" style="padding: 5px; width: 11%;">
              <div class="input-group">
                <input type="text" class="form-control datePicker datePicker3 genchoubi" id="genchoubi" name="genchoubi[]" autocomplete="off"
                  value="" placeholder="年/月/日"
                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                  maxlength="10">
                <input type="hidden" class="datePickerHidden" >
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px; width: 5%;border-right: 0 !important;">
              <input type="text" class="form-control text-right genchoujikan" name="genchoujikan[]" value="" maxlength="4" 
              onblur="callforColon(this)" onfocus="callToRemoveColon(this)">
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 25%;">
              <div class="input-group input-group-sm">
                <input type='hidden' class="houseEntry" id="houseEntry" name="houseEntry[]" />
                <textarea class="form-control comment" hidden="hidden" name="comment[]" id="comment" style=" display: none;"></textarea>
                <input type="text" class="form-control deliveryDestination"
                id="deliveryDestination"placeholder="納品先" name="nouhinsaki[]" readonly="">
                <input type="hidden" id="deliveryDestination_db" name="deliveryDestination[]"
                class="db_hidden_field deliveryDestination_db">
                <div class="input-group-append" >
                  <button type="button" id="deliveryDestinationModal"
                  class="input-group-text btn delivery_destination_opener" name="nouhinsaki-button"><i class="fas fa-arrow-left"></i></button>
                </div>
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
              <input type="text" class="form-control text-right juchubangou" name="juchubangou[]" maxlength="10" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" >
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 3%;">
              <input type="text" class="form-control juchubangougyou" id="juchubangougyou" name="juchubangougyou[]" maxlength="3" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" >
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 3%;">
              <input type="text" class="form-control juchubangougyoueda" name="juchubangougyoueda[]" maxlength="3" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" >
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 9%;">
              <div class="custom-arrow">
                <select class="form-control left_select siharaikazeikubun" id="siharaikazeikubun" name="siharaikazeikubun[]">
                @foreach ($siharaikazeikubun as $categoryKanri)
                  <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                      {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                  </option>
                @endforeach               
                </select>
              </div>
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
              <input type="text" class="form-control siharaizeihasuukubun" value="" id="siharaizeihasuukubun" name="siharaizeihasuukubun[]" readonly>
            </div>
            <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
              <input type="text" class="form-control text-right syouhizei" id="syouhizei" name="syouhizei[]" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endif

{{-- line confirm delation  modal start here --}}

<div class="modal custom-data-modal" data-backdrop="static" id="confirm_line_delation_Modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>明細行削除確認</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white" id="table-basic">
                        <tbody class="pl-4 pr-4">
                            <!-- <tr>
                                <td style="width: 150px;padding-left: 0px;padding-top: 17px;">
                                  <div class="line-icon-box"></div>発出備考</td>
                                 <td style="width: 840px;padding: 16px 0px;">
                                    <span class="inner" style="padding:10px;background: #fff;display: block;color:#9b9b9b;border-radius: 4px;padding: 0px 5px 30px;"> 発出備考を入力（全角XX文字まで）</span>
                                </td>
                              </tr> -->
                            <tr>

                                <td
                                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                                    <div class="" id="confrim_before_delete_juchu">
                                        999999999-999-999は発注出荷等処理済です。
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td
                                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 10px 0px !important;border-bottom: 0px!important;">
                                    <div>
                                        発注出荷の削除を実施してください。
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td
                                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                                    <div class="">
                                        現在行を削除してよろしいですか？
                                    </div>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button" id="cancel_line_delete" class="btn text-white w-145 bg-default"
                        data-dismiss="modal"><i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="juchusyukko_check_delete" class="btn w-145 bg-teal text-white ml-2">
                        <!--  <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->削除
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- line confirm delation modal end end here --}}
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
<script type="text/javascript">
    function numberColonFormat(num) {
        if (num) {
            return num.toString().replace(/(\d)(?=(\d{2})+(?!\d))/g, '$1:');
        }
        return null;
    }

    function callforColon(self) {
        var test = numberColonFormat(self.value);
        self.value = test;
    }

    function callToRemoveColon(self) {
        var test = self.value.replace(/:+/g, '')
        self.value = test;
    }
</script>
      