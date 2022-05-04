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
                        $('#datepicker2').addClass("error");
                        $('#datepicker1').addClass("error");
                    } else {
                        if (inputError.purchaseDateFrom) {
                            $('#datepicker1').addClass("error");
                        } else {
                            $('#datepicker1').removeClass("error");
                        }

                        if (inputError.purchaseDateTo) {
                            $('#datepicker2').addClass("error");
                        } else {
                            $('#datepicker2').removeClass("error");
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
// updatePurchaseResultList
function updatePurchaseResultList(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var count = 0;
        $(".up_support_number").each(function() {
          count++;
        });
        console.log(count,buttonPress);
        var url = url;
        var data = $('#mainForm').serialize();
        // console.log(data);
        if(count>0){
            //submit confirmation check
            var submit_confirmation = $("#submit_confirmation").val();
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
                        // $('.intorder05_input').css("cssText", "1px solid lightgray !important;");
                        var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください</p>';
                        $(document).find("#confirmation_message").html(confirmationMsg);
                        buttonPress = 0;
                    }else if ($.trim(result) == 'not_ok'){
                        buttonPress = 0;
                        $("#confirmation_message").html("");
                        //reset submit confirmation
                        $("#submit_confirmation").val("");
                        html = '<div>';
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">Logical Error</p>';
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }
                    else{
                        var inputError = result.errors;
                        buttonPress = 0;
                        console.log(result, inputError);
                        $("#confirmation_message").html("");
                        
                        //reset submit confirmation
                        $("#submit_confirmation").val("");

                        var html = '';
                        if (result.err_status) {
                            html = '<div>';
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">仕入完了計算=済はフラグ変更できません</p>';
                            // for (var count = 0; count < result.err_msg.length; count++) {
                            //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                            // }
                            html += '</div>';
                            $('#error_data').html(html);
                            $("#error_data").show();
                        }
                        
                        //array field error
                        for (var count = 0; count < inputError.length; count++) {
                            console.log(inputError[count])
                            if(inputError[count]==false){
                            var id = count+1;
                                var targetEl =  $("#row"+id).find(".selected_inspection");  
                                console.log(targetEl)                       
                                targetEl.addClass("error")
                                // targetEl.css("cssText", "border: 1px solid red !important;");
                            }
                        }
                    }
                }
            });
      }else{
          buttonPress = 0;
      }  
    } else {
      doubleClick();
    }
}

$(document).on("change", '#myAnchor', function (e) {
    var value = $(this).val();
    console.log(value);
    $(".selected_inspection").val(value).change();
})

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function gotoPurchaseInquiryResult(support_number){
    $("#support_number").val(support_number);
    // $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToPurchaseInquiryResult").submit();
}


