<div class="content-bottom-section" style="padding-bottom: 10px;">

  <div class="content-bottom-top" style="margin-bottom: 30px;">

    {{-- Page Title Starts Here --}}
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="bottom-top-title">
            仕入明細
          </div>
        </div>
      </div>
    </div>
    {{-- Page Title Ends Here --}}

    {{-- Pagination Starts Here --}}

    {{-- Pagination Ends Here --}}

  </div>

  <div class="content-bottom-bottom">
    <div class="container">

      {{-- Table Starts Here --}}
	  
	  <div id="purchaseBodyPart">
      @include('purchase.purchaseConfirmation.purchaseConfirmationBodyPart')
	  </div>

	<form id="mainForm3" method="post"> 
      <div class="row">
        <div class="col-6 pl-0">
          <div class="ml-3 mr-3">
            <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
              <tbody>
                <tr>
                  <td style="width: 23px!important;padding: 0!important;border:0!important;">
                    <div class="line-icon-box"></div>
                  </td>
                  <td style=" border: none!important;width: 79px!important;">伝票備考</td>
                  <td style=" border: none!important;width: 537px;">
                  <input type="text" name="" disabled class="form-control" placeholder="">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-6" style="display: flex;justify-content: flex-end;align-items: center;">
		  <input type="hidden" id="hidden_total_data_count" />
          <span id="data_count"></span>
        </div>
      </div>
      <div class="row">
        <div class="ml-3 mr-3">
          <table class="table custom-form custom-table" style="border: none!important;margin-bottom:4px !important">
            <tbody>
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-icon-box"></div>
                </td>
                <td style=" border: none!important;width: 79px!important;">指示者</td>
                <td style=" border: none!important;width: 197px">
                <div style="width: 187px!important;">
                    <div class="input-group input-group-sm position-relative">
                      <input name="datachar06" id="datachar06" type="text" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                      <input name="datachar06_hidden" id="datachar06_hidden" value="{{$bango}}" type="hidden">
                      <input name="datachar06_hidden_text" id="datachar06_hidden_text" value="{{mb_substr(str_replace(" ","",str_replace("　","",$tantousya->name)),0,3)}}" type="hidden">
                      <div class="input-group-append" id="modalarea">
                        <button type="button" onclick="getInstrusctorName()" class="input-group-text btn" style="padding-left: 7px!important;width: 40px!important; background-color:#2C66B0!important;">指示</button>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="ml-4 mr-3">
          <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
            <tbody>
              <tr>
                <td style="width: 23px!important;padding: 0!important;border:0!important;">
                  <div class="line-icon-box"></div>
                </td>
                <td style=" border: none!important;width: 65px!important;">検印者</td>
                <td style=" border: none!important;width: 189px;">
                    <input type="text" name="" id="datachar07_hidden_text" readonly class="form-control" placeholder="" >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
	</form>

      {{-- Table Ends Here --}}



    </div>
    <div class="container">
      {{-- Table Bottom Button Starts Here --}}
      <div class="row mb-2">
        <div class="ml-3 mr-3 d-flex w-100 justify-content-end ">
          <div style="background-color: #fff;padding:10px;">
            <!-- <button onclick="registerPurchaseConfirmation();event.preventDefault();" id="regButton" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">登録</button> -->
            <button onclick="registerPurchaseConfirmation();event.preventDefault();" id="regButton" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">登録</button>
            <button onclick="firstSearch('{{route('purchaseData')}}','previous',event.preventDefault())" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">前伝票</button>  
            <button onclick="firstSearch('{{route('purchaseData')}}','next',event.preventDefault())" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">次伝票</button>
          </div>
        </div>
      </div>
      {{-- Table Bottom Button Ends Here --}}
    </div>

  </div>
</div>

 