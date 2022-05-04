var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}


// updatePurchaseResultList
function updatePurchaseInquiryResult(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var url = url;
        var data = $('#firstSearch').serialize();
        console.log(data);
        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();
        $.ajax({
            type:"POST",
            url: url,
            data:data+"&submit_confirmation="+submit_confirmation,
            success:function(result){
                if($.trim(result) == 'ok'){
                    $("#confirmation_message").html("");
                    location.reload();
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#update-success-msg").css("display","none");
                    $("#submit_confirmation").val('submit');
                    $('#error_data').html("");
                    // $('.intorder05_input').css("cssText", "1px solid lightgray !important;");
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください</p>';
                    $(document).find("#confirmation_message").html(confirmationMsg);
                    buttonPress = 0;
                }else{
                    // var inputError = result.errors;
                    buttonPress = 0;
                    // console.log(result, inputError);
                    $("#confirmation_message").html("");
                    
                    //reset submit confirmation
                    $("#submit_confirmation").val("");

                    var html = '';
                    if (result.err_status) {
                        html = '<div>';
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">仕入完了計算=済はフラグ変更できません</p>';
                        // for (var count = 0; count < result.err_msg.length; count++) {
                        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        // }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }
                    
                    //array field error
                    // for (var count = 0; count < inputError.length; count++) {
                    //     console.log(inputError[count])
                    //     if(inputError[count]==false){
                    //     var id = count+1;
                    //         var targetEl =  $("#row"+id).find(".selected_inspection");  
                    //         console.log(targetEl)                       
                    //         targetEl.addClass("error")
                    //         // targetEl.css("cssText", "border: 1px solid red !important;");
                    //     }
                    // }
                }
            }
        }); 
    } else {
      doubleClick();
    }
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function gotoPurchaseInquiryResult(support_number){
    $("#support_number").val(support_number);
    // $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToPurchaseInquiryResult").submit();
}


