function importCSV(url) {
    buttonPress++;
    if (buttonPress == 1) {
        buttonPress = 0;
       
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    
    var data = new FormData(document.getElementById('import_csv'));
    data.append('submit_confirmation',submit_confirmation); 

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                $('#order_data_input').removeClass("error");
                $('#error_data').html("");
                $(".customalert, .loading-icon").hide();
                $("#depositSysApplicationReload").click();
            }else if ($.trim(result) == 'confirmation_msg'){
                $(".success-msg-box").css("display","none");
                $('.error_data1').css("display","none");
                $('.error_data2').css("display","none");
                $('.error_data3').css("display","none");
                $('.error_data4').css("display","none");
                $("#submit_confirmation").val('submit');
                $('#error_data').html("");
                $(".customalert, .loading-icon").hide();
                $('#order_data_input').removeClass("error");
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">取込を行います。もう一度「CSVインポート」をお願いします。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
                buttonPress = 0;
            }else if ($.trim(result) == 'ng') {
                $('#order_data_input').removeClass("error");
                $('#error_data').html("");
                $(".customalert, .loading-icon").hide();
                $("#depositSysApplicationReload").click();
            }else if ($.trim(result) == 'no_data') {
                //reset submit confirmation
                $("#submit_confirmation").val("");
                
                $(document).find("#confirmation_message").html("");
                $(".success-msg-box").css("display","none");
                $('.error_data1').css("display","none");
                $('.error_data2').css("display","none");
                $('.error_data3').css("display","none");
                $('.error_data4').css("display","none");
                $('#order_data_input').removeClass("error");
                $('#error_data').html("取込ファイルを確認してください。");
                $(".customalert, .loading-icon").hide();
            }else if ($.trim(result) == 'invalid_csv') {
                //reset submit confirmation
                $("#submit_confirmation").val("");
                
                $(".success-msg-box").css("display","none");
                $('.error_data1').css("display","none");
                $('.error_data2').css("display","none");
                $('.error_data3').css("display","none");
                $('.error_data4').css("display","none");
                $('#order_data_input').removeClass("error");
                $('#error_data').html("取込ファイルを確認してください。");
                $('#confirmation_message').html("");
                $(".customalert, .loading-icon").hide();
            }else {
                $(".customalert, .loading-icon").hide();
                var inputError = result.err_field;
                console.log(inputError);
                
                $("#confirmation_message").html("");
                $(".success-msg-box").css("display","none");
                $(".common_error").css("display","none");
                
                //reset submit confirmation
                $("#submit_confirmation").val("");

                var html = '';
                if (result.err_msg) {
                    html = '<div>';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';
                    $('#error_data').html(html);
                    $("#error_data").show();
                }

                if (inputError.filename) {
                    $('#order_data_input').addClass("error");
                } else {
                    $('#order_data_input').removeClass("error");
                }

            }
        }
    });
  } else {
    doubleClick();
  }
}

function formatValidationMsg(msg){
    if(msg.indexOf("processing_number") > 0){
        return msg.replace("processing_number", "処理番号");
    }
    if(msg.indexOf("customer_number") > 0){
        return msg.replace("customer_number", "顧客番号");
    }
    if(msg.indexOf("billing_gc_item_04") > 0){
        return msg.replace("billing_gc_item_04", "請求汎用文字項目０４");
    }
    if(msg.indexOf("torikomidate") > 0){
        return msg.replace("torikomidate", "入金日");
    }
    if(msg.indexOf("deposit_cus_number") > 0){
        return msg.replace("deposit_cus_number", "入金顧客番号");
    }
    if(msg.indexOf("deposit_number") > 0){
        return msg.replace("deposit_number", "入金番号");
    }
    if(msg.indexOf("deposit_method_code") > 0){
        return msg.replace("deposit_method_code", "入金方法コード");
    }
    if(msg.indexOf("due_date") > 0){
        return msg.replace("due_date", "期日");
    }
    if(msg.indexOf("application_amount") > 0){
        return msg.replace("application_amount", "消込金額");
    }
    return msg;
};