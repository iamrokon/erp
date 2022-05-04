function loadPaymentInputData(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {
    console.log("supplier");
    var payment_date = $("#datepicker1_oen").val();
    setDepositAmount(payment_date, torihikisaki_cd);
    // console.log(payment_date);
    $('#confirm_status').val(0)
    $("#confirmation_message").empty()
}
function setDepositAmount(payment_date, company) {
    if (payment_date && company) {
        let _token = $("#csrf").val()
        let bango = $("#userId").val()
        let payment_classification = $("#payment_classification").val()
        $.ajax({
            url: "payment-input/get-balance-amount/" + bango,
            type: 'POST',
            data: { company, payment_date, payment_classification, _token },
            success: function (res) {
                console.log(res);
                let balance = (res.balance && formatNumber(res.balance)) ? formatNumber(res.balance) : 0;
                $('input[name=balance]').val(balance)
            },
            error: function (err) {
                $('input[name=balance]').val(0)
            }
        })
    } else {
        $('input[name=balance]').val(0)
    }
}
function calculationPrice() {
    var total_sales_amount = 0;
    n = $(".line-form").length; // arbitrary length
    var masterPrice = Array(n).fill(0);
    $('.line-form').each(function () {
        var arrId = $(this).attr('id');
        var arrInd = removeComma($(this).find(".lineValue").text());
        var totalPrice = $(this).find($('input[name="payment_amount[]"]')).val()
        masterPrice[arrInd] = removeComma(totalPrice);      
    })
    for (var i = 1; i < masterPrice.length; i++) {
        total_sales_amount += masterPrice[i]
    }
    $('#total_amount').text('¥ ' + numberFormat(total_sales_amount));
    $("input[name='total_amount']").val(total_sales_amount)
}
function elementCopy() {
    // var $elementData = ref.parents().closest('.line-form');
    var $element = $('div[id^="LineBranch"]:last');
    console.log($element);
    var elId = $element.attr('id');
    var rowId = elId && elId.replace("LineBranch", "");
    rowId = parseInt(rowId) + 1;
    var clonedElement = $element.clone(true);
    var length = Math.floor(Math.random() * 1000)
    var domElements = ['delBtn', 'lineBtn', 'lineValue', 'payment_method', 'bank',
        'branch_store', 'payment_amount', 'due_date', 'remarks']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.prop("id", item + '-' + length);
    })
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.val('');
    })
    clonedElement.find('select, input').each(function () {
        if ($(this).hasClass("error")) {
            $(this).removeClass("error")
        }
    })
    var payment_method = clonedElement.find(".payment_method option:first").val();
    clonedElement.find(".payment_method").val(payment_method).change();
    clonedElement.attr('id', 'LineBranch' + rowId);
    clonedElement.find(".due_date").attr('readonly', true);
    clonedElement.find(".due_date").css('pointer-events', 'none');
    // clonedElement.find("input[name='due_date[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
    //     language: 'ja-JP',
    //     format: 'yyyy/mm/dd',
    //     autoHide: true,
    //     zIndex: 1,
    //     offset: 4,
    //     setDate: new Date()
    // })

    $element.after(clonedElement);
    var $nextElement = $($element).next();
    $nextElement.find('.lineValue').text(rowId);
    $nextElement.find('.line-input').val(rowId);
  
 
}
function deleteRow(rowId){
    var rowCount = $(".line-form").length;
    console.log(rowCount);
    if(rowCount > 1){
        $("#LineBranch" + rowId).remove();
        var id = 1;
        $(".line-form").each(function(){
            $(this).attr("id","LineBranch"+id);
            $(this).find(".lineValue").text(id);
            $(this).find(".line-input").val(id);
            id++;
        })
        calculationPrice()
    }else{
        var domElements = ['delBtn', 'lineBtn', 'lineValue', 'payment_method', 'bank',
        'branch_store', 'payment_amount', 'due_date', 'remarks']
        domElements.forEach(function (item) {
            var targetElm = $("#LineBranch" + rowId).find("." + item);
            targetElm.val('');
        })
        $("#LineBranch" + rowId).find('.lineValue').text(1);
        $("#LineBranch" + rowId).find('.line-input').val(1);
        var payment_method = $("#LineBranch" + rowId).find(".payment_method option:first").val();
        $("#LineBranch" + rowId).find(".payment_method").val(payment_method).change();
        $("#LineBranch" + rowId).attr('id', 'LineBranch' + rowId);
        calculationPrice()
    }
}
// function setDate(){
//     var payment_date = $("input[name='payment_date']").val();
//     var date = payment_date ?? null;
//     date = date ? date.substr(0,4) + '/' + date.substr(4,2) + '/' + date.substr(6) : null;
//     console.log(date);
//     $("#datepicker2_oen").val(date);
//     // $(".datePickerHidden").val(payment_date);
//     var billing_address = $("#supplier_db").val()
//     setDepositAmount(payment_date, billing_address)
// }
var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}
$(document).ready(function () {
    $(".due_date").attr('readonly', true);
    $(".due_date").css('pointer-events', 'none');
    $(document).on('change', "#datepicker1_oen", function () {
        var payment_date = $(this).val()
        var billing_address = $("#supplier_db").val()
        setDepositAmount(payment_date, billing_address)
    })
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

    // var date=new Date();
    // let _date = moment().format('YYYY/MM/DD');
	// $("#datepicker1_oen").val(_date);
    // $("#datepicker2_oen").val(_date);
    var domBody = $("body");
    domBody.on("click", ".lineBtn", function (e) {
        e.preventDefault();
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
        deleteRow(rowId);
    })
    domBody.on("keyup", ".payment_amount", calculationPrice)
    $(document).on('change', '.payment_method', function () {
        let payment_method_value = $(this).val();
        // console.log(payment_method_value);
        let $lineItem = $(this).parents().closest('.line-form');
        let $dueDate = $lineItem.find('.due_date');
        console.log(payment_method_value, $lineItem, $dueDate);
        if (payment_method_value == "D903") {
            $dueDate.attr('readonly', false)
            $dueDate.css('pointer-events', 'all')
            $dueDate.removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
                    language: 'ja-JP',
                    format: 'yyyy/mm/dd',
                    autoHide: true,
                    zIndex: 1,
                    offset: 4,
                    setDate: new Date()
           });
           $(".datePicker1_1").keydown(function (e) {
            if (e.keyCode == 13) {
                $(".datePicker1_1").datepicker('hide');
            }
        });
        } else {
            $dueDate.attr('readonly', true);
            $dueDate.val('')
            $dueDate.next().val('')
            $dueDate.css('pointer-events', 'none')
            $dueDate.removeClass('datePicker').unbind()
        }
    })
    var button = 0;
    domBody.on("click","#registrationButton", function (e) {  
        button++;      
        e.preventDefault();
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
                url: "payment-input/register/" + bango,
                data: data,
                processData: false,
                contentType: false,
                success: function (result) {
                    // console.log(result)
                    if ($.trim(result.status) == 'confirm' ) {
                        confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください。</p></div>'
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
                        if (inputError || inputErrorMsg) {                 
                            if (inputError) {
                                for (const err_field in inputError) {
                                    var targetEl = '';
                                    var selectInputs = ["payment_classification", "payment_method", "bank",'branch_store'];
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
                                }
                            }
                        }
                        var html = '';
                        if (inputErrorMsg) {
                            html = '<div style="margin-top: 8px;">';
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
        else {
            doubleClick();
        }
    });
})
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