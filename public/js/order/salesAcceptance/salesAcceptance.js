var submitflag = 0;
var differentiating_flag = 0;
function filterdatatxt0003() {
    var submitflag = 0;
    var filterOn = document.getElementById("datatxt0003").value;
    //var datatxt0003=val.substring(2);
    var url = '/sales_acceptance_process/filterCategory';
    var filterKey = "C1";
    
    var categoryhtml3 = "<option value=''>-</option>";

    $.ajax({
        type: "GET",
        url: url,
        data: { 'filterOn': filterOn, 'filterKey': filterKey },
        success: function (res) {
            var opitions = JSON.parse(res);

            $('#datatxt0004').html(opitions.categoryhtml2);
            $('#datatxt0005').html(categoryhtml3);
            //$('#usersoption').html(opitions.tantousyahtml);

        }
    });
}

function filterdatatxt0004() {
    var submitflag = 0;
    var filterOn = document.getElementById("datatxt0004").value;
    //var datatxt0003=val.substring(2);
    var url = '/sales_acceptance_process/filterCategory';
    var filterKey = "C2";
    console.log(filterOn);
    if(filterOn == ""){
       var categoryhtml3 = "<option value=''>-</option>";
       $('#datatxt0005').html(categoryhtml3);
    }else{
        $.ajax({
            type: "GET",
            url: url,
            data: { 'filterOn': filterOn, 'filterKey': filterKey },
            success: function (res) {

                var opitions = JSON.parse(res);


                $('#datatxt0005').html(opitions.categoryhtml3);
                //$('#usersoption').html(opitions.tantousyahtml);

            }
        });
    }
}

function filterdatatxt0005() {
    var submitflag = 0;
    var filterOn = document.getElementById("datatxt0005").value;
    //var datatxt0003=val.substring(2);
    var url = '/sales_acceptance_process/filterCategory';
    var filterKey = "C2";

    $.ajax({
        type: "GET",
        url: url,
        data: { 'filterOn': filterOn, 'filterKey': filterKey },
        success: function (res) {


            var opitions = JSON.parse(res);

            //$('#usersoption').html(opitions.tantousyahtml);

        }
    });
}
function goToSales() {
    var submitflag = 0;
    var paginate = parseInt($('#paginate').val())
    formSubmit()
}
function goForwardSales() {
    var submitflag = 0;
    var paginate = parseInt($('#paginate').val()) + 1
    console.log(paginate)
    $('#paginate').val(paginate);
    formSubmit()
}
function goBackSales() {
    var submitflag = 0;
    var paginate = parseInt($('#paginate').val()) - 1
    $('#paginate').val(paginate);
    formSubmit()
}
function formSubmit() {
    var submitflag = 0;
    $(".loading").addClass('show');
    var bango = $("input[name='userId']").val();
    var data = $('#searchForm').serialize();
    var url = "/sales_acceptance_process/searchOrder";
    var paginate = $('#paginate').val();
    data = data + '&page=' + (paginate == '' ? 1 : paginate)
    console.log(data)
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (res) {
            $(".loading").removeClass('show');
            chnagedropdown(res.status)
            $('#total_data').text(res.result.total);
            $('#from_data').text(res.result.from);
            $('#to_data').text(res.result.to);
            $('#total_page').text(res.result.last_page);
            $('#paginate').val(res.result.current_page);
            
            if (res.result.total>20) {
                document.getElementById('pagination_div').style.display = 'block';
            }else{
                document.getElementById('pagination_div').style.display = 'none';
            }
            var htmlData = res.html;
            var length = res.length;
            if (length == '0' && differentiating_flag==0) {
                $('#orderRows').html(htmlData);
                document.getElementById('msgFromBack').style.display = 'none';
                $('#err_msg').html('<p style="color:red;">該当するデータがありません。</p>');
                $("#ordersubmit").addClass("disable");
            } else {
                $('#orderRows').html(htmlData);
                $("#ordersubmit").removeClass("disable");
            }



        }
    })

}

function makePdftoZip(orderId, information1, information2, intorder01, information3) {
    var submitflag = 0;
    $(".loading").addClass('show');
    var url = "/sales_acceptance_process/makePdfZip";
    var tantousya = $("#usersoption").val();
    var bango = $("input[name='userId']").val();
    //var bango=1002;
    console.log(bango);
    $("#customRadio1").val(information2)
    $("#customRadio2").val(information1)
    $('#choice_button').val(information2)
    $('#orderbangohidden').val(orderId)


    $.ajax({
        type: "GET",
        url: url,
        data: { 'orderId': orderId, 'tantousya': tantousya, 'bango': bango, 'kokyaku': information2, 'intorder01': intorder01, 'information3': information3 },
        success: function (res) {

            //var url = window.location.hostname+'/'+res.pdffile;

            var a = document.getElementById(orderId); //or grab it
            console.log(a);
            a.href = res.pdffile;
            document.getElementById(orderId).click();
            $(".loading").removeClass('show');
            if (typeof (res.zipfile) == 'string' && res.zipfile == 'passwordempty') {
                // document.getElementById('msgFromBack').style.display = 'block';
                document.getElementById('err_msg').innerHTML = 'パスワードの入力がないため、メール送信できませんでした。';
                // $(".dismissAlertMessage").focus();
            } else {
                $("#project_reg_modal2").modal('show');
            }
        }
    })
}

function sendMail(number) {
    var submitflag = 0;
    var order = $('#orderbangohidden').val();
    var selectedUser = $('#usersoption').val();
    var number = number.value;
    var bango = $("input[name='userId']").val();
    var url = '/sales_acceptance_process/sendMail';

    $.ajax({
        type: "GET",
        url: url,
        data: { 'orderId': order, 'number': number, 'bango': bango, 'selectedUser': selectedUser },
        success: function (res) {


            if (res[0] == 'ok') {
                $('#project_reg_modal2').modal('hide')
                document.getElementById('msgFromBack').style.display = 'block';
                document.getElementById('msgFromJs').innerHTML = '検収書メールを送信しました';
                document.getElementById('err_msg').innerHTML =''
            }
            else if (res[0] == 'ng') {
                $('#project_reg_modal2').modal('hide')
                document.getElementById('msgFromBack').style.display = 'none';
                document.getElementById('err_msg').innerHTML = '選択した宛先の個人項目「メールアドレス」 が入力されていないため、処理できません。マスタより登録後、再度処理を行ってください。<br/>対象:' + number + ' ' + res[1];
            } else if (res[0] == 'mailnai') {
                $('#project_reg_modal2').modal('hide')
                document.getElementById('msgFromBack').style.display = 'none';
                document.getElementById('err_msg').innerHTML = '有効なメールアドレスではありませんでしたので、以下はメール未送信です<br/>対象:' + number + ' ' + res[1]
            } else {
                $('#project_reg_modal2').modal('hide')
                document.getElementById('msgFromBack').style.display = 'none';
                document.getElementById('err_msg').innerHTML = res
            }

        }
    })
}

function optionChange(own) {
    var submitflag = 0;
    document.getElementById('confirmation_message').innerHTML =""
    console.log(own.value)
    $('#choice_button').val(own.value)
}

function submitOrders() {
    $("#err_msg").text('')
    document.getElementById('confirmation_message').innerHTML =""
    var check_err = 0;
    $('.only_order').each(function (i, obj) {

        if ($(this).hasClass('errorForSelect')) {
            check_err++
        }
    }); 

    //var review_date_err_exist = 0;
    $('.datePicker').each(function (i, obj) {
        var serial = $(this).parents('.parentClass').find('.serial').val()
        var name=null;
        var from="";
        var review_date="";
        if($(this).attr('name').indexOf('intorder04') !== -1){
           name= '【検収日】';
        }
        if ($(this).attr('name').indexOf('intorder03') !== -1) {
           name= '【売上日】';
           
           from = $(this).parents('.lastRow').find('.from_date').val().replaceAll('/','')
           review_date=$("#review_date").val()
        }
        if ($(this).attr('name').indexOf('intorder05') !== -1) {
           name= '【入金日】';
        }
        

        if (!$(this).val()) {
            $(this).addClass('error')
            check_err++
            
            var msg = serial.trim()+'検収確認書'+ name + '必須項目に入力がありません。'
            if (!document.getElementById('err_p-'+serial.trim()+name)) {
                $("#err_msg").append("<p id='err_date-" +serial.trim()+name+ "'>" + msg + "</p>")
            }
           
        }else if($(this).attr('name').indexOf('intorder03') !== -1 && parseInt(from) <=parseInt(review_date)){
            check_err++
            console.log(from, review_date)
            $(this).addClass('error')
            if (!document.getElementById('err_p-'+serial.trim())) {
                // if(!review_date_err_exist){
                //     review_date_err_exist = 1;
                    $("#err_msg").append("<p id='err_date-" + serial.trim() + "'>" +serial.trim() + "売上確定済の売上日です。" + "</p>")
                //}
            }
        }
        else{
                $(this).removeClass('error')
                $('#err_date-' +serial.trim()+name).remove()
            }
    });

    
    if (check_err == 0) {
        if (submitflag == 0) {
            document.getElementById('confirmation_message').innerHTML = '登録はまだ完了していません。内容をご確認後、もう一度「登 録」をお願いします。'
            submitflag++
        }
        else {
            var bango = $("input[name='userId']").val();
            var everydata = $('#orderForm').serialize();
            let myForm = document.getElementById('orderForm');
            var data = new FormData(myForm);
            $(".loading").addClass('show');
            var url = "/sales_acceptance_process";

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (res) {
                    $(".loading").removeClass('show');
                    differentiating_flag=1;
                    console.log(res.trim(), res.trim() == 'ok')
                    if (res.trim() == 'ok') {
                        var msg = '登録が完了しました。'
                        $("#msgFromBack").removeClass('alert-danger')
                        $("#msgFromBack").addClass('alert-primary')
                        document.getElementById('msgFromBack').style.display = 'block';
                        document.getElementById('msgFromJs').innerHTML = msg
                        $("#shitanoformsubmit").click()
                        $(".dismissAlertMessage").focus();
                    } else {
                        var msg = '他のユーザーこのデータを変更しています。再度検索してデータを取得し直して下さい。'
                        $("#msgFromBack").removeClass('alert-primary')
                        $("#msgFromBack").addClass('alert-danger')
                        document.getElementById('msgFromBack').style.display = 'block';
                        document.getElementById('msgFromJs').innerHTML = msg;
                        //$('#orderRows').html(htmlData);
                    }

                }
            });
            document.getElementById('confirmation_message').innerHTML = ''
            submitflag = 0
        }
    }
}
function validateBeforeSearch() {
    document.getElementById('confirmation_message').innerHTML = ''
    var submitflag = 0;
    var datatxt0003 = document.getElementById('datatxt0003').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;
    var usersoption = document.getElementById('usersoption').value;
    if (to == '') {
        $('#to').addClass('error')
    } else {
        $('#to').removeClass('error')
    }
    if (from == '') {
        $('#from').addClass('error')
    } else {
        $('#from').removeClass('error')
    }
    if (datatxt0003 == '') {
        $('#datatxt0003').addClass('error')

    } else {
        $('#datatxt0003').removeClass('error')
    }
    /*if (usersoption == '') {
      $('#usersoption').addClass('error')

    }else{
      $('#usersoption').removeClass('error')
    }*/



    if (to != '' & from != '' & datatxt0003 != '') {
        $("#err_msg").html('')
        formSubmit();
    } else {
        var msg = '必須項目に入力がありません。'
        $("#err_msg").html(msg)
    }

}

function closeMsg() {
    var submitflag = 0;
    document.getElementById('msgFromBack').style.display = 'none';
}

function checkTheDate(own) {
    var submitflag = 0;
    var from = own.parents('.lastRow').find('.from_date').val()
    var date_from = from.replace('/', '')
    var to = own.parents('.lastRow').find('.to_date').val()
    var date_to = to.replace('/', '')
    console.log(to < from, to, from)
    var review_date=$("#review_date").val()

    if (date_to < date_from) {
        own.addClass('error')
        own.parents('.lastRow').find('.from_date').addClass('error')
        own.parents('.lastRow').find('.to_date').addClass('error')
        $("#ordersubmit").addClass("disable");
        //$("#err_msg").append("<p id='err_date-" +serial.trim()+name+ "'>" + msg + "</p>")
    } else {
        own.parents('.lastRow').find('.from_date').removeClass('error')
        own.parents('.lastRow').find('.to_date').removeClass('error')
        own.removeClass('error')
        //$('#err_date-' +serial.trim()+name).remove()
        $("#ordersubmit").removeClass("disable");
    }
    
    ///date check///
    var from = own.parents('.lastRow').find('.from_date').val().replaceAll('/','')
    var review_date=$("#review_date").val()
    var value = own.parents('.lastRow').find('.only_order').val()
    var serial = own.parents('.parentClass').find('.serial').val()
    console.log(value,from,review_date)
    if (value!=1) {
    if (parseInt(from) <=parseInt(review_date)) {
        //own.parents('.lastRow').find('.to_date').addClass('error')
        own.parents('.lastRow').find('.from_date').addClass('error')
        if (!document.getElementById('date_err_p-'+serial.trim())) {
               $("#err_msg").append("<p id='date_err_p-" + serial.trim() + "'>" + serial.trim()+"売上確定済の売上日です。" + "</p>")
           }
    }else{
        $('#date_err_p-' + serial.trim()).remove()
        own.parents('.lastRow').find('.from_date').removeClass('error')
        //own.parents('.lastRow').find('.to_date').removeClass('error')

    }
    }else{
        $('#date_err_p-' + serial.trim()).remove()
        own.parents('.lastRow').find('.from_date').removeClass('error')
    }
    ////////////////
}

function checkTheUpperDate() {
    var submitflag = 0;
    var from = $('#from').val()
    var date_from = from.replace('/', '')
    var to = $('#to').val()
    var date_to = to.replace('/', '')
    console.log(to < from, to, from)
    if (date_to < date_from) {

        $('#from').addClass('error')
        $('#to').addClass('error')
        var msg = '正しい年月日を入力してください。'
        $("#err_msg").html(msg)
        $("#shitanoformsubmit").addClass("disable");
    } else {
        $('#from').removeClass('error')
        $('#to').removeClass('error')
        $("#err_msg").html('')
        $("#shitanoformsubmit").removeClass("disable");
    }

}
 
function checkTheUser(own, flag, datachar09,color_flag) {

    var submitflag = 0;
    var value = own.val()
    var created_user = own.parents('.parentClass').find('.created_user').val()
    var serial = own.parents('.parentClass').find('.serial').val()
    var test = own.parents('.parentClass').find('.c_hover').text();
    datachar09 = (test.trim()!="検収確認書PDFアップロード")?'21332132':datachar09
  

    var bango = $("input[name='userId']").val();
  
    if (value=='3') {
        if (flag=='ng') {
            var msg = serial.trim() + '当受注の検印資格がありません。'
            if (!document.getElementById('err-'+serial.trim())) {
            $("#err_msg").append("<p id='err-" + serial.trim() + "'>" + msg + "</p>")
            }

            if (!datachar09 && color_flag !='2') {
                var msg = serial.trim() + '検収確認書PDFは必須です。'
                if (!document.getElementById('err_p-'+serial.trim())) {
                    $("#err_msg").append("<p id='err_p-" + serial.trim() + "'>" + msg + "</p>")
                }
            }else{
                $('#err_p-' + serial.trim()).remove()
            }
            own.addClass('errorForSelect')
            $("#ordersubmit").addClass("disable");
        }else{
            if (color_flag =='2') {
                $('#err-' + serial.trim()).remove()
                own.removeClass('errorForSelect')
            }else{
                if (datachar09) {
                    own.removeClass('errorForSelect');
                    $('#err_p-' + serial.trim()).remove()
                }else{
                    var msg = serial.trim() + '検収確認書PDFは必須です。'
                    if (!document.getElementById('err_p-'+serial.trim())) {
                        $("#err_msg").append("<p id='err_p-" + serial.trim() + "'>" + msg + "</p>")
                    }
                    own.addClass('errorForSelect')
                    $("#ordersubmit").addClass("disable");
                }
            }
        }
    }else if(value=='2'){
       if (datachar09 || color_flag=='2') {
           $('#err_p-' + serial.trim()).remove()
           $('#err-' + serial.trim()).remove()
           own.removeClass('errorForSelect')
       }else if(!datachar09)
       {
           var msg = serial.trim() + '検収確認書PDFは必須です。'
           if (!document.getElementById('err_p-'+serial.trim())) {
               $("#err_msg").append("<p id='err_p-" + serial.trim() + "'>" + msg + "</p>")
           }
           $('#err-' + serial.trim()).remove()
           own.addClass('errorForSelect')
           $("#ordersubmit").addClass("disable");
       }else{
           $('#err_p-' + serial.trim()).remove()
           $('#err-' + serial.trim()).remove()
           own.removeClass('errorForSelect')
       }
    }else{
       $('#err_p-' + serial.trim()).remove()
       $('#err-' + serial.trim()).remove()
       own.removeClass('errorForSelect')
    }

    var from = own.parents('.lastRow').find('.from_date').val().replaceAll('/','')
    var review_date=$("#review_date").val()
    console.log(from,review_date)
    if (value!=1) {
    if (parseInt(from) <=parseInt(review_date)) {
        //own.parents('.lastRow').find('.to_date').addClass('error')
        own.parents('.lastRow').find('.from_date').addClass('error')
        if (!document.getElementById('date_err_p-'+serial.trim())) {
               $("#err_msg").append("<p id='date_err_p-" + serial.trim() + "'>" + serial.trim()+"売上確定済の売上日です。" + "</p>")
           }
    }else{
        $('#date_err_p-' + serial.trim()).remove()
        own.parents('.lastRow').find('.from_date').removeClass('error')
        //own.parents('.lastRow').find('.to_date').removeClass('error')

    }
    }else{
        $('#date_err_p-' + serial.trim()).remove()
        own.parents('.lastRow').find('.from_date').removeClass('error')
    }
    var i = 1;
    $('#err_msg').children('p').each(function () {
        i++;
    });
    if (i <= 1) {
        $("#ordersubmit").removeClass("disable");
    }else{
        $("#ordersubmit").addClass("disable");
    }

   
}


function changeAllchild(own) {
    var submitflag = 0;
    var check_err = 0;
    $('.only_order').each(function (i, obj) {
        var check = $(this).data('check');
        var datachar09 = $(this).data('datachar09');
        var color =$(this).data('color_flag');

        $(this).val(own.val())
        checkTheUser($(this),check,datachar09,color)
        

    });

    /*if (check_err > 0) {
        $("#err_msg").text('検収確認書PDFは必須です。')
    } else {
        $("#err_msg").text('')
    }*/

}

function chnagedropdown(val) {
    var submitflag = 0;
    //$('#referTo').find('option:selected').removeAttr('selected')
    $('#referTo').find('option[value=1]').removeAttr('selected')
    $('#referTo').find('option[value=2]').removeAttr('selected')
    $('#referTo').find('option[value=3]').removeAttr('selected')
    $('#referTo').val(val)
    $('#referTo').find('option[value=' + val + ']').attr('selected', 'selected');
    //changeAllchild($('#referTo'))
}
