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
    var supplier_id = $('#supplier_db').val();
    var supplier = $('#supplier_v2').val();
    var contractor_id =  $('#reg_sold_to_db').val();
    var reg_end_customer_db = $("#reg_end_customer_db").val();
    $.ajax({
        url: '/hatchu-nyuryoku/open-number-search-modal/' + bango,
        type: 'POST',
        data: {
            'bango': bango,
            'data101': data101,
            'data102': data102,
            "_token": $('#csrf').val(),
            category_kanri_def,
            request_def,
            supplier_id,
            contractor_id,
            reg_end_customer_db,
            supplier
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
            console.log(data102);
            console.log(request_def);
            if(request_def == 1 && category_kanri_def != "V470"){
                // console.log("con");
                $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", false);
                $('.number_search_partial_html').find( '#customRadio' ).prop("checked", true);
            }
            else if(category_kanri_def == "V470"){
                // console.log(category_kanri_def);
                $('.number_search_partial_html').find( '#customRadio' ).prop("checked", false);
                $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", true);
                $('.number_search_partial_html').find( '#customRadio2' ).prop("checked", true);
            }
            else{
                $('.number_search_partial_html').find( '#customRadio' ).prop("checked", false);
                $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", true);
                $('.number_search_partial_html').find( '#customRadio2' ).prop("checked", true);
            }
            $('#numberSearchModal').modal("show");
        }
    })
}

$(document).ready(function () {
    var orderID = localStorage.getItem('historyToOrderEntry') ?? false;
    if (orderID) {
        var requestVal = localStorage.getItem('historyToOrderEntryWithdataChar01')
        var orderCategory = localStorage.getItem('historyToOrderEntryWithdataChar02')

        $("input[name='number_search']").val(orderID);
        setTimeout(function () {
            $(document).find('#request').val(requestVal)
            $(document).find('#categorikanri').val(orderCategory)
            $("#number_search").trigger("keyup")

        }, 10);
    }
    
    function numberSearch() {
        var data = $('#numberForm').serialize();
        var bango = $("input[id='userId']").val();
        var supplier_id = $('#supplier_db').val();
        var contractor_id =  $('#reg_sold_to_db').val();
        var reg_end_customer_db = $("#reg_end_customer_db").val();
        data += '&supplier_id=' + encodeURIComponent(supplier_id) + '&contractor_id=' + encodeURIComponent(contractor_id) + '&reg_end_customer_db=' + encodeURIComponent(reg_end_customer_db);
        $.ajax({
            type: "POST",
            data: data,
            url: "/hatchu-nyuryoku/handel-number-search/" + bango,
            success: function (response) {
                var id = $('.number_search_partial_html').find("input[name='rd1']:checked").attr("id");
                console.log(id);
                $('.number_search_partial_html').remove();
                $('#insert_partial_modal').before(response.html);
                var request_def = $('#request option:selected').val();
                var category_kanri_def = $('#categorikanri option:selected').val();
                if(request_def == 1 && category_kanri_def != "V470"){
                    // console.log("con");
                    $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", false);
                    $('.number_search_partial_html').find( '#customRadio' ).prop("checked", true);
                }
                else if(category_kanri_def == "V470"){
                    // console.log(category_kanri_def);
                    $('.number_search_partial_html').find( '#customRadio' ).prop("checked", false);
                    $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", true);
                    $('.number_search_partial_html').find( '#customRadio2' ).prop("checked", true);
                }
                else{
                    $('.number_search_partial_html').find( '#customRadio' ).prop("checked", false);
                    $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", true);
                    $('.number_search_partial_html').find( '#customRadio2' ).prop("checked", true);
                }
                $('.number_search_partial_html').find( '#' + id ).prop("checked", true);
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
    function radioButton(){
        console.log('change');
        $(".customRadio").prop( "checked", false );
        $(this).prop( "checked", true );
        // $('#numberForm').find('#Button').val("refresh")
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
    doc.on("click", ".customRadio", radioButton)
    
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
    function CalculatePriceForTotalSales(){
        var sales = 0;
        var tax = 0;
        $('body').find('.line-form').each(function (index) {
            var id = "#" + $(this).attr("id");
            var price = $(id).find(".orderAmount").val();
            sales = sales + removeComma(price);
            var taxRate = $(id).find(".syouhizei").val();
            tax = tax + removeComma(taxRate);
        })
        // console.log(tax);
        // console.log(sales);
        return {"total_sales_amount" : sales, "totalTax": tax};
    }
    function setRateAndRoundWhenDeliveryDestination(){
        $(document).find('.deliveryDestination_db').each(function () {
            var hasValue = $(this).val() ? $(this).val() : false;
            var id = $(this).parents('.line-form').attr("id");
            var bango = $("input[id='userId']").val();
            // console.log(hasValue);
            if (hasValue) {
                $.ajax({
                    url: '/hatchu-nyuryoku/contact-wise-trading-condition-value/' + bango,
                    data: {contractorId: hasValue},
                    success: function (response) {
                        // console.log(response);
                        // console.log(from);
                        const {siharaikazeikubun, siharaizeihasuukubun} = response;
                        var siharaikazeikubunValue = siharaikazeikubun ? siharaikazeikubun[0].category1 + siharaikazeikubun[0].category2 : '';
                        var siharaizeihasuukubunValue = siharaizeihasuukubun ? siharaizeihasuukubun[0].category2 + ' ' + siharaizeihasuukubun[0].category4 : '';
                        // console.log($("#" + id).find('.siharaikazeikubun').val());
                        // if(!$("#" + id).find('.siharaikazeikubun').val()){
                            $("#" + id).find('.siharaikazeikubun').val(siharaikazeikubunValue).change();
                        // }
                        // if(!$("#" + id).find('.siharaizeihasuukubun').val()){
                            $("#" + id).find('.siharaizeihasuukubun').val(siharaizeihasuukubunValue);
                        // }
                    }
                })
            }
        })
    }
    function fetchData(selected_row_id, selected_supplier_id = null, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikitaisukko) {
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
                    var supplier_id = selected_supplier_id ? selected_supplier_id : $('#supplier_db').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf').val()
                        },
                        url: '/hatchu-nyuryoku/order-detail-read/' + bango,
                        type: 'POST',
                        data: {
                            'bango': bango,
                            'order_id': selected_row_id,
                            'supplier_id': supplier_id
                        },
                        success: function (response) {

                            //  localStorage.removeItem('isContainDeletedRow')
                            console.log('data');
                            console.log(response);
                            let orderData = response.orderDetail;
                            var isEdit = $("#request").val() == '2 訂正';
                            var isCreate = $("#request").val() == "1 新規作成";
                            var isDelete = $("#request").val() == "3 削除";
                            
                            var creation_category = $("#request").val();
                            if(creation_category == 2 || creation_category == 3){
                                $("#categorikanri").val(orderData.order_classification);
                            }
                            if(creation_category == 1 && orderData.order_classification == 'V440'){
                                $("#categorikanri").val(orderData.order_classification);
                            }

                            var errorClassHas = $(document).find(".error");
                            if (errorClassHas) {
                                $("#error_data").empty();
                                errorClassHas.removeClass("error")
                            }
                            
                            if (!$('#' + targetId).is(":button") && $("#number_search").hasClass("error")) {
                                $("#number_search").removeClass("error");
                                // zalert("work1");
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
                                if (orderData['orderentry_datepicker1']) {
                                    $("input[name='order_entry_date']").val(orderData['orderentry_datepicker1']);
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
                                    // var sold_to_value = $("#reg_sold_to_db").val();
                                    // sold_to_value = sold_to_value ? sold_to_value.substr(0, 6) : 0;
                                    // var bango = $("input[id='userId']").val();
                                    // $.ajax({
                                    //     url: 'order-entry/sold-wise-pj-value/' + bango,
                                    //     data: { catchsm: sold_to_value },
                                    //     success: function (res) {
                                    //         var $pj = $("#pj");
                                    //         $pj.html(res)
                                    //         if (orderData['pj']) {
                                    //             $pj.val(orderData['pj'])
                                    //         } else {
                                    //             $("#pj option").eq(0).prop("selected", true)
                                    //         }
                                    //         $(".loading").removeClass('show');
                                    //     }
                                    // })
                                }
                                if (orderData['supplier_db']) {
                                    localStorage.setItem('lastKokyakuId', orderData['supplier_db'].substr(0, 6))
                                    if (((editWhen.includes(editCondition)) && isEdit) || isDelete) {
                                        $('#igroup1').prop("disabled", true);
                                    } else {
                                        if (!$('#supplier_db').val()) {
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
                                $('#sales_amount_total').text('¥ ' + numberFormat(orderData['total_sales']));
                                $('#totalTax').text('¥ ' + numberFormat(orderData['total_tax']));
                                $("input[name='totalTax']").val(orderData['total_tax']);
                                $("input[name='sales_amount_total']").val(orderData['total_sales']);
                                $("input[name='date0016']").val(orderData['date0016']);
                                if (orderData['employee_name']) {
                                    $("select[name='tantou']").val(orderData['employee_name']).change();
                                }
                                if (orderData['payment_criteria']) {
                                    $("select[name='payment_criteria']").val(orderData['payment_criteria']).change();
                                }
                                if (orderData['hacchu_bikou1'] && !isCreate) {
                                    $("input[name='hacchu_bikou1']").val(orderData['hacchu_bikou1'])
                                }
                                if (orderData['hacchu_bikou2'] && !isCreate) {
                                    $("input[name='hacchu_bikou2']").val(orderData['hacchu_bikou2'])
                                }
                                if (orderData['hacchu_bikou3'] && !isCreate) {
                                    $("input[name='hacchu_bikou3']").val(orderData['hacchu_bikou3'])
                                }
                                if (orderData['siiresakimitumori'] && !isCreate) {
                                    $("input[name='siiresakimitumori']").val(orderData['siiresakimitumori'])
                                }
                                if (orderData['checkbox'] == 1  && !isCreate) {
                                    $("input[name='saisyukokyaku_checkbox']").val(orderData['checkbox']);
                                    $("input[name='saisyukokyaku_checkbox']").prop('checked', true)
                                }
                                if (orderData['datatxt0150'] == 1  && !isCreate) {
                                    $("input[name='datatxt0150']").val(orderData['datatxt0150']);
                                }
                                
                                
                                if (orderData['supplier_db']) {
                                    // var transactionData = {
                                    //     'reg_kessaihouhou': orderData['kessaihouhou'] ?? '',
                                    //     'reg_housoukubun': orderData['housoukubun'] ?? '',
                                    //     'reg_chumonsyajouhou': orderData['chumonsyajouhou'] ?? '',
                                    //     'reg_soufusakijouhou': orderData['soufusakijouhou'] ?? ''
                                    // }
                                    loadTransactionData(orderData['supplier_db'], 'transactionData')
                                }
                                
                                if ($(".line-form")) {
                                    $(".line-form").remove()
                                }
                                //alert("ok");
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
                                } else if (isCreate && $("#categorikanri").val() == 'U150' && hikitaisukko == 1) {
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
                                    $(".custom-file-label").attr("style", "pointer-events: none;")
                                    var money10 = $("#money10").val();
                                    var _new_money10 = money10 > 0 ? - money10 : money10;
                                    var money_max = $("#moneymax").val();
                                    var _new_money_max = money_max > 0 ? - money_max : money_max;
                                    $("#money10").val(_new_money10);
                                    $("#moneymax").val(_new_money_max);
                                    $("#sales_amount_total").text("¥" + numberFormat(_new_money10))
                                    $("#totalTax").text("¥" + numberFormat(_new_money_max))
                                    setTimeout(changePositiveNumberToNegative, 100)
                                    $("#orderEntrySubmitBtn").prop("disabled", false);
                                } 
                                //Calculating 304 field Value
                                var {total_sales_amount, totalTax} = CalculatePriceForTotalSales();
                                $('#totalTax').text('¥ ' + numberFormat(totalTax));
                                $("input[name='totalTax']").val(totalTax)

                                $('#sales_amount_total').text('¥ ' + numberFormat(total_sales_amount));
                                // var total = numberFormat(total_sales_amount);
                                $("input[name='sales_amount_total']").val(total_sales_amount) 
                                setRateAndRoundWhenDeliveryDestination();                             
                            } else {
                                var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">検索結果に該当するデータがありません</p>';
                                $(document).find("#error_data").html(errorHtml);
                                $(this).addClass("error")
                                $("input[type=text][name != number_search] ").each(function () {
                                    $(this).val('')
                                })
                                $("#sales_amount_total").text('¥')
                                $("#totalTax").text('¥')

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
        var source = $("input[id=source]").val()
        var targetId = $(this).prop("id");
        var selected_row_id;
        var categorikanriIs10 = $("#categorikanri").val() == 'U110' ? true : false
        var requestVal = $("#request").val() == "1 新規作成" ? true : false
        var isBtn = $(this).is(":button");
        if ($(this).is(":button")) {
            var isContainDeletedRow = $('#order_show_table tr.add_border').find('.contain_deleted_item').val();
            var selected_supplier_id = $('#order_show_table tr.add_border').find('.supplier_id').val();
            selected_row_id = $('#order_show_table tr.add_border').attr('id')
            fetchData(selected_row_id, selected_supplier_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1)
        } else {
            selected_row_id = $(this).val();
            var bango = $("input[id='userId']").val();
            if (selected_row_id.length >= 10 && selected_row_id.substr(0,4)=='0351') {    
                fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1);
            }else{
                var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p></div>';
                // var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">検索結果に該当するデータがありません</p>';
                var errorData = $(document).find("#error_data")
                if (errorData) {
                    errorData.html(html);
                    $(this).addClass("error")
                }
                $(document).find("#error_data").html(html);
                $(this).addClass("error")
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







