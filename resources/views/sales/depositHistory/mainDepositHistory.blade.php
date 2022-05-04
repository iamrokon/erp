@section('title', '入金履歴一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求>')
@section('menu-test5', '入金履歴一覧')
@section('tag-test', 'ここには、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Including CSS Starts Here --}}
  @include('sales.depositHistory.styles')
  {{-- Including CSS Ends Here--}}

</head>



<body class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}

    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      @php
      $skip = 0;
      $old = array();
      if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
      }
      $current_page = $depositHistoryInfo->currentPage();
      $per_page = $depositHistoryInfo->perPage();
      $first_data = ($current_page - 1)*$per_page+1;
      $last_data = ($current_page - 1)*$per_page+ sizeof($depositHistoryInfo->items());
      $total = $depositHistoryInfo->total();
      $lastPage = $depositHistoryInfo->lastPage() ;
      @endphp

      <!-- ============================= Top Search start here ===================== -->
      @include('sales.depositHistory.depositHistoryTopSearch')
      <!-- ============================= Top Search end here ======================= -->

      <!-- ============================= Main Content start here ===================== -->
      @include('sales.depositHistory.depositHistoryMainContent')
      <!-- ============================= Main Content end here ======================= -->

    </div>

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->

    @include('layout.footer_new')
  </section>

  @include('common.supplierModal_2')

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var depositHistoryLink = document.createElement("script");
    depositHistoryLink.type = "text/javascript";
    depositHistoryLink.src = "{{ asset('js/sales/deposit_history/depositHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositHistoryLink);
  </script>
  <script type="text/javascript">
    var supplierLink = document.createElement("script");
    supplierLink.type = "text/javascript";
    supplierLink.src = "{{ asset('js/sales/deposit_history/supplier.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(supplierLink);
  </script>
  <!-- Hard reload js link ends here -->

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
    $(document).on('shown.bs.modal', function(e) {
     $('[autofocus]', e.target).focus();
  });
  </script>
  <script type="text/javascript">
    // #SI - modified date function starts here
$(function () {
    // å—æ³¨æ—¥
    // /******************* Common Date Picker *******************/ //
    $('.datePicker').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 6,
        trigger: 'datePicker'
    });

    $(document).on('change focus', '.datePicker', function () {
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

    $(document).on('click', '.datePicker', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '.datePicker', function (e) {
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
    $(document).on('blur', '.datePicker', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    $(".datePicker").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker").datepicker('hide');
        }
    });
});
  </script>

<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#torikomidate_start").datepicker('hide');
    $("#torikomidate_end").datepicker('hide');
    $("#nyukinbi2_start").datepicker('hide');
    $("#nyukinbi2_end").datepicker('hide');
  });
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


  <script>
    $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('depositHistoryTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>