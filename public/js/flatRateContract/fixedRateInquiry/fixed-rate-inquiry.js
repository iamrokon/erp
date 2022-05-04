function stepup(event) {
    if (event.keyCode == 13) {
        $("#ignoreButton").focus();
        event.preventDefault();
    }
}
function contentHideShow() {
    var hideShow = document.getElementById("closetopcontent");
    if (hideShow.innerHTML === "閉じる") {
        hideShow.innerHTML = "開く";
    } else {
        hideShow.innerHTML = "閉じる";
    }
}
$(document).ready(function (){
    $('.show_personal_master_info').click(function () {
        // e.preventDefault();
        $(".tabledataModal6").addClass('intro');
        //$(this).css('border', "solid 2px red");
        $("#product_sub_content2").show();
        // $(this).closest('td').find("#office_master_content_div").toggle();
    });
    $("#pr_sub_choice_button").on('click',function () {
        $("#initial_content_product_sub").hide();
        $("#product_sub_content2").hide();
        $("#personal_master_content_div").hide();
        $("#office_content_div_last").hide();
        if ($(".show_office_master_info").hasClass("add_border")) {
            $(".show_office_master_info").removeClass('add_border');
        }
        if ($(".show_personal_master_info").hasClass("add_border")) {
            $(".show_personal_master_info").removeClass('add_border');
        }
        if ($(".show_content_last").hasClass("add_border")) {
            $(".show_content_last").removeClass('add_border');
        }
    });
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
// datepicker 5,6

    $('#datepicker5_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker5_oen'
    });

    $('#datepicker5_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

            if($(this).val().replaceAll('/', '') > $('#datepicker6_oen').val().replaceAll('/', '')){
                $('#datepicker6_oen').val(datevalue);
                $('#datepicker6_oen').datepicker('setStartDate', $('#datepicker5_oen').datepicker('getDate'));
                $('#datepicker6_oen').datepicker('update');
                $('#datepicker6_oen').val('');
            }
            else{
                $('#datepicker6_oen').datepicker('setStartDate', $('#datepicker5_oen').datepicker('getDate'));
                $('#datepicker6_oen').datepicker('update');
            }
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
            $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
            $('#datepicker4_oen').datepicker('update');
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

    $('#datepicker6_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker6_oen',
        startDate: $('#datepicker5_oen').datepicker('getDate')
    });

    $('#datepicker6_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
        }
    });

    $('#datepicker6_oen').on('keyup', function (e) {
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
    $('#datepicker6_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

//Enter press hide dropdown...
    $("#datepicker5_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker5_oen").datepicker('hide');
        }
    });
    $("#datepicker6_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker6_oen").datepicker('hide');
        }
    });
    $("#closetopcontent").click(function () {
        $(".order_entry_topcontent").toggle();
        $('.content-bottom-section').css('margin-top', 38);
    });
    $(".first-table").hide();
    $("button#searchButton").click(function () {
        $(".first-table").show();
    });
    $(".second-table").hide();
    $(".first-table").click(function () {
        $(".second-table").show();
    });
    $(".third-table").hide();
    $(".second-table").click(function () {
        $(".third-table").show();
    });
    $("#modalarea").on('click', function () {
        $(".modal-backdrop").addClass("overflow_cls");
//      $('.modal-backdrop').remove();
    });

    $("#modalarea").on("click", function () {
        $('.modal-backdrop').remove();
        $('#modalarea').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');

        })
        $('#modalarea').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        })
        $("#modalarea").modal("hide");
    });
    <!-- file name show in input area... -->

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

//Enter press hide dropdown...
    $(".input_field").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".input_field").datepicker('hide');
        }
    });
})
