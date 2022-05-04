<form id="tableSetting" action="{{ route($route,$bango) }}">
  @csrf
  <input type="hidden" name="redirect_path" value="{{$redirect_path}}">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px;">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <a class="checkall btn btn-info " style="margin-bottom: 10px;">全選択</a>
              <a class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</a>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
              <a class="btn btn-info" data-token="{{csrf_token()}}" data-pageno="{{$page_no}}" data-bango="{{ $bango }}"
                data-route="{{ route('tableSettingsSave',['id'=>$bango,'type'=> 'default']) }}"
                id="default_table_setting" style="margin-bottom: 10px;float: right;">デフォルト</a>
            </div>
          </div>
          <div id="errorShow"></div>
          <div id="setting_input_boxwrap_personal" data-bind="nextFieldOnEnter:true">

            @php
            $headersChunk = collect($table_headers)->chunk(18);
            $chunkCount = count($headersChunk);
            $colDivider = $chunkCount ? intdiv(12,$chunkCount) : 0 ;
            $val = 0;
            @endphp

            <div class="row">
              @foreach($headersChunk as $headers)
              <div class="col-lg-{{$colDivider}} col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">
                      @foreach($headers as $key => $header)
                      @if($val == 0)
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 22px!important;">
                            <input type="checkbox" id="check_{{$header}}" class="custom-control-input" checked="checked"
                              disabled>
                            <input type="hidden" name="check_{{$header}}" value="on">
                            <label class="custom-control-label margin_btn_17" for="check_{{$header}}"></label>

                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="{{$header}}" value="0" readonly="readonly" id="setting_{{$header}}"
                            class="form-control text-right" maxlength="1" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">{{ $key }}</span>
                        </td>
                      </tr>
                      @php
                      $val++;
                      @endphp
                      @else
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 22px!important;">
                            <input type="checkbox" name="check_{{$header}}" id="check_{{$header}}"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_{{$header}}"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="{{$header}}" id="setting_{{$header}}" class="form-control text-right"
                            maxlength="3" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">{{ $key }}</span>
                        </td>
                      </tr>
                      @endif
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach

            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="tableSettingSubmit" class="btn btn-info">
            <i class="fas fa-save" style="margin-right: 5px;"></i>保存
          </button>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<script type="text/javascript">
  function lastTab1_personal(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_business_name").focus();
            event.preventDefault();
        }
    }

    // document.onkeydown = function (event) {
    //   if(event.shiftKey && event.keyCode == 13)
    //   {
    //     return false;
    //   }
    // }


</script>
<script>
  $("textarea").keydown(function (event) {
        if (event.keyCode == 13 && !e.shiftKey) {
            event.preventDefault();

        }


    });
</script>
<script>
  ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input,textarea, select', function (e) {
                var self = $(this)
                    , form = $(element)
                    , focusable
                    , next
                ;

                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input,a,select,textarea,button').filter(':visible');
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