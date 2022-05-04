function stringContains(string, substrings) {
    for (var i = 0; i != substrings.length; i++) {
        var substring = substrings[i];
        if (string.indexOf(substring) != -1) {
            return substring;
        }
    }
    return null;
}

function mb_strlen(str) {
    var len = 0;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? 2 : 1;
    }
    return len;
}

function allFullWidthCheck(string) {
    var str_length = string.length * 2;
    if (str_length) {
        var mblen = mb_strlen(string);
        if (str_length == mblen) {
            return true;
        }
    }
    return false;
}

function createErrorP(errormsg) {
    return '<p  style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + errormsg + '</p>'
}

function getFormattedData(delivery_method, continuetion_category) {
    var cut_delivery_methd, cut_continuetion_cat = '';
    if (delivery_method ) {
        cut_delivery_methd = delivery_method.split(" ")[1] ? delivery_method.split(" ")[1].substr(0, 2) : delivery_method ;
    } else {
        cut_delivery_methd = "";
    }

    if (continuetion_category ) {
        cut_continuetion_cat = continuetion_category.split(" ")[1] ? continuetion_category.split(" ")[1].substr(0, 2) : continuetion_category ;
    } else {
        cut_continuetion_cat = "";
    }

    if (cut_delivery_methd && (cut_delivery_methd.length > 0)) {
        cut_delivery_methd = '/' + cut_delivery_methd
    }
    if (cut_continuetion_cat && (cut_continuetion_cat.length > 0)) {
        cut_continuetion_cat = '/' + cut_continuetion_cat
    }
    return {cut_delivery_methd, cut_continuetion_cat}
}

$(document).ready(function () {
    $(document).on('click', '.shipping_modal_opener', function (e) {
        e.preventDefault()
        var selectedParent = $(this).parents('.line-form');
        var lineFromId = selectedParent.prop('id')
        var targetElm = selectedParent.find('.shippingInstruction').attr('id');
        var issueNote = selectedParent.find('.issueNote').attr('id');
        var deliveryMethod = selectedParent.find('.deliveryMethod').attr('id');
        var continutionCategory = selectedParent.find('.continutionCategory').attr('id');
        var newVup = selectedParent.find('.newVup').attr('id');
        var vupCategory = selectedParent.find('.vupCategory').attr('id');
        var statementRemarks = selectedParent.find('.statementRemarks').attr('id');
        var shouhinColor4 = selectedParent.find('.shoyin_color').attr("id");
        var shyohin1Tokuchou = selectedParent.find('.shoyin_tokuchou').attr("id");
        var shyohinData22 = selectedParent.find('.shoyin_data22').attr("id");
        var shyohinData51 = selectedParent.find('.shoyin_data51').attr("id");
        var flatContract = selectedParent.find('.flatContract').attr("id")
        var product_id = selectedParent.find('.productCd').attr('id')
        $("#shippingTargetElm").val(targetElm)
        $("#issueNoteElm").val(issueNote)
        $("#deliveryMethodElm").val(deliveryMethod)
        $("#continutionCategoryElm").val(continutionCategory)
        $("#newVupElm").val(newVup)
        $("#vupCategoryElm").val(vupCategory)
        $("#statementRemarksElm").val(statementRemarks)
        $("#shyohinColor4Elm").val(shouhinColor4)
        $("#shyohin1TokuchouElm").val(shyohin1Tokuchou)
        $("#shyohinData22Elm").val(shyohinData22)
        $("#shyohinData51Elm").val(shyohinData51)
        $("#lineFromId").val(lineFromId)
        $("#productIdShip").val(product_id)
        $("#flatRateContractId").val(flatContract)
        var shippingTargetElm = $("#shippingTargetElm").val()
        var issueNoteElm = $("#issueNoteElm").val()
        var deliveryMethodElm = $("#deliveryMethodElm").val()
        var continutionCategoryElm = $("#continutionCategoryElm").val()
        var newVupElm = $("#newVupElm").val()
        var vupCategoryElm = $("#vupCategoryElm").val()
        var statementRemarksElm = $("#statementRemarksElm").val()
        var shyohinColor4Elm = $("#shyohinColor4Elm").val()
        var shyohin1TokuchouElm = $("#shyohin1TokuchouElm").val()
        var shyohinData22Elm = $("#shyohinData22Elm").val()
        var shyohinData51Elm = $("#shyohinData51Elm").val()
        var productIdShip = $("#productIdShip").val();
        var flatRateContractNumber =  $("#flatRateContractId").val()
        var $issueNote = $("#departure_remarks");
        var $deliveryMethod = $("#delivery_method");
        var $continutionCategory = $("#continution_category");
        var $newVup = $("#new_vup");
        var $vupCategory = $("#vup_category");
        var $statementRemarks = $("#statement_remarks");
        var $flatRateContract = $("#flat_rate_contract_number")
        if ($('#' + issueNoteElm).val()) {
            $issueNote.val($('#' + issueNoteElm).val())
        } else {
            $issueNote.val('')
        }
        var deliveryMethodElmVal = $('#' + deliveryMethodElm).val();
        var shyohinColor4ElmVal = $('#' + shyohinColor4Elm).val()
        var continutionCategoryElmVal = $('#' + continutionCategoryElm).val()
        var shyohin1TokuchouElmVal = $('#' + shyohin1TokuchouElm).val()
        var newVupElmVal = $('#' + newVupElm).val()
        var shyohinData22ElmVal = $('#' + shyohinData22Elm).val()
        var vupCategoryElmVal = $('#' + vupCategoryElm).val()
        var shyohinData51ElmVal = $('#' + shyohinData51Elm).val()
        var partialShyohinColor4ElmVal = shyohinColor4ElmVal;
        partialShyohinColor4ElmVal = partialShyohinColor4ElmVal.substr(2, 2)
        var hasProduct = $("#" + productIdShip).val()
        if (optionExists($deliveryMethod, deliveryMethodElmVal)) {
            $deliveryMethod.val(deliveryMethodElmVal)
        }  else if (hasProduct) {
            $deliveryMethod.prop("selectedIndex", 1);
        } else {
            $deliveryMethod.prop("selectedIndex", 0);
        }

        if (optionExists($continutionCategory, continutionCategoryElmVal)) {
            $continutionCategory.val(continutionCategoryElmVal)
        } else if (hasProduct) {
            $continutionCategory.prop("selectedIndex", 1);
        } else {
            $continutionCategory.prop("selectedIndex", 0);
        }

        if (optionExists($newVup, newVupElmVal)) {
            $newVup.val(newVupElmVal)
        } else {
            $newVup.prop("selectedIndex", 0);
        }

        if (optionExists($vupCategory, vupCategoryElmVal)) {
            $vupCategory.val(vupCategoryElmVal)
        }  else {
            $vupCategory.prop("selectedIndex", 0)
        }

        if ($('#' + statementRemarksElm).val()) {
            $statementRemarks.val($('#' + statementRemarksElm).val())
        } else {
            $statementRemarks.val('')
        }
        // if (optionExists($deliveryMethod, deliveryMethodElmVal)) {
        //     $deliveryMethod.val(deliveryMethodElmVal)
        // } else if (partialOptionExists($deliveryMethod, partialShyohinColor4ElmVal)) {
        //     $('[data-category2="' + partialShyohinColor4ElmVal + '"]').attr("selected", "selected");
        // } else if (hasProduct) {
        //     $deliveryMethod.prop("selectedIndex", 1);
        // } else {
        //     $deliveryMethod.prop("selectedIndex", 0);
        // }
        //
        // if (optionExists($continutionCategory, continutionCategoryElmVal)) {
        //     $continutionCategory.val(continutionCategoryElmVal)
        // } else if (optionExists($continutionCategory, shyohin1TokuchouElmVal)) {
        //     $continutionCategory.val(shyohin1TokuchouElmVal)
        // } else if (hasProduct) {
        //     $continutionCategory.prop("selectedIndex", 1);
        // } else {
        //     $continutionCategory.prop("selectedIndex", 0);
        // }
        //
        // if (optionExists($newVup, newVupElmVal)) {
        //     $newVup.val(newVupElmVal)
        // } else if (optionExists($newVup, shyohinData22ElmVal)) {
        //     $newVup.val(shyohinData22ElmVal)
        // } else {
        //     $newVup.prop("selectedIndex", 0);
        // }
        //
        // if (optionExists($vupCategory, vupCategoryElmVal)) {
        //     $vupCategory.val(vupCategoryElmVal)
        // } else if (optionExists($vupCategory, shyohinData51ElmVal)) {
        //     $vupCategory.val(shyohinData51ElmVal)
        // } else {
        //     $vupCategory.prop("selectedIndex", 0)
        // }
        //
        // if ($('#' + statementRemarksElm).val()) {
        //     $statementRemarks.val($('#' + statementRemarksElm).val())
        // } else {
        //     $statementRemarks.val('')
        // }
        $flatRateContract.val($('#'+flatRateContractNumber).val())
        $('#shippingInstructionModal').modal("show")
    })
    $("#close_shipping_instruction").on("click", function () {
        $('#shippingInstructionModal').modal("hide")
    })
    $('#shippingInstructionModal').on('hide.bs.modal', function () {
        $('#departure_remarks').hasClass("border-red") ? $('#departure_remarks').removeClass("border-red") : '';
        $('#statement_remarks').hasClass("border-red") ? $('#statement_remarks').removeClass("border-red") : '';
        $('#delivery_method').hasClass("border-red") ? $('#delivery_method').removeClass("border-red") : '';
        $('#continution_category').hasClass("border-red") ? $('#continution_category').removeClass("border-red") : '';
        $("#shippingErrorData").empty()
        // $('#departure_remarks').val('');// $('#delivery_method option:first').attr('selected', 'selected');
        // $('#continution_category option:first').attr('selected', 'selected');
        // $('#new_vup option:first').attr('selected', 'selected');
        // $('#vup_category option:first').attr('selected', 'selected');
        // $('#statement_remarks').val('')
    })
    $("#select_shipping_instruction").on("click", function (e) {
        e.preventDefault();
        var dept_remark = $('#departure_remarks').val() ?  $('#departure_remarks').val().trim() : '';
        var statement_remarks = $('#statement_remarks').val() ? $('#statement_remarks').val().trim() : '';
        var delivery_method = $("#delivery_method").val();
        var continution_category = $("#continution_category").val();
        var delivery_method_Error = delivery_method ? false : true;
        var continution_category_Error = continution_category ? false : true;
        var skippingCharacter = [',', '*', '=', '\'', '!', '¥', '+', '&', '%', '"']
        var dept_remark_lengthError = dept_remark.length > 60;
        var dept_remark_skippingCharacterError = stringContains(dept_remark, skippingCharacter);
        var statement_remarks_lengthError = statement_remarks.length > 40;
        var statement_remarks_skippingCharacterError = stringContains(statement_remarks, skippingCharacter);
        var dept_remark_full_width_check = allFullWidthCheck(dept_remark);
        var statement_remark_full_width_check = allFullWidthCheck(statement_remarks);
        if (dept_remark.length <= 60 && (dept_remark.length > 0 ? allFullWidthCheck(dept_remark) : true) && statement_remarks.length <= 40 && !statement_remarks_skippingCharacterError && !dept_remark_skippingCharacterError && (statement_remarks.length > 0 ? allFullWidthCheck(statement_remarks) : true) && !delivery_method_Error && !continution_category_Error) {
            $('#departure_remarks').hasClass("border-red") ? $('#departure_remarks').removeClass("border-red") : '';
            $('#statement_remarks').hasClass("border-red") ? $('#statement_remarks').removeClass("border-red") : '';
            $('#delivery_method').hasClass("border-red") ? $('#delivery_method').removeClass("border-red") : '';
            $('#continution_category').hasClass("border-red") ? $('#continution_category').removeClass("border-red") : '';

            $("#shippingErrorData").empty()
            var continuetion_category = $('#continution_category option:selected').val();
            var new_vup = $('#new_vup option:selected').val();
            var vup_category = $('#vup_category option:selected').val();
            var delivery_method = $('#delivery_method option:selected').val();

            var tarElm = $("#shippingTargetElm").val()
            var departureRemarks = $("#issueNoteElm").val()
            var deliveryMethod = $("#deliveryMethodElm").val()
            var continutionCategory = $("#continutionCategoryElm").val()
            var newVup = $("#newVupElm").val()
            var vupCategory = $("#vupCategoryElm").val()
            var statementRemarks = $("#statementRemarksElm").val()
            var delivery_method_text =  $('#delivery_method option:selected').text();
            var continuetion_category_text =  $('#continution_category option:selected').text();
            let {cut_delivery_methd, cut_continuetion_cat} = getFormattedData(delivery_method_text, continuetion_category_text)

            var cut_dept_remark = dept_remark.substr(0, 2)
            //$('#' + tarElm).val(dept_remark.substr(0,2) + '/' + delivery_methd + '/' + continuetion_cat + '/' + new_vup + '/' + vup_category + '/' + statement_remarks)
            $('#' + tarElm).val(cut_dept_remark + cut_delivery_methd + cut_continuetion_cat)
            $('#' + departureRemarks).val(dept_remark);
            $('#' + deliveryMethod).val(delivery_method);
            $('#' + continutionCategory).val(continuetion_category);
            $('#' + newVup).val(new_vup);
            $('#' + vupCategory).val(vup_category);
            $('#' + statementRemarks).val(statement_remarks);
            var lineFromId = $(this).parents('#shippingInstructionModal').find("#lineFromId").val()
            var isParent = lineFromId ? $('#' + lineFromId).find(".syohin_data100").val() : false;
            var parentVal = isParent ? isParent : '';
            if (parentVal == "D160") {
                $('#' + lineFromId).find('.issueNote').trigger("change")
            }
            $('#shippingInstructionModal').modal("hide")
        } else {
            if (dept_remark_lengthError || dept_remark_skippingCharacterError || statement_remarks_lengthError || statement_remarks_skippingCharacterError || !dept_remark_full_width_check || !statement_remark_full_width_check || delivery_method_Error || continution_category_Error) {
                var ids = ['departure_remarks', 'statement_remarks','delivery_method','continution_category']
                ids.forEach((item) => {
                    $("#" + item).hasClass('border-red') ? $("#" + item).removeClass('border-red') : ''
                })
                var errmsg = '';
                if (dept_remark_lengthError) {
                    errmsg += createErrorP("【発出備考】60桁以下で入力してください。")
                    $("#departure_remarks").addClass("border-red")
                }
                if (dept_remark_skippingCharacterError) {
                    errmsg += createErrorP("【発出備考】[,][*][=]['][\"][!][¥][+][&][%]は使用できません。")
                    $("#departure_remarks").addClass("border-red")
                }
                if (dept_remark.length > 0 && !dept_remark_full_width_check) {
                    errmsg += createErrorP("【発出備考】全角文字以外は使用できません。 ")
                    $("#departure_remarks").addClass("border-red")
                }

                if (statement_remarks_lengthError) {
                    errmsg += createErrorP("【明細備考】40桁以下で入力してください。")
                    $("#statement_remarks").addClass("border-red")
                }
                if (statement_remarks_skippingCharacterError) {
                    errmsg += createErrorP("【明細備考】[,][*][=]['][\"][!][¥][+][&][%]は使用できません。")
                    $("#statement_remarks").addClass("border-red")
                }

                if (statement_remarks.length > 0 && !statement_remark_full_width_check) {
                    errmsg += createErrorP("【明細備考】全角文字以外は使用できません。")
                    $("#statement_remarks").addClass("border-red")
                }
                if(delivery_method_Error){
                    errmsg += createErrorP("【納品方法】必須項目に入力がありません。")
                    $("#delivery_method").addClass("border-red")
                }
                if (continution_category_Error){
                    errmsg += createErrorP("【継続区分】必須項目に入力がありません。")
                    $("#continution_category").addClass("border-red")
                }
                $("#shippingErrorData").html(errmsg)

            }

        }


    })
})
