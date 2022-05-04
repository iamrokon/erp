function taxRateCalculation(ref) {
    var money10 = $(ref).find(".productAmount").val();
    money10 = removeComma(money10);
    var info2 = $("#supplier_db").val();
    var otodoketime = $(ref).find(".taxation").val();
    if (money10 && info2 && otodoketime) {
        var bango = $("input[id='userId']").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: 'purchase-input/calculate-tax-rate/' + bango,
            async: false,
            data: { money10, info2, otodoketime },
            success: function (res) {
                console.log(res);
                if(res){
                    $(ref).find(".productTax").val(numberFormat(res));
                }else{
                    $(ref).find(".productTax").val(numberFormat(0));
                }
            }
        })
    }else{
        $(ref).find(".productTax").val(numberFormat(0));
    }
}
function calculationGrossProfitAndPrice() {
    var total_sales_amount = 0;
    var total_gross_profit = 0;
    n = $(".line-form").length; // arbitrary length
    var masterPrice = Array(n).fill(0);
    var masterGross = Array(n).fill(0);
    $('.line-form').not(':has(.invoke-delete)').each(function () {
        // if ($(this).find('.productSubOrCdTarget').val() != '') {
            var arrId = $(this).attr('id');
            var arrInd = removeComma($(this).find(".lineValue").text());
            var totalPrice = $(this).find($('input[name="productAmount[]"]')).val()
            var grossProfit = $(this).find($('input[name="productTax[]"]')).val()
            masterPrice[arrInd] = removeComma(totalPrice);
            masterGross[arrInd] = removeComma(grossProfit);      
        // }
    })
    for (var i = 1; i < masterPrice.length; i++) {
        total_sales_amount += masterPrice[i]
    }
    for (var i = 1; i < masterGross.length; i++) {
        total_gross_profit += masterGross[i]
    }
    var totalTax = total_sales_amount + total_gross_profit;
    return {
        total_sales_amount: total_sales_amount,
        salesTax: total_gross_profit,
        totalTax: totalTax
    }
}
//Start calculation
function calculatePriceInLine(source) {
    var sourceType = typeof (source);
    var parentLineForm = sourceType == 'string' ? $("#" + source) : $(this).parents('.line-form');
    var unitPrice = parentLineForm.find('.productUnitPrice').val();
    unitPrice = unitPrice ? unitPrice : 0;
    var quantity = parentLineForm.find('.productQuantity').val();
    quantity = quantity ? quantity : 0;
    var orderAmount = removeComma(unitPrice) * removeComma(quantity);
    parentLineForm.find($('input[name="productAmount[]"]')).val(numberFormat(orderAmount))    
    // console.log(parentLineForm)
    // taxCalculation(parentLineForm);
    taxRateCalculation(parentLineForm);
    const { total_sales_amount, salesTax, totalTax } = calculationGrossProfitAndPrice();
    $('#totalSales').text('¥ ' + numberFormat(total_sales_amount));
    $("input[name='totalSales']").val(total_sales_amount)
    $('#salesTax').text('¥ ' + numberFormat(salesTax));
    $("input[name='salesTax']").val(salesTax)
    $('#totalTax').text('¥ ' + numberFormat(totalTax));
    $("input[name='totalTax']").val(totalTax)
}

function supplierWisePaymentDate(flag = true) {
    var paymentDate = $("#datepicker1_oen").val();
    var billingDestination = $("#supplier_db").val();
    if (billingDestination) {
        var bango = $("input[id='userId']").val();
        $.ajax({
            url: 'purchase-input/purchase-date-wise-payment-date/' + bango,
            data: { paymentDate, billingDestination },
            success: function (res) {
                if(res.paymentMethod){
                    var paymentMethod = res.paymentMethod;
                    // console.log(paymentMethod);
                    // var payment = paymentMethod ? paymentMethod[0].category2 + ' ' + paymentMethod[0].category4 : '';
                    $('#payment_method').val(paymentMethod).change();
                }
                if (res.errormsg) {
                    alert(res.errormsg)
                }
                if(res.paymentDate && flag){
                    let _date = moment(res.paymentDate).format('YYYY/MM/DD')
                    $('#datepicker2_oen').val(_date);
                    let inputDateValue = document.getElementById("datepicker2_oen").value; //getting date value from input
                    if (inputDateValue.length == 8) {
                        let slicedYear = inputDateValue.slice(0, 4);
                        let slicedMonth = inputDateValue.slice(4, 6) - 1;
                        let slicedDay = inputDateValue.slice(6, 8);
                        $('#datepicker2_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
                    }
                }
            }
        })
    } 
    // else {
    //     $('#datepicker2_oen').val(paymentDate)
    //     //can be removed
    //     let inputDateValue = document.getElementById("datepicker2_oen").value; //getting date value from input
    //     if (inputDateValue.length == 8) {
    //         let slicedYear = inputDateValue.slice(0, 4);
    //         let slicedMonth = inputDateValue.slice(4, 6) - 1;
    //         let slicedDay = inputDateValue.slice(6, 8);
    //         $('#datepicker2_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
    //     }
    //     //can be removed
    // }

}

function elementCopy() {
    // var $elementData = ref.parents().closest('.line-form');
    var $element = $('#detailTable tr[id^="LineBranch"]:last');
    // console.log($element);
    var elId = $element.attr('id');
    var rowId = elId && elId.replace("LineBranch", "");
    rowId = parseInt(rowId) + 1;
    var clonedElement = $element.clone(true);
    var length = Math.floor(Math.random() * 1000)
    var domElements = ['delBtn', 'lineBtn', 'lineValue', 'orderNumber','productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'productTax', 'taxation',
    'accountingSubject','accountingItems','tableContractor', 'detailedRemarks']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.prop("id", item + '-' + length);
    })
    // var domElements = ['productCd', 'productName', 'manufacturerPartNumber', 'quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'juchubangougyou','juchubangou','juchubangougyoueda', 'syouhizei','kobetunouki','genchoubi']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.val('');
    })
    clonedElement.find(".tableContractor").html('');
    clonedElement.find('select, input').each(function () {
        if ($(this).hasClass("error")) {
            $(this).removeClass("error")
        }
    })
    clonedElement.find(".taxation").val('E120').change();
    clonedElement.attr('id', 'LineBranch' + rowId);
    $element.after( clonedElement);
    var $nextElement = $($element).next();
    $nextElement.find('.lineValue').text(rowId);
    $nextElement.find('.line-input').val(rowId);
}
function deleteRow(rowId){
    var rowCount = $("#detailTable tr").length;
    console.log(rowCount);
    if(rowCount > 2){
        var currentRowofBacklogTable = $("#LineBranch" + rowId).find(".addedRowNumberOfBacklogTable").val();
        if(currentRowofBacklogTable){
            if($("#" + currentRowofBacklogTable).find(".table-row-select").hasClass("select-button")){
                $("#" + currentRowofBacklogTable).find(".table-row-select").removeClass("select-button");
            }
        }
        $("#LineBranch" + rowId).remove();

        var id = 1;
        $(".line-form").each(function(){
            $(this).attr("id","LineBranch"+id);
            $(this).find(".lineValue").text(id);
            $(this).find(".line-input").val(id);
            var currentRowofBacklogTable = $(this).find(".addedRowNumberOfBacklogTable").val();
            if(currentRowofBacklogTable){
                $("#" + currentRowofBacklogTable).find(".addedRowNumberOfDetailsTable").val("LineBranch"+id);
            }
            id++;
        })
    }else{
        var domElements = ['delBtn', 'lineBtn', 'lineValue', 'orderNumber','productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'productTax', 'taxation',
        'accountingSubject','accountingItems','tableContractor', 'detailedRemarks']
        domElements.forEach(function (item) {
            var targetElm = $("#LineBranch" + rowId).find("." + item);
            targetElm.val('');
        })
        var currentRowofBacklogTable = $("#LineBranch" + rowId).find(".addedRowNumberOfBacklogTable").val();
        if(currentRowofBacklogTable){
            if($("#" + currentRowofBacklogTable).find(".table-row-select").hasClass("select-button")){
                $("#" + currentRowofBacklogTable).find(".table-row-select").removeClass("select-button");
                $("#LineBranch" + rowId).find(".addedRowNumberOfBacklogTable").val(null);
            }
        }   
        $("#LineBranch" + rowId).find('.lineValue').text(1);
        $("#LineBranch" + rowId).find('.line-input').val(1);
        $("#LineBranch" + rowId).find(".taxation").val('E120').change();
        $("#LineBranch" + rowId).attr('id', 'LineBranch' + rowId);
    }
}
var button = 0;
$(document).ready(function () {
    $(document).on('change', 'select', function () {
        // console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()

    })
    $(document).on('input', 'input', function () {
        // console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()
    })
    $(document).on(".deleteBtn, .lineBtn", function () {
        // console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()
    })
    var date=new Date();
	// var val = date.getFullYear()+"/"+(date.getMonth()+1)+"/"+date.getDate();
    let _date = moment().format('YYYY/MM/DD');
	$("#datepicker1_oen").val(_date);
    var domBody = $("body");
    // $(document).on('change', "input[name='purchase_date']", supplierWisePaymentDate)
    domBody.on("click", ".lineBtn", function (e) {
        e.preventDefault();
        // var $element = $(this).parents().closest('.line-form');
        // console.log($element)
        // var valueSet = $element.find('.productSubOrCdTarget').val();
        // if (valueSet) {
        elementCopy();
        // }
    })
    domBody.on("click", ".deleteBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');
        var elId = $element.attr('id');
        var rowId = elId && elId.replace("LineBranch", "");
        // console.log(rowId);
        deleteRow(rowId);
    })
    domBody.on("keyup", ".productQuantity,.productUnitPrice,.productAmount,.productTax", calculatePriceInLine)
    $(document).on('change', "select[name='taxation[]']", calculatePriceInLine);
    
        domBody.on("click","#registrationButton", function (e) {   
            button++;     
            e.preventDefault();
            console.log(button);
            var data = new FormData(document.getElementById('insertData'));
            var bango = $("input[id='userId']").val();
            $("input[name=type]").val("create");
            // alert("edit");
            if (button == 1){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val()
                },
                type: "POST",
                url: "purchase-input/register/" + bango,
                data: data,
                processData: false,
                contentType: false,
                success: function (result) {
                    // console.log(result)
                    if ($.trim(result.status) == 'confirm' && button == 1) {
                        confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p></div>'
                        $("#error_data").empty();
                        $("#confirmation_message").html(confirmHtml)
                        $("#confirm_status").val(1);
                        $('#orderEntrySubmitBtn').prop("disabled", false);
                    }
                    if ($.trim(result.status) == 'ok') {
                        console.log('done');
                        result.session_order_bango ? localStorage.setItem('session_order_bango', result.session_order_bango) : ""
                        result.session_company_code ? localStorage.setItem('session_company_code', result.session_company_code) : ""
                        location.reload();
                    }else{
                        button = 0;
                        $("#error_data").empty();
                        $("input").each(function () {
                            if ($(this).hasClass("error")) {
                                $(this).removeClass("error")
                            }
                        });
                        $("select").each(function () {
                            if ($(this).hasClass("error")) {
                                $(this).removeClass("error")
                            }
                        });
                        $("textarea").each(function () {
                            if ($(this).hasClass("error")) {
                                $(this).removeClass("error")
                            }
                        });
                        var inputError = result.err_field;
                        var inputErrorMsg = result.err_msg;
                        // var orderNumberCheck = checkOrderNumberHanteiFromJuchusyukko();
                        
                        if (inputError || inputErrorMsg) {
                            // $('#orderEntrySubmitBtn').prop("disabled", false);
                            if (inputError) {
                                for (const err_field in inputError) {
                                    var targetEl = '';
                                    var selectInputs = ["tantou", "order_category", "creation_category",'accountingSubject','accountingItems', "taxation"];
                                    if (err_field.indexOf('.') > -1) {
                                        const [inputName, key] = err_field.split('.');                                   
                                        if (inputName && selectInputs.indexOf(inputName) >= 0) {
                                            targetEl = $("select[name='" + inputName + "[]']").eq(key)
                                            console.log(err_field.indexOf('.'));
                                            console.log(targetEl.prop('id'));      
                                        } else {
                                            targetEl = $("input[name='" + inputName + "[]']").eq(key)
                                            console.log(err_field.indexOf('.'));
                                            console.log(targetEl.prop('id'));
                                        }
                                    } else {
                                        if (err_field && selectInputs.indexOf(err_field) >= 0) {
                                            targetEl = $("select[name=" + err_field + "]")  
                                        }
                                        else{
                                            targetEl = $("input[name=" + err_field + "]")
                                        }
                                    }
                                    targetEl.addClass("error")
                                    var idList = targetEl.prop('id');
                                    if (idList && idList.search("_db")) {
                                        targetEl.parents('.input-group').find("input[type=text]").addClass('error')
                                    }
                                    // if(idList && idList=="comment"){
                                    //     $('#deliveryDestination').addClass("error");
                                    //     $('#comment2').addClass("error");
                                    // }
                                    // if(idList && idList=="deliveryDestination_db"){
                                    //     $('#deliveryDest').addClass("error");
                                    // }
                                }
                            }
                        }
                        var html = '';
                        if (inputErrorMsg) {
                            html = '<div>';
                            if (inputErrorMsg) {
                                for (var count = 0; count < inputErrorMsg.length; count++) {
                                    var error_message = inputErrorMsg[count];
                                    // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                                    html += '<p>' + error_message + '</p>';
                                }
                            }
                            html += '</div>';
                            $('#error_data').html(html);
                            $("#error_data").show();
                        }
                    }            
                }
            })
        }
    });
});
