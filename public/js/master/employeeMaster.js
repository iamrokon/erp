var empReg = 0;
var empEdt = 0;
var empDeleteOrRetrieve = 0;

function openRegistration() {
    empReg = 0;
    $("input[name=validate_only]").val("1");
    $("#error_data").empty();
    $("#employee_modal1 input").parent().find('input').val('');
    $("#employee_modal1 select").parent().find('select').prop("selectedIndex", 0);
    $("#employee_modal1 input").parent().find('input').removeClass("error");
    $("#employee_modal1 select").parent().find('select').removeClass("error");
    $('#insert_innerlevel').val(20);
    $('#insert_ztanka').val($("#ztanka_def").val());
    $("#regFrontValidation").remove();
    var bango = $("#userId").val();
    let { categorytype = null, categoryvalue = null } = $('#registrationForm #insert_datatxt0003 option').eq(0).data()
    $.ajax({
        type: "GET",
        url: '/employee/categoryAsCategory/' + bango,
        data: { category_type: categorytype, category_value: categoryvalue },
        success: function (data) {
            var datatxt004 = $('#registrationForm #insert_datatxt0004');
            datatxt004.html(data);
            let { categorytype = null, categoryvalue = null } = $('#registrationForm #insert_datatxt0004 option').eq(0).data()
            $.ajax({
                type: "GET",
                url: '/employee/categoryAsCategory/' + bango,
                data: { category_type: categorytype, category_value: categoryvalue },
                success: function (data) {
                    var datatxt005 = $('#registrationForm #insert_datatxt0005');
                    datatxt005.html(data);
                }
            });
        }
    }).done(function () {
        $('#employee_modal1').modal('show');
    });
}

/////////registration function///////////////
function registerEmployee(url, field) {
    //IE support
    if (field == undefined) {
        field = null;
    }
    var data = new FormData(document.getElementById('registrationForm'));
    if (field != null) {
        data.append('field', field);
    } else {
        document.getElementById('regButton').disabled = true;
    }

    if (empReg == '0' && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if ($.trim(result.status) == 'ok') {
                    empReg++;
                    var html = getConfirmationMessage(1);
                    $('#registrationForm #error_data').html(html);
                    $("#registrationForm #error_data").show();
                    document.getElementById('regButton').disabled = false;
                    $("input[name=validate_only]").val("0");
                    $("#registrationForm").find('.error').removeClass("error")
                } else {
                    showRegistrationErrorMessage(field, result)
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
  
                if ($.trim(result.status) == 'ok') {
                     document.getElementById("employeeMasterReload").click();
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#employeeMasterReload").trigger("click");
                } else {
                    showRegistrationErrorMessage(field, result)
                }
            }
        });
    }

}

function showRegistrationErrorMessage(field, result) {
    if (field == null) {
        document.getElementById('regButton').disabled = false;
    }
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 1);
    $("#employee_modal1 input").parent().find('input').removeClass("error");
    $("#employee_modal1 select").parent().find('select').removeClass("error");
    $("#registrationForm #error_data").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#registrationForm #error_data').html(html);

        $("#registrationForm #error_data").show();
    }

    if (inputError.ztanka) {
        $('#registrationForm #insert_ztanka').addClass("error");
    }

    if (inputError.bango) {
        $('#registrationForm #insert_bango').addClass("error");
    }

    if (inputError.name1) {
        $('#registrationForm #insert_name1').addClass("error");
    }

    if (inputError.name2) {
        $('#registrationForm #insert_name2').addClass("error");
    }

    if (inputError.htanka) {
        $('#registrationForm #insert_htanka').addClass("error");
    }

    if (inputError.datatxt0003) {
        $('#registrationForm #insert_datatxt0003').addClass("error");
    }

    if (inputError.datatxt0004) {
        $('#registrationForm #insert_datatxt0004').addClass("error");
    }

    if (inputError.datatxt0005) {
        $('#registrationForm #insert_datatxt0005').addClass("error");
    }

    if (inputError.syozoku) {
        $('#registrationForm #insert_syozoku').addClass("error");
    }

    if (inputError.passwd) {
        var pass = inputError.passwd;
        var passLength = pass.length;
        for (var i = 0; i < passLength; i++) {
            if (passLength === 1 && pass[i] == '【パスワード(確認用)】が一致しません。') {
                $('#registrationForm #insert_passwd_confirmation').addClass("error");
            } else {
                $('#registrationForm #insert_passwd_confirmation').addClass("error");
                $('#registrationForm #insert_passwd').addClass("error");
            }
        }
    }
    if (inputError.mail4) {
        $('#registrationForm #insert_mail4').addClass("error");
    }

    if (inputError.mail2) {
        $('#registrationForm #insert_mail2').addClass("error");
    }

    if (inputError.mail3) {
        $('#registrationForm #insert_mail3').addClass("error");
    }

    if (inputError.mail) {
        var mail = inputError.mail;
        var mailLength = mail.length;

        for (var i = 0; i < mailLength; i++) {
            if (mailLength === 1 && mail[i] == '【メールアドレス(確認用)】が一致しません。') {
                $('#registrationForm #insert_mail_confirmation').addClass("error");
            } else {
                $('#registrationForm #insert_mail_confirmation').addClass("error");
                $('#registrationForm #insert_mail').addClass("error");
            }
        }
    }
    if (inputError.innerlevel) {
        $('#registrationForm #insert_innerlevel').addClass("error");
    }

    if (inputError.datatxt0030) {
        $('#registrationForm #insert_datatxt0030').addClass("error");
    }

    if (inputError.datatxt0031) {
        $('#registrationForm #insert_datatxt0031').addClass("error");
    }

    if (inputError.datatxt0032) {
        $('#registrationForm #insert_datatxt0032').addClass("error");
    }

    if (inputError.datatxt0033) {
        $('#registrationForm #insert_datatxt0033').addClass("error");
    }

    if (inputError.datatxt0034) {
        $('#registrationForm #insert_datatxt0034').addClass("error");
    }

    if (inputError.datatxt0035) {
        $('#registrationForm #insert_datatxt0035').addClass("error");
    }

    if (inputError.datatxt0036) {
        $('#registrationForm #insert_datatxt0036').addClass("error");
    }

    if (inputError.datatxt0037) {
        $('#registrationForm #insert_datatxt0037').addClass("error");
    }
    if (inputError.datatxt0029 || inputError.inpemp1) {
        $('#registrationForm #input_file_emp').addClass("error");
    } else {
        $('#registrationForm #input_file_emp').removeClass("error");
    }
    if (inputError.syounin || inputError.inpemp3) {
        $('#registrationForm #input_file_emp3').addClass("error");
    } else {
        $('#registrationForm #input_file_emp3').removeClass("error");
    }

}

///////////////end registration function//////

/////////edit function///////////////
function editEmployee(url, field) {
    var data = new FormData(document.getElementById('editForm'));
    if (field != null) {
        data.append('field', field);
    } else {
        $('#editForm #editButton').prop('disabled', true);
    }

    if (empEdt == '0' && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if ($.trim(result.status) == 'ok') {
                    empEdt++;
                    var html = getConfirmationMessage(2);
                    $('#editForm #error_dataEdit').html(html);
                    $('#editForm #error_dataEdit').show();
                    $('#editForm #editButton').prop('disabled', false);
                    $("input[name=validate_only]").val("0");
                    $("#editForm").find('.error').removeClass("error")
                }else if ($.trim(result.status)=='ng_p') {
                    $('#editForm #editButton').prop('disabled', false);
                    $("#error_dataEdit").html('<div class="col-12"><p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">他のユーザーこのデータを変更しています。再度検索してデータを取得し直して下さい。</p></div>')
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditErrorMessage(field, result)
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                // console.log(typeof(result));
                if ($.trim(result.status) == 'ok') {
                    // location.reload();
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $("#employeeMasterReload").trigger("click");
                }else if ($.trim(result.status)=='ng_p') {
                    $('#editForm #editButton').prop('disabled', false);
                    $("#error_dataEdit").html('<div class="col-12"><p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">他のユーザーこのデータを変更しています。再度検索してデータを取得し直して下さい。</p></div>')
                }
                 else {
                    showEditErrorMessage(field, result)
                }
            }
        });
    }
}


function showEditErrorMessage(field, result) {
    if (field == null) {
        $('#editForm #editButton').prop('disabled', false);
    }
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 2);
    console.log(inputError);
    $("#editForm #employee_modal3 input").parent().find('input').removeClass("error");
    $("#editForm #employee_modal3 select").parent().find('select').removeClass("error");

    $(" #editForm #error_dataEdit").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#editForm #error_dataEdit').html(html);

        $("#editForm #error_dataEdit").show();
    }

    if (inputError.ztanka) {
        $('#editForm #edit_ztanka').addClass("error");
    }

    if (inputError.bango) {
        $('#editForm #edit_bango').addClass("error");
    }

    if (inputError.name1) {
        $('#editForm #edit_name1').addClass("error");
    }

    if (inputError.name2) {
        $('#editForm #edit_name2').addClass("error");
    }

    if (inputError.htanka) {
        $('#editForm #edit_htanka').addClass("error");
    }

    if (inputError.datatxt0003) {
        $('#editForm #edit_datatxt0003').addClass("error");
    }

    if (inputError.datatxt0004) {
        $('#editForm #edit_datatxt0004').addClass("error");
    }

    if (inputError.datatxt0005) {
        $('#editForm #edit_datatxt0005').addClass("error");
    }

    if (inputError.syozoku) {
        $('#editForm #edit_syozoku').addClass("error");
    }

    if (inputError.passwd) {
        var pass = inputError.passwd;
        var passLength = pass.length;
        for (var i = 0; i < passLength; i++) {
            if (passLength === 1 && pass[i] == '【パスワード(確認用)】が一致しません。') {
                $('#editForm #edit_passwd_confirmation').addClass("error");
            } else {
                $('#editForm #edit_passwd_confirmation').addClass("error");
                $('#editForm #edit_passwd').addClass("error");
            }
        }
    }

    if (inputError.mail4) {
        $('#editForm #edit_mail4').addClass("error");
    }

    if (inputError.mail2) {
        $('#editForm #edit_mail2').addClass("error");
    }

    if (inputError.mail3) {
        $('#editForm #edit_mail3').addClass("error");
    }

    if (inputError.mail) {
        var mail = inputError.mail;
        var mailLength = mail.length;
        console.log(mailLength);
        for (var i = 0; i < mailLength; i++) {
            if (mailLength === 1 && mail[i] == '【メールアドレス(確認用)】が一致しません。') {
                $('#editForm #edit_mail_confirmation').addClass("error");
            } else {
                $('#editForm #edit_mail_confirmation').addClass("error");
                $('#editForm #edit_mail').addClass("error");
            }
        }
    }
    if (inputError.innerlevel) {
        $('#editForm #edit_innerlevel').addClass("error");
    }

    if (inputError.datatxt0030) {
        $('#editForm #edit_datatxt0030').addClass("error");
    }

    if (inputError.datatxt0031) {
        $('#editForm #edit_datatxt0031').addClass("error");
    }

    if (inputError.datatxt0032) {
        $('#editForm #edit_datatxt0032').addClass("error");
    }

    if (inputError.datatxt0033) {
        $('#editForm #edit_datatxt0033').addClass("error");
    }

    if (inputError.datatxt0034) {
        $('#editForm #edit_datatxt0034').addClass("error");
    }

    if (inputError.datatxt0035) {
        $('#editForm #edit_datatxt0035').addClass("error");
    }

    if (inputError.datatxt0036) {
        $('#editForm #edit_datatxt0036').addClass("error");
    }

    if (inputError.datatxt0037) {
        $('#editForm #edit_datatxt0037').addClass("error");
    }

    if (inputError.datatxt0029 || inputError.inpemp2) {
        $('#editForm #inpemp2').addClass("error");
    } else {
        $('#editForm #inpemp2').removeClass("error");
    }
    if (inputError.syounin || inputError.inpemp4) {
        $('#editForm #inpemp4').addClass("error");
    } else {
        $('#editForm #inpemp4').removeClass("error");
    }
}

///////////////end edit function//////

///////////view employee detail////////////

function viewDetail(url, id) {
    empEdt = 0;
    empDeleteOrRetrieve = 0;
    $("#employeeDetailViewForm #detail_error_data").hide();
    $.ajax({
        type: 'get',
        url: url,
        data: { id: id },
        success: function (result) {
            console.log(result);
            var name = (result.name).split(' ');

            $("#error_dataEdit").empty();
            $("#employee_modal3 input").parent().find('input').removeClass("error");
            $("#employee_modal3 select").parent().find('select').removeClass("error");

            if (result.deleteflag == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('empButton3').style.display = 'none';
            }
            var elem, elem2;
            if (result.employee_datatxt0029 != null && result.employee_datatxt0029 != '') {
                var img = result.employee_datatxt0029;
                var imageData = img.split(".");
                var len = imageData.length;
                console.log(imageData[len - 1]);
                if (imageData[len - 1] == "pdf") {

                    // elem = '<iframe src="'+result.base_url+'/uploads/employee_master/'+result.datatxt0029+'" style="height:2.25cm !important;width:2.25cm !important;padding:0;margin:0;" scrolling="no" frameborder="0">';
                    elem = '<object data="' + result.base_url + '/uploads/employee_master/' + img + '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" style="height: 2.25cm !important;width: 2.25cm !important;padding:0;margin:0;">' +
                        '<embed src="' + result.base_url + '/uploads/employee_master/' + img + '" type="application/pdf"></object>';
                    // elem = '<img src="'+image1+'" style="height:2.25cm !important;width:2.25cm !important;">';

                } else {
                    elem = '<img src="' + result.base_url + '/uploads/employee_master/' + img + '" style="height:2.25cm !important;width:2.25cm !important;">';
                }
            } else {
                elem = '';
            }

            if (result.employee_syounin != null && result.employee_syounin != '') {
                var img = result.employee_syounin;
                var imageData = img.split(".");
                var len = imageData.length;
                console.log(imageData[len - 1]);
                if (imageData[len - 1] == "pdf") {
                    elem2 = '<object data="' + result.base_url + '/uploads/employee_master/' + img + '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" style="height: 2.25cm !important;width: 2.25cm !important;padding:0;margin:0;">' +
                        '<embed src="' + result.base_url + '/uploads/employee_master/' + img + '" type="application/pdf"></object>';
                } else {
                    elem2 = '<img src="' + result.base_url + '/uploads/employee_master/' + img + '" style="height:2.25cm !important;width:2.25cm !important;">';
                }
            } else {
                elem2 = '';
            }

            $('#editForm #edit_ztanka').val(result.ztanka);
            $('#editForm #edit_bango').val(result.bango);
            $('#editForm #hiddenBango').val(result.bango);
            $('#editForm #edit_name1').val(name[0]);
            $('#editForm #edit_name2').val(name[1]);
            $('#editForm #edit_htanka').val(result.htanka);
            $('#editForm #edit_datatxt0003').val(result.datatxt0003);
            $('#editForm #edit_syozoku').val(result.syozoku);
            $('#editForm #edit_passwd').val(result.password);
            $('#editForm #edit_passwd_confirmation').val(result.password);
            $('#editForm #edit_mail4').val(result.employee_mail4);
            $('#editForm #edit_mail2').val(result.employee_mail2);
            $('#editForm #edit_mail3').val(result.mail3);
            $('#editForm #edit_mail').val(result.mail);
            $('#editForm #edit_mail_confirmation').val(result.mail);
            $('#editForm #edit_datatxt0030').val(result.datatxt0030_edit);
            $('#editForm #edit_datatxt0031').val(result.datatxt0031_edit);
            $('#editForm #edit_datatxt0032').val(result.datatxt0032_edit);
            $('#editForm #edit_datatxt0033').val(result.datatxt0033_edit);
            $('#editForm #edit_datatxt0034').val(result.datatxt0034_edit);
            $('#editForm #edit_datatxt0035').val(result.datatxt0035_edit);
            $('#editForm #edit_datatxt0036').val(result.datatxt0036_edit);
            $('#editForm #edit_datatxt0037').val(result.datatxt0037_edit);
            $('#editForm #edit_recog_dept').val(result.edit_recog_dept);
            $('#editForm #edit_innerlevel').val(result.innerlevel);
            $('#editForm #old_inpemp2').val(result.datatxt0029);
            $('#editForm #inpemp2').val(result.datatxt0029);
            $('#editForm #old_inpemp4').val(result.syounin);
            $('#editForm #inpemp4').val(result.syounin);


            $.each(result, function (index, value) {
                if (value != null) {
                    result[index] = breakData(value);
                }
            });

            $('#employeeDetailViewForm #detail_ztanka').html(result.ztanka);
            $('#employeeDetailViewForm #detail_bango').html(result.bango);
            $('#employeeDetailViewForm #detail_name1').html(name[0]);
            $('#employeeDetailViewForm #detail_name2').html(name[1]);
            $('#employeeDetailViewForm #detail_htanka').html(result.htanka);
            $('#employeeDetailViewForm #detail_datatxt0003').html(result.company_1);
            $('#employeeDetailViewForm #detail_datatxt0004').html(result.company_2);
            $('#employeeDetailViewForm #detail_datatxt0005').html(result.company_3);
            $('#employeeDetailViewForm #detail_syozoku').html(result.syozoku);
            $('#employeeDetailViewForm #detail_passwd').html(result.passwd);
            $('#employeeDetailViewForm #detail_mail4').html(result.mail4);
            $('#employeeDetailViewForm #detail_mail2').html(result.employee_mail2);
            $('#employeeDetailViewForm #detail_mail3').html(result.mail3);
            $('#employeeDetailViewForm #detail_mail_1').html(result.mail);
            $('#employeeDetailViewForm #detail_mail_2').html(result.mail);
            $('#employeeDetailViewForm #detail_datatxt0030').html(result.datatxt0030);
            $('#employeeDetailViewForm #detail_datatxt0031').html(result.datatxt0031);
            $('#employeeDetailViewForm #detail_datatxt0032').html(result.datatxt0032);
            $('#employeeDetailViewForm #detail_datatxt0033').html(result.datatxt0033);
            $('#employeeDetailViewForm #detail_datatxt0034').html(result.datatxt0034);
            $('#employeeDetailViewForm #detail_datatxt0035').html(result.datatxt0035);
            $('#employeeDetailViewForm #detail_datatxt0036').html(result.datatxt0036);
            $('#employeeDetailViewForm #detail_datatxt0037').html(result.datatxt0037);
            $('#employeeDetailViewForm #detail_recog_dept').html(result.recog_dept);
            $('#employeeDetailViewForm #detail_datatxt0029').html(elem);
            $('#employeeDetailViewForm #detail_syounin').html(elem2);

            $('#employeeDetailViewForm #detail_innerlevel').html(result.innerlevel);

            var datTxt0003 = $('#editForm #edit_datatxt0003');
            var bango = datTxt0003.data('bango');
            var seleted_option = datTxt0003.children('option:selected');
            var category_type = seleted_option.data('categorytype');
            var category_value = seleted_option.data('categoryvalue');
            $.ajax({
                type: "GET",
                url: '/employee/categoryAsCategory/' + bango,
                data: { category_type: category_type, category_value: category_value },
                success: function (data) {
                    var datatxt004 = $('#editForm #edit_datatxt0004');
                    var datatxt005 = $('#editForm #edit_datatxt0005');
                    datatxt004.html(data);
                    datatxt004.val(result.datatxt0004);
                    var bango = datatxt004.data('bango');
                    var seleted_option = datatxt004.children('option:selected');
                    var category_type = seleted_option.data('categorytype');
                    var category_value = seleted_option.data('categoryvalue');
                    $.ajax({
                        type: "GET",
                        url: '/employee/categoryAsCategory/' + bango,
                        data: { category_type: category_type, category_value: category_value },
                        success: function (data) {
                            datatxt005.html(data);
                            datatxt005.val(result.datatxt0005);
                        }
                    });

                }
            });
            $('#employee_modal2').modal('show');

        }
    });
}

// Show uploaded image in print preview start
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = e.target.result;
            var img1 = img.split(";");
            if (img1[0] == "data:application/pdf") {
                $('#employee_print #print_datatxt0029').html('<object data="' + img + '#toolbar=0&navpanes=0&scrollbar=0" class="iframeelement" type="application/pdf" style="height: 2.25cm !important;width: 2.25cm !important;padding:0;margin:0;overflow:hidden"><embed src="' + img + '" type="application/pdf" style="padding:0;margin:0;overflow: hidden" /></object>');
            } else {
                $('#employee_print #print_datatxt0029').html('<img src="' + e.target.result + '" style="width:2.25cm !important;height:2.25cm !important">');
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#customFileEmp").change(function () {
    readURL($('#customFileEmp').val());
});

$("#customFileEmp3").change(function () {
    readURL($('#customFileEmp3').val());
});

$("#customFileEmp2").change(function () {
    readURL($('#customFileEmp2').val());
});

$("#customFileEmp4").change(function () {
    readURL($('#customFileEmp4').val());
});


// Show uploaded image in print preview end

function deleteEmployeeMaster(url) {

    if (empDeleteOrRetrieve == 0) {
        empDeleteOrRetrieve++;
        var html = getConfirmationMessage(3);
        $('#employeeDetailViewForm #detail_error_data').html(html);
        $("#employeeDetailViewForm #detail_error_data").show();
    } else {
        var kesuId = $('#editForm #hiddenBango').val();
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

function returnEmployeeMaster(url) {

    if (empDeleteOrRetrieve == 0) {
        empDeleteOrRetrieve++;
        var html = getConfirmationMessage(4);
        $('#employeeDetailViewForm #detail_error_data').html(html);
        $("#employeeDetailViewForm #detail_error_data").show();
    } else {
        var kesuId = $('#editForm #hiddenBango').val();
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


$(document).ready(function () {
    $('body').css('pointer-events', 'all')
    $('#insert_datatxt0003').on('change', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#insert_datatxt0004').html(data);
                $('#insert_datatxt0004').trigger('change');
            }
        });
    });
    $('#insert_datatxt0004').on('change', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#insert_datatxt0005').html(data)
            }
        });
    });
    $('#editForm #edit_datatxt0003').on('change', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#editForm #edit_datatxt0004').html(data);
                $('#editForm #edit_datatxt0004').trigger('change');
            }
        });
    });
    $('#editForm #edit_datatxt0004').on('change', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#editForm #edit_datatxt0005').html(data)
            }
        });
    });
})

//frontEnd design portion

$('#employee_modal1').on('shown.bs.modal', function () {
    $("#insert_ztanka").focus();
});

// Edit Modal
$('#employee_modal3').on('shown.bs.modal', function () {
    $("#edit_ztanka").focus();
});

// Settings Modal
$('#setting_display_modal').on('shown.bs.modal', function () {
    $("#setting_name").focus();
});

$('#employee_modal3').on('show.bs.modal', function (e) {
    $('body').addClass('overflow_cls');
    $("#employee_modal2").modal("hide");
});

$('#employee_modal3').on('hide.bs.modal', function (e) {
    $('body').removeClass('overflow_cls');
})

$("#empButton3").on("click", function () {
    $('.modal-backdrop').remove();
});
