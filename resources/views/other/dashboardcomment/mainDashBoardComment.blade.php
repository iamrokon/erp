@section('title', 'インフォメーション')
@section('menu-test1', 'ホーム')
@section('menu-test3', '＞ その他 ')
@section('menu-test5', '＞インフォメーション')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <!-- Including Common Header Links Starts Here -->
  @include('other.dashboardcomment.dashBoardCommentStyles')
  <!-- Including Common Header Links Ends Here -->

</head>



<body class="common-nav" style="overflow-x:visible;">

    <!-- preloader start here -->
    <div class="preloader">
        <div class="loading" style="display: none"></div>
    </div>
    <!-- preloader end here -->

  <section>
    @include('layout.nav_fixed')
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">


      <!-- DashboardComment main content start here -->
      @include('other.dashboardcomment.dashBoardCommentMainContent')
      <!-- DashboardComment main content end here -->

    </div>

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->

    <!-- DashboardComment Registration Modal start here -->
    @include('other.dashboardcomment.dashBoardCommentRegistrationModal')
    <!-- DashboardComment Registration Modal end here -->

    <!-- DashboardComment Edit Modal start here -->
    @include('other.dashboardcomment.dashBoardCommentEditModal')
    <!-- DashboardComment Edit Modal end here -->


    @include('layout.footer_new')
  </section>

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript" src="{{asset('js/date-de-DE.js')}}"></script>
  {{-- CKEditor (Version: 4.15) Starts Here --}}
  {{-- Steps: Add ckeditor.js in scripts. To make sure linking works, add data-focus="false" in the modals and styles for properly showing the link modal. --}}
  <script type="text/javascript">
    CKEDITOR.replace( 'ckeditor1' );
    CKEDITOR.replace( 'ckeditor2' );
  </script>
  {{-- CKEditor (Version: 4.15) Ends Here --}}

  {{-- Enter to focus Next Fields --}}
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, a.btn, a.checkall, tr.trFocus', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), input:not([readonly]), select, textarea, button:not([disabled]), a.btn, a.checkall, tr.trFocus').filter(':visible');
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
    // Registration Modal
$('#dashboard_modal1').on('shown.bs.modal', function () {
  $("#insert_yukouflag1").focus();
});

  </script>
  <script>
    // Edit Modal
  $('#dashboard_comments_modal3').on('shown.bs.modal', function () {
    $("#edit_yukouflag1").focus();
  });

  // Settings Modal
  $('#setting_display_modal').on('shown.bs.modal', function () {
    $("#setting_category2").focus();
  });
  </script>
  <script type="text/javascript">
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      $("#fileshow").val(fileName);
    });
  </script>
  <script>
    type="text/javascript"
      $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      $("#fileshow2").val(fileName);
    });
  </script>



  <!-- Search result details modal scripts -->

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
    // select table col js start.......
            $(document).ready(function(){
            $('th.signbtn').click(function() {
            $(this).addClass('highlight').siblings().removeClass('highlight');
                var th_index = $(this).index();
                $('#userTable tr').each(function() {
                    $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
                });
            });
            });
     // select table col js end.......
  </script>

  <script type="text/javascript">
    $("#searchBtn").on("click", function() {
        $('#search_modal4').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
        })
      });
  </script>



  <script>
    // Date Picker Initialization
    var dateToday = new Date();
    $('#insert_kinsyousu').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#insert_kinsyousu',
      startDate: $('dateToday').datepicker()
    });

    $('#insert_kinsyousu').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#insert_kinsyousetteisu').val().replaceAll('/', '')){
          $('#insert_kinsyousetteisu').val(datevalue);
          $('#insert_kinsyousetteisu').datepicker('setStartDate', $('#insert_kinsyousu').datepicker('getDate'));
          $('#insert_kinsyousetteisu').datepicker('update');
          $('#insert_kinsyousetteisu').val('');
        }
        else{
          $('#insert_kinsyousetteisu').datepicker('setStartDate', $('#insert_kinsyousu').datepicker('getDate'));
          $('#insert_kinsyousetteisu').datepicker('update');
        }
      }
    });

    $('#insert_kinsyousu').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#insert_kinsyousetteisu').datepicker('setStartDate', $('#insert_kinsyousu').datepicker('getDate'));
        $('#insert_kinsyousetteisu').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#insert_kinsyousu').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#insert_kinsyousetteisu').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#insert_kinsyousetteisu',
      startDate: $('#insert_kinsyousu').datepicker('getDate')
    });

    $('#insert_kinsyousetteisu').on('change focus', function () {
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

    $('#insert_kinsyousetteisu').on('keyup', function (e) {
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
    $('#insert_kinsyousetteisu').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#insert_kinsyousu").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#insert_kinsyousu").datepicker('hide');
      }
    });
    $("#insert_kinsyousetteisu").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#insert_kinsyousetteisu").datepicker('hide');
      }
    });



    $('#edit_kinsyousu').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#edit_kinsyousu',
      startDate: $('dateToday').datepicker()
    });

    $('#edit_kinsyousu').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#edit_kinsyousetteisu').val().replaceAll('/', '')){
          $('#edit_kinsyousetteisu').val(datevalue);
          $('#edit_kinsyousetteisu').datepicker('setStartDate', $('#edit_kinsyousu').datepicker('getDate'));
          $('#edit_kinsyousetteisu').datepicker('update');
          $('#edit_kinsyousetteisu').val('');
        }
        else{
          $('#edit_kinsyousetteisu').datepicker('setStartDate', $('#edit_kinsyousu').datepicker('getDate'));
          $('#edit_kinsyousetteisu').datepicker('update');
        }
      }
    });

    $('#edit_kinsyousu').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#edit_kinsyousetteisu').datepicker('setStartDate', $('#edit_kinsyousu').datepicker('getDate'));
        $('#edit_kinsyousetteisu').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#edit_kinsyousu').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    $('#edit_kinsyousetteisu').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 2048,
      offset: 4,
      trigger: '#edit_kinsyousetteisu',
      startDate: $('#edit_kinsyousu').datepicker('getDate')
    });

    $('#edit_kinsyousetteisu').on('change focus', function () {
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

    $('#edit_kinsyousetteisu').on('keyup', function (e) {
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
    $('#edit_kinsyousetteisu').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    $("#edit_kinsyousu").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#edit_kinsyousu").datepicker('hide');
      }
    });
    $("#edit_kinsyousetteisu").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#edit_kinsyousetteisu").datepicker('hide');
      }
    });

  </script>

  <script type="text/javascript">
    var filemas = document.createElement("script");
  filemas.type = "text/javascript";
  filemas.src = "{{ asset('js/other/dashboardComment/dashboardComment.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
  document.getElementsByTagName("head")[0].appendChild(filemas);
  </script>
  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('dashboardCommentTableSetting',$bango)}}')");
    });
  </script>


</body>

</html>
