var officeMasterReg = 0;
var officeMasterEdit = 0;
var officeMasterDeleteRetrieve = 0;

function openRegistration() {
    //tab enable
    $("#reg_nav_item_2").css("pointer-events", "auto");
    $("#reg_nav_item_3").css("pointer-events", "auto");

    officeMasterReg = 0;
    
    //call loadSelectedKokyaku()
    $("#insert_shikibetsucode").trigger('change');

    //tab check start here
    $("#common1-office").addClass('active');
    $("#common1-tab-office").addClass('active');
    $("#sales_billing1_office").removeClass('active');
    $("#sales_billing1_office_tab").removeClass('active');
    $("#payment1-office").removeClass('active');
    $("#payment1-office-tab").removeClass('active'); //tab check end here

    $('#registrationForm').trigger("reset");
    //$('.custom_select_search').trigger("change");

    $("#regFrontValidation").remove();

    //reset submit confirmation
    $("#submit_confirmation").val("");

    $("#error_data").empty();
    //$("#registrationModal input").parent().find('input').val('');
    //$("#registrationModal select").parent().find('select').val('');
    $("#registrationModal input").parent().find('input').removeClass("error");
    $("#registrationModal select").parent().find('select').removeClass("error");
    $("#registrationModal div").parent().find('div').removeClass("error");
    $('#insert_shikibetsucode option:eq(0)').prop('selected', true);
    //$('#insert_torihikisakirank1 option:eq(0)').prop('selected', true);
    $('#registrationModal').modal('show');

    //readonly fields when innerlevel>14
    //enableDisableField();

    initTabHideShow();
}

function officeMasterRegistration(url, field) {
    //IE support
    if (field == undefined) {
        field = null;
    }

//    if (officeMasterReg == 0 && field == null) {
//        officeMasterReg++;
//        var msg = getConfirmationMessage(1);
//        $('#error_data').html(msg);
//        $("#error_data").show();
//    } else {

        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();

        var data = $('#registrationForm').serialize();
        if (field != null) {
            data = data + "&field=" + field;
        } else {
            document.getElementById('insertSubmit').disabled = true;
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: data+"&submit_confirmation="+submit_confirmation,
            success: function (result) {
                if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                    // location.reload();
                    var company_yobi12 = $("#company_yobi12").val();
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '"><input type="hidden" name="yobi12" value="' + company_yobi12 + '">';
                    jQuery('#navbarForm').append(input);
                    $("#officeMasterReload").trigger("click");
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                    $(document).find("#error_data").html(confirmationMsg);
                    document.getElementById('insertSubmit').disabled = false;
                } else {
                    var inputError = result.err_field;

                    if (field == null) {
                        document.getElementById('insertSubmit').disabled = false;
                    }
                    console.log(inputError);

                    //reset submit confirmation
                    $("#submit_confirmation").val("");

                    //check front validation after submit
                    checkFrontendValidationAfterSubmit(inputError,1); //1 for reg

                    $("#error_data").empty();
                    $("#registrationModal input").parent().find('input').removeClass("error");
                    $("#registrationModal select").parent().find('select').removeClass("error");

                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';

                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#error_data').html(html);

                        $("#error_data").show();
                    }

                    if (inputError.shikibetsucode) {
                        $('#insert_shikibetsucode').addClass("error");
                    }
                    if (inputError.name) {
                        $('#insert_name').addClass("error");
                    }
                    if (inputError.haisoumoji1) {
                        $('#insert_haisoumoji1').addClass("error");
                    }
                    if (inputError.haisousuchi1) {
                        $('#insert_haisousuchi1').addClass("error");
                    }
                    if (inputError.denpyoustart) {
                        $('#insert_denpyoustart').addClass("error");
                    }
                    if (inputError.denpyouend) {
                        $('#insert_denpyouend').addClass("error");
                    }
                    if (inputError.saiban) {
                        $('#insert_saiban').addClass("error");
                    }
                    if (inputError.torihikisakirank1) {
                        $('#insert_torihikisakirank1').addClass("error");
                    }
                    if (inputError.zip1) {
                        $('#insert_zip1').addClass("error");
                    }
                    if (inputError.zip2) {
                        $('#insert_zip2').addClass("error");
                    }
                    if (inputError.address1) {
                        $('#insert_address1').addClass("error");
                    }
                    if (inputError.address2) {
                        $('#insert_address2').addClass("error");
                    }
                    if (inputError.address3) {
                        $('#insert_address3').addClass("error");
                    }
                    if (inputError.address4) {
                        $('#insert_address4').addClass("error");
                    }
                    if (inputError.tel) {
                        $('#insert_tel').addClass("error");
                    }
                    if (inputError.fax) {
                        $('#insert_fax').addClass("error");
                    }
                    if (inputError.torihikisakirank2) {
                        $('#insert_torihikisakirank2').addClass("error");
                    }
                    if (inputError.yobi1) {
                        $('#reg_yobi1').addClass("error");
                    }
                    //if (inputError.haisousuchi2) {
                        //$('#insert_haisousuchi2').addClass("error");
                   // }
                    if (inputError.mail) {
                        var mail = inputError.mail;
                        var mailLength = mail.length;
                        console.log(mailLength);
                        for (var i = 0; i < mailLength; i++) {
                            if (mailLength === 1 && mail[i] == '【メールアドレス(確認用)】が一致しません。') {
                                $('#insert_mail_confirmation').addClass("error");
                            } else {
                                $('#insert_mail_confirmation').addClass("error");
                                $('#insert_mail').addClass("error");
                            }
                        }
                    }
                    if (inputError.kingakugoukei) {
                        $('#insert_kingakugoukei').addClass("error");
                    }

                    if (inputError.haisoumoji2) {
                        $('#insert_haisoumoji2').addClass("error");
                    } else {
                        $('#insert_haisoumoji2').removeClass("error");
                    }

                    if (inputError.syukeiki) {
                        $('#insert_syukeiki').addClass("error");
                    } else {
                        $('#insert_syukeiki').removeClass("error");
                    }

                    if (inputError.other1) {
                        $('#insert_other1').addClass("error");
                    } else {
                        $('#insert_other1').removeClass("error");
                    }

                    if (inputError.other36) {
                        $('#insert_other36').addClass("error");
                    } else {
                        $('#insert_other36').removeClass("error");
                    }

                    if (inputError.other2) {
                        $('#insert_other2').addClass("error");
                    } else {
                        $('#insert_other2').removeClass("error");
                    }

                    if (inputError.other3) {
                        $('#insert_other3').addClass("error");
                    } else {
                        $('#insert_other3').removeClass("error");
                    }

                    if (inputError.other4) {
                        $('#insert_other4').addClass("error");
                    } else {
                        $('#insert_other4').removeClass("error");
                    }

                    if (inputError.other5) {
                        $('#insert_other5').addClass("error");
                    } else {
                        $('#insert_other5').removeClass("error");
                    }

                    if (inputError.other6) {
                        $('#insert_other6').addClass("error");
                    } else {
                        $('#insert_other6').removeClass("error");
                    }

                    if (inputError.other7) {
                        $('#insert_other7').addClass("error");
                    } else {
                        $('#insert_other7').removeClass("error");
                    }

                    if (inputError.other8) {
                        $('#insert_other8').addClass("error");
                    } else {
                        $('#insert_other8').removeClass("error");
                    }

                    if (inputError.otherfloat1) {
                        $('#insert_otherfloat1').addClass("error");
                    } else {
                        $('#insert_otherfloat1').removeClass("error");
                    }

                    if (inputError.other9) {
                        $('#insert_other9').addClass("error");
                    } else {
                        $('#insert_other9').removeClass("error");
                    }

                    if (inputError.other10) {
                        $('#insert_other10').addClass("error");
                    } else {
                        $('#insert_other10').removeClass("error");
                    }

                    if (inputError.other11) {
                        $('#insert_other11').addClass("error");
                    } else {
                        $('#insert_other11').removeClass("error");
                    }

                    if (inputError.other12) {
                        $('#insert_other12').addClass("error");
                    } else {
                        $('#insert_other12').removeClass("error");
                    }

                    if (inputError.other13) {
                        $('#insert_other13').addClass("error");
                    } else {
                        $('#insert_other13').removeClass("error");
                    }

                    if (inputError.other14) {
                        $('#insert_other14').addClass("error");
                    } else {
                        $('#insert_other14').removeClass("error");
                    }

                    if (inputError.other15) {
                        $('#insert_other15').addClass("error");
                    } else {
                        $('#insert_other15').removeClass("error");
                    }

                    if (inputError.other16) {
                        $('#insert_other16').addClass("error");
                    } else {
                        $('#insert_other16').removeClass("error");
                    }

                    if (inputError.other18) {
                        $('#insert_other18').addClass("error");
                    } else {
                        $('#insert_other18').removeClass("error");
                    }

                    if (inputError.other17) {
                        $('#insert_other17').addClass("error");
                    } else {
                        $('#insert_other17').removeClass("error");
                    }

                    if (inputError.other39) {
                        $('#insert_other39').addClass("error");
                    } else {
                        $('#insert_other39').removeClass("error");
                    }

                    if (inputError.other40) {
                        $('#insert_other40').addClass("error");
                    } else {
                        $('#insert_other40').removeClass("error");
                    }

                    if (inputError.other19) {
                        $('#insert_other19').addClass("error");
                    } else {
                        $('#insert_other19').removeClass("error");
                    }

                    if (inputError.other20) {
                        $('#insert_other20').addClass("error");
                    } else {
                        $('#insert_other20').removeClass("error");
                    }

                    if (inputError.other21) {
                        $('#insert_other21').addClass("error");
                    } else {
                        $('#insert_other21').removeClass("error");
                    }

                    if (inputError.other22) {
                        $('#insert_other22').addClass("error");
                    } else {
                        $('#insert_other22').removeClass("error");
                    }

                    if (inputError.other23) {
                        $('#insert_other23').addClass("error");
                    } else {
                        $('#insert_other23').removeClass("error");
                    }

                    if (inputError.other24) {
                        $('#insert_other24').addClass("error");
                    } else {
                        $('#insert_other24').removeClass("error");
                    }

                    if (inputError.otherfloat2) {
                        $('#insert_otherfloat2').addClass("error");
                    } else {
                        $('#insert_otherfloat2').removeClass("error");
                    }

                    if (inputError.other30) {
                        $('#insert_other30').addClass("error");
                    } else {
                        $('#insert_other30').removeClass("error");
                    }

                    if (inputError.other25) {
                        $('#insert_other25').addClass("error");
                    } else {
                        $('#insert_other25').removeClass("error");
                    }

                    if (inputError.other26) {
                        $('#insert_other26').addClass("error");
                    } else {
                        $('#insert_other26').removeClass("error");
                    }

                    if (inputError.otherfloat4) {
                        $('#insert_otherfloat4').addClass("error");
                    } else {
                        $('#insert_otherfloat4').removeClass("error");
                    }

                    if (inputError.other27) {
                        $('#insert_other27').addClass("error");
                    } else {
                        $('#insert_other27').removeClass("error");
                    }

                    if (inputError.other28) {
                        $('#insert_other28').addClass("error");
                    } else {
                        $('#insert_other28').removeClass("error");
                    }

                    if (inputError.other31) {
                        $('#insert_other31').addClass("error");
                    } else {
                        $('#insert_other31').removeClass("error");
                    }

                    if (inputError.other32) {
                        $('#insert_other32').addClass("error");
                    } else {
                        $('#insert_other32').removeClass("error");
                    }

                    if (inputError.other33) {
                        $('#insert_other33').addClass("error");
                    } else {
                        $('#insert_other33').removeClass("error");
                    }

                    if (inputError.other34) {
                        $('#insert_other34').addClass("error");
                    } else {
                        $('#insert_other34').removeClass("error");
                    }

                    if (inputError.other35) {
                        $('#insert_other35').addClass("error");
                    } else {
                        $('#insert_other35').removeClass("error");
                    }

                    if (inputError.otherfloat3) {
                        $('#insert_otherfloat3').addClass("error");
                    } else {
                        $('#insert_otherfloat3').removeClass("error");
                    }

                    if (inputError.other37) {
                        $('#insert_other37').addClass("error");
                    } else {
                        $('#insert_other37').removeClass("error");
                    }

                    if (inputError.other38) {
                        $('#insert_other38').addClass("error");
                    } else {
                        $('#insert_other38').removeClass("error");
                    }

                }

            }
        });
    //}
}

function officeEdit(url, field) {
    //IE support
    if (field == undefined) {
        field = null;
    }

    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();

    var data = $('#editForm').serialize();

    if (field != null) {
        data = data + "&field=" + field;
    } else {
        document.getElementById('editSubmit').disabled = true;
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                // location.reload();
                var company_yobi12 = $("#company_yobi12").val();
                input = '<input type="hidden" name="change_id" value="' + result.change_id + '"><input type="hidden" name="yobi12" value="' + company_yobi12 + '">';
                jQuery('#navbarForm').append(input);
                $("#officeMasterReload").trigger("click");
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#error_Editdata").html(confirmationMsg);
                document.getElementById('editSubmit').disabled = false;
            } else {
                var inputError = result.err_field;

                if (field == null) {
                    document.getElementById('editSubmit').disabled = false;
                }

                console.log(inputError);

                //reset submit confirmation
                $("#submit_confirmation").val("");

                //check front validation after submit
                checkFrontendValidationAfterSubmit(inputError,2); //2 for edit

                $("#error_Editdata").empty();
                $("#office_modal3 input").parent().find('input').removeClass("error");
                $("#office_modal3 select").parent().find('select').removeClass("error");

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_Editdata').html(html);

                    $("#error_Editdata").show();
                }

                if (inputError.shikibetsucode) {
                    $('#edit_shikibetsucode').addClass("error");
                }
                if (inputError.name) {
                    $('#edit_name').addClass("error");
                }
                if (inputError.haisoumoji1) {
                    $('#edit_haisoumoji1').addClass("error");
                }
                if (inputError.haisousuchi1) {
                    $('#edit_haisousuchi1').addClass("error");
                }
                if (inputError.denpyoustart) {
                    $('#edit_denpyoustart').addClass("error");
                }
                if (inputError.denpyouend) {
                    $('#edit_denpyouend').addClass("error");
                }
                if (inputError.saiban) {
                    $('#edit_saiban').addClass("error");
                }
                if (inputError.torihikisakirank1) {
                    $('#edit_torihikisakirank1').addClass("error");
                }
                if (inputError.zip1) {
                    $('#edit_zip1').addClass("error");
                }
                if (inputError.zip2) {
                    $('#edit_zip2').addClass("error");
                }
                if (inputError.address1) {
                    $('#edit_address1').addClass("error");
                }
                if (inputError.address2) {
                    $('#edit_address2').addClass("error");
                }
                if (inputError.address3) {
                    $('#edit_address3').addClass("error");
                }
                if (inputError.address4) {
                    $('#edit_address4').addClass("error");
                }
                if (inputError.tel) {
                    $('#edit_tel').addClass("error");
                }
                if (inputError.fax) {
                    $('#edit_fax').addClass("error");
                }
                if (inputError.torihikisakirank2) {
                    $('#edit_torihikisakirank2').addClass("error");
                }
                if (inputError.yobi1) {
                    $('#edit_yobi1').addClass("error");
                }
            }
            //if (inputError.haisousuchi2) {
            //    $('#edit_haisousuchi2').addClass("error");
            //}
            if (inputError.hasOwnProperty("mail")) {
                var mail = inputError.mail;
                var mailLength = mail.length;
                console.log(mailLength);
                for (var i = 0; i < mailLength; i++) {
                    if (mailLength === 1 && mail[i] == '【メールアドレス(確認用)】が一致しません。') {
                        $('#edit_office_mail_confirmation').addClass("error");
                    } else {
                        $('#edit_office_mail_confirmation').addClass("error");
                        $('#edit_office_mail').addClass("error");
                    }
                }
            }
            if (inputError.kingakugoukei) {
                $('#edit_kingakugoukei').addClass("error");
            }

            if (inputError.haisoumoji2) {
                $('#edit_haisoumoji2').addClass("error");
            } else {
                $('#edit_haisoumoji2').removeClass("error");
            }

            if (inputError.syukeiki) {
                $('#edit_syukeiki').addClass("error");
            } else {
                $('#edit_syukeiki').removeClass("error");
            }

            if (inputError.other1) {
                $('#edit_other1').addClass("error");
            } else {
                $('#edit_other1').removeClass("error");
            }

            if (inputError.other36) {
                $('#edit_other36').addClass("error");
            } else {
                $('#edit_other36').removeClass("error");
            }

            if (inputError.other2) {
                $('#edit_other2').addClass("error");
            } else {
                $('#edit_other2').removeClass("error");
            }

            if (inputError.other3) {
                $('#edit_other3').addClass("error");
            } else {
                $('#edit_other3').removeClass("error");
            }

            if (inputError.other4) {
                $('#edit_other4').addClass("error");
            } else {
                $('#edit_other4').removeClass("error");
            }

            if (inputError.other5) {
                $('#edit_other5').addClass("error");
            } else {
                $('#edit_other5').removeClass("error");
            }

            if (inputError.other6) {
                $('#edit_other6').addClass("error");
            } else {
                $('#edit_other6').removeClass("error");
            }

            if (inputError.other7) {
                $('#edit_other7').addClass("error");
            } else {
                $('#edit_other7').removeClass("error");
            }

            if (inputError.other8) {
                $('#edit_other8').addClass("error");
            } else {
                $('#edit_other8').removeClass("error");
            }

            if (inputError.otherfloat1) {
                $('#edit_otherfloat1').addClass("error");
            } else {
                $('#edit_otherfloat1').removeClass("error");
            }

            if (inputError.other9) {
                $('#edit_other9').addClass("error");
            } else {
                $('#edit_other9').removeClass("error");
            }

            if (inputError.other10) {
                $('#edit_other10').addClass("error");
            } else {
                $('#edit_other10').removeClass("error");
            }

            if (inputError.other11) {
                $('#edit_other11').addClass("error");
            } else {
                $('#edit_other11').removeClass("error");
            }

            if (inputError.other12) {
                $('#edit_other12').addClass("error");
            } else {
                $('#edit_other12').removeClass("error");
            }

            if (inputError.other13) {
                $('#edit_other13').addClass("error");
            } else {
                $('#edit_other13').removeClass("error");
            }

            if (inputError.other14) {
                $('#edit_other14').addClass("error");
            } else {
                $('#edit_other14').removeClass("error");
            }

            if (inputError.other15) {
                $('#edit_other15').addClass("error");
            } else {
                $('#edit_other15').removeClass("error");
            }

            if (inputError.other16) {
                $('#edit_other16').addClass("error");
            } else {
                $('#edit_other16').removeClass("error");
            }

            if (inputError.other18) {
                $('#edit_other18').addClass("error");
            } else {
                $('#edit_other18').removeClass("error");
            }

            if (inputError.other17) {
                $('#edit_other17').addClass("error");
            } else {
                $('#edit_other17').removeClass("error");
            }

            if (inputError.other39) {
                $('#edit_other39').addClass("error");
            } else {
                $('#edit_other39').removeClass("error");
            }

            if (inputError.other40) {
                $('#edit_other40').addClass("error");
            } else {
                $('#edit_other40').removeClass("error");
            }

            if (inputError.other19) {
                $('#edit_other19').addClass("error");
            } else {
                $('#edit_other19').removeClass("error");
            }

            if (inputError.other20) {
                $('#edit_other20').addClass("error");
            } else {
                $('#edit_other20').removeClass("error");
            }

            if (inputError.other21) {
                $('#edit_other21').addClass("error");
            } else {
                $('#edit_other21').removeClass("error");
            }

            if (inputError.other22) {
                $('#edit_other22').addClass("error");
            } else {
                $('#edit_other22').removeClass("error");
            }

            if (inputError.other23) {
                $('#edit_other23').addClass("error");
            } else {
                $('#edit_other23').removeClass("error");
            }

            if (inputError.other24) {
                $('#edit_other24').addClass("error");
            } else {
                $('#edit_other24').removeClass("error");
            }

            if (inputError.otherfloat2) {
                $('#edit_otherfloat2').addClass("error");
            } else {
                $('#edit_otherfloat2').removeClass("error");
            }

            if (inputError.other30) {
                $('#edit_other30').addClass("error");
            } else {
                $('#edit_other30').removeClass("error");
            }

            if (inputError.other25) {
                $('#edit_other25').addClass("error");
            } else {
                $('#edit_other25').removeClass("error");
            }

            if (inputError.other26) {
                $('#edit_other26').addClass("error");
            } else {
                $('#edit_other26').removeClass("error");
            }

            if (inputError.otherfloat4) {
                $('#edit_otherfloat4').addClass("error");
            } else {
                $('#edit_otherfloat4').removeClass("error");
            }

            if (inputError.other27) {
                $('#edit_other27').addClass("error");
            } else {
                $('#edit_other27').removeClass("error");
            }

            if (inputError.other28) {
                $('#edit_other28').addClass("error");
            } else {
                $('#edit_other28').removeClass("error");
            }

            if (inputError.other31) {
                $('#edit_other31').addClass("error");
            } else {
                $('#edit_other31').removeClass("error");
            }

            if (inputError.other32) {
                $('#edit_other32').addClass("error");
            } else {
                $('#edit_other32').removeClass("error");
            }

            if (inputError.other33) {
                $('#edit_other33').addClass("error");
            } else {
                $('#edit_other33').removeClass("error");
            }

            if (inputError.other34) {
                $('#edit_other34').addClass("error");
            } else {
                $('#edit_other34').removeClass("error");
            }

            if (inputError.other35) {
                $('#edit_other35').addClass("error");
            } else {
                $('#edit_other35').removeClass("error");
            }

            if (inputError.otherfloat3) {
                $('#edit_otherfloat3').addClass("error");
            } else {
                $('#edit_otherfloat3').removeClass("error");
            }

            if (inputError.other37) {
                $('#edit_other37').addClass("error");
            } else {
                $('#edit_other37').removeClass("error");
            }

            if (inputError.other38) {
                $('#edit_other38').addClass("error");
            } else {
                $('#edit_other38').removeClass("error");
            }

        }
    });


}

function detailOfficeMaster(url, id) {
    officeMasterEdit = 0;
    officeMasterDeleteRetrieve = 0;
    $("#detail_office_error_data").hide();

    $("#editFrontValidation").remove();

    //tab check start here
    $("#common2").addClass('active');
    $("#common2-tab").addClass('active');
    $("#sales_billing2").removeClass('active');
    $("#sales_billing2_tab").removeClass('active');
    $("#payment2").removeClass('active');
    $("#payment2-tab").removeClass('active'); //tab check end here

    //tab check in edit page start here
    $("#common3").addClass('active');
    $("#common3-tab").addClass('active');
    $("#sales_billing3").removeClass('active');
    $("#sales_billing3_tab").removeClass('active');
    $("#payment3").removeClass('active');
    $("#payment3-tab").removeClass('active'); //tab check in edit page end here

    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (result) {
            if (result.kounyusu == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('officeButton3').style.display = 'none';
            }
            if (result.point == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('officeButton3').style.display = 'none';
            }

            if (result.syukeitukikijun == null) {
                result.syukeitukikijun = '';
            }
            if (result.syukeitukikijunname == null) {
                result.syukeitukikijunname = '';
            }

            if (result.syukeituki == null) {
                result.syukeituki = '';
            }
            if (result.syukeitukiname == null) {
                result.syukeitukiname = '';
            }

            if (result.syukeikikijun == null) {
                result.syukeikikijun = '';
            }
            if (result.syukeikikijunname == null) {
                result.syukeikikijunname = '';
            }

            if (result.syukeinenkijun == null) {
                result.syukeinenkijun = '';
            }
            if (result.syukeinenkijunname == null) {
                result.syukeinenkijunname = '';
            }

            if (result.torihikisakirank1 == null) {
                result.torihikisakirank1 = '';
            }
            if (result.jouhou == null) {
                result.jouhou = '';
            }

            $("#error_Editdata").empty();
            $("#office_modal3 input").parent().find('input').val('');
            $("#office_modal3 select").parent().find('select').val('');
            $("#office_modal3 input").parent().find('input').removeClass("error");
            $("#office_modal3 select").parent().find('select').removeClass("error");
            var company_details = result.office_shikibetsucode + " " + result.gaishamei;
            $('#edit_shikibetsuName').val(company_details);
            $('#edit_shikibetsucode').val(result.office_shikibetsucode);
            $('#edit_name').val(result.name);
            $('#edit_haisoumoji1').val(result.haisoumoji1);
            if(result.torihikisakirank1 == '0 訂正不可'){
               $('#edit_name').attr('readonly',true);
               $('#edit_haisoumoji1').attr('readonly',true);
            }
            $('#hidden_edit_bango').val(result.bango);
            $('#edit_torihikisakibango').text(result.office_torihikisakibango);
            $('#edit_torihikisakibango_extra').val(result.office_torihikisakibango);
            $('#hidden_torihikisakibango').val(result.office_torihikisakibango);
            $('#edit_syukeitukikijun').val(result.syukeitukikijun);
            $('#edit_syukeituki').val(result.syukeituki);
            $('#edit_syukeikikijun').val(result.syukeikikijun);
            $('#edit_syukeinenkijun').val(result.syukeinenkijun);
            $('#edit_torihikisakirank1').val(result.torihikisakirank1);
            $('#edit_zip1').val(result.office_yubinbango);
            $('#edit_address1').val(result.address1);
            $('#edit_address2').val(result.address2);
            $('#edit_address3').val(result.address3);
            $('#edit_address4').val(result.address4);
            $('#edit_tel').val(result.office_tel);
            $('#edit_torihikisakirank2').val(result.office_torihikisakirank2);
            $('#edit_yobi1').val(result.office_yobi1);
            $('#edit_office_mail').val(result.mail);
            $('#edit_office_mail_confirmation').val(result.mail);
            $('#edit_haisoumoji2').val(result.haisoumoji2 == null ? "" : result.haisoumoji2.substr(0, 1));
            $('#edit_syukeiki').val(result.syukeiki == null ? "" : result.syukeiki.substr(0, 1));
            $('#edit_other1').val(result.other1 == null ? "" : result.other1.substr(0, 1));
            $('#edit_other36').val(result.office_other36);
            $('#edit_other2').val(result.other2 == null ? "" : result.other2.substr(0, 1));
            $('#edit_other3').val(result.other3);
            $('#edit_other4').val(result.other4);
            $('#edit_other5').val(result.other5 == null ? "" : result.other5.substr(0, 1));
            $('#edit_other6').val(result.office_other6);
            $('#edit_other7').val((result.other7 == null || result.other7 == "") ? "1" : result.other7.substr(0, 1));
            $('#edit_other8').val(result.other8 == null ? "" : result.other8.substr(0, 1));
            $('#edit_otherfloat1').val(formatNumber(result.otherfloat1));
            $('#edit_other9').val(result.office_other9);
            $('#edit_other10').val(result.office_other10);
            $('#edit_other11').val(result.other11 == null ? "" : result.other11.substr(0, 1));
            $('#edit_other12').val(result.other12);
            $('#edit_other13').val(result.other13 == null ? "" : result.other13.substr(0, 1));
            $('#edit_other14').val(result.other14 == null ? "" : result.other14.substr(0, 1));
            $('#edit_other15').val(result.office_other15);
            $('#edit_other16').val(result.other16);
            $('#edit_other18').val(result.other18);
            $('#edit_other17').val(result.other17 == null ? "" : result.other17.substr(0, 1));
            $('#edit_other39').val((result.other39 == null || result.other39 == "") ? "2" : result.other39.substr(0, 1));
            $('#edit_other40').val(result.office_other40);
            $('#edit_other19').val(result.other19);
            $('#edit_other20').val(result.other20 == null ? "" : result.other20.substr(0, 1));
            $('#edit_other21').val(result.other21);
            $('#edit_other22').val(result.other22 == null ? "" : result.other22.substr(0, 1));
            $('#edit_other23').val(result.other23 == null ? "" : result.other23.substr(0, 1));
            $('#edit_other24').val(result.other24);
            $('#edit_otherfloat2').val(result.otherfloat2);
            $('#edit_other30').val(result.other30);
            $('#edit_other25').val(result.office_other25);
            $('#edit_other26').val(result.office_other26);
            $('#edit_otherfloat4').val(result.otherfloat4);
            $('#edit_other27').val(result.office_other27);
            $('#edit_other28').val(result.other28);
            $('#edit_other31').val(result.other31);
            $('#edit_other32').val(result.other32);
            $('#edit_other33').val(result.other33);
            $('#edit_other34').val(result.other34 == null ? "" : result.other34.substr(0, 1));
            $('#edit_other35').val(result.other35);
            $('#edit_otherfloat3').val(result.otherfloat3);
            $('#edit_other37').val(result.other37 == null ? "" : result.other37.substr(0, 1));
            $('#edit_other38').val(result.office_other38);
            $('#edit_kokyakuName').val(result.kokyakuname);

            $.each(result, function (index, value) {
                if (value != null) {
                    result[index] = breakData(value);
                }

            });

            $('#detail_shikibetsucode').html(company_details);
            $('#detail_name').html(result.name);
            $('#detail_torihikisakibango').html(result.office_torihikisakibango);
            $('#detail_haisoumoji1').html(result.haisoumoji1);
            $('#detail_syukeitukikijun').html(result.syukeitukikijun + ' ' + result.syukeitukikijunname);
            $('#detail_syukeituki').html(result.syukeituki + ' ' + result.syukeitukiname);
            $('#detail_syukeikikijun').html(result.syukeikikijun + ' ' + result.syukeikikijunname);
            $('#detail_syukeinenkijun').html(result.syukeinenkijun + ' ' + result.syukeinenkijunname);
            $('#detail_torihikisakirank1').html(result.torihikisakirank1);
            $('#detail_zip').html(result.office_yubinbango);
            $('#detail_address1').html(result.address1);
            $('#detail_address2').html(result.address2);
            $('#detail_address3').html(result.address3);
            $('#detail_address4').html(result.address4);
            $('#detail_tel').html(result.office_tel);
            $('#detail_torihikisakirank2').html(result.office_torihikisakirank2);
            $('#detail_yobi1').html(result.office_yobi1);
            $('#detail_mail').html(result.mail);
            $('#detail_mail_confirm').html(result.mail);
            $('#detail_haisoumoji2').html(result.haisoumoji2 == null ? "" : result.haisoumoji2.substr(0, 1));
            $('#detail_syukeiki').html(result.syukeiki == null ? "" : result.syukeiki.substr(0, 1));
            $('#detail_other1').html(result.other1 == null ? "" : result.other1.substr(0, 1));
            $('#detail_other36').html(result.office_other36);
            $('#detail_other2').html(result.other2 == null ? "" : result.other2.substr(0, 1));
            $('#detail_other3').html(result.other3_detail);
            $('#detail_other4').html(result.other4_detail);
            $('#detail_other5').html(result.other5 == null ? "" : result.other5.substr(0, 1));
            $('#detail_other6').html(result.office_other6);
            $('#detail_other7').html(result.other7 == null ? "" : result.other7.substr(0, 1));
            $('#detail_other8').html(result.other8 == null ? "" : result.other8.substr(0, 1));
            $('#detail_otherfloat1').html(formatNumber(result.otherfloat1));
            $('#detail_other9').html(result.office_other9);
            $('#detail_other10').html(result.office_other10);
            $('#detail_other11').html(result.other11 == null ? "" : result.other11.substr(0, 1));
            $('#detail_other12').html(result.other12);
            $('#detail_other13').html(result.other13 == null ? "" : result.other13.substr(0, 1));
            $('#detail_other14').html(result.other14 == null ? "" : result.other14.substr(0, 1));
            $('#detail_other15').html(result.office_other15);
            $('#detail_other16').html(result.other16_detail);
            $('#detail_other18').html(result.other18_detail);
            $('#detail_other17').html(result.other17 == null ? "" : result.other17.substr(0, 1));
            $('#detail_other39').html(result.other39 == null ? "" : result.other39.substr(0, 1));
            $('#detail_other40').html(result.office_other40);
            $('#detail_other19').html(result.other19_detail);
            $('#detail_other20').html(result.other20 == null ? "" : result.other20.substr(0, 1));
            $('#detail_other21').html(result.other21_detail);
            $('#detail_other22').html(result.other22 == null ? "" : result.other22.substr(0, 1));
            $('#detail_other23').html(result.other23 == null ? "" : result.other23.substr(0, 1));
            $('#detail_other24').html(result.other24_detail);
            $('#detail_otherfloat2').html(result.otherfloat2);
            $('#detail_other30').html(result.other30_detail);
            $('#detail_other25').html(result.office_other25);
            $('#detail_other26').html(result.office_other26);
            $('#detail_otherfloat4').html(result.otherfloat4);
            $('#detail_other27').html(result.office_other27);
            $('#detail_other28').html(result.other28);
            $('#detail_other31').html(result.other31_detail);
            $('#detail_other32').html(result.other32_detail);
            $('#detail_other33').html(result.other33_detail);
            $('#detail_other34').html(result.other34 == null ? "" : result.other34.substr(0, 1));
            $('#detail_other35').html(result.other35_detail);
            $('#detail_otherfloat3').html(result.otherfloat3);
            $('#detail_other37').html(result.other37 == null ? "" : result.other37.substr(0, 1));
            $('#detail_other38').html(result.office_other38);
            $('#detail_kokyakuName').html(result.kokyakuname);

            $('#print_shikibetsucode').html(company_details);
            $('#print_bango').html(result.torihikisakibango);
            $('#print_name').html(result.name);
            $('#print_torihikisakibango').html(result.torihikisakibango);
            $('#print_haisoumoji1').html(result.haisoumoji1);
            $('#print_syukeitukikijun').html(result.syukeitukikijun + ' ' + result.syukeitukikijunname);
            $('#print_syukeituki').html(result.syukeituki + ' ' + result.syukeitukiname);
            $('#print_syukeikikijun').html(result.syukeikikijun + ' ' + result.syukeikikijunname);
            $('#print_syukeinenkijun').html(result.syukeinenkijun + ' ' + result.syukeinenkijunname);
            $('#print_torihikisakirank1').html(result.torihikisakirank1 + ' ' + result.jouhou);
            $('#print_zip').html(result.zip1 + result.zip2);
            $('#print_address1').html(result.address1);
            $('#print_address2').html(result.address2);
            $('#print_address3').html(result.address3);
            $('#print_address4').html(result.address4);
            $('#print_tel').html(result.tel);
            $('#print_torihikisakirank2').html(result.torihikisakirank2);
            $('#print_yobi1').html(result.yobi1);
            $('#print_mail').html(result.mail);
            $('#print_mail_confirm').html(result.mail);
            $('#print_syukeiki').html(result.syukeiki);
            $('#print_kokyakuName').html(result.kokyakuName);
            $('#office_print').find('h6').html('事業所マスタ(詳細)');

            //readonly fields when innerlevel>14
            enableDisableFieldEdit();

            $('#office_modal2').modal('show');


            //disable enable tab in detail page depend on haisoumoji2,syukeiki
            if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable second & third tab
                $("#detail_nav_item_2").css("pointer-events", "none");
                $("#detail_nav_item_3").css("pointer-events", "none");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 1) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable third tab
                $("#detail_nav_item_2").css("pointer-events", "auto");
                $("#detail_nav_item_3").css("pointer-events", "none");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) == 1) {//disable second tab
                $("#detail_nav_item_2").css("pointer-events", "none");
                $("#detail_nav_item_3").css("pointer-events", "auto");
            } else {
                $("#detail_nav_item_2").css("pointer-events", "auto");
                $("#detail_nav_item_3").css("pointer-events", "auto");
            }

            //first time disable enable tab in edit page depend on haisoumoji2,syukeiki
            if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable second & third tab
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "none");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 1) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable third tab
                $("#edit_nav_item_2").css("pointer-events", "auto");
                $("#edit_nav_item_3").css("pointer-events", "none");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) == 1) {//disable second tab
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "auto");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() > 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) > 2) {
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "none");
            } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() < 1) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) < 1) {
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "none");
            } else {
                $("#edit_nav_item_2").css("pointer-events", "auto");
                $("#edit_nav_item_3").css("pointer-events", "auto");
            }


        }
    });
}


$("#edit_torihikisakirank1").change(function(){
    $('#edit_name').attr('readonly',false);
    $('#edit_haisoumoji1').attr('readonly',false);
});


$("#insert_zip1").keyup(function () {
    console.log("Handler for .keypress() called.");
    var firstData = $("#insert_zip1").val();
    // var secondData = $("#insert_zip2").val();

    if (firstData.length == 7) {

        var url = "https://ita01.colgis.com/cgi-bin/http_yubin_get.cgi?PASSWORD=colgis.co.jp&YUBINBANGO=" + firstData;
        var request = new XMLHttpRequest();

        request.open('GET', url, true);

        request.onload = function () {
            var data = this.response;
            if (data.indexOf('get_addr_furigana') == -1) {
                var address = data.split(" ");
                console.log(address);
                var ken = address[0].split("==");

                $("#insert_address1,#insert_address2,#insert_address3").val('');

                if (ken[1]) {
                    $("#insert_address1").val(ken[1]);
                }
                if (address[1]) {
                    $("#insert_address2").val(address[1]);
                }
                if (address[2]) {
                    $("#insert_address3").val(address[2]);
                }
            } else {
                $("#insert_address1,#insert_address2,#insert_address3").val('');
            }
        }
        request.send();
    } else {
        $("#insert_address1,#insert_address2,#insert_address3").val('');
    }
});

$("#edit_zip1").keyup(function () {
    console.log("Handler for .keypress() called.");
    var firstData = $("#edit_zip1").val();
    //var secondData = $("#edit_zip2").val();

    if (firstData.length == 7) {

        var url = "https://ita01.colgis.com/cgi-bin/http_yubin_get.cgi?PASSWORD=colgis.co.jp&YUBINBANGO=" + firstData;
        var request = new XMLHttpRequest();

        request.open('GET', url, true);

        request.onload = function () {
            var data = this.response;
            if (data.indexOf('get_addr_furigana') == -1) {
                var address = data.split(" ");
                console.log(address);
                var ken = address[0].split("==");

                $("#edit_address1,#edit_address2,#edit_address3").val('');

                if (ken[1]) {
                    $("#edit_address1").val(ken[1]);
                }
                if (address[1]) {
                    $("#edit_address2").val(address[1]);
                }
                if (address[2]) {
                    $("#edit_address3").val(address[2]);
                }
            } else {
                $("#edit_address1,#edit_address2,#edit_address3").val('');
            }
        }
        request.send();
    } else {
        $("#edit_address1,#edit_address2,#edit_address3").val('');
    }
});

$("#reset_button").on("click", function () {
    $("#lastname").val("");
    $("#office_search_button").click();

    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    $("#product_supplier_content2").removeData();
});


$("#choice_button").on("click", function () {
    var number = kokyaku + haisou + etsuransya[0];
    $("#insert_kingakugoukei").val(number);
    $("#edit_kingakugoukei").val(number);
    $("#office_modal4").modal('hide');
});

$("#box_popup1").on("click", function () {
    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();

    $("#office_modal4").modal('show');
});

$("#box_popupEdit").on("click", function () {
    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();

    $("#office_modal4").modal('show');
});


$("#reset_button2").on("click", function () {
    $("#lastname2").val("");
    $("#office_search_button2").click();

    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    $("#product_supplier_content2").removeData();
});


$("#choice_button2").on("click", function () {
    var number = kokyaku + haisou + etsuransya[0];
    $("#insert_kingakugoukei").val(number);
    $("#edit_kingakugoukei").val(number);
    $("#office_modal42").modal('hide');
});

$("#box_popup2").on("click", function () {
    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();

    $("#office_modal42").modal('show');
});

$("#box_popupEdit2").on("click", function () {
    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();

    $("#office_modal42").modal('show');
});


function deleteOfficeMaster(url) {
    if (officeMasterDeleteRetrieve == 0) {
        officeMasterDeleteRetrieve++;
        var html = getConfirmationMessage(3);
        $('#detail_office_error_data').html(html);
        $("#detail_office_error_data").show();

    } else {
        var kesuId = document.getElementById('hidden_edit_bango').value;

        console.log(kesuId)
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

function returnOfficeMaster(url) {
    if (officeMasterDeleteRetrieve == 0) {
        officeMasterDeleteRetrieve++;
        var html = getConfirmationMessage(4);
        $('#detail_office_error_data').html(html);
        $("#detail_office_error_data").show();

    } else {
        var kesuId = document.getElementById('hidden_edit_bango').value;

        console.log(kesuId)
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


function goToPersonalMaster(Id) {

    document.getElementById('torihikisakibango').value = Id;
    document.getElementById("personalTable").submit();
}

function loadSelectedKokyaku(yobi12, url, page_type) {
    var yobi12 = $(yobi12).find(":selected").val();

    $.ajax({
        type: "GET",
        url: url,
        data: 'yobi12=' + yobi12,
        success: function (response) {
            if (page_type == 1) {
                $("#insert_haisoumoji2").val(response.syukeituki != null ? response.syukeituki.substr(0, 1) : response.syukeituki);
                $("#insert_syukeiki").val(response.syukeikikijun != null ? response.syukeikikijun.substr(0, 1) : response.syukeikikijun);
                $("#insert_other2").val(response.kcode3 != null ? response.kcode3.substr(0, 1) : response.kcode3);
                $("#insert_other3").val(response.ytoiawsestart != null ? response.ytoiawsestart : response.ytoiawsestart);
                $("#insert_other4").val(response.ytoiawseend != null ? response.ytoiawseend : response.ytoiawseend);
                $("#insert_other5").val(response.ytoiawsesaiban != null ? response.ytoiawsesaiban.substr(0, 1) : response.ytoiawsesaiban);
                $("#insert_other6").val(response.yetoiawsestart != null ? response.yetoiawsestart : 31);
                $("#insert_other7").val(response.yetoiawseend != null ? response.yetoiawseend.substr(0, 1) : response.yetoiawseend);
                $("#insert_other8").val(response.yetoiawsesaiban != null ? response.yetoiawsesaiban.substr(0, 1) : response.yetoiawsesaiban);
                $("#insert_otherfloat1").val(formatNumber(response.denpyostart));
                $("#insert_other9").val(response.mail_soushin);
                $("#insert_other10").val(response.mail_jyushin);
                $("#insert_other11").val(response.mail_nouhin != null ? response.mail_nouhin.substr(0, 1) : response.mail_nouhin);
                $("#insert_other12").val(response.mail_toiawase);
                $("#insert_other13").val(response.mail_soushin_mb != null ? response.mail_soushin_mb.substr(0, 1) : response.mail_soushin_mb);
                $("#insert_other14").val(response.mail_jyushin_mb != null ? response.mail_jyushin_mb.substr(0, 1) : response.mail_jyushin_mb);
                $("#insert_other15").val(response.mail_nouhin_mb);
                $("#insert_other16").val(response.mail_toiawase_mb != null ? response.mail_toiawase_mb : response.mail_toiawase_mb);
                $("#insert_other17").val(response.datatxt0051 != null ? response.datatxt0051.substr(0, 1) : response.datatxt0051);
                $("#insert_other18").val(response.mallsoukobango1 != null ? response.mallsoukobango1 : response.mallsoukobango1);
                $("#insert_other19").val(response.haisoujouhou_tel != null ? response.haisoujouhou_tel : response.haisoujouhou_tel);
                $("#insert_other21").val(response.sex != null ? response.sex : response.sex);
                $("#insert_other39").val(response.mallsoukobango2 != null ? response.mallsoukobango2.substr(0, 1) : response.mallsoukobango2);
                $("#insert_other40").val(response.mallsoukobango3);
                $("#insert_other20").val(response.mail != null ? response.mail.substr(0, 1) : response.mail);
                $("#insert_other22").val(response.bunrui1 != null ? response.bunrui1.substr(0, 1) : response.bunrui1);
                $("#insert_other23").val(response.bunrui2 != null ? response.bunrui2.substr(0, 1) : response.bunrui2);
                $("#insert_other24").val(response.bunrui3 != null ? response.bunrui3 : response.bunrui3);
                $("#insert_other25").val(response.datatxt0054);
                $("#insert_other26").val(response.datatxt0055);
                $("#insert_other30").val(response.syukeinenkijun != null ? response.syukeinenkijun : "");
                $("#insert_other31").val(response.syukeiki != null ? response.syukeiki : "");
                $("#insert_other32").val(response.datatxt0053 != null ? response.datatxt0053 : "");
                $("#insert_other33").val(response.bunrui4 != null ? response.bunrui4 : response.bunrui4);
                $("#insert_other35").val(response.bunrui5 != null ? response.bunrui5 : response.bunrui5);
                $("#insert_otherfloat2").val(response.syukei3);
                $("#insert_other34").val(response.datatxt0052 != null ? response.datatxt0052.substr(0, 1) : response.datatxt0052);
                $("#insert_otherfloat3").val(response.syukei2);
                $("#insert_otherfloat4").val(response.endtime != null ? response.endtime : "");
                $("#insert_other27").val(response.datatxt0056);
                $("#insert_other28").val(response.datatxt0057);
                $("#insert_other37").val(response.bunrui9 != null ? response.bunrui9.substr(0, 1) : response.bunrui9);
                $("#insert_other38").val(response.bunrui10 != null ? response.bunrui10 : response.bunrui10);

                initTabHideShow();
            } else if (page_type == 2) {
                $("#edit_haisoumoji2").val(response.syukeituki != null ? response.syukeituki.substr(0, 1) : response.syukeituki);
                $("#edit_syukeiki").val(response.syukeikikijun != null ? response.syukeikikijun.substr(0, 1) : response.syukeikikijun);
                $("#edit_other2").val(response.kcode3 != null ? response.kcode3.substr(0, 1) : response.kcode3);
                $("#edit_other3").val(response.ytoiawsestart != null ? response.ytoiawsestart : response.ytoiawsestart);
                $("#edit_other4").val(response.ytoiawseend != null ? response.ytoiawseend : response.ytoiawseend);
                $("#edit_other5").val(response.ytoiawsesaiban != null ? response.ytoiawsesaiban.substr(0, 1) : response.ytoiawsesaiban);
                $("#edit_other7").val(response.yetoiawseend != null ? response.yetoiawseend.substr(0, 1) : response.yetoiawseend);
                $("#edit_other8").val(response.yetoiawsesaiban != null ? response.yetoiawsesaiban.substr(0, 1) : response.yetoiawsesaiban);
                $("#edit_otherfloat1").val(formatNumber(response.denpyostart));
                $("#edit_other10").val(response.mail_jyushin);
                $("#edit_other11").val(response.mail_nouhin != null ? response.mail_nouhin.substr(0, 1) : response.mail_nouhin);
                $("#edit_other12").val(response.mail_toiawase);
                $("#edit_other13").val(response.mail_soushin_mb != null ? response.mail_soushin_mb.substr(0, 1) : response.mail_soushin_mb);
                $("#edit_other14").val(response.mail_jyushin_mb != null ? response.mail_jyushin_mb.substr(0, 1) : response.mail_jyushin_mb);
                $("#edit_other16").val(response.mail_toiawase_mb != null ? response.mail_toiawase_mb : response.mail_toiawase_mb);
                $("#edit_other17").val(response.datatxt0051 != null ? response.datatxt0051.substr(0, 1) : response.datatxt0051);
                $("#edit_other18").val(response.mallsoukobango1 != null ? response.mallsoukobango1 : response.mallsoukobango1);
                $("#edit_other19").val(response.haisoujouhou_tel != null ? response.haisoujouhou_tel : response.haisoujouhou_tel);
                $("#edit_other21").val(response.sex != null ? response.sex : response.sex);
                $("#edit_other39").val(response.mallsoukobango2 != null ? response.mallsoukobango2.substr(0, 1) : response.mallsoukobango2);
                $("#edit_other40").val(response.mallsoukobango3);
                $("#edit_other20").val(response.mail != null ? response.mail.substr(0, 1) : response.mail);
                $("#edit_other22").val(response.bunrui1 != null ? response.bunrui1.substr(0, 1) : response.bunrui1);
                $("#edit_other23").val(response.bunrui2 != null ? response.bunrui2.substr(0, 1) : response.bunrui2);
                $("#edit_other24").val(response.bunrui3 != null ? response.bunrui3 : response.bunrui3);
                $("#edit_other33").val(response.bunrui4 != null ? response.bunrui4 : response.bunrui4);
                $("#edit_other35").val(response.bunrui5 != null ? response.bunrui5 : response.bunrui5);
                $("#edit_otherfloat2").val(response.syukei3);
                $("#edit_other34").val(response.datatxt0052 != null ? response.datatxt0052.substr(0, 1) : response.datatxt0052);
                $("#edit_otherfloat3").val(response.syukei2);
                $("#edit_other37").val(response.bunrui9 != null ? response.bunrui9.substr(0, 1) : response.bunrui9);
                $("#edit_other38").val(response.bunrui10 != null ? response.bunrui10 : response.bunrui10);

                initTabHideShow();
            }
        }
    });
}

//disable enable tab in reg page depend on haisoumoji2,syukeiki
$('#insert_haisoumoji2,#insert_syukeiki').on('keyup change', function () {
    if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val() == 2)) {//disable second & third tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 1) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val() == 2)) {//disable third tab
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) == 1) {//disable second tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "initial");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() > 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) > 2) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() < 1) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) < 1) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else {
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "initial");
    }
});


//disable enable tab in edit page depend on syukeituki,syukeikikijun
$('#edit_haisoumoji2,#edit_syukeiki').on('keyup change', function () {
    if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable second & third tab
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
    } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 1) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val() == 2)) {//disable third tab
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "none");
    } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() == 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) == 1) {//disable second tab
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "auto");
    } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() > 2) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) > 2) {
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
    } else if (($("#edit_haisoumoji2").val() != "" && $("#edit_haisoumoji2").val() < 1) && ($("#edit_syukeiki").val() != "" && $("#edit_syukeiki").val()) < 1) {
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
    } else {
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "auto");
    }
});


//tab hide,show when open registration modal
function initTabHideShow() {
    if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val() == 2)) {//disable second & third tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 1) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val() == 2)) {//disable third tab
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() == 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) == 1) {//disable second tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "initial");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() > 2) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) > 2) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if (($("#insert_haisoumoji2").val() != "" && $("#insert_haisoumoji2").val() < 1) && ($("#insert_syukeiki").val() != "" && $("#insert_syukeiki").val()) < 1) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else {
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "initial");
    }
}


//readonly field when innerlevel>14, registration
function enableDisableField(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#insert_torihikisakirank1:selected").prop("readonly",true);
        $("#insert_torihikisakirank1").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other1").prop("readonly",true);
        $("#insert_other36").prop("readonly",true);
        $("#insert_other2").prop("readonly",true);
        $("#insert_other3:selected").prop("readonly",true);
        $("#insert_other3").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other4:selected").prop("readonly",true);
        $("#insert_other4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other5").prop("readonly",true);
        $("#insert_other6:selected").prop("readonly",true);
        $("#insert_other6").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other7").prop("readonly",true);
        $("#insert_other8").prop("readonly",true);
        $("#insert_otherfloat1").prop("readonly",true);
        $("#insert_other16:selected").prop("readonly",true);
        $("#insert_other16").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other18:selected").prop("readonly",true);
        $("#insert_other18").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other17").prop("readonly",true);
        $("#insert_other39").prop("readonly",true);
        $("#insert_other40").prop("readonly",true);
        $("#insert_other19:selected").prop("readonly",true);
        $("#insert_other19").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other20").prop("readonly",true);
        $("#insert_other21:selected").prop("readonly",true);
        $("#insert_other21").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other22").prop("readonly",true);
        $("#insert_other23").prop("readonly",true);
        $("#insert_other24:selected").prop("readonly",true);
        $("#insert_other24").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_otherfloat2").prop("readonly",true);
        $("#insert_other30:selected").prop("readonly",true);
        $("#insert_other30").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other25").prop("readonly",true);
        $("#insert_other26").prop("readonly",true);
        $("#insert_otherfloat4:selected").prop("readonly",true);
        $("#insert_otherfloat4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other27").prop("readonly",true);
        $("#insert_other28").prop("readonly",true);
        $("#insert_other31:selected").prop("readonly",true);
        $("#insert_other31").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other32:selected").prop("readonly",true);
        $("#insert_other32").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other33:selected").prop("readonly",true);
        $("#insert_other33").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_other34").prop("readonly",true);
        $("#insert_other35:selected").prop("readonly",true);
        $("#insert_other35").css({'background-color':'#efefef','pointer-events':'none'});
        $("#insert_otherfloat3").prop("readonly",true);
        $("#insert_other37").prop("readonly",true);
        $("#insert_other38:selected").prop("readonly",true);
        $("#insert_other38").css({'background-color':'#efefef','pointer-events':'none'});
    }
}

//readonly field when innerlevel>14, registration
function enableDisableFieldEdit(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#edit_torihikisakirank1:selected").prop("readonly",true);
        $("#edit_torihikisakirank1").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other1").prop("readonly",true);
        $("#edit_other36").prop("readonly",true);
        $("#edit_other2").prop("readonly",true);
        $("#edit_other3:selected").prop("readonly",true);
        $("#edit_other3").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other4:selected").prop("readonly",true);
        $("#edit_other4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other5").prop("readonly",true);
        $("#edit_other6:selected").prop("readonly",true);
        $("#edit_other6").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other7").prop("readonly",true);
        $("#edit_other8").prop("readonly",true);
        $("#edit_otherfloat1").prop("readonly",true);
        $("#edit_other16:selected").prop("readonly",true);
        $("#edit_other16").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other18:selected").prop("readonly",true);
        $("#edit_other18").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other17").prop("readonly",true);
        $("#edit_other39").prop("readonly",true);
        $("#edit_other40").prop("readonly",true);
        $("#edit_other19:selected").prop("readonly",true);
        $("#edit_other19").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other20").prop("readonly",true);
        $("#edit_other21:selected").prop("readonly",true);
        $("#edit_other21").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other22").prop("readonly",true);
        $("#edit_other23").prop("readonly",true);
        $("#edit_other24:selected").prop("readonly",true);
        $("#edit_other24").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_otherfloat2").prop("readonly",true);
        $("#edit_other30:selected").prop("readonly",true);
        $("#edit_other30").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other25").prop("readonly",true);
        $("#edit_other26").prop("readonly",true);
        $("#edit_otherfloat4:selected").prop("readonly",true);
        $("#edit_otherfloat4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other27").prop("readonly",true);
        $("#edit_other28").prop("readonly",true);
        $("#edit_other31:selected").prop("readonly",true);
        $("#edit_other31").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other32:selected").prop("readonly",true);
        $("#edit_other32").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other33:selected").prop("readonly",true);
        $("#edit_other33").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_other34").prop("readonly",true);
        $("#edit_other35:selected").prop("readonly",true);
        $("#edit_other35").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_otherfloat3").prop("readonly",true);
        $("#edit_other37").prop("readonly",true);
        $("#edit_other38:selected").prop("readonly",true);
        $("#edit_other38").css({'background-color':'#efefef','pointer-events':'none'});
    }
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

//comma replace
function commaReplace(str) {
    var new_str = str.toString();
    new_str = new_str.replace(/,/g,"");
    return new_str; 
}

$("#insert_otherfloat1,#edit_otherfloat1").focusout(function(){
    var val = commaReplace($(this).val());
    val = formatNumber(val);
    $(this).val(val);
});

$("#insert_otherfloat1,#edit_otherfloat1").focusin(function(){
    var val = commaReplace($(this).val());
    $(this).val(val);
});