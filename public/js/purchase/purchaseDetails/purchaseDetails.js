//102 button on press
nullCheck=0;
lengthCheck=0;
databaseCheck=0;
orderNo=null;
$(document).on('click','#topSearchBtn',function(){
    $('#session_msg').empty();
    $('#error_data').empty();
    $('#warning_data').empty();
    var orderNo=$('#order_no').val();
    var userId=$('#userId').val();
    /*nullCheck=0;
    lengthCheck=0;
    databaseCheck=0;*/
    console.log(!orderNo,orderNo.length);
    if (!orderNo){
        nullCheck=1;
        var dyappend='<p>【受注番号】必須項目に入力がありません。</p>';
        $("#error_data").append(dyappend);
        $("#order_no").addClass('error');
    }
    else {
        nullCheck=0;
        $("#order_no").removeClass('error');
    }
    /*if (orderNo.length>10){
        lengthCheck=1;
        var dyappend='<p>【受注番号】10文字以下で入力してください。</p>';
        $("#error_data").append(dyappend);
        $("#order_no").addClass('error');
    }
    else {
        lengthCheck=0;
        $("#order_no").removeClass('error');
    }*/
    /*if (orderNo && (orderNo.length<11)){
        $.ajax({
            type: 'GET',
            url: '/purchase-details/validationCheck/'+ userId,
            data: {'orderNo': orderNo,'userId': userId},
            async: false,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data=='ng'){
                    //databaseCheck=1;
                    //var dyappend='<p>何かがうまくいかなかった。</p>';
                    //$("#error_data").append(dyappend);
                    //$("#order_no").addClass('error');
                }else if(data=='ok') {
                    //databaseCheck=0;
                    //$("#order_no").removeClass('error');
                    $('#warning_data').empty();
                }else {
                    if (data=='0'){
                        // console.log(data);
                        //databaseCheck=1;
                        //$("#order_no").addClass('error');
                        setTimeout('warningMsg0()', 1000);
                    }
                    else if (data=='1'){
                        // console.log(data);
                        //databaseCheck=1;
                        //$("#order_no").addClass('error');
                        setTimeout('warningMsg1()', 1000);
                    }
                    else if (data=='2'){
                        // console.log(data);
                        //databaseCheck=1;
                        //$("#order_no").addClass('error');
                        setTimeout('warningMsg2()', 1000);
                    }
                    else {
                        //databaseCheck=0;
                        //$("#order_no").removeClass('error');
                        $('#warning_data').empty();
                    }
                }
                console.log('databaseCheck',data);
            }
        });
    }
    else {
        databaseCheck=0;
        //$("#order_no").removeClass('error');
        //console.log('2');
    }*/

    if (nullCheck==0){
        $('#warning_data').empty();
        $('#error_data').empty();
        $("#order_no").removeClass('error');
        console.log('3');
        $('#firstSearch').submit();
    }
})

function warningMsg0() {
    var dyappend='<p>仕入完了計算済です。</p>';
    var dyappend1='<p>仕入完了検印済です。</p>';
    $("#warning_data").append(dyappend,dyappend1);
}
function warningMsg1() {
    var dyappend='<p>仕入完了計算済です。</p>';
    $("#warning_data").append(dyappend);
}
function warningMsg2() {
    var dyappend='<p>仕入完了検印済です。</p>';
    $("#warning_data").append(dyappend);
}

//251-1,252-2 button on press
$(document).on('click','#instructorBtn',function(){
    var userId=$('#userId').val();
    var loginUserName= $('#userName').val();
    $('#input_instructor').val(loginUserName);
    $('#input_instructor_h').val(userId);
});
$(document).on('click','#inspectorBtn',function(){
    var userId=$('#userId').val();
    var loginUserName= $('#userName').val();
    $('#input_inspector').val(loginUserName);
    $('#input_inspector_h').val(userId);
});

//on click 261 button (update)
var confirmationOfUpdate='0';
$('#updatePdBtn').click(function() {
    $('#warning_data').empty();
    $('#error_data').empty();
    orderNo = $('#order_no').val();
    var defaultSrc = $('#defaultSrc_h').val();
    var userId=$('#userId').val();
    var instructorBango=$('#input_instructor_h').val();
    var inspectorBango=$('#input_inspector_h').val();
    var idoutanabangoVal=$('#idoutanabango_h').val();
    // console.log(defaultSrc=='1',instructorBango.length,inspectorBango.length,defaultSrc,instructorBango,inspectorBango)
    if ((defaultSrc=='1') && ((instructorBango.length>0) || (inspectorBango.length>0))){
        if (confirmationOfUpdate=='1'){
            $.ajax({
                type: 'GET',
                url: '/purchase-details/updatePd/'+ userId,
                data: {'orderNo': orderNo,'userId': userId,'idoutanabangoVal': idoutanabangoVal,'instructorBango': instructorBango,'inspectorBango': inspectorBango},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data=='1'){
                        $('#session_msg').removeClass('d-none');
                        $("#error_data").empty();
                        var msg = '<div class="col-12" style="white-space: normal; word-break: break-all;">\n' +
                            '             <div class="alert alert-primary alert-dismissible">\n' +
                            '                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus\n' +
                            '                             onclick="$(\'#order_no\').focus();">\n' +
                            '                        &times;\n' +
                            '                    </button>\n' +
                            '                    <strong id="s_msg"></strong>\n' +
                            '                </div>\n' +
                            '            </div>';
                        $('#session_msg').html(msg);
                        var sMsg='受注番号' +orderNo+　'更新が完了しました。'
                        $('#s_msg').html(sMsg);
                        $('.dismissMe').focus();
                    }
                    else if(data=='2'){
                        var dyappend='<p>他のユーザーこのテータを変更しています。再度検索してデータを取得し直して下さい。</p>';
                        $("#error_data").append(dyappend);
                    }
                    else if(data=='0'){
                        var dyappend='<p>何かがうまくいかなかった。</p>';
                        $("#error_data").append(dyappend);
                    }
                }
            });
            confirmationOfUpdate='0';
            $("#confirmation_message").empty();
        }
        else {
            confirmationOfUpdate='1'
            var conmsg='更新はまだ完了していません。内容をご確認後、もう一度更新ボタンを押してください。'
            $("#confirmation_message").append(conmsg);
        }
    }
});

//for 2nd table starts here

function showTableSetting2(url) {

    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $("#setting_display_modal2 input").parent().find('input').removeClass("error");
            $('#errorShow2').empty();
            if (typeof (response) == 'string') {
                $('#setting_display_modal2').modal('show');
            } else {
                for (var key in response) {
                    console.log(key + '=' + response[key]);
                    if (response[key] > 199) {
                        document.getElementById('setting2_' + key).value = '';
                        // $('#setting_' + key).prop('readonly', true);
                    } else {
                        console.log(key + '=' + response[key]);
                        document.getElementById('setting2_' + key).value = response[key];
                    }
                    if (response[key] || response[key] == '0') {
                        document.getElementById("check2_" + key).checked = true;
                        if ($('#setting2_' + key).prop('readonly')) {
                            $('#setting2_' + key).prop('readonly', false);
                        }
                    }
                    /* else if(Object.keys(response)[0])
                     {
                       document.getElementById("check_"+key).checked = true;
                     }*/
                    else {
                        document.getElementById("check2_" + key).checked = false;
                        $('#setting2_' + key).prop('readonly', true);
                    }
                }

                $('#setting_display_modal2').modal('show');
            }
        },
    });
}

function saveTableSetting2(menu) {
    var url = $('#tableSetting2').attr('action');

    var data = $('#tableSetting2').serialize();

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {

            console.log(response);
            //alert(response);
            $(document).find("#tableSettingSubmit2").prop("disabled", true)
            location.reload();
            // refresh();
            //document.getElementById(menu).click();
        },
        error: function () {
            $(document).find("#tableSettingSubmit2").prop("disabled", false)
        }
    });

}

$(document).on("click", "#tableSettingSubmit2", function () {
    $(this).prop("disabled", true)
    var attributes = [];
    var redirect_path = $('input[name=redirect_path]').val();

    $(this).parents('form').find('input[type="text"],input[type="tel"]').each(function () {
        attributes.push($(this).attr('name'));
    });

    var error = 0;
    var largeNumber = 0;
    var sameValueError = 0;
    $("#setting_display_modal2 input").parent().find('input').removeClass("error");
    var sameValue = [];
    for (var i = 0; i < attributes.length; i++) {
        if ($("#check2_" + attributes[i]).prop('checked') != true && $("#setting2_" + attributes[i]).val() != "") {
            error++;
            $('#setting2_' + attributes[i]).addClass("error");
        }
        //check for same value
        var settings_value = $('#setting2_' + attributes[i]).val();

        if (settings_value != "") {
            var int_value = parseInt(settings_value);
            if (sameValue.indexOf(int_value) === -1) {
                sameValue.push(int_value);
            } else {
                sameValueError++;
                $('#setting2_' + attributes[i]).addClass("error");
            }

        }
        if ($('#setting2_' + attributes[i]).val() > 199) {
            largeNumber++;
            $('#setting2_' + attributes[i]).addClass("error");
        }
    }
    if (error || largeNumber || sameValueError) {
        $('#errorShow2').empty();
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
            $('#errorShow2').html(html);
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
        saveTableSetting2(redirect_path);
    }
});

$(document).on('click', '#default_table_setting2', function (e) {
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
            $("#setting_display_modal2 input").parent().find('input').removeClass("error");
            $('#errorShow2').empty();
            for (var key in response) {
                if (response[key] > 199) {
                    document.getElementById('setting2_' + key).value = '';
                } else {
                    document.getElementById('setting2_' + key).value = response[key];
                }
                if (response[key] || response[key] == '0') {
                    document.getElementById("check2_" + key).checked = true;
                    if ($('#setting2_' + key).prop('readonly')) {
                        $('#setting2_' + key).prop('readonly', false);
                    }
                } else {
                    document.getElementById("check2_" + key).checked = false;
                    $('#setting2_' + key).prop('readonly', true);
                }
            }
        }

    });

});

//for 2nd table ends here
