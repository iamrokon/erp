@section('title', '売掛残高更新')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '売掛残高更新')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja" >

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Common Style Starts Here --}}
  @include('sales.balanceUpdate.styles')
  {{-- Common Style Ends Here --}}

</head>

<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section">
        <div class="container position-relative">

         {{-- Success Message Starts Here --}}
         <div class="row success-msg-box" style="display: none;" id="success-msg">
          <div class="col-12">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close dismissAlertMessage" data-dismiss="alert" autofocus>&times;</button>
              <strong>処理が正常に終了しました。</strong>
            </div>
          </div>
        </div>
        {{-- Success Message Ends Here --}}
        
        {{-- Error Message Starts Here --}}
        <div id="no-data-msg" class="common_error" style="display: none;">該当するデータがありません。</div>
        <div id="error_data" class="common_error" style="display: none;">売掛残高更新でエラーが発生しました。</div>
        {{-- Error Message Ends Here --}}

        <div class="row inner-top-content">
          <div class="col custom-form">
            <div class="input-group input-group-sm">
              <div style="color: #000;width: 250px;line-height: 28px;">売掛残高更新</div>
              <div style="display: inline-flex; position: relative;">
                <button type="button" id="contenthide" class="btn text-white uskc-button"  data-toggle="modal" data-target="#search_modal4" autofocus style="border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;background:#2B66B1;" onclick="balanceUpdate('{{ route('balanceUpdateAction',['id' => $bango]) }}')">実行</button>
                <div class="loading-icon" style="display: none;">
                <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
              </div>
             </div>
           </div>
         </div>
       </div>
       <form id="balance_update_form">
         @csrf
       </form>
     </div>
   </div>    
 </div>
 {{-- Footer Starts Here --}}
 @include('layout.footer_new')
 {{-- Footer  Ends Here --}}
</section>

<!-- Including Common Footer Links Starts Here -->
@include('layouts.footer')
<!-- Including Common Footer Links Ends Here -->

<!-- content hide show toggle -->

<script type="text/javascript">
    var depositAccountDataCreation = document.createElement("script");
  depositAccountDataCreation.type = "text/javascript";
  depositAccountDataCreation.src = "{{ asset('js/sales/balance_update/balance_update.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
  document.getElementsByTagName("head")[0].appendChild(depositAccountDataCreation);
  </script>


{{-- Knockout - Enter to New Input Starts Here --}}
{{-- @include('master.common.knockout') --}}
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
<script>
  ko.bindingHandlers.nextFieldOnEnter = {
    init: function(element, valueAccessor, allBindingsAccessor) {
      $(element).on('keydown', '.trfocus', function(e) {
        var self = $(this),
        form = $(element),
        focusable, next;

        if (e.keyCode == 13 && !e.shiftKey) {
          focusable = form.find('.trfocus').filter(':visible');
          var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
          next = focusable.eq(nextIndex);
          next.find('.trfocus').addClass('rowSelect').focus();
          return false;
        }
        if (e.keyCode == 13 && e.shiftKey) {

          var rowSelect2 = $('.rowSelect');
          $(this).trigger('click');

        }
      });
    }
  };
  ko.applyBindings({});
</script> 
<script>
    // Enter key press auto focus next input......
    ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
        $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
          var self = $(this),
          form = $(element),
          focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            focusable = form.find('input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
            // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
            var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
            next = focusable.eq(nextIndex);
            next.focus();
            return false;
          }
          if (e.keyCode == 9) {
            e.preventDefault();
          }
        });
      }
    };
    ko.applyBindings({});
  </script>
  {{-- Knockout - Enter to New Input Ends Here --}}
  <script>
    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });

  </script>
  <!--  footer content // windows height resize call-->
 
  <!--  footer content end // windows height resize call-->
</body>
</html>
