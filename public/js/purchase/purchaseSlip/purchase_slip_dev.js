function resetLineItem(lineItemId) {
    $('#' + lineItemId).find(".last_datetime").val('')
    $('#' + lineItemId).find(".id").val('')
}
function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function createMsg(err_msg, type) {
    var typeMessage = type ? 'blue' : 'red';
    var html = '<div>';
    console.log(typeof (err_msg));
    if (typeof (err_msg) != 'string') {
        var errmsg = err_msg.filter(onlyUnique)
        for (var count = 0; count < errmsg.length; count++) {
            html += '<p style="color:' + typeMessage + ';font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + errmsg[count] + '</p>';
        }
    } else {
        html += '<p style="color:' + typeMessage + ';font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + err_msg + '</p>';
    }

    html += '</div>';
    return html;
}

function calculatePriceInLine(source) {
    var sourceType = typeof (source);
    console.log(sourceType);
    var parentLineForm = sourceType == 'string' ? $("#" + source) : $(this).parents('.line-form');
    var purchaseQuantity = parentLineForm.find('.purchase_quantity').val();
    purchaseQuantity = purchaseQuantity ? purchaseQuantity : 0;
    console.log('purchaseQuantity '+purchaseQuantity);
    var purchaseUnitPrice = parentLineForm.find('.purchase_unit_price').val();
    purchaseUnitPrice = purchaseUnitPrice ? purchaseUnitPrice : 0;
    console.log('purchaseUnitPrice '+purchaseUnitPrice);
    var totalPriceInline = removeComma(purchaseUnitPrice) * removeComma(purchaseQuantity);
    console.log('totalPriceInline '+totalPriceInline);
    var taxRate = $("#tax_rate").val();
    console.log('taxRate '+taxRate);
    var tax = (totalPriceInline/100)*taxRate;
    var format = $("#format").val();
    console.log('format '+format);
    if(format == '1'){
        var total_tax_inline = Math.round(tax);
        parentLineForm.find('input[name="purchase_consumption_amount[]"]').val(numberFormat(total_tax_inline))
        console.log('total_tax_inline '+total_tax_inline);
    }else if(format == '2'){
        var total_tax_inline = Math.floor(tax);
        parentLineForm.find('input[name="purchase_consumption_amount[]"]').val(numberFormat(total_tax_inline))
    }else if(format == '3'){
        var total_tax_inline = Math.ceil(tax);
        parentLineForm.find('input[name="purchase_consumption_amount[]"]').val(numberFormat(total_tax_inline))
    }
    parentLineForm.find($('input[name="purchase_line_amount[]"]')).val(numberFormat(totalPriceInline))
    totalPrice()
}

function totalPrice(source) {
    let total_price = 0;
    let total_tax = 0;
    let price_tax_total = 0;
    $(".purchase_line_amount").each(function () {
        var price_inline = $(this).val().replaceAll(',', '')
        total_price += isNaN(price_inline) ? 0 : Number(price_inline)
    })
    $("input[name='total_price']").val(total_price)

    $(".purchase_consumption_amount").each(function () {
        var tax_inline = $(this).val().replaceAll(',', '')
        total_tax += isNaN(tax_inline) ? 0 : Number(tax_inline)
    })
    $("input[name='total_tax']").val(total_tax)

    price_tax_total = total_price + total_tax
    $("input[name='price_tax_total']").val(price_tax_total)
}

function removeComma(str) {
    if (typeof (str) == 'string') {
        if (str != 0) {
            if (/[,\-]/.test(str)) {
                var number = str.replace(/,+/g, '');
            } else {
                var number = str;
            }

        } else {
            var number = 0;
        }
    } else {
        var number = str;
    }
    return parseFloat(number);
}

function numberFormat(num) {
    if (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    return 0;
}

$(document).ready(function () {
    localStorage.removeItem('serialLineItem')
    $(document).on("click", "#registration", function (e) {
        e.preventDefault()
        $(this).prop("disabled", true)
        var bango = $("#userId").val()
        console.log("bango"+bango);
        console.log($('#insertData').serialize());
        $("#confirmation_message").html("");
        $("#error_data").html("");
        $("#success_msg").html("");
        $("#insertData input").parent().find('input').removeClass("error");
        $("#insertData select").parent().find('select').removeClass("error");
        $("#error_data").empty();
        let delLine = localStorage.getItem('serialLineItem')
        $("input[name='deleteLine']").val(delLine)
        $.ajax({
            url: 'purchase-slip/register/' + bango,
            type: 'POST',
            data: $('#insertData').serialize(),
            success: function (res) {
                if (res.status == 'ng') {
                    console.log(res)
                    var err_msg = res.err_msg;
                    $("#error_data").html(createMsg(err_msg));
                    var inputError = res.err_field;
                    let targetEl;
                    let selectInputs = ["incharge_purchasing", "accounting_subject", "accounting_breakdown"];
                    
                    inputError.forEach((item) => {
                        const [inputName, key] = item.split('.')
                        if (inputName && key) {
                            if (selectInputs.indexOf(inputName) >= 0) {
                                targetEl = $("select[name='" + inputName + "[]']").eq(key)
                            } else {
                                targetEl = $("input[name='" + inputName + "[]']").eq(key)
                            }

                        } else if (inputName && !key) {
                            if (selectInputs.indexOf(inputName) >= 0) {
                                targetEl = $("select[name=" + inputName + "]")
                            } else {

                                targetEl = $("input[name=" + inputName + "]")
                            }
                        }
                        console.log(targetEl);
                        targetEl.addClass("error")
                        var targetElId = targetEl.prop('id');
                        if (targetElId && targetElId.search("_db")) {
                            targetEl.parents('.input-group').find("input[type=text]").addClass('error')
                        }

                    })
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'confirm') {
                    var confirmMessage = "登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください。"
                    $("#confirmation_message").html(createMsg(confirmMessage));
                    $("#confirm_status").val(1)
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'ok') {
                    $("#all_id").val(res.all_id)
                    console.log(res.all_id);
                    location.reload()
                } else if (res.status == "not_ok") {
                    $("#registration").prop("disabled", false)
                }
                else if (res.status == "error_int_limit_exceed") {
                    console.log(res.status);
                    if(res.total_price_error){
                        $("#error_data").html('【仕入明細金額】が桁あふれしています。');
                    }
                    if(res.total_tax_error){
                        $("#error_data").html('【仕入明細消費額】が桁あふれしています。');
                    }
                    if(res.price_tax_total_error){
                        $("#error_data").html('【合計】が桁あふれしています。');
                    }
                    $("#registration").prop("disabled", false)
                    // $("#creation_category").css("pointer-events", "");
                    // $("#deposit_number").css("pointer-events", "");
                }
            },
            error: function (res) {
                console.log({ res })
                $("#registration").prop("disabled", false)
            }
        })

    })

    $(document).on("click", "#dataCreation", function (e) {
        e.preventDefault()
        //$(this).prop("disabled", true)
        $("#confirmation_message").html("");
        $("#error_data").empty();
        $("#error_msg_div").empty();
        $("#confirm_status").val(0)
        $("#success_msg").html("");
        
        $("#dataCreation_pop_up_modal1 input").each(function(){
            $(this).val("");
        });
        
        var kaiin_register_status = $("#kaiin_register_status").val();
        if(kaiin_register_status == '1'){
            $("#dataCreation_pop_up_modal1").modal('show')
        }else{
            $("#error_data").html("登録されていません。登録ボタンを押下してください。");
        }
    })


    $(document).on("click", "#dataCreationDone", function (e) {
        e.preventDefault()
        $("#dataCreation_pop_up_modal1").modal('hide')
        $("#dataCreation_pop_up_modal2").modal('hide')
    })

    $(document).on("click", "#main_registration", function (e) {
        e.preventDefault()
        console.log("I am here")
        var bango = $("#userId").val()
        console.log("bango"+bango);
        $("#insertData input").parent().find('input').removeClass("error");
        $("#insertData select").parent().find('select').removeClass("error");
        $('#group_first').removeClass("error");
        $('#group_last').removeClass("error");
        $('#purchase_date').removeClass("error");
        $("#error_data2").empty();
        console.log($('#insertData').serialize());
        $.ajax({
            url: 'purchase-slip/data-create/' + bango,
            type: 'POST',
            data: $('#insertData').serialize(),
            success: function (res) {
                console.log("res"+res);
                if (res.status == 'ng') {
                    var err_msg = res.err_msg;
                    var inputError = res.err_field;
                    let targetEl;

                    var html = '';
                    if (res.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < res.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + res.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#error_data2').html(html);

                        $("#error_data2").show();
                    }
                    inputError.forEach((item) => {
                        const [inputName, key] = item.split('.')
                        if (inputName && key) {
                            targetEl = $("input[name='" + inputName + "[]']").eq(key)
                        } else if (inputName && !key) {
                            targetEl = $("input[name=" + inputName + "]")
                        }
                        console.log('targetEl: '+targetEl)
                        targetEl.addClass("error")

                    })
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'confirm') {
                    var confirmMessage = "登録はまだ完了していません。内容を確認後、もう一度 「登 録」 をお願いします。"
                    $("#confirmation_message").html(createMsg(confirmMessage));
                    $("#confirm_status").val(1)
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'ok') {
                    var msg = "";
                    if(res.no_of_unsumei == 0){
                        msg = "対象のデータがありませんでした。";
                        $("#error_data").html(msg);
                        $("#dataCreation_pop_up_modal1").modal('hide')
                    }else{
                        //msg = res.no_of_unsumei+"登録した ";
                        msg = res.no_of_unsumei+"件登録しました ";
                        $("#no_of_unsumei").html(msg);
                        $("#dataCreation_pop_up_modal2").modal('show')
                    }
                } else if (res.status == "not_ok") {
                    $("#registration").prop("disabled", false)
                }
                else if (res.status == "error_int_limit_exceed") {
                    console.log(res.status);
                    if(res.total_price_error){
                        $("#error_data2").html('【仕入明細金額】が桁あふれしています。');
                    }
                    if(res.total_tax_error){
                        $("#error_data2").html('【仕入明細消費額】が桁あふれしています。');
                    }
                    if(res.price_tax_total_error){
                        $("#error_data2").html('【合計】が桁あふれしています。');
                    }
                }
            },
            error: function (res) {
                console.log({ res })
                $("#registration").prop("disabled", false)
            }
        })

    })

    $(document).on('click', '.delete_btn', function (e) {
    console.log("I am pressed")
    e.preventDefault()
    var lineItemLength = $('.line-form').length
    var lineItemId = $(this).parents('.line-form').prop('id')
    console.log('lineItemLength: '+lineItemLength+' lineItemId: '+lineItemId);
    if (lineItemLength > 1) {
        $('#confirm_purchase_slip_line_delete').find('#lineItemId').val(lineItemId)
        $('#confirm_purchase_slip_line_delete').modal('show');
    } else {
        resetLineItem(lineItemId)
    }

    })

    $(document).on('click', '#submit_modal', function () {
        var lineItemId = $('#confirm_purchase_slip_line_delete').find('#lineItemId').val()
        let serial = $("#" + lineItemId).find(".id").val()
        serial = serial ? serial : null;
        let serialLineItem = localStorage.getItem('serialLineItem') ? JSON.parse(localStorage.getItem('serialLineItem')) : []
        serial ? serialLineItem.push(serial) : ''
        localStorage.setItem('serialLineItem', JSON.stringify(serialLineItem))
        
        $('#' + lineItemId).remove()
        $('#confirm_purchase_slip_line_delete').modal('hide');
        $('.line-form').each(function (index) {
            let lineLength = parseInt(index) + 1;
            $(this).find('.serial').html(lineLength)
            $(this).find('.serial-input').val(lineLength)
            $(this).find('.display_order').val(lineLength)
        })
        $('#deletion_status').val(1);
        $("#kaiin_register_status").val(0);
        totalPrice()
    })

    $(document).on('click', '#close_modal', function () {
        $('#confirm_purchase_slip_line_delete').find('#lineItemId').val('')
        $('#confirm_purchase_slip_line_delete').modal('hide');
    })

    var domBody = $("body");
    domBody.on("keyup", ".purchase_quantity,.purchase_unit_price", calculatePriceInLine)
    $(".retain").change(function() {
        var parentLineForm = $(this).parents('.line-form')
        if(this.checked) {
            console.log("I am checked")
            parentLineForm.find('.retain_val').val(2)
        }else{
            console.log("I am unchecked")
            parentLineForm.find('.retain_val').val(1)
        }
    });

})