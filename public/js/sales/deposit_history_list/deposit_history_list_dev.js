var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}
function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function createMsg(err_msg, type) {
    console.log( typeof (err_msg));
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
            type:"POST",
            url: url,
            data:data,
            success:function(result){
                console.log({result})
                if($.trim(result) == 'ok'){
                    document.getElementById('first_csrf').disabled = false;
                    document.getElementById('firstButton').value = "FirstSearch";
                    document.getElementById("firstSearch").submit();
                }else{
                    buttonPress = 0;
                    $("#no_found_data").hide();
                    var inputError = result.err_field;
                    console.log(inputError);
                    let err_msg = result.err_msg
                    $('#error_data').html(createMsg(err_msg));
                    $("#error_data").show();
                    if (inputError.payment_day_start) {
                        $('#payment_day_start').addClass("error");
                    } else {
                        $('#payment_day_start').removeClass("error");
                    }
                    if (inputError.payment_day_end) {
                        $('#payment_day_end').addClass("error");
                    } else {
                        $('#payment_day_end').removeClass("error");
                    }
                    if (inputError.disposal_day_start) {
                        $('#disposal_day_start').addClass("error");
                    } else {
                        $('#disposal_day_start').removeClass("error");
                    }
                    if (inputError.disposal_day_end) {
                        $('#disposal_day_end').addClass("error");
                    } else {
                        $('#disposal_day_end').removeClass("error");
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


