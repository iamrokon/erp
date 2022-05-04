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

                        if (inputError.sales_date) {
                            $('#sales_date_start').addClass("error");
                            $('#sales_date_end').addClass("error");
                        } else {
                            if (inputError.sales_date_start) {
                                $('#sales_date_start').addClass("error");
                            } else {
                                $('#sales_date_start').removeClass("error");
                            }

                            if (inputError.sales_date_end) {
                                $('#sales_date_end').addClass("error");
                            } else {
                                $('#sales_date_end').removeClass("error");
                            }
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
    //$("#orderEntryReload").click();
    localStorage.setItem("historyToOrderEntry",bango);
    localStorage.setItem("historyToOrderEntryWithdataChar01",'2 受注訂正');
    localStorage.setItem("historyToOrderEntryWithdataChar02",'U110');
    $("#goToOrderEntry").submit();

}


