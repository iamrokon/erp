@section('title', '入金消込SYS請求データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '入金消込SYS請求データ作成')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
 
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Common Style Starts Here --}}
  @include('sales.billingDataCreation.styles')
  {{-- Common Style Ends Here --}}

</head>

<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section1" style="padding-bottom:46px!important;">
        <div class="container position-relative">

          {{-- Success Message Starts Here --}}
          <div class="row success-msg-box" id="successMessage">
            <div class="col-12 pl-0 pr-0 ml-3">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close dismissAlertMessage" data-dismiss="alert" autofocus
                  onclick="$('#datepicker2_oen').focus();">
                  &times;
                </button>
                <strong>処理が正常に終了しました。</strong>
              </div>
            </div>
          </div>
          {{-- Success Message Ends Here --}}

          {{-- Error Message Starts Here --}}
          <div id="error_data" class="common_error"></div>
          {{-- Error Message Ends Here --}}

          <div class="row inner-top-content">
            <div class="col-12">
              <div class="row mb-2" style="padding-top: 0px;">
                <div class="col-6">
                  <form id="csvForm" method="GET" action="{{ route('billingDataDownloadCSV') }}">
                    @csrf
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="padding-left:0px !important;border: none!important;text-align: left;color: black;width: 115px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            入金日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input id="datepicker2_oen" autocomplete="off" autofocus="" type="text"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                class="form-control input_field datePicker datePicker1_1" value="" placeholder="年/月/日"
                                style="width: 96px!important;" name="date_start">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input id="datepicker1_oen" autocomplete="off" type="text"
                                class="form-control input_field datePicker datePicker1_2" value="" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                style="width: 96px!important;" name="date_end">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="col-12" style="padding-right: 50px;">
                  <div class="text-right">
                    <button class="btn btn-info uskc-button"
                      onclick="csvExport('{{ route('billingDataCreateCSV',['id' => $bango]) }}')"
                      id="contenthide">CSVエクスポート</button>
                  </div>
                  <div class="loading-icon" style="right: 0px;">
                    <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer Start Here -->
    @include('layout.footer_new')
    <!-- Footer End Here -->
  </section>

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  {{-- Shift + Enter to Close Alert Message Starts Here --}}
  <script>
    $(document).ready(function(){
      $(".dismissAlertMessage").click(function (){
        $('#successMessage').hide();
        $('#datepicker2_oen').focus();
      });
      $(".dismissAlertMessage").keydown(function (e){
        if (e.shiftKey && e.which == 13) {
          $('#successMessage').hide();
          $('#datepicker2_oen').focus();
          e.preventDefault();
        }
      });
    });
  </script>
  {{-- Shift + Enter to Close Alert Message Ends Here --}}

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var billingDataCreationLink = document.createElement("script");
      billingDataCreationLink.type = "text/javascript";
      billingDataCreationLink.src = "{{ asset('js/sales/billing_data_creation/billing_data_creation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(billingDataCreationLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  {{-- <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-3.5.0.js" type="text/javascript"></script> --}}
  
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

  <script>
    $(document).ready(function(){
      $(".customalert, .loading-icon").hide();
      $("#contenthide").click(function(){
        $(".customalert,.loading-icon").toggle();
      });
    });
  </script>
  <script type="text/javascript">
    // Start
     $('.datePicker1_1').datepicker({
    language: 'ja-JP',
    format: 'yyyy/mm/dd',
    autoHide: true,
    zIndex: 10,
    offset: 6,
  });

  $(document).on('change focus', '.datePicker1_1', function () {
    // if ($(this).is('[readonly]')) {
    //   $(this).datepicker('hide');
    //   $(this).css("pointer-events", "none");
    // }
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

  $(document).on('click', '.datePicker1_1', function () {
    $(this).datepicker('show');
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

  //Enter press hide calendar
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
  });

  $(document).on('change focus', '.datePicker1_2', function () {
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

  $(document).on('click', '.datePicker1_2', function () {
    $(this).datepicker('show');
  });

  $(document).on('keyup', '.datePicker1_2', function (e) {
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
  $(document).on('blur', '.datePicker1_2', function () {
    if ($(this).val() != '') {
      $(this).val($(this).siblings('.datePickerHidden').val());
    } else if ($(this).val() == '') {
      $(this).val('');
      $(this).siblings('.datePickerHidden').val('');
    }
  });

  //Enter press hide calendar
  $(".datePicker1_2").keydown(function (e) {
    if (e.keyCode == 13) {
      $(".datePicker1_2").datepicker('hide');
    }
  });
  
  //Click to hide calendar
  $("#add_icon").click(function () {
      $(".datePicker1_1").datepicker('hide');
      $(".datePicker1_2").datepicker('hide');
  });
  </script>
</body>

</html>