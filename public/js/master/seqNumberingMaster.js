var seqNumberingReg = 0;
var seqNumberingEdit = 0;
var seqNumDeleteRetrieve=0;

function openRegistration()
{
    seqNumberingReg = 0;
    $('#registrationForm').trigger("reset");
    
    $("#regFrontValidation").remove();
    
    $("#error_data").hide();
    $('.error').each(function () {
        if (this.classList.contains("error"))
        {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });
    $('#registrationModal').modal('show');


}


/////////registration function///////////////
function registerSeqNumbering(url,field)
{
    //IE support
    if(field == undefined){
        field = null;
    }
    
//    if (seqNumberingReg == '0' && field==null)
//    {
//        seqNumberingReg++;
//        var html = getConfirmationMessage(1);
//        $('#error_data').html(html);
//        $("#error_data").show();
//
//    } else{
        var data = $('#registrationForm').serialize();
        if(field!=null){
            data = data+"&field="+field;
        }else{
            document.getElementById('regButton').disabled=true;
        }
        
        //submit confirmation check
        var len = $("#submit_confirmation").length;
        var check_val = $("#submit_confirmation").val();
        var submit_confirmation = "";
        if(len>0 && check_val == 'submit'){
            submit_confirmation = check_val;
        }

        $.ajax({
           type: 'POST',
           url: url,
           data: data+"&submit_confirmation="+submit_confirmation,
           success: function(result){
             console.log(result);
             if ($.trim(result.status) == 'ok'){ 
                 //location.reload();
                 // document.getElementById("seqNumberingMasterReload").click();
                 input = '<input type="hidden" name="change_id" value="'+result.change_id+'">';
                 jQuery('#navbarForm').append(input);
                 $("#seqNumberingMasterReload").trigger("click");
             }else if ($.trim(result) == 'confirmation_msg'){
                var  submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
                $('#registrationForm').prepend(submit_confirmation);

                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「保存」をお願いします。</p>';
                $(document).find("#error_data").html(confirmationMsg);
                document.getElementById('regButton').disabled=false;
             }else{
                if(field == null){
                    document.getElementById('regButton').disabled=false;
                }
                
                //submit confirmation check
                var len = $("#submit_confirmation").length;
                if(len>0){
                    $("#submit_confirmation").val("");
                }

                 var inputError =result.err_field;
                 console.log(result);
                 
                //check front validation after submit
                checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

                 var html = '';
                 if(result.err_msg)
                 {
                 html = '<div>';

                 for(var count = 0; count < result.err_msg.length; count++)
                 {
                 html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                 }
                 html += '</div>';

                 $('#error_data').html(html);

                  if (true) {}
                 $("#error_data").show();
                 }

                 if (inputError.kokyakusyouhinbango){
                     $('#reg_kokyakusyouhinbango').addClass("error");
                 }else{
                     $('#reg_kokyakusyouhinbango').removeClass("error");
                 }

                 if (inputError.orderbango){
                     $('#reg_orderbango').addClass("error");
                 }else{
                     $('#reg_orderbango').removeClass("error");
                 }

                 if (inputError.mobile_flag){
                     $('#reg_mobile_flag').addClass("error");
                 }else{
                     $('#reg_mobile_flag').removeClass("error");
                 }

             }
           }
           });
  // }
}
///////////////end registration function//////

/////////edit function///////////////
function editSeqNumbering(url,field)
{
    //IE support
    if(field == undefined){
        field = null;
    }
    
//    if (seqNumberingEdit == '0' && field==null)
//    {
//      seqNumberingEdit++;
//      var html = getConfirmationMessage(2);
//      $('#edit_error_data').html(html);
//      $("#edit_error_data").show();
//
//    }
//    else
//    {
   
    var data = $('#editForm').serialize();
    if(field!=null){
        data = data+"&field="+field;
    }else{
        document.getElementById('editButton').disabled=true;
    }
    
    //submit confirmation check
    var len = $("#submit_confirmation").length;
    var check_val = $("#submit_confirmation").val();
    var submit_confirmation = "";
    if(len>0 && check_val == 'submit'){
        submit_confirmation = check_val;
    }
    
    $.ajax({
       type: 'POST',
       url: url,
       data: data+"&submit_confirmation="+submit_confirmation,
       success: function(result){
         console.log(result);
         if ($.trim(result.status) == 'ok')
         {
 //            $('#seq_numbering_edit_modal').modal('hide');
 //            location.reload();
             input = '<input type="hidden" name="change_id" value="'+result.change_id+'">';
             jQuery('#navbarForm').append(input);
             $("#seqNumberingMasterReload").trigger("click");
         }else if ($.trim(result) == 'confirmation_msg'){
            var  submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
            $('#editForm').prepend(submit_confirmation);

            var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「保存」をお願いします。</p>';
            $(document).find("#edit_error_data").html(confirmationMsg);
            document.getElementById('editButton').disabled=false;
         }else{
            if(field == null){
               document.getElementById('editButton').disabled=false;
            }
            
            //submit confirmation check
            var len = $("#submit_confirmation").length;
            if(len>0){
                $("#submit_confirmation").val("");
            }

            var inputError =result.err_field;
            //console.log(result);
             
            //check front validation after submit
            checkFrontendValidationAfterSubmit(inputError,2); //2 for edit

             var html = '';
             if(result.err_msg)
             {
             html = '<div>';

             for(var count = 0; count < result.err_msg.length; count++)
             {
             html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
             }
             html += '</div>';

             $('#edit_error_data').html(html);

              if (true) {}
             $("#edit_error_data").show();
             }

             if (inputError.kokyakusyouhinbango){
                 $('#edit_kokyakusyouhinbango').addClass("error");
              }else{
                 $('#edit_kokyakusyouhinbango').removeClass("error");
              }

             if (inputError.orderbango){
                 $('#edit_orderbango').addClass("error");
              }else{
                 $('#edit_orderbango').removeClass("error");
              }

              if (inputError.mobile_flag){
                 $('#edit_mobile_flag').addClass("error");
              }else{
                 $('#edit_mobile_flag').removeClass("error");
              }

         }
       }
       });
   //}
}
///////////////end edit function//////

///////////view employee detail////////////

function viewSeqNumberingDetail(url,id)
{
    seqNumberingEdit = 0;
    seqNumDeleteRetrieve=0;
    $("#detail_seq_error_data").hide();
    
    //remove front validation field when initial open
    $("#editFrontValidation").remove();

   $.ajax({
   	type: 'get',
        url: url,
        data: {id:id},
        success: function(result){
            console.log(result);

          $( "#edit_error_data" ).empty();
          $("#seq_numbering_edit_modal input").parent().find('input').removeClass("error");

          $('#print_exampleModalLabel').text("SEQ番号附番マスタ（詳細）");

          if (result.check_flag == 1)
        {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('seq_Button3').style.display = 'none';
        }

          $('#detail_kokyakusyouhinbango').text(result.kokyakusyouhinbango_detail);
          $('#detail_orderbango').text(result.orderbango);
          $('#detail_mobile_flag').text(result.mobile_flag);

          $('#edit_kokyakusyouhinbango_detail').val(result.kokyakusyouhinbango_detail);
          $('#edit_kokyakusyouhinbango').val(result.kokyakusyouhinbango);
          $('#edit_orderbango').val(result.orderbango);
          $('#edit_mobile_flag').val(result.mobile_flag);
          $('#hiddenBango1').val(result.bango);

          $('#print_kokyakusyouhinbango').text(result.kokyakusyouhinbango);
          $('#print_orderbango').text(result.orderbango);
          $('#print_mobile_flag').text(result.mobile_flag);

          $('#seqNumberingDetailModal').modal('show');
           $('.modal-backdrop').show();
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



function deleteSeqNumberingMaster(url)
{
    if (seqNumDeleteRetrieve == '0')
    {
      seqNumDeleteRetrieve++;
      var html = getConfirmationMessage(3);
      $('#detail_seq_error_data').html(html);
      $("#detail_seq_error_data").show();

    }
    else
    {
        var kesuId= document.getElementById('hiddenBango1').value;

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

}

function returnSeqNumberingMaster(url)
{
    if (seqNumDeleteRetrieve == '0')
    {
      seqNumDeleteRetrieve++;
      var html = getConfirmationMessage(4);
      $('#detail_seq_error_data').html(html);
      $("#detail_seq_error_data").show();

    }
    else
    {
        var kesuId= document.getElementById('hiddenBango1').value;

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

}


// $('#tableSettingSubmit').click(function() {
//    var error=0;
//    var largeNumber=0;
//    $("#setting_display_modal input").parent().find('input').removeClass("error");
//
//    var Things=['kokyakusyouhinbango','orderbango','mobile_flag','created_date','created_time','edited_date','edited_time','size','user_name'];
//
//    for (var i = 0; i < Things.length; i++)
//    {
//      if($("#check_"+Things[i]).prop('checked') != true && $("#setting_"+Things[i]).val() != "")
//       {
//         error++;
//         console.log(Things[i])
//         $('#setting_'+Things[i]).addClass("error");
//       }
//       if ($('#setting_'+Things[i]).val() > 98)
//       {
//         largeNumber++;
//         $('#setting_'+Things[i]).addClass("error");
//       }
//    }
//
//     if(error > 0 && largeNumber > 0)
//     {
//
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
//                  '<br>'+ '98以下の数値を入力してください。'+ '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//
//     else if (largeNumber>0 && error == 0)
//      {
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '98以下の数値を入力してください。' + '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//      }
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
//         saveTableSetting("seqNumberingMasterReload");
//     }
//
// });
