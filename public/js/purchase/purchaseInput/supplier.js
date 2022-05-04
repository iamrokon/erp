function getSpecificIdForSoldModal(ref) {
    var visibleId = $(ref).parents(".input-group").find("input[type=text]").prop("id");
    var hiddenId = $(ref).parents(".input-group").find("input[type=hidden]").prop("id");
    return { visibleId, hiddenId }
}

function loadOrderEntryData1(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {
    var current_class = $("#" + fillable_id).prop('class')
    if (current_class.includes("deliveryDestination")) {
        localStorage.setItem("deliveryDestination", torihikisaki_details + "hidden" + torihikisaki_cd)
        $(document).find('#' + fillable_id).trigger("change")
    }
}

function loadPurchaseInputData2(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {

    if (fillable_id == 'reg_sold_to') {
        $("#orderEntrySubmitBtn").prop("disabled", false)
        var sold_to_value = $("#reg_sold_to_db").val();
        sold_to_value = sold_to_value ? sold_to_value.substr(0, 6) : 0;

        // if (!$("#supplier").val()) {
        //     $("#supplier").val(torihikisaki_details);
        //     $("#supplier_db").val(torihikisaki_cd);
        // }
        if (!$("#reg_end_customer").val()) {
            $("#reg_end_customer").val(torihikisaki_details);
            $("#reg_end_customer_db").val(torihikisaki_cd);
        }
        //getProductPrice();
    }if (fillable_id == 'supplier_v2') {
        supplierWisePaymentDate()
        //getProductPrice();
    }

}