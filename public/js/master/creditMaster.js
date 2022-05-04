//ajax set up
$.ajaxSetup({
    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }
});//end ajax set up


/////////edit function///////////////
function editCredit5(url)
{
   var data = $('#editCreditForm').serialize();
    var token = document.getElementById("token").value;
   $.ajax({
      type: 'POST',
      url: url,
        headers: {
           'X-CSRF-Token': token
        },
      data: data,
      success: function(result){
        console.log(result);
        if ($.trim(result)=='ok')
        {
            $('#credit_modal3').modal('hide');
            location.reload();
        }
        else
        {
            var inputError =result.err_field;

            var html = '';
            if(result.err_msg)
            {
            html = '<div>';

            for(var count = 0; count < result.err_msg.length; count++)
            {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
            }
            html += '</div>';

            $('#error_dataEdit').html(html);

            $("#error_dataEdit").show();
            }

            if (inputError.editCreditKounyusu)
             {
                $('#editCreditKounyusu').addClass("error");
             }
             else
             {
                $('#editCreditKounyusu').removeClass("error");
             }
            if (inputError.editCreditSyukei4)
             {
                $('#editCreditSyukei4').addClass("error");
             }
             else
             {
                $('#editCreditSyukei4').removeClass("error");
             }
        }
      }
      });
}
///////////////end edit function//////

///////////view credit detail////////////

function showSingleCredit(url, id) {
    $.ajax({
        type: 'GET',
        url: url,
        data: {bango: id},
        success: function (result) {
            console.log(result);
            if (result[0]['mailflagu'] == 1)
            {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('creditButton3').style.display = 'none';
            }
            if (result[0]['mail'])
            {
                var date11 = result[0]['mail'].substr(0, 4);
                var date12 = result[0]['mail'].substr(4, 2);
                var date13 = result[0]['mail'].substr(6, 2);
                result[0]['mail11'] = date11+'-'+date12+'-'+date13;
                var time11 = result[0]['mail'].substr(8, 2);
                var time12 = result[0]['mail'].substr(10, 2);
                var time13 = result[0]['mail'].substr(12, 2);
                result[0]['mail12'] = time11+':'+time12+':'+time13;
            }
            if (result[0]['mail2'])
            {
                var date21 = result[0]['mail2'].substr(0, 4);
                var date22 = result[0]['mail2'].substr(4, 2);
                var date23 = result[0]['mail2'].substr(6, 2);
                result[0]['mail21'] = date21+'-'+date22+'-'+date23;
                var time21 = result[0]['mail2'].substr(8, 2);
                var time22 = result[0]['mail2'].substr(10, 2);
                var time23 = result[0]['mail2'].substr(12, 2);
                result[0]['mail22'] = time21+':'+time22+':'+time23;
            }
            $("#creditDetailBango").html(breakData(result[0]['point']));
            $("#creditDetailKounyusu").html(breakData(result[0]['kounyusu']));
            $("#creditDetailDenpyostart").html(breakData(result[0]['denpyostart']));
            $("#creditDetailSyukei1").html(breakData(result[0]['syukei1']));
            $("#creditDetailSyukei2").html(breakData(result[0]['syukei2']));
            $("#creditDetailSyukei3").html(breakData(result[0]['syukei3']));
            $("#creditDetailSyukei4").html(breakData(result[0]['syukei4']));
            $("#creditDetailSyukei5").html(breakData(result[0]['syukei5']));
            $("#creditButton3").attr('data-id',result[0]['bango']);

            $("#editCreditBango").html(result[0]['point']);
            $("#editCreditBango1").val(result[0]['bango']);
            $("#hiddenBango").val(result[0]['bango']);
            $("#editCreditKounyusu").val(result[0]['kounyusu']);
            $("#editCreditDenpyostart").html(result[0]['denpyostart']);
            $("#editCreditSyukei1").html(result[0]['syukei1']);
            $("#editCreditSyukei2").html(result[0]['syukei2']);
            $("#editCreditSyukei3").html(result[0]['syukei3']);
            $("#editCreditSyukei4").val(result[0]['syukei4']);
            $("#editCreditSyukei5").html(result[0]['syukei5']);

            $('#printCreditPoint').html(breakData(result[0]['point']));
            $('#printCreditKokyaku1Name').html(breakData(result[0]['kokyaku_name']));
            $('#printCreditKounyusu').html(breakData(result[0]['kounyusu']));
            $('#printCreditDenpyostart').html(breakData(result[0]['denpyostart']));
            $('#printCreditSyukei1').html(breakData(result[0]['syukei1']));
            $('#printCreditSyukei2').html(breakData(result[0]['syukei2']));
            $('#printCreditSyukei3').html(breakData(result[0]['syukei3']));
            $('#printCreditSyukei4').html(breakData(result[0]['syukei4']));
            $('#printCreditSyukei5').html(breakData(result[0]['syukei5']));
            $('#printCreditMail11').html(breakData(result[0]['mail11']));
            $('#printCreditMail12').html(breakData(result[0]['mail12']));
            $('#printCreditMail21').html(breakData(result[0]['mail21']));
            $('#printCreditMail22').html(breakData(result[0]['mail22']));
            $('#printCreditName').html(breakData(result[0]['name']));
            $('#printCreditKaka').html(breakData(result[0]['kaka']));

            $("#credit_modal1").modal("show");
        }
    });
}

////////////end employee detail function///////


///////settings function start////////////////

// $('#openSettingModal').click(function(){
//    $('#setting_display_modal').modal('show');
// });

///////settings function end//////////////////


//....table setting@[start] ........

//....table setting@[start] ........

document.getElementById("btnPrint").onclick = function () {

    var data=document.getElementById("credit_print");
    console.log(data);
    var printSection = document.getElementById("credit_print");
    var newWin = window.open();
    newWin.document.write(printSection.innerHTML);
    newWin.document.close();
    newWin.print();
    newWin.close();

};

document.getElementById("btnPrintEdit").onclick = function () {

    var data=document.getElementById("credit_print");
    console.log(data);
    var printSection = document.getElementById("credit_print");

    var newWin = window.open();
    newWin.document.write(printSection.innerHTML);
    newWin.document.close();
    newWin.print();
    newWin.close();
}

// $('#tableSettingSubmit').click(function() {
//     var error=0;
//     var largeNumber=0;
//     $("#setting_display_modal input").parent().find('input').removeClass("error");
//
//     var Things=['point','kokyaku1_name','kounyusu','denpyostart','syukei1','syukei2',
//         'syukei3','syukei4','syukei5','mail11','mail12','mail21','mail22','name', 'kaka'];
//
//     for (var i = 0; i < Things.length; i++)
//     {
//         if($("#check_"+Things[i]).prop('checked') != true && $("#setting_"+Things[i]).val() != "")
//         {
//             error++;
//             $('#setting_'+Things[i]).addClass("error");
//         }
//         if ($('#setting_'+Things[i]).val() > 98)
//         {
//             largeNumber++;
//             $('#setting_'+Things[i]).addClass("error");
//         }
//     }
//
//     if(error > 0 && largeNumber > 0)
//     {
//
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
//             '<br>'+ '98以下の数値を入力してください。'+ '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//
//     else if (largeNumber>0 && error == 0)
//     {
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '98以下の数値を入力してください。' + '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//     else if(error > 0 && largeNumber == 0)
//     {
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' + '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//
//
//
//     else
//     {
//         $('#errorShow').empty();
//         saveTableSetting("creditMasterReload");
//     }
//
// });

function deleteCreditMaster(url)
{
    var kesuId= document.getElementById('hiddenBango').value;


    $.ajax({
        type: "GET",
        url: url,
        data:kesuId,
        success: function( response ) {
            console.log(response);
            location.reload();
        },
    });

}
