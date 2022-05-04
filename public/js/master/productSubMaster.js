var productSubReg = 0;
var productSubEdit = 0;
var productSubDeleteRetrieve = 0;

function openRegistration() {
    $("#regFrontValidation").remove();

    if (level < 15) {
        productSubReg = 0;
        $("#error_data").empty();
        $("#product_sub_modal1 input").parent().find('input').val('');
        $("#product_sub_modal1 select").parent().find('select').val('');
        $("#product_sub_modal1 input").parent().find('input').removeClass("error");
        $("#product_sub_modal1 select").parent().find('select').removeClass("error");
        $("#product_sub_modal1 div").parent().find('div').removeClass("error");

        //$('#insert_other1 option:eq(2)').prop('selected', true);
        $('#insert_other1').val('1 運送会社');
        $('#insert_other14').val('3 受付');
        $('#insert_other3 option:eq(0)').prop('selected', true);
        $('#insert_other4 option:eq(0)').prop('selected', true);
        $('#insert_other25 option:eq(0)').prop('selected', true);
        $('#insert_other17').val('1 訂正可');
        $('#show25').html('');
        $('#insert_other9').html('');
        $('#insert_other10').html('');
        $('#insert_other11').html('');

        $('#product_sub_modal1').modal('show');
        getOther2();
        getOther4();
        getOther25();
        tantousyaApi($('#insert_other12 option:eq(0)').val());
    }
}


function openPopUpModal() {
    $("#product_supplier_content1").hide();
    $("#product_supplier_content2").hide();
    $("#product_supplier_content3").hide();
    var number = null;
    $("#product_sub_modal4 input").parent().find('input').val('');
    $("#product_sub_modal4").modal('show');


    $('.modal-backdrop').show();


}

function tantousyaApi(bango) {
    if ($("#insert_other12").val()) {
        var data = $("#insert_other12").val();
    } else {
        var data = null;
    }

    console.log(data)
    var url = "/product_sub/Api/" + data + "/" + bango;
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        success: function (response) {
            console.log(response);
            if (response[0]) {
                if (response[0].company_1 == null) {
                    response[0].company_1 = '';
                }
                if (response[0].company_2 == null) {
                    response[0].company_2 = '';
                }
                if (response[0].company_3 == null) {
                    response[0].company_3 = '';
                }
                var company_1 = response[0].company_1;
                var company_2 = response[0].company_2;
                var company_3 = response[0].company_3;

                $("#insert_other9").text(company_1 ? company_1.replace(company_1.slice(0, 2), "") : '');
                $("#insert_other10").text(company_2 ? company_2.replace(company_2.slice(0, 2), "") : '');
                $("#insert_other11").text(company_3 ? company_3.replace(company_3.slice(0, 2), "") : '');

                $("#other9_hidden").val(response[0].datatxt0003);
                // $("#insert_other10").text(response[0].bango+' '+response[0].datatxt0004);
                $("#other10_hidden").val(response[0].datatxt0004);
                // $("#insert_other11").text(response[0].bango+' '+response[0].datatxt0005);
                $("#other11_hidden").val(response[0].datatxt0005);

            }

        },
    });
}

function tantousyaApiEdit(bango) {

    if (("#edit_other12")) {
        var data = $("#edit_other12").val();
    }

    console.log(data)
    var url = "/product_sub/Api/" + data + "/" + bango;
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        success: function (response) {
            if (response[0]) {
                if (response[0].company_1 == null) {
                    response[0].company_1 = '';
                }
                if (response[0].company_2 == null) {
                    response[0].company_2 = '';
                }
                if (response[0].company_3 == null) {
                    response[0].company_3 = '';
                }
                var company_1 = response[0].company_1;
                var company_2 = response[0].company_2;
                var company_3 = response[0].company_3;

                $("#edit_other9").text(company_1 ? company_1.replace(company_1.slice(0, 2), "") : '');
                $("#edit_other10").text(company_2 ? company_2.replace(company_2.slice(0, 2), "") : '');
                $("#edit_other11").text(company_3 ? company_3.replace(company_3.slice(0, 2), "") : '');

                // $("#edit_other9").text(response[0].bango+' '+response[0].datatxt0003);
                $("#edit_other9_hidden").val(response[0].datatxt0003);
                // $("#edit_other10").text(response[0].bango+' '+response[0].datatxt0004);
                $("#edit_other10_hidden").val(response[0].datatxt0004);
                // $("#edit_other11").text(response[0].bango+' '+response[0].datatxt0005);
                $("#edit_other11_hidden").val(response[0].datatxt0005);

            }

        },
    });
}

function showRegistrationError(field, result) {
    if (field == null) {
        document.getElementById('regButton').disabled = false;
    }
    var inputError = result.err_field;
    console.log(inputError);
    //check front validation after submit
    checkFrontendValidationAfterSubmit(inputError, 1); //1 for reg

    $("#product_sub_modal1 input").parent().find('input').removeClass("error");
    $("#product_sub_modal1 select").parent().find('select').removeClass("error");
    $("#product_sub_modal1 div").parent().find('div').removeClass("error");
    $("#error_data").empty();
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

    for (var key in inputError) {
        console.log(key + '=' + inputError[key]);
        if (key) {
            $('#insert_' + key).addClass("error");
        }

        if (key == 'other2') {
            $('#insert_other2').parent().addClass("error")
        }

    }

}
function showEditError(field, result) {
    if (field == null) {
        document.getElementById('editButton').disabled = false;
    }
    var inputError = result.err_field;
    console.log(inputError);
    //check front validation after submit
    checkFrontendValidationAfterSubmit(inputError, 2); //2 for edit

    $("#product_sub_modal3 input").parent().find('input').removeClass("error");
    $("#product_sub_modal3 select").parent().find('select').removeClass("error");
    $("#product_sub_modal3 div").parent().find('div').removeClass("error");
    $("#error_dataEdit").empty();
    var html = '';
    if (result.err_msg) {
        html = '<div>';

        for (var count = 0; count < result.err_msg.length; count++) {
            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + result.err_msg[count] + '</p>';
        }
        html += '</div>';

        $('#error_dataEdit').html(html);

        $("#error_dataEdit").show();
    }

    for (var key in inputError) {
        console.log(key + '=' + inputError[key]);
        if (key) {
            $('#edit_' + key).addClass("error");
            $('#edit_' + key + '_origial').addClass("error");
            $('#edit_' + key + '_modified').addClass("error");
        }

    }
}

function registerProductSub(url, field) {
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

    if (productSubReg == 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                // console.log(result);
                if (typeof (result.status) == 'string') {
                    productSubReg++;
                    var html = getConfirmationMessage(1);
                    $('#error_data').html(html);
                    $("#error_data").show();
                    document.getElementById('regButton').disabled = false;
                    $("input[name=validate_only]").val("0");
                } else {
                    showRegistrationError(field, result)
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
                // console.log(result);
                if (typeof (result.status) == 'string') {
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $('#product_sub_modal1').modal('hide');
                    document.getElementById("ProductSubMasterReload").click();
                } else {
                    showRegistrationError(field, result)
                }
            }
        });
    }
}

function editProductSub(url, field) {
    //IE support
    if (field == undefined) {
        field = null;
    }
    var data = new FormData(document.getElementById('editForm'));
    if (field != null) {
        data.append('field', field);
    } else {
        document.getElementById('editButton').disabled = true;
    }

    if (productSubEdit == 0 && field == null) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (typeof (result.status) == 'string') {
                    productSubEdit++;
                    var html = getConfirmationMessage(2);
                    $('#error_dataEdit').html(html);
                    $("#error_dataEdit").show();
                    document.getElementById('editButton').disabled = false;
                    $("input[name=validate_only]").val("0");
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditError(field, result)

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
                if (typeof (result.status) == 'string') {
                    //location.reload();
                    console.log(result);
                    input = '<input type="hidden" name="change_id" value="' + result.change_id + '">';
                    jQuery('#navbarForm').append(input);
                    $('#product_sub_modal2').modal('hide');
                    document.getElementById("ProductSubMasterReload").click();
                } else {
                    $("input[name=validate_only]").val("0");
                    showEditError(field, result);
                }
            }
        });
    }
}

function viewDetail(url, id) {
    productSubEdit = 0;
    productSubDeleteRetrieve = 0;
    $("#productsub_detail_error_data").hide();

    $.ajax({
        type: 'get',
        url: url,
        data: { id: id },
        success: function (result) {
            $.each(result, function (index, value) {
                if (value != null) {
                    result[index] = value;
                }
            });
            $("#e_other25").val(result.primarykey)

            $("#product_sub_modal3 input").parent().find('input').removeClass("error");
            $("#product_sub_modal3 select").parent().find('select').removeClass("error");
            $("#product_sub_modal3 div").parent().find('div').removeClass("error");
            $("#error_dataEdit").empty();
            if (result.other19 == 1) {
                document.getElementById('deleteThis').style.display = 'none';
                document.getElementById('productSubButton3').style.display = 'none';
            }
            for (var key in result) {
                // console.log(key + '=' + result[key]);
                if ($('#detail_' + key)) {
                    console.log(key + '=' + result[key]);
                    // if(key == 'other2'){
                    //     var other3cat4 = result['other3cat4'];
                    //     var other4cat4 = result['other4cat4'];
                    //     var other25cat4 = result['other25cat4'];
                    //     $('#detail_' + key).html(result[key]+' '+other3cat4+'/'+other4cat4+'/'+other25cat4);
                    // }else{
                    $('#detail_' + key).text(result[key]);
                    // }

                }

            }

            for (var key in result) {
                // console.log(key + '=' + result[key]);

                if ($('#edit_' + key)) {
                    console.log(key + '=' + result[key]);
                    if (key == 'other3' || key == 'other4' || key == 'other25') {
                        $('#edit_' + key).text(result[key] + ' ' + result[key + 'cat4']);
                    } else if (key == 'other2') {
                        $('#edit_' + key).text(result[key]);
                    } else if (key == 'other1') {
                        $('#edit_' + key).text(result['other1']);
                    } else if (key == 'other15_modified' || key == 'other16_modified') {
                        if (result[key] != null && result[key] != '') {
                            result[key] = result[key].replace("/", "");
                            result[key] = result[key].replace("/", "");
                        }
                        $('#edit_' + key).val(result[key]);
                    } else if (key == 'other17_original') {
                        if (result['other17_original'] == '0 訂正不可') {
                            $('#edit_other21').attr('readonly', 'readonly');
                            $('#edit_' + key).val(result['other17_original']);
                        } else {
                            $('#edit_other21').removeAttr('readonly');
                            $('#edit_' + key).val(result['other17_original']);
                        }

                    } else {
                        $('#edit_' + key).val(result[key]);
                    }

                }

                $('#edit_hidden_other22').val(result['other22']);
                $('#edit_hidden_other23').val(result['other23']);
                $('#edit_hidden_other24').val(result['other24']);
                $('#edit_hidden_other18').val(result['other18']);
                $('#edit_hidden_other1').val(result['other1']);
                $('#edit_other2_hidden').val(result['other2_original']);
                $('#edit_hidden_other1_detail').val(result['other1']);
                $('#edit_other9').text(result['other9']);
                $('#edit_other10').text(result['other10']);
                $('#edit_other11').text(result['other11']);
                $('#edit_other9_hidden').val(result['other9_original']);
                $('#edit_other10_hidden').val(result['other10_original']);
                $('#edit_other11_hidden').val(result['other11_original']);
            }

            for (var key in result) {
                // console.log(key + '=' + result[key]);
                if ($('#print_' + key)) {
                    console.log(key + '=' + result[key]);
                    $('#print_' + key).html(result[key]);
                }

            }


            $('#product_sub_modal2').on('show.bs.modal', function (e) {
                $('body').addClass('overflow_cls');
                $("#product_sub_modal2").css('overflow', 'hidden');

            })
            $("#product_sub_modal2").modal('show');
            $('.modal-backdrop').show();

        }
    });
}

function deleteProductSubMaster(url) {
    if (productSubDeleteRetrieve == 0) {
        productSubDeleteRetrieve++;
        var html = getConfirmationMessage(3);
        $('#productsub_detail_error_data').html(html);
        $("#productsub_detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_primarykey').value;
        $.ajax({
            type: "GET",
            url: url,
            data: { kesuId: kesuId },
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }
}

function returnProductSubMaster(url) {
    if (productSubDeleteRetrieve == 0) {
        productSubDeleteRetrieve++;
        var html = getConfirmationMessage(4);
        $('#productsub_detail_error_data').html(html);
        $("#productsub_detail_error_data").show();

    } else {
        var kesuId = document.getElementById('edit_primarykey').value;
        $.ajax({
            type: "GET",
            url: url,
            data: { kesuId: kesuId },
            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    }
}

function getOther2() {
    var other3 = $("#insert_other3").val();
    other3 = other3.substring(2);
    var other3text = $("#insert_other3 option:selected").text();
    var url = "/product_sub/getCatogoryData";
    var data = '';
    var catValue;
    var i;
    if (other3 != '' && other3 != null && other3 != 'undefined') {
        $.ajax({
            type: "GET",
            url: url,
            data: { other3: other3 },
            success: function (response) {
                for (i = 0; i < response.length; i++) {
                    if (i == 0) {
                        catValue = response[i].category1 + '' + response[i].category2;
                    }
                    data += '<option value="' + response[i].category1 + '' + response[i].category2 + '">' + response[i].category2 + ' ' + response[i].category4 + '</option>'
                }
                $("#insert_other4").html(data);
                getOther4(catValue);
                getOther25();
            },
        });
    }

}

function getOther4(value) {
    var url = "/product_sub/getCatogoryData";
    var data = '';
    var i;
    if (value != '' && value != null && value != 'undefined') {
        value = value.substring(2)
        $.ajax({
            type: "GET",
            url: url,
            data: { other4: value },
            success: function (response) {
                for (i = 0; i < response.length; i++) {
                    data += '<option value="' + response[i].category1 + '' + response[i].category2 + '">' + response[i].category2 + ' ' + response[i].category4 + '</option>'
                }
                $("#insert_other25").html(data);
                getOther25();
            },
        });
    }
}

function getOther25() {
    var other3 = $("#insert_other3").val() ? $("#insert_other3").val().substring(2) : '';
    var other3text = $("#insert_other3 option:selected").text();
    var other4 = $("#insert_other4").val() ? $("#insert_other4").val().substring(2) : '';
    var other4text = $("#insert_other4 option:selected").text();
    var other25 = $("#insert_other25").val() ? $("#insert_other25").val().substring(2) : '';
    var other25text = $("#insert_other25 option:selected").text();
    if ((other3 != "" && other4 != "" && other25 != "") && (other3 != null && other4 != null && other25 != null)
        && (other3 != 'undefined' && other4 != 'undefined' && other25 != 'undefined')) {
        $("#insert_other2").val(other25);
        console.log(other3text, other3text.split(" "))
        var other3cat4 = other3text.split(" ");
        var other4cat4 = other4text.split(" ");
        var other25cat4 = other25text.split(" ");
        $("#show25").html(other25 + ' ' + other3cat4[1] + '/' + other4cat4[1] + '/' + other25cat4[1]);

    } else {
        $("#show25").html("");
    }
}

function other17effect() {
    $('#edit_other21').removeAttr('readonly');
}
$(document).ready(function () {
    var innerlevel = $("#innerlevel").val();
    if (innerlevel > 14) {
        $("#common_reg_button").addClass('disabled');
        $("#common_reg_button").css({ 'pointer-events': 'none' });
        $("#productSubButton3").addClass('disabled');
        $("#productSubButton3").css({ 'pointer-events': 'none' });

    }
})
