<script type="text/javascript">
  // Date Picker Initialization
$('#datepicker1_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
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
  // Enter hide
  $("#datepicker1_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#datepicker1_oen").datepicker('hide');
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
  //file upload show name....
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
<script>
  // Knockout
  ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
              var self = $(this),
                  form = $(element),
                  focusable, next;
              if (e.keyCode == 13 && !e.shiftKey) {
                  focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                  // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                  var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                  next = focusable.eq(nextIndex);
                  next.focus();
                  return false;
              }
              if (e.keyCode == 9) {
                  e.preventDefault();
              }

              // Shift+Enter to select table row
              if (e.keyCode == 13 && e.shiftKey) {
                var rowSelect2 = $('.rowSelect');
                $(this).trigger('click');
              }
          });
      }
  };
  ko.applyBindings({});

</script>
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
  $("#datepicker1_oen").datepicker('hide');
});
</script>
<script>
  $("#productQuantity").keypress(function(event) {
  if ( event.which == 45 ) {
      event.preventDefault();
   }
});
$("#productUnitPrice").keypress(function(event) {
  if ( event.which == 45 ) {
      event.preventDefault();
   }
 
});
$('#productUnitPrice').keypress(function(event){ 
   if (this.value.length == 0 && event.which == 48){
      return false;
   }
});

</script>