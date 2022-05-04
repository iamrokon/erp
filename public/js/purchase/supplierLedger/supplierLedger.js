$("#displayButton").click(function() {
    $('#error_msg_div').empty();
    // alert("searching");
    $("#Button").val("refresh");
    $("#sortField").val("");
    $("#sortType").val("");
    // alert(button);
    $('#mainForm').submit();
});

// $(document).ready(function () {
//     var date=new Date();
//     let _date = moment().format('YYYY/MM');
// 	$("#datepicker1_oen").val(_date);
//     $("#datepicker2_oen").val(_date);
// });

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

                        if (inputError.start_date) {
                            $('#datepicker1_oen').addClass("error");
                        } else {
                            $('#datepicker1_oen').removeClass("error");
                        }

                        if (inputError.end_date) {
                            $('#datepicker2_oen').addClass("error");
                        } else {
                            $('#datepicker2_oen').removeClass("error");
                        }

                        if (inputError.intorder01) {
                            $('#datepicker2_oen').addClass("error");
                            $('#datepicker1_oen').addClass("error");
                        }
                        //  else {
                        //     if (inputError.intorder01_start) {
                        //         $('#datepicker2_oen').addClass("error");
                        //     } else {
                        //         $('#datepicker2_oen').removeClass("error");
                        //     }

                        //     if (inputError.intorder01_end) {
                        //         $('#datepicker1_oen').addClass("error");
                        //     } else {
                        //         $('#datepicker1_oen').removeClass("error");
                        //     }
                        // }
                        if (inputError.supplier) {
                            $('#supplier_v2').addClass("error");                            
                        } else {
                            $('#supplier_v2').removeClass("error");
                        }

                }
          }
      });

  } else {
    doubleClick();
  }
}
