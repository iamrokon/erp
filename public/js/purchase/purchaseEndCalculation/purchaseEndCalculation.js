/*$(document).on('click','#contenthide',function(){
    $('#session_msg').empty();
    $('#error_data').empty();
    var nullCheck=0;
    var purchase_completion_date=$('#purchase_completion_date').val();
    var order_no=$('#order_no').val();
    // console.log(!orderNo,orderNo.length);
    if (!purchase_completion_date){
        nullCheck=1;
        var dyappend='<p>【仕入完了日】必須項目に入力がありません。</p>';
        $("#error_data").append(dyappend);
        $("#purchase_completion_date").addClass('error');
    }
    else {
        nullCheck=0;
        $("#purchase_completion_date").removeClass('error');
    }

    if (nullCheck==0){
        $('#warning_data').empty();
        $('#error_data').empty();
        $("#purchase_completion_date").removeClass('error');
        // $('#firstSearch').submit();
    }
})*/

var confirmMsg=0;
function createData() {
    $("#error_msg_div").empty();
    $("#success_msg").empty();
    $("#confirmation_message").empty();
    $(".loading-icon").show();


    var department_datachar05_start=$('#department_datachar05_start').val();
    var department_datachar05_end=$('#department_datachar05_end').val();
    var group_datachar05_start=$('#group_datachar05_start').val();
    var group_datachar05_end=$('#group_datachar05_end').val();
    var purchase_completion_date=$('#purchase_completion_date').val();
    var order_no=$('#order_no').val();
    var bango=$('#userId').val();
    var data = $('#insertData').serialize();
    var valCheck=0;
    // console.log('hlw');

    //required check for department,group
    /*if (!department_datachar05_start && !department_datachar05_end && !group_datachar05_start && !group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【部】必須項目に入力がありません。</p>' +
                     '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start,#department_datachar05_end,#group_datachar05_start,#group_datachar05_end").addClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        }, 1000);
    }
    else if (department_datachar05_start && !department_datachar05_end && !group_datachar05_start && !group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【部】必須項目に入力がありません。</p>' +
            '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_end,#group_datachar05_start,#group_datachar05_end").addClass('error');
        $("#department_datachar05_start").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        },1000);
    }
    else if (!department_datachar05_start && department_datachar05_end && !group_datachar05_start && !group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【部】必須項目に入力がありません。</p>' +
            '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start,#group_datachar05_start,#group_datachar05_end").addClass('error');
        $("#department_datachar05_end").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        },1000);
    }
    else if (!department_datachar05_start && !department_datachar05_end && group_datachar05_start && !group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【部】必須項目に入力がありません。</p>' +
            '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start,#department_datachar05_end,#group_datachar05_end").addClass('error');
        $("#group_datachar05_start").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        },1000);
    }
    else if (!department_datachar05_start && !department_datachar05_end && group_datachar05_start && group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【部】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start,#department_datachar05_end").addClass('error');
        $("#group_datachar05_start,#group_datachar05_end").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        },1000);
    }
    else if (department_datachar05_start && department_datachar05_end && !group_datachar05_start && !group_datachar05_end){
        valCheck=1;
        confirmMsg=0;
        var dyappend= '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#group_datachar05_start,#group_datachar05_end").addClass('error');
        $("#department_datachar05_start,#department_datachar05_end").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        },1000);
    }*/

    //required check for purchase_completion_date
    if (!purchase_completion_date){
        // console.log('hlw2');
        valCheck=1;
        confirmMsg=0;
        var dyappend='<p>【仕入完了日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#purchase_completion_date").addClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        }, 1000);
    }
    else {
        valCheck=0;
        $("#purchase_completion_date").removeClass('error');
        setTimeout(function(){
            $(".loading-icon").hide();
        }, 1000);
    }

    // alert(valCheck);

    /*if(purchase_completion_date && department_datachar05_start && department_datachar05_end && group_datachar05_start && group_datachar05_end){*/
    if(purchase_completion_date){
        // console.log('hlw5');
        valCheck=0;
        $("#purchase_completion_date,#department_datachar05_start,#department_datachar05_end,#group_datachar05_start,#group_datachar05_end").removeClass('error');
        $("#error_msg_div").empty();

        // console.log(data);
        $.ajax({
            type: 'POST',
            url: "purchase-end-calculation/validate/" + bango,
            data: data,
            success: function (result) {
                $("#error_msg_div").empty();
                console.log(result,valCheck,confirmMsg);
                if (result[0]==='ng') {
                    valCheck=1;
                    confirmMsg=0;
                    var dyappend='<p>該当するデータがありません。</p>';
                    $("#error_msg_div").append(dyappend);
                    setTimeout(function(){
                        $(".loading-icon").hide();
                    }, 1000);
                }
                else if (result[0]==='ng1'){
                    valCheck=1;
                    confirmMsg=0;
                    setTimeout(function(){
                        $(".loading-icon").hide();
                    }, 1000);
                    $("#success_msg").empty();
                    var dyappend = '<p>仕入完了計算済です。</p>';
                    $("#error_msg_div").append(dyappend);
                }
                else if (result[0]==='ok' && valCheck===0 && confirmMsg===1){
                    confirmMsg=0;
                    $("#confirmation_message").empty();
                    $("#error_msg_div").empty();
                    $.ajax({
                        type: 'POST',
                        url: "purchase-end-calculation/register/" + bango,
                        data: data,
                        success: function (response) {
                            $("#error_msg_div").empty();
                            console.log(response);
                            if (response[0] === 'ok') {
                                setTimeout(function(){
                                    $(".loading-icon").hide();
                                }, 1000);
                                $("#success_msg").empty();
                                var dyappend = '<div class="col-12" style="white-space: normal; word-break: break-all;">' +
                                '<div class="alert alert-primary alert-dismissible">' +
                                '<button type="button" class="close dismissMe" data-dismiss="alert" autofocus' + 'style="background-color: white;"' + ' onclick="$(\'#division_datachar05_start\')'+'.'+'focus()'+';'+'">' +
                                '&times;' +
                                '</button>' +
                                '<strong>正常に処理が終了しました。</strong>' +
                                '</div></div>';
                                $("#success_msg").append(dyappend);
                            }
                            else if (response[0]==='ng'){
                                setTimeout(function(){
                                    $(".loading-icon").hide();
                                }, 1000);
                                $("#success_msg").empty();
                                var dyappend = '<p>該当するデータがありません。</p>';
                                $("#error_msg_div").append(dyappend);
                            }
                            else if (response[0]==='ng1'){
                                setTimeout(function(){
                                    $(".loading-icon").hide();
                                }, 1000);
                                $("#success_msg").empty();
                                var dyappend = '<p>仕入完了計算済です。</p>';
                                $("#error_msg_div").append(dyappend);
                            }
                            else if (response[0]==='ng2'){
                                setTimeout(function(){
                                    $(".loading-icon").hide();
                                }, 1000);
                                $("#success_msg").empty();
                                var dyappend = '<p> 受注番号'+order_no+' 外注仕入未完了です。</p>';
                                $("#error_msg_div").append(dyappend);
                            }
                        },
                        /*beforeSend:function(){
                            $(".loading").addClass('show');
                        }*/
                    });
                }
                else if (result[0]==='ok' && valCheck===0 && confirmMsg===0){
                    confirmMsg=1;
                    $("#error_msg_div").empty();
                    var conmsg='登録はまだ完了していません。内容をご確認後、もう一度「データ作成」をお願いします。'
                    $("#confirmation_message").append(conmsg);
                    setTimeout(function(){
                        $(".loading-icon").hide();
                    }, 1000);
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
