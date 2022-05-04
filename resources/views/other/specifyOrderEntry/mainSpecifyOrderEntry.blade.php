
@section('title', '受注入力可否指定')
@section('menu-test1', 'ホーム > ')
@section('menu-test3', ' その他 > ')
@section('menu-test5', '受注入力可否指定 ')
@section('menu-test1', '受注入力可否指定')
<!DOCTYPE html>
<html lang="ja">
<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('other.specifyOrderEntry.styles')
</head>

<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
<div class="container">
        <div class="row">
          <div class="col-12">
            <div id="error_data" class="common_error"></div>
          </div>
        </div>
          {{-- Success Message Starts Here --}}
          @if(Session::has('success_msg'))
          @php
          $success_msg = session()->get('success_msg');
          @endphp
          
            <div id="update-success-msg" class="row success-msg-box">
              <div class="col-12">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" autofocus
                onclick="$('#number_search').focus();">&times;</button>
                
                <strong>{{$success_msg}}</strong><br>
              
              </div>
              </div>
            </div>
          
      
      
		@endif
  </div>
       {{-- Success Message Ends Here --}}
	
      {{-- First Part starts here --}}
      @include('other.specifyOrderEntry.specifyOrderEntryTopSearch')
      {{-- First Part Ends here --}}
 
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->

  <!-- end  modal  here-->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}

	<script type="text/javascript">
        var fileorderentry = document.createElement("script");
        fileorderentry.type = "text/javascript";
        fileorderentry.src = "{{ asset('js/other/specify_order_entry/specifyOrderEntry.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileorderentry);

    </script>

</body>

</html>