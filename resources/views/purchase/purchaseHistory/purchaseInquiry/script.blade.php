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
<script type="text/javascript">
  $('#datepicker2_oen').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 2048,
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
  
  $("#datepicker2_oen").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#datepicker2_oen").datepicker('hide');
    }
  });
</script>

<!-- script for take only 60 characters in textarea field -->
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
  $("#datepicker2_oen").datepicker('hide');
});
</script>