function changePositiveNumberToNegative() {
    var _elements = ['unitSellingPrice', 'priceCell', 'grossProfitCell', 'se', 'institute', 'ship', 'purchase', 'price', 'grossProfit'];
    _elements.forEach((el) => {
        var _el = $("." + el)
        _el.each(function (index) {
            const item = $(this)
            const item_type = item.prop('localName')
            let item_value = item_type == 'input' ? item.val() : item.text();
            item_value = Number(item_value.replaceAll(',', ''))
            let _val = item_value > 0 ? - item_value : item_value
            if (item_type == 'input') {
                item.val(numberFormat(_val))
            } else {
                item.text(numberFormat(_val))
            }
        })

    })

}
function handleNumberSearchModalOpener(targetId) {
    $(this).prop('disabled', true)
    //$('.modal-backdrop').remove();
    // var source = $("input[id=source]").val()
    // if (source == 'orderHistory') {
    //     var targetEl = $(this).parents('.input-group').find('.form-control').attr('id')
    //     $("#targetId").val(targetEl)
    // }
    var bango = $("input[id='userId']").val();
    var data101 = $('#categorikanri option:selected').text();
    var data102 = $('#request option:selected').text();
    var category_kanri_def = $('#categorikanri option:selected').val();
    var request_def = $('#request option:selected').val();
    $.ajax({
        url: '/order-entry/open-number-search-modal/' + bango,
        type: 'POST',
        data: {
            'bango': bango,
            'data101': data101,
            'data102': data102,
            "_token": $('#csrf').val(),
            category_kanri_def,
            request_def
        },
        success: function (response) {
            var targetEl = $('#insert_partial_modal')
            var prevEl = targetEl.prevAll();
            if (prevEl) {
                prevEl.remove()
            }
            targetEl.before(response.html);
            //$("#targetId").val(targetId)
            localStorage.setItem("numberTargetId", targetId)
            $("#select-order-detail").prop('disabled', true)
            $("#request_def").val(request_def)
            $("#category_kanri_def").val(category_kanri_def)
            $('#numberSearchModal').modal("show");
        }
    })
}

$(document).ready(function () {
    var orderID = localStorage.getItem('historyToOrderEntry') ?? false;
    
    if (orderID) {
        var requestVal = localStorage.getItem('historyToOrderEntryWithdataChar01').substring(0, 1);
        var orderCategory = localStorage.getItem('historyToOrderEntryWithdataChar02')

        $("input[name='number_search']").val(orderID);
        setTimeout(function () {
            $(document).find('#request').val(requestVal)
            $(document).find('#categorikanri').val(orderCategory)
            $("#number_search").trigger("keyup")

        }, 10);
    }

    function numberSearch() {
        var bango = $("input[id='userId']").val();
        $.ajax({
            type: "POST",
            data: $('#numberForm').serialize(),
            url: "/order-entry/handel-number-search/" + bango,
            success: function (response) {
                console.log("lll")
                $('.number_search_partial_html').remove();
                $('#insert_partial_modal').before(response.html);
            }
        })
    }

    function goToSpecificPage() {

        var i = $('#numberForm').find("#paginate").val()

        if (i < 1) {
            $('#numberForm').find("#paginate").val(1)
        } else {
            $('#numberForm').find("#paginate").val(i)
        }

        var mood = $('#numberForm').find('#Button').val()
        if (mood == 'sort') {
            $('#numberForm').find('#Button').val("sort");
        } else {
            $('#numberForm').find('#Button').val("Thesearch");

        }
        $('#numberForm').prop("method", "post")

        numberSearch();
    }

    function gotoBackwardPage() {

        $('#numberForm').find('#paginationhelper').prop('disabled', false)
        var i = $('#numberForm').find("#paginate").val()
        if (i <= 1) {
            $('#numberForm').find('#paginationhelper').val(1);
        } else {
            $('#numberForm').find('#paginationhelper').val(--i);
        }

        var mood = $('#numberForm').find('#Button').val();
        if (mood == 'sort') {
            $('#numberForm').find('#Button').val('sort');
        } else {
            $('#numberForm').find('#Button').val('Thesearch');
        }

        $('#numberForm').find("#paginate").prop('disabled', true)
        $('#numberForm').find('#paginationhelper').prop('disabled', false)
        $('#numberForm').prop("method", "post")

        numberSearch();
    }

    function goToForwardPage() {

        $('#numberForm').find('#paginationhelper').prop('disabled', false)
        var i = $('#numberForm').find("#paginate").val()
        if (i < 1) {
            $('#numberForm').find('#paginationhelper').val(1);
        } else {
            $('#numberForm').find('#paginationhelper').val(++i);
        }

        var mood = $('#numberForm').find('#Button').val();
        if (mood == 'sort') {
            $('#numberForm').find('#Button').val('sort');
        } else {
            $('#numberForm').find('#Button').val('Thesearch');
        }

        $('#numberForm').find("#paginate").prop('disabled', true)
        $('#numberForm').find('#paginationhelper').prop('disabled', false)
        $('#numberForm').prop("method", "post")
        numberSearch();
    }

    function dataSearch() {

        if ($('#numberForm').find("#paginate")) {
            $('#numberForm').find("#paginate").val(1)
        }
        $('#numberForm').find('#Button').val('Thesearch')
        $('#numberForm').prop("method", "post")
        numberSearch();
    }

    function sortingAscDsc(field) {
        if ($('#numberForm').find("#paginate")) {
            $('#numberForm').find("#paginate").val(1)
        }

        var previousSort = $('#numberForm').find('#sortType').val();
        var previousField = $('#numberForm').find('#sortField').val();

        if (previousField && previousSort) {
            if (previousField == field) {
                if (previousSort == 'ASC') {
                    sortOrder = 'DESC';
                } else {
                    sortOrder = 'ASC';
                }
            } else {
                sortOrder = 'ASC';
            }
        } else {
            sortOrder = 'ASC';
        }

        $('#numberForm').find('#sortType').val(sortOrder);
        $('#numberForm').find('#sortField').val(field);
        $('#numberForm').find('#Button').val('sort')
        $('#numberForm').prop("method", "post")
        numberSearch();
    }


    function refreshData() {
        if ($('#numberForm').find("#paginate")) {
            $('#numberForm').find("#paginate").val(1);
        }
        $('#numberForm').find('#Button').val("refresh")
        $('#numberForm').prop("method", "post")
        numberSearch();
    }


    // $(".number_search_modal_opener").on("click", handleNumberSearchModalOpener);
    var doc = $(document)
    doc.on("click", ".columnSort", function (e) {
        e.preventDefault();
        var $field = $(this).prop("id");
        sortingAscDsc($field)
    })
    doc.on("click", ".refreshBtn", function (e) {
        e.preventDefault();
        refreshData();

    })
    doc.on("click", ".searchBtn", function (e) {
        e.preventDefault();
        dataSearch();
    })
    doc.on("click", ".forwardPageLink", function (e) {
        e.preventDefault();
        goToForwardPage();
    })
    doc.on("click", ".pageLink", function (e) {
        e.preventDefault();
        goToSpecificPage();
    })
    doc.on("click", ".backPageLink", function (e) {
        e.preventDefault();
        gotoBackwardPage();
    })


    $('#numberSearchModal').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');

    })
    $('#numberSearchModal').on('hide.bs.modal', function (e) {
        // refreshData();
        if ($("#number_search").hasClass("error")) {
            $("#number_search").removeClass("error")
        }
        $('.number_search_partial_html').remove();
        // $('body').removeClass('overflow_cls');
        $(".number_search_modal_opener").prop('disabled', false);
        //$('.modal-backdrop').remove();
    })
    $(document).on("click", ".number_search_show", function () {
        $("#select-order-detail").prop('disabled', false);
    })
    // $(document).on("click", "#select-number-search", function () {
    //     var $targetElm = $(this).parents('.modal-body').find('.add_border')
    //     var numberSearch = $targetElm.find("td:first").text();
    //     $("input[name=number_search]").val(numberSearch)
    //     $('#numberSearchModal').modal("hide")
    // })
    function fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikitaisukko) {
        console.log(hikitaisukko)
        if (selected_row_id && selected_row_id.length < 10) {
            var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">検索結果に該当するデータがありません</p>';
            var errorData = $(document).find("#error_data")
            if (errorData) {
                errorData.html(errorHtml);
                $(this).addClass("error")
            }
            $(document).find("#error_data").html(errorHtml);
            $(this).addClass("error")
        } else if (selected_row_id && isContainDeletedRow && categorikanriIs10 && requestVal) {
            var errormsg = "番号検索データには、欠番データが含まれているためコピー元として使用できません。"
            var errorhtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + errormsg + '</p>';
            if (isBtn) {
                $(document).find('.delete_data_contain').html(errorhtml)
            } else {
                $(document).find("#error_data").html(errorhtml)
            }
        } else {
            if (selected_row_id && selected_row_id.length >= 10) {
                if (source == 'orderHistory' || source == 'lBook') {
                    var targetElm = localStorage.getItem("numberTargetId");
                    $('#' + targetElm).val(selected_row_id)
                    if (isBtn) {
                        $(document).find('#numberSearchModal').modal("hide")
                    }
                } else {
                    $(".loading").addClass('show');
                    var bango = $("input[id='userId']").val();
                    if (isBtn) {
                        $(document).find('#numberSearchModal').modal("hide")
                    }
                    var category_id = $("#request").val();
                    console.log(category_id)
                    $.ajax({
                        url: '/order-entry/order_detail_read/' + bango,
                        type: 'POST',
                        data: {
                            'bango': bango,
                            'order_id': selected_row_id,
                            'category_id': category_id
                        },
                        success: function (response) {

                            //  localStorage.removeItem('isContainDeletedRow')
                            let orderData = response.orderDetail;
                            let productData = response.products;
                            let update_restriction = response.update_restriction;
                            if(update_restriction){
                                $('#update_restriction').val(1)
                            }
                            let max_update_count = response.max_update_count;
                            if(max_update_count){
                                $('#max_update_count').val(max_update_count)
                            }
                            var dataint16_total = 0;
                            var priceTotal = 0;
                            var purchaseTotal = 0;
                            productData.forEach((product) => {
                                dataint16_total += parseInt(product.dataint16);        
                                if (product.hantei == 0) {
                                    var price = removeComma(product.dataint11)
                                    priceTotal += price;
                                }
                        
                                var purchase = removeComma(product.dataint08)
                                var quantity = removeComma(product.syukkasu)
                                purchaseTotal += purchase * quantity;
                                if(product.deletion_permission){
                                    $('#deletion_restriction').val(1)
                                }
                            
                            })
                            
                            $('#price_total_p1').val(priceTotal)
                            $('#purchase_total_p1').val(purchaseTotal)
                            var isEdit = $("#request").val() == '2';
                            var isCreate = $("#request").val() == "1";
                            var isDelete = $("#request").val() == "3";
                            
                            var creation_category = $("#request").val();
                            if(creation_category == 1){
                                dataint16_total = 0;
                            }
                            $("#dataint16_total").val(dataint16_total)
                            if(creation_category == 2 || creation_category == 3){
                                console.log(orderData)
                                $("#categorikanri").val(orderData.order_classification);
                            }
                            $("#datachar05").val(orderData['datachar05']);

                            var errorClassHas = $(document).find(".error");
                            if (errorClassHas) {
                                $("#error_data").empty();
                                errorClassHas.removeClass("error")
                            }
                            if (!$('#' + targetId).is(":button") && $("#number_search").hasClass("error")) {
                                $("#number_search").removeClass("error")
                            }
                            const hasOrder = Boolean(response.hasOrder)

                            if (hasOrder) {
                                var voucherCreationFlag = orderData['hikiatesyukkodatachar04'];
                                var stamping_phrase = orderData['hikiatesyukkodatachar01'];
                                var editCondition = voucherCreationFlag + '' + stamping_phrase;
                                var editWhen = ['22', '23', '12', '13'];
                                for (let [key, value] of Object.entries(orderData)) {
                                    if (value != null) {
                                        $('#' + key).val(value);
                                    }
                                }
                                var dateids = {
                                    'datepicker1_oen': 'datepicker1_comShow',
                                    'datepicker2_oen': 'datepicker2_comShow',
                                    'datepicker3_oen': 'datepicker3_comShow',
                                    'datepicker4_oen': 'datepicker4_comShow',
                                    'datepicker5_oen': 'datepicker5_comShow',
                                }
                                for (const key in dateids) {
                                    if (orderData[key]) {
                                        var res = orderData[key];
                                        var hidden_field = dateids[key];
                                        $("#" + hidden_field).datepicker('setDate', res);
                                        $("#" + hidden_field).datepicker('hide');
                                        $('#' + key).val(res)
                                    }
                                }
                                if (orderData['reg_sold_to']) {
                                    var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search"];
                                    elements.forEach((el) => {
                                        var element = $(el);
                                        var type = element.prop('localName')
                                        if (type == 'button') {
                                            element.prop("disabled", true)
                                        } else if (type == 'select') {
                                            element.attr("readonly", "readonly")
                                            element.attr("style", "pointer-events: none;");
                                        } else if (type == 'input') {
                                            element.prop('readonly', true)
                                            element.attr("style", "pointer-events: none;");
                                        }
                                    })
                                    var sold_to_value = $("#reg_sold_to_db").val();
                                    sold_to_value = sold_to_value ? sold_to_value.substr(0, 6) : 0;
                                    var bango = $("input[id='userId']").val();
                                    $.ajax({
                                        url: 'order-entry/sold-wise-pj-value/' + bango,
                                        data: { catchsm: sold_to_value },
                                        success: function (res) {
                                            var $pj = $("#pj");
                                            $pj.html(res)
                                            if (orderData['pj']) {
                                                $pj.val(orderData['pj'])
                                            } else {
                                                $("#pj option").eq(0).prop("selected", true)
                                            }
                                            $("#pj").trigger("change")
                                            $(".loading").removeClass('show');
                                        }
                                    })
                                }
                                if (orderData['reg_sales_billing_destination']) {
                                    localStorage.setItem('lastKokyakuId', orderData['reg_sales_billing_destination'].substr(0, 6))
                                    if (((editWhen.includes(editCondition)) && isEdit) || isDelete) {
                                        $('#igroup1').prop("disabled", true);
                                    } else {
                                        if (!$('#reg_sales_billing_destination').val()) {
                                            $('#igroup1').prop("disabled", true)
                                        } else {
                                            $('#igroup1').prop("disabled", false);
                                        }
                                    }
                                }

                                if (orderData['order_number'] && !isCreate) {
                                    $(".order_entry_topcontent").find("input[name=order_number]").val(orderData['order_number']);
                                }
                                if (orderData['order_number'] && isCreate) {
                                    $(".order_entry_topcontent").find("input[name=order_number]").val('');
                                }
                                if (orderData['customfile'] && !isCreate) {
                                    $('.custom-file-label').text(orderData['custom_file_short']);
                                    $("input[name='purchase_order_file_name']").val(orderData['customfile'])
                                }
                                if (!orderData['customfile']) {
                                    $('.custom-file-label').text('注文書PDFアップロード');
                                    $("input[name='purchase_order_file_name']").val('')
                                }
                                $('#sales_amount_total').text('¥ ' + numberFormat(orderData['money10']));
                                $('#gross_profit_margin').text('¥ ' + numberFormat(orderData['moneymax']-dataint16_total))

                                if (orderData['reg_sales_billing_destination']) {
                                    var transactionData = {
                                        'reg_kessaihouhou': orderData['kessaihouhou'] ?? '',
                                        'reg_housoukubun': orderData['housoukubun'] ?? '',
                                        'reg_chumonsyajouhou': orderData['chumonsyajouhou'] ?? '',
                                        'reg_soufusakijouhou': orderData['soufusakijouhou'] ?? ''
                                    }
                                    
                                    var paymentDate = $("#datepicker4_oen").val();
                                    var billingDestination = $("#reg_sales_billing_destination_db").val();
                                    var bango = $("input[id='userId']").val();
                                    //console.log('paymentDate '+paymentDate+' billingDestination '+billingDestination+' bango '+bango)
                                    $.ajax({
                                        url: 'order-entry/sales-billing-date-wise-payment-date/' + bango,
                                        data: { paymentDate, billingDestination },
                                        success: function (res) {
                                            console.log("A "+res.A);
                                            console.log("B "+res.B);
                                            console.log("C "+res.C);
                                            console.log("D "+res.D);
                                            console.log("E "+res.E);
                                            var F = parseInt(res.A) + parseInt(res.C) + parseInt(res.D) + parseInt(res.E);
                                            console.log("F "+F);
                                            $('#value_of_F').val(F);
                                            $('#value_of_B').val(res.B);
                                        }
                                    })

                                    loadTransactionData(orderData['reg_sales_billing_destination'], transactionData)
                                }
                                if ($(".line-form")) {
                                    $(".line-form").remove()
                                }
                                var htmlResponse = orderData ? response.html : '';
                                $("#products_button").before(htmlResponse);
                                $("#formSubmitButton").val('edit');
                                if ((editWhen.includes(editCondition)) && isEdit) {
                                    $('#isEditReadonly').val(1)
                                    var escapeElements = ['pj', 'customer_order_number'];
                                    var buttons = ['open_number_search', 'sold_to_modal_opener', 'igroup1', 'productModalOpener', 'viewProductDes', 'product_sub_modal_opener', 'shipping_modal_opener', 'delBtn', 'lineBtn', 'branchBtn', 'repeatBtn'];
                                    buttons.forEach(function (item) {
                                        $('.' + item).prop("disabled", true)
                                    })
                                    $("#insertData").find('input[type!=hidden],select').each(function () {
                                        var elName = $(this).prop('name');
                                        var elLocalName = $(this).prop('localName');
                                        if (elName && !escapeElements.includes(elName)) {
                                            if (elLocalName == 'input') {
                                                $(this).prop('readonly', true)
                                                $(this).attr("style", "pointer-events: none;");
                                            } else if (elLocalName == 'select') {
                                                $(this).attr("readonly", "readonly")
                                                $(this).attr("style", "pointer-events: none;");
                                            }
                                        }
                                    });
                                }

                                if (isEdit) {
                                    var editMessage = {
                                        '21': '',
                                        '22': '該当データは売上指示済みです',
                                        '23': '該当データは売上検印済みです',
                                        '11': '該当データは売上データ作成済みです',
                                        '12': '該当データは売上指示済みです',
                                        '13': '該当データは売上検印済みです'
                                    }
                                    if (Object.keys(editMessage).includes(editCondition)) {
                                        var editErrorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + editMessage[editCondition] + '</p>';
                                        $(document).find("#error_data").html(editErrorHtml)
                                    }

                                } else if (isDelete) {
                                    $("#insertData").find('input[type!=hidden],select,button').each(function () {
                                        var elType = $(this).prop('localName');
                                        if (elType == 'input' && $(this).prop('name')) {
                                            $(this).prop('readonly', true)
                                            $(this).attr("style", "pointer-events: none;");
                                        } else if (elType == 'select') {
                                            $(this).attr("readonly", "readonly")
                                            $(this).attr("style", "pointer-events: none;");
                                        } else if (elType == 'button' && ($(this).attr("id") != 'orderEntrySubmitBtn')) {
                                            $(this).attr('disabled', 'disabled');
                                        }
                                    });
                                    $(".custom-file-label").attr("style", "pointer-events: none;")
                                } else if (isCreate) {
                                    $("input[name=customer_order_number]").val('')
                                }
                                if (isCreate && $("#categorikanri").val() == 'U150' && hikitaisukko == 2) {
                                    var errormsg = "売上伝票未作成の受注に関する売上キャンセルデータは作成できません。"
                                    var errorhtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + errormsg + '</p>';
                                    $(document).find("#error_data").html(errorhtml)
                                    var buttons = ['open_number_search', 'sold_to_modal_opener', 'igroup1', 'productModalOpener', 'viewProductDes', 'product_sub_modal_opener', 'shipping_modal_opener', 'delBtn', 'lineBtn', 'branchBtn', 'repeatBtn'];
                                    buttons.forEach(function (item) {
                                        $('.' + item).prop("disabled", true)
                                    })
                                    $("#insertData").find('input[type!=hidden],select').each(function () {
                                        var elLocalName = $(this).prop('localName');
                                        if (elLocalName == 'input') {
                                            $(this).prop('readonly', true)
                                            $(this).attr("style", "pointer-events: none;");
                                        } else if (elLocalName == 'select') {
                                            $(this).attr("readonly", "readonly")
                                            $(this).attr("style", "pointer-events: none;");
                                        }
                                    });
                                    $(".custom-file-label").attr("style", "pointer-events: none;")
                                    $(document).find("#orderEntrySubmitBtn").prop('disabled', true)

                                    $('#datepicker1_oen').prop('readonly', false)
                                    $('#datepicker1_oen').attr("style", "pointer-events: block;")
                                    $('#datepicker2_oen').prop('readonly', false)
                                    $('#datepicker2_oen').attr("style", "pointer-events: block;")
                                    $('#datepicker3_oen').prop('readonly', false)
                                    $('#datepicker3_oen').attr("style", "pointer-events: block;")
                                    $('#datepicker4_oen').prop('readonly', false)
                                    $('#datepicker4_oen').attr("style", "pointer-events: block;")
                                    $('#datepicker5_oen').prop('readonly', false)
                                    $('#datepicker5_oen').attr("style", "pointer-events: block;")
                                }
                                else if ($("#categorikanri").val() == 'U150' && hikitaisukko == 2) {
                                    
                                    var flag=$("#request").val()
                                    var escapeElements = ['voucher_remarks', 'in_house_remarks'];
                                    var buttons = ['open_number_search', 'sold_to_modal_opener', 'igroup1', 'productModalOpener', 'viewProductDes', 'product_sub_modal_opener', 'shipping_modal_opener', 'delBtn', 'lineBtn', 'branchBtn', 'repeatBtn'];
                                    buttons.forEach(function (item) {
                                        $('.' + item).prop("disabled", true)
                                    })
                                    $("#insertData").find('input[type!=hidden],select').each(function () {
                                        var elName = $(this).prop('name');
                                        var elLocalName = $(this).prop('localName');
                                        if (elName && !escapeElements.includes(elName)) {
                                            if (elLocalName == 'input') {
                                                $(this).prop('readonly', true)
                                                $(this).attr("style", "pointer-events: none;");
                                            } else if (elLocalName == 'select') {
                                                $(this).attr("readonly", "readonly")
                                                $(this).attr("style", "pointer-events: none;");
                                            }
                                        }
                                    });
                                    if (flag == '1' || flag == '2') {
                                        $('#datepicker1_oen').prop('readonly', false)
                                        $('#datepicker1_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker2_oen').prop('readonly', false)
                                        $('#datepicker2_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker3_oen').prop('readonly', false)
                                        $('#datepicker3_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker4_oen').prop('readonly', false)
                                        $('#datepicker4_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker5_oen').prop('readonly', false)
                                        $('#datepicker5_oen').attr("style", "pointer-events: block;")
                                    }
                                    $(".custom-file-label").attr("style", "pointer-events: none;")
                                    var money10 = $("#money10").val();
                                    var _new_money10 = money10 > 0 ? - money10 : money10;
                                    var money_max = $("#moneymax").val();
                                    var _new_money_max = money_max > 0 ? - money_max : money_max;
                                    $("#money10").val(_new_money10);
                                    $("#moneymax").val(_new_money_max);
                                    $("#sales_amount_total").text("¥" + numberFormat(_new_money10))
                                    $("#gross_profit_margin").text("¥" + numberFormat(_new_money_max-dataint16_total))
                                    setTimeout(changePositiveNumberToNegative, 100)
                                    $("#orderEntrySubmitBtn").prop("disabled", false);
                                } 
                                 else if (isCreate && $("#categorikanri").val() == 'U150' && hikitaisukko == 1) {
                                   
                                    var flag=$("#request").val()
                                    var escapeElements = ['voucher_remarks', 'in_house_remarks'];
                                    var buttons = ['open_number_search', 'sold_to_modal_opener', 'igroup1', 'productModalOpener', 'viewProductDes', 'product_sub_modal_opener', 'shipping_modal_opener', 'delBtn', 'lineBtn', 'branchBtn', 'repeatBtn'];
                                    buttons.forEach(function (item) {
                                        $('.' + item).prop("disabled", true)
                                    })
                                    $("#insertData").find('input[type!=hidden],select').each(function () {
                                        var elName = $(this).prop('name');
                                        var elLocalName = $(this).prop('localName');
                                        if (elName && !escapeElements.includes(elName)) {
                                            if (elLocalName == 'input') {
                                                $(this).prop('readonly', true)
                                                $(this).attr("style", "pointer-events: none;");
                                            } else if (elLocalName == 'select') {
                                                $(this).attr("readonly", "readonly")
                                                $(this).attr("style", "pointer-events: none;");
                                            }
                                        }
                                    });
                                    if (flag == '1' || flag == '2') {
                                        $('#datepicker1_oen').prop('readonly', false)
                                        $('#datepicker1_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker2_oen').prop('readonly', false)
                                        $('#datepicker2_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker3_oen').prop('readonly', false)
                                        $('#datepicker3_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker4_oen').prop('readonly', false)
                                        $('#datepicker4_oen').attr("style", "pointer-events: block;")
                                        $('#datepicker5_oen').prop('readonly', false)
                                        $('#datepicker5_oen').attr("style", "pointer-events: block;")
                                    }
                                    $(".custom-file-label").attr("style", "pointer-events: none;")
                                    var money10 = $("#money10").val();
                                    var _new_money10 = money10 > 0 ? - money10 : money10;
                                    var money_max = $("#moneymax").val();
                                    var _new_money_max = money_max > 0 ? - money_max : money_max;
                                    $("#money10").val(_new_money10);
                                    $("#moneymax").val(_new_money_max);
                                    $("#sales_amount_total").text("¥" + numberFormat(_new_money10))
                                    $("#gross_profit_margin").text("¥" + numberFormat(_new_money_max-dataint16_total))
                                    setTimeout(changePositiveNumberToNegative, 100)
                                    $("#orderEntrySubmitBtn").prop("disabled", false);
                                }
                            } else {
                                var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">検索結果に該当するデータがありません</p>';
                                $(document).find("#error_data").html(errorHtml);
                                $(this).addClass("error")
                                $("input[type=text][name != number_search] ").each(function () {
                                    $(this).val('')
                                })
                                $("#sales_amount_total").text('¥')
                                $("#gross_profit_margin").text('¥')

                                $("select").each(function () {
                                    $(this).prop("selectedIndex", 0)
                                })
                                if ($(".line-form")) {
                                    $(".line-form").not(":first").remove()
                                }

                                $(".price").text("")
                                $(".grossProfit").text("")
                                if (!$('#' + targetId).is(":button")) {
                                    $("#number_search").addClass("error")
                                }
                            }
                            $("#insertData").find('.datePicker').each(function () {
                                $(this).removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
                                    language: 'ja-JP',
                                    format: 'yyyy/mm/dd',
                                    autoHide: true,
                                    zIndex: 1,
                                    offset: 4,
                                    setDate: new Date()
                                })
                            })
                            if ($('#' + targetId).is(":button")) {
                                $(document).find('#numberSearchModal').modal("hide")
                                $("#number_search").focus();
                            }
                            $(".loading").removeClass('show');
                        }
                    });
                }
            } else if (!selected_row_id) {
                $(document).find("#error_data").html('');
                $(this).hasClass("error") ? $(this).removeClass("error") : '';
            }

        }
    }

    function readOrderDetail() {
        $(".success-msg-box").css("display","none");
        var source = $("input[id=source]").val()
        var targetId = $(this).prop("id");
        var selected_row_id;
        var categorikanriIs10 = $("#categorikanri").val() == 'U110' ? true : false
        var requestVal = $("#request").val() == "1 新規作成" ? true : false
        var isBtn = $(this).is(":button");
        if ($(this).is(":button")) {
            var isContainDeletedRow = $('#order_show_table tr.add_border').find('.contain_deleted_item').val();
            selected_row_id = $('#order_show_table tr.add_border').attr('id')
            fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1)
        } else {
            selected_row_id = $(this).val();
            var bango = $("input[id='userId']").val();
            if (selected_row_id.length >= 10) {
                $.ajax({
                    url: '/order-entry/check-yoteimeter-status/' + bango + '/' + selected_row_id,
                    type: 'GET',
                    success: function ({ delStatus, hikiatesyukko, datachar02 }) {
                        var isContainDeletedRow = delStatus;
                        $("#_hikitasukko_val").val(hikiatesyukko)
                        
                        var checkErrorForInnerlevel = $("#innerLevel").val()>14
                        if(datachar02 == 'U123'){
                            if(!checkErrorForInnerlevel){
                                fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikiatesyukko);
                            }
                        }else{
                            fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikiatesyukko);
                        }
                    }
                })
            }
            if (localStorage.getItem('historyToOrderEntry')) {
                localStorage.removeItem('historyToOrderEntry')
                localStorage.removeItem('historyToOrderEntryWithdataChar01')
                localStorage.removeItem('historyToOrderEntryWithdataChar02')
            }
        }
    }
    $(document).on("click", "#select-order-detail", readOrderDetail)
    
    $(document).on("keyup", "#number_search", _.debounce(readOrderDetail, 500))
})







