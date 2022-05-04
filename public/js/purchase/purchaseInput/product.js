function handleCategoryChange(reference, selector = null, C4 = null, C5 = null, C6 = null, E7 = null, E6 = null) {
    // alert("handleCategoryChange");
    var selector1 = selector
    if (selector == null) {
        var selector = reference.val();
        var parent = reference.parents('.parentOfPoductPopUp')
    } else {
        var parent = reference
    }
    var category_type = selector.slice(0, 2)
    var category_value = selector.slice(2, 10)
    var bango = $("input[id='userId']").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#csrf').val()
        },
        type: "POST",
        url: "purchase-input/handel-category-kanri/" + bango,
        data: {
            // "_token" : $('meta[name=_token]').attr('content'),
            category_type: category_type,
            category_value: category_value,
        },
        success: function (res) {
            //alert(res);
            var htmlData = res.html || {};
            var length = Object.keys(htmlData).length;
            var parent = $('#productModal')
            console.log(parent);
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
    // alert("what");
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
        headers: {
            'X-CSRF-TOKEN': $('#csrf').val()
        },
        type: "POST",
        url: "purchase-input/categorykanri-wise-table/" + bango,
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
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#csrf').val()
        },
        type: "POST",
        url: "purchase-input/categorykanri-wise-table/" + bango,
        data: {
            jouhou: C4,
            koyuujouhou: C5,
            color: C6,
            bumon: E7,
            jouhou2: E6,
            reg_sold_to: $(document).find('#reg_sold_to_db').val()
        },
        success: function (response) {
            // alert("hi");
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

$("#productSelect").prop('disabled', true)
$(document).on("click", '.productNumberModalOpener', function (e) {
    e.preventDefault();
    // alert("work");
    // get all ids of from line to modal
    $("#productModal").find('.itemGroup').val('')
    $("#productModal").find('.productCategory').val('')
    $("#productModal").find('.itemClassification').val('')
    $("#productModal").find('.salesFrom').val('')
    $("#productModal").find('.versionClassification').val('')
    if ($(this).parents(".input-group").find(".productNumber").val() != '') {
        $("#id_of_prodcut").remove();
        var id = $(this).parents(".line-form").attr("id");
        $("#productModal").append('<input name="id_of_prodcut" type="hidden" id="id_of_prodcut" value="' + id + '">')
        // alert(id);
        keepTheData($(this).parents(".line-form").attr("id"))
    } else {
        var companyCd = $("#reg_sold_to_db").val();
        // if (companyCd != "") {
            $("#id_of_prodcut").remove();
            var id = $(this).parents(".line-form").attr("id");
            $("#productModal").append('<input name="id_of_prodcut" type="hidden" id="id_of_prodcut" value="' + id + '">')
            $("#productModal").modal("show");
        // }
        
    }
    var targetElement = $(this).parents(".input-group").find(".productNumber").attr("id");
    var targetElement2 = $(this).parents(".custom-form").find(".productName").attr("id");
    
    var $lineFrom = $(this).parents('.line-form').prop("id")
})


function filterCategoryKanri(own) {
    // alert("Hello");
    handleCategoryChange(own);
}

// $(document).on("change", "#salesFrom", function (e) {
//     handleCategoryChange($(this), "#versionClassification");
// })

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
$(document).on("click", ".productRow", function () {
    // alert("prod");
    var productId_forAppend = $(this).attr("id");
    // var pro= productId_forAppend.split("-");
    $("#saveProductId").val(productId_forAppend);
    console.log(productId_forAppend);
});
$(document).on("click", "#productSelect", function () {
    var LineBranchParent = $("#id_of_prodcut").val()    
    // clear hidden fields
    $("#" + LineBranchParent).find('.LineBranchId').remove()
    $("#" + LineBranchParent).find(".jouhou").remove()
    $("#" + LineBranchParent).find(".koyuujouhou").remove()
    $("#" + LineBranchParent).find(".color").remove()
    $("#" + LineBranchParent).find(".bumon").remove()
    $("#" + LineBranchParent).find(".jouhou2").remove()
    // var productId_forAppend = $("body").find('#tushar').val();
    // console.log(productId_forAppend);
    // var pro= productId_forAppend.split("-");
    // alert(pro);
    // $("#" + LineBranchParent).find('.productNumber').val(pro[1]);
    var productId_forAppend = $("#saveProductId").val();
    var pro= productId_forAppend.split("-");
    // $("#" + LineBranchParent).find('.productNumber').val(pro[1]);
    //create hidden fields
    $("#" + LineBranchParent).append('<input name="jouhouHidden[]" type="hidden" class="jouhou" value="' + $(this).parents('.parentOfPoductPopUp').find('.itemGroup').val() + '">')
    $("#" + LineBranchParent).append('<input name="koyuujouhouHidden[]" type="hidden" class="koyuujouhou" value="' + $(this).parents('.parentOfPoductPopUp').find('.productCategory').val() + '">')
    $("#" + LineBranchParent).append('<input name="colorHidden[]" type="hidden" class="color" value="' + $(this).parents('.parentOfPoductPopUp').find('.itemClassification').val() + '">')
    $("#" + LineBranchParent).append('<input name="bumonHidden[]" type="hidden" class="bumon" value="' + $(this).parents('.parentOfPoductPopUp').find('.salesFrom').val() + '">')
    $("#" + LineBranchParent).append('<input name="jouhou2Hidden[]" type="hidden" class="jouhou2" value="' + $(this).parents('.parentOfPoductPopUp').find('.versionClassification').val() + '">')
    $("#" + LineBranchParent).append('<input name="LineBranchId[]" type="hidden" class="LineBranchId" value="' + productId_forAppend + '">')
    //get all ids from line in product modal
    // alert(LineBranchParent);
     var targetElement = $("input[id='productInputId']").val();
    $("#productModal").modal("hide");
    var companyCd = $("#reg_sold_to_db").val().substr(0, 6);
    console.log(companyCd);
    var targetId = "#" + LineBranchParent;
    getProductPrice(targetId, companyCd, pro[1])
    calculatePriceInLine(LineBranchParent);
})
$(document).on("click", ".enableSelectProduct", function () {
    $("#productSelect").prop('disabled', false)
})

function getProductPrice(id, companyCd, productId) {
    var bango = $("input[id='userId']").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#csrf').val()
        },
        url: 'hatchu-nyuryoku/product-details/' + bango,
        type: 'POST',
        async: false,
        data: {
            productCd: productId,
            companyCd: companyCd
        },
        success: function (response) {
            console.log({ response })
            if (response['status'] == "ok") {
                var price = response['yoyakusu'];
                var product = response['product'];
                console.log(product['bango']);
                $(id).find('.productUnitPrice').val(numberFormat(price));
                $(id).find('.productName').val(product['mdjouhou']);
                $(id).find('.productNumber').val(product['kongouritsu']);
            }
        }
    })
}