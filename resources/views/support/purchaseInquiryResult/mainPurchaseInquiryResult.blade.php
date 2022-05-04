
@section('title', '外注仕入実績照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', 'サポート>')
@section('menu-test5', '外注仕入実績照会')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('support.purchaseInquiryResult.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      @php
        if(isset($purchaseInquiryResultData)){
            $skip = 0;
            $old = array();
            if(session()->has('oldInput'.$bango)){
              $old = session()->get('oldInput'.$bango);
            }
            $current_page=$purchaseInquiryResultData->currentPage();
            $per_page=$purchaseInquiryResultData->perPage();
            $first_data= ($current_page - 1)*$per_page+1;
            $last_data=($current_page - 1)*$per_page+ sizeof($purchaseInquiryResultData->items());
            $total=$purchaseInquiryResultData->total();
            $lastPage=$purchaseInquiryResultData->lastPage();
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
      @include('support.purchaseInquiryResult.purchaseInquiryResultTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('support.purchaseInquiryResult.purchaseInquiryResultMainContent')
     {{-- Second Part Ends here --}}
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{--@include('support.purchaseInquiryResult.modal')--}}
  <!-- end  modal  here-->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('support.purchaseInquiryResult.script')
 {{-- Including Scripts Ends Here --}}
      
  <script type="text/javascript">
      var filepurchaseInquiryResult = document.createElement("script");
      filepurchaseInquiryResult.type = "text/javascript";
      filepurchaseInquiryResult.src = "{{ asset('js/support/purchaseInquiryResult/purchaseInquiryResult.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepurchaseInquiryResult);
  </script>
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseInquiryResultTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>