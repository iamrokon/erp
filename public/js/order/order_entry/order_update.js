
    $("body").on("click", "#orderEntrySubmitBtn", function (e) {
        e.preventDefault();
        var data = $("#insertData").serialize();
        var payment_method = $("#reg_kessaihouhou").val();
        var acceptance_condition = $("#reg_chumonsyajouhou").val();
        var sales_standard = $("#reg_soufusakijouhou").val();
        var immediate_version = $("#reg_housoukubun").val();
        data += '&payment_method=' + encodeURIComponent(payment_method) + '&acceptance_condition=' + encodeURIComponent(acceptance_condition) + '&sales_standard=' + encodeURIComponent(sales_standard) + '&immediate_version=' + encodeURIComponent(immediate_version);
        var bango = $("input[id='userId']").val();
        $("input[name=type]").val("create")
        $.ajax({
            url: "order-entry/register/" + bango,
            type: "POST",
            data: data,
            success: function (result) {
                console.log(result)
                if ($.trim(result.status) == 'ok') {
                    console.log('done');
                }else{
                    var inputError = result.err_field;
                    console.log(result)
                }

            }
        })
    })
