<div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="fileExtensionConfirmationModal" tabindex="-1"
  role="dialog" aria-labelledby="fileExtensionConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 450px !important;" role="document">
    <div class="modal-content bg-blue">
      <div class="modal-header">
        {{-- <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px";>Warning!</h5> --}}
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body text-white" data-bind="nextFieldOnEnter:true">
        <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">
          <div class="row titlebr mt-3" style="margin-bottom: 15px;">
            pdfまたはzip形式のファイルのみアップロード可能です。
          </div>
        </div>
        <div class="modal-footer border-top-0" style="padding: 0px;">
          <button type="button" id="cancelButton" class="btn text-white bg-default w-145" data-dismiss="modal"> 
            <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
        </div>
        <script type="text/javascript">
          //Tab first field focus....
          $(document).on('shown.bs.modal', function (e) {
            $('#cancelButton').focus();
          });
        </script>
      </div>
    </div>
  </div>
</div>