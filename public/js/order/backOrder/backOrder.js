$("#msgDiv").empty();

$("#topSearchBtn").click(function (){
    var datepickerFromval= $("#from").val();
    var datepickerToval= $("#to").val();
    if (!datepickerFromval && !datepickerToval){
        $("#from,#to").removeClass("error");
        $("#msgDiv").empty();
        var dyappend='<p>【売上年月1】 必須項目に入力がありません。</p>' +
            '<p>【売上年月2】 必須項目に入力がありません。</p>';
        $("#msgDiv").append(dyappend);
        $("#from,#to").addClass("error");
    }
    else if (!datepickerFromval) {
        $("#from,#to").removeClass("error");
        $("#msgDiv").empty();
        var dyappend='<p>【売上年月1】 必須項目に入力がありません。 </p>';
        $("#msgDiv").append(dyappend);
        $("#from").addClass("error");
    }
    else if (!datepickerToval) {
        $("#from,#to").removeClass("error");
        $("#msgDiv").empty();
        var dyappend='<p>【売上年月2】 必須項目に入力がありません。</p>';
        $("#msgDiv").append(dyappend);
        $("#to").addClass("error");
    }
    else {
        $("#from,#to").removeClass("error");
        var d = new Date();
        var pY= d.getFullYear();
        var pM= d.getMonth()+1;
        /*var pDate= pY + pM;*/

        var fDate = datepickerFromval.replace(/\//g, '');
        var tDate = datepickerToval.replace(/\//g, '');

        if(fDate > tDate){
            $("#from,#to").removeClass("error");
            $("#msgDiv").empty();
            var dyappend='<p style="color: red;font-size:12px!important;">【売上年月】 正しい年月日を入力してください。</p>';
            $("#msgDiv").append(dyappend);
            $("#from").addClass("error");
            $("#to").addClass("error");
        }else {
            document.getElementById('firstSearch').submit();
        }

    }
});


/*validation for updated date field*/

function addMonths(date, months) {
    var d = date.getDate();
    date.setMonth(date.getMonth() + +months);
    if (date.getDate() != d) {
        date.setDate(0);
    }
    return date;
}

var graterArr=[];
var gtmsg='';


var changeDateArr=[];

var msg='';
var seralArr=[];
var check_change=0;

function checkForNull(own,serial,field){
   clickButton =1;
   check_change=1;
   console.log(check_change);
    msg=''
    var realSerial=serial-1;
    var preFieldID = '';

}

//onclick register(update) button
$("#updateButton").click(function () {
    if (clickButton =='1') {
   $("#msgDiv p").empty()
   console.log($("#validateORupdate").val())
   if($("#validateORupdate").val() == 'update'){


    $("#msgDiv").empty();
    if (check_change!=1) {
        $("input[name=Button]").val("update");
    }

    document.getElementById('mainForm').method = "post";
    document.getElementById('mainForm').submit();


   }else{
      validate()
   }
  }
else{
    var msg="更新されたデータがありません。[検収日][売上日][入金日] を更新してください。"
    $('#confirmation_message').text(msg);
}
});


function validate(){
    $("#msgDiv").empty();
    $("input[name=Button]").val("validate");
    document.getElementById('mainForm').method = "post";
    document.getElementById('mainForm').submit();
}

/*for first search form submit*/

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

                    if (inputError.division_datachar05_end) {
                        $('#division_datachar05_end').addClass("error");
                    } else {
                        $('#division_datachar05_end').removeClass("error");
                    }

                    if (inputError.intorder01) {
                        $('#datepicker2_oen').addClass("error");
                        $('#datepicker1_oen').addClass("error");
                    } else {
                        if (inputError.intorder01_start) {
                            $('#datepicker2_oen').addClass("error");
                        } else {
                            $('#datepicker2_oen').removeClass("error");
                        }

                        if (inputError.intorder01_end) {
                            $('#datepicker1_oen').addClass("error");
                        } else {
                            $('#datepicker1_oen').removeClass("error");
                        }
                    }

                    if (inputError.kokyakuorderbango_start || inputError.kokyakuorderbango_end) {
                        $('#kokyakuorderbango_start_err').addClass("error");
                        $('#kokyakuorderbango_end_err').addClass("error");
                    } else {
                        $('#kokyakuorderbango_start_err').removeClass("error");
                        $('#kokyakuorderbango_end_err').removeClass("error");
                    }

                }
            }
        });

    } else {
        doubleClick();
    }
}


function showTableSettingBackOrder(url) {

    var radioFilter=$("input[type='radio'][name='rd2']:checked").val();
    console.log(radioFilter)
    $.ajax({
        type: "GET",
        url: url,
        data:{'radioFilter':radioFilter},
        success: function (response) {
            $("#setting_display_modal input").parent().find('input').removeClass("error");
            $('#errorShow').empty();
            if (typeof (response) == 'string') {
                $('#setting_display_modal').modal('show');
            } else {
                for (var key in response) {
                    // console.log(key + '=' + response[key]);
                    if (response[key] > 199) {
                        document.getElementById('setting_' + key).value = '';
                        // $('#setting_' + key).prop('readonly', true);
                    } else {
                        document.getElementById('setting_' + key).value = response[key];
                    }
                    if (response[key] || response[key] == '0') {
                        document.getElementById("check_" + key).checked = true;
                        if( $('#setting_' + key).prop('readonly')){
                            $('#setting_' + key).prop('readonly', false);
                        }
                    }

                    else {
                        document.getElementById("check_" + key).checked = false;
                        $('#setting_' + key).prop('readonly', true);
                    }
                }

                $('#setting_display_modal').modal('show');
            }
        },
    });
}

