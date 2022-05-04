@section('title', '請求書発行 締日')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '請求書発行 締日')
 <!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="msapplication-tap-highlight" content="no">
{{--<link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png"> --}}
<link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_navbar_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_new_styles.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
    {{-- @include('layouts.header') --}}
    {{-- Including CSS Starts Here --}}
    @include('sales.invoiceDeadline.styles')
    {{-- Including CSS Ends Here--}}
</head>

<body class="common-nav" style="overflow-x:visible;">
    
    <!-- preloader start here -->
    <div class="preloader">
      <div class="loading" style="display: none"></div>
    </div>
    <!-- preloader end here -->
    
<section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1 position-relative" data-bind="nextFieldOnEnter:true">
        <!-- Content head section start -->
    @include('sales.invoiceDeadline.invoiceDeadlineTopSearch')
        <!-- Content head section end -->
        <!-- Content bottom section start -->
    @include('sales.invoiceDeadline.invoiceDeadlineMainContent')
        <!-- Content bottom section end -->
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}

</section>

<!-- Start search modal -->
@include('common.supplierModal_2')
<!-- end search modal -->

<!-- Table Header Settings Modal Starts Here -->
@include('master.common.table_settings_modal')
<!-- Table Header Settings Modal Ends Here -->

<!-- Including Common Footer Links Starts Here -->
@include('layouts.footer')
<!-- Including Common Footer Links Ends Here -->

<!-- Modal open add class -->
<script type="text/javascript">
    $("#modalarea").on('click', function () {
        $(".modal-backdrop").addClass("overflow_cls");
    });
    $("#modalarea").on("click", function () {
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
<!-- Modal open add class end -->
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
            });
        }
    };
    ko.applyBindings({});

  </script>
<script>
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
  </script>  

<script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });


</script>
<script type="text/javascript">
    // Date Picker Initialization

    // 出荷日
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
            $(this).datepicker('update');
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


    // 納品日
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
    //Click to hide calendar
    $("#add_icon").click(function () {
      $(".datePicker1_1").datepicker('hide');
      $("#datepicker1_oen").datepicker('hide');
    });
  </script>
<script>
    // click button progress toggle......
    $(document).ready(function(){
        $(".progress").hide();
        $("#customprogress").click(function(){
           // $(".progress").toggle();
        });
    });
</script>
<script>
     // click button load icon toggle......
     $(document).ready(function(){
        $(".loading-icon").hide();
        $(".progress").hide();
        $(".loadingProgress").click(function(){
          $(".loading-icon,.progress").toggle();

        });
      });
    // click button load icon toggle......
    $(document).ready(function(){
        $(".loading-icon").hide();
        $("#loading-icon").click(function(){
            //$(".loading-icon").toggle();
        });
    });

    // Check All Table chackbox js start.....
    /*var state = false; // desecelted
    $('.check-tblall').click(function() {
        $('.tblCheckBox').each(function() {
            if (!state) {
                this.checked = true;
            }
        });
    });*/
    // Check All Table chackbox js start.....
    var state = false; // desecelted
    $('.check-tblall').click(function() {
        $('.tblCheckBox').each(function() {
            if (!state) {
                this.checked = true;
            }
            $('.check-tblall').hide();
            $('.uncheck-tblall').show();
        });
    });
    $('.uncheck-tblall').click(function() {
        $('.tblCheckBox').each(function() {
            if (!state) {
                this.checked = false;
            }
        });
        $('.uncheck-tblall').hide();
        $('.check-tblall').show();
    });
</script>

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var invoiceDeadlineLink = document.createElement("script");
    invoiceDeadlineLink.type = "text/javascript";
    invoiceDeadlineLink.src = "{{ asset('js/sales/invoiceDeadline/invoiceDeadline.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(invoiceDeadlineLink);
</script>
<!-- Hard reload js link ends here -->

<script>
    $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('invoiceDeadlineTableSetting',$bango)}}')");
    });
</script>
<script>
    $(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
    });
</script>


</body>
</html>
