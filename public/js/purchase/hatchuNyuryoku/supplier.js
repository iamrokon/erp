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

function loadOrderEntryData2(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {

    if (fillable_id == 'reg_sold_to') {

        // $("#categorikanri").prop("disabled")
        // var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search"];
        // elements.forEach((el) => {
        //     var element = $(el);
        //     var type = element.prop('localName')
        //     if (type == 'button') {
        //         element.prop("disabled", true)
        //     } else if (type == 'select') {
        //         element.attr("readonly", "readonly")
        //         element.attr("style", "pointer-events: none;");
        //     } else if (type == 'input') {
        //         element.prop('readonly', true)
        //     }
        // })
        $("#orderEntrySubmitBtn").prop("disabled", false)
        $(document).find('.deliveryDestination').each(function () {
            var hasValue = $(this).val() ? $(this).val() : false;
            var id = $(this).parents('.line-form').attr("id");
            console.log(id);
            if (!hasValue) {
                let details = torihikisaki_details;
                let split_part = torihikisaki_details.split("/")[0]
                details = split_part ? details.replace(split_part + '/', '') : details;
                $(this).val(details);
                $(this).next().val(torihikisaki_cd)
                $("#deliveryDest").val(details);
                $("#deliveryDest_db").val(torihikisaki_cd);
                // When Tax Rate calculate from delivery destination DB
                // setRateField(torihikisaki_cd, id); 
            }
        })
        var sold_to_value = $("#reg_sold_to_db").val();
        sold_to_value = sold_to_value ? sold_to_value.substr(0, 6) : 0;

        // if (!$("#supplier_v2").val()) {
        //     $("#supplier_v2").val(torihikisaki_details);
        //     $("#supplier_db").val(torihikisaki_cd);
        // }
        if (!$("#reg_end_customer").val()) {
            $("#reg_end_customer").val(torihikisaki_details);
            $("#reg_end_customer_db").val(torihikisaki_cd);
        }
        //getProductPrice();
    }
    // if ($('#supplier_v2').val()) {
    //     $('#igroup1').prop("disabled", false);
    //     loadTransactionData(torihikisaki_cd, 'supplier_modal');
    // }
    if (fillable_id == 'supplier_v2') {
        $('#igroup1').prop("disabled", false);
        loadTransactionData(torihikisaki_cd, 'supplier_modal');
    }
    
    //取引条件 modal, set trancation loaded data
    // loadTransactionData(torihikisaki_cd, 'supplier_modal');
}