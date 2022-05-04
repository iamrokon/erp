var defEmpEdt = 0;
var defEmpDeleteOrRetrieve = 0;

function editUserDetail(url, field) {
    var user_def_edit_modal = $('#user_edit_modal')
    var data = new FormData(document.getElementById('userEditForm'))
    if (field == undefined) {
        field = null;
    }
    if (field != null) {
        data.append('field', field);
    } else {
        //  $('#userEditForm').find('#userEditButton').prop('disabled', true);
    }

    if (defEmpEdt == 0) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log({ result }, 'hittes')
                if ($.trim(result.status) == 'ok') {
                    defEmpEdt++;
                    var html = getConfirmationMessage(2)
                    user_def_edit_modal.find('#def_error_dataEdit').html(html);
                    user_def_edit_modal.find("#def_error_dataEdit").show();
                    user_def_edit_modal.find('.error').removeClass('error')
                    $('#userEditForm').find('#userEditButton').prop('disabled', false);
                    $('#userEditForm').find("input[name=validate_only]").val("0")
                } else {
                    $('#userEditForm').find("input[name=validate_only]").val("0");
                    showUserEditErrorMessage(field, result);
                }
            }
        });
    } else if (defEmpEdt > 0) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if ($.trim(result.status) == 'ok') {
                    console.log({ result })
                    location.reload()
                    // input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    // jQuery('#navbarForm').append(input);
                    // $("#employeeMasterReload").trigger("click");
                } else {
                    showUserEditErrorMessage(field, result);
                }
            }
        });
    }


}
function showUserEditErrorMessage(field, result) {
    if (field == null) {
        $('#userEditForm #userEditButton').prop('disabled', false);
    }
    var inputError = result.err_field;
    defEmpEdt = 0;
    //checkFrontendValidationAfterSubmit(inputError, 2);
    $("#user_edit_modal input").parent().find('input').removeClass("error");
    var user_def_edit_modal = $('#user_edit_modal');
    user_def_edit_modal.find("#def_error_dataEdit").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        user_def_edit_modal.find('#def_error_dataEdit').html(html);

        user_def_edit_modal.find("#def_error_dataEdit").show();
    }

    //if (typeof(inputError)=='object') {
    if (inputError.ztanka) {
        user_def_edit_modal.find('#edit_ztanka').addClass("error");
    }

    if (inputError.bango) {
        user_def_edit_modal.find('#edit_bango').addClass("error");
    }

    if (inputError.name1) {
        user_def_edit_modal.find('#edit_name1').addClass("error");
    }

    if (inputError.name2) {
        user_def_edit_modal.find('#edit_name2').addClass("error");
    }

    if (inputError.htanka) {
        user_def_edit_modal.find('#edit_htanka').addClass("error");
    }

    if (inputError.datatxt0003) {
        user_def_edit_modal.find('#edit_datatxt0003').addClass("error");
    }

    if (inputError.datatxt0004) {
        user_def_edit_modal.find('#edit_datatxt0004').addClass("error");
    }

    if (inputError.datatxt0005) {
        user_def_edit_modal.find('#edit_datatxt0005').addClass("error");
    }

    if (inputError.syozoku) {
        user_def_edit_modal.find('#edit_syozoku').addClass("error");
    }

    if (inputError.passwd) {
        var pass = inputError.passwd;
        var passLength = pass.length;
        for (var i = 0; i < passLength; i++) {
            if (passLength === 1 && pass[i] == '【パスワード(確認用)】が一致しません。') {
                user_def_edit_modal.find('#edit_passwd_confirmation').addClass("error");
            } else {
                user_def_edit_modal.find('#edit_passwd_confirmation').addClass("error");
                user_def_edit_modal.find('#edit_passwd').addClass("error");
            }
        }
    }

    if (inputError.mail4) {
        user_def_edit_modal.find('#edit_mail4').addClass("error");
    }

    if (inputError.mail2) {
        user_def_edit_modal.find('#edit_mail2').addClass("error");
    }

    if (inputError.mail3) {
        user_def_edit_modal.find('#edit_mail3').addClass("error");
    }

    if (inputError.mail) {
        var mail = inputError.mail;
        var mailLength = mail.length;
        console.log(mailLength);
        for (var i = 0; i < mailLength; i++) {
            if (mailLength === 1 && mail[i] == '【メールアドレス(確認用)】が一致しません。') {
                user_def_edit_modal.find('#edit_mail_confirmation').addClass("error");
            } else {
                user_def_edit_modal.find('#edit_mail_confirmation').addClass("error");
                user_def_edit_modal.find('#edit_mail').addClass("error");
            }
        }
    }
    if (inputError.innerlevel) {
        user_def_edit_modal.find('#edit_innerlevel').addClass("error");
    }

    if (inputError.datatxt0030) {
        user_def_edit_modal.find('#edit_datatxt0030').addClass("error");
    }

    if (inputError.datatxt0031) {
        user_def_edit_modal.find('#edit_datatxt0031').addClass("error");
    }

    if (inputError.datatxt0032) {
        user_def_edit_modal.find('#edit_datatxt0032').addClass("error");
    }

    if (inputError.datatxt0033) {
        user_def_edit_modal.find('#edit_datatxt0033').addClass("error");
    }

    if (inputError.datatxt0034) {
        user_def_edit_modal.find('#edit_datatxt0034').addClass("error");
    }

    if (inputError.datatxt0035) {
        user_def_edit_modal.find('#edit_datatxt0035').addClass("error");
    }

    if (inputError.datatxt0036) {
        user_def_edit_modal.find('#edit_datatxt0036').addClass("error");
    }

    if (inputError.datatxt0037) {
        user_def_edit_modal.find('#edit_datatxt0037').addClass("error");
    }

    if (inputError.datatxt0029 || inputError.inpemp2) {
        user_def_edit_modal.find('#inpemp2').addClass("error");
    } else {
        user_def_edit_modal.find('#inpemp2').removeClass("error");
    }
    if (inputError.syounin || inputError.inpemp4) {
        user_def_edit_modal.find('#inpemp4').addClass("error");
    } else {
        user_def_edit_modal.find('#inpemp4').removeClass("error");

    }
    //}
}
function uploadAction() {
    var fileValue = document.getElementById("my-file").value.split("\\");
    var fileName = fileValue[fileValue.length - 1].split(".");
    var fileName2 = fileName[0].match(/(.|[\r\n]){1,13}/g);
    fileName2[0] = fileName2[0] + "." + fileName[fileName.length - 1]
    document.getElementById('file-name-show_emp1').innerHTML = fileName2[0];
}
function uploadAction2() {
    var fileValue = document.getElementById("my-file2").value.split("\\");
    var fileName = fileValue[fileValue.length - 1].split(".");
    var fileName2 = fileName[0].match(/(.|[\r\n]){1,13}/g);
    fileName2[0] = fileName2[0] + "." + fileName[fileName.length - 1]
    document.getElementById('file-name-show_emp2').innerHTML = fileName2[0];
}
$(document).ready(function () {
    $(document).on('change', '#userEditForm #edit_datatxt0003', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#userEditForm #edit_datatxt0004').html(data);
                $('#userEditForm #edit_datatxt0004').trigger('change');
            }
        });

    })

    $(document).on('change', '#userEditForm #edit_datatxt0004', function () {
        var bango = $(this).data('bango');
        var seleted_option = $(this).children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');

        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                $('#userEditForm #edit_datatxt0005').html(data)
            }
        });
    });
    // Edit Modal
    $('#user_edit_modal').on('shown.bs.modal', function () {
        $("#edit_ztanka").focus();
    });
    $("body").on("click", "#userBtnEdit", function () {
        $('.modal-backdrop').remove();
        var user_def_edit_modal = $('#user_edit_modal');
        var datTxt0003 = user_def_edit_modal.find('#edit_datatxt0003');
        var bango = datTxt0003.data('bango');
        var seleted_option = datTxt0003.children('option:selected');
        var category_type = seleted_option.data('categorytype');
        var category_value = seleted_option.data('categoryvalue');
        $.ajax({
            type: "GET",
            url: '/employee/categoryAsCategory/' + bango,
            data: { category_type: category_type, category_value: category_value },
            success: function (data) {
                var datatxt004 = user_def_edit_modal.find('#edit_datatxt0004');
                var datatxt005 = user_def_edit_modal.find('#edit_datatxt0005');
                datatxt004.html(data);
                datatxt004.val($('#def_datatxt004_e').val());
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
                        datatxt005.val($("#def_datatxt005_e").val());
                    }
                });
            }
        });
        $("#user_view_modal").modal("hide");
        $('#user_edit_modal').modal('show');

    });
    $(document).on('show.bs.modal', '#user_edit_modal', function (e) {
        $('body').addClass('overflow_cls');
    });
    $(document).on('hide.bs.modal', '#user_edit_modal', function () {
        $('body').removeClass('overflow_cls');
    })
    $(".def_custom-file-input_emp2").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $("#inpemp2").val(fileName);
    });
    $(".def_custom-file-input_emp4").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $("#inpemp4").val(fileName);
    });
    $("textarea").keydown(function (event) {
        if (event.keyCode == 13 && !e.shiftKey) {
            event.preventDefault();

        }
    });

    $(document).on("click", "#viewUserDetail", function () {
        $('#userEditForm').find("input[name=validate_only]").val("1")
        defEmpEdt = 0;
        defEmpDeleteOrRetrieve = 0;
        var user_def_view_modal = $('#user_view_modal');
        var user_def_edit_modal = $('#user_edit_modal');
        user_def_view_modal.find("#def_error_dataDetail").hide()
        let url = $(this).data('url')
        let id = $(this).data('id')
        $.ajax({
            type: 'GET',
            url: url,
            data: { id: id },
            success: function (result) {
                console.log(result);
                var name = (result.name).split(' ');
                if (result.deleteflag == 1) {
                    document.getElementById('deleteThis').style.display = 'none';
                    document.getElementById('userBtnEdit').style.display = 'none';
                }

                var elem, elem2;
                if (result.employee_datatxt0029 != null && result.employee_datatxt0029 != '') {
                    var img = result.employee_datatxt0029;
                    var imageData = img.split(".");
                    var len = imageData.length;
                    console.log(imageData[len - 1]);
                    if (imageData[len - 1] == "pdf") {
                        elem = '<object data="' + result.base_url + '/uploads/employee_master/' + img + '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" style="height: 2.25cm !important;width: 2.25cm !important;padding:0;margin:0;">' +
                            '<embed src="' + result.base_url + '/uploads/employee_master/' + img + '" type="application/pdf"></object>';
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
                user_def_view_modal.find('#detail_ztanka').text(result.ztanka);
                user_def_view_modal.find('#detail_bango').text(result.bango);
                user_def_view_modal.find('#detail_name1').text(name[0]);
                user_def_view_modal.find('#detail_name2').text(name[1]);
                user_def_view_modal.find('#detail_htanka').text(result.htanka);
                user_def_view_modal.find('#detail_datatxt0003').text(result.company_1);
                user_def_view_modal.find('#detail_datatxt0004').text(result.company_2);
                user_def_view_modal.find('#detail_datatxt0005').text(result.company_3);
                user_def_view_modal.find('#def_datatxt004_e').val(result.datatxt0004);
                user_def_view_modal.find('#def_datatxt005_e').val(result.datatxt0005);
                user_def_view_modal.find('#detail_syozoku').text(result.syozoku);
                user_def_view_modal.find('#detail_passwd').text(result.passwd);
                user_def_view_modal.find('#detail_mail4').text(result.mail4);
                user_def_view_modal.find('#detail_mail2').text(result.employee_mail2);
                user_def_view_modal.find('#detail_mail3').text(result.mail3);
                user_def_view_modal.find('#detail_mail_1').text(result.mail);
                user_def_view_modal.find('#detail_mail_2').text(result.mail);
                user_def_view_modal.find('#detail_datatxt0030').text(result.datatxt0030);
                user_def_view_modal.find('#detail_datatxt0031').text(result.datatxt0031);
                user_def_view_modal.find('#detail_datatxt0032').text(result.datatxt0032);
                user_def_view_modal.find('#detail_datatxt0033').text(result.datatxt0033);
                user_def_view_modal.find('#detail_datatxt0034').text(result.datatxt0034);
                user_def_view_modal.find('#detail_datatxt0035').text(result.datatxt0035);
                user_def_view_modal.find('#detail_datatxt0036').text(result.datatxt0036);
                user_def_view_modal.find('#detail_datatxt0037').text(result.datatxt0037);
                user_def_view_modal.find('#detail_recog_dept').text(result.recog_dept);
                user_def_view_modal.find('#detail_datatxt0029').html(elem);
                user_def_view_modal.find('#detail_syounin').html(elem2);
                user_def_view_modal.find('#detail_innerlevel').text(result.innerlevel);
                user_def_edit_modal.find("#def_error_dataEdit").empty();
                $("#user_edit_modal input").parent().find('input').removeClass("error");
                $("#user_edit_modal .modal-body").html(result.view)
                var name = (result.name).split(' ');
                user_def_edit_modal.find('#edit_ztanka').val(result.ztanka);
                user_def_edit_modal.find('#edit_bango').val(result.bango);
                user_def_edit_modal.find('#hiddenBango').val(result.bango);
                user_def_edit_modal.find('#edit_name1').val(name[0]);
                user_def_edit_modal.find('#edit_name2').val(name[1]);
                user_def_edit_modal.find('#edit_htanka').val(result.htanka);
                user_def_edit_modal.find('#edit_datatxt0003').val(result.datatxt0003);
                user_def_edit_modal.find('#edit_syozoku').val(result.syozoku);
                user_def_edit_modal.find('#edit_passwd').val(result.password);
                user_def_edit_modal.find('#edit_passwd_confirmation').val(result.password);
                user_def_edit_modal.find('#edit_mail4').val(result.employee_mail4);
                user_def_edit_modal.find('#edit_mail2').val(result.employee_mail2);
                user_def_edit_modal.find('#edit_mail3').val(result.mail3);
                user_def_edit_modal.find('#edit_mail').val(result.mail);
                user_def_edit_modal.find('#edit_mail_confirmation').val(result.mail);
                user_def_edit_modal.find('#edit_datatxt0030').val(result.datatxt0030_edit);
                user_def_edit_modal.find('#edit_datatxt0031').val(result.datatxt0031_edit);
                user_def_edit_modal.find('#edit_datatxt0032').val(result.datatxt0032_edit);
                user_def_edit_modal.find('#edit_datatxt0033').val(result.datatxt0033_edit);
                user_def_edit_modal.find('#edit_datatxt0034').val(result.datatxt0034_edit);
                user_def_edit_modal.find('#edit_datatxt0035').val(result.datatxt0035_edit);
                user_def_edit_modal.find('#edit_datatxt0036').val(result.datatxt0036_edit);
                user_def_edit_modal.find('#edit_datatxt0037').val(result.datatxt0037_edit);
                user_def_edit_modal.find('#edit_recog_dept').val(result.edit_recog_dept);
                user_def_edit_modal.find('#edit_innerlevel').val(result.innerlevel);
                user_def_edit_modal.find('#old_inpemp2').val(result.datatxt0029);
                user_def_edit_modal.find('#inpemp2').val(result.datatxt0029);
                user_def_edit_modal.find('#old_inpemp4').val(result.syounin);
                user_def_edit_modal.find('#inpemp4').val(result.syounin);
                user_def_edit_modal.find('#def_datatxt004_e').val(result.datatxt0004);
                user_def_edit_modal.find('#def_datatxt005_e').val(result.datatxt0005);
                $('#user_view_modal').modal('show');
            }
        });
    })
})




