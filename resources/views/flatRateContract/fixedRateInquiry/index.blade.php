@section('title', '定期定額契約照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '定期定額契約 >')
@section('menu-test5', '定期定額契約一覧・照会')


<!DOCTYPE html>
<html lang="jp">

<head>
    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}
</head>
@include('flatRateContract.fixedRateInquiry.style')

<body class="common-navbar common-nav" style="overflow-x:visible;">
<section class="">
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}

    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        @include('flatRateContract.fixedRateInquiry.top-content')
        @include('flatRateContract.fixedRateInquiry.contract-details')
        @include('flatRateContract.fixedRateInquiry.split-display')
       </div>
    <!-- Footer Start Here -->
@include('layout.footer_new')
<!-- Footer End Here -->
</section>

@include('flatRateContract.fixedRateInquiry.include-modal.transaction-term')
@include('flatRateContract.fixedRateInquiry.include-modal.maintenance-conditions')
@include('flatRateContract.fixedRateInquiry.include-modal.order-shipping')
{{--@include('flatRateContract.fixedRateInquiry.include-modal.extra')--}}
<!-- Including Common Footer Links Start Here -->
@include('layouts.footer')
<!-- Including Common Footer Links End Here -->

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

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var fixedRateInquiryLink = document.createElement("script");
    fixedRateInquiryLink.type = "text/javascript";
    fixedRateInquiryLink.src = "{{ asset('js/flatRateContract/fixedRateInquiry/fixed-rate-inquiry.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fixedRateInquiryLink);
</script>
<!-- Hard reload js link ends here -->

</body>

</html>
