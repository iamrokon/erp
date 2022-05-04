var nameMasterReg = 0;
var nameMasterEdit = 0;
var nameMasterDeleteRetrieve = 0;

function openRegistration() {
    nameMasterReg = 0;
    $("input[name=validate_only]").val("1");
    $("#error_data").empty();
    $("#name_modal1 input").parent().find('input').removeClass("error");
    $("#name_modal1 input").parent().find("input[type!='radio']").val("");
    $("input[name=changed][value= '2 不可']").prop('checked', true);
    $("#regFrontValidation").remove();
    $('#name_modal1').modal('show');
}

function showRegistrationError(result, field) {
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 1);
    if (field == null) {
        document.getElementById('regButton').disabled = false;
    }
    $("#name_modal1 input").parent().find('input').removeClass("error");
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#error_data').html(html);


        $("#error_data").show();
    }

    if (inputError.category1) {
        $('#insert_category1').addClass("error");
    }

    if (inputError.category2) {
        $('#insert_category2').addClass("error");
    }

    if (inputError.category3) {
        $('#insert_category3').addClass("error");
    }

    if (inputError.category4) {
        $('#insert_category4').addClass("error");
    }

    if (inputError.category5) {
        $('#insert_category5').addClass("error");
    }

    if (inputError.groupbango) {
        $('#insert_groupbango').addClass("error");
    }

    if (inputError.osusume) {
        $('#insert_osusume').addClass("error");
    }

    if (inputError.suchi1) {
        $('#insert_suchi1').addClass("error");
    }
    if (inputError.spare_one) {
        $('#insert_spare_one').addClass("error");
    }
    if (inputError.spare_two) {
        $('#insert_spare_two').addClass("error");
    }
    if (inputError.spare_three) {
        $('#insert_spare_three').addClass("error");
    }

}

function showEditError(field, result) {
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 2);
    console.log(inputError);
    if (field == null) {
        document.getElementById('editButton').disabled = false;
    }
    $("#name_modal3 input").parent().find('input').removeClass("error");
    $("#error_dataEdit").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#error_dataEdit').html(html);

        $("#error_dataEdit").show();
    }

    if (inputError.category1) {
        $('#edit_category1').addClass("error");
    }

    if (inputError.category2) {
        $('#edit_category2').addClass("error");
    }

    if (inputError.category3) {
        $('#edit_category3').addClass("error");
    }

    if (inputError.category4) {
        $('#edit_category4').addClass("error");
    }

    if (inputError.category5) {
        $('#edit_category5').addClass("error");
    }

    if (inputError.groupbango) {
        $('#edit_groupbango').addClass("error");
    }

    if (inputError.osusume) {
        $('#edit_osusume').addClass("error");
    }

    if (inputError.suchi1) {
        $('#edit_suchi1').addClass("error");
    }
    if (inputError.spare_one) {
        $('#edit_spare_one').addClass("error");
    }
    if (inputError.spare_two) {
        $('#edit_spare_two').addClass("error");
    }
    if (inputError.spare_three) {
        $('#edit_spare_three').addClass("error");
    }


}

/////////registration function///////////////
function registerName(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = $('#registrationForm').serialize();
    if (field != null) {
        data = data + "&field=" + field;
    } else {
        document.getElementById('regButton').disabled = true;
    }

    if (nameMasterReg == 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                //console.log(result);
                if ($.trim(result.status) == 'ok') {
                    nameMasterReg++;
                    var msg = getConfirmationMessage(1);
                    $('#error_data').html(msg);
                    $("#error_data").show();
                    $("input[name=validate_only]").val("0");
                    document.getElementById('regButton').disabled = false;
                } else {
                    showRegistrationError(result, field)
                }
            }
        });


    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                if ($.trim(result.status) == 'ok') {
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#nameMasterReload").trigger("click");
                } else {
                    showRegistrationError(result, field)
                }
            }
        });


    }
}

///////////////end registration function//////

//////name detail start//////////

function viewDetail(url, id) {
    nameMasterEdit = 0;
    nameMasterDeleteRetrieve = 0;
    $("#detail_error_data").hide();
    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (result) {
            console.log(result.bango);
            $("#error_dataEdit").empty();
            $("#name_modal3 input").parent().find('input').removeClass("error");
            if (result.suchi2 == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('nameButton3').style.display = 'none';
            }

            $('#edit_bango1').val(result.bango);
            $('#edit_category1').val(result.category1);
            $('#edit_category2').val(result.category2);
            $('#edit_category3').val(result.category3);
            $('#edit_category4').val(result.category4);
            $('#edit_category5').val(result.category5);
            $('#edit_groupbango').val(result.groupbango);
            $('#edit_osusume').val(result.osusume);
            $('#edit_suchi1').val(result.suchi1);
            $("#edit_spare_one").val(result.spare_one);
            $("#edit_spare_two").val(result.spare_two);
            $("#edit_spare_three").val(result.spare_three);
            console.log({'tarel': $("input[name=edit_changed][value= '" + result.changed + "']")})
            $("input[name=edit_changed][value= '" + result.changed + "']").prop('checked', true);
            $.each(result, function (index, value) {
                if (value != null) {
                    result [index] = breakData(value);
                }
            });

            $('#detail_category1').html(result.category1);
            $('#detail_category2').html(result.category2);
            $('#detail_category3').html(result.category3);
            $('#detail_category4').html(result.category4);
            $('#detail_category5').html(result.category5);
            $('#detail_groupbango').html(result.groupbango);
            $('#detail_osusume').html(result.osusume);
            $('#detail_suchi1').html(result.suchi1);
            $("#detail_changed").html(result.changed);
            $("#detail_spare_one").html(result.spare_one);
            $("#detail_spare_two").html(result.spare_two);
            $("#detail_spare_three").html(result.spare_three);


            // $('#print_category1').html(result.category1);
            // $('#print_category2').html(result.category2);
            // $('#print_category3').html(result.category3);
            // $('#print_category4').html(result.category4);
            // $('#print_category5').html(result.category5);
            // $('#print_groupbango').html(result.groupbango);
            // $('#print_osusume').html(result.osusume);
            // $('#print_suchi1').html(result.suchi1);
            // $('#name_print').find('h6').html('名称マスタ(詳細)');
            $('#name_modal2').modal('show');
        }
    });
}


/////name detail end///////////


//////// edit function ////////


function editName(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = $('#editForm').serialize();
    if (field != null) {
        data = data + "&field=" + field;
    } else {
        document.getElementById('editButton').disabled = true;
    }
    //var len = $("#submit_confirmation").length;
        //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    if (nameMasterEdit == 0 && field == null) {
      //if(len>0){
        $.ajax({
            type: 'POST',
            url: url,
            data: data+"&submit_confirmation="+submit_confirmation,
            success: function (result) {
                if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                    nameMasterEdit++;
                    // var msg = getConfirmationMessage(2);
                    // $('#error_dataEdit').html(msg);
                    // $("#error_dataEdit").show();
                    $("input[name=validate_only]").val("0");
                    document.getElementById('editButton').disabled = false;
                }else if ($.trim(result) == 'confirmation_msg'){
                    nameMasterEdit++;
                    $("#submit_confirmation").val('submit');
                    var msg = getConfirmationMessage(2);
                    $('#error_dataEdit').html(msg);
                    $("#error_dataEdit").show();
                    $("input[name=validate_only]").val("0");
                    document.getElementById('editButton').disabled = false;
                } else {
                    //$("#submit_confirmation").val("");
                    $("input[name=validate_only]").val("0");
                    showEditError(field, result)

                }
            }
        });
      // }else{
      //   var submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
      //   $('#mainForm').prepend(submit_confirmation);
      //   nameMasterEdit++;
      //   var msg = getConfirmationMessage(2);
      //   $('#error_dataEdit').html(msg);
      //   $("#error_dataEdit").show();
      //   $("input[name=validate_only]").val("0");
      //   document.getElementById('editButton').disabled = false;
      // }
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data+"&submit_confirmation="+submit_confirmation,
            success: function (result) {
                console.log(result);
                if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    document.getElementById("nameMasterReload").click();

                } else {
                    showEditError(field, result)

                }
            }
        });

    }

}

///////////////end edit function//////


// document.getElementById("btnPrint").onclick = function () {
//
//     var data = document.getElementById("name_print");
//     console.log(data);
//     var printSection = document.getElementById("name_print");
//
//     var newWin = window.open();
//     newWin.document.write(printSection.innerHTML);
//     newWin.document.close();
//     newWin.print();
//     newWin.close();
// }
//
// document.getElementById("btnPrintEdit").onclick = function () {
//
//     var data = document.getElementById("name_print");
//     console.log(data);
//     var printSection = document.getElementById("name_print");
//     $('#name_print').find('h6').html("名称マスタ(変更)");
//     var newWin = window.open();
//     newWin.document.write(printSection.innerHTML);
//     newWin.document.close();
//     newWin.print();
//     newWin.close();
// }
//
// document.getElementById("btnPrintInsert").onclick = function () {
//
//     $('#print_category1').html(breakData($('#insert_category1').val()));
//     $('#print_category2').html(breakData($('#insert_category2').val()));
//     $('#print_category3').html(breakData($('#insert_category3').val()));
//     $('#print_category4').html(breakData($('#insert_category4').val()));
//     $('#print_category5').html(breakData($('#insert_category5').val()));
//     $('#print_groupbango').html(breakData($('#insert_groupbango').val()));
//     $('#print_osusume').html(breakData($('#insert_osusume').val()));
//     $('#print_suchi1').html(breakData($('#insert_suchi1').val()));
//
//     $('#name_print').find('h6').html("名称マスタ(登録)");
//     var printSection = document.getElementById("name_print");
//
//     var newWin = window.open();
//     newWin.document.write(printSection.innerHTML);
//     newWin.document.close();
//     newWin.print();
//     newWin.close();
// }
//

$("body").on("keyup", "#edit_category1", function () {
    console.log("Handler for .keypress() called.");
    var firstData = $("#edit_category1").val();
    // var secondData=$("#edit_category2").val();
    var url = "/name/Api/" + 72;
    if (firstData) {
        $.ajax({
            url: url,
            type: "GET",
            data: {firstData: firstData},
            success: function (response) {
                $("#edit_category3").val(response.category3);
                $("#edit_category5").val(response.category5);
            },
        });
    }
});
$("body").on("keyup", "#insert_category1", function (e) {
    var targetValue = e.target.value;
    var categoryOne = $("#registrationForm #insert_category1");
    if (targetValue.match(/^[a-zA-Z0-9]+$/)) {
        if (targetValue.length === 2) {
            var url = "/name/Api/" + 72;
            var data = categoryOne.val();
            if (data) {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {firstData: data},
                    success: function (response) {
                        console.log(response)
                        if (typeof (response) != 'string') {
                            $("#registrationForm").find("#insert_category3").val(response.category3);
                            $("#registrationForm").find("#insert_category5").val(response.category5);
                        } else {
                            $("#registrationForm").find("#insert_category3").val("");
                            $("#registrationForm").find("#insert_category5").val("");
                        }
                    },
                });
            }
        } else {
            $("#registrationForm").find("#insert_category3").val("");
            $("#registrationForm").find("#insert_category5").val("");
        }
    } else {
        $("#registrationForm").find("#insert_category3").val("");
        $("#registrationForm").find("#insert_category5").val("");
    }


});

// $('#tableSettingSubmit').click(function() {
//
//    var error=0;
//    var largeNumber=0;
//    $("#setting_display_modal input").parent().find('input').removeClass("error");
//
//    var Things=['category1','category2','category3','category4','category5','groupbango',
//    'osusume','suchi1','created_date','created_time','edited_date','edited_time','image3','user_name'];
//
//    for (var i = 0; i < Things.length; i++)
//    {
//      if($("#check_"+Things[i]).prop('checked') != true && $("#setting_"+Things[i]).val() != "")
//       {
//         error++;
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
//         saveTableSetting("nameMasterReload");
//     }
//
// });


function deleteNameMaster(url) {
    if (nameMasterDeleteRetrieve == 0) {
        nameMasterDeleteRetrieve++;
        var msg = getConfirmationMessage(3);
        $('#detail_error_data').html(msg);
        $("#detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_bango1').value;
        $.ajax({
            type: "GET",
            url: url,
            data: kesuId,
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }
}

function returnNameMaster(url) {
    if (nameMasterDeleteRetrieve == 0) {
        nameMasterDeleteRetrieve++;
        var msg = getConfirmationMessage(4);
        $('#detail_error_data').html(msg);
        $("#detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_bango1').value;
        $.ajax({
            type: "GET",
            url: url,
            data: kesuId,
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }
}
