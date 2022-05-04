@section('title', '月別受注残一覧2')
@section('menu-test1', ' ホーム>')
@section('menu-test3', '受注 >')
@section('menu-test5', '月別受注残一覧2')
@section('tag-test', 'ここは、ガイドの文章が入ります。')


<!DOCTYPE html>
<html lang="ja">

<head>
<!-- Including Common Header Starts Here -->
@include('layouts.header')
<!-- Including Common Header Ends Here -->

<!-- Including CSS Starts Here -->
@include('order.backlogList2.styles')
<!-- Including CSS Ends Here -->

</head>

<body class="common-nav" style="overflow-x:visible;">
  <section>
     {{-- Navbar Starts Here --}}
     @include('layout.nav_fixed')
     {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        
    @php
    if(isset($backlogList2Info)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $backlogList2Info->currentPage();
        $per_page = $backlogList2Info->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($backlogList2Info->items());
        $total = $backlogList2Info->total();
        $lastPage = $backlogList2Info->lastPage() ;
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
    @endphp
        
      <div class="content-head-section" style="padding-bottom: 5px;">
        <div class="container">

          {{-- Success Message Starts Here --}}
          {{-- <div class="row success-msg-box" style="position: relative;width:100%; max-width: 1452px; z-index: 1; min-width: 1349px;">
            <div class="col-12">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close dismissMe" data-dismiss="alert" onclick="$('#businessUnit').focus();"
                  autofocus>&times;</button>
                <strong>Success Message</strong><br>
              </div>
            </div>
          </div> --}}
          {{-- Success Message Ends Here --}}

          {{-- <script>
            // Focus on Alert Closing
              $(".dismissMe").keydown(function(e) {
                  if (e.shiftKey && e.which == 13) {
                    $('.close').alert('close');
                    event.preventDefault();
                    document.getElementById("businessUnit").click();
                    $('#businessUnit').focus();
                  }
              });
          </script> --}}

          {{-- Error Message Starts Here --}}
           <div id="error_data" class="common_error"></div>
           @if(isset($exceedUser))
            <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
            @endif
          {{-- Error Message Ends Here --}}


        <!-- ============================= Top Search start here ===================== -->
        @include('order.backlogList2.backlogList2TopSearch')
        <!-- ============================= Top Search end here ======================= -->

        </div>
      </div>

    <!-- Main Content Starts Here -->
    @include('order.backlogList2.backlogList2MainContent')
    <!-- Main Content Ends Here -->
    
    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->
      
    </div>
  </section>

  <!-- Footer Starts Here -->
  @include('layout.footer_new')
  <!-- Footer end Here -->
  
  <!--  goto order inquiry page -->
  <form action="{{route('orderInquiry')}}" method="POST" target="_blank" id="goToOrderInquiry">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango" />
    <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" />
  </form>
  <!--  goto order inquiry page -->
    
  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('backlogList2TableSetting',$bango)}}')");
    });
  </script>

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->
  
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/order/backlog_list_2/backlogList2.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      $("#closetopcontent").click(function(){
        $(".list_backlog2").toggle();
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
  <script type="text/javascript">
    // Date Picker Initialization


 // Start
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
      else if ($(this).val().length <= 5 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_1', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 6) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
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

    $('.datePicker1_2').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function () {
      if ($(this).val().length == 7) {
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
      else if ($(this).val().length <= 5 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
      // $(this).datepicker('hide');
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 6) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1));
        $(this).datepicker('update');
       
      }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_2', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
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

  <!-- </script> -->

  <!-- script for take only 60 characters in textarea field -->
  <script>
    //file upload show name....
    $(".custom-file-input").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
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
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
    $(".datePicker1_1").datepicker('hide');
    $(".datePicker1_2").datepicker('hide');
  });
  </script>
  <script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
    
    $(document).ready(function(){
        setTimeout(function(){    
            if($("#userTable").length > 0){
                var count = document.getElementById("userTable").getElementsByTagName("tr").length;
                if(count == 1){
                    $("#excelDwld").prop('disabled', true);
                }else{
                    $("#excelDwld").prop('disabled', false);
                }
            }
        }, 1000);
    });
    
</script>
</body>

</html>