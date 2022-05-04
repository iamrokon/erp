@section('title', ' 指定納品書（伝発名人クラウド）')
@section('menu-test1', 'ホーム')
@section('menu-test3', '＞ 売上請求')
@section('menu-test5', '＞ 指定納品書（伝発名人クラウド）')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        @include('layouts.header')

        <!-- including CSS Starts Here -->
        @include('sales.deliveryNote.styles')
        <!-- including CSS ends Here -->

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body class="common-nav" style="overflow-x:visible;">
        <!-- preloader start here -->
        <div class="preloader">
            <div class="loading" style="display: none"></div>
        </div>
        <!-- preloader end here -->
        <section>
            @include('layout.nav_fixed')
            {{-- @include('layout.custom_checkbox') --}}
            <form id="delivery_note_data">
                <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
                    <!-- content head section start -->
                    <div class="content-head-section">
                        <div class="container position-relative" id="delivery_note">

                            {{-- Success Message Starts Here --}}
                            @if (Session::has('success_msg'))
                                <div class="row success-msg-box" id="session_msg"
                                    style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                                    <div class="col-12 pl-0 pr-0 ml-3">
                                        <div class="alert alert-primary alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                autofocus>&times;</button>
                                            <strong>{{ session()->get('success_msg') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Success Message Ends Here --}}
                            {{-- Error Message Starts Here --}}
                            <div id="error_data" class="common_error"></div>
                            {{-- Error Message Ends Here --}}

                            <div class="row inner-top-content">
                                <div class="col-12">
                                    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
                                    <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
                                    <input type="hidden" name="confirm_status" value=0 id="confirm_status">
                                    <div class="content-head-top">
                                        @include('layout.commonOfficeDeptGroup')
                                        <div class="row">
                                            <div class="col">
                                                <table class="table custom-form "
                                                    style="border: none!important;width: auto;">
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 65px!important;">売上日
                                                            </td>
                                                            <td style=" border: none!important;width: 122px;">
                                                                <div class="data-box float-left"
                                                                    style="padding: 5px; padding-right: 0; width: 122px;">
                                                                    <div class="input-group">
                                                                        <input type="text"
                                                                            class="form-control order_date_start datePicker"
                                                                            id="datepicker1_oen" name="order_date_start"
                                                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            maxlength="10" autocomplete="off"
                                                                            placeholder="年/月/日"
                                                                            style="width: 96px!important;" value="" />
                                                                        <input type="hidden" class="datePickerHidden">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td
                                                                style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                                                ～
                                                            </td>
                                                            <td style=" border: none!important;width: 122px;">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        class="form-control order_date_end datePicker"
                                                                        id="datepicker2_oen" name="order_date_end"
                                                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                        maxlength="10" autocomplete="off"
                                                                        placeholder="年/月/日" style="width: 96px!important;"
                                                                        value="" />
                                                                    <input type="hidden" class="datePickerHidden">
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="ml-3 mr-3">
                                                <table class="table custom-form"
                                                    style="border: none!important;width: auto;">
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 71px!important;">受注先
                                                            </td>
                                                            <td style=" border: none!important;">
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text"
                                                                        class="form-control contractor custom_modal_input"
                                                                        name="contractor" id="contractor" readonly=""
                                                                        placeholder="受注先" style="padding: 0!important;">
                                                                    <input type="hidden" name="contractor_db"
                                                                        class="contractor_db" id="contractor_db">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="input-group-text btn"
                                                                            onclick="supplierSelectionModalOpener_2('contractor','contractor_db','1','nullable','r16cd',null,event.preventDefault())">
                                                                            <i class="fas fa-arrow-left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 65px!important;">売上請求先
                                                            </td>
                                                            <td style=" border: none!important;">
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text"
                                                                        class="form-control billing_address custom_modal_input"
                                                                        name="billing_address" id="billing_address"
                                                                        readonly="" placeholder="売上請求先"
                                                                        style="padding: 0!important;">
                                                                    <input type="hidden" class="billing_address_db"
                                                                        name="billing_address_db" id="billing_address_db">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="input-group-text btn"
                                                                            onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','nullable','r16cd',null,event.preventDefault())">
                                                                            <i class="fas fa-arrow-left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <table class="table custom-form"
                                                    style="border: none!important;width: auto;">
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 71px!important;">売上区分
                                                            </td>
                                                            <td style=" border: none!important;width: 178px;">
                                                                <div class="custom-arrow">
                                                                    <select class="form-control creation_category"
                                                                        name="creation_category" id="request">
                                                                        <option value="">-</option>
                                                                        @foreach ($categorykanriesU5 as $categoryKanri)
                                                                            <option
                                                                                value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-3">
                                                <table class="table custom-form"
                                                    style="border: none!important;width: auto;">
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 53px!important;">発行区分
                                                            </td>
                                                            <td style=" border: none!important;width: 178px">
                                                                <div class="custom-arrow">
                                                                    <select class="form-control issuance_classification"
                                                                        autofocus="" name="issuance_classification"
                                                                        id="issuance_classification">
                                                                        <option value="1">1 済</option>
                                                                        <option value="2" selected>2 未</option>
                                                                        <option value="3">3 すべて</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <table class="table custom-form"
                                                    style="border: none!important;width: auto;margin-bottom: 0!important;">
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                <div class="line-icon-box"></div>
                                                            </td>
                                                            <td style=" border: none!important;width: 65px!important;">
                                                                売上伝票番号</td>
                                                            <td style=" border: none!important;width: 122px;">
                                                                <div class="input-group">
                                                                    <!-- <input placeholder="9999999999" type="text" class="form-control"  style="width: 174px!important;color:#000;"> -->
                                                                    <input placeholder="9999999999" type="text"
                                                                        name="sales_slip_number_start"
                                                                        id="sales_slip_number_start"
                                                                        class="form-control input1 sales_slip_number_start"
                                                                        style="width: 168px!important;color:#000;"
                                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                        maxlength="10" autocomplete="off">
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="width: 40px!important;border:0!important;text-align: center;">
                                                                ～
                                                            </td>
                                                            <td style=" border: none!important;width: 122px;">
                                                                <div class="input-group">
                                                                    <!-- <input  placeholder="9999999999" type="text" class="form-control" autocomplete="off" style="width: 174px!important;color:#000;"> -->
                                                                    <input placeholder="9999999999" type="text"
                                                                        class="form-control input2 sales_slip_number_end"
                                                                        autocomplete="off" name="sales_slip_number_end"
                                                                        id="sales_slip_number_end"
                                                                        style="width: 174px!important;color:#000;"
                                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                        maxlength="10" autocomplete="off">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-5"></div>
                                            <div class="col-7">
                                                <div class="" style="text-align:right;margin-top:27px;">
                                                    <button type="button" id="loading-icon"
                                                        class="btn btn-info uskc-button btn-m-view create_csv"
                                                        style="margin-right:5px;">作成
                                                    </button>
                                                    <button type="button"
                                                        class="btn uskc-button btn-info btn-view btn-m-view download_csv"
                                                        style="margin-right:5px;">CSVエクスポート
                                                    </button>
                                                    {{-- <div class="link-hover"> --}}
                                                    <button type="button" style="" id="contenthide"
                                                        class="btn btn-info uskc-button btn-view btn-m-view delete_csv">エクスポート完了
                                                    </button>
                                                    {{-- </div> --}}
                                                </div>
                                                {{-- <div class="loading-icon" style="display: none;"> --}}
                                                {{-- <span style="font-size: 30px;float: right;"> --}}
                                                {{-- <i class="fa fa-spinner" aria-hidden="true"></i> --}}
                                                {{-- </span> --}}
                                                {{-- </div> --}}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <!-- content head section end -->

            </div>

            </div>
        </section>
        @include('layout.footer_new')
        @include('common.supplierModal_2')
        {{-- <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

        <script>
            ko.bindingHandlers.nextFieldOnEnter = {
                init: function(element, valueAccessor, allBindingsAccessor) {
                    // $(element).on('keydown', 'input, textarea, select, button, a.btn, .btn, tr.trFocus', function (e) {
                    $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trfocus', function(e) {
                        var self = $(this),
                            form = $(element),
                            focusable, next;
                        if (e.keyCode == 13 && !e.shiftKey) {
                            // focusable = form.find('input:not([ignore]), select, textarea, button, a.btn, .btn, tr.trFocus').filter(':visible');
                            focusable = form.find(
                                'input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trfocus'
                            ).filter(':visible');
                            var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(
                                this) + 1;
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
        Knockout - Enter to New Input Ends Here --}}

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
        <script src="{{ asset('js/jquery.clone.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        {{-- <script src="{{asset('js/jquery.filedownload.min.js')}}"></script> --}}

        <!-- Hard reload js link starts here -->
        <script type="text/javascript">
            var deliveryNoteLink = document.createElement("script");
            deliveryNoteLink.type = "text/javascript";
            deliveryNoteLink.src = "{{ asset('js/sales/delivery_note/delivery_note.js') }}?v=" + Math.floor((Math.random() *
                500) + 1);
            document.getElementsByTagName("head")[0].appendChild(deliveryNoteLink);
        </script>
        <script type="text/javascript">
            var deliveryNoteDevLink = document.createElement("script");
            deliveryNoteDevLink.type = "text/javascript";
            deliveryNoteDevLink.src = "{{ asset('js/sales/delivery_note/delivery_note_dev.js') }}?v=" + Math.floor((Math
                .random() * 500) + 1);
            document.getElementsByTagName("head")[0].appendChild(deliveryNoteDevLink);
        </script>
        <script type="text/javascript">
            var deliveryNoteCSVLink = document.createElement("script");
            deliveryNoteCSVLink.type = "text/javascript";
            deliveryNoteCSVLink.src = "{{ asset('js/sales/delivery_note/delivery_note_csv.js') }}?v=" + Math.floor((Math
                .random() * 500) + 1);
            document.getElementsByTagName("head")[0].appendChild(deliveryNoteCSVLink);
        </script>
        <!-- Hard reload js link ends here -->
        <script>
            //Click to hide calendar
            $("#add_icon").click(function () {
              $("#datepicker1_oen").datepicker('hide');
              $("#datepicker2_oen").datepicker('hide');
            });
        </script>
        <script>
            // Modal first focus....
            $(document).on('shown.bs.modal', function(e) {
                $('[autofocus]', e.target).focus();
            });
        </script>
        <script type="text/javascript">
            jQuery(function($) {
                var e = function() {
                    var e = (window.innerHeight > 5 ? window.innerHeight : this.screen.height) - 5;
                    (e -= 219) < 1 && (e = 1), e > 219 && jQuery(".fullpage_width1").css("min-height", e + "px")
                };
                jQuery(window).ready(e), jQuery(window).on("resize", e);
            });
        </script>
    </body>

    </html>
