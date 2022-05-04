
function calculationGrossProfitAndPrice() {
    var total_sales_amount = 0;
    n = $(".line-form").length; // arbitrary length
    var masterPrice = Array(n).fill(0);
    $('.line-form').not(':has(.invoke-delete)').each(function () {
        // if ($(this).find('.productSubOrCdTarget').val() != '') {
            var arrId = $(this).attr('id');
            var arrInd = removeComma($(this).find(".lineValue").text());
            var totalPrice = $(this).find($('input[name="productAmount[]"]')).val()
            masterPrice[arrInd] = removeComma(totalPrice);      
        // }
    })
    for (var i = 1; i < masterPrice.length; i++) {
        total_sales_amount += masterPrice[i]
    }
    return total_sales_amount
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
    const total_sales_amount = calculationGrossProfitAndPrice();
    $('#total_order_amount_show').text('¥ ' + numberFormat(total_sales_amount));
    $("input[name='total_order_amount']").val(total_sales_amount)
}


function elementCopy($element) {
    // var $elementData = ref.parents().closest('.line-form');
    // console.log("f",$elementNext);
    // var $element = $('#userTable tr[id^="LineBranch"]:last');
    console.log($element);
    // var elId = $element.attr('id');
    // var rowId = elId && elId.replace("LineBranch", "");
    // rowId = parseInt(rowId) + 1;
    var rowId = $("#userTable tr").length;
    var clonedElement = $element.clone(true);
    var length = Math.floor(Math.random() * 1000)
    var domElements = ['delBtn', 'lineBtn', 'lineValue','productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount',
    'responsiblePerson','orderAmountClassification']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.prop("id", item + '-' + length);
    })
    // var domElements = ['productCd', 'productName', 'manufacturerPartNumber', 'quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'juchubangougyou','juchubangou','juchubangougyoueda', 'syouhizei','kobetunouki','genchoubi']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.val('');
    })
    clonedElement.find('select, input').each(function () {
        if ($(this).hasClass("error")) {
            $(this).removeClass("error")
        }
    })
    // var responsiblePerson = clonedElement.find('.responsiblePerson option:nth-child(2)').val()
    var bango = $element.find(".responsiblePerson").val();
    clonedElement.find(".responsiblePerson").val(bango).change();
    clonedElement.find(".responsiblePersonCD").val(bango);
    var orderAmountClassification = clonedElement.find('.orderAmountClassification option:nth-child(1)').val()
    clonedElement.find(".orderAmountClassification").val(orderAmountClassification).change();
    clonedElement.attr('id', 'LineBranch' + rowId);
    $element.after( clonedElement);
    var $nextElement = $($element).next();
    $nextElement.find('.lineValue').text(rowId);
    $nextElement.find('.line-input').val(rowId);
}
function deleteRow(rowId){
    var rowCount = $("#userTable tr").length;
    console.log(rowCount);
    if(rowCount > 2){
        $("#LineBranch" + rowId).remove();
        // var id = 1;
        // $(".line-form").each(function(){
        //     $(this).attr("id","LineBranch"+id);
        //     $(this).find(".lineValue").text(id);
        //     $(this).find(".line-input").val(id);
        //     id++;
        // })
        if(rowCount == 3){
            var id = 1;
            $(".line-form").each(function(){
                $(this).attr("id","LineBranch"+id);
                $(this).find(".lineValue").text(id);
                $(this).find(".line-input").val(id);
                id++;
            })
        }
    }else{
        var domElements = ['delBtn', 'lineBtn', 'lineValue', 'productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount',
        'responsiblePerson','orderAmountClassification']
        domElements.forEach(function (item) {
            var targetElm = $("#LineBranch" + rowId).find("." + item);
            targetElm.val('');
        })  
        var bango = $("input[id='userId']").val();
        $("#LineBranch" + rowId).find(".responsiblePerson").val(bango).change();
        var orderAmountClassification = $("#LineBranch" + rowId).find('.orderAmountClassification option:nth-child(1)').val()
        $("#LineBranch" + rowId).find(".orderAmountClassification").val(orderAmountClassification).change();
        $("#LineBranch" + rowId).find('.lineValue').text(1);
        $("#LineBranch" + rowId).find('.line-input').val(1);
        $("#LineBranch" + rowId).attr('id', 'LineBranch' + rowId);
    }
}
function handleEmployeeCdDependOnCategoryKanri() {
    var $el = $("#categorikanri");
    var category = $el.val();
    var bango = $("input[id='userId']").val();
    if (category == 'V130' || category == 'V140'){
        if(category == 'V130'){
            var html = "<option selected value=0020>0020 Ｓ研究所 社員</option>";
            $('#employee_cd').html(html);
            $('#employee').val('0020');
        }
        if(category == 'V140'){
            var html = "<option selected value=0970>0970 出荷 センター</option>";
            $('#employee_cd').html(html);
            $('#employee').val('0970');
        }
        $('#employee_cd').prop('disabled', true);
    }
    else if (category == 'V110' || category == 'V120'){
        if(category == 'V110'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val()
                },
                type: "POST",
                url: "gross_profit_adjustment_input/employee_cd/" + bango,
                data: {
                    category: 'C310'
                },
                success: function (response) {
                    console.log(response);
                    $('#employee_cd').html(response.html);
                    $('#employee').val(response.isSelected);
                }
            });
        }
        if(category == 'V120'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val()
                },
                type: "POST",
                url: "gross_profit_adjustment_input/employee_cd/" + bango,
                data: {
                    category: 'C320'
                },
                success: function (response) {
                    console.log(response);
                    $('#employee_cd').html(response.html);
                    $('#employee').val(response.isSelected);
                }
            });
        }
        $('#employee_cd').prop('disabled', false);
    }
    else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "gross_profit_adjustment_input/employee_cd/" + bango,
            data: {
                category: null,
            },
            success: function (response) {
                console.log(response);
                $('#employee_cd').html(response.html);
                $('#employee').val(response.isSelected);
            }
        });
        $('#employee_cd').prop('disabled', false);
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
        console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()
    })
    var domBody = $("body");
    domBody.on("click", ".lineBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');
        elementCopy($element);
    })
    domBody.on("click", ".deleteBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');
        var elId = $element.attr('id');
        var rowId = elId && elId.replace("LineBranch", "");
        // console.log(rowId);
        deleteRow(rowId);
    })
    domBody.on("keyup", ".productQuantity,.productUnitPrice", calculatePriceInLine);
    $(document).on('change', "#employee_cd",function (e) {
        var bango = $(this).val();
        $("#employee").val(bango);
    })
    $(document).on("change", "#categorikanri", handleEmployeeCdDependOnCategoryKanri);
    
    $(document).on('change', "select[name='responsiblePersonCD[]']",function (e) {
        var $element = $(this).parents().closest('.line-form');
        var bango = $(this).val();
        $element.find('.responsiblePersonCD').val(bango);
    })
    $(document).on('change', "select[name='orderAmountClassification[]']",function (e) {
        var $element = $(this).parents().closest('.line-form');
        // var elId = $element.attr('id');
        var category = $(this).val();
        var bango = $("input[id='userId']").val();
        if (category == 'V130' || category == 'V140'){
            if(category == 'V130'){
                var html = "<option selected value=0020>0020 Ｓ研究所 社員</option>";
                $element.find('.responsiblePerson').html(html);
                $element.find('.responsiblePersonCD').val('0020');
            }
            if(category == 'V140'){
                var html = "<option selected value=0970>0970 出荷 センター</option>";
                $element.find('.responsiblePerson').html(html);
                $element.find('.responsiblePersonCD').val('0970');
            }
            $element.find('.responsiblePerson').prop('disabled', true);
        }
        else if (category == 'V110' || category == 'V120'){
            if(category == 'V110'){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf').val()
                    },
                    type: "POST",
                    url: "gross_profit_adjustment_input/employee_cd/" + bango,
                    data: {
                        category: 'C310'
                    },
                    success: function (response) {
                        // console.log(response);
                        $element.find('.responsiblePerson').html(response.html);
                        $element.find('.responsiblePersonCD').val(response.isSelected);
                    }
                });
            }
            if(category == 'V120'){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf').val()
                    },
                    type: "POST",
                    url: "gross_profit_adjustment_input/employee_cd/" + bango,
                    data: {
                        category: 'C320'
                    },
                    success: function (response) {
                        // console.log(response);
                        $element.find('.responsiblePerson').html(response.html);
                        $element.find('.responsiblePersonCD').val(response.isSelected);
                    }
                });
            }
            $element.find('.responsiblePerson').prop('disabled', false);
        }
        else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val()
                },
                type: "POST",
                url: "gross_profit_adjustment_input/employee_cd/" + bango,
                data: {
                    category: 'C320'
                },
                success: function (response) {
                    // console.log(response);
                    $element.find('.responsiblePerson').html(response.html);
                    $element.find('.responsiblePersonCD').val(response.isSelected);
                }
            });
            $element.find('.responsiblePerson').prop('disabled', false);
        }
    })
    domBody.on("click","#registrationButton", function (e) {   
        button++;     
        e.preventDefault();
        var data = new FormData(document.getElementById('insertData'));
        var bango = $("input[id='userId']").val();
        $("input[name=type]").val("create");
        if (button == 1){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf').val()
                },
                type: "POST",
                url: "gross_profit_adjustment_input/register/" + bango,
                data: data,
                processData: false,
                contentType: false,
                success: function (result) {
                    // console.log(result)
                    if ($.trim(result.status) == 'confirm' && button == 1) {
                        confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください。</p></div>'
                        $("#error_data").empty();
                        $("#confirmation_message").html(confirmHtml)
                        $("#confirm_status").val(1);
                        $('#registrationButton').prop("disabled", false);
                    }
                    if ($.trim(result.status) == 'ok') {
                        console.log('done');
                        result.session_order_bango ? localStorage.setItem('session_order_bango', result.session_order_bango) : ""
                        // result.session_company_code ? localStorage.setItem('session_company_code', result.session_company_code) : ""
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
                        if (inputError || inputErrorMsg) {
                            if (inputError) {
                                for (const err_field in inputError) {
                                    var targetEl = '';
                                    var selectInputs = ["employee_cd", "order_category",'orderAmountClassification','responsiblePerson'];
                                    if (err_field.indexOf('.') > -1) {
                                        const [inputName, key] = err_field.split('.');                                   
                                        if (inputName && selectInputs.indexOf(inputName) >= 0) {
                                            if(inputName == 'responsiblePerson'){
                                                targetEl = $("select[name='" + 'responsiblePersonCD' + "[]']").eq(key)
                                            }else{
                                                targetEl = $("select[name='" + inputName + "[]']").eq(key)
                                            }     
                                        } else {
                                            targetEl = $("input[name='" + inputName + "[]']").eq(key)
                                        }
                                    } else {
                                        if (err_field && selectInputs.indexOf(err_field) >= 0) {
                                            if(err_field == 'employee_cd'){
                                                targetEl = $("select[name=" + "employee" + "]")
                                            }else{
                                                targetEl = $("select[name=" + err_field + "]")
                                            }  
                                        }
                                        else{
                                            targetEl = $("input[name=" + err_field + "]")
                                        }
                                    }
                                    targetEl.addClass("error");
                                    // console.log(err_field,targetEl);
                                }
                            }
                        }
                        var html = '';
                        if (inputErrorMsg) {
                            html = '<div style="margin-left:-8px!important;">';
                            if (inputErrorMsg) {
                                for (var count = 0; count < inputErrorMsg.length; count++) {
                                    var error_message = inputErrorMsg[count];
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
})
function readOrderDetails(){
    var orderId = $(this).val();
    var bango = $("input[id='userId']").val();
    if (orderId.length >= 10) {    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "gross_profit_adjustment_input/order_details/" + bango,
            data: {
                orderId
            },
            success: function (response) {
                var checkStatus = response.errorMessage.length > 0 ? true : false;
                var errorMessage = response.errorMessage;            
                if(response.hasOrder && !checkStatus){
                    if($("#order_number").hasClass("error")){
                        $("#error_data").empty();
                        $("#order_number").removeClass("error");
                    }
                    var orderDetails = response.orderDetails;
                    console.log(orderDetails);
                    if(orderDetails['money10']){
                        $('#order_amount').val(numberFormat(orderDetails['money10']));
                    }
                    if(orderDetails['person_name']){
                        $('#employee_name').val(orderDetails['person_name']);
                    }
                    if(orderDetails['orders_subject']){
                        $('#order_subject').val(orderDetails['orders_subject']);
                    }
                }else{
                    if(checkStatus){
                        $("#order_subject").val('');
                        $("#order_amount").val('');
                        $("#person_name").val('');
                        var html = '<div style="margin-top: 8px;margin-left:-8px!important;">';
                        if (errorMessage) {
                            for (var count = 0; count < errorMessage.length; count++) {
                                var error_message = errorMessage[count];
                                html += '<p>' + error_message + '</p>';
                            }
                        }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                        $("#order_number").addClass("error")
                        // $('#registrationButton').prop('disabled', true);
                    }                   
                }
            }
        })
    }else{
        console.log('please insert valid orderId');
    }
}
$(document).on("keyup", "#order_number",readOrderDetails);
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
// added for numberFormat
function numberFormat(num) {
    if (num) {
        // console.log({'numberFormat': num})
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    // console.log({'numberFormat' : ''})
    return 0;
}