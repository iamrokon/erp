@section('title', '売上履歴一覧・売上照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '売上履歴一覧・売上照会')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">
<head>
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Including CSS Starts Here --}}
  @include('sales.salesHistory.styles')
  {{-- Including CSS Ends Here--}}

  <style media="screen">
    .display_none{
      display: none;
    }
  </style>
</head>

<body class="common-nav" style="overflow-x:visible;">
      {{-- <section> --}}

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}
  <section>
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    @php
      $skip = 0;
      $old = array();
      if(session()->has('oldInput'.$bango)){
        $old = session()->get('oldInput'.$bango);
      }
      $current_page = $salesHistoryInfo->currentPage();
      $per_page = $salesHistoryInfo->perPage();
      $first_data = ($current_page - 1)*$per_page+1;
      $last_data = ($current_page - 1)*$per_page+ sizeof($salesHistoryInfo->items());
      $total = $salesHistoryInfo->total();
      $lastPage = $salesHistoryInfo->lastPage() ;
    @endphp
     <!-- ============================= Top Search start here ===================== -->
    @include('sales.salesHistory.salesHistoryTopSearch')
    <!-- ============================= Top Search end here ======================= -->

      <!-- ============================= Main Content start here ===================== -->
      @include('sales.salesHistory.salesHistoryMainContent')
      <!-- ============================= Main Content end here ======================= -->

    </div>

    <!-- Supplier Modal start here -->
    @include('common.supplierModal_2')
    <!-- Supplier Modal end here -->

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->

  @include('layout.footer_new')
  <form action="{{route('orderInquiry')}}" method="POST" target="_blank" id="goToOrderInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango" />
    <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" />
    <input type="hidden" name="req_type" id="req_type" value="sales_data" />
  </form>
  <form action="{{route('salesInquiry')}}" method="POST" target="_blank" id="goToSalesInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="s_kokyakuorderbango" id="s_kokyakuorderbango" />
    <input type="hidden" name="s_ordertypebango2" id="s_inquiry_ordertypebango2" />
  </form>
  </section>

  {{-- </div> --}}
  <!-- end search modal -->

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->
    
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var salesHistoryLink = document.createElement("script");
    salesHistoryLink.type = "text/javascript";
    salesHistoryLink.src = "{{ asset('js/sales/sales_history/salesHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(salesHistoryLink);
  </script>
  <!-- Hard reload js link ends here -->

<script>
  $(document).on('shown.bs.modal', function(e) {
     $('[autofocus]', e.target).focus();
  });
</script>
<script>
      $('.largeTable').on('scroll', function() {
        $(".date-hide-td").datepicker('hide');
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
<!-- hide show table content -->
{{-- <script>
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
</script> --}}
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
<!-- <script type="text/javascript">
   $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
      $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
      $('#datepicker3_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
      $('#datepicker4_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
       //Enter press hide dropdown...
      $(".input_field").keydown(function(e){
        if(e.keyCode == 13) {
          $(".input_field").datepicker('hide');
        }
      });
</script> -->
<!-- show hide table content -->
<!-- <script type="text/javascript">
  $(function () {
    $('#searchButton').click(function (event) {
      $("#initial_content").show();
    });
  });

</script> -->
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
                    // next.find('.trfocus').addClass('rowSelect').focus();
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
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
  });

</script>

<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#date_start").datepicker('hide');
    $("#date_end").datepicker('hide');
    $("#intorder03_start").datepicker('hide');
    $("#intorder03_end").datepicker('hide');
  });
</script>
  <script>
    $(document).ready(function(){
      // Datepicker 1 start heare....
      $('#date_end').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#date_end', function () {
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

    $(document).on('click', '#date_end', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#date_end', function (e) {
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
    $(document).on('blur', '#date_end', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 1 end heare....

    // Datepicker 2 start heare....
    $('#date_start').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#date_start', function () {
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

    $(document).on('click', '#date_start', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#date_start', function (e) {
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
    $(document).on('blur', '#date_start', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 2 end heare....
    });

    $(document).ready(function(){
      // Datepicker 3 start heare....
      $('#intorder03_end').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#intorder03_end', function () {
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

    $(document).on('click', '#intorder03_end', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#intorder03_end', function (e) {
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
    $(document).on('blur', '#intorder03_end', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 3 end heare....

    // Datepicker 4 start heare....
    $('#intorder03_start').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#intorder03_start', function () {
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

    $(document).on('click', '#intorder03_start', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#intorder03_start', function (e) {
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
    $(document).on('blur', '#intorder03_start', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 4 end heare....
    });

    // Table Datepicker start heare....
    $(document).ready(function(){
      $('#table_date').datepicker({
          language: 'ja-JP',
          format: 'yyyy/mm/dd',
          autoHide: true,
          zIndex: 10,
          offset: 6,
        });

        $(document).on('change focus', '#table_date', function () {
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

      $(document).on('click', '#table_date', function () {
          $(this).datepicker('show');
      });

      $(document).on('keyup', '#table_date', function (e) {
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
      $(document).on('blur', '#table_date', function () {
          if ($(this).val() != '') {
              $(this).val($(this).siblings('.datePickerHidden').val());
          } else if ($(this).val() == '') {
              $(this).val('');
              $(this).siblings('.datePickerHidden').val('');
          }
      });
      // Table Datepicker end heare....
    });


    $(".input_field").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".input_field").datepicker('hide');
      }
    });
  </script>

    <script>
      $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('salesHistoryTableSetting',$bango)}}')");
      });
    </script>
</body>

</html>
