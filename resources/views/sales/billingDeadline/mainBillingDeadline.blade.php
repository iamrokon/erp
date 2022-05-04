@section('title', '請求締日処理')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '請求締日処理')
@section('tag-test', 'ここにはガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>
  @include('layouts.header')
  @include('sales.billingDeadline.styles')
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
</head>

<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    @include('layout.nav_fixed')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section">
        @include('sales.billingDeadline.billingDeadlineTopSearch')
      </div>
    </div>
  </section>
  @include('common.supplierModal_2')
  {{-- Footer Starts Here --}}
  @include('layout.footer_new')

  @include('layouts.footer')

  {{-- Footer Ends Here --}}
  <script type="text/javascript">
    $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 6,
        trigger: '#datepicker2_oen'
    });
    $(".input_field").keydown(function (e) {
        if (e.keyCode == 13) {
          $(".input_field").datepicker('hide');
        }
    });
    $('#datepicker2_oen').on('change focus', function () {
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

    // $('#datepicker2_oen').on('click', function () {
    //     $(this).datepicker('show');
    // });
    $('#datepicker2_oen').on('keyup', function (e) {
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
    $('#datepicker2_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });



  </script>
  <script>
    $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 6,
        trigger: '#datepicker1_oen'
    });
    $(".input_field").keydown(function (e) {
        if (e.keyCode == 13) {
        $(".input_field").datepicker('hide');
        }
    });
    $('#datepicker1_oen').on('change focus', function () {
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

    // $('#datepicker1_oen').on('click', function () {
    //     $(this).datepicker('show');
    // });
    $('#datepicker1_oen').on('keyup', function (e) {
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
    $('#datepicker1_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
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

  <script>
    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
    });

  </script>
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, a.btn, a.checkall, tr.trfocus', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, a.checkall, tr.trfocus').filter(':visible');
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
    $("#datepicker2_oen").datepicker('hide');
    $("#1st_date").datepicker('hide');
  });
</script>
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var billingDeadlineLink = document.createElement("script");
      billingDeadlineLink.type = "text/javascript";
      billingDeadlineLink.src = "{{ asset('js/sales/billingDeadline/billingDeadline.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(billingDeadlineLink);
  </script>
  <!-- Hard reload js link ends here -->
  <script>
    // click button progress toggle......
    //$(document).ready(function(){
    //  $(".progress").hide();
    //  $("#customprogress").click(function(){
    //    $(".progress").toggle();
    //  });
    //});
  </script>
  <script type="text/javascript" src="{{asset('js/date-de-DE.js')}}"></script>

</body>

</html>