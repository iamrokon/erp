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

                        if (inputError.datatxt0003) {
                            $('#division_datachar05_start').addClass("error");
                        } else {
                            $('#division_datachar05_start').removeClass("error");
                        }
                        
                        if (inputError.datatxt0004) {
                            $('#department_datachar05_start').addClass("error");
                        } else {
                            $('#department_datachar05_start').removeClass("error");
                        }

                        if (inputError.date) {
                            $('#start_date').addClass("error");
                            $('#end_date').addClass("error");
                        } else {
                            if (inputError.start_date) {
                                $('#start_date').addClass("error");
                            } else {
                                $('#start_date').removeClass("error");
                            }

                            if (inputError.end_date) {
                                $('#end_date').addClass("error");
                            } else {
                                $('#end_date').removeClass("error");
                            }
                        }
                        
                        if (inputError.creation_category) {
                            $('#creation_category').addClass("error");
                        } else {
                            $('#creation_category').removeClass("error");
                        }
                        
                        if (inputError.seal_classification) {
                            $('#seal_classification').addClass("error");
                        } else {
                            $('#seal_classification').removeClass("error");
                        }

                }
          }
      });

  } else {
    doubleClick();
  }
}

function pdfCreation(url) {
  buttonPress++;
  if (buttonPress == 1) {
      buttonPress = 0;
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        //var bill_to_len = $('#mail_bill_to:checked').length;
        //if(bill_to_len>0){
        //    var mail_bill_to = 1;
        //}else{
        //    var mail_bill_to = 0;
        //}

        //var billing_address_len = $('#mail_billing_address:checked').length;
        //if(billing_address_len>0){
        //    var mail_billing_address = 1;
        //}else{
        //    var mail_billing_address = 0;
        //}
        $(".progress").toggle();
        var per_progress = parseInt(100 / len);
        $("#customprogress").css('pointer-events','none');
        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            //data:data+"&bill_to="+mail_bill_to+"&billing_address="+mail_billing_address,
            data:data,
            success:function(result){
                if(result[0]=='end'){
                    if (localStorage.getItem('supportPdfGenProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('supportPdfGenProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                    }else{
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    
                    localStorage.removeItem('supportPdfGenProgressBar')
                    //$(".loading").removeClass('show');
                    //var html = "<p style='font-weight: bold;color: #0c51a7; margin: 0px;'>"+result[2]+": execution time "+ result[1].date+"</p>";
                    //$("#error_data").append(html);
                    location.reload();  
                }else if(result[0]=='going'){
                    if (localStorage.getItem('supportPdfGenProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('supportPdfGenProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                        localStorage.setItem('supportPdfGenProgressBar',newprogress);
                    }else{
                        localStorage.setItem('supportPdfGenProgressBar',per_progress);
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    
                    pdfCreation(url);
                    //var html = "<p style='font-weight: bold;color: #0c51a7; margin: 0px;'>"+result[2]+": execution time "+ result[1].date+"</p>";
                    //$("#error_data").append(html);
                }else if($.trim(result) == 'ng'){
                    location.reload();
                }else{
                  console.log("Something went wrong");
                }
            },
            //error: function(xmlhttprequest, textstatus, message) {
                //if(textstatus==="error") {
                    //$(".loading").removeClass('show');
                    //location.reload();
                //} 
           // },
            beforeSend:function(){
                //$(".loading").addClass('show');
            }
        });
        
    }else{
        var html = "<p>対象が選択されていません。</p>";
        $('#error_data').html(html);
    }

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


function downloadPDF(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            async: false,
            data:data,
            success:function(result){
                if(result.length>0 && typeof result !=='string'){
                   for(var i=0;i<result.length;i++ ){
                        var position = result[i].lastIndexOf("/");
                        var filename = result[i].substr(position+1);
                        //download the file
                        download(result[i],filename);
                    }

                    buttonPress = 0;
                    $('.loading-icon').hide();

                    $('#error_data').html("");
                    //document.getElementById('req_status_msg_main').style.display = 'block';
                    //document.getElementById('req_status_msg').innerHTML = 'ダウンロードが完了しました。';

                    $(".unselectall").click();
                    location.reload();
                }else{
                    $('.update_common_error').hide();
                    $('.loading-icon').hide();
                    setTimeout(function(){
                       $('.progress').hide();
                       $('.loading-icon').hide();
                    },1000);
                    buttonPress = 0;
                    var html = "<p>PDF未作成のデータです。</p>";
                    $('#error_data').html(html);
                    //document.getElementById('req_status_msg_main').style.display = 'block';
                    //document.getElementById('req_status_msg').innerHTML = 'PDF未作成のデータです。';
                    $(".unselectall").click();
                    console.log("No PDF found");
                }
            }
        });
      }else{
           buttonPress = 0;
           var html = "<p>対象が選択されていません。</p>";
           $('#error_data').html(html);
      }

  } else {
    doubleClick();
  }
}


function download(res,filename){
    fetch(res)
    .then(resp => resp.blob())
    .then(blob => {
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = url;
      // the filename you want
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      window.URL.revokeObjectURL(url);
    });
}


function updateSelectedSupportReqCon(url) {
  buttonPress++;
  if (buttonPress == 1) {
      buttonPress = 0;
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var submit_confirmation = $("#submit_confirmation").val();
        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            data:data+"&submit_confirmation="+submit_confirmation,
            success:function(result){
                if($.trim(result) == 'ok'){
                    location.reload();  
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#update-success-msg").css("display","none");
                    $("#submit_confirmation").val('submit');
                    $('.common_error').html("");
                    $('#error_data').html("");
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「検印」をお願いします。</p>';
                    $(document).find("#confirmation_message").html(confirmationMsg);
                    buttonPress = 0;
                }else{
                   // location.reload();  
                }
            },
            beforeSend:function(){
                //$(".loading").addClass('show');
            }
        });
        
    }else{
        var html = "<p>対象が選択されていません。</p>";
        $('#error_data').html(html);
    }

  } else {
    doubleClick();
  }
}

function gotoSupportInquiry(kokyakuorderbango,ordertypebango2){
    $("#kokyakuorderbango").val(kokyakuorderbango);
    $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToSupportInquiry").submit();
}


$(document).ready(function(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel > 18){
        $("#stamp_btn").attr("disabled",true);  
        $("#stamp_btn").css("pointer-events","none");  
        $("#stamp_btn").css("opacity","0.65"); 
        
        $("#customprogress").attr("disabled",true);  
        $("#customprogress").css("pointer-events","none");
        $("#customprogress").css("opacity","0.65");
    }else{
        $("input[name='rd1']").each(function(){
            if($(this).is(':checked')) {
               if($(this).val() == 20){
                 $("#stamp_btn").attr("disabled",true);  
                 $("#stamp_btn").css("pointer-events","none");  
                 $("#stamp_btn").css("opacity","0.65");  
               }
               if($(this).val() == 10){
                 $("#customprogress").attr("disabled",true);  
                 $("#customprogress").css("pointer-events","none");
                 $("#customprogress").css("opacity","0.65");
               }
           }
        });
    }
    
    setTimeout(function(){
        $("#department_datachar05_start").prop("disabled",false);
    },700);
    
});

$("input[name='rd1']").click(function(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel < 19){
        if($(this).is(':checked')) {
            if($(this).val() == 20){
              $("#stamp_btn").attr("disabled",true);  
              $("#stamp_btn").css("pointer-events","none");  
              $("#stamp_btn").css("opacity","0.65");  
            }else{
              $("#stamp_btn").attr("disabled",false);  
              $("#stamp_btn").css("pointer-events","auto");  
              $("#stamp_btn").css("opacity","1");  
            }

            if($(this).val() == 10){
              $("#customprogress").attr("disabled",true);  
              $("#customprogress").css("pointer-events","none");
              $("#customprogress").css("opacity","0.65");
            }else{
              $("#customprogress").attr("disabled",false);  
              $("#customprogress").css("pointer-events","auto");  
              $("#customprogress").css("opacity","1");  
            }
        }
    }
});



