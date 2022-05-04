var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}

function firstSearch(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var url = url;
        var data = $('#firstSearch').serialize();
        $.ajax({
            type:"POST",
            url: url,
            data:data,
            success:function(result){
                if($.trim(result) == 'ok'){
                    document.getElementById('first_csrf').disabled = false;
                    document.getElementById('firstButton').value = "FirstSearch";
                    document.getElementById("firstSearch").submit();
                }else{
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    console.log(inputError);
                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';
                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';
                        $('#error_data').html(html);
                        $("#error_data").show();
                    }
                    if (inputError.division_datachar05_start) {
                        $('#division_datachar05_start').addClass("error");
                    } else {
                        $('#division_datachar05_start').removeClass("error");
                    }

                    // if (inputError.division_datachar05_end) {
                    //     $('#division_datachar05_end').addClass("error");
                    // } else {
                    //     $('#division_datachar05_end').removeClass("error");
                    // }

                     if (inputError.creation_category) {
                        $('#creation_category').addClass("error");
                    } else {
                        $('#creation_category').removeClass("error");
                    }

                }
            }
        });

    } else {
        doubleClick();
    }
}

function formatNumber(num) {
    if (num != null) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}

function goToFixedRateInquiry(datachar07){
    $("#goToFixedRateInquiry").find("#datachar07").val(datachar07);
    $("#goToFixedRateInquiry").submit();
}

function gotoFlatRateEntry(flat_entry_number){
    //localStorage.setItem("historyToOrderEntry",bango);
    //localStorage.setItem("historyToOrderEntryWithdataChar01",'2 受注訂正');
    //localStorage.setItem("historyToOrderEntryWithdataChar02",'U110');
    $("#flatRateNumber").val(flat_entry_number);
    $("#goToFlatRateEntry").submit();

}
