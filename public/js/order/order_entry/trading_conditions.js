function setTransactionData(response, from = '') {
    var tradingCondition = $('#tradingConditionModal');
    const {paymentMethod, immediateClassification, acceptanceConditions} = response
    var payment_method,acceptance_condition,sales_standard,immediate_classification;
    if( typeof from == 'object'){
        const { reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = from
        payment_method = reg_kessaihouhou ;
        acceptance_condition = reg_chumonsyajouhou
        sales_standard = reg_soufusakijouhou
        immediate_classification = reg_housoukubun
    }else {
        payment_method = from ? '' : $(document).find('#kessaihouhou').val();
        acceptance_condition = from ? '' : $(document).find('#chumonsyajouhou').val();
        sales_standard = from ? '' : $(document).find('#soufusakijouhou').val();
        immediate_classification = from ? '' : $(document).find('#housoukubun').val();

    }

    var reg_kessaihouhou = payment_method ? payment_method : paymentMethod
    var reg_housoukubun = immediate_classification ? immediate_classification : immediateClassification
    var reg_chumonsyajouhou = acceptance_condition ? acceptance_condition : acceptanceConditions
    var reg_soufusakijouhou = sales_standard ? sales_standard : tradingCondition.find('#reg_soufusakijouhou option:eq(1)').val()

    tradingCondition.find('#reg_kessaihouhou').val(reg_kessaihouhou)
    tradingCondition.find('#reg_housoukubun').val(reg_housoukubun)
    tradingCondition.find('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
    tradingCondition.find("#reg_soufusakijouhou").val(reg_soufusakijouhou);
    var transactionData = {
        'reg_kessaihouhou': reg_kessaihouhou,
        'reg_housoukubun': reg_housoukubun,
        'reg_chumonsyajouhou': reg_chumonsyajouhou,
        'reg_soufusakijouhou': reg_soufusakijouhou

    }
    transactionData = JSON.stringify(transactionData)
    localStorage.setItem('transactionData', transactionData)
    var contractorId = $('#reg_sales_billing_destination_db').val();
    localStorage.setItem('lastKokyakuId', contractorId.substr(0, 6))
}

$(document).ready(function () {
    localStorage.removeItem('transactionData');
    localStorage.removeItem('lastKokyakuId');
    $(document).on('click', '#igroup1', function (e) {
        e.preventDefault();
        var contractorId = $('#reg_sales_billing_destination_db').val();
        var kokyakuId = contractorId ? contractorId.substr(0, 6) : '';
        var lastkokyakuId = localStorage.getItem('lastKokyakuId');
        var isLastkokyakuId = kokyakuId == lastkokyakuId;
        var bango = $("input[id='userId']").val();
        var tradingCondition = $('#tradingConditionModal');

        if (contractorId && !localStorage.getItem('transactionData') && !isLastkokyakuId) {
            $.ajax({
                url: '/order-entry/contact-wise-trading-condition-value/' + bango,
                data: {contractorId: contractorId},
                success: function (response) {
                    setTransactionData(response)
                    tradingCondition.modal("show");
                }
            })
        } else {
            var transactionData = JSON.parse(localStorage.getItem('transactionData'))
            var {reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = transactionData;
            tradingCondition.find('#reg_kessaihouhou').val(reg_kessaihouhou)
            tradingCondition.find('#reg_housoukubun').val(reg_housoukubun)
            tradingCondition.find('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
            tradingCondition.find("#reg_soufusakijouhou").val(reg_soufusakijouhou)
            tradingCondition.modal("show");
        }


    })
    $(document).on("click", "#select_trading_condition", function () {
        var tradingCondition = $('#tradingConditionModal');
        var reg_kessaihouhou = tradingCondition.find('#reg_kessaihouhou').val()
        var reg_housoukubun = tradingCondition.find('#reg_housoukubun').val()
        var reg_chumonsyajouhou = tradingCondition.find('#reg_chumonsyajouhou').val()
        var reg_soufusakijouhou = tradingCondition.find("#reg_soufusakijouhou").val();
        var transactionData = {
            'reg_kessaihouhou': reg_kessaihouhou,
            'reg_housoukubun': reg_housoukubun,
            'reg_chumonsyajouhou': reg_chumonsyajouhou,
            'reg_soufusakijouhou': reg_soufusakijouhou
        }
        transactionData = JSON.stringify(transactionData)
        localStorage.setItem('transactionData', transactionData)
        tradingCondition.modal("hide");
    });


    $(".closeTradingConditionModal").on("click", function () {
        var transactionData = JSON.parse(localStorage.getItem('transactionData'))
        var {reg_kessaihouhou, reg_housoukubun, reg_chumonsyajouhou, reg_soufusakijouhou} = transactionData;
        $('#reg_kessaihouhou').val(reg_kessaihouhou)
        $('#reg_housoukubun').val(reg_housoukubun)
        $('#reg_chumonsyajouhou').val(reg_chumonsyajouhou)
        $("#reg_soufusakijouhou").val(reg_soufusakijouhou)
        localStorage.setItem('transactionData', JSON.stringify(transactionData))
        $('#tradingConditionModal').modal("hide");
    });

})

//取引条件 modal, set trancation loaded data
function loadTransactionData(contractorId = '', from = '') {
    var contractorId = $('#reg_sales_billing_destination_db').val() ? $('#reg_sales_billing_destination_db').val() : contractorId;
    var bango = $("input[id='userId']").val();
    console.log({contractorId})
    if (contractorId) {
        $.ajax({
            url: '/order-entry/contact-wise-trading-condition-value/' + bango,
            data: {contractorId: contractorId},
            success: function (response) {
                setTransactionData(response, from)
            }
        })
    }
}
