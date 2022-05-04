var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function registerAccountBalance() {
    var submit_confirmation = $("#submit_confirmation").val();
    var bango = $("#userId").val();
    var data = $('#mainForm').serialize();
    //$('.loading-icon').show();
    $.ajax({
        type: 'POST',
        url: "accountBalanceUpdate",
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $('.loading-icon').hide();
                $("#error_data").hide();
                $("#session_msg").css("display","none");
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「実行」をお願いします。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
            }else if ($.trim(result) == 'no_data_found'){
               $('.loading-icon').hide();
                $(".success-msg-box").css("display","none");
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html("該当するデータがありません。");
            }else if ($.trim(result) == 'no_date'){
                $('.loading-icon').hide();
                $("#session_msg").css("display","none");
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html("仕入確定日が未入力です。");
            }else if ($.trim(result) == 'invalid_date'){
                $('.loading-icon').hide();
                $("#session_msg").css("display","none");
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html("仕入確定日が不正です。");
            }else if ($.trim(result) == 'ng'){
                $('.loading-icon').hide();
                $("#session_msg").css("display","none");
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#error_data").show();
                $("#error_data").html("Database Error.");
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
              
               

            }
        }
    });
}

