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
    // $('.modal-backdrop').remove();
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
<!-- chalender js -->
<script type="text/javascript">
// Date Picker Initialization

// 入力日
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
  // $(this).datepicker('hide');
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


// 仕入日
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
</script>
<script>
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });
</script>
<script>
//Click to hide calendar
$("#add_icon").click(function () {
$(".datePicker1_1").datepicker('hide');
$(".datePicker1_2").datepicker('hide');
$(".datePicker2_1").datepicker('hide');
$(".datePicker2_2").datepicker('hide');
});
</script>