@section('title', '発注一覧・発注書')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '発注 >')
@section('menu-test5', '発注一覧・発注書')

<!DOCTYPE html>
<html lang="ja">

<head>
    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}
    {{-- Including CSS Starts Here --}}
    @include('purchase.purchaseOrder.styles')
    {{-- Including CSS Ends Here--}}
</head>

<body class="common-nav" style="overflow-x:visible;">
    <section>
        {{-- Navbar Starts Here --}}
        @include('layout.nav_fixed')
        {{-- Navbar Ends Here --}}
        @include('layout.custom_checkbox')

        <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
            <!-- ============================= Top Search start here ===================== -->
            @include('purchase.purchaseOrder.purchaseOrderTopSearch')
            <!-- ============================= Top Search end here ======================= -->

            <!-- ============================= Main Content start here ===================== -->
            @include('purchase.purchaseOrder.purchaseOrderMainContent')
            <!-- ============================= Main Content end here ======================= -->
            <form action="{{route('downloadPurchaseOrderPdf')}}" method="POST" target="" id="DownloadPurchaseOrderPdfForm">
                @csrf
                <input type="hidden" id="userId" name="userId" value="{{$bango}}">
                <input type="hidden" name="pdfName" id="pdfName" />
                <input type="hidden" name="pdfOrderNo" id="pdfOrderNo" />
                <input type="hidden" name="pdfCorrectionNo" id="pdfCorrectionNo" />
            </form>
        </div>
        <!-- Table Header Settings Modal Starts Here -->
        @include('master.common.table_settings_modal')
        <!-- Table Header Settings Modal Ends Here -->
        <!-- Supplier Modal start here -->
        @include('common.supplierModal_2')
        <!-- Supplier Modal end here -->
        {{-- Footer Starts Here --}}
        @include('layout.footer_new')
        {{-- Footer end Here --}}
    </section>

    <!-- Including Common Footer Links Starts Here -->
    @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->

    <!-- =============================Email Modal start here ===================== -->
    @include('purchase.purchaseOrder.purchaseOrderEmailModal')
    <!-- =============================Email Modal end here ======================= -->

    {{-- common.js link include starts here --}}
    @include('layouts.common_js')
    {{-- common.js link include ends here --}}

    <script>
        // button click progress toggle......
    $(document).ready(function(){
        $(".progress").hide();
        $("#customprogress").click(function(){
            $(".progress").toggle();
        });
    });

    // button click Load icon toggle......
    $(document).ready(function(){
        $(".loading-icon").hide();
        $("#loading-icon").click(function(){
            $(".loading-icon").toggle();
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
    <!-- chalender js -->
    <script type="text/javascript">
        // Datepicker start heare....
    $('#datepicker1').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '#datepicker1'
    });

    $(document).on('change focus', '#datepicker1', function () {
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

    $(document).on('click', '#datepicker1', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker1', function (e) {
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
    $(document).on('blur', '#datepicker1', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    $('#datepicker2').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
        trigger: '#datepicker2'
    });

    $(document).on('change focus', '#datepicker2', function () {
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

    $(document).on('click', '#datepicker2', function () {
        $(this).datepicker('show');
    });

    $(document).on('keyup', '#datepicker2', function (e) {
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
    $(document).on('blur', '#datepicker2', function () {

        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val('');
        }
    });
    // Datepicker end heare....

    //Enter press hide dropdown...
    $(".input_field").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".input_field").datepicker('hide');
        }
    });
    </script>
    <script>
        $("#add_icon").click(function () {
        $("#datePicker1").datepicker('hide');
        $("#datePicker2").datepicker('hide');
    });
    </script>

    <script>
        $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
    </script>

    <!-- Hard reload js link -->
    <script type="text/javascript">
        var filepurchaseorder = document.createElement("script");
        filepurchaseorder.type = "text/javascript";
        filepurchaseorder.src = "{{ asset('js/purchase/purchaseOrder/purchaseOrder.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filepurchaseorder);
    </script>
    <!-- Hard reload js link end -->
    <script>
        $(document).ready(function () {
            $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseOrderTableSetting',$bango)}}')");
        });
    </script>
</body>

</html>
