var buttonPress = 0;

function goToPage(tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {

        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                var i = document.getElementById("paginate").value;

                if (i < 1) {
                    document.getElementById("paginate").value = 1;
                } else {
                    document.getElementById("paginate").value = i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }

                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                var i = document.getElementById("paginate2").value;

                if (i < 1) {
                    document.getElementById("paginate2").value = 1;
                } else {
                    document.getElementById("paginate2").value = i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }

                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                var i = document.getElementById("paginate").value;

                if (i < 1) {
                    document.getElementById("paginate").value = 1;
                } else {
                    document.getElementById("paginate").value = i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            var i = document.getElementById("paginate").value;

            if (i < 1) {
                document.getElementById("paginate").value = 1;
            } else {
                document.getElementById("paginate").value = i;
            }

            var mood = document.getElementById('Button').value;
            if (mood == 'sort') {
                document.getElementById('Button').value = 'sort';
            } else {
                document.getElementById('Button').value = 'Thesearch';
            }
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
    } else {
        doubleClick();
    }
}

function gotoBack(tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {
        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('paginationhelper').disabled = false;

                var i = document.getElementById("paginate").value;
                if (i <= 1) {
                    document.getElementById("paginationhelper").value = 1;
                } else {
                    document.getElementById("paginationhelper").value = --i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate').disabled = true;
                document.getElementById('paginationhelper').disabled = false;
                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('paginationhelper2').disabled = false;

                var i = document.getElementById("paginate2").value;
                if (i <= 1) {
                    document.getElementById("paginationhelper2").value = 1;
                } else {
                    document.getElementById("paginationhelper2").value = --i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate2').disabled = true;
                document.getElementById('paginationhelper2').disabled = false;

                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                document.getElementById('paginationhelper').disabled = false;

                var i = document.getElementById("paginate").value;
                if (i <= 1) {
                    document.getElementById("paginationhelper").value = 1;
                } else {
                    document.getElementById("paginationhelper").value = --i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate').disabled = true;
                document.getElementById('paginationhelper').disabled = false;
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            document.getElementById('paginationhelper').disabled = false;

            var i = document.getElementById("paginate").value;
            if (i <= 1) {
                document.getElementById("paginationhelper").value = 1;
            } else {
                document.getElementById("paginationhelper").value = --i;
            }

            var mood = document.getElementById('Button').value;
            if (mood == 'sort') {
                document.getElementById('Button').value = 'sort';
            } else {
                document.getElementById('Button').value = 'Thesearch';
            }
            document.getElementById('paginate').disabled = true;
            document.getElementById('paginationhelper').disabled = false;
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
    } else {
        doubleClick();
    }
}

function goForward(tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {
        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('paginationhelper').disabled = false;
                var i = document.getElementById("paginate").value;

                if (i < 1) {
                    document.getElementById("paginationhelper").value = 1;
                } else {
                    document.getElementById("paginationhelper").value = ++i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate').disabled = true;
                document.getElementById('paginationhelper').disabled = false;
                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('paginationhelper2').disabled = false;
                var i = document.getElementById("paginate2").value;

                if (i < 1) {
                    document.getElementById("paginationhelper2").value = 1;
                } else {
                    document.getElementById("paginationhelper2").value = ++i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate2').disabled = true;
                document.getElementById('paginationhelper2').disabled = false;
                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                document.getElementById('paginationhelper').disabled = false;
                var i = document.getElementById("paginate").value;

                if (i < 1) {
                    document.getElementById("paginationhelper").value = 1;
                } else {
                    document.getElementById("paginationhelper").value = ++i;
                }

                var mood = document.getElementById('Button').value;
                if (mood == 'sort') {
                    document.getElementById('Button').value = 'sort';
                } else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('paginate').disabled = true;
                document.getElementById('paginationhelper').disabled = false;
                // document.getElementById('mainForm').method = "post";
                // document.getElementById('mainForm').submit();
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            document.getElementById('paginationhelper').disabled = false;
            var i = document.getElementById("paginate").value;

            if (i < 1) {
                document.getElementById("paginationhelper").value = 1;
            } else {
                document.getElementById("paginationhelper").value = ++i;
            }

            var mood = document.getElementById('Button').value;
            if (mood == 'sort') {
                document.getElementById('Button').value = 'sort';
            } else {
                document.getElementById('Button').value = 'Thesearch';
            }
            document.getElementById('paginate').disabled = true;
            document.getElementById('paginationhelper').disabled = false;
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
    } else {
        doubleClick();
    }
}

function changeByDataAmount(tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {
        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                if (document.getElementById("paginate")) {
                    document.getElementById("paginate").value = 1;
                }
                if (document.getElementById('Button').value == 'xls') {
                    document.getElementById('Button').value = 'refresh';
                }
                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                if (document.getElementById("paginate2")) {
                    document.getElementById("paginate2").value = 1;
                }
                if (document.getElementById('Button').value == 'xls') {
                    document.getElementById('Button').value = 'refresh';
                }
                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                if (document.getElementById("paginate")) {
                    document.getElementById("paginate").value = 1;
                }
                if (document.getElementById('Button').value == 'xls') {
                    document.getElementById('Button').value = 'refresh';
                }else {
                    document.getElementById('Button').value = 'Thesearch';
                }
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            if (document.getElementById("paginate")) {
                document.getElementById("paginate").value = 1;
            }
            if (document.getElementById('Button').value == 'xls') {
                document.getElementById('Button').value = 'refresh';
            }
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
    } else {
        doubleClick();
    }
}

function Thesearch(tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {
        if (document.getElementById("paginate")) {
            document.getElementById("paginate").value = 1;
        }

        document.getElementById('Button').value = 'Thesearch';

        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }

    } else {
        doubleClick();
    }
}

function AscDsc(field,tableTypeValue) {
    buttonPress++;
    if (buttonPress == 1) {

        if (document.getElementById("paginate")) {
            document.getElementById("paginate").value = 1;
        }

        var previousSort = document.getElementById('sortType').value;
        var previousField = document.getElementById('sortField').value;

        if (previousField && previousSort) {
            if (previousField == field) {
                if (previousSort == 'ASC') {
                    sortOrder = 'DESC';
                } else {
                    sortOrder = 'ASC';
                }
            } else {
                sortOrder = 'ASC';
            }
        } else {
            sortOrder = 'ASC';
        }

        document.getElementById('sortType').value = sortOrder;
        document.getElementById('sortField').value = field;
        document.getElementById('Button').value = 'sort';
        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('tableType').value = 'orderDataTable';
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('tableType').value = 'purchaseDataTable';
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
        }
        else
        {
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }

    } else {
        doubleClick();
    }
}

function doubleClick() {
    alert('処理中です');
}

function refresh(tableTypeValue) {
    if ($("#company_yobi12").length) {
        document.getElementById('company_yobi12').value = "";
    }

    buttonPress++;
    if (buttonPress == 1) {
        if (document.getElementById("paginate")) {
            document.getElementById("paginate").value = 1;
        }

        document.getElementById('Button').value = 'refresh';
        //document.getElementById('csrf').disabled=false;
        if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('tableType').value = 'orderDataTable';
                $('.B_Button').val('refresh');
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('tableType').value = 'purchaseDataTable';
                $('.B_Button').val('refresh');
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
    } else {
        doubleClick();
    }
}

function excelDownload(tableTypeValue) {

    document.getElementById('excelDwld').disabled = true;
    document.getElementById('Button').value = 'xls';
    //document.getElementById('csrf').disabled=false;
    if ($('#tableTypeDefinition').length){
            if (tableTypeValue=='orderDataTable'){
                document.getElementById('tableType').value = 'orderDataTable';
                $('.B_Button').val('xls');
                document.getElementById('mainForm').method = "post";
                document.getElementById('mainForm').submit();
            }
            else if (tableTypeValue=='purchaseDataTable'){
                document.getElementById('tableType').value = 'purchaseDataTable';
                $('.B_Button').val('xls');
                document.getElementById('mainForm2').method = "post";
                document.getElementById('mainForm2').submit();
            }
            else if (tableTypeValue=='purchaseSlipTable'){
                document.getElementById('tableType').value = 'purchaseSlipTable';
                document.getElementById('insertData').method = "post";
                document.getElementById('insertData').submit();
            }
        }
        else
        {
            document.getElementById('mainForm').method = "post";
            document.getElementById('mainForm').submit();
        }
}


function showTableSetting(url) {

    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $("#setting_display_modal input").parent().find('input').removeClass("error");
            $('#errorShow').empty();
            if (typeof (response) == 'string') {
                $('#setting_display_modal').modal('show');
            } else {
                for (var key in response) {
                    // console.log(key + '=' + response[key]);
                    if (response[key] > 199) {
                        document.getElementById('setting_' + key).value = '';
                        // $('#setting_' + key).prop('readonly', true);
                    } else {
                        document.getElementById('setting_' + key).value = response[key];
                    }
                    if (response[key] || response[key] == '0') {
                        document.getElementById("check_" + key).checked = true;
                        if ($('#setting_' + key).prop('readonly')) {
                            $('#setting_' + key).prop('readonly', false);
                        }
                    }
                    /* else if(Object.keys(response)[0])
                     {
                       document.getElementById("check_"+key).checked = true;
                     }*/
                    else {
                        document.getElementById("check_" + key).checked = false;
                        $('#setting_' + key).prop('readonly', true);
                    }
                }

                $('#setting_display_modal').modal('show');
            }
        },
    });
}


function saveTableSetting(menu) {
    var url = $('#tableSetting').attr('action');

    var data = $('#tableSetting').serialize();

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {

            console.log(response);
            //alert(response);
            $(document).find("#tableSettingSubmit").prop("disabled", true)
            location.reload();
            // refresh();
            //document.getElementById(menu).click();
        },
        error: function () {
            $(document).find("#tableSettingSubmit").prop("disabled", false)
        }
    });

}


function clearTableSetting(url) {
    buttonPress++;
    if (buttonPress == 1) {


        $.ajax({
            type: "GET",
            url: url,

            success: function (response) {
                console.log(response);
                location.reload();
            },
        });
    } else {
        doubleClick();
    }
}

function closeSetting() {
    buttonPress = 0;
    $('#setting_display_modal').modal('hide');

}


//show registration form
function show_new_registration() {

    $('#registrationForm').trigger("reset");
    $("#error_data").hide();
    $('.error').each(function () {
        if (this.classList.contains("error")) {
            this.classList.remove("error");
            //this.parentNode.removeChild(this.nextSibling);
        }
    });
    $('#registrationModal').modal('show');
}


function closeModal(modalId) {
    buttonPress = 0;
    $('#' + modalId).modal('hide');
}

$(document).on("click", "#tableSettingSubmit", function () {
    $(this).prop("disabled", true)
    var attributes = [];
    var redirect_path = $('input[name=redirect_path]').val();

    $(this).parents('form').find('input[type="text"],input[type="tel"]').each(function () {
        attributes.push($(this).attr('name'));
    });

    var error = 0;
    var largeNumber = 0;
    var sameValueError = 0;
    $("#setting_display_modal input").parent().find('input').removeClass("error");
    var sameValue = [];
    for (var i = 0; i < attributes.length; i++) {
        if ($("#check_" + attributes[i]).prop('checked') != true && $("#setting_" + attributes[i]).val() != "") {
            error++;
            $('#setting_' + attributes[i]).addClass("error");
        }
        //check for same value
        var settings_value = $('#setting_' + attributes[i]).val();

        if (settings_value != "") {
            var int_value = parseInt(settings_value);
            if (sameValue.indexOf(int_value) === -1) {
                sameValue.push(int_value);
            } else {
                sameValueError++;
                $('#setting_' + attributes[i]).addClass("error");
            }

        }
        if ($('#setting_' + attributes[i]).val() > 199) {
            largeNumber++;
            $('#setting_' + attributes[i]).addClass("error");
        }
    }
    if (error || largeNumber || sameValueError) {
        $('#errorShow').empty();
        var errList = [];
        if (error) {
            errList.push('非表示の項目に番号が入っています。')
        }
        if (largeNumber) {
            errList.push('200以下の数値を入力してください。')
        }
        if (sameValueError) {
            errList.push('表示順が重複しています。')
        }


        if (errList) {
            var html = '<div>';

            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">';
            errList.forEach((item, index, arr) => {
                var lineBreak = index == (arr.length - 1) ? "" : "<br/>"
                html += item + lineBreak
            })
            html += '</p>';
            html += '</div>';
            $('#errorShow').html(html);
        }
        $(this).prop("disabled", false)
        // if (error > 0 && largeNumber > 0 && sameValueError > 0) {
        //
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
        //         '<br>' + '200以下の数値を入力してください。' +
        //         '<br>' + '表示順が重複しています。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (largeNumber > 0 && error == 0 && sameValueError == 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '200以下の数値を入力してください。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (error > 0 && largeNumber == 0 && sameValueError == 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (error == 0 && largeNumber == 0 && sameValueError > 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '表示順が重複しています。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (error > 0 && largeNumber == 0 && sameValueError > 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
        //         '<br>' + '表示順が重複しています。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (largeNumber > 0 && sameValueError > 0 && error == 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '200以下の数値を入力してください。' +
        //         '<br>' + '表示順が重複しています。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // } else if (error > 0 && largeNumber > 0 && sameValueError == 0) {
        //     $('#errorShow').empty();
        //     html = '<div>';
        //     html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">' + '非表示の項目に番号が入っています。' +
        //         '<br>' + '200以下の数値を入力してください。' + '</p>';
        //     html += '</div>';
        //     $(this).prop("disabled", false)
        //     $('#errorShow').html(html);
        // }
    } else {
        $('#errorShow').empty();
        saveTableSetting(redirect_path);
    }
});
var checkstate = false; // desecelted

//checked
$('body').on('click', '.checkall', function () {
    $('.customCheckBox').each(function () {
        if (!checkstate) {
            this.checked = true;
            $(this).parents('tr').find('td > input.input_field').val('');
            $(this).parents('tr').find('td > input.input_field').prop('readonly', false);
        }
    });


});

//Unchecked....
$('body').on('click', '.uncheck', function () {
    $('.customCheckBox').each(function () {
        if (!checkstate) {
            this.checked = false;
            var select_element = $(this).parent().parent().next().find("input[type='tel']");
            select_element.val("");
            $(this).parents().find('#errorShow').empty();
            if (select_element.hasClass('error')) {
                select_element.removeClass('error')
            }
            select_element.parents('tr').find('td > input.input_field').val('');
            select_element.parents('tr').find('td > input.input_field').prop('readonly', true);
        }
    });


});

//custom select for long value

$(".custom_select>option").each(function () {
    var optionText = $(this).attr("data-id");
    var width = $(window).width();
    if (width > 760) {
        if (optionText.length > 40) {
            var newOption = optionText.substring(0, 40);
            $(this).text(newOption + '...');
        } else {
            $(this).text(optionText);
        }

    } else {
        if (optionText.length > 30) {
            var newOption = optionText.substring(0, 30);
            $(this).text(newOption + '...');
        } else {
            $(this).text(optionText);
        }
    }

});

$(window).on('resize', function () {
    $(".custom_select>option").each(function () {
        var optionText = $(this).attr("data-id");
        var width = $(window).width();
        if (width > 760) {
            if (optionText.length > 40) {
                var newOption = optionText.substring(0, 40);
                $(this).text(newOption + '...');
            } else {
                $(this).text(optionText);
            }

        } else {
            if (optionText.length > 30) {
                var newOption = optionText.substring(0, 30);
                $(this).text(newOption + '...');
            } else {
                $(this).text(optionText);
            }
        }

    });
});

//For button message start
$(function () {

    $(".message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.hover_message').html(mssg);
    }, function () {
        $('.hover_message').html('');
    });

    //reg button message
    $(".reg_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.reg_hover_message').html(mssg);
    }, function () {
        $('.reg_hover_message').html('');
    });

    //edit open button message
    $(".edit_open_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.detail_hover_message').html(mssg);
    }, function () {
        $('.detail_hover_message').html('');
    });

    //edit button message
    $(".edit_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.edit_hover_message').html(mssg);
    }, function () {
        $('.edit_hover_message').html('');
    });

    //delete button message
    $(".delete_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.detail_hover_message').html(mssg);
    }, function () {
        $('.detail_hover_message').html('');
    });

    //return button message
    $(".return_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.detail_hover_message').html(mssg);
    }, function () {
        $('.detail_hover_message').html('');
    });

    //table setting message
    $(".table_sett_message_content").hover(function () {
        var mssg = $(this).attr("message");
        $('.table_setting_hover_message').html(mssg);
    }, function () {
        $('.table_setting_hover_message').html('');
    });

});
//For button message ens

//Line break after specific amount of charecter start
function chunk(str, n) {
    var ret = [];
    var i;
    var len;

    if (str !== null && str !== '' && typeof str !== 'undefined') {
        if (typeof str !== 'number') {
            for (i = 0, len = str.length; i < len; i += n) {
                ret.push(str.substr(i, n))
            }
        } else {
            for (i = 0, len = str.toString().length; i < len; i += n) {
                ret.push(str.toString().substr(i, n))
            }
        }

        return ret;
    } else {
        return '';
    }

}

function breakData(val, point) {
    if (val !== null && val !== '' && typeof val !== 'undefined') {
        point = typeof point !== 'undefined' ? point : '40';
        var ret = chunk(val, point).join('</br>');
        return ret;
    } else {
        return '';
    }
}

//Line break after specific amount of charecter end

//confirmation message
function getConfirmationMessage(msgType) {
    //1 for reg,2 for edit,3 for delete,4 for return

    if (msgType == 1) {
        var msg = '<div class="col-12"  >';
        msg += '<p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">登録はまだ完了していません。内容をご確認後、もう一度「保存」をお願いします。</p>';
        msg += '</div>';
        return msg;
    } else if (msgType == 2) {
        var msg = '<div class="col-12" >';
        msg += '<p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">変更はまだ完了していません。内容をご確認後、もう一度「保存」をお願いします。</p>';
        msg += '</div>';
        return msg;
    } else if (msgType == 3) {
        var msg = '<div class="col-12" >';
        msg += '<p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">削除はまだ完了していません。内容をご確認後、もう一度「削除」をお願いします。</p>';
        msg += '</div>';
        return msg;
    } else if (msgType == 4) {
        var msg = '<div class="col-12" >';
        msg += '<p style="color:red; font-size: 12px; margin-bottom: 8px; word-break: break-all !important; white-space: normal !important;">データはまだ戻されていません。内容をご確認後、もう一度「データを戻す」をお願いします。</p>';
        msg += '</div>';
        return msg;
    }
}

//default table settings
$(document).on('click', '#default_table_setting', function (e) {
    e.preventDefault();
    var id = $(this).data('userid');

    if ($("#pageName").length > 0 && $("#pageName").val() == 'order_history_2') {
        var rd3 = $("input[type='radio'][name='rd3']:checked").val();
        var url = $(this).data('url') + "?rd3=" + rd3 + "";
    } else {
        var url = $(this).data('url');
    }

    console.log(id, url);
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            "id": id
        },
        success: function (response) {
            $("#setting_display_modal input").parent().find('input').removeClass("error");
            $('#errorShow').empty();
            for (var key in response) {
                if (response[key] > 199) {
                    document.getElementById('setting_' + key).value = '';
                } else {
                    document.getElementById('setting_' + key).value = response[key];
                }
                if (response[key] || response[key] == '0') {
                    document.getElementById("check_" + key).checked = true;
                    if ($('#setting_' + key).prop('readonly')) {
                        $('#setting_' + key).prop('readonly', false);
                    }
                } else {
                    document.getElementById("check_" + key).checked = false;
                    $('#setting_' + key).prop('readonly', true);
                }
            }
        }

    });

});

function activeInactiveCheckbox(element) {
    if ($(element).is(':checked')) {
        $(element).parents('tr').find('td > input.input_field').val('');
        $(element).parents('tr').find('td > input.input_field').prop('readonly', false);
    } else {
        $(element).parents('tr').find('td > input.input_field').val('');
        $(element).parents('tr').find('td > input.input_field').prop('readonly', true);
    }
}


function unique(array) {
    return $.grep(array, function (el, index) {
        return index === $.inArray(el, array);
    });
}

function checkFrontendValidation() {
    var fieldName = $(this).attr('name');
    var fieldId = $(this).attr('id');
    if (fieldId.search('reg') >= 0 || fieldId.search('insert') >= 0 || fieldId.search('cke_1') >= 0) {
        url = $("#registrationForm").attr('action');
        regmethod = $("#registrationForm").data('regmethod');

        var len = $("#regFrontValidation").length;
        if (len > 0) {
            var fields = $("#regFrontValidation").val() + ',' + fieldName;
            fields = unique(fields.split(","));
            $("#regFrontValidation").val(fields);
            window[regmethod](url, fields);

        } else {
            var fields = [fieldName];
            var input = '<input type="hidden" id="regFrontValidation" value="' + fieldName + '">';
            $("#registrationForm").prepend(input);

            window[regmethod](url, fields);
        }
    } else {
        url = $("#editForm").attr('action');
        editmethod = $("#editForm").data('editmethod');

        var len = $("#editFrontValidation").length;
        if (len > 0) {
            var fields = $("#editFrontValidation").val() + ',' + fieldName;
            fields = unique(fields.split(","));
            $("#editFrontValidation").val(fields);
            window[editmethod](url, fields);

        } else {
            var fields = [fieldName];
            var input = '<input type="hidden" id="editFrontValidation" value="' + fieldName + '">';
            $("#editForm").prepend(input);
            window[editmethod](url, fields);
        }
    }

}
// ,#userEditForm input,#userEditForm textarea,#userEditForm select
//front validation start here
$("#registrationForm input,#registrationForm textarea,#registrationForm select,#editForm input,#editForm textarea,#editForm select").on("keyup ",checkFrontendValidation);
$("#registrationForm select,#editForm select").on("change",checkFrontendValidation);
if(typeof CKEDITOR !== "undefined"){
    CKEDITOR.instances.ckeditor1.on('change', checkFrontendValidation);
    CKEDITOR.instances.ckeditor2.on('change', checkFrontendValidation);
}
//front validation end here


function checkFrontendValidationAfterSubmit(object, pageType) {
    var fields = "";
    var i = 0;
    var len = Object.keys(object).length;
    $.each(object, function (key, val) {
        i++;
        if (len == i) {
            fields = fields + key;
        } else {
            fields = fields + key + ',';
        }
    });

    if (pageType == 1) {
        var len = $("#regFrontValidation").length;
        if (len > 0) {
            //var fields = $("#regFrontValidation").val();
            //fields = $.unique(fields.split(","));
            $("#regFrontValidation").val(fields);
        } else {
            var input = '<input type="hidden" id="regFrontValidation" value="' + fields + '">';
            $("#registrationForm").prepend(input);
        }
    } else {
        var len = $("#editFrontValidation").length;
        if (len > 0) {
            //var fields = $("#editFrontValidation").val();
            //fields = unique(fields.split(","));
            $("#editFrontValidation").val(fields);
        } else {
            var input = '<input type="hidden" id="editFrontValidation" value="' + fields + '">';
            $("#editForm").prepend(input);
        }
    }
}


function formatNumber(num) {
    if(num == 0){
        return num;
    }else if (num == null || num == '') {
        return null;
    } else {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

}

//=============== Supplier modal opener starts here ===============//
function supplierSelectionModalOpener(fillable_id,db_fillable_id,condition,field_type,selected_field_name,dependant_status = null){
    var bango = $("input[id='userId']").val();
    var base_url = window.location.origin;
    var url = base_url+"/getCompanyData/" + bango;

    //check modal data selection
    var len = fillable_id.split("v2").length;
    if(len > 1){
        //id name should be idName_v2 to use version 2
        var data = "condition="+condition+"&modal_type=v2";
        $("#table_denpyostart_label").html("");
        $("#changable_payment_label").html("支払日");
        $("#changable_invoice_label").html("支払方法");
    }else{
        var data = "condition="+condition+"&modal_type=v1";
        $("#table_denpyostart_label").html("与信限度額");
        $("#changable_payment_label").html("入金日");
        $("#changable_invoice_label").html("請求書方式");
    }

    $.ajax({
        type: 'get',
        async:false,
        url: url,
        //data: "condition="+condition,
        data: data,
        success: function (response) {
            var html = "";
            for (var i = 0; i < response.length; i++) {
                //console.log(response[i]);
                var kokyakuData = jQuery.param(response[i]);

                html += '<tr class="show_office_master_info table_hover2 grid trfocus" tabindex="0"'+
                    'id="'+response[i]["yobi12"]+'"'+
                    'onclick="getHaisouData(this,\''+bango+'\',\''+kokyakuData+'\')">'+
                    '<td style="width: 50px;">'+response[i]["yobi12"]+'</td>'+
                    '<td>'+response[i]["name"]+'</td>'+
                    '</tr>';
            }
            $("#company_table_data").html(html);
        }
    });

    if(selected_field_name != null){
        $("#selected_field_name").val(selected_field_name);
    }
    if(dependant_status != null){
        $("#dependantStatus").val(dependant_status);
    }

    //if(field_type == 'nullable'){
    //    $("#clear_parent").css("display","initial");
    //    var func = 'clearParentScreen("'+fillable_id+'","'+db_fillable_id+'")';
    //    $("#clear_parent").attr("onclick",func);
    //}else{
    //    $("#clear_parent").css("display","none");
    //    $("#clear_parent").removeAttr("onclick");
    //}

    $("#clear_parent").css("display","initial");
    var func = 'clearParentScreen("'+fillable_id+'","'+db_fillable_id+'")';
    $("#clear_parent").attr("onclick",func);

    $("#lastname").val("");
    $("#office_search_button").click();
    $("#fillable_id").val(fillable_id);
    $("#db_fillable_id").val(db_fillable_id)
    var soldModalValue = $("#db_fillable_id").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info').removeClass('add_border');
    $('.show_personal_master_info').removeClass('add_border');
    $('.show_content_last').removeClass('add_border');

    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        var officeid = prevValue.substr(6, 2);
        var personalId = prevValue.substr(8, 3);
        document.getElementById(companyid).click();

        setTimeout(function () {
            document.getElementById("ets_"+officeid).click();
            //sroll to selected item
            //document.getElementById("ets_"+officeid).scrollIntoView();
            etsuransya();
        },1500)

        function etsuransya(){
            setTimeout(function (){
                //sroll to selected item
                setTimeout(function () {
                    document.getElementById(companyid).scrollIntoView();
                    document.getElementById("ets_"+officeid).scrollIntoView();
                },50);
                var newPersonalId = $(`[data-serial="${personalId}"]`).prop("id")
                document.getElementById(newPersonalId).click();
                //sroll to selected item
                document.getElementById(newPersonalId).scrollIntoView();
                $("#supplierModal").modal("show");
            },1500)
        }

    }else {
        $("#supplierModal").modal("show");
    }
}

$("#reset_button").on("click", function () {
    $("#supplierModal").modal("hide");

});

function resetBusinessPartnerInfoExceptCompany() {
    $("#table_payment").text("");
    $("#table_mjn_mn").text("");
    $("#table_datatxt0049").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
}

function resetBusinessPartnerInfo() {
    $("#table_datatxt0049").text("");
    $("#table_company_name").text("");
    $("#table_office_name").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_mail1").text("");
    $("#table_datatxt0016").text("");
    $("#table_yobi13").text("");
    $("#table_torihikisakibango").text("");
    $("#table_denpyostart").text("");
    $("#table_payment").text("");
    $("#table_mjn_mn").text("");
    $("#table_kensakukey").text("");
}

function resetBusinessPartnerInfoFromOffice() {
    $("#etsuransyaMail4").text("");
    $("#table_datatxt0049").text("");
    $("#table_datatxt0015").text("");
    $("#table_mail1").text("");
    $("#table_mail2").text("");
    $("#table_mail3").text("");
    $("#table_tantousya").text("");
    $("#table_datatxt0016").text("");
}

$(function () {
    $('#searchButton').on('click', function (event) {
        $("#initial_content").show();
    });
    $('.show_office_master_info').on('click',function (event) {
        $('.show_office_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div").show();
    });

    $(document).on('click','.show_personal_master_info',function(){
        $('.show_personal_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

    $(document).on('click','.show_content_last',function(){
        $('.show_content_last').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

});
//=============== Supplier modal opener ends here ===============//

//=============== Supplier  modal 2 opener start here ===============//
function supplierSelectionModalOpener_2(fillable_id2, db_fillable_id2,condition,field_type,selected_field_name = null,dependant_status = null) {
    var bango = $("input[id='userId']").val();
    var base_url = window.location.origin;
    var url = base_url+"/getCompanyData/" + bango;

    //check modal data selection
    var len = fillable_id2.split("v2").length;
    if(len > 1){
        //id name should be idName_v2 to use version 2
        var data = "condition="+condition+"&modal_type=v2";
        $("#table_denpyostart_2_label").html("");
        $("#changable_payment_2_label").html("支払日");
        $("#changable_invoice_2_label").html("支払方法");
    }else{
        var data = "condition="+condition+"&modal_type=v1";
        $("#table_denpyostart_2_label").html("与信限度額");
        $("#changable_payment_2_label").html("入金日");
        $("#changable_invoice_2_label").html("請求書方式");
    }
    $.ajax({
        type: 'get',
        async:false,
        url: url,
        data: data,
        success: function (response) {
            var html = "";
            for (var i = 0; i < response.length; i++) {
                //console.log(response[i]);
                var kokyakuData = jQuery.param(response[i]);

                html += '<tr class="show_office_master_info2 table_hover2 grid trfocus" tabindex="0"'+
                    'id="2_'+response[i]["yobi12"]+'"'+
                    'onclick="getHaisouData2(this,\''+bango+'\',\''+kokyakuData+'\')">'+
                    '<td style="width: 50px;">'+response[i]["yobi12"]+'</td>'+
                    '<td>'+response[i]["name"]+'</td>'+
                    '</tr>';
            }
            
            $("#company_table_data_2").html(html);
        }
    });

    if(selected_field_name != null){
        $("#selected_field_name_2").val(selected_field_name);
    }

    if(dependant_status != null){
        $("#dependantStatus_2").val(dependant_status);
    }

    //if(field_type == 'nullable'){
    //    $("#clear_parent2").css("display","initial");
    //    var func = 'clearParentScreen("'+fillable_id2+'","'+db_fillable_id2+'")';
    //    $("#clear_parent2").attr("onclick",func);
    //}else{
    //    $("#clear_parent2").css("display","none");
    //    $("#clear_parent2").removeAttr("onclick");
    //}

    $("#clear_parent2").css("display","initial");
    var func = 'clearParentScreen("'+fillable_id2+'","'+db_fillable_id2+'")';
    $("#clear_parent2").attr("onclick",func);

    $("#lastname2").val("");
    $("#office_search_button2").click();
    $("#fillable_id2").val(fillable_id2);
    $("#db_fillable_id2").val(db_fillable_id2)
    var soldModalValue = $("#db_fillable_id2").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info').removeClass('add_border');
    $('.show_personal_master_info2').removeClass('add_border');
    $('.show_content_last2').removeClass('add_border');

    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        var officeid = prevValue.substr(6, 2);

        if($("#2_"+companyid).length>0){
            document.getElementById("2_"+companyid).click();
            $("#office_master_content_div_table2").show();
            setTimeout(function () {
                document.getElementById("2_"+officeid).click()
                //sroll to selected item
                setTimeout(function () {
                    document.getElementById("2_"+companyid).scrollIntoView();
                    document.getElementById("2_"+officeid).scrollIntoView();
                },50);
                $("#supplierModal2").modal("show");
            },1500)
        }else{
            $("#supplierModal2").modal("show");
        }
    }else {
        $("#supplierModal2").modal("show");
    }
}


//Supplier Modal 2 reset button
$("#reset_button2").on("click", function () {
    $("#supplierModal2").modal("hide");
});

function resetBusinessPartnerInfoExceptCompany2() {
    $("#table_payment_2").text("");
    $("#table_mjn_mn_2").text("");
    $("#table_datatxt0049_2").text("");
    $("#table_office_name_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_mail1_2").text("");
    $("#table_datatxt0016_2").text("");
}

function resetBusinessPartnerInfo2() {
    $("#table_datatxt0049_2").text("");
    $("#table_company_name_2").text("");
    $("#table_office_name_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_mail1_2").text("");
    $("#table_datatxt0016_2").text("");
    $("#table_yobi13_2").text("");
    $("#table_torihikisakibango_2").text("");
    $("#table_denpyostart_2").text("");
    $("#table_payment_2").text("");
    $("#table_mjn_mn_2").text("");
    $("#table_kensakukey_2").text("");
}

function resetBusinessPartnerInfoFromOffice2() {
    $("#etsuransyaMail4_2").text("");
    $("#table_datatxt0049_2").text("");
    $("#table_datatxt0015_2").text("");
    $("#table_mail1_2").text("");
    $("#table_mail2_2").text("");
    $("#table_mail3_2").text("");
    $("#table_tantousya_2").text("");
    $("#table_datatxt0016_2").text("");
}

$(function () {
    $('.show_office_master_info2').on('click', function (event) {
        $('.show_office_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div2").show();
    });

    $(document).on('click', '.show_personal_master_info2', function () {
        $('.show_personal_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

    $(document).on('click', '.show_content_last2', function () {
        $('.show_content_last2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
    });

});
//=============== Supplier  modal 2 opener end here ===============//

//=============== Supplier  modal 3 opener start here ===============//
function supplierSelectionModalOpener_3(fillable_id, db_fillable_id,condition,field_type,selected_field_name = null,dependant_status = null) {
    var bango = $("input[id='userId']").val();
    var base_url = window.location.origin;
    var url = base_url+"/getCompanyData/" + bango;
    $.ajax({
        type: 'get',
        async:false,
        //url: "getCompanyData/" + bango,
        url: url,
        data: "condition="+condition,
        success: function (response) {
            var html = "";
            for (var i = 0; i < response.length; i++) {
                //console.log(response[i]);
                var kokyakuData = jQuery.param(response[i]);

                html += '<tr class="show_office_master_info3 table_hover2 grid trfocus" tabindex="0"'+
                    'id="3_'+response[i]["yobi12"]+'"'+
                    'onclick="showCompanyData(this,\''+bango+'\',\''+kokyakuData+'\')">'+
                    '<td style="width: 50px;">'+response[i]["yobi12"]+'</td>'+
                    '<td>'+response[i]["name"]+'</td>'+
                    '</tr>';
            }
            $("#company_table_data_3").html(html);
        }
    });

    if(selected_field_name != null){
        $("#selected_field_name_3").val(selected_field_name);
    }

    if(dependant_status != null){
        $("#dependantStatus_3").val(dependant_status);
    }

    //if(field_type == 'nullable'){
    //    $("#clear_parent3").css("display","initial");
    //    var func = 'clearParentScreen("'+fillable_id+'","'+db_fillable_id+'")';
    //    $("#clear_parent3").attr("onclick",func);
    //}else{
    //    $("#clear_parent3").css("display","none");
    //    $("#clear_parent3").removeAttr("onclick");
    //}

    $("#clear_parent3").css("display","initial");
    var func = 'clearParentScreen("'+fillable_id+'","'+db_fillable_id+'")';
    $("#clear_parent3").attr("onclick",func);

    $("#lastname3").val("");
    $("#office_search_button3").click();
    $("#fillable_id3").val(fillable_id);
    $("#db_fillable_id3").val(db_fillable_id)
    var soldModalValue = $("#db_fillable_id3").val()
    var prevValue = $('#' + soldModalValue).val()

    $('.show_office_master_info3').removeClass('add_border');
    if (prevValue) {
        var companyid = prevValue.substr(0, 6);
        if($("#3_"+companyid).length>0){
            document.getElementById("3_"+companyid).click();
            setTimeout(function () {
                document.getElementById("3_"+companyid).scrollIntoView();
            },50);
            $("#supplierModal3").modal("show");
        }else{
            $("#supplierModal3").modal("show");
        }
    }else {
        $("#supplierModal3").modal("show");
    }
}

//Supplier Modal 3 reset button
$("#reset_button3").on("click", function () {
    $("#supplierModal3").modal("hide");
});

function resetBusinessPartnerInfo3() {
    $("#table_datatxt0049_3").text("");
    $("#table_company_name_3").text("");
    $("#table_office_name_3").text("");
    $("#table_mail2_3").text("");
    $("#table_mail3_3").text("");
    $("#table_tantousya_3").text("");
    $("#table_mail1_3").text("");
    $("#table_datatxt0016_3").text("");
    $("#table_yobi13_3").text("");
    $("#table_torihikisakibango_3").text("");
    $("#table_denpyostart_3").text("");
    $("#table_payment_3").text("");
    $("#table_mjn_mn_3").text("");
    $("#table_kensakukey_3").text("");
}
//=============== Supplier  modal 3 opener end here ===============//

//=============== clear the parent screen ===============//
function clearParentScreen(fillable_id,db_fillable_id){
    $("#"+fillable_id).val("");
    $("#"+db_fillable_id).val("");
}
//=============== clear the parent screen end ===============//



//disable excel button when no content data found (start)
if($("#userTable").length > 0){
    var count = document.getElementById("userTable").getElementsByTagName("tr").length;
    if(count == 2 || count == 1){
        $("#excelDwld").prop('disabled', true);
    }else{
        $("#excelDwld").prop('disabled', false);
    }
}
//disable excel button when no content data found (end)

//=============== Common Office Department Group start here ===============//

//top search pulldown filter starts here
$('#division_datachar05_start').change(function() {
    var filterOn = document.getElementById("division_datachar05_start").value;

    var url= '/sales_acceptance_process/filterCategoryForAll';
    if (filterOn !='') {
        $.ajax({
            type: "GET",
            url: url,
            data: {'filterOn':filterOn},
            success: function (res) {
                var opitions=JSON.parse(res);
                $('#department_datachar05_start').removeAttr('disabled');
                $('#group_datachar05_start').removeAttr('disabled');
                $('#department_datachar05_end').removeAttr('disabled');
                $('#group_datachar05_end').removeAttr('disabled');

                $('#department_datachar05_start').html(opitions.categoryhtml2)
                $('#group_datachar05_start').html(opitions.categoryhtml3)
                $('#division_datachar05_end').html(opitions.categoryhtml1_right)
                $('#division_datachar05_end').val(filterOn)
                $('#department_datachar05_end').html(opitions.categoryhtml2)
                $('#group_datachar05_end').html(opitions.categoryhtml3)



            }
        });
    }else{
        $('#department_datachar05_start').html("<option value=''>-</option>\n")
        $('#group_datachar05_start').html("<option value=''>-</option>\n")
        $('#division_datachar05_end').val('')
        $('#department_datachar05_end').html("<option value=''>-</option>\n")
        $('#group_datachar05_end').html("<option value=''>-</option>\n")
    }
})


$('#department_datachar05_start').change(function() {
    var filterOn = document.getElementById("department_datachar05_start").value;
    if (filterOn=="") {
        filterOn=document.getElementById("division_datachar05_start").value;
    }
    var url= '/sales_acceptance_process/filterCategoryForAll';
    //if (filterOn !='') {
    $.ajax({
        type: "GET",
        url: url,
        data: {'filterOn':filterOn},
        success: function (res) {
            var opitions=JSON.parse(res);
            $('#group_datachar05_start').html(opitions.categoryhtml3)
            $('#group_datachar05_start').removeAttr('disabled');
            $('#group_datachar05_end').removeAttr('disabled');
            if ($('#division_datachar05_start').val() == $('#division_datachar05_end').val()) {
                $('#department_datachar05_end').html(opitions.categoryhtml2_other)
                $('#department_datachar05_end').val(filterOn)
                $('#group_datachar05_end').html(opitions.categoryhtml3)
                if (filterOn.length!=6) {
                    $('#department_datachar05_end').find('.null').remove();
                }else{
                    $('#department_datachar05_end').find('.null').attr('selected','selected');
                }

            }

        }
    });

})

$('#group_datachar05_start').change(function() {
    var filterOn = document.getElementById("group_datachar05_start").value;
    if (filterOn=='') {
        var filterOn = document.getElementById("department_datachar05_start").value;
        if (filterOn=='') {
            filterOn=document.getElementById("division_datachar05_start").value;
        }

    }
    var url= '/sales_acceptance_process/filterCategoryForAll';
    console.log(filterOn)
    $.ajax({
        type: "GET",
        url: url,
        data: {'filterOn':filterOn},
        success: function (res) {
            var opitions=JSON.parse(res);
            if ($('#department_datachar05_start').val() == $('#department_datachar05_end').val()) {

                $('#group_datachar05_end').html(opitions.categoryhtml3_other)
                $('#group_datachar05_end').val(filterOn)
                if (filterOn.length !=7){
                    $('#group_datachar05_end').find('.null').remove();
                }else{
                    $('#group_datachar05_end').find('.null').attr('selected','selected');
                }
            }

        }
    });

})

$('#division_datachar05_end').change(function() {
    var filterOn = document.getElementById("division_datachar05_end").value;
    $('#department_datachar05_start').removeAttr('disabled');
    $('#group_datachar05_start').removeAttr('disabled');
    $('#department_datachar05_end').removeAttr('disabled');
    $('#group_datachar05_end').removeAttr('disabled');
    var url= '/sales_acceptance_process/filterCategoryForAll';
    if (filterOn !='') {
        $.ajax({
            type: "GET",
            url: url,
            data: {'filterOn':filterOn},
            success: function (res) {
                var opitions=JSON.parse(res);

                $('#department_datachar05_end').html(opitions.categoryhtml2)
                $('#group_datachar05_end').html(opitions.categoryhtml3)
                $('#department_datachar05_start').val('')
                $('#group_datachar05_start').val('')

                if (filterOn != $('#division_datachar05_start').val()) {
                    $('#department_datachar05_start').attr('disabled','disabled')
                    $('#group_datachar05_start').attr('disabled','disabled')
                    $('#department_datachar05_end').attr('disabled','disabled')
                    $('#group_datachar05_end').attr('disabled','disabled')
                }else{
                    $('#department_datachar05_start').removeAttr('disabled');
                    $('#group_datachar05_start').removeAttr('disabled');
                    $('#department_datachar05_end').removeAttr('disabled');
                    $('#group_datachar05_end').removeAttr('disabled');
                }

            }
        })
    }else{
        $('#department_datachar05_end').html("<option value=''>-</option>\n")
        $('#group_datachar05_end').html("<option value=''>-</option>\n")
    }
})


$('#department_datachar05_end').change(function() {
    var filterOn = document.getElementById("department_datachar05_end").value;
    if(filterOn==""){
        filterOn= document.getElementById("division_datachar05_end").value;
    }
    $('#group_datachar05_start').removeAttr('disabled');
    $('#group_datachar05_end').removeAttr('disabled');
    var url= '/sales_acceptance_process/filterCategoryForAll';

    $.ajax({
        type: "GET",
        url: url,
        data: {'filterOn':filterOn},
        success: function (res) {
            var opitions=JSON.parse(res);

            $('#group_datachar05_end').html(opitions.categoryhtml3)
            $('#group_datachar05_start').val('')
            if (filterOn != $('#department_datachar05_start').val() && filterOn.length==7) {
                $('#group_datachar05_start').attr('disabled','disabled')
                $('#group_datachar05_end').attr('disabled','disabled')
            }



        }
    })

})

$('#department_datachar05_end').change(function() {

});
//top search pulldown filter ends here

$(document).ready(function(){
    var division_datachar05_start = $("#division_datachar05_start").val();
    var division_datachar05_end = $("#division_datachar05_end").val();
    if(division_datachar05_start != division_datachar05_end){
        $("#department_datachar05_start").attr("disabled",true);
        $("#department_datachar05_end").attr("disabled",true);
        $("#group_datachar05_start").attr("disabled",true);
        $("#group_datachar05_end").attr("disabled",true);
    }

    var department_datachar05_start = $("#department_datachar05_start").val();
    var department_datachar05_end = $("#department_datachar05_end").val();
    if(department_datachar05_start != department_datachar05_end){
        $("#group_datachar05_start").attr("disabled",true);
        $("#group_datachar05_end").attr("disabled",true);
    }
    
    //set id in all html tag
    setTagId();

});

function setTagId(){
    console.log("setTagId()");
    var i = 1;
    $( "*" ).each(function(){
        if(typeof $(this).attr('id') === 'undefined'){
           $(this).attr('id', 'temp_id_'+i); 
           i++;
        }
    });
}

//=============== Common Office Department Group tantousya filter start here ===============//
function filter_tantousya(field) {
    if (field==1 || field==2) {
        var from =$("#division_datachar05_start").val()
        var to=$("#division_datachar05_end").val()
    }
    if (field==3 || field==4) {
        var from =$("#department_datachar05_start").val()
        var to=$("#department_datachar05_end").val()
    }
    if (field==5 || field==6) {
        var from =$("#group_datachar05_start").val()
        var to=$("#group_datachar05_end").val()
    }
    $.ajax({
        type: "GET",
        url: '/filter/tantousya',
        data: {'field':field,'to':to,'from':from},
        success: function (res) {
            var opitions=JSON.parse(res);
            $('#datachar05').html(opitions)

        }
    })
}

//=============== Common Office Department Group tantousya filter end here ===============//

//=============== Common Office Department Group end here ===============//

var zenkakuFields = document.getElementsByClassName("zenkaku-validation");
var zenkakuCheck = function()
{
    var regex = /[\u3000-\u303f\u3040-\u309f\u30a0-\u30ff\uff00-\uffef\u4e00-\u9faf\u2605-\u2606\u2190-\u2195\u203B]/g;
    if(this.value.match(regex)) this.value = this.value.match(regex).join('');
    else this.value = '';
};

for (var i = 0; i < zenkakuFields.length; i++)
{
    zenkakuFields[i].addEventListener('blur', zenkakuCheck);
}

var hankakuFields = document.getElementsByClassName("hankaku-validation");
var hankakuCheck = function()
{
    var regex = /[a-zA-Z0-9_]/g;
    if(this.value.match(regex)) this.value = this.value.match(regex).join('');
    else this.value = '';
};

for (var i = 0; i < hankakuFields.length; i++)
{
    hankakuFields[i].addEventListener('blur', hankakuCheck);
}

//=====================zenkaku and hankaku validation code start=================//


//destroy local storage
$("#specifyOrderEntryReload").click(function(){
    if(localStorage.getItem("inhouseEntryReqType")) {
        localStorage.removeItem("inhouseEntryReqType");
    }
});


/*document.onreadystatechange = function () {
  if (document.readyState === 'complete') {
    var bango= document.getElementById("idBango").value
    var usac_custom_html_content = document.documentElement.innerHTML;
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     
    // send html_content to server
    $.ajax({
        type: 'POST',
        url: "/save-html-content",
        data: {"bango" : bango, "usac_custom_html_content" :  usac_custom_html_content},
        success: function (result) {
            console.log("result")
        }
    });
  }
}*/

$.getScript("https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js", function(){
        document.onreadystatechange = function () {
          if (document.readyState === 'complete') {
            html2canvas(document.getElementsByTagName("BODY")[0]).then(canvas => {
                
                    var png = canvas.toDataURL();
                    var markup = document.documentElement.innerHTML;
                    var bango= document.getElementById("idBango").value;
                    var usac_custom_html_content = markup;
                    var usac_custom_png_content = png;
                //console.log($('#csrfForEnter').val())
                    $.ajax({
                        type: 'POST',
                        url: "/save-html-content",
                        data: { "bango": bango, "usac_custom_html_content": usac_custom_html_content, "usac_custom_png_content": usac_custom_png_content, _token: $('#csrfForEnter').val()},
                        success: function (result) {
                            console.log("result")
                        }
                    });

            });
          }
        }
});