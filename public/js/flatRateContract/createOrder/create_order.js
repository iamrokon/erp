//registration order
function createOrder() {
    
    var bango = $("input[id='userId']").val();
    var data = $('#insertData').serialize();
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    
    $.ajax({
        type: 'POST',
        url: "create-order/register/" + bango,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            console.log(result);
            if ($.trim(result.status) == 'ok') {
                //reset submit confirmation
                $("#submit_confirmation").val("");
                
                $(".common_error").css("display",'none');
                $(".loading").removeClass('show');
                $(document).find("#confirmation_message").html('<div></div>');
                //$("#num_su").text('('+result.success_msg.length+')')
                var success_msg = $.trim(result.success_msg);
                
                var html = '<div id="success_msg" class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">'+
                      '<div class="col-12 pl-0 pr-0 ml-3">'+
                        '<div class="alert alert-primary alert-dismissible">'+
                          '<button type="button" class="close" data-dismiss="alert" autofocus onclick="$("#division_datachar05_start").focus();">&times;</button>'+
                          '<strong><span id="num_su"></span></strong><br>'+
                        '</div>'+
                      '</div>'+
                    '</div>'
                $("#success_msg").html(html);
                $("#num_su").text($.trim(result.success_msg));
                $("#success_msg").css("display",'block');
                
                //location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $(".success-msg-box").css("display",'none');
                $(".common_error").css("display",'none');
                $(".loading").removeClass('show');
                $('#error_data').html("");
                $('#datepicker1_oen').removeClass("error");
                $('#datepicker2_oen').removeClass("error");
                $('#information2_1_err').removeClass("error");
                $('#information2_2_err').removeClass("error");
                $("#submit_confirmation").val('submit');
                $('#error_data').css("display", "");
                var confirmationMsg = '<p style="margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「データ作成」をお願いします。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
            }else if($.trim(result) == 'ng'){
                $(".common_error").css("display",'none');
                $("#success_msg").css("display",'none');
                $(".loading").removeClass('show');
                $('#datepicker1_oen').removeClass("error");
                $('#datepicker2_oen').removeClass("error");
                $('#information2_1_err').removeClass("error");
                $('#information2_2_err').removeClass("error");
                var html = '<p id="no_found_data" style="color: red; margin-bottom: 5px;">検索結果に該当するデータがありません。</p>';
                $('#error_data').html(html);
                $('#error_data').css("display", "");
            }else if($.trim(result.status) == 'ng'){
                $(".loading").removeClass('show');
                $("#success_msg").css("display",'none');
                $(document).find("#confirmation_message").html('<div></div>');
                var html = '<p id="no_found_data" style="color: red; margin-bottom: 5px;">検索結果に該当するデータがありません。</p>';
                $('#error_data').html(html);
                $('#error_data').css("display", "");
                //location.reload();
            }else {
                $(".loading").removeClass('show');
                
                var inputError = result.err_field;
                console.log(inputError);
                
                 //reset submit confirmation
                $("#submit_confirmation").val("");
                
                $("#confirmation_message").html("");

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

                if (inputError.kanryoubi) {
                    $('#datepicker1_oen').addClass("error");
                    $('#datepicker2_oen').addClass("error");
                } else {
                    if (inputError.kanryoubi_start) {
                        $('#datepicker1_oen').addClass("error");
                    } else {
                        $('#datepicker1_oen').removeClass("error");
                    }
                    if (inputError.kanryoubi_end) {
                        $('#datepicker2_oen').addClass("error");
                    } else {
                        $('#datepicker2_oen').removeClass("error");
                    }
                }
                
                if (inputError.information2_start) {
                    $('#information2_1_err').addClass("error");
                } else {
                    $('#information2_1_err').removeClass("error");
                }
                if (inputError.information2_end) {
                    $('#information2_2_err').addClass("error");
                } else {
                    $('#information2_2_err').removeClass("error");
                }
            }
        },
        beforeSend:function(){
            $(".loading").addClass('show');
        }
    });
}


