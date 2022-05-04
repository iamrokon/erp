function contentHideShow() {
    var hideShow = document.getElementById("closetopcontent");
    if (hideShow.innerHTML === "閉じる") {
        hideShow.innerHTML = "開く";
    } else {
        hideShow.innerHTML = "閉じる";
    }
}
$(document).ready(function(){
    $("#closetopcontent").click(function(){
        $(".order_entry_topcontent").toggle();
    });
    $("#modalarea").on('click', function(){
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
    });
    $("#modalarea").on("click", function(){
        $('.modal-backdrop').remove();
        $('#modalarea').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');

        })
        $('#modalarea').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        })
        $("#modalarea").modal("hide");
    });
    // Date Picker Initialization
    $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker1_oen'
    });
    $('#datepicker1_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

            if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
                $('#datepicker2_oen').val(datevalue);
                $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
                $('#datepicker2_oen').datepicker('update');
                $('#datepicker2_oen').val('');
            }
            else{
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
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker2_oen',
        startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
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
        }
    });
    // Update date value with slash on blur
    $('#datepicker2_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
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
    $('#datepicker3_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker3_oen'
    });

    $('#datepicker3_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

            if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
                $('#datepicker4_oen').val(datevalue);
                $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
                $('#datepicker4_oen').datepicker('update');
                $('#datepicker4_oen').val('');
            }
            else{
                $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
                $('#datepicker4_oen').datepicker('update');
            }
        }
    });

    $('#datepicker3_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
            $('#datepicker4_oen').datepicker('update');
        }
    });
    // Update date value with slash on blur
    $('#datepicker3_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    $('#datepicker4_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker4_oen',
        startDate: $('#datepicker3_oen').datepicker('getDate')
    });

    $('#datepicker4_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
        }
    });

    $('#datepicker4_oen').on('keyup', function (e) {
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
    $('#datepicker4_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });


    //5
    $('#datepicker5_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker5_oen',
        startDate: $('#datepicker3_oen').datepicker('getDate')
    });

    $('#datepicker5_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
        }
    });

    $('#datepicker5_oen').on('keyup', function (e) {
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
    $('#datepicker5_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    //Enter press hide dropdown...
    $("#datepicker3_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker3_oen").datepicker('hide');
        }
    });
    $("#datepicker4_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker4_oen").datepicker('hide');
        }
    });
    $('.largeTable').on('scroll', function() {
        $("#datepicker5_oen").datepicker('hide');
    });
})
