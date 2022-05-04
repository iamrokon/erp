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

                        if (inputError.intorder01) {
                            $('#datepicker4_oen').addClass("error");
                            $('#datepicker3_oen').addClass("error");
                        } else {
                            if (inputError.intorder01_start) {
                                $('#datepicker4_oen').addClass("error");
                            } else {
                                $('#datepicker4_oen').removeClass("error");
                            }

                            if (inputError.intorder01_end) {
                                $('#datepicker3_oen').addClass("error");
                            } else {
                                $('#datepicker3_oen').removeClass("error");
                            }
                        }

                        if (inputError.kokyakuorderbango_start || inputError.kokyakuorderbango_end) {
                            $('#kokyakuorderbango_start_err').addClass("error");
                            $('#kokyakuorderbango_end_err').addClass("error");
                        } else {
                            $('#kokyakuorderbango_start_err').removeClass("error");
                            $('#kokyakuorderbango_end_err').removeClass("error");
                        }

                }
          }
      });

  } else {
    doubleClick();
  }
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function gotoOrderInquiry(kokyakuorderbango,ordertypebango2){
    $("#kokyakuorderbango").val(kokyakuorderbango);
    $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToOrderInquiry").submit();
}

function gotoOrderEntry(bango,dataChar01,dataChar02){
    $("#orderEntryReload").click();
    localStorage.setItem("historyToOrderEntry",bango)
    localStorage.setItem("historyToOrderEntryWithdataChar01",dataChar01)
    localStorage.setItem("historyToOrderEntryWithdataChar02",dataChar02)

}

function updateSelectedOrderBango(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var count = 0;
      $(".dtchar01").each(function() {
        count++;
      });
      console.log(count);
      var url = url;
      var data = $('#mainForm').serialize();
      if(count>0){
        var len = $("#submit_confirmation").length;
        if(len>0){
            $.ajax({
                type:"POST",
                url: url,
                data:data,
                success:function(result){
                    if($.trim(result) == 'ok'){
                        location.reload();
                    }else{
                        buttonPress = 0;
                    }
                }
            });
        }else{
            var  submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
            $('#mainForm').prepend(submit_confirmation);

            var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
            $(document).find("#confirmation_message").html(confirmationMsg);
            buttonPress = 0;
        }
    }else{
        buttonPress = 0;
    }

  } else {
    doubleClick();
  }
}

//disable update button when no data found
$(document).ready(function(){
    var len = $("#userTable").find('tr').length;
    if(len == 2){
        $("#updateButton").prop('disabled',true);
    }else{
        $("#updateButton").prop('disabled',false);
    }
});
