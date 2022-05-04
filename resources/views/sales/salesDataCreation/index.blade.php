@section('title', '受注→売上データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '受注→売上データ作成')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')

<!DOCTYPE html>
<html lang="ja">

<head>
  
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}

  {{-- Including CSS Starts Here --}}
  @include('sales.salesDataCreation.styles')
  {{-- Including CSS Ends Here--}}

</head>


<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <!-- content head section start -->
      <div class="preloader">
        <div class="loading" style="display: none"></div>
      </div>
      <!--/.preloader-->
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      
      <div class="content-head-section">
        <div class="container position-relative">

          {{-- Success Message Starts Here --}}
          <div id="succmsg" class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: none;">
            <div class="col-12">
              <div class="alert alert-primary alert-dismissible session_alert-sales">
                <button type="button" class="close dismissMe" autofocus data-dismiss="alert">&times;</button>
                <strong>登録しました。</strong>
              </div>
            </div>
          </div>
          {{-- Success Message Ends Here --}}

          {{-- Error Message Starts Here --}}
          <div id="datanai" class="common_error">該当するデータがありません。</div>
          {{-- Error Message Ends Here --}}

            <div class="inner-top-content">
              <form action="POST" id="submitform">
                @csrf
                <div class="row">
                  <div class="col-5 custom-form">
                    <div class="input-group input-group-sm">
                      <div style="color: #000;width: 250px;line-height: 28px;">受注→売上データ作成</div>
                      <div>
                        <button type="button" autofocus="" onclick="submitform()" class="btn-info btn text-white uskc-button"
                          style="border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;">データ作成</button>
                      </div>
                      <div class="loading-icon" style="display: none;">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </div>
              </form>
              <div class="toggle-content-sales" id="msgFromBack" style="width: 500px; margin-top: 20px; display: none;">
                <table class="table custom-form table-borderless">
                  <tbody>
                    <tr>
                      <td style="border: none !important;width: 145px;">処理が完了しました</td>
                    </tr>
                    <tr>
                      <td style="border: none !important;width: 145px;">実行時間　：　</td>
                      <td style="border: none !important;"><span id="start_time"></span> ～ <span id="end_time"></span></td>
                    </tr>
                    <tr>
                      <td style="border: none !important;width: 145px;">対象件数　：　</td>
                      <td style="border: none !important;"><span id="target"></span>&nbsp;件</td>
                    </tr>
                    <tr>
                      <td style="border: none !important;width: 145px;">作成件数　：　</td>
                      <td style="border: none !important;"><span id="ok"></span>&nbsp;件</td>
                    </tr>
                    <tr>
                      <td style="border: none !important;width: 145px;">エラー件数：　</td>
                      <td style="border: none !important;"><span id="ng"></span>&nbsp;件</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

    </div>
    </div>
    <!-- container-fluid div end -->

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  <!-- content hide show toggle -->
  {{-- <script>
      $(document).ready(function () {
        $(".toggle-content-sales, .loading-icon,.session_alert-sales").hide();
        $("#contenthide").click(function () {
          $(".toggle-content-sales, .loading-icon").show();
          $(".session_alert-sales").show();
        });
      }); 
      
    </script> --}}
  <script>
    function setFirstFocus() {
            document.getElementById("contenthide").focus();
        }
  </script>

  <!-- content hide show toggle end -->
  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
      init: function (element, valueAccessor, allBindingsAccessor) {
        // $(element).on('keydown', 'input, textarea, select, button, a.btn, .btn, tr.trFocus', function (e) {
            $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trFocus', function (e) {
          var self = $(this),
            form = $(element),
            focusable, next;
          if (e.keyCode == 13 && !e.shiftKey) {
            // focusable = form.find('input:not([ignore]), select, textarea, button, a.btn, .btn, tr.trFocus').filter(':visible');
            focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trFocus').filter(':visible');
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
  <!-- content hide show toggle -->
  <script>
    //  $(document).ready(function () {
    //    $(".toggle-content-sales, .loading-icon,.session_alert-sales").hide();
    //    $("#contenthide").click(function () {
    //      $(".toggle-content-sales").show();
    //      $(".session_alert-sales").show();
    //    });
    //  }); 
      
  </script>

  <script>
    var submit_check=0;
        function submitform() {
        
        if (submit_check==0) {
          submit_check++
          $("#confirmation_message").text('登録はまだ完了していません。内容をご確認後、もう一度「データ作成」をお願いします。')
          document.getElementById('datanai').style.display = 'none';
          document.getElementById('msgFromBack').style.display = 'none';
          document.getElementById('succmsg').style.display = 'none';
          
        }
          else{
            submit_check=0
            $("#confirmation_message").text('')
            document.getElementById('msgFromBack').style.display = 'none';
            var bango= document.getElementById("idBango").value
            var data = $('#submitform').serialize();
            $(".loading").css("display", "block")
       
        $.ajax({
        type: "GET",
        url: '/sales_data_creation/crud',
        data:{'bango':bango},
        success: function (response) {
           $(".loading").css("display", "none")
          if(JSON.parse(response).empty.trim()=='ok'){
             document.getElementById('datanai').style.display = 'block';
             document.getElementById('msgFromBack').style.display = 'none';
             document.getElementById('succmsg').style.display = 'none';
          }
          else if (JSON.parse(response).empty.trim()=='ng') {
          document.getElementById('datanai').style.display = 'none';
          $("#start_time").text(JSON.parse(response).start)
          $("#end_time").text(JSON.parse(response).end)
          $("#ok").text(JSON.parse(response).ok)
          $("#ng").text(JSON.parse(response).ng)
          $("#target").text(JSON.parse(response).target)
          document.getElementById('msgFromBack').style.display = 'block';
          //document.getElementById('succmsg').style.display = 'block';
          }else{
            console.log('no data') 
          }

         }
        })
        }
        }

  </script>
  <script>
    $(document).ready(function(){
       
        $("#contenthide").click(function(){
          // $(".loading").addClass("show").fadeOut();
          // $("loading").fadeOut();
            //$(".loading").css("display", "block")
        });
        
      });
      function removeLoader(){
            $( ".loading" ).fadeOut(500, function() {
              // fadeOut complete. Remove the loading div
              $( ".loading" ).remove(); //makes page more lightweight 
          });  
      }
  </script>
  <!-- content hide show toggle end -->

  <!--  footer content // windows height resize call-->
  <script type="text/javascript">
    jQuery(function($){
          var e = function() {
              var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
              (e -= 229) < 1 && (e = 1), e > 224 && $(".fullpage_width1").css("min-height", e + "px")
          };
          $(window).ready(e), $(window).on("resize", e);
      });
          
  </script>
  <!--  footer content end // windows height resize call-->
</body>

</html>