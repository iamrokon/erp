var projectReg = 0;
var projectEdit = 0;
var projtDeleteRetrieve = 0;

function openRegistration() {
    projectReg = 0;

    $("#regFrontValidation").remove();

    $('#registrationForm').trigger("reset");
    $("#reg_catchsm").val("");
    $("#reg_caption").val("");
    
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
function registerProject(url,field) {
    //IE support
    if(field == undefined){
        field = null;
    }
    
    //if (projectReg == '0' && field==null) {
    //    projectReg++;
    //    var html = getConfirmationMessage(1);
    //    $('#error_data').html(html);
    //    $("#error_data").show();
    //} else {
    
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
                    $("#projectRegistrationReload").trigger("click");
                }else if ($.trim(result) == 'confirmation_msg'){
                    $("#submit_confirmation").val('submit');
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
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
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';

                        $('#error_data').html(html);

                        if (true) {
                        }
                        $("#error_data").show();
                    }

                    if (inputError.url) {
                        $('#reg_url').addClass("error");
                    } else {
                        $('#reg_url').removeClass("error");
                    }

                    if (inputError.urlsm) {
                        $('#reg_urlsm').addClass("error");
                    } else {
                        $('#reg_urlsm').removeClass("error");
                    }

                    if (inputError.catchsm) {
                        $('#reg_catchsm_gp').addClass("error");
                    } else {
                        $('#reg_catchsm_gp').removeClass("error");
                    }

                    if (inputError.setumei) {
                        $('#reg_setumei').addClass("error");
                    } else {
                        $('#reg_setumei').removeClass("error");
                    }
                    
                    if (inputError.mbcatch) {
                        $('#reg_mbcatch').addClass("error");
                    } else {
                        $('#reg_mbcatch').removeClass("error");
                    }
                    
                    if (inputError.mbcatchsm) {
                        $('#reg_mbcatchsm').addClass("error");
                    } else {
                        $('#reg_mbcatchsm').removeClass("error");
                    }
                    
                    if (inputError.mbcaption) {
                        $('#reg_mbcaption').addClass("error");
                    } else {
                        $('#reg_mbcaption').removeClass("error");
                    }
                    
                }
            }
        });
    //}
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
});

/////////edit function///////////////

function editProject(url,field) { 
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
                input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                jQuery('#navbarForm').append(input);
                $("#projectRegistrationReload").trigger("click");
            }else if ($.trim(result) == 'confirmation_msg'){
                $("#submit_confirmation").val('submit');
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 16px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
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
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#edit_error_data').html(html);

                    if (true) {
                    }
                    $("#edit_error_data").show();
                }

                if (inputError.urlsm) {
                    $('#edit_urlsm').addClass("error");
                } else {
                    $('#edit_urlsm').removeClass("error");
                }

                if (inputError.catchsm) {
                    $('#edit_catchsm_gp').addClass("error");
                } else {
                    $('#edit_catchsm_gp').removeClass("error");
                }

                if (inputError.caption) {
                    $('#edit_caption').addClass("error");
                } else {
                    $('#edit_caption').removeClass("error");
                }

                if (inputError.setumei) {
                    $('#edit_setumei').addClass("error");
                } else {
                    $('#edit_setumei').removeClass("error");
                }

                if (inputError.catch) {
                    $('#edit_catch').addClass("error");
                } else {
                    $('#edit_catch').removeClass("error");
                }

                if (inputError.mbcatch) {
                    $('#edit_mbcatch').addClass("error");
                } else {
                    $('#edit_mbcatch').removeClass("error");
                }

                if (inputError.mbcatchsm) {
                    $('#edit_mbcatchsm').addClass("error");
                } else {
                    $('#edit_mbcatchsm').removeClass("error");
                }

                if (inputError.mbcaption) {
                    $('#edit_mbcaption').addClass("error");
                } else {
                    $('#edit_mbcaption').removeClass("error");
                }

            }
        }
    });
    
}

///////////////end edit function//////

///////////view project detail////////////

function viewProjectDetail(url, id, bango) {
    projectEdit = 0;
    projtDeleteRetrieve = 0;
    $("#detail_project_error_data").hide();
    
    //remove front validation field when initial open
    $("#editFrontValidation").remove();

    $.ajax({
        type: 'get',
        url: url,
        data: {id: id},
        success: function (result) {
            console.log(result);

            $("#edit_error_data").empty();
            $("#project_edit_modal input").parent().find('input').removeClass("error");

            //$('#print_exampleModalLabel').html("商品マスタ(詳細)");

            if (result.hyouji == 1)
            {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('projectButton3').style.display = 'none';
            }

            $('#edit_hiddenBango').val(result.datatxt0098);
            $('#edit_url').val(result.url);
            $('#edit_urlsm').val(result.urlsm);
            $('#edit_show_catchsm').val(result.catchsm_address);
            $('#edit_catchsm').val(result.catchsm);
            $('#edit_caption').val(result.caption);
            $('#edit_show_caption').val(result.caption_address);
            $('#edit_setumei').val(result.setumei);
            $('#edit_catch').val(result.catch);
            $('#edit_mbcatch').val(result.mbcatch_date);
            $('#edit_mbcatch').datepicker("update");
            $('#edit_mbcatchsm').val(result.mbcatchsm_date);
            $('#edit_mbcatchsm').datepicker('setStartDate', $('#edit_mbcatch').datepicker('getDate'));
            $('#edit_mbcatchsm').datepicker("update");
            $('#edit_mbcaption').val(result.mbcaption);
            
//            $.each(result, function (index, value) {
//                if (value != null) {
//                    result [index] = breakData(value);
//                }
//            });

            if(result.mbcatchsm_date == null){
                var mbcatch_mbcatchsm = result.mbcatch_date;
            }else{
                 var mbcatch_mbcatchsm = result.mbcatch_date+" ～ "+result.mbcatchsm_date;
            }

            $('#detail_url').html(result.url);
            $('#detail_urlsm').html(result.urlsm);
            $('#detail_catchsm').html(result.catchsm_address);
            $('#detail_caption').html(result.caption_address);
            $('#detail_setumei').html(result.setumei_name);
            $('#detail_catch').html(result.catch_name);
            $('#detail_mbcatch_mbcatchsm').html(mbcatch_mbcatchsm);
            $('#detail_mbcaption').html(result.mbcaption);
            
            $('#project_detail_modal').modal('show');
        }
    });
}


function deleteProjectRegistration(url) {
    if (projtDeleteRetrieve == '0') {
        projtDeleteRetrieve++;
        var html = getConfirmationMessage(3);
        $('#detail_project_error_data').html(html);
        $("#detail_project_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_url').value;

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

function returnProjectRegistration(url) {
    if (projtDeleteRetrieve == '0') {
        projtDeleteRetrieve++;
        var html = getConfirmationMessage(4);
        $('#detail_project_error_data').html(html);
        $("#detail_project_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_url').value;

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

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}
