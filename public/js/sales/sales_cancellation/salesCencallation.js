var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function registerSalesCancellation(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#mainForm').serialize();

    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    $(".loading-icon").show();
    $.ajax({
        type:"POST",
        url: url,
        data:data+"&submit_confirmation="+submit_confirmation,
        success:function(result){
            if($.trim(result) == 'ok'){
                $("#confirmation_message").html("");
                location.reload();
            }else if ($.trim(result) == 'date0009_err'){
                $("#submit_confirmation").val('');
                $(document).find("#confirmation_message").html("");
                var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">請求締日処理済の日付です。</p>';
                $('#error_data').html(errMsg);
                buttonPress = 0;
                $(".loading-icon").hide();
            }else if ($.trim(result) == 'sum_of_nyukingaku_err'){
                $("#submit_confirmation").val('');
                $(document).find("#confirmation_message").html("");
                var errMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">入金済のデータです。</p>';
                $('#error_data').html(errMsg);
                buttonPress = 0;
                $(".loading-icon").hide();
            }else if ($.trim(result) == 'confirmation_msg'){
                $(".success-msg-box").hide();
                $("#submit_confirmation").val('submit');
                $('#error_data').html("");
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう１度実行ボタンを押してください。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
                buttonPress = 0;
                $(".loading-icon").hide();
            }else{
                var inputError = result.err_field;
                buttonPress = 0;
                $("#confirmation_message").html("");
                $(".success-msg-box").hide();

                //reset submit confirmation
                $("#submit_confirmation").val("");

                var html = '';
                if (result.err_msg) {
                    html = '<div style="margin-left: -7px;">';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';
                    $('#error_data').html(html);
                    $("#error_data").show();
                }

                if (inputError.datachar10) {
                    $('#sales_number').addClass("error");
                } else {
                    $('#sales_number').removeClass("error");
                }
                
                if (inputError.date0009) {
                    $('#datepicker1_oen').addClass("error");
                } else {
                    $('#datepicker1_oen').removeClass("error");
                }
                
                if (inputError.information7) {
                    $('#information7').addClass("error");
                } else {
                    $('#information7').removeClass("error");
                }
                
                if (inputError.information8) {
                    $('#information8').addClass("error");
                } else {
                    $('#information8').removeClass("error");
                }
                
                 $(".loading-icon").hide();
                
            }
        }
    });

  } else {
    doubleClick();
  }
}

$('#sales_number').on('keyup paste',function(){
    var bango = $("#userId").val();
    var datachar10 = $(this).val();
    if(datachar10.length == 10)
    {
        $('#error_data').html("");
        $('.error').each(function () {
            if (this.classList.contains("error")) {
                this.classList.remove("error");
            }
        });
                
        $.ajax({
            type:"GET",
            async:false,
            url: "sales-cancellation/loadSalesData/" + bango,
            //headers: {
            //  'X-CSRF-TOKEN': $('#bottomSearchCsrf').val()
            //},
            data:"datachar10="+datachar10,
            success:function(result){
                  if($.trim(result.status) == 'ok'){
                      var data = result.data;
                      console.log(data);
                      $("#information1").val(data.information1_detail);
                      $("#information2").val(data.information2_detail);
                      $("#information2_db").val(data.information2);
                      $("#juchukubun1").val(data.juchukubun1);
                      $("#money10").val(data.money10);
                      $("#information7").val(data.information7);
                      $("#information8").val(data.information8);
                      $("#salesCancellation").attr("disabled",false);
                  }else if($.trim(result.status) == 'U523_err'){
                      $("#information1").val("");
                      $("#information2").val("");
                      $("#information2_db").val("");
                      $("#juchukubun1").val("");
                      $("#money10").val("");
                      $("#information7").val("");
                      $("#information8").val("");
                      var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">該当するデータがありません。</p>';
                      $("#error_data").html(err_msg);
                      $("#salesCancellation").attr("disabled",true);
                  }else{
                      $("#information1").val("");
                      $("#information2").val("");
                      $("#information2_db").val("");
                      $("#juchukubun1").val("");
                      $("#money10").val("");
                      $("#information7").val("");
                      $("#information8").val("");
                      var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">該当するデータがありません。</p>';
                      $("#error_data").html(err_msg);
                      $("#salesCancellation").attr("disabled",true);
                      console.log("no data");
                  }
            }
        });
    }else{
        $("#information1").val("");
        $("#information2").val("");
        $("#information2_db").val("");
        $("#juchukubun1").val("");
        $("#money10").val("");
        $("#information7").val("");
        $("#information8").val("");
        $("#salesCancellation").attr("disabled",false);
    }
});

function checkDateValidation(){
    var date = parseInt($("#datepicker1_oen").val());
    var start_date = parseInt($("#start_date").val());
    var end_date = parseInt($("#end_date").val());
    if(date < start_date || date > end_date){
        var err_msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">取消可能日は可動範囲自～可動範囲至です。</p>';
        $("#error_date").html(err_msg);
        $("#salesCancellation").attr("disabled",true);
    }else{
        $("#error_date").html("");
        $("#salesCancellation").attr("disabled",false);
    }
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}






