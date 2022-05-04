function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function createMsg(err_msg, type) {
    var typeMessage = type ? 'blue' : 'red';
    var html = '<div>';
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

function changeConfirmStatus() {
    $('#confirm_status').val(0)
    $("#confirmation_message").empty()
}

function resetLineItem(lineItemId) {
    $('#' + lineItemId).find('.payment_method option[value="A902"]').prop('selected', true)
    $('#' + lineItemId).find('.deposit_bank option').eq('0').prop('selected', true)
    $('#' + lineItemId).find('.deposit_branch option').eq('0').prop('selected', true)
    $('#' + lineItemId).find('.deposit_bank').css('pointer-events', 'all')
    //$('#' + lineItemId).find('.deposit_branch').css('pointer-events', 'all')
    $('#' + lineItemId).find('.deposit_branch').prop("readonly", true)
    $('#' + lineItemId).find('.deposit_branch').css('pointer-events', 'none')
    $('#' + lineItemId).find(".deposit_amount").val('')
    $('#' + lineItemId).find(".bill_settlement_date").val('')
    $('#' + lineItemId).find(".bill_settlement_date").prop("readonly", true)
    $('#' + lineItemId).find(".bill_settlement_date").css("pointer-events", 'none')
    $('#' + lineItemId).find(".bill_settlement_date").next().val('')
    $('#' + lineItemId).find(".remarks").val('')
}

function setPaymentDate() {
    let current_date = moment()
    current_date = current_date.format('YYYY/MM/DD')

    $('#payment_date').val(current_date)
    $('#payment_date').next().val(current_date.replaceAll("/", ""))
    $('#payment_date').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: current_date,
        trigger: '#payment_date'
    })
}

function numberCommaFormat(num) {
    if (num) {
        console.log({ 'numberFormat': num })
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    // console.log({'numberFormat' : ''})
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

function setDepositAmount(payment_date, billing_address) {
    if (payment_date && billing_address) {
        let _token = $("#csrf").val()
        let bango = $("#userId").val()
        $.ajax({
            url: "deposit-input/expected-deposit-amount/" + bango,
            type: 'POST',
            data: { billing_address, payment_date, _token },
            success: function (res) {
                let deposit_amount = (res.deposit_amount && formatNumber(res.deposit_amount)) ? formatNumber(res.deposit_amount) : 0;
                $("#expected_deposit_amount").html(deposit_amount)
                $('input[name=expected_deposit_amount]').val(deposit_amount)
            },
            error: function (err) {
                $("#expected_deposit_amount").html(0)
                $('input[name=expected_deposit_amount]').val(0)
            }
        })
    } else {
        $("#expected_deposit_amount").html("0")
        $('input[name=expected_deposit_amount]').val(0)
    }
}

function setSpecificSelectItem(dbHiddenValue) {
    var bango = $("#userId").val()
    $.ajax({
        url: "deposit-input/bill-wise-categories/" + bango,
        type: "GET",
        data: { billing_address: dbHiddenValue },
        success: function (res) {
            console.log({ 'setSelect': res })
            var creation_category = $('#creation_category').val();
            const { deposit_bank, deposit_branch, showed } = res
            console.log({ deposit_bank, deposit_branch, showed })
            let deposit_bank_error = '入金銀行';
            let deposit_branch_error = '入金支店';
            if (!showed) {
                $(".lineItem").each(function () {
                    $(this).find('.deposit_branch').prop("readonly", true)
                    $(this).find('.deposit_branch').css('pointer-events', 'none')
                    $('#' + lineItemId).find('.deposit_branch').css('pointer-events', 'none')
                    let payment_method_value = $(this).find('.payment_method').val();
                    let type1 = ['A901', 'A902', 'A903', 'A904'];
                    if (type1.indexOf(payment_method_value) !== -1) {
                        let depositBankOption = $(this).find(".deposit_bank option[value=" + deposit_bank + "]")
                        let depositBranchOption = $(this).find(".deposit_branch option[value=" + deposit_branch + "]")

                        if (deposit_bank && depositBankOption) {
                            depositBankOption.prop('selected', true)
                            $(this).find(".deposit_bank").hasClass("error") ? $(this).find(".deposit_bank").removeClass("error") : ''
                            removeFromErrorData(deposit_bank_error)
                        } else {
                            $(this).find('.deposit_bank option').eq('0').prop('selected', true)
                            $(this).find('.deposit_bank').hasClass("error") ? $(this).find('.deposit_bank').removeClass("error") : ''
                            removeFromErrorData(deposit_bank_error)
                        }

                        if (deposit_branch && depositBranchOption) {
                            depositBranchOption.prop('selected', true)
                            $(this).find(".deposit_branch").hasClass("error") ? $(this).find(".deposit_branch").removeClass("error") : ''
                            removeFromErrorData(deposit_branch_error)
                        } else {
                            console.log($(this).find('.deposit_branch option'))
                            $(this).find('.deposit_branch option').eq('0').prop('selected', true)
                            $(this).find('.deposit_branch').hasClass("error") ? $(this).find('.deposit_branch').removeClass("error") : ''
                            removeFromErrorData(deposit_branch_error)
                        }
                    } else {
                        $(this).find('.deposit_branch').prop("readonly", true)
                        $(this).find('.deposit_branch').css('pointer-events', 'none')
                        $(this).find('.deposit_bank option').eq('0').prop('selected', true)
                        $(this).find('.deposit_branch option').eq('0').prop('selected', true)
                        $(this).find('.deposit_bank').hasClass("error") ? $(this).find('.deposit_bank').removeClass("error") : ''
                        removeFromErrorData(deposit_bank_error)
                        $(this).find('.deposit_branch').hasClass("error") ? $(this).find('.deposit_branch').removeClass("error") : ''
                        removeFromErrorData(deposit_branch_error)

                    }
                })
            } else {
                $(this).find('.deposit_branch').prop("readonly", true)
                $(this).find('.deposit_branch').css('pointer-events', 'none')
                $(this).find('.deposit_bank option').eq('0').prop('selected', true)
                $(this).find('.deposit_branch option').eq('0').prop('selected', true)
                $(this).find('.deposit_bank').hasClass("error") ? $(this).find('.deposit_bank').removeClass("error") : ''
                removeFromErrorData(deposit_bank_error)
                $(this).find('.deposit_branch').hasClass("error") ? $(this).find('.deposit_branch').removeClass("error") : ''
                removeFromErrorData(deposit_branch_error)

            }
        }
    })
}

function loadDepositInputData(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {
    var payment_date = $("#payment_date").val()
    setDepositAmount(payment_date, torihikisaki_cd)
    //setSpecificSelectItem(torihikisaki_cd)
}

function removeFromErrorData(error) {
    $("#error_data > div > p").each(function () {
        var errorData = $(this).html()
        if (errorData.includes(error)) {
            $(this).remove()
        }
    })
}

$(document).ready(function () {
    localStorage.removeItem('serialLineItem')
    $('body').css('pointer-events', 'all')
    $("#lineItem").find('.payment_method option[value="A902"]').prop('selected', true)
    $(document).on("click", "#registration", function (e) {
        e.preventDefault()
        $(this).prop("disabled", true)
        var bango = $("#userId").val()
        $("#insertData input").parent().find('input').removeClass("error");
        $("#insertData select").parent().find('select').removeClass("error");
        $("#insertData #error_data").empty();
        let delLine = localStorage.getItem('serialLineItem')
        $("input[name='deleteLine']").val(delLine)
        $.ajax({
            url: 'deposit-input/register/' + bango,
            type: 'POST',
            data: $('#insertData').serialize(),
            success: function (res) {
                if (res.status == 'ng') {
                    var err_msg = res.err_msg;
                    $("#insertData #error_data").html(createMsg(err_msg));
                    var inputError = res.err_field;
                    let targetEl;
                    let selectInputs = ["payment_method", "deposit_bank", "deposit_branch"];
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
                        targetEl.addClass("error")
                        var targetElId = targetEl.prop('id');
                        if (targetElId && targetElId.search("_db")) {
                            targetEl.parents('.input-group').find("input[type=text]").addClass('error')
                        }

                    })
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'confirm') {
                    var confirmMessage = "登録はまだ完了していません。内容を確認後、もう一度 「登 録」 をお願いします。"
                    $("#confirmation_message").html(createMsg(confirmMessage));
                    $("#confirm_status").val(1)
                    $("#registration").prop("disabled", false)
                } else if (res.status == 'ok') {
                    location.reload()
                } else if (res.status == "not_ok") {
                    $("#registration").prop("disabled", false)
                }
                else if (res.status == "error90") {
                    console.log(res.status);
                    $("#insertData #error_data").html('訂正回数が最大値を超えます。');
                    $("#registration").prop("disabled", false)
                    $("#creation_category").css("pointer-events", "");
                    $("#deposit_number").css("pointer-events", "");
                }
            },
            error: function (res) {
                console.log({ res })
                $("#registration").prop("disabled", false)
            }
        })

    })
    $(document).on('click', '.delete_btn', function (e) {
        e.preventDefault()
        var lineItemLength = $('.lineItem').length
        var lineItemId = $(this).parents('.lineItem').prop('id')
        let isEdit = $("#creation_category").val() == '2 訂正';
        let serial = $("#" + lineItemId).find(".shinkurokokyakugroup").val()
        serial = serial ? serial : null
        if (lineItemLength > 1) {
            $('#confirm_deposit_input_line_delete').find('#lineItemId').val(lineItemId)
            $('#confirm_deposit_input_line_delete').modal('show');
        } else {
            if (isEdit) {
                let serialLineItem = localStorage.getItem('serialLineItem') ? JSON.parse(localStorage.getItem('serialLineItem')) : []
                serial ? serialLineItem.push(serial) : ''
                localStorage.setItem('serialLineItem', JSON.stringify(serialLineItem))
            }
            // resetLineItem(lineItemId)
        }

    })
    $(document).on('click', '#submit_modal', function () {
        var lineItemId = $('#confirm_deposit_input_line_delete').find('#lineItemId').val()
        let serial = $("#" + lineItemId).find(".shinkurokokyakugroup").val()
        serial = serial ? serial : null;
        let isEdit = $("#creation_category").val() == '2 訂正';
        if (isEdit) {
            let serialLineItem = localStorage.getItem('serialLineItem') ? JSON.parse(localStorage.getItem('serialLineItem')) : []
            serial ? serialLineItem.push(serial) : ''
            localStorage.setItem('serialLineItem', JSON.stringify(serialLineItem))
        }
        $('#' + lineItemId).remove()
        $('#confirm_deposit_input_line_delete').modal('hide');
        if (!isEdit) {
            serialLineItem();
        }
        totalDepositAmount()
    })
    $(document).on('click', '#close_modal', function () {
        $('#confirm_deposit_input_line_delete').find('#lineItemId').val('')
        $('#confirm_deposit_input_line_delete').modal('hide');
    })
    $('#deposit_number').attr('readonly', true)
    $(document).on('change', '#creation_category', function () {
        if ($(this).val() == '2 訂正') {
            $('#deposit_number').attr('readonly', false)

        } else {
            $(".lineItem").not(":eq(0)").remove()
            var lineItemId = $(".lineItem").eq(0).prop("id")
            resetLineItem(lineItemId)
            //  serialLineItem()
            $("#" + lineItemId).find('.shinkurokokyakugroup').val('')
            $("#" + lineItemId).find('.serial').html(1)
            $("#" + lineItemId).find('.serial-input').val(1)
            $('#deposit_number').val('')
            $('#deposit_number').attr('readonly', true)
            $('#deposit_number').hasClass('error') ? $('#deposit_number').removeClass('error') : ''
            removeFromErrorData('入金番号')
            setPaymentDate()
            $("#billing_address").val('')
            $("#billing_address_db").val('')
            $("input[name=expected_deposit_amount]").val(0);
            $("#expected_deposit_amount").html('0')
            $("input[name=total_deposit_amount]").val(0);
            $("#total_deposit_amount").html('0')
        }
    })
    $(document).on('change', 'select', changeConfirmStatus)
    $(document).on('input', 'input', changeConfirmStatus)
    setPaymentDate()
    $(document).on('change', "#payment_date", function () {
        var payment_date = $(this).val()
        var billing_address = $("#billing_address_db").val()
        setDepositAmount(payment_date, billing_address)
    })
    $(document).on('change', '.payment_method', function () {
        let payment_method_value = $(this).val();
        let type1 = ['A901', 'A902', 'A903', 'A904'];
        let type2 = ['A905'];
        let $lineItem = $(this).parents('.lineItem')
        let $depositBank = $lineItem.find('.deposit_bank')
        let $depositBalance = $lineItem.find('.deposit_branch')
        let $billingSettlementDate = $lineItem.find('.bill_settlement_date')
        if (!type1.includes(payment_method_value)) {
            $depositBalance.attr('readonly', true);
            $depositBank.attr('readonly', true);
            $depositBank.css('pointer-events', 'none')
            $depositBalance.css('pointer-events', 'none')
            $lineItem.find('.deposit_bank option').eq('0').prop('selected', true)
            $lineItem.find('.deposit_branch option').eq('0').prop('selected', true)
        } else {
            //$depositBalance.attr('readonly', false);
            $depositBalance.attr('readonly', true);
            $depositBank.attr('readonly', false);
            $depositBank.css('pointer-events', 'all')
            //$depositBalance.css('pointer-events', 'all')
            $depositBalance.css('pointer-events', 'none')
        }
        if (!type2.includes(payment_method_value)) {
            $billingSettlementDate.attr('readonly', true);
            $billingSettlementDate.val('')
            $billingSettlementDate.next().val('')
            $billingSettlementDate.css('pointer-events', 'none')
        } else {
            $billingSettlementDate.attr('readonly', false)
            $billingSettlementDate.css('pointer-events', 'all')
        }
    })

    $(document).on("click", "#choice_buttonApi2", function () {
        $("#billing_address").hasClass("error") ? $("#billing_address").removeClass("error") : ''
        removeFromErrorData("売上請求先")

    })



    $(document).on("change", 'select', function () {
        let deposit_bank = '入金銀行';
        let deposit_branch = '入金支店';
        $(this).hasClass("error") ? $(this).removeClass("error") : ''
        if ($(this).hasClass('deposit_bank')) {
            removeFromErrorData(deposit_bank)
        }
        if ($(this).hasClass('deposit_branch')) {
            removeFromErrorData(deposit_branch)
        }
    })
    $(document).on("keyup", 'input', function () {
        let deposit_number = '入金番号';
        let deposit_amount = '入金金額';
        let remarks = '備考';

        $(this).hasClass("error") ? $(this).removeClass("error") : ''
        if ($(this).hasClass('deposit_number')) {
            removeFromErrorData(deposit_number)
        }
        if ($(this).hasClass('deposit_amount')) {
            removeFromErrorData(deposit_amount)
        }

        if ($(this).hasClass('remarks')) {
            removeFromErrorData(remarks)
        }
    })
})
