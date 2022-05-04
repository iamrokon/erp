$(document).on('click','#pdfCreationBtn',function(){
    $("#firstSearch").attr("onsubmit", 'return false');
});

//202 button on press
$(document).on('click','#topSearchBtn',function(){
    $('#error_msg_div').empty();
    var dateDeadLine=$('#datepicker1_oen').val();
    var information1_short=$('#tsearch_information1_db').val();
    var information2_short=$('#tsearch_information2_db').val();
    var paymentDateFrom=$('#datepicker2_oen').val();
    var paymentDateTo=$('#datepicker3_oen').val();
    var dateCheck1=0;
    var informationCheck=0;
    var dateCheck2=0;

    if (!dateDeadLine){
        dateCheck1=1;
        var dyappend='<p>【締切日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker1_oen").addClass('error');
    }
    else {
        $("#datepicker1_oen").removeClass('error');
    }

    if ((information1_short && information2_short) && (BigInt(information1_short) > BigInt(information2_short))){
        informationCheck=1;
        var dyappend='<p>【仕入先】仕入先2は仕入先1より大きい番号を入力してください。</p>';
        $("#error_msg_div").append(dyappend);
        $("#tsearch_information1_v2,#tsearch_information2_v2").addClass('error');
    }
    else {
        $("#tsearch_information1_v2,#tsearch_information2_v2").removeClass('error');
    }

    if (!paymentDateFrom && !paymentDateTo){
        dateCheck2=1;
        var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker2_oen,#datepicker3_oen").addClass('error');
    }
    else if (!paymentDateFrom && paymentDateTo){
        dateCheck2=1;
        var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker3_oen").removeClass('error');
        $("#datepicker2_oen").addClass('error');
    }
    else if (!paymentDateTo && paymentDateFrom){
        dateCheck2=1;
        var dyappend='<p>【支払日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker2_oen").removeClass('error');
        $("#datepicker3_oen").addClass('error');
    }
    else if (paymentDateFrom > paymentDateTo){
        dateCheck2=1;
        var dyappend='<p>【支払日】正しい年月日を入力してください。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker2_oen,#datepicker3_oen").addClass('error');
    }
    else {
        $("#datepicker2_oen,#datepicker3_oen").removeClass('error');
    }

    console.log((BigInt(information1_short) > BigInt(information2_short)))

    if (dateCheck1===0 && informationCheck===0 && dateCheck2===0){
        $("#error_msg_div").empty();
        $("#datepicker1_oen,#tsearch_information1_v2,#tsearch_information2_v2,#datepicker2_oen,#datepicker3_oen").removeClass('error');
        $('#firstSearch').submit();
    }
})
//203 button on press
$(document).on('click','#pdfCreationBtn',function(){
    $('#error_msg_div').empty();
    var searchedDataCount = $('#searchedDataCount').val();
    var dateDeadLine = $('#dateDeadLineReqVal').val();
    var information1_short = $('#information1_shortReqVal').val();
    var information2_short = $('#information2_shortReqVal').val();
    var paymentDateFrom = $('#paymentDateFromReqVal').val();
    var paymentDateTo = $('#paymentDateToReqVal').val();
    var paymentMethod = $('#paymentMethodReqVal').val();
    var rd1= $('#rd1ReqVal').val();
    var userId=$('#userId').val();
    // console.log(searchedDataCount);
    if (searchedDataCount>0){
        $(".progress").show();
        $.ajax({
            type: 'GET',
            url: '/payment-schedule/downloadPaymentScheduleZip/'+ userId,
            data: {'dateDeadLine': dateDeadLine , 'information1_short': information1_short , 'information2_short': information2_short , 'paymentDateFrom': paymentDateFrom ,'paymentDateTo': paymentDateTo , 'paymentMethod': paymentMethod , 'rd1': rd1 , 'userId': userId },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // location.reload();
                $('#error_msg_div,#success_msg').empty();
                if (data[0] == 1){
                    $('#progress-bar').css({"width": "100%"});
                    $('#success_msg').removeClass('d-none');
                    setTimeout('sleepfor1()', 2000);

                    var msg = '<div class="col-12" style="white-space: normal; word-break: break-all;">\n' +
                        '             <div class="alert alert-primary alert-dismissible">\n' +
                        '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                        '                             onclick="$(\'#datepicker1_oen\').focus();">\n' +
                        '                        &times;\n' +
                        '                    </button>\n' +
                        '                    <strong>ダウンロードが完了しました。</strong>\n' +
                        '                </div>\n' +
                        '            </div>';
                    $('#success_msg').html(msg);
                    $('.dismissMe').focus();
                    $("#zipName").val(data[1]);
                    var filename = data[1];
                    console.log(data[1]);
                    var position = data[1].lastIndexOf("/");
                    var filename = data[1].substr(position+1);
                    download(data[1],filename);
                    // $("#DownloadPaymentScheduleZipForm").submit();
                }
                else if (data[0]==2){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。(pdfに失敗しました)';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data[0]==3){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。(zip3に失敗しました)';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data[0]==4){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。(zip4に失敗しました)';
                    $('#error_msg_div').html(eMsg);
                }
            }
        });
    }
    else {
        $(".progress").hide();
        /*var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);*/
    }
});

function sleepfor1() {
    $(".progress").hide();
    // location.reload();
}

$( document ).ready(function() {
    setTimeout('sleepfor2()', 400);
});

function sleepfor2() {
    var searchedDataCount=$("#searchedDataCount").val();
    console.log(searchedDataCount,BigInt(searchedDataCount)<1);
    if ((searchedDataCount) && BigInt(searchedDataCount)<1){
        $("#excelDwld").attr("disabled","disabled");
    }
}

// Focus on Alert Closing
$(".dismissMe").keydown(function(e) {
    if (e.shiftKey && e.which == 13) {
        $('.close').alert('close');
        event.preventDefault();
        document.getElementById("datepicker1_oen").click();
        $('#datepicker1_oen').focus();
    }
});

function download(res,filename){
    fetch(res)
        .then(resp => resp.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        });
}

function showTableSettingPaymentSchedule(url) {

    var radioFilter=$("input[type='radio'][name='rd1']:checked").val();
    console.log(radioFilter)
    $.ajax({
        type: "GET",
        url: url,
        data:{'radioFilter':radioFilter},
        success: function (response) {
            $("#setting_display_modal input").parent().find('input').removeClass("error");
            $('#errorShow').empty();
            if (typeof (response) == 'string') {
                $('#setting_display_modal').modal('show');
            } else {
                for (var key in response) {
                    // console.log(key + '=' + response[key]);
                    if (response[key] > 199) {
                        document.getElementById('setting_' + key).value = '';
                        // $('#setting_' + key).prop('readonly', true);
                    } else {
                        document.getElementById('setting_' + key).value = response[key];
                    }
                    if (response[key] || response[key] == '0') {
                        document.getElementById("check_" + key).checked = true;
                        if( $('#setting_' + key).prop('readonly')){
                            $('#setting_' + key).prop('readonly', false);
                        }
                    }

                    else {
                        document.getElementById("check_" + key).checked = false;
                        $('#setting_' + key).prop('readonly', true);
                    }
                }

                $('#setting_display_modal').modal('show');
            }
        },
    });
}
