<!-- <script type="text/javascript">
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
</script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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

      // if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
      //   $('#datepicker2_oen').val(datevalue);
      //   $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
      //   // $('#datepicker2_oen').datepicker('update');
      //   // $('#datepicker2_oen').val('');
      // }
      // else{
      //   $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
      //   // $('#datepicker2_oen').datepicker('update');
      // }
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
      // $('#datepicker2_oen').datepicker('update');
      $(this).datepicker('show');
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
    // startDate: $('#datepicker1_oen').datepicker('getDate')
    // startDate: new Date().setDate(-90),
    // endDate: new Date().setDate(+90)
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

  // Set start date and end date......start
  $(document).on('click', '#datepicker2_oen', function() {
      $(this).datepicker('show');
      let getDateValue = new Date();
      let yearValue = getDateValue.getFullYear();
      let monthValue = getDateValue.getMonth() + 1;
      let dateValue = getDateValue.getDate() -90;
      $(this).datepicker('setStartDate', new Date(yearValue, monthValue - 1, dateValue));
  });

  $(document).on('click', '#datepicker2_oen', function() {
      $(this).datepicker('show');
      let getDateValue = new Date();
      let yearValue = getDateValue.getFullYear();
      let monthValue = getDateValue.getMonth() + 1;
      let dateValue = getDateValue.getDate() +90;
      $(this).datepicker('setEndDate', new Date(yearValue, monthValue - 1, dateValue));
  });
  // Set start date and end date......end

  $('#datepicker2_oen').on('keyup', function (e) {
   
    $("#error_data").hide();
    let inputDateValue = $(this).val();  //getting date value from input

    let someDate = new Date();  //date validation message code start...
    let numberOfDaysToAdd = 90;
    let sumResult = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);

    let getDateValue  = new Date(sumResult);
    let yearValue     = getDateValue.getFullYear();
    let monthValue    = ("0" + (getDateValue.getMonth() + 1)).slice(-2);
    let dateValue     = getDateValue.getDate();
    let moreDateValue = yearValue +""+ monthValue +""+ dateValue;

    let oddSomeDate = new Date();
    let oddNumberOfDaysToAdd = 90;
    let oddResult = oddSomeDate.setDate(oddSomeDate.getDate() - oddNumberOfDaysToAdd);

    let getOddDateValue = new Date(oddResult);
    let yearOddValue    = getOddDateValue.getFullYear();
    let monthOddValue   = ("0" + (getOddDateValue.getMonth() + 1)).slice(-2);
    let dateOddValue    = getOddDateValue.getDate();
    let lessDateValue   = yearOddValue +""+ monthOddValue +""+ dateOddValue;
    //date validation message code end...

    if (inputDateValue.length == 8) {
      let slicedYear = inputDateValue.slice(0, 4);
      let slicedMonth = inputDateValue.slice(4, 6);
      let slicedDay = inputDateValue.slice(6, 8);
      let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
      $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
      $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));

      var errorHtml = '<p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">【会計伝票日】誤った範囲が指定されています。正しい範囲を入力してください。</p>';
      if(moreDateValue < inputDateValue){
        $('#error_data').html(errorHtml);
        $("#error_data").show();
      }
      if(lessDateValue > inputDateValue){
        $('#error_data').html(errorHtml);
        $("#error_data").show();
      }
    }
    $(this).datepicker('show');
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

<script type="text/javascript">
  // Start
  $('.datePicker1_1').datepicker({
       language: 'ja-JP',
       format: 'yyyy/mm/dd',
       autoHide: true,
       zIndex: 2048,
       offset: 4,
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
 
     // $(document).on('click', '.datePicker1_1', function () {
     //   if ($(this).val().length == 0) {
     //     $(this).datepicker('show');
     //   }
     //   else if ($(this).val().length <= 7 ) {
     //     $(this).datepicker('hide');
     //   }
     // });
 
     $(document).on('keyup', '.datePicker1_1', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
       if (inputDateValue.length == 8) {
         let slicedYear = inputDateValue.slice(0, 4);
         let slicedMonth = inputDateValue.slice(4, 6);
         let slicedDay = inputDateValue.slice(6, 8);
         let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
         $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
         $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));

          if ( $('.datePicker1_1').find(':input').not(':input[readonly]') ) {
            $(this).datepicker('show');
          }else{
            $(this).datepicker('hide');
          }
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
    $(".datePicker1_1").datepicker('hide');
  });


  //input maxlength validation...
  $(document).on('keyup','.payment_amount',function(){
    const value = $(this).val();
    if (value.charAt(0) === '-') {
      $(this).attr('maxlength', 10);
    } else {
      $(this).attr('maxlength', 9);
    }
  });
</script>