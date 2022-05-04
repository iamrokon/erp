//open 2-3sub modal/trading condition modal
function openTradingConditionModal() {
    $("#tradingConditionModal").modal("show");
}

function addLeadingZero(string) {
    var inputStringLength = string.length;
    if (inputStringLength > 3) {
        return string;
    } else {
        var looplength = 3 - inputStringLength;
        var leadingZero = '';
        for (var i = 0; i < looplength; i++) {
            leadingZero += '0'
        }
        leadingZero += string
        return leadingZero;
    }
}

function optionExists(select, value) {
    var selectId = select.prop("id");
    if (selectId) {
        return $("#" + selectId + " option")
            .filter(function (i, o) {
                if (o.value) {
                    return o.value == value;
                }
                return false;
            })
            .length > 0;
    }
    return false;
}

function partialOptionExists(select, value) {
    var selectId = select.prop("id");
    if (selectId) {
        return $("#" + selectId + " option")
            .filter(function (i, o) {
                if (o.value) {
                    return o.value.substr(0, 2) == value;
                }
                return false;
            })
            .length > 0;
    }
    return false;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function numberFormat(num) {
    if (num) {
        // console.log({'numberFormat': num})
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    // console.log({'numberFormat' : ''})
    return 0;

}

function singleDateWiseLineDate() {
    var inputId = $(this).prop('id');
    var inputVal = $(this).val();
    var inputVals = inputVal.replaceAll('/', '')
    var inputIds = { 'datepicker1_oen': 'orderDate', 'datepicker2_oen': 'individualDeliveryDate' }
    // var focusIds = {'datepicker1_comShow': 'datepicker1_oen', 'datepicker2_comShow': 'datepicker2_oen'}


    $('.' + inputIds[inputId]).each(function () {
        console.log({ vsl: $(this), inputId, lg: inputIds[inputId] })
        if (!$(this).val()) {
            $(this).val(inputVal);
            $(this).next().val(inputVal);
            let year = parseInt(inputVals.slice(0, 4));
            let month = inputVals.slice(4, 6) - 1;
            let day = parseInt(inputVals.slice(6, 8));
            $(this).datepicker('setDate', new Date(year, month, day));

            if (inputIds[inputId] == 'orderDate') {
                $('#datepicker1_oen').focus();
                $('#datepicker1_oen').datepicker('hide');
            } else if (inputIds[inputId] == 'individualDeliveryDate') {
                $('#datepicker2_oen').focus();
                $('#datepicker2_oen').datepicker('hide');
            }
        }
    })
    // $('#' + focusIds[inputId]).focus()
    // $('#number_search').focus();
}

function handleRequestDependOnCategoryKanri() {
    var $el = $("#categorikanri");
    var $elVal = $el.val().toString();
    var processedVal = $elVal.replace("U1", "")
    const disableRequest = { 'pointer-events': 'none', 'background': '#efefef' }
    const enableRequest = { 'pointer-events': 'all', 'background': '#ffffff' }
    $("#request option").each(function () {
        if ($(this).prop("disabled", true)) {
            $(this).prop("disabled", false)
        }
    })
    if (processedVal == 10 || processedVal == 60 || processedVal == 70) {
        $("#request option").eq(0).prop("selected", true);
        // $("#request").trigger("change")
        $("#request").prop("readonly", false).css(enableRequest)
    } else if (processedVal == 11 || processedVal == 20 || processedVal == 21) {
        $("#request option").eq(1).prop("selected", true);
        $("#request option").eq(0).prop("disabled", true);
        // $("#request").trigger("change")
        $("#request").prop("readonly", false).css(enableRequest)
    } else if (processedVal == 50) {
        //$("#request option").eq(1).prop("disabled", true);
        //$("#request option").eq(0).prop("selected", true);
        //$("#request").prop("readonly", true).css(disableRequest)
        // $("#request").trigger("change")
        if (!$("#number_search").val()) {
            setTimeout(() => alert("売上キャンセルデータを作成する受注番号を入力してください"), 5)
        }
    } else {
        $("#request option").each(function () {
            if ($(this).prop("disabled", true)) {
                $(this).prop("disabled", false)
            }
            $("#request").prop("readonly", false).css('pointer-events', 'all')
        })
    }
    if (processedVal == 10 || processedVal == 60) {
        $("#orderEntrySubmitBtn").prop('disabled', false)
    } else {
        $("#orderEntrySubmitBtn").prop('disabled', true)
    }
}

function billingDestinationWisePaymentDate() {
    var paymentDate = $("#datepicker4_oen").val();
    var billingDestination = $("#reg_sales_billing_destination_db").val();
    if (billingDestination && paymentDate) {
        var bango = $("input[id='userId']").val();
        $.ajax({
            url: 'order-entry/sales-billing-date-wise-payment-date/' + bango,
            data: { paymentDate, billingDestination },
            success: function (res) {
                if (res.errormsg) {
                    alert(res.errormsg)
                }
                let _date = moment(res.paymentDate).format('YYYY/MM/DD')
                $('#datepicker5_oen').val(_date);
                let inputDateValue = document.getElementById("datepicker5_oen").value; //getting date value from input
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
        let inputDateValue = document.getElementById("datepicker5_oen").value; //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6) - 1;
            let slicedDay = inputDateValue.slice(6, 8);
            $('#datepicker5_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }
        //can be removed
    }

}

function requestWiseNumberSearch(el) {
    var tarEl = el ? $("#request") : $(this)
    var requestValues = ['2 受注訂正', '3 受注削除'];
    var requestValue = tarEl.val();
    var orderNumberInput = $(".order_entry_topcontent").find("input[name=order_number]")
    var numberSearchInput = $(document).find("#number_search")
    var numberSearchBtn = $(document).find(".open_number_search")
    var submitBtn = $(document).find('#orderEntrySubmitBtn')
    if (requestValues.includes(requestValue)) {
        tarEl.attr("readonly", "readonly")
        tarEl.attr("style", "pointer-events: none;");
        var order_number = numberSearchInput.val()
        orderNumberInput.val(order_number);
        numberSearchInput.prop("readonly", false)
        numberSearchBtn.prop("disabled", false)
        submitBtn.prop('disabled', false)
    } else if (requestValue == '1 新規作成') {
        tarEl.attr("readonly", false)
        tarEl.attr("style", "pointer-events: all;");
        orderNumberInput.val('');
        numberSearchInput.prop("readonly", true)
        numberSearchBtn.prop("disabled", true)
        submitBtn.prop('disabled', false)
    } else {
        orderNumberInput.val('');
        numberSearchInput.prop("readonly", false)
        numberSearchBtn.prop("disabled", false)
        submitBtn.prop('disabled', true)
    }
    // else {
    //     orderNumberInput.val('');
    //     tarEl.attr("style", "pointer-events: all;");
    //     numberSearchInput.prop("readonly", false)
    //     numberSearchBtn.prop("disabled", false)
    //     submitBtn.prop('disabled',true)
    // }

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function () {
    /*if (localStorage.getItem('session_order_bango')) {
        $("#kokyakushoyin_wise_modal").show();
        $(".modaloverlay").addClass('bodyOverlay');
    }*/
    $('#igroup1').prop("disabled", true);
    //remove local storage data
    localStorage.removeItem("largestSet");
    localStorage.removeItem("numberTargetId");
    localStorage.removeItem("deliveryDestination")
    localStorage.removeItem("parentPrice")
    localStorage.removeItem('lineFromId')
    localStorage.removeItem('isContainDeletedRow')

    $('body').css('pointer-events', 'all')
    $(document).on('click', ".fileUploadClose", function (e) {
        e.preventDefault()
        var labelName = '注文書PDFアップロード ';
        var targetParent = $(this).parents('.custom-select-file-upload');
        var fileLabel = targetParent.find('.custom-file-label');
        if (fileLabel.text() != labelName) {
            fileLabel.text(labelName)
            targetParent.find('.custom-file-input').val('')
            targetParent.find("input[name='purchase_order_file_name']").val('')
        }


    })
    $(".custom-file-input").on("change", function () {
        var fileName2 = $(this).val().split("\\").pop();
        var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
        if (extension == 'pdf' || extension == 'zip') {
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName2);
            $("input[name=purchase_order_file_name]").val(fileName2);
        } else {
            $(this).siblings(".custom-file-label").addClass("selected").html("注文書PDFアップロード");
            $("input[name=purchase_order_file_name]").val("");
            $('#customFile').val("");
        }

    });
    $("#customFile").change(function () {
        readURL($('#customFile').val());
    });
    handleRequestDependOnCategoryKanri();
    //   requestWiseNumberSearch("#request");
    //  $(document).on("change", "#request", requestWiseNumberSearch)
    $(document).on("change", "#categorikanri", handleRequestDependOnCategoryKanri)
    $(document).on('change', "input[name='sales_date']", billingDestinationWisePaymentDate)
    
    //$("#datepicker4_oen").unbind('change').bind('change',billingDestinationWisePaymentDate)
    //$("#datepicker4_oen").unbind('paste').bind('paste',billingDestinationWisePaymentDate)

    $(document).on('change', "#datepicker1_oen", singleDateWiseLineDate)
    $(document).on('change', "#datepicker2_oen", singleDateWiseLineDate)

    // let current_date = moment()
    // let _formatted_current_date = current_date.format('YYYY/MM/DD')
    // let dateIds = ['datepicker1_oen', 'datepicker2_oen', 'datepicker3_oen', 'datepicker4_oen', 'datepicker5_oen']
    // dateIds.forEach((dateField) => {
    //     $("#" + dateField).val(_formatted_current_date);
    //     $("#" + dateField).next().val(current_date)
    // })
    $("#kokyakushoyin_wise_modal .close").on('click', function () {
        $("#kokyakushoyin_wise_modal").hide()
        $(".modaloverlay").removeClass('bodyOverlay');
    })
    $("#kokyakushoyin_wise_modal #choice_button").on('click', function () {
        $("#kokyakushoyin_wise_modal").hide()
        $(".modaloverlay").removeClass('bodyOverlay');
        //add more functionalities
        let orderEntry = localStorage.getItem('session_order_bango')
        let company_code = localStorage.getItem('session_company_code')
        let bango = $("#userId").val()
        localStorage.removeItem('session_order_bango')
        localStorage.removeItem('session_company_code')
        console.log({ orderEntry, bango })
        $.ajax({
            url: '/flatRate/createData/' + bango + '/' + orderEntry + '/' + company_code,
            type: 'GET',
            success: function (response) {
                console.log(response);
                if (response[0] == 'ok') {
                    $(".loading").removeClass('show');
                    $("#session_msg").empty();
                    var dyappend = response[1];
                    $("#session_msg").append(dyappend);
                } else if (response[0] == 'ng') {
                    $(".loading").removeClass('show');
                    $("#session_msg").empty();
                    var dyappend = response[1];
                    $("#error_data").append(dyappend);
                }
            },
            beforeSend: function () {
                $(".loading").addClass('show');
            }
        });
    })
})
