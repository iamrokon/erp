@section('title', '受注履歴一覧・受注照会２')
@section('menu-test1', 'ホーム > ')
@section('menu-test3', '受注 > ')
@section('menu-test5', '受注履歴一覧・受注照会２')
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

  {{-- Including CSS Starts Here --}}
  @include('order.orderHistory2.styles')
  {{-- Including CSS Ends Here--}}
</head>



<body class="common-nav" style="overflow-x:visible;">
  {{-- <section> --}}

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

  <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

    @php
    if(isset($orderHistory2Info)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $orderHistory2Info->currentPage();
        $per_page = $orderHistory2Info->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($orderHistory2Info->items());
        $total = $orderHistory2Info->total();
        $lastPage = $orderHistory2Info->lastPage() ;
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
    @include('order.orderHistory2.orderHistory2TopSearch')
    <!-- ============================= Top Search end here ======================= -->

    <!-- ============================= Main Content start here ===================== -->
    @include('order.orderHistory2.orderHistory2MainContent')
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

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->
  <script src="{{ asset('js/underscore.min.js') }}"></script>
  <script>
    $(document).ready(function () {
        var rd3 = $("input[type='radio'][name='rd3']:checked").val();
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('orderHistory2TableSetting',$bango)}}"+"?rd3="+rd3+"')");
        var key_type = '{{isset($fsReqData["rd3"])?$fsReqData["rd3"]:"rd3_1"}}';
        $('#tableSetting').append('<input type="hidden" name="key_type" value="'+key_type+'">')
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
<script type="text/javascript">
       //Enter press hide dropdown...
      $(".input_field").keydown(function(e){
        if(e.keyCode == 13) {
          $(".input_field").datepicker('hide');
        }
      });

</script>
<script>
    $(document).ready(function(){
      // Datepicker 1 start heare....
      $('#datepicker3_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker3_oen', function () {
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

    $(document).on('click', '#datepicker3_oen', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker3_oen', function (e) {
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
    $(document).on('blur', '#datepicker3_oen', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker 1 end heare....

    // Datepicker 2 start heare....
    $('#datepicker4_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker4_oen', function () {
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

    $(document).on('click', '#datepicker4_oen', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker4_oen', function (e) {
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
    $(document).on('blur', '#datepicker4_oen', function () {
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
<script>

$("#add_icon").click(function () {
  $("#datepicker3_oen").datepicker('hide');
  $("#datepicker4_oen").datepicker('hide');
  

});
</script>
   <!-- Hard reload js link -->
  <script type="text/javascript">
    var filecomscript = document.createElement("script");
    filecomscript.type = "text/javascript";
    filecomscript.src = "{{ asset('js/common_script.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(filecomscript);
  </script>
  
  <script type="text/javascript">
    var fileord2 = document.createElement("script");
    fileord2.type = "text/javascript";
    fileord2.src = "{{ asset('js/order/order_history2/orderHistory2.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fileord2);
  </script>
  
  <script type="text/javascript">
    var filenumsearch = document.createElement("script");
    filenumsearch.type = "text/javascript";
    filenumsearch.src = "{{ asset('js/order/order_entry/number_search.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(filenumsearch);
  </script>
  <!-- Hard reload js link -->

</body>

</html>
