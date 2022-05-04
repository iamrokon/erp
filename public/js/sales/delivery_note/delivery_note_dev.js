$(document).ready(function () {
    let current_order_date_start = moment().startOf('month')
    let _date_order_date_start = current_order_date_start.format('YYYY/MM/DD')
    let current_order_date_end = moment()
    let _date_order_date_end = current_order_date_end.format('YYYY/MM/DD')
    let _formatted_date_order_date_end = current_order_date_end.format('YYYYMMDD');
    let _formatted_date_order_date_start = current_order_date_start.format('YYYYMMDD');
    $('.order_date_start').val(_date_order_date_start)
    $('.order_date_start').next().val(_formatted_date_order_date_start)
    $('.order_date_end').val(_date_order_date_end);
    $('.order_date_end').next().val(_formatted_date_order_date_end)

    $('body').css('pointer-events', 'all')
    $(".download_csv").prop("disabled", true)
    $(".delete_csv").prop("disabled", true)
    function changeConfirmStatus() {
        $('#confirm_status').val(0)
        $("#confirmation_message").empty()
    }
    $(document).on('change', 'select', changeConfirmStatus)
    $(document).on('input', 'input', changeConfirmStatus)

    //top search pulldown filter starts here
    //     $('#division_datachar05_start').change(function () {
    //         var filterOn = document.getElementById("division_datachar05_start").value;
    //
    //         var url = '/sales_acceptance_process/filterCategoryForAll';
    //         if (filterOn != '') {
    //             $.ajax({
    //                 type: "GET",
    //                 url: url,
    //                 data: {'filterOn': filterOn},
    //                 success: function (res) {
    //                     var opitions = JSON.parse(res);
    //                     $('#department_datachar05_start').removeAttr('disabled');
    //                     $('#group_datachar05_start').removeAttr('disabled');
    //                     $('#department_datachar05_end').removeAttr('disabled');
    //                     $('#group_datachar05_end').removeAttr('disabled');
    //
    //                     $('#department_datachar05_start').html(opitions.categoryhtml2)
    //                     $('#group_datachar05_start').html(opitions.categoryhtml3)
    //                     $('#division_datachar05_end').html(opitions.categoryhtml1_right)
    //                     $('#division_datachar05_end').val(filterOn)
    //                     $('#department_datachar05_end').html(opitions.categoryhtml2)
    //                     $('#group_datachar05_end').html(opitions.categoryhtml3)
    //
    //                 }
    //             });
    //         } else {
    //             $('#department_datachar05_start').html("<option value=''>-</option>\n")
    //             $('#group_datachar05_start').html("<option value=''>-</option>\n")
    //             $('#division_datachar05_end').val('')
    //             $('#department_datachar05_end').html("<option value=''>-</option>\n")
    //             $('#group_datachar05_end').html("<option value=''>-</option>\n")
    //         }
    //     })
    //     $('#department_datachar05_start').change(function () {
    //         var filterOn = document.getElementById("department_datachar05_start").value;
    //
    //         var url = '/sales_acceptance_process/filterCategoryForAll';
    //         if (filterOn != '') {
    //             $.ajax({
    //                 type: "GET",
    //                 url: url,
    //                 data: {'filterOn': filterOn},
    //                 success: function (res) {
    //                     var opitions = JSON.parse(res);
    //                     $('#group_datachar05_start').html(opitions.categoryhtml3)
    //                     $('#group_datachar05_start').removeAttr('disabled');
    //                     $('#group_datachar05_end').removeAttr('disabled');
    //                     if ($('#division_datachar05_start').val() == $('#division_datachar05_end').val()) {
    //
    //                         $('#department_datachar05_end').html(opitions.categoryhtml2_other)
    //                         $('#department_datachar05_end').val(filterOn)
    //                         $('#group_datachar05_end').html(opitions.categoryhtml3)
    //                     } else {
    //                         //$('#department_datachar05_end').html("<option value=''>-</option>\n")
    //                         //$('#group_datachar05_end').html("<option value=''>-</option>\n")
    //                     }
    //                 }
    //             });
    //         } else if (filterOn == '' && $('#division_datachar05_start').val() == $('#division_datachar05_end').val()) {
    //             $('#department_datachar05_end').html("<option value=''>-</option>\n")
    //             $('#group_datachar05_end').html("<option value=''>-</option>\n")
    //         }
    //     })
    //     $('#group_datachar05_start').change(function () {
    //         var filterOn = document.getElementById("group_datachar05_start").value;
    //
    //         var url = '/sales_acceptance_process/filterCategoryForAll';
    //         if (filterOn != '') {
    //             $.ajax({
    //                 type: "GET",
    //                 url: url,
    //                 data: {'filterOn': filterOn},
    //                 success: function (res) {
    //                     var opitions = JSON.parse(res);
    //                     if ($('#department_datachar05_start').val() == $('#department_datachar05_end').val()) {
    //
    //                         $('#group_datachar05_end').html(opitions.categoryhtml3_other)
    //                     } else {
    //                         //$('#group_datachar05_end').html("<option value=''>-</option>\n")
    //                     }
    //                 }
    //             });
    //         } else if (filterOn == '' && $('#department_datachar05_start').val() == $('#department_datachar05_end').val()) {
    //             $('#group_datachar05_end').html("<option value=''>-</option>\n")
    //         }
    //     })
    //     $('#division_datachar05_end').change(function () {
    //         var filterOn = document.getElementById("division_datachar05_end").value;
    //         $('#department_datachar05_start').removeAttr('disabled');
    //         $('#group_datachar05_start').removeAttr('disabled');
    //         $('#department_datachar05_end').removeAttr('disabled');
    //         $('#group_datachar05_end').removeAttr('disabled');
    //         var url = '/sales_acceptance_process/filterCategoryForAll';
    //         if (filterOn != '') {
    //             $.ajax({
    //                 type: "GET",
    //                 url: url,
    //                 data: {'filterOn': filterOn},
    //                 success: function (res) {
    //                     var opitions = JSON.parse(res);
    //
    //                     $('#department_datachar05_end').html(opitions.categoryhtml2)
    //                     $('#group_datachar05_end').html(opitions.categoryhtml3)
    //                     $('#department_datachar05_start').val('')
    //                     $('#group_datachar05_start').val('')
    //
    //                     if (filterOn != $('#division_datachar05_start').val()) {
    //                         $('#department_datachar05_start').attr('disabled', 'disabled')
    //                         $('#group_datachar05_start').attr('disabled', 'disabled')
    //                         $('#department_datachar05_end').attr('disabled', 'disabled')
    //                         $('#group_datachar05_end').attr('disabled', 'disabled')
    //                     } else {
    //                         $('#department_datachar05_start').removeAttr('disabled');
    //                         $('#group_datachar05_start').removeAttr('disabled');
    //                         $('#department_datachar05_end').removeAttr('disabled');
    //                         $('#group_datachar05_end').removeAttr('disabled');
    //                     }
    //
    //                 }
    //             })
    //         } else {
    //             $('#department_datachar05_end').html("<option value=''>-</option>\n")
    //             $('#group_datachar05_end').html("<option value=''>-</option>\n")
    //         }
    //     })
    //     $('#department_datachar05_end').change(function () {
    //         var filterOn = document.getElementById("department_datachar05_end").value;
    //         $('#group_datachar05_start').removeAttr('disabled');
    //         $('#group_datachar05_end').removeAttr('disabled');
    //         var url = '/sales_acceptance_process/filterCategoryForAll';
    //         if (filterOn != '') {
    //             $.ajax({
    //                 type: "GET",
    //                 url: url,
    //                 data: {'filterOn': filterOn},
    //                 success: function (res) {
    //                     var opitions = JSON.parse(res);
    //
    //                     $('#group_datachar05_end').html(opitions.categoryhtml3)
    //                     $('#group_datachar05_start').val('')
    //                     if (filterOn != $('#department_datachar05_start').val()) {
    //                         $('#group_datachar05_start').attr('disabled', 'disabled')
    //                         $('#group_datachar05_end').attr('disabled', 'disabled')
    //                     } else {
    //
    //                     }
    //
    //                 }
    //             })
    //         } else {
    //             $('#group_datachar05_end').html("<option value=''>-</option>\n")
    //         }
    //     })
    //top search pulldown filter ends here


})
