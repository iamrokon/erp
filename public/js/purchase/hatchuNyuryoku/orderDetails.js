var previousChild = 0;
function addLeadingZero(string) {
    var inputStringLength = String(string).length;
    if (inputStringLength >= 3) {
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

function changeConfirmStatus() {
    var isInLine = $(this).parents('.line-form').length
    if (isInLine) {
        //vai eikhane code koiren
        var orderId = $('#order_number').val()
        var juchusyukko_check = $(this).parents('.line-form').find("[name='juchusyukko_check']").val()
        if (juchusyukko_check == '1') {
            var line = $(this).parents('.line-form').find('.lineValue').text()
            var branch = $(this).parents('.line-form').find('.branchValue').text()
            var id = 'l' + line + 'b' + branch
            $("#" + id).remove();
            var msg = orderId + '-' + addLeadingZero(line) + '-' + addLeadingZero(branch) + 'は発注出荷等処理済です。発注出荷の訂正・削除を実施してください。'
            $('body').append('<input id="l' + line + 'b' + branch + '" type="hidden" class="checkChanges" value="' + msg + '">')
        }

    }
    $('#confirm_status').val(0)
    $("#confirmation_message").empty()
}

function maintainSerialInput(modifiedLineBranch = false) {
    $('body').find('.line-form').each(function (index) {
        var lineValue = $(this).find('.lineValue').text()
        for (var i = 1; i < productRows.length; i++) {
            if (lineValue == productRows[i] ){
                $(this).attr("id", "LineBranch" + i);
                //$(this).find('.serial').val(i)
            }
        }
    });
    for (var i = 1; i < productRows.length; i++) {
        $("#LineBranch" + i).find('.lineValue').text(i)
        $("#LineBranch" + i).find('.line-input').val(i)
    }
}

function maintainSerialInputWithdivId() {
    $('body').find('.line-form').each(function (index) {
        var id = $(this).attr("id");
        var vId = id.replace("LineBranch", "");
        $(this).find('.serial').val(vId)
    });
}

function calculationGrossProfitAndPrice() {
    var total_sales_amount = 0;
    var total_gross_profit = 0;
    n = productRows.length  // arbitrary length
    var masterPrice = Array(n).fill(0);
    var masterGross = Array(n).fill(0);

    $('.line-form').not(':has(.invoke-delete)').each(function () {
        if ($(this).find('.productSubOrCdTarget').val() != '') {
            var arrId = $(this).attr('id');
            var arrInd = removeComma($(this).find(".lineValue").text());
            var totalPrice = $(this).find($('input[name="orderAmount[]"]')).val()
            var grossProfit = $(this).find($('input[name="syouhizei[]"]')).val()

            masterPrice[arrInd] = removeComma(totalPrice);
            masterGross[arrInd] = removeComma(grossProfit);
            // $(this).find('input[name="quantity[]"]').removeClass("error")
            // $(this).find('input[name="unitSellingPrice[]"]').removeClass("error")      
        }
    })
    for (var i = 1; i < masterPrice.length; i++) {

        total_sales_amount += masterPrice[i]


    }
    for (var i = 1; i < masterGross.length; i++) {
        total_gross_profit += masterGross[i]
    }


    return {
        total_sales_amount: total_sales_amount,
        totalTax: total_gross_profit
    }

}

//Start calculation
function calculatePriceInLine(source) {
    var sourceType = typeof (source);
    var parentLineForm = sourceType == 'string' ? $("#" + source) : $(this).parents('.line-form');
    var unitPrice = parentLineForm.find('.price').val();
    unitPrice = unitPrice ? unitPrice : 0;
    var quantity = parentLineForm.find('.quantity').val();
    quantity = quantity ? quantity : 0;
    var se = parentLineForm.find(".rate").val();
    se = se ? se : 0;
    //var summation = removeComma(se) + removeComma(institute) + removeComma(ship) + removeComma(purchase);
    var totalPrice = removeComma(unitPrice) * removeComma(se);
    quantity = removeComma(quantity);
    unitPrice = removeComma(unitPrice);
    var partitionUnitPrice = Math.round(totalPrice / 100);
    var orderAmount = partitionUnitPrice * quantity;
    if(parentLineForm.find('.price').val()&& parentLineForm.find(".rate").val()){
        parentLineForm.find($('input[name="partitionUnitPrice[]"]')).val(numberFormat(partitionUnitPrice))
    }
        // parentLineForm.find('.grossProfit').text(numberFormat(grossProfit))
    if(parentLineForm.find($('input[name="partitionUnitPrice[]"]')).val()){
        parentLineForm.find($('input[name="orderAmount[]"]')).val(numberFormat(orderAmount))
    }
    // console.log(parentLineForm)
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
    var err_total_sales_msg = '販売金額計が桁あふれしています。'
    var error_p_el = `<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 17px;"> ${err_total_sales_msg} </p>`;
    var $html_err = `<div>${error_p_el}</div>`;
    var hasDiv = $("#error_data > div")
    if (total_sales_amount.toString().length > 9 && !$("#error_data > div > p").text().includes(err_total_sales_msg)) {
        console.log('hiy3')
        if (hasDiv.length) {
            hasDiv.append(error_p_el)
        } else {
            console.log('hiy3-o', { $html_err })
            $("#error_data").html($html_err)
        }
    }

}

function elementCopy(ref) {

    var $elementData = ref.parents().closest('.line-form');
    var $element = $('div[id^="LineBranch"]:last');
    // console.log($element);
    var elId = $element.attr('id');
    var rowId = elId && elId.replace("LineBranch", "");
    rowId = parseInt(rowId);
    var line = parseInt($element.find('.lineValue').text());
    var $div = $('div[id^="LineBranch"]:last');
    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
    productRows[num] = num;
    console.log(productRows);
    var clonedElement = $element.clone(true);
    //var length = parseInt($('.line-form').length)
    var length = Math.floor(Math.random() * 1000)
    var domElements = ['delBtn', 'lineBtn', 'lineValue', 'productCd', 'productName', 'manufacturerPartNumber', 'quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'deliveryDestination', 'deliveryDestination_db',
    'juchubangougyou','juchubangou','juchubangougyoueda', 'siharaikazeikubun', 'siharaizeihasuukubun', 'syouhizei', 'setcode']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.prop("id", item + '-' + length);
    })
    var domElements = ['productCd', 'productName', 'manufacturerPartNumber', 'quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'juchubangougyou','juchubangou','juchubangougyoueda', 'syouhizei','kobetunouki','genchoubi']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.val('');
    })
    clonedElement.find('select, input').each(function () {
        if ($(this).hasClass("error")) {
            $(this).removeClass("error")
        }
    })
    var val1 = $elementData.find(".siharaikazeikubun").val();
    // console.log(val1);
    clonedElement.find(".siharaikazeikubun").val(val1).change();
    clonedElement.attr('id', 'LineBranch' + num);
    clonedElement.find("input[name='kobetunouki[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: new Date()
    })
    
    clonedElement.find("input[name='genchoubi[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: new Date()
    })
    
    $element.after( clonedElement);
    var $nextElement = $($element).next();
    $nextElement.find('.lineValue').text(num);
    $nextElement.find('.line-input').val(num);
    $(".datePicker2").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker2").datepicker('hide');
        }
    });
     //Enter press hide dropdown
     $(".datePicker3").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker3").datepicker('hide');
        }
    });
    
}


$(document).ready(function () {
    var findLineInput = $('.lineValue').text('1');
    //console.log(productRows);
    findLineInput.next('.line-input').val(1)
    $(".serial").eq(0).val(1);
    var domBody = $("body");

    domBody.on("click", ".delBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');
        // var isInLine = $(this).parents('.line-form').length
        // console.log(isInLine);
        var str = $element.attr('id');
        var rowId = str.replace("LineBranch", "");
        rowId = parseInt(rowId);
        var line = parseInt($element.find('.lineValue').text());
        // console.log(rowId);
        // console.log(line);
        // console.log(productRows);
        var afterRemove = [];
        var removedId = [];
        var modifiedLineBranch = [];
        console.log(document.getElementById("request").value);
        if (document.getElementById("request").value == "2 訂正" || document.getElementById("request").value == "3 削除") {
            deleteWhenEdit($element, rowId, line, afterRemove, removedId, modifiedLineBranch)
        } else {

            deleteWhenReg($element, rowId, line, afterRemove, removedId, modifiedLineBranch)
        }
        calculatePriceInLine()

    });
    // $(document).on("change", ".siharaikazeikubun",calculatePriceInLine)
    // $(document).on("keyup", ".siharaizeihasuukubun",calculatePriceInLine)
    $(document).on('change', 'select', changeConfirmStatus)
    $(document).on('input', 'input', changeConfirmStatus)
    $(document).on(".delBtn, .lineBtn", function () {
        console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()

    })

    ///call this function for registration
    function deleteWhenReg($element, rowId, line, afterRemove, removedId, modifiedLineBranch) {
        for (var i = 1, j = 1; i < productRows.length; i++) {
            if (rowId != i) {
                afterRemove[j] = productRows[i];
                j++;
            }
        }       
        console.log(productRows);
        var cln = 0;
        if (line == 1 && productRows.length <= 2) {
            cln++;
        } else {
            $('#LineBranch' + `${rowId}`).remove();
        }
        if (afterRemove.length){
            productRows = afterRemove;
        }
        console.log(productRows);
        maintainSerialInput();
        if (cln > 0) {
            var domElements = ['delBtn', 'lineBtn', 'branchBtn', 'lineValue', 'branchValue', 'repeatBtn', 'productCd', 'productName', 'productSubCd', 'productSubName', 'shippingInstruction', 'issueNote', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'statementRemarks', 'serial', 'deliveryDestination', 'deliveryDestination_db', 'supplier', 'supplier_db', 'syohin_data100', 'dspbango', 'shoyin_kongouritsu', 'shoyin_mdjouhou', 'shoyin_color', 'shoyin_tokuchou', 'shoyin_data22', 'shoyin_data51', 'maintenance', 'manufacturePartNumber', 'manufactureProductName', 'syohin_product_count', 'syohin_product_status', 'setcode']
            var deleted_inputs = ['unitSellingPrice', 'se', 'institute', 'ship', 'purchase', 'productSubName', 'productSubCd', 'supplier', 'supplier_db', 'shippingInstruction', 'issueNote', 'statementRemarks', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'manufacturePartNumber', 'manufactureProductName', 'syohin_data100', 'syohin_product_status', 'syohin_product_count', 'dspbango', 'shoyin_kongouritsu', 'shoyin_mdjouhou', 'shoyin_color', 'shoyin_tokuchou', 'shoyin_data22', 'shoyin_data51', 'productCd', 'productName', 'deliveryDestination', 'deliveryDestination_db', 'orderDate', 'individualDeliveryDate', 'quantity', 'datePickerHidden', 'unit'];
            var select_inputs = ['sales', 'se2', 'maintenance']
            var targetElm = $(".line-form")
            domElements.forEach(function (item) {
                targetElm.find('.' + item).prop("id", item)

            })
            deleted_inputs.forEach(item => {
                targetElm.find("." + item).val("");
            })

            select_inputs.forEach(function (item) {
                targetElm.find("." + item).prop('selectedIndex', 0);
            });
            targetElm.find("input[name='orderDate[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
                language: 'ja-JP',
                format: 'yyyy/mm/dd',
                autoHide: true,
                zIndex: 1,
                offset: 4,
                setDate: new Date()
            })
            targetElm.find("input[name='individualDeliveryDate[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
                language: 'ja-JP',
                format: 'yyyy/mm/dd',
                autoHide: true,
                zIndex: 1,
                offset: 4,
                setDate: new Date()
            })

            // targetElm.find("input[type=text], textarea, select ").val("");
            targetElm.find('.price').text('')
            targetElm.find('.grossProfit').text('')
            targetElm.find('input[name="quantity[]"]').removeClass("error")
            targetElm.find('input[name="unitSellingPrice[]"]').removeClass("error")
            targetElm.attr("data-setcode", "");
            targetElm.find(".delBtn").prop("disabled", false);
            targetElm.find(".lineBtn").prop("disabled", false);
        }
        calculatePriceInLine()
    }

    function deleteWhenEdit($element, rowId, line, branch, afterRemove, removedId, modifiedLineBranch) {
        var juchusyukko_check = $element.find("[name='juchusyukko_check']").val()
        if (juchusyukko_check == '1') {
            var orderId = $('#order_number').val()
            $('#confrim_before_delete_juchu').html(orderId + '-' + addLeadingZero(line) + '-' + addLeadingZero(branch) + "は発注出荷等処理済です。")
            $('#confirm_line_delation_Modal').modal('show');
            event.preventDefault();
            $("body").on("click", "#juchusyukko_check_delete", function (e) {
                $element.find("[name='juchusyukko_check']").val(0)
                $('#confirm_line_delation_Modal').modal('hide');
                deleteWhenEdit($element, rowId, line, branch, afterRemove, removedId, modifiedLineBranch)

            })
        } else {
            if (branch == 0) {


                for (var i = 1, j = 1; i < productRows.length; i++) {
                    if (line != productRows[i][0]) {
                        afterRemove[j] = productRows[i];
                        if (line < productRows[i][0]) {
                            modifiedLineBranch[j] = {
                                0: productRows[i][0] - 1,
                                1: productRows[i][1]
                            };
                        }
                        j++;
                    } else {
                        removedId[i] = productRows[i];
                    }
                }

            } else if ($element.data("setcode") !== "" && $element.data('setcode').split("-")[1] == '0') {
                var parentSetcode = $element.data('setcode').split("-");
                var decrement = 0;
                $('.line-form[data-setcode]').each(function () {
                    if ($(this).data('setcode').split("-")[0] == parentSetcode[0]) {
                        decrement++;
                    }
                });
                for (var i = 1, j = 1; i < productRows.length; i++) {
                    var childSetcode = $('#LineBranch' + i).data('setcode').split("-");

                    if (parentSetcode[0] != childSetcode[0]) {

                        afterRemove[j] = productRows[i];
                        if (line == productRows[i][0] && branch < productRows[i][1]) {
                            modifiedLineBranch[j] = {
                                0: line,
                                1: productRows[i][1] - parseInt(decrement)
                            };
                        }
                        j++;
                    } else {
                        removedId[i] = productRows[i];
                    }
                }

            } else {

                for (var i = 1, j = 1; i < productRows.length; i++) {
                    if (rowId != i) {
                        afterRemove[j] = productRows[i];
                        if (line == productRows[i][0] && branch < productRows[i][1]) {
                            modifiedLineBranch[j] = {
                                0: line,
                                1: productRows[i][1] - 1
                            };
                        }
                        j++;
                    } else {
                        removedId[i] = productRows[i];
                    }
                }
            }
        }
        var productRowsHidden = afterRemove;
        var cln = 0;

        for (let [key, value] of Object.entries(removedId)) {

            if (line == 1 && branch == 0 && productRowsHidden.length == 0) {

                cln++;
            }
            $('#LineBranch' + `${key}`).find(".delete-area").addClass("invoke-delete")
            /*$('#LineBranch' + `${key}`).find(".line-form").addClass("invoke-delete")*/
            $('#LineBranch' + `${key}`).find('.deletedProduct').val(2)
            $('#LineBranch' + `${key}`).data("deletedPro", '1');


        }


        //maintainSerialInput(modifiedLineBranch);
        if (cln > 0) {


            $('#LineBranch1').find(".delBtn").prop("disabled", true);
            $('#LineBranch1').find(".lineBtn").prop("disabled", false);
            $('#LineBranch1').find(".branchBtn").prop("disabled", true);
            $('#LineBranch1').find(".repeatBtn").prop("disabled", true);
        }
        var disableRegButton = 0;
        $('body').find('.line-form').each(function (index) {

            if ($(this).find('.deletedProduct').val() != 2) {
                disableRegButton++

            }
        })
        if (disableRegButton < 1) {
            $("#orderEntrySubmitBtn").prop("disabled", true)
        }

        calculatePriceInLine()
    }

    domBody.on("click", ".lineBtn", function (e) {
        e.preventDefault();
        // alert("hola");
        var $element = $(this).parents().closest('.line-form');
        var valueSet = $element.find('.productSubOrCdTarget').val();
        if (valueSet) {
            elementCopy($(this));
        }
        // elementCopy($(this));
    })

    domBody.on("keyup", ".quantity,.price,.rate", calculatePriceInLine)

    $("#orderEntrySubmitBtn").on("click", function (e) {
        
        e.preventDefault();
        // $('#confirm_status').val(1);
        // var data = $("#insertData").serialize();
        
        // var payment_method = $("#reg_kessaihouhou").val();
        // var acceptance_condition = $("#reg_chumonsyajouhou").val();
        // var sales_standard = $("#reg_soufusakijouhou").val();
        // var immediate_version = $("#reg_housoukubun").val();
        var  order_user_bango = $("#LineBranch1").find('.juchubangou').val();
        var intOrder01 = calculateIntOrder01();
        $("input[name='order_user_bango'] ").val(order_user_bango)
        $("input[name='intOrder01'] ").val(intOrder01)
        // data += '&payment_method=' + encodeURIComponent(payment_method) + '&acceptance_condition=' + encodeURIComponent(acceptance_condition) + '&sales_standard=' + encodeURIComponent(sales_standard) + 
        // '&immediate_version=' + encodeURIComponent(immediate_version) + '&order_user_bango=' + encodeURIComponent(order_user_bango) + '&intOrder01=' + encodeURIComponent(intOrder01);
        var bango = $("input[id='userId']").val();
        $("input[name=type]").val("create")
        var data = new FormData(document.getElementById('insertData'));
        // console.log(data);
        checkIsOrderNumberSame();
        var supportNumber = $("#support_number_search").val();
        var isOrderNumber = true;
        var isSupportNumber = true;
        var isSupportNumber3rdCheck = true;
        if(supportNumber){
            var supportNumberCheck = supportNumberSearchValidation();
            console.log(supportNumberCheck);
            if(supportNumberCheck["firstCheck"] == false || supportNumberCheck["secondCheck"] == false){
                isSupportNumber = false;
            }
            else if(supportNumberCheck["thirdCheck"] == false){
                isSupportNumber3rdCheck = false;
            }
        }
        else{
            var orderNumberCheck = checkOrderNumberHanteiFromJuchusyukko();
            if(!Object.values(orderNumberCheck).every(v => v)){
                isOrderNumber = false;
            }
        }       
        // var isOrderNumberSame = checkIsOrderNumberSame();
        // checkIsOrderNumberSame();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "hatchu-nyuryoku/register/" + bango,
            data: data,
            processData: false,
            contentType: false,
            success: function (result) {
                // console.log(result)
                if ($.trim(result.status) == 'confirm' && isOrderNumber && isSupportNumber) {
                    
                    if( isSupportNumber3rdCheck == false){
                        confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 予定金額オーバーです、処理を続行します。</p></div>';
                    }else{
                        // confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。</p></div>'
                        confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p></div>'

                    }
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
                    
                    if (inputError || inputErrorMsg || !isOrderNumber || !isSupportNumber ) {
                        // $('#orderEntrySubmitBtn').prop("disabled", false);
                        if (inputError) {
                            for (const err_field in inputError) {
                                var targetEl = '';
                                var selectInputs = ["tantou", "order_category", "creation_category",];
                                if (err_field.indexOf('.') > -1) {
                                    const [inputName, key] = err_field.split('.');
                                    if(inputName == 'comment'){
                                        targetEl = $("textarea[name='" + inputName + "[]']").eq(key);
                                        // console.log(err_field.indexOf('.'));
                                        // console.log(targetEl);
                                    }else {
                                        targetEl = $("input[name='" + inputName + "[]']").eq(key);
                                        // console.log(err_field.indexOf('.'));
                                        // console.log(targetEl);
                                    }
                                } else {
                                    if (err_field && selectInputs.indexOf(err_field) >= 0) {
                                        targetEl = $("select[name=" + err_field + "]")  
                                    }
                                    else{
                                        targetEl = $("input[name=" + err_field + "]")
                                    }
                                }
                                // targetEl.addClass("error")
                                var idList = targetEl.prop('id');
                                // orderTypebango2 valiadtion without red-border
                                if(idList != "order_number"){
                                    targetEl.addClass("error")
                                }
                                // console.log(idList, targetEl);
                                if (idList && idList.search("_db")) {
                                    targetEl.parents('.input-group').find("input[type=text]").addClass('error')
                                }
                                if(idList && idList=="comment"){
                                    $('#deliveryDestination').addClass("error");
                                    $('#comment2').addClass("error");
                                }
                                if(idList && idList=="deliveryDestination_db"){
                                    $('#deliveryDest').addClass("error");
                                }
                            }
                        }
                        if(!isOrderNumber){
                            // console.log(orderNumberCheck);
                            for(var key in orderNumberCheck){
                                // console.log(key);
                                if(orderNumberCheck[key] == false){
                                    var id = "#" + key;
                                    // console.log(id);
                                    $(id).find('.juchubangou').addClass("error");
                                    $(id).find('.juchubangougyou').addClass("error");
                                    $(id).find('.juchubangougyoueda').addClass("error");
                                }
                            }
                        }
                        // if(!isOrderNumberSame){
                        //     $('.juchubangou').addClass("error");
                        // }
                        if(!isSupportNumber){
                            for(var key in supportNumberCheck){
                                // console.log(key);
                                if(supportNumberCheck[key] == false){
                                    if(key == "firstCheck"){
                                        $("#support_number_search").addClass("error");
                                    }
                                    if(key == "secondCheck"){
                                        $('.juchubangou').addClass("error");
                                    }
                                }
                            }
                        }
                    }
                    var html = '';
                    if (inputErrorMsg  || !isOrderNumber || !isSupportNumber) {
                        html = '<div style="margin-top: 8px;">';
                        if (inputErrorMsg) {
                            for (var count = 0; count < inputErrorMsg.length; count++) {
                                var error_message = inputErrorMsg[count];
                                // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                                html += '<p>' + error_message + '</p>';
                            }
                        }
                        // var errorMsgQuantity = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">単価と金額に差異がありますので、ご確認の上、再登録お願いします。</p>';
                        if(!isOrderNumber){
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 存在しない受注です。</p>';
                        }
                        // if(!isOrderNumberSame){
                        //     html += '<p>【受注番号】同じ注文番号を入力してください。</p>';
                        // }
                        if(!isSupportNumber){
                            if(supportNumberCheck["firstCheck"] == false){
                                html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 存在しないサポート番号です。</p>';
                            }
                            if(supportNumberCheck["secondCheck"] == false){
                                html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> サポート番号とリンクする受注ではありません。</p>';
                            }                               
                        }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }
                }            
            }
        })
    })
})

function checkOrderNumberHanteiFromJuchusyukko(order='', branch='', line=''){
    var data = [];
    var result = '';
    $('body').find('.line-form').each(function (index) {
        var id = $(this).attr("id");
        var orderNumber = $(this).find('.juchubangou').val();
        var branch = $(this).find('.juchubangougyou').val() ?? '';
        var line = $(this).find('.juchubangougyoueda').val() ?? '';
        
        if(id == "LineBranch1"){
            if(orderNumber){
                data.push({"order": orderNumber, "branch": branch, "line": line, "id": id})
            }
        }else{
            if($('#'+id).find('.productCd').val() && orderNumber){
                data.push({"order": orderNumber, "branch": branch, "line": line, "id": id})
            }
        }
    })
    if(!data.length==0){
        console.log(data);
        var bango = $("input[id='userId']").val();
        // var val = null;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            url: 'hatchu-nyuryoku/juchusyukko-order-hantei-confirm/' + bango,
            type: 'POST',
            async: false,
            data: {
                data
            },
            success: function (response) {
                // console.log( response ) 
                result = response; 
                // console.log(val);              
            }   
        })
        // console.log(val);
    }
    return result;
}

function supportNumberSearchValidation(){
    // alert("okay");
    var supportNumber = $("#support_number_search").val();
    var salesAmount = $("#money10").val();
    var data214 = $("#LineBranch1").find('.juchubangou').val();
    var result = '';
    if(supportNumber){
        var bango = $("input[id='userId']").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            url: 'hatchu-nyuryoku/support-order-number-validation/' + bango,
            type: 'POST',
            async: false,
            data: {
                supportNumber,
                data214,
                salesAmount
            },
            success: function (response) {
                console.log( response ) 
                result = response;               
            }   
        })
    }
    return result;
}

function checkIsOrderNumberSame(){
    var data = [];
    $('body').find('.line-form').each(function (index) {
        var id = $(this).attr("id");
        var orderNumber = $(this).find('.juchubangou').val();
        if(id == "LineBranch1"){
            data.push(orderNumber)
        }else{
            if($('#'+id).find('.productCd').val() && orderNumber){
                data.push(orderNumber)
            }
        }
    })
    let s = new Set(data);
    if(s.size !=1){
        $('.juchubangou').val("");
        $('.juchubangougyou').val("");
        $('.juchubangougyoueda').val("");
    }
    // return (s.size == 1);
}

function calculateIntOrder01(){
    var result = 0;
    $('body').find('.line-form').each(function (index) {
        var id = $(this).attr("id");
        var price = $(this).find('.price').val();
        result = result + removeComma(price);
    })
    return result;
}

function errorDataSubmit(response) {
    $('#orderEntrySubmitBtn').prop("disabled", false);
}

function successDataSubmit(result) {
    var checkErrorForQuantity = $(".quantity").hasClass("error") && $(".unitSellingPrice").hasClass("error")
    if ($.trim(result.status) == 'confirm' && !checkErrorForQuantity) {
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
        calculatePriceInLine();
        var confirmMessage = checkConfirmMessage();
        var confirmHtml = "<div>";
        $(document).find('.checkChanges').each(function () {
            var errormsg = $(this).val()

            confirmHtml += '<p  style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + errormsg + '</p>'
        })
        confirmHtml += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + confirmMessage + '</p>';
        confirmHtml += "</div>"
        $("#error_data").empty();
        $("#confirmation_message").html(confirmHtml)
        $("#confirm_status").val(1);
        $('#orderEntrySubmitBtn').prop("disabled", false);
    } else if ($.trim(result.status) == 'ok' && !checkErrorForQuantity) {
        result.session_order_bango ? localStorage.setItem('session_order_bango', result.session_order_bango) : ""
        result.session_company_code ? localStorage.setItem('session_company_code', result.session_company_code) : ""
        location.reload();
    } else {
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
        calculatePriceInLine();
        var inputError = result.err_field;
        var inputErrorMsg = result.err_msg;

        if (inputError || inputErrorMsg || checkErrorForQuantity) {
            $('#orderEntrySubmitBtn').prop("disabled", false);
            if (inputError) {
                for (const err_field in inputError) {
                    var targetEl = '';
                    var selectInputs = ["pj", "sales", "se2", "maintenance"];
                    if (err_field.indexOf('.') > -1) {
                        const [inputName, key] = err_field.split('.');
                        if (inputName && selectInputs.indexOf(inputName) >= 0) {
                            targetEl = $("select[name='" + inputName + "[]']").eq(key)

                        } else {
                            targetEl = $("input[name='" + inputName + "[]']").eq(key)
                        }

                    } else {
                        if (err_field && selectInputs.indexOf(err_field) >= 0) {
                            targetEl = $("select[name=" + err_field + "]")

                        } else {
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

            var html = '';
            if (inputErrorMsg || checkErrorForQuantity) {
                html = '<div>';
                if (inputErrorMsg) {
                    for (var count = 0; count < inputErrorMsg.length; count++) {
                        var error_message = inputErrorMsg[count];
                        error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + error_message + '</p>';
                    }
                }
                var errorMsgQuantity = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">単価と金額に差異がありますので、ご確認の上、再登録お願いします。</p>';
                if (checkErrorForQuantity) {
                    html += errorMsgQuantity;
                }
                html += '</div>';
                $('#error_data').html(html);
                $("#error_data").show();
            }

        }

    }
}

function checkConfirmMessage() {
    var confirmMessage = "登録はまだ完了していません。内容をご確認後、もう一度「登  録」をお願いします。";
    var lineBranchBox = []
    $('.line-form').each(function () {
        let se_quan = $(this).find('.se').val().replaceAll(",", "");
        let institute_quan = $(this).find('.institute').val().replaceAll(",", "");
        let ship_quan = $(this).find('.ship').val().replaceAll(",", "");
        let delivery_me = $(this).find('.deliveryMethod').val();
        let lin = $(this).find('.line-input').val();
        let bran = $(this).find('.branch-input').val();
        console.log({ se_quan, institute_quan, ship_quan, delivery_me: !(delivery_me), lin, bran })
        if ((se_quan > 0 || institute_quan > 0 || ship_quan > 0) && (!delivery_me || delivery_me == 'G300')) {
            var lineBranchConcat = lin + "-" + bran;
            lineBranchBox.push(lineBranchConcat)
        }
    })
    if (lineBranchBox.length > 0) {
        var lines_ = lineBranchBox.join()
        confirmMessage = "【" + lines_ + "】の納品方法が（空欄）ですが、よろしいですか？ "
    }
    return confirmMessage;
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

function removeItemFromLocalStorage(lineId) {
    var lineFromIdRand = $("#lineFromIdRand").val();
    if (localStorage.getItem(lineFromIdRand + "lineFromId") !== null) {
        if (localStorage.getItem(lineFromIdRand + 'lineFromId').indexOf('&') >= 0) {
            var test = localStorage.getItem(lineFromIdRand + 'lineFromId').split('&');
            var i;
            var res = "";
            for (i = 0; i < test.length; i++) {
                if (lineId != test[i]) {
                    if (i == (test.length - 1)) {
                        res = res + test[i];
                    } else {
                        res = res + test[i] + '&';
                    }
                }
            }
            localStorage.setItem(lineFromIdRand + 'lineFromId', res)
        } else {
            if (localStorage.getItem(lineFromIdRand + 'lineFromId') == lineId) {
                var newLineFromId3 = localStorage.getItem(lineFromIdRand + 'lineFromId').replace(lineId, "");
                localStorage.setItem(lineFromIdRand + 'lineFromId', newLineFromId3);
            }
        }
    }
}


function setValueForDataChar13() {
    $(".line-form").each(function () {
        if ($(this).find(".branch-input").val() == 0) {
            let hantei = $(this).find('.line-input').val()
            let isSingleParent = Number($(".line-input[value=" + hantei + "]").length) === 1;
            if (isSingleParent) {
                $(this).find('.dataChar13Status').val(1)
            } else {
                $(this).find('.dataChar13Status').val(2)
            }
        } else {
            $(this).find('.dataChar13Status').val('')
        }

    })
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