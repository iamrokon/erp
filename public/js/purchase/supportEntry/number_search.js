//reset file input
$(document).on('click', "#fileUploadClose", function (e) {
    e.preventDefault()
    var labelName = '提案書アップロード';
    var targetParent = $(this).parents('.custom-select-file-upload');
    var fileLabel = targetParent.find('.custom-file-label');
    if (fileLabel.text() != labelName) {
        fileLabel.text(labelName)
        targetParent.find('.custom-file-input').val('')
        //targetParent.find("input[name='purchase_order_file_name']").val('')
        $("#hidden_filename").val("");
        $("#temp_filename").val("");
    }
})

// $(".custom-file-input").on("change", function () {
//         var fileName2 = $(this).val().split("\\").pop();
//         var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
//         if (extension == "xlsx" || extension == 'pdf' || extension == 'zip') {
//             $(this).siblings(".custom-file-label").addClass("selected").html(fileName2);
//             $("input[name=purchase_order_file_name]").val(fileName2);
//         } else {
//             $(this).siblings(".custom-file-label").addClass("selected").html("提案書アップロード");
//             $("input[name=purchase_order_file_name]").val("");
//             $('#proposal_file').val("");
//         }

// });


$(".custom-file-input").on("change", function (e) {
        var fileName2 = $(this).val().split("\\").pop();
        var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
        let fileName = e.target.files[0].name;
        let fileExtension = $(this).val().split(".").pop().toLowerCase();
        if (fileExtension == 'pdf' || fileExtension == 'zip') {
            if(fileName.length >= 15){
              let slicedFileName = fileName.slice(0, 10);
              let updatedFileName = slicedFileName + "..." + fileExtension;
              $(this).siblings(".custom-file-label").addClass("selected").html(updatedFileName);
              $("input[name=purchase_order_file_name]").val(fileName2);
            }
            else if(fileName.length <= 14){
              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              $("input[name=purchase_order_file_name]").val(fileName2);
            }
        } else {
            $(this).siblings(".custom-file-label").addClass("selected").html("提案書アップロード");
            $("input[name=purchase_order_file_name]").val("");
            $('#proposal_file').val("");
        }

});


// $(".custom-file-input").on("change", function (e) {
//       let oldFileName = $(this).val();
//       // let fileName = $(this).val().split("\\").pop();
//       let fileName = e.target.files[0].name;
//       let fileExtension = $(this).val().split(".").pop().toLowerCase();
//       if(fileExtension == "pdf" || fileExtension == "zip"){
//         if(fileName.length >= 15){
//           let slicedFileName = fileName.slice(0, 10);
//           let updatedFileName = slicedFileName + "..." + fileExtension;
//           $(this).siblings(".custom-file-label").addClass("selected").html(updatedFileName);
//         }
//         else if(fileName.length <= 14){
//           $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
//         }
//       }
//       else{
//         $("#fileExtensionConfirmationModal").modal('show');
//       }
// });

$("#proposal_file").change(function () {
    readURL($('#proposal_file').val());
});



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

function handleNumberSearchModalOpener102ChildScreen(targetId) {
    var bango = $("input[id='userId']").val();
    var syouhinbango_jouhou = $('#syouhinbango_jouhou option:selected').val();

    $.ajax({
        url: '/support-entry/open-number-search-modal/' + bango,
        type: 'POST',
        data: {
            'bango': bango,
            'syouhinbango_jouhou': syouhinbango_jouhou,
            "_token": $('#csrf').val()
        },
        success: function (response) {
            var targetEl = $('#insert_partial_modal')
            var prevEl = targetEl.prevAll();
            if (prevEl) {
                prevEl.remove()
            }
            targetEl.before(response.html);
            localStorage.setItem("numberTargetId", targetId)

            // Enable, disabled the 101 radio button
            if(syouhinbango_jouhou == 1){
                $("#customRadio_creation_category_1").prop('disabled', false)
                $("#customRadio_creation_category_1").attr("checked", true);
                $("#customRadio_creation_category_2_3").prop('disabled', true)
            }else{
                if(syouhinbango_jouhou == 2 || syouhinbango_jouhou == 3){
                    $("#customRadio_creation_category_2_3").prop('disabled', false)
                    $("#customRadio_creation_category_2_3").attr("checked", true);
                    $("#customRadio_creation_category_1").prop('disabled', true)
                }
            }

            $("#syouhinbango_jouhou").val(syouhinbango_jouhou);
            $("#select-order-detail").prop('disabled', true)
            $('#numberSearchModal').modal("show");
        }
    })
}


function handleNumberSearchModalOpener102ChildScreen_2021002(targetId) {
    $(this).prop('disabled', true)
    var bango = $("input[id='userId']").val();
    var data101 = $('#categorikanri option:selected').text();
    var data102 = $('#request option:selected').text();
    var category_kanri_def = $('#categorikanri option:selected').val();
    var request_def = $('#request option:selected').val();
    $.ajax({
        url: '/support-entry/open-number-search-modal/' + bango,
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


function handleNumberSearchModalOpener102ChildScreen_temp(targetId) {
    console.log("target id: "+ targetId);
    $(this).prop('disabled', true)
    var bango = $("input[id='userId']").val();
    var data101 = $('#request option:selected').text();
    var request_def = $('#request option:selected').val();

    $.ajax({
        url: '/support-entry/open-number-search-modal/' + bango,
        type: 'POST',
        data: {
            'bango': bango,
            'data101': data101,
            "_token": $('#csrf').val(),
            request_def
        },
        success: function (response) {
            console.log(response);
            var targetEl = $('#insert_partial_modal')
            var prevEl = targetEl.prevAll();
            if (prevEl) {
                prevEl.remove()
            }
            targetEl.before(response.html);
            localStorage.setItem("numberTargetId", targetId)
            $("#select-order-detail").prop('disabled', true)
            //$("#request_def").val(request_def)
            //$("#category_kanri_def").val(category_kanri_def)
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
        var syouhinbango_jouhou = $('#syouhinbango_jouhou option:selected').val();
        $.ajax({
            type: "POST",
            data: $('#numberForm').serialize(),
            url: "/support-entry/handel-number-search/" + bango,
            success: function (response) {
                $('.number_search_partial_html').remove();
                $('#insert_partial_modal').before(response.html);

                // Enable, disabled the 101 radio button
                if(syouhinbango_jouhou == 1){
                    $("#customRadio_creation_category_1").prop('disabled', false)
                    $("#customRadio_creation_category_1").attr("checked", true);
                    $("#customRadio_creation_category_2_3").prop('disabled', true)
                }else{
                    if(syouhinbango_jouhou == 2 || syouhinbango_jouhou == 3){
                        $("#customRadio_creation_category_2_3").prop('disabled', false)
                        $("#customRadio_creation_category_2_3").attr("checked", true);
                        $("#customRadio_creation_category_1").prop('disabled', true)
                    }
                }

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


    function fetchData(order_number, isBtn, source, targetId, syouhinbango_jouhou){
        if (order_number && isBtn && source && targetId && syouhinbango_jouhou && order_number.length >= 10) {
            var bango = $("input[id='userId']").val();

            // Showing the loading modal
            $(".loading").addClass('show');

            // Hide the number search modal
            if (isBtn) {
                $(document).find('#numberSearchModal').modal("hide")
            }
            $.ajax({
                url: '/support-entry/order_detail_read/' + bango,
                type: 'POST',
                data: {
                    'bango': bango,
                    'order_number': order_number,
                    'syouhinbango_jouhou': syouhinbango_jouhou,
                    "_token": $('#csrf').val()
                },

                success: function (response) {
                    $(".loading").removeClass('show');
                    let supportData = response.supportDetail;
                    if(supportData != ''){
                        //enable submit button

                        $('#supportEntrySubmitBtn').prop("disabled", false);
                        $('.open_number_search').prop("disabled", true);
                        if($("#number_search").hasClass("error")){
                            $("#number_search").removeClass("error");
                        }

                         // hidden field filled
                            $("#tuhanorder_otodoketime_ju0029").val(supportData.tuhanorder_otodoketime_ju0029);
                            $("#tuhanorder_information1").val(supportData.information1);
                            $("#tuhanorder_information2").val(supportData.information2);
                            $("#tuhanorder_information3").val(supportData.information3);
                            $("#datachar05_ju0008").val(supportData.datachar05_ju0008);
                            $("#tuhanorder_juchukubun1_orders_subject").val(supportData.tuhanorder_juchukubun1_orders_subject);
                            // use in update time
                            $("#hidden_lbook_kokyakuorderbango").val(supportData.lbook_kokyakuorderbango);
                            $("#hidden_orderhenkan_date0016").val(supportData.orderhenkan_date0016);

                       // syouhinbango_jouhou = 2;
                        if(syouhinbango_jouhou == 1){
                            // 101
                            // creation category
                            $('#syouhinbango_jouhou').attr("style", "pointer-events: none; background-color: #efefef !important");


                            // 102
                            $("#number_search").val(supportData.order_number);
                            $('#number_search').prop('readonly', true)
                            $('#number_search').attr("style", "pointer-events: none;");


                            // 103 blank

                            // 104
                            $("#order_number").val(supportData.order_number);

                            //105
                            $("#contractor").val(supportData.sold_to);
                            $("#orderhenkan_datachar10_information1").val(supportData.information1);

                            // 106
                            $("#end_customer").val(supportData.end_customer);
                             $("#orderhenkan_datachar10_information3").val(supportData.information3);

                            // 107
                            // order date
                            $("#datepicker1_oen").val(supportData.intorder01);
                            $('#datepicker1_oen').prop('readonly', true)
                            $('#datepicker1_oen').attr("style", "pointer-events: none;");

                            // 108
                            // delivery date
                            $("#datepicker2_oen").val(supportData.intorder02);
                            $('#datepicker2_oen').prop('readonly', true)
                            $('#datepicker2_oen').attr("style", "pointer-events: none;");

                            // 109
                            // acceptance date
                            $("#datepicker3_oen").val(supportData.intorder04);
                            $('#datepicker3_oen').prop('readonly', true)
                            $('#datepicker3_oen').attr("style", "pointer-events: none;");

                            // 110
                            // sales date
                            $("#datepicker4_oen").val(supportData.intorder03);
                            $('#datepicker4_oen').prop('readonly', true)
                            $('#datepicker4_oen').attr("style", "pointer-events: none;");

                            // 111
                            // payment date
                            $("#datepicker5_oen").val(supportData.intorder05);
                            $('#datepicker5_oen').prop('readonly', true)
                            $('#datepicker5_oen').attr("style", "pointer-events: none;");   

                            // 121
                            // profit meter -> orders
                            $('#se_profit_meter').text('¥ ' + numberFormat(supportData.orders))
                            $('#hidden_se_profit_meter').val(supportData.orders)

                            // body part
                            // 202A
                            // support delivery date
                            $("#datepicker11_oen").val(supportData.intorder02);

                            // 203
                            // consultation se
                            $("#consultation_person_name").val(supportData.person_name);

                            // 206
                            // juchukubun1 -> order subject
                            $("#juchukubun1_business_name").val(supportData.juchukubun1);

                            // 208
                            // in house remarks
                            $("#information7_in_house_remarks").val(supportData.information7);

                            // 209
                            $("#order_shipping_remarks_209").val(supportData.datachar07);

                            // 214
                            $("#chumonsyajouhou_214").val(supportData.chumonsyajouhou);

                            // 216
                            $("#datatxt0004_216").val(supportData.datatxt0004);

                            
                            // 301
                            $('#registrationButton').prop('disabled', false)

                            
                            // hide the error
                            $("#error_data").hide();
                        }else{
                            if(syouhinbango_jouhou == 2){

                                $('#number_search').prop('readonly', true)
                                $('#number_search').attr("style", "pointer-events: none;");

                                // hidden fillable
                                $("#orderhenkan_ordertypebango2_maxval").val(supportData.orderhenkan_ordertypebango2_maxval);
                                $("#orderhenkan_bango").val(supportData.orderhenkan_bango);
                                $("#orderhenkan_datachar10_information1").val(supportData.information1);
                                $("#orderhenkan_datachar10_information3").val(supportData.information3);
/*
                                if(supportData.lbook_file){
                                    $("#lbook_file_input").val(supportData.lbook_file);

                                    // var fileName2 = supportData.lbook_file.split("\\").pop();
                                    // var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
                                    $(".custom-file-input").siblings(".custom-file-label").addClass("selected").html(supportData.lbook_file);
                                    $("input[name=proposal_file]").val(supportData.lbook_file);
                                }*/


                                if(supportData.lbook_file){
                                    $("#lbook_file_input").val(supportData.lbook_file);

                                    // var fileName2 = supportData.lbook_file.split("\\").pop();
                                    // var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
                                    $(".custom-file-input").siblings(".custom-file-label").addClass("selected").html(supportData.lbook_file_short);
                                    // $("input[name=proposal_file]").val(supportData.lbook_file);
                                }
                              
                                
                                // 101
                                // creation category
                                $('#syouhinbango_jouhou').attr("style", "pointer-events: none; background-color: #efefef !important");


                                // 102
                                $("#number_search").val(supportData.order_number);

                                // 103
                                 $("#support_number").val(supportData.order_number);

                                // 104
                                $("#order_number").val(supportData.orderuserbango);

                                //105
                                $("#contractor").val(supportData.sold_to);

                                // 106
                                $("#end_customer").val(supportData.end_customer);

                                // 107
                                // order date
                                $("#datepicker1_oen").val(supportData.intorder01);
                                $('#datepicker1_oen').prop('readonly', true)
                                $('#datepicker1_oen').attr("style", "pointer-events: none;");

                                // 108
                                // delivery date
                                $("#datepicker2_oen").val(supportData.intorder02);
                                $('#datepicker2_oen').prop('readonly', true)
                                $('#datepicker2_oen').attr("style", "pointer-events: none;");

                                // 109
                                // acceptance date
                                $("#datepicker3_oen").val(supportData.intorder04);
                                $('#datepicker3_oen').prop('readonly', true)
                                $('#datepicker3_oen').attr("style", "pointer-events: none;");

                                // 110
                                // sales date
                                $("#datepicker4_oen").val(supportData.intorder03);
                                $('#datepicker4_oen').prop('readonly', true)
                                $('#datepicker4_oen').attr("style", "pointer-events: none;");

                                // 111
                                // payment date
                                $("#datepicker5_oen").val(supportData.intorder05);
                                $('#datepicker5_oen').prop('readonly', true)
                                $('#datepicker5_oen').attr("style", "pointer-events: none;");   

                                // 121
                                // profit meter -> orders
                                $('#se_profit_meter').text('¥ ' + numberFormat(supportData.orders))
                                $('#hidden_se_profit_meter').val(supportData.orders)

                                // body part

                                // 201
                                $("#datepicker6_oen").val(supportData.deletedate);
                                // 202
                                $("#datepicker7_oen").val(supportData.date0012);

                                // 202A
                                // support delivery date
                                $("#datepicker11_oen").val(supportData.date0020);

                                // 203
                                // consultation se
                                $("#consultation_person_name").val(supportData.person_name);


                                // 204
                                $("#include_place").val(supportData.include_place);

                                 // 205
                                $("#model_name").val(supportData.model_name);

                                // 206
                                // juchukubun1 -> order subject
                                $("#juchukubun1_business_name").val(supportData.juchukubun1);

                                // 207
                                $("#os").val(supportData.os);

                                // 208
                                // in house remarks
                                $("#information7_in_house_remarks").val(supportData.datachar11);

                                // 209
                                $("#order_shipping_remarks_209").val(supportData.datachar09);

                                // 210
                                $("#order_summary_remarks").val(supportData.datatxt0147);
                                
                                // 211
                                $("#datepicker8_oen").val(supportData.date0013);

                                // 212
                                $("#datepicker9_oen").val(supportData.date0014);

                                // 213
                                $("#datepicker10_oen").val(supportData.date0015);

                                // 214
                                $("#chumonsyajouhou_214").val(supportData.chumonsyajouhou);

                                // 215
                                $("#acceptance_condition").val(supportData.datatxt0148);


                                // 216
                                $("#datatxt0004_216").val(supportData.datatxt0149);

                                 // 217
                             //   $("#proposal_file").val(supportData.datatxt0150);

                                
                                // 301
                                $('#registrationButton').prop('disabled', false)

                                
                                // hide the error
                                $("#error_data").hide();
                            }else{
                                if(syouhinbango_jouhou == 3){
                                    $('#number_search').prop('readonly', true)
                                    $('#number_search').attr("style", "pointer-events: none;");

                                    // hidden fillable
                                    $("#orderhenkan_ordertypebango2_maxval").val(supportData.orderhenkan_ordertypebango2_maxval);
                                    $("#orderhenkan_bango").val(supportData.orderhenkan_bango);
                                    $("#orderhenkan_datachar10_information1").val(supportData.information1);
                                    $("#orderhenkan_datachar10_information3").val(supportData.information3);

                                    if(supportData.lbook_file){
                                        $("#lbook_file_input").val(supportData.lbook_file);

                                        // var fileName2 = supportData.lbook_file.split("\\").pop();
                                        // var extension = fileName2.substr((fileName2.lastIndexOf('.') + 1));
                                        $(".custom-file-input").siblings(".custom-file-label").addClass("selected").html(supportData.lbook_file_short);
                                       // $("input[name=proposal_file]").val(supportData.lbook_file);
                                    }
                                  
                                    
                                    // 101
                                    // creation category
                                    $('#syouhinbango_jouhou').attr("style", "pointer-events: none; background-color: #efefef !important");


                                    // 102
                                    $("#number_search").val(supportData.order_number);

                                    // 103
                                     $("#support_number").val(supportData.order_number);

                                    // 104
                                    $("#order_number").val(supportData.orderuserbango);

                                    //105
                                    $("#contractor").val(supportData.sold_to);

                                    // 106
                                    $("#end_customer").val(supportData.end_customer);

                                    // 107
                                    // order date
                                    $("#datepicker1_oen").val(supportData.intorder01);
                                    $('#datepicker1_oen').prop('readonly', true)
                                    $('#datepicker1_oen').attr("style", "pointer-events: none;");

                                    // 108
                                    // delivery date
                                    $("#datepicker2_oen").val(supportData.intorder02);
                                    $('#datepicker2_oen').prop('readonly', true)
                                    $('#datepicker2_oen').attr("style", "pointer-events: none;");

                                    // 109
                                    // acceptance date
                                    $("#datepicker3_oen").val(supportData.intorder04);
                                    $('#datepicker3_oen').prop('readonly', true)
                                    $('#datepicker3_oen').attr("style", "pointer-events: none;");

                                    // 110
                                    // sales date
                                    $("#datepicker4_oen").val(supportData.intorder03);
                                    $('#datepicker4_oen').prop('readonly', true)
                                    $('#datepicker4_oen').attr("style", "pointer-events: none;");

                                    // 111
                                    // payment date
                                    $("#datepicker5_oen").val(supportData.intorder05);
                                    $('#datepicker5_oen').prop('readonly', true)
                                    $('#datepicker5_oen').attr("style", "pointer-events: none;");   

                                    // 121
                                    // profit meter -> orders
                                    $('#se_profit_meter').text('¥ ' + numberFormat(supportData.orders))
                                    $('#hidden_se_profit_meter').val(supportData.orders)

                                    // body part

                                    // 201
                                    $("#datepicker6_oen").val(supportData.deletedate);
                                    $('#datepicker6_oen').prop('readonly', true)
                                    // 202
                                    $("#datepicker7_oen").val(supportData.date0012);
                                    $('#datepicker7_oen').prop('readonly', true)

                                    // 202A
                                    // support delivery date
                                    $("#datepicker11_oen").val(supportData.date0020);
                                    $('#datepicker11_oen').prop('readonly', true)

                                    // 203
                                    // consultation se
                                    $("#consultation_person_name").val(supportData.person_name);
                                    $('#consultation_person_name').prop('readonly', true)

                                    // 204
                                    $("#include_place").val(supportData.include_place);
                                    $('#include_place').prop('readonly', true)

                                     // 205
                                    $("#model_name").val(supportData.model_name);
                                    $('#model_name').prop('readonly', true)

                                    // 206
                                    // juchukubun1 -> order subject
                                    $("#juchukubun1_business_name").val(supportData.juchukubun1);
                                    $('#juchukubun1_business_name').prop('readonly', true)

                                    // 207
                                    $("#os").val(supportData.os);
                                    $('#os').prop('readonly', true)

                                    // 208
                                    // in house remarks
                                    $("#information7_in_house_remarks").val(supportData.datachar11);
                                    $('#information7_in_house_remarks').prop('readonly', true)

                                    // 209
                                    $("#order_shipping_remarks_209").val(supportData.datachar09);
                                    $('#order_shipping_remarks_209').prop('readonly', true)

                                    // 210
                                    $("#order_summary_remarks").val(supportData.datatxt0147);
                                    $('#order_summary_remarks').prop('readonly', true)
                                    
                                    document.getElementById("order_summary_remarks").style.backgroundColor = "#efefef";



                                    // 211
                                    $("#datepicker8_oen").val(supportData.date0013);
                                    $('#datepicker8_oen').prop('readonly', true) 

                                    // 212
                                    $("#datepicker9_oen").val(supportData.date0014);
                                    $('#datepicker9_oen').prop('readonly', true) 

                                    // 213
                                    $("#datepicker10_oen").val(supportData.date0015);
                                    $('#datepicker10_oen').prop('readonly', true) 
                                    
                                    // 214
                                    $("#chumonsyajouhou_214").val(supportData.chumonsyajouhou);
                                    $('#chumonsyajouhou_214').attr("style", "pointer-events: none; background-color: #efefef !important");

                                    // 215
                                    $("#acceptance_condition").val(supportData.datatxt0148);
                                    $('#acceptance_condition').prop('readonly', true) 

                                    // 216
                                    $("#datatxt0004_216").val(supportData.datatxt0149);
                                    $('#datatxt0004_216').attr("style", "pointer-events: none; background-color: #efefef !important");

                                     // 217
                                  //  $("#proposal_file").val(supportData.datatxt0150);

                                    
                                    // 301
                                    $('#registrationButton').prop('disabled', false)

                                    
                                    // hide the error
                                    $("#error_data").hide();
                                }
                            }
                        }
                    }else{
                        var html = '';
                        html = '<div>';
                       // html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 該当するデータがありません。 </p>';
                       // html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 検索結果に該当するデータがありません.</p>';
                       if(syouhinbango_jouhou == 1){
                         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 指定された受注番号でのサポート入力は既に行われています。</p>';
                       }else{
                         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 該当するデータがありません </p>';                     
                       }
                         html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                        $('#supportEntrySubmitBtn').prop("disabled", true);

                       // console.log("There is no corresponding data.");

                        if(!$("#number_search").hasClass("error")){
                            $("#number_search").addClass("error");
                        }
                    }
                }
            });
        }
    }

    function readOrderDetailSupportEntryForEdit(syouhinbango_jouhou, source, targetId, isBtn){
        if ((syouhinbango_jouhou == 2 || syouhinbango_jouhou == 3) && source && targetId && isBtn) {
            var isContainDeletedRow = $('#order_show_table tr.add_border').find('.contain_deleted_item').val();
            selected_row_id = $('#order_show_table tr.add_border').attr('id')
            order_number = selected_row_id
            var bango = $("input[id='userId']").val();
            // Checking the order number 
             if (selected_row_id.length >= 10) {
                $('.delete_data_contain').html("");
                fetchData(order_number, isBtn, source, targetId, syouhinbango_jouhou);
            }
        }
    }

    function readOrderDetail() {
        var syouhinbango_jouhou = $('#syouhinbango_jouhou option:selected').val();
        var source = $("input[id=source]").val()
        var targetId = $(this).prop("id");
        var isBtn = $(this).is(":button");
       if(syouhinbango_jouhou == 2 || syouhinbango_jouhou == 3){
            if ($(this).is(":button")) {
                readOrderDetailSupportEntryForEdit(syouhinbango_jouhou, source, targetId, isBtn);
            }else{
                var bango = $("input[id='userId']").val();
                var order_number = $("input[id='number_search']").val();
                var isBtn = true;
                var source = "supportEntry";
                var targetId = "select-order-detail";
                var syouhinbango_jouhou = $('#syouhinbango_jouhou option:selected').val();
                fetchData(order_number, isBtn, source, targetId, syouhinbango_jouhou);
            }
       }else{
        if(syouhinbango_jouhou == 1){
             if ($(this).is(":button")) {
                var isContainDeletedRow = $('#order_show_table tr.add_border').find('.contain_deleted_item').val();
                selected_row_id = $('#order_show_table tr.add_border').attr('id')
                order_number = selected_row_id
                var bango = $("input[id='userId']").val();
                // Checking the order number 
                 if (selected_row_id.length == 10) {
                    $.ajax({
                        url: '/support-entry/check-order-number-exist/' + bango + '/' + selected_row_id,
                        type: 'GET',
                        success: function (response) {
                            if(response.duplicate_data_status == false){
                                $('.delete_data_contain').html("");
                                console.log(order_number, isBtn, source, targetId, syouhinbango_jouhou);
                                fetchData(order_number, isBtn, source, targetId, syouhinbango_jouhou);
                            }else{
                                if(response.duplicate_data_status == true){
                                    var errorhtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + response.duplicate_error_data_message + '</p>';
                                    $('.delete_data_contain').html(errorhtml);
                                }
                            }
                        }
                    })
                }
            }else{
                var bango = $("input[id='userId']").val();
                var order_number = $("input[id='number_search']").val();
                var isBtn = true;
                var source = "supportEntry";
                var targetId = "select-order-detail";
                var syouhinbango_jouhou = $('#syouhinbango_jouhou option:selected').val();
                
                if(order_number.length == 10){
                    $.ajax({
                        url: '/support-entry/check-order-number-exist/' + bango + '/' + order_number,
                        type: 'GET',
                        success: function (response) {
                            if(response.duplicate_data_status == false){
                                $('.delete_data_contain').html("");
                                fetchData(order_number, isBtn, source, targetId, syouhinbango_jouhou);
                            }else{
                                if(response.duplicate_data_status == true){
                                    // var errorhtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + response.duplicate_error_data_message + '</p>';
                                    // $('.delete_data_contain').html(errorhtml);

                                    var html = '';
                                    html = '<div>';
                                   // html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+response.duplicate_error_data_message+'</p>';
                                    html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;"> 該当するデータがありません </p>';
                                    html += '</div>';
                                    $('#error_data').html(html);
                                    $("#error_data").show();
                                    $('#supportEntrySubmitBtn').prop("disabled", true);


                                }
                            }
                        }
                    })
                }
            }
         }
       }
    }


    // added for numberFormat
    function numberFormat(num) {
        if (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }
        return 0;
    }

    $(document).on("click", "#select-order-detail", readOrderDetail)
  //  $(document).on("keyup", "#number_search", readOrderDetail)
  //  $(document).on("keyup", "#number_search", debounce(readOrderDetail, 500))

    function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }


        // Example usage:

        $('#number_search').keyup(delay(function (e) {
          readOrderDetail();
        }, 300));


})







