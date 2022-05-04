var buttonPress = 0;
function doubleClick() {
    alert('処理中です');
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function createMsg(err_msg, type) {
    console.log(typeof (err_msg));
    var typeMessage = type ? 'blue' : 'red';
    var html = '<div>';
    if (typeof (err_msg) != 'string') {
        var errmsg = err_msg.filter(onlyUnique)
        for (var count = 0; count < errmsg.length; count++) {
            html += '<p style="color:' + typeMessage + ';">' + errmsg[count] + '</p>';
        }
    } else {
        html += '<p style="color:' + typeMessage + ';">' + err_msg + '</p>';
    }

    html += '</div>';
    return html;
}

function firstSearch(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var url = url;
        var data = $('#firstSearch').serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (result) {
                console.log({ result })
                if ($.trim(result) == 'ok') {
                    document.getElementById('first_csrf').disabled = false;
                    document.getElementById('firstButton').value = "FirstSearch";
                    document.getElementById("firstSearch").submit();
                } else {
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    console.log(inputError);
                    let err_msg = result.err_msg
                    $('#error_data').html(createMsg(err_msg));
                    $("#error_data").show();
                    if (inputError.ledger_year_start) {
                        $('#ledger_year_start').addClass("error");
                    } else {
                        $('#ledger_year_start').removeClass("error");
                    }
                    if (inputError.ledger_year_end) {
                        $('#ledger_year_end').addClass("error");
                    } else {
                        $('#ledger_year_end').removeClass("error");
                    }
                    if (inputError.billing_address_text) {
                        $('#billing_address').addClass("error");
                    } else {
                        $('#billing_address').removeClass("error");
                    }
                  
                    // $("#billing_ledger_0408_pagination_header_html_pagination_new1").html("");
                    var element1 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new1");
                    if(element1){
                        element1.parentNode.removeChild(element1);
                    }
                    

                    $("#billing_ledger_0408_pagination_header_html_pagination_new2").html("情報総数 0");
                  //  $("#billing_ledger_0408_pagination_header_html_pagination_new3").html("");
                    var element3 = document.getElementById("billing_ledger_0408_pagination_header_html_pagination_new3");
                    if(element3){
                        element3.parentNode.removeChild(element3);
                    }
                    
                    $("#billing_ledger_0408_pagination_header_html_pagination_new4").html("ページ総数 1");
                    $("#billing_ledger_0408_pagination_table_body").empty();
                    document.getElementById("excelDwld").disabled = true;
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

/*function loadBillingLedgerSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    // alert('hlw');
    // console.log(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details);
    if (torihikisaki_cd){
        $.ajax({
            type: 'GET',
            url: '/findBillingLedgerMaxDate/',
            data: {'companyCode': torihikisaki_cd},
            dataType: 'json',
            success: function (data) {
                // console.log(data.length>0,data);
                $('#ledger_year_start').val(data.replace(/-/g, '/'));
            }
        });
    }
}*/


