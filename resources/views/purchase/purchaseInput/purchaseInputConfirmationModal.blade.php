{{-- Confirmation Modal Starts Here --}}
<div class="modal custom-modal" data-backdrop="static" tabindex="-1" role="dialog" id="confirmation_modal"
  aria-labelledby="ConfirmationModal" aria-hidden="true">
  <input type="hidden" id="confirmModalStatus" name="confirmModalStatus" class="confirmModalStatus" value="0">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 380px;">
      <div class="modal-header">
        <h5 class="modal-title" id="ConfirmationModalLabel"></h5>
        <span type="button" class="close purchaseConfirmModalClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body">
        <div class="text-left" style="margin-bottom: 35px;">
          <h6>仕入完了済ですがよろしいですか。</h6>
        </div>
      </div>
      <div class="modal-footer" style="border-top: 1px solid transparent;">
        <button type="button" id="confirmOK" class="btn w-145 bg-teal text-white uskc-button confirmOk confirmBackDataOk">はい</button>
        <button type="button" id="confirmCancel" class="btn text-white w-145 bg-default uskc-button confirmCancel" data-dismiss="modal">いいえ</button>
      </div>
    </div>
  </div>
</div>
{{-- Confirmation Modal Ends Here --}}