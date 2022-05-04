var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function firstSearch(url) {
  // alert("aa");
  // console.log("gg");
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#firstSearch').serialize();
      console.log(data);
      $.ajax({
          type:"POST",
          url: url,
          data:data,
          success:function(result){
            //alert("bb");
                if($.trim(result) == 'ok'){
                  //alert("cc");
                      document.getElementById('first_csrf').disabled = false;
                      document.getElementById('firstButton').value = "FirstSearch";
                      document.getElementById("firstSearch").submit();
                }else{
                        buttonPress = 0;
                        $("#no_found_data").hide();
                        var inputError = result.err_field;
                        console.log(inputError.date_start_intorder03);

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

                        if (inputError.date_start_intorder03){
                            // console.log('hlw')
                            $('#date_start').addClass("error");
                            $('#date_end').addClass("error");
                            $('#intorder03_start').addClass("error");
                            $('#intorder03_end').addClass("error");
                        }

                        if (inputError.intorder05){
                            $('#date_start').addClass("error");
                            $('#date_end').addClass("error");
                        }
                        if (inputError.intorder03){
                            $('#intorder03_start').addClass("error");
                            $('#intorder03_end').addClass("error");
                        }
                        if (inputError.intorder03_start || inputError.intorder03_end){
                            $('#intorder03_start').addClass("error");
                            $('#intorder03_end').addClass("error");
                        }
                        if (inputError.date_start || inputError.date_end){
                            $('#date_start').addClass("error");
                            $('#date_end').addClass("error");
                        }


                        // if (inputError.juchukubun_start) {
                        //     $('#juchukubun_start').addClass("error");
                        // } else {
                        //     $('#juchukubun_start').removeClass("error");
                        // }
                        // if (inputError.juchukubun_end) {
                        //     $('#juchukubun_end').addClass("error");
                        // } else {
                        //     $('#juchukubun_end').removeClass("error");
                        // }
                        if (inputError.juchukubun_start || inputError.juchukubun_end) {
                            $('#juchukubun_start_err').addClass("error");
                            $('#juchukubun_end_err').addClass("error");
                        } else {
                            $('#juchukubun_start_err').removeClass("error");
                            $('#juchukubun_end_err').removeClass("error");
                        }
                }
          }
      });

  } else {
    doubleClick();
  }
}

// //top search pulldown filter ends here

//=============== SoldToModal modal opener start here ===============//
function supplierSelectionModalOpener(fillable_id,db_fillable_id){
    $("#lastname").val("");
    $("#office_search_button").click();
    $("#fillable_id").val(fillable_id);
    $("#db_fillable_id").val(db_fillable_id)
    var soldModalValue = $("#db_fillable_id").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info').removeClass('add_border');
    $('.show_personal_master_info').removeClass('add_border');
    $('.show_content_last').removeClass('add_border');

    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        var officeid = prevValue.substr(6, 2);
        var personalId = prevValue.substr(8, 3);
        console.log({prevValue, companyid, officeid, personalId})
        document.getElementById(companyid).click();

        setTimeout(function () {
            document.getElementById("ets_"+officeid).click();
            //sroll to selected item
            document.getElementById("ets_"+officeid).scrollIntoView();
            etsuransya();
        },1500)

        function etsuransya(){
            setTimeout(function (){
            var newPersonalId = $(`[data-serial="${personalId}"]`).prop("id")
            document.getElementById(newPersonalId).click();
            //sroll to selected item
            document.getElementById(newPersonalId).scrollIntoView();
            $("#SoldToModal").modal("show");
            },1500)
        }

    }else {
        $("#SoldToModal").modal("show");
    }
}

$("#reset_button").on("click", function () {
    //$('.show_office_master_info').removeClass('add_border');
    //$("#lastname").val("");
    //$("#office_search_button").click();
    $("#SoldToModal").modal("hide");

});

function resetBusinessPartnerInfoExceptCompany() {
    $("#table_datatxt0049").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
}

function resetBusinessPartnerInfo() {
    $("#table_datatxt0049").text("");
    $("#table_company_name").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
    $("#table_yobi13").text("");
    $("#table_torihikisakibango").text("");
    $("#table_denpyostart").text("");
    $("#table_payment").text("");
    $("#table_mjn_mn").text("");
    $("#table_kensakukey").text("");
}

function resetBusinessPartnerInfoFromOffice() {
    $("#etsuransyaMail4").text("");
    $("#table_datatxt0049").text("");
    $("#table_datatxt0015").text("");
    $("#table_mail1").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_datatxt0016").text("");
}

$(function () {
    $('#searchButton').on('click', function (event) {
        $("#initial_content").show();
    });
    $('.show_office_master_info').on('click',function (event) {
        $('.show_office_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div").show();
    });

    $(document).on('click','.show_personal_master_info',function(){
        $('.show_personal_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

    $(document).on('click','.show_content_last',function(){
        $('.show_content_last').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

});
//=============== SoldToModal modal opener end here ===============//


function gotoOrderInquiry(kokyakuorderbango,ordertypebango2){
    $("#kokyakuorderbango").val(kokyakuorderbango);
    $("#inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToOrderInquiry").submit();
}

function gotoOrderInquiry_I(kokyakuorderbango,ordertypebango2){
    $("#kokyakuorderbango_i").val(kokyakuorderbango);
    $("#inquiry_ordertypebango2_i").val(ordertypebango2);
    $("#gotoOrderInquiry_I").submit();
}

function gotoSalesInquiry(kokyakuorderbango,ordertypebango2){
    $("#s_kokyakuorderbango").val(kokyakuorderbango);
    $("#s_inquiry_ordertypebango2").val(ordertypebango2);
    $("#goToSalesInquiry").submit();
}

// function gotoSalesInquiry(bango,juchukubun2){
//     $("#sale_history_bango").val(bango);
//     $("#juchukubun2").val(juchukubun2);
//     $("#goToSalesInquiry").submit();
// }

function updateSelectedSalesBango(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#mainForm').serialize();
      var len = $("#submit_confirmation").length;
      var update_stat = $("#changeStatus").val();
      $(document).find("#error_data").html("");
      var dropdown_error = false;
      var classification_error = "";
      var payment_method_error = "";
      $('.dropdown').each(function (i, obj) {
        var dropdown_val = $(this).val();
        var parentLineForm = $(this).parents('.dropdown_parent');
        var dropdown_change_status = "";
        if(dropdown_val.length > 1){
            dropdown_val = dropdown_val.slice(-2);
            dropdown_change_status = parentLineForm.find('.dropdown_change_status_2').val();
        }else{
            dropdown_change_status = parentLineForm.find('.dropdown_change_status_1').val();
        }
        var dataint06 = parentLineForm.find('.dataint06').val();
        if(dropdown_val != '1' && dropdown_val != '01' && dropdown_change_status == 1 && dataint06 != '1'){
            if(dropdown_val.length > 1){
                payment_method_error = "【入金方法】";
            }
            if(dropdown_val.length == 1){
                classification_error = "【即時区分】";
            }
            dropdown_error = true;
            $(this).addClass('error')
        }else{
            $(this).removeClass('error')
        }
        console.log(dropdown_val);
      });

      if(update_stat == 1 && !dropdown_error){
        if(len>0){
          $.ajax({
              type:"POST",
              url: url,
              data:data,
              success:function(result){
                // console.log(result);
                // alert("ss");
                    if($.trim(result) == 'ok'){
                        location.reload();
                    }else{
                        buttonPress = 0;

                    }
              }
          });
        }else{
          var submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
          $('#mainForm').prepend(submit_confirmation);

          var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
          $(document).find("#confirmation_message").html(confirmationMsg);
          buttonPress = 0;
        }
      }else {
          var error_msg = '';
          if(dropdown_error){
              if(payment_method_error){
                error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">'+payment_method_error+'請求計算済です。請求計算取消後、再実行してください。</p>';
              }
              if(classification_error){
                error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">'+classification_error+'請求計算済です。請求計算取消後、再実行してください。</p>';
              }
          }else{
            error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">更新されたデータがありません。[入金日][入金完了フラグ][即時区分][入金方法] を更新してください。</p>';
          }
          $(document).find("#error_data").html(error_msg);
          buttonPress = 0;
      }

  } else {
    doubleClick();
  }
}

function updateSelectedSalesInquiryBango(url) {
  //alert("bb");
  buttonPress++;
  if (buttonPress == 1) {
      var url = url;
      var data = $('#mainForm').serialize();
      //alert(url);

      var len = $("#submit_confirmation").length;
      var update_stat = $("#changeStatus").val();
      $(document).find("#error_data").html("");
      var dropdown_error = false;
      var classification_error = "";
      var payment_method_error = "";
      $('.dropdown_i').each(function (i, obj) {
        var dropdown_val = $(this).val();
        var dropdown_change_status = "";
        if(dropdown_val.length > 1){
            dropdown_val = dropdown_val.slice(-2);
            dropdown_change_status = $('.dropdown_change_status_2').val();
        }else{
            dropdown_change_status = $('.dropdown_change_status_1').val();
        }
        var dataint06 = $('#dataint06').val();

        if(dropdown_val != '1' && dropdown_val != '01' && dropdown_change_status == 1 && dataint06 != '1'){
            if(dropdown_val.length > 1){
                payment_method_error = "【入金方法】";
            }
            if(dropdown_val.length == 1){
                classification_error = "【即時区分】";
            }
            dropdown_error = true;
            $(this).addClass('error')
        }else{
            $(this).removeClass('error')
        }
        console.log(dropdown_val);
      });

      if(update_stat == 1 && !dropdown_error){
        if(len>0){
          $.ajax({
              type:"POST",
              url: url,
              data:data,
              success:function(result){
                console.log("result");
                //alert(result);
                    if($.trim(result) == 'ok'){
                        location.reload();
                    }else{
                        buttonPress = 0;

                    }
              }
          });
      }else {
        var submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
        $('#mainForm').prepend(submit_confirmation);

        var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
        $(document).find("#confirmation_message").html(confirmationMsg);
        buttonPress = 0;
      }
    }else {
        var error_msg = '';
        if(dropdown_error){
            if(payment_method_error){
            error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">'+payment_method_error+'請求計算済です。請求計算取消後、再実行してください。</p>';
            }
            if(classification_error){
            error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">'+classification_error+'請求計算済です。請求計算取消後、再実行してください。</p>';
            }
        }else{
            error_msg += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">更新されたデータがありません。[即時区分][入金方法] を更新してください。</p>';
        }
        $(document).find("#error_data").html(error_msg);
        buttonPress = 0;
    }

  } else {
    doubleClick();
  }
}


$(function () {
  $('#searchButton').on('click', function (event) {
      $("#initial_content").show();
  });
  $('.show_office_master_info').on('click',function (event) {
      $('.show_office_master_info').not(this).removeClass('add_border');
      $(this).addClass('add_border');
      $("#office_master_content_div").show();
  });

  $(document).on('click','.show_personal_master_info',function(){
      $('.show_personal_master_info').not(this).removeClass('add_border');
      $(this).addClass('add_border');
  });

  $(document).on('click','.show_content_last',function(){
      $('.show_content_last').not(this).removeClass('add_border');
      $(this).addClass('add_border');
  });
});


//=============== SoldToModal2 modal opener start here ===============//
function sold_to_modal_opener2(fillable_id2, db_fillable_id2) {
    $("#lastname2").val("");
    $("#office_search_button2").click();
    $("#fillable_id2").val(fillable_id2);
    $("#db_fillable_id2").val(db_fillable_id2)
    var soldModalValue = $("#db_fillable_id2").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info').removeClass('add_border');
    $('.show_personal_master_info2').removeClass('add_border');
    $('.show_content_last2').removeClass('add_border');

    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        var officeid = prevValue.substr(6, 2);
        var personalId = prevValue.substr(8, 3);
        console.log({prevValue, companyid, officeid, personalId})

        if($("#2_"+companyid).length>0){
            document.getElementById("2_"+companyid).click();

            $("#office_master_content_div_table2").show();
            setTimeout(function () {
                document.getElementById("2_"+officeid).click()
                //sroll to selected item
                document.getElementById("2_"+officeid).scrollIntoView();
                etsuransya();
            },1500)
            $("#personal_master_content_div_table2").show();

            //setTimeout(function (){
            function etsuransya(){
                setTimeout(function (){
                var newPersonalId = $(`[data-serial="2_${personalId}"]`).prop("id")
                document.getElementById(newPersonalId).click()

                //sroll to selected item
                document.getElementById(newPersonalId).scrollIntoView();
                $("#SoldToModal2").modal("show");
                },1700)
            }
            //},4000)
        }else{
            $("#SoldToModal2").modal("show");
        }
    }else {
        $("#SoldToModal2").modal("show");
    }
}

//SoldToModal2 reset button
$("#reset_button2").on("click", function () {
    //$('.show_office_master_info2').removeClass('add_border');
    //$("#lastname2").val("");
    //$("#office_search_button2").click();
    //resetBusinessPartnerInfo2();
    $("#SoldToModal2").modal("hide");
});

function resetBusinessPartnerInfoExceptCompany2() {
    $("#table_datatxt0049_2").text("");
    $("#table_office_name_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_mail1_2").text("");
    $("#table_datatxt0016_2").text("");
}

function resetBusinessPartnerInfo2() {
    $("#table_datatxt0049_2").text("");
    $("#table_company_name_2").text("");
    $("#table_office_name_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_mail1_2").text("");
    $("#table_datatxt0016_2").text("");
    $("#table_yobi13_2").text("");
    $("#table_torihikisakibango_2").text("");
    $("#table_denpyostart_2").text("");
    $("#table_payment_2").text("");
    $("#table_mjn_mn_2").text("");
    $("#table_kensakukey_2").text("");
}

function resetBusinessPartnerInfoFromOffice2() {
    $("#etsuransyaMail4_2").text("");
    $("#table_datatxt0049_2").text("");
    $("#table_datatxt0015_2").text("");
    $("#table_mail1_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_datatxt0016_2").text("");
}

$('.dropdown').on('change', function (event) {
    var parentLineForm = $(this).parents('.dropdown_parent');
    var dropdown_val = $(this).val();
    if(dropdown_val.length > 1){
        parentLineForm.find($('input[name="dropdown_change_status_2[]"]')).val(1);
    }else{
        parentLineForm.find($('input[name="dropdown_change_status_1[]"]')).val(1);
    }
    document.getElementById("changeStatus").value = 1;
});

$('.dropdown_i').on('change', function (event) {
    //var parentLineForm = $(this).parents('.dropdown_parent');
    var dropdown_val = $(this).val();
    if(dropdown_val.length > 1){
        $('.dropdown_change_status_2').val(1);
    }else{
        $('.dropdown_change_status_1').val(1);
    }
    document.getElementById("changeStatus").value = 1;
});

$(function () {
    //SoldToModal2 start here
    $('.show_office_master_info2').on('click', function (event) {
        $('.show_office_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div2").show();
    });

    $(document).on('click', '.show_personal_master_info2', function () {
        $('.show_personal_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

    $(document).on('click', '.show_content_last2', function () {
        $('.show_content_last2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

});
//=============== SoldToModal2 modal opener end here ===============//

//disable update button when no data found
$(document).ready(function(){
    var len = $("#userTable").find('tr').length;
    if(len == 2){
        $("#updateButton").prop('disabled',true);
    }else{
        $("#updateButton").prop('disabled',false);
    }
});
