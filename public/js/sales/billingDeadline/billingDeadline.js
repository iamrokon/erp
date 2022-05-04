/*
$(document).ready(function () {
    var categorykanri =$('#categorykanri').val().split('A8');
    var catDate = categorykanri[1];
    if (categorykanri==''){
        $('#datepicker1_oen').val('');
    }else {
        var date = new Date();
        console.log(catDate)
        if (catDate=='31'){
      
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
            console.log(lastDay,twoDigitMonth,lastDayDate)
            $('#datepicker2_oen').val(lastDayDate);
        }else {
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = ((lastDay.getMonth().length+1) === 1)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            /*var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());*/
           // var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
            //$('#datepicker2_oen').val(expectedDate);
        //}
        //$('#datepicker2_oen').val(expectedDate);
        //var pre_date= Date.parse(expectedDate).add({ months: -1}).toString("yyyy/MM/dd")
       // $('#1st_date').val(pre_date)

   // }
//});*/

$('#categorykanri').on('change',function () {
    var categorykanri =$(this).val().split('A8');
    var catDate = categorykanri[1];
    console.log(categorykanri)
    if (categorykanri==''){
        $('#datepicker2_oen').val('');
    }else {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var last_date = new Date(year, month , 0);
        var last_day = last_date.getDate();
     
        //if (catDate=='31'){
        if (catDate == last_day || catDate=='31'){
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);
            var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());
            var lastDayDate2 = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + '01';
            $('#datepicker2_oen').val(lastDayDate);

            //var pre_date= Date.parse(lastDayDate2).add({ months: -1}).toString("yyyy/MM/dd")
            var pre_date= Date.parse(lastDayDate2).toString("yyyy/MM/dd")
            $('#1st_date').val(pre_date)
        }else {
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var twoDigitMonth = (lastDay.getMonth() >= 9)? (lastDay.getMonth()+1) : '0' + (lastDay.getMonth()+1);

            /*var lastDayDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (lastDay.getDate());*/
            var expectedDate = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + catDate;
            var expectedDate2 = lastDay.getFullYear() + '/' + twoDigitMonth + '/' + (parseInt(catDate)+1);
            $('#datepicker2_oen').val(expectedDate);

            var pre_date= Date.parse(expectedDate2).add({ months: -1}).toString("yyyy/MM/dd")
            $('#1st_date').val(pre_date)
        }

    }
});

$('#datepicker2_oen').on('change',function () {
    var sec_date = $('#datepicker2_oen').val()
    var year = sec_date.substr(0,4);
    var month = sec_date.substr(4,2);
    var day = sec_date.substr(6,2);
    var last_date = new Date(year, month , 0);
    var last_day = last_date.getDate();
    //var p_date = sec_date.substr(0,4)+'/'+sec_date.substr(4,2)+'/'+sec_date.substr(6,2);
    if(day > last_day){
        var p_date = year+'/'+month+'/'+'01';
        //var pre_date= Date.parse(p_date).add({ months: -1}).toString("yyyy/MM/dd")
        var pre_date= Date.parse(p_date).toString("yyyy/MM/dd")
    }else{
        var last_date = new Date(year, (parseInt(month-1)) , 0);
        var last_day = last_date.getDate();
        if(parseInt(day)+1 > parseInt(last_day)){
            var p_date = year+'/'+month+'/'+'01';
            //var p_date = year+'/'+month+'/'+last_day;
            //var pre_date= Date.parse(p_date).add({ months: -1}).toString("yyyy/MM/dd") 
            var pre_date= Date.parse(p_date).toString("yyyy/MM/dd") 
        }else{
            var p_date = year+'/'+month+'/'+day;
            var pre_date= Date.parse(p_date).add({ months: -1}).add({ days: 1}).toString("yyyy/MM/dd") 
        }
        
        
    }
    $('#1st_date').val(pre_date)
})
var msgVar=null;
function searchOrder(){
    document.getElementById('sucmsg').style.display = 'none';
    var date=$("#datepicker2_oen").val()
    var asso_date=$("#categorykanri").val()

    if (date == '' &&  asso_date == '') {
        $("#datepicker2_oen").addClass('error')
        $("#categorykanri").addClass('error')
        $("#error_data").html('<p>【請求範囲】必須項目に入力がありません。</p> <p>【締め日】必須項目に入力がありません。</p>')
    }else if(date != '' &&  asso_date == ''){
        $("#datepicker2_oen").removeClass('error')
        $("#categorykanri").addClass('error')
        $("#error_data").html('<p>【締め日】必須項目に入力がありません。</p>')
    }else if(date == '' &&  asso_date != ''){
        $("#datepicker2_oen").addClass('error')
        $("#categorykanri").removeClass('error')
        $("#error_data").html('<p>【請求範囲】必須項目に入力がありません。</p>')
    }else{
        $("#datepicker2_oen").removeClass('error')
        $("#categorykanri").removeClass('error')
    }
    
   

    if (date != '' && asso_date != '') {
        $("#error_data").text('')
        submitTheform()
        msgVar='';
    }
   
}
var submit_button=0;
function submitTheform() {
    console.log(submit_button=='0')
    if (submit_button=='0') {
        submit_button++
        var check=true
        var data = $('#searchForm').serializeArray();
        data.push({ name: "check", value: check });
        var bango = $("input[name='userId']").val();
        document.getElementById("confirmation_message").innerHTML = '登録はまだ完了していません。内容をご確認後、もう一度「実 行」をお願いします。';
        var url = "/billingDeadline/searchOrder/" + 'id=' + bango;
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (res) {
                var hikiate_flag = '';
                document.getElementById("hikiate_flag").innerHTML = hikiate_flag;

                if (res[0].trim() == 'check_ok') {
                    
                    for (let index = 0; index < res[1].length; index++) {
                        hikiate_flag += "<p>入金が完了していない売上データが存在します。(売上請求先" + res[1][index] + ")</p>";
                        
                    }
                    document.getElementById("hikiate_flag").innerHTML = hikiate_flag;
                    
                }
                if (res[0].trim() == 'ec_zaiko') {
                    document.getElementById("confirmation_message").innerHTML = ''
                    var zaiko_err = "<p>入金消込が未完了のデータが存在します。入金データを確認してください。(売上請求先：" + res[1] + ")</p>"
                    document.getElementById("error_message").innerHTML = zaiko_err;
                

                }
                
            }
        });
    }else if (submit_button == '1') {
        submit_button=0
        document.getElementById("confirmation_message").innerHTML =""
 
        var bango = $("input[name='userId']").val();
        var data = $('#searchForm').serialize();
        var url="/billingDeadline/searchOrder/"+'id='+bango;
        msgVar='';
  
	
	//progress bar 
    progressBar(30);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (res) {
            console.log(res)
            var hikiate_flag='';
            document.getElementById("hikiate_flag").innerHTML = hikiate_flag;
          if (res[0].trim()=='data_nai') {
              $(".loading").removeClass('show');
        
              msgVar = "<p>"+ ' 該当データがありませんでした。' + "</p>";
              document.getElementById('sucmsg').style.display = 'none';
              document.getElementById("error_message").innerHTML = msgVar;
            //   document.getElementById('sucmsg').style.display = 'block';
            //   $('.dismissAlertMessage').focus();
            progressBar(70);
            localStorage.removeItem('billingDeadlineProgressBar');
            setTimeout(function(){
                    $(".progress").hide();
            },300);
          }else if(res[0].trim()=='all_exist'){
              $(".loading").removeClass('show');
              if (res[3].length > 0) {
              /*for (var i = 0; i < res[3].length; i++) {    
                  msgVar += "<p>" + res[3][i] + ' 該当データがありませんでした。' + "</p>";
              }*/
              msgVar += "<p>"+ ' 該当データがありませんでした。' + "</p>";
            }else{
                  document.getElementById('sucmsg').style.display = 'none';
                  msgVar += "<p>" + ' 該当データがありませんでした。' + "</p>";
            }
              document.getElementById("error_message").innerHTML = msgVar;
            //   document.getElementById('sucmsg').style.display = 'block';
            //   $('.dismissAlertMessage').focus();
            
            progressBar(70);
            localStorage.removeItem('billingDeadlineProgressBar');
            setTimeout(function(){
                    $(".progress").hide();
            },300);
          }else if(res[0].trim()=='ng'){
              $(".loading").removeClass('show');
              msgVar+=res[2]+" オーバーフローが発生したため、請求残高データを作成できませんでした。"+"<br>";
              document.getElementById("main_msg").innerHTML = msgVar;
              document.getElementById("error_message").innerHTML = '';
              document.getElementById('sucmsg').style.display = 'block';
              $('.dismissAlertMessage').focus();
              
            progressBar(70);
            localStorage.removeItem('billingDeadlineProgressBar');
            setTimeout(function(){
                    $(".progress").hide();
            },300);
          }else if(res[0].trim()=='end'){
              //progress bar 
              progressBar(70);
              
              $(".loading").removeClass('show');
              msgVar='正常に終了しました。';

			 setTimeout(function(){
				 document.getElementById("main_msg").innerHTML = msgVar;
				  document.getElementById("error_message").innerHTML = '';
				  document.getElementById('sucmsg').style.display = 'block';
				  $('.dismissAlertMessage').focus();
				  
				  localStorage.removeItem('billingDeadlineProgressBar');
				  $(".progress").hide();
			 },500);
 
              
              
          }else if(res[0].trim()=='going'){
            //progress bar 
            progressBar(30);
              
              
              submit_button='1'
              submitTheform()
              
          }else if(res[0].trim()=='copy_ok'){
              $(".loading").removeClass('show');
              msgVar='正常に終了しました。';

              document.getElementById("main_msg").innerHTML = msgVar;
              document.getElementById("error_message").innerHTML = '';
              document.getElementById('sucmsg').style.display = 'block';
              $('.dismissAlertMessage').focus();
              
            progressBar(70);
            localStorage.removeItem('billingDeadlineProgressBar');
            setTimeout(function(){
                    $(".progress").hide();
            },300);
              
          } else if (res[0].trim() == 'ec_zaiko') {
              $(".progress").hide();
              var msgVar = "<p>入金消込が未完了のデータが存在します。入金データを確認してください。(売上請求先：" + res[1] + ")</p>"
              document.getElementById("error_message").innerHTML = msgVar;
              msgVar=''

          }
        }
    })
   }
}

//progress bar starts
function progressBar(per_progress = 0){	
	//var per_progress = parseInt(100 / 5);
	if (localStorage.getItem('billingDeadlineProgressBar') !== null) {
		var prev_progress = localStorage.getItem('billingDeadlineProgressBar');
		var newprogress = parseInt(prev_progress)+per_progress;
		localStorage.setItem('billingDeadlineProgressBar',newprogress);
	}else{
		localStorage.setItem('billingDeadlineProgressBar',per_progress);
		var newprogress = per_progress;
	}
	console.log(newprogress);
	$('#progress-bar').attr('aria-valuenow', newprogress).css('width', newprogress+'%');
	$(".progress").show();
}
//progress bar ends


function loadBillingDeadlineSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    var supplier2 = $("#billingDeadlineSupplier1").val();
    document.getElementById('billingDeadlineSupplier1_db').value = torihikisaki_cd;
    document.getElementById('billingDeadlineSupplier1').value = torihikisaki_details;
}