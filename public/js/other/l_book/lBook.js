var lBookReg = 0;
var lBookEdit = 0;
var lBookDeleteRetrieve = 0;

function openRegistration() {
    lBookReg = 0;

    $("#regFrontValidation").remove();

    $('#registrationForm').trigger("reset");
    $('#reg_success_msg').html("");
    
    $("#error_data").hide();
    $('.error').each(function () {
        if (this.classList.contains("error")) {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });
    $('#registrationModal').modal('show');
}

/////////registration function///////////////
function registerLBook(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();
   
    //var data = $('#registrationForm').serialize();
    var data = new FormData(document.getElementById('registrationForm'));
    data.append('submit_confirmation',submit_confirmation); 
    if(field!=null){
        //data = data+"&field="+field;
        data.append('field',field); 
    }else{
        document.getElementById('regButton').disabled = true;
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if ($.trim(result.status) == 'ok') {
                document.getElementById('regButton').disabled = false;
                $('#registrationForm').trigger("reset");
                //$("#reg_datachar02").val('');
                //$("#reg_datachar03").val('');
                //$("#reg_datachar04").val('');
                //$("#error_data").hide();
                //$('.error').each(function () {
                //    if (this.classList.contains("error")) {
                //        this.classList.remove("error");
                //    }
                //});

                //$("#reg_datachar01").val(result.new_lbook_bango);
                //$("#hiddenOrderbango").val(result.change_id);
                //$("#reg_success_msg").html(result.success_msg);
                //$("#reg_load_data").html(result.view);
                $('#registrationModal').modal('hide');
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                document.getElementById('regButton').disabled = false;
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<div class="col-12"><p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">登録はまだ完了していません。内容をご確認後、もう一度「新規登録」をお願いします。</p></div>';
                $(document).find("#error_data").html(confirmationMsg);
            } else {

                if(field == null){
                    document.getElementById('regButton').disabled = false;
                }

                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");

                //check front validation after submit
                checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

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

                if (inputError.datachar01) {
                    $('#reg_datachar01').addClass("error");
                } else {
                    $('#reg_datachar01').removeClass("error");
                }

                if (inputError.datachar02) {
                    $('#err_datachar02').addClass("error");
                } else {
                    $('#err_datachar02').removeClass("error");
                }

                if (inputError.datachar06) {
                    $('#reg_datachar06').addClass("error");
                } else {
                    $('#reg_datachar06').removeClass("error");
                }

                if (inputError.datachar07) {
                    $('#reg_datachar07').addClass("error");
                } else {
                    $('#reg_datachar07').removeClass("error");
                }

                if (inputError.datachar08) {
                    $('#reg_datachar08').addClass("error");
                } else {
                    $('#reg_datachar08').removeClass("error");
                }

                if (inputError.datachar09 || inputError.filename) {
                    $('#err_datachar09').addClass("error");
                } else {
                    $('#err_datachar09').removeClass("error");
                }

                if (inputError.datachar10) {
                    $('#reg_datachar10').addClass("error");
                } else {
                    $('#reg_datachar10').removeClass("error");
                }

            }
        }
    });
    
}

///////////////end registration function//////


/////////edit function///////////////
function editLBook(url,field) { 
    //IE support
    if(field == undefined){
        field = null;
    }
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();

    //var data = $('#editForm').serialize();
    var data = new FormData(document.getElementById('editForm'));
    data.append('submit_confirmation',submit_confirmation);
    if(field!=null){
        //data = data+"&field="+field;
        data.append('field',field);
    }else{
        document.getElementById('editButton').disabled = true;
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            console.log(result);
            if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                document.getElementById('editButton').disabled = false;
                //$("#edit_error_data").hide();
                //$('#err_edit_datachar09').removeClass("error");
                //$("#edit_success_msg").html(result.success_msg);
                //$("#edit_success_msg").show();
                //$("#reg_load_data").html(result.view);
                $('#lBookEditModal').modal('hide');
               // input = '<input type="hidden" name="change_id" value="' + result.lbook_id + '">';
                //jQuery('#navbarForm').append(input);
                //$("#lBookReload").trigger("click");
                location.reload();
            }else if ($.trim(result) == 'confirmation_msg'){
                document.getElementById('editButton').disabled = false;
                $('.error').each(function () {
                    if (this.classList.contains("error")) {
                        this.classList.remove("error");
                    }
                });
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<div class="col-12"><p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">登録はまだ完了していません。内容をご確認後、もう一度「修正登録」をお願いします。</p></div>';
                $(document).find("#edit_error_data").html(confirmationMsg);
            } else {

                if(field == null){
                   document.getElementById('editButton').disabled = false;
                }

                var inputError = result.err_field;
                console.log(inputError);
                
                //reset submit confirmation
                $("#submit_confirmation").val("");

                //check front validation after submit
                checkFrontendValidationAfterSubmit(inputError,2); //2 for edit

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#edit_error_data').html(html);

                    if (true) {
                    }
                    $("#edit_error_data").show();
                }

                if (inputError.datachar01) {
                    $('#edit_datachar01').addClass("error");
                } else {
                    $('#edit_datachar01').removeClass("error");
                }

                if (inputError.datachar02) {
                    $('#err_edit_datachar02').addClass("error");
                } else {
                    $('#err_edit_datachar02').removeClass("error");
                }

                if (inputError.datachar06) {
                    $('#edit_datachar06').addClass("error");
                } else {
                    $('#edit_datachar06').removeClass("error");
                }

                if (inputError.datachar07) {
                    $('#edit_datachar07').addClass("error");
                } else {
                    $('#edit_datachar07').removeClass("error");
                }

                if (inputError.datachar08) {
                    $('#edit_datachar08').addClass("error");
                } else {
                    $('#edit_datachar08').removeClass("error");
                }

                if (inputError.datachar09 || inputError.filename) {
                    $('#err_edit_datachar09').addClass("error");
                } else {
                    $('#err_edit_datachar09').removeClass("error");
                }

                if (inputError.datachar10) {
                    $('#edit_datachar10').addClass("error");
                } else {
                    $('#edit_datachar10').removeClass("error");
                }

            }
        }
    });
    
}
///////////////end edit function//////


function viewLBookDetail(url, id, bango) {
    lBookEdit = 0;
    projtDeleteRetrieve = 0;
    $("#edit_success_msg").hide();
    
    //remove front validation field when initial open
    $("#editFrontValidation").remove();

    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (result) {
            console.log(result);

            $("#edit_error_data").empty();
            $("#lBookEditModal input").parent().find('input').removeClass("error");

            //if (result.dataint25 == 1){
            //    document.getElementById('deleteThis').style.display = 'none';
            //    document.getElementById('lBookButton3').style.display = 'none';
            //}

            $('#edit_hiddenBango').val(result.datachar13);
            $('#edit_datachar01').val(result.datachar01);
            $('#edit_datachar02').val(result.datachar02);
            $('#show_edit_datachar02').val(result.datachar02_text);
            $('#edit_datachar03').val(result.datachar03);
            $('#show_edit_datachar03').val(result.datachar03_text);
            $('#edit_datachar04').val(result.datachar04);
            $('#show_edit_datachar04').val(result.datachar04_text);
            $('#edit_datachar05').val(result.lbook_datachar05);
            $('#edit_datachar06').val(result.datachar06);
            $('#edit_datachar07').val(result.datachar07);
            $('#edit_datachar08').val(result.datachar08);
            $('#edit_datachar09').val(result.datachar09_short);
            $('#edit_modified_old_datachar09').val(result.datachar09_short);
            $('#edit_old_datachar09').val(result.datachar09);
            $('#edit_datachar10').val(result.datachar10);
            
            $('#lBookEditModal').modal('show');
        }
    });
}

function getModifiedFileName(str) {
  var position = str.lastIndexOf(".");
  var extension = str.substr(position);
  var main_str = str.substr(0,position);
  var test2 = str.lastIndexOf("_");
  var last_index_data = main_str.substr(test2+1);
  if(last_index_data.length == 14){ //check for order_entry data
    var arr = main_str.split("_");
    var len = arr.length;
    var res = "";
    for(var i=0; i<len-2; i++){
      if(i==len-3){
      	res = res+arr[i];
      }else{
      	res = res+arr[i]+"_";
      }

    }
  }else{ //lbook data
    var arr = main_str.split("_");
    var len = arr.length;
    var res = "";
    for(var i=0; i<len-1; i++){
      if(i==len-2){
      res = res+arr[i];
      }else{
      res = res+arr[i]+"_";
      }
    }
  }
  return (res+extension);
}

function deleteLBook(url) {
    if (lBookDeleteRetrieve == '0') {
        lBookDeleteRetrieve++;
        //var html = getConfirmationMessage(3);
        var html = '<p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">まだ削除は完了していません。内容を確認し、再度削除ボタンを押してください。</p>';
        $('#edit_error_data').html(html);
        $("#edit_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_datachar01').value;

        $.ajax({
            type: "GET",
            url: url,
            data: kesuId,
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }
}

//first search start here
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

                            $('#search_error_data').html(html);

                            if (true) {
                            }
                            $("#search_error_data").show();
                        }
                        
                        if (inputError.datachar02_detail) {
                            $('#error_datachar02_2').addClass("error");
                            $('#error_datachar03_3').addClass("error");
                        } else {
                            $('#error_datachar02_2').removeClass("error");
                            $('#error_datachar03_3').removeClass("error");
                        }
                        
                        if (inputError.created_date) {
                            $('#datepicker1_oen').addClass("error");
                            $('#datepicker2_oen').addClass("error");
                        } else {
                            if (inputError.created_date_start) {
                                $('#datepicker2_oen').addClass("error");
                            } else {
                                $('#datepicker2_oen').removeClass("error");
                            }

                            if (inputError.created_date_end) {
                                $('#datepicker1_oen').addClass("error");
                            } else {
                                $('#datepicker1_oen').removeClass("error");
                            }
                        }
                        
                        if (inputError.datachar05) {
                            $('#tsearch_datachar05_start').addClass("error");
                            $('#tsearch_datachar05_end').addClass("error");
                        } else {
                            if (inputError.datachar05_start) {
                                $('#tsearch_datachar05_start').addClass("error");
                            } else {
                                $('#tsearch_datachar05_start').removeClass("error");
                            }

                            if (inputError.datachar05_end) {
                                $('#tsearch_datachar05_end').addClass("error");
                            } else {
                                $('#tsearch_datachar05_end').removeClass("error");
                            }
                        }
                        
                        if (inputError.datachar07) {
                            $('#tsearch_datachar07').addClass("error");
                        } else {
                            $('#tsearch_datachar07').removeClass("error");
                        }
                        
                        if (inputError.datachar06) {
                            $('#tsearch_datachar06').addClass("error");
                        } else {
                            $('#tsearch_datachar06').removeClass("error");
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