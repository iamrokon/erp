//registration flat rate
function registerFlatRate() {
    //check split item added or not added
    $len = $("#line-main-div > div").length;
    if($len<1){
       alert("Please enter line data");
       return false;
    }
      
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    
    var bango = $("input[id='userId']").val();
    var data = new FormData(document.getElementById('insertData'));
    data.append('submit_confirmation', submit_confirmation);
    
    $.ajax({
        type: 'POST',
        url: "flat-rate-entry/register/" + bango,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if ($.trim(result.status) == 'ok') {
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#error_data").hide();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
            } else {
                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");

                //check front validation after submit
                //checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_data').html(html);

                    if (true) {
                    }
                    $("#error_data").show();
                }

                if (inputError.information2) {
                    $('#information2_input_group').addClass("error");
                } else {
                    $('#information2_input_group').removeClass("error");
                }
                
                if (inputError.information1) {
                    $('#information1_input_group').addClass("error");
                } else {
                    $('#information1_input_group').removeClass("error");
                }
                
                if (inputError.information3) {
                    $('#information3_input_group').addClass("error");
                } else {
                    $('#information3_input_group').removeClass("error");
                }
                
                if (inputError.information6) {
                    $('#information6_input_group').addClass("error");
                } else {
                    $('#information6_input_group').removeClass("error");
                }
                
                if (inputError.datachar05) {
                    $('#reg_datachar05').addClass("error");
                } else {
                    $('#reg_datachar05').removeClass("error");
                }
                
                if (inputError.kawasename) {
                    $('#kawasename_input_group').addClass("error");
                } else {
                    $('#kawasename_input_group').removeClass("error");
                }
                
                if (inputError.syouhinname) {
                    $('#reg_syouhinname').addClass("error");
                } else {
                    $('#reg_syouhinname').removeClass("error");
                }
                
                if (inputError.syukkasu) {
                    $('#reg_syukkasu').addClass("error");
                } else {
                    $('#reg_syukkasu').removeClass("error");
                }
                
                if (inputError.money1) {
                    $('#reg_money1').addClass("error");
                } else {
                    $('#reg_money1').removeClass("error");
                }
                
                if (inputError.money2) {
                    $('#reg_money2').addClass("error");
                } else {
                    $('#reg_money2').removeClass("error");
                }
                
                if (inputError.date0002) {
                    $('#datepicker1_oen').addClass("error");
                } else {
                    $('#datepicker1_oen').removeClass("error");
                }
                
                if (inputError.numeric8) {
                    $('#reg_numeric8').addClass("error");
                } else {
                    $('#reg_numeric8').removeClass("error");
                }
                
                if (inputError.datatxt0124) {
                    $('#maintenance_window_err').addClass("error");
                } else {
                    $('#maintenance_window_err').removeClass("error");
                }
                
                if (inputError.numericmax) {
                    $('#reg_numericmax').addClass("error");
                } else {
                    $('#reg_numericmax').removeClass("error");
                }
                
                if (inputError.datatxt0123) {
                    $('#maintenance_company_err').addClass("error");
                } else {
                    $('#maintenance_company_err').removeClass("error");
                }
                
                if (inputError.datatxt0120) {
                    $('#reg_datatxt0120').addClass("error");
                } else {
                    $('#reg_datatxt0120').removeClass("error");
                }
                
                if (inputError.datachar02) {
                    $('#reg_datachar02').addClass("error");
                } else {
                    $('#reg_datachar02').removeClass("error");
                }
                
                if (inputError.numeric9) {
                    $('#reg_numeric9').addClass("error");
                    $('#reg_numeric8').addClass("error");
                } else {
                    $('#reg_numeric9').removeClass("error");
                    $('#reg_numeric8').removeClass("error");
                }
                if (inputError.numeric10) {
                    $('#reg_numeric10').addClass("error");
                    $('#datepicker2_oen').addClass("error");
                    $('#datepicker3_oen').addClass("error");
                } else {
                    $('#reg_numeric10').removeClass("error");
                    $('#datepicker2_oen').removeClass("error");
                    $('#datepicker3_oen').removeClass("error");
                }
                
                //order shipping popup field validation starts here
                if (inputError.datachar03) {
                    $('#reg_datachar03').addClass("error");
                } else {
                    $('#reg_datachar03').removeClass("error");
                }
                
                if (inputError.datachar04) {
                    $('#reg_datachar04').addClass("error");
                } else {
                    $('#reg_datachar04').removeClass("error");
                }
                
                if (inputError.dataint09) {
                    $('#datepicker7_oen').addClass("error");
                } else {
                    $('#datepicker7_oen').removeClass("error");
                }
                
                if (inputError.dataint10) {
                    $('#datepicker8_oen').addClass("error");
                } else {
                    $('#datepicker8_oen').removeClass("error");
                }
                
                if (inputError.datachar06) {
                    $('#delivery_destination_err').addClass("error");
                } else {
                    $('#delivery_destination_err').removeClass("error");
                }
                
                if (inputError.datachar07) {
                    $('#reg_datachar07').addClass("error");
                } else {
                    $('#reg_datachar07').removeClass("error");
                }
                //order shipping popup field validation ends here
                
                if (inputError.money4) {
                    $('#reg_money4').addClass("error");
                } else {
                    $('#reg_money4').removeClass("error");
                }
                
                if (inputError.money5) {
                    $('#reg_money5').addClass("error");
                } else {
                    $('#reg_money5').removeClass("error");
                }
                
                if (inputError.money6) {
                    $('#reg_money6').addClass("error");
                } else {
                    $('#reg_money6').removeClass("error");
                }
                
                if (inputError.money7) {
                    $('#reg_money7').addClass("error");
                } else {
                    $('#reg_money7').removeClass("error");
                }
                
                if (inputError.money8) {
                    $('#reg_money8').addClass("error");
                } else {
                    $('#reg_money8').removeClass("error");
                }
                
                //array field error
                var temp_err_key = [];
                for (const err_field in inputError) {
                    var targetEl = '';
                    var selectInputs = ["pj"];
                    if (err_field.indexOf('.') > -1) {
                        const [inputName, key] = err_field.split('.');
                        temp_err_key[key] = key;
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
                }
                
                //remove error class
                $('input[name="datachar08[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
                    } 
                });

            }
        }
    });
}

//load registered data starts here
$('#temp_datatxt0110').off().on('input',function(event){
    //console.log(event);
    //validate number,remove character
    var temp_val = $(this).val().replace(/[^0-9]/g,'');
    $(this).val(temp_val);
    //if((event.type == 'keyup' && event.keyCode != 17) || event.type == 'paste'){
        //call gross operating profit 
        loadRegisteredData(event);
   // }
});
function loadRegisteredData(event) {
    //reset line div
    $("#line-main-div").empty();
    $("#error_data").empty();
    $('#contract_number_grp').removeClass("error");
    
    if(event == 1){
        var datatxt0110 = $("#flatRateNumber").val();
        if(datatxt0110 != ""){
            $("#reg_datatxt0111").val(2);
        }
        $("#temp_datatxt0110").val(datatxt0110);
    }else{
        if(event.type == 'paste'){
            var datatxt0110 = event.originalEvent.clipboardData.getData('text');
        }else{
            var datatxt0110 = $("#temp_datatxt0110").val();  
        }
    }
    
    if(datatxt0110.length == 10){
        var bango = $("input[id='userId']").val();
        $.ajax({
            type: 'POST',
            //async:false,
            headers: {'X-CSRF-TOKEN': $('#csrf').val()},
            url: "flat-rate-entry/loadRegisteredData/" + bango,
            data: "contract_number="+datatxt0110,
            success: function (result) {
                //console.log(result);
                var arr_len = result.flatRateEntryInfo.length;
                if(arr_len<1){
                    $("#reg_datatxt0112").css({"pointer-events":"auto","background": "#fff"});
                    $("#reg_datatxt0111").css({"pointer-events":"auto","background": "#fff"});
                    
                    var noDataMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">検索結果に該当するデータがありません。</p>';
                    $(document).find("#error_data").html(noDataMsg);
                    
                    $(".loading").removeClass('show');
                    
                    return false;
                }else{
                    $(document).find("#error_data").html("");
                }
                
                $("#temp_datatxt0110").prop('readonly',true);
                $("#reg_datatxt0112").css({"pointer-events":"none","background": "#efefef"});
                $("#reg_datatxt0111").css({"pointer-events":"none","background": "#efefef"});
                
                //load PJ pulldown data
                var db_information1 = (result['flatRateEntryInfo'][0].information1).substr(0,6);
                loadPJData(bango,db_information1);
                
                //disable fields
                var data100 = result['flatRateEntryInfo'][0].data100;
                if(data100 == 'D131'){
                    $("#reg_datatxt0113").prop('readonly',true);
                    $("#reg_numeric6").prop('readonly',true);
                    $("#reg_numeric7").prop('readonly',true);
                }else{
                    $("#reg_datatxt0113").prop('readonly',false);
                    $("#reg_numeric6").prop('readonly',false);
                    $("#reg_numeric7").prop('readonly',false);
                }
                
                $("#orderhenkan_bango").val(result['flatRateEntryInfo'][0].bango);
                if($("#reg_datatxt0111").val() != 1){
                    $("#reg_datatxt0110").val(result['flatRateEntryInfo'][0].datatxt0110);
                }
                $("#reg_datatxt0113").val(result['flatRateEntryInfo'][0].datatxt0113);
                $("#reg_numeric6").val(result['flatRateEntryInfo'][0].numeric6);
                $("#reg_numeric7").val(result['flatRateEntryInfo'][0].numeric7);
                $("#reg_datatxt0122").val(result['flatRateEntryInfo'][0].datatxt0122_detail);
                $("#reg_db_information2").val(result['flatRateEntryInfo'][0].information2);
                $("#reg_information2").val(result['flatRateEntryInfo'][0].information2_detail);
                $("#reg_db_information1").val(result['flatRateEntryInfo'][0].information1);
                $("#reg_information1").val(result['flatRateEntryInfo'][0].information1_detail);
                $("#reg_db_information3").val(result['flatRateEntryInfo'][0].information3);
                $("#reg_information3").val(result['flatRateEntryInfo'][0].information3_detail);
                $("#reg_db_information6").val(result['flatRateEntryInfo'][0].information6);
                $("#reg_information6").val(result['flatRateEntryInfo'][0].information6_detail);
                setTimeout(function(){
                    $("#reg_datatxt0129").val(result['flatRateEntryInfo'][0].datatxt0129);
                },1500);               
                $("#reg_datatxt0114").val(result['flatRateEntryInfo'][0].datatxt0114);
                $("#reg_datachar05").val(result['flatRateEntryInfo'][0].datachar05);
                $("#reg_kessaihouhou").val(result['flatRateEntryInfo'][0].kessaihouhou);
                $("#reg_deposit_month").val(result['flatRateEntryInfo'][0].datatxt0116);
                $("#payment_day").val(result['flatRateEntryInfo'][0].datatxt0117 ?? 1);
                $("#reg_housoukubun").val(result['flatRateEntryInfo'][0].housoukubun);
                $("#billing_tax_classification").val(result['flatRateEntryInfo'][0].otodoketime);
                $("#hidden_lbook_bango").val(result['flatRateEntryInfo'][0].datatxt0115??'');
                $("#hidden_filename").val(result['flatRateEntryInfo'][0].soukonyuko_datachar09??'');
                $("#temp_filename").val(result['flatRateEntryInfo'][0].datachar09_detail??'');
                if($("#reg_datatxt0111").val() != 1){
                    $(".custom-file-label").html(result['flatRateEntryInfo'][0].datachar09_detail??'契約書PDFアップロード');  
                    if($("#reg_datatxt0111").val() == 2){
                        $('#productButton').prop("disabled", false);
                        var current_date = (result['flatRateEntryInfo'][0].current_date).replace(/-/g,"");
                        var date0003 = (result['flatRateEntryInfo'][0].date0003).replace(/\//g,"");
                        var count_syouhinid = result['flatRateEntryInfo'][0].count_syouhinid;
                        var count_syouhinbango = result['flatRateEntryInfo'][0].count_syouhinbango;
                        if(current_date < date0003){
                            $("#reg_datatxt0122").val("10 "+result['flatRateEntryInfo'][0].contract_status_10);
                        //}else if(current_date > date0003 && (count_syouhinid != null && count_syouhinid > 0)){
                        }else if(current_date > date0003 && (count_syouhinid == count_syouhinbango)){
                            $("#reg_datatxt0122").val("30 "+result['flatRateEntryInfo'][0].contract_status_30);
                        //}else if(current_date > date0003 && (count_syouhinid != null && count_syouhinid < 1)){
                        }else if(current_date > date0003 && (count_syouhinid < count_syouhinbango)){
                            $("#reg_datatxt0122").val("20 "+result['flatRateEntryInfo'][0].contract_status_20);
                        }
                    }
                    if($("#reg_datatxt0111").val() == 3){
                        $("#reg_datatxt0122").val("20 "+result['flatRateEntryInfo'][0].contract_status_20);
                        $("#regButton").prop('disabled',false);
                        $("#choice_button").prop('disabled',true);
                        $("#maintenance_submit_button").prop('disabled',true);
                        $("#orderShippingSubmit").prop('disabled',true);
                        $("#productButton").prop('disabled',true);
                    }
                }else{
                   $("#hidden_lbook_bango").val(""); 
                   $("#hidden_filename").val(""); 
                   $("#temp_filename").val(""); 
                   $(".custom-file-label").html('契約書PDFアップロード'); 
                   $('#productButton').prop("disabled", false);
                }
                $("#reg_kawasename").val(result['flatRateEntryInfo'][0].kawasename);
                $("#reg_syouhinname").val(result['flatRateEntryInfo'][0].syouhinname);
                $("#reg_syukkasu").val(result['flatRateEntryInfo'][0].syukkasu);
                $("#reg_money1").val(formatNumber(result['flatRateEntryInfo'][0].money1));
                $("#reg_money2").val(formatNumber(result['flatRateEntryInfo'][0].money2));
                $("#reg_money3").val(result['flatRateEntryInfo'][0].money3);
                $("#datepicker1_oen").val((result['flatRateEntryInfo'][0].date0002).replace(/-/g,"/"));
                $("#datepicker1_oen").datepicker('update');
                $("#reg_numeric8").val(result['flatRateEntryInfo'][0].numeric8);
                $("#reg_date0003").val((result['flatRateEntryInfo'][0].date0003).replace(/-/g,"/"));
                $("#reg_date0003").datepicker('update');
                $("#reg_datachar26").val(result['flatRateEntryInfo'][0].datachar26);
                
                //保守条件 subwindow starts
                $("#initial_product_status").val(1);
                $("#syouhin1_data52").val(result['flatRateEntryInfo'][0].data52);
                $("#db_reg_maintenance_window").val(result['flatRateEntryInfo'][0].datatxt0124);
                $("#reg_maintenance_window").val(result['flatRateEntryInfo'][0].datatxt0124_detail);
                $("#reg_numericmax").val(result['flatRateEntryInfo'][0].numericmax);
                if(result['flatRateEntryInfo'][0].datatxt0123 != null){
                    $("#initial_maintenance_status").val(1);    
                    $("#db_reg_maintenance_company").val(result['flatRateEntryInfo'][0].datatxt0123);
                    $("#reg_maintenance_company").val(result['flatRateEntryInfo'][0].datatxt0123_detail);
                }
                
                $("#reg_datatxt0120").val(result['flatRateEntryInfo'][0].datatxt0120);
                //保守条件 subwindow ends
                
                $("#reg_datachar02").val(result['flatRateEntryInfo'][0].datachar02);
                $("#reg_numeric9").val(result['flatRateEntryInfo'][0].numeric9);
                $("#reg_numeric10").val(result['flatRateEntryInfo'][0].numeric10);
                $("#reg_datatxt0121").val(result['flatRateEntryInfo'][0].datatxt0121);
                $("#reg_datatxt0125").val(result['flatRateEntryInfo'][0].datatxt0125);
                if(result['flatRateEntryInfo'][0].soukosyukko_datachar05 != null){
                    $("#initial_shipping_status").val(1);
                    $("#db_reg_supplier").val(result['flatRateEntryInfo'][0].soukosyukko_datachar05);
                    $("#reg_supplier").val(result['flatRateEntryInfo'][0].datachar05_detail);
                }   
                $("#db_reg_delivery_destination").val(result['flatRateEntryInfo'][0].datachar06);
                $("#reg_delivery_destination").val(result['flatRateEntryInfo'][0].datachar06_detail);
                $("#deliveryMethod").val(result['flatRateEntryInfo'][0].datachar09);
                $("#datepicker2_oen").val((result['flatRateEntryInfo'][0].date0004).replace(/-/g,"/"));
                $("#datepicker3_oen").val((result['flatRateEntryInfo'][0].date0005).replace(/-/g,"/"));
                $("#reg_datatxt0119").val(result['flatRateEntryInfo'][0].datatxt0119);
                $("#reg_numeric1").val(result['flatRateEntryInfo'][0].numeric1);
                $("#reg_datachar27").val(result['flatRateEntryInfo'][0].datachar27);
                $("#reg_datatxt0118").val(result['flatRateEntryInfo'][0].datatxt0118);
                $("#reg_money4").val(formatNumber(result['flatRateEntryInfo'][0].money4));
                
                console.log(result['product_price']);
                
                //$("#db_money5").val(result['flatRateEntryInfo'][0].money5);
                $("#db_money5").val(result['product_price'].yoyakukanousu ?? 0);
                $("#reg_money5").val(formatNumber(result['flatRateEntryInfo'][0].money5));
                if(result['flatRateEntryInfo'][0].money5>0){
                    $("#reg_datachar02").prop('disabled',false);
                }
                //$("#db_money6").val(result['flatRateEntryInfo'][0].money6);
                $("#db_money6").val(result['product_price'].sortbango ?? 0);
                $("#reg_money6").val(formatNumber(result['flatRateEntryInfo'][0].money6));
                //$("#db_money7").val(result['flatRateEntryInfo'][0].money7);
                $("#db_money7").val(result['product_price'].dataint01 ?? 0);
                $("#reg_money7").val(formatNumber(result['flatRateEntryInfo'][0].money7));
                //$("#db_money8").val(result['flatRateEntryInfo'][0].money8);
                $("#db_money8").val(result['product_price'].yoyakusu ?? 0);
                $("#reg_money8").val(formatNumber(result['flatRateEntryInfo'][0].money8));
                if(result['flatRateEntryInfo'][0].datachar03 != null){
                    $("#initial_datachar03_status").val(1);
                    $("#reg_datachar03").val(result['flatRateEntryInfo'][0].datachar03);
                }
                if(result['flatRateEntryInfo'][0].datachar04 != null){
                    $("#initial_datachar04_status").val(1);
                    $("#reg_datachar04").val(result['flatRateEntryInfo'][0].datachar04);
                }
                $("#datepicker7_oen").val(result['flatRateEntryInfo'][0].dataint09);
                $("#datepicker8_oen").val(result['flatRateEntryInfo'][0].dataint10);
                $("#reg_datachar07").val(result['flatRateEntryInfo'][0].soukosyukko_datachar07);
                $("#deliveryMethod").val(result['flatRateEntryInfo'][0].datachar09);
                
                $("#line-main-div").append(result['lineInfo']);
                //$('#productButton').prop("disabled", false);
                //enable disable split button 分割
                //enableDisableSplitButton();
                
                $("#splitButton").prop('disabled',false);
                
                //enable,disbale fields depend on 作成区分
                var countSyouhinid = result['flatRateEntryInfo'][0].count_syouhinid;
                enableDisableFields(countSyouhinid);
                $(".loading").removeClass('show');
                
                //comapre exceed date
                compareContactPeriod();
            },
            beforeSend:function(){
                $(".loading").addClass('show');
            }
        });
    }else{
        $("#reg_datatxt0112").css({"pointer-events":"auto","background": "#fff"});
        $("#reg_datatxt0111").css({"pointer-events":"auto","background": "#fff"});
        $("#reg_datatxt0110").val("");
        $("#reg_datatxt0113").val("");
        $("#reg_numeric6").val("");
        $("#reg_numeric7").val("");
        $("#reg_datatxt0122").val("");
        $("#reg_db_information2").val("");
        $("#reg_information2").val("");
        $("#reg_db_information1").val("");
        $("#reg_information1").val("");
        $("#reg_db_information3").val("");
        $("#reg_information3").val("");
        $("#reg_db_information6").val("");
        $("#reg_information6").val("");
        $("#reg_datatxt0129").val("");
        $("#reg_datatxt0114").val("");
        $("#reg_kessaihouhou").val("");
        $("#reg_deposit_month").val("");
        $("#payment_day").val("");
        $("#reg_housoukubun").val("");
        $("#billing_tax_classification").val("");
        $("#reg_kawasename").val("");
        $("#reg_syouhinname").val("");
        $("#reg_syukkasu").val(1);
        $("#reg_money1").val("");
        $("#reg_money2").val(0);
        $("#reg_money3").val("");
        $("#datepicker1_oen").val("");
        $("#reg_numeric8").val("");
        $("#reg_date0003").val("");
        $("#db_reg_maintenance_window").val("");
        $("#reg_maintenance_window").val("");
        $("#reg_numericmax").val("");
        $("#db_reg_maintenance_company").val("");
        $("#reg_maintenance_company").val("");
        $("#reg_datatxt0120").val("");
        $("#reg_datachar02").val("");
        $("#reg_numeric9").val(0);
        $("#reg_datatxt0125").val("");
        $("#reg_datachar04").val("");
        $("#db_reg_supplier").val("");
        $("#reg_supplier").val("");
        $("#db_reg_delivery_destination").val("");
        $("#reg_delivery_destination").val("");
        $("#reg_datachar07").val("");
        $("#deliveryMethod").val("");
        $("#datepicker2_oen").val("");
        $("#datepicker3_oen").val("");
        $("#reg_datatxt0119").val("");
        $("#reg_numeric1").val(1);
        $("#reg_datatxt0118").val("");
        $("#reg_money4").val("");
        $("#reg_datachar03").val("");
        $("#reg_datachar04").val("");
        $("#datepicker7_oen").val("");
        $("#datepicker8_oen").val("");
        $("#reg_datachar07").val("");
        $("#deliveryMethod").val("");
        
        //enable disable split button 分割
        //enableDisableSplitButton();
    }
    
}
//load registered data ends here

$("#reg_datatxt0111").change(function(){
    var datatxt0111 = $("#reg_datatxt0111").val();
    var filename = $("#temp_filename").val();
    if(datatxt0111 != 1){
        $(".custom-file-label").html(filename!=""?filename:'契約書PDFアップロード'); 
    }else{
        $(".custom-file-label").html("契約書PDFアップロード");
    }
    
    //enable,disbale fields depend on 作成区分
    //enableDisableFields();
});


//open transaction terms modal
function transactionTermsModalOpener(status = null,first_load = null){
    var bango = $("input[id='userId']").val();
    var orderBango = $("#reg_db_information2").val();
    var datatxt0110 = $("#reg_datatxt0110").val();
    
    //not set initial value again if already set the initial value
    var initial_status = $("#transaction_initial_val_status").val();
    if(initial_status == "" && status != 1){
        $("#transaction_initial_val_status").val(1);
    }
    
    if(orderBango == ""){
        return false;
    }else if(initial_status == 1){
        //store modal initial data
        localStoreTransactionPrevData();
        $('#transactionTermsModal').modal('show');
        return false;
    }else if(datatxt0110 != ""){
        //store modal initial data
        localStoreTransactionPrevData();
        if(first_load == 2){
            return false;
        }else{
            $('#transactionTermsModal').modal('show');
            return false;
        }
    }else{
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('#csrf').val()},
            url: "flat-rate-entry/searchDataFromOthers2/" + bango,
            async: false,
            data: 'order_bango='+orderBango,
            success:function(result){
                //console.log(result);
                if(result.payment_method == null){
                    $("#reg_kessaihouhou").prop("selectedIndex", 0);
                }else{
                    $("#reg_kessaihouhou").val(result.payment_method);
                }
                
                if(result.deposit_month == null){
                    $("#reg_deposit_month").prop("selectedIndex", 0);
                }else{
                    $("#reg_deposit_month").val((result.deposit_month).substr(0,1));
                }
                
                if(result.payment_day == null){
                    $("#payment_day").prop("selectedIndex", 0);
                }else{
                    $("#payment_day").val(result.payment_day);
                }
                
                var payment_method = result.payment_method;
                if(payment_method == 'A903'){
                    $("#reg_housoukubun").val(1);
                    $("#reg_housoukubun").css({"pointer-events":"none","background": "#efefef"});
                }else{
                    if(result.housoukubun == null){
                        $("#reg_housoukubun").prop("selectedIndex", 0);
                    }else{
                        $("#reg_housoukubun").val((result.housoukubun).substr(0,1)); 
                    }
                }
                
                if(result.billing_tax_classification == null){
                    $("#billing_tax_classification").prop("selectedIndex", 0);
                }else{
                    $("#billing_tax_classification").val(result.billing_tax_classification ?? "");
                }
                
                //store modal initial data
                localStoreTransactionPrevData();
            }
        });
    }
    if(status != 1){
        //store modal initial data
        localStoreTransactionPrevData();
        $('#transactionTermsModal').modal('show'); 
    }
}

//store transaction terms initial data in local storage
function localStoreTransactionPrevData(){
    var transactionModalPrevData = {};
    transactionModalPrevData.reg_kessaihouhou = $("#reg_kessaihouhou").val();
    transactionModalPrevData.reg_deposit_month = $("#reg_deposit_month").val();
    transactionModalPrevData.payment_day = $("#payment_day").val();
    transactionModalPrevData.reg_housoukubun = $("#reg_housoukubun").val();
    transactionModalPrevData.billing_tax_classification = $("#billing_tax_classification").val();
    localStorage.setItem("transactionModalPrevData", JSON.stringify(transactionModalPrevData));
}

//set previous transaction data
function transactionDataCancellation(){
    var transactionModalPrevData = JSON.parse(localStorage.getItem("transactionModalPrevData"));
    $("#reg_kessaihouhou").val(transactionModalPrevData.reg_kessaihouhou);
    $("#reg_deposit_month").val(transactionModalPrevData.reg_deposit_month);
    $("#payment_day").val(transactionModalPrevData.payment_day);
    $("#reg_housoukubun").val(transactionModalPrevData.reg_housoukubun);
    $("#billing_tax_classification").val(transactionModalPrevData.billing_tax_classification);
    localStorage.removeItem('transactionModalPrevData');
}

//open transaction terms modal
function maintenanceConditionsModalOpener(){
    var information1 = $("#reg_information1").val();
    var kawasename = $("#reg_kawasename").val();
    if(information1 == "" || kawasename == ""){
        return false;
    }
    
    var maintenanceModalPrevData ={};
    maintenanceModalPrevData.db_reg_maintenance_window = $("#db_reg_maintenance_window").val();
    maintenanceModalPrevData.reg_maintenance_window = $("#reg_maintenance_window").val();
    maintenanceModalPrevData.reg_numericmax = $("#reg_numericmax").val();
    maintenanceModalPrevData.db_reg_maintenance_company = $("#db_reg_maintenance_company").val();
    maintenanceModalPrevData.reg_maintenance_company = $("#reg_maintenance_company").val();
    maintenanceModalPrevData.reg_datatxt0120 = $("#reg_datatxt0120").val();
    localStorage.setItem("maintenanceModalPrevData", JSON.stringify(maintenanceModalPrevData));
    
    $('#maintenanceConditionsModal').modal('show');
}

//set previous maintenance data
function maintenanceDataCancellation(){
    var maintenanceModalPrevData = JSON.parse(localStorage.getItem("maintenanceModalPrevData"));
    $("#db_reg_maintenance_window").val(maintenanceModalPrevData.db_reg_maintenance_window);
    $("#reg_maintenance_window").val(maintenanceModalPrevData.reg_maintenance_window);
    $("#reg_numericmax").val(maintenanceModalPrevData.reg_numericmax);
    $("#db_reg_maintenance_company").val(maintenanceModalPrevData.db_reg_maintenance_company);
    $("#reg_maintenance_company").val(maintenanceModalPrevData.reg_maintenance_company);
    $("#reg_datatxt0120").val(maintenanceModalPrevData.reg_datatxt0120);
    localStorage.removeItem('maintenanceModalPrevData');
}

//order shipping modal
function orderShippingModalOpener(){
    var information1 = $("#reg_information1").val();
    var kawasename = $("#reg_kawasename").val();
    if(information1 == "" || kawasename == ""){
        return false;
    }
    
    var shippingModalPrevData ={};
    shippingModalPrevData.reg_datachar03 = $("#reg_datachar03").val();
    shippingModalPrevData.reg_datachar04 = $("#reg_datachar04").val();
    shippingModalPrevData.db_reg_supplier = $("#db_reg_supplier").val();
    shippingModalPrevData.reg_supplier = $("#reg_supplier").val();
    shippingModalPrevData.datepicker7_oen = $("#datepicker7_oen").val();
    shippingModalPrevData.datepicker8_oen = $("#datepicker8_oen").val();
    shippingModalPrevData.db_reg_delivery_destination = $("#db_reg_delivery_destination").val();
    shippingModalPrevData.reg_delivery_destination = $("#reg_delivery_destination").val();
    shippingModalPrevData.reg_datachar07 = $("#reg_datachar07").val();
    shippingModalPrevData.deliveryMethod = $("#deliveryMethod").val();
    localStorage.setItem("shippingModalPrevData", JSON.stringify(shippingModalPrevData));
    
    $('#orderShippingModal').modal('show');
}

//set previous shipping data
function shippingDataCancellation(){
    var shippingModalPrevData = JSON.parse(localStorage.getItem("shippingModalPrevData"));
    $("#reg_datachar03").val(shippingModalPrevData.reg_datachar03);
    $("#reg_datachar04").val(shippingModalPrevData.reg_datachar04);
    $("#db_reg_supplier").val(shippingModalPrevData.db_reg_supplier);
    $("#reg_supplier").val(shippingModalPrevData.reg_supplier);
    $("#datepicker7_oen").val(shippingModalPrevData.datepicker7_oen);
    $("#datepicker8_oen").val(shippingModalPrevData.datepicker8_oen);
    $("#db_reg_delivery_destination").val(shippingModalPrevData.db_reg_delivery_destination);
    $("#reg_delivery_destination").val(shippingModalPrevData.reg_delivery_destination);
    $("#reg_datachar07").val(shippingModalPrevData.reg_datachar07);
    $("#deliveryMethod").val(shippingModalPrevData.deliveryMethod);
    localStorage.removeItem('shippingModalPrevData');
}

$("#reg_kessaihouhou").change(function(){
    var kessaihouhou = $("#reg_kessaihouhou").val();
    var housoukubun = $("#reg_housoukubun").val();
    if(kessaihouhou == 'A903'){
        $("#reg_housoukubun").val(1);
        $("#reg_housoukubun").css({"pointer-events":"none","background": "#efefef"});
    }else{
        $("#reg_housoukubun").val(housoukubun);
        $("#reg_housoukubun").css({"pointer-events":"auto","background": "white"});
    }
});


//reset file input
$(document).on('click', "#fileUploadClose", function (e) {
    e.preventDefault()
    var labelName = '契約書PDFアップロード ';
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


function enableDisableFields(countSyouhinid){
    var datatxt0111 = $("#reg_datatxt0111").val();
    if(datatxt0111 == 2){
        $("#reg_datatxt0112").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0111").css({"pointer-events":"none","background": "#efefef"});
        $("#supplierButton1").prop('disabled',true);
        $("#supplierButton2").prop('disabled',true);
        $("#supplierButton3").prop('disabled',true);
        $("#reg_datatxt0129").css({"pointer-events":"none","background": "#efefef"});
        if(countSyouhinid>0){
            $("#reg_datatxt0129").css({"pointer-events":"auto","background": "#fff"});
            $("#reg_datachar05").css({"pointer-events":"none","background": "#efefef"});
            $("#productButton").prop('disabled',true);
            $("#reg_syouhinname").prop('readonly',true);
            $("#reg_syukkasu").prop('readonly',true);
            $("#reg_money1").prop('readonly',true);
            $("#datepicker1_oen").css({"pointer-events":"none","background": "#efefef"});
            $("#reg_numeric8").prop('readonly',true);
            $("#reg_numeric9").prop('readonly',true);
            $("#reg_numeric10").css({"pointer-events":"none","background": "#efefef"});
            $("#reg_datatxt0121").css({"pointer-events":"none","background": "#efefef"});
            $("#reg_money5").prop('readonly',true);
            $("#reg_money6").prop('readonly',true);
            $("#reg_money7").prop('readonly',true);
            $("#reg_money8").prop('readonly',true);
            $("#splitButton").prop('disabled',true);
            $("#regButton").prop('disabled',false);
            //transaction modal
            $("#reg_kessaihouhou").css({"pointer-events":"none","background": "#efefef"});
            $("#reg_deposit_month").css({"pointer-events":"none","background": "#efefef"});
            $("#payment_day").css({"pointer-events":"none","background": "#efefef"});
            $("#reg_housoukubun").css({"pointer-events":"none","background": "#efefef"});
            $("#billing_tax_classification").css({"pointer-events":"none","background": "#efefef"});
        }
        //common enable fields
        enableFields();
    }else if(datatxt0111 == 3){
        $("#reg_datatxt0112").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0111").css({"pointer-events":"none","background": "#efefef"});
        $("#supplierButton1").prop('disabled',true);
        $("#supplierButton2").prop('disabled',true);
        $("#supplierButton3").prop('disabled',true);
        $("#reg_datatxt0129").css({"pointer-events":"none","background": "#efefef"});
        $("#supplierButton4").prop('disabled',true);
        $("#reg_datatxt0113").prop('readonly',true);
        $("#reg_numeric6").prop('readonly',true);
        $("#reg_numeric7").prop('readonly',true);
        $("#reg_datatxt0114").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datachar05").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_kessaihouhou").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_deposit_month").css({"pointer-events":"none","background": "#efefef"});
        $("#payment_day").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_housoukubun").css({"pointer-events":"none","background": "#efefef"});
        $("#billing_tax_classification").css({"pointer-events":"none","background": "#efefef"});
        $("#custom_file_label").css({"pointer-events":"none","background": "#efefef"});
        $("#fileUploadClose").prop('disabled',true);
        $("#reg_syouhinname").prop('readonly',true);
        $("#reg_syukkasu").prop('readonly',true);
        $("#reg_money1").prop('readonly',true);
        $("#datepicker1_oen").prop('readonly',true);
        $("#datepicker1_oen").css({"pointer-events":"none"});
        $("#reg_date0003").prop('readonly',false);
        $("#reg_date0003").css({"pointer-events":"auto"});
        $("#reg_numeric8").prop('readonly',true);
        $("#reg_datachar26").css({"pointer-events":"none","background": "#efefef"});
        $("#maintenance_sub_btn1").prop('disabled',true);
        $("#reg_numericmax").prop('readonly',true);
        $("#maintenance_sub_btn2").prop('disabled',true);
        $("#reg_datatxt0120").prop('readonly',true);
        $("#reg_datachar02").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_numeric9").prop('readonly',true);
        $("#reg_numeric10").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0121").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0125").prop('readonly',true);
        $("#reg_datachar03").prop('readonly',true);
        $("#reg_datachar04").prop('readonly',true);
        $("#shipping_sub_btn1").prop('disabled',true);
        $("#datepicker7_oen").css({"pointer-events":"none","background": "#efefef"});
        $("#datepicker8_oen").css({"pointer-events":"none","background": "#efefef"});
        $("#shipping_sub_btn2").prop('disabled',true);
        $("#reg_datachar07").prop('readonly',true);
        $("#deliveryMethod").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0119").prop('readonly',true);
        $("#reg_numeric1").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datachar27").css({"pointer-events":"none","background": "#efefef"});
        $("#reg_datatxt0118").prop('readonly',true);
        $("#splitButton").prop('disabled',true);
        $("#reg_money5").prop('readonly',true);
        $("#reg_money6").prop('readonly',true);
        $("#reg_money7").prop('readonly',true);
        $("#reg_money8").prop('readonly',true);
        $('.remarks').each(function(){
            $(this).prop('readonly',true);
        });
    }else{
        $("#supplierButton1").prop('disabled',false);
        $("#supplierButton2").prop('disabled',false);
        $("#supplierButton3").prop('disabled',false);
        $("#reg_datatxt0129").css({"pointer-events":"auto","background": "#fff"});
        //common enable fields
        enableFields();
    }
}

function enableFields(){
    $("#supplierButton4").prop('disabled',false);
    //$("#reg_datatxt0113").prop('readonly',false);
    //$("#reg_numeric6").prop('readonly',false);
    //$("#reg_numeric7").prop('readonly',false);
    $("#reg_datatxt0114").css({"pointer-events":"auto","background": "#fff"});
    $("#transactionButton").prop('disabled',false);
    $("#custom_file_label").css({"pointer-events":"auto","background": "#fff"});
    $("#fileUploadClose").prop('disabled',false);
    $("#reg_datachar26").css({"pointer-events":"auto","background": "#fff"});
    $("#maintenanceButton").prop('disabled',false);
    $("#maintenance_sub_btn1").prop('disabled',false);
    $("#reg_numericmax").prop('readonly',false);
    $("#maintenance_sub_btn2").prop('disabled',false);
    $("#reg_datatxt0120").prop('readonly',false);
    $("#reg_datachar02").css({"pointer-events":"auto","background": "#fff"});
    $("#reg_datatxt0125").prop('readonly',false);
    $("#orderShippingButton").prop('disabled',false);
    $("#reg_datachar03").prop('readonly',false);
    $("#reg_datachar04").prop('readonly',false);
    $("#shipping_sub_btn1").prop('disabled',false);
    $("#datepicker7_oen").css({"pointer-events":"auto","background": "#fff"});
    $("#datepicker8_oen").css({"pointer-events":"auto","background": "#fff"});
    $("#shipping_sub_btn2").prop('disabled',false);
    $("#reg_datachar07").prop('readonly',false);
    $("#deliveryMethod").css({"pointer-events":"auto","background": "#fff"});
    $("#reg_datatxt0119").prop('readonly',false);
    $("#reg_numeric1").css({"pointer-events":"auto","background": "#fff"});
    $("#reg_datachar27").css({"pointer-events":"auto","background": "#fff"});
    $("#reg_datatxt0118").prop('readonly',false);
    $('.remarks').each(function(){
        $(this).prop('readonly',false);
    });
}

$("#orderShippingSubmit").click(function(){
    var bango = $("input[id='userId']").val();
    var data = $('#insertData').serialize(); 
    
    $.ajax({
        type: 'POST',
        url: "flat-rate-entry/validateOrderShipping/" + bango,
        data: data,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                $("#shipping_order_error_data").hide();
                $('#shipping-table .error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#maintenanceConditionsModal").modal('hide')
                $("#orderShippingModal").modal('hide')
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px; margin-left: -8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#shipping_order_error_data').html(html);

                    if (true) {
                    }
                    $("#shipping_order_error_data").show();
                }

                if (inputError.datachar03) {
                    $('#reg_datachar03').addClass("error");
                } else {
                    $('#reg_datachar03').removeClass("error");
                }
                
                if (inputError.datachar04) {
                    $('#reg_datachar04').addClass("error");
                } else {
                    $('#reg_datachar04').removeClass("error");
                }
                
                if (inputError.supplier) {
                    $('#reg_supplier').addClass("error");
                } else {
                    $('#reg_supplier').removeClass("error");
                }
                
                if (inputError.dataint09) {
                    $('#datepicker7_oen').addClass("error");
                } else {
                    $('#datepicker7_oen').removeClass("error");
                }
                
                if (inputError.dataint10) {
                    $('#datepicker8_oen').addClass("error");
                } else {
                    $('#datepicker8_oen').removeClass("error");
                }
                
                if (inputError.datachar06) {
                    $('#delivery_destination_err').addClass("error");
                } else {
                    $('#delivery_destination_err').removeClass("error");
                }
                
                if (inputError.datachar07) {
                    $('#reg_datachar07').addClass("error");
                } else {
                    $('#reg_datachar07').removeClass("error");
                }
                
            }
        }
    });
});

function validateMaintenance(){
    var bango = $("input[id='userId']").val();
    var data = $('#insertData').serialize(); 
    
    $.ajax({
        type: 'POST',
        url: "flat-rate-entry/validateMaintenance/" + bango,
        data: data,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                $("#maintenance_error_data").hide();
                $('#maintenance-table .error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#maintenanceConditionsModal").modal('hide')
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px; margin-left: -8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#maintenance_error_data').html(html);

                    if (true) {
                    }
                    $("#maintenance_error_data").show();
                }

                if (inputError.datatxt0124) {
                    $('#maintenance_window_err').addClass("error");
                } else {
                    $('#maintenance_window_err').removeClass("error");
                }
                
                if (inputError.numericmax) {
                    $('#reg_numericmax').addClass("error");
                } else {
                    $('#reg_numericmax').removeClass("error");
                }
                
                if (inputError.datatxt0123) {
                    $('#maintenance_company_err').addClass("error");
                } else {
                    $('#maintenance_company_err').removeClass("error");
                }
                
                if (inputError.datatxt0120) {
                    $('#reg_datatxt0120').addClass("error");
                } else {
                    $('#reg_datatxt0120').removeClass("error");
                }
                
            }
        }
    });
}

$("#billing_tax_classification").change(function(){
    var billing_tax_classification = $("#billing_tax_classification").val();
    $("#hiddenOtodoketime").val(billing_tax_classification);
});

function getCurrentDate(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    var current_date = yyyy + '/' + mm + '/' + dd;
    return current_date;
}

$(document).ready(function(){
    var flat_rate_number = $("#flatRateNumber").val();
    loadRegisteredData(1);
});


$('#datepicker1_oen').on('blur change keyup', function () {
    compareContactPeriod();
});

function compareContactPeriod(){
    var compare_contact_period = parseInt($("#compare_contact_period").val());
    var contact_period = parseInt($("#datepicker1_oen").val().replace(/\//g,""));
    if(contact_period < compare_contact_period){
        var html = "過去日付を指定しています。";
        $('#error_data2').html(html);
        $("#error_data2").show();
        document.getElementById("insertData").scrollIntoView();
        console.log("date chekced error");
    }else{
        $('#error_data2').html("");
        $("#error_data2").hide();
    }
}