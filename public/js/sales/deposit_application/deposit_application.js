jQuery(function($) {
    var e = function() {
        var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
        (e -= 84) < 1 && (e = 1), e > 80 && jQuery(".fullpage_width1").css("min-height", e + "px")
    };
    jQuery(window).ready(e), jQuery(window).on("resize", e);
});
$(document).ready(function() {
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function(e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });
        }
    };
    ko.applyBindings({});
    $(".customalert, .loading-icon").hide();
    $("#contenthide").click(function() {
        $(".customalert,.loading-icon").toggle();
    });
    // Date Picker Initialization

    // 出荷日
    // Start
    $('.datePicker1_1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_1'
    });

    $(document).on('change focus', '.datePicker1_1', function() {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_1', function() {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 7) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_1', function(e) {
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_1', function() {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_1").keydown(function(e) {
        if (e.keyCode == 13) {
            $(".datePicker1_1").datepicker('hide');
        }
    });


    // End
    $('.datePicker1_2').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function() {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_2', function() {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 7) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_2', function(e) {
        // $(this).datepicker('hide');
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_2', function() {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_2").keydown(function(e) {
        if (e.keyCode == 13) {
            $(".datePicker1_2").datepicker('hide');
        }
    });


    // 納品日
    // Start
    $('.datePicker2_1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker2_1'
    });

    $(document).on('change focus', '.datePicker2_1', function() {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker2_1', function() {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 7) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker2_1', function(e) {
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker2_1', function() {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker2_1").keydown(function(e) {
        if (e.keyCode == 13) {
            $(".datePicker2_1").datepicker('hide');
        }
    });


    // End
    $('.datePicker2_2').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker2_2'
    });

    $(document).on('change focus', '.datePicker2_2', function() {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker2_2', function() {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        } else if ($(this).val().length <= 7) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker2_2', function(e) {
        let inputDateValue = $(this).val(); //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker2_2', function() {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker2_2").keydown(function(e) {
        if (e.keyCode == 13) {
            $(".datePicker2_2").datepicker('hide');
        }
    });
    let current_sale_date_start = moment().subtract(3, 'Y')
    let _sale_date_start = current_sale_date_start.format('YYYY/MM/DD')
    let _formatted_sale_start = current_sale_date_start.format('YYYYMMDD')
    $('.datePicker1_2').val(_sale_date_start);
    $('.datePicker1_2').next().val(_formatted_sale_start);

})
var buttonPress = 0;
var error_occur = 0;

function doubleClick() {
    alert('処理中です');
}
var submit = 0;


function updateDepositAppData(url) {
    //alert("pp");
    var kingaku_limit=parseInt($("#applicable_amount").text().replaceAll(",",""));
    var total_kingaku=parseInt($("#deposit_amount_total").text().replaceAll(",",""));
    console.log(-kingaku_limit,-kingaku_limit<=total_kingaku , total_kingaku<=kingaku_limit)
    if(total_kingaku<=kingaku_limit){
        $("#error_data").text("")
    buttonPress++;
    if (buttonPress == 1) {
        var url = url;
        var data = $('#mainForm').serialize();
        var len = $("#submit_confirmation").length;

        var deposit_number = $("#deposit_number").val();
        var sales_number = $("#sales_number").val();
        //if(deposit_number == sales_number){
        // if(update_stat == 1){
        //  if(error_occur==0){

        if (submit > 0) {
            //alert("uu");
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(result) {
                    console.log(result);
                    //alert("ss");
                    if ($.trim(result) == 'ok') {
                        location.reload();
                    } else {
                        buttonPress = 0;
                        var inputError = result.err_field;

                        var html = '';
                        if (result.err_msg) {
                            html = '<div>';

                            for (var count = 0; count < result.err_msg.length; count++) {
                                html += '<p>' + result.err_msg[count] + '</p>';
                            }
                            html += '</div>';

                            $('#error_data').html(html);

                            if (true) {}
                            $("#error_data").show();
                        }

                        for (var i = 1; i <= sales_number; i++) {
                            if (inputError["depositAmount_" + i]) {

                                $('#depositAmount_' + i).addClass("error");
                            } else {
                                $('#depositAmount_' + i).removeClass("error");
                            }
                        }
                    }
                }
            });
        } else {
            var submit_confirmation = "<input id='submit_confirmation' value='submit' type='hidden'/>";
            $('#mainForm').prepend(submit_confirmation);
            submit = 1

            if ($('#applicable_amount').text() == $('#deposit_amount_total').text()) {
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 10px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。</p>';
            } else {
                var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 10px;padding-left: 2px;">登録はまだ完了していません。内容をご確認後、もう１度登録ボタンを押してください。</p>';

            }


            $(document).find("#confirmation_message").html(confirmationMsg);
            buttonPress = 0;
        }
        /* }
         else{
               submit=0
               //var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;">【入金金額】未入金金額を上回る入金は登録できません。</p>';
               //$(document).find("#confirmation_message").html(confirmationMsg);
               buttonPress = 0;
             }*/

    } else {
        doubleClick();
    }
  }else{
    $("#error_data").text("消込可能額を上回る入金は登録できません。")
  }
}