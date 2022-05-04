
@section('title', '粗利調整入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', 'その他 >')
@section('menu-test5', '粗利調整入力')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('other.grossProfitAdjustmentInput.styles')
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
      <input type="hidden" name="source" value="grossProfitAdjustmentInput"/>
      <input id='page_name' value='grossProfitAdjustmentInput' type='hidden' />
      {{-- First Part starts here --}}
      @include('other.grossProfitAdjustmentInput.grossProfitAdjustmentInputTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('other.grossProfitAdjustmentInput.grossProfitAdjustmentInputMainContent')
     {{-- Second Part Ends here --}}
   

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{--@include('other.grossProfitAdjustmentInput.modal')--}}
  <!-- end  modal  here-->
  @include('other.grossProfitAdjustmentInput.product.main')

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
</form>
  {{-- Including Scripts Starts Here --}}
  @include('other.grossProfitAdjustmentInput.script')
 {{-- Including Scripts Ends Here --}}

 <script type="text/javascript">
      var fileGrossProfitAdjustmentInput = document.createElement("script");
      fileGrossProfitAdjustmentInput.type = "text/javascript";
      fileGrossProfitAdjustmentInput.src = "{{ asset('js/other/grossProfitAdjustmentInput/grossProfitAdjustmentInput.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileGrossProfitAdjustmentInput);
  </script>
  <script type="text/javascript">
        var fileprod = document.createElement("script");
        fileprod.type = "text/javascript";
        fileprod.src = "{{ asset('js/other/grossProfitAdjustmentInput/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileprod);
    </script>
</body>

</html>