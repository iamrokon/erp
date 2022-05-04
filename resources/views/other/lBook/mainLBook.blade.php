@section('menu-test1', 'ホーム >')
@section('menu-test3', 'その他 >')
@section('menu-test5', '書類保管L-BOOK ')
@section('title', '書類保管L-BOOK')
<!DOCTYPE html>
<html lang="ja">
  <head>
    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}
  </head>

    <!-- Including Common Header Links Starts Here -->
    @include('other.lBook.lBookStyles')
    <!-- Including Common Header Links Ends Here -->

  <body class="common-nav" style="overflow-x:visible;">
    <section>
        @include('layout.nav_fixed')

        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

          <!-- Top Search Starts Here -->
          @include('other.lBook.lBookTopSearch')
          <!-- Top Search Starts end Here -->

          <!-- LBook main content start here -->
          @include('other.lBook.lBookMainContent')
          <!-- LBook main content end here -->

        </div>

        <!-- Supplier Modal start here -->
        @include('common.supplierModal')
        @include('common.supplierModal_3')
        <!-- Supplier Modal end here -->

        <!-- Table Header Settings Modal Starts Here -->
        @include('master.common.table_settings_modal')
        <!-- Table Header Settings Modal Ends Here -->

        <!-- LBook Registration Modal start here -->
        @include('other.lBook.lBookRegistrationModal')
        <!-- LBook Registration Modal end here -->

        <!-- LBook Edit Modal start here -->
        @include('other.lBook.lBookEditModal')
        <!-- LBook Edit Modal end here -->

        <!-- Number Search Modal start here -->
        @include('order.order-entry.include.number_search.main')
        <!-- Number Search Modal end here -->

        @include('layout.footer_new')
    </section>

    <!-- Including Common Footer Links Starts Here -->
    @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->
    <script src="{{ asset('js/underscore.min.js') }}"></script>
  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filelbook = document.createElement("script");
      filelbook.type = "text/javascript";
      filelbook.src = "{{ asset('js/other/l_book/lBook.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filelbook);
    </script>
    <script type="text/javascript">
      var filenumsearchlb = document.createElement("script");
      filenumsearchlb.type = "text/javascript";
      filenumsearchlb.src = "{{ asset('js/order/order_entry/number_search.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filenumsearchlb);
    </script>
   
    <script>
      $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('lBookTableSetting',$bango)}}')");
      });

      // Focus input while settings modal is shown
      $("#setting_display_modal").on("shown.bs.modal", function () {
        $("#setting_datachar02_detail").focus();
      });

      // Focus input while Supplier Selection Modal is shown
      $("#supplierSelectionModal").on("shown.bs.modal", function () {
        $("#lastname").focus();
      });

      // Focus input while Registration Modal is shown
      $("#registrationModal").on("shown.bs.modal", function () {
        $("#regEditButton").focus();
      });

      // Focus input while Edit Modal is shown
      $("#lBookEditModal").on("shown.bs.modal", function () {
        $("#deleteThis").focus();
      });
    </script>

    {{-- Enter to focus Next Fields --}}
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
    {{-- <script>
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
    </script> --}}
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
  // Modal first focus....
  $(document).on('shown.bs.modal', function(e) {
  $('[autofocus]', e.target).focus();
  });

</script>
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#datepicker2_oen").datepicker('hide');
    $("#datepicker1_oen").datepicker('hide');
  });
</script>


    <!-- Search result details modal scripts -->

    <script type="text/javascript">
      // $("#modalarea").on('click', function () {
      //   $(".modal-backdrop").addClass("overflow_cls");
      //   // $('.modal-backdrop').remove();
      // });
      $(".remove-cls").click(function(){
  $("body").removeClass("overflow_cls");
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
    // Date Picker Initialization
    $('#datepicker1_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 1,
      offset: 4,
      trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
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
      }
    });

    $('#datepicker2_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 1,
      offset: 4,
      trigger: '#datepicker2_oen',
      // startDate: $('#from').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
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

    {{-- <!-- chalender js -->
    <script type="text/javascript">
      $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
      $('#datepicker1_oen').on('change', function () {
        $('#datepicker1_oen').focus(); //focusing current input on select
      });

      //Enter press hide dropdown...
      $("#datepicker1_oen").keydown(function(e){
        if(e.keyCode == 13) {
          $("#datepicker1_oen").datepicker('hide');
        }
      });

      $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 1,
        offset: 4,
      });
      $('#datepicker2_oen').on('change', function () {
        $('#datepicker2_oen').focus(); //focusing current input on select
      });

      //Enter press hide dropdown...
      $("#datepicker2_oen").keydown(function(e){
        if(e.keyCode == 13) {
          $("#datepicker2_oen").datepicker('hide');
        }
      });
    </script> --}}
    <script type="text/javascript">
//      function openModalDetailProjectReg() {
//        $("#project_reg_modal2").modal('show');
//        $('body').addClass('overflow_cls');
//        $('.modal-backdrop').show();
//        $('#project_reg_modal2').on('hide.bs.modal', function(e) {
//          $('body').removeClass('overflow_cls');
//        })
//      }

      // Supplier Selection Modal Hide body overlay.....
//      $('#supplierSelectionModal').on('hide.bs.modal', function (e) {
//        refreshData();
//        $('body').addClass('overflow_cls');
//      }
    </script>
    <!-- Modal show hide -->
    {{-- <script type="text/javascript">
      $("#projectButton3").on("click", function() {
        $('.modal-backdrop').remove();
        $('#project_reg_modal3').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
          $("#project_reg_modal2").modal("hide");
        })
        $('#project_reg_modal3').on('hide.bs.modal', function(e) {
          $('body').removeClass('overflow_cls');
        })
      });
    </script> --}}
    <!-- Modal show hide -->
    <script type="text/javascript">
      $("#searchBtn").on("click", function() {
        $('#search_modal4').on('show.bs.modal', function(e) {
          $('body').addClass('overflow_cls');
        })
      });
    </script>
    <script type="text/javascript">
//      $("#projectButton11").on("click", function() {
//        $('#project_reg_modal1').on('show.bs.modal', function(e) {
//          $('body').addClass('overflow_cls');
//        })
//        $('#project_reg_modal1').on('hide.bs.modal', function(e) {
//          $('body').removeClass('overflow_cls');
//        })
//      });
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
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $("#reg_datachar09").val(fileName);
      });
    </script>
    <script>
      $(".custom-file-input2").on("change", function() {
        var fileName2 = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
        $("#edit_datachar09").val(fileName2);
      });
    </script>
    <script>
      $(".custom-file-input3").on("change", function() {
        var fileName3 = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label3").addClass("selected").html(fileName3);
        $("#input_file_prdes3").val(fileName3);
      });
    </script>

  </body>
</html>
