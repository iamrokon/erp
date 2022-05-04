document.querySelector("#order_no").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
{
    evt.preventDefault();
}
});

$(document).ready(function(){
    $("#order_no").change(function(){
        var orderNo=$("#order_no").val();
        var userId=$("#user_id").val();
        if (orderNo){
            $.ajax({
                type: 'GET',
                url: '/cancellation-of-pre-orders/cancellationOfPreOrdersInfo/'+ userId,
                data: {'orderNo': orderNo , 'userId': userId },
                dataType: 'json',
                success: function (data) {
                    // alert(data);
                    /*$('#error_msg_div,#success_msg').empty();
                    if (data == 0){
                        // location.reload();
                        confirmationOfRegister='0';
                        window.scrollTo(0, 0);
                        var eMsg='指示が必要です。';
                        $('#error_msg_div').html(eMsg);
                    }
                    else if (data==1){
                        confirmationOfRegister='1';
                        var conmsg='登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。'
                        $("#confirmation_message").append(conmsg);
                    }
                    else {
                        confirmationOfRegister='0';
                        window.scrollTo(0, 0);
                        var eMsg='ng';
                        $('#error_msg_div').html(eMsg);
                    }*/
                }
            });
        }
    });
});
