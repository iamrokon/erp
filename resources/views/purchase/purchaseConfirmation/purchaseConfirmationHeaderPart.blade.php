<form id="mainForm" method="post"> <!-- form tag ended in purchaseConfirmationDetails -->
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
    <input id='submit_confirmation' value='' type='hidden'/>
	
<div class="content-head-top" style="border-bottom:0px;margin-bottom:0px;">
    <div class="row">
      <div class="ml-3 mr-3">
        <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">仕入番号</td>
              <td style=" border: none!important;width: 202px;">
              <input type="text" name="unsoumei" id="unsoumei" value="@if(isset($purchaseData[0]->unsoumei)){{$purchaseData[0]->unsoumei}}@endif" class="form-control" placeholder="" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ml-3 mr-3">
        <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">仕入日</td>
              <td style=" border: none!important;width: 202px;">
              <input type="text" name="touchakudate" id="touchakudate" value="@if(isset($purchaseData[0]->touchakudate)){{$purchaseData[0]->touchakudate}}@endif" class="form-control" placeholder="年/月/日" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ml-3 mr-3">
        <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:2px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">仕入先</td>
              <td style=" border: none!important;width: 340px;">
              <input type="hidden" name="bikou1" id="bikou1" class="form-control" value="@if(isset($purchaseData[0]->bikou1)){{$purchaseData[0]->bikou1}}@endif">
              <input type="text" name="bikou1_detail" id="bikou1_detail" class="form-control" value="@if(isset($purchaseData[0]->bikou1_detail)){{$purchaseData[0]->bikou1_detail}}@endif"  placeholder="仕入先" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="ml-3 mr-3">
        <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">仕入区分</td>
              <td style=" border: none!important;width: 340px;">
                <input type="text" name="toiawasebango_detail" id="toiawasebango_detail" value="@if(isset($purchaseData[0]->toiawasebango_detail)){{$purchaseData[0]->toiawasebango_detail}}@endif" class="form-control" placeholder="" readonly="">
                <input type="hidden" name="toiawasebango" id="toiawasebango" value="@if(isset($purchaseData[0]->toiawasebango)){{$purchaseData[0]->toiawasebango}}@endif" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ml-3 mr-3">
        <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:4px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">納品書日付</td>
              <td style=" border: none!important;width: 202px;">
              <input type="text" name="" value="@if(isset($purchaseData[0]->dataint01)){{$purchaseData[0]->dataint01}}@endif" class="form-control" placeholder="年/月/日" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ml-3 mr-3">
        <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
          <tbody>
            <tr>
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 79px!important;">納品書番号</td>
              <td style=" border: none!important;width: 202px;">
              <input type="text" name="" value="@if(isset($purchaseData[0]->denpyoname)){{$purchaseData[0]->denpyoname}}@endif" class="form-control" placeholder="納品書番号" readonly="">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="ml-3 mr-3 d-flex  w-100 justify-content-end" style="background-color: #fff;">
        <div class="mt-2 mr-1">
          <table class="table custom-form" style="border: none!important;width:auto;">
          <tbody>
            <tr style="height: 28px;">
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                合計</td>
              <td style=" border: none!important;width: 15px!important;"></td>
              <td style=" border: none!important;width: 65%;color: #000;font-weight: bold;font-size: 0.9em;">
                @if(isset($purchaseData[0]->dataint03) && $purchaseData[0]->dataint03 != null){{'¥ '.number_format($purchaseData[0]->dataint03)}}@endif</td>
            </tr>
          </tbody>
          </table>
        </div>
        <div class="mt-2 mr-3">
          <table class="table custom-form" style="border: none!important;width:auto;">
          <tbody>
            <tr style="height: 28px;">
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                消費税</td>
              <td style=" border: none!important;width: 15px!important;"></td>
              <td style=" border: none!important;width: 55%;color: #000;font-weight: bold;font-size: 0.9em;">
                @if(isset($purchaseData[0]->datanum0001) && $purchaseData[0]->datanum0001 != null){{'¥ '.number_format($purchaseData[0]->datanum0001)}}@endif</td>
            </tr>
          </tbody>
          </table>
        </div>
        <div class="mt-2">
          <table class="table custom-form" style="border: none!important;width:auto;">
          <tbody>
            <tr style="height: 28px;">
              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                <div class="line-icon-box"></div>
              </td>
              <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                税込合計</td>
              <td style=" border: none!important;width: 15px!important;"></td>
              <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;font-size: 0.9em;">
                @if(isset($purchaseData[0]->sum_of_dataint03_datanum0001) && $purchaseData[0]->sum_of_dataint03_datanum0001 != null){{'¥ '.number_format($purchaseData[0]->sum_of_dataint03_datanum0001)}}@endif</td>
            </tr>
          </tbody>
          </table>
        </div>
      </div>
      </div>
  </div>
   </form>