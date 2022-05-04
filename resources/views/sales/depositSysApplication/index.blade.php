@section('title', ' 入金消込SYS消込データ取込')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', ' 入金消込SYS消込データ取込')
@section('tag-test', 'ここにはガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Common Style Starts Here --}}
  @include('sales.depositSysApplication.styles')
  {{-- Common Style Ends Here --}}

</head>


<body class="common-nav" id="body" style="overflow-x:visible;">
  <section>
    @include('layout.nav_fixed')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section1">
        <div class="container position-relative ">

          {{-- Success Message Starts Here --}}
          @if(Session::has('success_msg'))
          @php
          $success_msg = session()->get('success_msg');
          @endphp
          <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
            <div class="col-12">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" autofocus data-dismiss="alert"
                  onclick="$('#order_data_input').focus();">&times;</button>
                <strong> {{$success_msg}}</strong>
              </div>
            </div>
          </div>
          @endif
          {{-- Success Message Ends Here --}}
        
          {{-- Error Message Starts Here --}}
          @if(Session::has('err_msg'))
          @php
          $err_msg = session()->get('err_msg');
          @endphp
          @foreach($err_msg as $key=>$val)
          <div class="common_error error_data1" id='error_data1'>{{$val}}</div>
          @endforeach
          
          @endif

          @if(Session::has('err_msg2'))
          @php
          $err_msg2 = session()->get('err_msg2');
          @endphp
          @foreach($err_msg2 as $key=>$val)
          <div class="common_error error_data2" id='error_data2'>{{$val}}</div>
          @endforeach
          @endif

          @if(Session::has('err_msg3'))
          @php
          $err_msg3 = session()->get('err_msg3');
          @endphp
          @foreach($err_msg3 as $key=>$val)
          <div class="common_error error_data3" id='error_data3'>{{$val}}</div>
          @endforeach
          @endif

          @if(Session::has('err_msg4'))
          @php
          $err_msg4 = session()->get('err_msg4');
          @endphp
          {{-- <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
            <div class="col-12">
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" autofocus data-dismiss="alert"
                  onclick="$('#order_data_input').focus();">&times;</button>
                @foreach($err_msg4 as $key=>$val)
                <strong style="display: block;"> {{$val}}</strong>
                @endforeach
              </div>
            </div>
          </div> --}}
          @foreach($err_msg4 as $key=>$val)
          <div class="common_error error_data4" id='error_data4'>{{$val}}</div>
          @endforeach
          @endif

		  @if(Session::has('err_msg5'))
          @php
          $err_msg5 = session()->get('err_msg5');
          @endphp
          @foreach($err_msg5 as $key=>$val)
          <div class="common_error error_data5" id='error_data5'>{{$val}}</div>
          @endforeach
          @endif

          <div class="common_error" id='error_data'></div>
          {{-- Error Message Ends Here --}}

          <div class="row deposit-sys-application inner-top-content">
            <div class="col-12">
              <form method="post" action="{{route('importCSV')}}" id="import_csv" enctype='multipart/form-data'>
                <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
                <input id='submit_confirmation' value='' type='hidden' />
                @csrf
                <div class="row">
                  <div class="col-8">
                    <table class="table custom-form">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;border:0!important;">
                            <div class="line-icon-box" style="background: #353A81;"></div>
                          </td>
                          <td style="width: 84px!important;border: none!important;text-align: left;color: black;">
                            ファイル
                          </td>
                          <td style=" border: none!important;width: 62%;">

                            <div class="input-group" id="file_err">
                              <input type="text" name="file" id="order_data_input" class="form-control" placeholder=""
                                readonly="">
                              <div class="input-group-append" style="height: 30px;margin-left: 6px;margin-top: 0px;">
                                <div class="custom-file">
                                  <input type="file" name="filename" accept=".csv" class="custom-file-input"
                                    id="customFileOrder">
                                  <a style="height: 28px;" class="btn btn-info" href="#" id="file_selection"> <label
                                      for="customFileOrder"><i class="fa fa-search" aria-hidden="true"
                                        style="margin-right: 5px;"></i>参照</label></a>
                                </div>
                              </div>
                            </div>
                            <script>
                              $("#file_selection").click(function(){ 
                                $('#customFileOrder').val(''); 
                                $('#order_data_input').val(''); 
								$(".common_error").html("");
								$("#submit_confirmation").val("");
								$("#confirmation_message").html("");
								$(".success-msg-box").hide();
                              });
                              $(".custom-file-input").on("change", function() {
                                var fileName = $(this).val().split("\\").pop();
                                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                $("#order_data_input").val(fileName);
                              });
                            </script>
                          </td>
                          <td style="border:0!important;width:40%;"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <script>
                  //  $(document).ready(function(){
                        //     $(".btn").click(function(){
                        //       $(".customalert,.loading-icon").toggle();
                        //     });
                        //   });
                        $(document).ready(function() {
                            $(".inputAttrRemove").click(function(){            
                                $("input").removeAttr("readonly");
                            });
                        });
                          // $('.btn').toggleClass('class1 class2');
                </script>
                <div class="row">
                  <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                    <div>
                      <button onclick="importCSV('{{route('importCSV')}}',event.preventDefault())" type="submit"
                        id="contenthide" class="btn btn-info uskc-button">CSVインポート</button>
                    </div>
                    <div>
                      <div class="loading-icon">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- <div class="row">
                  <div class="col-9">
                    <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
                      <tbody>
                        <tr>
                          <td style=" border: none!important;padding: 0px!important;">
                            <button onclick="importCSV('{{route('importCSV')}}',event.preventDefault())" type="submit"
                id="contenthide" class="btn btn-info uskc-button">
                CSVインポート
                </button>
                </td>
                <td style="border: none !important;">
                  <div class="loading-icon">
                    <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </td>
                </tr>
                </tbody>
                </table>
            </div>
          </div> --}}

          </form>
        </div>
      </div>

    </div>
    <!-- container-fluid div end -->
    </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer end Here --}}
  </section>

  {{-- Footer bottom link Starts Here --}}
  @include('layouts.footer')
  {{-- Footer  bottom link Ends Here --}}
  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      $("#fileshow2").val(fileName);
    });
  </script>
  <!--  loading icon -->
  <script>
    $(document).ready(function(){
        $(".customalert, .loading-icon").hide();
        $("#contenthide").click(function(){
          $(".customalert,.loading-icon").toggle();
        });
      });
  </script>
  <script>
    $(document).ready(function () {
      $(".second-table").hide();
      $(".first-table").click(function () {
        $(".second-table").show();
      });
    });
    $(document).ready(function () {
      $(".third-table").hide();
      $(".second-table").click(function () {
        $(".third-table").show();
      });
    });
  </script>
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var depositSysApplicationLink = document.createElement("script");
    depositSysApplicationLink.type = "text/javascript";
    depositSysApplicationLink.src = "{{ asset('js/sales/deposit_sys_application/deposit_sys_application.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(depositSysApplicationLink);
  </script>
  <!-- Hard reload js link ends here -->

  <script>
    // Knockout
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                    // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }

                // Shift+Enter to select table row
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
    $(document).on('shown.bs.modal', function(e) {
     $('[autofocus]', e.target).focus();
  });
  </script>
  
</body>

</html>