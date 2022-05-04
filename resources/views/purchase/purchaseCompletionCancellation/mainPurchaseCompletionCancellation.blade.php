
@section('title', '仕入完了取消画面')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '仕入完了取消画面')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseCompletionCancellation.styles')
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
      <input type="hidden" name="source" value="purchaseCompletionCancellation"/>
      <input id='page_name' value='purchaseCompletionCancellation' type='hidden' />
 
          {{-- First Part starts here --}}
          @include('purchase.purchaseCompletionCancellation.purchaseCompletionCancellationTopSearch')
          {{-- First Part Ends here --}}
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  </form>
  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseCompletionCancellation.script')
  {{-- Including Scripts Ends Here --}}
 
  <!-- Hard reload js link -->
  
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/purchase/purchase_completion_cancellation/purchaseCompletionCancellation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
</body>

</html>