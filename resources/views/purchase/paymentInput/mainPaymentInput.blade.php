
@section('title', '支払入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払入力')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentInput.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <form id="insertData" enctype="multipart/form-data">
      <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <input type="hidden" id="formSubmitButton" name="type" />
      <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
      <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
      <input type="hidden" name="userName" id="userName" value="{{$tantousya->name}}"> 
      <input type="hidden" id="confirm_status" name="confirm_status" value="0">
      <input type="hidden" name="source" value="paymentInput" />
      <input id='page_name' value='paymentInput' type='hidden' />
      <input id='_hikitasukko_val' type='hidden' />
        {{-- First Part starts here --}}
        @include('purchase.paymentInput.paymentInputTopSearch')
        {{-- First Part Ends here --}}
      {{-- Second Part starts here --}}
      @include('purchase.paymentInput.paymentInputMainContent')
      {{-- Second Part Ends here --}}

      </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{--@include('purchase.paymentInput.modal')--}}
  <!-- end  modal  here-->
  <!-- Supplier Modal start here -->
    @include('common.supplierModal')
    @include('common.supplierModal_2')
  <!-- Supplier Modal end here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  </form>
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentInput.script')
 {{-- Including Scripts Ends Here --}}

 <script type="text/javascript">
        var filecomm = document.createElement("script");
        filecomm.type = "text/javascript";
        filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filecomm);
  </script>
  <script type="text/javascript">
        var fileinput = document.createElement("script");
        fileinput.type = "text/javascript";
        fileinput.src = "{{ asset('js/purchase/paymentInput/paymentInput.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileinput);
    </script>
</body>

</html>