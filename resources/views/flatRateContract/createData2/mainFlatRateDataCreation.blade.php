
@section('title', ' 受注→定期定額契約データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 定期定額  >')
@section('menu-test5', ' 受注→定期定額契約データ作成')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('flatRateContract.createData2.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('flatRateContract.createData2.flatRateDataCreationTopSearch')
      {{-- First Part Ends here --}}

     {{-- Second Part starts here --}}

     {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('flatRateContract.createData2.script')
 {{-- Including Scripts Ends Here --}}

  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filecreatedata2 = document.createElement("script");
      filecreatedata2.type = "text/javascript";
      filecreatedata2.src = "{{ asset('js/flatRateContract/createData2/createData2.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filecreatedata2);
  </script>
  <!-- Hard reload js link end -->
</body>

</html>
