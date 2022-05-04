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
    var bango = $("input[id='userId']").val();
    var data101 = $('#categorikanri option:selected').text();
    var data102 = $('#request option:selected').text();
    var category_kanri_def = $('#categorikanri option:selected').val();
    var request_def = $('#request option:selected').val();
    $.ajax({
        url: '/purchase-input/open-number-search-modal/' + bango,
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
        var bango = $("input[id='userId']").val();
        $.ajax({
            type: "POST",
            data: $('#numberForm').serialize(),
            url: "/purchase-input/handel-number-search/" + bango,
            success: function (response) {
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
        if ($("#number_search").hasClass("error")) {
            $("#number_search").removeClass("error")
        }
        $('.number_search_partial_html').remove();
        $(".number_search_modal_opener").prop('disabled', false);
    })
    $(document).on("click", ".number_search_show", function () {
        $("#select-order-detail").prop('disabled', false);
    })

    function fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, hikitaisukko) {
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
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf').val()
                        },
                        url: '/purchase-input/order-detail-read/' + bango,
                        type: 'POST',
                        data: {
                            'bango': bango,
                            'order_id': selected_row_id
                        },
                        success: function (response) {

                            //  localStorage.removeItem('isContainDeletedRow')
                            let orderData = response.orderDetail;
                            let errorMessage = response.errorMessage.length > 0 ? response.errorMessage : null;
                            var isEdit = $("#request").val() == '2';
                            var isCreate = $("#request").val() == "1";
                            var isDelete = $("#request").val() == "3";
                            console.log(isCreate, isDelete, isEdit);
                            $('#registrationButton').prop('disabled', false);
                            var creation_category = $("#request").val();
                            if(creation_category == 2 || creation_category == 3){
                                // console.log(orderData)
                                $("#categorikanri").val(orderData.order_classification);
                            }
                            var errorClassHas = $(document).find(".error");
                            if (errorClassHas) {
                                $("#error_data").empty();
                                errorClassHas.removeClass("error")
                            }
                            
                            if (!$('#' + targetId).is(":button") && $("#number_search").hasClass("error")) {
                                $("#number_search").removeClass("error")
                            }
                            if(errorMessage && !isCreate){
                                html = '<div style="margin-top: 8px;margin-left:-8px!important;">';
                                if (errorMessage) {
                                    for (var count = 0; count < errorMessage.length; count++) {
                                        var error_message = errorMessage[count];
                                        // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                                        html += '<p>' + error_message + '</p>';
                                    }
                                }
                                html += '</div>';
                                $('#error_data').html(html);
                                $("#error_data").show();
                                $("#number_search").addClass("error")
                                $('#registrationButton').prop('disabled', true);
                            }
                            const hasOrder = Boolean(response.hasOrder)

                            if (hasOrder) {
                                if (isCreate) {
                                    var elements = ["purchase_date", "purchase_number", "delivery_note", "delivery_date","inspector","instructor"]
                                    for (let [key, value] of Object.entries(orderData)) {
                                        if (value != null && !elements.includes(key)) {
                                            $("input[name="+ key+"]").val(value);
                                        }
                                    }
                                }else {
                                    for (let [key, value] of Object.entries(orderData)) {
                                        if (value != null) {
                                            $("input[name="+ key+"]").val(value);
                                        }
                                    }
                                }
                                
                                if (isCreate) {
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
                                }
                                if (isEdit ) {
                                    var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search", "#payment_method"];
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
                                if (orderData['instructor'] && !isCreate) {
                                    var name = orderData['instructor'].replaceAll(' ', '');
                                    $("#instructorShow").val(name.substr(0, 3));
                                }
                                if (orderData['inspector'] && !isCreate) {
                                    var name = orderData['inspector'].replaceAll(' ', '');
                                    $("#inspectorShow").val(name.substr(0, 3));
                                }
                                $("input[name='datanum0013']").val(orderData['datanum0013']);
                                if (orderData['employee_name']) {
                                    $("select[name='tantou']").val(orderData['employee_name']).change();
                                }
                                if (orderData['supplier_db']) {
                                    $("#supplier_v2").val(orderData['supplier']);
                                    $("#supplier_db").val(orderData['supplier_db']);
                                    supplierWisePaymentDate(false);
                                }
                                if(orderData["purchase_date"] && !isCreate){
                                    $("#datepicker1_oen").val(orderData["purchase_date"]);
                                }
                                // else{
                                //     $("#datepicker1_oen").val(null);
                                // }
                                if(orderData["payment_date"] && !isCreate){
                                    $("#datepicker2_oen").val(orderData["payment_date"]);
                                }else{
                                    $("#datepicker2_oen").val(null);
                                }
                                // $('#sales_amount_total').text('¥ ' + numberFormat(orderData['money10']));
                                // $('#gross_profit_margin').text('¥ ' + numberFormat(orderData['moneymax']))

                                if ($(".mainContentPart2")) {
                                    $(".mainContentPart2").remove()
                                }
                                var htmlResponse = orderData ? response.html : '';
                                $("#insertMainData").before(htmlResponse);
                                $("#formSubmitButton").val('edit');
                                if (isDelete ) {
                                    var elements = ["#categorikanri", "#request", "#number_search", ".open_number_search", "#payment_method", "#employee_id",
                                        "#datepicker1_oen", "#delivery_note", ".sold_to_modal_opener", "#datepicker3", "#datepicker2_oen", "#inspectorButton",
                                        ".deleteBtn", ".lineBtn", ".orderNumber",".productNumber", ".productName", ".productQuantity", ".productUnitPrice", 
                                        ".productAmount", ".productTax", ".taxation", ".accountingSubject", ".accountingItems", ".detailedRemarks",
                                        ".orderNumberModalOpener", ".productNumberModalOpener"];
                                    elements.forEach((el) => {
                                        var element = $(el);
                                        var type = element.prop('localName')
                                        console.log(element, type)
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
                                    // var domElements = ['delBtn', 'lineBtn', 'lineValue', 'orderNumber','productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'productTax', 'taxation',
                                    // 'accountingSubject','accountingItems','tableContractor', 'detailedRemarks']
                                    // $(".line-form").each(function(){
                                    //     var id = $(this).attr("id");
                                    //     domElements.forEach(function (item) {
                                    //         var targetElm = $('#'+id).find("." + item);
                                    //         targetElm.prop("disabled", true);
                                    //     })
                                    // })
                                }
                                if (orderData['comments']) {
                                    $("#comments").val(orderData['comments']);
                                }
                                calculatePriceInLine();
                                if(errorMessage && !isCreate){
                                    // $(".open_number_search").prop('readonly', false);
                                    // $('#number_search').prop('disabled', false);   
                                    $('#registrationButton').prop('disabled', true);
                                }
                            } else {
                                var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">検索結果に該当するデータがありません</p>';
                                $(document).find("#error_data").html(errorHtml);
                                $(this).addClass("error")
                                $("input[type=text][name != number_search] ").each(function () {
                                    $(this).val('')
                                })                               
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
                fetchData(selected_row_id, categorikanriIs10, requestVal, isBtn, source, targetId, isContainDeletedRow, 1);
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







