@section('title', '入金消込')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', '入金消込')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.header')
</head>
@include('sales.depositApplication.style')
<body id="body" class="common-nav" style="overflow-x:visible;">

<!-- preloader start here -->
<div class="preloader">
    <div class="loading" style="display: none;"></div>
</div>
<!-- preloader end here -->
<script type="text/javascript">
    var no_check=0;
</script>
<section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <form id="mainForm" action="{{ route('depositApplication') }}" method="post">
            <input type="hidden"  id="page_name" value="depositApplication">
            <input type="hidden" id="userId" name="userId" value="{{$bango}}">
            <!-- <input type="hidden" id="changeStatus" value="0"> -->
            <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
              @csrf
            <div class="position-relative">

                <div class="container">
                    {{-- Success Message Starts Here --}}
                    @if(Session::has('success_msg_keshikomu'))
                    <div class="row success-msg-box" id="session_msg" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
                        <div class="col-12">
                            <div class="alert alert-primary alert-dismissible">
                                <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                                    onclick="$('#billing_address').focus();">
                                    &times;
                                </button>
                                <strong>{{session()->pull('success_msg_keshikomu') }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- Success Message Ends Here --}}

                    {{-- Error Message Starts Here --}}
                    <div id="error_data" class="common_error"></div>
                    {{-- Error Message Ends Here --}}
                    
                    <script>
                        // Focus on Alert Closing
                        $(".dismissMe").keydown(function(e) {
                            if (e.shiftKey && e.which == 13) {
                                $('.close').alert('close');
                                event.preventDefault();
                                document.getElementById("billing_address").click();
                                $('#billing_address').focus();
                            }
                        });
                    </script>
                </div>
                
                <div class="content-head-section1 inner-top-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                                    <tbody>
                                    <tr>
                                        <td class="text-render"
                                            style="border: none!important;color: black;width: 95px !important;padding-left:0px!important;">
                                            <div style="width: 91px;">
                                                <div class="line-icon-box float-left mr-3"></div>
                                                売上請求先
                                            </div>
                                        </td>
                                        <td style=" border: none!important;width: 443px;">
                                            <div>
                                                <div class="input-group input-group-sm custom_modal_input">
                                                    <input type="text" class="form-control billing_address"
                                                        id="billing_address" placeholder="売上請求先" readonly="" style="padding-left: 0px !important;padding-right: 0px !important;max-width:507px!important;" autofocus>
                                                    <input type="hidden" name="billing_address"
                                                        id="billing_address_db">
                                                    <div class="input-group-append">
                                                        <button type="button" class="input-group-text btn"
                                                                onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','nullable','r16cd',event.preventDefault())">
                                                            <i class="fas fa-arrow-left"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col">
                                        <table class="table custom-form custom-table"
                                            style="border: none!important;width: auto;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td
                                                    style="border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    入金予定額
                                                </td>
                                                <td style="border: none!important;width: 15px!important;"></td>
                                                <td
                                                    style="border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    ¥ <span id="expected_deposit_amount"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col">
                                        <table class="table custom-form" style="border: none!important;width: auto;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                    <div class="line-icon-box"></div>
                                                </td>
                                                <td
                                                    style="border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    消込可能額計
                                                </td>
                                                <td style="border: none!important;width: 15px!important;"></td>
                                                <td
                                                    style="border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                                    ¥ <span id="applicable_amount"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- container-fluid div end -->
                    <div class="content-bottom-top" style="margin-top: 20px;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bottom-top-title" style="letter-spacing: 15px;">
                                        入金明細
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-bottom-pagination">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <table style="width: 100%;">
                                            <tbody>
                                            <tr>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 10% !important;background: white;text-align: center;padding:5px;">
                                                    入金番号
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 6% !important;background: white;text-align: center;padding:5px;">
                                                    行
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 10% !important;background: white;text-align: center;padding:5px;">
                                                    入金日
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 10% !important;background: white;text-align: center;padding:5px;">
                                                    入金方法
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 10% !important;background: white;text-align: center;padding:5px;">
                                                    入金金額
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 6% !important;background: white;text-align: center;padding:5px;">
                                                    消込可能額
                                                </td>
                                                <td
                                                    style="border-right: 1px solid #dee2e6 !important;width: 27% !important;background: white;text-align: center;padding:5px;">
                                                    備考
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background: #efefef;padding-bottom: 10px;padding-top: 7px;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div id="div_payment_details">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background: white;padding:10px 0px 7px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    @include('sales.depositApplication.search-menu')
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <table class="table custom-form" style="border: none!important;width: 100%;float:right;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style="border: none!important;color: #000;font-weight: bold; font-size: 0.9em;">
                                                未入金額計
                                            </td>
                                            <td style="border: none!important;"></td>
                                            <td style="border: none!important;color: #000;font-weight: bold; font-size: 0.9em;width: 141px;">
                                                ¥<span id="unpaid_amount_total">0</span>
                                            </td>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style="border: none!important;color: #000;font-weight: bold; font-size: 0.9em;">
                                                入金金額計
                                            </td>
                                            
                                            <td style="border: none!important;color: #000;font-weight: bold; font-size: 0.9em;min-width:134px;">
                                                ¥<span id="deposit_amount_total">0</span>
                                            </td>
                                            <td style="border: none!important;border: none!important;display: flex;justify-content: flex-end">
                                                <div class="form-button">
                                                    <button type="button" id="fixed_record"  class="btn btn-sm btn-primary uskc-button">0引当</button>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-bottom-top">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bottom-top-title" style="letter-spacing: 15px;">
                                        消込対象売上
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-bottom-pagination">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="data-wrapper-content" style="width: 100%;">
                                            <div class="data-box-content"
                                                style="width: 4%; float: left;background-color:#666666;text-align: center;color:#fff;height: 58px;vertical-align: middle;border-radius: 5px 0px 5px;">
                                                <div style="padding: 23px 0px;">
                                                    行
                                                </div>
                                            </div>
                                            <div class="data-box-content2 text-center data-box-bg orderentry-databox"
                                                style="width: 96%;float: left;">
                                                <div style="width: 100%;float: left;">
                                                    <div
                                                        class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                                                        style="padding: 5px; width: 12%;">
                                                        受注番号
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 8%;">
                                                        担当
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 8%;">
                                                        売上日
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding:5px 5px; width: 42%;height: 29px;">
                                                        受注件名
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 10%;">
                                                        消込対象額
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0"
                                                        style="padding: 5px; width: 10%;">入金金額
                                                    </div>
                                                </div>
                                                <div style="width:100%;">
                                                
                                                <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width:12%;">
                                                        売上番号
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 8%;">
                                                        即時区分
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 8%;">
                                                        入金日
                                                    </div> 
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 42%;">受注先
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 10%;">未入金
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 10%;">入金残高
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                                        style="padding: 5px; width: 5%;">前受区分
                                                    </div>
                                                    <div class="data-box float-left border border-bottom-0"
                                                        style="padding: 5px; width: 5%;">売済区分
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="content-bottom-pagination" style="background: #efefef;padding-top: 7px;">
                        <div class="container">
                        <div class="row mt-2" id="div_sales_subject">

                        </div>
      
                        </div>
                    </div>
                </div>
                <div class="content-bottom-pagination pt-3" style="padding-bottom: 105px;background: #efefef; margin-top: 124px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-7">
                                <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                    <tbody>
                                    <tr>
                                        <td style=" border: none!important;">
                                            <div class="form-button">
                                                <button onclick="updateDepositAppData('{{route('updateDepositApplication')}}',event.preventDefault())" type="button" disabled="disabled" id="choice_button" class="btn btn-sm btn-primary uskc-button">登録</button>
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
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
</section>
@include('common.supplierModal_2')
<!-- Including Common Footer Links Starts Here -->
@include('layouts.footer')
<!-- Including Common Footer Links Ends Here -->
<script src="{{asset('js/moment.min.js')}}"></script>
<script>
    // click button load icon toggle......
    
    // click button load icon toggle......
</script>
<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var depositApplicationLink = document.createElement("script");
    depositApplicationLink.type = "text/javascript";
    depositApplicationLink.src = "{{ asset('js/sales/deposit_application/deposit_application.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositApplicationLink);
</script>
<script type="text/javascript">
    var depositApplicationDevLink = document.createElement("script");
    depositApplicationDevLink.type = "text/javascript";
    depositApplicationDevLink.src = "{{ asset('js/sales/deposit_application/deposit_application_dev.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositApplicationDevLink);
</script>
<script type="text/javascript">
    var salesSubjectLink = document.createElement("script");
    salesSubjectLink.type = "text/javascript";
    salesSubjectLink.src = "{{ asset('js/sales/deposit_application/sales_subject.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(salesSubjectLink);
</script>
<!-- Hard reload js link ends here -->
<script>
    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
    });
</script>
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
 
</body>

</html>
