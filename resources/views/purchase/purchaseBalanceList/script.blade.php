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

{{-- Chech/Uncheck Scripts Starts Here --}}
<script type="text/javascript">
  var state = false; // desecelted
  $('.checkall').click(function() {
  $('.customCheckBox').each(function() {
    if (!state) {
      this.checked = true;
      }
    });
  });
  //Unchecked....
  $('.uncheck').click(function() {
    $('.customCheckBox').each(function() {
      if (!state) {
        this.checked = false;
        $("input[type='tel']").val("");
      }
    });
  });
</script>
{{-- Chech/Uncheck Scripts Ends Here --}}


<script type="text/javascript">
  $(document).ready(function(){
    $("#closetopcontent").click(function(){
      $(".order_entry_topcontent").toggle();
    });
  });
 function contentHideShow() {
  var hideShow = document.getElementById("closetopcontent");
  if (hideShow.innerHTML === "閉じる") {
    hideShow.innerHTML = "開く";
  } else {
    hideShow.innerHTML = "閉じる";
  }
}
</script>

<script type="text/javascript">
$("#modalarea").on('click', function(){
  $(".modal-backdrop").addClass("overflow_cls");
});

$("#modalarea").on("click", function(){
$('.modal-backdrop').remove();
$('#modalarea').on('show.bs.modal', function (e) {
$('body').addClass('overflow_cls');

})
$('#modalarea').on('hide.bs.modal', function (e) {
$('body').removeClass('overflow_cls');
})
$("#modalarea").modal("hide");
});
</script>

{{-- Calendar Initialization Starts Here --}}
<script type="text/javascript">
  // Date Picker Initialization

  // 処理日
  // Start
  // Start
  $('.datePicker1_1').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm',
    autoHide: true,
    zIndex: 10,
    offset: 6,
    trigger: '.datePicker1_1'
  });

  $(document).on('change focus', '.datePicker1_1', function () {
    if ($(this).val().length == 7) {
      $(this).datepicker('update');
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      $(this).focus(); //focusing current input on select
      $(this).datepicker('hide');
    }
  });

  $(document).on('click', '.datePicker1_1', function () {
    if ($(this).val().length == 0) {
      $(this).datepicker('show');
    }
    else if ($(this).val().length <= 5 ) {
      $(this).datepicker('hide');
    }
  });

  $(document).on('keyup', '.datePicker1_1', function (e) {
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
{{-- Calendar Initialization End Here --}}

<script>
  //Click Navbar Menu Icon to Hide Calendar
  $("#add_icon").click(function () {
  $(".datePicker1_1").datepicker('hide');
  $(".datePicker1_2").datepicker('hide');
  $(".datePicker2_1").datepicker('hide');
  $(".datePicker2_2").datepicker('hide');
});
</script>