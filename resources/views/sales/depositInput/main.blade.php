@section('title', '入金入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求>')
@section('menu-test5', '入金入力')
@section('tag-test', 'ここには、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">
<head>
    @include('layouts.header')
    @include('sales.depositInput.styles')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body class="common-nav" style="overflow-x:visible;">
<section>
    @include('layout.nav_fixed')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <form id="insertData">
            <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
            <input type="hidden" name="bango" id="userId" value="{{$bango}}">
            <input type="hidden" name="confirm_status" id="confirm_status" value="0">
            <input type="hidden" name="deleteLine">
            <input type="hidden" id="shinkuroKokyakugroupList">
            <input id='page_name' value='depositInput' type='hidden'/>
            <div class="content-head-section">
                <div class="container position-relative">
                    @if(Session::has('success_msg'))
                        <div class="row success-msg-box" id="session_msg" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible">
                                    <button type="button" class="close dismissMe" data-dismiss="alert" onclick="$('#creation_category').focus();" autofocus>
                                        &times;
                                    </button>
                                    <strong>{{session()->get('success_msg') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    <script>
                    // Focus on Alert Closing
                    $(".dismissMe").keydown(function (e) {
                        if (e.shiftKey && e.which == 13) {
                            $('.close').alert('close');
                            event.preventDefault();
                            document.getElementById("creation_category").click();
                            $('#creation_category').focus();
                        }
                    });
                    </script>

                    {{-- Error Message Starts Here --}}
                    <div id="error_data" class="common_error"></div>
                    {{-- Error Message Ends Here --}}

                    <div class="row order_entry_topcontent inner-top-content">

                        <div class="col">
                            <div class="content-head-top">

                                <div class="row">
                                    <div class="col-3 mb-1">
                                        <table class="table custom-form custom-table"
                                               style="border: none!important;width: auto;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 89px!important;">作成区分</td>
                                                <td style=" border: none!important;width: 178px;">
                                                    <div class="custom-arrow">
                                                        <select name="creation_category" id="creation_category"
                                                                class="form-control creation_category" autofocus="">
                                                            @foreach($creationCategories as $request)
                                                                <option
                                                                    value="{{$request->syouhinbango.' '.$request->jouhou}}">
                                                                    {{$request->syouhinbango.' '.$request->jouhou}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-3 mb-1">
                                        <table class="table custom-form custom-table"
                                               style="border: none!important;width: auto;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 53px!important;">入金番号</td>
                                                <td style=" border: none!important;width: 190px;">

                                                    <input type="text" name="deposit_number"
                                                           class="form-control deposit_number" id="deposit_number"
                                                           oninput="this.value = this.value.replace(/[^\d^\/]/g, '');"
                                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"

                                                           maxlength="10"
                                                    />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-3 mb-1">
                                        <table class="table custom-form"
                                               style="border: none!important;width: 100% !important;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 53px!important;">入金日</td>
                                                <td style="border: none!important;width: 151px;">
                                                    <div class="input-group">
                                                        <input autofocus="" type="text"
                                                               class="form-control datePicker payment_date"
                                                               id="payment_date" name="payment_date"
                                                               oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                               onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                               maxlength="10"
                                                               autocomplete="off" placeholder="年/月/日"
                                                               style="width: 96px!important;" value="">
                                                        <input type="hidden" class="datePickerHidden">
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <table class="table custom-form" style="border: none!important;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 89px!important;">売上請求先</td>
                                                <td style=" border: none!important;">
                                                    <div class="input-group input-group-sm custom_modal_input">
                                                        <input type="text" class="form-control billing_address"
                                                               id="billing_address" placeholder="売上請求先" readonly="" style="padding-left:0px!important;padding-right:0px !important; max-width:507px!important; ">
                                                        <input type="hidden" name="billing_address"
                                                               id="billing_address_db">
                                                        <div class="input-group-append">
                                                            <button type="button" class="input-group-text btn"
                                                                    onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','required','r16cd',null,event.preventDefault())">
                                                                <i class="fas fa-arrow-left"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-4">
                                        <table class="table custom-form"
                                               style="border: none!important;width: auto;margin-top: 8px;">
                                            <tbody>
                                            <tr style="">
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    入金予定額
                                                </td>
                                                <td style=" border: none!important;width: 15px!important;"></td>
                                                <input type="hidden" name="expected_deposit_amount" value="0">
                                                <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    ¥ <span id="expected_deposit_amount">0</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bottom-section" style="padding-bottom:46px!important;">
                <div class="content-bottom-top">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="bottom-top-title">
                                    入金明細
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="data-wrapper-content" style="width: 100%;">
                                    <div class="data-box-content"
                                         style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 33px;vertical-align: middle;border-radius: 5px 0px 5px;">
                                        <div style="padding: 6px;">
                                            行
                                        </div>
                                    </div>
                                    <div class="data-box-content2 text-center orderentry-databox"
                                         style="width: 90%;float: left;background: white;">
                                        <div style="width: 100%;float: left;background: white;">
                                            <div
                                                class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                                                style="padding: 5px; width: 11%;">
                                                入金方法
                                            </div>
                                            <div class="data-box float-left border border-bottom-0 border-right-0"
                                                 style="padding: 5px; width: 11%;">
                                                入金銀行
                                            </div>
                                            <div class="data-box float-left border border-bottom-0 border-right-0"
                                                 style="padding: 5px; width: 11%;">
                                                入金支店
                                            </div>
                                            <div class="data-box float-left border border-bottom-0 border-right-0"
                                                 style="padding: 5px; width: 10%;">
                                                入金金額
                                            </div>
                                            <div class="data-box float-left border border-bottom-0"
                                                 style="padding: 5px; width: 10%;">
                                                手形決済日
                                            </div>
                                            <div class="data-box float-left border border-bottom-0"
                                                 style="padding: 5px; width: 47%;">
                                                備考
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-bottom-bottom">
                    <div class="container">
                        @include('sales.depositInput.line-item')
                        <div id="last_row" class="row mt-3 ">
                            <div class="col-7"></div>
                            <div class="col-5">
                                <table class="table custom-form"
                                       style="border: none!important;width: auto;margin-top: 8px;">
                                    <tbody>
                                    <tr>
                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                            入金金額計
                                        </td>
                                        <td style=" border: none!important;width: 15px!important;"></td>
                                        <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                            ¥ <span id="total_deposit_amount">0</span></td>
                                        <input type="hidden" name="total_deposit_amount"value="0"/>
                                        <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                            <div style="background: white;float: right;">
                                                <div class="form-button">
                                                    <button type="button" id="registration"
                                                            class="btn btn-sm btn-primary uskc-button " style="width: 120px;">登録
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('layout.footer_new')
</section>

@include('common.supplierModal_2')
@include('sales.depositInput.delete_confirm_modal')

<!-- Footer common links starts here -->
@include('layouts.footer')
<!-- Footer common links Ends here -->
<script src="{{asset('js/jquery.clone.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/underscore.min.js')}}"></script>

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var depositInputLink = document.createElement("script");
    depositInputLink.type = "text/javascript";
    depositInputLink.src = "{{ asset('js/sales/deposit_input/deposit_input.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositInputLink);
</script>
<script type="text/javascript">
    var depositInputDevLink = document.createElement("script");
    depositInputDevLink.type = "text/javascript";
    depositInputDevLink.src = "{{ asset('js/sales/deposit_input/deposit_input_dev.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositInputDevLink);
</script>
<script type="text/javascript">
    var depositInputDetailLink = document.createElement("script");
    depositInputDetailLink.type = "text/javascript";
    depositInputDetailLink.src = "{{ asset('js/sales/deposit_input/deposit_input_detail.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositInputDetailLink);
</script>
<script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $("#payment_date").datepicker('hide');
    });
  </script>
<!-- Hard reload js link ends here -->

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
<script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });


</script>

</body>

</html>
