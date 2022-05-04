var buttonPress = 0;
var willUpdate = false;

function doubleClick(){
    alert('処理中です');
}

function balanceUpdate(url) {
    buttonPress++;
    if (buttonPress == 1) {
        if(willUpdate)
        {
            willUpdate = false;
            var url = url;
            var data = $('#balance_update_form').serialize();
            $('#success-msg').css("display","none");
            $('#no-data-msg').css("display","none");
            $('#error_data').css("display","none");
            $("#confirmation_message").html("");
            $(".loading-icon").show();
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                success:function(result){
                    buttonPress = 0;
                    $(".loading-icon").hide();
                    if($.trim(result) == 'ok'){
                        $('#success-msg').css("display","block");
                    }else if($.trim(result) == 'nd'){
                        $('#no-data-msg').css("display","block");
                    }else{
                        $('#error_data').css("display","block");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $('#error_data').css("display","block");
                }
            });
        }
        else
        {
            var confirmationMsg = '<p style="margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「実行」をお願いします。</p>';
            $("#confirmation_message").html(confirmationMsg);
            $('#success-msg').css("display","none");
            $('#no-data-msg').css("display","none");
            willUpdate = true;
            buttonPress = 0;
        }
    } else {
        doubleClick();
    }
}