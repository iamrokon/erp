@section('title', '入金消込履歴一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '入金消込履歴一覧')

<!DOCTYPE html>
<html lang="ja">

<head>
 {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
 {{-- Including Common Header Ends Here--}}
 {{-- Including CSS Starts Here --}}
 @include('sales.depositHistoryList.styles')
 {{-- Including CSS Ends Here--}}
</head>

<body class="common-nav" style="overflow-x:visible;">
  <section>
  {{-- Navbar Starts Here --}}
	@include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    @php
        if(isset($allDepositHistoryList)){
            $skip = 0;
            $old = array();
            if(session()->has('oldInput'.$bango)){
              $old = session()->get('oldInput'.$bango);
            }
            $current_page =$allDepositHistoryList->currentPage();
            $per_page = $allDepositHistoryList->perPage();
            $first_data = ($current_page - 1)*$per_page+1;
            $last_data = ($current_page - 1)*$per_page+ sizeof($allDepositHistoryList->items());
            $total = $allDepositHistoryList->total();
            $lastPage = $allDepositHistoryList->lastPage() ;
        }else{
            $current_page = 1;
            $per_page = 20;
            $first_data = 1;
            $last_data = 0;
            $total = 0;
            $lastPage = 1;
        }
    @endphp
        @include('sales.depositHistoryList.top-search')
        @include('sales.depositHistoryList.content')
    </div>
 {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}
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
  <script src="{{asset('js/moment.min.js')}}"></script>
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('depositHistoryListTableSetting',$bango)}}')");
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
  
  {{-- Table Column Selection Starts Here --}}
  @include('master.common.table_column_selection')
  {{-- Table Column Selection Ends Here --}}
  
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var depositHistoryListLink = document.createElement("script");
      depositHistoryListLink.type = "text/javascript";
      depositHistoryListLink.src = "{{ asset('js/sales/deposit_history_list/deposit_history_list.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(depositHistoryListLink);
  </script>
  <script type="text/javascript">
    var depositHistoryListDevLink = document.createElement("script");
      depositHistoryListDevLink.type = "text/javascript";
      depositHistoryListDevLink.src = "{{ asset('js/sales/deposit_history_list/deposit_history_list_dev.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(depositHistoryListDevLink);
  </script>
  <!-- Hard reload js link ends here -->
  <script>
    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });
  </script>
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $("#disposal_day_start ").datepicker('hide');
      $("#disposal_day_end").datepicker('hide');
      $("#payment_day_start ").datepicker('hide');
      $("#payment_day_end").datepicker('hide');
    });
  </script>
</body>

</html>
