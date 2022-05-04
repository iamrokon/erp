function setTransactionData(response, from = '') {
    var tradingCondition = $('#tradingConditionModal');
    const {paymentMethod, immediateClassification, acceptanceConditions, saleStandard, siharaikazeikubun, siharaizeihasuukubun} = response
    var payment = paymentMethod ? paymentMethod[0].category2 + ' ' + paymentMethod[0].category4 : '';
    var immediateClassificationValue = immediateClassification ? immediateClassification[0].category2 + ' ' + immediateClassification[0].category4 : '';
    var acceptanceConditionsValue = acceptanceConditions ? acceptanceConditions[0].category2 + ' ' + acceptanceConditions[0].category4 : '';
    var siharaikazeikubunValue = siharaikazeikubun ? siharaikazeikubun[0].category1 + siharaikazeikubun[0].category2 : '';
    var siharaizeihasuukubunValue = siharaizeihasuukubun ? siharaizeihasuukubun[0].category2 + ' ' + siharaizeihasuukubun[0].category4 : '';
    // console.log(siharaizeihasuukubun);
    var payment_method,acceptance_condition,sales_standard,immediate_classification;
    if( typeof from == 'object'){
        const { reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = from
        payment_method = reg_kessaihouhou ;
        acceptance_condition = reg_chumonsyajouhou
        sales_standard = reg_soufusakijouhou
        immediate_classification = reg_housoukubun
    }else {
        payment_method = from ? '' : $(document).find('#kessaihouhou').val();
        acceptance_condition = from ? '' : $(document).find('#chumonsyajouhou').val();
        sales_standard = from ? '' : $(document).find('#soufusakijouhou').val();
        immediate_classification = from ? '' : $(document).find('#housoukubun').val();

    }

    var reg_kessaihouhou = payment_method ? payment_method : payment;
    var reg_housoukubun = immediate_classification ? immediate_classification : immediateClassificationValue
    var reg_chumonsyajouhou = acceptance_condition ? acceptance_condition : acceptanceConditionsValue
    var reg_soufusakijouhou = sales_standard ? sales_standard : saleStandard

    tradingCondition.find('#reg_kessaihouhou').val(reg_kessaihouhou)
    tradingCondition.find('#reg_housoukubun').val(reg_housoukubun)
    tradingCondition.find('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
    tradingCondition.find("#reg_soufusakijouhou").val(reg_soufusakijouhou);
    
    var transactionData = {
        'reg_kessaihouhou': reg_kessaihouhou,
        'reg_housoukubun': reg_housoukubun,
        'reg_chumonsyajouhou': reg_chumonsyajouhou,
        'reg_soufusakijouhou': reg_soufusakijouhou

    }
    transactionData = JSON.stringify(transactionData)
    localStorage.setItem('transactionData', transactionData)
    var contractorId = $('#supplier_db').val(); //for testing
    localStorage.setItem('lastKokyakuId', contractorId.substr(0, 6))
    taxRateFieldSet(siharaikazeikubunValue, siharaizeihasuukubunValue);
}
function taxRateFieldSet(feild1 = '', field2 = ''){
    //setting 217 and 218 value
    $('.siharaikazeikubun').val(feild1).change();
    $('.siharaizeihasuukubun').val(field2);
    $('body').find('.line-form').each(function (index) {
        var id = $(this).attr("id");
        // console.log(id);
        calculatePriceInLine(id);
    })

}
function taxCalculation(ref){
    // console.log(ref.hasClass("line-form"))
    ref = ref.hasClass("line-form") ? ref : ref.parents().closest('.line-form');
    // console.log(ref)
    // console.log(ref.find('.orderAmount').val());
    if (ref.find('.orderAmount').val() != '') {
        var orderAmount =  ref.find($('input[name="orderAmount[]"]')).val() ?? 0;
        var tax =  ref.find($('select[name="siharaikazeikubun[]"]')).val();
        var val1 =  ref.find($('input[name="siharaizeihasuukubun[]"]')).val();
        if(val1){
            var format = val1.substr(1);
            // console.log(tax);
            // console.log(orderAmount);
            if(tax == 'E110'){
                tax = 0;
            }else if(tax =='E120'){
                tax = 10;
            }
            else if(tax == 'E130'){
                tax = 8;
            }else if(tax == 'E140'){
                tax = 8;
            }
            //  console.log(tax);
            var amount = (removeComma(orderAmount) * tax)/100;
            if (format == '四捨五入'){
                amount = Math.round(amount);
            }else if(format == '切り捨て'){
                amount = Math.floor(amount);
            }else if(format='切り上げ'){
                amount = Math.ceil(amount);
            }
            //  console.log(amount);
            ref.find($('input[name="syouhizei[]"]')).val(numberFormat(amount));
        }
    }
}
function calculatePriceOnChangeSiharaikazeikubun(source){
    var sourceType = typeof (source);
    var parentLineForm = sourceType == 'string' ? $("#" + source) : $(this).parents('.line-form');
    taxCalculation(parentLineForm);
    const { total_sales_amount, totalTax } = calculationGrossProfitAndPrice();
    if(parentLineForm.find($('input[name="syouhizei[]"]')).val()){
        $('#totalTax').text('¥ ' + numberFormat(totalTax));
        $("input[name='totalTax']").val(totalTax)
    }
    if(parentLineForm.find($('input[name="orderAmount[]"]')).val()){
        $('#sales_amount_total').text('¥ ' + numberFormat(total_sales_amount));
        // var total = numberFormat(total_sales_amount);
        $("input[name='sales_amount_total']").val(total_sales_amount)
    }
}
$(document).ready(function () {
    localStorage.removeItem('transactionData');
    localStorage.removeItem('lastKokyakuId');
    $(document).on('click', '#igroup1', function (e) {
        e.preventDefault();
        var contractorId = $('#supplier_db').val();
        var kokyakuId = contractorId ? contractorId.substr(0, 6) : '';
        var lastkokyakuId = localStorage.getItem('lastKokyakuId');
        var isLastkokyakuId = kokyakuId == lastkokyakuId;
        var bango = $("input[id='userId']").val();
        var tradingCondition = $('#tradingConditionModal');

        if (contractorId && !localStorage.getItem('transactionData') && !isLastkokyakuId) {
            $.ajax({
                url: '/hatchu-nyuryoku/contact-wise-trading-condition-value/' + bango,
                data: {contractorId: contractorId},
                success: function (response) {
                    setTransactionData(response)
                    tradingCondition.modal("show");
                }
            })
        } else {
            var transactionData = JSON.parse(localStorage.getItem('transactionData'))
            var {reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = transactionData;
            tradingCondition.find('#reg_kessaihouhou').val(reg_kessaihouhou)
            tradingCondition.find('#reg_housoukubun').val(reg_housoukubun)
            tradingCondition.find('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
            tradingCondition.find("#reg_soufusakijouhou").val(reg_soufusakijouhou)
            tradingCondition.modal("show");
        }


    })
    $(document).on("click", "#select_trading_condition", function () {
        var tradingCondition = $('#tradingConditionModal');
        var reg_kessaihouhou = tradingCondition.find('#reg_kessaihouhou').val()
        var reg_housoukubun = tradingCondition.find('#reg_housoukubun').val()
        var reg_chumonsyajouhou = tradingCondition.find('#reg_chumonsyajouhou').val()
        var reg_soufusakijouhou = tradingCondition.find("#reg_soufusakijouhou").val();
        var transactionData = {
            'reg_kessaihouhou': reg_kessaihouhou,
            'reg_housoukubun': reg_housoukubun,
            'reg_chumonsyajouhou': reg_chumonsyajouhou,
            'reg_soufusakijouhou': reg_soufusakijouhou
        }
        transactionData = JSON.stringify(transactionData)
        localStorage.setItem('transactionData', transactionData)
        tradingCondition.modal("hide");
    });


    $(".closeTradingConditionModal").on("click", function () {
        var transactionData = JSON.parse(localStorage.getItem('transactionData'))
        var {reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = transactionData;
        $('#reg_kessaihouhou').val(reg_kessaihouhou)
        $('#reg_housoukubun').val(reg_housoukubun)
        $('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
        $("#reg_soufusakijouhou").val(reg_soufusakijouhou)
        localStorage.setItem('transactionData', JSON.stringify(transactionData))
        $('#tradingConditionModal').modal("hide");
    });

})

//取引条件 modal, set trancation loaded data
function loadTransactionData(contractorId = '', from = '') {
    var contractorId = $('#supplier_db').val() ? $('#supplier_db').val() : contractorId;
    var bango = $("input[id='userId']").val();
    console.log({contractorId})
    if (contractorId) {
        $.ajax({
            url: '/hatchu-nyuryoku/contact-wise-trading-condition-value/' + bango,
            data: {contractorId: contractorId},
            success: function (response) {
                console.log(response);
                // console.log(from);
                setTransactionData(response, from)
            }
        })
    }
}

// Added from order_entry_dev.js for fileupload and transactionConditional modal disable
function handleRequestDependOnCategoryKanri() {
    // alert("ok");
    var $el = $("#categorikanri");
    var $elVal = $el.val().toString();
    var category = $el.val();
    // console.log(category);
    if (category == 'V440'){
        $('#support_number_search_button').prop('disabled', false);
        $('#support_number_search').prop('readonly', false);
        $('.open_number_search').prop('disabled', true);
        $('#number_search').prop('readonly', true);
        // $('#request option[value="3"]').attr("disabled", true);
    }else{
        $('#support_number_search_button').prop('disabled', true);
        $('#support_number_search').prop('readonly', true);
        $('.open_number_search').prop('disabled', false);
        $('#number_search').prop('readonly', false);
        // $('#request option[value="3"]').attr("disabled", false);
    }
}

function readURL(input) {
    // alert("start");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
    }
    // alert(input.files[0]);
}
$(document).ready(function () {
    if (localStorage.getItem('session_order_bango')) {
        $("#kokyakushoyin_wise_modal").show();
        $(".modaloverlay").addClass('bodyOverlay');
    }
    $('#igroup1').prop("disabled", true);
    $('#support_number_search_button').prop('disabled', true);
    $('#support_number_search').prop('readonly', true);
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
            // alert(fileName2);
        } else {
            $(this).siblings(".custom-file-label").addClass("selected").html("注文書PDFアップロード");
            $("input[name=purchase_order_file_name]").val("");
            $('#customFile').val("");
        }

    });
    $("#customFile").change(function () {
        readURL($('#customFile').val());
    });

    $(document).on("change", "#categorikanri", handleRequestDependOnCategoryKanri)
    $(document).on("change", ".siharaikazeikubun",calculatePriceOnChangeSiharaikazeikubun)
    $(document).on("keyup", ".siharaizeihasuukubun",calculatePriceOnChangeSiharaikazeikubun)
    

    $(document).on('click','.checkbox2',function () {
        if ($(this).parents('.line-form').find('.checkbox2').is(':checked')) {
            $(this).parents('.line-form').find('.checkboxInput').val(1);
        } else {
            $(this).parents('.line-form').find('.checkboxInput').val(2);
        }
    })
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
                // console.log(response);
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