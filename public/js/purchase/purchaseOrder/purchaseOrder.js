$(document).on('click','#correction_checkbox',function(){
    var value=$(this).is(':checked');
    var defaultSrc = $('#defaultSrc_h').val();
    if($(this).is(':checked')){
        $(this).parent().find('#correction_checkbox_h').val(1)
        $("#stampButton,#customprogress,#emailSendingButton").attr("disabled", 'disabled');
    } else {
        $(this).parent().find('#correction_checkbox_h').val(0)
        $("#stampButton,#customprogress,#emailSendingButton").removeAttr("disabled", 'disabled');
    }
    console.log(defaultSrc)
    if (defaultSrc=='1'){
        $('#firstSearch').submit();
    }
});

var countCheckedBox=0;
$('.check-tblall').click(function() {
    countCheckedBox=0;
    var allChkBxFlag=$('#allChkBxFlag').val();
    $('.tblCheckBox').each(function() {
        /*if ($(this).prop('checked')==false){
            this.checked = true;
            countCheckedBox++;
            $(this).parent().find('.tblCheckBox_h').val(1);
        }
        else {
            this.checked = false;
            $(this).parent().find('.tblCheckBox_h').val(0);
        }*/
        if (allChkBxFlag=='0'){
            this.checked = true;
            countCheckedBox++;
            $(this).parent().find('.tblCheckBox_h').val(1);
            $('#allChkBxFlag').val(1);
        }
        else if (allChkBxFlag=='1') {
            this.checked = false;
            $(this).parent().find('.tblCheckBox_h').val(0);
            $('#allChkBxFlag').val(0);
        }
    });
    if (countCheckedBox!=0){
        $("#checkedSum").html(countCheckedBox);
    }
    else {
        $("#checkedSum").html('');
    }
});

$('.tblCheckBox').click(function() {
    countCheckedBox=0;
    $('.tblCheckBox').each(function() {
        if ($(this).prop('checked')==true){
            countCheckedBox++;
            $(this).parent().find('.tblCheckBox_h').val(1);
        }
        else {
            $(this).parent().find('.tblCheckBox_h').val(0);
        }
    });
    if (countCheckedBox!=0){
        $("#checkedSum").html(countCheckedBox);
    }
    else {
        $("#checkedSum").html('');
    }
});
//121 button on press
$('#stampButton').click(function() {
    $('#error_msg_div').empty();
    var syouhinIdArr=[];
    var syouhinIdDateArr=[];
    var userId=$('#userId').val();
    $('.tblCheckBox_h').each(function() {
        if ($(this).val()==1){
            var syouhinId=$(this).parent().find('.tblCheckBox').val();
            var denpyoshimebi=$(this).parent().find('.hikiatenyukoDate_h').val();
            if (syouhinIdArr.indexOf(syouhinId) == -1){
                syouhinIdArr.push(syouhinId);
                syouhinIdDateArr.push(denpyoshimebi)
            }
        }

    });
    // console.log(syouhinIdArr,syouhinIdArr.length,syouhinIdDateArr);

    if (syouhinIdDateArr.length>0){
        $.ajax({
            type: 'GET',
            url: '/purchase-order/purchaseStampUpdate/'+ userId,
            data: {'syouhinIds': syouhinIdArr , 'syouhinIdDates': syouhinIdDateArr , 'userId': userId },
            dataType: 'json',
            success: function (data) {
                // alert(data);
                $('#error_msg_div,#success_msg').empty();
                if (data == 1){
                    location.reload();
                    /*var msg = '     <div class="col-12">\n' +
                        '                <div class="alert alert-primary alert-dismissible">\n' +
                        '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                        '                            style="background-color: white;" onclick="$(\'#division_datachar05_start\').focus();">\n' +
                        '                        &times;\n' +
                        '                    </button>\n' +
                        '                    <strong style="font-size: 12px !important;">検印処理を行いました。</strong>\n' +
                        '                </div>\n' +
                        '            </div>';
                    $('#success_msg').html(msg);*/
                }
                else if (data==2){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data==3){
                    window.scrollTo(0, 0);
                    var dMsg='他のユーザーこのテータを変更しています。再度検索してデータを取得し直して下さい。';
                    $('#error_msg_div').html(dMsg);
                }
            }
        });
    }
    else {
        var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);
    }

});
//122 button on press
$('#customprogress').click(function() {
    $('#error_msg_div').empty();
    var syouhinIdArr=[];
    var syouhinIdDateArr=[];
    var correctionOrdersArr=[];
    var userId=$('#userId').val();
    $('.tblCheckBox_h').each(function() {
        if ($(this).val()==1){
            var syouhinId=$(this).parent().find('.tblCheckBox').val();
            var denpyoshimebi=$(this).parent().find('.hikiatenyukoDate_h').val();
            var ordertypebango2=$(this).parent().find('.correction_orders_h').val();
            if (syouhinIdArr.indexOf(syouhinId) == -1){
                syouhinIdArr.push(syouhinId);
                syouhinIdDateArr.push(denpyoshimebi)
                correctionOrdersArr.push(ordertypebango2)
            }
        }

    });
    // console.log(syouhinIdArr,syouhinIdArr.length,syouhinIdDateArr);

    if (syouhinIdDateArr.length>0){
        $.ajax({
            type: 'GET',
            url: '/purchase-order/purchasePdfCreate/'+ userId,
            data: {'syouhinIds': syouhinIdArr , 'syouhinIdDates': syouhinIdDateArr , 'userId': userId ,'correctionOrders': correctionOrdersArr },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // location.reload();
                $('#error_msg_div,#success_msg').empty();
                if (data == 1){
                    $('#progress-bar').css({"width": "100%"});
                    setTimeout('sleepfor1()', 2000);

                    /*var msg = '     <div class="col-12">\n' +
                        '                <div class="alert alert-primary alert-dismissible">\n' +
                        '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                        '                            style="background-color: white;" onclick="$(\'#division_datachar05_start\').focus();">\n' +
                        '                        &times;\n' +
                        '                    </button>\n' +
                        '                    <strong style="font-size: 12px !important;">検印処理を行いました。</strong>\n' +
                        '                </div>\n' +
                        '            </div>';
                    $('#success_msg').html(msg);*/
                }
                else if (data==2){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data==3){
                    window.scrollTo(0, 0);
                    var dMsg='他のユーザーこのテータを変更しています。再度検索してデータを取得し直して下さい。';
                    $('#error_msg_div').html(dMsg);
                }
            }
        });
    }
    else {
        $(".progress").hide();
        var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);
    }

});

function sleepfor1() {
    location.reload();
}

//123 button on press
$('#emailSendingButton').click(function() {
    $('#error_msg_div').empty();
    var syouhinIdArr=[];
    $('.tblCheckBox_h').each(function() {
        if ($(this).val()==1){
            var syouhinId=$(this).parent().find('.tblCheckBox').val();
            if (syouhinIdArr.indexOf(syouhinId) == -1){
                syouhinIdArr.push(syouhinId);
            }
        }

    })
    if (syouhinIdArr.length>0){
        $('#confirm_email_transmission_modal').removeClass('d-none');
    }
    else {
        $('#confirm_email_transmission_modal').modal('toggle');
        var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);
    }

});

//send mail

$('#choice_button').click(function() {
        $('#error_msg_div').empty();
        var syouhinIdArr=[];
        var syouhinIdDateArr=[];
        var correctionOrdersArr=[];
        var userId=$('#userId').val();
        $('.tblCheckBox_h').each(function() {
            if ($(this).val()==1){
                var syouhinId=$(this).parent().find('.tblCheckBox').val();
                var denpyoshimebi=$(this).parent().find('.hikiatenyukoDate_h').val();
                var ordertypebango2=$(this).parent().find('.correction_orders_h').val();
                if (syouhinIdArr.indexOf(syouhinId) == -1){
                    syouhinIdArr.push(syouhinId);
                    syouhinIdDateArr.push(denpyoshimebi)
                    correctionOrdersArr.push(ordertypebango2)
                }
            }

        });
    // console.log(syouhinIdArr,correctionOrdersArr);

    if (syouhinIdDateArr.length>0){
        $.ajax({
            type: 'GET',
            url: '/purchase-order/purchaseSendEmail/'+ userId,
            data: {'syouhinIds': syouhinIdArr , 'syouhinIdDates': syouhinIdDateArr , 'userId': userId ,'correctionOrders': correctionOrdersArr },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // location.reload();
                $('#error_msg_div,#success_msg').empty();
                if (data == 1){
                    location.reload();
                    /*var msg = '     <div class="col-12">\n' +
                        '                <div class="alert alert-primary alert-dismissible">\n' +
                        '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                        '                            style="background-color: white;" onclick="$(\'#division_datachar05_start\').focus();">\n' +
                        '                        &times;\n' +
                        '                    </button>\n' +
                        '                    <strong style="font-size: 12px !important;">検印処理を行いました。</strong>\n' +
                        '                </div>\n' +
                        '            </div>';
                    $('#success_msg').html(msg);*/
                }
                else if (data==2){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data==3){
                    window.scrollTo(0, 0);
                    var dMsg='他のユーザーこのテータを変更しています。再度検索してデータを取得し直して下さい。';
                    $('#error_msg_div').html(dMsg);
                }else {
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
            }
        });
    }
    else {
        var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);
    }
});

$(document).on('click','#stampButton,#customprogress,#emailSendingButton',function(){
    var correction_checkbox_h_val=$("#correction_checkbox_h").val();
    $("#firstSearch").attr("onsubmit", 'return false');
});

$(document).on('click','#topSearchBtn',function(){
    $("#firstSearch").removeAttr("onsubmit", 'return false');
    $("#error_msg_div").empty();
    /*var department_datachar05_start=$('#department_datachar05_start').val();
    var department_datachar05_end=$('#department_datachar05_end').val();
    var group_datachar05_start=$('#group_datachar05_start').val();
    var group_datachar05_end=$('#group_datachar05_end').val();*/
    var datepicker1_h=$('#datepicker1').val();
    var datepicker2_h=$('#datepicker2').val();
    // alert(datepicker1_h,datepicker2_h);
    //  var deptCheck=0;
    var groupCheck=0;
    var dateCheck=0;

    /*if(!department_datachar05_start && !department_datachar05_end){
        deptCheck=1;
        var dyappend='<p>【部】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start,#department_datachar05_end").addClass('error');
    }

    else if(!department_datachar05_start && department_datachar05_end){
        deptCheck=1;
        var dyappend='<p>【部1】必須項目に入力がありません。</p>' ;
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_end").removeClass('error');
        $("#department_datachar05_start").addClass('error');
    }
    else if(department_datachar05_start && !department_datachar05_end){
        deptCheck=1;
        var dyappend='<p>【部2】必須項目に入力がありません。</p>' ;
        $("#error_msg_div").append(dyappend);
        $("#department_datachar05_start").removeClass('error');
        $("#department_datachar05_end").addClass('error');
    }
    else {
        $("#department_datachar05_start,#department_datachar05_end").removeClass('error');
    }

    if(!group_datachar05_start && !group_datachar05_end){
        groupCheck=1;
        var dyappend= '<p>【グループ】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#group_datachar05_start,#group_datachar05_end").addClass('error');
    }
    else if(!group_datachar05_start && group_datachar05_end){
        groupCheck=1;
        var dyappend='<p>【グループ1】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#group_datachar05_end").removeClass('error');
        $("#group_datachar05_start").addClass('error');
    }
    else if(group_datachar05_start && !group_datachar05_end){
        groupCheck=1;
        var dyappend='<p>【グループ2】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#group_datachar05_start").removeClass('error');
        $("#group_datachar05_end").addClass('error');
    }
    else {
        $("#group_datachar05_start,#group_datachar05_end").removeClass('error');
    }*/

    if (!datepicker1_h && !datepicker2_h){
            dateCheck=1;
            var dyappend='<p>【発注日1】必須項目に入力がありません。</p>' +
                         '<p>【発注日2】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datepicker1,#datepicker2").addClass('error');
        }
        else if (!datepicker1_h && datepicker2_h){
            dateCheck=1;
            var dyappend='<p>【発注日1】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datepicker2").removeClass('error');
            $("#datepicker1").addClass('error');
        }
        else if (!datepicker2_h && datepicker1_h){
            dateCheck=1;
            var dyappend='<p>【発注日2】必須項目に入力がありません。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datepicker1").removeClass('error');
            $("#datepicker2").addClass('error');
        }
        else if (datepicker1_h > datepicker2_h){
            dateCheck=1;
            var dyappend='<p>【発注日】正しい年月日を入力してください。</p>';
            $("#error_msg_div").append(dyappend);
            $("#datepicker1,#datepicker2").addClass('error');
    }
        /*else {
        $("#datepicker1,#datepicker2").removeClass('error');
    }*/

    // if (deptCheck==0 && groupCheck==0 && dateCheck==0){
    if (dateCheck==0){
        $("#error_msg_div").empty();
        $("#department_datachar05_start,#department_datachar05_end,#group_datachar05_start,#group_datachar05_end#datepicker1,#datepicker2").removeClass('error');
        $('#firstSearch').submit();
    }
    // console.log(deptCheck,groupCheck,dateCheck)
});

//download Purchase Order Pdf start
function downloadPurchaseOrderPdf(datachar09,kokyakuorderbango,ordertypebango2,bango){
    $('#error_msg_div').empty();
    var pdfName=datachar09;
    var pdfOrderNo=kokyakuorderbango;
    var pdfCorrectionNo=ordertypebango2;
    var userId=bango;
    if (pdfName){
        $.ajax({
            type: 'GET',
            url: '/purchase-order/downloadPurchaseOrderPdfConfirm/'+ userId,
            data: {'pdfName': pdfName , 'pdfOrderNo': pdfOrderNo , 'pdfCorrectionNo': pdfCorrectionNo ,'userId': userId },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // location.reload();
                $('#error_msg_div,#success_msg').empty();
                if (data == 0){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data==1){
                    window.scrollTo(0, 0);
                    var eMsg='該当するデータがありません。';
                    $('#error_msg_div').html(eMsg);
                }
                else if (data==3){
                    $("#pdfName").val(datachar09);
                    $("#pdfOrderNo").val(kokyakuorderbango);
                    $("#pdfCorrectionNo").val(ordertypebango2);
                    $("#DownloadPurchaseOrderPdfForm").submit();
                }
            }
        });
    }
    else {
        window.scrollTo(0, 0);
        var eMsg='該当するデータがありません。';
        $('#error_msg_div').html(eMsg);
    }

}
