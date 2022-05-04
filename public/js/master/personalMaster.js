var registrationCount = 0;
var editCount = 0;
var deleteCount = 0;
var errorBorder = "border-color: red !important; border-style: solid; border-width:1px";
var normalBorder = "border-color: #29487d !important; border-style: solid; border-width:1px";


function formatNumber(num) {
    if (typeof num == null) {
        return;
    } else {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

}

function checkForNullValue(value) {
    if (value == 'null' || value == '-') {
        return '';
    }
    return value;

}

function isEmptyObj(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}


function openRegistration() {
    registrationCount = 0;
    $("input[name=validate_only]").val("1");
    $("#registration_error_data").empty();
    $("#registration_modal input").parent().find('input').removeClass("error");
    $("#registration_modal textarea").parent().find('textarea').removeClass("error");
    $("#registration_modal select").parent().find('select').removeClass("error");
    $("#registration_modal").find('.select2-selection--single').attr("style", normalBorder);
    $("#registration_modal input").parent().find('input[type != hidden]').val('');
    $("#registration_modal select").parent().find('select option:eq(0)').prop('selected', true);
    $("#registration_modal select").parent().find('#insert_input_classification_id option:eq(1)').prop('selected', true);

    $("#registration_modal textarea").parent().find('textarea').val('');
    // $('#insert_company_cd_id option:eq(0)').prop('selected', true);
    // $('#insert_office_cd_id option:eq(0)').prop('selected', true);
    $('#submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $('#registration_modal').modal('show');
}

function openEditPersonalModal() {
    editCount = 0;
    //  $("input[name=validate_only]").val("1");
    $("#edit_registration_error_data").empty();
    $("#edit_modal input").parent().find('input').removeClass("error");
    $("#edit_modal select").parent().find('select').removeClass("error");
    $("#edit_modal textarea").parent().find('textarea').removeClass("error");
    $('#edit_submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $("#edit_modal").modal("show");
}

function registerPersonalModal(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = $('#registrationForm').serialize();

    if (field != null) {
        data = data + "&field=" + field;
    } else {
        $('#submit_registration').prop('disabled', true);
    }

    if (registrationCount === 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                if (result.status == 'ok') {
                    var msg = getConfirmationMessage(1);
                    $('#registration_error_data').html(msg);
                    $('#registration_error_data').show();
                    registrationCount++;
                    $('#submit_registration').prop('disabled', false);
                    $("input[name=validate_only]").val("0");
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
            success: function (result) {
                if (result.status == 'ok') {
                    var input = '<input type="hidden" name="personal_master_id" value="' + result.id + '">';
                    $('#navbarForm').append(input);
                    $("#personalReload")[0].click();
                } else {
                    showRegistrationErrorMessage(field, result)
                }
            }
        });
    }
}

function showRegistrationErrorMessage(field, result) {
    if (field == null) {
        $('#submit_registration').prop('disabled', false);
    }

    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 1);
    $("#registration_modal input").parent().find('input').removeClass("error");
    $("#registration_modal textarea").parent().find('textarea').removeClass("error");
    $("#registration_modal select").parent().find('select').removeClass("error");
    $("#registration_modal").find('.select2-selection--single').attr("style", normalBorder);
    $("#registration_error_data").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#registration_error_data').html(html);

        $("#registration_error_data").show();
    }
    if (inputError.company_cd) {
        $('#insert_company_cd_id').addClass("error");
        $('#insert_company_cd_id').parent().find('.select2-selection--single').attr("style", errorBorder)

    }
    if (inputError.office_cd) {
        $('#insert_office_cd_id').addClass("error");
        $('#insert_office_cd_id').parent().find('.select2-selection--single').attr("style", errorBorder);
    }
    if (inputError.deploy) {
        $('#insert_deploy_id').addClass("error");
    }
    if (inputError.position) {
        $('#insert_position_id').addClass("error");
    }
    if (inputError.personal_name) {
        $('#insert_personal_name_id').addClass("error");
    }
    if (inputError.department_charge_abbreviation) {
        $('#insert_department_charge_abbreviation_id').addClass("error");
    }
    if (inputError.mail_address) {
        $('#insert_mail_address').addClass("error");
        var mail = inputError.mail_address;
        for (var i = 0; i < mail.length; i++) {
            if (mail[i] == '【メールアドレス (確認用) 】とメールアドレスが一致しません。') {
                $('#insert_mail_address_confirmation').addClass("error");
            } else {
                $('#insert_mail_address').addClass("error");
            }
        }
    }
    if (inputError.mail_address_confirmation) {
        $('#insert_mail_address_confirmation').addClass("error");

    }
    if (inputError.tel) {
        $('#insert_tel_id').addClass("error");
    }
    if (inputError.fax) {
        $('#insert_fax_id').addClass("error");
    }
    if (inputError.internal_notes) {
        $('#insert_internal_notes_id').addClass("error");
    }
}

function viewPersonalModalDetail(url, id) {
    $.ajax({
        type: 'GET',
        url: url,
        data: { id: id },
        success: function (result) {
            var etsuransya = result.etsuransya;
            if (etsuransya.deleteflag == 1) {
                $('#btnDelete').hide();
                $('#edit_modal_open').hide();
            }
            //add value for edited field
            var company_details = etsuransya.personal_company_cd + " " + etsuransya.company_name;
            var office_details = etsuransya.personal_office_cd + " " + etsuransya.office_name;
            console.log(etsuransya)
            $('#edit_company_cd_id').val(company_details);
            $('#edit_office_cd_id').val(office_details);
            $('#new_edit_office_cd_id').val(etsuransya.datatxt0015 + '-' + etsuransya.datanum0018);
            $('#new_edit_company_id').val(etsuransya.personal_datatxt0014);
            $('#edit_personal_cd_id').val(etsuransya.personal_datatxt0049);
            $('#edit_deploy_id').val(etsuransya.mail2);
            $('#edit_position_id').val(etsuransya.mail3);
            $('#edit_personal_name_id').val(etsuransya.tantousya);
            $('#edit_department_charge_abbreviation_id').val(etsuransya.mail4);
            $('#edit_input_classification_id').val(etsuransya.mail5);
            $('#edit_mail_address').val(etsuransya.mail1);
            $('#edit_mail_address_confirmation').val(etsuransya.mail1);
            $('#edit_tel_id').val(etsuransya.personal_datatxt0016);
            $('#edit_fax_id').val(etsuransya.personal_datatxt0017);
            $('#edit_internal_notes_id').val(etsuransya.datatxt0018);
            $('#edit_information_stop_flag_id').val(etsuransya.datatxt0040);
            $('#edit_keyman_flag_id').val(etsuransya.datatxt0041);
            $('#edit_officer_election_information_id').val(etsuransya.datatxt0042);
            $('#edit_new_years_card_id').val(etsuransya.datatxt0043);
            $('#edit_user_meeting_information').val(etsuransya.datatxt0044);
            $("#edit_shipment_flag_id").val(etsuransya.datatxt0045);
            $('#personalBango').val(etsuransya.bango);

            if (etsuransya.mail5 == '0 訂正不可') {
                $('#edit_personal_name_id').attr('readonly', true);
                $('#edit_department_charge_abbreviation_id').attr('readonly', true);

            }

            // $.each(etsuransya, function (index, value) {
            //     if (value != null) {
            //         etsuransya[index] = breakData(value);
            //     }

            // });
            $('#company_name').html(company_details);
            $('#bussiness_name').html(office_details);
            $('#personal_cd').html(etsuransya.personal_datatxt0049);
            $('#deploy').html(etsuransya.mail2);
            $('#position').html(etsuransya.mail3);
            $('#personal_name').html(etsuransya.tantousya);
            $('#department_charge_abbreviation').html(etsuransya.mail4);
            $('#input_classification').html(etsuransya.mail5);
            console.log({ mail: etsuransya.mail1 })
            $('#mail_address').html(etsuransya.mail1);
            $('#confirm_mail_address').html(etsuransya.mail1);
            $('#tel').html(etsuransya.personal_datatxt0016);
            $('#fax').html(etsuransya.personal_datatxt0017);
            $('#internal_notes').html(etsuransya.datatxt0018);
            $('#information_stop_flag').html(etsuransya.datatxt0040);
            $('#keyman_flag').html(etsuransya.datatxt0041);
            $('#officer_election_information').html(etsuransya.datatxt0042);
            $('#new_years_card').html(etsuransya.datatxt0043);
            $('#user_meeting_information').html(etsuransya.datatxt0044);
            $("#shipment_flag").html(etsuransya.datatxt0045);
            //print value for edited field

            // $('#print_company_id').html(etsuransya.company_name);
            // $('#print_bussiness_id').html(etsuransya.business_name);
            // $('#print_personal_cd').html(etsuransya.personal_datatxt0049);
            // // $('#print_personal_cd').parent().parent().hide();
            // $('#print_deploy').html(etsuransya.mail2);
            // $('#print_position').html(etsuransya.mail3);
            // $('#print_personal_name').html(etsuransya.tantousya);
            // $('#print_department_charge_abbreviation').html(etsuransya.mail4);
            // $('#print_input_classification').html(etsuransya.mail5);
            // $('#print_mail_address').html(etsuransya.mail1);
            // $('#print_confirm_mail_address').html(etsuransya.mail1);
            // $('#print_tel').html(etsuransya.personal_datatxt0016);
            // $('#print_fax').html(etsuransya.personal_datatxt0017);
            // $('#print_internal_notes').html(etsuransya.datatxt0018);
            // $('#print_information_stop_flag').html(etsuransya.datatxt0040);
            // $('#print_keyman_flag').html(etsuransya.datatxt0041);
            // $('#print_officer_election_information').html(etsuransya.datatxt0042);
            // $('#print_new_years_card').html(etsuransya.datatxt0043);
            // $('#print_user_meeting_information').html(etsuransya.datatxt0044);
            // $("#print_shipment_flag").html(etsuransya.datatxt0045);
            $('#view_modal').modal('show');

        }
    });
}

function editPersonalMaster(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = $('#editForm').serialize();
    if (field != null) {
        data = data + "&field=" + field;
    } else {
        $('#edit_submit_registration').prop('disabled', true);
    }

    if (editCount === 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                if (result.status == 'ok') {
                    var msg = getConfirmationMessage(2);
                    $('#edit_registration_error_data').html(msg);
                    $('#edit_registration_error_data').show();
                    editCount++;
                    $('#edit_submit_registration').prop('disabled', false);
                    $("input[name=validate_only]").val("0");
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditErrorMessage(field, result);
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                if (result.status == 'ok') {
                    var input = '<input type="hidden" name="personal_master_id" value="' + result.id + '">';
                    $('#navbarForm').append(input);
                    $("#personalReload")[0].click();
                } else {
                    // $("input[name=validate_only]").val("0");
                    showEditErrorMessage(field, result);
                }
            }
        });
    }
}

function showEditErrorMessage(field, result) {
    if (field == null) {
        $('#edit_submit_registration').prop('disabled', false);
    }

    var editInputError = result.err_field;
    checkFrontendValidationAfterSubmit(editInputError, 2);
    $("#edit_modal input").parent().find('input').removeClass("error");
    $("#edit_modal textarea").parent().find('textarea').removeClass("error");
    $("#edit_modal select").parent().find('select').removeClass("error");
    $("#edit_registration_error_data").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#edit_registration_error_data').html(html);

        $("#edit_registration_error_data").show();
    }
    if (editInputError.company_cd) {
        $('#edit_company_cd_id').addClass("error");
    }
    if (editInputError.office_cd) {
        $('#edit_office_cd_id').addClass("error");
    }

    if (editInputError.deploy) {
        $('#edit_deploy_id').addClass("error");
    }
    if (editInputError.position) {
        $('#edit_position_id').addClass("error");
    }
    if (editInputError.personal_name) {
        $('#edit_personal_name_id').addClass("error");
    }
    if (editInputError.department_charge_abbreviation) {
        $('#edit_department_charge_abbreviation_id').addClass("error");
    }
    if (editInputError.mail_address) {
        $('#edit_mail_address').addClass("error");
        var mail = editInputError.mail_address;
        for (var i = 0; i < mail.length; i++) {
            if (mail[i] == '【メールアドレス (確認用) 】とメールアドレスが一致しません。') {
                $('#edit_mail_address_confirmation').addClass("error");
            } else {
                $('#edit_mail_address').addClass("error");
            }
        }
    }
    if (editInputError.mail_address_confirmation) {
        $('#edit_mail_address_confirmation').addClass("error");

    }
    if (editInputError.tel) {
        $('#edit_tel_id').addClass("error");
    }
    if (editInputError.fax) {
        $('#edit_fax_id').addClass("error");
    }
    if (editInputError.internal_notes) {
        $('#edit_internal_notes_id').addClass("error");
    }
}


//submit registration
$('#registrationForm').on('submit', function (event) {
    event.preventDefault();
    var url = $("input[name=url]").val();
    registerPersonalModal(url);
});

//open view modal
$('body').on('click', '.open_view', function (event) {
    event.preventDefault();
    deleteCount = 0;
    var url = $(this).data('url');
    var id = $(this).data('id');
    $('#view_modal .m_t').parent().find('.m_t').text('');
    $('#view_modal').find('#confirmation_message').empty();
    viewPersonalModalDetail(url, id);

});

//edit registration
$('#editForm').on('submit', function (event) {
    event.preventDefault();
    var editUrl = $("input[name=editUrl]").val();
    editPersonalMaster(editUrl);
});

//view page print function
// document.getElementById("btnPrintView").onclick = function () {
//     var print_personal_cd = $('#print_personal_cd');
//     print_personal_cd.parent().show();
//     print_personal_cd.parent().next().show();
//     var header = '';
//     var status = $(this).data('status');
//
//     if (status) {
//         header = '個人マスタ (削除) ';
//     } else {
//         header = '個人マスタ(詳細)';
//     }
//
//     var printSection = document.getElementById("print_modal");
//     $('#print_modal  h6').text(header);
//     var newWin = window.open();
//     newWin.document.write(printSection.innerHTML);
//     newWin.document.close();
//     newWin.print();
//     newWin.close();
// };

//edit page print
// document.getElementById("btnPrintEdit").onclick = function () {
//     $('#print_company_id').text(checkForNullValue($('#edit_company_cd_id').val()));
//     $('#print_bussiness_id').text(checkForNullValue($('#edit_office_cd_id').val()));
//     var print_personal_cd = $('#print_personal_cd');
//     print_personal_cd.parent().show();
//     print_personal_cd.parent().next().show();
//     $('#print_personal_cd').text($('#edit_personal_cd_id').val());
//     $('#print_deploy').text($('#edit_deploy_id').val());
//     $('#print_position').text($('#edit_position_id').val());
//     $('#print_personal_name').text($('#edit_personal_name_id').val());
//     $('#print_department_charge_abbreviation').text($('#edit_department_charge_abbreviation_id').val());
//     $('#print_input_classification').text(checkForNullValue($('#edit_input_classification_id').val()));
//     $('#print_mail_address').text($('#edit_mail_address').val());
//     $('#print_confirm_mail_address').text($('#edit_mail_address_confirmation').val());
//     $('#print_tel').text($('#edit_tel_id').val());
//     $('#print_fax').text($('#edit_fax_id').val());
//     $('#print_internal_notes').text($('#edit_internal_notes_id').val());
//     $('#print_information_stop_flag').text(checkForNullValue($('#edit_information_stop_flag_id').val()));
//     $('#print_keyman_flag').text(checkForNullValue($('#edit_keyman_flag_id').val()));
//     $('#print_officer_election_information').text(checkForNullValue($('#edit_officer_election_information_id').val()));
//     $('#print_new_years_card').text(checkForNullValue($('#edit_new_years_card_id').val()));
//     $('#print_user_meeting_information').text(checkForNullValue($('#edit_user_meeting_information').val()));
//     $("#print_shipment_flag").text(checkForNullValue($('#edit_shipment_flag_id').val()));
//     var header = '個人マスタ (変更)';
//     var printSection = document.getElementById("print_modal");
//     $('#print_modal  h6').text(header);
//     var newWin = window.open();
//     newWin.document.write(printSection.innerHTML);
//     newWin.document.close();
//     newWin.print();
//     newWin.close();
// };
//registration page print
//
$("#edit_modal_open").on("click", function () {
    $("#view_modal").modal("hide");
    openEditPersonalModal();
    $('#edit_modal').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#view_modal").modal("hide");
        $("#edit_company_cd_id").focus();
    });

    $('#edit_modal').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
        $("#view_modal").modal("hide");
    });

});

function deletePersonalDetail(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(3);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();

    } else {
        var id = $('#personalBango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: { id: id },
            success: function (response) {
                location.reload();
            },
        });
    }

}

function returnPersonalDetail(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(4);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();

    } else {
        var id = $('#personalBango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: { id: id },
            success: function (response) {
                location.reload();
            },
        });
    }

}


$('body').on('click', '#btnDelete', function () {
    var url = $(this).data('url');
    deletePersonalDetail(url);
});
$('body').on('click', '#btnRestore', function () {
    var url = $(this).data('url');
    returnPersonalDetail(url);
});
function kokyaku1WiseHaisou(bango, kokyakubango) {
    var officeBango = $('input[name=officeId]').val();
    $.ajax({
        type: 'GET',
        url: '/personal-master/kokyaku1WiseHaisou/' + bango,
        data: { id: kokyakubango, officeBango: officeBango },
        success: function (data) {
            var $office_cd_id = $('#insert_office_cd_id');
            $office_cd_id.html(data);
            $office_cd_id.trigger('change');
        }
    })


};

// function changeOfficeSerial(bango, officeId) {
//     $.ajax({
//         type: 'GET',
//         url: '/personal-master/change-office-serial/' + bango,
//         data: {id: officeId},
//         success: function (data) {
//             console.log(data)
//             $('#insert_personal_cd_id').val(data);
//         }
//     });
// };

$('#insert_company_cd_id').on("change", function () {
    var bango, kokyakubango;
    bango = $(this).data('ownbango');
    kokyakubango = $(this).val();
    kokyakubango = kokyakubango ? kokyakubango.split('-')[1] : null;
    kokyaku1WiseHaisou(bango, kokyakubango)

});
// $('#insert_office_cd_id').on('change', function () {
//     var officeId, bango;
//     officeId = $(this).val();
//     officeId = officeId ? officeId.split('-')[1] : null;
//     bango = $(this).data('bango');
//     changeOfficeSerial(bango, officeId);
// });

var companyBango, kokyakubango;
companyBango = $('#insert_company_cd_id').data('ownbango');
kokyakubango = $('#insert_company_cd_id').children('option:first').val();
kokyakubango = kokyakubango ? kokyakubango.split('-')[1] : null;
kokyaku1WiseHaisou(companyBango, kokyakubango);

var officeId, bango;
officeId = $('#insert_office_cd_id').children('option:first').val();
officeId = officeId ? officeId.split('-')[1] : null;
bango = $('#insert_office_cd_id').data('bango');
// changeOfficeSerial(bango, officeId);

$('#edit_input_classification_id').on('change', function (e) {
    $('#edit_personal_name_id').attr('readonly', false);
    $('#edit_department_charge_abbreviation_id').attr('readonly', false);
})

