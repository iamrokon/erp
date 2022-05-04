
@section('title', '仕入購入データ取込')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入購入データ取込')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.importPurchaseData.styles')
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
            <div class="error-div" style="margin-top: 25px;">
            <div id="error_data" class="common_error"></div>
            
            <!-- Show Update Message -->
             <div class="row success-msg-box" style="display:none;position: relative; width:100%;max-width: 1452px;z-index: 1;">
              <div class="col-12 pl-0 pr-0 ml-3">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#categorikanri').focus();">&times;</button>
                  <strong></strong>
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
            <p class="common_error mb-0" ></p>
          
          </div>
          
          {{-- First Part starts here --}}
          @include('purchase.importPurchaseData.importPurchaseDataTopSearch')
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
  @include('purchase.importPurchaseData.script')
 {{-- Including Scripts Ends Here --}}
 
<!-- Hard reload js link -->
<script type="text/javascript">
  var fileord1 = document.createElement("script");
    fileord1.type = "text/javascript";
    fileord1.src = "{{ asset('js/purchase/import_purchase_data/importPurchaseData.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fileord1);
</script> 
  
</body>

</html>