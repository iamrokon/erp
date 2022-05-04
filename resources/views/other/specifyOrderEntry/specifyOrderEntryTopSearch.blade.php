<!-- content head section start -->
<form id="firstSearch" action="{{ route('specifyOrderEntry') }}" method="post">
	<input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
	<input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
	<input id='submit_confirmation' value='' type='hidden'/>
	@csrf  
		
<div class="content-head-section">
  <div class="container position-relative">
     <div class="row">
        <div class="col-12">
           <div class="customalert"  style="padding:10px; margin-bottom: 0px;background: #e6e6ff;color: #3333FF;border-radius: 4px;display: none;">
            <span class="close alertclose" style="color: #3333FF;">
              <span aria-hidden="true">&times;</span>
            </span>
            <strong>作成しました</strong>
         </div>
        </div>
 
     </div>
     <div class="row">

      <div class="col-12">
        <div class="popupalert" style="padding: 10px; margin-bottom: 0px;background: #e6e6ff;color: #3333FF;border-radius: 4px;display: none;">
              <span class="close alertclose2" style="color: #3333FF;">
                <span aria-hidden="true">&times;</span>
              </span>
              <strong>検収書メールを送信しました</strong>
        </div>
      </div>
      
     </div>


    <div class="row inner-top-content2 inner-top-content">
      <div class="col-5">
        <table class="table custom-form " style="border: none!important;width: 440px;">
          <tbody>
            <tr>
              <td style="important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style="border: none!important;width:110px;">受注入力使用</td>
              <td style=" border: none!important;">
                <div class="data-box switch-area float-left border" style="padding: 0px; border: none !important;background: white;" onclick="checkCheckbox()">
                    <label class="switch">
                        <input name="req_type" id="req_type" type="checkbox" class="switch-one" checked>
                      <div class="slider">
                        <span class="on">可</span>
                        <span class="off">不可</span>
                      </div>
                    </label>
                  </div>
              </td>
            </tr>
            <tr>
              <td style="width: 5%!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style="border: none!important;">除外社員</td>
              <td style=" border: none!important;">
                <input name="bango1" id="bango1" type="text" readonly class="form-control" placeholder="" maxlength="4" style="width:94px;text-align:right;">
              </td>
              <td style=" border: none!important;width:15px;"></td>
              <td style=" border: none!important;">
                <input name="bango2" id="bango2" type="text" readonly class="form-control" placeholder="" maxlength="4" style="width:94px;text-align:right;">
              </td>
              <td style=" border: none!important;width:15px;"></td>
              <td style=" border: none!important;">
                <input name="bango3" id="bango3" type="text" readonly class="form-control" placeholder="" maxlength="4" style="width:94px;text-align:right;">
              </td>
            </tr>
           
          </tbody>
        </table>
      </div>
      <div class="col-4"></div>
      <div class="col-3"></div>
    </div>
    <!-- <div class="row">
      <div class="col-12">
        <div class="border-line" style="border-top: 1px solid #e1e1e1;"></div>
      </div>
    </div> -->
    <div class="row ">
      <div class="col-6"></div>
      <div class="col-6">
        <div class="margin_t">
          <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
            <tbody>
              <tr>
                <td style=" border: none!important;padding: 0px!important;">
				<button onclick="firstSearch('{{route('specifyOrderEntry')}}',event.preventDefault())"  id="contenthide" href="#" style="width:150px;height:30px;line-height:30x;" class="btn btn-info">更新
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div>
</form>
<!-- content head section end -->