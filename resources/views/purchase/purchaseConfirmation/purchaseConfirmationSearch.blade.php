<form id="backlogSearch" method="post"> 
<input type="hidden" id="user_id" name="userId" value="{{$bango}}">
<input type="hidden" name="csrf-token" id="bottomSearchCsrf" value="{{ csrf_token() }}">
<div class="content-head-top" style="border-bottom: 0px;margin-bottom: 13px;">
  <div class="container">
      
    {{-- Error Message Starts Here --}}
    <div class="row">
      <div class="col-12">
          <div id="error_data_2" style="color: red;position: relative;margin-top: 45px;"></div>
      </div>
    </div>
    {{-- Error Message Ends Here --}}
  
    <div class="row mt-3">
      <div class="col-6">
        <table class="table custom-form " style="border: none!important;margin-bottom: 2px!important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">受注先</td>
              <td style=" border: none!important;">
                <div class="input-group input-group-sm custom_modal_input">
				  <input name="datachar10" type="hidden" id="msearch_datachar10" />
                  <input name="datachar10_detail" id="msearch_datachar10_detail" type="text" class="form-control" placeholder="受注先" readonly="">
                  <div class="input-group-append"  style="margin-left: 0px;">
                    <button onclick="supplierSelectionModalOpener_3('msearch_datachar10_detail','msearch_datachar10','1','nullable','r20cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">売上請求先</td>
              <td style=" border: none!important;">
                <div class="input-group input-group-sm custom_modal_input">
				  <input name="information2" type="hidden" id="msearch_information2" />
                  <input name="information2_detail" id="msearch_information2_detail" type="text" class="form-control" placeholder="売上請求先" readonly="">
                  <div class="input-group-append" style="margin-left: 0px!important;">
                    <button onclick="supplierSelectionModalOpener_3('msearch_information2_detail','msearch_information2','1','nullable','r20cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">最終顧客</td>
              <td style=" border: none!important;">
                <div class="input-group input-group-sm custom_modal_input">
				  <input name="datachar11" type="hidden" id="msearch_datachar11" />
                  <input name="datachar11_detail" id="msearch_datachar11_detail" type="text" class="form-control" placeholder="最終顧客" readonly="">
                  <div class="input-group-append" style="margin-left: 0px!important;">
                    <button onclick="supplierSelectionModalOpener_3('msearch_datachar11_detail','msearch_datachar11','1','nullable','r20cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-6">

        <div class="d-inline-block float-right" style="margin-top: 70px;">
          <button onclick="backlogDataSearch('{{route('backlogDataSearch')}}',event.preventDefault())" type="button" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
        </div>
      </div>
  </div>
</div>
  
</div>
</form>