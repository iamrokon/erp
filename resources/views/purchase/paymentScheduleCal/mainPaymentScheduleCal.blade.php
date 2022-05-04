
@section('title', '支払予定計算')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払予定計算')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentScheduleCal.styles')
</head>

<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section">
        <div class="container position-relative">
          <div class="error-div">
            <div id="error_data" class="common_error"></div>
            
            <!-- Show Update Message -->
            @if(Session::has('success_msg'))
            @php
            $success_msgs = session()->get('success_msg');
            @endphp
            @foreach($success_msgs as $key=>$val)
             <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
              <div class="col-12 pl-0 pr-0 ml-3">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#payment_deadline').focus();">&times;</button>
                  <strong> {{$val}}</strong>
                </div>
              </div>
            </div>
            @endforeach
            @endif
            
            <!-- No Email Common Message -->
            @if(!Session::has('success_msg'))
            @php
            $no_insertion_msg = session()->get('no_insertion_msg');
            @endphp
            <p class="common_error mb-0" id="no_insertion_msg">{{$no_insertion_msg}}</p>
            @endif
          </div>
          
          {{-- First Part starts here --}}
          @include('purchase.paymentScheduleCal.paymentScheduleCalTopSearch')
          {{-- First Part Ends here --}}
      
         {{-- Second Part starts here --}}
         {{-- @include('purchase.paymentScheduleCal.paymentScheduleCalMainContent') --}}
         {{-- Second Part Ends here --}}
        </div>
      </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
    
    <!-- supplier modal -->
    @include('common.supplierModal_2')

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentScheduleCal.script')
 {{-- Including Scripts Ends Here --}}
 
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/purchase/payment_schedule_cal/paymentScheduleCal.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
  
</body>

</html>