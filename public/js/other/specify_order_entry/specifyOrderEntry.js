buttonPress = 0;
function firstSearch(url) {
  buttonPress++;
  if (buttonPress == 1) {
      //submit confirmation check
      var submit_confirmation = $("#submit_confirmation").val();
    
      var url = url;
      var data = $('#firstSearch').serialize();
      $.ajax({
          type:"POST",
          url: url,
          data:data+"&submit_confirmation="+submit_confirmation,
          success:function(result){
                if($.trim(result) == 'ok'){
                    if($("input[name='req_type']").is(":checked")){
                        localStorage.setItem("inhouseEntryReqType", "checked");
                    }else{
                        localStorage.setItem("inhouseEntryReqType", "unchecked");
                    }
                    location.reload();
                }else if ($.trim(result) == 'confirmation_msg'){
                    buttonPress = 0;
                    $("#error_data").hide();
                    $("#update-success-msg").css("display","none");
                    $('.error').each(function () {
                        if (this.classList.contains("error")) {
                            this.classList.remove("error");
                        }
                    });

                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">更新はまだ完了していません。内容をご確認後、もう１度更新ボタンを押してください。</p>';
                    $(document).find("#confirmation_message").html(confirmationMsg);
                }else{
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    console.log(inputError);
                    
                    //reset submit confirmation
                    $("#submit_confirmation").val("");
                    $(document).find("#confirmation_message").html("");
                    
                    $("#update-success-msg").css("display","none");

                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';
                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#error_data').html(html);
                        $("#error_data").show();
                    }

                    if (inputError.bango1) {
                        $('#bango1').addClass("error");
                    } else {
                         $('#bango1').removeClass("error");
                    }
                    
                    if (inputError.bango2) {
                        $('#bango2').addClass("error");
                    } else {
                         $('#bango2').removeClass("error");
                    }
                    
                    if (inputError.bango3) {
                        $('#bango3').addClass("error");
                    } else {
                         $('#bango3').removeClass("error");
                    }

                }
          }
      });

  } else {
    doubleClick();
  }
}

function checkCheckbox(){
    setTimeout(function(){
        if($("input[name='req_type']").is(":checked")){
            $("#error_data").html("");
            $("#bango1,#bango2,#bango3").removeClass("error");
            $("#bango1").val("");
            $("#bango2").val("");
            $("#bango3").val("");
            $("#bango1").val("");
            $("#bango1").prop("readonly",true);
            $("#bango2").prop("readonly",true);
            $("#bango3").prop("readonly",true);
            
        }else{
            $("#bango1").prop("readonly",false);
            $("#bango2").prop("readonly",false);
            $("#bango3").prop("readonly",false);
        }
    },500);
    
}

$(document).ready(function(){
    if(localStorage.getItem("inhouseEntryReqType")) {
        var status = localStorage.getItem("inhouseEntryReqType");
        if(status == "unchecked"){
            $("#req_type").prop("checked", false);
            $("#bango1").prop("readonly",false);
            $("#bango2").prop("readonly",false);
            $("#bango3").prop("readonly",false);
        }else{
            $("#error_data").html("");
            $("#bango1,#bango2,#bango3").removeClass("error");
            $("#bango1").val("");
            $("#bango2").val("");
            $("#bango3").val("");
            $("#bango1").val("");
            $("#bango1").prop("readonly",true);
            $("#bango2").prop("readonly",true);
            $("#bango3").prop("readonly",true);
        }
    }
});

function doubleClick() {
    alert('処理中です');
}


