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

                    if (inputError.kk0001) {
                        $('#kk0001').addClass("error");
                    } else {
                        $('#kk0001').removeClass("error");
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


function loadPurchaseBalanceListDependantData (fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    if (fillable_id == 'kk0002_start_v2') {
        document.getElementById('db_kk0002_end').value = torihikisaki_cd;
        document.getElementById('kk0002_end_v2').value = torihikisaki_details;
    }
}




