<script>
  // Knockout
ko.bindingHandlers.nextFieldOnEnter = {
  init: function (element, valueAccessor, allBindingsAccessor) {
    $(element).on('keydown', 'input, textarea, select, button, a.btn', function (e) {
      var self = $(this),
        form = $(element),
        focusable, next;
      if (e.keyCode == 13 && !e.shiftKey) {
        focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn').filter(':visible');
        // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
        var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
        next = focusable.eq(nextIndex);
        next.focus();
        return false;
      }
      if (e.keyCode == 9) {
        e.preventDefault();
      }
    });
  }
};
ko.applyBindings({});
</script>

<script type="text/javascript">
  function openModalDetailProjectReg() {
      $("#project_reg_modal2").modal('show');
    }
</script>

{{-- <script>
  $(".custom-file-input").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
  $(".custom-file-input2").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label2").addClass("selected").html(fileName);
    });
</script> --}}

<script type="text/javascript">
// Date Picker Initialization
$('#from').datepicker({
  language: 'ja-JP',
  format: 'yyyy/mm',
  autoHide: true,
  zIndex: 1,
  offset: 4,
  trigger: '#from'
});

$('#from').on('change focus', function () {
  if ($(this).val().length == 7) {
    $(this).datepicker('update');
    $(this).siblings('.datePickerHidden').val($(this).val());
    let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
    let formatted_date = datevalue.replaceAll('/', '')
    $(this).val(formatted_date);
    $(this).focus(); //focusing current input on select
    $(this).datepicker('hide');
    // if($(this).val().replaceAll('/', '') > $('#to').val().replaceAll('/', '')){
    //   $('#to').val(datevalue);
    //   $('#to').datepicker('setStartDate', $('#from').datepicker('getDate'));
    //   $('#to').datepicker('update');
    //   $('#to').val('');
    // }
    // else{
    //   $('#to').datepicker('setStartDate', $('#from').datepicker('getDate'));
    //   $('#to').datepicker('update');
    // }
  }
});

$('#from').on('keyup', function (e) {
  let inputDateValue = $(this).val();  //getting date value from input
  if (inputDateValue.length == 6) {
    let slicedYear = inputDateValue.slice(0, 4);
    let slicedMonth = inputDateValue.slice(4, 6);
    let formatted_sliced_date = slicedYear + "/" + slicedMonth;
    $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
    $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
    // $('#to').datepicker('setStartDate', $('#from').datepicker('getDate'));
    $(this).datepicker('update');
  }
});
// Update date value with slash on blur
$('#from').on('blur', function () {
  if ($(this).val() != '') {
    $(this).val($(this).siblings('.datePickerHidden').val());
  }
  else if ($(this).val() == '') {
    $(this).val('');
    $(this).siblings('.datePickerHidden').val('');
  }
});

$('#to').datepicker({
  language: 'ja-JP',
  format: 'yyyy/mm',
  autoHide: true,
  zIndex: 1,
  offset: 4,
  trigger: '#to',
  // startDate: $('#from').datepicker('getDate')
});

$('#to').on('change focus', function () {
  if ($(this).val().length == 7) {
    $(this).datepicker('update');
    $(this).siblings('.datePickerHidden').val($(this).val());
    let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
    let formatted_date = datevalue.replaceAll('/', '')
    $(this).val(formatted_date);
    $(this).focus(); //focusing current input on select
    $(this).datepicker('hide');
  }
});

$('#to').on('keyup', function (e) {
  let inputDateValue = $(this).val();  //getting date value from input
  if (inputDateValue.length == 6) {
    let slicedYear = inputDateValue.slice(0, 4);
    let slicedMonth = inputDateValue.slice(4, 6);
    let formatted_sliced_date = slicedYear + "/" + slicedMonth;
    $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
    $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
    $(this).datepicker('update');
  }
});
// Update date value with slash on blur
$('#to').on('blur', function () {
  if ($(this).val() != '') {
    $(this).val($(this).siblings('.datePickerHidden').val());
  }
  else if ($(this).val() == '') {
    $(this).val('');
    $(this).siblings('.datePickerHidden').val('');
  }
});
 
//Enter press hide dropdown...
$("#from").keydown(function (e) {
  if (e.keyCode == 13) {
    $("#from").datepicker('hide');
  }
});
$("#to").keydown(function (e) {
  if (e.keyCode == 13) {
    $("#to").datepicker('hide');
  }
});
</script>

<script>
  $(document).ready(function () {
      $(".customalert, .loading-icon").hide();
      $("#contenthide").click(function () {
        $(".customalert,.loading-icon").toggle();
      });

    });
</script>

<script type="text/javascript">
  $(".alertclose").on("click", function () {
    // $(".popupalert").('show');
    $('.customalert,.loading-icon').hide();
  });
  $(".alertclose2").on("click", function () {
    // $(".popupalert").('show');
    $('.popupalert').hide();
  });
</script>

<script type="text/javascript">
  $("#choice_button").on("click", function () {
    // $(".popupalert").('show');
    // $('.popupalert').addClass('show');
    $('#project_reg_modal2').on('hide.bs.modal', function (e) {
      $('.popupalert').show();
    });
    $('.modal-backdrop').remove();
  });
</script>