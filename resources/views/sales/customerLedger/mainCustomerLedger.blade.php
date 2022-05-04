@section('title', '得意先元帳（社内）')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', '得意先元帳（社内）')

<!DOCTYPE html>
<html lang="ja">

<head>

    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}

    {{-- Including CSS Starts Here --}}
    @include('sales.customerLedger.styles')
    {{-- Including CSS Ends Here--}}

</head>

<body class="common-nav" style="overflow-x: visible;">

    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}

    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <!-- ============================= Top Search start here ===================== -->
        @include('sales.customerLedger.customerLedgerTopSearch')
        <!-- ============================= Top Search end here ======================= -->

        <!-- ============================= Main Content start here ===================== -->
        @include('sales.customerLedger.customerLedgerMain')
        <!-- ============================= Main Content end here ======================= -->

    </div>

    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}

    <!-- Start search modal -->
    @include('common.supplierModal_2')
    <!-- end search modal -->

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->

    <!-- <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"> -->
    <!-- Including Common Footer Links Starts Here -->
    @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->

    {{-- Knockout - Enter to New Input Starts Here --}}
    {{-- @include('master.common.knockout') --}}
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
    
    <script>
    // Enter key press auto focus next input......
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                    // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.find('.trfocus').addClass('rowSelect').focus();
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
                if (e.keyCode == 13 && e.shiftKey) {
                    var rowSelect2 = $('.rowSelect');
                    $(this).trigger('click');
                }
            });
        }
    };
    ko.applyBindings({});
    </script>
    {{-- <script>
        ko.bindingHandlers.nextFieldOnEnter = {
         init: function(element, valueAccessor, allBindingsAccessor) {
             $(element).on('keydown', '.trfocus', function(e) {
                 var self = $(this),
                     form = $(element),
                     focusable, next;
  
                 if (e.keyCode == 13 && !e.shiftKey) {
                     focusable = form.find('.trfocus').filter(':visible');
                     var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                     next = focusable.eq(nextIndex);
                     next.find('.trfocus').addClass('rowSelect').focus();
                     // $(this).click();
                     return false;
                 }
                 if (e.keyCode == 13 && e.shiftKey) {
                     // alert('hello');
                     var rowSelect2 = $('.rowSelect');
                     $(this).trigger('click');
  
                 }
             });
         }
     };
     ko.applyBindings({});
    </script> --}}
    {{-- Knockout - Enter to New Input Ends Here --}}
    
    <!-- Date Picker -->
    <script type="text/javascript">
    // 年月 - Start
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
            $(this).focus();
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


    // 年月 - End
    $('.datePicker1_2').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function () {
        if ($(this).val().length == 7) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val(); //getting date value from calendar
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
        else if ($(this).val().length <= 5 ) {
            $(this).datepicker('hide');
        }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
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
    </script>
    <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $(".datePicker1_1 ").datepicker('hide');
      $(".datePicker1_2").datepicker('hide');
    });
    </script>
    <script>
    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
        $('[autofocus]', e.target).focus();
    });
    </script>

    <!-- Hard reload js link starts here -->
    <script type="text/javascript">
        var customerLedgerLink = document.createElement("script");
        customerLedgerLink.type = "text/javascript";
        customerLedgerLink.src = "{{ asset('js/sales/customerLedger/customerLedger.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(customerLedgerLink);
    </script>
    <!-- Hard reload js link ends here -->

    <script>
    $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('customerLedgerTableSetting',$bango)}}')");
    });
    </script>

</body>

</html>