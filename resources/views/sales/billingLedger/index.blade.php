@section('title', '得意先元帳（社外）')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', '得意先元帳（社外）')

    <!DOCTYPE html>
    <html lang="ja">

    <head>
        {{-- Including Common Header Starts Here --}}
        @include('layouts.header')
        {{-- Including Common Header Ends Here --}}
    </head>
    @include('sales.billingLedger.style')

    <body class="common-nav" style="overflow-x: visible;">
        {{-- Navbar Starts Here --}}
        @include('layout.nav_fixed')
        {{-- Navbar Ends Here --}}
        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
            @php
                if (isset($allBillingLedger)) {
                    $skip = 0;
                    $old = [];
                    if (session()->has('oldInput' . $bango)) {
                        $old = session()->get('oldInput' . $bango);
                    }
                    $current_page = $allBillingLedger->currentPage();
                    $per_page = $allBillingLedger->perPage();
                    $first_data = ($current_page - 1) * $per_page + 1;
                    $last_data = ($current_page - 1) * $per_page + sizeof($allBillingLedger->items());
                    $total = $allBillingLedger->total();
                    $lastPage = $allBillingLedger->lastPage();
                } else {
                    $current_page = 1;
                    $per_page = 20;
                    $first_data = 1;
                    $last_data = 0;
                    $total = 0;
                    $lastPage = 1;
                }
            @endphp
            @include('sales.billingLedger.top-search')
            @include('sales.billingLedger.content')
        </div>
        {{-- Footer Starts Here --}}
        @include('layout.footer_new')
        {{-- Footer Ends Here --}}
        <!-- Table Header Settings Modal Starts Here -->
        @include('master.common.table_settings_modal')
        <!-- Table Header Settings Modal Ends Here -->

        <!-- Supplier Modal start here -->

        @include('common.supplierModal_2')
        <!-- Supplier Modal end here -->



        <!-- <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"> -->

        <!-- Including Common Footer Links Starts Here -->
        @include('layouts.footer')
        <!-- Including Common Footer Links Ends Here -->
        {{-- Knockout - Enter to New Input Starts Here --}}
        {{-- @include('master.common.knockout') --}}
        <script>
            $(document).ready(function() {
                $('#openSettingModal').attr('onclick',
                    "showTableSetting('{{ route('billingLedgerTableSetting', $bango) }}')");
            });
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
              $("#ledger_year_start").datepicker('hide');
              $("#ledger_year_end").datepicker('hide');
            });
          </script>
    
        <script>
            // Enter key press auto focus next input......
            ko.bindingHandlers.nextFieldOnEnter = {
                init: function(element, valueAccessor, allBindingsAccessor) {
                    $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function(e) {
                        var self = $(this),
                            form = $(element),
                            focusable, next;
                        if (e.keyCode == 13 && !e.shiftKey) {
                            focusable = form.find(
                                'input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn'
                            ).filter(':visible');
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
        
        {{-- Knockout - Enter to New Input Ends Here --}}
        <script src="{{ asset('js/sales/billing_ledger/billing_ledger.js') }}"></script>
        <script src="{{ asset('js/sales/billing_ledger/billing_ledger_dev.js') }}"></script>


    </body>

    </html>
