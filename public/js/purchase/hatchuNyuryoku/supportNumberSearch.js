// function changePositiveNumberToNegative() {
//     var _elements = ['unitSellingPrice', 'priceCell', 'grossProfitCell', 'se', 'institute', 'ship', 'purchase', 'price', 'grossProfit'];
//     _elements.forEach((el) => {
//         var _el = $("." + el)
//         _el.each(function (index) {
//             const item = $(this)
//             const item_type = item.prop('localName')
//             let item_value = item_type == 'input' ? item.val() : item.text();
//             item_value = Number(item_value.replaceAll(',', ''))
//             let _val = item_value > 0 ? - item_value : item_value
//             if (item_type == 'input') {
//                 item.val(searchNumberFormat(_val))
//             } else {
//                 item.text(searchNumberFormat(_val))
//             }
//         })

//     })

// }
function handleSupportNumberSearchModalOpener(targetId) {
    $(this).prop('disabled', true)
    // $('.number_search_partial_html').find( '#customRadio2' ).prop("checked",true);
    // $('.number_search_partial_html').find( '#customRadio' ).prop("disabled", true);
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
    var contractor_id =  $('#reg_sold_to_db').val();
    var reg_end_customer_db = $("#reg_end_customer_db").val();
    $.ajax({
        url: '/hatchu-nyuryoku/open-support-number-search-modal/' + bango,
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
            reg_end_customer_db
        },
        success: function (response) {
            var targetEl = $('#insert_support_partial_modal')
            var prevEl = targetEl.prevAll();
            if (prevEl) {
                prevEl.remove()
            }
            targetEl.before(response.html);
            //$("#targetId").val(targetId)
            localStorage.setItem("numberTargetId", targetId)
            $("#select-support-order-detail").prop('disabled', true)
            $('#supportNumberSearchModal').modal("show");
        }
    })
}

$(document).ready(function () {
    // var orderID = localStorage.getItem('historyToOrderEntry') ?? false;
    // if (orderID) {
    //     var requestVal = localStorage.getItem('historyToOrderEntryWithdataChar01')
    //     var orderCategory = localStorage.getItem('historyToOrderEntryWithdataChar02')

    //     $("input[name='support_number_search']").val(orderID);
    //     setTimeout(function () {
    //         $(document).find('#request').val(requestVal)
    //         $(document).find('#categorikanri').val(orderCategory)
    //         $("#support_number_search").trigger("keyup")

    //     }, 10);
    // }
    
    function supportNumberSearch() {
        var data = $('#searchNumberForm').serialize();
        var bango = $("input[id='userId']").val();
        var supplier_id = $('#supplier_db').val();
        var contractor_id =  $('#reg_sold_to_db').val();
        var reg_end_customer_db = $("#reg_end_customer_db").val();
        data += '&supplier_id=' + encodeURIComponent(supplier_id) + '&contractor_id=' + encodeURIComponent(contractor_id) + '&reg_end_customer_db=' + encodeURIComponent(reg_end_customer_db);
        $.ajax({
            type: "POST",
            data: data,
            url: "/hatchu-nyuryoku/handel-support-number-search/" + bango,
            success: function (response) {
                $('.support_number_search_partial_html').remove();
                $('#insert_support_partial_modal').before(response.html);
            }
        })
    }

    function goToSupportSpecificPage() {

        var i = $('#searchNumberForm').find("#paginate").val()

        if (i < 1) {
            $('#searchNumberForm').find("#paginate").val(1)
        } else {
            $('#searchNumberForm').find("#paginate").val(i)
        }

        var mood = $('#searchNumberForm').find('#Button').val()
        if (mood == 'sort') {
            $('#searchNumberForm').find('#Button').val("sort");
        } else {
            $('#searchNumberForm').find('#Button').val("Thesearch");

        }
        $('#searchNumberForm').prop("method", "post")

        supportNumberSearch();
    }

    function gotoSupportBackwardPage() {

        $('#searchNumberForm').find('#paginationhelper').prop('disabled', false)
        var i = $('#searchNumberForm').find("#paginate").val()
        if (i <= 1) {
            $('#searchNumberForm').find('#paginationhelper').val(1);
        } else {
            $('#searchNumberForm').find('#paginationhelper').val(--i);
        }

        var mood = $('#searchNumberForm').find('#Button').val();
        if (mood == 'sort') {
            $('#searchNumberForm').find('#Button').val('sort');
        } else {
            $('#searchNumberForm').find('#Button').val('Thesearch');
        }

        $('#searchNumberForm').find("#paginate").prop('disabled', true)
        $('#searchNumberForm').find('#paginationhelper').prop('disabled', false)
        $('#searchNumberForm').prop("method", "post")

        supportNumberSearch();
    }

    function goToSupportForwardPage() {

        $('#searchNumberForm').find('#paginationhelper').prop('disabled', false)
        var i = $('#searchNumberForm').find("#paginate").val()
        if (i < 1) {
            $('#searchNumberForm').find('#paginationhelper').val(1);
        } else {
            $('#searchNumberForm').find('#paginationhelper').val(++i);
        }

        var mood = $('#searchNumberForm').find('#Button').val();
        if (mood == 'sort') {
            $('#searchNumberForm').find('#Button').val('sort');
        } else {
            $('#searchNumberForm').find('#Button').val('Thesearch');
        }

        $('#searchNumberForm').find("#paginate").prop('disabled', true)
        $('#searchNumberForm').find('#paginationhelper').prop('disabled', false)
        $('#searchNumberForm').prop("method", "post")
        supportNumberSearch();
    }

    function dataSupportSearch() {

        if ($('#searchNumberForm').find("#paginate")) {
            $('#searchNumberForm').find("#paginate").val(1)
        }
        $('#searchNumberForm').find('#Button').val('Thesearch')
        $('#searchNumberForm').prop("method", "post")
        supportNumberSearch();
    }

    function sortingAscDscSupport(field) {
        if ($('#searchNumberForm').find("#paginate")) {
            $('#searchNumberForm').find("#paginate").val(1)
        }

        var previousSort = $('#searchNumberForm').find('#sortType').val();
        var previousField = $('#searchNumberForm').find('#sortField').val();

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

        $('#searchNumberForm').find('#sortType').val(sortOrder);
        $('#searchNumberForm').find('#sortField').val(field);
        $('#searchNumberForm').find('#Button').val('sort')
        $('#searchNumberForm').prop("method", "post")
        supportNumberSearch();
    }


    function refreshSupportData() {
        if ($('#searchNumberForm').find("#paginate")) {
            $('#searchNumberForm').find("#paginate").val(1);
        }
        $('#searchNumberForm').find('#Button').val("refresh")
        $('#searchNumberForm').prop("method", "post")
        supportNumberSearch();
    }

    // $(".number_search_modal_opener").on("click", handleNumberSearchModalOpener);
    var doc = $(document)
    doc.on("click", ".supportColumnSort", function (e) {
        e.preventDefault();
        var $field = $(this).prop("id");
        sortingAscDscSupport($field)
    })
    doc.on("click", ".refreshSupportBtn", function (e) {
        e.preventDefault();
        refreshSupportData();

    })
    doc.on("click", ".searchSupportBtn", function (e) {
        e.preventDefault();
        dataSupportSearch();
    })
    doc.on("click", ".forwardSupportPageLink", function (e) {
        e.preventDefault();
        goToSupportForwardPage();
    })
    doc.on("click", ".pageSupportLink", function (e) {
        e.preventDefault();
        goToSupportSpecificPage();
    })
    doc.on("click", ".backSupportPageLink", function (e) {
        e.preventDefault();
        gotoSupportBackwardPage();
    })
    
    $('#supportNumberSearchModal').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');

    })
    $('#supportNumberSearchModal').on('hide.bs.modal', function (e) {
        // refreshData();
        if ($("#support_number_search").hasClass("error")) {
            $("#support_number_search").removeClass("error")
        }
        $('.support_number_search_partial_html').remove();
        // $('body').removeClass('overflow_cls');
        $(".support_number_search_modal_opener").prop('disabled', false);
        //$('.modal-backdrop').remove();
    })
    $(document).on("click", ".support_number_search_show", function () {
        $("#select-support-order-detail").prop('disabled', false);
    })

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
    function supportFetchData(selected_row_id, selected_supplier_id = null, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikitaisukko) {
        if (selected_row_id && selected_row_id.length < 10) {
            var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">存在しないサポート番号です。</p>';
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
                        $(document).find('#supportNumberSearchModal').modal("hide")
                    }
                } else {
                    $(".loading").addClass('show');
                    var bango = $("input[id='userId']").val();
                    if (isBtn) {
                        $(document).find('#supportNumberSearchModal').modal("hide")
                    }
                    var supplier_id = selected_supplier_id ? selected_supplier_id : $('#supplier_db').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf').val()
                        },
                        url: '/hatchu-nyuryoku/support-order-detail-read/' + bango,
                        type: 'POST',
                        data: {
                            'bango': bango,
                            'order_id': selected_row_id,
                            'supplier_id': supplier_id
                        },
                        success: function (response) {

                            //  localStorage.removeItem('isContainDeletedRow')
                            // console.log('data');
                            // console.log(response);
                            let orderData = response.orderDetail;
                            var isEdit = $("#request").val() == '2 訂正';
                            var isCreate = $("#request").val() == "1 新規作成";
                            var isDelete = $("#request").val() == "3 削除";
                            
                            var creation_category = $("#request").val();
                            if(creation_category == 2 || creation_category == 3){
                                if(!(orderData.order_classification in ['V410', 'V440', 'V460', 'V470'])){
                                    optText = '40 外注';
                                    optValue = 'V413';
                                    $('#categorikanri').append(`<option value="${optValue}" selected>${optText}</option>`);
                                }
                                // else{
                                //     $("#categorikanri").val(orderData.order_classification);
                                // }
                            }

                            var errorClassHas = $(document).find(".error");
                            if (errorClassHas) {
                                $("#error_data").empty();
                                errorClassHas.removeClass("error")
                            }
                            
                            if (!$('#' + targetId).is(":button") && $("#support_number_search").hasClass("error")) {
                                $("#support_number_search").removeClass("error");
                                // zalert("work1");
                            }
                            const hasOrder = Boolean(response.hasOrder)

                            if (hasOrder) {
                                var voucherCreationFlag = orderData['hikiatesyukkodatachar04'];
                                var stamping_phrase = orderData['hikiatesyukkodatachar01'];
                                var editCondition = voucherCreationFlag + '' + stamping_phrase;
                                var editWhen = ['22', '23', '12', '13'];
                                for (let [key, value] of Object.entries(orderData)) {
                                    if (value != null && key != "order_classification") {
                                        $('#' + key).val(value);
                                    }
                                }
                                // var dateids = {
                                //     'datepicker1_oen': 'datepicker1_comShow',
                                //     'datepicker2_oen': 'datepicker2_comShow',
                                //     'datepicker3_oen': 'datepicker3_comShow',
                                //     'datepicker4_oen': 'datepicker4_comShow',
                                //     'datepicker5_oen': 'datepicker5_comShow',
                                // }
                                // for (const key in dateids) {
                                //     if (orderData[key]) {
                                //         var res = orderData[key];
                                //         var hidden_field = dateids[key];
                                //         $("#" + hidden_field).datepicker('setDate', res);
                                //         $("#" + hidden_field).datepicker('hide');
                                //         $('#' + key).val(res)
                                //     }
                                // }
                                // if (orderData['orderentry_datepicker1']) {
                                //     $("input[name='order_entry_date']").val(orderData['orderentry_datepicker1']);
                                // }
                                if (orderData['reg_sold_to']) {
                                    var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search", ".open_support_number_search", ".support_number_search"];
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
                                }
                                if (orderData['supplier_db'] && orderData['supplier_v2']) {
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
                                    $(".order_entry_topcontent").find("input[name=number_search]").val('');
                                    $(".order_entry_topcontent").find("input[name=support_number_search]").val(orderData['number_search']);
                                }
                                if (orderData['order_number'] && isCreate) {
                                    $(".order_entry_topcontent").find("input[name=order_number]").val('');
                                }
                                // if (orderData['customfile'] && !isCreate) {
                                //     $('.custom-file-label').text(orderData['custom_file_short']);
                                //     $("input[name='purchase_order_file_name']").val(orderData['customfile'])
                                // }
                                // if (!orderData['customfile']) {
                                //     $('.custom-file-label').text('注文書PDFアップロード');
                                //     $("input[name='purchase_order_file_name']").val('')
                                // }
                                // $('#sales_amount_total').text('¥ ' + numberFormat(orderData['total_sales']));
                                // $('#totalTax').text('¥ ' + numberFormat(orderData['total_tax']));
                                // $("input[name='totalTax']").val(orderData['total_tax']);
                                // $("input[name='sales_amount_total']").val(orderData['total_sales']);
                                // $("input[name='date0016']").val(orderData['date0016']);
                                if (orderData['employee_name']) {
                                    $("select[name='tantou']").val(orderData['employee_name']).change();
                                }
                                if (orderData['payment_criteria']) {
                                    $("select[name='payment_criteria']").val(orderData['payment_criteria']).change();
                                }
                                // if (orderData['hacchu_bikou1'] && !isCreate) {
                                //     $("input[name='hacchu_bikou1']").val(orderData['hacchu_bikou1'])
                                // }
                                // if (orderData['hacchu_bikou2'] && !isCreate) {
                                //     $("input[name='hacchu_bikou2']").val(orderData['hacchu_bikou2'])
                                // }
                                // if (orderData['hacchu_bikou3'] && !isCreate) {
                                //     $("input[name='hacchu_bikou3']").val(orderData['hacchu_bikou3'])
                                // }
                                // if (orderData['siiresakimitumori'] && !isCreate) {
                                //     $("input[name='siiresakimitumori']").val(orderData['siiresakimitumori'])
                                // }
                                // if (orderData['checkbox'] == 1  && !isCreate) {
                                //     $("input[name='saisyukokyaku_checkbox']").val(orderData['checkbox']);
                                //     $("input[name='saisyukokyaku_checkbox']").prop('checked', true)
                                // }
                                // if (orderData['datatxt0150'] == 1  && !isCreate) {
                                //     $("input[name='datatxt0150']").val(orderData['datatxt0150']);
                                // }
                                                              
                                if (orderData['supplier_db'] && orderData['supplier_v2']) {
                                    loadTransactionData(orderData['supplier_db'], 'transactionData')
                                }
                                
                                if ($(".line-form")) {
                                    $(".line-form").remove()
                                }
                                //alert("ok");
                                var htmlResponse = orderData ? response.html : '';
                                $("#products_button").before(htmlResponse);
                                $("#formSubmitButton").val('edit');
                                
                                //Calculating 304 field Value
                                var {total_sales_amount, totalTax} = CalculatePriceForTotalSales();
                                $('#totalTax').text('¥ ' + numberFormat(totalTax));
                                $("input[name='totalTax']").val(totalTax)

                                $('#sales_amount_total').text('¥ ' + numberFormat(total_sales_amount));
                                // var total = searchNumberFormat(total_sales_amount);
                                $("input[name='sales_amount_total']").val(total_sales_amount) 
                                setRateAndRoundWhenDeliveryDestination();                             
                            } else {
                                var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">存在しないサポート番号です。</p>';
                                $(document).find("#error_data").html(errorHtml);
                                $(this).addClass("error")
                                $("input[type=text][name != support_number_search] ").each(function () {
                                    $(this).val('')
                                })
                                $("#sales_amount_total").text('¥')
                                $("#totalTax").text('¥')

                                // $("select").each(function () {
                                //     $(this).prop("selectedIndex", 0)
                                // })
                                if ($(".line-form")) {
                                    $(".line-form").not(":first").remove()
                                }

                                $(".price").text("")
                                $(".grossProfit").text("")
                                if (!$('#' + targetId).is(":button")) {
                                    $("#support_number_search").addClass("error")
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
                                $("#support_number_search").focus();
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

    function readSupportOrderDetail() {
        var source = $("input[id=source]").val()
        var targetId = $(this).prop("id");
        var selected_row_id;
        var categorikanriIs10 = $("#categorikanri").val() == 'U110' ? true : false
        var requestVal = $("#request").val() == "1 新規作成" ? true : false
        var isBtn = $(this).is(":button");
        if ($(this).is(":button")) {
            var isContainDeletedRow = $('#order_show_table tr.add_border').find('.contain_deleted_item').val();
            var selected_supplier_id = $('#order_show_table tr.add_border').find('.supplier_id').val();
            // selected_row_id = $('#order_show_table tr.add_border').attr('id')
            selected_row_id = $('#order_show_table tr.add_border').find('.search_support_number').val();
            supportFetchData(selected_row_id, selected_supplier_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1)
        } else {
            selected_row_id = $(this).val();
            var bango = $("input[id='userId']").val();
            if (selected_row_id.length == 13) {
                $.ajax({
                    url: '/hatchu-nyuryoku/check-number-search-status/' + bango + '/' + selected_row_id,
                    type: 'GET',
                    success: function ({ checkStatus}) {
                        // var isContainDeletedRow = delStatus;
                        console.log(checkStatus);
                        if(checkStatus){
                            supportFetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1);
                        }
                        // console.log(isContainDeletedRow);
                        // $("#_hikitasukko_val").val(hikiatesyukko)
                        else{
                            var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 存在しないサポート番号です。</p></div>';
                            // var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">検索結果に該当するデータがありません</p>';
                            var errorData = $(document).find("#error_data")
                            if (errorData) {
                                errorData.html(html);
                                $(this).addClass("error")
                            }
                            $(document).find("#error_data").html(html);
                            $("#support_number_search").addClass("error")
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
    $(document).on("click", "#select-support-order-detail", readSupportOrderDetail)
    $(document).on("keyup", "#support_number_search", _.debounce(readSupportOrderDetail, 500))
})







