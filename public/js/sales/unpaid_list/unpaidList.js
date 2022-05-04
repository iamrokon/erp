var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function firstSearch(url) { 
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#firstSearch').serialize();
      $.ajax({
          type:"POST",
          url: url,
          data:data,
          success:function(result){
                if($.trim(result) == 'ok'){
                      document.getElementById('first_csrf').disabled = false;
                      document.getElementById('firstButton').value = "FirstSearch";
                      document.getElementById("firstSearch").submit();
                }else{
                        buttonPress = 0;
                        $("#no_found_data").hide();
                        $("#update-success-msg").hide();
                        var inputError = result.err_field;
                        console.log(inputError);

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

                        if (inputError.division_datachar05_start) {
                            $('#division_datachar05_start').addClass("error");
                        } else {
                            $('#division_datachar05_start').removeClass("error");
                        }

                        if (inputError.division_datachar05_end) {
                            $('#division_datachar05_end').addClass("error");
                        } else {
                            $('#division_datachar05_end').removeClass("error");
                        }
                        
                        if (inputError.datachar05) {
                            $('#search_datachar05').addClass("error");
                        } else {
                            $('#search_datachar05').removeClass("error");
                        }

                        if (inputError.intorder05) {
                            $('#datepicker1_oen').addClass("error");
                            $('#datepicker2_oen').addClass("error");
                        }else if(inputError.intorder05_intorder03){
                            $('#datepicker1_oen').addClass("error");
                            $('#datepicker2_oen').addClass("error");
                        }else {
                            if (inputError.intorder05_start) {
                                $('#datepicker1_oen').addClass("error");
                            } else {
                                $('#datepicker1_oen').removeClass("error");
                            }

                            if (inputError.intorder05_end) {
                                $('#datepicker2_oen').addClass("error");
                            } else {
                                $('#datepicker2_oen').removeClass("error");
                            }
                        }
                        
                        if (inputError.intorder03) {
                            $('#datepicker3_oen').addClass("error");
                            $('#datepicker4_oen').addClass("error");
                        }else if(inputError.intorder05_intorder03){
                            $('#datepicker3_oen').addClass("error");
                            $('#datepicker4_oen').addClass("error");
                        } else {
                            if (inputError.intorder03_start) {
                                $('#datepicker3_oen').addClass("error");
                            } else {
                                $('#datepicker3_oen').removeClass("error");
                            }

                            if (inputError.intorder03_end) {
                                $('#datepicker4_oen').addClass("error");
                            } else {
                                $('#datepicker4_oen').removeClass("error");
                            }
                        }

                }
          }
      });

  } else {
    doubleClick();
  }
}


function updateSelectedDepositeDate(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var count = 0;
      $(".intorder05_input").each(function() {
        count++;
      });
      console.log(count);
      var url = url;
      var data = $('#mainForm').serialize();
      if(count>0){
        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();
        
        //var len = $("#submit_confirmation").length;
        //if(len>0){
            $.ajax({
                type:"POST",
                url: url,
                data:data+"&submit_confirmation="+submit_confirmation,
                success:function(result){
                    if($.trim(result) == 'ok'){
                        $("#confirmation_message").html("");
                        location.reload();
                    }else if ($.trim(result) == 'confirmation_msg'){
                        $("#update-success-msg").css("display","none");
                        $("#submit_confirmation").val('submit');
                        $('#error_data').html("");
                        $('.intorder05_input').css("cssText", "1px solid lightgray !important;");
                        var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                        $(document).find("#confirmation_message").html(confirmationMsg);
                        buttonPress = 0;
                    }else{
                        var inputError = result.err_field;
                        buttonPress = 0;
                        
                        $("#confirmation_message").html("");
                        
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
                        
                        //array field error
                        var temp_err_key = [];
                        for (const err_field in inputError) {
                            var targetEl = '';
                            var selectInputs = ["pj"];
                            if (err_field.indexOf('.') > -1) {
                                const [inputName, key] = err_field.split('.');
                                temp_err_key[key] = key;
                                if (inputName && selectInputs.indexOf(inputName) >= 0) {
                                    targetEl = $("select[name='" + inputName + "[]']").eq(key)
                                } else {
                                    targetEl = $("input[name='" + inputName + "[]']").eq(key)
                                }
                            } else {
                                if (err_field && selectInputs.indexOf(err_field) >= 0) {
                                    targetEl = $("select[name=" + err_field + "]")
                                } else {
                                    targetEl = $("input[name=" + err_field + "]")
                                }
                            }
                            //targetEl.addClass("error")
                            targetEl.css("cssText", "border: 1px solid red !important;");
                        }
                    }
                }
            });
        //}else{
        //    var  submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
        //    $('#mainForm').prepend(submit_confirmation);

        //    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
        //    $(document).find("#confirmation_message").html(confirmationMsg);
        //    buttonPress = 0;
        //}
    }else{
        buttonPress = 0;
    }

  } else {
    doubleClick();
  }
}

$('input[name="rd2"]').click(function(){
    $("#fs_sortField").val("");
    $("#fs_sortType").val("");
    $("#sortField").val("");
    $("#sortType").val("");
});

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}






