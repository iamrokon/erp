@section('title', 'プロジェクト登録')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注 >')
@section('menu-test5', 'プロジェクト登録')
<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Including CSS Starts Here --}}
  @include('order.projectRegistration.styles')
  {{-- Including CSS Ends Here--}}

</head>

<body class="common-nav" style="overflow-x: visible;">

  @include('layout.nav_fixed')

  <!-- ============================= Main Content start here ===================== -->
  @include('order.projectRegistration.projectMainContent')
  <!-- ============================= Main Content end here ======================= -->

  <!-- Supplier Modal start here -->
  @include('common.supplierModal_3')
  <!-- Supplier Modal end here -->

  <!-- ======= Registration Modal start here ==================== -->
  @include('order.projectRegistration.projectRegistrationModal')
  <!-- ======= Registration Moda1 end here ====================== -->

  <!-- ============================ Deatils Moda1 start here ===================== -->
  @include('order.projectRegistration.projectDetailViewModal')
  <!-- ============================ Deatils Moda1 end here ======================= -->

  <!-- ============================ Edit Moda1 start here ===================== -->
  @include('order.projectRegistration.projectEditModal')
  <!-- ============================ Edit Moda1 end here ======================= -->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  @include('layout.footer_new')

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileprojectreg = document.createElement("script");
          fileprojectreg.type = "text/javascript";
          fileprojectreg.src = "{{ asset('js/order/project_registration/projectRegistration.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
          document.getElementsByTagName("head")[0].appendChild(fileprojectreg);
  </script>
  <!-- Hard reload js link end -->

  <!-- Enter next tab focus start -->
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
          init: function(element, valueAccessor, allBindingsAccessor) {
            // $(element).on('keydown', 'input, textarea, select, button, .btn, .btn-info, .input-group-text', function(e) {
            $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trfocus', function (e) {
              var self = $(this),
                form = $(element),
                focusable, next;
              if (e.keyCode == 13 && !e.shiftKey) {
                // focusable = form.find('input, select, textarea, button, .btn, .btn-info, .input-group-text').filter(':visible');
                focusable = form.find('input:not([ignore]), input:not([readonly]), select, textarea, button:not([disabled]), a.btn, tr.trfocus').filter(':visible');
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
  <!-- Enter next tab focus end -->
  
  {{-- Date Picker Code Starts Here --}}

  {{-- Registration Modal --}}
  <script type="text/javascript">
    // Date Picker Initialization
          $(document).ready(function () {
            $('#reg_mbcatch').datepicker({
              language: 'ja-JP',
              format: 'yyyy/mm',
              autoHide: true,
              zIndex: 1100,
              offset: 4,
              trigger: '#reg_mbcatch'
            });

            $('#reg_mbcatch').on('change focus', function () {
              if ($(this).val().length == 7) {
                $(this).siblings('.datePickerHidden').val($(this).val());
                let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
                let formatted_date = datevalue.replaceAll('/', '')
                $(this).val(formatted_date);
                $(this).focus(); //focusing current input on select
                $(this).datepicker('hide');
                if($(this).val().replaceAll('/', '') > $('#reg_mbcatchsm').val().replaceAll('/', '')){
                  $('#reg_mbcatchsm').val(datevalue);
                  $('#reg_mbcatchsm').datepicker('setStartDate', $('#reg_mbcatch').datepicker('getDate'));
                  $('#reg_mbcatchsm').datepicker('update');
                  $('#reg_mbcatchsm').val('');
                }
                else{
                  $('#reg_mbcatchsm').datepicker('setStartDate', $('#reg_mbcatch').datepicker('getDate'));
                  $('#reg_mbcatchsm').datepicker('update');
                }
              }
            });

            $('#reg_mbcatch').on('keyup', function (e) {
              let inputDateValue = $(this).val();  //getting date value from input
              if (inputDateValue.length == 6) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                let formatted_sliced_date = slicedYear + "/" + slicedMonth;
                $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
                $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
                $('#reg_mbcatchsm').datepicker('setStartDate', $('#reg_mbcatch').datepicker('getDate'));
                $('#reg_mbcatchsm').datepicker('update');
              }
            });
            // Update date value with slash on blur
            $('#reg_mbcatch').on('blur', function () {
              if ($(this).val() != '') {
                $(this).val($(this).siblings('.datePickerHidden').val());
              }
              else if ($(this).val() == '') {
                $(this).val('');
                $(this).siblings('.datePickerHidden').val('');
              }
            });

            $('#reg_mbcatchsm').datepicker({
              language: 'ja-JP',
              format: 'yyyy/mm',
              autoHide: true,
              zIndex: 1100,
              offset: 4,
              trigger: '#reg_mbcatchsm',
              startDate: $('#reg_mbcatch').datepicker('getDate')
            });

            $('#reg_mbcatchsm').on('change focus', function () {
              if ($(this).val().length == 7) {
                $(this).siblings('.datePickerHidden').val($(this).val());
                let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
                let formatted_date = datevalue.replaceAll('/', '')
                $(this).val(formatted_date);
                $(this).focus(); //focusing current input on select
                $(this).datepicker('hide');
              }
            });

            $('#reg_mbcatchsm').on('keyup', function (e) {
              let inputDateValue = $(this).val();  //getting date value from input
              if (inputDateValue.length == 6) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                let formatted_sliced_date = slicedYear + "/" + slicedMonth;
                $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
                $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
              }
            });
            // Update date value with slash on blur
            $('#reg_mbcatchsm').on('blur', function () {
              if ($(this).val() != '') {
                $(this).val($(this).siblings('.datePickerHidden').val());
              }
              else if ($(this).val() == '') {
                $(this).val('');
                $(this).siblings('.datePickerHidden').val('');
              }
            });

            //Enter press hide dropdown...
            $("#reg_mbcatch").keydown(function (e) {
              if (e.keyCode == 13) {
                $("#reg_mbcatch").datepicker('hide');
              }
            });
            $("#reg_mbcatchsm").keydown(function (e) {
              if (e.keyCode == 13) {
                $("#reg_mbcatchsm").datepicker('hide');
              }
            });
          });
  </script>
  <script>
    $("#add_icon").click(function () {
      $("#reg_mbcatch").datepicker('hide');
      $("#reg_mbcatchsm").datepicker('hide');
    });
  </script>
  {{-- Edit Modal --}}
  <script type="text/javascript">
    // Date Picker Initialization
          $(document).ready(function () {
            $('#edit_mbcatch').datepicker({
              language: 'ja-JP',
              format: 'yyyy/mm',
              autoHide: true,
              zIndex: 1100,
              offset: 4,
              trigger: '#edit_mbcatch'
            });

            $('#edit_mbcatch').on('change focus', function () {
              if ($(this).val().length == 7) {
                $(this).siblings('.datePickerHidden').val($(this).val());
                let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
                let formatted_date = datevalue.replaceAll('/', '')
                $(this).val(formatted_date);
                $(this).focus(); //focusing current input on select
                $(this).datepicker('hide');
                if($(this).val().replaceAll('/', '') > $('#edit_mbcatchsm').val().replaceAll('/', '')){
                  $('#edit_mbcatchsm').val(datevalue);
                  $('#edit_mbcatchsm').datepicker('setStartDate', $('#edit_mbcatch').datepicker('getDate'));
                  $('#edit_mbcatchsm').datepicker('update');
                  $('#edit_mbcatchsm').val('');
                }
                else{
                  $('#edit_mbcatchsm').datepicker('setStartDate', $('#edit_mbcatch').datepicker('getDate'));
                  $('#edit_mbcatchsm').datepicker('update');
                }
              }
            });

            $('#edit_mbcatch').on('keyup', function (e) {
              let inputDateValue = $(this).val();  //getting date value from input
              if (inputDateValue.length == 6) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                let formatted_sliced_date = slicedYear + "/" + slicedMonth;
                $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
                $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
                $('#edit_mbcatchsm').datepicker('setStartDate', $('#edit_mbcatch').datepicker('getDate'));
                $('#edit_mbcatchsm').datepicker('update');
              }
            });
            // Update date value with slash on blur
            $('#edit_mbcatch').on('blur', function () {
              if ($(this).val() != '') {
                $(this).val($(this).siblings('.datePickerHidden').val());
              }
              else if ($(this).val() == '') {
                $(this).val('');
                $(this).siblings('.datePickerHidden').val('');
              }
            });

            $('#edit_mbcatchsm').datepicker({
              language: 'ja-JP',
              format: 'yyyy/mm',
              autoHide: true,
              zIndex: 1100,
              offset: 4,
              trigger: '#edit_mbcatchsm',
              startDate: $('#edit_mbcatch').datepicker('getDate')
            });

            $('#edit_mbcatchsm').on('change focus', function () {
              if ($(this).val().length == 7) {
                $(this).siblings('.datePickerHidden').val($(this).val());
                let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
                let formatted_date = datevalue.replaceAll('/', '')
                $(this).val(formatted_date);
                $(this).focus(); //focusing current input on select
                $(this).datepicker('hide');
              }
            });

            $('#edit_mbcatchsm').on('keyup', function (e) {
              let inputDateValue = $(this).val();  //getting date value from input
              if (inputDateValue.length == 6) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                let formatted_sliced_date = slicedYear + "/" + slicedMonth;
                $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
                $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
              }
            });
            // Update date value with slash on blur
            $('#edit_mbcatchsm').on('blur', function () {
              if ($(this).val() != '') {
                $(this).val($(this).siblings('.datePickerHidden').val());
              }
              else if ($(this).val() == '') {
                $(this).val('');
                $(this).siblings('.datePickerHidden').val('');
              }
            });

            //Enter press hide dropdown...
            $("#edit_mbcatch").keydown(function (e) {
              if (e.keyCode == 13) {
                $("#edit_mbcatch").datepicker('hide');
              }
            });
            $("#edit_mbcatchsm").keydown(function (e) {
              if (e.keyCode == 13) {
                $("#edit_mbcatchsm").datepicker('hide');
              }
            });
          });
  </script>

  {{-- Date Picker Code Ends Here --}}

  <script type="text/javascript">
    function openModalDetailProjectReg() {
        $("#project_reg_modal2").modal('show');
        $('.modal-backdrop').show();
      }
  </script>

  <!-- Modal show hide -->
  <script type="text/javascript">
    $("#projectButton3").on("click", function() {
        $('.modal-backdrop').remove();
        $('#project_edit_modal').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
          $("#project_detail_modal").modal("hide");
        })
        $('#project_edit_modal').on('hide.bs.modal', function(e) {
          $('body').removeClass('overflow_cls');
        })
      });
  </script>

  <!-- Modal show hide -->
  <script type="text/javascript">
    $("#searchBtn").on("click", function() {
        // $('.modal-backdrop').remove();
        $('#search_modal4').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
          // $("#project_reg_modal1").modal("hide");
        })
        $('#search_modal4').on('hide.bs.modal', function(e) {
          $('body').removeClass('overflow_cls');
        })
      });
  </script>

  <!-- Modal show hide -->
  <script type="text/javascript">
    $("#searchBtn1").on("click", function() {
        $('.modal-backdrop').remove();
        $('#billing_ledger_search_modal').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
          $("#project_reg_modal3").modal("hide");
        })
        $('#billing_ledger_search_modal').on('hide.bs.modal', function(e) {
          $('body').removeClass('overflow_cls');
        })
      });

      //Modal first field focus....
        $(document).on('shown.bs.modal', function(e) {
          $('[autofocus]', e.target).focus();
        });
  </script>

  <!-- table col select js start -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('th.signbtn').click(function() {
        $(this).addClass('highlight').siblings().removeClass('highlight');
          var th_index = $(this).index();
          $('#userTable tr').each(function() {
              $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
          });
        });
      });
  </script>
  <!-- table col select js end -->

  <script>
    $(document).ready(function(){
        $("#initial_content1").hide();
        $("button#searchButton").click(function(){
          $("#initial_content1").show();
        });
      });
      $(document).ready(function(){
          $("#choice_button1").click(function(){
           $("#initial_content1").hide();
          });
      });
  </script>
  <script type="text/javascript">
    //Tab first field focus....
      $(document).on('shown.bs.modal', function(e) {
        if ('button[data-toggle="modal"]') {
          $('[autofocus]', e.target).focus();
        }
      });

  </script>
  <!-- modal overlay -->
  <script type="text/javascript">
    $(".modal").on("shown.bs.modal", function () {
        if ($(".modal-backdrop").length > 1) {
            $(".modal-backdrop").not(':first').remove();
        }
      });
  </script>
  <!-- modal overlay -->

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

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('projectRegistrationTableSetting',$bango)}}')");
    });
  </script>

</body>

</html>