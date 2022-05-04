var registrationCount = 0;
var editCount = 0;
var deleteCount = 0;

function openRegistration() {
    registrationCount = 0;
    $("input[name=validate_only]").val("1");
    $("#registration_error_data").empty();
    $("#registration_modal").parent().find('input').removeClass("error");
    $("#registration_modal textarea").parent().find('textarea').removeClass("error");
    $("#registration_modal input[type != 'radio']").parent().find('input').val('');
    $("#registration_modal textarea").parent().find('textarea').val('');
    $("#insert_name").text('');
    $("#registration_modal").find("#insert_datatxt0096").val('1 訂正可')
    $('#submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $('#registration_modal').modal('show');
}

function openEditProductDescription() {
    editCount = 0;
    $("input[name=validate_only]").val("1");
    $("#edit_registration_error_data").empty();
    $("#edit_modal input").parent().find('input').removeClass("error");
    $("#edit_modal textarea").parent().find('textarea').removeClass("error");
    $('#edit_submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $('#edit_modal').modal('show');
}
function showRegistrationErrorMsg(field,result) {
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 1);
    if (field == null) {
        $('#submit_registration').prop('disabled', false);
    }
    $("#registration_modal input").parent().find('input').removeClass("error");
    $("#registration_modal textarea").parent().find('textarea').removeClass("error");
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
    for (var name in inputError) {
        var names = ['mbcaption', 'urlsm', 'mbcatch', 'caption', 'catchsm', 'datatxt0096'];
        if (names.indexOf(name) !== -1) {
            if (name === 'mbcaption') {
                $("#registrationForm").find("input[name='inp2']").addClass("error")
            } else {
                $("#registrationForm").find("input[name=" + name + "]").addClass("error")
            }
        }
        $("#registrationForm").find("textarea[name=" + name + "]").addClass("error")

    }
}
function showEditError(field,result) {
    var editInputError = result.err_field;
    checkFrontendValidationAfterSubmit(editInputError, 2);
    if (field == null) {
        $('#edit_submit_registration').prop('disabled', false);
    }

    $("#edit_modal input").parent().find('input').removeClass("error");
    $("#edit_modal textarea").parent().find('textarea').removeClass("error");
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

    for (var name in editInputError) {
        console.log(name);
        var names = ['mbcaption', 'urlsm', 'mbcatch', 'caption', 'catchsm', 'datatxt0096'];
        if (names.indexOf(name) !== -1) {
            if (name === 'mbcaption') {
                $("#editForm").find("input[name='new_inp2']").addClass("error")
            } else {
                $("#editForm").find("input[name=" + name + "]").addClass("error")
            }
        }
        $("#editForm").find("textarea[name=" + name + "]").addClass("error")

    }
}

function registerProductDescription(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = new FormData(document.getElementById('registrationForm'));
    if (field != null) {
        data.append('field', field);
    } else {
        $('#submit_registration').prop('disabled', true);
    }

    if (registrationCount === 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);
                if (result.status == 'ok') {
                    var msg = getConfirmationMessage(1);
                    $('#registration_error_data').html(msg);
                    $('#registration_error_data').show();
                    registrationCount++;
                    $("input[name=validate_only]").val("0");
                    $('#submit_registration').prop('disabled', false);
                } else {
                    showRegistrationErrorMsg(field,result)
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
                console.log(result);
                if (result.status == 'ok') {
                    var input = '<input type="hidden" name="product_des_master_id" value="' + result.id + '">';
                    $('#navbarForm').append(input);
                    $("#productDescriptionReload")[0].click();
                } else {
                    showRegistrationErrorMsg(field,result)
                }
            }
        });
    }
}

function viewProductDescription(url, id) {
    $.ajax({
        type: 'GET',
        url: url,
        data: {id: id},
        success: function (result) {
            console.log(result);
            var gazou = result.gazou;
            if (gazou.hyouji == 1) {
                $('#btnDelete').hide();
                $('#edit_modal_open').hide();
            }
            var view_modal = $("#view_modal");
            view_modal.find("#url").text(gazou.url);
            view_modal.find('#urlsm').text(gazou.urlsm + ' ' + gazou.shohin1_name);
            view_modal.find('#mbcatch').text(gazou.mbcatch);
            view_modal.find('#setumei').html(gazou.setumei);
            view_modal.find('#catch').html(gazou.catch);
            view_modal.find('#caption').html(gazou.caption);
            view_modal.find('#catchsm').html(gazou.catchsm);
            view_modal.find('#mbcatchsm').html(gazou.mbcatchsm);
            if (gazou.mbcaption) {
                var pdfPath = "/uploads/product_des_master/" + gazou.mbcaption;
                var anchorElement = "<a target='_blank' href=" + pdfPath + ">" + gazou.mbcaption + "</a>"
                view_modal.find('#mbcaption').html(anchorElement);
            } else {
                view_modal.find('#mbcaption').text("");
            }
            view_modal.find('#supplementary_explanation').text(gazou.supplementary_explanation);
            view_modal.find('#datatxt0096').text(gazou.datatxt0096);
            var edit_modal = $('#edit_modal');
            edit_modal.find("#url").text(gazou.url);
            edit_modal.find('#urlsm').text(gazou.urlsm + ' ' + gazou.shohin1_name);
            edit_modal.find("input[name='mbcatch']").val(gazou.mbcatch);
            edit_modal.find("textarea[name='setumei']").val(gazou.setumei);
            edit_modal.find("textarea[name='catch']").val(gazou.catch);
            edit_modal.find("textarea[name='caption']").val(gazou.caption);
            edit_modal.find("textarea[name='catchsm']").val(gazou.catchsm);
            edit_modal.find("textarea[name='mbcatchsm']").val(gazou.mbcatchsm);
            edit_modal.find("input[name='old_inp2']").val(gazou.mbcaption);
            edit_modal.find("input[name='new_inp2']").val(gazou.mbcaption);
            edit_modal.find("textarea[name='supplementary_explanation']").val(gazou.supplementary_explanation);
            edit_modal.find("select[name='datatxt0096']").val(gazou.datatxt0096 );
            if (gazou.datatxt0096== '0') {
                $('#edit_mbcatch').attr('readOnly', true)
            }
            $('#productDesBango').val(gazou.urlsm);
            $('#view_modal').modal('show');
        }
    });
}

function editProductDescription(url, field) {
    if (field == undefined) {
        field = null;
    }
    var data = new FormData(document.getElementById('editForm'));
    if (field != null) {
        data.append('field', field);
    } else {
        $('#edit_submit_registration').prop('disabled', true);
    }
    if (editCount === 0 && field == null) {

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.status == 'ok') {
                    editCount++;
                    var msg = getConfirmationMessage(2);
                    $('#edit_registration_error_data').html(msg);
                    $('#edit_registration_error_data').show();
                    $("input[name=validate_only]").val("0");
                    $('#edit_submit_registration').prop('disabled', false);
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditError(field,result)
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
                if (result.status == 'ok') {
                    var input = '<input type="hidden" name="product_des_master_id" value="' + result.id + '">';
                    $('#navbarForm').append(input);
                    $("#productDescriptionReload")[0].click();
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditError(field,result)
                }
            }
        });
    }
}

function deleteProductDescription(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(3);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();
    } else {
        var id = $('#productDesBango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }

}

function returnProductDescription(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(4);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();
    } else {
        var id = $('#productDesBango').val();
        $.ajax({
            type: "GET",
            url: url,
            data: {id: id},
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }

}

$(document).ready(function () {
    var innerlevel = $("#innerlevel").val();
    if (innerlevel > 14) {
        $("#common_reg_button").addClass('disabled');
        $("#common_reg_button").css({'pointer-events': 'none'});
        $("#edit_modal_open").addClass('disabled');
        $("#edit_modal_open").css({'pointer-events': 'none'});

    }

    //submit product description
    $('body').on('submit', '#registrationForm', function (event) {
        event.preventDefault();
        var url = $("input[name=submit_url]").val();
        registerProductDescription(url);
    });

//open view modal
    $('body').on('click', '.open_view', function () {
        deleteCount = 0;
        var url = $(this).data('url');
        var id = $(this).data('id');
        $("#view_modal .m_t").parent().find('.m_t').text('');
        $('#view_modal').find('#confirmation_message').empty();
        viewProductDescription(url, id);
        $('.modal-backdrop').show();
    });

//submit edit customer product
    $('body').on('submit', '#editForm', function (event) {
        event.preventDefault();
        var editUrl = $("input[name=editUrl]").val();
        editProductDescription(editUrl);
    });

//open edit modal
    $("body").on("click", '#edit_modal_open', function () {
        $("#view_modal").modal("hide");
        $('.modal-backdrop').remove();
        $('#edit_modal').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');
            $("#view_modal").modal("hide");
        });
        $('#edit_modal').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        });
        openEditProductDescription();
    });


//delete data
    $('body').on('click', '#btnDelete', function () {
        var url = $(this).data('url');
        deleteProductDescription(url);
    });
    $('body').on('click', '#btnRestore', function () {
        var url = $(this).data('url');
        returnProductDescription(url);
    });
    var url = $('#registrationForm').find("input[name='url']").val();
    if (url === '商品') {
        $('#registrationForm').find("input[name='urlsm']").attr("maxlength", 5)
    } else {
        $('#registrationForm').find("input[name='urlsm']").attr("maxlength", 10)
    }
    $('.check_product_radio').on('click', function () {
        var urlsmInput = $('#registrationForm').find("input[name='urlsm']");
        urlsmInput.val('');
        var value = $(this).val();
        if (value === '商品') {
            urlsmInput.attr("maxlength", 5);
        } else {
            urlsmInput.attr("maxlength", 10);
        }
    })
    $('body').on('keyup', '#insert_urlsm', function (e) {
        e.preventDefault();
        var length = $(this).attr('maxlength');
        var searchKeyLength = $(this).val().length;
        $('#insert_name').text('')
        if (searchKeyLength == length) {
            console.log(length, searchKeyLength);
            var type = searchKeyLength == 5 ? 'syouhin1' : 'others';
            var bango = $('#registrationForm').find('input[name=bango]').val();
            var name = $(this).val();
            $.ajax({
                type: "GET",
                url: '/product-description/bango-wise-name/' + bango + '/' + type,
                data: {name: name},
                success: function (response) {
                    $('#insert_name').text(response)
                },
            });

        }
    })

    $("#edit_datatxt0096").on('keyup', function () {
        $('#edit_mbcatch').attr('readOnly', false);
    })
})





