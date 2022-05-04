function totalDepositAmount() {
    let total_deposit_amount = 0;
    $(".deposit_amount").each(function () {
        var deposit_amount = $(this).val().replaceAll(',', '')
        total_deposit_amount += isNaN(deposit_amount) ? 0 : Number(deposit_amount)
    })
    $("input[name='total_deposit_amount']").val(total_deposit_amount)
    $("#total_deposit_amount").html(formatNumber(total_deposit_amount) ? formatNumber(total_deposit_amount) : 0)
}

function resetElement() {
    $("#creation_category option").eq(0).prop('selected', true)
    $("#payment_date").val('');
    $("#billing_address").val('')
    $("#billing_address_db").val('')
    $("input[name=expected_deposit_amount]").val(0)
    $("#expected_deposit_amount").html(0)
}

function serialLineItem() {
    $('.lineItem').each(function (index) {
        let lineLength = parseInt(index) + 1;
        $(this).find('.serial').html(lineLength)
        $(this).find('.serial-input').val(lineLength)
    })
}

function settingsIdAfterCopy($clonedEl) {
    var idChanges = ['serial', 'serial-input', 'payment_method', 'deposit_bank', 'deposit_branch', 'deposit_amount', 'bill_settlement_date', 'remarks', 'shinkurokokyakugroup'];
    var uniqueKey = Math.floor(Math.random() * 1000)
    idChanges.forEach(item => {
        $clonedEl.find('.' + item).hasClass('error') ? $clonedEl.find('.' + item).removeClass('error') : ''
        $clonedEl.find('.' + item).prop('id', item + '-' + uniqueKey)
    })
    $clonedEl.prop('id', '')
    $clonedEl.prop('id', 'lineItem' + '-' + uniqueKey)
    $clonedEl.find("input[name='bill_settlement_date[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: new Date()
    })
    $clonedEl.find('.shinkurokokyakugroup').val('')
}

function formattedDate(date) {
    date = date.replaceAll("/", "")
    let slicedYear = date.substr(0, 4);
    let slicedMonth = date.substr(4, 2);
    let slicedDay = date.substr(6, 2);
    return slicedYear + '/' + slicedMonth + '/' + slicedDay
}

function getCurLineSerial(lastLineSerial) {
    let shinkuroKokyakugroupList = $("#shinkuroKokyakugroupList").val()
    if ($("#creation_category").val() != '2 訂正' || (shinkuroKokyakugroupList.length == 0)) {
        return parseInt(lastLineSerial) + 1;
    } else {
        let shinkuroKokyaku_groupList = JSON.parse(shinkuroKokyakugroupList)
        shinkuroKokyaku_groupList = shinkuroKokyaku_groupList.sort(function (a, b) {
            return b - a;
        })
        $("#shinkuroKokyakugroupList").val("")
        return Number(shinkuroKokyaku_groupList[0]) + 1;
    }
}

$(document).ready(function () {
    $(document).on('click', '.repeat_btn', function (e) {
        e.preventDefault()
        let $el = $(this).parents('.lineItem');
        let $clonedEl = $el.clone(true)
        $($clonedEl).insertBefore('#last_row')
        settingsIdAfterCopy($clonedEl);
        let lineItemId = $clonedEl.prop('id')
        resetLineItem(lineItemId)
        let lastLineSerial = $clonedEl.prev().find('.serial-input').val()
        let curLineSerial = getCurLineSerial(lastLineSerial);
        $clonedEl.find('.serial').html(curLineSerial)
        $clonedEl.find('.serial-input').val(curLineSerial)
        $clonedEl.find('.deposit_bank').attr("readonly", false);
        //$clonedEl.find('.deposit_branch').attr("readonly", false);
        $clonedEl.find('.deposit_branch').attr("readonly", true);
        totalDepositAmount()
    })
    $(document).on('keyup', '.deposit_number', function (e) {
        e.preventDefault()
        let bango = $("#userId").val()
        let deposit_number = $(this).val()
        let length = deposit_number.length
        let _token = $("#csrf").val()
        let payment_date = $("#payment_date").val()
        let billing_address = $("#billing_address_db").val()
        let creation_category = $("#creation_category").val()
        if (length >= 10) {
            $.ajax({
                url: 'deposit-input/details/' + bango,
                type: 'POST',
                data: { deposit_number, _token, payment_date, billing_address, creation_category },
                success: function (res) {
                    console.log({ res })
                    $("#insertData input").parent().find('input').removeClass("error");
                    $("#insertData select").parent().find('select').removeClass("error");
                    $("#insertData #error_data").empty();
                    if (res.status == 'ok') {
                        $("#error_data").empty()
                        const {
                            billing_address,
                            billing_address_db,
                            count_of_deposit_input,
                            creation_category,
                            delivery_number,
                            expected_deposit_amount,
                            payment_date,
                            total_deposit_amount,
                            all_shinkuroKokyakugroup
                        } = res.deposit_input
                        $("#shinkuroKokyakugroupList").val(all_shinkuroKokyakugroup)
                        $("#creation_category").attr("readonly", "readonly")
                        $("#creation_category").attr("style", "pointer-events: none;")
                        $("#deposit_number").attr("readonly", "readonly")
                        $("#deposit_number").attr("style", "pointer-events: none;")
                        //  $('#deposit_number').val(delivery_number);
                        $('#payment_date').val(formattedDate(payment_date))
                        $('#payment_date').next().val(payment_date)
                        $('#billing_address').val(billing_address)
                        $('#billing_address_db').val(billing_address_db);
                        let deposit_amount_ex = expected_deposit_amount && formatNumber(expected_deposit_amount) ? formatNumber(expected_deposit_amount) : 0
                        $('#expected_deposit_amount').html(formatNumber(deposit_amount_ex));
                        $("input[name=expected_deposit_amount]").val(deposit_amount_ex);
                        $('#total_deposit_amount').html(formatNumber(total_deposit_amount) ? formatNumber(total_deposit_amount) : 0);
                        $("input[name=total_deposit_amount]").val(total_deposit_amount);
                        // $(".lineItem").before(res.lineItemView);
                        $('.lineItem').remove()
                        $("#last_row").before(res.lineItemView);
                        let serial = parseInt(count_of_deposit_input) + 1;
                        $(document).find('#serial').html(serial)
                        $(document).find('#serial-input').val(serial)
                    } else if (res.status == 'error') {
                        let depositError = "該当するデータがありません。";
                        $("#creation_category").removeAttr("readonly")
                        $("#creation_category").attr("style", "pointer-events: all;")
                        $("#payment_date").hasClass('error') ? $('#payment_date').removeClass('error') : '';
                        $("#billing_address").hasClass('error') ? $('#billing_address').removeClass('error') : '';
                        $("#payment_date").val('')
                        $("#payment_date").next().val('')
                        $("#billing_address").val('')
                        $("#billing_address_db").val('')
                        $(".lineItem").not(":eq(0)").remove()
                        var lineItemId = $(".lineItem").eq(0).prop("id")
                        resetLineItem(lineItemId)
                        $("#" + lineItemId).find('.shinkurokokyakugroup').val('')
                        $("#error_data").html(createMsg(depositError))
                        $("#deposit_number").addClass("error")
                    } else if (res.status == 'edit_error') {
                        $("#error_data").html(createMsg(res.err_msg))
                        $("#deposit_number").addClass("error")
                    }else if (res.status == 'review__daikinseisan_D7402_edit_error'){
                        $("#error_data").html(createMsg(res.err_msg))
                       // $("#deposit_number").addClass("error")
                    }
                    //    serialLineItem()
                },
                error: function (err) {
                    $(".lineItem").not(":eq(0)").remove()
                    var lineItemId = $(".lineItem").eq(0).prop("id")
                    resetLineItem(lineItemId)
                    //    serialLineItem()
                }
            })

        } else {
            $("#error_data").empty()
            $("#deposit_number").hasClass("error") ? $("#deposit_number").removeClass("error") : ''
        }
    })
    $(document).on('keyup', '.deposit_amount', function (e) {
        e.preventDefault()
        totalDepositAmount()
    })
})
