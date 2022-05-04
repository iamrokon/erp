<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
  // Knockout
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input:not([ignore]), select:not([ignore]), textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
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
</script> -->

<script type="text/javascript">
  // Date Picker Initialization
    $('.datepicker1').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '.datepicker1'
    });

    $('.datepicker1').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('.datepicker2').val().replaceAll('/', '')){
          $('.datepicker2').val(datevalue);
          $('.datepicker2').datepicker('setStartDate', $('.datepicker1').datepicker('getDate'));
          $('.datepicker2').datepicker('update');
          $('.datepicker2').val('');
        }
        else{
          $('.datepicker2').datepicker('setStartDate', $('.datepicker1').datepicker('getDate'));
          $('.datepicker2').datepicker('update');
        }
      }
    });

    $('.datepicker1').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('.datepicker2').datepicker('setStartDate', $('.datepicker1').datepicker('getDate'));
        $('.datepicker2').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('.datepicker1').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
    // Enter hide
    $(".datepicker1").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datepicker1").datepicker('hide');
      }
    });
</script>

<script type="text/javascript">
  $('.datepicker2').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '.datepicker2',
      startDate: $('.datepicker1').datepicker('getDate')
    });

    $('.datepicker2').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('.datepicker2').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });

    // Update date value with slash on blur
    $('.datepicker2').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $(".datepicker2").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datepicker2").datepicker('hide');
      }
    });

    $('#datepicker3').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '#datepicker3'
      });

      $(document).on('change focus', '#datepicker3', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
    });

    $(document).on('click', '#datepicker3', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker3', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $(this).datepicker('update');
        }
    });
    // Update date value with slash on blur
    $(document).on('blur', '#datepicker3', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val('');
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

<script>
  //Click to hide calendar
    $("#add_icon").click(function () {
      $(".datepicker1").datepicker('hide');
      $(".datepicker2").datepicker('hide');
      $(".datepicker3").datepicker('hide');
    });
</script>