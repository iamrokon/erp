var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function registerPurchaseConfirmation() {
    //check split item added or not added
    //$len = $("#order_details > tr").length;
    //if($len<1){
    //   alert("Please enter line data");
    //   return false;
    //}
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
    
    var bango = $("#user_id").val();
    var data = $('#mainForm,#mainForm2,#mainForm3').serialize();
    
    $.ajax({
        type: 'POST',
        url: "purchaseConfirmation/registerPurchaseConfirmation/" + bango,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#error_data").hide();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                
                $("#submit_confirmation").val('submit');
                //var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                //$(document).find("#confirmation_message").html(confirmationMsg);
                $("#confirm_line_delation_Modal").modal('show');
            }else if ($.trim(result) == 'order_number_err'){
                $("#error_data").show();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                
                $("#submit_confirmation").val('');
                var order_numberMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">発注データが存在しません。</p>';
                $(document).find("#error_data").html(order_numberMsg);
            }else if ($.trim(result) == 'pattern_mismatch'){
                $("#error_data").show();
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#submit_confirmation").val('');
                var order_numberMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">会計科目の仕入区分が混在しています。仕入区分を統一してください。</p>';
                $(document).find("#error_data").html(order_numberMsg);
            } else {
                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");
                $(document).find("#confirmation_message").html("");
                $("#update-success-msg").hide();

                //check front validation after submit
                //checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

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

                $('input[name="order_ln_number[]"]').each(function(index){
                        $(this).removeClass("error");
                });
                
                //array field error
                var temp_err_key = [];
                for (const err_field in inputError) {
                    var targetEl = '';
                    var selectInputs = ["barcode","codename"];
                    if (err_field.indexOf('.') > -1) {
                        const [inputName, key] = err_field.split('.');
                        temp_err_key[key] = key;
                        if (inputName && selectInputs.indexOf(inputName) >= 0) {
                            targetEl = $("select[name='" + inputName + "[]']").eq(key)
                        } else {
                            if(inputName == 'order_number'){
                                var newInputName = 'order_ln_number';
                                targetEl = $("input[name='" + newInputName + "[]']").eq(key) 
                            }else if(inputName == 'idoutanabango'){
                                var newInputName = 'order_ln_number';
                                targetEl = $("input[name='" + newInputName + "[]']").eq(key) 
                            }else{
                               targetEl = $("input[name='" + inputName + "[]']").eq(key) 
                            }
                            
                        }
                    } else {
                        if (err_field && selectInputs.indexOf(err_field) >= 0) {
                            targetEl = $("select[name=" + err_field + "]")
                        } else {
                            if(err_field == 'order_number'){
                                var new_err_field = 'order_ln_number';
                                targetEl = $("input[name='" + new_err_field + "[]']").eq(key) 
                            }else if(err_field == 'idoutanabango'){
                                var new_err_field = 'order_ln_number';
                                targetEl = $("input[name='" + new_err_field + "[]']").eq(key) 
                            }else{
                                targetEl = $("input[name=" + err_field + "]")
                            }
                        }
                    }
                    targetEl.addClass("error")
                }
                
                //remove error class
                $('input[name="barcode[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
                    } 
                });
                $('input[name="codename[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
                    } 
                });
                $('input[name="order_ln_number[]"]').each(function(index){
                    if( temp_err_key[index] == undefined) {
                        $(this).removeClass("error");
                    } 
                });

            }
        }
    });
}

function firstSearch(url,value_type = null) {
  buttonPress++;
  if (buttonPress == 1) {
      if(value_type == "next"){
          var current_purchase_number = $("#unsoumei").val();
          var value_type = "next";
      }else if(value_type == "previous"){
          var current_purchase_number = $("#unsoumei").val();
          var value_type = "previous";
      }else{
          var current_purchase_number = "";
          var value_type = "";
      }
      var url = url;
      var data = $('#firstSearch').serialize();
      $.ajax({
          type:"POST",
          url: url,
          data:data+"&current_purchase_number="+current_purchase_number+"&value_type="+value_type,
          success:function(result){
                if($.trim(result.status) == 'ok'){
                    buttonPress = 0;
                    $("#error_data").hide();
                    $('.error').each(function () {
                        if (this.classList.contains("error")) {
                            this.classList.remove("error");
                        }
                    });
                    
                    $("#purchaseHeaderPart").html(result.header_html);
                    $("#purchaseBodyPart").html(result.body_html);
                    
                    if($.trim(result.data_count) > 0) {
                        $("#datachar06").val(result.purchaseData[0].datachar06_tan_name_short);
                        $("#datachar07_hidden_text").val(result.purchaseData[0].datachar07_tan_name_short);
                    }
                    
                    if($.trim(result.data_count) < 1){
                        var html = '<p style="color:red;font-size: 12px;margin-bottom: 8px;">該当するデータがありません。</p>';
                        $("#error_data").html(html);
                        $("#error_data").show();
                        $("#data_count").html("");
                    }else{
                        $("#customRadiotd1_1").prop('checked', 'checked');
                        $("#hidden_total_data_count").val(result.data_count);
                        //$("#data_count").html("1/"+result.data_count);
                        $("#data_count").html(+result.current_index+"/"+result.number_of_unsoumei);
                    }
                }else{
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    $("#data_count").html("");
                    console.log(inputError);

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

                    if (inputError.touchakudate) {
                        $('#touchakudate_start').addClass("error");
                        $('#touchakudate_end').addClass("error");
                    } else {
                        if (inputError.touchakudate_start) {
                            $('#touchakudate_start').addClass("error");
                        } else {
                            $('#touchakudate_start').removeClass("error");
                        }

                        if (inputError.touchakudate_end) {
                            $('#touchakudate_end').addClass("error");
                        } else {
                            $('#touchakudate_end').removeClass("error");
                        }
                    }

                }
          }
      });

  } else {
    doubleClick();
  }
}

function displayCurrentNumber(current_number){
	var total_data_count = $("#hidden_total_data_count").val();
	//$("#data_count").html(current_number+"/"+total_data_count);
}

function backlogDataSearch(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#backlogSearch').serialize();
      var datachar08 = $("#bikou1").val();
      $.ajax({
          type:"POST",
          url: url,
          headers: {
            'X-CSRF-TOKEN': $('#bottomSearchCsrf').val()
          },
          data:data+"&datachar08="+datachar08,
          success:function(result){
                if($.trim(result.status) == 'ok'){
                    buttonPress = 0;
                    $("#error_data_2").hide();
                    $('#msearch_datachar10_detail').removeClass("error");
                    $('#msearch_information2_detail').removeClass("error");
                    $('#msearch_datachar11_detail').removeClass("error");
					
					 if($.trim(result.backlogdata_count) < 1){
                        var html = '<p style="color:red;font-size: 12px;margin-bottom: 8px;">該当するデータがありません。</p>';
                        $("#error_data_2").html(html);
                        $("#error_data_2").show();
                    }
					
                    $("#backlogContent").html(result.backlog_html);
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

                        $('#error_data_2').html(html);
                        $("#error_data_2").show();
                    }

                    if (inputError.all) {
                        $('#msearch_datachar10_detail').addClass("error");
                        $('#msearch_information2_detail').addClass("error");
                        $('#msearch_datachar11_detail').addClass("error");
                    } else {
                        $('#msearch_datachar10_detail').removeClass("error");
                        $('#msearch_information2_detail').removeClass("error");
                        $('#msearch_datachar11_detail').removeClass("error");
                    }
                  

                }
          }
      });

  } else {
    doubleClick();
  }
}


function getInstrusctorName(){
    var datachar06_hidden = $("#datachar06_hidden_text").val();
    $("#datachar06").val(datachar06_hidden);
    //$("#datachar07_hidden_text").val(datachar06_hidden);
    var toiawasebango = $("#toiawasebango").val();
    if(toiawasebango == 'U610'){
        var cn = 0;
        $(".order-number").each(function(){
          if($(this).val() == ""){
              $(this).addClass("error");
              cn++; 
          }else{
            $(this).removeClass("error");
          }  
        });
        if(cn > 0){
            var msg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">発注行番号が未入力です。</p>';
            $(document).find("#error_data").html(msg);
            $(document).find("#error_data").show();
            $("#regButton").prop("disabled",true);
            return false;
        }else{
            $(document).find("#error_data").html("");
            $("#regButton").prop("disabled",false);
        }
    }
}

function changeOrderLineNumber(order_number, syouhinsyu, formatted_syouhinsyu){
    $(".custom-radio-btn").each(function(){
        if($(this).is(':checked')) {
			var temp_id = $(this).attr('id');
			var ordr_ln_id = temp_id+"_val"
			var order_id = temp_id+"_order_number"
			var order_id_dis = temp_id+"_order_number_dis"
                        var order_ln_id = temp_id+"_order_ln_number"
			var order_ln_id_dis = temp_id+"_order_ln_number_dis"
			$("#"+ordr_ln_id).val(order_number+formatted_syouhinsyu);
			$("#"+order_id).val(order_number);
			$("#"+order_id_dis).html(order_number);
                        $("#"+order_ln_id).val(formatted_syouhinsyu);
			$("#"+order_ln_id_dis).html(formatted_syouhinsyu);
		}
    });
}

$(document).on('blur change keyup','.order-number',function(){
    var temp_val = $(this).val();
    var len = temp_val.length;
    if(len == 13){
        var order_number = temp_val.substring(0, 10);
        var sub_number = temp_val.substring(10);
        $(this).parent().closest("tr").find('.customRadiotd1_order_number').val(order_number);
        $(this).parent().closest("tr").find('.customRadiotd1__order_number_dis').html(order_number);
        $(this).parent().closest("tr").find('.customRadiotd1_order_ln_number').val(sub_number);
        $(this).parent().closest("tr").find('.customRadiotd1_order_ln_number_dis').html(sub_number);
    }
});

function getPurchaseCategoryData(own){
    var bango = $("#user_id").val();
    var toiawasebango = $("#toiawasebango").val();
    var cat = own.val();
    var checked_btn = own.parent().closest('td').closest('tr').find('.custom-radio-btn');
    var data = $('#mainForm2').serialize();
    //if (checked_btn.is(':checked')) {
    //if (toiawasebango == "") {
        $.ajax({
            type: "get",
            url: "purchaseConfirmation/getPurchaseCategoryData/"+bango,
            data: data,
            success:function(response){
                var toiawasebango = $.trim(response.toiawasebango);
                var toiawasebango_detail = $.trim(response.toiawasebango_detail);
                console.log(toiawasebango_detail);
                $("#toiawasebango").val(toiawasebango);
                $("#toiawasebango_detail").val(toiawasebango_detail);
            }
        });
    //}
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}




