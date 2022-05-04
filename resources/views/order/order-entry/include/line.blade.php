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

    /*if (typeofFunction != "1 新規作成") {
       document.cookie="typeoffunction=1";
    }else{
       document.cookie="typeoffunction=2";
    }*/
</script>
<input id='innerlevel' value='{{$tantousya->innerlevel}}' type='hidden'/>

<input type="hidden" id='selected_category' name="selected_category" value="{{ $creation_category ?? '' }}">
@if (isset($products))
    @php
        $j = array_fill(1, sizeof($products), 0);
    @endphp
    @foreach ($products as $product)
        @php
            $i++;
            $parent = 0;
            if ($product->hantei == '0') {
                foreach ($products as $k => $val) {
                    if ($product->syouhinsyu == $val->syouhinsyu && $val->yoteimeter != '2') {
                        $parent++;
                    }
                }
            }
            $idoutanabango = $product->idoutanabango;
            if ($idoutanabango) {
                $setProduct = explode('-', explode(',', $idoutanabango)[0]);
                $setProductParent = $setProduct[0];
                $setProductChild = $setProduct[1];
                if ($setProductChild != '0') {
                    $product->juchusyukko_check = '2';
                }
                foreach ($products as $k => $val) {
                    $idoutanabango_c = $val->idoutanabango;
                    if ($idoutanabango_c && $setProductChild == '0') {
                        $setProduct_c = explode('-', explode(',', $idoutanabango_c)[0]);
                        $setProductParent_c = $setProduct_c[0];
                        $setProductChild_c = $setProduct_c[1];
                        if ($setProductParent == $setProductParent_c && $setProductChild_c != '0') {
                            if ($val->juchusyukko_check == '1') {
                                $product->juchusyukko_check = 1;
                            }
                        }
                    }
                }
            }

            if($creation_category == '1'){
                $dataint16 = 0;
            }else{
                $dataint16 = $product->dataint16;
            }
        @endphp
        {{-- cut from here and paste to line 91-97 --}}
        @php
            $currProduct = '';
            $idotanabango = $product->idoutanabango ? explode(',', $product->idoutanabango)[0] ?? null : null;
            $percentage = $product->idoutanabango ? explode(',', $product->idoutanabango)[1] ?? null : null;
            $currSetProduct = $idotanabango ?? false;
            if ($currSetProduct) {
                $currProduct = explode('-', $currSetProduct)[1] == 0 ? 'parent_product' : 'child_product';
            } else {
                $currProduct = 'normal_product';
            }
            $productYoteimeterStatus = $product->yoteimeter == 2 ? true : false;
            $delButtonStatus = $currProduct == 'child_product' || $productYoteimeterStatus;
            $lineButtonStatus = $currProduct == 'child_product' || $productYoteimeterStatus;
            $copyButtonStatus = $currProduct == 'child_product' || $currProduct == 'parent_product' || $productYoteimeterStatus;
            $branchButtonStatus = $currProduct == 'child_product' || $currProduct == 'parent_product' || $productYoteimeterStatus;
            $isChild = $currProduct == 'child_product';
            $isParent = $currProduct == 'parent_product';
            $seStatus = $currProduct == 'parent_product' || $parent > 1;
            $instituteStatus = $currProduct == 'parent_product' || $parent > 1;
            $shipStatus = $currProduct == 'parent_product' || $parent > 1;
            $purchaseStatus = $currProduct == 'parent_product' || $parent > 1;
            $syouhin1Data24Status = $product->syouhin1data24 != '1 訂正可' && $_COOKIE['typeoffunction'] == '2 受注訂正' ? 'readonly' : '';
        @endphp
        <div class="row mt-2 line-form" data-setcode="{{ $idotanabango }}" id="LineBranch{{ $i }}">
            <script type="text/javascript">
                /*productRows[{{ $i }}] = [[{{ $product->syouhinsyu }},{{ $product->hantei }}]];*/
                productRows[{{ $i }}] = {
                    0: {{ $product->syouhinsyu }},
                    1: {{ $product->hantei }}
                };
            </script>
            <div class="col-12 data-container">
                <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content"
                        style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div class="branchLineContainer" style="padding: 15px 0px;height: 76px;">
                            <input type="hidden" value="{{ $product->dataint02 }}" class="serial"
                                id="serial-{{ $loop->index }}" name="serial[]">
                            <input type="hidden" class="deletedProduct" name="deletedProduct[]"
                                value="@if($creation_category == 1){{0}}@else{{ $product->yoteimeter }}@endif" />
                            <input type="hidden" value="{{ $idotanabango }}" id="setcode-{{ $loop->index }}"
                                class="setcode" name="setcode[]">
                            <div style="width:100%;float:left;">
                                <div class="checkHasUnderline" @if ($product->juchusyukko_check == '1' && ($_COOKIE['typeoffunction'] == '3 受注削除' || $_COOKIE['typeoffunction'] == '2 受注訂正')) style="width:70%;float:left;color: #fff;text-decoration:underline;"
        @else style="width:70%;float:left;color: #fff;" @endif>
                                    @if ($product->juchusyukko_check == '1' && ($_COOKIE['typeoffunction'] == '3 受注削除' || $_COOKIE['typeoffunction'] == '2 受注訂正'))
                                        <input type="hidden" name="juchusyukko_check" value="1">
                                    @else
                                        <input type="hidden" name="juchusyukko_check" value="0">
                                    @endif
                                    <span id="lineValue-{{ $loop->index }}"
                                        class="lineValue">{{ $product->syouhinsyu }}</span>
                                    <input type="hidden" class="line-input" name="line[]"
                                        value="{{ $product->syouhinsyu }}">

                                    <span>-</span>
                                    <span id="branchValue-{{ $loop->index }}"
                                        class="branchValue">{{ $product->hantei }}</span>
                                    <input type="hidden" class="branch-input" name="branch[]"
                                        value="{{ $product->hantei }}">
                                </div>
                                <div style="width:30%;float:left;">
                                    <button class="btn delBtn" id="delBtn-{{ $loop->index }}" @if ($delButtonStatus) disabled @endif
                                        style="background-color: #FF6767;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div style="width:100%;float:left;margin-top: 7px;">
                                <div style="width:33.33%;float:left;color: #fff;">
                                    <button class="btn lineBtn" id="lineBtn-{{ $loop->index }}" @if ($lineButtonStatus) disabled @endif
                                        style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div style="width:33.33%;float:left;color: #fff;">
                                    <button class="btn branchBtn" id="branchBtn-{{ $loop->index }}" @if ($branchButtonStatus) disabled @endif
                                        style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #F59B4C;color: #fff;cursor: pointer;">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div style="width:33.33%;float:left;">
                                    <button class="btn repeat repeatBtn" id="repeatBtn-{{ $loop->index }}" @if ($copyButtonStatus) disabled @endif
                                        style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;margin-left:3px;background-color: #5397E9;color: #fff;cursor: pointer;">
                                        複
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data-box-content2 custom-form text-center orderentry-databox delete-area
                    @if (($product->yoteimeter == 2 && $creation_category != 1) || ($_COOKIE['typeoffunction'] == '1 新規作成' &&
                        $_COOKIE['typeOfCategoyKanri'] == 'U150' && $_COOKIE['hikitasukko_val'] == 1)) invoke-delete @endif"
                        style="width: 90%;float: left;">
                        <div style="width: 100%;float: left;">
                            <div class="data-box float-left" style="padding: 5px; min-width: 130px;width:12%;">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control productCd productSubOrCdTarget"
                                        id="productCd-{{ $loop->index }}" name="productCd[]"
                                        value="{{ $product->kawasename }}">
                                    @php
                                        [$data100, $childCount, $color] = \App\AllClass\order\orderEntry\OrderEntry::getChildCount($product->kawasename);
                                    @endphp
                                    <div class="input-group-append">
                                        <input type="hidden" class="selectValue">
                                        <input type="hidden" value="{{ $data100 }}" class="syohin_data100"
                                            id="syohin_data100-{{ $loop->index }}" />
                                        <input type="hidden" class="syohin_product_status"
                                            id="syohin_product_status-{{ $loop->index }}" />
                                        <input type="hidden" value="{{ $childCount }}" class="syohin_product_count"
                                            id="syohin_product_count-{{ $loop->index }}" />
                                        <input type="hidden" value="" class="dataChar13Status" name="data_char13[]">
                                        <input type="hidden" class="dspbango" id="dspbango-{{ $loop->index }}" />
                                        <input type="hidden" class="shoyin_kongouritsu"
                                            id="shoyin_kongouritsu-{{ $loop->index }}" />
                                        <input type="hidden" class="shoyin_mdjouhou"
                                            id="shoyin_mdjouhou-{{ $loop->index }}" />
                                        <input type="hidden" class="shoyin_color" name=shoyin_color[]
                                            id="shoyin_color-{{ $i }}" value={{ $color }} />
                                        <input type="hidden" class="shoyin_tokuchou"
                                            id="shoyin_tokuchou-{{ $loop->index }}" />
                                        <input type="hidden" class="shoyin_data22"
                                            id="shoyin_data22-{{ $loop->index }}" />
                                        <input type="hidden" class="shoyin_data51"
                                            id="shoyin_data51-{{ $loop->index }}" />

                                        <button type="button" class="btn btn-outline-secondary productModalOpener" @if ($isChild) disabled @endif
                                            style="background-color: grey;color: white; ">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="data-box float-left" style="padding: 5px; min-width: 340px;width:35%;">
                                <div class="input-group">
                                    <input type="text" class="form-control productName " @if ($isChild) readonly @endif
                                        id="productName-{{ $loop->index }}" maxlength="40" name="productName[]"
                                        {{ $syouhin1Data24Status }} value="{{ $product->syouhinname }}">
                                    <div class="input-group-append">
                                        <button class="btn rounded viewProductDes "
                                            style="margin-left: 4px;color: #fff;">
                                            <i class="fa fa-clone" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="data-box float-left" style="padding: 5px; min-width: 140px;width:15%;">
                                <div class="input-group">
                                    <input type="text" class="form-control input_field datePicker orderDate"
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="10" name="orderDate[]" autocomplete="off" placeholder="発注日　年/月/日"
                                        style="width: 96px!important;" value="{{ $product->dataint09 }}">
                                    <input type="hidden" class="datePickerHidden">

                                </div>
                            </div>
                            <div class="data-box float-left" style="padding: 5px; min-width: 140px;width:15%;">
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control input_field datePicker individualDeliveryDate"
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="10" name="individualDeliveryDate[]" autocomplete="off"
                                        placeholder="個別納期 年/月/日" style="width: 96px!important;"
                                        value="{{ $product->dataint10 }}">
                                    <input type="hidden" class="datePickerHidden">
                                </div>
                            </div>
                            <div class="data-box float-left " style="padding: 5px; min-width: 249px;width:23%;">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control deliveryDestination"
                                        id="deliveryDestination-{{ $loop->index }}"
                                        value="{{ \App\AllClass\order\orderEntry\OrderEntry::convertNumberToString($product->datachar06, 'r17_3') }}">
                                    <input type="hidden" readonly
                                        class="form-control deliveryDestination_db db_hidden_field"
                                        id="deliveryDestination-{{ $loop->index }}_db" name="deliveryDestination[]"
                                        value="{{ $product->datachar06 }}">

                                    <div class="input-group-append">
                                        <button type="button"
                                            onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','required','r17_3',1,event.preventDefault())"
                                            class="btn btn-outline-secondary sold_to_modal_opener"
                                            style=" background-color: grey;color: white;"><i class="fa fa-arrow-left"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data-box-content2 text-center custom-form orderentry-databox delete-area
                    @if (($product->yoteimeter == 2 && $creation_category != 1) || ($_COOKIE['typeoffunction'] == '1 新規作成' &&
                        $_COOKIE['typeOfCategoyKanri'] == 'U150' && $_COOKIE['hikitasukko_val'] == 1)) invoke-delete @endif"
                        style="width: 90%;float: left;">
                        <div style="width: 100%;float: left;">
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 122px;width:14%;border-right: 0 !important; border-left: 0 !important;">
                                <input type="text" class="form-control unit" name="unit[]"
                                    {{ $syouhin1Data24Status }} value="{{ $product->codename }}">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 65px; width:8%;border-right: 0 !important;">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                    class="form-control text-right quantity" name="quantity[]"
                                    min="1" @if ($isChild) readonly @endif
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                                    value="{{ $product->syukkasu ? numberFormat($product->syukkasu) : null }}">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 90px;width:8%;border-right: 0 !important;">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                    class="form-control text-right unitSellingPrice" name="unitSellingPrice[]" @if ($isChild) readonly @endif
                                    value="{{ $product->dataint04 ? numberFormat($product->dataint04) : null }}"
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                            </div>
                            <div class="data-box float-left price"
                                style="padding: 12px 0px; min-width: 88px;width:8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                                {{ $product->dataint11 ?? '' }}
                            </div>
                            <input type="hidden" class="priceCell" name="price[]"
                                value="{{ $product->dataint11 ?? '' }}">
                            <input type="hidden" class="percentage" name="percentage[]" value="{{ $percentage }}">

                            <div class="data-box float-left vertical-line grossProfit"
                                style="padding: 12px 0px; min-width: 88px;width:8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                                {{ $product->dataint12 ? numberFormat(str_replace(',','',$product->dataint12)-$dataint16) : '' }}
                            </div>
                            <input type="hidden" class="grossProfitCell" name="grossProfit[]"
                                value="{{ $product->dataint12 ?? '' }}">
                            <input type="hidden" name="dataint16[]" class="dataint16"
                                value="{{ $dataint16 ?? '' }}">
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 88px;width:8%;border-right: 0 !important;">

                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                    class="form-control text-right se" name="se[]" @if ($isParent || $seStatus) readonly @endif
                                    value="{{ $product->dataint05 ? numberFormat($product->dataint05) : 0 }}"
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px;float: left; min-width: 90px;width:9%;">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                    class="form-control text-right institute" name="institute[]" @if ($isParent || $instituteStatus) readonly @endif
                                    value="{{ $product->dataint06 ? numberFormat($product->dataint06) : 0 }}"
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px;float: left; min-width: 91px;width:8%;">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                    class="form-control text-right ship" name="ship[]" @if ($isParent || $shipStatus) readonly @endif
                                    value="{{ $product->dataint07 ? numberFormat($product->dataint07) : 0 }}"
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px;float: left; min-width: 91px;width:8%;">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                    class="form-control text-right purchase" name="purchase[]" @if ($isParent || $purchaseStatus) readonly @endif
                                    value="{{ $product->dataint08 ? numberFormat($product->dataint08) : 0 }}"
                                    onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px;float: left; min-width: 93px;width:11%;">
                                <div class="custom-arrow">
                                    <select class="form-control left_select font-weight-bold sales" name="sales[]">
                                        <option value="">選択なし</option>
                                        @foreach ($sales as $sale)
                                            <option value="{{ $sale->bango }}" @if ($sale->bango == $product->datachar01) selected
                                    {{-- @elseif($sale->bango == $bango && $_COOKIE['typeoffunction'] == '1 新規作成') --}}
                                    {{-- selected --}} @endif>{{ $sale->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px;float: left;min-width: 93px;width:10%;">
                                <div class="custom-arrow">
                                    <select class="form-control left_select font-weight-bold se2" name="se2[]">
                                        <option value="">選択なし</option>
                                        @foreach ($ses as $se)
                                            <option value="{{ $se->bango }}" @if ($se->bango == $product->datachar02) selected @endif> {{ $se->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-box-content3 custom-form orderentry-databox  text-center delete-area
                @if (($product->yoteimeter == 2 && $creation_category != 1) || ($_COOKIE['typeoffunction'] == '1 新規作成' &&
                    $_COOKIE['typeOfCategoyKanri'] == 'U150' && $_COOKIE['hikitasukko_val'] == 1)) invoke-delete @endif"
                    style="width: 100%;float: left;">
                    <div style="width: 100%;float: left;">
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 294px;width:25%;border-right: 0 !important; border-left: 0 !important;">
                            <div class="input-group">
                                <input type="text" class="form-control productSubCd productSubOrCdTarget"
                                    id="productSubCd-{{ $loop->index }}" readonly name="productSubCd[]"
                                    value="{{ $product->barcode }}">
                                <!-- $product->barcode ? explode(' ',$product->barcode)[0] : '' -->
                                <input type="hidden" id="productSubName-{{ $loop->index }}" class="productSubName"
                                    name="productSubName[]"
                                    value="{{ $product->barcode ? str_replace(explode(' ', $product->barcode)[0], '', $product->barcode) : '' }}" />
                                <div class="input-group-append">
                                    <button type="button" readonly @if ($isChild) disabled @endif
                                        class="btn btn-outline-secondary product_sub_modal_opener"
                                        style="background-color: grey;color: white;border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                    <button class="btn rounded  viewProductDes" style="margin-left: 4px;color: #fff;"><i
                                            class="fa fa-clone" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 148px;width:12%;border-right: 0 !important;">
                            <div class="input-group">
                                @php
                                    $issueNote = $product->datachar07 ? mb_substr($product->datachar07, 0, 2) : '';
                                    $datachar09 = $product->datachar09;
                                    $category1 = substr($datachar09, 0, 2);
                                    $category2 = substr($datachar09, 2, 2);
                                    $syouhinbango = $product->datachar15;
                                    $deliveryMethod = \App\AllClass\order\orderEntry\OrderEntry::getDeliveryMethods($category1, $category2);
                                    $continutionCategory = \App\AllClass\order\orderEntry\OrderEntry::getContinutionCategory($syouhinbango);
                                    $datachar09 = preg_replace('/[0-9 ]/', '', $deliveryMethod);
                                    $datachar15 = preg_replace('/[0-9 ]/', '', $continutionCategory);
                                    $deliveryMethod = $datachar09 ? '/' . mb_substr($datachar09, 0, 2) : '';
                                    $continutionCategory = $datachar15 ? '/' . mb_substr($datachar15, 0, 2) : '';
                                    $shippingInstructionVal = $issueNote . '' . $deliveryMethod . '' . $continutionCategory;
                                @endphp
                                <input type="text" class="form-control shippingInstruction"
                                    id="shippingInstruction-{{ $loop->index }}" readonly
                                    value="{{ $shippingInstructionVal }}" name="shippingInstruction[]">
                                <input type="hidden" class="issueNote" id="issueNote-{{ $loop->index }}"
                                    name="issueNote[]" value="{{ $product->datachar07 }}">
                                <input type="hidden" class="statementRemarks"
                                    id="statementRemarks-{{ $loop->index }}" name="statementRemarks[]"
                                    value="{{ $product->datachar08 }}">
                                <input type="hidden" class="deliveryMethod" id="deliveryMethod-{{ $loop->index }}"
                                    name="deliveryMethod[]" value="{{ $product->datachar09 }}">
                                <input type="hidden" class="continutionCategory"
                                    id="continutionCategory-{{ $loop->index }}" name="continutionCategory[]"
                                    value="{{ $product->datachar15 }}">
                                <input type="hidden" class="newVup" id="newVup-{{ $loop->index }}" name="newVup[]"
                                    value="{{ $product->datachar16 }}">
                                <input type="hidden" class="vupCategory" id="vupCategory-{{ $loop->index }}"
                                    value="{{ $product->datachar17 }}" name="vupCategory[]">
                                <input type="hidden" class="flatContract" id="flatContract-{{ $loop->index }}"
                                    value="{{ $product->datachar21 }}" name="flatContract[]">

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary shipping_modal_opener"
                                        style=" background-color: grey;color: white;">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 68px;width:6%;border-right: 0 !important;">
                            <div class="custom-arrow">
                                <select class="form-control left_select font-weight-bold maintenance"
                                    id="maintenance-{{ $loop->index }}" name="maintenance[]">
                                    {{-- <option value="">なし</option> --}}
                                    @foreach ($maintains as $categoryKanri)
                                        @php
                                            $maintain_value = $categoryKanri->category1 . '' . $categoryKanri->category2;
                                        @endphp
                                        <option @if ($maintain_value == $product->datachar12) selected
            @elseif($maintain_value == 'E92' && ! $product->datachar12)
                                selected @endif value="{{ $maintain_value }}">
                                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 260px;width:25%;border-right: 0 !important;">
                            <div class="input-group ">
                                <input type="text" readonly class="form-control supplier"
                                    id="supplier-{{ $loop->index }}"
                                    value="{{ \App\AllClass\order\orderEntry\OrderEntry::convertNumberToString($product->datachar05, 'r17_3') }}" />
                                <input type="hidden" value="{{ $product->datachar05 }}"
                                    id="supplier_db-{{ $loop->index }}" name="supplier[]"
                                    class="db_hidden_field supplier_db" />
                                <div class="input-group-append">
                                    <button type="button"
                                        onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','nullable','r17_3',1,event.preventDefault())"
                                        class="btn btn-outline-secondary sold_to_modal_opener"
                                        style=" background-color: grey;color: white;">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 130px;width:12%;border-right: 0 !important;">
                            <input type="text" class="form-control manufacturePartNumber"
                                id="manufacturePartNumber-{{ $loop->index }}"
                                value="{{ $product->datachar03 ?? null }}" name="manufacturePartNumber[]">
                        </div>
                        <div class="data-box float-left"
                            style="padding: 5px; min-width: 210px;width:20%;border-right: 0 !important;">
                            <input type="text" class="form-control manufactureProductName"
                                id="manufactureProductName-{{ $loop->index }}"
                                value="{{ $product->datachar04 ?? null }}" name="manufactureProductName[]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $lastChild = $idotanabango ?? null;
            if ($lastChild) {
                $lastChild = explode('-', $lastChild);
            }
        @endphp
        @if (isset($lastChild[1]) && $lastChild[1] == '2' && $product->hantei != '0' && $product->hantei != '2')

            @php
                $i++;
                $newHantei = (int) $product->hantei + $j[$product->syouhinsyu];

                foreach ($products as $k => $val) {
                    if ($val->syouhinsyu == $product->syouhinsyu) {
                        if ($newHantei < (int) $val->hantei + $j[$product->syouhinsyu]) {
                            $newHantei = (int) $val->hantei + $j[$product->syouhinsyu];
                        }
                    }
                }
                $j[$product->syouhinsyu] = $j[$product->syouhinsyu] + 1;

            @endphp

            <div class="row mt-2 line-form" data-setcode="" id="LineBranch{{ $i }}">
                <script type="text/javascript">
                    productRows[{{ $i }}] = {
                        0: {{ $product->syouhinsyu }},
                        1: {{ (int) $newHantei + 1 }}
                    };
                </script>
                <div class="col-12 data-container">
                    <div class="data-wrapper-content" style="width: 100%;">
                        <div class="data-box-content"
                            style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px ;vertical-align: middle;border-radius: 5px 0px 5px;">
                            <input type="hidden" id="parentPrice" />
                            <div class="branchLineContainer" style="padding: 15px 0px;height: 76px;">
                                <input type="hidden" value="{{ $i }}" class="serial" name="serial[]">
                                <input type="hidden" class="deletedProduct" name="deletedProduct[]" value="0" />
                                <input type="hidden" class="setcode" name="setcode[]">
                                <div style="width:100%;float:left;">
                                    <div style="width:70%;float:left;color: #fff;">
                                        <span id="lineValue-{{ $i }}" class="lineValue">
                                            {{ $product->syouhinsyu }}
                                        </span>
                                        <input type="hidden" value="{{ $product->syouhinsyu }}" class="line-input"
                                            name="line[]">

                                        <span>-</span>
                                        <span id="branchValue-{{ $i }}"
                                            class="branchValue">{{ (int) $newHantei + 1 }}</span>
                                        <input type="hidden" class="branch-input" value="{{ (int) $newHantei + 1 }}"
                                            name="branch[]">
                                    </div>
                                    <div style="width:30%;float:left;">
                                        <button class="btn delBtn" id="delBtn-{{ $i }}"
                                            {{-- @if ($delButtonStatus) disabled @endif --}}
                                            style="background-color: #FF6767;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div style="width:100%;float:left;margin-top: 7px;">
                                    <div style="width:33.33%;float:left;color: #fff;">
                                        <button class="btn lineBtn" id="lineBtn-{{ $i }}"
                                            {{-- @if ($lineButtonStatus) disabled @endif --}}
                                            style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div style="width:33.33%;float:left;color: #fff;">
                                        <button class="btn branchBtn" id="branchBtn-{{ $i }}"
                                            {{-- @if ($branchButtonStatus) disabled @endif --}}
                                            style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #F59B4C;color: #fff;cursor: pointer;">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div style="width:33.33%;float:left;">
                                        <button class="btn repeat repeatBtn" id="repeatBtn-{{ $i }}"
                                            {{-- @if ($copyButtonStatus) disabled @endif --}}
                                            style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;margin-left:3px;background-color: #5397E9;color: #fff;cursor: pointer;">
                                            複
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data-box-content2 custom-form text-center orderentry-databox delete-area "
                            style="width: 90%;float: left;">
                            <div style="width: 100%;float: left;">
                                <div class="data-box float-left" style="padding: 5px; min-width: 130px;width:12%;">
                                    <div class="input-group">
                                        <input type="text" readonly class="form-control productCd productSubOrCdTarget "
                                            id="productCd{{ $i }}" name="productCd[]">
                                        <div class="input-group-append">
                                            <input type="hidden" class="selectValue">
                                            <input type="hidden" class="syohin_data100"
                                                id="syohin_data100-{{ $i }}" />
                                            <input type="hidden" class="syohin_product_status"
                                                id="syohin_product_status-{{ $i }}" />
                                            <input type="hidden" class="syohin_product_count"
                                                id="syohin_product_count-{{ $i }}" />
                                            <input type="hidden" value="" class="dataChar13Status" name="data_char13[]">
                                            <input type="hidden" class="dspbango" id="dspbango-{{ $i }}" />
                                            <input type="hidden" class="shoyin_kongouritsu"
                                                id="shoyin_kongouritsu-{{ $i }}" />
                                            <input type="hidden" class="shoyin_mdjouhou"
                                                id="shoyin_mdjouhou-{{ $i }}" />
                                            <input type="hidden" class="shoyin_color" name=shoyin_color[]
                                                id="shoyin_color-{{ $i }}" />
                                            <input type="hidden" class="shoyin_tokuchou"
                                                id="shoyin_tokuchou-{{ $i }}" />
                                            <input type="hidden" class="shoyin_data22"
                                                id="shoyin_data22-{{ $i }}" />
                                            <input type="hidden" class="shoyin_data51"
                                                id="shoyin_data51-{{ $i }}" />
                                            <button type="button" class="btn btn-outline-secondary productModalOpener"
                                                style="background-color: grey;color: white; ">
                                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="data-box float-left" style="padding: 5px; min-width: 340px;width:35%;">
                                    <div class="input-group">
                                        <input type="text" class="form-control productName"
                                            id="productName-{{ $i }}" maxlength="40" name="productName[]">
                                        <div class="input-group-append">
                                            <button class="btn rounded  viewProductDes"
                                                style="margin-left: 4px;color: #fff;">
                                                <i class="fa fa-clone" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="data-box float-left" style="padding: 5px; min-width: 140px;width:15%;">
                                    <div class="input-group">
                                        <input type="text" class="form-control input_field datePicker orderDate"
                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                            maxlength="10" name="orderDate[]" autocomplete="off" placeholder="発注日　年/月/日"
                                            style="width: 96px!important;">
                                        <input type="hidden" class="datePickerHidden">
                                    </div>
                                </div>
                                <div class="data-box float-left" style="padding: 5px; min-width: 140px;width:15%;">
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control input_field datePicker individualDeliveryDate"
                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                            maxlength="10" name="individualDeliveryDate[]" autocomplete="off"
                                            placeholder="個別納期 年/月/日" style="width: 96px!important;">
                                        <input type="hidden" class="datePickerHidden">
                                    </div>
                                </div>
                                <div class="data-box float-left " style="padding: 5px; min-width: 249px;width:23%;">
                                    <div class="input-group">
                                        <input type="text" readonly class="form-control deliveryDestination"
                                            id="deliveryDestination-{{ $i }}" />
                                        <input type="hidden" id="deliveryDestination_db-{{ $i }}"
                                            name="deliveryDestination[]" class="db_hidden_field deliveryDestination_db">
                                        <div class="input-group-append">
                                            <button type="button"
                                                onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','required','r17_3',1,event.preventDefault())"
                                                class="btn btn-outline-secondary sold_to_modal_opener"
                                                style=" background-color: grey;color: white;"><i
                                                    class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="data-box-content2 text-center custom-form orderentry-databox delete-area "
                            style="width: 90%;float: left;">
                            <div style="width: 100%;float: left;">
                                <div class="data-box float-left"
                                    style="padding: 5px; min-width: 122px;width:14%;border-right: 0 !important; border-left: 0 !important;">
                                    <input type="text" class="form-control unit" name="unit[]">
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px; min-width: 65px;width:8%;border-right: 0 !important;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                        class="form-control text-right quantity" name="quantity[]"
                                        onblur="callforComma(this)" onfocus="callToRemoveComma(this)" />
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px; min-width: 90px;width:8%;border-right: 0 !important;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                        class="form-control text-right unitSellingPrice" name="unitSellingPrice[]"
                                        onblur="callforComma(this)" onfocus="callToRemoveComma(this)" />
                                </div>
                                <div class="data-box float-left price"
                                    style="padding: 12px 0px; min-width: 88px;width:8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                                </div>
                                <input type="hidden" class="priceCell" name="price[]">
                                <input type="hidden" class="percentage" name="percentage[]" value="">
                                <div class="data-box float-left vertical-line grossProfit"
                                    style="padding: 12px 0px; min-width: 88px;width:8%;border-right: 0 !important;font-size: 13px;height: 38px;">

                                </div>
                                <input type="hidden" class="grossProfitCell" name="grossProfit[]">
                                <input type="hidden" name="dataint16[]" class="dataint16" value="">
                                <div class="data-box float-left"
                                    style="padding: 5px; min-width: 88px;width:8%;border-right: 0 !important;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                        class="form-control text-right se" name="se[]" onblur="callforComma(this)"
                                        onfocus="callToRemoveComma(this)">
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px;float: left; min-width: 90px;width:9%;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                        class="form-control text-right institute" name="institute[]"
                                        onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px;float: left; min-width: 91px;width:8%;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                        class="form-control text-right ship" name="ship[]" onblur="callforComma(this)"
                                        onfocus="callToRemoveComma(this)">
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px;float: left; min-width: 91px;width:8%;">
                                    <input type="text"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                        class="form-control text-right purchase" name="purchase[]"
                                        onblur="callforComma(this)" onfocus="callToRemoveComma(this)">
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px;float: left; min-width: 93px;width:11%;">
                                    <div class="custom-arrow">
                                        <select class="form-control left_select font-weight-bold sales" name="sales[]">
                                            <option value="">選択なし</option>
                                            @foreach ($sales as $sale)
                                                <option @if ($sale->bango == $bango) selected @endif
                                                    value="{{ $sale->bango }}">{{ $sale->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="data-box float-left"
                                    style="padding: 5px;float: left; min-width: 93px;width:10%;">
                                    <div class="custom-arrow">
                                        <select class="form-control left_select font-weight-bold se2" name="se2[]">
                                            <option value="">選択なし</option>
                                            @foreach ($ses as $se)
                                                <option value="{{ $se->bango }}">{{ $se->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data-box-content3 custom-form orderentry-databox  text-center delete-area "
                        style="width: 100%;float: left;">
                        <div style="width: 100%;float: left;">
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 294px;width:25%;border-right: 0 !important; border-left: 0 !important;">
                                <div class="input-group">
                                    <input type="text" class="form-control productSubCd productSubOrCdTarget"
                                        id="productSubCd-{{ $i }}" readonly name="productSubCd[]">
                                    <input type="hidden" id="productSubName-{{ $i }}"
                                        class="productSubName" name="productSubName[]" />
                                    <div class="input-group-append">
                                        <button type="button" readonly
                                            class="btn btn-outline-secondary product_sub_modal_opener"
                                            style="background-color: grey;color: white;border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                        <button class="btn rounded viewProductDes"
                                            style="margin-left: 4px;color: #fff;"><i class="fa fa-clone"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 148px;width:12%;border-right: 0 !important;">
                                <div class="input-group">
                                    <input type="text" class="form-control shippingInstruction"
                                        id="shippingInstruction-{{ $i }}" readonly
                                        name="shippingInstruction[]">
                                    <input type="hidden" class="issueNote" id="issueNote-{{ $i }}"
                                        name="issueNote[]">
                                    <input type="hidden" class="statementRemarks"
                                        id="statementRemarks-{{ $i }}" name="statementRemarks[]">
                                    <input type="hidden" class="deliveryMethod"
                                        id="deliveryMethod-{{ $i }}" name="deliveryMethod[]">
                                    <input type="hidden" class="continutionCategory"
                                        id="continutionCategory-{{ $i }}" name="continutionCategory[]">
                                    <input type="hidden" class="newVup" id="newVup-{{ $i }}"
                                        name="newVup[]">
                                    <input type="hidden" class="vupCategory" id="vupCategory-{{ $i }}"
                                        name="vupCategory[]">
                                    <input type="hidden" class="flatContract" id="flatContract-{{ $i }}"
                                        name="flatContract[]">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary shipping_modal_opener"
                                            style=" background-color: grey;color: white;">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 68px;width:6%;border-right: 0 !important;">
                                <div class="custom-arrow">
                                    <select class="form-control left_select font-weight-bold maintenance"
                                        id="maintenance-{{ $i }}" name="maintenance[]">
                                        {{-- <option value="">なし</option> --}}
                                        @foreach ($maintains as $categoryKanri)
                                            <option @if ($categoryKanri->category1 . $categoryKanri->category2 == 'E92') selected @endif
                                                value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 260px;width:25%;border-right: 0 !important;">
                                <div class="input-group ">
                                    <input type="text" readonly class="form-control supplier"
                                        id="supplier-{{ $i }}">
                                    <input type="hidden" id="supplier_db-{{ $i }}" name="supplier[]"
                                        class="db_hidden_field supplier_db">
                                    <div class="input-group-append">
                                        <button type="button"
                                            onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'2','nullable','r17_3',3,event.preventDefault())"
                                            class="btn btn-outline-secondary sold_to_modal_opener"
                                            style=" background-color: grey;color: white;">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 130px;width:12%;border-right: 0 !important;">
                                <input type="text" class="form-control manufacturePartNumber"
                                    id="manufacturePartNumber-{{ $i }}" name="manufacturePartNumber[]">
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; min-width: 210px;width:20%;border-right: 0 !important;">
                                <input type="text" class="form-control manufactureProductName"
                                    id="manufactureProductName-{{ $i }}" name="manufactureProductName[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="row mt-2 line-form" data-setcode="" id="LineBranch1">
        <script type="text/javascript">
            productRows[1] = {
                0: 1,
                1: 0
            };
        </script>
        <div class="col-12 data-container">
            <div class="data-wrapper-content" style="width: 100%;">
                <div class="data-box-content"
                    style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px ;vertical-align: middle;border-radius: 5px 0px 5px;">
                    <input type="hidden" id="parentPrice" />
                    <div class="branchLineContainer" style="padding: 15px 0px;height: 76px;">
                        <input type="hidden" class="serial" name="serial[]">
                        <input type="hidden" class="deletedProduct" name="deletedProduct[]" value="0" />
                        <input type="hidden" class="setcode" name="setcode[]">
                        <div style="width:100%;float:left;">
                            <div style="width:70%;float:left;color: #fff;">
                                <span id="lineValue" class="lineValue"></span>
                                <input type="hidden" class="line-input" name="line[]">

                                <span>-</span>
                                <span id="branchValue" class="branchValue"></span>
                                <input type="hidden" class="branch-input" name="branch[]">
                            </div>
                            <div style="width:30%;float:left;">
                                <button class="btn delBtn" id="delBtn"
                                    style="background-color: #FF6767;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div style="width:100%;float:left;margin-top: 7px;">
                            <div style="width:33.33%;float:left;color: #fff;">
                                <button class="btn lineBtn" id="lineBtn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div style="width:33.33%;float:left;color: #fff;">
                                <button class="btn branchBtn" id="branchBtn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;background-color: #F59B4C;color: #fff;cursor: pointer;">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div style="width:33.33%;float:left;">
                                <button class="btn repeat repeatBtn" id="repeatBtn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;margin-left:3px;background-color: #5397E9;color: #fff;cursor: pointer;">
                                    複
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-box-content2 custom-form text-center orderentry-databox delete-area"
                    style="width: 90%;float: left;">
                    <div style="width: 100%;float: left;">
                        <div class="data-box float-left" style="padding: 5px; width: 12%;">
                            <div class="input-group">
                                <input type="text" readonly class="form-control productCd productSubOrCdTarget "
                                    id="productCd" name="productCd[]">
                                <div class="input-group-append">
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
                                    <button type="button" class="btn btn-outline-secondary productModalOpener"
                                        style="background-color: grey;color: white; ">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 35%;">
                            <div class="input-group">
                                <input type="text" maxlength="40" class="form-control productName" id="productName"
                                    name="productName[]">
                                <div class="input-group-append">
                                    <button class="btn rounded  viewProductDes" style="margin-left: 4px;color: #fff;">
                                        <i class="fa fa-clone" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 15%;">
                            <div class="input-group">
                                <input type="text" class="form-control input_field datePicker orderDate"
                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    maxlength="10" name="orderDate[]" autocomplete="off" placeholder="発注日　年/月/日"
                                    style="width: 96px!important;">
                                <input type="hidden" class="datePickerHidden">
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 15%;">
                            <div class="input-group">
                                <input type="text" class="form-control input_field datePicker individualDeliveryDate"
                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    maxlength="10" name="individualDeliveryDate[]" autocomplete="off"
                                    placeholder="個別納期 年/月/日" style="width: 96px!important;">
                                <input type="hidden" class="datePickerHidden">
                            </div>
                        </div>
                        <div class="data-box float-left " style="padding: 5px; width: 23%;">
                            <div class="input-group">
                                <input type="text" readonly class="form-control deliveryDestination"
                                    id="deliveryDestination" />
                                <input type="hidden" id="deliveryDestination_db" name="deliveryDestination[]"
                                    class="db_hidden_field deliveryDestination_db">
                                <div class="input-group-append">
                                    <button type="button"
                                        onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','required','r17_3',1,event.preventDefault())"
                                        class="btn btn-outline-secondary sold_to_modal_opener"
                                        style=" background-color: grey;color: white;"><i class="fa fa-arrow-left"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-box-content2 text-center custom-form orderentry-databox delete-area"
                    style="width: 90%;float: left;">
                    <div style="width: 100%;float: left;">
                        <div class="data-box float-left"
                            style="padding: 5px; width: 14%;border-right: 0 !important; border-left: 0 !important;">
                            <input type="text" class="form-control unit" name="unit[]">
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                class="form-control text-right quantity" name="quantity[]" onblur="callforComma(this)"
                                onfocus="callToRemoveComma(this)" />
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                class="form-control text-right unitSellingPrice" name="unitSellingPrice[]"
                                onblur="callforComma(this)" onfocus="callToRemoveComma(this)" />
                        </div>
                        <div class="data-box float-left price"
                            style="padding: 12px 0px; width: 8%;border-right: 0 !important;font-size: 13px;height: 38px;">
                        </div>
                        <input type="hidden" class="priceCell" name="price[]">
                        <input type="hidden" class="percentage" name="percentage[]" value="">
                        <div class="data-box float-left vertical-line grossProfit"
                            style="padding: 12px 0px; width: 8%;border-right: 0 !important;font-size: 13px;height: 38px;">

                        </div>
                        <input type="hidden" class="grossProfitCell" name="grossProfit[]">
                        <div class="data-box float-left" style="padding: 5px; width: 8%;border-right: 0 !important;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control text-right se" name="se[]" onblur="callforComma(this)"
                                onfocus="callToRemoveComma(this)">
                        </div>
                        <div class="data-box float-left" style="padding: 5px;float: left; width: 9%;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control text-right institute" name="institute[]" onblur="callforComma(this)"
                                onfocus="callToRemoveComma(this)">
                        </div>
                        <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control text-right ship" name="ship[]" onblur="callforComma(this)"
                                onfocus="callToRemoveComma(this)">
                        </div>
                        <div class="data-box float-left" style="padding: 5px;float: left; width: 8%;">
                            <input type="text"
                                oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control text-right purchase" name="purchase[]" onblur="callforComma(this)"
                                onfocus="callToRemoveComma(this)">
                        </div>
                        <div class="data-box float-left" style="padding: 5px;float: left; width: 11%;">
                            <div class="custom-arrow">
                                <select class="form-control left_select font-weight-bold sales" name="sales[]">
                                    <option value="">選択なし</option>
                                    @foreach ($sales as $sale)
                                        <option @if ($sale->bango == $bango) selected @endif value="{{ $sale->bango }}">
                                            {{ $sale->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px;float: left; width: 10%;">
                            <div class="custom-arrow">
                                <select class="form-control left_select font-weight-bold se2" name="se2[]">
                                    <option value="">選択なし</option>
                                    @foreach ($ses as $se)
                                        <option value="{{ $se->bango }}">{{ $se->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="data-box-content3 custom-form orderentry-databox  text-center delete-area"
                style="width: 100%;float: left;">
                <div style="width: 100%;float: left;">
                    <div class="data-box float-left"
                        style="padding: 5px; width: 25%;border-right: 0 !important; border-left: 0 !important;">
                        <div class="input-group">
                            <input type="text" class="form-control productSubCd productSubOrCdTarget" id="productSubCd"
                                readonly name="productSubCd[]">
                            <input type="hidden" id="productSubName" class="productSubName" name="productSubName[]" />
                            <div class="input-group-append">
                                <button type="button" readonly
                                    class="btn btn-outline-secondary product_sub_modal_opener"
                                    style="background-color: grey;color: white;border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                                <button class="btn rounded viewProductDes" style="margin-left: 4px;color: #fff;"><i
                                        class="fa fa-clone" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="data-box float-left" style="padding: 5px; width: 12%;border-right: 0 !important;">
                        <div class="input-group">
                            <input type="text" class="form-control shippingInstruction" id="shippingInstruction"
                                readonly name="shippingInstruction[]">
                            <input type="hidden" class="issueNote" id="issueNote" name="issueNote[]">
                            <input type="hidden" class="statementRemarks" id="statementRemarks"
                                name="statementRemarks[]">
                            <input type="hidden" class="deliveryMethod" id="deliveryMethod" name="deliveryMethod[]">
                            <input type="hidden" class="continutionCategory" id="continutionCategory"
                                name="continutionCategory[]">
                            <input type="hidden" class="newVup" id="newVup" name="newVup[]">
                            <input type="hidden" class="vupCategory" id="vupCategory" name="vupCategory[]">
                            <input type="hidden" class="flatContract" id="flatContract" name="flatContract[]">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary shipping_modal_opener"
                                    style=" background-color: grey;color: white;">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="data-box float-left" style="padding: 5px; width: 6%;border-right: 0 !important;">
                        <div class="custom-arrow">
                            <select class="form-control left_select font-weight-bold maintenance" id="maintenance"
                                name="maintenance[]">
                                {{-- <option value="">なし</option> --}}
                                @foreach ($maintains as $categoryKanri)
                                    <option @if ($categoryKanri->category1 . $categoryKanri->category2 == 'E92') selected @endif
                                        value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                        {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="data-box float-left" style="padding: 5px; width: 25%;border-right: 0 !important;">
                        <div class="input-group ">
                            <input type="text" readonly class="form-control supplier" id="supplier_v2">
                            <input type="hidden" id="supplier_db" name="supplier[]" class="db_hidden_field supplier_db">
                            <div class="input-group-append">
                                <button type="button"
                                    onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'2','nullable','r17_3',3,event.preventDefault())"
                                    class="btn btn-outline-secondary sold_to_modal_opener"
                                    style=" background-color: grey;color: white;">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="data-box float-left" style="padding: 5px; width: 12%;border-right: 0 !important;">
                        <input type="text" class="form-control manufacturePartNumber" id="manufacturePartNumber"
                            name="manufacturePartNumber[]">
                    </div>
                    <div class="data-box float-left" style="padding: 5px; width: 20%;border-right: 0 !important;">
                        <input type="text" class="form-control manufactureProductName" id="manufactureProductName"
                            name="manufactureProductName[]">
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
