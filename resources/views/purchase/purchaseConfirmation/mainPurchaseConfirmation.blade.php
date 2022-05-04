@section('title', '仕入購入確認')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入購入確認')

<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  {{-- Including CSS Starts Here --}}
  @include('purchase.purchaseConfirmation.styles')
  {{-- Including CSS Ends Here--}}

</head>

<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
  {{--  @include('layout.custom_checkbox') --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
           {{-- Top Contents Starts Here --}}
  
              @include('purchase.purchaseConfirmation.purchaseConfirmationTopSearch')
              {{-- Top Contents Ends Here --}}
              {{-- Main Content Part1 Starts Here --}}
              
              {{-- Main Content Part1 Ends Here --}}
      {{-- First Part Ends here --}}
              {{-- Checkbox with Button Starts Here --}}
              {{-- <div class="content-head-top">
                <div class="row mb-4 mt-4">
                  <div class="col-8">
                    <div class="radio-rounded d-inline-block">
                      <div class="custom-control custom-radio custom-control-inline"
                        style="padding-left:11px!important;">
                        <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value=""
                          checked="">
                        <label class="custom-control-label" for="customRadio"
                          style="font-size: 12px!important;cursor:pointer;">買掛分</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline"
                        style="padding-left: 20px!important;">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="">
                        <label class="custom-control-label" for="customRadio2"
                          style="font-size: 12px!important;cursor:pointer;">未払分</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline"
                        style="padding-left: 20px!important;">
                        <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="">
                        <label class="custom-control-label" for="customRadio3"
                          style="font-size: 12px!important;cursor:pointer;">すべて</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="d-inline-block float-right">
                      <button style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                    </div>
                  </div>
                </div>
              </div> --}}
              {{-- Checkbox with Button Ends Here --}}
       {{-- Second Part starts here --}}
       @include('purchase.purchaseConfirmation.purchaseConfirmationDetails')
       {{-- Second Part Ends here --}}

       {{-- Third Part starts here --}}
         {{-- Third Part Bottom Search starts here --}}
         @include('purchase.purchaseConfirmation.purchaseConfirmationSearch')
         {{-- Third Part Bottom Search ends here --}}
         {{-- Third Part Bottom Table starts here --}}
         <div id="backlogContent">
         @include('purchase.purchaseConfirmation.purchaseConfirmationBottomContent')
         </div>
         
         {{-- Third Part Bottom Table ends here --}}

       {{-- Third Part ends here --}}          
    </div>

    {{-- line confirm modal start here --}}
    <div class="modal custom-data-modal" data-backdrop="static" id="confirm_line_delation_Modal" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 400px;">
        <div class="modal-content bg-blue">
          <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLabel"><strong></strong></h5>
            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
            <div class="modal-data-box pl-4 pr-4">
              <table class="table text-white">
                <tbody class="pl-4 pr-4">
                    <td
                      style="border-left: 0px !important;border-right: 0px !important;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                      <div class="text-white">
                          仕入完了済のデータですが、
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td
                      style="border-left: 0px !important;border-right: 0px !important;padding: 10px 0px !important;border-bottom: 0px!important;">
                      <div class="text-white">
                          引き当ててよろしいですか。
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer border-top-0 float-left">
              <button onclick="registerPurchaseConfirmation();event.preventDefault();" type="button" class="btn text-white w-145 bg-teal" data-dismiss="modal"> <i class=""
                  aria-hidden="true" style="margin-right: 5px;"></i>Yes
              </button>
              <button type="button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
                <!--  <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->No
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- line confirm modal end here --}}


    {{-- Bottom Link Starts Here 
    @include('layout.bottom_link')
    -- Bottom Link Ends Here --}}

  </section>
 {{-- Including Common Footer Links Start Here --}}
 @include('layouts.footer')
 {{-- Including Common Footer Links End Here --}}

 {{-- Footer Starts Here --}}
 @include('layout.footer_new')
 {{-- Footer Ends Here --}}

  <!-- Search modal starts Here -->
  @include('common.supplierModal_3')

   <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/purchase/purchase_confirmation/purchaseConfirmation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>

  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseConfirmation.scripts')
  {{-- Including Scripts Ends Here --}}
</body>
</html>