
@section('title', '請求残高一覧')
@section('menu-test1', 'ホーム')
@section('menu-test3', '＞ 売上請求')
@section('menu-test5', '＞ 請求残高一覧')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('sales.billingBalanceList.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    
    @php
    if(isset($billingBalanceListInfo)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $billingBalanceListInfo->currentPage();
        $per_page = $billingBalanceListInfo->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($billingBalanceListInfo->items());
        $total = $billingBalanceListInfo->total();
        $lastPage = $billingBalanceListInfo->lastPage() ;
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
    @endphp

      {{-- First Part starts here --}}
      @include('sales.billingBalanceList.billingBalanceListTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('sales.billingBalanceList.billingBalanceListMainContent')
     {{-- Second Part Ends here --}}
   

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{-- @include('sales.billingBalanceList.modal')--}}
  <!-- end  modal  here-->
  <!-- Start search modal -->
  @include('common.supplierModal_2')
  <!-- end search modal -->

  <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('sales.billingBalanceList.script')
 {{-- Including Scripts Ends Here --}}
 <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/sales/billing_balance_list/billingBalanceList.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
   <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('billingBalanceListTableSetting',$bango)}}')");
      });
  </script>

</body>

</html>