<div class="modal custom-data-modal" data-backdrop="static" id="confirm_email_transmission_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 528px;">
      <div class="modal-content bg-blue">
        <div class="modal-header border-bottom-0" style="background: #fff;">
     
        </div>
        <div class="modal-body" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box">
            <table class="table text-white" id="table-basic">
              <tbody>
                <tr>
                  <td
                    style="font-size: 0.8em;border-left: 0px !important;border-right: 0px !important;width: 840px;border-bottom: 0px!important;padding: 5px 8px 5px 2px !important;">
                    <div>
                    <span class="modal-message"></span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="border-top-0 pt-4 pb-2 text-center">
          
            <button type="button" id="choice_button" class="btn uskc-button bg-teal text-white closeModal" data-dismiss="modal">
             OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<script>
    $(document).ready(function (){
        $(".closeModal").on("click",function (e){
            e.preventDefault();
            $("#confirm_email_transmission_modal").hide()
        })
    })
</script>