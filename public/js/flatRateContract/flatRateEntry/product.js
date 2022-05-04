function openProductModal(){
    $("#productModal").modal('show');
}

function filterProductModalData(selector){
    var bango = $("input[id='userId']").val();
    
    var selected_option = $(selector).children('option:selected');
    var categorytype = selected_option.data('categorytype');
    var categoryvalue = selected_option.data('categoryvalue');
    
    $.ajax({
        type: "POST",
        url: "flat-rate-entry/filterProductModalData/" + bango,
        headers: {'X-CSRF-TOKEN': $('#csrf').val()},
        data: {category_type: categorytype,category_value: categoryvalue},
        success: function (res) {
            var htmlData = res.html;
            var length = Object.keys(htmlData).length;
            var parent = $('#productModal');
            
            if (length === 4) {
                parent.find(".productCategory").html(htmlData.C5html);
                parent.find(".salesFrom").html(htmlData.E7html);
                parent.find(".versionClassification").html(htmlData.E6html);
                parent.find(".itemClassification").html(htmlData.C6html);
            }
            if (length === 1) {
                parent.find('.itemClassification').html(htmlData.C6html)
            }
            
            //get product details
            getProductDeatils(parent,bango);
        }
    })
}


function getProductDeatils(parent,bango) {
    $.ajax({
        type: "POST",
        url: "flat-rate-entry/getProductDeatils/" + bango,
        headers: {'X-CSRF-TOKEN': $('#csrf').val()},
        data: {
            jouhou: parent.find('.itemGroup').val(),
            koyuujouhou: parent.find('.productCategory').val(),
            color: parent.find('.itemClassification').val(),
            bumon: parent.find('.salesFrom').val(),
            jouhou2: parent.find('.versionClassification').val(),
            reg_sold_to: $(document).find('#reg_db_information1').val()
        },
        success: function (response) {
            parent.find(".productModalScroll").remove()
            parent.find('.insert_table_data').after(response.html)
            $("#productSelect").prop("disabled", true);

        }
    })
}

$(document).on("click", ".enableSelectProduct", function () {
    var productCode = $(this).attr('id').split('-')[1];
    $("#product_code").val(productCode);
    $("#productSelect").prop('disabled', false)
})

$(document).on('click','#productSelect',function(){
    var bango = $("input[id='userId']").val();
    var product_code = $("#product_code").val();
    var companyCd = $("#reg_db_information2").val().substr(0, 6);
    $.ajax({
        type: "POST",
        url: "flat-rate-entry/getSelectedProductDeatils/" + bango,
        headers: {'X-CSRF-TOKEN': $('#csrf').val()},
        data: {
            product_code: product_code,
            companyCd: companyCd
        },
        success: function (response) {
            var root_data = response.rootInfo;
            console.log(root_data);
            $("#reg_kawasename").val(product_code);
            $("#reg_syouhinname").val(root_data.name);
            //if(root_data.data24 != null && root_data.data24.substr(0,1)){
            //    $("#reg_syouhinname").prop('readonly',true);
            //}else{
            //    $("#reg_syouhinname").prop('readonly',true);
            //}
            $("#reg_syukkasu").val(1);
            $("#syouhin1_data52").val(root_data.data52);
            $("#reg_money1").val(formatNumber(root_data.hanbaisu));
            $("#db_money5").val(root_data.yoyakukanousu ?? 0);
            $("#reg_money5").val(formatNumber(root_data.yoyakukanousu) ?? 0);
            $("#db_money6").val(root_data.sortbango ?? 0);
            $("#reg_money6").val(formatNumber(root_data.sortbango) ?? 0);
            $("#db_money7").val(root_data.dataint01 ?? 0);
            $("#reg_money7").val(formatNumber(root_data.dataint01) ?? 0);
            $("#db_money8").val(root_data.yoyakusu ?? 0);
            $("#reg_money8").val(formatNumber(root_data.yoyakusu) ?? 0);
            
            //if(root_data.data100 == 'D131'){
            //    $("#reg_datatxt0113").prop('readonly',true);
            //    $("#reg_numeric6").prop('readonly',true);
            //    $("#reg_numeric7").prop('readonly',true);
            //}else{
            //    $("#reg_datatxt0113").prop('readonly',false);
            //    $("#reg_numeric6").prop('readonly',false);
            //    $("#reg_numeric7").prop('readonly',false);
            //}
            
            
            $("#productModal").modal('hide');
            
            //not set initial value again if already set the initial value
            var initial_status = $("#initial_product_status").val();
            if(initial_status == ""){
                $("#initial_product_status").val(1);
                
                //set this value to maintenance_company, 保守条件 = modal name
                //var preVal = $("#reg_maintenance_company").val();
                //$("#reg_maintenance_company").val(root_data.data104_detail);
                //$("#db_reg_maintenance_company").val(root_data.data104);

                //shipping order modal
                //$("#reg_datachar03").val(root_data.kongouritsu);
                //$("#reg_datachar04").val(root_data.mdjouhou);
                //$("#db_reg_supplier").val(root_data.season);
                //$("#reg_supplier").val(root_data.season_detail);
                
                //set initial value to delivery_method, 発注出荷 = modal name
                if(root_data.newcolor4 != null){
                    $("#deliveryMethod").val(root_data.newcolor4);
                }
            }
            
            //not set initial value again if already set the initial value
            var initial_maintenance_status = $("#initial_maintenance_status").val();
            if(initial_maintenance_status == ""){
                if(root_data.data104 != null){
                    $("#initial_maintenance_status").val(1);
                }
                //set this value to maintenance_company, 保守条件 = modal name
                var preVal = $("#reg_maintenance_company").val();
                $("#reg_maintenance_company").val(root_data.data104_detail);
                $("#db_reg_maintenance_company").val(root_data.data104);
            }
            
            //not set initial value again if already set the initial value
            var initial_datachar03_status = $("#initial_datachar03_status").val();
            if(initial_datachar03_status == ""){
                if(root_data.kongouritsu != null){
                    $("#initial_datachar03_status").val(1);
                }
                //shipping order modal
                $("#reg_datachar03").val(root_data.kongouritsu);
                
            }
            
            //not set initial value again if already set the initial value
            var initial_datachar04_status = $("#initial_datachar04_status").val();
            if(initial_datachar04_status == ""){
                if(root_data.mdjouhou != null){
                    $("#initial_datachar04_status").val(1);
                }
                //shipping order modal
                $("#reg_datachar04").val(root_data.mdjouhou);
                
            }
            
            //not set initial value again if already set the initial value
            var initial_shipping_status = $("#initial_shipping_status").val();
            if(initial_shipping_status == ""){
                if(root_data.season != null){
                    $("#initial_shipping_status").val(1);
                }
                //shipping order modal
                $("#db_reg_supplier").val(root_data.season);
                $("#reg_supplier").val(root_data.season_detail);
                
            }
            
            
            //trigger money1 to calculate gross operating profit
            $("#reg_money1").trigger('change');
            
            //enable disable split button 分割
            //enableDisableSplitButton();
            
            //set order shipping required field value
            var datatxt0110 = $("#reg_datatxt0110").val();
            if(datatxt0110 == ""){
                var today = getCurrentDate();
                $("#datepicker7_oen").val(today);
                $("#datepicker8_oen").val(today);
            }
        }
    })
});

//calculate gross operating office
$('#reg_syukkasu,#reg_money1,#reg_money5,#reg_money6,#reg_money7,#reg_money8').on('input keyup paste',function(){
    //validate number,remove character
    var temp_id = $(this).attr('id');
    var temp_val = $(this).val().replace(/[^0-9]/g,'');
    //$(this).val(formatNumber(temp_val));
    
    if(temp_id == 'reg_syukkasu'){
        var temp_syukkasu = $(this).val();
        if(temp_syukkasu != ""){
            var temp_money5 = commaReplace($("#db_money5").val())*commaReplace(temp_syukkasu);
            var temp_money6 = commaReplace($("#db_money6").val())*commaReplace(temp_syukkasu);
            var temp_money7 = commaReplace($("#db_money7").val())*commaReplace(temp_syukkasu);
            var temp_money8 = commaReplace($("#db_money8").val())*commaReplace(temp_syukkasu);
            $("#reg_money5").val(formatNumber(temp_money5));
            $("#reg_money6").val(formatNumber(temp_money6));
            $("#reg_money7").val(formatNumber(temp_money7));
            $("#reg_money8").val(formatNumber(temp_money8));
        }
    }
    
    //call gross operating profit 
    grossOperatingProfit();
    //enable disable split button 分割
    //enableDisableSplitButton();
});

$('#reg_syukkasu,#reg_money1,#reg_money5,#reg_money6,#reg_money7,#reg_money8').on('blur', function () {
    var temp_val = $(this).val();
    $(this).val(formatNumber(temp_val));
});

function grossOperatingProfit(){
    var syukkasu = commaReplace($("#reg_syukkasu").val());
    var money1 = commaReplace($("#reg_money1").val());
    var money5 = commaReplace($("#reg_money5").val());
    var money6 = commaReplace($("#reg_money6").val());
    var money7 = commaReplace($("#reg_money7").val());
    var money8 = commaReplace($("#reg_money8").val());
    var money2 = syukkasu*money1;
    $("#reg_money2").val(formatNumber(money2));
    if(syukkasu != ""){
        var money4 = money2 - money5 - money6 - money7 - money8;
        $("#reg_money4").val(formatNumber(money4));
    }else{
        $("#reg_money4").val(0);
    }
    
    
    //disable or enable datachar02 depend on money5
    if(money5 > 0){
        $("#reg_datachar02").prop('disabled',false);
    }else{
        $("#reg_datachar02").prop('disabled',true);
    }
}

//get contract period end date
$(document).on('input keyup paste','#datepicker1_oen,#reg_numeric8',function(){
    //validate number,remove character
    var tmp_numeric8 = $("#reg_numeric8").val();
    var temp_val = tmp_numeric8.replace(/[^0-9]/g,'');
    $("#reg_numeric8").val(temp_val);
    
    //cal contract period end date
    getContractPeriodEndDate();
});

function getContractPeriodEndDate(){
    var add_month = parseInt($("#reg_numeric8").val());
    var start_date = $("#datepicker1_oen").val();
    var temp_start_date = $("#datepicker1_oen").val();
    if(!isNaN(add_month) && start_date != ""){
        //start_date = start_date.replace(/\//g,"");
        if(start_date.indexOf("/") < 0){
            start_date = start_date.substr(0,4)+"/"+start_date.substr(4,2)+"/"+start_date.substr(6,2);
        }
        
        if(add_month == 0){
            var month = add_month;
        }else{
           //var month = add_month-1; 
           var month = add_month; 
        }
        var day = leftPad(parseInt(start_date.substr(8,2))-1,2);
        
        if(day == '00'){
            var end_date = moment(start_date, "YYYY/MM/DD").add(month, 'M').format("YYYY/MM/DD");
            end_date = moment(end_date, "YYYY/MM/DD").subtract(1, 'days').format("YYYY/MM/DD");
            //var year = end_date.substr(0,4);
            //var tmp_mon = leftPad(parseInt(end_date.substr(5,2))-1,2);
            //var lastDate = new Date(year, tmp_mon , 0);
            //var lastDay = lastDate.getDate();
            //var end_date = end_date.substr(0,4) + "/" + tmp_mon + "/" + lastDay;
        }else{
           start_date = start_date.substr(0,8) + day;
           var end_date = moment(start_date, "YYYY/MM/DD").add(month, 'M').format("YYYY/MM/DD"); 
        }
        
        $("#reg_date0003").val(end_date);
        
        //get paid period
        getPaidPeriod(temp_start_date,end_date);
    
    }else{
       $("#reg_date0003").val(""); 
       $("#datepicker2_oen").val(""); 
       $("#datepicker3_oen").val(""); 
    }
    
    //enable disable split button 分割
    //enableDisableSplitButton();
}

//get paid period end date, getPaidPeriod is a nested function
$(document).on('input keyup paste','#reg_numeric9',function(){
    //validate number,remove character
    var temp_val = $(this).val().replace(/[^0-9]/g,'');
    $(this).val(temp_val);
    
    //getContractPeriodEndDate();
    var numeric8 = $("#reg_numeric8").val();
    var start_date = $("#datepicker1_oen").val();
    if(start_date == "" || numeric8 == ""){
        return false;
    }
    start_date = start_date.replace(/\//g,"");
    var end_date = $("#reg_date0003").val();
    getPaidPeriod(start_date,end_date);
});
function getPaidPeriod(temp_start_date,end_date){
    if($("#reg_numeric9").val() == ""){
        $("#datepicker2_oen").val("")
        $("#datepicker3_oen").val("")
        return false; 
    }
    var add_month = parseInt($("#reg_numeric9").val());
    var start_date = moment(temp_start_date, "YYYY/MM/DD").add(add_month, 'M').format("YYYY/MM/DD");
    
    $("#datepicker2_oen").val(start_date);
    $("#datepicker3_oen").val(end_date);
}

function leftPad(value, length) { 
    return ('0'.repeat(length) + value).slice(-length); 
}

//comma replace
function commaReplace(str) {
    var new_str = str.toString();
    new_str = new_str.replace(/,/g,"");
    return new_str; 
}

//number format
function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}
