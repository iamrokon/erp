function handleCategoryChange(reference, selector = null, C4 = null, C5 = null, C6 = null, E7 = null, E6 = null) {
    var selector1 = selector
    console.log('selectorsss '+selector)
    if (selector == null) {
        var selector = reference.val();
        var parent = reference.parents('.parentOfPoductPopUp')
        //fetchCategoryKanriewiseData(parent)
    } else {
        var parent = reference
    }

    var category_type = selector.slice(0, 2)
    var category_value = selector.slice(2, 10)
    console.log('selector '+selector, 'category_type '+category_type, 'category_value '+category_value)
    var bango = $("input[id='userId']").val();
    console.log('bango '+bango)
    $.ajax({
        type: "POST",
        url: "purchase-slip/handel-category-kanri/" + bango,
        data: {
            category_type: category_type,
            category_value: category_value
        },
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        success: function (res) {
            console.log('res ')
            console.log(res)
            var htmlData = res.html;

            var length = Object.keys(htmlData).length;
            var parent = $('#productModal')
            //console.log(parent);
            if (length === 4) {
                parent.find(".productCategory").html(htmlData.C5html);
                parent.find(".salesFrom").html(htmlData.E7html);
                parent.find(".versionClassification").html(htmlData.E6html);
                parent.find(".itemClassification").html(htmlData.C6html);
            }
            if (length === 1) {
                parent.find('.itemClassification').html(htmlData.C6html)
            }
            if (category_type == 'C4') {
                //console.log(selector)
                parent.find('.itemGroup').val(selector)
            }
            if (category_type == 'C5') {
                //console.log(selector)
                parent.find('.productCategory').val(selector)
            }
            // console.log(selector1)
            if (selector1 == null) {

                fetchCategoryKanriewiseData(parent)

            } else {
                //console.log(C4, C5, C6, E7, E6)
                $("#productModal").find('.itemGroup').val(C4 ?? '')
                $("#productModal").find('.productCategory').val(C5 ?? '')
                $("#productModal").find('.itemClassification').val(C6 ?? '')
                $("#productModal").find('.salesFrom').val(E7 ?? '')
                $("#productModal").find('.versionClassification').val(E6 ?? '')
            }
        }
    })

}

function handleProductChangeOnly(reference, selector = null) {
    if (selector != null) {
        var category_type = selector.slice(0, 2)
        fetchCategoryKanriewiseData(reference, category_type)
    } else {
        var selector = reference.val();
        var parent = reference.parents('.parentOfPoductPopUp')
        var category_type = selector.slice(0, 2)

        //call for below's table
        fetchCategoryKanriewiseData(parent)
    }

}

function fetchCategoryKanriewiseData(parent) {
    var bango = $("input[id='userId']").val();
    $.ajax({
        type: "POST",
        url: "purchase-slip/categorykanri-wise-table/" + bango,
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        data: {
            jouhou: parent.find('.itemGroup').val(),
            koyuujouhou: parent.find('.productCategory').val(),
            color: parent.find('.itemClassification').val(),
            bumon: parent.find('.salesFrom').val(),
            jouhou2: parent.find('.versionClassification').val(),
            reg_sold_to: $(document).find('#reg_sold_to_db').val()
        },
        success: function (response) {
            parent.find(".productModalScroll").remove()
            parent.find('.insert_table_data').after(response.html)

            $("#productSelect").prop("disabled", true);

        }
    })
}

function fetchCategoryKanriewiseDataWhenProductSelected(parent, C4, C5, C6, E7, E6, own) {
    var bango = $("input[id='userId']").val();
    //console.log(C4, C5, C6, E7, E6)
    console.log('C4: '+C4+' C5: '+C5+' C6: '+C6+' E7: '+E7+' E6: '+E6)
    $.ajax({
        type: "POST",
        url: "purchase-slip/categorykanri-wise-table/" + bango,
        data: {
            jouhou: C4,
            koyuujouhou: C5,
            color: C6,
            bumon: E7,
            jouhou2: E6,
            reg_sold_to: $(document).find('#reg_sold_to_db').val()
        },
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        success: function (response) {
            parent.find(".productModalScroll").remove()
            parent.find('.insert_table_data').after(response.html)

            //add blue color
            $('#' + $("#" + own).find(".LineBranchId").val()).addClass('add_border')
            $("#productSelect").prop("disabled", false);
        }
    })
}

function keepTheData(own) {

    var C4 = $("#" + own).find(".jouhou").val()
    var C5 = $("#" + own).find(".koyuujouhou").val()
    var C6 = $("#" + own).find(".color").val()
    var E7 = $("#" + own).find(".bumon").val()
    var E6 = $("#" + own).find(".jouhou2").val()
    console.log('C4: '+C4+' C5: '+C5+' C6: '+C6)
    fetchCategoryKanriewiseDataWhenProductSelected($("#productModal"), C4, C5, C6, E7, E6, own)
    if (C4 != "") {

        handleCategoryChange($("#productModal"), C4, C4, C5, C6, E7, E6)

    }

    $("#productModal").modal("show");

    function triggerAfterResult() {
        setTimeout(function () {
            if (C5 != "") {

                handleCategoryChange($("#productModal"), C5, C4, C5, C6, E7, E6)
            }
            $("#productModal").modal("show");
        }, 1000);
    }

    triggerAfterResult()

}

function disableLineAndBranch($lineFrom) {
    var copyFieldDisableValue = ['D160', 'D111', 'D131'];
    var lineAndBranchDisebleValue = ['D160', 'D111'];
    var shoyuhinData = $lineFrom.find('.syohin_data100').val();
    if (copyFieldDisableValue.indexOf(shoyuhinData) != -1) {
        $lineFrom.find('.repeatBtn').prop('disabled', true)
    }

    if (lineAndBranchDisebleValue.indexOf(shoyuhinData) != -1) {
        $lineFrom.find('.lineBtn').prop('disabled', true)
        $lineFrom.find('.branchBtn').prop('disabled', true)
    }
}

//$(document).ready(function () {
$("#productSelect").prop('disabled', true)
$(document).on("click", '.productModalOpener', function () {
    // get all ids of from line to modal
    $("#productModal").find('.itemGroup').val('')
    $("#productModal").find('.productCategory').val('')
    $("#productModal").find('.itemClassification').val('')
    $("#productModal").find('.salesFrom').val('')
    $("#productModal").find('.versionClassification').val('')
    if ($(this).parents(".productData").find(".productCd").val() != '') {
        $("#id_of_prodcut").remove();
        var id = $(this).parents(".line-form").attr("id");
        $("#productModal").append('<input name="id_of_prodcut" type="hidden" id="id_of_prodcut" value="' + id + '">')
        keepTheData($(this).parents(".line-form").attr("id"))
    } else {
        var companyCd = $("#reg_sold_to_db").val();
        if (companyCd != "") {
            $("#id_of_prodcut").remove();
            var id = $(this).parents(".line-form").attr("id");
            $("#productModal").append('<input name="id_of_prodcut" type="hidden" id="id_of_prodcut" value="' + id + '">')
            $("#productModal").modal("show");
        }
    }
    var targetElement = $(this).parents(".productData").find(".productCd").attr("id");
    var targetElement2 = $(this).parents(".productData").find(".productName").attr("id");
    console.log('productCd: '+targetElement+' productName: '+targetElement2)
    var shoyhin_data_100 = $(this).parents(".input-group-append").find(".syohin_data100").attr("id");
    var childProductCount = $(this).parents(".input-group-append").find(".syohin_product_count").attr("id");
    var productStatus = $(this).parents(".input-group-append").find(".syohin_product_status").attr("id");
    var kongouritsu = $(this).parents(".input-group-append").find(".shoyin_kongouritsu").attr("id");
    var mdjouhou = $(this).parents(".input-group-append").find(".shoyin_mdjouhou").attr("id");
    var color = $(this).parents(".input-group-append").find(".shoyin_color").attr("id");
    var tokuchou = $(this).parents(".input-group-append").find(".shoyin_tokuchou").attr("id");
    var data22 = $(this).parents(".input-group-append").find(".shoyin_data22").attr("id");
    var data51 = $(this).parents(".input-group-append").find(".shoyin_data51").attr("id");
    var maintance = $(this).parents(".line-form").find(".maintenance").attr("id");
    var manufactureProductName = $(this).parents(".line-form").find(".manufactureProductName").attr("id");
    var manufacturePartNumber = $(this).parents(".line-form").find(".manufacturePartNumber").attr("id");
    var shippingInstruction = $(this).parents(".line-form").find(".shippingInstruction").attr("id")
    var $lineFrom = $(this).parents('.line-form').prop("id")
    //add to the modal as hidden field
    $("#productInputId").val(targetElement)
    console.log('targetElement2 '+targetElement2)
    $("#productInputName").val(targetElement2)
    $("#childProductCount").val(childProductCount)
    $("#shoyinProductStatus").val(productStatus)
    $("#shoyinKongouritsu").val(kongouritsu)
    $("#shoyinMdjouhou").val(mdjouhou)
    $("#shoyinColor").val(color)
    $("#shoyinTokuchou").val(tokuchou)
    $("#shoyinData22").val(data22)
    $("#shoyinData51").val(data51)
    $("#syohin100").val(shoyhin_data_100)
    $("#manufactureProductNameMd").val(manufactureProductName)
    $("#manufacturePartNumberMd").val(manufacturePartNumber)
    $("#maintanceMd").val(maintance)
    $("#sourceProduct").val($lineFrom)
    $("#shippingInstructionId").val(shippingInstruction)
})
////ami comment korsi

//sajal haque
function filterCategoryKanri(own) {
    handleCategoryChange(own);
}

$(document).on("change", "#itemGroup", fetchCategoryKanriewiseData)
$(document).on("change", "#productCategory", fetchCategoryKanriewiseData)
$(document).on("change", "#itemClassification", fetchCategoryKanriewiseData)
$(document).on("change", "#salesFrom", fetchCategoryKanriewiseData)
$(document).on("change", "#versionClassification", fetchCategoryKanriewiseData)

$('#productModal').on("hidden.bs.modal", function () {
    $('#itemGroup option:first').prop('selected', true);
    $('#productCategory option:first').prop('selected', true);
    $('#itemClassification option:first').prop('selected', true);
    $('#salesFrom option:first').prop('selected', true);
    $('#versionClassification option:first').prop('selected', true);
    $(".productModalScroll").remove()
})

$('#productModalClose').on("click", function () {
    $("#productModal").modal("hide");
})

$(document).on("click", "#productSelect", function () {
    var largestSet = 1;
    var LineBranchParent = $("#id_of_prodcut").val()
    // clear hidden fields
    $("#" + LineBranchParent).find('.LineBranchId').remove()
    $("#" + LineBranchParent).find(".jouhou").remove()
    $("#" + LineBranchParent).find(".koyuujouhou").remove()
    $("#" + LineBranchParent).find(".color").remove()
    $("#" + LineBranchParent).find(".bumon").remove()
    $("#" + LineBranchParent).find(".jouhou2").remove()
    $("#" + LineBranchParent).find('.price').text('')
    $("#" + LineBranchParent).find('.grossProfit').text('')
    $("#" + LineBranchParent).find('input[name="quantity[]"]').removeClass("error")
    $("#" + LineBranchParent).find('input[name="unitSellingPrice[]"]').removeClass("error")
    //hidden fileds
    var productId_forAppend = $("body").find('.add_table_data').find('.add_border').attr('id')

    ///create hidden fields
    $("#" + LineBranchParent).append('<input name="jouhouHidden[]" type="hidden" class="jouhou" value="' + $(this).parents('.parentOfPoductPopUp').find('.itemGroup').val() + '">')
    $("#" + LineBranchParent).append('<input name="koyuujouhouHidden[]" type="hidden" class="koyuujouhou" value="' + $(this).parents('.parentOfPoductPopUp').find('.productCategory').val() + '">')
    $("#" + LineBranchParent).append('<input name="colorHidden[]" type="hidden" class="color" value="' + $(this).parents('.parentOfPoductPopUp').find('.itemClassification').val() + '">')
    $("#" + LineBranchParent).append('<input name="bumonHidden[]" type="hidden" class="bumon" value="' + $(this).parents('.parentOfPoductPopUp').find('.salesFrom').val() + '">')
    $("#" + LineBranchParent).append('<input name="jouhou2Hidden[]" type="hidden" class="jouhou2" value="' + $(this).parents('.parentOfPoductPopUp').find('.versionClassification').val() + '">')
    $("#" + LineBranchParent).append('<input name="LineBranchId[]" type="hidden" class="LineBranchId" value="' + productId_forAppend + '">')
    //get all ids from line in product modal

    var targetElement = $("input[id='productInputId']").val();
    var shippingInstruction = $("input[id='shippingInstructionId']").val();
    //check local storage to process new req
    removeItemFromLocalStorage(targetElement);

    var targetElement2 = $("input[id='productInputName']").val();
    console.log('targetElement: '+targetElement+' targetElement2: '+targetElement2)
    var targetElement3 = $("input[id='sourceProduct']").val();
    var lineFrom = $("input[id='sourceProduct']").val();
    var shoyhindata100 = $("input[id='syohin100']").val();
    var childProductCount = $("input[id='childProductCount']").val();
    var shoyinProductStatus = $("input[id='shoyinProductStatus']").val()
    var shoyhinkongouritsu = $("input[id='shoyinKongouritsu']").val();
    var shoyhinmdjouhou = $("input[id='shoyinMdjouhou']").val();
    var shoyhincolor = $("input[id='shoyinColor']").val();

    // var shoyhinurl = $("input[id='shoyinUrl']").val();
    var shoyhintokuchou = $("input[id='shoyinTokuchou']").val();
    var shoyhindata22 = $("input[id='shoyinData22']").val();
    var shoyhindata51 = $("input[id='shoyinData51']").val();
    var maintance = $("input[id='maintanceMd']").val();
    var manufacturepartnumber = $("input[id='manufacturePartNumberMd']").val();
    var manufactureproductname = $("input[id='manufactureProductNameMd']").val();
    
    var rowId = targetElement3 && targetElement3.replace("LineBranch", "");
    var parentID = $(this).parents(".modal-body").find(".add_border");

    var productId = parentID.find("td").eq(0).text();
    var productName = parentID.find("td").eq(1).text();
    var productSetCode = parentID.find(".set_product_data").val() ? parentID.find(".set_product_data").val() : null;
    var shoyhinDt100 = parentID.find(".shoyin_data_100").val();
    var shoyhinProductCount = parentID.find('.shoyin_child_count').val();
    var shoyhinProductStatus = parentID.find(".syohin_product_status").val();
    var shoyhinKongouritsu = parentID.find(".shoyin_kongouritsu").val()
    var shoyhinMdjouhou = parentID.find(".shoyin_mdjouhou").val()
    // var shoyhinUrl = parentID.find(".shoyin_url").val()
    var shoyhinColor = parentID.find(".shoyin_color").val()
    var shoyhinTokuchou = parentID.find(".shoyin_tokuchou").val()
    var shoyhinDt22 = parentID.find(".shoyin_data22").val()
    var shoyhinDt51 = parentID.find(".shoyin_data51").val()
    var mAintance = parentID.find(".shoyin_url").val()
    var manuFacturePartNumber = parentID.find(".shoyin_mdjouhou").val()
    var manufactureProductName = parentID.find(".shoyin_kongouritsu").val()

    if (shoyhinProductStatus != "parent_without_dsbango") {
        $('#' + targetElement).val(productId)
        if(productName){
            $('#' + targetElement2).val(productName)
            $('#' + targetElement2).prop('readonly',true)
        }else{
            $('#' + targetElement2).val("")
            $('#' + targetElement2).prop('readonly',false)
        }
        console.log('targetElement2: '+targetElement2)
        console.log('productName: '+productName)
        if (childProductCount != "") {
            $('#' + childProductCount).val(shoyhinProductCount)
        }
        var color = shoyhinColor ? shoyhinColor : null;
        var tokuchou = shoyhinTokuchou.split(' ')[0] ? shoyhinTokuchou.split(' ')[0] : null
        var data22 = shoyhinDt22.split(' ')[0] ? shoyhinDt22.split(' ')[0] : null
        var data51 = shoyhinDt51.split(' ')[0] ? shoyhinDt51.split(' ')[0] : null
        lineFrom = $("#" + lineFrom)
        lineFrom.find('.deliveryMethod').val(color)
        lineFrom.find('.continutionCategory').val(tokuchou)
        lineFrom.find('.newVup').val(data22)
        lineFrom.find('.vupCategory').val(data51)
        color = color ? color.substr(2, 2) : null
        var delivery_method = color ? $("#delivery_method").find('[data-category2="' + color + '"]').text() : $("#delivery_method option").eq(1).val() ? $("#delivery_method option").eq(1).text() : '';
        var continuetion_cat = tokuchou ? $("#continution_category").find('[data-req="' + tokuchou + '"]').text() : $("#continution_category option").eq(1).val() ? $("#continution_category option").eq(1).text() : '';
        $('.productViewOpener').prop("disabled", false);

        $("#productModal").modal("hide");

    } else {
        $("#no_child_msg").html("");
        var err_msg = '選択したセット商品' + productId + 'の(内訳製品)(内訳保守)商品項目「内訳商品粗利比率」が入力されていないため,処理できません。マスタより登録後、再度入力を行ってください。';
        $("#no_child_msg").html(err_msg);
        $("#productModal").modal("hide");
    }
})
$(document).on("click", ".enableSelectProduct", function () {
    $("#productSelect").prop('disabled', false)
})


function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function getProductPrice() {
    var lineFromIdRand = $("#lineFromIdRand").val();
    var bango = $("input[id='userId']").val();
    var dspbango = null;
    $(".productCd").each(function (index) {
        var productCd = $(this).val();
        var lineId = $(this).attr('id');

        //check lineId storage data
        var excludeLineFromId = "";
        if (localStorage.getItem(lineFromIdRand + "lineFromId") !== null) {
            if (localStorage.getItem(lineFromIdRand + 'lineFromId').indexOf('&') >= 0) {
                excludeLineFromId = localStorage.getItem(lineFromIdRand + 'lineFromId').split('&').filter(function (value, index, self) {
                    return self.indexOf(value) === index;
                });
            } else {
                excludeLineFromId = localStorage.getItem(lineFromIdRand + 'lineFromId');
            }
        }

        $("#no_child_msg").html("");

        var $targetLineFrom = $(this).parents(".line-form");
        var productTypeTemp = $targetLineFrom.find(".syohin_product_status").val();

        if (productCd && !excludeLineFromId.includes(lineId) && productTypeTemp != "") {

            //store process data in localStorage
            if (localStorage.getItem(lineFromIdRand + 'lineFromId')) {
                var newLineFromId = localStorage.getItem(lineFromIdRand + 'lineFromId') + '&' + lineId;
                localStorage.setItem(lineFromIdRand + 'lineFromId', newLineFromId)
            } else {
                localStorage.setItem(lineFromIdRand + 'lineFromId', lineId)
            }

            var companyCd = $("#reg_sold_to_db").val().substr(0, 6);
            var $lineFrom = $(this).parents(".line-form");
            var fillableId1 = $lineFrom.find(".unitSellingPrice");
            var fillableId2 = $lineFrom.find(".se");
            var fillableId3 = $lineFrom.find(".institute");
            var fillableId4 = $lineFrom.find(".ship");
            var fillableId5 = $lineFrom.find(".purchase");
            var season_detail = $lineFrom.find(".deliveryDestination");
            var season = $lineFrom.find(".deliveryDestination_db");
            var supplier = $lineFrom.find(".supplier_db");
            var supplier_detail = $lineFrom.find(".supplier");
            var unit = $lineFrom.find(".unit");
            var productType = $lineFrom.find(".syohin_product_status").val();
            var childCount = $lineFrom.find(".syohin_product_count")
            var data100 = $lineFrom.find(".syohin_data100")
            var color = $lineFrom.find(".shoyin_color")

            var editMode = $("#request").val() == "2 受注訂正";
            $.ajax({
                url: 'purchase-slip/product-details/' + bango,
                type: 'POST',
                async: false,
                data: {
                    productCd: productCd,
                    companyCd: companyCd
                },
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                success: function (response) {
                    console.log({ response })
                    if (response['status'] == "ok") {

                        var code = $lineFrom.data('setcode').split("-");
                        if (productType == 'parent_with_dsbango' || productType == 'parent_without_dsbango') {

                            var datatype = 'parent';
                            localStorage.setItem("parentPrice", response['hanbaisu']);
                        } else if (productType == 'normal_product') {
                            var datatype = 'normal_product';
                        } else if (productType == "") {
                            var datatype = 'no_change';
                        } else {
                            var datatype = 'child';
                        }
                        console.log({ datatype });
                        if (datatype == "child") {
                            $targetLineFrom.attr("data-setcode",'');
                            if (response['dspbango'] != null) {
                                var dspbango = response['dspbango'].split("G2")[1];
                                var parentNedan = localStorage.getItem("parentPrice");
                                var hanbaisuRes = (parseInt(dspbango) * parentNedan) / 100;
                                fillableId1.val(formatNumber(hanbaisuRes));
                            } else {
                                fillableId1.val(0);
                            }

                            fillableId2.val(formatNumber(response['yoyakukanousu']) ?? 0);
                            fillableId3.val(formatNumber(response['sortbango']) ?? 0);
                            fillableId4.val(formatNumber(response['dataint01']) ?? 0);
                            fillableId5.val(formatNumber(response['yoyakusu']) ?? 0);

                            !supplier_detail.val() ? supplier_detail.val(response['season_detail']) : '';
                            !supplier.val() ? supplier.val(response['season']) : '';
                            unit.val(response['konpoumei'])
                            childCount.val(response['childCount'])
                            data100.val(response['data100'])
                            color.val(response['color'])


                        } else if (datatype == "normal_product") {
                            $targetLineFrom.removeAttr("data-setcode");
                            fillableId1.val(formatNumber(response['hanbaisu']));

                            if (fillableId2.attr("readonly") && fillableId3.attr("readonly") && fillableId4.attr("readonly") && fillableId5.attr("readonly") && !editMode) {
                                fillableId2.val("0");
                                fillableId3.val("0");
                                fillableId4.val("0");
                                fillableId5.val("0");
                            } else {
                                fillableId2.val(formatNumber(response['yoyakukanousu']) ?? 0);
                                fillableId3.val(formatNumber(response['sortbango']) ?? 0);
                                fillableId4.val(formatNumber(response['dataint01']) ?? 0);
                                fillableId5.val(formatNumber(response['yoyakusu']) ?? 0);
                            }
                            !supplier_detail.val() ? supplier_detail.val(response['season_detail']) : '';
                            !supplier.val() ? supplier.val(response['season']) : '';
                            unit.val(response['konpoumei'])
                            childCount.val(response['childCount'])
                            data100.val(response['data100'])
                            color.val(response['color'])
                        } else if (datatype == "no_change") {
                            //no change will be occured
                        } else {
                            console.log($targetLineFrom)
                            $targetLineFrom.attr("data-setcode",'');
                            !supplier_detail.val() ? supplier_detail.val(response['season_detail']) : '';
                            !supplier.val() ? supplier.val(response['season']) : '';
                            unit.val(response['konpoumei'])
                            fillableId1.val(formatNumber(response['hanbaisu']));
                            childCount.val(response['childCount'])
                            data100.val(response['data100'])
                            color.val(response['color'])
                        }

                    } else {
                        fillableId1.val("");
                        fillableId2.val("0");
                        fillableId3.val("0");
                        fillableId4.val("0");
                        fillableId5.val("0");
                    }

                    if (editMode && response['data24'] != "1 訂正可") {
                        $targetLineFrom.find('.productName').prop("readonly", true);
                        $targetLineFrom.find('.unit').prop("readonly", true);
                    }
                }
            });
            var $quantity = $targetLineFrom.find('.quantity');
            if ($quantity && !parseInt($quantity.val())) {
                $quantity.val(1).trigger("keyup");
            }
            var lineId = $targetLineFrom.prop('id')
            calculatePriceInLine(lineId);
        } else {
            //$(this).parents(".line-form").find('.syohin_product_status').val('');
        }

    })
}

//remove unique storage key lineFromId when reload the page
window.onbeforeunload = function (event) {
    var remove_key = $("#lineFromIdRand").val() + "lineFromId";
    localStorage.removeItem(remove_key)
};

