var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function firstSearch(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#firstSearch').serialize();
      var pagination = $('select[name="pagination"]').val();
      $.ajax({
          type:"POST",
          url: url,
          data:data,
          success:function(result){
                if($.trim(result) == 'ok'){
                      document.getElementById('first_csrf').disabled = false;
                      document.getElementById('first_pagination').disabled = false;
                      document.getElementById('first_pagination').value = pagination;
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

                        if (inputError.intorder03) {
                            $('#datepicker1_dnote').addClass("error");
                            $('#datepicker2_dnote').addClass("error");
                        } else {
                            if (inputError.intorder03_start) {
                                $('#datepicker1_dnote').addClass("error");
                            } else {
                                $('#datepicker1_dnote').removeClass("error");
                            }

                            if (inputError.intorder03_end) {
                                $('#datepicker2_dnote').addClass("error");
                            } else {
                                $('#datepicker2_dnote').removeClass("error");
                            }
                        }

                        if (inputError.information1_detail) {
                            $('#information1_err_msg').addClass("error");
                        } else {
                            $('#information1_err_msg').removeClass("error");
                        }

                        if (inputError.information2_detail) {
                            $('#information2_err_msg').addClass("error");
                        } else {
                            $('#information2_err_msg').removeClass("error");
                        }

                        if (inputError.information3_detail) {
                            $('#information3_err_msg').addClass("error");
                        } else {
                            $('#information3_err_msg').removeClass("error");
                        }

                        if (inputError.datachar02) {
                            $('#datachar02').addClass("error");
                        } else {
                            $('#datachar02').removeClass("error");
                        }

                        if (inputError.hktsyukko_datachar04) {
                            $('#hktsyukko_datachar04').addClass("error");
                        } else {
                            $('#hktsyukko_datachar04').removeClass("error");
                        }

                }
          }
      });

  } else {
    doubleClick();
  }
}


function voucherCreation(url) {
  buttonPress++;
  if (buttonPress == 1) {
      buttonPress = 0;
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var bill_to_len = $('#mail_bill_to:checked').length;
        if(bill_to_len>0){
            var mail_bill_to = 1;
        }else{
            var mail_bill_to = 0;
        }

        var billing_address_len = $('#mail_billing_address:checked').length;
        if(billing_address_len>0){
            var mail_billing_address = 1;
        }else{
            var mail_billing_address = 0;
        }
        
        var per_progress = parseInt(100 / len);
        $("#customprogress").css('pointer-events','none');
        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            data:data+"&bill_to="+mail_bill_to+"&billing_address="+mail_billing_address,
            success:function(result){
                if(result[0]=='end'){
                    if (localStorage.getItem('salesSlipProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('salesSlipProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                    }else{
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    
                    localStorage.removeItem('salesSlipProgressBar')
                    //$(".loading").removeClass('show');
                    //var html = "<p style='font-weight: bold;color: #0c51a7; margin: 0px;'>"+result[2]+": execution time "+ result[1].date+"</p>";
                    //$("#error_data").append(html);
                    location.reload();  
                }else if(result[0]=='going'){
                    if (localStorage.getItem('salesSlipProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('salesSlipProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                        localStorage.setItem('salesSlipProgressBar',newprogress);
                    }else{
                        localStorage.setItem('salesSlipProgressBar',per_progress);
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    
                    voucherCreation(url);
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

function mailConfirmation(){
    var len = $('input[name="selected_item[]"]:checked').length;
    if(len>0){
      $("#mailConfirmationModal").modal('show');
    }else{
        var html = "<p>対象が選択されていません。</p>";
        $('#error_data').html(html);
    }
}

function sendMail(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var bill_to_len = $('#mail_bill_to:checked').length;
        if(bill_to_len>0){
            var mail_bill_to = 1;
        }else{
            var mail_bill_to = 0;
        }

        var billing_address_len = $('#mail_billing_address:checked').length;
        if(billing_address_len>0){
            var mail_billing_address = 1;
        }else{
            var mail_billing_address = 0;
        }

        if(mail_bill_to == 0 && mail_billing_address == 0){
            alert("チェックを選択してください。");
            buttonPress = 0;
        }else{
            var url = url;
            var data = $('#mainForm').serialize();
            $.ajax({
                type:"POST",
                url: url,
                data:data+"&bill_to="+mail_bill_to+"&billing_address="+mail_billing_address,
                success:function(result){
                    if(result[0] == 'ok'){
                        $("#mailConfirmationModal").modal('hide');
                        $(".loading").removeClass('show');
                        //document.getElementById('req_status_msg_main').style.display = 'block';
                        //document.getElementById('req_status_msg').innerHTML = '検収書メールを送信しました。';

                        //document.getElementById('total_sent_mail_count').style.display = 'block';
                        //document.getElementById('total_sent_mail_msg').innerHTML = result[1]+'件、メール送信しました。';
                        location.reload();
                        buttonPress = 0;
                    }else if(result[0] == 'mailnai'){
                        $("#mailConfirmationModal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else if(result[0] == 'no_password'){
                        $("#mailConfirmationModal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else if(result[0] == 'ng'){
                        $("#mailConfirmationModal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else{
                      buttonPress = 0;
                      console.log("Something went wrong");
                    }
                },
                beforeSend:function(){
                    $(".loading").addClass('show');
                }
            });
        }

      }else{
            buttonPress = 0;
            var html = "<p>対象が選択されていません。</p>";
            $('#error_data').html(html);
      }

  } else {
    doubleClick();
  }
}

// function closeMsg(){
//   document.getElementById('req_status_msg_main').style.display = 'none';
// }

// function closeSentMailCountMsg(){
//   document.getElementById('total_sent_mail_count').style.display = 'none';
// }

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
                    document.getElementById('req_status_msg_main').style.display = 'block';
                    document.getElementById('req_status_msg').innerHTML = 'ダウンロードが完了しました。';

                    $(".unselectall").click();
                    location.reload();
                }else{
                    $('.loading-icon').hide();
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


function gotoOrderInquiry(kokyakuorderbango,ordertypebango2){
    $("#kokyakuorderbango").val(kokyakuorderbango);
    $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToOrderInquiry").submit();
}

function gotoSalesInquiry(kokyakuorderbango,ordertypebango2){
    $("#s_kokyakuorderbango").val(kokyakuorderbango);
    $("#s_inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToSalesInquiry").submit();
}