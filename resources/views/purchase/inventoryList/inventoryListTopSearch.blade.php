<div class="content-head-section custom-mb" style="padding-bottom: 5px;">
  <div class="container position-relative">
   {{-- Success Message Starts Here --}}
   @if(Session::has('success_msg'))
    <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissAlertMessage"  autofocus>&times;</button>
          <strong>{{session()->pull('success_msg') }}</strong>
        </div>
      </div>
    </div>
    @endif
  {{-- Success Message Ends Here --}}

  {{-- Error Message Starts Here --}}
  <div  class="common_error" id="error_msg_div">@if(isset($inventoryListError)&& $inventoryListError!=null){{$inventoryListError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
  {{-- Error Message Ends Here --}}
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
    <div class="row order_entry_topcontent inventory_list inner-top-content">
      <div class="col">
        <div class="content-head-top">
          <div class="row mb-4">
              <div class="col-8"></div>
              <div class="col-4">
                 <div class="d-inline-block float-right">
                 <button style="width: 150px;height:30px;line-height:30px;" id ="displayButton" class="btn btn-info displayButton">表示</button>   
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>