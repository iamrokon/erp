var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}
/*$('#categorykanri').on('change',function () {
    var categorykanri =$(this).val().split('A8');
    var catDate = categorykanri[1];
    console.log(catDate)
    if (categorykanri==''){
        $('#datepicker1_oen').val('');
    }else {
        var date = new Date();
        if (catDate=='31'){
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
            $('#datepicker1_oen').val(lastDayDate);
        }else {
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            /!*var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());*!/
            var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
            $('#datepicker1_oen').val(expectedDate);
        }

    }
});*/
$('#categorykanri').on('change',function () {
    var categorykanri =$(this).val().split('A8');
    var catDate = categorykanri[1];
    console.log(catDate)
    if (categorykanri==''){
        $('#datepicker1_oen').val('');
        $('#print_date').val('');
    }else {
        /*var date = new Date();
        if (catDate=='31'){
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            lastDayDate = (lastDay.getFullYear() + twoDigitMonth + (lastDay.getDate())).substring(6);
            // $('#datepicker1_oen').val(lastDayDate);
            console.log(lastDayDate);
        }
        else {
            lastDayDate = catDate;
            console.log(lastDayDate);
        }*/
        // var url = '{{route(\'findInvoiceDeadlineMaxDate\')}}';
        $.ajax({
            type: 'GET',
            url: '/findInvoiceDeadlineMaxDate/',
            data: {'lastDayDate': catDate},
            dataType: 'json',
            success: function (data) {
                // console.log(data==null,data);
                if (data.length>0){
                    // console.log(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                    $('#datepicker1_oen').val(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                    $('#print_date').val(data[0].date0009.split(" ")[0].replace(/-/g, '/'));
                }
                else {

                    var date = new Date();
                    if (catDate=='31'){
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        $('#datepicker1_oen').val(lastDayDate);
                        $('#print_date').val(lastDayDate);
                    }else {
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                        var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
                        var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
                        var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
                        $('#print_date').val(expectedDate);
                        $('#datepicker1_oen').val(expectedDate);
                    }
                }

            }
        });

    }
});

$("#datepicker1_oen").on("input", function(){
    $('#print_date').val($("#datepicker1_oen").val());
});

$("#msgDiv").empty();

$("#topSearchBtn").click(function (){
    /*document.getElementById('firstSearch').submit();*/
    var msg='';
    var categorykanri=$('#categorykanri').val();
    var categorykanri_date=$('#datepicker1_oen').val();
    var invoiceDeadlineSupplier1_db=$('#invoiceDeadlineSupplier1_db').val();
    var invoiceDeadlineSupplier2_db=$('#invoiceDeadlineSupplier2_db').val();
    console.log(categorykanri,categorykanri_date,invoiceDeadlineSupplier1_db,invoiceDeadlineSupplier2_db)
    // debugger;
    if (!categorykanri){
        $('#categorykanri').addClass("error");
        var msg=msg+'<p>【締め日】必須項目に入力がありません。</p>\n'
    }
    else {
        $('#categorykanri').removeClass("error");
    }
    if (!categorykanri_date){
        var msg=msg+'<p>【請求日】必須項目に入力がありません。</p>\n'
        $('#datepicker1_oen').addClass('error');
    }
    else {
        $('#datepicker1_oen').removeClass("error");
    }
    
//    if (!invoiceDeadlineSupplier1_db && invoiceDeadlineSupplier2_db){
//        $('#invoiceDeadlineSupplier1').addClass("error");
//        var msg=msg+'<p>【売上請求先1】必須項目に入力がありません。</p>\n'
//    }
//    else {
//        $('#invoiceDeadlineSupplier1').removeClass("error");
//    }
//    if (!invoiceDeadlineSupplier2_db && invoiceDeadlineSupplier1_db){
//        $('#invoiceDeadlineSupplier2').addClass("error");
//        var msg=msg+'<p>【売上請求先2】必須項目に入力がありません。</p>\n'
//    }
//    else {
//        $('#invoiceDeadlineSupplier2').removeClass("error");
//    }
//    if (!invoiceDeadlineSupplier1_db && !invoiceDeadlineSupplier2_db){
//        $('#invoiceDeadlineSupplier2').addClass("error");
//        $('#invoiceDeadlineSupplier1').addClass("error");
//        var msg=msg+'<p>【売上請求先1】【売上請求先2】必須項目に入力がありません。</p>\n'
//    }
//    else if (invoiceDeadlineSupplier1_db && invoiceDeadlineSupplier2_db) {
//        $('#invoiceDeadlineSupplier2').removeClass("error");
//        $('#invoiceDeadlineSupplier1').removeClass("error");
//    }
    
    if (msg!=''){
        $("#msgDiv").html(msg);
    }
    else {
        document.getElementById('firstSearch').submit();
    }
});


function voucherCreation(url) {
  buttonPress++;
  if (buttonPress == 1) {
      buttonPress = 0;
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var bill_to_len = $('#mail_bill_to:checked').length;
        if(bill_to_len>0){
            var mail_bill_to = 1;
        }else{
            var mail_bill_to = 0;
        }

        var billing_address_len = $('#mail_billing_address:checked').length;
        if(billing_address_len>0){
            var mail_billing_address = 1;
        }else{
            var mail_billing_address = 0;
        }

        var billing_date = $("#datepicker1_oen").val();
        var print_date = $("#print_date").val();

        //progress bar
        var per_progress = parseInt(100 / len);
        $("#customprogress").css('pointer-events','none');

        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            data:data+"&bill_to="+mail_bill_to+"&billing_address="+mail_billing_address+"&billing_date="+billing_date+"&print_date="+print_date,
            success:function(result){
                if(result[0]=='end'){
                    //progress bar
                    if (localStorage.getItem('invoiceDeadlineProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('invoiceDeadlineProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                    }else{
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    localStorage.removeItem('invoiceDeadlineProgressBar')
                    
                    //$(".loading").removeClass('show');
                    //var html = "<p style='font-weight: bold;color: #0c51a7; margin: 0px;'>"+result[2]+": execution time "+ result[1].date+"</p>";
                    //$("#error_data").append(html);
                    location.reload();
                }else if(result[0]=='going'){
                    //progress bar
                    if (localStorage.getItem('invoiceDeadlineProgressBar') !== null) {
                        var prev_progress = localStorage.getItem('invoiceDeadlineProgressBar');
                        var newprogress = parseInt(prev_progress)+per_progress;
                        localStorage.setItem('invoiceDeadlineProgressBar',newprogress);
                    }else{
                        localStorage.setItem('invoiceDeadlineProgressBar',per_progress);
                        var newprogress = per_progress;
                    }
                    $('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
                    
                    //recursive call to prevent timeout error
                    voucherCreation(url);
                    //var html = "<p style='font-weight: bold;color: #0c51a7; margin: 0px;'>"+result[2]+": execution time "+ result[1].date+"</p>";
                    //$("#error_data").append(html);
                }else if($.trim(result) == 'ng'){
                    location.reload();
                }else{
                  console.log("Something went wrong");
                }
            },
            beforeSend:function(){
                //$(".loading").addClass('show');
            }
        });

    }else{
        var html = "<p>対象が選択されていません。</p>";
        $('#error_data').html(html);
    }

  } else {
    doubleClick();
  }
}

function mailConfirmation(){
    var len = $('input[name="selected_item[]"]:checked').length;
    if(len>0){
      $("#confirm_email_transmission_modal").modal('show');
    }else{
        var html = "<p>対象が選択されていません。</p>";
        $('#error_data').html(html);
    }
}

function sendMail(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var billing_date = $("#datepicker1_oen").val();
        
        var bill_to_len = $('#mail_bill_to:checked').length;
        if(bill_to_len>0){
            var mail_bill_to = 1;
        }else{
            var mail_bill_to = 0;
        }

        if(mail_bill_to == 0){
            alert("チェックを選択してください。");
            buttonPress = 0;
        }else{
            var url = url;
            var data = $('#mainForm').serialize();
            $.ajax({
                type:"POST",
                url: url,
                data:data+"&bill_to="+mail_bill_to+"&billing_date="+billing_date,
                success:function(result){
                    if($.trim(result) == 'ok'){
                        $("#confirm_email_transmission_modal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else if($.trim(result) == 'mailnai'){
                        $("#confirm_email_transmission_modal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else if($.trim(result) == 'no_password'){
                        $("#confirm_email_transmission_modal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else if($.trim(result) == 'ng'){
                        $("#confirm_email_transmission_modal").modal('hide');
                        $(".loading").removeClass('show');
                        location.reload();
                        buttonPress = 0;
                    }else{
                      buttonPress = 0;
                      console.log("Something went wrong");
                    }
                },
                beforeSend:function(){
                    $(".loading").addClass('show');
                }
            });
        }

      }else{
            buttonPress = 0;
            var html = "<p>対象が選択されていません。</p>";
            $('#error_data').html(html);
      }

  } else {
    doubleClick();
  }
}

//function sendMail() {
//  buttonPress++;
//  if (buttonPress == 1) {
//      var len = $('input[name="selected_item[]"]:checked').length;
//      if(len>0){
//        var bill_to_len = $('#mail_bill_to:checked').length;
//        if(bill_to_len>0){
//            var mail_bill_to = 1;
//        }else{
//            var mail_bill_to = 0;
//        }
//
//        if(mail_bill_to == 0){
//            alert("チェックを選択してください。");
//            buttonPress = 0;
//        }else{
//            var billing_date = $("#datepicker1_oen").val();
//            var bango = $("input[id='userId']").val();
//            $('input[name="selected_item[]"]:checked').each(function(){
//                var selected_item = $(this).val();
//                var base_url = window.location.origin;
//                var url = base_url+"/invoiceSendMail/" + bango
//                var data = $('#mainForm').serialize();
//                $.ajax({
//                    type:"POST",
//                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
//                    url: url,
//                    data:"selected_item="+selected_item+"&bill_to="+mail_bill_to+"&billing_date="+billing_date,
//                    success:function(result){
//                        console.log(result);
//                        if($.trim(result) == 'ok'){
//                            $("#mailConfirmationModal").modal('hide');
//                            $(".loading").removeClass('show');
//                            location.reload();
//                            buttonPress = 0;
//                        }else if($.trim(result) == 'mailnai'){
//                            $("#mailConfirmationModal").modal('hide');
//                            $(".loading").removeClass('show');
//                            location.reload();
//                            buttonPress = 0;
//                        }else if($.trim(result) == 'no_password'){
//                            $("#mailConfirmationModal").modal('hide');
//                            $(".loading").removeClass('show');
//                            location.reload();
//                            buttonPress = 0;
//                        }else if($.trim(result) == 'ng'){
//                            $("#mailConfirmationModal").modal('hide');
//                            $(".loading").removeClass('show');
//                            location.reload();
//                            buttonPress = 0;
//                        }else{
//                          buttonPress = 0;
//                          console.log("Something went wrong");
//                        }
//                    },
//                    beforeSend:function(){
//                        $(".loading").addClass('show');
//                    }
//                });
//            });
//        }
//
//      }else{
//           buttonPress = 0;
//      }
//
//  } else {
//    doubleClick();
//  }
//}

function downloadPDF(url) {
  buttonPress++;
  if (buttonPress == 1) {
      var len = $('input[name="selected_item[]"]:checked').length;
      if(len>0){
        var billing_date = $("#datepicker1_oen").val();
        var url = url;
        var data = $('#mainForm').serialize();
        $.ajax({
            type:"POST",
            url: url,
            async: false,
            data:data+"&billing_date="+billing_date,
            success:function(result){
                if(result.length>0 && typeof result !=='string'){
                   for(var i=0;i<result.length;i++ ){
                        var position = result[i].lastIndexOf("/");
                        var filename = result[i].substr(position+1);
                        //download the file
                        download(result[i],filename);
                    }

                    buttonPress = 0;
                    $('.loading-icon').hide();
                    $('#error_data').html("");
                    document.getElementById('req_status_msg_main').style.display = 'block';
                    document.getElementById('req_status_msg').innerHTML = 'ダウンロードが完了しました。';

                    $(".unselectall").click();
                }else{
                    $('.loading-icon').hide();
                    buttonPress = 0;
                    console.log("No PDF found");
                }
            }
        });
      }else{
           buttonPress = 0;
           var html = "<p>対象が選択されていません。</p>";
           $('#error_data').html(html);
      }

  } else {
    doubleClick();
  }
}


function download(res,filename){
    fetch(res)
    .then(resp => resp.blob())
    .then(blob => {
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = url;
      // the filename you want
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      window.URL.revokeObjectURL(url);
    });
}

function closeMsg(){
  document.getElementById('req_status_msg_main').style.display = 'none';
}

function loadInvoiceDeadlineSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    var supplier2 = $("#invoiceDeadlineSupplier2").val();
    document.getElementById('invoiceDeadlineSupplier2_db').value = torihikisaki_cd;
    document.getElementById('invoiceDeadlineSupplier2').value = torihikisaki_details;
}