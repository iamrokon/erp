
@section('title', '支払予定登録')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払予定登録')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentScheduleRegistration.styles')
</head>

<body style="overflow-x:visible;" class="common-nav">
  <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
  <input type="hidden" id="userId" name="userId" value="{{ $bango }}">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.paymentScheduleRegistration.paymentScheduleRegistrationTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.paymentScheduleRegistration.paymentScheduleRegistrationMainContent1')
     @include('purchase.paymentScheduleRegistration.paymentScheduleRegistrationMainContent2')
     {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here -->
   @include('purchase.paymentScheduleRegistration.supplierModal_2')
  <!-- end  modal  here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentScheduleRegistration.script')
 {{-- Including Scripts Ends Here --}}
</body>

</html>