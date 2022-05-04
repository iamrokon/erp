@section('title', '受注履歴一覧・受注照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注 >')
@section('menu-test5', '受注履歴一覧・受注照会')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">--}}
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Including CSS Starts Here --}}
  @include('order.orderHistory.styles')
  {{-- Including CSS Ends Here--}}
</head>



<body class="common-nav" style="overflow-x:visible;">
  {{-- <section> --}}

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

  <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

    @php
    if(isset($orderHistoryInfo)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $orderHistoryInfo->currentPage();
        $per_page = $orderHistoryInfo->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($orderHistoryInfo->items());
        $total = $orderHistoryInfo->total();
        $lastPage = $orderHistoryInfo->lastPage() ;
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
    @endphp

    <!-- ============================= Top Search start here ===================== -->
    @include('order.orderHistory.orderHistoryTopSearch')
    <!-- ============================= Top Search end here ======================= -->

    <!-- ============================= Main Content start here ===================== -->
    @include('order.orderHistory.orderHistoryMainContent')
    <!-- ============================= Main Content end here ======================= -->

  </div>

  <!-- Supplier Modal start here -->
  @include('common.supplierModal')
  <!-- Supplier Modal end here -->

  <!-- Number Search Modal start here -->
  @include('order.order-entry.include.number_search.main')
  <!-- Number Search Modal end here -->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  {{-- Navbar Starts Here --}}
  @include('layout.footer_new')
  {{-- Navbar Ends Here --}}

  {{-- </section> --}}


  <!--  goto order inquiry page -->
  <form action="{{route('orderInquiry')}}" method="POST" target="_blank" id="goToOrderInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango" />
    <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" />
  </form>
  <!--  goto order inquiry page -->

  <!--  goto order entry page -->
  <form action="{{route('orderEntry')}}" method="POST" target="_blank" id="goToOrderEntry" >
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
  </form>
  <!--  goto order entry page -->

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->
  <script src="{{ asset('js/underscore.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('orderHistoryTableSetting',$bango)}}')");
    });
  </script>

  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
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
                    return false;
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
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
        // $(element).on('keydown', 'input, textarea, select, button, a.btn, .btn, tr.trFocus', function (e) {
            $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trfocus', function (e) {
          var self = $(this),
            form = $(element),
            focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            // focusable = form.find('input:not([ignore]), select, textarea, button, a.btn, .btn, tr.trFocus').filter(':visible');
            focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trfocus').filter(':visible');
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
    {{-- Knockout - Enter to New Input Ends Here --}}
  <!-- shift+enter click tbale row selected -->
  
        <!-- shift+enter click tbale row selected -->


  {{-- Table Header Settings - Check/Uncheck All Checkbox Starts Here --}}
  {{-- @include('master.common.check_uncheck_all') --}}
  {{-- Table Header Settings - Check/Uncheck All Checkbox Ends Here --}}

  {{-- Button Hover Message Starts Here --}}
  {{-- @include('master.common.hover_message') --}}
  {{-- Button Hover Message Ends Here --}}

  {{-- Table Column Selection Starts Here --}}
  @include('master.common.table_column_selection')
  {{-- Table Column Selection Ends Here --}}

  <script>
    $(document).on('shown.bs.modal', function (e) {
      $('[autofocus]', e.target).focus();
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#closetopcontent").click(function () {
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
    $("#modalarea").on('click', function () {
      $(".modal-backdrop").addClass("overflow_cls");
      // $('.modal-backdrop').remove();
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
  <script>
    $(document).ready(function(){
      // Datepicker 1 start heare....
      $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker1_oen', function () {
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

    $(document).on('click', '#datepicker1_oen', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker1_oen', function (e) {
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
    $(document).on('blur', '#datepicker1_oen', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 1 end heare....

    // Datepicker 2 start heare....
    $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker2_oen', function () {
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

    $(document).on('click', '#datepicker2_oen', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker2_oen', function (e) {
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
    $(document).on('blur', '#datepicker2_oen', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 2 end heare....
    });
  </script>

  <!-- chalender js -->
  <script type="text/javascript">
    //Enter press hide dropdown...
    $(".input_field").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".input_field").datepicker('hide');
      }
    });
  </script>

  <script>
      //Click to hide calendar
    $("#add_icon").click(function () {
      $("#datepicker1_oen").datepicker('hide');
      $("#datepicker2_oen").datepicker('hide');
    });
  </script>
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/order/order_history/orderHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
  <script type="text/javascript">
    var filenumsearch = document.createElement("script");
      filenumsearch.type = "text/javascript";
     filenumsearch.src = "{{ asset('js/order/order_entry/number_search.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filenumsearch);
  </script>
  <!-- Hard reload js link end -->
  
  <script>
    // Disable opening new browser window when Shift+Enter is pressed and logging in in the same tab.
    $("a").keydown(function(e){
      if (e.shiftKey && e.which == 13) {
        e.preventDefault(); // stop opening new window
      }
      if (e.shiftKey && e.ctrlKey && e.which == 13) {
        $(this).click();
      }
    });
</script>

</body>

</html>
