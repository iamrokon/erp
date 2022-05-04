<script type="text/javascript">
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
      $("#contenthide").click(function(){
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
  {{-- <script type="text/javascript">
    jQuery(function($){
      var e = function() {
          var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
          (e -= 224) < 1 && (e = 1), e > 219 && jQuery(".fullpage_width1").css("min-height", e + "px")
      };
      jQuery(window).ready(e), jQuery(window).on("resize", e);
  });
  </script> --}}
   <!--  footer content end // windows height resize call-->