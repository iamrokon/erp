
@section('title', '前受受注取消')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注  >')
@section('menu-test5', '前受受注取消')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('order.cancellationOfPreOrders.styles')
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
            <div id="error_data" class="common_error d-none">error message</div>

            <!-- Show Update Message -->

             <div class="row success-msg-box d-none" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
              <div class="col-12 pl-0 pr-0 ml-3">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#categorikanri').focus();">&times;</button>
                  <strong> show update message</strong>
                </div>
              </div>
            </div>

             <script>
			  // Focus on Alert Closing
			  $(".dismissMe").keydown(function(e) {
				  if (e.shiftKey && e.which == 13) {
					  $('.close').alert('close');
					  event.preventDefault();
					  document.getElementById("categorikanri").click();
					  $('#categorikanri').focus();
				  }
			  });
			</script>
            <!-- No Email Common Message -->

            <p class="common_error mb-0 d-none" >email common message</p>

          </div>

          {{-- First Part starts here --}}
          @include('order.cancellationOfPreOrders.cancellationOfPreOrdersTopSearch')
          {{-- First Part Ends here --}}
        </div>
      </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

    <!-- supplier modal -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('order.cancellationOfPreOrders.script')
 {{-- Including Scripts Ends Here --}}

  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filecreatedata2 = document.createElement("script");
      filecreatedata2.type = "text/javascript";
      filecreatedata2.src = "{{ asset('js/order/cancellationOfPreOrders/cancellationOfPreOrders.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filecreatedata2);
  </script>
  <!-- Hard reload js link end -->

</body>

</html>
