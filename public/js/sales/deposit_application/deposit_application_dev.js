function loadDepositApplicationData(fillable_id, db_fillable_id, torihikisaki_cd, torihikisaki_details) {
    var bango = $('#userId').val()
    $.ajax({
        type : 'POST',
        url: 'deposit-application/bill-wise-data/'+bango,
        data: {
            '_token': $("#csrf").val(),
            'chumonsyaname': torihikisaki_cd
        },
        success : function(response){
            $("#choice_button").prop('disabled', true)  
            const {deposit_amount,payment_details,payment_details_view,applicable_amount} = response
            console.log(payment_details,payment_details.length ==0);
            $("#expected_deposit_amount").html(deposit_amount ? formatNumber(deposit_amount) : 0);
            $("#applicable_amount").html(applicable_amount ? formatNumber(applicable_amount) : 0);
             
            $("#div_payment_details").html(payment_details_view);
            //console.log(payment_details.length ==0)
            //if (applicable_amount == '0' && deposit_amount !='0') {
            //if (applicable_amount == '0' && deposit_amount !='0' && payment_details.length !=0) {
            if (response.payment_day_err > 0) {
                $("#error_data").html('<p>締日処理済の日付で消込が行われていない入金データは消込対象となりません。入金データを確認してください。</P>')
            }else if(applicable_amount == '0' && deposit_amount =='0'){
                $("#error_data").html('<p>該当の入金データがありません。</P>')
            }
            else{
                $("#error_data").html('')
            }
            
        },
        err : function (err){
            console.log(err)
        }
    })
}
