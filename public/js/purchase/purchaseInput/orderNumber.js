function addOrderDeatailsOnTable(orderData, lineBranchId, exctime){
    var confirmation = $("#confirmModalStatus").val();
    console.log(confirmation, lineBranchId, exctime)
    if(exctime < 2){
        if(confirmation == '1'){ 
            console.log(confirmation)
            // var datalist = ["datachar07", "datachar08", "nyukosu", "genka", "syouhizeiritu", "soukobango", "datachar18", "datachar10", "datachar11", "syouhinid", "syouhinsyu"]
            if(orderData["syouhinsyu"].length ==2){
                var syouhinsyu = '0'+orderData["syouhinsyu"];
                // var number = orderData["syouhinid"] +'0'+orderData["syouhinsyu"];
            }else if(orderData["syouhinsyu"].length == 1){
                var syouhinsyu = '00'+orderData["syouhinsyu"];
                // var number = orderData["syouhinid"] +'00'+orderData["syouhinsyu"];
            }else{
                var syouhinsyu = orderData["syouhinsyu"];
                // var number = orderData["syouhinid"] + orderData["syouhinsyu"];
            }
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
            if($('#'+ lineBranchId).find(".orderNumber").hasClass("error")){
                $("#error_data").empty();
                $('#'+ lineBranchId).find(".orderNumber").removeClass("error")
            }
            calculatePriceInLine();
        }
        else{
            $("#confirmation_modal").show();
            event.preventDefault();
            $("body").on("click", '#addOrderDataToDetailTable', function (e) {
                $("#confirmModalStatus").val(1);
                $("#confirmation_modal").hide();
                exctime++;
                console.log("esctime", exctime);
                addOrderDeatailsOnTable(orderData, lineBranchId, exctime);
            })
        }
    }
}
$(document).on("click", '.confirmCancel', function (e) {
    $("#confirmModalStatus").val(0);
    $("#confirmation_modal").hide();
})
$(document).on("click", '.purchaseConfirmModalClose', function (e) {
    $("#confirmModalStatus").val(0);
    $("#confirmation_modal").hide();
})
// $(document).on("click", '.confirmOk', function (e) {
//     $("#confirmModalStatus").val(1);
//     $("#confirmation_modal").hide();
// })
$(document).on("click", '.orderNumberModalOpener', function (e) {
    e.preventDefault();
    var lineBranchId = $(this).parents(".line-form").attr("id");
    var orderNumber = $(this).parents(".input-group").find(".orderNumber").val();
    console.log(orderNumber, lineBranchId);
    var bango = $("input[id='userId']").val();
    if(orderNumber.length >=13){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#csrf').val()
            },
            type: "POST",
            url: "purchase-input/get-order-detail-table-data/" + bango,
            data: {
                orderNumber
            },
            success: function (response) {            
                if(response.hasOrder && response.checkResult){
                    $("#confirmation_modal").find(".confirmOk").prop("id","addOrderDataToDetailTable");
                    let orderData = response.orderDetail;
                    // addOrderDeatailsOnTable(orderData, lineBranchId, 0);
                    
                    if((orderData.datachar01 == 'V160' && orderData.juchusyukko2_tanka == 1) || (orderData.datachar01 != 'V160' && orderData.hikiatesyukko_datachar16 == 1)){
                        console.log(response);
                        addOrderDeatailsOnTable(orderData, lineBranchId, 0);
                    }
                    else{
                        // var html = '<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 8px;"> 該当するデータがありません。</p></div>';              
                        // var errorData = $(document).find("#error_data")
                        // if (errorData) {
                        //     console.log(errorData)
                        //     errorData.html(html);
                        //     $('#'+ lineBranchId).find(".orderNumber").addClass("error")
                        // }
                        // $(document).find("#error_data").html(html);
                        // $('#'+ lineBranchId).find(".orderNumber").addClass("error")
                        $("#confirmModalStatus").val(1);
                        addOrderDeatailsOnTable(orderData, lineBranchId, 1);
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
                        $('#'+ lineBranchId).find(".orderNumber").addClass("error")
                    }
                    $(document).find("#error_data").html(html);
                    $('#'+ lineBranchId).find(".orderNumber").addClass("error")
                }
            }
        })
    }
});

