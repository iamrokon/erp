$(document).ready(function (){


    // Date Picker Initialization

    // 入金日
    // Start
    $('.datePicker1_1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_1'
    });

    $(document).on('change focus', '.datePicker1_1', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_1', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_1', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
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
    $(document).on('blur', '.datePicker1_1', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_1").keydown(function (e) {
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

    $(document).on('change focus', '.datePicker1_2', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker1_2', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
        // $(this).datepicker('hide');
        let inputDateValue = $(this).val();  //getting date value from input
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
    $(document).on('blur', '.datePicker1_2', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker1_2").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker1_2").datepicker('hide');
        }
    });


    // 処理日
    // Start
    $('.datePicker2_1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker2_1'
    });

    $(document).on('change focus', '.datePicker2_1', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker2_1', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker2_1', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
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
    $(document).on('blur', '.datePicker2_1', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker2_1").keydown(function (e) {
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

    $(document).on('change focus', '.datePicker2_2', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '.datePicker2_2', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker2_2', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
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
    $(document).on('blur', '.datePicker2_2', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown
    $(".datePicker2_2").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker2_2").datepicker('hide');
        }
    });

})
