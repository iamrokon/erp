var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

//generate txt file
function accountingDataCreation() {
    buttonPress++;
    if (buttonPress == 1) {
        var bango = $("input[id='userId']").val();
        var data = $('#mainForm').serialize();

        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();
        
        $("#submit").css('pointer-events','none');
        $(document).find("#confirmation_message").html("");

        $.ajax({
            type: 'POST',
            url: "accounting-data-creation/register/" + bango,
            data: data+"&submit_confirmation="+submit_confirmation,
            success: function (result) {
                if (result.length>0 && typeof result !=='string') {
                    $(".loading-icon").show();
                    var position = result[0].lastIndexOf("/");
                    var filename = result[0].substr(position+1);
                    var temp_filename = 'shiwake-uri.txt';
                    //download the file
                    download(result[0],temp_filename);

                    $.ajax({
                       type:'post',
                       url:'accounting-data-creation/deleteTempFile/' + bango,
                       data:data+"&filename="+filename,
                       success: function (response){
                           if($.trim(response) == 'ok'){
                               console.log("Successfully temp file deleted."); 
                               $('#error_data').html("");
                               location.reload();
                           }else{
                               console.log("No File Found");
                           }

                       }
                    });

                    //$(".loading").removeClass('show');

                }else if ($.trim(result) == 'confirmation_msg'){
                    buttonPress = 0;
                    $("#error_data").html("");
                    $('#datepicker2_oen').removeClass("error");
                    $('#datepicker1_oen').removeClass("error");
                    $("#submit").css('pointer-events','initial');
                    $(".loading-icon").hide();
                    $(".alert").hide();
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 4px;">登録はまだ完了していません。内容をご確認後、もう一度「TXTエクスポート」をお願いします。</p>';
                    $(document).find("#confirmation_message").html(confirmationMsg);
                }else if ($.trim(result) == 'no_data'){
                    buttonPress = 0;
                    $(".loading-icon").hide();
                    $("#submit_confirmation").val("");
                    $("#submit").css('pointer-events','initial');
                    $(document).find("#confirmation_message").html("");
                    $(document).find("#error_data").html('<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 4px;">該当するデータがありません。</p>');
                }else {
                    buttonPress = 0;
                    $(".loading-icon").hide();
                    $("#submit").css('pointer-events','initial');

                    var inputError = result.err_field;
                    console.log(inputError);

                    //reset submit confirmation
                    $("#submit_confirmation").val("");

                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#error_data').html(html);

                        if (true) {
                        }
                        $("#error_data").show();
                    }

                    if (inputError.intorder03) {
                        $('#datepicker2_oen').addClass("error");
                        $('#datepicker1_oen').addClass("error");
                    } else {
                        if (inputError.intorder03_start) {
                            $('#datepicker2_oen').addClass("error");
                        } else {
                            $('#datepicker2_oen').removeClass("error");
                        }
                        if (inputError.intorder03_end) {
                            $('#datepicker1_oen').addClass("error");
                        } else {
                            $('#datepicker1_oen').removeClass("error");
                        }
                    }

                }
            },
            beforeSend:function(){
                $(".loading-icon").show();
            }
        });
    } else {
        doubleClick();
    }
}

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


