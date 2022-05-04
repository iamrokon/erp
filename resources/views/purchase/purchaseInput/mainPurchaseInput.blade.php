@section('title', '仕入購入入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入購入入力')


<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}

  {{-- Including CSS Starts Here --}}
  @include('purchase.purchaseInput.styles') 
  {{-- Including CSS Ends Here--}}

</head>


<body class="common-nav" style="overflow-x:visible;">
    <!-- preloader start here -->
    <div class="preloader">
        <div class="loading" style="display: none"></div>
    </div>
    <!-- preloader end here -->
    
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}

    {{-- Main Page Starts Here --}}
    <form id="insertData" enctype="multipart/form-data">
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <input type="hidden" id="formSubmitButton" name="type" />
      <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
      <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
      <input type="hidden" name="userName" id="userName" value="{{$tantousya->name}}"> 
      <input type="hidden" id="confirm_status" name="confirm_status" value="0">
      <input type="hidden" name="source" value="purchaseInput" />
      <!-- <input type="hidden" name="datachar08" id="datachar08">
      <input type="hidden" name="date0016" id="date0016">
      <input type="hidden" name="datatxt0150" id="datatxt0150">-->
      <input type="hidden" name="datanum0013" id="datanum0013">
      <input id='page_name' value='purchaseInput' type='hidden' />
      <input id='_hikitasukko_val' type='hidden' />
      
      {{-- Top Search Starts Here --}}
      @include('purchase.purchaseInput.purchaseInputTopSearch')
      {{-- Top Search Ends Here --}}
      
      {{-- Main Content Part1 Starts Here --}}
      @include('purchase.purchaseInput.purchaseInputMainContentPart1')
      {{-- Main Content Part1 Ends Here --}}
      <div class="insert-div" id="insertBacklogData"></div>
      {{-- Main Content Part2 Starts Here --}}
      @include('purchase.purchaseInput.purchaseInputMainContentPart2')
      {{-- Main Content Part2 Ends Here --}}
      <div class="display none" id="insertMainData"></div>

    </div>
    {{-- Main Page Ends Here --}}

    {{-- Including Common Footer Links Start Here --}}
    @include('layouts.footer')
    {{-- Including Common Footer Links End Here --}}

    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}

    {{-- Modal Starts Here --}}
    {{-- @include('purchase.purchaseInput.modal') --}}
    {{-- Modal Ends Here --}}

    <!-- Number Search Modal start here -->
    @include('purchase.purchaseInput.include.numberSearch.main')
    <!-- Number Search Modal end here -->

    <!-- Supplier Modal start here -->
    @include('common.supplierModal')
    @include('common.supplierModal_2')
    <!-- Supplier Modal end here -->

    <!-- Number Search Modal start here -->
    @include('purchase.purchaseInput.include.product.main')
    <!-- Number Search Modal end here -->
    {{-- Confirmation Modal Starts Here --}}
      @include('purchase.purchaseInput.purchaseInputConfirmationModal')
    {{-- Confirmation Modal Ends Here --}}
    </form>
    {{-- Including Scripts Starts Here --}}
    @include('purchase.purchaseInput.scripts')
    {{-- Including Scripts Ends Here--}}

    <script type="text/javascript">
        var filecomm = document.createElement("script");
        filecomm.type = "text/javascript";
        filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filecomm);
    </script>

    <script type="text/javascript">
        var filenumsearch = document.createElement("script");
        filenumsearch.type = "text/javascript";
        filenumsearch.src = "{{ asset('js/purchase/purchaseInput/numberSearch.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filenumsearch);
    </script>

    <script type="text/javascript">
        var filesupplier = document.createElement("script");
        filesupplier.type = "text/javascript";
        filesupplier.src = "{{ asset('js/purchase/purchaseInput/supplier.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(filesupplier);
    </script>

    <script type="text/javascript">
        var fileback = document.createElement("script");
        fileback.type = "text/javascript";
        fileback.src = "{{ asset('js/purchase/purchaseInput/orderBacklog.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileback);
    </script>
    <script type="text/javascript">
        var fileinput = document.createElement("script");
        fileinput.type = "text/javascript";
        fileinput.src = "{{ asset('js/purchase/purchaseInput/purchaseInput.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileinput);
    </script>
    <script type="text/javascript">
        var fileprod = document.createElement("script");
        fileprod.type = "text/javascript";
        fileprod.src = "{{ asset('js/purchase/purchaseInput/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileprod);
    </script>
    <script type="text/javascript">
        var fileOrderNum = document.createElement("script");
        fileOrderNum.type = "text/javascript";
        fileOrderNum.src = "{{ asset('js/purchase/purchaseInput/orderNumber.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileOrderNum);
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
</body>

</html>