var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function registerPaymentScheduleCal() {
    var submit_confirmation = $("#submit_confirmation").val();
    var bango = $("#userId").val();
    var data = $('#firstSearch').serialize();
    
    $.ajax({
        type: 'POST',
        url: "paymentScheduleCal/registerPaymentScheduleCal/" + bango,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#error_data").hide();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $(".common_error").css("display","none");
                $(".success-msg-box").css("display","none");
                
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
            }else if ($.trim(result) == 'payment_con_err'){
                $(".success-msg-box").css("display","none");
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html("締切日が支払確定済です。");
            }else if ($.trim(result.status) == 'data_check_err'){
                $(".success-msg-box").css("display","none");
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html(result.msg);
            }  else {
                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");

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

                if (inputError.payment_deadline) {
                    $('#payment_deadline').addClass("error");
                } else {
                     $('#payment_deadline').removeClass("error");
                }
              
                if (inputError.payment_date) {
                    $('#payment_date').addClass("error");
                } else {
                     $('#payment_date').removeClass("error");
                }
                
                if (inputError.deadline) {
                    $('#deadline').addClass("error");
                } else {
                     $('#deadline').removeClass("error");
                }

            }
        }
    });
}

$(document).ready(function(){
    dateCal();
});

function dateCal(){
    var payment_deadline = $("#payment_deadline").val().substring(2, 4);
    var previous_date = $("#temp_previous_date").val();
    var system_day = $("#system_day").val();
    var payment_date = $("#temp_start_date").val();
    var temp_end_date = $("#temp_end_date").val();
    //var payment_date = temp_start_date.substring(0, 8) + payment_deadline;
    var deadline = temp_end_date.substring(0, 8) + payment_deadline;
    
    if(payment_deadline > system_day){
        deadline = previous_date.substring(0, 8) + payment_deadline;
    }
    
    $("#payment_date").val(payment_date);
    $("#payment_date_hidden").val(payment_date);
    $("#deadline").val(deadline);
    $("#deadline_hidden").val(deadline);
}