@section('title', '売上伝票発行')
@section('menu-test1', 'ホーム')
@section('menu-test3', '＞ 売上請求')
@section('menu-test5', '＞ 売上伝票発行')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>
  @include('layouts.header')

  <!-- including CSS Starts Here -->
  @include('sales.salesSlip.styles')
  <!-- including CSS ends Here -->

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

      <!-- ============================= Top Search start here ===================== -->
      @include('sales.salesSlip.salesSlipTopSearch')
      <!-- ============================= Top Search end here ======================= -->

      <!-- ============================= Main Content start here ===================== -->
      @include('sales.salesSlip.salesSlipMainContent')
      <!-- ============================= Main Content end here ======================= -->

    </div>

    <!-- Supplier Modal start here -->
    @include('common.supplierModal_2')
    <!-- Supplier Modal end here -->

    <!-- Mail Confirmation Modal start here -->
    @include('sales.salesSlip.mailConfirmationModal')
    <!-- Mail Confirmation Modal end here -->

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here   -->

    @include('layouts.footer')

  </section>

  @include('layout.footer_new')


  <!--  goto order inquiry page -->
  <form action="{{route('orderInquiry')}}" method="POST" target="_blank" id="goToOrderInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango" />
    <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" />
  </form>
  <!--  goto order inquiry page -->

  <!--  goto sales inquiry page -->
  <form action="{{route('salesInquiry')}}" method="POST" target="_blank" id="goToSalesInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="s_kokyakuorderbango" id="s_kokyakuorderbango" />
    <input type="hidden" name="s_ordertypebango2" id="s_inquiry_ordertypebango2" />
  </form>
  <!--  goto sales inquiry page -->

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var salesSlipLink = document.createElement("script");
        salesSlipLink.type = "text/javascript";
        salesSlipLink.src = "{{ asset('js/sales/sales_slip/salesSlip.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(salesSlipLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <script>
    $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('salesSlipTableSetting',$bango)}}')");
        });
  </script>
  <script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
      });
  </script>
  <script>
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


      //Enter press hide dropdown
      $(".datePicker").keydown(function (e) {
        if (e.keyCode == 13) {
          $(".datePicker").datepicker('hide');
        }
      });

      
      // button click progress toggle......
      $(document).ready(function(){
        $(".progress").hide();
        var len = $('input[name="selected_item[]"]:checked').length;
        if(len>0){
            $("#customprogress").click(function(){
              $(".progress").toggle();
            });
        }
      });

      // button click Load icon toggle......
      $(document).ready(function(){
        $(".loading-icon").hide();
        var len = $('input[name="selected_item[]"]:checked').length;
        if(len>0){
            $("#loading-icon").click(function(){
              $(".loading-icon").toggle();
            });
        }
      });

      $(document).ready(function(){
        $(".loading-icon").hide();
        $(".progress").hide();
        $(".loadingProgress").click(function(){
          $(".loading-icon,.progress").toggle();
          // $(".buttonGroup").addClass('inner');

        });
      });
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
  <script>
    //Click to hide calendar
      $("#add_icon").click(function () {
        $("#datepicker1_dnote").datepicker('hide');
        $("#datepicker2_dnote").datepicker('hide');
      });
  </script>
  <script>
    //count checked item start here
        var $checkboxes = $(".checkedItem");
        $checkboxes.change(function(){
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            $('#countCheckedItem').text(countCheckedCheckboxes);
        });

        var $select_all_checkboxes = $(".selectall");
        $select_all_checkboxes.on("click",function(){
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            $('#countCheckedItem').text(countCheckedCheckboxes);
        });

        var $unselect_all_checkboxes = $(".unselectall");
        $unselect_all_checkboxes.on("click",function(){
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            $('#countCheckedItem').text(countCheckedCheckboxes);
        });
        //count checked item end here
  </script>

  <script>
    // Enter next tab focus start............
      ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), select:not([ignore]), textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
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
</body>

</html>