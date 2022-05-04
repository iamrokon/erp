// $(document).on("click", '.confirmCancel', function (e) {
//     $("#confirm_status").val(0);
//     $("#paymentData_pop_up_modal").hide();
// })
function paymentDataInsert(data){
    var bango = $("#userId").val();
    $("input[name=type]").val("insert");
    var payment_deadline = $("#payment_deadline").val();
    var payment_date = $("#payment_date").val();
    var voucher_date = $("#voucher_date").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#csrf').val()
        },
        url: 'payment-data-creation/register/' + bango,
        type: 'POST',
        data: {
            "type" : "insert",
            payment_deadline,
            payment_date,
            voucher_date,
            data
        },
        success: function (res) {
            console.log(res);
            if (res.status == 'ok') {
                location.reload()
            } else if (res.status == "ng") {
                html = '<div>';
                html += '<p>' + '該当するデータがありません。' + '</p>';
                html += '</div>';
                $('#error_data').html(html);
                $("#error_data").show();
                $("#registration").prop("disabled", false)
            }
        }
    })
}
$(document).on("click", '.paymentConfirmModalClose', function (e) {
    $("#confirm_status").val(0);
    $("#paymentData_pop_up_modal").hide();
})
function confirmDialog(handler){    
    $("#paymentData_pop_up_modal").show();
     //Pass true to a callback function
     $(".confirmOk").unbind('click').bind('click',function () {
         handler(true);
         $("#paymentData_pop_up_modal").hide();
     });      
     //Pass false to callback function
     $(".confirmCancel").unbind('click').bind('click',function () {
         handler(false);
         $("#paymentData_pop_up_modal").hide();
     });
}
$(document).ready(function () {
    $('body').css('pointer-events', 'all')
    $(document).on("click", "#loaderButton", function (e) {
        e.preventDefault()
        var bango = $("#userId").val()
        $("#insertData input").parent().find('input').removeClass("error");
        $("#insertData select").parent().find('select').removeClass("error");
        $("#insertData #error_data").empty();
        $("#insertData #session_msg").empty();
        $("input[name=type]").val("search");
        $.ajax({
            url: 'payment-data-creation/register/' + bango,
            type: 'POST',
            data: $('#insertData').serialize(),
            success: function (res) {
                $(".loading-icon").hide();
                if (res.status == 'ng') {
                    var inputError = res.err_field;
                    var inputErrorMsg = res.err_msg;
                    let targetEl;
                    inputError.forEach((item) => {
                        const [inputName, key] = item.split('.')
                        if (inputName) {
                            targetEl = $("input[name=" + inputName + "]")
                        }
                        targetEl.addClass("error")
                    })
                    var html = '';
                    if (inputErrorMsg) {
                        html = '<div>';
                        if (inputErrorMsg) {
                            for (var count = 0; count < inputErrorMsg.length; count++) {
                                var error_message = inputErrorMsg[count];
                                // error_message = error_message.includes('999999999') ? error_message.replaceAll('999999999', '9') : error_message;
                                html += '<p>' + error_message + '</p>';
                            }
                        }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }    
                } else if (res.status == 'confirm') {
                    if (res.data.length > 0){
                        // $("#paymentData_pop_up_modal").show();
                        var data = Object.entries(res.data);
                        console.log(data);
                        confirmDialog((ans) => {
                            if (ans) {
                               console.log("yes");
                            //    console.log(res.data);
                                paymentDataInsert(res.data);
                            }else {
                               console.log("no");
                            }
                           });   
                    }else{
                        html = '<div>';
                        html += '<p>' + '該当するデータがありません。' + '</p>';
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }
                    // $("#confirm_status").val(1)
                } else if (res.status == 'ok') {
                    location.reload()
                } else if (res.status == "not_ok") {
                    $("#registration").prop("disabled", false)
                }
            },
            error: function (res) {
                console.log({ res })
                $("#registration").prop("disabled", false)
            }
        })

    })
})

