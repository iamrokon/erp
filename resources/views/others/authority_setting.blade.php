@section('title', '権限設定')
@section('menu-test1', '権限設定')
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  @include('layouts.header')
  <style>
    .inner_content {
      float: left;
      width: 100%;
      margin-bottom: 10px;
    }

    .id_wrap {
      float: left;
      width: 68px;
      /*margin-left: 2%;*/
      margin-left: 15px;
      margin-top: 3px;
    }

    small {
      font-size: 96%;
    }

    .chk_wrap {
      float: left;
      /*width: 80%;*/
    }

    .overflow_cls {
      overflow: hidden !important;
    }

    @media only screen and (min-width: 1400px) {
      .left_right_margin {
        margin-bottom: : 0px;

      }
    }

    .m_t {
      margin-top: 7px;
    }

    @media only screen and (max-width: 767px) {
      .rounded_table_wrap {
        width: 50%;
        padding-left: 15px !important;
      }

      .nav_mview {
        margin-bottom: 15px !important;
      }

      .pagi-input-field {
        height: 36px !important;
      }

      .fullpage_width1 {
        /* width: 96vw; */
        margin-top: 90px;
      }

      .custom-control-label {
        margin-left: 0 !important;
      }
    }


    @media only screen and (min-width: 576px) {
      .custom-control-label {
        margin-left: 0 !important;
      }
    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
    }

    .stander li a .change-icon {
      margin: 8px 6px;
      font-size: 12px;
      color: #444;
      transition: all 0.5s 0.25s;
      transform: rotate(0);
    }

    .colorChange .change-icon {
      transform: rotate(135deg) !important;
      color: #ff9900 !important;
    }

    .colorChange {
      color: #ff9900 !important;
    }

    .hideIcon {
      display: none;
    }

    .showIcon {
      display: block;
    }

    body {
      overflow-x: auto !important;
      min-width: 98vw !important;
    }

    .content-head-top {
      border-bottom: 1px solid #E1E1E1;
    }

    .input-data {
      background: #EFEFEF;
    }

    .custom-table-1 {
      position: relative;
    }

    .custom-table-1:after {
      content: '';
      position: absolute;
      background: #D0D0D0;
      width: 1px;
      height: 90px;
      right: -15px;
      top: 3px;
    }

    .content-head-section {
      padding: 0;
      min-height: 0;
      font-size: 0.8em;
    }

    .container {
      max-width: 1140px !important;
    }

    /*custom window  changes*/
    .inner-top-content {
      margin-top: 126px !important;
    }

    @media (max-width: 1800px) {
      .common-nav .inner-top-content {
        margin-top: 103px !important;

      }
    }
  </style>

</head>

<body class="common-nav" style="overflow-x: visible;">
  @include('layout.nav_fixed')
  @include('layout.custom_checkbox')

  <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    <div class="content-head-section">
      <div>
        <div class="container">
          <div class="row ">
            <div class="col">
              <div class="content-head-top inner-top-content">
                <form id="menuForm" method="post" action="{{ route('authority_setting') }}">
                  <input type="hidden" name="userId" value="{{$bango}}">
                  @csrf
                  <div class="row mt-2">
                    <div class="col-4">
                      <div class="w-100">
                        <div class=" row row_data">
                          <div class="col-3 mt-1">
                            <div class="line-icon-box"></div>
                            <div class="">
                              <span>担当者名</span>
                            </div>
                          </div>
                          <div class="col-9">
                            <div class="outer row">
                              <div class="col-12 ">
                                <div class="custom-arrow custom-form">
                                  <div style="width: 150px !important;">
                                    <select autofocus class="form-control" id="" name="user"
                                      onchange="readTheUser(this)">
                                      <option value="">-</option>
                                      @foreach($users as $user)
                                      <option value="{{$user->bango}}" @if($user->bango == $selected_user)
                                        selected="selected" @endif>{{$user->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="custom-form" style="width: 200px !important;">
                        <input type="text" class="form-control mr-1"
                          value="@if(isset($search_val)){{ $search_val }}@endif" name="search_val"
                          style="width: 150px !important;float: left;">
                        <button type="button" class="btn btn-info text-center" onclick="readTheUser(this)"
                          style="height: 27px !important;">検索</button>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="pull-right">
                        <button type="button" class="btn btn-info text-center" style="cursor: pointer;"
                          onclick="defaultValues();">デフォルト権限</button>
                        <button type="button" onclick="changeSetting()" class="btn btn-info text-center" style=""><i
                            class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
                        <input type="hidden" id="saveButton" name="saveButton" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    @foreach($menus as $masterMenu=>$subMenu)
                    <div class=" col-4">
                      <div>
                        <div class=" mt-2 mb-2 text-center" style="width: 220px;">
                          @php
                          $master_menu_name = explode(',', $masterMenu)[0];
                          $master_menu_id = explode(',', $masterMenu)[1];
                          @endphp
                          <span><b>{{$master_menu_name}}</b></span>
                          <div> <small class="text-center">(ID：{{ $master_menu_id }})</small></div>
                        </div>
                        @foreach($subMenu as $key=>$name)
                        <div class="row text-left">
                          <div class="inner_content">
                            <div class="id_wrap"><small>(ID：{{$key}})</small></div>
                            <div class="chk_wrap">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input menu-checkbox" name="{{$key}}"
                                  id="{{$key}}" @if(explode(',',$name)[1]=='GO' ) checked="checked" @endif>
                                <label class="custom-control-label mrge_in1" for="{{$key}}"> {{explode(',',$name)[0]}}
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    @endforeach
                    <div class="col-4">
                      <div>
                </form>
              </div>
              <div class="content-head-bottom">
                <div class="row">
                  <div class="col">

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  @include('layout.footer_new')

  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <!--Bootstrap 4.x-->
  <script src="  {{ asset('js/bootstrap.min.js') }}"></script>
  <!--Jquery Map for mac operating system-->
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/datepicker.js') }}"></script>
  <script src="{{ asset('js/datepicker.ja-JP.js') }}"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

  <script>
    // Enter next tab focus start............
        ko.bindingHandlers.nextFieldOnEnter = {
          init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, textarea, select, button, .btn, .trfocus', function (e) {
              var self = $(this),
                form = $(element),
                focusable, next;
              if (e.keyCode == 13 && !e.shiftKey) {
                focusable = form.find('input, select, textarea, button, .btn, .trfocus').filter(':visible');
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
        // Enter next tab focus end............
  </script>

  <script type="text/javascript">
    $(function () {
        $("#show_view_modal").click(function () {
            $("#msg_modal1").modal("show");
        });
    });
  </script>
  <script type="text/javascript">
    $("#msgButton3").on("click", function () {

           // $('body').removeClass('modal-open');
           //$('body').addClass('overflow_cls');
           $('.modal-backdrop').remove();
            $('#msg_modal3').on('show.bs.modal', function (e) {
          $('body').addClass('overflow_cls');
          $("#msg_modal1").modal("hide");
              })
              $('.modal-backdrop').show();
              $('#msg_modal3').on('hide.bs.modal', function (e) {
          $('body').removeClass('overflow_cls');
              })


          });


  </script>
  <script type="text/javascript">
    function changeSetting()
  {
    document.getElementById('saveButton').value='save';
    document.getElementById('menuForm').submit();
  }

  function readTheUser()
  {
    document.getElementById('menuForm').submit();
  }
  function defaultValues()
  {
    var elems = document.getElementsByClassName('menu-checkbox');
    var defaults = @json($user_def_menus);

    for(var i = 0; i<elems.length;i++)
    {
      if(defaults.includes(elems[i].name))
        elems[i].checked = true;
      else elems[i].checked = false;
    }
  }
  </script>
</body>

</html>