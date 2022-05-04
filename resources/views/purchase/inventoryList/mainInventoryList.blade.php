
@section('title', '在庫一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '在庫一覧')
@section('tag-test', 'ここは、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.inventoryList.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>

  
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.inventoryList.inventoryListTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.inventoryList.inventoryListMainContent')
     {{-- Second Part Ends here --}}
      

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>


  <!-- Start  modal  here-->
  {{--@include('purchase.inventoryList.modal')--}}
  <!-- end  modal  here-->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  {{-- Including Scripts Starts Here --}}
  @include('purchase.inventoryList.script')
 {{-- Including Scripts Ends Here --}}
 <script type="text/javascript">
      var fileinventoryList = document.createElement("script");
      fileinventoryList.type = "text/javascript";
      fileinventoryList.src = "{{ asset('js/purchase/inventoryList/inventoryList.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileinventoryList);
  </script>
 <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('inventoryListTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>