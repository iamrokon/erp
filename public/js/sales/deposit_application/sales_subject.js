
$(document).ready(function () {
    $(".loading").hide();
    $("#searchBtn").on("click", function () {
        
        if (checkDatefields()) {
        $(".loading").toggle();
        $("#fixed_record").attr("disabled", true);
        let complete_status = $('input[type=radio][name=complete_status]:checked').val();
        let sales_date_start = $("input[name=sales_date_start]").val()
        let sales_date_end = $("input[name=sales_date_end]").val()
        let billing_address = $("input[name=billing_address]").val()
        let bango = $("#userId").val()
        let _token = $("#csrf").val()

        $.ajax({
            url: 'deposit-application/sales-subject/' + bango, 
            type: 'POST',
            data: {complete_status, sales_date_end, sales_date_start, billing_address, bango, _token},
            success: function (res) {
                $(".loading").hide();

                const {sales_subject_view} = res
             
                if (sales_subject_view == undefined) {
                    $("#error_data").html('<p>売上請求先は必須です</p>')
                }else{
                    var msg= $("#error_data").html();
                    msg=msg.replace('<p>売上請求先は必須です</p>', '')
                    $("#error_data").html(msg)
                }
                $("#div_sales_subject").html(sales_subject_view);
                var sales_number = $("#sales_number").val(); 
                for(var i=1;i<=sales_number;i++){
                  $("#depositAmount_"+i).trigger("keyup");
                }
                if (sales_number =='0') {
                    var msg= $("#error_data").html();
                    $("#error_data").html(msg+"<p>該当の売上データがありません</p>")
                }else{
                    var msg= $("#error_data").html();
                    msg=msg.replace('<p>該当の売上データがありません</p>', '')
                    $("#error_data").html(msg)
                }
                if($("#customRadio2").prop('checked') == true){
                    $("#choice_button").prop('disabled', false)
                }else{
                    $("#choice_button").prop('disabled', false) 
                    check_before_update()
                }
                
            }
        })
       } 
    })

    $("#fixed_record").on("click", function () {
        if ($("#billing_address").val()) {
             var msg= $("#error_data").html();
             msg=msg.replace('<p>売上請求先は必須です</p>', '')
             $("#error_data").html(msg)
        no_check++;
        console.log(no_check)
        $("#searchBtn").attr("disabled", true);
        let complete_status = $('input[type=radio][name=complete_status]:checked').val();
        let sales_date_start = $("input[name=sales_date_start]").val()
        let sales_date_end = $("input[name=sales_date_end]").val()
        let billing_address = '0'
        let bango = $("#userId").val()
        let _token = $("#csrf").val()
        console.log(complete_status)
        $.ajax({
            url: 'deposit-application/sales-subject/' + bango, 
            type: 'POST',
            data: {complete_status, sales_date_end, sales_date_start, billing_address, bango, _token},
            success: function (res) {
                console.log({res});
                const {sales_subject_view} = res
                $("#div_sales_subject").html(sales_subject_view);
                var sales_number = $("#sales_number").val(); 
                for(var i=1;i<=sales_number;i++){
                  $("#depositAmount_"+i).trigger("keyup");
                }
                $("#choice_button").prop('disabled', false) 
               // check_before_update()
            }
        })
        }else{
            $("#error_data").html('<p>売上請求先は必須です</p>')
        }
    })

})

function check_before_update() {

  
    if ( $("#deposit_number-0").text().trim()=='0') {
        console.log('1')
       $("#choice_button").prop('disabled', true)
    }
    if( $("#depositAmount_1").text().trim()=='0') {
        console.log('2')
       $("#choice_button").prop('disabled', true)
    }
    if ( parseInt($("#applicable_amount").text().replaceAll(',','')) ==0 ) {

       $("#choice_button").prop('disabled', true)
    }
    
}

function checkDatefields(){
   var from= $("input[name='sales_date_start']").val();
   var to= $("input[name='sales_date_end']").val();

   if (from == '' || to=='' || from == null || to==null) {
     if (!from && !to) {
         $("#error_data").html('<p>【売上日1】必須項目に入力がありません。</p><p>【売上日2】必須項目に入力がありません。</p>')
     }else if (!from && to) {
        $("#error_data").html('<p>【売上日1】必須項目に入力がありません。</p>')
     }else if (from && !to) {
        $("#error_data").html('<p>【売上日2】必須項目に入力がありません。</p>')
     }
     return false
   }else{
       $("#error_data").html('')
   }

   if (from <= to) {
     return true;
   }else{
    $("#error_data").html('<p>【売上日】正しい年月日を入力してください。</p>') 
   }

   return false;

}