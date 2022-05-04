@section('title', '定期定額契約一覧・照会')
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

@include('flatRateContract.fixedRateContract.styles')

<body class="common-nav common-navbar" style="overflow-x:visible;" id="datehideinscroll">
<section>

    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
            @php
                if(isset($allFixedRateContract)){
                    $skip = 0;
                    $old = array();
                    if(session()->has('oldInput'.$bango)){
                      $old = session()->get('oldInput'.$bango);
                    }
                    $current_page =$allFixedRateContract->currentPage();
                    $per_page = $allFixedRateContract->perPage();
                    $first_data = ($current_page - 1)*$per_page+1;
                    $last_data = ($current_page - 1)*$per_page+ sizeof($allFixedRateContract->items());
                    $total = $allFixedRateContract->total();
                    $lastPage = $allFixedRateContract->lastPage() ;
                }else{
                    $current_page = 1;
                    $per_page = 20;
                    $first_data = 1;
                    $last_data = 0;
                    $total = 0;
                    $lastPage = 1;
                }
            @endphp
            @include('flatRateContract.fixedRateContract.top-search')
            @include('flatRateContract.fixedRateContract.content')
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
    <!--  goto order inquiry page -->
    <form action="{{route('fixedRateInquiry')}}" method="POST" target="_blank" id="goToFixedRateInquiry">
        @csrf
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="datachar07" name="datachar07" >
    </form>
    <!--  goto order inquiry page -->
    
    <!--  goto order entry page -->
    <form action="{{route('flatRateEntry')}}" method="POST" target="_blank" id="goToFlatRateEntry" >
      @csrf
      <input type="hidden" id="userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="flatRateNumber" name="flat_rate_number">
    </form>
  <!--  goto order entry page -->
  
  </section>
<!-- Table Header Settings Modal Starts Here -->
@include('master.common.table_settings_modal')
<!-- Table Header Settings Modal Ends Here -->

<!-- Supplier Modal start here -->
@include('common.supplierModal_2')
<!-- Supplier Modal end here -->

<!-- Including Common Footer Links Starts Here -->
@include('layouts.footer')
<!-- Including Common Footer Links Ends Here -->

<script>
    $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('fixedRateTableSetting',$bango)}}')");
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
<script>
// Modal first focus....
$(document).on('shown.bs.modal', function(e) {
    $('[autofocus]', e.target).focus();
});
</script>
{{-- Knockout - Enter to New Input Ends Here --}}

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var fixedRateContacts = document.createElement("script");
    fixedRateContacts.type = "text/javascript";
    fixedRateContacts.src = "{{ asset('js/flatRateContract/fixedRateContracts/fixed_rate_contract.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fixedRateContacts);
</script>
<script type="text/javascript">
    var fixedRateContactsDev = document.createElement("script");
    fixedRateContactsDev.type = "text/javascript";
    fixedRateContactsDev.src = "{{ asset('js/flatRateContract/fixedRateContracts/fixed_rate_contract_dev.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fixedRateContactsDev);
</script>
<!-- Hard reload js link ends here -->

{{-- Table Column Selection Starts Here --}}
@include('master.common.table_column_selection')
{{-- Table Column Selection Ends Here --}}
</body>

</html>
