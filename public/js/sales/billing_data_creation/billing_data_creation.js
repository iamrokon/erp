var buttonPress = 0;
var willDownloadCSV = false;

function doubleClick(){
    alert('処理中です');
}

function csvExport(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#csvForm').serialize();
      $.ajax({
          type:"POST",
          url: url,
          data:data,
          success:function(result){
              buttonPress = 0;
              $('.loading-icon').css("display","none");
              $('#confirmation_message').html("");
              $('#successMessage').css("display","none");
              var html = '';
	            if($.trim(result) == 'ok'){
                if(willDownloadCSV) {
                  willDownloadCSV = false;
                  $('#csvForm').submit();
                  $('#successMessage').css("display","block");
                } else {
                  willDownloadCSV = true;
                  $('#confirmation_message').html("エクスポートはまだ完了していません。内容をご確認後、もう一度「CSVエクスポート」をお願いします。");
                }
                $('#datepicker2_oen').removeClass("error");
                $('#datepicker1_oen').removeClass("error");
	            }else{
                willDownloadCSV = false;
                var inputError = result.err_field;
                if (result.err_msg) {
                  html += '<div>';
                  
                  jQuery.each(result.err_msg, function(index, item) {
                    html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + item + '</p>';
                  });

                  //for (var count = 0; count < result.err_msg.length; count++) {
                  //  html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                  //}
                  html += '</div>';
                }

                if (inputError.date) {
                    $('#datepicker2_oen').addClass("error");
                    $('#datepicker1_oen').addClass("error");
                }
                else{
                  if (inputError.date_start) {
                    $('#datepicker2_oen').addClass("error");
                  } else {
                    $('#datepicker2_oen').removeClass("error");
                  }
                  if (inputError.date_end) {
                    $('#datepicker1_oen').addClass("error");
                  } else {
                    $('#datepicker1_oen').removeClass("error");
                  }
                }
              }
              $('#error_data').html(html);
              $("#error_data").show();
            }
          });
  } else {
    doubleClick();
  }
}