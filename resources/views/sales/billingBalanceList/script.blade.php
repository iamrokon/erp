  <!-- modal search button click insert data on table -->

  <!-- Date Picker -->
      <script type="text/javascript">
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
    </script>


  <!-- modal search button click insert data on table js end-->

  <script>
    // button click progress toggle......
      $(document).ready(function(){
        $(".progress").hide();
        $("#customprogress").click(function(){
          $(".progress").toggle();
        });
      });

      // button click Load icon toggle......
      $(document).ready(function(){
        $(".loading-icon").hide();
        $("#loading-icon").click(function(){
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
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>
<script>
  //Click Navbar Menu Icon to Hide Calendar
  $("#add_icon").click(function () {
  $(".datePicker1_1").datepicker('hide');

});
</script>