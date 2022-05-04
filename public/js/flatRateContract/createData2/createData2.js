var confirmMsg=0;
function createData() {
    $("#error_msg_div").empty();
    $("#confirmation_message").empty();
    $(".customalert, .loading-icon").show();
    var datachar05_val=$('#datachar05').val();
    var order_no_val=$('#order_no').val();
    var bango=$('#userId').val();
    var data = $('#insertData').serialize();
    var valCheck=0;
    // console.log('hlw');
    /*if (!datachar05_val && !order_no_val){
        // console.log('hlw2');
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【担当】必須項目に入力がありません。</p>' +
                         '<p>【受注番号】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datachar05,#order_no").addClass('error');
            $(".customalert, .loading-icon").hide();
    }
    else if(!datachar05_val && order_no_val){
        // console.log('hlw3');
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【担当】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#order_no").removeClass('error');
            $("#datachar05").addClass('error');
            $(".customalert, .loading-icon").hide();
    }
    else if(datachar05_val && !order_no_val){
        // console.log('hlw4');
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【受注番号】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datachar05").removeClass('error');
            $("#order_no").addClass('error');
            $(".customalert, .loading-icon").hide();
    }*/
    if (!datachar05_val ){
        // console.log('hlw2');
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【担当】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datachar05").addClass('error');
        $(".customalert, .loading-icon").hide();
    }
    /*else if(datachar05_val && order_no_val){*/
    else if(datachar05_val){
        // console.log('hlw5');
        valCheck=0;
        /*$("#datachar05,#order_no").removeClass('error');*/
        $("#datachar05").removeClass('error');
        $("#error_msg_div").empty();

        // console.log(data);
        $.ajax({
            type: 'POST',
            url: "create-data2/validate/" + bango,
            data: data,
            success: function (result) {
                $("#error_msg_div").empty();
                console.log(result);
                if (result.trim()=='ng'){
                    valCheck=1;
                    confirmMsg=0;
                    var dyappend='<p>該当するデータがありません。</p>';
                    $("#error_msg_div").append(dyappend);
                    $(".loading-icon").hide();
                }
                else if (result.trim()==='ok' && valCheck===0 && confirmMsg===1){
                    confirmMsg=0;
                    $("#confirmation_message").empty();
                    $("#error_msg_div").empty();
                    $.ajax({
                        type: 'POST',
                        url: "create-data2/register/" + bango,
                        data: data,
                        success: function (response) {
                            $("#error_msg_div").empty();
                            console.log(response);
                            if (response[0] == 'ok') {
                                $(".loading-icon").hide();
                                $("#success_msg").empty();
                                var dyappend = response[1];
                                $("#success_msg").append(dyappend);
                            } else if (response[0] == 'ng') {
                                $(".loading-icon").hide();
                                $("#success_msg").empty();
                                var dyappend = response[1];
                                $("#error_msg_div").append(dyappend);
                            }else if ($.trim(response) == 'no_data_found') {
                                $(".loading-icon").hide();
                                $("#success_msg").empty();
                                var dyappend='<p>該当するデータがありません。</p>';
                                $("#error_msg_div").append(dyappend);
                            }
                        },
                        /*beforeSend:function(){
                            $(".loading").addClass('show');
                        }*/
                    });
                }
                else if (result.trim()==='ok' && valCheck===0 && confirmMsg===0){
                    confirmMsg=1;
                    $("#error_msg_div").empty();
                    var conmsg='登録はまだ完了していません。内容をご確認後、もう一度「データ作成」をお願いします。'
                    $("#confirmation_message").append(conmsg);
                    $(".customalert, .loading-icon").hide();
                }

                // console.log(valCheck)


            },
            /*beforeSend:function(){
                $(".loading").addClass('show');
            }*/
        });
        console.log(bango,data);
    }
    else {
        //submit confirmation check
        console.log('hlw6');

    }

}
