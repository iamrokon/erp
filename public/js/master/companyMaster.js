var companyReg = 0;
var companyEdt = 0;
var companyDeleteRetrieve = 0;

function openRegistration() {
    //table enable
    $("#reg_nav_item_2").css("pointer-events", "auto");
    $("#reg_nav_item_3").css("pointer-events", "auto");

    $("#reg_mail_soushin_abbr").html("");
    $("#reg_mail_nouhin_mb_abbr").html("");

    $("#regFrontValidation").remove();


    companyReg = 0;

    //tab check start here
    $("#common1").addClass('active');
    $("#common1-tab").addClass('active');
    $("#sales_billing1").removeClass('active');
    $("#sales_billing1_tab").removeClass('active');
    $("#payment1").removeClass('active');
    $("#payment1-tab").removeClass('active');
    $("#reg_nav_item_2").css("pointer-events", "none");
    $("#reg_nav_item_3").css("pointer-events", "none");
    //tab check end here

    $('#registrationForm').trigger("reset");
    $("#error_data").hide();
    $('.error').each(function () {
        if (this.classList.contains("error")) {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });

    //readonly fields when innerlevel>14
    //enableDisableField();

    $('#registrationModal').modal('show');
}

/////////registration function///////////////
function registerCompany(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }

//    if (companyReg == '0' && field==null) {
//        companyReg++;
//        var html = getConfirmationMessage(1);
//        $('#error_data').html(html);
//        $("#error_data").show();
//
//    } else {

        //submit confirmation check
        var submit_confirmation = $("#submit_confirmation").val();

        var data = new FormData(document.getElementById('registrationForm'));
        data.append('submit_confirmation', submit_confirmation);
        if(field!=null){
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
                //console.log(result);
                if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                    //document.getElementById("companyMasterReload").trigger("click");
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#companyMasterReload").trigger("click");

                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                    $(document).find("#error_data").html(confirmationMsg);
                    document.getElementById('regButton').disabled = false;
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

                    if (inputError.kounyusu) {
                        $('#reg_kounyusu').addClass("error");
                    } else {
                        $('#reg_kounyusu').removeClass("error");
                    }

                    if (inputError.name) {
                        $('#reg_name').addClass("error");
                    } else {
                        $('#reg_name').removeClass("error");
                    }

                    if (inputError.address) {
                        $('#reg_address').addClass("error");
                    } else {
                        $('#reg_address').removeClass("error");
                    }

                    if (inputError.furigana) {
                        $('#reg_furigana').addClass("error");
                    } else {
                        $('#reg_furigana').removeClass("error");
                    }

                    if (inputError.datatxt0050) {
                        $('#reg_datatxt0050').addClass("error");
                    } else {
                        $('#reg_datatxt0050').removeClass("error");
                    }

                    if (inputError.syukeitukikijun) {
                        $('#reg_syukeitukikijun').addClass("error");
                    } else {
                        $('#reg_syukeitukikijun').removeClass("error");
                    }

                    if (inputError.syukeinen) {
                        $('#reg_syukeinen').addClass("error");
                    } else {
                        $('#reg_syukeinen').removeClass("error");
                    }
                    
                    if (inputError.bunrui6) {
                        $('#reg_bunrui6').addClass("error");
                    } else {
                        $('#reg_bunrui6').removeClass("error");
                    }

                    if (inputError.tel) {
                        $('#reg_tel').addClass("error");
                    } else {
                        $('#reg_tel').removeClass("error");
                    }

                    if (inputError.fax) {
                        $('#reg_fax').addClass("error");
                    } else {
                        $('#reg_fax').removeClass("error");
                    }

                    if (inputError.torihikisakibango) {
                        $('#reg_torihikisakibango').addClass("error");
                    } else {
                        $('#reg_torihikisakibango').removeClass("error");
                    }

                    if (inputError.kensakukey) {
                        $('#reg_kensakukey').addClass("error");
                    } else {
                        $('#reg_kensakukey').removeClass("error");
                    }

                    if (inputError.syukeituki) {
                        $('#reg_syukeituki').addClass("error");
                    } else {
                        $('#reg_syukeituki').removeClass("error");
                    }

                    if (inputError.syukeikikijun) {
                        $('#reg_syukeikikijun').addClass("error");
                    } else {
                        $('#reg_syukeikikijun').removeClass("error");
                    }

                    if (inputError.kcode3) {
                        $('#reg_kcode3').addClass("error");
                    } else {
                        $('#reg_kcode3').removeClass("error");
                    }

                    if (inputError.ytoiawsestart) {
                        $('#reg_ytoiawsestart').addClass("error");
                    } else {
                        $('#reg_ytoiawsestart').removeClass("error");
                    }

                    if (inputError.ytoiawseend) {
                        $('#reg_ytoiawseend').addClass("error");
                    } else {
                        $('#reg_ytoiawseend').removeClass("error");
                    }


                    if (inputError.ytoiawsesaiban) {
                        $('#reg_ytoiawsesaiban').addClass("error");
                    } else {
                        $('#reg_ytoiawsesaiban').removeClass("error");
                    }

                    if (inputError.yetoiawsestart) {
                        $('#reg_yetoiawsestart').addClass("error");
                    } else {
                        $('#reg_yetoiawsestart').removeClass("error");
                    }

                    if (inputError.yetoiawseend) {
                        $('#reg_yetoiawseend').addClass("error");
                    } else {
                        $('#reg_yetoiawseend').removeClass("error");
                    }

                    if (inputError.yetoiawsesaiban) {
                        $('#reg_yetoiawsesaiban').addClass("error");
                    } else {
                        $('#reg_yetoiawsesaiban').removeClass("error");
                    }

                    if (inputError.netusername) {
                        $('#reg_netusername').addClass("error");
                    } else {
                        $('#reg_netusername').removeClass("error");
                    }

                    if (inputError.netuserpasswd) {
                        $('#reg_netuserpasswd').addClass("error");
                    } else {
                        $('#reg_netuserpasswd').removeClass("error");
                    }

                    if (inputError.denpyostart) {
                        $('#reg_denpyostart').addClass("error");
                    } else {
                        $('#reg_denpyostart').removeClass("error");
                    }

                    if (inputError.mail_soushin) {
                        $('#reg_mail_soushin').addClass("error");
                    } else {
                        $('#reg_mail_soushin').removeClass("error");
                    }

                    if (inputError.mail_jyushin) {
                        $('#reg_mail_jyushin').addClass("error");
                    } else {
                        $('#reg_mail_jyushin').removeClass("error");
                    }

                    if (inputError.mail_nouhin) {
                        $('#reg_mail_nouhin').addClass("error");
                    } else {
                        $('#reg_mail_nouhin').removeClass("error");
                    }

                    if (inputError.mail_toiawase) {
                        $('#reg_mail_toiawase').addClass("error");
                    } else {
                        $('#reg_mail_toiawase').removeClass("error");
                    }

                    if (inputError.mail_soushin_mb) {
                        $('#reg_mail_soushin_mb').addClass("error");
                    } else {
                        $('#reg_mail_soushin_mb').removeClass("error");
                    }

                    if (inputError.mail_jyushin_mb) {
                        $('#reg_mail_jyushin_mb').addClass("error");
                    } else {
                        $('#reg_mail_jyushin_mb').removeClass("error");
                    }

                    if (inputError.mail_nouhin_mb) {
                        $('#reg_mail_nouhin_mb').addClass("error");
                    } else {
                        $('#reg_mail_nouhin_mb').removeClass("error");
                    }

                    if (inputError.mail_toiawase_mb) {
                        $('#reg_mail_toiawase_mb').addClass("error");
                    } else {
                        $('#reg_mail_toiawase_mb').removeClass("error");
                    }

                    if (inputError.mallsoukobango1) {
                        $('#reg_mallsoukobango1').addClass("error");
                    } else {
                        $('#reg_mallsoukobango1').removeClass("error");
                    }

                    if (inputError.datatxt0051) {
                        $('#reg_datatxt0051').addClass("error");
                    } else {
                        $('#reg_datatxt0051').removeClass("error");
                    }

                    if (inputError.mallsoukobango2) {
                        $('#reg_mallsoukobango2').addClass("error");
                    } else {
                        $('#reg_mallsoukobango2').removeClass("error");
                    }

                    if (inputError.mallsoukobango3) {
                        $('#reg_mallsoukobango3').addClass("error");
                    } else {
                        $('#reg_mallsoukobango3').removeClass("error");
                    }

                    if (inputError.kaiinbango) {
                        $('#reg_kaiinbango').addClass("error");
                    } else {
                        $('#reg_kaiinbango').removeClass("error");
                    }

                    if (inputError.zokugara) {
                        $('#reg_zokugara').addClass("error");
                    } else {
                        $('#reg_zokugara').removeClass("error");
                    }

                    if (inputError.haisoujouhou_name) {
                        $('#reg_haisoujouhou_name').addClass("error");
                    } else {
                        $('#reg_haisoujouhou_name').removeClass("error");
                    }

                    if (inputError.haisoujouhou_yubinbango) {
                        $('#reg_haisoujouhou_yubinbango').addClass("error");
                    } else {
                        $('#reg_haisoujouhou_yubinbango').removeClass("error");
                    }

                    if (inputError.kcode4) {
                        $('#reg_kcode4').addClass("error");
                    } else {
                        $('#reg_kcode4').removeClass("error");
                    }

                    if (inputError.haisoujouhou_address) {
                        $('#reg_haisoujouhou_address').addClass("error");
                    } else {
                        $('#reg_haisoujouhou_address').removeClass("error");
                    }

                    if (inputError.haisoujouhou_tel) {
                        $('#reg_haisoujouhou_tel').addClass("error");
                    } else {
                        $('#reg_haisoujouhou_tel').removeClass("error");
                    }

                    if (inputError.mail) {
                        $('#reg_mail').addClass("error");
                    } else {
                        $('#reg_mail').removeClass("error");
                    }

                    if (inputError.sex) {
                        $('#reg_sex').addClass("error");
                    } else {
                        $('#reg_sex').removeClass("error");
                    }

                    if (inputError.bunrui1) {
                        $('#reg_bunrui1').addClass("error");
                    } else {
                        $('#reg_bunrui1').removeClass("error");
                    }

                    if (inputError.bunrui2) {
                        $('#reg_bunrui2').addClass("error");
                    } else {
                        $('#reg_bunrui2').removeClass("error");
                    }

                    if (inputError.syukeinenkijun) {
                        $('#reg_syukeinenkijun').addClass("error");
                    } else {
                        $('#reg_syukeinenkijun').removeClass("error");
                    }

                    if (inputError.bunrui3) {
                        $('#reg_bunrui3').addClass("error");
                    } else {
                        $('#reg_bunrui3').removeClass("error");
                    }

                    if (inputError.datatxt0054) {
                        $('#reg_datatxt0054').addClass("error");
                    } else {
                        $('#reg_datatxt0054').removeClass("error");
                    }

                    if (inputError.datatxt0055) {
                        $('#reg_datatxt0055').addClass("error");
                    } else {
                        $('#reg_datatxt0055').removeClass("error");
                    }

                    if (inputError.endtime) {
                        $('#reg_endtime').addClass("error");
                    } else {
                        $('#reg_endtime').removeClass("error");
                    }

                    if (inputError.datatxt0056) {
                        $('#reg_datatxt0056').addClass("error");
                    } else {
                        $('#reg_datatxt0056').removeClass("error");
                    }

                    if (inputError.datatxt0057) {
                        $('#reg_datatxt0057').addClass("error");
                    } else {
                        $('#reg_datatxt0057').removeClass("error");
                    }

                    if (inputError.syukei3) {
                        $('#reg_syukei3').addClass("error");
                    } else {
                        $('#reg_syukei3').removeClass("error");
                    }

                    if (inputError.syukeiki) {
                        $('#reg_syukeiki').addClass("error");
                    } else {
                        $('#reg_syukeiki').removeClass("error");
                    }

                    if (inputError.bunrui4) {
                        $('#reg_bunrui4').addClass("error");
                    } else {
                        $('#reg_bunrui4').removeClass("error");
                    }

                    if (inputError.bunrui5) {
                        $('#reg_bunrui5').addClass("error");
                    } else {
                        $('#reg_bunrui5').removeClass("error");
                    }

                    if (inputError.syukei2) {
                        $('#reg_syukei2').addClass("error");
                    } else {
                        $('#reg_syukei2').removeClass("error");
                    }

                    if (inputError.bunrui9) {
                        $('#reg_bunrui9').addClass("error");
                    } else {
                        $('#reg_bunrui9').removeClass("error");
                    }

                    if (inputError.datatxt0052) {
                        $('#reg_datatxt0052').addClass("error");
                    } else {
                        $('#reg_datatxt0052').removeClass("error");
                    }

                }
            }
        });
    //}
}

///////////////end registration function//////

/////////edit function///////////////

function editCompany(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }

    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();

    var data = new FormData(document.getElementById('editForm'));
    data.append('submit_confirmation', submit_confirmation);

    if(field!=null){
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
            //console.log(result);
            if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                //location.reload();
                input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                jQuery('#navbarForm').append(input);
                $("#companyMasterReload").trigger("click");
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 0px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#edit_error_data").html(confirmationMsg);
                document.getElementById('editButton').disabled = false;
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

                if (inputError.kounyusu) {
                    $('#edit_kounyusu').addClass("error");
                } else {
                    $('#edit_kounyusu').removeClass("error");
                }

                if (inputError.name) {
                    $('#edit_name').addClass("error");
                } else {
                    $('#edit_name').removeClass("error");
                }

                if (inputError.address) {
                    $('#edit_address').addClass("error");
                } else {
                    $('#edit_address').removeClass("error");
                }

                if (inputError.furigana) {
                    $('#edit_furigana').addClass("error");
                } else {
                    $('#edit_furigana').removeClass("error");
                }

                if (inputError.datatxt0050) {
                    $('#edit_datatxt0050').addClass("error");
                } else {
                    $('#edit_datatxt0050').removeClass("error");
                }

                if (inputError.syukeitukikijun) {
                    $('#edit_syukeitukikijun').addClass("error");
                } else {
                    $('#edit_syukeitukikijun').removeClass("error");
                }

                if (inputError.syukeinen) {
                    $('#edit_syukeinen').addClass("error");
                } else {
                    $('#edit_syukeinen').removeClass("error");
                }
                
                if (inputError.bunrui6) {
                    $('#edit_bunrui6').addClass("error");
                } else {
                    $('#edit_bunrui6').removeClass("error");
                }

                if (inputError.tel) {
                    $('#edit_tel').addClass("error");
                } else {
                    $('#edit_tel').removeClass("error");
                }

                if (inputError.fax) {
                    $('#edit_fax').addClass("error");
                } else {
                    $('#edit_fax').removeClass("error");
                }

                if (inputError.torihikisakibango) {
                    $('#edit_torihikisakibango').addClass("error");
                } else {
                    $('#edit_torihikisakibango').removeClass("error");
                }

                if (inputError.kensakukey) {
                    $('#edit_kensakukey').addClass("error");
                } else {
                    $('#edit_kensakukey').removeClass("error");
                }

                if (inputError.syukeituki) {
                    $('#edit_syukeituki').addClass("error");
                } else {
                    $('#edit_syukeituki').removeClass("error");
                }

                if (inputError.syukeikikijun) {
                    $('#edit_syukeikikijun').addClass("error");
                } else {
                    $('#edit_syukeikikijun').removeClass("error");
                }

                if (inputError.kcode3) {
                    $('#edit_kcode3').addClass("error");
                } else {
                    $('#edit_kcode3').removeClass("error");
                }

                if (inputError.ytoiawsestart) {
                    $('#edit_ytoiawsestart').addClass("error");
                } else {
                    $('#edit_ytoiawsestart').removeClass("error");
                }

                if (inputError.ytoiawseend) {
                    $('#edit_ytoiawseend').addClass("error");
                } else {
                    $('#edit_ytoiawseend').removeClass("error");
                }

                if (inputError.ytoiawsesaiban) {
                    $('#edit_ytoiawsesaiban').addClass("error");
                } else {
                    $('#edit_ytoiawsesaiban').removeClass("error");
                }

                if (inputError.yetoiawsestart) {
                    $('#edit_yetoiawsestart').addClass("error");
                } else {
                    $('#edit_yetoiawsestart').removeClass("error");
                }

                if (inputError.yetoiawseend) {
                    $('#edit_yetoiawseend').addClass("error");
                } else {
                    $('#edit_yetoiawseend').removeClass("error");
                }

                if (inputError.yetoiawsesaiban) {
                    $('#edit_yetoiawsesaiban').addClass("error");
                } else {
                    $('#edit_yetoiawsesaiban').removeClass("error");
                }

                if (inputError.netusername) {
                    $('#edit_netusername').addClass("error");
                } else {
                    $('#edit_netusername').removeClass("error");
                }

                if (inputError.netuserpasswd) {
                    $('#edit_netuserpasswd').addClass("error");
                } else {
                    $('#edit_netuserpasswd').removeClass("error");
                }

                if (inputError.denpyostart) {
                    $('#edit_denpyostart').addClass("error");
                } else {
                    $('#edit_denpyostart').removeClass("error");
                }

                if (inputError.mail_soushin) {
                    $('#edit_mail_soushin').addClass("error");
                } else {
                    $('#edit_mail_soushin').removeClass("error");
                }

                if (inputError.mail_jyushin) {
                    $('#edit_mail_jyushin').addClass("error");
                } else {
                    $('#edit_mail_jyushin').removeClass("error");
                }

                if (inputError.mail_nouhin) {
                    $('#edit_mail_nouhin').addClass("error");
                } else {
                    $('#edit_mail_nouhin').removeClass("error");
                }

                if (inputError.mail_toiawase) {
                    $('#edit_mail_toiawase').addClass("error");
                } else {
                    $('#edit_mail_toiawase').removeClass("error");
                }

                if (inputError.mail_soushin_mb) {
                    $('#edit_mail_soushin_mb').addClass("error");
                } else {
                    $('#edit_mail_soushin_mb').removeClass("error");
                }

                if (inputError.mail_jyushin_mb) {
                    $('#edit_mail_jyushin_mb').addClass("error");
                } else {
                    $('#edit_mail_jyushin_mb').removeClass("error");
                }

                if (inputError.mail_nouhin_mb) {
                    $('#edit_mail_nouhin_mb').addClass("error");
                } else {
                    $('#edit_mail_nouhin_mb').removeClass("error");
                }

                if (inputError.mail_toiawase_mb) {
                    $('#edit_mail_toiawase_mb').addClass("error");
                } else {
                    $('#edit_mail_toiawase_mb').removeClass("error");
                }

                if (inputError.mallsoukobango1) {
                    $('#edit_mallsoukobango1').addClass("error");
                } else {
                    $('#edit_mallsoukobango1').removeClass("error");
                }

                if (inputError.datatxt0051) {
                    $('#edit_datatxt0051').addClass("error");
                } else {
                    $('#edit_datatxt0051').removeClass("error");
                }

                if (inputError.mallsoukobango2) {
                    $('#edit_mallsoukobango2').addClass("error");
                } else {
                    $('#edit_mallsoukobango2').removeClass("error");
                }

                if (inputError.mallsoukobango3) {
                    $('#edit_mallsoukobango3').addClass("error");
                } else {
                    $('#edit_mallsoukobango3').removeClass("error");
                }

                if (inputError.kaiinbango) {
                    $('#edit_kaiinbango').addClass("error");
                } else {
                    $('#edit_kaiinbango').removeClass("error");
                }

                if (inputError.zokugara) {
                    $('#edit_zokugara').addClass("error");
                } else {
                    $('#edit_zokugara').removeClass("error");
                }

                if (inputError.haisoujouhou_name) {
                    $('#edit_haisoujouhou_name').addClass("error");
                } else {
                    $('#edit_haisoujouhou_name').removeClass("error");
                }

                if (inputError.haisoujouhou_yubinbango) {
                    $('#edit_haisoujouhou_yubinbango').addClass("error");
                } else {
                    $('#edit_haisoujouhou_yubinbango').removeClass("error");
                }

                if (inputError.kcode4) {
                    $('#reg_kcode4').addClass("error");
                } else {
                    $('#reg_kcode4').removeClass("error");
                }

                if (inputError.haisoujouhou_address) {
                    $('#edit_haisoujouhou_address').addClass("error");
                } else {
                    $('#edit_haisoujouhou_address').removeClass("error");
                }

                if (inputError.haisoujouhou_tel) {
                    $('#edit_haisoujouhou_tel').addClass("error");
                } else {
                    $('#edit_haisoujouhou_tel').removeClass("error");
                }

                if (inputError.mail) {
                    $('#com_edit_mail').addClass("error");
                } else {
                    $('#com_edit_mail').removeClass("error");
                }

                if (inputError.sex) {
                    $('#edit_sex').addClass("error");
                } else {
                    $('#edit_sex').removeClass("error");
                }

                if (inputError.bunrui1) {
                    $('#edit_bunrui1').addClass("error");
                } else {
                    $('#edit_bunrui1').removeClass("error");
                }

                if (inputError.bunrui2) {
                    $('#edit_bunrui2').addClass("error");
                } else {
                    $('#edit_bunrui2').removeClass("error");
                }

                if (inputError.syukeinenkijun) {
                    $('#edit_syukeinenkijun').addClass("error");
                } else {
                    $('#edit_syukeinenkijun').removeClass("error");
                }

                if (inputError.bunrui3) {
                    $('#edit_bunrui3').addClass("error");
                } else {
                    $('#edit_bunrui3').removeClass("error");
                }

                if (inputError.datatxt0054) {
                    $('#edit_datatxt0054').addClass("error");
                } else {
                    $('#edit_datatxt0054').removeClass("error");
                }

                if (inputError.datatxt0055) {
                    $('#edit_datatxt0055').addClass("error");
                } else {
                    $('#edit_datatxt0055').removeClass("error");
                }

                if (inputError.endtime) {
                    $('#edit_endtime').addClass("error");
                } else {
                    $('#edit_endtime').removeClass("error");
                }

                if (inputError.datatxt0056) {
                    $('#edit_datatxt0056').addClass("error");
                } else {
                    $('#edit_datatxt0056').removeClass("error");
                }

                if (inputError.datatxt0057) {
                    $('#edit_datatxt0057').addClass("error");
                } else {
                    $('#edit_datatxt0057').removeClass("error");
                }

                if (inputError.syukei3) {
                    $('#edit_syukei3').addClass("error");
                } else {
                    $('#edit_syukei3').removeClass("error");
                }

                if (inputError.syukeiki) {
                    $('#edit_syukeiki').addClass("error");
                } else {
                    $('#edit_syukeiki').removeClass("error");
                }

                if (inputError.bunrui4) {
                    $('#edit_bunrui4').addClass("error");
                } else {
                    $('#edit_bunrui4').removeClass("error");
                }

                if (inputError.bunrui5) {
                    $('#edit_bunrui5').addClass("error");
                } else {
                    $('#edit_bunrui5').removeClass("error");
                }

                if (inputError.syukei2) {
                    $('#edit_syukei2').addClass("error");
                } else {
                    $('#edit_syukei2').removeClass("error");
                }

                if (inputError.bunrui9) {
                    $('#edit_bunrui9').addClass("error");
                } else {
                    $('#edit_bunrui9').removeClass("error");
                }

                if (inputError.datatxt0052) {
                    $('#edit_datatxt0052').addClass("error");
                } else {
                    $('#edit_datatxt0052').removeClass("error");
                }


            }
        }
    });

}

///////////////end edit function//////

///////////view employee detail////////////

function viewCompanyDetail(url, id) {
    $('#edit_name').attr('readonly',false);
    $('#edit_address').attr('readonly',false);
    companyEdt = 0;
    companyDeleteRetrieve = 0;
    $("#com_detail_error_data").hide();

    $("#edit_mail_soushin_abbr").html("");
    $("#edit_mail_nouhin_mb_abbr").html("");

    $("#editFrontValidation").remove();

    //tab check start here
    $("#common2").addClass('active');
    $("#common2-tab").addClass('active');
    $("#sales_billing1").removeClass('active');
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
            //var name=(result.name).split(' ');
            console.log(result);
            
            var details_yobi13_link = result.yobi13;

            $("#edit_error_data").empty();
            $("#comp_modal3 input").parent().find('input').removeClass("error");
            $("#comp_modal3 select").parent().find('select').removeClass("error");

            $('#print_exampleModalLabel').html("会社マスタ（詳細）");

            if (result.denpyosaiban == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('comp_button3').style.display = 'none';
            }

            $('#edit_hiddenBango').val(result.bango);
            $('#edit_hiddenYobi12').val(result.yobi12);
            $('#edit_yobi12').val(result.yobi12);
            $('#edit_kounyusu').val(result.kounyusu);
            $('#edit_name').val(result.name);
            $('#edit_address').val(result.address);
            if(result.yubinbango == '0 訂正不可'){
               $('#edit_name').attr('readonly',true);
               $('#edit_address').attr('readonly',true);
            }
            $('#edit_furigana').val(result.furigana);
            $('#edit_datatxt0050').val(result.datatxt0050);
            $('#edit_yubinbango').val(result.yubinbango);
            $('#edit_yobi13').val(result.yobi13_short);
            $('#edit_old_yobi13_short').val(result.yobi13_short);
            $('#edit_old_yobi13').val(result.yobi13);
            $('#edit_tel').val(result.tel==null?'':result.tel.replace(/\//g,''));
            $('#edit_bunrui6').val(result.bunrui6);
            $('#edit_fax').val(result.fax);
            $('#edit_torihikisakibango').val(result.torihikisakibango);
            $('#edit_tantousya').val(result.tantousya);
            $('#edit_kcode1').val(result.kcode1);
            $('#edit_kensakukey').val(result.kensakukey);
            $('#edit_syukeitukikijun').val(result.syukeitukikijun);
            $('#edit_syukeinen').val(result.syukeinen);
            $('#edit_kcode2').val(result.kcode2);
            $('#edit_stoiawsestart').val(result.stoiawsestart);
            $('#edit_stoiawseend').val(result.stoiawseend);
            $('#edit_stoiawsesaiban').val(result.stoiawsesaiban);
            //$('#edit_kensakukey').val(result.kensakukey);
            $('#edit_syukeituki').val(result.syukeituki == null?"":result.syukeituki.substr(0,1));
            $('#edit_syukeikikijun').val(result.syukeikikijun == null?"":result.syukeikikijun.substr(0,1));
            $('#edit_kcode3').val(result.kcode3 == null?"":result.kcode3.substr(0,1));
            $('#edit_ytoiawsestart').val(result.ytoiawsestart == null?"A831":result.ytoiawsestart);
            $('#edit_ytoiawseend').val(result.ytoiawseend == null?"A902":result.ytoiawseend);
            $('#edit_ytoiawsesaiban').val(result.ytoiawsesaiban == null?"":result.ytoiawsesaiban.substr(0,1));
            $('#edit_yetoiawsestart').val(result.yetoiawsestart == null ? 1 : result.yetoiawsestart);
            $('#edit_yetoiawseend').val((result.yetoiawseend == null || result.yetoiawseend == "")?"1":result.yetoiawseend.substr(0,1));
            $('#edit_yetoiawsesaiban').val(result.yetoiawsesaiban == null?"":result.yetoiawsesaiban.substr(0,1));
            $('#edit_mail_soushin').val(result.mail_soushin);
            $('#edit_mail_soushin_extra').val(result.mail_soushin_extra);
            $('#edit_mail_soushin_abbr').html(result.mail_soushin_extra);
            $('#edit_mail_jyushin').val((result.mail_jyushin == null || result.mail_jyushin == "")?"0":result.mail_jyushin);
            $('#edit_mail_nouhin').val(result.mail_nouhin == null?"":result.mail_nouhin.substr(0,1));
            $('#edit_mail_toiawase').val(result.mail_toiawase);
            $('#edit_mail_soushin_mb').val(result.mail_soushin_mb == null?"":result.mail_soushin_mb.substr(0,1));
            $('#edit_mail_jyushin_mb').val(result.mail_jyushin_mb == null?"":result.mail_jyushin_mb.substr(0,1));
            $('#edit_mail_nouhin_mb').val(result.mail_nouhin_mb);
            $('#edit_mail_nouhin_mb_extra').val(result.mail_nouhin_mb_extra);
            $('#edit_mail_nouhin_mb_abbr').html(result.mail_nouhin_mb_extra);
            $('#edit_mail_toiawase_mb').val(result.mail_toiawase_mb == null?"B120":result.mail_toiawase_mb);
            $('#edit_mallsoukobango1').val(result.mallsoukobango1 == null?"B21":result.mallsoukobango1);
            $('#edit_datatxt0051').val(result.datatxt0051 == null?"":result.datatxt0051.substr(0,1));
            $('#edit_mallsoukobango2').val((result.mallsoukobango2 == null ||result.mallsoukobango2 == "")?"2":result.mallsoukobango2.substr(0,1));
            $('#edit_mallsoukobango3').val(result.mallsoukobango3);
            $('#edit_domain').val(result.domain);
            $('#edit_domain2').val(result.domain2);
            $('#edit_datatxt0058').val(result.datatxt0058);
            $('#edit_datatxt0059').val(result.datatxt0059);
            $('#edit_datatxt0060').val(result.datatxt0060);
            $('#edit_datatxt0061').val(result.datatxt0061);
            $('#edit_netusername').val(result.netusername == null?"F62":result.netusername);
            $('#edit_netuserpasswd').val(result.netuserpasswd == null?"F62":result.netuserpasswd);
            $('#edit_denpyostart').val((result.denpyostart == null || result.denpyostart == "")?"2,000,000":formatNumber(result.denpyostart));
            $('#edit_netlogin').val(result.netlogin);
            $('#edit_haisoujouhou_address').val(result.haisoujouhou_address);
            $('#edit_kaiinbango').val(result.kaiinbango==null?'':result.kaiinbango.replace(/\//g,''));
            $('#edit_zokugara').val(result.zokugara==null?'':result.zokugara.replace(/\//g,''));
            $('#edit_haisoujouhou_name').val(result.haisoujouhou_name==null?'':result.haisoujouhou_name.replace(/\//g,''));
            $('#edit_haisoujouhou_yubinbango').val(result.haisoujouhou_yubinbango==null?'':result.haisoujouhou_yubinbango.replace(/\//g,''));
            $('#edit_kcode4').val((result.kcode4 == null || result.kcode4 == "")?"1 ﾕｰｻﾞｰ":result.kcode4);
            $('#edit_kcode5').val(result.kcode5);
            $('#edit_haisoujouhou_tel').val(result.haisoujouhou_tel == null?"D820":result.haisoujouhou_tel);
            $('#com_edit_mail').val(result.mail == null?"":result.mail.substr(0,1));
            $('#edit_sex').val(result.sex == null?"F931":result.sex);
            $('#edit_bunrui1').val(result.bunrui1 == null?"":result.bunrui1.substr(0,1));
            $('#edit_bunrui2').val(result.bunrui2 == null?"":result.bunrui2.substr(0,1));
            $('#edit_syukeinenkijun').val(result.syukeinenkijun);
            $('#edit_bunrui3').val(result.bunrui3 == null?"D901":result.bunrui3);
            $('#edit_datatxt0054').val(result.datatxt0054);
            $('#edit_datatxt0055').val(result.datatxt0055);
            $('#edit_endtime').val(result.endtime);
            $('#edit_datatxt0056').val(result.datatxt0056);
            $('#edit_datatxt0057').val(result.datatxt0057);
            $('#edit_syukei3').val(result.syukei3);
            $('#edit_syukeiki').val(result.syukeiki);
            $('#edit_datatxt0053').val(result.datatxt0053);
            $('#edit_bunrui4').val(result.bunrui4 == null?"E120":result.bunrui4);
            $('#edit_bunrui5').val(result.bunrui5 == null?"E21":result.bunrui5);
            $('#edit_syukei2').val(result.syukei2);
            $('#edit_bunrui9').val(result.bunrui9 == null?"":result.bunrui9.substr(0,1));
            $('#edit_bunrui10').val(result.bunrui10);
            $('#edit_datatxt0052').val(result.datatxt0052 == null?"":result.datatxt0052.substr(0,1));

            $.each(result, function (index, value) {
                if (value != null) {
                    result [index] = breakData(value);
                }

            });
            $('#comp_detail_bango').html(result.yobi12);
            $('#detail_kounyusu').html(result.kounyusu);
            $('#detail_name').html(result.name);
            $('#detail_address').html(result.address);
            $('#detail_furigana').html(result.furigana);
            $('#detail_datatxt0050').html(result.datatxt0050);
            $('#detail_yubinbango').html(result.yubinbango);

            var detail_base_url = $("#detail_base_url").val();
            var detail_yobi13_show_url = detail_base_url+'/'+details_yobi13_link;
            $("#detail_yobi13_show_url").attr('href',detail_yobi13_show_url);
            $('#detail_yobi13').html(result.yobi13_short);

            $('#detail_bunrui6').html(result.bunrui6);
            $('#detail_tel').html(result.tel);
            $('#detail_fax').html(result.fax);
            $('#detail_torihikisakibango').html(result.torihikisakibango);
            $('#detail_tantousya').html(result.tantousya_detail);
            $('#detail_kcode1').html(result.kcode1_detail);
            $('#detail_kensakukey').html(result.kensakukey);
            $('#detail_syukeitukikijun').html(result.syukeitukikijun);
            $('#detail_syukeinen').html(result.syukeinen);
            $('#detail_kcode2').html(result.kcode2_detail);
            $('#detail_stoiawsestart').html(result.stoiawsestart_detail);
            $('#detail_stoiawseend').html(result.stoiawseend_detail);
            $('#detail_stoiawsesaiban').html(result.stoiawsesaiban_detail);
            $('#detail_kensakukey').html(result.kensakukey);
            $('#detail_syukeituki').html(result.syukeituki == null?"":result.syukeituki.substr(0,1));
            $('#detail_syukeikikijun').html(result.syukeikikijun == null?"":result.syukeikikijun.substr(0,1));
            $('#detail_kcode3').html(result.kcode3 == null?"":result.kcode3.substr(0,1));
            $('#detail_ytoiawsestart').html(result.ytoiawsestart_detail);
            $('#detail_ytoiawseend').html(result.ytoiawseend_detail);
            $('#detail_ytoiawsesaiban').html(result.ytoiawsesaiban == null?"":result.ytoiawsesaiban.substr(0,1));
            $('#detail_yetoiawsestart').html(result.yetoiawsestart);
            $('#detail_yetoiawseend').html(result.yetoiawseend == null?"":result.yetoiawseend.substr(0,1));
            $('#detail_yetoiawsesaiban').html(result.yetoiawsesaiban == null?"":result.yetoiawsesaiban.substr(0,1));
            $('#detail_mail_soushin').html(result.mail_soushin);
            $('#detail_mail_soushin_extra').html(result.mail_soushin_extra);
            $('#detail_mail_jyushin').html(result.mail_jyushin);
            $('#detail_mail_nouhin').html(result.mail_nouhin == null?"":result.mail_nouhin.substr(0,1));
            $('#detail_mail_toiawase').html(result.mail_toiawase);
            $('#detail_mail_soushin_mb').html(result.mail_soushin_mb == null?"":result.mail_soushin_mb.substr(0,1));
            $('#detail_mail_jyushin_mb').html(result.mail_jyushin_mb == null?"":result.mail_jyushin_mb.substr(0,1));
            $('#detail_mail_nouhin_mb').html(result.mail_nouhin_mb);
            $('#detail_mail_nouhin_mb_extra').html(result.mail_nouhin_mb_extra);
            $('#detail_mail_toiawase_mb').html(result.mail_toiawase_mb_detail);
            $('#detail_mallsoukobango1').html(result.mallsoukobango1_detail);
            $('#detail_datatxt0051').html(result.datatxt0051 == null?"":result.datatxt0051.substr(0,1));
            $('#detail_mallsoukobango2').html(result.mallsoukobango2 == null?"":result.mallsoukobango2.substr(0,1));
            $('#detail_mallsoukobango3').html(result.mallsoukobango3);
            $('#detail_domain').html(result.domain_detail);
            $('#detail_domain2').html(result.domain2_detail);
            $('#detail_datatxt0058').html(result.datatxt0058_detail);
            $('#detail_datatxt0059').html(result.datatxt0059_detail);
            $('#detail_datatxt0060').html(result.datatxt0060_detail);
            $('#detail_datatxt0061').html(result.datatxt0061_detail);
            $('#detail_netusername').html(result.netusername_detail);
            $('#detail_netuserpasswd').html(result.netuserpasswd_detail);
            $('#detail_netlogin').html(result.netlogin_detail);
            $('#detail_denpyostart').html(formatNumber(result.denpyostart));
            $('#detail_haisoujouhou_address').html(result.haisoujouhou_address_detail);
            $('#detail_kaiinbango').html(result.kaiinbango);
            $('#detail_zokugara').html(result.zokugara);
            $('#detail_haisoujouhou_name').html(result.haisoujouhou_name);
            $('#detail_haisoujouhou_yubinbango').html(result.haisoujouhou_yubinbango);
            $('#detail_kcode4').html(result.kcode4);
            $('#detail_kcode5').html(result.kcode5_detail);
            $('#detail_haisoujouhou_tel').html(result.haisoujouhou_tel_detail);
            $('#detail_mail').html(result.mail == null?"":result.mail.substr(0,1));
            $('#detail_sex').html(result.sex_detail);
            $('#detail_bunrui1').html(result.bunrui1 == null?"":result.bunrui1.substr(0,1));
            $('#detail_bunrui2').html(result.bunrui2 == null?"":result.bunrui2.substr(0,1));
            $('#detail_syukeinenkijun').html(result.syukeinenkijun_detail);
            $('#detail_bunrui3').html(result.bunrui3_detail);
            $('#detail_datatxt0054').html(result.datatxt0054);
            $('#detail_datatxt0055').html(result.datatxt0055);
            $('#detail_endtime').html(result.endtime);
            $('#detail_datatxt0056').html(result.datatxt0056);
            $('#detail_datatxt0057').html(result.datatxt0057);
            $('#detail_syukei3').html(result.syukei3);
            $('#detail_syukeiki').html(result.syukeiki_detail);
            $('#detail_datatxt0053').html(result.datatxt0053_detail);
            $('#detail_bunrui4').html(result.bunrui4_detail);
            $('#detail_bunrui5').html(result.bunrui5_detail);
            $('#detail_syukei2').html(result.syukei2);
            $('#detail_bunrui9').html(result.bunrui9 == null?"":result.bunrui9.substr(0,1));
            $('#detail_bunrui10').html(result.bunrui10);
            $('#detail_datatxt0052').html(result.datatxt0052 == null?"":result.datatxt0052.substr(0,1));


            //disable enable tab in detail page depend on syukeituki,syukeikikijun
            if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 2) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val() == 2)) {//disable second & third tab
                $("#detail_nav_item_2").css("pointer-events", "none");
                $("#detail_nav_item_3").css("pointer-events", "none");
                $("#second_tab").css("display", "none");
                $("#third_tab").css("display", "none");
            } else if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 1) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val() == 2)) {//disable third tab
                $("#detail_nav_item_2").css("pointer-events", "auto");
                $("#detail_nav_item_3").css("pointer-events", "none");
                $("#second_tab").css("display", "initial");
                $("#third_tab").css("display", "none");
            } else if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 2) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val()) == 1) {//disable second tab
                $("#detail_nav_item_2").css("pointer-events", "none");
                $("#detail_nav_item_3").css("pointer-events", "auto");
                $("#second_tab").css("display", "none");
                $("#third_tab").css("display", "initial");
            } else {
                $("#detail_nav_item_2").css("pointer-events", "auto");
                $("#detail_nav_item_3").css("pointer-events", "auto");
                $("#second_tab").css("display", "initial");
                $("#third_tab").css("display", "initial");
            }

            //first time disable enable tab in edit page depend on syukeituki,syukeikikijun
            if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 2) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val() == 2)) {//disable second & third tab
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "none");
                $("#second_tab").css("display", "none");
                $("#third_tab").css("display", "none");
            } else if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 1) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val() == 2)) {//disable third tab
                $("#edit_nav_item_2").css("pointer-events", "auto");
                $("#edit_nav_item_3").css("pointer-events", "none");
                $("#second_tab").css("display", "initial");
                $("#third_tab").css("display", "none");
            } else if (($("#edit_syukeituki").val() != "" && $("#edit_syukeituki").val() == 2) && ($("#edit_syukeikikijun").val() != "" && $("#edit_syukeikikijun").val()) == 1) {//disable second tab
                $("#edit_nav_item_2").css("pointer-events", "none");
                $("#edit_nav_item_3").css("pointer-events", "auto");
                $("#second_tab").css("display", "none");
                $("#third_tab").css("display", "initial");
            } else {
                $("#edit_nav_item_2").css("pointer-events", "auto");
                $("#edit_nav_item_3").css("pointer-events", "auto");
                $("#second_tab").css("display", "initial");
                $("#third_tab").css("display", "initial");
            }

            //readonly fields when innerlevel>14
            enableDisableFieldEdit();

            $('#company_code_modal2').modal('show');
        }
    });
}
////////////end employee detail function///////


$("#edit_yubinbango").change(function(){
    $('#edit_name').attr('readonly',false);
    $('#edit_address').attr('readonly',false);
});


function deleteCompanyMaster(url) {
    if (companyDeleteRetrieve == '0') {
        companyDeleteRetrieve++;
        var html = getConfirmationMessage(3);
        $('#com_detail_error_data').html(html);
        $("#com_detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_hiddenBango').value;

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

function returnCompanyMaster(url) {
    if (companyDeleteRetrieve == '0') {
        companyDeleteRetrieve++;
        var html = getConfirmationMessage(4);
        $('#com_detail_error_data').html(html);
        $("#com_detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_hiddenBango').value;

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

$("#reset_button").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#lastname").val("");
    $("#office_search_button").click();

    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    $("#product_supplier_content2").removeData();
});

$("#box_popup1_comp").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    $("#company_modal4").modal('show');

    // $('.modal-backdrop').show();
});

$("#edit_box_popup1_comp").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#office_content_div_last").hide();
    $("#office_master_content_div").hide();
    $("#personal_master_content_div").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    $("#company_modal4").modal('show');

    //$("#company_modal4").modal('show');
});


$("#reset_button2").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#lastname2").val("");
    $("#office_search_button2").click();

    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    $("#product_supplier_content22").removeData();
});

$("#box_popup1_comp2").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();
    document.getElementById('choice_buttonApi').disabled = true;
    $("#company_modal42").modal('show');

    // $('.modal-backdrop').show();
});

$("#edit_box_popup1_comp2").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#office_content_div_last2").hide();
    $("#office_master_content_div2").hide();
    $("#personal_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;
    $("#company_modal42").modal('show');
});


//disable enable tab in reg page depend on syukeituki,syukeikikijun
$('#reg_syukeituki,#reg_syukeikikijun').on('keyup change', function () {
    var syukeituki = $("#reg_syukeituki").val();
    var syukeikikijun = $("#reg_syukeikikijun").val();

    if ( ((syukeituki != "" && syukeituki == 2) && (syukeikikijun != "" && syukeikikijun == 2)) || (syukeituki == "" && syukeikikijun == "") || ((syukeituki != "" && syukeituki >1) && (syukeikikijun != "" && syukeikikijun <1)) || ((syukeituki != "" && syukeituki <1) && (syukeikikijun != "" && syukeikikijun >1)) || (syukeituki == 2 && syukeikikijun == "") || (syukeituki == "" && syukeikikijun == 2) ) {//disable second & third tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if ((syukeituki != "" && syukeituki == 1) && (syukeikikijun != "" && syukeikikijun == 2)) {//disable third tab
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "none");
    } else if ( (syukeituki != "" && syukeituki == 2) && (syukeikikijun != "" && syukeikikijun == 1) ) {//disable second tab
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "auto");
    } else if ( ((syukeituki != "" && syukeituki > 2) && (syukeikikijun != "" && syukeikikijun > 2)) || (syukeituki >2 && syukeikikijun == "") || (syukeituki == "" && syukeikikijun > 2) ) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
    }else if ((syukeituki != "" && syukeituki < 1) && (syukeikikijun != "" && syukeikikijun < 1)) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
    }else if ( (syukeituki != "" && syukeituki == 1) && (syukeikikijun == "" || syukeikikijun <1 || syukeikikijun >2) ) {
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "none");
    }else if ( (syukeituki == "" || syukeituki <1 || syukeituki >2) && (syukeikikijun != "" && syukeikikijun == 1) ) {
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "auto");
    } else {
        $("#reg_nav_item_2").css("pointer-events", "auto");
        $("#reg_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "initial");
    }
});


//disable enable tab in edit page depend on syukeituki,syukeikikijun
$('#edit_syukeituki,#edit_syukeikikijun').on('keyup change', function () {
    var syukeituki = $("#edit_syukeituki").val();
    var syukeikikijun = $("#edit_syukeikikijun").val();

    if ( ((syukeituki != "" && syukeituki == 2) && (syukeikikijun != "" && syukeikikijun == 2)) || (syukeituki == "" && syukeikikijun == "") || ((syukeituki != "" && syukeituki >1) && (syukeikikijun != "" && syukeikikijun <1)) || ((syukeituki != "" && syukeituki <1) && (syukeikikijun != "" && syukeikikijun >1)) || (syukeituki == 2 && syukeikikijun == "") || (syukeituki == "" && syukeikikijun == 2)  ) {//disable second & third tab
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
        //$("#second_tab").css("display", "none");
        //$("#third_tab").css("display", "none");
    } else if ( (syukeituki != "" && syukeituki == 1) && (syukeikikijun != "" && syukeikikijun == 2) ) {//disable third tab
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "none");
    } else if ( (syukeituki != "" && syukeituki == 2) && (syukeikikijun != "" && syukeikikijun == 1) ) {//disable second tab
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "auto");
    } else if ( ((syukeituki != "" && syukeituki > 2) && (syukeikikijun != "" && syukeikikijun > 2)) || (syukeituki >2 && syukeikikijun == "") || (syukeituki == "" && syukeikikijun > 2) ) {
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
    }else if ( (syukeituki != "" && syukeituki < 1) && (syukeikikijun != "" && syukeikikijun < 1) ) {
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "none");
    }else if ( (syukeituki != "" && syukeituki == 1) && (syukeikikijun == "" || syukeikikijun <1 || syukeikikijun >2) ) {
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "none");
    }else if ( (syukeituki == "" || syukeituki <1 || syukeituki >2) && (syukeikikijun != "" && syukeikikijun == 1) ) {
        $("#edit_nav_item_2").css("pointer-events", "none");
        $("#edit_nav_item_3").css("pointer-events", "auto");
    } else {
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "auto");
        //$("#second_tab").css("display", "initial");
        //$("#third_tab").css("display", "initial");
    }
});

function goToOfficeMaster(Id,yobi12) {
    document.getElementById('kokyakubango').value = Id;
    document.getElementById('yobi12').value = yobi12;
    document.getElementById("officeTable").submit();
}

function checkTab(){
    var reg_syukeituki = $("#reg_syukeituki").val();
    var reg_syukeikikijun = $("#reg_syukeikikijun").val();
    if(reg_syukeituki == 2 && reg_syukeikikijun == 2){
        $("#reg_nav_item_2").css("pointer-events", "none");
        $("#reg_nav_item_3").css("pointer-events", "none");
    }else{
        $("#edit_nav_item_2").css("pointer-events", "auto");
        $("#edit_nav_item_3").css("pointer-events", "auto");
    }

}

//get kcode1 data depend on tantousya in reg
$('#reg_tantousya').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/company/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type:"A1"},
        success: function (data) {
            $('#reg_kcode1').html(data);
            $('#reg_kcode1').trigger('change');
        }
    });
});

//get kcode1 data depend on tantousya in edit
$('#edit_tantousya').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/company/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type:"A1"},
        success: function (data) {
            $('#edit_kcode1').html(data);
            $('#edit_kcode1').trigger('change');
        }
    });
});



function getExtraShowingData(id,bango,fillableId1,fillableId2){
    var value = $(id).val();
    var len = $(id).val().length;

    $('#'+fillableId1).val("");
    $('#'+fillableId2).html("");

    if(len == 11){
        $.ajax({
            type: "GET",
            url: '/company/getExtraShowingData/' + bango,
            data: {value: value},
            success: function (data) {
                if($.trim(data) != "not_found"){
                    $('#'+fillableId1).val($.trim(data));
                    $('#'+fillableId2).html($.trim(data));
                }
            }
        });
    }
}

//readonly field when innerlevel>14, registration
function enableDisableField(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#reg_kcode3").prop("readonly",true);
        $("#reg_ytoiawsestart:selected").prop("readonly",true);
        $("#reg_ytoiawsestart").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_ytoiawseend:selected").prop("readonly",true);
        $("#reg_ytoiawseend").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_ytoiawsesaiban").prop("readonly",true);
        $("#reg_yetoiawsestart:selected").prop("readonly",true);
        $("#reg_yetoiawsestart").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_yetoiawseend").prop("readonly",true);
        $("#reg_yetoiawsesaiban").prop("readonly",true);
        $("#reg_netusername:selected").prop("readonly",true);
        $("#reg_netusername").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_netuserpasswd:selected").prop("readonly",true);
        $("#reg_netuserpasswd").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_netlogin:selected").prop("readonly",true);
        $("#reg_netlogin").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_denpyostart").prop("readonly",true);
        $("#reg_mail_toiawase_mb:selected").prop("readonly",true);
        $("#reg_mail_toiawase_mb").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_mallsoukobango1:selected").prop("readonly",true);
        $("#reg_mallsoukobango1").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_datatxt0051").prop("readonly",true);
        $("#reg_mallsoukobango2").prop("readonly",true);
        $("#reg_mallsoukobango3").prop("readonly",true);
        $("#reg_haisoujouhou_address:selected").prop("readonly",true);
        $("#reg_haisoujouhou_address").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_haisoujouhou_tel:selected").prop("readonly",true);
        $("#reg_haisoujouhou_tel").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_mail").prop("readonly",true);
        $("#reg_sex:selected").prop("readonly",true);
        $("#reg_sex").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_bunrui1").prop("readonly",true);
        $("#reg_bunrui2").prop("readonly",true);
        $("#reg_syukeinenkijun:selected").prop("readonly",true);
        $("#reg_syukeinenkijun").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_bunrui3:selected").prop("readonly",true);
        $("#reg_bunrui3").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_datatxt0054").prop("readonly",true);
        $("#reg_datatxt0055").prop("readonly",true);
        $("#reg_endtime:selected").prop("readonly",true);
        $("#reg_endtime").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_datatxt0056").prop("readonly",true);
        $("#reg_datatxt0057").prop("readonly",true);
        $("#reg_syukei3").prop("readonly",true);
        $("#reg_syukeiki:selected").prop("readonly",true);
        $("#reg_syukeiki").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_datatxt0053:selected").prop("readonly",true);
        $("#reg_datatxt0053").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_bunrui4:selected").prop("readonly",true);
        $("#reg_bunrui4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_bunrui5:selected").prop("readonly",true);
        $("#reg_bunrui5").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_syukei2").prop("readonly",true);
        $("#reg_bunrui9").prop("readonly",true);
        $("#reg_bunrui10:selected").prop("readonly",true);
        $("#reg_bunrui10").css({'background-color':'#efefef','pointer-events':'none'});
        $("#reg_datatxt0052").prop("readonly",true);
    }
}

//readonly field when innerlevel>14, edit
function enableDisableFieldEdit(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#edit_kcode3").prop("readonly",true);
        $("#edit_ytoiawsestart:selected").prop("readonly",true);
        $("#edit_ytoiawsestart").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_ytoiawseend:selected").prop("readonly",true);
        $("#edit_ytoiawseend").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_ytoiawsesaiban").prop("readonly",true);
        $("#edit_yetoiawsestart:selected").prop("readonly",true);
        $("#edit_yetoiawsestart").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_yetoiawseend").prop("readonly",true);
        $("#edit_yetoiawsesaiban").prop("readonly",true);
        $("#edit_netusername:selected").prop("readonly",true);
        $("#edit_netusername").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_netuserpasswd:selected").prop("readonly",true);
        $("#edit_netuserpasswd").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_netlogin:selected").prop("readonly",true);
        $("#edit_netlogin").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_denpyostart").prop("readonly",true);
        $("#edit_mail_toiawase_mb:selected").prop("readonly",true);
        $("#edit_mail_toiawase_mb").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_mallsoukobango1:selected").prop("readonly",true);
        $("#edit_mallsoukobango1").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_datatxt0051").prop("readonly",true);
        $("#edit_mallsoukobango2").prop("readonly",true);
        $("#edit_mallsoukobango3").prop("readonly",true);
        $("#edit_haisoujouhou_address:selected").prop("readonly",true);
        $("#edit_haisoujouhou_address").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_haisoujouhou_tel:selected").prop("readonly",true);
        $("#edit_haisoujouhou_tel").css({'background-color':'#efefef','pointer-events':'none'});
        $("#com_edit_mail").prop("readonly",true);
        $("#edit_sex:selected").prop("readonly",true);
        $("#edit_sex").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_bunrui1").prop("readonly",true);
        $("#edit_bunrui2").prop("readonly",true);
        $("#edit_syukeinenkijun:selected").prop("readonly",true);
        $("#edit_syukeinenkijun").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_bunrui3:selected").prop("readonly",true);
        $("#edit_bunrui3").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_datatxt0054").prop("readonly",true);
        $("#edit_datatxt0055").prop("readonly",true);
        $("#edit_endtime:selected").prop("readonly",true);
        $("#edit_endtime").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_datatxt0056").prop("readonly",true);
        $("#edit_datatxt0057").prop("readonly",true);
        $("#edit_syukei3").prop("readonly",true);
        $("#edit_syukeiki:selected").prop("readonly",true);
        $("#edit_syukeiki").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_datatxt0053:selected").prop("readonly",true);
        $("#edit_datatxt0053").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_bunrui4:selected").prop("readonly",true);
        $("#edit_bunrui4").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_bunrui5:selected").prop("readonly",true);
        $("#edit_bunrui5").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_syukei2").prop("readonly",true);
        $("#edit_bunrui9").prop("readonly",true);
        $("#edit_bunrui10:selected").prop("readonly",true);
        $("#edit_bunrui10").css({'background-color':'#efefef','pointer-events':'none'});
        $("#edit_datatxt0052").prop("readonly",true);
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

$("#reg_denpyostart,#edit_denpyostart").focusout(function(){
    var val = commaReplace($(this).val());
    val = formatNumber(val);
    $(this).val(val);
});

$("#reg_denpyostart,#edit_denpyostart").focusin(function(){
    var val = commaReplace($(this).val());
    $(this).val(val);
});