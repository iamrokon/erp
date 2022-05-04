//disable reg button when innerlevel>14
$(document).ready(function(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#common_reg_button").addClass('disabled');
        $("#common_reg_button").css({'pointer-events':'none'});
    }
});

var productReg = 0;
var productEdit = 0;
var prodtDeleteRetrieve = 0;

function openRegistration() {
    productReg = 0;
    $("#r_url_mobile").css('display', 'none');

    $("#reg_jyougensu").val("");
    $("#reg_jyougensuDiv").html("");
    $("#reg_yoyaku").val("");
    $("#reg_yoyakuDiv").html("");
    $("#modal_type").val("reg");
    
    $("#regFrontValidation").remove();

    //reset submit confirmation
    $("#submit_confirmation").val("");

    $('#registrationForm').trigger("reset");
    $("#error_data").hide();
    $('.error').each(function () {
        if (this.classList.contains("error")) {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });
    $('#reg_jouhou').trigger("change");
    $('#registrationModal').modal('show');
}

/////////registration function///////////////
function registerProduct(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }
    
   
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();

    var data = $('#registrationForm').serialize();
    if(field!=null){
        data = data+"&field="+field;
    }else{
        document.getElementById('regButton').disabled = true;
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            //console.log(result);
            if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                //location.reload();
                // document.getElementById("productMasterReload").click();
                input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                jQuery('#navbarForm').append(input);
                $("#productMasterReload").trigger("click");
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#error_data").html(confirmationMsg);
                document.getElementById('regButton').disabled = false;
            } else {
                var jyougensu = $("#reg_jyougensu").val();
                var kakaku_yoyaku = $("#reg_yoyaku").val();

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
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_data').html(html);

                    if (true) {
                    }
                    $("#error_data").show();
                }

                if (inputError.kokyakusyouhinbango) {
                    $('#reg_kokyakusyouhinbango').addClass("error");
                } else {
                    $('#reg_kokyakusyouhinbango').removeClass("error");
                }

                if (inputError.name) {
                    $('#reg_name').addClass("error");
                } else {
                    $('#reg_name').removeClass("error");
                }

                if (inputError.jouhou) {
                    $('#reg_jouhou').addClass("error");
                } else {
                    $('#reg_jouhou').removeClass("error");
                }


                if (inputError.koyuujouhou) {
                    $('#reg_koyuujouhou').addClass("error");
                } else {
                    $('#reg_koyuujouhou').removeClass("error");
                }

                if (inputError.color) {
                    $('#reg_color').addClass("error");
                } else {
                    $('#reg_color').removeClass("error");
                }

                if (inputError.data23) {
                    $('#reg_data23').addClass("error");
                } else {
                    $('#reg_data23').removeClass("error");
                }

                if (inputError.size) {
                    $('#reg_size').addClass("error");
                } else {
                    $('#reg_size').removeClass("error");
                }

                if (inputError.jouhou2) {
                    $('#reg_jouhou2').addClass("error");
                } else {
                    $('#reg_jouhou2').removeClass("error");
                }

                if (inputError.chardata4) {
                    $('#reg_chardata4').addClass("error");
                } else {
                    $('#reg_chardata4').removeClass("error");
                }

                if (inputError.kakaku) {
                    $('#reg_kakaku').addClass("error");
                } else {
                    $('#reg_kakaku').removeClass("error");
                }

                if (inputError.hanbaisu) {
                    $('#reg_hanbaisu').addClass("error");
                } else {
                    $('#reg_hanbaisu').removeClass("error");
                }

                if (inputError.jyougensu) {
                    $('#reg_jyougensu').addClass("error");
                } else {
                    $('#reg_jyougensu').removeClass("error");
                }

                if (inputError.yoyaku) {
                    $('#reg_syouhin1_yoyaku').addClass("error");
                } else {
                    $('#reg_syouhin1_yoyaku').removeClass("error");
                }

                if (inputError.kakaku_yoyaku) {
                    $('#reg_yoyaku').addClass("error");
                } else {
                    $('#reg_yoyaku').removeClass("error");
                }

                //if (inputError.yoyakusu || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.yoyakusu) {
                    $('#reg_yoyakusu').addClass("error");
                } else {
                    $('#reg_yoyakusu').removeClass("error");
                }

                //if (inputError.yoyakukanousu || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.yoyakukanousu) {
                    $('#reg_yoyakukanousu').addClass("error");
                } else {
                    $('#reg_yoyakukanousu').removeClass("error");
                }

                //if (inputError.sortbango || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.sortbango) {
                    $('#reg_sortbango').addClass("error");
                } else {
                    $('#reg_sortbango').removeClass("error");
                }

                //if (inputError.dataint01 || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.dataint01) {
                    $('#reg_dataint01').addClass("error");
                } else {
                    $('#reg_dataint01').removeClass("error");
                }

                if (inputError.data25) {
                    $('#reg_data25').addClass("error");
                } else {
                    $('#reg_data25').removeClass("error");
                }

                if (inputError.synchrosyouhinbango) {
                    $('#reg_synchrosyouhinbango').addClass("error");
                } else {
                    $('#reg_synchrosyouhinbango').removeClass("error");
                }

                if (inputError.endtime) {
                    $('#reg_endtime').addClass("error");
                } else {
                    $('#reg_endtime').removeClass("error");
                }

                if (inputError.data52) {
                    $('#reg_data52').addClass("error");
                } else {
                    $('#reg_data52').removeClass("error");
                }

                if (inputError.data100) {
                    $('#reg_data100').addClass("error");
                } else {
                    $('#reg_data100').removeClass("error");
                }

                if (inputError.data29) {
                    $('#reg_data29').addClass("error");
                } else {
                    $('#reg_data29').removeClass("error");
                }

                if (inputError.url) {
                    $('#reg_url').addClass("error");
                } else {
                    $('#reg_url').removeClass("error");
                }

                if (inputError.data26) {
                    $('#reg_data26').addClass("error");
                } else {
                    $('#reg_data26').removeClass("error");
                }

                if (inputError.data101) {
                    $('#reg_data101').addClass("error");
                } else {
                    $('#reg_data101').removeClass("error");
                }

                if (inputError.kongouritsu) {
                    $('#reg_kongouritsu').addClass("error");
                } else {
                    $('#reg_kongouritsu').removeClass("error");
                }

                if (inputError.mdjouhou) {
                    $('#reg_mdjouhou').addClass("error");
                } else {
                    $('#reg_mdjouhou').removeClass("error");
                }

                if (inputError.konpoumei) {
                    $('#reg_konpoumei').addClass("error");
                } else {
                    $('#reg_konpoumei').removeClass("error");
                }

            }
        }
    });
}

///////////////end registration function//////


//remove error class at the first time edit page open
$("#productButton3").click(function () {
    $('.error').each(function () {
        if (this.classList.contains("error")) {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });
    $("#modal_type").val("edit");
});

/////////edit function///////////////

function editProduct(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }
    
    //submit confirmation check
    var submit_confirmation = $("#submit_confirmation").val();

    var data = $('#editForm').serialize();
    if(field!=null){
        data = data+"&field="+field;
    }else{
        document.getElementById('editButton').disabled = true;
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data+"&submit_confirmation="+submit_confirmation,
        success: function (result) {
            console.log(result);
            if ($.trim(result.status) == 'ok' || $.trim(result.status) == 'ng') {
                //$('#product_code_modal3').modal('hide');
                //location.reload();
                input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                jQuery('#navbarForm').append(input);
                $("#productMasterReload").trigger("click");
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
                $(document).find("#edit_error_data").html(confirmationMsg);
                document.getElementById('editButton').disabled = false;
            } else {
                var jyougensu = $("#edit_jyougensu").val();
                var kakaku_yoyaku = $("#edit_yoyaku").val();

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
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#edit_error_data').html(html);

                    if (true) {
                    }
                    $("#edit_error_data").show();
                }

                if (inputError.kokyakusyouhinbango) {
                    $('#edit_kokyakusyouhinbango').addClass("error");
                } else {
                    $('#edit_kokyakusyouhinbango').removeClass("error");
                }

                if (inputError.name) {
                    $('#edit_name').addClass("error");
                } else {
                    $('#edit_name').removeClass("error");
                }

                if (inputError.jouhou) {
                    $('#edit_jouhou').addClass("error");
                } else {
                    $('#edit_jouhou').removeClass("error");
                }

                if (inputError.koyuujouhou) {
                    $('#edit_koyuujouhou').addClass("error");
                } else {
                    $('#edit_koyuujouhou').removeClass("error");
                }

                if (inputError.color) {
                    $('#edit_color').addClass("error");
                } else {
                    $('#edit_color').removeClass("error");
                }

                if (inputError.data23) {
                    $('#edit_data23').addClass("error");
                } else {
                    $('#edit_data23').removeClass("error");
                }

                if (inputError.size) {
                    $('#edit_size').addClass("error");
                } else {
                    $('#edit_size').removeClass("error");
                }

                if (inputError.jouhou2) {
                    $('#edit_jouhou2').addClass("error");
                } else {
                    $('#edit_jouhou2').removeClass("error");
                }

                if (inputError.chardata4) {
                    $('#edit_chardata4').addClass("error");
                } else {
                    $('#edit_chardata4').removeClass("error");
                }

                if (inputError.kakaku) {
                    $('#edit_kakaku').addClass("error");
                } else {
                    $('#reg_kakaku').removeClass("error");
                }

                if (inputError.hanbaisu) {
                    $('#edit_hanbaisu').addClass("error");
                } else {
                    $('#reg_hanbaisu').removeClass("error");
                }

                if (inputError.jyougensu) {
                    $('#edit_jyougensu').addClass("error");
                } else {
                    $('#edit_jyougensu').removeClass("error");
                }

                if (inputError.yoyaku) {
                    $('#edit_syouhin1_yoyaku').addClass("error");
                } else {
                    $('#edit_syouhin1_yoyaku').removeClass("error");
                }

                if (inputError.kakaku_yoyaku) {
                    $('#edit_yoyaku').addClass("error");
                } else {
                    $('#edit_yoyaku').removeClass("error");
                }

                //if (inputError.yoyakusu || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.yoyakusu) {
                    $('#edit_yoyakusu').addClass("error");
                } else {
                    $('#edit_yoyakusu').removeClass("error");
                }

                //if (inputError.yoyakukanousu || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.yoyakukanousu) {
                    $('#edit_yoyakukanousu').addClass("error");
                } else {
                    $('#edit_yoyakukanousu').removeClass("error");
                }

                //if (inputError.sortbango || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.sortbango) {
                    $('#edit_sortbango').addClass("error");
                } else {
                    $('#edit_sortbango').removeClass("error");
                }

                //if (inputError.dataint01 || jyougensu < 0 || kakaku_yoyaku < 0) {
                if (inputError.dataint01) {
                    $('#edit_dataint01').addClass("error");
                } else {
                    $('#edit_dataint01').removeClass("error");
                }

                if (inputError.data25) {
                    $('#edit_data25').addClass("error");
                } else {
                    $('#edit_data25').removeClass("error");
                }

                if (inputError.synchrosyouhinbango) {
                    $('#edit_synchrosyouhinbango').addClass("error");
                } else {
                    $('#edit_synchrosyouhinbango').removeClass("error");
                }

                if (inputError.endtime) {
                    $('#edit_endtime').addClass("error");
                } else {
                    $('#edit_endtime').removeClass("error");
                }

                if (inputError.data52) {
                    $('#edit_data52').addClass("error");
                } else {
                    $('#edit_data52').removeClass("error");
                }
                
                if (inputError.data100) {
                    $('#edit_data100').addClass("error");
                } else {
                    $('#edit_data100').removeClass("error");
                }
                
                if (inputError.data29) {
                    $('#edit_data29').addClass("error");
                } else {
                    $('#edit_data29').removeClass("error");
                }
                
                if (inputError.url) {
                    $('#edit_url').addClass("error");
                } else {
                    $('#edit_url').removeClass("error");
                }

                if (inputError.data26) {
                    $('#edit_data26').addClass("error");
                } else {
                    $('#edit_data26').removeClass("error");
                }

                if (inputError.data101) {
                    $('#edit_data101').addClass("error");
                } else {
                    $('#edit_data101').removeClass("error");
                }

                if (inputError.data102) {
                    $('#edit_data102').addClass("error");
                } else {
                    $('#edit_data102').removeClass("error");
                }

                if (inputError.data103) {
                    $('#edit_data103').addClass("error");
                } else {
                    $('#edit_data103').removeClass("error");
                }

                if (inputError.name2) {
                    $('#edit_name2').addClass("error");
                } else {
                    $('#edit_name2').removeClass("error");
                }

                if (inputError.kongouritsu) {
                    $('#edit_kongouritsu').addClass("error");
                } else {
                    $('#edit_kongouritsu').removeClass("error");
                }

                if (inputError.mdjouhou) {
                    $('#edit_mdjouhou').addClass("error");
                } else {
                    $('#edit_mdjouhou').removeClass("error");
                }

                if (inputError.konpoumei) {
                    $('#edit_konpoumei').addClass("error");
                } else {
                    $('#edit_konpoumei').removeClass("error");
                }


            }
        }
    });
}

///////////////end edit function//////

///////////view employee detail////////////

function viewProductDetail(url, id, bango) {
    productEdit = 0;
    prodtDeleteRetrieve = 0;
    $("#detail_product_error_data").hide();
    
    //disable edit button when innerlevel>14
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#productButton3").addClass('disabled');
        $("#productButton3").css({'pointer-events':'none'});
    }
    
    //remove front validation field when initial open
    $("#editFrontValidation").remove();

    //get C5 list when first open edit page
    //getC5List(bango);
    //get C6 list when first open edit page
    //getC6List(bango);

    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (response) {
            //var name=(result.name).split(' ');
            console.log(response);
            
            $('#edit_koyuujouhou').html(response.koyuujouhou_html);
            //$('#edit_koyuujouhou').trigger('change');
            $('#edit_color').html(response.color_html);
            $('#edit_color').trigger('change');
            var result = response.data;

            $("#edit_error_data").empty();
            $("#product_code_modal3 input").parent().find('input').removeClass("error");

            $('#print_exampleModalLabel').html("商品マスタ(詳細)");

            if (result.isuriage == 1)
            {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('productButton3').style.display = 'none';
            }

            $('#edit_hiddenBango').val(result.bango);
            $('#edit_kokyakusyouhinbango').val(result.kokyakusyouhinbango);
            $('#edit_name').val(result.name);
            if(result.data24 == '0 訂正不可'){
               $('#edit_name').attr('readonly',true);
               $('#edit_size').attr('readonly',true);
            }
            $('#edit_jouhou').val(result.jouhou);
            $('#edit_koyuujouhou').val(result.koyuujouhou);
            setTimeout(function(){
                $('#edit_color').val(result.color);
                $('#edit_color').trigger('change');
            }, 2000);
            $('#edit_bumon').val(result.bumon);
            //$('#edit_syouhin1_yoyaku').val(result.jouhou2);
            $('#edit_data21').val(result.data21);
            $('#edit_tokuchou').val(result.tokuchou);
            $('#edit_data22').val(result.data22);
            $('#edit_data23').val(result.data23);
            $('#edit_size').val(result.size);
            $('#edit_data24').val(result.data24);
            $('#edit_season').val(result.season);
            $('#edit_kakaku').val(result.kakaku);
            $('#edit_hanbaisu').val(result.hanbaisu);
            $('#edit_jyougensu').val(result.jyougensu);
            $('#edit_jyougensuDiv').html(result.jyougensu);
            $('#edit_yoyaku').val(result.kakaku_yoyaku);
            $('#edit_yoyakuDiv').html(result.kakaku_yoyaku);
            $('#edit_jouhou2').val(result.product_data20);
            $('#edit_yoyakusu').val(result.yoyakusu);
            $('#edit_yoyakukanousu').val(result.yoyakukanousu);
            $('#edit_sortbango').val(result.sortbango);
            $('#edit_dataint01').val(result.dataint01);
            if(result.data25 == '0 訂正不可'){
               $('#edit_kakaku').attr('readonly',true);
               $('#edit_hanbaisu').attr('readonly',true);
               $('#edit_yoyakusu').attr('readonly',true);
               $('#edit_yoyakukanousu').attr('readonly',true);
               $('#edit_sortbango').attr('readonly',true);
               $('#edit_dataint01').attr('readonly',true);
            }
            $('#edit_meker').val(result.meker);
            $('#edit_konpoumei').val(result.konpoumei);
            $('#edit_data25').val(result.data25);
            $('#edit_synchrosyouhinbango').val(result.synchrosyouhinbango_detail==null?'':result.synchrosyouhinbango_detail.replace(/\//g,''));
            $('#edit_endtime').val(result.endtime_detail==null?'':result.endtime_detail.replace(/\//g,''));
            $('#edit_data52').val(result.data52);
            $('#edit_data53').val(result.data53);
            $('#edit_data54').val(result.data54);
            $('#edit_data100').val(result.data100);
            $('#edit_data50').val(result.data50);
            $('#edit_data51').val(result.data51);
            $('#edit_data26').val(result.data26);
            $('#edit_data27').val(result.data27);
            $('#edit_data28').val(result.data28);
            $('#edit_data29').val(result.data29);
            $('#edit_url').val(result.url);
            $('#edit_syouhin1_yoyaku').val(result.jouhou2);
            $('#edit_url_mobile').val(result.url_mobile);
            $('#edit_chardata4').val(result.chardata4);
            $('#edit_data101').val(result.data101);
            $('#edit_kongouritsu').val(result.product_kongouritsu);
            $('#edit_mdjouhou').val(result.mdjouhou);
            $('#edit_data104').val(result.data104);
            $('#edit_dspbango').val(result.dspbango);
            $('#edit_syouhin4_color').val(result.s4_color);
            $('#edit_syouhin4_size').val(result.s4_size);
            $('#edit_syouhingroup').val(result.syouhingroup);
            $('#edit_ruijihinbango').val(result.ruijihinbango);
            $('#edit_chardata1').val(result.chardata1);
            $('#edit_chardata2').val(result.chardata2);

            $.each(result, function (index, value) {
                if (value != null) {
                    result [index] = breakData(value);
                }
            });
//          $('#detail_ztanka').html(result.ztanka);
            $('#detail_kokyakusyouhinbango').html(result.kokyakusyouhinbango);
            $('#detail_name').html(result.name);
            $('#detail_jouhou').html(result.jouhou_detail);
            $('#detail_koyuujouhou').html(result.koyuujouhou_detail);
            $('#detail_color').html(result.color_detail);
            $('#detail_bumon').html(result.bumon_detail);
            $('#detail_jouhou2').html(result.product_data20);
            $('#detail_data21').html(result.data21);
            $('#detail_tokuchou').html(result.tokuchou);
            $('#detail_data22').html(result.data22);
            $('#detail_data23').html(result.data23);
            $('#detail_size').html(result.size);
            $('#detail_data24').html(result.data24);
            $('#detail_season').html(result.season);
            $('#detail_kakaku').html(formatNumber(result.kakaku));
            $('#detail_hanbaisu').html(formatNumber(result.hanbaisu));
            $('#detail_jyougensu').html(formatNumber(result.jyougensu));
            $('#detail_yoyaku').html(formatNumber(result.kakaku_yoyaku));
            $('#detail_yoyakusu').html(formatNumber(result.yoyakusu));
            $('#detail_yoyakukanousu').html(formatNumber(result.yoyakukanousu));
            $('#detail_sortbango').html(formatNumber(result.sortbango));
            $('#detail_dataint01').html(formatNumber(result.dataint01));
            $('#detail_meker').html(result.meker);
            $('#detail_konpoumei').html(result.konpoumei);
            $('#detail_data25').html(result.data25);
            $('#detail_synchrosyouhinbango').html(result.synchrosyouhinbango_detail);
            $('#detail_endtime').html(result.endtime_detail);
            $('#detail_data52').html(result.data52_detail);
            $('#detail_data53').html(result.data53_detail);
            $('#detail_data54').html(result.data54_detail);
            $('#detail_data100').html(result.data100_detail);
            $('#detail_data50').html(result.data50);
            $('#detail_data51').html(result.data51);
            $('#detail_data26').html(result.data26_detail);
            $('#detail_data27').html(result.data27);
            $('#detail_data28').html(result.data28_detail);
            $('#detail_data29').html(result.data29_detail);
            $('#detail_url').html(result.url_detail);
            $('#detail_syouhin1_yoyaku').html(result.jouhou2_detail);
            $('#detail_url_mobile').html(result.url_mobile_detail);
            $('#detail_chardata4').html(result.chardata4);
            $('#detail_data101').html(result.data101_detail);
            $('#detail_kongouritsu').html(result.product_kongouritsu);
            $('#detail_mdjouhou').html(result.mdjouhou);
            $('#detail_data104').html(result.data104);
            $('#detail_dspbango').html(result.dspbango_detail);
            $('#detail_syouhin4_color').html(result.s4_color_detail);
            $('#detail_syouhin4_size').html(result.s4_size_detail);
            $('#detail_syouhingroup').html(result.syouhingroup_detail);
            $('#detail_ruijihinbango').html(result.ruijihinbango_detail);
            $('#detail_chardata1').html(result.chardata1_detail);
            $('#detail_chardata2').html(result.chardata2_detail);
            
            if (result.syouhinbango != null) {
                $(".productButton3").show();
            }else{
                $(".productButton3").hide();
            }

            var edata21 = $("#edit_data21").val();
            if (edata21 != null && edata21.substr(0,1) == 1) {
                $("#e_url_mobile").css('display', 'flex');
                $("#d_url_mobile").css('display', 'flex');
                $("#p_url_mobile").css('display', 'flex');
            } else {
                $("#e_url_mobile").css('display', 'none');
                $("#d_url_mobile").css('display', 'none');
                $("#p_url_mobile").css('display', 'none');
            }

            $('#product_code_modal2').modal('show');
        }
    });
}

$("#edit_data24").change(function(){
    $('#edit_name').attr('readonly',false);
    $('#edit_size').attr('readonly',false);
});

$("#edit_data25").change(function(){
    $('#edit_kakaku').attr('readonly',false);
    $('#edit_hanbaisu').attr('readonly',false);
    $('#edit_yoyakusu').attr('readonly',false);
    $('#edit_yoyakukanousu').attr('readonly',false);
    $('#edit_sortbango').attr('readonly',false);
    $('#edit_dataint01').attr('readonly',false);
});


function deleteProductMaster(url) {
    if (prodtDeleteRetrieve == '0') {
        prodtDeleteRetrieve++;
        var html = getConfirmationMessage(3);
        $('#detail_product_error_data').html(html);
        $("#detail_product_error_data").show();

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

function returnProductMaster(url) {
    if (prodtDeleteRetrieve == '0') {
        prodtDeleteRetrieve++;
        var html = getConfirmationMessage(4);
        $('#detail_product_error_data').html(html);
        $("#detail_product_error_data").show();

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


// $('#tableSettingSubmit').click(function() {
//    var error=0;
//    var largeNumber=0;
//    $("#setting_display_modal input").parent().find('input').removeClass("error");
//
//    var Things=['name','jouhou_detail','koyuujouhou_detail','color_detail','bumon','syouhin1_yoyaku',
//    'data21','tokuchou','data22','data23','size','data24','season','kakaku',
//    'hanbaisu','jyougensu','kakaku_yoyaku','yoyakusu','yoyakukanousu','sortbango',
//    'dataint01','data25','data52_detail','data53_detail','data54_detail','data100_detail','data50',
//    'data51','synchrosyouhinbango_detail','endtime_detail','data27','data28_detail','data29','data101',
//    'data102','data103','name2','url','data20','url_mobile','kongouritsu',
//    'mdjouhou','meker','konpoumei','data104','created_date','created_time','edited_date','edited_time',
//    'code3','user_name'
//    ];
//
//    for (var i = 0; i < Things.length; i++)
//    {
//      if($("#check_"+Things[i]).prop('checked') != true && $("#setting_"+Things[i]).val() != "")
//       {
//         error++;
//        // console.log(Things[i])
//         $('#setting_'+Things[i]).addClass("error");
//       }
//       if ($('#setting_'+Things[i]).val() > 98)
//       {
//         largeNumber++;
//         $('#setting_'+Things[i]).addClass("error");
//       }
//    }
//
//     if(error > 0 && largeNumber > 0)
//     {
//
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
//                  '<br>'+ '98以下の数値を入力してください。'+ '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//
//     else if (largeNumber>0 && error == 0)
//      {
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '98以下の数値を入力してください。' + '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//      }
//     else if(error > 0 && largeNumber == 0)
//     {
//         $('#errorShow').empty();
//         html = '<div>';
//         html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' + '</p>';
//         html += '</div>';
//
//         $('#errorShow').html(html);
//     }
//
//
//
//     else
//     {
//         $('#errorShow').empty();
//         saveTableSetting("productMasterReload");
//     }
//
// });


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

$("#reset_button2").on("click", function () {
    $('.show_office_master_info').removeClass('add_border');
    $("#lastname2").val("");
    $("#office_search_button2").click();

    $("#product_content_div_last2").hide();
    $("#product_master_content_div2").hide();
    $("#office_master_content_div2").hide();
    document.getElementById('choice_buttonApi2').disabled = true;

    $("#product_supplier_content2").removeData();
});


function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}


$("#reg_data21").change(function () {
    var data21 = $("#reg_data21").val();
    if (data21.substr(0,1) == 1) {
        $("#r_url_mobile").css('display', 'flex');
    } else {
        $("#r_url_mobile").css('display', 'none');
    }
});

$("#edit_data21").change(function () {
    var edata21 = $("#edit_data21").val();
    if (edata21.substr(0,1) == 1) {
        $("#e_url_mobile").css('display', 'flex');
    } else {
        $("#e_url_mobile").css('display', 'none');
    }
});

$('#reg_jouhou').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "C5"},
        success: function (data) {
            $('#reg_koyuujouhou').html(data);
            $('#reg_koyuujouhou').trigger('change');
        }
    });


    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "E7"},
        success: function (data) {
            $('#reg_bumon').html(data);
            $('#reg_bumon').trigger('change');
        }
    });

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "E6"},
        success: function (data) {
            $('#reg_syouhin1_yoyaku').html(data);
            $('#reg_syouhin1_yoyaku').trigger('change');
        }
    });

});


$('#reg_koyuujouhou').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C5"},
        success: function (data) {
            $('#reg_color').html(data);
            $('#reg_color').trigger('change');
        }
    });
});


$('#editForm #edit_jouhou').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "C5"},
        success: function (data) {
            $('#editForm #edit_koyuujouhou').html(data);
            $('#editForm #edit_koyuujouhou').trigger('change');
        }
    });

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "E7"},
        success: function (data) {
            $('#editForm #edit_bumon').html(data);
            $('#editForm #edit_bumon').trigger('change');
        }
    });

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "E6"},
        success: function (data) {
            $('#editForm #edit_syouhin1_yoyaku').html(data);
            $('#editForm #edit_syouhin1_yoyaku').trigger('change');
        }
    });

});

$('#editForm #edit_koyuujouhou').on('change', function () {
    var bango = $(this).data('bango');
    var seleted_option = $(this).children('option:selected');
    var category_type = seleted_option.data('categorytype');
    var category_value = seleted_option.data('categoryvalue');

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C5"},
        success: function (data) {
            $('#editForm #edit_color').html(data);
            $('#editForm #edit_color').trigger('change');
        }
    });
});


$('#reg_chardata4').on('keyup', function () {
    var bango = $(this).data('bango');
    var kokyakusyouhinbango = $(this).val();

    $.ajax({
        type: "GET",
        url: '/product/getSyouhinName/' + bango,
        data: {kokyakusyouhinbango: kokyakusyouhinbango},
        success: function (data) {
            if (typeof (data.name) === "undefined") {
                $('#reg_syouhin_name').html("");
            } else {
                $('#reg_syouhin_name').html(data.name);
            }
        }
    });
});

$('#edit_chardata4').on('keyup', function () {
    var bango = $(this).data('bango');
    var kokyakusyouhinbango = $(this).val();

    $.ajax({
        type: "GET",
        url: '/product/getSyouhinName/' + bango,
        data: {kokyakusyouhinbango: kokyakusyouhinbango},
        success: function (data) {
            if (typeof (data.name) === "undefined") {
                $('#edit_syouhin_name').html("");
            } else {
                $('#edit_syouhin_name').html(data.name);
            }
        }
    });
});


function getC4List(bango) {
    var category_type = "";
    var category_value = "";

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "C4"},
        success: function (data) {
            $('#editForm #edit_koyuujouhou').html(data);
            $('#editForm #edit_koyuujouhou').trigger('change');
        }
    });
}

//get C5 list when first open edit page
function getC5List(bango) {
    var category_type = "";
    var category_value = "";

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C4", currentCategory: "C5"},
        success: function (data) {
            $('#editForm #edit_koyuujouhou').html(data);
            // $('#editForm #edit_koyuujouhou').trigger('change');
        }
    });
}

//get C6 list when first open edit page
function getC6List(bango) {
    var category_type = "";
    var category_value = "";

    $.ajax({
        type: "GET",
        url: '/product/categoryWiseCategory/' + bango,
        data: {category_type: category_type, category_value: category_value, type: "C5"},
        success: function (data) {
            $('#editForm #edit_color').html(data);
            $('#editForm #edit_color').trigger('change');
        }
    });
}
