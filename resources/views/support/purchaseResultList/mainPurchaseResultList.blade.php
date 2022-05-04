
@section('title', '外注仕入実績一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', 'サポート >')
@section('menu-test5', '外注仕入実績一覧')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('support.purchaseResultList.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      @php
        if(isset($purchaseResultListData)){
            $skip = 0;
            $old = array();
            if(session()->has('oldInput'.$bango)){
              $old = session()->get('oldInput'.$bango);
            }
            $current_page=$purchaseResultListData->currentPage();
            $per_page=$purchaseResultListData->perPage();
            $first_data= ($current_page - 1)*$per_page+1;
            $last_data=($current_page - 1)*$per_page+ sizeof($purchaseResultListData->items());
            $total=$purchaseResultListData->total();
            $lastPage=$purchaseResultListData->lastPage();
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
      @include('support.purchaseResultList.purchaseResultListTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('support.purchaseResultList.purchaseResultListMainContent')
     {{-- Second Part Ends here --}}
   

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{--@include('support.purchaseResultList.modal')--}}
  <!-- end  modal  here-->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  <!--  goto order inquiry page -->
  <form action="{{route('purchaseInquiryResult')}}" method="POST" target="_blank" id="goToPurchaseInquiryResult">
    @csrf
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" name="support_number" id="support_number" />
    <!-- <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2" /> -->
  </form>
  <!--  goto order inquiry page -->
  
  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('support.purchaseResultList.script')
 {{-- Including Scripts Ends Here --}}
 <script type="text/javascript">
      var filePurchaseResultList = document.createElement("script");
      filePurchaseResultList.type = "text/javascript";
      filePurchaseResultList.src = "{{ asset('js/support/purchaseResultList/purchaseResultList.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filePurchaseResultList);
  </script>

  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseResultListTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>