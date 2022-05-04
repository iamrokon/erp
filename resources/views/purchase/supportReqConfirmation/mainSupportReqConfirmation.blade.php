@section('title', 'サポート一覧・サポート依頼兼請書')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '発注>')
@section('menu-test5', 'サポート一覧・サポート依頼兼請書')
@section('tag-test', 'ここには、ガイドの文章が入ります。')


<!DOCTYPE html>
<html lang="ja">

<head>
<!-- Including Common Header Starts Here -->
@include('layouts.header')
<!-- Including Common Header Ends Here -->
</head>

<!-- Including CSS Starts Here -->
@include('purchase.supportReqConfirmation.styles')
<!-- Including CSS Ends Here -->

<body class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    
    @php
    if(isset($supportReqConfirmationInfo)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $supportReqConfirmationInfo->currentPage();
        $per_page = $supportReqConfirmationInfo->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($supportReqConfirmationInfo->items());
        $total = $supportReqConfirmationInfo->total();
        $lastPage = $supportReqConfirmationInfo->lastPage() ;
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
    @endphp
    
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      
    <!-- ============================= Top Search start here ===================== -->
    @include('purchase.supportReqConfirmation.supportReqConfirmationTopSearch')
    <!-- ============================= Top Search end here ======================= -->

    <!-- ============================= Main Content start here ===================== -->
    @include('purchase.supportReqConfirmation.supportReqConfirmationMainContent')
    <!-- ============================= Main Content end here ======================= -->
    
    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->
      
    </div>
   {{-- Footer Starts Here --}}
   @include('layout.footer_new')
   {{-- Footer end Here --}}
  </section>
    
    <!-- Supplier Modal start here -->
    @include('common.supplierModal_3')
    <!-- Supplier Modal end here -->


  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->
  
  <!--  goto support inquiry page -->
  <form action="{{route('supportInquiry')}}" method="POST" target="_blank" id="goToSupportInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango" />
    <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" />
  </form>
  <!--  goto order inquiry page -->
  
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/purchase/support_req_confirmation/supportReqConfirmation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
  
  <script>
    $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('supportReqConfirmationTableSetting',$bango)}}')");
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
  <!-- chalender js -->

  <script>
    // button click Load icon toggle......
  $(document).ready(function(){
    $(".loading-icon").hide();
    $(".progress").hide();
    $("#loading-icon").click(function(){
      $(".loading-icon").toggle();
      $(".progress").toggle();
    });
  });
  </script>
    {{-- Knockout - Enter to New Input Starts Here --}}
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
    {{-- Knockout - Enter to New Input ends Here --}}
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

    $(document).on('change focus', '.datePicker1_1', function (){

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
        $(this).datepicker('update');
      }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_1', function () {
      if ($(this).val() != '') { 
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).datepicker('update');
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
        $(this).datepicker('update');
      }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_2', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker1_2").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker1_2").datepicker('hide');
      }
    });

  </script>
  <script type="text/javascript">
    // Check All Table chackbox js start.....
      $('.check-tblall').click(function() {
        $('.tblCheckBox').each(function() {
          if ($(this).prop('checked')==false){
            this.checked = true;
          }
          else {
            this.checked = false;
          }
        });
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
      $("#add_icon").click(function () {
        $(".datePicker1_1").datepicker('hide');
        $(".datePicker1_2").datepicker('hide');
      });
    </script>
  
  <script>
      $(document).on('shown.bs.modal', function (e) {
          $('[autofocus]', e.target).focus();
      });
  </script>
</body>

</html>