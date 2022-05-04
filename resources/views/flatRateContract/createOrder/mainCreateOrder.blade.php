@section('title', ' 定期定額→受注データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 定期定額契約  >')
@section('menu-test5', ' 定期定額→受注データ作成')
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
  
  {{-- Common Style Starts Here --}}
  @include('flatRateContract.createOrder.styles')
  {{-- Common Style Ends Here --}}

</head>


<body class="common-nav" style="overflow-x:visible;">

     <!-- preloader start here -->
    <div class="preloader">
      <div class="loading" style="display: none"></div>
    </div>
    <!-- preloader end here -->

    <section>
      @include('layout.nav_fixed')
      <form id="insertData">
        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
          <div class="content-head-section">
            <div class="container position-relative">

              <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
              <input type="hidden" name="bango" id="userId" value="{{$bango}}">
              <input id='submit_confirmation' value='' type='hidden'/>

              <div class="row order_entry_topcontent ">
                <div class="col">

                    {{-- Success Message Starts Here --}}
                    <div id="success_msg">
                    </div>
                    {{-- Success Message Ends Here --}}
                    
                    {{-- No Order Create Message Starts Here --}}
                    @if(Session::has('no_order_create_msg'))
                    @php
                    $no_order_create_msgs = session()->get('no_order_create_msg');
                    @endphp
                    <p class="common_error">作成する受注データの売上日が売上確定日以前のため、受注データは作成できません。</p>
                    @foreach($no_order_create_msgs as $key=>$val)
                    <p class="common_error">{{$val}}</p>
                    @endforeach
                    @endif
                    {{-- No Order Create Message Ends Here --}}
                    
                    <!-- No Data Message -->
                    @if(Session::has('no_data_msg'))
                    @php
                    $no_data_msg = session()->get('no_data_msg');
                    @endphp
                    <p class="common_error">{{$no_data_msg}}</p>
                    @endif

                    {{-- Error Message Starts Here --}}
                    <div id="error_data" class="common_error"></div>
                    {{-- Error Message Ends Here --}}

                  <div class="content-head-top inner-top-content">
                    
                    <!-- Top search common pull-down layout -->
                    @include('layout.commonOfficeDeptGroup')
                      
                    <div class="row mb-2" style="padding-top: 0px;">
                        <div class="col-5">
                          <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                            <tbody>
                              <tr>
                                <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left:0px!important;">
                                  <div class="line-icon-box float-left mr-3"></div>売上日
                                </td>
                                  <td style="border: none!important;width: 110px;">
                                    @php
                                    $previous_date = date('Y-m-d', strtotime("-1 Months"));
                                    $previous_year = explode("-",$previous_date)[0];
                                    $previous_month = explode("-",$previous_date)[1];
                                    $previous_day = explode("-",$previous_date)[2];
                                    $kanryoubi_start = $previous_year.'/'.$previous_month.'/'.$previous_day;
                                    @endphp
                                    <div class="input-group">
                                        <input name="kanryoubi_start" type="text" class="form-control" id="datepicker1_oen"
                                      oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                      maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                      value="{{$kanryoubi_start}}">
                                    <input type="hidden" class="datePickerHidden">
                                  </div>
                                  </td>
                                  <style>
                                    span#calInfo {
                                          position: absolute;
                                          left: 0;
                                          right: 0;
                                          height: 27px;
                                          width: 105px;
                                          background: transparent;
                                          display: block;
                                          border-radius: 4px;
                                      }
                                  </style>
                                  <td style="width: 30px!important;border:0!important;text-align: center;">
                                    ～
                                  </td>
                                  <td style="border: none!important;width: 110px;">
                                     <div class="input-group">
                                    <input name="kanryoubi_end" type="text" class="form-control" id="datepicker2_oen"
                                      oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                      maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                      value="{{date('Y/m/d')}}">
                                    <input type="hidden" class="datePickerHidden">
                                  </div>
                                  </td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                          <div class="col-6">
                          </div>
                          <div class="col-1"></div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                             <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                              <tbody>
                                <tr>
                                  <td style="border: none!important;text-align: left;color: black;width:94px !important;padding-left:0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>売上請求先
                                  </td>
                                  <td style="border: none!important;width: 350px;">
                                        <div id="information2_1_err" class="input-group input-group-sm position-relative custom_modal_input">
                                            <input name="db_information2_start" id="reg_db_information2_start" type="hidden"/>
                                            <input name="information2_start" id="reg_information2_start" type="text" readonly class="form-control"  placeholder="売上請求先" style="width: 94px!important;padding-left: 0px !important;">
                                            <div class="input-group-append" id="modalarea" data-toggle="modal" data-target="#search_modal4" style="margin-left:0px;">
                                               <button onclick="supplierSelectionModalOpener_2('reg_information2_start','reg_db_information2_start','1','required','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                      ～
                                    </td>
                                    <td style="border: none!important;width: 354px;">
                                        <div id="information2_2_err" class="input-group input-group-sm position-relative custom_modal_input">
                                           <input name="db_information2_end" id="reg_db_information2_end" type="hidden"/>
                                            <input name="information2_end" id="reg_information2_end" type="text" readonly class="form-control" placeholder="売上請求先" style="padding-left: 0px !important;width: 80px;">
                                            <div class="input-group-append" id="modalarea" data-toggle="modal" data-target="#search_modal4"  style="margin-left:0px;">
                                              <button onclick="supplierSelectionModalOpener_2('reg_information2_end','reg_db_information2_end','1','required','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                            </div>
                                        </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-12">
                              <button onclick="createOrder();event.preventDefault();" type="submit" class="bg-teal btn-info btn uskc-button float-right">データ作成</button>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- supplier modal -->
      @include('common.supplierModal_2')

      @include('layout.footer_new')
      </form>
    </section>


  {{-- @include('layout.bottom_link') --}}
  @include('layouts.footer')
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
  {{-- Knockout - Enter to New Input Ends Here --}}
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var createOrderLink = document.createElement("script");
      createOrderLink.type = "text/javascript";
      createOrderLink.src = "{{ asset('js/flatRateContract/createOrder/create_order.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(createOrderLink);
  </script>
  <!-- Hard reload js link ends here -->


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

<!-- chalender js -->
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
      if ($(this).is('[readonly]')) {
        $(this).datepicker('hide');
        $(this).css("pointer-events", "none");
      }
      else if ($(this).val().length == 10) {
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
      startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    // $('#datepicker2_oen').on('change focus', function () {
    //   if ($(this).val().length == 10) {
    //     $(this).siblings('.datePickerHidden').val($(this).val());
    //     let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
    //     let formatted_date = datevalue.replaceAll('/', '')
    //     $(this).val(formatted_date);
    //     $(this).focus(); //focusing current input on select
    //     $(this).datepicker('hide');
    //   }
    // });
    $(document).on('change focus', '#datepicker2_oen', function () {
    if ($(this).is('[readonly]')) {
      $(this).datepicker('hide');
      $(this).css("pointer-events", "none");
    }
    else if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '');
        $(this).val(formatted_date);
        $(this).focus();
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
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#datepicker1_oen").datepicker('hide');
    $("#datepicker2_oen").datepicker('hide');
  });
</script>

<script type="text/javascript">

</script>

<script type="text/javascript">
    $("#modalarea").on('click', function(){
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
      });

  $("#modalarea").on("click", function(){
  // $('.modal-backdrop').remove();
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
      ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, a.btn, a.checkall, tr.trfocus', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, a.checkall, tr.trfocus').filter(':visible');
              var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
              next = focusable.eq(nextIndex);
              next.focus();
              return false;
            }
          });
        }
      };
      ko.applyBindings({});
    </script>
    <script>
       //Modal first field focus....
       $(document).on('shown.bs.modal', function(e) {
          $('[autofocus]', e.target).focus();
        });
    </script>
</body>

</html>
