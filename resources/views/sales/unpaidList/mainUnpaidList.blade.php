@section('title', '未入金一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '未入金一覧')

<!DOCTYPE html>
<html lang="ja">

<head>
  <!-- Including Common Header Starts Here -->
  @include('layouts.header')
  <!-- Including Common Header Ends Here -->

  <!-- Including CSS Starts Here -->
  @include('sales.unpaidList.styles')
  <!-- Including CSS Ends Here -->

</head>

<body class="common-navbar common-nav" style="overflow-x:visible;" id="datehideinscroll">
  <section>

    <!-- Navbar Starts Here -->
    @include('layout.nav_fixed')
    <!-- Navbar Ends Here -->

    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

      @php
      if(isset($unpaidInfo)){
      $skip = 0;
      $old = array();
      if(session()->has('oldInput'.$bango)){
      $old = session()->get('oldInput'.$bango);
      }
      $current_page = $unpaidInfo->currentPage();
      $per_page = $unpaidInfo->perPage();
      $first_data = ($current_page - 1)*$per_page+1;
      $last_data = ($current_page - 1)*$per_page+ sizeof($unpaidInfo->items());
      $total = $unpaidInfo->total();
      $lastPage = $unpaidInfo->lastPage() ;
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
      @include('sales.unpaidList.unpaidListTopSearch')
      <!-- ============================= Top Search end here ======================= -->

      <!-- ============================= Main Content start here =================== -->
      @include('sales.unpaidList.unpaidListMainContent')
      <!-- ============================= Main Content end here ===================== -->

    </div>

    <!-- footer Starts Here -->
    @include('layout.footer_new')
    <!-- footer Ends Here -->

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->

  </section>

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('unpaidListTableSetting',$bango)}}')");
    });
  </script>


  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var unpaidListLink = document.createElement("script");
    unpaidListLink.type = "text/javascript";
    unpaidListLink.src = "{{ asset('js/sales/unpaid_list/unpaidList.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(unpaidListLink);
  </script>
  <!-- Hard reload js link ends here -->

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
  <!-- Calender js -->
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
        $(this).datepicker('update');
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
        $('#datepicker2_oen').datepicker('destroy');
        $('#datepicker2_oen').datepicker('reset');
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
      // startDate: $('#datepicker2_oen').datepicker('getDate')
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

    //Enter press hide dropdown...
    $("#datepicker1_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker1_oen").datepicker('hide');
      }
    });
    $("#datepicker2_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker2_oen").datepicker('hide');
      }
    });
  </script>

  <script type="text/javascript">
    $('#datepicker3_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker3_oen'
    });

    $('#datepicker3_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker4_oen').val().replaceAll('/', '')){
          $('#datepicker4_oen').val(datevalue);
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
          $('#datepicker4_oen').val('');
        }
        else{
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
        }
      }
    });

    $('#datepicker3_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        $('#datepicker4_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker3_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
        $('#datepicker4_oen').datepicker('destroy');
        $('#datepicker4_oen').datepicker('reset');
      }
    });

    $('#datepicker4_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#datepicker4_oen',
      // startDate: $('#datepicker4_oen').datepicker('getDate')
    });

    $('#datepicker4_oen').on('change focus', function () {
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

    $('#datepicker4_oen').on('keyup', function (e) {
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
    $('#datepicker4_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });


    //5
    // /******************* Common Date Picker *******************/ //
  $('.datePicker').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '.datePicker', function () {
    if ($(this).val().length == 10) {
      $(this).datepicker('update');
      $(this).siblings('.datePickerHidden').val($(this).val());
      let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
      let formatted_date = datevalue.replaceAll('/', '');
      $(this).val(formatted_date);
      $(this).focus();
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
      $(this).datepicker('update');
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
    //Enter press hide dropdown...
    $("#datepicker3_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker3_oen").datepicker('hide');
      }
    });
    $("#datepicker4_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker4_oen").datepicker('hide');
      }
    });
  </script>
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#datepicker1_oen").datepicker('hide');
    $("#datepicker2_oen").datepicker('hide');
    $("#datepicker3_oen").datepicker('hide');
    $("#datepicker4_oen").datepicker('hide');
  });
</script>
</body>

</html>