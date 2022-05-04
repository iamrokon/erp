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

        $("#categorikanri").prop("disabled")
        var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search"];
        elements.forEach((el) => {
            var element = $(el);
            var type = element.prop('localName')
            if (type == 'button') {
                element.prop("disabled", true)
            } else if (type == 'select') {
                element.attr("readonly", "readonly")
                element.attr("style", "pointer-events: none;");
            } else if (type == 'input') {
                element.prop('readonly', true)
            }
        })
        $("#orderEntrySubmitBtn").prop("disabled", false)
        $(document).find('.deliveryDestination').each(function () {
            var hasValue = $(this).val() ? $(this).val() : false;
            if (!hasValue) {
                let details = torihikisaki_details;
                let split_part = torihikisaki_details.split("/")[0]
                details = split_part ? details.replace(split_part + '/', '') : details;
                $(this).val(details);
                $(this).next().val(torihikisaki_cd)
            }
        })
        var sold_to_value = $("#reg_sold_to_db").val();
        sold_to_value = sold_to_value ? sold_to_value.substr(0, 6) : 0;
        if (sold_to_value) {
            console.log({ sold_to_value });
            var bango = $("input[id='userId']").val();
            $.ajax({
                url: 'order-entry/sold-wise-pj-value/' + bango,
                data: { catchsm: sold_to_value },
                success: function (res) {
                    $("#pj").html(res)
                }

            })
        }

        if (!$("#reg_sales_billing_destination").val()) {
            $("#reg_sales_billing_destination").val(torihikisaki_details);
            $("#reg_sales_billing_destination_db").val(torihikisaki_cd);
        }
        if (!$("#reg_end_customer").val()) {
            $("#reg_end_customer").val(torihikisaki_details);
            $("#reg_end_customer_db").val(torihikisaki_cd);
        }
        if (!$("#reg_bill_to").val()) {
            $("#reg_bill_to").val(torihikisaki_details);
            $("#reg_bill_to_db").val(torihikisaki_cd);
        }
        //getProductPrice();
    }
    if ($('#reg_sales_billing_destination').val()) {
        var paymentDate = $("#datepicker4_oen").val();
        var billingDestination = $("#reg_sales_billing_destination_db").val();
        console.log({ paymentDate }, { billingDestination })
        if (billingDestination && paymentDate) {
            var bango = $("input[id='userId']").val();
            $.ajax({
                url: 'order-entry/sales-billing-date-wise-payment-date/' + bango,
                data: { paymentDate, billingDestination },
                success: function (res) {
                    let _date = moment(res.paymentDate).format('YYYY/MM/DD')
                    $('#datepicker5_oen').val(_date);
                    let inputDateValue = document.getElementById("datepicker5_oen").value;  //getting date value from input
                    if (inputDateValue.length == 8) {
                        let slicedYear = inputDateValue.slice(0, 4);
                        let slicedMonth = inputDateValue.slice(4, 6) - 1;
                        let slicedDay = inputDateValue.slice(6, 8);
                        $('#datepicker5_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
                    }
                }
            })
        } else if (billingDestination) {
            var bango = $("input[id='userId']").val();
            console.log('paymentDate '+paymentDate+' billingDestination '+billingDestination+' bango '+bango)
            $.ajax({
                url: 'order-entry/sales-billing-date-wise-payment-date/' + bango,
                data: { paymentDate, billingDestination },
                success: function (res) {
                    //console.log(res);
                    console.log("B "+res.B);
                    console.log("C "+res.C);
                    console.log("D "+res.D);
                    console.log("E "+res.E);
                    var F = parseInt(res.A) + parseInt(res.C) + parseInt(res.D) + parseInt(res.E);
                    console.log("F "+F);
                    $('#value_of_F').val(F);
                    $('#value_of_B').val(res.B);

                    $('#datepicker5_oen').val(paymentDate)
                    //can be removed
                    let inputDateValue = document.getElementById("datepicker5_oen").value;  //getting date value from input
                    if (inputDateValue.length == 8) {
                        let slicedYear = inputDateValue.slice(0, 4);
                        let slicedMonth = inputDateValue.slice(4, 6) - 1;
                        let slicedDay = inputDateValue.slice(6, 8);
                        $('#datepicker5_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
                    }
                }
            })
        } else {
            $('#datepicker5_oen').val(paymentDate)
            //can be removed
            let inputDateValue = document.getElementById("datepicker5_oen").value;  //getting date value from input
            if (inputDateValue.length == 8) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6) - 1;
                let slicedDay = inputDateValue.slice(6, 8);
                $('#datepicker5_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
            }
            //can be removed
        }
        $('#igroup1').prop("disabled", false);
    } else if (!$('#reg_sales_billing_destination').val()) {
        $('#igroup1').prop("disabled", true);
    }

    //取引条件 modal, set trancation loaded data
    loadTransactionData(torihikisaki_cd, 'supplier_modal');
}







