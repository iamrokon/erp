@section('title', '売上検収処理')
@section('menu-test1', 'ホーム > ')
@section('menu-test3', '受注 > ')
@section('menu-test5', '売上検収処理 ')
@section('menu-test1', '売上検収処理')

<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}

  {{-- Including CSS Starts Here --}}
  @include('order.salesAcceptance.styles')
  {{-- Including CSS Ends Here--}}

</head>


<body class="common-nav"  style="overflow-x: visible;">

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

  {{-- Main Content Starts Here --}}
  @include('order.salesAcceptance.mainContents')
  {{-- Main Content Ends Here --}}

  {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  {{--Modal 1 Starts Here --}}
  @include('order.salesAcceptance.modal1')
  {{--Modal 1 Ends Here --}}

  {{--File Extension Confirmation Modal Starts Here --}}
  @include('order.salesAcceptance.fileExtensionConfirmationModal')
  {{--File Extension Confirmation Modal Ends Here --}}

  {{-- Including Scripts Starts Here --}}
  @include('order.salesAcceptance.scripts')
  {{-- Including Scripts Ends Here--}}
  <script>
    //Click to hide calendar
    $("#add_icon").click(function () {
      $("#from").datepicker('hide');
      $("#to").datepicker('hide');
    });
  </script>
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var filesalesAccept = document.createElement("script");
      filesalesAccept.type = "text/javascript";
      filesalesAccept.src = "{{ asset('js/order/salesAcceptance/salesAcceptance.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filesalesAccept);
  </script>
  <!-- Hard reload js link end -->
  
</body>

</html>
