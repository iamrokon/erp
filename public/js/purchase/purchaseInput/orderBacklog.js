function addOrderDeatailsFromOrderBackLogTable(orderData, currentRow, exctime){
    var confirmation = $("#confirmModalStatus").val();
    // console.log(confirmation)
    if(exctime < 2){
        if(confirmation == '1'){
            $("#confirmModalStatus").val(0); 
            // console.log(confirmation);
            var $element = $('#detailTable tr[id^="LineBranch"]:last');
            var lineBranchId = $element.attr('id');
            // console.log($('#'+ lineBranchId).find(".orderNumber").val());
            if($('#'+ lineBranchId).find(".orderNumber").val()){
                elementCopy();
                var $element = $('#detailTable tr[id^="LineBranch"]:last');
                var lineBranchId = $element.attr('id');
            }
            // var datalist = ["datachar07", "datachar08", "nyukosu", "genka", "syouhizeiritu", "soukobango", "datachar18", "datachar10", "datachar11", "syouhinid", "syouhinsyu"]
            if(orderData["syouhinsyu"].length ==2){
                var syouhinsyu = '0'+orderData["syouhinsyu"];
                var number = orderData["syouhinid"] +'0'+orderData["syouhinsyu"];
            }else if(orderData["syouhinsyu"].length == 1){
                var syouhinsyu = '00'+orderData["syouhinsyu"];
                var number = orderData["syouhinid"] +'00'+orderData["syouhinsyu"];
            }else{
                var syouhinsyu = orderData["syouhinsyu"];
                var number = orderData["syouhinid"] + orderData["syouhinsyu"];
            }
            $('#'+ lineBranchId).find(".orderNumber").val(number);
            $('#'+ lineBranchId).find(".productNumber").val(orderData["datachar02"]);
            $('#'+ lineBranchId).find(".productName").val(orderData["datachar08"]);
            $('#'+ lineBranchId).find(".productQuantity").val(numberFormat(orderData["nyukosu"]));
            $('#'+ lineBranchId).find(".productUnitPrice").val(numberFormat(orderData["genka"]));
            $('#'+ lineBranchId).find(".productAmount").val(numberFormat(orderData["syouhizeiritu"]));
            $('#'+ lineBranchId).find(".productTax").val(numberFormat(orderData["soukobango"]));
            if(!(orderData["datachar18"] in ['E110', 'E120', 'E130', 'E140'])){
                $('#'+ lineBranchId).find(".taxation").val('E120').change();              
            }else{
                $('#'+ lineBranchId).find(".taxation").val(orderData["datachar18"]).change();
            }
            $('#'+ lineBranchId).find(".tableContractor").text(orderData["orderhenkan_datachar10"]);
            $('#'+ lineBranchId).find(".detailedRemarks").val(orderData["datachar11"]);
            $('#'+ lineBranchId).find(".syouhinid").val(orderData["syouhinid"]);
            $('#'+ lineBranchId).find(".syouhinsyu").val(syouhinsyu);
            $("#confirmModalStatus").val(0);
            //addedRowNumberOfBacklogTable
            $('#'+ lineBranchId).find(".addedRowNumberOfBacklogTable").val(currentRow.attr("id"));
            currentRow.find(".addedRowNumberOfDetailsTable").val(lineBranchId);
            currentRow.find(".table-row-select").addClass("select-button");
            calculatePriceInLine();
            
        }
        else{
            $("#confirmation_modal").show();
            event.preventDefault();
            $("body").on("click", '#addBackLogOrderData', function (e) {
                $("#confirmModalStatus").val(1);
                $("#confirmation_modal").hide();
                exctime++;
                console.log("esctime", exctime);
                addOrderDeatailsFromOrderBackLogTable(orderData, currentRow, exctime);
            })
        }  
    }
}
function getSelectedRowsFromBacklogOrderTable(currentRow){  
     var data = {};    
    // var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
    // var col2=currentRow.find("td:eq(1)").html(); 
    // var col3=currentRow.find("td:eq(2)").html();
    // var col4=currentRow.find("td:eq(3)").html();
    // var col5=currentRow.find("td:eq(4)").html();
    // var col6=currentRow.find("td:eq(5)").html(); 
    // var col7=currentRow.find("td:eq(6)").html();
    // var col8=currentRow.find("td:eq(7)").html();
    // var col9=currentRow.find("td:eq(8)").html();
    // var data=col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col6+"\n"+col7+"\n"+col8+"\n"+col9;        
    // for (var i = 0; i<9; i++){
    //     var col=currentRow.find("td:eq(" + i + ")").html();
    //     colName = "col"+i;
    //     data[colName] = col;
    // }
    // currentRow.find(".table-row-select").css('background-color','red');
    var orderNumber=currentRow.find("td:eq(5)").html();
    var bango = $("input[id='userId']").val();
    if(orderNumber.length >=13){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "purchase-input/get-order-detail-table-data/" + bango,
            // async: false,
            data: {
                orderNumber
            },
            success: function (response) {            
                if(response.hasOrder && response.checkResult){
                    $("#confirmation_modal").find(".confirmOk").prop("id","addBackLogOrderData");
                    let orderData = response.orderDetail;
                    // addOrderDeatailsFromOrderBackLogTable(orderData, 0);
                    if((orderData.datachar01 == 'V160' && orderData.juchusyukko2_tanka == 1) || (orderData.datachar01 != 'V160' && orderData.hikiatesyukko_datachar16 == 1)){
                        console.log(response);
                        addOrderDeatailsFromOrderBackLogTable(orderData, currentRow, 0);
                    }
                    else{
                        // var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p></div>';              
                        // var errorData = $(document).find("#error_data")
                        // if (errorData) {
                        //     console.log(errorData)
                        //     errorData.html(html);
                        //     currentRow.find(".table-row-select").addClass("error")
                        // }
                        // $(document).find("#error_data").html(html);
                        // currentRow.find(".table-row-select").addClass("error")
                        $("#confirmModalStatus").val(1);
                        console.log(orderData, "val");
                        addOrderDeatailsFromOrderBackLogTable(orderData, currentRow, 1);
                    }
                }else{
                    if(response.checkResult == false){
                        var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 受注キャンセルのデータです。</p></div>';
                    }
                    else{
                        var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p></div>';
                    }                   
                    var errorData = $(document).find("#error_data")
                    if (errorData) {
                        console.log(errorData)
                        errorData.html(html);
                        currentRow.find(".table-row-select").addClass("error")
                    }
                    $(document).find("#error_data").html(html);
                    currentRow.find(".table-row-select").addClass("error")
                }
            }
        })
    }
}

function handleRequestAndSearchNumber(){
    var $el = $("#request");
    var $elVal = $el.val().toString();
    var category = $el.val();
    // console.log(category);
    if (category == '1'){
        $('.open_number_search').prop('disabled', true);
        $('.open_number_search_input').prop('disabled', true);
    }else{
        $('.open_number_search').prop('disabled', false);
        $('.open_number_search_input').prop('disabled', false);
    }
}
$(document).ready(function (){
    // $('.open_number_search').prop('disabled', true);
    // $('.open_number_search_input').prop('disabled', true);
    // $(document).on("change", "#request", handleRequestAndSearchNumber)
    $(document).on('click',"#backlogOrderTable .table-row-select",function(e){
        e.preventDefault();
        // get the current row
        var currentRow=$(this).closest("tr"); 
        console.log(currentRow);
        if(currentRow.find(".table-row-select").hasClass("select-button")){
            var elId = currentRow.find(".addedRowNumberOfDetailsTable").val();
            console.log(elId);
            var rowId = elId && elId.replace("LineBranch", "");
            // console.log(rowId);
            deleteRow(rowId);
            currentRow.find(".addedRowNumberOfDetailsTable").val(null);
            currentRow.find(".table-row-select").removeClass("select-button");
        }else{
            getSelectedRowsFromBacklogOrderTable(currentRow);
        }
    });

    $("#inspectorButton").on("click", function (e){
        e.preventDefault();
        var bango = $("input[id='userName']").val();
        if(!$("#instructor").val()){
            $("#instructor").val(bango);
            var bango1 = bango.replaceAll(' ','');
            $("#instructorShow").val(bango1.substr(0, 3));
        }
        if(!$("#inspector").val()){
            $("#inspector").val(bango);
            var bango1 = bango.replaceAll(' ','');
            $("#inspectorShow").val(bango1.substr(0, 3));
        }
    });

    $("#topSearchSubmitButton").on("click", function (e){
        e.preventDefault();
        $(".loading").addClass('show');
        var bango = $("input[id='userId']").val();
        $("input[name=type]").val("create")
        var data = new FormData(document.getElementById('insertData'));
        console.log(data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "purchase-input/get-backlog-data/" + bango,
            data: data,
            processData: false,
            contentType: false,
            success: function (result) {
                // console.log(result)
                // if ($.trim(result.status) == 'confirm') {
                //     confirmHtml = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。</p></div>'
                //     $("#error_data").empty();
                //     $("#confirmation_message").html(confirmHtml)
                //     $("#confirm_status").val(1);
                //     $('#orderEntrySubmitBtn').prop("disabled", false);
                // }
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
                if ($.trim(result.status) == 'ok') {
                    // console.log(result.html);
                    var htmlResponse = result.html;
                    if(result.hasData <= 0){   
                        html = '<div style="margin-top: 8px;margin-left:-8px!important;"><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p></div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }                    
                    if($(".backlog-order-section")){
                        $(".backlog-order-section").remove();
                    }
                    $("#insertBacklogData").before(htmlResponse);
                    $(".loading").removeClass('show');
                }else{                   
                    var inputError = result.err_field;
                    var inputErrorMsg = result.err_msg;                   
                    if (inputError || inputErrorMsg) {
                        if (inputError) {
                            for (const err_field in inputError) {
                                var targetEl = '';
                                var selectInputs = ["tantou", "order_category", "creation_category",];                              
                                if (err_field && selectInputs.indexOf(err_field) >= 0) {
                                    targetEl = $("select[name=" + err_field + "]")  
                                }
                                else{
                                    targetEl = $("input[name=" + err_field + "]")
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
                    if (inputErrorMsg || result.hasData <= 0) {
                        html = '<div>';
                        if (inputErrorMsg) {
                            for (var count = 0; count < inputErrorMsg.length; count++) {
                                var error_message = inputErrorMsg[count];
                                // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                                html += '<p>' + error_message + '</p>';
                            }
                        }
                        if(result.hasData <= 0){
                            html = '<div>';
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p>';
                        }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                        $(".loading").removeClass('show');
                    }
                }            
            }
        })
    })
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