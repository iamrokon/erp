// Ignoring Disbale Button Function
// $(function () {
function ignoreDisabledButton(event) {
    if (event.keyCode == 13) {
        $("#pj").focus();
        event.preventDefault();
    }
}


$(document).ready(function () {
    $(".loading-icon").hide();
    $("#loading-icon").click(function () {
        $(".loading-icon").toggle();
    })
    $(".customalert").hide();
    $("#contenthide").click(function () {
        $(".customalert").toggle();
        // $('#test').focus();
    })
    $(".alertclose").on("click", function () {
        // $(".popupalert").('show');
        $('.customalert').hide();
        $('#test').focus();
    });
    let current_order_date_start  = moment().subtract(1,'M')
    let _date_order_date_start  = current_order_date_start.format('YYYY/MM/DD')
    let current_order_date_end  = moment()
    let _date_order_date_end  = current_order_date_end.format('YYYY/MM/DD')

    $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        setDate : _date_order_date_start,
        trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

            if ($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')) {
                $('#datepicker2_oen').val(datevalue);
                $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
                $('#datepicker2_oen').datepicker('update');
                $('#datepicker2_oen').val('');
            } else {
                $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
                $('#datepicker2_oen').datepicker('update');
            }
        }
    });

    $('#datepicker1_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
            $('#datepicker2_oen').datepicker('update');
        }
    });
// Update date value with slash on blur
    $('#datepicker1_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
        trigger: '#datepicker2_oen',
        setDate: _date_order_date_end,
        startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
        }
    });

    $('#datepicker2_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $(this).datepicker('update');
        }
    });
// Update date value with slash on blur
    $('#datepicker2_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

//Enter press hide dropdown...
    $("#datepicker1_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker1_oen").datepicker('hide');
        }
    });
    $("#datepicker2_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker2_oen").datepicker('hide');
        }
    });
});









