 <div class="modal custom-modal" data-backdrop="static" id="mailConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">メール送信処理</h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>

        <div class="modal-body">
          <div class="text-left" style="margin-bottom: 35px;">
            <h5>売上伝票をメールで送信します。</h5>
          </div>
          <div style="width: 100%;">
            <div class="d-inline-block" style="/*margin-left:-236px;*/">
              <label class="checkbox_container" style="margin-left:18px !important;">
              <input class="checkAllCheckbox tblCheckBox" type="checkbox" id="mail_bill_to" name="" value="" checked="">
              <span class="checkmark" style="top: -6px;left:-6px;"></span>
              </label>
                <span style="float: left;margin-left: 38px;margin-top: -7px;color:white;">請求書送付先</span>
            </div>
            <div class="d-inline-block">
              <label class="checkbox_container" style="margin-left:18px !important;">
                  <input class="checkAllCheckbox tblCheckBox" type="checkbox" id="mail_billing_address" name="" value="" >
                  <span class="checkmark" style="top: -6px;left:-6px;"></span>
                </label>
                <span style="float: left;margin-left: 38px;margin-top: -7px;color:white;">売上請求先</span>
            </div>
             <div class="text-left" style="margin-top: 15px;">
            <h5>よろしいですか？</h5>
          </div>
          </div>
        </div>

        <div class="modal-footer" style="border-top: 1px solid transparent;">
          <button type="button" class="btn text-white w-145 bg-default" data-dismiss="modal">キャンセル</button>
          <button type="button" id="send_mail" onclick="sendMail('{{route("sendMail",[$bango])}}');" class="btn w-145 bg-teal text-white">送信する</button>
        </div>
      </div>
    </div>
</div>