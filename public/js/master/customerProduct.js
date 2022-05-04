var registrationCount = 0;
var editCount = 0;
var deleteCount = 0;
var errorBorder = "border-color: red !important; border-style: solid; border-width:1px";
var normalBorder = "border-color: #29487d !important; border-style: solid; border-width:1px";

function formatNumber(num) {
    if (num == null || num == '') {
        return null;
    } else {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

}

function endWithThreeDot(value) {
    var isNotempty = value.length ? value.length : 0;
    var sentence = '';
    if (isNotempty) {
        sentence += value.substr(0, 40);
        if (value.length > 40) {
            sentence += '...';
        }
    }

    return sentence;

}

function checkForNullValue(value) {
    if (value == 'null' || value == '-') {
        return '';
    }
    return value;

}

function openRegistration() {
    registrationCount = 0;
    $("input[name=validate_only]").val("1");
    $("#registration_modal").find('.select2-selection--single').attr("style", normalBorder);
    $("#registration_modal input").parent().find('input').val('');
    $("#registration_modal select").parent().find('select').val('');
    $('#insert_company_id option:eq(0)').prop('selected', true);
    $('#insert_product_id option:eq(0)').prop('selected', true);
    $('#insert_unit_price option:eq(0)').prop('selected', true);
    $('#insert_input_category_1 option:eq(1)').prop('selected', true);
    $('#insert_input_category_2 option:eq(1)').prop('selected', true);

    $('#insert_company_id').trigger('change');
    $('#insert_product_id').trigger('change');
    $('#insert_unit_price').trigger('change');
    $("#registration_error_data").empty();
    $("#registration_modal input").parent().find('input').removeClass("error");
    $("#registration_modal select").parent().find('select').removeClass("error");
    $('#submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $('#registration_modal').modal('show');

}

function openEditRegisterCustomerProductModal() {
    editCount = 0;
    $("input[name=validate_only]").val("1");
    $("#edit_registration_error_data").empty();
    $("#edit_modal input").parent().find('input').removeClass("error");
    $("#edit_modal select").parent().find('select').removeClass("error");
    $('#edit_submit_registration').prop('disabled', false);
    $("#regFrontValidation").remove();
    $('#edit_modal').modal('show');
}

function registerCustomerProduct(url, field) {
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
                    registrationCount++;
                    var msg = getConfirmationMessage(1);
                    $('#registration_error_data').html(msg);
                    $('#registration_error_data').show();
                    $('#submit_registration').prop('disabled', false);
                    $("input[name=validate_only]").val("0");
                } else {
                    showRegistrationErrorMessage(field,result)
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                if (result.status == 'ok' || result.status == 'error') {
                    // document.getElementById("employeeMasterReload").click();
                    if (result.status == 'error') {
                        html = '<div>';
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.error_mesasge + '</p>';
                        html += '</div>';
                        document.getElementById('submit_registration').disabled = false;
                        $("#registration_error_data").html(html);
                        $("#registration_error_data").show();
                    } else if (result.status == 'ok') {
                        var input = '<input type="hidden" name="change_id" value="' + result.datachar03 + '">';
                        $('#navbarForm').append(input);
                        $("#customerProductReload")[0].click();
                    }

                } else {
                    showRegistrationErrorMessage(field,result)
                }
            }
        });
    }
}

function showRegistrationErrorMessage(field,result)
{
    var inputError = result.err_field;
    checkFrontendValidationAfterSubmit(inputError, 1);
    if (field == null) {
        $('#submit_registration').prop('disabled', false);
    }
    $("#registration_modal input").parent().find('input').removeClass("error");
    $("#registration_modal select").parent().find('select').removeClass("error");
    $("#registration_modal").find('.select2-selection--single').attr("style", normalBorder);
    $("#registration_error_data").empty();
    var html = '';
    var frontEndError = 0;
    if (result.err_msg) {
        html = '<div>';
        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';
        $('#registration_error_data').html(html);
        $("#registration_error_data").show();
    }
    console.log(inputError);
    if (inputError.basic_selling) {
        $('#insert_basic_selling').addClass("error");
    }
    if (inputError.pb_sales) {
        $('#insert_pb_sales').addClass("error");
    }
    // if (inputError.operating_margin) {
    //     $('#insert_operating_margin').addClass("error");
    // }
    // if (inputError.pb_operating_gross) {
    //     $('#insert_pb_operating_gross').addClass("error");
    // }
    if (inputError.purchase_price || inputError.operating_margin || inputError.pb_operating_gross) {
        $('#insert_purchase_price').addClass("error");
    }
    if (inputError.partition_se || inputError.operating_margin || inputError.pb_operating_gross) {
        $('#insert_partition_se').addClass("error");
    }
    if (inputError.partition_lab || inputError.operating_margin || inputError.pb_operating_gross) {
        $('#insert_partition_lab').addClass("error");
    }
    if (inputError.partition_shopping || inputError.operating_margin || inputError.pb_operating_gross) {
        $('#insert_partition_shopping').addClass("error");
    }
    if (inputError.company_id) {
        $('#insert_company_id').parent().find('.select2-selection--single').attr("style", errorBorder)
        $('#insert_company_id').addClass("error");
    }
    if (inputError.product_id) {
        $('#insert_product_id').parent().find('.select2-selection--single').attr("style", errorBorder)
        $('#insert_product_id').addClass("error");

    }
    if (inputError.unit_price) {
        $('#insert_unit_price').addClass("error");
    }
}

function viewCustomerProduct(url, id) {
    $.ajax({
        type: 'GET',
        url: url,
        data: {id: id},
        success: function (result) {
            var kakaku = result.kakaku;
            console.log(kakaku);
            if (kakaku.pointritu == 1) {
                $('#btnDelete').hide();
                $('#edit_modal_open').hide();
            }
            var company_name = kakaku.company_name;
            var product_name = kakaku.product_name;
            //add value for edited field
            $('#edit_company_id').val(endWithThreeDot(company_name));
            $('#edit_product_id').val(endWithThreeDot(product_name));
            $('#edit_unit_price').val(kakaku.icon);
            $('#edit_company_id').data('id', company_name);
            $('#edit_product_id').data('id', product_name);
            $('#edit_unit_price').data('id', kakaku.icon);
            $('#new_edit_company_id').val(kakaku.syutenjyouken);
            $('#new_edit_product_id').val(kakaku.syutenbi + '-' + kakaku.syouhinbango);
            $('#new_edit_unit_price').val(kakaku.edit_icon);

            $('#edit_basic_selling').val(kakaku.kakaku);
            $('#edit_pb_sales').val(kakaku.hanbaisu);
            $('.operating_margin_text_edit').text(kakaku.jyougensu);
            $('.pb_operating_gross_text_edit').text(kakaku.yoyaku);
            $('#edit_operating_margin').val(kakaku.jyougensu);
            $('#edit_pb_operating_gross').val(kakaku.yoyaku);
            $('#edit_purchase_price').val(kakaku.yoyakusu);
            $('#edit_partition_se').val(kakaku.yoyakukanousu);
            $('#edit_partition_lab').val(kakaku.sortbango);
            $('#edit_partition_shopping').val(kakaku.dataint01);
            $('#edit_input_category_1').val(kakaku.datachar01);
            $('#edit_input_category_2').val(kakaku.datachar02);
            $('#customerProductBango').val(kakaku.uuid);

            if (kakaku.datachar01 === "0 訂正不可") {
                $('#edit_basic_selling').attr('readonly', true);
                $('#edit_pb_sales').attr('readonly', true);
                $('#edit_purchase_price').attr('readonly', true);
                $('#edit_partition_se').attr('readonly', true);
                $('#edit_partition_lab').attr('readonly', true);
                $('#edit_partition_shopping').attr('readonly', true);
            }
            $.each(kakaku, function (index, value) {
                if (value != null) {
                    kakaku [index] = breakData(value);
                }

            });

            $('#company_id').html(kakaku.company_name);
            // $('#company_name').text(company_name);
            $('#product_id').html(kakaku.product_name);
            // $('#product_name').text(product_name);
            $('#unit_price').html(kakaku.icon);
            $('#basic_selling').html(formatNumber(kakaku.kakaku));
            $('#pb_sales').html(formatNumber(kakaku.hanbaisu));
            $('#operating_margin').html(formatNumber(kakaku.jyougensu));
            $('#pb_operating_gross').html(formatNumber(kakaku.yoyaku));
            $('#purchase_price').html(formatNumber(kakaku.yoyakusu));
            $('#partition_se').html(formatNumber(kakaku.yoyakukanousu));
            $('#partition_lab').html(formatNumber(kakaku.sortbango));
            $('#partition_shopping').html(formatNumber(kakaku.dataint01));
            $('#input_category_1').html(kakaku.datachar01);
            $('#input_category_2').html(kakaku.datachar02);


            //print value for view
            // $('#print_company_id').html(kakaku.company_name);
            // $('#print_product_id').html(kakaku.product_name);
            // $('#print_unit_price').html(kakaku.icon);
            // $('#print_basic_selling').html(formatNumber(kakaku.kakaku));
            // $('#print_pb_sales').html(formatNumber(kakaku.hanbaisu));
            // $('#print_operating_margin').html(formatNumber(kakaku.jyougensu));
            // $('#print_pb_operating_gross').html(formatNumber(kakaku.yoyaku));
            // $('#print_purchase_price').html(formatNumber(kakaku.yoyakusu));
            // $('#print_partition_se').html(formatNumber(kakaku.yoyakukanousu));
            // $('#print_partition_lab').html(formatNumber(kakaku.sortbango));
            // $('#print_partition_shopping').html(formatNumber(kakaku.dataint01));
            // $('#print_input_category_1').html(kakaku.datachar01);
            // $('#print_input_category_2').html(kakaku.datachar02);

            $('#view_modal').modal('show');
        }
    });
}

function editCustomerProduct(url, field) {
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
                    editCount++;
                    var msg = getConfirmationMessage(2);
                    $('#edit_registration_error_data').html(msg);
                    $('#edit_registration_error_data').show();
                    $('#edit_submit_registration').prop('disabled', false);
                    $("input[name=validate_only]").val("0");
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditErrorMessage(field,result)
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
                    var input = '<input type="hidden" name="change_id" value="' + result.datachar03 + '">';
                    $('#navbarForm').append(input);
                    $("#customerProductReload")[0].click();
                } else {
                    showEditErrorMessage(field,result)
                }
            }
        });
    }
}

function showEditErrorMessage(field,result)
{
    var editInputError = result.err_field;
    checkFrontendValidationAfterSubmit(editInputError, 2);

    if (field == null) {
        $('#edit_submit_registration').prop('disabled', false);
    }
    $("#edit_modal input").parent().find('input').removeClass("error");
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

    if (editInputError.basic_selling) {
        $('#edit_basic_selling').addClass("error");
    }
    if (editInputError.pb_sales) {
        $('#edit_pb_sales').addClass("error");
    }
    if (editInputError.operating_margin) {
        $('#edit_operating_margin').addClass("error");
    }
    if (editInputError.pb_operating_gross) {
        $('#edit_pb_operating_gross').addClass("error");
    }
    if (editInputError.purchase_price || editInputError.operating_margin || editInputError.pb_operating_gross) {
        $('#edit_purchase_price').addClass("error");
    }
    if (editInputError.partition_se || editInputError.operating_margin || editInputError.pb_operating_gross) {
        $('#edit_partition_se').addClass("error");
    }
    if (editInputError.partition_lab || editInputError.operating_margin || editInputError.pb_operating_gross) {
        $('#edit_partition_lab').addClass("error");
    }
    if (editInputError.partition_shopping || editInputError.operating_margin || editInputError.pb_operating_gross) {
        $('#edit_partition_shopping').addClass("error");
    }
    if (editInputError.company_id) {
        $('#edit_company_id').addClass("error");
    }
    if (editInputError.product_id) {
        $('#edit_product_id').addClass("error");
    }
    if (editInputError.unit_price) {
        $('#edit_unit_price').addClass("error");
    }
}

function deleteCustomerProduct(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(3);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();
    } else {
        var id = $('#customerProductBango').val();
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

function returnCustomerProduct(url) {
    if (deleteCount === 0) {
        deleteCount++;
        var msg = getConfirmationMessage(4);
        $("#view_modal #confirmation_message").html(msg);
        $("#view_modal #confirmation_message").show();
    } else {
        var id = $('#customerProductBango').val();
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
function makeSuitableNumber($value) {
    if (isNaN($value)) {
        return 0
    }
    return $value;
}

$(document).ready(function(){
    var innerlevel = $("#innerlevel").val();
    if(innerlevel>14){
        $("#common_reg_button").addClass('disabled');
        $("#common_reg_button").css({'pointer-events':'none'});
        $("#edit_modal_open").addClass('disabled');
        $("#edit_modal_open").css({'pointer-events': 'none'});
    }
    //submit customer product
    $('body').on('submit', '#registrationForm', function (event) {
        event.preventDefault();
        var url = $("input[name=url]").val();
        registerCustomerProduct(url);
    });

//open view modal
    $('body').on('click', '.open_view', function () {
        deleteCount = 0;
        var url = $(this).data('url');
        var id = $(this).data('id');
        $("#view_modal .m_t").parent().find('.m_t').text('');
        $('#view_modal').find('#confirmation_message').empty();
        viewCustomerProduct(url, id);
        $('.modal-backdrop').show();
    });

//submit edit customer product
    $('body').on('submit', '#editForm', function (event) {
        event.preventDefault();
        var editUrl = $("input[name=editUrl]").val();
        editCustomerProduct(editUrl);
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
        openEditRegisterCustomerProductModal();
    });
//delete data
    $('body').on('click', '#btnDelete', function () {
        var url = $(this).data('url');
        deleteCustomerProduct(url);
    });
    $('body').on('click', '#btnRestore', function () {
        var url = $(this).data('url');
        returnCustomerProduct(url);
    });
    $('.subsBy').on('keyup', function (e) {
        var basic_selling = $("input[name=basic_selling]").val();
        var basic_selling = Number(basic_selling);
        var pb_sales = $("input[name=pb_sales]").val();
        var pb_sales = Number(pb_sales);
        var purchase_price = $("input[name=purchase_price]").val();
        var purchase_price = Number(purchase_price);
        var partition_se = $("input[name=partition_se]").val();
        var partition_se = Number(partition_se);
        var partition_lab = $("input[name=partition_lab]").val();
        var partition_lab = Number(partition_lab);
        var partition_shopping = $("input[name=partition_shopping]").val();
        var partition_shopping = Number(partition_shopping);
        var result = {
            partition_se: partition_se,
            purchase_price: purchase_price,
            partition_lab: partition_lab,
            partition_shopping: partition_shopping
        }
        var currentValue = e.currentTarget.name;

        var sum = 0;
        for (var val in result) {
            if (val !== currentValue) {
                sum += result[val];
            }
        }
        var resultSix = Number(e.target.value) + sum;
        var res1 = basic_selling - resultSix;
        var res2 = pb_sales - resultSix;
        $('.operating_margin_text').text(res1);
        $('#add_operating_margin').val(res1);
        $('.pb_operating_gross_text').text(res2);
        $('#add_pb_operating_gross').val(res2)


    });
    $('.subs').on('keyup', function (e) {
        var basic_selling = $("input[name=basic_selling]").val();
        var basic_selling = Number(basic_selling);
        var pb_sales = $("input[name=pb_sales]").val();
        var pb_sales = Number(pb_sales);
        var purchase_price = $("input[name=purchase_price]").val();
        var purchase_price = Number(purchase_price);
        var partition_se = $("input[name=partition_se]").val();
        var partition_se = Number(partition_se);
        var partition_lab = $("input[name=partition_lab]").val();
        var partition_lab = Number(partition_lab);
        var partition_shopping = $("input[name=partition_shopping]").val();
        var partition_shopping = Number(partition_shopping);
        var result = (purchase_price + partition_se + partition_lab + partition_shopping)

        var currentValue = e.currentTarget.name;

        if (currentValue == 'basic_selling') {
            var resultOne = pb_sales - result;
            var resultTwo = e.target.value - result;
            $('.operating_margin_text').text(resultTwo);
            $('#add_operating_margin').val(resultTwo);
            $('.pb_operating_gross_text').text(resultOne);
            $('#add_pb_operating_gross').val(resultOne);

        } else {
            var resultThree = basic_selling - result;
            var resultFour = e.target.value - result;
            $('.operating_margin_text').text(resultThree);
            $('#add_operating_margin').val(resultThree);
            $('.pb_operating_gross_text').text(resultFour);
            $('#add_pb_operating_gross').val(resultFour);
        }


    });
    $('.e_subsBy').on('keyup', function (e) {
        var basic_selling = $("#editForm").find("input[name=basic_selling]").val();
        var basic_selling = Number(basic_selling);
        var pb_sales = $("#editForm").find("input[name=pb_sales]").val();
        var pb_sales = Number(pb_sales);
        var purchase_price = $("#editForm").find("input[name=purchase_price]").val();
        var purchase_price = Number(purchase_price);
        var partition_se = $("#editForm").find("input[name=partition_se]").val();
        var partition_se = Number(partition_se);
        var partition_lab = $("#editForm").find("input[name=partition_lab]").val();
        var partition_lab = Number(partition_lab);
        var partition_shopping = $("#editForm").find("input[name=partition_shopping]").val();
        var partition_shopping = Number(partition_shopping);
        var result = {
            partition_se: partition_se,
            purchase_price: purchase_price,
            partition_lab: partition_lab,
            partition_shopping: partition_shopping
        }
        var currentValue = e.currentTarget.name;

        var sum = 0;
        for (var val in result) {
            if (val !== currentValue) {
                sum += result[val];
            }
        }
        var resultSix = Number(e.target.value) + sum;
        var res1 = basic_selling - resultSix;
        var res2 = pb_sales - resultSix;

        $('.operating_margin_text_edit').text(res1);
        $("#edit_operating_margin").val(res1);
        $('.pb_operating_gross_text_edit').text(res2);
        $("#edit_pb_operating_gross").val(res2)


    });
    $('.e_subs').on('keyup', function (e) {
        var basic_selling = $("#editForm").find("input[name=basic_selling]").val();
        var basic_selling = Number(basic_selling);
        var pb_sales = $("#editForm").find("input[name=pb_sales]").val();
        var pb_sales = Number(pb_sales);
        var purchase_price = $("#editForm").find("input[name=purchase_price]").val();
        var purchase_price = Number(purchase_price);
        var partition_se = $("#editForm").find("input[name=partition_se]").val();
        var partition_se = Number(partition_se);
        var partition_lab = $("#editForm").find("input[name=partition_lab]").val();
        var partition_lab = Number(partition_lab);
        var partition_shopping = $("#editForm").find("input[name=partition_shopping]").val();
        var partition_shopping = Number(partition_shopping);
        var result = (purchase_price + partition_se + partition_lab + partition_shopping)

        var currentValue = e.currentTarget.name;

        if (currentValue == 'basic_selling') {
            var resultOne = pb_sales - result;
            var resultTwo = e.target.value - result;
            $('.operating_margin_text_edit').text(resultTwo);
            $("#edit_operating_margin").val(resultTwo);
            $('.pb_operating_gross_text_edit').text(resultOne);
            $("#edit_pb_operating_gross").val(resultOne);

        } else {
            var resultThree = basic_selling - result;
            var resultFour = e.target.value - result;
            $('.operating_margin_text_edit').text(resultThree);
            $("#edit_operating_margin").val(resultThree);
            $('.pb_operating_gross_text_edit').text(resultFour);
            $("#edit_pb_operating_gross").val(resultFour);
        }


    });

    $(".message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.hover_message').html(mssg);

    }, function () {
        $('.hover_message').html('');
    });
// Registration Modal
    $('#registration_modal').on('shown.bs.modal', function () {
        $("#insert_company_id").focus();
    });
    $("#registration_modal").on("hidden.bs.modal", function () {
        $(this).find('.operating_margin_text').text('');
        $(this).find('.pb_operating_gross_text').text('');
    });
// Edit Modal
    $('#edit_modal').on('shown.bs.modal', function () {
        $("#edit_company_id").focus();
    });
// Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
        $("#setting_product_name").focus();
    });
    $('#edit_input_category_1').on('change',function () {
        $('#edit_basic_selling').attr('readonly', false);
        $('#edit_pb_sales').attr('readonly', false);
        $('#edit_purchase_price').attr('readonly', false);
        $('#edit_partition_se').attr('readonly', false);
        $('#edit_partition_lab').attr('readonly', false);
        $('#edit_partition_shopping').attr('readonly', false);
    })

})
