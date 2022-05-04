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
        var branchValue = $(this).find('.branchValue').text()

        for (var i = 1; i < productRows.length; i++) {

            if (lineValue == productRows[i][0] && branchValue == productRows[i][1]) {
                $(this).attr("id", "LineBranch" + i);
                //$(this).find('.serial').val(i)

            }
        }

    });
    if (modifiedLineBranch) {
        for (var i = 1; i < productRows.length; i++) {
            if (modifiedLineBranch[i]) {
                productRows[i] = modifiedLineBranch[i];

                $("#LineBranch" + i).find('.lineValue').text(modifiedLineBranch[i][0])
                $("#LineBranch" + i).find('.branchValue').text(modifiedLineBranch[i][1])
                $("#LineBranch" + i).find('.line-input').val(modifiedLineBranch[i][0])
                $("#LineBranch" + i).find('.branch-input').val(modifiedLineBranch[i][1])
                // $("#LineBranch" + i).find('.serial').val(i)
            }

        }
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
            var branch = $(this).find(".branchValue").text();
            var line = $(this).find(".lineValue").text();

            if (branch != '0') {
                //if (true) {
                if ($(this).data('setcode')) {
                    reShuffleProductCalculation($(this))
                    var code = $(this).data('setcode').split("-");
                    if (code[1] != "0") {
                        var amount = $(this).find($('input[name="price[]"]')).val() ? $(this).find($('input[name="price[]"]')).val() : 0;
                        var grossProfit = $(this).find($('input[name="grossProfit[]"]')).val() ? $(this).find($('input[name="grossProfit[]"]')).val() : 0;
                        masterPrice[parseInt(line)] += removeComma(amount);
                        masterGross[parseInt(line)] += removeComma(grossProfit);
                    }
                } else {
                    reShuffleProductCalculation($(this))
                    var amount = $(this).find($('input[name="price[]"]')).val() ? $(this).find($('input[name="price[]"]')).val() : 0;
                    var grossProfit = $(this).find($('input[name="grossProfit[]"]')).val() ? $(this).find($('input[name="grossProfit[]"]')).val() : 0;
                    masterPrice[parseInt(line)] += removeComma(amount);
                    masterGross[parseInt(line)] += removeComma(grossProfit);


                }
                $('.line-form').not(':has(.invoke-delete)').each(function () {
                    if ($(this).find('.productSubOrCdTarget').val() != '') {
                        reShuffleProductCalculation($(this))
                        var bval = removeComma($(this).find(".branchValue").text());
                        var lVal = removeComma($(this).find(".lineValue").text());
                        var k = 0;

                        $('.line-form').not(':has(.invoke-delete)').each(function () {
                            if ($(this).find('.productSubOrCdTarget').val() != '') {
                                var bbval = removeComma($(this).find(".branchValue").text());
                                var llVal = removeComma($(this).find(".lineValue").text());
                                if (llVal == lVal && bbval != "0") {
                                    k++;
                                }
                            }
                        })


                        if (bval == 0 && k > 0) {
                            $(this).find('.price').text(numberFormat(masterPrice[lVal]))
                            $(this).find('.grossProfit').text(numberFormat(masterGross[lVal]))
                            $(this).find('input[name="price[]"]').val(masterPrice[lVal])
                            $(this).find('input[name="grossProfit[]"]').val(masterGross[lVal])

                            $(this).find(".se").prop("readonly", true)
                            $(this).find(".institute").prop("readonly", true)
                            $(this).find(".ship").prop("readonly", true)
                            $(this).find(".purchase").prop("readonly", true)

                            $(this).find(".se").val("0")
                            $(this).find(".institute").val("0")
                            $(this).find(".ship").val("0")
                            $(this).find(".purchase").val("0")
                            /////red line if calculation not matched/////
                            var masterTotal = $(this).find('input[name="price[]"]').val();

                            var unit = removeComma($(this).find($('input[name="quantity[]"]')).val())
                            var price = removeComma($(this).find($('input[name="unitSellingPrice[]"]')).val())

                            if (unit * price != masterTotal && !Number.isNaN(unit) && !Number.isNaN(price)) {

                                $(this).find('input[name="quantity[]"]').addClass("error")
                                $(this).find('input[name="unitSellingPrice[]"]').addClass("error")
                            } else {
                                $(this).find('input[name="quantity[]"]').removeClass("error")
                                $(this).find('input[name="unitSellingPrice[]"]').removeClass("error")
                            }
                            /////
                        }
                    }
                });
            } else {
                var bval = removeComma($(this).find(".branchValue").text());
                var lVal = removeComma($(this).find(".lineValue").text());
                var k = 0;
                $('.line-form').not(':has(.invoke-delete)').each(function () {
                    if ($(this).find('.productSubOrCdTarget').val() != '') {
                        var bbval = removeComma($(this).find(".branchValue").text());
                        var llVal = removeComma($(this).find(".lineValue").text());
                        if (llVal == lVal && bbval != "0") {
                            k++;
                        }
                    }
                })
                if (bval == 0 && k == 0) {
                    ////ekhane this row 4 ta field enable korben
                    reShuffleProductCalculation($(this))
                    if ($('#isEditReadonly').val() != '1') {
                        $(this).find(".se").prop("readonly", false)
                        $(this).find(".institute").prop("readonly", false)
                        $(this).find(".ship").prop("readonly", false)
                        $(this).find(".purchase").prop("readonly", false)
                    }

                    var arrId = $(this).attr('id');
                    var arrInd = removeComma($(this).find(".lineValue").text());
                    var totalPrice = $(this).find($('input[name="price[]"]')).val()
                    var grossProfit = $(this).find($('input[name="grossProfit[]"]')).val()

                    masterPrice[arrInd] = removeComma(totalPrice);
                    masterGross[arrInd] = removeComma(grossProfit);
                    $(this).find('input[name="quantity[]"]').removeClass("error")
                    $(this).find('input[name="unitSellingPrice[]"]').removeClass("error")

                }
            }

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
        total_gross_profit: total_gross_profit
    }

}

function setProductCal() {
    n = 10;
    var parentUnit = Array(n).fill(0);
    var parentNedan = Array(n).fill(0);
    var parentPrice = Array(n).fill(0);
    var parentGross = Array(n).fill(0);


    //////parent child calculation/////
    $('.line-form[data-setcode]').not(':has(.invoke-delete)').each(function () {
        if ($(this).data("setcode") !== "") {

            var code = $(this).data('setcode').split("-");

            $('.line-form[data-setcode]').not(':has(.invoke-delete)').each(function () {
                var parentCode = $(this).data('setcode').split("-");
                if (code[0] == parentCode[0] && parentCode[1] == '0') {
                    parentUnit[parentCode[0]] = $(this).find($('input[name="quantity[]"]')).val() ? removeComma($(this).find($('input[name="quantity[]"]')).val()) : 0;
                    parentNedan[parentCode[0]] = $(this).find($('input[name="unitSellingPrice[]"]')).val() ? removeComma($(this).find($('input[name="unitSellingPrice[]"]')).val()) : 0;


                }
            });

            if (code[1] != '0') {
                $('.line-form[data-setcode]').not(':has(.invoke-delete)').each(function (x) {
                    if ($(this).data("setcode") !== "") {
                        var subCode = $(this).data('setcode').split("-");

                        if (subCode[0] == code[0] && subCode[1] != '0' && code[1] != subCode[0]) {

                            var parcentage = $(this).find($('.percentage')).val() ? $(this).find($('.percentage')).val() : 0;

                            var childUnit = parentUnit[subCode[0]];
                            if (subCode[1] == 1) {

                                var childNedan = Math.round(parentNedan[subCode[0]] * (parcentage / 100));
                                console.log((parentNedan[subCode[0]] * (parcentage / 100)) % 1)
                                if ((parentNedan[subCode[0]] * (parcentage / 100)) % 1 == .5) {
                                    var childNedan = childNedan - 1
                                    console.log(childNedan,'A')
                                }
                            } else {
                                var childNedan = Math.round(parentNedan[subCode[0]] * (parcentage / 100));
                                console.log(childNedan,'B')
                            }


                            var totalPrice = childUnit * childNedan;

                            var se = $(this).find(".se").val();
                            se = se ? se : 0;
                            var institute = $(this).find(".institute").val();
                            institute = institute ? institute : 0;
                            var ship = $(this).find(".ship").val();
                            ship = ship ? ship : 0;
                            var purchase = $(this).find(".purchase").val();
                            purchase = purchase ? purchase : 0;
                            var dataint16 = $(this).find(".dataint16").val();
                            dataint16 = dataint16 ? dataint16 : 0;
                            dataint16 = removeComma(dataint16);

                            var summation = removeComma(se) + removeComma(institute) + removeComma(ship) + removeComma(purchase);
                            
                            quantity = childUnit;
                            unitPrice = childNedan;
                            var grossProfit = totalPrice - summation * quantity - dataint16;


                            $(this).find($('input[name="quantity[]"]')).val(numberFormat(childUnit));
                            $(this).find($('input[name="unitSellingPrice[]"]')).val(numberFormat(unitPrice));
                            console.log(unitPrice)
                            $(this).find($('input[name="price[]"]')).val(totalPrice);
                            $(this).find($('input[name="grossProfit[]"]')).val(grossProfit);
                            $(this).find('.price').text(numberFormat(totalPrice))
                            $(this).find('.grossProfit').text(numberFormat(grossProfit))

                            parentPrice[subCode[0]] += removeComma(totalPrice);
                            parentGross[subCode[0]] += removeComma(grossProfit);


                        }
                    }
                });

            }

            $('.line-form[data-setcode]').not(':has(.invoke-delete)').each(function () {
                var parentCode = $(this).data('setcode').split("-");
                if (code[0] == parentCode[0] && parentCode[1] == '0') {
                    //      console.log(parentGross[parentCode[0]])
                    $(this).find($('input[name="price[]"]')).val(parentPrice[parentCode[0]]);
                    $(this).find($('input[name="grossProfit[]"]')).val(parentGross[parentCode[0]]);
                    $(this).find('.price').text(numberFormat(parentPrice[parentCode[0]]))
                    $(this).find('.grossProfit').text(numberFormat(parentGross[parentCode[0]]))
                    $(this).find(".se").val("0")
                    $(this).find(".institute").val("0")
                    $(this).find(".ship").val("0")
                    $(this).find(".purchase").val("0")


                }
            });
        }
    });


}

function reShuffleProductCalculation(own) {
    var self = own
    var unitPrice = self.find('.unitSellingPrice').val();
    unitPrice = unitPrice ? unitPrice : 0;

    var quantity = self.find('.quantity').val();
    quantity = quantity ? quantity : 0;

    var se = self.find(".se").val();
    se = se ? se : 0;
    var institute = self.find(".institute").val();
    institute = institute ? institute : 0;
    var ship = self.find(".ship").val();
    ship = ship ? ship : 0;
    var purchase = self.find(".purchase").val();
    purchase = purchase ? purchase : 0;
    var dataint16 = self.find(".dataint16").val();
    dataint16 = dataint16 ? dataint16 : 0;
    dataint16 = removeComma(dataint16);
    var summation = removeComma(se) + removeComma(institute) + removeComma(ship) + removeComma(purchase);
    var totalPrice = removeComma(unitPrice) * removeComma(quantity);
    quantity = removeComma(quantity);
    unitPrice = removeComma(unitPrice);
    var grossProfit = totalPrice - summation * quantity - dataint16;

    self.find('.price').text(numberFormat(totalPrice));
    self.find($('input[name="price[]"]')).val(totalPrice)
    self.find('.grossProfit').text(numberFormat(grossProfit))
    self.find($('input[name="grossProfit[]"]')).val(grossProfit)
    
    calculateGrossTotalPattern();

}
function calculateGrossTotalPattern() {
    var priceTotal = 0;
    var purchaseTotal = 0;
    $('body').find('.line-form').each(function (index) {
        var branchValue = $(this).find('.branchValue').text()
        // console.log('branchValue: '+branchValue)
        $('#price_total_p1').val(0)
        $('#purchase_total_p1').val(0)
        
        if (branchValue == 0) {
            var price = $(this).find($('input[name="price[]"]')).val()
            //console.log('price: '+price)
            priceTotal += removeComma(price);
            //console.log('priceTotal: '+priceTotal)
        }

        
        var purchase = $(this).find($('input[name="purchase[]"]')).val()
        var quantity = $(this).find($('input[name="quantity[]"]')).val()
        purchaseTotal += removeComma(purchase) * removeComma(quantity);
        //console.log('purchaseTotal: '+purchaseTotal)

        $('#price_total_p1').val(priceTotal)
        $('#purchase_total_p1').val(purchaseTotal)

    });
}

function calculatePriceInLine(source) {
    var sourceType = typeof (source);
    var parentLineForm = sourceType == 'string' ? $("#" + source) : $(this).parents('.line-form');
    var unitPrice = parentLineForm.find('.unitSellingPrice').val();
    unitPrice = unitPrice ? unitPrice : 0;
    var quantity = parentLineForm.find('.quantity').val();
    quantity = quantity ? quantity : 0;
    var se = parentLineForm.find(".se").val();
    se = se ? se : 0;
    var institute = parentLineForm.find(".institute").val();
    institute = institute ? institute : 0;
    var ship = parentLineForm.find(".ship").val();
    ship = ship ? ship : 0;
    var purchase = parentLineForm.find(".purchase").val();
    purchase = purchase ? purchase : 0;
    var dataint16 = parentLineForm.find(".dataint16").val();
    dataint16 = dataint16 ? dataint16 : 0;
    dataint16 = removeComma(dataint16);
    var summation = removeComma(se) + removeComma(institute) + removeComma(ship) + removeComma(purchase);
    var totalPrice = removeComma(unitPrice) * removeComma(quantity);
    quantity = removeComma(quantity);
    unitPrice = removeComma(unitPrice);
    var grossProfit = totalPrice - summation * quantity - dataint16;
    //console.log({summation, totalPrice, grossProfit, quantity, unitPrice, purchase, ship, institute})
    parentLineForm.find('.price').text(numberFormat(totalPrice));
    parentLineForm.find($('input[name="price[]"]')).val(totalPrice)
    parentLineForm.find('.grossProfit').text(numberFormat(grossProfit))
    parentLineForm.find($('input[name="grossProfit[]"]')).val(grossProfit)
    setProductCal();
    const { total_sales_amount, total_gross_profit } = calculationGrossProfitAndPrice();
    setProductCal();
    $('#gross_profit_margin').text('¥ ' + numberFormat(total_gross_profit));
    $("input[name='gross_profit_margin']").val(total_gross_profit)
    $('#sales_amount_total').text('¥ ' + numberFormat(total_sales_amount));
    $("input[name='sales_amount_total']").val(total_sales_amount)

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

function elementCopy(ref, type, setCode, key, largestSet = null) {

    var $element = (type == 'P') ? $('#' + ref) : ref.parents().closest('.line-form');

    var elId = $element.attr('id');
    var rowId = elId && elId.replace("LineBranch", "");
    rowId = parseInt(rowId);
    var line = parseInt($element.find('.lineValue').text());
    var branch = parseInt($element.find('.branchValue').text());

    if (type == "L") {
        var newRow = checkPreviousRowLine(rowId, line, branch);
    }
    if (type == "B" || type == "P") {
        var newRow = checkPreviousRowBranch(rowId, line, branch);
    }
    if (type == "R") {
        var newRow = checkPreviousRowRepeat(rowId, line, branch);

    }
    maintainSerialInput();
    var clonedElement = $element.clone(true);
    //var length = parseInt($('.line-form').length)
    var length = Math.floor(Math.random() * 1000)
    var domElements = ['delBtn', 'lineBtn', 'branchBtn', 'lineValue', 'branchValue', 'repeatBtn', 'productCd', 'productName', 'productSubCd', 'productSubName', 'shippingInstruction', 'issueNote', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'statementRemarks', 'flatContract', 'serial', 'deliveryDestination', 'deliveryDestination_db', 'supplier', 'supplier_db', 'syohin_data100', 'dspbango', 'shoyin_kongouritsu', 'shoyin_mdjouhou', 'shoyin_color', 'shoyin_tokuchou', 'shoyin_data22', 'shoyin_data51', 'maintenance', 'manufacturePartNumber', 'manufactureProductName', 'syohin_product_count', 'syohin_product_status', 'setcode']
    domElements.forEach(function (item) {
        var targetElm = clonedElement.find("." + item);
        targetElm.prop("id", item + '-' + length);
    })
    clonedElement.attr('id', 'LineBranch' + newRow[2]);
    clonedElement.find("input[name='orderDate[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: new Date()
    })
    clonedElement.find("input[name='individualDeliveryDate[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate: new Date()
    })
    clonedElement.find('select, input').each(function () {
        if ($(this).hasClass("error")) {
            $(this).removeClass("error")
        }
        if (type == 'L' || type == 'B') {
            var dataRemovableField = ['supplier', 'supplier_db', 'shippingInstruction', 'issueNote', 'statementRemarks', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'productSubName', 'shoyin_color', 'shoyin_tokuchou', 'shoyin_data22', 'shoyin_data51', 'syohin_data100', 'syohin_product_count', 'syohin_product_status'];
            var classNames = ['productCd', 'productName', 'unit', 'quantity', 'unitSellingPrice', 'se', 'institute', 'ship', 'purchase', 'dataint16', 'productSubCd', 'supplier', 'supplier_db', 'manufacturePartNumber', 'manufactureProductName']
            dataRemovableField.forEach((item) => {
                clonedElement.find('.' + item).val('')

            })
            if ($(this).prop("tagName") == "INPUT" && $(this).prop('type') != 'hidden') {
                classNames.forEach((item) => {
                    if ($(this).hasClass(item)) {
                        $(this).val('')
                    }
                })

            } else if ($(this).prop("tagName") == "SELECT" && $(this).prop('type') != 'hidden') {
                var selectNames = ["sales[]", "se2[]"];
                if (!(selectNames.indexOf($(this).prop("name")) > -1)) {
                    $(this).prop('selectedIndex', 0);
                }
            }
        }

    })
    if (type != 'R') {
        clonedElement.find("input[name='price[]']").val(0)
        clonedElement.find("input[name='grossProfit[]']").val(0)
        clonedElement.find('.grossProfit').text('')
        clonedElement.find('.price').text('')
    }

    clonedElement.find('input[name="percentage"]').remove();
    clonedElement.find(".productName").prop("readonly", false)
    if (type == "L" || type == "B" || type == "P" || type == "R") {
        if (type == "L" || type == "B" || type == "R") {
            clonedElement.data("setcode", "");
            clonedElement.find('.setcode').val('')
            clonedElement.find('.checkHasUnderline').css({ "text-decoration": "none" })
        }
        clonedElement.find(".delete-area").removeClass("invoke-delete")
        clonedElement.find(".deletedProduct").val() ? clonedElement.find(".deletedProduct").val('0') : false
        clonedElement.find(".delBtn").prop("disabled", false);
        clonedElement.find(".lineBtn").prop("disabled", false);
        clonedElement.find(".branchBtn").prop("disabled", false);
        clonedElement.find(".repeatBtn").prop("disabled", false);
        clonedElement.find(".productModalOpener").prop("disabled", false);
        if (type == "R") {
            var elPrice = $element.find('.price').text();
            var elGrossProfit = $element.find('.grossProfit').text();

            clonedElement.find('.price').text(elPrice);
            clonedElement.find('.grossProfit').text(elGrossProfit);
        } else {
            clonedElement.find('.price').text('');
            clonedElement.find('.grossProfit').text('');
        }
        if (type == "P") {
            if (setCode.dspbango != null) {
                var percentage = setCode.dspbango.substr(setCode.dspbango.length - 2);
            } else {
                var percentage = 0;
            }

            clonedElement.find('.percentage').val(percentage);
        }
        clonedElement.find('select, input').each(function () {
            if (type == "P") {
                let {
                    kongouritsu,
                    mdjouhou,
                    url,
                    newcolor4,
                    tokuchou,
                    data22,
                    data51,
                    kokyakusyouhinbango,
                    name
                } = setCode
                clonedElement.find('.manufacturePartNumber').val(kongouritsu)
                clonedElement.find('.manufactureProductName').val(mdjouhou)
                clonedElement.find('.maintenance').val(url ? url : 2)
                var clonedIssueNote = clonedElement.find('.issueNote');
                var clonedDeliveryMethod = clonedElement.find('.deliveryMethod');
                var clonedContinutionCategory = clonedElement.find('.continutionCategory');
                var clonedNewVup = clonedElement.find('.newVup');
                var clonedVupCategory = clonedElement.find('.vupCategory')
                var clonedStatementRemarks = clonedElement.find('.statementRemarks');
                var shippingInstruction = clonedElement.find('.shippingInstruction')
                var color = newcolor4 ? newcolor4.substr(2, 2) : null;
                var shoyhinTokuchou = tokuchou ? tokuchou.split(' ')[0] : null;
                data22 = data22 ? data22.split(' ')[0] : null;
                data51 = data51 ? data51.split(' ')[0] : null;
                var cut_dept_remark = clonedElement.find('.issueNote').val().substr(0, 2) ?? ''
                var delivery_method = color ? $("#delivery_method").find('[data-category2="' + color + '"]').text() : $("#delivery_method option").eq(1).val() ? $("#delivery_method option").eq(1).text() : '';
                var continuetion_cat = shoyhinTokuchou ? $("#continution_category").find('[data-req="' + shoyhinTokuchou + '"]').text() : $("#continution_category option").eq(1).val() ? $("#continution_category option").eq(1).text() : '';
                var { cut_delivery_methd, cut_continuetion_cat } = getFormattedData(delivery_method, continuetion_cat)
                shippingInstruction.val(cut_dept_remark + cut_delivery_methd + cut_continuetion_cat)
                if (newcolor4) {
                    clonedDeliveryMethod.val(newcolor4)
                }
                if (tokuchou) {
                    clonedContinutionCategory.val(shoyhinTokuchou)
                }
                if (data22) {
                    clonedNewVup.val(data22)
                }
                if (data51) {
                    clonedVupCategory.val(data51)
                }
                var productCdVal = clonedElement.find('.productCd').prop('id')

                //check local storage to process new req
                removeItemFromLocalStorage(productCdVal);

                clonedElement.find('.productCd').val(kokyakusyouhinbango)
                clonedElement.find('.productName').val(name)
                clonedElement.find('.syohin_product_status').val('p_child')
                clonedElement.find('.productName').prop('readonly', true);
                clonedElement.find('.productModalOpener').prop('disabled', true);
                clonedElement.find('.product_sub_modal_opener').prop('disabled', true);
                clonedElement.data("setcode", largestSet + "-" + key)
                clonedElement.find('.setcode').val(largestSet + "-" + key)

                clonedElement.find(".delBtn").prop("disabled", true);
                clonedElement.find(".lineBtn").prop("disabled", true);
                clonedElement.find(".branchBtn").prop("disabled", true);
                clonedElement.find(".repeatBtn").prop("disabled", true);

                if ($element.data('setcode') && $element.data('setcode').split("-")[1] == '0') {
                    $element.find(".se").prop("readonly", true)
                    $element.find(".institute").prop("readonly", true)
                    $element.find(".ship").prop("readonly", true)
                    $element.find(".purchase").prop("readonly", true)
                    $element.find(".branchBtn").prop("disabled", true);
                    $element.find(".repeatBtn").prop("disabled", true);
                }
                if (clonedElement.data('setcode') && clonedElement.data('setcode').split("-")[1] != '0') {


                    clonedElement.find(".quantity").prop("readonly", true)
                    clonedElement.find(".unitSellingPrice").prop("readonly", true)

                }


            } else if (type == "R" || type == "L" || type == "B") {

                clonedElement.find(".quantity").prop("readonly", false)
                clonedElement.find(".unitSellingPrice").prop("readonly", false)
                clonedElement.find(".branchBtn").prop("disabled", false);
                clonedElement.find(".lineBtn").prop("disabled", false);
                if ($('#isEditReadonly').val() != '1') {
                    clonedElement.find(".se").prop("readonly", false)
                    clonedElement.find(".institute").prop("readonly", false)
                    clonedElement.find(".ship").prop("readonly", false)
                    clonedElement.find(".purchase").prop("readonly", false)
                }

            }
        }
        )
    }
    var imidiateRowId = newRow[2] - 1;
    imidiateRowId = 'LineBranch' + imidiateRowId;

    $element = $("#" + imidiateRowId);
    $element.after(clonedElement)
    var $nextElement = $($element).next();
    //var latestBranchValue = parseInt($element.find('.' + selector + 'Value').text()) + 1;
    $nextElement.find('.lineValue').text(newRow[0])
    $nextElement.find('.line-input').val(newRow[0])
    $nextElement.find('.branchValue').text(newRow[1])
    $nextElement.find('.branch-input').val(newRow[1])
    maintainSerialInputWithdivId();
    calculatePriceInLine();
    if (clonedElement.data('setcode') && clonedElement.data('setcode').split("-")[1] == '2' && parseInt(clonedElement.find('.branchValue').text()) != '2') {

        elementCopy(clonedElement.find('.branchBtn'), 'B');

    }

}

function repeatSetProductCopy(masterRow) {
    var largestSet = null;
    var noOfTurn = 0;
    var baseSetCode = masterRow.data('setcode').split("-");

    $('.line-form[data-setcode]').each(function () {

        var code = $(this).data('setcode').split("-");

        if (parseInt(code[0]) >= largestSet) {
            largestSet = parseInt(code[0]) + 1;

        }
        if (code[0] == baseSetCode[0]) {
            noOfTurn++;

        }
    });

    return [largestSet, noOfTurn];
}

function checkPreviousRowLine(rowId, line, branch) {

    for (var i = 1, j = line + 1; i < productRows.length; i++) {
        if (productRows[i][0] == j) {
            j++;
            i = 1;
            continue;
        }
    }

    for (var n = parseInt(rowId); n < productRows.length; n++) {
        if (productRows[n][0] != line) {
            break;
        } else {
            continue;
        }
    }
    rowId = n;

    var tempArr = [];
    var k = rowId;

    while (k < productRows.length) {
        tempArr[k + 1] = productRows[k];
        k++;
    }

    productRows[rowId] = {
        0: j,
        1: 0
    };
    for (var m = rowId + 1; m < tempArr.length; m++) {
        productRows[m] = tempArr[m];
    }

    return [j, 0, rowId];
}

function checkPreviousRowBranch(rowId, line, branch) {
    rowId = parseInt(rowId);
    var checkSetProduct = 0;
    if ($("#LineBranch" + rowId).data("setcode").split("-")[1] == "0") {
        var parentCode = $("#LineBranch" + rowId).data('setcode').split("-");
        $('.line-form[data-setcode]').each(function () {
            var childCode = $(this).data('setcode').split("-");
            if (parentCode[0] == childCode[0]) {
                checkSetProduct++
            }
        });
    }
    if (checkSetProduct > 0) {
        rowId = rowId + 1;
    } else {
        rowId += 1;
    }


    for (var i = 1, j = branch; i < productRows.length; i++) {
        if (productRows[i][0] == line && productRows[i][1] == j) {
            j++;
            i = 1;
            continue;
        }
    }

    var tempArr = [];
    var k = rowId;

    while (k < productRows.length) {

        tempArr[k + 1] = productRows[k];
        k++;
    }
    productRows[rowId] = {
        0: line,
        1: j
    };
    for (var m = rowId + 1; m < tempArr.length; m++) {
        productRows[m] = tempArr[m];
    }

    return [line, j, rowId];
}

function checkPreviousRowRepeat(rowId, line, branch) {

    if (branch == 0) {
        return checkPreviousRowLine(rowId, line, branch);
    } else {
        return checkPreviousRowBranch(rowId, line, branch);
    }
}

$(document).ready(function () {
    $("#pj").change(function(){
        var bango = $("input[id='userId']").val();
        var pj = $(this).val();
        console.log('I am pj: '+pj);
        $.ajax({
            url: '/order-entry/read_pj_data/' + bango,
            type: 'POST',
            data: {
                'bango': bango,
                'pj': pj
            },
            success: function (response) {
                var total_money10 = response.total_money10;
                var purchase_other_total = response.total_purchase;
                $("#total_money10").val(total_money10);
                $("#purchase_other_total").val(purchase_other_total);

                console.log(response);
            }
        })
    })
    var findLineInput = $('.lineValue').text('1');
    findLineInput.next('.line-input').val(1)
    var findBranchInput = $('.branchValue').text('0');
    findBranchInput.next('.branch-input').val(0)
    $(".serial").eq(0).val(1);
    var domBody = $("body");
    domBody.on('click', '.repeat', function (e) {
        e.preventDefault($(this));
        var $element = $(this).parents().closest('.line-form');
        var valueSet = $element.find('.productSubOrCdTarget ').val();
        if (valueSet) {
            elementCopy($(this), 'R');
        }


    });

    domBody.on("click", ".delBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');

        var str = $element.attr('id');
        var rowId = str.replace("LineBranch", "");
        rowId = parseInt(rowId);
        var line = parseInt($element.find('.lineValue').text());
        var branch = parseInt($element.find('.branchValue').text());
        var afterRemove = [];
        var removedId = [];
        var modifiedLineBranch = [];

        //if (document.getElementById("request").value == "2 受注訂正" || document.getElementById("request").value == "3 受注削除") {
        if (document.getElementById("request").value == "2" || document.getElementById("request").value == "3") {
            deleteWhenEdit($element, rowId, line, branch, afterRemove, removedId, modifiedLineBranch)
        } else {

            deleteWhenReg($element, rowId, line, branch, afterRemove, removedId, modifiedLineBranch)
        }
        calculatePriceInLine()

    });
    $(document).on('change', 'select', changeConfirmStatus)
    $(document).on('input', 'input', changeConfirmStatus)
    $(document).on(".delBtn, .lineBtn,.branchBtn,,repeatBtn", function () {
        console.log('hit btn')
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()

    })

    ///call this function for registration
    function deleteWhenReg($element, rowId, line, branch, afterRemove, removedId, modifiedLineBranch) {

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
            var afterSetProduct = null
            for (var i = 1, j = 1; i < productRows.length; i++) {
                var childSetcode = $('#LineBranch' + i).data('setcode').split("-");


                if (childSetcode[1] == '2') {

                    afterSetProduct = i + 1

                }
                if (parentSetcode[0] != childSetcode[0] && afterSetProduct != i) {

                    afterRemove[j] = productRows[i];
                    if (line == productRows[i][0] && branch < productRows[i][1]) {
                        modifiedLineBranch[j] = {
                            0: line,
                            1: Math.abs(productRows[i][1] - parseInt(decrement))
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
        productRows = afterRemove;

        var cln = 0;
        for (let [key, value] of Object.entries(removedId)) {

            if (line == 1 && branch == 0 && productRows.length == 0) {
                productRows[1] = {
                    0: 1,
                    1: 0
                };
                cln++;
            } else {
                $('#LineBranch' + `${key}`).remove();

            }
        }


        maintainSerialInput(modifiedLineBranch);
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
            targetElm.find(".branchBtn").prop("disabled", false);
            targetElm.find(".repeatBtn").prop("disabled", false);
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
        var $element = $(this).parents().closest('.line-form');
        var valueSet = $element.find('.productSubOrCdTarget ').val();
        if (valueSet) {
            elementCopy($(this), 'L');
        }


    })

    domBody.on("click", ".branchBtn", function (e) {
        e.preventDefault();
        var $element = $(this).parents().closest('.line-form');
        var valueSet = $element.find('.productSubOrCdTarget ').val();
        if (valueSet) {
            elementCopy($(this), 'B');
        }


    })


    domBody.on("keyup", ".unitSellingPrice,.quantity,.se,.institute,.ship,.purchase", calculatePriceInLine)

    $(document).on("change", ".orderDate,.individualDeliveryDate,.deliveryDestination,.sales,.se2", function () {
        var $lineFrom = $(this).parents('.line-form');
        var isParent = $lineFrom.find(".syohin_data100").val();
        var parentVal = isParent ? isParent : '';
        var loopCount = $lineFrom.find('.syohin_product_count') ? parseInt($lineFrom.find('.syohin_product_count').val()) : 0;

        if (parentVal == "D160") {
            var input_name = $(this).prop("name");
            if (!$(this).prop('class').includes('deliveryDestination')) {
                var tagname = $(this).prop("tagName") ? $(this).prop("tagName").toLowerCase() : false;
                if (tagname == 'input') {
                    var input_val = $lineFrom.find('input[name="' + input_name + '"]').val()
                } else if (tagname == 'select') {
                    var input_val = $lineFrom.find('select[name="' + input_name + '"]').val()
                }
                for (var i = 0; i < loopCount; i++) {
                    if (tagname == 'input') {
                        var nextInput = $lineFrom.nextAll().eq(i).find('input[name="' + input_name + '"]');
                    } else if (tagname == 'select') {
                        var nextInput = $lineFrom.nextAll().eq(i).find('select[name="' + input_name + '"]');
                    }
                    if (!nextInput.val()) {
                        if (nextInput.hasClass('datePicker')) {
                            var inputDateValue = input_val.replaceAll("/", "");
                            let slicedYear = parseInt(inputDateValue.substr(0, 4));
                            let slicedMonth = inputDateValue.substr(4, 2) - 1;
                            let slicedDay = parseInt(inputDateValue.substr(6, 2));
                            // var formatted_sliced_date = slicedYear + '/' + slicedMonth + '/'+slicedDay
                            nextInput.siblings('.datePickerHidden').val(input_val);
                            nextInput.datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
                            $(this).focus()
                            $(this).datepicker('hide');
                        } else {
                            nextInput.val(input_val)
                        }
                    }

                }
            } else {
                for (var i = 0; i < loopCount; i++) {
                    var nextInput = $lineFrom.nextAll().eq(i).find('.deliveryDestination');
                    var nextInput1 = $lineFrom.nextAll().eq(i).find('.deliveryDestination_db');
                    var deliveryDestination = localStorage.getItem("deliveryDestination")
                    deliveryDestination = deliveryDestination.split("hidden")
                    var input_val = deliveryDestination[0];
                    var input_val_hidden = deliveryDestination[1];
                    !nextInput.val() ? nextInput.val(input_val) : false;
                    !nextInput1.val() ? nextInput1.val(input_val_hidden) : false;
                }

            }

        }
    })
    $(document).on("change", ".issueNote, .statementRemarks, .deliveryMethod, .continutionCategory, .newVup, .vupCategory", function () {
        var $lineFrom = $(this).parents('.line-form');
        var isParent = $lineFrom.find(".syohin_data100").val();
        var parentVal = isParent ? isParent : '';
        var loopCount = $lineFrom.find('.syohin_product_count') ? parseInt($lineFrom.find('.syohin_product_count').val()) : 0;
        if (parentVal == "D160") {
            var elementArray = ['issueNote', 'statementRemarks', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory']
            elementArray.forEach((item) => {
                var input_val = $lineFrom.find("." + item).val()
                for (var i = 0; i < loopCount; i++) {
                    var $nextInput = $lineFrom.nextAll().eq(i).find("." + item)
                    !$nextInput.val() ? $nextInput.val(input_val) : false;
                    //  $nextInput.val(input_val)
                }
            })
            for (var i = 0; i < loopCount; i++) {
                var $shipInputField = $lineFrom.nextAll().eq(i).find(".shippingInstruction")
                var color = $lineFrom.nextAll().eq(i).find(".deliveryMethod").val();
                var shoyhinTokuchou = $lineFrom.nextAll().eq(i).find(".continutionCategory").val();
                color = color ? color.substr(2, 2) : null;
                var delivery_method = color ? $("#delivery_method").find('[data-category2="' + color + '"]').text() : $("#delivery_method option").eq(1).val() ? $("#delivery_method option").eq(1).text() : '';
                var continuetion_cat = shoyhinTokuchou ? $("#continution_category").find('[data-req="' + shoyhinTokuchou + '"]').text() : $("#continution_category option").eq(1).val() ? $("#continution_category option").eq(1).text() : '';
                var $dept_remark = $lineFrom.nextAll().eq(i).find(".issueNote");
                let { cut_delivery_methd, cut_continuetion_cat } = getFormattedData(delivery_method, continuetion_cat)
                var cut_dept_remark = $dept_remark.val() ? $dept_remark.val().substr(0, 2) : '';
                if (!$shipInputField.val() || cut_dept_remark.length > 0 || cut_delivery_methd.length > 0 || cut_continuetion_cat.length > 0) {
                    $shipInputField.val(cut_dept_remark + cut_delivery_methd + cut_continuetion_cat)
                }
                // $shipInputField.val(cut_dept_remark + cut_delivery_methd + cut_continuetion_cat)
            }

        }
    })
    $("#orderEntrySubmitBtn").on("click", function (e) {
        $(this).prop("disabled", true);
        e.preventDefault();
        if (!$('#order_subject').val()) {
            var product_name = $('.line-form').eq(0).find('.productName').val()
            $('#order_subject').val(product_name)
        }
        setValueForDataChar13()
        var payment_method = $("#reg_kessaihouhou").val();
        var acceptance_condition = $("#reg_chumonsyajouhou").val();
        var sales_standard = $("#reg_soufusakijouhou").val();
        var immediate_version = $("#reg_housoukubun").val();
        $("input[name='payment_method'] ").val(payment_method)
        $("input[name='acceptance_condition'] ").val(acceptance_condition)
        $("input[name='sales_standard'] ").val(sales_standard)
        $("input[name='immediate_version'] ").val(immediate_version)
        var bango = $("input[id='userId']").val();
        $("#formSubmitButton").val("create")
        var data = new FormData(document.getElementById('insertData'));
        var voucherCreationFlag = $("#hikiatesyukkodatachar04").val();
        var stamping_phrase = $("#hikiatesyukkodatachar01").val();
        var isDelete = $("#request").val() == '3 受注削除';
        var canNotEdit = $("#request").val() == '2 受注訂正' && $("#number_search").val() == '';
        var cannotEditForUpperLimitCross = $("#request").val() == '2' && $("#update_restriction").val() == 1;
        var max_update_count = $("#max_update_count").val();
        var canNotDelete = $("#request").val() == '3' && $("#deletion_restriction").val() == 1;
        console.log('deletion_restriction'+ canNotDelete);
        if (canNotEdit) {
            $("#insertData").find(".error").removeClass('error')
            var editErrorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">オーダーを選択後、受注訂正してください</p>';
            $(document).find("#error_data").html(editErrorHtml)
            $("#orderEntrySubmitBtn").prop("disabled", false)
        } else if (cannotEditForUpperLimitCross) {
            $("#insertData").find(".error").removeClass('error')
            var editErrorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">訂正回数が上限値'+max_update_count+'回に達しました。</p>';
            $(document).find("#error_data").html(editErrorHtml)
            $("#orderEntrySubmitBtn").prop("disabled", false)
        } else if (canNotDelete) {
            $("#insertData").find(".error").removeClass('error')
            var deletionErrorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">紐づいた仕入伝票が存在しており、受注削除できません。</p>';
            $(document).find("#error_data").html(deletionErrorHtml)
            $("#orderEntrySubmitBtn").prop("disabled", false)
        } else if (isDelete) {
            $("#insertData").find(".error").removeClass('error')
            if (voucherCreationFlag == 2 && stamping_phrase == 1) {
                $.ajax({
                    url: "order-entry/register/" + bango,
                    type: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: successDataSubmit,
                    error: errorDataSubmit
                })
            } else {
                var deleteErrorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">このオーダーは削除できません</p>';
                $(document).find("#error_data").html(deleteErrorHtml)
                $("#orderEntrySubmitBtn").prop("disabled", false)

            }
        } else {
            $.ajax({
                url: "order-entry/register/" + bango,
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: successDataSubmit,
                error: errorDataSubmit
            })
        }


    })


})

function errorDataSubmit(response) {
    $('#orderEntrySubmitBtn').prop("disabled", false);
}

function successDataSubmit(result) {
    console.log(result);
    var checkErrorForQuantity = $(".quantity").hasClass("error") && $(".unitSellingPrice").hasClass("error")
    var checkErrorForInnerlevel = $("#innerlevel").val()>=15 && $("input[name='sales_amount_total']").val()<=0
    var patternsub2_1 = parseInt($("#patternsub2_1").val())
    var patternsub2_2 = parseInt($("#patternsub2_2").val())
    var priceTotal = parseInt($("#price_total_p1").val())
    var purchaseTotal = parseInt($("#purchase_total_p1").val())
    var request = $("#request").val();
    var totalMoney10 = parseInt($("#total_money10").val())
    var purchase_other_total = parseInt($("#purchase_other_total").val())
    console.log('pj: '+$("#pj").val());
    var value_of_F = parseInt($("#value_of_F").val()) 
    var value_of_B = parseInt($("#value_of_B").val())
    if($("#pj").val()){
        var checkErrorForPriceCreate = request == '1' && (priceTotal + totalMoney10) >= patternsub2_1
        var checkErrorForPurchaseCreate = request == '1' && (purchaseTotal + purchase_other_total) >= patternsub2_2
        var checkErrorForPrice = false
        var checkErrorForPurchase = false
    }else{
        var checkErrorForPriceCreate = false
        var checkErrorForPurchaseCreate = false
        var checkErrorForPrice = request == '1' && priceTotal >= patternsub2_1
        var checkErrorForPurchase = request == '1' && purchaseTotal >= patternsub2_2
    }
    var checkErrorForCredit = request == '1' && value_of_B == 0
    var checkErrorForCreditAlert = request == '1' && value_of_B < value_of_F
    console.log('value_of_F'+value_of_F+' value_of_B'+value_of_B+' checkErrorForCredit'+checkErrorForCredit+' checkErrorForCreditAlert'+checkErrorForCreditAlert)
    // console.log('purchaseTotal: '+purchaseTotal)
    // console.log('checkErrorForPurchaseCreate: '+checkErrorForPurchaseCreate)
    // console.log('patternsub2_2 + purchase_other_total: '+(patternsub2_2 + purchase_other_total))
    // console.log('request: '+request)

    if ($.trim(result.status) == 'confirm' && !checkErrorForQuantity && !checkErrorForInnerlevel && !checkErrorForCredit) {
        $('#confirm_email_transmission_modal').find(".modal-message").text('')
        var errorMsgPriceCreate = '受注金額が '+numberFormat(patternsub2_1)+' 以上は、稟議事項です。社内備考に稟議番号を入力してください。';
        if (checkErrorForPriceCreate) {
            $('#confirm_email_transmission_modal').find(".modal-message").text(errorMsgPriceCreate)
           // $('#confirm_email_transmission_modal').show()
            $('#confirm_email_transmission_modal').modal('show');
        }
        var errorMsgPurchaseCreate = '仕入金額が '+numberFormat(patternsub2_2)+' 以上は、稟議事項です。社内備考に稟議番号を入力してください。';
        if (checkErrorForPurchaseCreate) {
            $('#confirm_email_transmission_modal').find(".modal-message").text(errorMsgPurchaseCreate)
            // $('#confirm_email_transmission_modal').show()
            $('#confirm_email_transmission_modal').modal('show');
        }
        var errorMsgPrice = '受注金額が '+numberFormat(patternsub2_1)+' 以上は、稟議事項です。社内備考に稟議番号を入力してください。';
        if (checkErrorForPrice) {
            $('#confirm_email_transmission_modal').find(".modal-message").text(errorMsgPrice)
            // $('#confirm_email_transmission_modal').show()
            $('#confirm_email_transmission_modal').modal('show');
        }
        var errorMsgPurchase = '仕入金額が '+numberFormat(patternsub2_2)+' 以上は、稟議事項です。社内備考に稟議番号を入力してください。';
        if (checkErrorForPurchase) {
            $('#confirm_email_transmission_modal').find(".modal-message").text(errorMsgPurchase)
            // $('#confirm_email_transmission_modal').show()
            $('#confirm_email_transmission_modal').modal('show');
        }
        var errorMsgForCreditAlert = '・与信限度額を超えています。確認してください。';
        if (checkErrorForCreditAlert) {
            $('#confirm_email_transmission_modal').find(".modal-message").text(errorMsgForCreditAlert)
            $('#confirm_email_transmission_modal').modal('show');
        }
        
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
    } else if ($.trim(result.status) == 'ok' && !checkErrorForQuantity && !checkErrorForInnerlevel && !checkErrorForCredit) {
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

        if (inputError || inputErrorMsg || checkErrorForQuantity || checkErrorForInnerlevel || checkErrorForCredit) {
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
            if (inputErrorMsg || checkErrorForQuantity || checkErrorForInnerlevel || checkErrorForCredit) {
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
                var errorMsgInnerlevel = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">販売金額計が0以下のため、処理できません。</p>';
                if (checkErrorForInnerlevel) {
                    html += errorMsgInnerlevel;
                }
                var errorMsgCredit = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">会社マスタに与信限度額が登録されていません。</p>';
                if (checkErrorForCredit) {
                    html += errorMsgCredit;
                }
                html += '</div>';
                $('#error_data').html(html);
                $("#error_data").show();
                var confirmMessage = " エラーを修正してから再度登録ボタンを押して下さい。 "
                var confirmHtml = "<div>";
                confirmHtml += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + confirmMessage + '</p>';
                confirmHtml += "</div>"
                $("#confirmation_message").html(confirmHtml)
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
