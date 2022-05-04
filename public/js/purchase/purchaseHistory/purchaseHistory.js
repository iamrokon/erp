//on click checkbox1 data manipulation start
var countCheckedBox1=0;
//multiple chk box
$('.checkbox1').click(function() {
    countCheckedBox1=0;
    $('.tblCheckBox1').each(function() {
        if ($(this).prop('checked')==false){
            this.checked = true;
            countCheckedBox1++;
            $(this).parent().find('.tblCheckBox1_h').val(1);
        }
        else {
            this.checked = false;
            $(this).parent().find('.tblCheckBox1_h').val(0);
        }
    });
});
//single chk box
$('.tblCheckBox1').click(function() {
    setTimeout(function(){
    countCheckedBox1=0;
    $('.tblCheckBox1').each(function() {
        if ($(this).prop('checked')==true){
            countCheckedBox1++;
            $(this).parent().find('.tblCheckBox1_h').val(1);
        }
        else {
            $(this).parent().find('.tblCheckBox1_h').val(0);
        }
    });
    }, 1000);
});

//on click checkbox1 data manipulation end

//on click checkbox2 data manipulation start

var countCheckedBox2=0;
//multiple chk box
$('.checkbox2').click(function() {
    countCheckedBox2=0;
    $('.tblCheckBox2').each(function() {
        if ($(this).prop('checked')==false){
            this.checked = true;
            countCheckedBox2++;
            $(this).parent().find('.tblCheckBox2_h').val(1);
        }
        else {
            this.checked = false;
            $(this).parent().find('.tblCheckBox2_h').val(0);
        }
    });
});

//single chk box
$('.tblCheckBox2').click(function() {
    setTimeout(function(){
        countCheckedBox2=0;
        $('.tblCheckBox2').each(function() {
            if ($(this).prop('checked')==true){
                countCheckedBox2++;
                $(this).parent().find('.tblCheckBox2_h').val(1);
            }
            else {
                $(this).parent().find('.tblCheckBox2_h').val(0);
            }
        });
    }, 1000);
});
//on click checkbox2 data manipulation end

//151 button on press
$(document).on('click','#topSearchBtn',function(){
    $("#firstSearch").removeAttr("onsubmit", 'return false');
    $("#error_msg_div").empty();
    var datepicker1_h=$('#datepicker1').val();
    var datepicker2_h=$('#datepicker2').val();
    var datepicker3_h=$('#datepicker3').val();
    var datepicker4_h=$('#datepicker4').val();
    var purchaseNoFrom=$('#purchaseNoFrom').val();
    var purchaseNoTo=$('#purchaseNoTo').val();
    // alert(datepicker1_h,datepicker2_h);
    //  var deptCheck=0;
    var noCheck=0;
    var dateCheck=0;
    var dateCheck2=0;

    if (!datepicker1_h && !datepicker2_h){
        dateCheck=1;
        var dyappend='<p>【入力日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker1,#datepicker2").addClass('error');
    }
    else if (!datepicker1_h && datepicker2_h){
        dateCheck=1;
        var dyappend='<p>【入力日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker2").removeClass('error');
        $("#datepicker1").addClass('error');
    }
    else if (!datepicker2_h && datepicker1_h){
        dateCheck=1;
        var dyappend='<p>【入力日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker1").removeClass('error');
        $("#datepicker2").addClass('error');
    }
    else if (datepicker1_h > datepicker2_h){
        dateCheck=1;
        var dyappend='<p>【入力日】正しい年月日を入力してください。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker1,#datepicker2").addClass('error');
    }
    else {
        $("#datepicker1,#datepicker2").removeClass('error');
    }

    if (!datepicker3_h && !datepicker4_h){
        dateCheck2=1;
        var dyappend='<p>【仕入日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker3,#datepicker4").addClass('error');
    }
    else if (!datepicker3_h && datepicker4_h){
        dateCheck2=1;
        var dyappend='<p>【仕入日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker4").removeClass('error');
        $("#datepicker3").addClass('error');
    }
    else if (!datepicker4_h && datepicker3_h){
        dateCheck2=1;
        var dyappend='<p>【仕入日】必須項目に入力がありません。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker3").removeClass('error');
        $("#datepicker4").addClass('error');
    }
    else if (datepicker3_h > datepicker4_h){
        dateCheck2=1;
        var dyappend='<p>【仕入日】正しい年月日を入力してください。</p>';
        $("#error_msg_div").append(dyappend);
        $("#datepicker3,#datepicker4").addClass('error');
    }else {
        $("#datepicker3,#datepicker4").removeClass('error');
    }

    if ((purchaseNoFrom && purchaseNoTo) && (BigInt(purchaseNoFrom) > BigInt(purchaseNoTo))){
        noCheck=1;
        var dyappend='<p>【仕入番号】正しい番号を入力してください。</p>';
        $("#error_msg_div").append(dyappend);
        $("#purchaseNoFrom,#purchaseNoTo").addClass('error');
    }
    else {
        $("#purchaseNoFrom,#purchaseNoTo").removeClass('error');
    }

    if (dateCheck==0 && dateCheck2==0 && noCheck==0){
        $("#error_msg_div").empty();
        $("#datepicker1,#datepicker2,#datepicker3,#datepicker4,#purchaseNoFrom,#purchaseNoTo").removeClass('error');
        $('#firstSearch').submit();
    }
    // console.log(deptCheck,groupCheck,dateCheck)
});

//152 button on press
var confirmationOfRegister='0';
$('.checkbox1,.tblCheckBox1,.checkbox2,.tblCheckBox2').click(function(){
    confirmationOfRegister='0';
    $("#confirmation_message").empty();
});
$('#registrationBtn').click(function() {
    $('#error_msg_div').empty();
    var chk1Arr=[];
    var chk1StatusArr=[];
    var chk2Arr=[];
    var chk2StatusArr=[];
    var barcodeVal= $('#accountingSub').val();
    if (barcodeVal=='-'){
        barcodeVal=null;
    }
    countCheckedBox1=0;
    countCheckedBox2=0;
    var userId=$('#userId').val();
    var $i=0;
    $('.tblCheckBox1_h').each(function() {

        var chk1Val=$(this).parent().find('.ck1_val_h').val();
        chk1Arr.push(chk1Val);
        chk1StatusArr.push($(this).val());
        /*before spec changed starts*/
        /*if ($(this).val()==1){
            // chk1StatusArr.push(1);
            var chk1Val=$(this).parent().find('.ck1_val_h').val();
            var chk2valId=$(this).parent().find('.chk2Id').val();
            var chk2hId=$(this).parent().find('.chk2hId').val();
            // console.log(chk2valId);
            var chk2val=$(chk2valId).val();
            var chk2hval=$(chk2hId).val();

            if (chk1Arr.indexOf(chk1Val) == -1){
                countCheckedBox1++;
                chk1Arr.push(chk1Val);
                chk1StatusArr.push(1);
                chk2StatusArr.push(chk2hval);
                if (chk2Arr.indexOf(chk2val) == -1){
                    chk2Arr.push(chk2val);
                }
            }
        }*/
        /*before spec changed ends*/

    });
    $('.tblCheckBox2_h').each(function() {

        var chk2Val=$(this).parent().find('.ck2_val_h').val();
        chk2Arr.push(chk2Val);
        chk2StatusArr.push($(this).val());
        /*before spec changed starts*/
        /*if ($(this).val()==1){
            // chk2StatusArr.push(1)
            var chk2Val=$(this).parent().find('.ck2_val_h').val();
            var chk1valId=$(this).parent().find('.chk1Id').val();
            // console.log(chk1valId);
            var chk1val=$(chk1valId).val();
            // console.log(chk1val);
            if (chk2Arr.indexOf(chk2Val) == -1){
                countCheckedBox2++;
                chk2Arr.push(chk2Val);
                chk2StatusArr.push(1)
                if (chk1Arr.indexOf(chk1val) == -1){
                    chk1Arr.push('nodata');
                    // chk1StatusArr.push(0)
                }
            }
        }*/
        /*before spec changed ends*/
    });
    /*console.log(chk1Arr,chk1Arr.length,countCheckedBox1);
    console.log(chk2Arr,chk2Arr.length,countCheckedBox2);
    console.log(chk1StatusArr,chk1StatusArr.length,chk2StatusArr,chk2StatusArr.length);*/
    $('#error_msg_div,#success_msg').empty();
    console.log(chk1Arr,chk2Arr);
    // alert(chk1Arr.length,chk2Arr.length);


    if (confirmationOfRegister=='1'){
        // alert(chk1Arr.length,chk2Arr.length);
        $.ajax({
            type: 'GET',
            url: '/purchase-history/purchaseHistoryUpdate/'+ userId,
            data: {'chk1Arr': chk1Arr , 'chk2Arr': chk2Arr , 'userId': userId , 'chk1StatusArr': chk1StatusArr , 'chk2StatusArr': chk2StatusArr , 'barcodeVal': barcodeVal},
            dataType: 'json',
            success: function (data) {
                // alert(data);
                $('#error_msg_div,#success_msg').empty();
                if (data == 1){
                    location.reload();
                }
                else if (data==2){
                    confirmationOfRegister='0';
                    window.scrollTo(0, 0);
                    var eMsg='更新するものはありません。';
                    $('#error_msg_div').html(eMsg);
                    $("#confirmation_message").empty();
                }
                else {
                    confirmationOfRegister='0';
                    window.scrollTo(0, 0);
                    var eMsg='ng';
                    $('#error_msg_div').html(eMsg);
                    $("#confirmation_message").empty();
                }
            }
        });
    }
    else {
        $.ajax({
            type: 'GET',
            url: '/purchase-history/purchaseHistoryUpdateValidation/'+ userId,
            data: {'chk1Arr': chk1Arr , 'chk2Arr': chk2Arr , 'userId': userId , 'chk1StatusArr': chk1StatusArr , 'chk2StatusArr': chk2StatusArr , 'barcodeVal': barcodeVal},
            dataType: 'json',
            success: function (data) {
                // alert(data);
                $('#error_msg_div,#success_msg').empty();
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
                }
            }
        });
    }

    /*before spec changed starts*/
    /*if (confirmationOfRegister=='1'){
        $.ajax({
            type: 'GET',
            url: '/purchase-history/purchaseHistoryUpdate/'+ userId,
            data: {'chk1Arr': chk1Arr , 'chk2Arr': chk2Arr , 'userId': userId , 'chk1StatusArr': chk1StatusArr , 'chk2StatusArr': chk2StatusArr , 'barcodeVal': barcodeVal},
            dataType: 'json',
            success: function (data) {
                // alert(data);
                $('#error_msg_div,#success_msg').empty();
                if (data == 1){
                    location.reload();
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
                else {
                    window.scrollTo(0, 0);
                    var eMsg='ng';
                    $('#error_msg_div').html(eMsg);
                }
            }
        });
    }
    else {
        if (chk1Arr.indexOf('nodata') == -1){
            // alert('hlw');
            console.log(chk1Arr,chk2Arr);
            if ((chk1Arr.length==chk2Arr.length) && (chk1Arr.length>0 && chk2Arr.length>0)){
                confirmationOfRegister='1';
                var conmsg='登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。'
                $("#confirmation_message").append(conmsg);
            }
            else {
                confirmationOfRegister='0';
                var errmsg='指示が必要です。';
                $("#error_msg_div").append(errmsg);
                $("#confirmation_message").empty();
            }

        }
        else {
            confirmationOfRegister='0';
            var errmsg='指示が必要です。';
            $("#error_msg_div").append(errmsg);
            $("#confirmation_message").empty();
        }
    }*/
    /*before spec changed ends*/


});

//purchase inquiry start
function gotoPurchaseInquiry(pNo,cNo,lNo){
    $("#pNo").val(pNo);
    $("#cNo").val(cNo);
    $("#lNo").val(lNo);
    $("#PurchaseInquiryForm").submit();
}

