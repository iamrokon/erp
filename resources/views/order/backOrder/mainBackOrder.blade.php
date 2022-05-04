@section('title', '月別受注残一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注 > ')
@section('menu-test5', '月別受注残一覧')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.header')
    {{-- Including CSS Starts Here --}}
    @include('order.backOrder.styles')
    {{-- Including CSS Ends Here--}}
    <script type="text/javascript">
      var clickButton =0;
    </script>
</head>

<body class="common-nav" style="overflow-x:visible;">
    <section>
        @include('layout.nav_fixed')
        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
            <!-- ============================= Top Search start here ===================== -->
            @include('order.backOrder.backOrderTopSearch')
            <!-- ============================= Top Search end here ======================= -->

            <!-- ============================= Main Content start here ===================== -->
            @include('order.backOrder.backOrderMainContent')
            <!-- ============================= Main Content end here ======================= -->
            <!-- container-fluid div end -->
        </div>
        {{--@include('order.backOrder.backOrderAtarashiModal')--}}
        @include('common.supplierModal_2')
        <!-- Table Header Settings Modal Starts Here -->
        @include('master.common.table_settings_modal')
        <!-- Table Header Settings Modal Ends Here -->
        {{-- Footer Starts Here --}}
        @include('layout.footer_new')

        @include('layouts.footer')
        {{-- Footer Ends Here --}}

    </section>


    <!-- Change main table on radio select js Start -->
    <script>
        $("#deposit_classi_unit_radio").click(function() {
        $("#payment_history_content_1").show();
        $("#payment_history_content_2").hide();
    });
    $("#order_no_unit_radio").click(function() {
        $("#payment_history_content_2").show();
        $("#payment_history_content_1").hide();
    });
    </script>
    <!-- Change main table on radio select js End -->

    <script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
    </script>

    {{-- Knockout - Enter to New Input Starts Here --}}
    <script>
        ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trfocus', function (e) {
          var self = $(this),
            form = $(element),
            focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trfocus').filter(':visible');
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
    {{-- Knockout - Enter to New Input Ends Here --}}

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
            // $('#to').datepicker('update');
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

    <script type="text/javascript">
        // $(document).find(".datePicker").removeClass('datePicker').removeData('datepicker').unbind().datepicker({
  $(".datePicker").removeData('datepicker').unbind().datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 1,
    offset: 4,
    /*endDate: new Date(),*/
  })

  $('.datePicker').on('change', function () {
    if ($(this).val().length == 10) {
      $(this).css("color", "#3333ff");
      $(this).focus(); //focusing current input on select
    }
  });

  $('.datePicker').on('focus', function () {
    if ($(this).val().length == 10) {
      $(this).datepicker('update');
      // $(this).css("color", "#3333ff");
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '')
      $(this).val(formatted_date);
      // $(this).focus(); //focusing current input on select
      $(this).datepicker('hide');
    }
  });

  $('.datePicker').on('click', function () {
    // $(this).css("color", "gray");
    $(this).datepicker('show');
  });

  $('.datePicker').on('keyup', function (e) {
    let inputDateValue = $(this).val();  //getting date value from input
    if (inputDateValue.length == 8) {
      $(this).css("color", "#3333ff");
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
  $('.datePicker').on('blur', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    }
    else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  //Enter press hide dropdown
  $(".datePicker").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker").datepicker('hide');
    }
  });
    </script>
  <script>
    $("#add_icon").click(function () {
      $(".datepicker").datepicker('hide');
      $("#to").datepicker('hide');
      $("#from").datepicker('hide');
    });
  </script>

     <!-- Hard reload js link -->
     {{-- <script src="{{ asset('js/order/backOrder/backOrder.js?v=5003') }}"></script> --}}
     <script type="text/javascript">
      var filebackorder = document.createElement("script");
      filebackorder.type = "text/javascript";
      filebackorder.src = "{{ asset('js/order/backOrder/backOrder.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filebackorder);
    </script>
    <!-- Hard reload js link end -->
    
    <script>
        $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSettingBackOrder('{{route('backOrderTableSetting',$bango)}}')");
        var key_type= {{isset($fsReqData['rd2'])?$fsReqData['rd2']:1}}
        $('#tableSetting').append('<input type="hidden" name="key_type" value="'+key_type+'">')
    });
    </script>

@if(isset($arr_err) && $arr_err=='update')
 <script type="text/javascript">
   clickButton++
 </script>
@endif
</body>

</html>
