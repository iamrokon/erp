<script type="text/javascript">

  $(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("unearned_sales_cancel_success_msg"))
    {
       createSuccessMessage(localStorage.getItem("unearned_sales_cancel_success_msg"));
       localStorage.removeItem("unearned_sales_cancel_success_msg");
    }
});


  // billing data and order data retriving after onchange 101 field
  function unearnedSalesBillingOrderDataRetrive(){
    $.ajax({
        type: "POST",
        url: '/unearnedSalesCancellation/billing_data_order_data_retrive',
        data: $('#mainForm').serialize(),
        success: function (response) {
           var result = response.result;
           if(result){
              result = result[0];
              if(result){
                $("#unearned_sales_cancellation_201").val(result["unearned_sales_cancellation_201"])
                $("#unearned_sales_cancellation_202").val(result["unearned_sales_cancellation_202"])
                $("#unearned_sales_cancellation_203").val(result["unearned_sales_cancellation_203"])
                $("#unearned_sales_cancellation_204").val(result["unearned_sales_cancellation_204"])
              }else{
                  $("#unearned_sales_cancellation_201").val("")
                  $("#unearned_sales_cancellation_202").val("")
                  $("#unearned_sales_cancellation_203").val("")
                  $("#unearned_sales_cancellation_204").val("")
              }
           }
        }
    });
  }


  // click unearnedSalesCancellation
  function unearnedSalesCancellation(){
    $.ajax({
        type: "POST",
        url: '/unearnedSalesCancellation/cancellationProcess',
        data: $('#mainForm').serialize(),
        success: function (response) {
            var error_msg = response.err_msg;
            if(error_msg){
                unearnedSalesCancellationValidation(error_msg); 
            }else{
                $("#unearned_sales_cancellation_101").removeClass("error");
                $("#datepicker1_oen").removeClass("error");
                $('#error_data').html('');
                $("#error_data").hide();
                $("#submit_confirmation").val('confirm');

                if(response.status == "confirm"){
                    var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;"> 処理はまだ完了していません。内容をご確認後、もう１度取引データ作成ボタンを押してください</p>';
                    $(document).find("#confirmation_message").html(confirmationMsg);
                      
                    // remove success message
                    if ($(document).find("#successMsg")) {
                        $(document).find("#successMsg").remove();
                    }
                  }else{
                      $(document).find("#confirmation_message").html("");
                      $("#submit_confirmation").val('');
                      //$("#mainForm").submit();
                      //createSuccessMessage('処理が終了しました');
                     // location.reload();
                     console.log("submit data")
                     //localStorage.setItem("unearned_sales_cancel_success_msg", response.success_msg);
                    //window.location.reload(); 
                }
            }

            $(".loading-icon").toggle();
        }
    });
  }



  function createSuccessMessage(message) {
    if ($(document).find("#successMsg")) {
        $(document).find("#successMsg").remove();
    }
    var success_html = `
    <div class="row success-msg-box" id="successMsg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: block;">
        <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
                    <strong id="success_data">${message}</strong>
            </div>
        </div>
    </div>
    `;
    $("#error_data").before(success_html)
}

  function unearnedSalesCancellationValidation(error_msg){
      var error_flag = 0;
      html = "<div>";
      if(error_msg.unearned_sales_cancellation_101 == "【売上番号】必須項目に入力がありません。"){
      html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.unearned_sales_cancellation_101[0]+'</p>';
        $("#unearned_sales_cancellation_101").addClass("error");
        error_flag++;
      }else{
        $("#unearned_sales_cancellation_101").removeClass("error");
      }

      if(error_msg.unearned_sales_cancellation_102 == "【取消日】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.unearned_sales_cancellation_102[0]+'</p>';
        $("#datepicker1_oen").addClass("error");
        error_flag++;
      }else{
        $("#datepicker1_oen").removeClass("error");
      }


      if(error_msg == "該当するデータがありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg+'</p>';
        error_flag++;
      }

      html += "</div>";
      if(error_flag == 0){
            $("#unearned_sales_cancellation_101").removeClass("error");
            $("#datepicker1_oen").removeClass("error");
            $('#error_data').html('');
            $("#error_data").hide();
            $("#submit_confirmation").val('confirm');
      }else{
          $('#error_data').html(html);
          $("#error_data").show();
          $("#submit_confirmation").val('');
          $(document).find("#confirmation_message").html("");
      } 
  }

  // Date Picker Initialization
  $('#datepicker1_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 1,
    offset: 4,
    trigger: '#datepicker1_oen'
  });

  $('#datepicker1_oen').on('change focus', function () {
    if ($(this).val().length == 10) {
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      $(this).focus(); //focusing current input on select
      $(this).datepicker('hide');

      if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
        $('#datepicker2_oen').val(datevalue);
        $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
        $('#datepicker2_oen').datepicker('update');
        $('#datepicker2_oen').val('');
      }
      else{
        $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
        $('#datepicker2_oen').datepicker('update');
      }
    }
  });

  $('#datepicker1_oen').on('keyup', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
      $('#datepicker2_oen').datepicker('update');
    }
  });
  // Update date value with slash on blur
  $('#datepicker1_oen').on('blur', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    }
    else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  $('#datepicker2_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 1,
    offset: 4,
    trigger: '#datepicker2_oen',
    startDate: $('#datepicker1_oen').datepicker('getDate')
  });

  $('#datepicker2_oen').on('change focus', function () {
    if ($(this).val().length == 10) {
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      $(this).focus(); //focusing current input on select
      $(this).datepicker('hide');
    }
  });

  $('#datepicker2_oen').on('keyup', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
    }
  });
  // Update date value with slash on blur
  $('#datepicker2_oen').on('blur', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    }
    else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  //Enter press hide dropdown...
  $("#datepicker1_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#datepicker1_oen").datepicker('hide');
    }
  });
  $("#datepicker2_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#datepicker2_oen").datepicker('hide');
    }
  });
  </script>


    <script type="text/javascript">
    $('#datepicker1_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 1,
      offset: 4,

    });

    $('#datepicker2_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 1,
      offset: 4,
      trigger: '#datepicker2_oen',
    });
    $('#datepicker2_oen').on('change', function() {
          $(this).focus();
        });

    //Enter press hide dropdown...
    $(".input_field").keydown(function(e){
      if(e.keyCode == 13) {
      $(".input_field").datepicker('hide');
      }
    });
  </script>
  <!--  loading icon -->
  <script>
    $(document).ready(function(){
      $(".customalert, .loading-icon").hide();
      $("#unearnedSalesCancellationSubmitBtn").click(function(){
        $(".customalert,.loading-icon").toggle();
      });

    });
  </script>
  <script>
  $(document).ready(function () {
    $(".second-table").hide();
    $(".first-table").click(function () {
      $(".second-table").show();
    });
  });
  $(document).ready(function () {
    $(".third-table").hide();
    $(".second-table").click(function () {
      $(".third-table").show();
    });
  });
</script>
  <!--  footer content // windows height resize call-->
  <script type="text/javascript">
    jQuery(function($){
      var e = function() {
          var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
          (e -= 224) < 1 && (e = 1), e > 219 && jQuery(".fullpage_width1").css("min-height", e + "px")
      };
      jQuery(window).ready(e), jQuery(window).on("resize", e);
  });
  </script>
   <!--  footer content end // windows height resize call-->