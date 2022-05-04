<script type="text/javascript">

  $(document).ready(function(){
    // button press for pagination handle
    var buttonPress = 0;
    //get it if Status key found
    if(localStorage.getItem("payment_schedule_registration_success_msg"))
    {
       createSuccessMessage(localStorage.getItem("payment_schedule_registration_success_msg"));
       localStorage.removeItem("payment_schedule_registration_success_msg");
    }
  });


// Starts pagination code

function goToPage_0610_page() {
    buttonPress++;
    if (buttonPress == 1) {

        var i = document.getElementById("paginate").value;

        if (i < 1) {
            document.getElementById("paginate").value = 1;
        } else {
            document.getElementById("paginate").value = i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }

        $.ajax({
            type: "POST",
            data: $('#mainForm').serialize(),
            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
            success: function (response) {
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
            }
        });
       
    } else {
        doubleClick();
    }
}


function goForward_0610_page() {
    buttonPress++;
    if (buttonPress == 1) {

        document.getElementById('paginationhelper').disabled = false;
        var i = document.getElementById("paginate").value;

        if (i < 1) {
            document.getElementById("paginationhelper").value = 1;
        } else {
            document.getElementById("paginationhelper").value = ++i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }
        document.getElementById('paginate').disabled = true;
        document.getElementById('paginationhelper').disabled = false;
        $.ajax({
            type: "POST",
            data: $('#mainForm').serialize(),
            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
            success: function (response) {
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
            }
        });
    } else {
        doubleClick();
    }
}



function gotoBack_0610_page() {
    buttonPress++;
    if (buttonPress == 1) {
        document.getElementById('paginationhelper').disabled = false;

        var i = document.getElementById("paginate").value;
        if (i <= 1) {
            document.getElementById("paginationhelper").value = 1;
        } else {
            document.getElementById("paginationhelper").value = --i;
        }

        var mood = document.getElementById('Button').value;
        if (mood == 'sort') {
            document.getElementById('Button').value = 'sort';
        } else {
            document.getElementById('Button').value = 'Thesearch';
        }
        document.getElementById('paginate').disabled = true;
        document.getElementById('paginationhelper').disabled = false;
        $.ajax({
            type: "POST",
            data: $('#mainForm').serialize(),
            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
            success: function (response) {
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
            }
        });
    } else {
        doubleClick();
    }
}


function changeByDataAmount_0610_page() {
    buttonPress++;
    if (buttonPress == 1) {
        if (document.getElementById("paginate")) {
            document.getElementById("paginate").value = 1;
        }
        if (document.getElementById('Button').value == 'xls') {
            document.getElementById('Button').value = 'refresh';
        }
        //document.getElementById('csrf').disabled=false;
        $.ajax({
            type: "POST",
            data: $('#mainForm').serialize(),
            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
            success: function (response) {
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
            }
        });
    } else {
        doubleClick();
    }
}


function doubleClick() {
    alert('処理中です');
}

// ./ Ends pagination code

  function createSuccessMessage(message) {
    if ($(document).find("#successMsg")) {
        $(document).find("#successMsg").remove();
    }
    var success_html = `
    <div class="row success-msg-box" id="successMsg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: block;">
        <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
                    <strong id="success_data">${message}</strong>
            </div>
        </div>
    </div>
    `;
    $("#error_data").before(success_html)
}

  // 241 payment schedule registration
  function registerPaySchedule(){
    $(".registerPayScheduleSubmitButton").prop('disabled', true); 

    var bango=$('#userId').val();
    var data = new FormData(document.getElementById('insertData'));
   
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        type: "POST",
       // data: $('#insertData, #insertPaymentBalanceData').serialize(),
        data: data,
        url: "pay-schedule-reg/register/" + bango,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response){
           if(response.err_field){
              console.log("yes")
              console.log(response);
              var inputErrorMsg = response.err_msg;
              var html = '';
              html = '<div>';
              var custom_3_1_message_flag = 0;
              var custom_3_2_message_flag = 0;
              var purchase_payment_schedule_reg_101_flag = 0;
              var purchase_payment_schedule_reg_102_flag = 0;
              var purchase_payment_schedule_reg_212_flag = 0;
              var purchase_payment_schedule_reg_214_flag = 0;
              var purchase_payment_schedule_reg_216_flag = 0;
              var purchase_payment_schedule_reg_222_flag = 0;
              var purchase_payment_schedule_reg_224_flag = 0;
              var purchase_payment_schedule_reg_226_flag = 0;
              var purchase_payment_schedule_reg_231_flag = 0;

              var globalVariableFlag = 0;
              var globalVariableFlag2 = 0;

              if (inputErrorMsg) {
                for (var count = 0; count < inputErrorMsg.length; count++) {
                  var error_message = inputErrorMsg[count];
                   var error_message_count = 0;
                
                  // 3.1 error message 該当するデータがありません。
                  // 3.2 error message 支払額0円は登録できません。
                  if(error_message == "該当するデータがありません。" || error_message == "支払額0円は登録できません。"){
                    
                    // Show the error message for 3.1
                    html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 17px;">' + error_message + '</p>';
                       error_message_count++;

                    // Show the red border of 211, 213, 215, 221, 223, 225 field
                    globalVariableFlag = 1;

                  }else{
                    if(error_message == "purchase_payment_schedule_reg_212_not_in_0" || error_message == "purchase_payment_schedule_reg_214_not_in_0" || error_message == "purchase_payment_schedule_reg_216_not_in_0" || error_message == "purchase_payment_schedule_reg_222_not_in_0" || error_message == "purchase_payment_schedule_reg_224_not_in_0" || error_message == "purchase_payment_schedule_reg_226_not_in_0"){
                        if(globalVariableFlag2 == 0){
                            if($("#success_result_3_2").val() == "success_result_3_2"){    
                                html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 17px;">支払額0円は登録できません。</p>';
                                globalVariableFlag2 = 1;
                            }else{
                                if($("#success_result_3_1").val() == "success_result_3_1"){    
                                    html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 17px;">該当するデータがありません。</p>';
                                    globalVariableFlag2 = 1;
                                }
                            }
                        }
                        
                    }else{
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + error_message + '</p>';
                    } 
                  }

                  if(globalVariableFlag == 1){
                    paymentBalance3_1Validation(1);
                  }

                  if(globalVariableFlag == 0){
                    paymentBalance3_1Validation(0);
                  }


                  // purchase_payment_schedule_reg_101
                  if(error_message == "【締切日】必須項目に入力がありません。"){
                      if(!$("#purchase_payment_schedule_reg_101").hasClass("error")){
                          $("#purchase_payment_schedule_reg_101").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_101_flag = 1;
                  }

                   // purchase_payment_schedule_reg_102
                  if(error_message == "【仕入先・購入先】必須項目に入力がありません。"){
                      if(!$("#purchase_payment_schedule_reg_102").hasClass("error")){
                          $("#purchase_payment_schedule_reg_102").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_102_flag = 1;
                  }

                  // purchase_payment_schedule_reg_212
                  if(error_message == "【仕入支払額1】必須項目に入力がありません。" || error_message == "【仕入支払額1】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_212_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_212").hasClass("error")){
                          $("#purchase_payment_schedule_reg_212").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_212_flag = 1;
                  }

                   // purchase_payment_schedule_reg_214
                  if(error_message == "【仕入支払額2】必須項目に入力がありません。" || error_message == "【仕入支払額2】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_214_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_214").hasClass("error")){
                          $("#purchase_payment_schedule_reg_214").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_214_flag = 1;
                  }

                   // purchase_payment_schedule_reg_216
                  if(error_message =="【仕入支払額3】必須項目に入力がありません。" || error_message == "【仕入支払額3】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_216_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_216").hasClass("error")){
                          $("#purchase_payment_schedule_reg_216").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_216_flag = 1;
                  }

                  // purchase_payment_schedule_reg_222
                  if(error_message == "【購入支払額1】必須項目に入力がありません。" || error_message == "【購入支払額1】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_222_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_222").hasClass("error")){
                          $("#purchase_payment_schedule_reg_222").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_222_flag = 1;
                  }

                   // purchase_payment_schedule_reg_224
                  if(error_message =="【購入支払額2】必須項目に入力がありません。" || error_message == "【購入支払額2】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_224_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_224").hasClass("error")){
                          $("#purchase_payment_schedule_reg_224").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_224_flag = 1;
                  }

                   // purchase_payment_schedule_reg_226
                  if(error_message =="【購入支払額3】必須項目に入力がありません。" || error_message == "【購入支払額3】半角英数字・ｶﾅ・記号以外は使用できません。" || error_message == "purchase_payment_schedule_reg_226_not_in_0"){
                      if(!$("#purchase_payment_schedule_reg_226").hasClass("error")){
                          $("#purchase_payment_schedule_reg_226").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_226_flag = 1;
                  }

                  // purchase_payment_schedule_reg_231
                  if(error_message == "【手形期日】必須項目に入力がありません。"){
                      if(!$("#purchase_payment_schedule_reg_231").hasClass("error")){
                          $("#purchase_payment_schedule_reg_231").addClass("error");
                      }
                      error_message_count++;
                      purchase_payment_schedule_reg_231_flag = 1;
                  }

                  if(error_message_count > 0){
                      window.scrollTo(0, 0);
                  }
                } // ./ Ends error Loop
              } // ./ Ends input error condition if

              // remove the error_data if exist
              // console.log("datepicker11_oen_flag : " + datepicker11_oen_flag)
              if(purchase_payment_schedule_reg_101_flag == 0 && $("#purchase_payment_schedule_reg_101").hasClass("error")){
                  $('#purchase_payment_schedule_reg_101').removeClass("error");
              }

              if(purchase_payment_schedule_reg_102_flag == 0 && $("#purchase_payment_schedule_reg_102").hasClass("error")){
                  $('#purchase_payment_schedule_reg_102').removeClass("error");
              }

              if(purchase_payment_schedule_reg_212_flag == 0 && $("#purchase_payment_schedule_reg_212").hasClass("error")){
                  $('#purchase_payment_schedule_reg_212').removeClass("error");
              }


              if(purchase_payment_schedule_reg_214_flag == 0 && $("#purchase_payment_schedule_reg_214").hasClass("error")){
                  $('#purchase_payment_schedule_reg_214').removeClass("error");
              }

              if(purchase_payment_schedule_reg_216_flag == 0 && $("#purchase_payment_schedule_reg_216").hasClass("error")){
                  $('#purchase_payment_schedule_reg_216').removeClass("error");
              }

              if(purchase_payment_schedule_reg_222_flag == 0 && $("#purchase_payment_schedule_reg_222").hasClass("error")){
                  $('#purchase_payment_schedule_reg_222').removeClass("error");
              }

              if(purchase_payment_schedule_reg_224_flag == 0 && $("#purchase_payment_schedule_reg_224").hasClass("error")){
                  $('#purchase_payment_schedule_reg_224').removeClass("error");
              }

              if(purchase_payment_schedule_reg_226_flag == 0 && $("#purchase_payment_schedule_reg_226").hasClass("error")){
                  $('#purchase_payment_schedule_reg_226').removeClass("error");
              }

              if(purchase_payment_schedule_reg_231_flag == 0 && $("#purchase_payment_schedule_reg_231").hasClass("error")){
                  $('#purchase_payment_schedule_reg_231').removeClass("error");
              }


              html += '</div>';
              $('#error_data').html(html);
              $("#error_data").show();
              $("#submit_confirmation").val('');
              $(document).find("#confirmation_message").html("");
              $(".registerPayScheduleSubmitButton").prop('disabled', false); 

           }else{
               if(($.trim(response) == 'confirm')){
                $('#error_data').html("");
                $(document).find("#submit_confirmation").val("submit");
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;"> 登録はまだ完了していません。内容をご確認後、もう一度登録ボタンを押してください。</p>';
                $(document).find("#confirmation_message").html(confirmationMsg);
                $(".registerPayScheduleSubmitButton").prop('disabled', false); 
                removeErrorIfExist();
              }else{
                $(".registerPayScheduleSubmitButton").prop('disabled', true); 
                $("#submit_confirmation").val('');
                $(document).find("#confirmation_message").html("");
                localStorage.setItem("payment_schedule_registration_success_msg", response.success_msg);
                window.location.reload(); 
              } // ./ Ends confirmation message
            } // ./ Ends response.err_field

         
        },
        
        error: function (error){
            console.log("error")
        }
      });
  }


  // remove error if exist
  function removeErrorIfExist(){
    $('#purchase_payment_schedule_reg_101').removeClass("error");
    $('#purchase_payment_schedule_reg_102').removeClass("error");
    $('#purchase_payment_schedule_reg_212').removeClass("error");
    $('#purchase_payment_schedule_reg_214').removeClass("error");
    $('#purchase_payment_schedule_reg_216').removeClass("error");
    $('#purchase_payment_schedule_reg_222').removeClass("error");
    $('#purchase_payment_schedule_reg_224').removeClass("error");
    $('#purchase_payment_schedule_reg_226').removeClass("error");
    $('#purchase_payment_schedule_reg_231').removeClass("error");
  }


  // summation field when onchange 212, 214, 216
  // summation field when onchange 222, 224, 226
  $("#purchase_payment_schedule_reg_212").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_212").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_212").val(temp);
  });

  $("#purchase_payment_schedule_reg_214").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_214").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_214").val(temp);
  });

  $("#purchase_payment_schedule_reg_216").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_216").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_216").val(temp);
  });

  $("#purchase_payment_schedule_reg_222").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_222").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_222").val(temp);
  });

  $("#purchase_payment_schedule_reg_224").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_224").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_224").val(temp);
  });

  $("#purchase_payment_schedule_reg_226").on("change", function () {
     do_summation();
     var temp = Number($("#purchase_payment_schedule_reg_226").val().replace(/\,/g,''));
     temp = formatNumber(temp);
     $("#purchase_payment_schedule_reg_226").val(temp);
  });

  function do_summation(){
    var sum1 = Number($("#purchase_payment_schedule_reg_212").val().replace(/\,/g,'')) + Number($("#purchase_payment_schedule_reg_214").val().replace(/\,/g,'')) + Number($("#purchase_payment_schedule_reg_216").val().replace(/\,/g,''));
    var sum2 = Number($("#purchase_payment_schedule_reg_222").val().replace(/\,/g,'')) + Number($("#purchase_payment_schedule_reg_224").val().replace(/\,/g,'')) + Number($("#purchase_payment_schedule_reg_226").val().replace(/\,/g,''));

    var sum3 = sum1 + sum2;

    $("#purchase_payment_schedule_reg_217").val(formatNumber(sum1));
    $("#purchase_payment_schedule_reg_227").val(formatNumber(sum2));
    $("#purchase_payment_schedule_reg_232").val(formatNumber(sum3));
  }

  // 3.1 paymentBalance3_validation
  function paymentBalance3_1Validation(flag){
    if(flag == 1){
       // 211
        if(!$("#purchase_payment_schedule_reg_211").hasClass("error")){
          $("#purchase_payment_schedule_reg_211").addClass("error");
        }
    

        // 213
        if(!$("#purchase_payment_schedule_reg_213").hasClass("error")){
          $("#purchase_payment_schedule_reg_213").addClass("error");
        }

        // 215
        if(!$("#purchase_payment_schedule_reg_215").hasClass("error")){
          $("#purchase_payment_schedule_reg_215").addClass("error");
        }
    

        // 221
        if(!$("#purchase_payment_schedule_reg_221").hasClass("error")){
          $("#purchase_payment_schedule_reg_221").addClass("error");
        }
        

        // 223 
        if(!$("#purchase_payment_schedule_reg_223").hasClass("error")){
          $("#purchase_payment_schedule_reg_223").addClass("error");
        }
        

        // 
        if(!$("#purchase_payment_schedule_reg_225").hasClass("error")){
          $("#purchase_payment_schedule_reg_225").addClass("error");
        }  
    }else{
        $("#purchase_payment_schedule_reg_211").removeClass("error");
        $("#purchase_payment_schedule_reg_213").removeClass("error");
        $("#purchase_payment_schedule_reg_215").removeClass("error");
        $("#purchase_payment_schedule_reg_221").removeClass("error");
        $("#purchase_payment_schedule_reg_223").removeClass("error");
        $("#purchase_payment_schedule_reg_225").removeClass("error");
    }
    
    
  }


  // 202 button click handle
  function process_2_202_display(){
      var ajaxFlag = 0;
      var purchase_payment_schedule_reg_101 = $("#purchase_payment_schedule_reg_101").val();
      var purchase_payment_schedule_reg_102 = $("#purchase_payment_schedule_reg_102").val();
      var purchase_payment_schedule_reg_201 = $('input[name="purchase_payment_schedule_reg_201"]:checked').val();

      // console.log('purchase_payment_schedule_reg_101 : ' + purchase_payment_schedule_reg_101)
      // console.log('purchase_payment_schedule_reg_102: ' + purchase_payment_schedule_reg_102)

      var flag = 0;
      
      var html = '';
      html = '<div>';
      
      if(purchase_payment_schedule_reg_101 == ''){
        $("#purchase_payment_schedule_reg_101").addClass("error");
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">【締切日】必須項目に入力がありません。</p>';
        flag++;
      }else{
        $("#purchase_payment_schedule_reg_101").removeClass("error");
      }

      if(purchase_payment_schedule_reg_102 == ''){
        $("#purchase_payment_schedule_reg_102").addClass("error");
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">【仕入先・購入先】必須項目に入力がありません。</p>';
        flag++;
      }else{
        $("#purchase_payment_schedule_reg_102").removeClass("error");
      }

      if(flag > 0){
        ajaxFlag++;
        html += '</div>';
        $('#error_data').html(html);
        $("#error_data").show();
      }else{
        $("#error_data").hide();
      }


      // search condition
      if(ajaxFlag == 0){
          var bango='{{$bango}}';

          $.ajax({
              url:  "/pay-schedule-reg/process_2_202_display_data/" + bango,
              type: "GET",
              data: "purchase_payment_schedule_reg_101="+purchase_payment_schedule_reg_101+'&purchase_payment_schedule_reg_102='+purchase_payment_schedule_reg_102+'&purchase_payment_schedule_reg_201='+purchase_payment_schedule_reg_201,
              success: function( response ){
                if(response.status == "false" && response.error == "error"){
                    var html = '';
                    html = '<div>';
                    html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+response.errror_message+'</p>';
                    html += '</div>';
                    $('#error_data').html(html);
                    $("#error_data").show();
                }else{
                    // remove the error_data
                    $("#error_data").hide();

                    // 3.2 and 5.2 spec
                    if(response.status == "true" && response.success == "success_result_3_2"){
                      var response_result = response.result_3_2;
                     

                      $("#purchase_payment_schedule_reg_111").val(0);
                      $("#purchase_payment_schedule_reg_112").val(0);
                      $("#purchase_payment_schedule_reg_113").val(0);
                      $("#purchase_payment_schedule_reg_114").val(0);
                      $("#purchase_payment_schedule_reg_115").val(0);
                      $("#purchase_payment_schedule_reg_116").val(0);
                      $("#purchase_payment_schedule_reg_117").val(0);
                      $("#purchase_payment_schedule_reg_118").val(0);
                      $("#purchase_payment_schedule_reg_119").val(0);

                      $("#purchase_payment_schedule_reg_211").val(response_result["purchase_payment_schedule_reg_211"]);
                      $("#purchase_payment_schedule_reg_221").val(response_result["purchase_payment_schedule_reg_221"]);

                      $("#purchase_payment_schedule_reg_212").val(0);
                      if(response_result["purchase_payment_schedule_reg_211"] == 'D901' || response_result["purchase_payment_schedule_reg_211"] == 'D906'){
                        $("#purchase_payment_schedule_reg_214").val(response_result["purchase_payment_schedule_reg_211"]);
                        $("#purchase_payment_schedule_reg_213").val(response_result["purchase_payment_schedule_reg_211"]);
                        $("#purchase_payment_schedule_reg_223").val(response_result["purchase_payment_schedule_reg_211"]);
                      }else{
                        $("#purchase_payment_schedule_reg_214").val('');
                        $("#purchase_payment_schedule_reg_213").val('');
                        $("#purchase_payment_schedule_reg_223").val('');
                      }

                      $("#purchase_payment_schedule_reg_214").val(0);
                      $("#purchase_payment_schedule_reg_216").val(0);
                      $("#purchase_payment_schedule_reg_217").val(0);
                      $("#purchase_payment_schedule_reg_222").val(0);
                      $("#purchase_payment_schedule_reg_224").val(0);
                      $("#purchase_payment_schedule_reg_226").val(0);
                      $("#purchase_payment_schedule_reg_227").val(0);
                      $("#purchase_payment_schedule_reg_232").val(0);
                      // @20220418 added
                      // @20220421 removed
                    //  $("#purchase_payment_schedule_reg_231").val("1970/01/01");


                      $("#success_result_3_2").val("success_result_3_2");
                      $("#success_result_3_1").val("");
                       // for pagination
                      $("#pagination_dynamic_variable").val('');
                      $("#pagination_dynamic_variable_purchase_payment_schedule_reg_101").val('');
                      $("#pagination_dynamic_variable_purchase_payment_schedule_reg_102").val('');
                      $("#pagination_dynamic_variable_purchase_payment_schedule_reg_201").val('');

                       $.ajax({
                            type: "POST",
                            data: $('#mainForm').serialize(),
                            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
                            success: function (response) {

                                var test = document.getElementById("payment_schedule_registration_0610_pagination_header_html_pagination_new1"); 

                                if(test){
                                   // console.log("yes");
                                    $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                                }else{
                                   // console.log("no");
                                    if(document.getElementById("tmp_internal_payment_schedule_registration_0610_pagination_header_html_pagination_new1")){
                                        $('#tmp_internal_payment_schedule_registration_0610_pagination_header_html_pagination_new1').remove();
                                    }
                                     $(response.html_pagination_new1_rendered).insertBefore("#payment_schedule_registration_0610_pagination_header_html_pagination_new2");
                                }

                                
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
                            }
                        });
                       
                     // $("#pay_schedule_registration_id").empty();
                    }else{
                      // 3.1 and 5.1 spec
                      if(response.status == "true" && response.success == "success_result_3_1"){
                        var response_result = response.result_3_1;
                        // fillable 111-119
                        $("#success_result_3_1").val("success_result_3_1");
                        $("#success_result_3_2").val("");
                        $("#purchase_payment_schedule_reg_111").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_111"]));
                        $("#purchase_payment_schedule_reg_112").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_112"]));
                        $("#purchase_payment_schedule_reg_113").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_113"]));
                        $("#purchase_payment_schedule_reg_114").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_114"]));
                        $("#purchase_payment_schedule_reg_115").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_115"]));
                        $("#purchase_payment_schedule_reg_116").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_116"]));
                        $("#purchase_payment_schedule_reg_117").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_117"]));
                        $("#purchase_payment_schedule_reg_118").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_118"]));
                        $("#purchase_payment_schedule_reg_119").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_119"]));

                        // fillable 211-232
                        $("#purchase_payment_schedule_reg_211").val(response_result[0]["purchase_payment_schedule_reg_211"]);
                        $("#purchase_payment_schedule_reg_212").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_212"]));
                        $("#purchase_payment_schedule_reg_213").val(response_result[0]["purchase_payment_schedule_reg_213"]);
                        $("#purchase_payment_schedule_reg_214").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_214"]));
                        $("#purchase_payment_schedule_reg_215").val(response_result[0]["purchase_payment_schedule_reg_215"]);
                        $("#purchase_payment_schedule_reg_216").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_216"]));

                        if(response_result[0]["purchase_payment_schedule_reg_217"]){
                            $("#purchase_payment_schedule_reg_217").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_217"]));
                        }else{
                            $("#purchase_payment_schedule_reg_217").val(0);
                        }
                        

                        $("#purchase_payment_schedule_reg_221").val(response_result[0]["purchase_payment_schedule_reg_221"]);
                        $("#purchase_payment_schedule_reg_222").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_222"]));
                        $("#purchase_payment_schedule_reg_223").val(response_result[0]["purchase_payment_schedule_reg_223"]);
                        $("#purchase_payment_schedule_reg_224").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_224"]));
                        $("#purchase_payment_schedule_reg_225").val(response_result[0]["purchase_payment_schedule_reg_225"]);
                        $("#purchase_payment_schedule_reg_226").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_226"]));
                        
                        if(response_result[0]["purchase_payment_schedule_reg_227"]){
                            $("#purchase_payment_schedule_reg_227").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_227"]));
                        }else{
                            $("#purchase_payment_schedule_reg_227").val(0);
                        }

                        //$("#purchase_payment_schedule_reg_231").val(response_result[0]["purchase_payment_schedule_reg_231"]);

                        // @20220421 removed

                        // if(response_result[0]["purchase_payment_schedule_reg_231"]){
                        //     $("#purchase_payment_schedule_reg_231").val(response_result[0]["purchase_payment_schedule_reg_231"]);
                        // }else{
                        //     $("#purchase_payment_schedule_reg_231").val("1970/01/01");
                        // }

                        $("#purchase_payment_schedule_reg_231").val(response_result[0]["purchase_payment_schedule_reg_231"]);

                        if(response_result[0]["purchase_payment_schedule_reg_232"]){
                             $("#purchase_payment_schedule_reg_232").val(formatNumber(response_result[0]["purchase_payment_schedule_reg_232"]));
                         }else{
                             $("#purchase_payment_schedule_reg_232").val(0);
                         }

                        $("#pagination_dynamic_variable").val("payment_datatable_3_1");
                        $("#pagination_dynamic_variable_purchase_payment_schedule_reg_101").val($("#purchase_payment_schedule_reg_101").val());
                        $("#pagination_dynamic_variable_purchase_payment_schedule_reg_102").val($("#purchase_payment_schedule_reg_102").val());
                        $("#pagination_dynamic_variable_purchase_payment_schedule_reg_201").val($('input[name="purchase_payment_schedule_reg_201"]:checked').val());

                        
                        // table generate => 301-310
                        $.ajax({
                            type: "POST",
                            data: $('#mainForm').serialize(),
                            url: "/pay-schedule-reg/handle-payment-schedule-registration-pagination",
                            success: function (response) {
                                
                                var test = document.getElementById("payment_schedule_registration_0610_pagination_header_html_pagination_new1"); 

                                if(test){
                                   // console.log("yes");
                                    $('#payment_schedule_registration_0610_pagination_header_html_pagination_new1').html(response.html_pagination_new1_rendered);
                                }else{
                                   // console.log("no");
                                    if(document.getElementById("tmp_internal_payment_schedule_registration_0610_pagination_header_html_pagination_new1")){
                                        $('#tmp_internal_payment_schedule_registration_0610_pagination_header_html_pagination_new1').remove();
                                    }
                                     $(response.html_pagination_new1_rendered).insertBefore("#payment_schedule_registration_0610_pagination_header_html_pagination_new2");
                                }

                                
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new2').html(response.html_pagination_new2_rendered);
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new3').html(response.html_pagination_new3_rendered);
                                $('#payment_schedule_registration_0610_pagination_body').html(response.html_pagination_new6_body_rendered);
                                $('#payment_schedule_registration_0610_pagination_header_html_pagination_new4').html(response.html_pagination_new4_rendered);
                            }
                        });

                      }
                    }
                }
              }
          });
      }
  }



  $(document).ready(function(){
    $("#closetopcontent").click(function(){
      $(".order_entry_topcontent").toggle();
    });
  });
 function contentHideShow() {
  var hideShow = document.getElementById("closetopcontent");
  if (hideShow.innerHTML === "閉じる") {
    hideShow.innerHTML = "開く";
  } else {
    hideShow.innerHTML = "閉じる";
  }
}
</script>
<script>
  $(document).ready(function(){
  /*$(".first-table").hide();*/
  $("button#searchButton").click(function(){
    $(".first-table").show();
  });
});
$(document).ready(function(){
    $(".second-table").hide();
    $(".first-table").click(function(){
     $(".second-table").show();
    });
});
$(document).ready(function(){
   $(".third-table").hide();
  $(".second-table").click(function(){
    $(".third-table").show();
  });
});
</script>
<script type="text/javascript">
  $("#modalarea").on('click', function(){
      $(".modal-backdrop").addClass("overflow_cls");
      // $('.modal-backdrop').remove();
    });

$("#modalarea").on("click", function(){
$('.modal-backdrop').remove();
$('#modalarea').on('show.bs.modal', function (e) {
$('body').addClass('overflow_cls');

})
$('#modalarea').on('hide.bs.modal', function (e) {
$('body').removeClass('overflow_cls');
})
$("#modalarea").modal("hide");
});
</script>
<script type="text/javascript">
  // Date Picker Initialization
    // Start
    $('.datePicker1_1').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
    trigger: '.datePicker1_1'
  });

  $(document).on('change focus', '.datePicker1_1', function () {
    if ($(this).val().length == 10) {
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      $(this).focus();
      $(this).datepicker('hide');
    }
  });

  $(document).on('click', '.datePicker1_1', function () {
    if ($(this).val().length == 0) {
      $(this).datepicker('show');
    }
    else if ($(this).val().length <= 7 ) {
      $(this).datepicker('hide');
    }
  });

  $(document).on('keyup', '.datePicker1_1', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });

  // Update date value with slash on blur
  $(document).on('blur', '.datePicker1_1', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  //Enter press hide dropdown
  $(".datePicker1_1").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker1_1").datepicker('hide');
    }
  });


  // End
  $('.datePicker1_2').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
    trigger: '.datePicker1_2'
  });

  $(document).on('change focus', '.datePicker1_2', function () {
    if ($(this).val().length == 10) {
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      $(this).focus();
      $(this).datepicker('hide');
    }
  });

  $(document).on('click', '.datePicker1_2', function () {
    if ($(this).val().length == 0) {
      $(this).datepicker('show');
    }
    else if ($(this).val().length <= 7 ) {
      $(this).datepicker('hide');
    }
  });

  $(document).on('keyup', '.datePicker1_2', function (e) {
    // $(this).datepicker('hide');
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });

  // Update date value with slash on blur
  $(document).on('blur', '.datePicker1_2', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  //Enter press hide dropdown
  $(".datePicker1_2").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker1_2").datepicker('hide');
    }
  });
</script>



<!-- script for take only 60 characters in textarea field -->
<script>
  //file upload show name....
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
<script>
  // Knockout
  ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
              var self = $(this),
                  form = $(element),
                  focusable, next;
              if (e.keyCode == 13 && !e.shiftKey) {
                  focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                  // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                  var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                  next = focusable.eq(nextIndex);
                  next.focus();
                  return false;
              }
              if (e.keyCode == 9) {
                  e.preventDefault();
              }

              // Shift+Enter to select table row
              if (e.keyCode == 13 && e.shiftKey) {
                var rowSelect2 = $('.rowSelect');
                $(this).trigger('click');
              }
          });
      }
  };
  ko.applyBindings({});

</script>
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
  $(".datePicker1_1").datepicker('hide');
  $(".datePicker1_2").datepicker('hide');
});
</script>
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>