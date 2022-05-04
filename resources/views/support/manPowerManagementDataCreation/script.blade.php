
  <!-- Date Picker -->
  <script type="text/javascript">

    // props settings on condition based
     $(document).on('change', '#man_power_management_data_creation_101', function () {
        var temp_value  = $("#man_power_management_data_creation_101").val();
        // if 101 field value is 2: 105 field is enabled otherwise other field is disabled.
        if(temp_value == 2){
          var date = new Date();
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();

          if (month < 10) month = "0" + month;
          if (day < 10) day = "0" + day;

          var today = year + "/" + month + "/" + day; 

        
          var firstDate = year + "/" + month + "/" + "01"; 
          var lastDate = year + "/" + month + "/" + new Date(year, month, 0).getDate(); 


          $("#man_power_management_data_creation_103_1").val('');
          $("#man_power_management_data_creation_103_2").val('');
          $("#man_power_management_data_creation_104_1").val('');
          $("#man_power_management_data_creation_104_2").val('');
          $("#man_power_management_data_creation_103_1").prop('disabled', true);
          $("#man_power_management_data_creation_103_2").prop('disabled', true);
          $("#man_power_management_data_creation_104_1").prop('disabled', true);
          $("#man_power_management_data_creation_104_2").prop('disabled', true);
          $("#man_power_management_data_creation_105_1").prop('disabled', false);
          $("#man_power_management_data_creation_105_1").val(firstDate);
          $("#man_power_management_data_creation_105_2").prop('disabled', false);
          $("#man_power_management_data_creation_105_2").val(lastDate);
        }else{
          var date = new Date();
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();

          if (month < 10) month = "0" + month;
          if (day < 10) day = "0" + day;

          var today = year + "/" + month + "/" + day; 

          $("#man_power_management_data_creation_103_1").prop('disabled', false);
          $("#man_power_management_data_creation_103_1").val(today);
          $("#man_power_management_data_creation_103_2").prop('disabled', false);
          $("#man_power_management_data_creation_103_2").val(today);
          $("#man_power_management_data_creation_104_1").prop('disabled', false);
          $("#man_power_management_data_creation_104_2").prop('disabled', false);
          $("#man_power_management_data_creation_105_1").val('');
          $("#man_power_management_data_creation_105_2").val('');
          $("#man_power_management_data_creation_105_1").prop('disabled', true);
          $("#man_power_management_data_creation_105_2").prop('disabled', true);
        }
    });

     // click the csv process button
     // 1. validation first
     // 2. process and download the zip files of csv
    function manPowerManagementDataCreation(){
         $.ajax({
            type: "POST",
            url: '/man-power-management-data-creation/csvProcess',
            data: $('#mainForm').serialize(),
            success: function (response) {
              var error_msg = response.err_msg;
              var temp_value  = $("#man_power_management_data_creation_101").val();
              // error checking
              if(error_msg){
                // remove success message
                if ($(document).find("#successMsg")) {
                    $(document).find("#successMsg").remove();
                }
                if(temp_value == 1){
                  $("#man_power_management_data_creation_105_1").removeClass("error");
                  $("#man_power_management_data_creation_105_2").removeClass("error");
                  manPowerManagementDataCreationValidationFor1(error_msg);
                }

                if(temp_value == 2){
                  $("#man_power_management_data_creation_103_1").removeClass("error");
                  $("#man_power_management_data_creation_103_2").removeClass("error");
                  $("#man_power_management_data_creation_104_1").removeClass("error");
                  $("#man_power_management_data_creation_104_2").removeClass("error");
                  manPowerManagementDataCreationValidationFor2(error_msg);
                }
              }else{ // ./ Ends error msg
                $("#man_power_management_data_creation_103_1").removeClass("error");
                $("#man_power_management_data_creation_103_2").removeClass("error");
                $("#man_power_management_data_creation_104_1").removeClass("error");
                $("#man_power_management_data_creation_104_2").removeClass("error");
                $("#man_power_management_data_creation_105_1").removeClass("error");
                $("#man_power_management_data_creation_105_2").removeClass("error");
                $('#error_data').html('');
                $("#error_data").hide();
                $("#submit_confirmation").val('confirm');

                if(response.status == "confirm"){
                    if(temp_value == 1){
                      var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;"> 処理はまだ完了していません。内容をご確認後、もう１度取引データ作成ボタンを押してください</p>';
                     $(document).find("#confirmation_message").html(confirmationMsg);
                      
                      // remove success message
                      if ($(document).find("#successMsg")) {
                          $(document).find("#successMsg").remove();
                      }
                    }

                    if(temp_value == 2){
                      var confirmationMsg = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 2px;"> 処理はまだ完了していません。内容をご確認後、もう１度取引データ作成ボタンを押してください</p>';
                      $(document).find("#confirmation_message").html(confirmationMsg);
                      
                      // remove success message
                      if ($(document).find("#successMsg")) {
                          $(document).find("#successMsg").remove();
                      }
                    }
                  }else{
                    $(document).find("#confirmation_message").html("");
                    $("#mainForm").submit();
                    $("#submit_confirmation").val('');
                    createSuccessMessage('処理が終了しました');
                   // location.reload();
                  }
              } // ./ Ends error checking

              $(".loading-icon").toggle();

              // downloading option here
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

    function manPowerManagementDataCreationValidationFor1(error_msg){
      var error_flag = 0;
      html = "<div>";
      if(error_msg.man_power_management_data_creation_103_1 == "【入力日付1】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_103_1[0]+'</p>';
        $("#man_power_management_data_creation_103_1").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_103_1").removeClass("error");
      }

      if(error_msg.man_power_management_data_creation_103_2 == "【入力日付2】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_103_2[0]+'</p>';
        $("#man_power_management_data_creation_103_2").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_103_2").removeClass("error");
      }


      if(error_msg.man_power_management_data_creation_104_1 == "【受注番号1】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_104_1[0]+'</p>';
        $("#man_power_management_data_creation_104_1").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_104_1").removeClass("error");
      }

      if(error_msg.man_power_management_data_creation_104_2 == "【受注番号2】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_104_2[0]+'</p>';
        $("#man_power_management_data_creation_104_2").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_104_2").removeClass("error");
      }

      if(error_msg.man_power_management_data_creation_103_1 == "【入力日付1】正しい年月日を入力してください。" || error_msg.man_power_management_data_creation_103_2 == "【入力日付2】正しい年月日を入力してください。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">開始日付の方が大きいです。</p>';
        $("#man_power_management_data_creation_103_1").addClass("error");
        $("#man_power_management_data_creation_103_2").addClass("error");
        error_flag++;
      }


      if(error_msg.man_power_management_data_creation_104_1 == "【受注番号1】正しい年月日を入力してください。" || error_msg.man_power_management_data_creation_104_2 == "【受注番号2】正しい年月日を入力してください。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">開始番号の方が大きいです。</p>';
        $("#man_power_management_data_creation_104_1").addClass("error");
        $("#man_power_management_data_creation_104_2").addClass("error");
        error_flag++;
      }



      html += '</div>';

        if(error_flag == 0){
              $("#man_power_management_data_creation_103_1").removeClass("error");
              $("#man_power_management_data_creation_103_2").removeClass("error");
              $("#man_power_management_data_creation_104_1").removeClass("error");
              $("#man_power_management_data_creation_104_2").removeClass("error");
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

    function manPowerManagementDataCreationValidationFor2(error_msg){
      var error_flag = 0;
      html = "<div>";
      if(error_msg.man_power_management_data_creation_105_1 == "【伝票日付1】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_105_1[0]+'</p>';
        $("#man_power_management_data_creation_105_1").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_105_1").removeClass("error");
      }

      if(error_msg.man_power_management_data_creation_105_2 == "【伝票日付2】必須項目に入力がありません。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">'+error_msg.man_power_management_data_creation_105_2[0]+'</p>';
        $("#man_power_management_data_creation_105_2").addClass("error");
        error_flag++;
      }else{
        $("#man_power_management_data_creation_105_2").removeClass("error");
      }


      if(error_msg.man_power_management_data_creation_105_1 == "【伝票日付1】正しい年月日を入力してください。" || error_msg.man_power_management_data_creation_105_2 == "【伝票日付2】正しい年月日を入力してください。"){
        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">開始日付の方が大きいです。</p>';
        $("#man_power_management_data_creation_105_1").addClass("error");
        $("#man_power_management_data_creation_105_2").addClass("error");
        error_flag++;
      }



      html += '</div>';

        if(error_flag == 0){
              $("#man_power_management_data_creation_105_1").removeClass("error");
              $("#man_power_management_data_creation_105_2").removeClass("error");
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

    // Start
    $('.datePicker1_1').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker1_1'
    });

    $(document).on('change focus', '.datePicker1_1', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker1_1', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_1', function (e) {
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
    $(document).on('blur', '.datePicker1_1', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker1_1").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker1_1").datepicker('hide');
      }
    });
    // End


    // Start
    $('.datePicker1_2').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker1_2', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
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
    $(document).on('blur', '.datePicker1_2', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker1_2").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker1_2").datepicker('hide');
      }
    });
    // End

    // Start
    $('.datePicker2_1').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker2_1'
    });

    $(document).on('change focus', '.datePicker2_1', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker2_1', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker2_1', function (e) {
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
    $(document).on('blur', '.datePicker2_1', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker2_1").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker2_1").datepicker('hide');
      }
    });
    // End


    // Start
    $('.datePicker2_2').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker2_2'
    });

    $(document).on('change focus', '.datePicker2_2', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker2_2', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker2_2', function (e) {
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
    $(document).on('blur', '.datePicker2_2', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker2_2").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker2_2").datepicker('hide');
      }
    });
    // End

  </script>
  <script>
    $(document).ready(function(){
        $(".first-table").hide();
        $("button#searchButton").click(function(){
          $(".first-table").show();
        });
      });
      $(document).ready(function(){
          $(".second-table").hide();
          $(".first-table").click(function(){
           $(".second-table").show();
          });
      });
      $(document).ready(function(){
         $(".third-table").hide();
        $(".second-table").click(function(){
          $(".third-table").show();
        });
      });
  </script>
  <!-- modal search button click insert data on table js end-->

  <script>
    // button click progress toggle......
      // $(document).ready(function(){
      //   $(".progress").hide();
      //   $("#customprogress").click(function(){
      //     $(".progress").toggle();
      //   });
      // });

      // button click Load icon toggle......
      $(document).ready(function(){
        $(".loading-icon").hide();
        $("#dataCreationBtn").click(function(){
          $(".loading-icon").toggle();
        });
      });

      // Check All Table chackbox js start.....
      var state = false; // desecelted    
      $('.check-tblall').click(function() {
        $('.tblCheckBox').each(function() {
          if (!state) {
            this.checked = true;
          }
        });
      });

         //Enter press hide dropdown...
    $(".input_field").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".input_field").datepicker('hide');
      }
    });
  </script>

  <script>
    //Click Navbar Menu Icon to Hide Calendar
    $("#add_icon").click(function () {
    $(".datePicker1_1").datepicker('hide');
    $(".datePicker1_2").datepicker('hide');
    $(".datePicker2_1").datepicker('hide');
    $(".datePicker2_2").datepicker('hide');
  
  });
  </script>
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>
