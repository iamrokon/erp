@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '売掛残高一覧')
@section('title', '売掛残高一覧')
<!DOCTYPE html>
<html lang="ja">
  <head>
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}
  </head>
  @include('sales.accountList.styles')

  <body class="common-nav" style="overflow-x: visible;">
    @include('layout.nav_fixed')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <!-- Content Head Section start -->
      @include('sales.accountList.top')
      <!-- Content Head Section end -->
      <!-- Content Bottom Section start -->
      @include('sales.accountList.bottom')
      <!-- Content Bottom Section end -->
    </div>
    {{-- Footer Starts Here --}}
       @include('layout.footer_new')
    {{-- Footer end Here --}}

    @include('master.common.table_settings_modal')
    
    @include('common.supplierModal_2')
    

    {{-- Footer Starts Here --}}
        @include('layouts.footer')
    {{-- Footer Ends Here --}}

    <script type="text/javascript">
      var file = document.createElement("script");
      file.type = "text/javascript";
      file.src = "{{ asset('js/sales/account_list/accountList.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(file);

      $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{ route('accountListTableSetting',$bango) }}')");
      });
    </script>

    <!-- Search result details modal scripts -->
    <script>
      function openModalPopup() {
        $("#billing_ledger_search_modal").modal('show');

        $('.modal-backdrop').show();
        $('#product_code_modal').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
          //$("#product_code_modal2").modal("hide");
        })
        $('#product_code_modal').on('hide.bs.modal', function(e) {
          $('body').removeClass('overflow_cls');
        })
      }

      function removeBorder() {
        $('.show_office_master_info').removeClass('add_border');
        $('.show_personal_master_info').removeClass('add_border');
        $('.show_content_last').removeClass('add_border');
      }
    </script>
  
    <script type="text/javascript">
      $("#choice_button").click(function() {

        //$("#initial_content").hide();
        $("#office_master_content_div").hide();
        $("#personal_master_content_div").hide();
        $("#office_content_div_last").hide();
        $('body').addClass('overflow_cls');
        if ($(".show_office_master_info").hasClass("add_border")) {
          // $(".show_office_master_info").addClass('add_border');
          $(".show_office_master_info").removeClass('add_border');
        }

        if ($(".show_personal_master_info").hasClass("add_border")) {
          $(".show_personal_master_info").removeClass('add_border');
        }
        if ($(".show_content_last").hasClass("add_border")) {
          $(".show_content_last").removeClass('add_border');
        }
      });
    </script>

    <!-- Search result details modal scripts end -->
    <script>

        $(document).ready(function () {
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
            } else if ($(this).val().length <= 5) {
                $(this).datepicker('hide');
            }
        });

        $(document).on('keyup', '.datePicker1_1', function (e) {
            let inputDateValue = $(this).val(); //getting date value from input
            if (inputDateValue.length == 6) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                // let slicedDay = inputDateValue.slice(6, 8);
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
        // End

    })
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
    <script>
    $("#add_icon").click(function () {
      $(".datePicker1_1").datepicker('hide');
    });
  </script>

<script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
</script>

  </body>
</html>
