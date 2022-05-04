$(function () {
    $("#modalarea").on('click', function () {
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
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

    $('.datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 6,
        trigger: 'datePicker'
    });

    $(document).on('change focus', '.datePicker', function () {

        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
            console.log('hitted', $(this).hasClass("error"));
            let payment_date = '入金日';
            $(this).hasClass("error") ? $(this).removeClass("error") : ''
            if ($(this).hasClass('payment_date')) {
                removeFromErrorData(payment_date)
            }
        }
    });

    $(document).on('click', '.datePicker', function () {
        $(this).datepicker('show');
        // if ($(this).val().length == 0) {
        //     $(this).datepicker('show');
        // }
        // else if ($(this).val().length <= 7) {
        //     $(this).datepicker('hide');
        // }
    });

    $(document).on('keyup', '.datePicker', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (e.keyCode == 13) {
            $(this).datepicker('hide');
        }
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
    $(document).on('blur', '.datePicker', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    $(".deposit_amount").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker").datepicker('hide');
            // $('#registration').focus();
        }
    });

    $(".bill_settlement_date").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".bill_settlement_date").datepicker('hide');
        }
    });
    $(".payment_date").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".payment_date").datepicker('hide');
        }
    });

    $(".remarks").focus(function (e) {
        $(".datePicker").datepicker('hide');
    });

});

function depositBranchSelection(own){
    var id = own.attr("id");
    var deposit_bank = own.val();
    if(id == 'deposit_bank'){
        if(deposit_bank != ""){
            deposit_bank = "H3"+parseInt(deposit_bank.split("H2")[1]);
            $("#deposit_branch").val(deposit_bank);
            //$("#deposit_branch").removeAttr("readonly");
            $("#deposit_branch").attr("readonly",true);
            $("#deposit_branch").css("pointer-events","none");
            console.log("d");
        }else{
            $("#deposit_branch").val("");
            $("#deposit_branch").attr("readonly",true);
            $("#deposit_branch").css("pointer-events","none");
        }
    }
    
    if(id.split("-").length > 0){
        var temp_id = "deposit_branch-"+id.split("-")[1];
        if(deposit_bank != ""){
            deposit_bank = "H3"+parseInt(deposit_bank.split("H2")[1]);
            $("#"+temp_id).val(deposit_bank);
            // $("#"+temp_id).removeAttr("readonly");
            // $("#"+temp_id).css("pointer-events","auto");
            $("#"+temp_id).attr("readonly",true)
            $("#"+temp_id).css("pointer-events","none");
        }else{
            $("#"+temp_id).val("");
            $("#"+temp_id).attr("readonly",true);
            $("#"+temp_id).css("pointer-events","none");
        }
    }
}
